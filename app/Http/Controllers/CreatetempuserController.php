<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\About;
use App\Enprinfo;
use App\User;

class CreatetempuserController extends Controller
{
    public function index ()
    {
        $data = array();
        $data['uid'] = AuthController::getUid();
//        $data['username'] = InfoController::getUsername();
//        $data['type'] = AuthController::getType();
        $data['tempuser']=array();
        if($data['uid']==22){//只有开发者的账号可以临时创建企业账号
            $i=10;
            for($i;$i<=20;$i++){
                $tempuser = new User();
                $tempuser->username = 'tempUser';
                $tempuser->mail = 'tempUser'.$i.'@qq.com';
                $tempuser->password = '$2y$10$iAOFL/wsEq2OrcrrHOWTSufRxG6/fF79pJE22xRDuZ1TK2y8JIxOS';//123456
                $tempuser->type = 2;
                $tempuser->email_vertify = 1;
                if($tempuser->save()){
                    $data['tempuser'][]=$tempuser;
                    $enprinfo = new Enprinfo();
                    $enprinfo->uid=$tempuser->uid;
                    $enprinfo->enature=0;
                    $enprinfo->is_verification=1;
                    $enprinfo->save();
                }
            }
        }
        return $data;
    }
}
