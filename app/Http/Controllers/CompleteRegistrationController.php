<?php

namespace App\Http\Controllers;

use App\Enums\Gender;
use Inertia\Response;
use App\Models\Criteria;
use Illuminate\Support\Str;
use App\Models\CriteriaDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CompleteRegistrationRequest;

class CompleteRegistrationController extends Controller
{
    public function view(): Response
    {
        $genders = collect(Gender::cases())->mapWithKeys(fn ($item) => [$item->value => Str::title($item->label())]);

        $criteria = Criteria::with('details')->get()->map(function ($criteria): Criteria {
            $name = Str::slug($criteria->name, '_');

            return $criteria->fill([
                'input_name' => $name,
                'input_file_name' => "{$name}_file"
            ]);
        });

        return inertia('participan/complete-registration', [
            'genders' => $genders,
            'criterias' => $criteria,
        ]);
    }

    public function store(CompleteRegistrationRequest $request)
    {
        DB::beginTransaction();

        try {
            user()->detail()->create($request->commonValidatedData());

            // create directory if not exists
            if (!Storage::exists(user()->detail->nik)) {
                Storage::makeDirectory(user()->detail->nik);
            }

            $pictureFile = $request->file('picture');

            $picture = $pictureFile->storeAs(
                user()->detail->nik,
                user()->detail->nik . "." . $pictureFile->getClientOriginalExtension()
            );

            user()->detail()->update(['picture' => $picture]);

            $criteria = $request->getDynamicCriteria();

            collect($criteria['texts'])->map(function ($value, $key) use ($request, $criteria) {
                $file = $criteria['files'][$key];

                if ($request->hasFile($criteria['files'][$key])) {
                    $paths =  $request->{$file}->storeAs(user()->detail->nik, "{$key}.pdf");
                }

                DB::table('user_has_criterias')->insert([
                    'user_id' => user()->id,
                    'model_type' => Criteria::class,
                    'criteria_id' => CriteriaDetail::find($request->{$value})->criteria_id,
                ]);

                DB::table('user_has_criteria_details')->insert([
                    'user_id' => user()->id,
                    'file' => $paths ?? null,
                    'model_type' => CriteriaDetail::class,
                    'criteria_detail_id' => $request->{$value},
                ]);
            });

            DB::commit();

            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
