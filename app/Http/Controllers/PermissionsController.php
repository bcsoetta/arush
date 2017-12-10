<?php

namespace App\Http\Controllers;

use Alert;
use App\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $no = 1;
        return view('admin.permissions.index', compact('permissions', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:4|unique:permissions',
            'label' => 'required|min:4'
        ]);

        $Permission = new Permission;
        $Permission->name = $request->name;
        $Permission->label = $request->label;
        $Permission->save();

        Alert::success('Berhasil disimpan');

        return redirect()->route('permissions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
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
        $this->validate($request,[
            'name' => 'required|min:4',
            'label' => 'required|min:4'
        ]);

        $Permission = Permission::findOrFail($id);
        $Permission->name = $request->name;
        $Permission->label = $request->label;
        $Permission->save();

        Alert::success('Berhasil Update');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission= Permission::findOrFail($id);
        $permission->delete();
        Alert::success('Berhasil dihapus');
        return redirect()->route('permissions.index');
    }
}
