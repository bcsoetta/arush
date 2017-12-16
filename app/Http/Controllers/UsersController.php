<?php

namespace App\Http\Controllers;

use Alert;
use App\Role;
use App\User;
use App\Lokasi;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(Gate::denies('USERS'))
        // {
        //     Alert::error('Sorry');
        //     return back();
        // }

        $users = User::all();
        $no=1;
        return view('admin.users.index', compact('users', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(Gate::denies('USERS'))
        // {
        //     Alert::error('Sorry');
        //     return back();
        // }
        $roles = Role::all();
        $lokasi = Lokasi::all();
        return view('admin.users.create', compact('roles', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(Gate::denies('USERS'))
        // {
        //     Alert::error('Sorry');
        //     return back();
        // }
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:users',
            'user_name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nip' => $request->nip,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $roles = $request->input('role') ? $request->input('role') : [];

        foreach($roles as $role){
            $user->assignRole($role);
        }

        Alert::success('Berhasil');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::findOrFail(auth()->user()->id);

        dd($user->profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(Gate::denies('USERS'))
        // {
        //     Alert::error('Sorry');
        //     return back();
        // }
        $user = User::findOrFail($id);
        $roles = Role::all();
        $lokasi = Lokasi::all();
        return view('admin.users.edit', compact('user', 'roles', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if(Gate::denies('USERS'))
        // {
        //     Alert::error('Sorry');
        //     return back();
        // }
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'nip' => 'required|numeric',
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            // 'password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'nip' => $request->nip,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'lokasi_id' => $request->lokasi,
            // 'password' => bcrypt($request->password),
        ]);
        //males buat fungsi
        $user->roles()->detach();

        $roles = $request->input('role') ? $request->input('role') : [];

        foreach($roles as $role){
            $user->assignRole($role);
        }
        Alert::success('Berhasil diupdate');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(Gate::denies('USERS'))
        // {
        //     Alert::error('Sorry');
        //     return back();
        // }
        $user= User::findOrFail($id);
        $user->permissions()->detach();
        $user->delete();
        Alert::success('Berhasil dihapus');
        return redirect()->route('users.index');
    }
}
