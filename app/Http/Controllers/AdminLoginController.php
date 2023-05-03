<?php

namespace App\Http\Controllers;

use App\Models\UserAvatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
{
    private $user_avatar;
    public function __construct(UserAvatar $user_avatar)
    {   
        $this->user_avatar = $user_avatar;
    }
    public function login () {
        // dd(bcrypt('minhman'));
        if(auth()->check()){
            return redirect()->route('backend.dashboard');
        }
        return view('backend.login');
       
    }
    public function PostLogin ( Request $request ) {
        $remember = $request->has('remember_me') ? true : false;
        if(auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)){
            $users = Auth::user();
            $avartar = $this->user_avatar->where('user_id', $users->id)->first();
            Session::put('avartar', $avartar);
            return redirect()->route('backend.dashboard');
        }else{
            return redirect()->route('admin.login')->with('message' , 'Nhập sai mật khẩu hoặc tài khoản');
        }
    }
    public function logout () {
        auth()->logout();
        Session::pull('avartar');
        return redirect()->route('admin.login');
    }
}
