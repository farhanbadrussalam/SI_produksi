<?php

namespace App\Http\Controllers;

use App\Models\produksi;
use App\Http\Requests\StoreproduksiRequest;
use App\Http\Requests\UpdateproduksiRequest;

use DataTables;

class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produksi.index');
    }

    public function dataAjax()
    {
        $produksi = produksi::join('proses_mesin', 'tbl_produksi.proses_id', '=', 'proses_mesin.id')
            ->join('master_mesin', 'proses_mesin.mesin_id', '=', 'master_mesin.id')->get();

        return DataTables::of($produksi)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <div class="d-flex justify-content-center w-100">
                        <a href="' . url("dashboard/product/$row->id") . '" class="btn btn-info mr-2">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                        </a>
                        <a href="' . url("dashboard/product/$row->id/edit") . '" class="btn btn-warning mr-2">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="deleteThis(' . $row->id . ')" class="btn btn-danger">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                ';
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproduksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreproduksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function show(produksi $produksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function edit(produksi $produksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateproduksiRequest  $request
     * @param  \App\Models\produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateproduksiRequest $request, produksi $produksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(produksi $produksi)
    {
        //
    }
}
