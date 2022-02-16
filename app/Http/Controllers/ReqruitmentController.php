<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Models\Reqruitment;
use App\Services\CalculateReqruitment;
use App\Datatable\ReqruitmentDatatable;
use App\Http\Requests\ReqruitmentRequest;
use App\Datatable\ReqruitmentUserDatatable;
use App\Datatable\ReqruitmentCriteriaDatatable;

class ReqruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return inertia('reqruitment/index')->datatable(new ReqruitmentDatatable)->title('Daftar Penerimaan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): Response
    {
        return inertia('reqruitment/create')->title('Tambah Penerimaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReqruitmentRequest $request)
    {
        Reqruitment::create($request->validated());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Reqruitment $reqruitment)
    {
        return inertia('reqruitment/show')
            ->datatable(new ReqruitmentCriteriaDatatable($reqruitment))
            ->with(['reqruitment' => $reqruitment])
            ->title('Rincian Kriteria');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reqruitment $reqruitment)
    {
        return inertia('reqruitment/edit')->with(['reqruitment' => $reqruitment])->title('Ubah Penerimaan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Reqruitment $reqruitment, ReqruitmentRequest $request)
    {
        $reqruitment->update($request->validated());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reqruitment $reqruitment)
    {
        $reqruitment->delete();
        return back();
    }

    /**
     * Get users where reqruitment
     *
     * @param Reqruitment $reqruitment
     * @return Response
     */
    public function users(Reqruitment $reqruitment): Response
    {
        return inertia('reqruitment/users/index')
            ->datatable(new ReqruitmentUserDatatable($reqruitment))
            ->with(['reqruitment' => $reqruitment])
            ->title("Daftar Peserta {$reqruitment->name}");
    }

    public function ranks(Reqruitment $reqruitment, CalculateReqruitment $result)
    {
        return inertia('reqruitment/users/ranks')
            ->with(['result' => $result->execute($reqruitment)])
            ->title('Peringkat Peserta');
    }
}
