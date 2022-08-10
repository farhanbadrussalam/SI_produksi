<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DataTables;
use App\Models\User;

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
                        <a href="' . url("dashboard/product/$user->id") . '" class="btn btn-info mr-2">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                        </a>
                        <a href="' . url("dashboard/product/$user->id/edit") . '" class="btn btn-warning mr-2">
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
}
