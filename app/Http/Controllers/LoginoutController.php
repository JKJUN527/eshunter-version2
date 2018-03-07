<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginoutController extends Controller
{
    //登出函数
    public function logout() {
        Auth::logout();
        Session::flush();   //清除所有缓存
        // return 123;
        return redirect('index');
    }
    //切换角色
    public function checkout() {
        Auth::logout();
        Session::flush();   //清除所有缓存
        // return 123;
        return redirect('/account/login');
    }
}
