<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\About;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;
use Auth;
use App\Admininfo;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Session;
use Hash;

class LoginController extends Controller
{
//    public function __construct() {
//        $this->middleware('guest')->except('logout','index');  //除了logout、index方法
//    }
    public function index() {
        $data = array();
        $data['uid'] = AdminAuthController::getUid();
        $data['username'] = $this->getUsername();
        return view('admin/login', ["data" => $data]);
    }
    public function postLogin(Request $request)
    {
        $data = array();
        $input = $request->all();
        $username = $input['username'];
        $password = $input['password'];
        $isexist = User::where('username', '=', $username)->where('type',3)
            ->get();
        if($isexist->count())
        {
            $res = User::where('username','=',$username)->first();
            if(Hash::check($password, $res->password))
            {
//                $uid = User::where('username','=',$username)->select('uid')->first()->uid;
                $uid = $res->uid;
                session()->put('backUid',$uid);
                $type =User::where('uid','=',$uid)
                    ->select('type')
                    ->get();
                $type = $type[0]['type'];
                session()->put('adminType',$type);
                $last_login = date('Y-m-d H-i-s',time());
                $affectedRows = Admininfo::where('uid',$uid)
                    ->update(['last_login'=>$last_login]);
                if($affectedRows)
                {
                    $data['status'] = 200;
                    $data['msg'] = '登录成功';
                }else{
                    $data['status'] = 400;
                    $data['msg'] = '数据库更新失败';
                }
            } else{
                $data['status'] = 400;
                $data['msg'] = '密码错误';
            }
        }else{
            $data['status'] = 400;
            $data['msg'] = '用户名不存在';
        }
        return $data;
    }
    //登出函数
    public function logout(){
        Auth::logout();
        Session::flush();   //清除所有缓存
        return redirect('admin/login');
    }
    //获取用户名
    public function getUsername() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return null;
        $user = User::where("uid", $uid)->get();
        return $user[0]->username;
    }
}
