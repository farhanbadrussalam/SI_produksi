<?php

namespace App\Http\Controllers;

use App\Models\proses_mesin;
use App\Http\Requests\Storeproses_mesinRequest;
use App\Http\Requests\Updateproses_mesinRequest;

class ProsesMesinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\Storeproses_mesinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storeproses_mesinRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\proses_mesin  $proses_mesin
     * @return \Illuminate\Http\Response
     */
    public function show(proses_mesin $proses_mesin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\proses_mesin  $proses_mesin
     * @return \Illuminate\Http\Response
     */
    public function edit(proses_mesin $proses_mesin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updateproses_mesinRequest  $request
     * @param  \App\Models\proses_mesin  $proses_mesin
     * @return \Illuminate\Http\Response
     */
    public function update(Updateproses_mesinRequest $request, proses_mesin $proses_mesin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\proses_mesin  $proses_mesin
     * @return \Illuminate\Http\Response
     */
    public function destroy(proses_mesin $proses_mesin)
    {
        //
    }
}
