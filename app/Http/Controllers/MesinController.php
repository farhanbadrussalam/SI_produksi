<?php

namespace App\Http\Controllers;

use App\Models\mesin;
use App\Http\Requests\StoremesinRequest;
use App\Http\Requests\UpdatemesinRequest;

use DataTables;

class MesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mesin.index');
    }

    public function dataAjax()
    {
        $mesin = mesin::all();

        return DataTables::of($mesin)
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
     * @param  \App\Http\Requests\StoremesinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoremesinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function show(mesin $mesin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function edit(mesin $mesin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatemesinRequest  $request
     * @param  \App\Models\mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatemesinRequest $request, mesin $mesin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mesin  $mesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(mesin $mesin)
    {
        //
    }
}
