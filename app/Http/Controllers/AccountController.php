<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Account;
use App\Enprinfo;
use App\Industry;
use App\Personinfo;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller {
    public function login() {
        return view('account/login');
    }

    public function register() {
        return view('account/register');
    }

    public function findPassword() {
        return view('account/findPassword');
    }

    public function index($userid = 111) {
        print $userid;
        return view('account/index', [
            'userid' => $userid,
        ]);
    }

    public function edit() {
        return view('account/edit');
    }
    public function enterpriseVerify_step1(){
        return view('enterpriseVerify/audit1');
    }

    //个人资料修改（新增）
    public function personinfoEdit(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        if ($data['uid'] == 0) {//用户未登陆
            return view('account.login', ['data' => $data]);
        }
        //上传头像;
        $pid = Personinfo::where('uid', $data['uid'])->first();
        $personinfo = Personinfo::find($pid['pid']);

        if ($request->hasFile('photo')) {
            //验证输入的图片格式,验证图片尺寸比例为一比一
//            $this->validate($request, [
//                'photo' => 'dimensions:ratio=1/1'
//            ]);
            $photo = $request->file('photo');
            if ($photo->isValid()) {//判断文件是否上传成功
                $originalName = $photo->getClientOriginalName();
                //扩展名
                $ext = $photo->getClientOriginalExtension();
                //mimetype
                $type = $photo->getClientMimeType();
                //临时觉得路径
                $realPath = $photo->getRealPath();

                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . 'photo' . '.' . $ext;

                $bool = Storage::disk('profile')->put($filename, file_get_contents($realPath));
                if ($bool) {
                    $personinfo->photo = asset('storage/profiles/' . $filename);
                }
            }
        }
        $personinfo->pname = $request->input('pname');
        $personinfo->birthday = $request->input('birthday');
        $personinfo->sex = $request->input('sex');
        $personinfo->work_year = $request->input('work_year');
        $personinfo->register_place = $request->input('register_place');
        $personinfo->residence = $request->input('residence');
        $personinfo->tel = $request->input('tel');
        $personinfo->mail = $request->input('mail');
        $personinfo->is_marry = $request->input('is_marry');
        $personinfo->political = $request->input('political');
        $personinfo->self_evalu = $request->input('self_evalu');
        $personinfo->education = $request->input('education');

        if ($personinfo->save()) {
            $user = Users::find($data['uid']);
            $user->username = $request->input('username');
            $user->save();
            $data['status'] = 200;
            $data['msg'] = "操作成功";
        } else {
            $data['status'] = 400;
            $data['msg'] = "操作失败";
        }

        return $data;
    }

    //企业资料修改，新增
    public function enprinfoEdit(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['type'] = AuthController::getType();
        if ($data['uid'] == 0) {//用户未登陆
            $data['status'] = 400;
            $data['msg'] = "请先登陆再进行操作";
            return $data;
        }
        if ($data['type'] != 2) {
            $data['status'] = 400;
            $data['msg'] = "用户非法，请登录企业号";
            return $data;
        }
        //上传头像;
        $eid = Enprinfo::where('uid', $data['uid'])->first();
        $enprinfo = Enprinfo::find($eid['eid']);

        if ($request->hasFile('elogo')) {
            //验证输入的图片格式,验证图片尺寸比例为一比一
//            $this->validate($request, [
//                'elogo' => 'dimensions:ratio=1/1'
//            ]);
            $elogo = $request->file('elogo');
            if ($elogo->isValid()) {//判断文件是否上传成功
                $originalName = $elogo->getClientOriginalName();
                //扩展名
                $ext = $elogo->getClientOriginalExtension();
                //mimetype
                $type = $elogo->getClientMimeType();
                //临时觉得路径
                $realPath = $elogo->getRealPath();

                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . 'elogo' . '.' . $ext;

                $bool = Storage::disk('profile')->put($filename, file_get_contents($realPath));
                if ($bool) {
//                    $enprinfo->elogo = $filename;
                    $enprinfo->elogo = asset('storage/profiles/' . $filename);
                }
            }
        }
        if($request->has('byname')) $enprinfo->byname = $request->input('byname');
        if($request->has('ename')) $enprinfo->ename = $request->input('ename');
        if($request->has('email')) $enprinfo->email = $request->input('email');
        if($request->has('etel')) $enprinfo->etel = $request->input('etel');
        if($request->has('ebrief')) $enprinfo->ebrief = $request->input('ebrief');
        if($request->has('escale')) $enprinfo->escale = $request->input('escale');
//        $enprinfo->enature = $request->input('enature');
//        $enprinfo->industry = $request->input('industry');
        if($request->has('home_page')) $enprinfo->home_page = $request->input('home_page');
        if($request->has('address')) $enprinfo->address = $request->input('address');


        if ($enprinfo->save()) {
            $data['status'] = 200;
            $data['msg'] = "操作成功";
        } else {
            $data['status'] = 400;
            $data['msg'] = "操作失败";
        }

        return $data;
    }
    //企业用户验证页面\返回对应企业信息
    //如果options 为upload，则上传证件照片到数据库
    //返回值为$data数组
    public function enterpriseVerifyView1(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $uid = $data['uid'];

        if ($uid == 0)
            return view("/account/login", ['data' => $data]);

        $type = AuthController::getType();

        if ($type != 2)
            return redirect()->back();

        $eid = Enprinfo::select('eid')
            ->where('uid', '=', $uid)
            ->first();
        if (!$eid->count())
            return redirect()->back();

//        $eid = $eid['eid'];
        $data['eid'] = $eid['eid'];

        $data['enterprise'] = Enprinfo::find($data['eid']);

        if ($data['enterprise']['is_verification'] != -1)
            return view('enterpriseVerify/auditFail', ['data' => $data]);

        //return $data;
        return view('enterpriseVerify/audit1', ['data' => $data]);
    }
    public function enterpriseVerifyView2(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $uid = $data['uid'];

        if ($uid == 0)
            return view("/account/login", ['data' => $data]);

        $type = AuthController::getType();

        if ($type != 2)
            return redirect()->back();

        $eid = Enprinfo::select('eid')
            ->where('uid', '=', $uid)
            ->first();
        if (!$eid->count())
            return redirect()->back();

//        $eid = $eid['eid'];
        $data['eid'] = $eid['eid'];

        $data['enterprise'] = Enprinfo::find($data['eid']);

        if ($data['enterprise']['is_verification'] != -1)
            return view('enterpriseVerify/auditFail', ['data' => $data]);

        $data['industry'] = Industry::select('id', 'name')->get();

        //return $data;
        return view('enterpriseVerify/audit2', ['data' => $data]);
    }

    //上传企业验证证件照片

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadVerinfo(Request $request) {
        $data = array();
        $uid = AuthController::getUid();
        $username = InfoController::getUsername();
        $eid = Enprinfo::where('uid', $uid)->first();
        if($eid['is_verification']==0||$eid['is_verification']==1){
            $data['status']=400;
            $data['msg']="用户已提交审核，无需重复提交";
            return $data;
        }
        if ($request->has('enature') && $request->has('industry')) {
            $enprinfo = Enprinfo::find($eid['eid']);

            if ($request->isMethod('POST')) {
                $ecertifi = $request->file('ecertifi');//取得上传文件信息
                $lcertifi = $request->file('lcertifi');//取得上传文件信息

                if ($ecertifi->isValid() && $lcertifi->isValid()) {//判断文件是否上传成功
                    //原文件名
                    //echo '文件上传成功';
                    $originalName1 = $ecertifi->getClientOriginalName();
                    $originalName2 = $lcertifi->getClientOriginalName();
                    //扩展名
                    $ext1 = $ecertifi->getClientOriginalExtension();
                    $ext2 = $lcertifi->getClientOriginalExtension();
                    //mimetype
                    $type1 = $ecertifi->getClientMimeType();
                    $type2 = $lcertifi->getClientMimeType();
                    //临时觉得路径
                    $realPath1 = $ecertifi->getRealPath();
                    $realPath2 = $lcertifi->getRealPath();

                    $filename1 = date('Y-m-d-H-i-s') . '-' . uniqid() . 'ecertifi' . '.' . $ext1;
                    $filename2 = date('Y-m-d-H-i-s') . '-' . uniqid() . 'lcertifi' . '.' . $ext2;

                    $bool1 = Storage::disk('authentication')->put($filename1, file_get_contents($realPath1));
                    $bool2 = Storage::disk('authentication')->put($filename2, file_get_contents($realPath2));
                    //var_dump($bool);
                    if ($bool1 && $bool2) {
                        //文件名保存到数据库中
                        $enprinfo->ecertifi = asset('storage/authentication/' . $filename1);
                        $enprinfo->lcertifi = asset('storage/authentication/' . $filename2);
                    }
//                    $enprinfo->ename = $request->input('ename');
                    $enprinfo->enature = $request->input('enature');
                    $enprinfo->industry = $request->input('industry');
                    $enprinfo->escale = $request->input('escale');
//                    $enprinfo->email = $request->input('email');
//                    $enprinfo->etel = $request->input('etel');
                    $enprinfo->address = $request->input('address');
                    $enprinfo->is_verification = 0;


                    if ($enprinfo->save()) {
                        $data['status'] = 200;
                        $data['msg'] = "上传成功";
                        return $data;
                        //return redirect('account/enterpriseVerify?eid='.$eid)->with('success', '上传证件成功');
                    } else {
                        $data['status'] = 400;
                        $data['msg'] = "上传失败";
                        return $data;
                        //return redirect('account/enterpriseVerify?eid='.$eid)->with('error', '上传证件失败');
                    }
                }
            }
        }
    }
}
