<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    } 
    public function user_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withError('Login details are not valid');
    }
    public function update_password()
    {
        // $request->validate([
        //     'password' => 'required',
        // ]);
   
        User::find(1)->update(['password'=> Hash::make('123456')]);
   
        dd('Password change successfully.');
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
}
