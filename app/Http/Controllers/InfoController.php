<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/6
 * Time: 19:45
 */

namespace App\Http\Controllers;

use App\Enprinfo;
use App\Industry;
use App\Personinfo;
use App\User;
use Illuminate\Http\Request;

class InfoController extends Controller {

    //个人、企业基本信息修改、新增页面
    public function index(){
        $data = array();

        $uid = AuthController::getUid();
        $username = InfoController::getUsername();
        $type = AuthController::getType();
        $data['username'] = $username;
        $data['type'] = $type;
        $data['uid'] = $uid;
        if($uid == 0){
            return  redirect('index');
        }
        if($type == 1){
            //返回个人资料修改界面的个人信息资料
            $data['personinfo'] = Personinfo::where('uid','=',$uid)->first();
            $data['personinfo']['username'] = User::where('uid',$uid)->select('username')->first();
            //return $data;
        }else if($type == 2){
            //返回企业修改基本资料的企业信息资料
            $data['enprinfo'] = Enprinfo::where('uid',$uid)->first();
            $data['industry'] = Industry::all();
        }
//        return $data;
        return view('account.edit',[
//            'username'=>$username,
//            'uid'=>$uid,
//            'type'=>$type,
            'data'=>$data
        ]);

    }
    public static function getUsername() {
        $data = array();
        $uid = AuthController::getUid();
        if ($uid == 0)
            return null;

        $user = User::where("uid", $uid)->first();
        $personCenter = new PersonCenterController();
        if($user->type==1){
//            $photo = Personinfo::where('uid',$uid)->select('photo')->first();
//            $data['photo']=$photo->photo;

            //获取未读消息个数
            $data['messageNum'] = $personCenter->getMessageNum();
            //投递职位个数
            $data['deliveredNum'] = $personCenter->getDeliveredNum();
        }elseif ($user->type==2){
//            $photo = Enprinfo::where('uid',$uid)->select('elogo')->first();
//            $data['photo']=$photo->elogo;

            //获取未读消息个数
            $data['messageNum'] = $personCenter->getMessageNum();
        }
        $data['username']=$user->username;

        return $data;
    }

    public function getPersonInfo() {
        $auth = new AuthController();
        $uid = $auth->getUid();
        if($uid == 0){
            return redirect('index');
        }
        $type = $auth->getType();
        if ($uid && $type == 1) {
            $personInfo = Personinfo::where('uid', '=', $uid)
                ->get();
            return $personInfo;
        }

        return null;
    }

    public function getEnprInfo() {
        $auth = new AuthController();
        $uid = $auth->getUid();
        $type = $auth->getType();
        if($uid == 0){
            return redirect('index');
        }
        if ($uid && $type == 2) {
            $enprInfo = Enprinfo::where('uid', '=', $uid)
                ->first();
            return $enprInfo;
        }
        return null;
    }

    public function editPersonInfo(Request $request) {
        $data = array();
        //验证前台是否有传值 这个地方还没做
        $input = $request->all();
        $auth = new AuthController();
        $uid = $auth->getUid();
        $type = $auth->getType();
        if ($uid != 0 && $type == 1)   //确认为合法个人用户
        {
            $pid = PersonInfo::where('uid', '=', $uid)
                ->select('pid')
                ->get();
            //如果存在pid则为修改信息执行更新操作，反之则为新增执行插入操作
            if ($pid != '[]')                //更改信息$pid->isEmpty();
            {
                $pid = $pid[0]['pid'];
                $personInfo = PersonInfo::find($pid);
                $personInfo->pname = $input['pname'];
                //photo没有完成上传 之后完成
                $personInfo->birthday = $input['birthday'];
                $personInfo->sex = $input['sex'];
                $personInfo->register_way = $input['register_way'];
                $personInfo->work_year = $input['work_year'];
                $personInfo->register_place = $input['register_place'];
                $personInfo->residence = $input['residence'];
                $personInfo->tel = $input['tel'];
                $personInfo->mail = $input['mail'];
                $personInfo->is_marry = $input['is_marry'];
                $personInfo->political = $input['political'];
                $personInfo->self_evalu = $input['self_evalu'];
                $personInfo->education = $input['education'];
                if ($personInfo->save()) {
                    $data["status"] = 200;
                } else {
                    $data["status"] = 400;
                    $data["msg"] = "信息修改失败";
                }
                return view("account.edit", ["data" => $data]);
            } else {                  //新增信息
                $personInfo = new PersonInfo();
                $personInfo->uid = $uid;
                $personInfo->pname = $input['pname'];
                //photo没有完成上传 之后完成
                $personInfo->birthday = $input['birthday'];
                $personInfo->sex = $input['sex'];
                $personInfo->register_way = $input['register_way'];
                $personInfo->work_year = $input['work_year'];
                $personInfo->register_place = $input['register_place'];
                $personInfo->residence = $input['residence'];
                $personInfo->tel = $input['tel'];
                $personInfo->is_marry = $input['is_marry'];
                $personInfo->political = $input['political'];
                $personInfo->self_evalu = $input['self_evalu'];
                $personInfo->education = $input['education'];
                if ($personInfo->save()) {
                    return redirect('account/getPersonInfo')->with('success', '个人信息添加成功');
                } else {
                    return redirect('account/getPersonInfo')->with('error', '个人信息添加失败');
                }
            }
        }

    }

    public function editEnprInfo(Request $request) {
        //todo 上传照片还没有做
        $input = $request->all();
        $auth = new AuthController();
        $uid = $auth->getUid();
        $type = $auth->getType();
        if ($uid && $type == 2)   //确认为合法企业用户
        {
            $eid = Enprinfo::where('uid', '=', $uid)
                ->select('eid')
                ->get();
            //如果存在pid则为修改信息执行更新操作，反之则为新增执行插入操作
            if ($eid != '[]')                //更改信息
            {
                $eid = $eid[0]['eid'];
                $enprInfo = Enprinfo::find($eid);    //根据主键进行查询
                $enprInfo->ename = $input['ename'];
                $enprInfo->email = $input['email'];
                $enprInfo->etel = $input['etel'];
                $enprInfo->ebrief = $input['ebrief'];
                $enprInfo->escale = $input['escale'];
                $enprInfo->enature = $input['enature'];
                $enprInfo->industry = $input['industry'];
                $enprInfo->home_page = $input['home_page'];
                $enprInfo->address = $input['address'];
                $enprInfo->ecertifi = $input['ecertifi'];
                $enprInfo->lcertifi = $input['lcertifi'];
                $enprInfo->is_verification = $input['is_verification'];
                if ($enprInfo->save()) {
                    return redirect('account/getEnprInfo')->with('success', '企业信息修改成功');
                } else {
                    return redirect('account/getEnprInfo')->with('error', '企业信息修改失败');
                }
            } else {
                $enprInfo = new Enprinfo();
                $enprInfo->uid = $uid;
                $enprInfo->ename = $input['ename'];
                $enprInfo->email = $input['email'];
                $enprInfo->etel = $input['etel'];
                $enprInfo->ebrief = $input['ebrief'];
                $enprInfo->escale = $input['escale'];
                $enprInfo->enature = $input['enature'];
                $enprInfo->industry = $input['industry'];
                $enprInfo->home_page = $input['home_page'];
                $enprInfo->address = $input['address'];
                $enprInfo->ecertifi = $input['ecertifi'];
                $enprInfo->lcertifi = $input['lcertifi'];
                $enprInfo->is_verification = $input['is_verification'];
                if ($enprInfo->save()) {
                    return redirect('account/getEnprInfo')->with('success', '企业信息添加成功');
                } else {
                    return redirect('account/getEnprInfo')->with('error', '企业信息添加失败');
                }
            }
        }
    }
}
