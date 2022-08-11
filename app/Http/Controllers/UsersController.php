<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use DataTables;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

date_default_timezone_set('Asia/Jakarta');

class UsersController extends Controller
{
    public function index()
    {
        return view('users/index');
    }

    public function dataAjax()
    {
        $users = User::all();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('level', function ($user) {
                $level = '';
                switch ($user->level) {
                    case '1':
                        $level = 'Manager';
                        break;
                    case '2':
                        $level = 'Admin produksi';
                        break;
                    case '3':
                        $level = 'Operator';
                        break;
                    case '4':
                        $level = 'PPIC';
                        break;
                }
                return $level;
            })
            ->addColumn('action', function ($user) {
                return '
                    <div class="d-flex justify-content-center w-100">
                        <a href="' . url("users/$user->id") . '" class="btn btn-info mr-2">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                        </a>
                        <a href="' . url("users/$user->id/edit") . '" class="btn btn-warning mr-2">
                            <i class="fas fa-edit" aria-hidden="true"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="deleteThis(' . $user->id . ')" class="btn btn-danger">
                            <i class="fas fa-trash" aria-hidden="true"></i>
                        </a>
                    </div>
                ';
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'email_verified_at' => $request->email_verified_at,
            'level' => $request->level,
            'password' => Hash::make($request->password),
            // 'remember_token' => $request->remember_token,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/users')->with('success', 'Data Berhasil Disimpan');

    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;
        $user->password = Hash::make($request->password);
        $user->updated_at = date('Y-m-d H:i:s');

        $user->save();

        return redirect('/users')->with('success', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $users = User::find($id);

        $users->delete();

        return redirect('/users')->with('success', 'Data Berhasil Dihapus');
    }
}
