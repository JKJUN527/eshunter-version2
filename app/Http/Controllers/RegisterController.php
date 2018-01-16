<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;


use App\Enprinfo;
use App\Personinfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();

        return view('account/register', ["data" => $data]);
    }

    /*注册验证逻辑*/
    public function postRegister (Request $request)
    {
        $data = array();
        $input = $request->all();
        if ($request->has('phone'))     //手机注册
        {
            //手机短信验证码匹配???
            $code = $request->input('code');
            $validator = Validator::make($input, [
                'phone' => 'required|regex:/^1[34578][0-9]{9}$/'
            ]);
            if ($validator->fails()) {
                $data['status'] = 400;
                $data['msg'] = "手机号格式输入错误";
                return $data;
            }
            if (ValidationController::verifySmsCode($input['phone'], $code)) {//验证码正确
                $user = new User();
                $user->tel = $input['phone'];
                $user->password = bcrypt($input['password']);
                $user->type = $input['type'];
                $user->username = substr($input['phone'], -4);
                $user->tel_vertify = 1;

                if ($user->save()) {
                    if ($input['type'] == 1) {//个人用户
                        $perinfo = new Personinfo();
                        $perinfo->uid = $user->uid;
                        $perinfo->register_way = 0;
                        $perinfo->save();
                        $data['type'] = $input['type'];

                    } else if ($input['type'] == 2) {//企业用户
                        $enprinfo = new Enprinfo();
                        $enprinfo->uid = $user->uid;
                        $enprinfo->save();
                        $data['type'] = $input['type'];
                    }
                    $data['status'] = 200;
                    $data['msg'] = "注册成功！";
                    return $data;
                }

                $data['status'] = 400;
                $data['msg'] = "数据库插入错误！";
                return $data;
            } else {
                $data['status'] = 400;
                $data['msg'] = "验证码错误";
                return $data;
            }

        } else if ($request->has('email'))     //邮箱注册
        {
            //邮箱验证码匹配???
            $validator = Validator::make($input, [
                'email' => 'required|string|email'
            ]);
            if ($validator->fails()) {
                $data['status'] = 400;
                $data['msg'] = "邮箱信息格式有误";
                return $data;
            }else{
                //检查该邮箱是否已经被注册
                $isexist = User::where('mail','=',$input['email'])->get();
                if($isexist->count()) {
                    if ($isexist[0]->email_vertify == 1){//已注册{
                        $data['status'] = 400;
                        $data['msg'] = "该用户已注册！请直接登录";
                        return $data;
                     }
                  //邮箱已发送过验证码，重新发送验证码
                    $mailAgain = ValidationController::sendemail($input['email'],$isexist[0]->uid);
                    if($mailAgain == -1){
                        $data['status'] = 400;
                        $data['msg'] ="验证邮件发送失败！";
                        return $data;
                    }
                    $data['status'] = 200;
                    $data['msg'] ="验证邮件发送成功！";
                    return $data;
                }
                $username = explode('@',$input['email']);
                $user = new User();
                $user->mail = $input['email'];
                $user->password = bcrypt($input['password']);
                $user->type = $input['type'];
                $user->username = $username[0];

                $type = $input['type'];
                if ($user->save()) {
                    if ($input['type'] == 1) {//个人用户
                        $perinfo = new Personinfo();
                        $perinfo->uid = $user->uid;
                        $perinfo->register_way = 1;
                        $perinfo->save();

                    } else if ($input['type'] == 2) {//企业用户
                        $enprinfo = new Enprinfo();
                        $enprinfo->uid = $user->uid;
                        $enprinfo->save();
                    }
                    //发送验证邮件
                    $mailstatus = ValidationController::sendemail($input['email'],$user->uid);
                    if($mailstatus ==-1){
                        $data['status'] = 400;
                        $data['msg'] ="验证邮件发送失败！";
                        return $data;
                    }
                    $data['status'] = 200;
                    $data['msg'] ="注册成功";
                    return $data;
                } else {
                    $data['status'] = 400;
                    $data['msg'] ="数据库插入错误!";
                    return $data;
                }
            }

        }
    }
}
