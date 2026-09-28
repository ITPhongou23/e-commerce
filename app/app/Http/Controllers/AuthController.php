<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showregister(){
        return view('auth.register');
    }

    public function showlogin(){
        return view('auth.login');
    }

    public function get_user(){
        $user = auth()->user();
        return response()->json($user);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $User = User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with(
            'success','Register successfully! Please login.'
        );
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required',
        ]);

        $user = User::where('name',$credentials->name)->first();

        if (!$user) {
            return back()->withErrors([
                'error' => 'Tài khoản không tồn tại.',
            ])->withInput();
        }

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Mật khẩu không đúng.',
        ])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');

    }
}