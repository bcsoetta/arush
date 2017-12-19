<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{

    public function __construct() {

        $this->middleware('auth');

    }


    public function show()
    {
        return view('users.change-password');
    }

    public function reset()
    {
        $user = User::select('id', 'name')->get();
        
        return view('users.reset-password', compact('user'));
    }

    public function storeReset(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
        ],[
            'user_name.required' => 'tidak boleh kosong',
        ]);

        $user = User::find($request->user_name);

        $user->fill([
                'password' => Hash::make('123456')
            ])->save();

        $request->session()->flash('success', $user->name .' '.'password has been changed');

        return back();
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|min:6|confirmed',
        ],[
            'old.required' => 'tidak boleh kosong',
            'password.required' => 'tidak boleh kosong',
        ]);

        $user = User::find(Auth::id());
        $hashedPassword = $user->password;

        if (Hash::check($request->old, $hashedPassword)) {
            //Change the password
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            $request->session()->flash('success', 'Your password has been changed.');

            return back();
        }

        $request->session()->flash('failure', 'Your password has not been changed.');

        return back();

    }
}
