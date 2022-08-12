<?php

namespace App\Http\Controllers;

use App\Models\kain;
use App\Http\Requests\StorekainRequest;
use App\Http\Requests\UpdatekainRequest;

use DataTables;

class KainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kain.index');
    }

    public function dataAjax()
    {
        $kain = kain::all();

        return DataTables::of($kain)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return "
                    <div class='d-flex justify-content-center w-100'>
                        <a href='javascript:void(0)' onclick='editData(this)' data-item='$row' class='btn btn-warning mr-2'>
                            <i class='fas fa-edit' aria-hidden='true'></i>
                        </a>
                        <a href='javascript:void(0)' onclick='deleteThis($row->id)' class='btn btn-danger'>
                            <i class='fas fa-trash' aria-hidden='true'></i>
                        </a>
                    </div>
                ";
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
     * @param  \App\Http\Requests\StorekainRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorekainRequest $request)
    {
        kain::create([
            'nama_kain' => $request->nama_kain
        ]);
        return redirect('/kain')->with('success', 'Create new kain success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function show(kain $kain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function edit(kain $kain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatekainRequest  $request
     * @param  \App\Models\kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatekainRequest $request, kain $kain)
    {
        kain::where('id', $kain->id)->update([
            'nama_kain' => $request->nama_kain
        ]);

        return redirect('/kain')->with('success', 'Update kain success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function destroy(kain $kain)
    {
        kain::destroy($kain->id);
        return 'Kain has been deleted';
    }
}
