<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Criteria;
use App\Enums\WeightType;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Table\CriteriaTable;
use Illuminate\Http\Request;
use App\Models\CriteriaDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CriteriaRequest;
use Illuminate\Database\Eloquent\Builder;

class CriteriaController extends Controller
{
    public function index(Request $request, CriteriaTable $datatable): Response
    {
        return inertia('criteria/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }

    public function create(): Response
    {
        $weightTypes = collect(WeightType::cases())->mapWithKeys(fn ($object) => [$object->value => Str::title($object->name)]);

        return inertia('criteria/create', [
            'weightTypes' => $weightTypes,
        ]);
    }

    public function store(CriteriaRequest $request)
    {
        DB::beginTransaction();

        try {
            $criteria = Criteria::create($request->criteria());
            collect($request->options)->each(fn ($field): CriteriaDetail => $criteria->details()->create($field));

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambah kriteria');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Criteria $criterion): Response
    {
        $weightTypes = collect(WeightType::cases())->mapWithKeys(fn ($object) => [$object->value => Str::title($object->name)]);

        return inertia('criteria/edit', [
            'weightTypes' => $weightTypes,
            'criteria' => $criterion->where('id', $criterion->id)->with('details')->first()
        ]);
    }

    public function update(Criteria $criterion, CriteriaRequest $request)
    {
        DB::beginTransaction();

        try {
            $criterion->update($request->criteria());
            collect($request->options)->each(function ($field) use ($criterion) {
                if (isset($field['id']) && $detail = CriteriaDetail::whereId($field['id'])->first()) {
                    $detail->update(Arr::except($field, 'id'));
                } else {
                    $criterion->details()->create($field);
                }
            });

            $ids = collect($request->options)->pluck('id');
            $criterion->details()->when($ids, fn (Builder $query): int => $query->whereNotIn('id', collect($request->options)->pluck('id')->all())->delete());

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambah kriteria');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(Criteria $criterion)
    {
        DB::beginTransaction();

        try {
            $criterion->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menghapus criteria');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus kriteria');
        }
    }
}
