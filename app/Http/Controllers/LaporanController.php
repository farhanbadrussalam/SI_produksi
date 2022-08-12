<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\produksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;

date_default_timezone_set('Asia/Jakarta');

class LaporanController extends Controller
{
    public function index()
    {

        $date = now()->format('Y-m-d');
        $data = array();
        $user = Auth::user();

        $dataOperator = User::where('level', 3)->get();
        foreach ($dataOperator as $key => $value) {
            $jadwal = jadwal::where('user_id', $value->id)->where('tanggal', $date)->first();
            $bagus = 0;
            $jelek = 0;
            $quantityAwal = 0;
            $quantityJadi = 0;
            if ($jadwal) {
                $produksi = produksi::where('jadwal_id', $jadwal->id)->get();

                if ($produksi) {
                    foreach ($produksi as $key1 => $value_1) {
                        if ($value_1->jenis_proses == 'Bagus') {
                            $bagus = $bagus + $value_1->quantity_jadi;
                        } else {
                            $jelek = $jelek + $value_1->quantity_jadi;
                        }
                        $quantityAwal = $quantityAwal + $value_1->quantity_awal;
                        $quantityJadi = $quantityJadi + $value_1->quantity_jadi;
                    }
                }
            }
            $value->bagus = $bagus;
            $value->jelek = $jelek;
            $value->quantityAwal = $quantityAwal;
            $value->quantityJadi = $quantityJadi;
            $value->nama_mesin = $jadwal ? $jadwal->mesin->nama_mesin : '-';
        }
        $data['operator'] = $dataOperator;

        return view('laporan.index', $data);
    }

    public function cetak()
    {
        $date = now()->format('Y-m-d');
        $data = array();
        $user = Auth::user();

        $dataOperator = User::where('level', 3)->get();
        foreach ($dataOperator as $key => $value) {
            $jadwal = jadwal::where('user_id', $value->id)->where('tanggal', $date)->first();
            $produksi = produksi::where('jadwal_id', $jadwal->id)->get();

            $bagus = 0;
            $jelek = 0;
            $quantityAwal = 0;
            $quantityJadi = 0;
            foreach ($produksi as $key1 => $value_1) {
                if ($value_1->jenis_proses == 'Bagus') {
                    $bagus = $bagus + $value_1->quantity_jadi;
                } else {
                    $jelek = $jelek + $value_1->quantity_jadi;
                }
                $quantityAwal = $quantityAwal + $value_1->quantity_awal;
                $quantityJadi = $quantityJadi + $value_1->quantity_jadi;
            }
            $value->bagus = $bagus;
            $value->jelek = $jelek;
            $value->quantityAwal = $quantityAwal;
            $value->quantityJadi = $quantityJadi;
            $value->nama_mesin = $jadwal ? $jadwal->mesin->nama_mesin : '-';
        }
        $data['operator'] = $dataOperator;
        $pdf = PDF::loadView('laporan.cetak', $data);

        return $pdf->stream();
    }
}
