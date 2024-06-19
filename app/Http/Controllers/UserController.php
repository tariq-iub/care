<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return Datatables::of($data)
                ->addColumn('avatar', function($row){
                    return view('admin.users.partial.avatar', compact('row'));
                })
                ->addColumn('status', function ($row) {
                    return view('admin.users.partial.status', compact('row'));
                })
                ->addColumn('role', function ($row) {
                    return $row->role->title;
                })
                ->addColumn('action', function($row)
                {
                    return view('admin.users.partial.action', compact('row'));
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function profile()
    {

    }

    public function statusToggle(User $user)
    {
        if($user->status)
        {
            $user->status = false;
            $user->save();
        }
        else
        {
            $user->status = true;
            $user->save();
        }

        return redirect('/users');
    }
}
