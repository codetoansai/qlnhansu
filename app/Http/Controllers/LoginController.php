<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function getIndex()
    {
        if(Auth::check()){
            return redirect()->route('danh-sach-phong');
        }
        else{
            return view('admin.login');
        }
    }

    public function postLogin(LoginRequest $req)
    {
        $login=[
          'name'=>$req->txtname,
          'password'=>$req->txtpass
        ];
            if (Auth::attempt($login)) {
                return redirect()->route('danh-sach-phong');
            }
            else{
                return redirect()->back()->with(['error'=>'Tài khoản không tồn tại']);
            }
    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
