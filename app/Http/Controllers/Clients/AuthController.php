<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Login\LoginAdminRequest;
use App\Http\Requests\Auths\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    public function loginClient()
    {
        // in danh mục ra menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();
        return view('frontend.auths.login_client', compact('categories'));
    }

    public function loginClientPost(LoginAdminRequest $request)
    {
        // xử lý login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1], $request->has('remember'))) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('error', 'Thông tin đăng nhập sai hoặc tài khoản của bạn đã bị khóa !');
        }
    }

    public function registerClient()
    {
        // in danh mục ra menu
        $categories = Category::where([
            ['status', '=', config('common.status.pulish')],
            ['parent_id', '=', 0]
        ])->take(4)->get();
        return view('frontend.auths.register_client', compact('categories'));
    }
    public function registerClientPost(RegisterRequest $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'active' => config('common.active.active')
            ]);
            $user->getRoles()->attach(config('common.role.guest'));
            DB::commit();
            return redirect()->route('login.client')->with('error', 'Đăng kí thành công vui lòng đăng nhập tài khoản !');
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.client')->with('error', 'Đăng xuất thành công !');
    }
}