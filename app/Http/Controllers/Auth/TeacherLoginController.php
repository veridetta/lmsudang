<?php

namespace App\Http\Controllers\Auth\Login;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function proses_login(Request $request)
    {
        request()->validate([
        'nip' => 'required',
        ]);

        $credentials = $request->only('nip');
        if (Auth::attempt($credentials)) {
            $user = Auth::teacher();
            return redirect()->intended('teacher/auth/login');
        }
        return redirect('login')->withSuccess('Oppes! Silahkan Cek Inputanmu');
    }
    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
