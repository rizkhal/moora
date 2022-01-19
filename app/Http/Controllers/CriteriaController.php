<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Criteria;
use App\Enums\WeightType;
use Illuminate\Http\Request;
use App\Models\CriteriaDetail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CriteriaRequest;
use App\Table\CriteriaTable;

class CriteriaController extends Controller
{
    public function index(Request $request, CriteriaTable $datatable): Response
    {
        return inertia('criteria/index', [
            'columns' => $datatable->columns(),
            'data' => $datatable->query($request),
        ]);
    }

    public function create()
    {
        $weightTypes = collect(WeightType::cases())->mapWithKeys(fn ($object) => [$object->value => $object->name]);

        return inertia('criteria/create', [
            'weightTypes' => $weightTypes,
        ]);
    }

    public function store(CriteriaRequest $request)
    {
        DB::beginTransaction();

        try {
            $criteria = Criteria::create($request->criteria());
            if ($request->isText()) {
                $criteria->detail()->create($request->texts);
            }

            if ($request->isOption()) {
                collect($request->options)->each(fn ($field): CriteriaDetail => $criteria->detail()->create($field));
            }

            if ($request->isFile()) {
                $criteria->detail()->create($request->get('files'));
            }

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil menambah kriteria');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(Criteria $criterion): Response
    {
        return inertia('criteria/edit');
    }
}
