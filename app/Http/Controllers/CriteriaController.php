<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Enums\WeightType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CriteriaRequest;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    public function index(Request $request): Response
    {
        return inertia('criteria/index');
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
                $criteria->subCriteria()->create($request->texts);
            }

            if ($this->isOption()) {
                $criteria->subCriteria()->create($request->options);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
