<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use APP\Models\E3Email;
use App\Tempemail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

require (app_path() . '/lib/BmobSms.class.php');
require (app_path() . '/Models/E3Email.php');

class ValidationController extends Controller
{
    public static function regSMS(Request $request, $telnum = "", $option = 0) {//$option 0:注册验证1:重置验证
        $data = array();
        if($request->has('telnum') || $telnum !=""){
            if($telnum ==""){
                $mytel['phone'] = $request->input('telnum');
            }else{
                $mytel['phone'] = $telnum;
            }
            $validatorTel = Validator::make($mytel, [
                'phone' => 'required|regex:/^1[34578][0-9]{9}$/',
            ]);
            if(!($validatorTel->fails())){
                //查询该手机是否已经被注册过
                if(!$option) {
                    $isexist = User::where('tel', '=', $mytel['phone'])->get();
                    if ($isexist->count()) {
                        $data['status'] = 400;
                        $data['msg'] = "该用户已注册！请直接登录";
                        return $data;
                    }
                }
                if (ValidationController::sendSMS($mytel['phone'])) {
                    $data['status'] = 200;
                    $data['msg'] = "验证码发送成功";
                    return $data;
                }
                $data['status'] = 400;
                $data['msg'] = "验证码发送失败！";
                return $data;
            }
            $data['status'] = 400;
            $data['msg'] = "手机号格式不正确！";
            return $data;
        }
        $data['status'] = 400;
        $data['msg'] = "手机号为空！";
        return $data;
    }
    public static function sendSMS ($phone)
    {
            $bmobSms = new \BmobSms();
            $res = $bmobSms->sendSmsVerifyCode($phone, "电竞猎人");
            //var_dump($res);
            if($res){
                return 1;
            }
        return 0;
    }
    public static function verifySmsCode($phone,$code)
    {
        //验证短信验证码是否正确
        $bmobSms = new \BmobSms();
        $res = $bmobSms->verifySmsCode($phone, $code);
         if($res){
             return 1;
         }
        return 0;
    }

    /**
     * @param Request $request
     * @return string
     */
    //返回0表示邮件已经发送过并在有效期内
    //返回1表示邮件发送成功
    //返回-1表示邮件发送失败
    public static function sendemail($mail="",$uid="")
    {
        if($mail != "" && $uid != "") {
            $res = Tempemail::where('uid', '=', $uid)
                ->where('type','=',0)
                ->get();
            if ($res->count()) {
                //return $res[0]->deadline;
                if ($res[0]->deadline >= date('Y-m-d H-i-s')) {
                    return 0;
                }
            }
            $ecode = ValidationController::generate_rand(32);
            //保存已发送的邮箱验证码
            //还未考虑同一用户重复多次发送邮件验证，或已经失效后重新发送邮件。
            if ($res->count()) {
                $num = Tempemail::where('uid','=',$uid)
                    ->update([
                        'code'=>$ecode,
                        'deadline'=>date('Y-m-d H:i:s', strtotime('+7 day')),
                    ]);
                return 1;
            }
            $temp = new Tempemail();
            $temp->code = $ecode;
            $temp->uid = $uid;
            $temp->type = 0;
            $temp->deadline = date('Y-m-d H:i:s', strtotime('+7 day'));

            if($temp->save()) {
                $e3_email = new E3Email();
                $e3_email->from = "404138362@qq.com";
                $e3_email->to = $mail;
                $e3_email->subject = "电竞招聘邮箱验证";
                $e3_email->content = "请于一周内点击该链接，完成验证。http://www.eshunter.com/validate_email"
                    . "?uid=" . $uid
                    . '&code=' . $ecode
                    . '&type=0'
                    . '如非本人操作请忽略此邮件。';
                //发送纯文本邮件
                Mail::raw($e3_email->content, function ($message) use ($e3_email) {
                    $message->from($e3_email->from, '电竞招聘官网');
                    $message->subject($e3_email->subject);
                    $message->to($e3_email->to);
                });

                return 1;
            }
        }
        return -1;
    }
    //验证邮箱链接
    public function verifyEmailCode(Request $request) {
        if($request->has('uid') && $request->has('code') && $request->has('type')){
            $uid = $request->input('uid');
            $code = $request->input('code');
            $type = $request->input('type');

            $num = Tempemail::where('uid','=',$uid)
                ->where('type','=',$type)
                ->where('code','=',$code)
                ->where('deadline','>=',date('Y-m-d H-i-s'))
                ->count();

            if($num){
                if($type ==0) {
                    //修改邮箱验证为已邮箱验证
                    $user = User::find($uid);
                    $user->email_vertify = 1;
                    $user->save();

                    $data = array();
                    $data["status"] = 200;
                    $data["user"] = $user;

                    //return $data;
                    return view("account.emailVerify", ["data" => $data]);
//                    echo "<script> alert('邮箱验证成功！')</script>>";
//                    return redirect('index');
                }else{
                    return 1;//忘记密码部分，邮件验证成功.
                }
            }
            if($type ==0) {
//                echo "<script> alert('邮件已过期！')</script>>";
//                return redirect('index');
                $data["status"] = 400;
                $data["msg"] = "对不起，你的邮件已过期";
                return view("account.emailVerify", ["data" => $data]);
            }else{
                return 0;//忘记密码部分，邮件验证失败.
            }
        }
        return redirect('index');
    }
    //忘记密码逻辑,发送邮箱验证码
    public static function sendForgetMail($mail, $uid) {
        if($mail != "" && $uid != "") {
            $res = Tempemail::where('uid', '=', $uid)
                ->where('type','=',1)
                ->count();
            if ($res) {
                $update_temp = Tempemail::where('uid', '=', $uid)
                    ->where('type','=',1)
                    ->first();
                if ($update_temp->deadline >= date('Y-m-d H-i-s')) {
                    return 1;
                }
            }
            $ecode = ValidationController::generate_rand(4);
            $e3_email = new E3Email();
            $e3_email->from = "404138362@qq.com";
            $e3_email->to = $mail;
            $e3_email->subject = "电竞招聘邮箱验证";
            $e3_email->content = "你的重置密码验证码为"
                . '&code=' . $ecode
                . '如非本人操作请忽略此邮件。';
            //发送纯文本邮件
            Mail::raw($e3_email->content, function ($message) use ($e3_email) {
                $message->from($e3_email->from, '电竞招聘官网');
                $message->subject($e3_email->subject);
                $message->to($e3_email->to);
            });
            //保存已发送的邮箱验证码
            //还未考虑同一用户重复多次发送邮件验证，或已经失效后重新发送邮件。
            if ($res) {
                $update_temp = Tempemail::where('uid', '=', $uid)
                    ->where('type','=',1)
                    ->update([
                        'code'=>$ecode,
                        'deadline'=>date('Y-m-d H:i:s', strtotime('+1 day'))
                    ]);
                return 1;
            }
            $temp = new Tempemail();
            $temp->code = $ecode;
            $temp->uid = $uid;
            $temp->type = 1;
            $temp->deadline = date('Y-m-d H:i:s', strtotime('+1 day'));
            $temp->save();

            return 1;
        }
        return -1;
    }
    //生成num位随机验证码
    public static function generate_rand($num) {
        $c= "abcdefghijklmnopqrstuvwxyz0123456789";
        $rand = '';
        srand((double)microtime()*1000000);
        for ($i=0; $i<$num; $i++) {
            $rand .= $c[rand() % strlen($c)];
        }
        $restr = $rand;
        return $restr;
    }
}
