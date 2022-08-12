<?php

namespace App\Http\Controllers;

use App\Models\produksi;
use App\Http\Requests\StoreproduksiRequest;
use App\Http\Requests\UpdateproduksiRequest;
use App\Models\jadwal;
use App\Models\kain;
use App\Models\proses_mesin;
use DataTables;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('Asia/Jakarta');
class ProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = now()->format('Y-m-d');
        $getJadwal = jadwal::where('user_id', Auth::user()->id)
            ->where('tanggal', $date)
            ->first();
        $dataProses = array();
        if ($getJadwal) {
            $listProses = proses_mesin::whereIn('id', json_decode($getJadwal->proses))->get();
            foreach ($listProses as $key => $value) {
                $data = produksi::where('jadwal_id', $getJadwal->id)->where('proses_id', $value->id)->first();
                if (!isset($data)) {
                    array_push($dataProses, $value);
                }
            }
        }
        return view('produksi.index', [
            'jadwal' => $getJadwal,
            'proses' => count($dataProses)
        ]);
    }

    public function dataAjax()
    {
        $date = now()->format('Y-m-d');

        $produksi = produksi::select('tbl_produksi.*', 'master_mesin.nama_mesin', 'proses_mesin.nama_proses')
            ->join('proses_mesin', 'tbl_produksi.proses_id', '=', 'proses_mesin.id')
            ->join('master_mesin', 'proses_mesin.mesin_id', '=', 'master_mesin.id')
            ->join('tbl_jadwal', 'tbl_produksi.jadwal_id', '=', 'tbl_jadwal.id')
            ->where('tbl_jadwal.tanggal', $date)
            ->get();

        return DataTables::of($produksi)
            ->addIndexColumn()
            ->addColumn('waktu', function ($row) {
                return "$row->waktu_mulai - $row->waktu_selesai";
            })
            ->addColumn('jenis_kain', function ($row) {
                return $row->kain->nama_kain;
            })
            ->addColumn('action', function ($row) {
                return "
                    <div class='d-flex justify-content-center w-100'>
                        <a href='javascript:void(0)' onclick='showInfo(this)' data-item='$row' class='btn btn-info mr-2'>
                            <i class='fas fa-comment' aria-hidden='true'></i>
                        </a>
                        <a href=' " . url("produksi/$row->id/edit") . " ' class='btn btn-warning mr-2'>
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
        $date = now();
        $getJadwal = jadwal::where('user_id', Auth::user()->id)
            ->where('tanggal', $date->format('Y-m-d'))
            ->first();
        $dataProses = array();
        if ($getJadwal) {
            $listProses = proses_mesin::whereIn('id', json_decode($getJadwal->proses))->get();
            foreach ($listProses as $key => $value) {
                $data = produksi::where('jadwal_id', $getJadwal->id)->where('proses_id', $value->id)->first();
                if (!isset($data)) {
                    array_push($dataProses, $value);
                }
            }
        }
        return view('produksi.create', [
            'dataProses' => $dataProses,
            'dataKain' => kain::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreproduksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreproduksiRequest $request)
    {
        $validateData = $request->validate([
            'proses' => 'required',
            'jenis_kain' => 'required',
            'warna' => 'required',
            'jenis_proses' => 'required',
            'quantity_awal' => 'required',
            'quantity_jadi' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'
        ]);

        $date = now();
        $getJadwal = jadwal::where('user_id', Auth::user()->id)
            ->where('tanggal', $date->format('Y-m-d'))
            ->first();

        $data = [
            'jadwal_id' => $getJadwal->id,
            'proses_id' => $request->proses,
            'kain_id' => $request->jenis_kain,
            'warna' => $request->warna,
            'quantity_awal' => $request->quantity_awal,
            'quantity_jadi' => $request->quantity_jadi,
            'jenis_proses' => $request->jenis_proses,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'keterangan' => $request->keterangan
        ];

        produksi::create($data);
        return redirect('/produksi')->with('success', 'Create new produksi success');
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
        $date = now();
        $getJadwal = jadwal::where('user_id', Auth::user()->id)
            ->where('tanggal', $date->format('Y-m-d'))
            ->first();
        $dataProses = array();
        if ($getJadwal) {
            $listProses = proses_mesin::whereIn('id', json_decode($getJadwal->proses))->get();
            foreach ($listProses as $key => $value) {
                $data = produksi::where('jadwal_id', $getJadwal->id)->where('proses_id', $value->id)->first();
                if (!isset($data)) {
                    array_push($dataProses, $value);
                } else {
                    if ($data->id == $produksi->id) {
                        array_push($dataProses, $value);
                    }
                }
            }
        }
        return view('produksi.edit', [
            'dataProduksi' => $produksi,
            'dataProses' => $dataProses,
            'dataKain' => kain::all()
        ]);
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
        $validateData = $request->validate([
            'proses' => 'required',
            'jenis_kain' => 'required',
            'warna' => 'required',
            'jenis_proses' => 'required',
            'quantity_awal' => 'required',
            'quantity_jadi' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'
        ]);

        $data = [
            'proses_id' => $request->proses,
            'kain_id' => $request->jenis_kain,
            'warna' => $request->warna,
            'quantity_awal' => $request->quantity_awal,
            'quantity_jadi' => $request->quantity_jadi,
            'jenis_proses' => $request->jenis_proses,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'keterangan' => $request->keterangan
        ];

        produksi::where('id', $produksi->id)->update($data);
        return redirect('/produksi')->with('success', 'Update produksi success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(produksi $produksi)
    {
        produksi::destroy($produksi->id);
        return 'Produksi has been deleted';
    }
}
