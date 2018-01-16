<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use APP\Tempemail;
use App\User;
use Illuminate\Http\Request;

class ForgetPwController extends Controller {
    public function view() {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();

        return view('account/findPassword', ["data" => $data]);
    }

    public function index(Request $request, $option) {
        //option 0:重置第一步发送验证码 1：验证验证码 2：重置密码
        $data = array();
        switch ($option) {
            case '0'://发送验证码
                if ($request->has('tel')) {//手机重置逻辑
                    $tel = $request->input('tel');
                    $uid = User::where('tel', '=', $tel)->first();
                    $data = ValidationController::regSMS($request,$tel, 1);
                    $data['uid'] = $uid['uid'];
                    return $data;
                } else if ($request->has('email')) {
                    $mail = $request->input('email');
                    $uid = User::where('mail', '=', $mail)->get();
                    $temp = ValidationController::sendForgetMail($mail, $uid[0]['uid']);
                    if ($temp == -1) {
                        $data['status'] = 400;
                        $data['msg'] = "邮箱验证码发送失败";
                        return $data;
                    }
                    $data['uid'] = $uid[0]['uid'];
                    $data['status'] = 200;
                    $data['msg'] = "邮箱验证码发送成功";
                    return $data;
                }
                $data['status'] = 400;
                $data['msg'] = "发送失败";
                return $data;
                break;
            case '1'://验证验证码
                if ($request->has('tel') && $request->has('code')) {
                    $tel = $request->input('tel');
                    $code = $request->input('code');
                    if (ValidationController::verifySmsCode($tel, $code)) {//验证码正确
                        $data['status'] = 200;
                        $data['msg'] = "手机验证码正确";
                        return $data;
                    } else {
                        $data['status'] = 400;
                        $data['msg'] = "手机验证码错误";
                        return $data;
                    }
                } else if ($request->has('email') && $request->has('code')) {
                    $mail = $request->input('email');
                    $code = $request->input('code');
//                    $uid = Users::where('mail', '=', $mail)->get();
                    $uid = $request->input('uid');
                    //验证邮箱验证码是否正确
                    $num = Tempemail::where('uid', '=', $uid)
                        ->where('type', '=', 1)
                        ->where('code', '=', $code)
                        ->where('deadline', '>=', date('Y-m-d H-i-s'))
                        ->count();
                    $data['uid'] = $uid;
                    if ($num) {
                        $data['status'] = 200;
                        $data['msg'] = "邮箱验证码正确";
                        return $data;
                    } else {
                        $data['status'] = 400;
                        $data['msg'] = "邮箱验证码错误";
                        return $data;
                    }
                }
                $data['status'] = 400;
                $data['msg'] = "验证失败";
                return $data;
            case '2'://重置密码
                if ($request->has('password')) {
                    $password = $request->input('password');

                    // todo 这里的uid，前台无法获取，需要后台根据：phone或者email进行查询获取，而且不是在这一步做，而是在发验证码之前就做。
                    $uid = $request->input('uid');
                    $temp = FixPasswordController::forgotPasswordReset($uid, $password);
                    if ($temp) {
                        $data['status'] = 200;
                        $data['msg'] = "重置密码成功";
                        return $data;
                    }
                }
                $data['status'] = 400;
                $data['msg'] = "重置密码失败";
                return $data;
            default:
                $data['status'] = 400;
                $data['msg'] = "未知操作";
                return $data;
        }

    }
}
