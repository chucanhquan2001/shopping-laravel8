<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Login\LoginAdminRequest;

class AdminController extends Controller
{
    // thửu
    public function login()
    {
        return view('admin.login');
    }

    public function loginPost(LoginAdminRequest $request)
    {
        // xử lý login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1], $request->has('remember'))) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Thông tin đăng nhập không chính xác hoặc tài khoản của bạn đã bị khóa !');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login-admin')->with('error', 'Đăng xuất thành công !');
    }
}