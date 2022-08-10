<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Http\Requests\StorejadwalRequest;
use App\Http\Requests\UpdatejadwalRequest;

use DataTables;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwal = jadwal::all();
        return view('jadwal.index');
    }

    public function dataAjax()
    {
        $jadwal = jadwal::all();

        return DataTables::of($jadwal)
            ->addIndexColumn()
            ->addColumn('nama_opp', function ($row) {
                return $row->user->name;
            })
            ->addColumn('nama_mesin', function ($row) {
                return $row->mesin->nama_mesin;
            })
            ->addColumn('waktu', function ($row) {
                return $row->mulai . ' S/D ' . $row->selesai;
            })
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
     * @param  \App\Http\Requests\StorejadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorejadwalRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatejadwalRequest  $request
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatejadwalRequest $request, jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwal $jadwal)
    {
        //
    }
}
