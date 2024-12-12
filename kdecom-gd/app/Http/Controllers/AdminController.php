<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function login(Request $request){
    if(auth()->check()){
        return redirect('home');
    }
        return view('login');
    }
    public function postlogin(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email', // Kiểm tra trường email
            'password' => 'required|min:6', // Kiểm tra trường password
        ]);

        $remember = $request->has('remember') ? true : false;

        // Thực hiện xác thực người dùng
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            return redirect()->to('home');
        }

        // Nếu xác thực không thành công, trả về thông báo lỗi
        return redirect()->back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ])->withInput();
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin');
    }
}
