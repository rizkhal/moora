<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Criteria;
use App\Enums\WeightType;
use App\Models\Reqruitment;
use Illuminate\Support\Arr;
use App\Models\CriteriaDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\ReqruitmentCriteriaRequest;
use App\Datatable\ReqruitmentCriteriaDetailDatatable;

class ReqruitmentCriteriaController extends Controller
{
    public function create(Reqruitment $reqruitment)
    {
        return inertia('reqruitment/criteria/create')->with([
            'reqruitment' => $reqruitment,
            'weightTypes' => WeightType::labels(),
        ])->title('Kelola Kriteria');
    }

    public function store(ReqruitmentCriteriaRequest $request, Reqruitment $reqruitment)
    {
        DB::beginTransaction();

        try {
            $criteria = Criteria::create($request->criteria());

            collect($request->options)->each(
                fn ($field): CriteriaDetail => $criteria->details()->create($field)
            );

            DB::commit();

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return back();
        }
    }

    public function show(Reqruitment $reqruitment, Criteria $criteria)
    {
        return inertia('reqruitment/criteria/show')
            ->datatable(new ReqruitmentCriteriaDetailDatatable($criteria))
            ->title('Rincian Kriteria');
    }

    public function edit(Reqruitment $reqruitment, Criteria $criteria): Response
    {
        return inertia('reqruitment/criteria/edit', [
            'weightTypes' => WeightType::labels(),
            'criteria' => $criteria->where('id', $criteria->id)->where('reqruitment_id', $reqruitment->id)->with('details')->first()
        ]);
    }

    public function update(Reqruitment $reqruitment, Criteria $criteria, ReqruitmentCriteriaRequest $request)
    {
        DB::beginTransaction();

        try {
            $criteria->update(Arr::except($request->criteria(), 'reqruitment_id'));

            collect($request->options)->each(function ($field) use ($criteria) {
                if (isset($field['id']) && $detail = CriteriaDetail::whereId($field['id'])->first()) {
                    $detail->update(Arr::except($field, 'id'));
                } else {
                    $criteria->details()->create([
                        'text' => $field['text'],
                        'weight' => $field['weight']
                    ]);
                }
            });

            $ids = collect($request->options)->pluck('id');

            $criteria->details()->when(
                $ids,
                fn (Builder $query): int => $query->whereNotIn('id', collect($request->options)->pluck('id')->all())->delete()
            );

            DB::commit();

            return back();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
            return back();
        }
    }

    public function destroy(Reqruitment $reqruitment, Criteria $criteria)
    {
        $criteria->whereReqruitmentId($reqruitment->id)->delete();
        return back();
    }
}
