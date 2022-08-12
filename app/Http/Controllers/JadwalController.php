<?php

namespace App\Http\Controllers;

use App\Models\jadwal;
use App\Http\Requests\StorejadwalRequest;
use App\Http\Requests\UpdatejadwalRequest;
use App\Models\mesin;
use App\Models\proses_mesin;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

date_default_timezone_set('Asia/Jakarta');
class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = now()->format('Y-m-d');

        if (Auth::user()->level == 3) {
            $getjadwal = jadwal::where('user_id', Auth::user()->id)->where('tanggal', $date)->first();
            if ($getjadwal) {
                return redirect()->to('jadwal/' . $getjadwal->id);
            } else {
                return view('jadwal.index', [
                    'jadwalKosong' => true
                ]);
            }
        } else {
            return view('jadwal.index');
        }
    }

    public function dataAjax()
    {
        $date = now()->format('Y-m-d');
        if (Auth::user()->level == 3) {
            $jadwal = jadwal::where('user_id', Auth::user()->id)->where('tanggal', $date)->get();
        } else if (Auth::user()->level == 4) {
            $jadwal = jadwal::where('tanggal', '>=', $date)->get();
        }

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
                        <a href="' . url("jadwal/$row->id") . '" class="btn btn-info mr-2">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                        </a>
                        <a href="' . url("jadwal/$row->id/edit") . '" class="btn btn-warning mr-2">
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
        return view('jadwal.create', [
            'dataOperator' => User::where('level', 3)->get(),
            'dataMesin' => mesin::all(),
            'dataProses' => proses_mesin::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorejadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorejadwalRequest $request)
    {
        $validateData = $request->validate([
            'operator' => 'required',
            'mesin' => 'required',
            'proses_mesin' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
            'tanggal' => 'required'
        ]);

        $data = [
            'user_id' => $validateData['operator'],
            'mesin_id' => $validateData['mesin'],
            'mulai' => $validateData['mulai'],
            'proses' => json_encode($validateData['proses_mesin']),
            'selesai' => $validateData['selesai'],
            'tanggal' => $validateData['tanggal']
        ];

        jadwal::create($data);

        return redirect('/jadwal')->with('success', 'Create new jadwal success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(jadwal $jadwal)
    {
        return view('jadwal.detail', [
            'jadwal' => $jadwal,
            'dataProses' => proses_mesin::whereIn('id', json_decode($jadwal->proses))->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(jadwal $jadwal)
    {
        return view('jadwal.edit', [
            'dataOperator' => User::where('level', 3)->get(),
            'dataMesin' => mesin::all(),
            'dataProses' => proses_mesin::all(),
            'jadwal' => $jadwal
        ]);
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
        $validateData = $request->validate([
            'operator' => 'required',
            'mesin' => 'required',
            'proses_mesin' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        $data = [
            'user_id' => $validateData['operator'],
            'mesin_id' => $validateData['mesin'],
            'mulai' => $validateData['mulai'],
            'proses' => json_encode($validateData['proses_mesin']),
            'selesai' => $validateData['selesai']
        ];

        jadwal::where('id', $jadwal->id)->update($data);
        return redirect('/jadwal')->with('success', 'Update jadwal success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(jadwal $jadwal)
    {
        jadwal::destroy($jadwal->id);
        return 'Jadwal has been deleted';
    }
}
