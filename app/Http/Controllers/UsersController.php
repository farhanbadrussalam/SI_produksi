<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreuserRequest;
use App\Http\Requests\UpdateuserRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index');
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
     * @param  \App\Http\Requests\StoreuserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreuserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/users')->with('success', 'Create new User success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserRequest $request, User $user)
    {
        User::where('id', $user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/users')->with('success', 'Update User success');
    }

    public function destroy(User $user)
    {
        User::destroy($user->id);
        return 'User has been deleted';
    }
}
