<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/8/16
 * Time: 22:40
 */
namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Session\Session;

class Account
{
    public function handel($request,Closure $next)
    {
        if(!Session::get('loginuid')){
            echo "123";
            return view("account.login");
        }
        return $next($request);
    }
}