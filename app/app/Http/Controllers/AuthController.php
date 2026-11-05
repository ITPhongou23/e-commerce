<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showregister()
    {
        return view('auth.register');
    }

    public function showlogin()
    {
        return view('auth.login');
    }

    public function get_user()
    {
        $user = auth()->user();

        return response()->json($user);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with(
            'success', 'Register successfully! Please login.'
        );
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required',
        ]);

        $user = User::where('name', $credentials['name'])->first();

        if (! $user) {
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');

    }

    // Test API
    public function api_login(Request $request){
        $data = $request->validate([
            'name'     => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('name', $data['name'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Sai tên đăng nhập hoặc mật khẩu.',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'token'   => $user->createToken('web')->plainTextToken,
            'user'    => $user,
        ]);
    }
}
