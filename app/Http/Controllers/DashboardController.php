<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Models\produksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

date_default_timezone_set('Asia/Jakarta');

class DashboardController extends Controller
{
    public function index()
    {
        $date = now()->format('Y-m-d');
        $data = array();
        $user = Auth::user();
        if ($user->level == 3) {
            $getJadwal = jadwal::where('user_id', $user->id)
                ->where('tanggal', $date)
                ->first();
            if ($getJadwal) {
                $quantity = produksi::select(DB::raw('SUM(quantity_awal) as awal'), DB::raw('SUM(quantity_jadi) as jadi'))->where('jadwal_id', $getJadwal->id)->first();
                $data['quantity_awal'] = $quantity->awal;
                $data['quantity_jadi'] = $quantity->jadi;
            } else {
                $data['quantity_awal'] = 0;
                $data['quantity_jadi'] = 0;
            }
        } else {
            $quantity = produksi::join('tbl_jadwal', 'tbl_jadwal.id', '=', 'tbl_produksi.jadwal_id')->select(DB::raw('SUM(quantity_awal) as awal'), DB::raw('SUM(quantity_jadi) as jadi'))->where('tbl_jadwal.tanggal', $date)->first();

            $data['quantity_awal'] = $quantity->awal ? $quantity->awal : 0;
            $data['quantity_jadi'] = $quantity->jadi ? $quantity->jadi : 0;
        }

        if ($user->level == 1) {
            $dataOperator = User::where('level', 3)->get();
            foreach ($dataOperator as $key => $value) {
                $jadwal = jadwal::where('user_id', $value->id)->where('tanggal', $date)->first();
                $produksi = produksi::where('jadwal_id', $jadwal->id)->get();

                $bagus = 0;
                $jelek = 0;
                foreach ($produksi as $key1 => $value_1) {
                    if ($value_1->jenis_proses == 'Bagus') {
                        $bagus = $bagus + $value_1->quantity_jadi;
                    } else {
                        $jelek = $jelek + $value_1->quantity_jadi;
                    }
                }
                $value->bagus = $bagus;
                $value->jelek = $jelek;
                $value->nama_mesin = $jadwal ? $jadwal->mesin->nama_mesin : '-';
            }
            $data['operator'] = $dataOperator;
        } else if ($user->level == 4) {
        }

        return view('dashboard', $data);
    }
}
