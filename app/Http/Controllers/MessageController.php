<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Enprinfo;
use App\Message;
use App\Personinfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller {
    //站内信主页，需返回数据站内信详情、及发送人信息（id、pic）

    public function index(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $uid = $data['uid'];

        if ($uid == 0) {
            return view('account.login',['data'=>$data]);
        }

        $data['listMessages'] = array();

        $temp = array();//保存temp['from'];

        $temp1 = Message::whereRaw('to_id =? and is_delete =?', [$uid, 0])//别人发给我的消息
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($temp1 as $item) {
            $id = $item['attributes']['from_id'];
            //echo "from".$id."<br>";
            if (in_array($id, $temp)) {
                continue;
            } else {
                $temp[] = $id;
                $data['listMessages'][] = $item;
            }
        }
        $temp2 = Message::whereRaw('from_id =? and is_delete =?', [$uid, 0])//我发给别人的消息
        ->orderBy('created_at', 'desc')
            ->get();
        foreach ($temp2 as $item) {

            $id = $item['attributes']['to_id'];
            //echo "to".$id."<br>";
            if (in_array($id, $temp)) {
                continue;
            } else {
                $temp[] = $id;
                $data['listMessages'][] = $item;
            }
        }
        //将自己的id加入temp数组查询用户名及头像
        $temp[] = $data['uid'];
        foreach ($temp as $item) {
            $type = User::find($item);
            if($type['type']==1) {
                $data['user'][$item] = DB::table('jobs_users')
                    ->leftjoin('jobs_personinfo','jobs_users.uid','jobs_personinfo.uid')
                    ->select('username','photo')
                    ->where('jobs_users.uid', '=', $item)
                    ->first();
            }elseif ($type['type']==2){
                $data['user'][$item] = Enprinfo::select('ename','elogo')
                    ->where('uid', '=', $item)
                    ->first();
            }elseif ($type['type']==3){
                $data['user'][$item]['username'] = "系统消息";
                $data['user'][$item] = (object)$data['user'][$item];
            }
        }

//        return $data;
        return view('message.index', ['data' => $data]);
        //dd(response()->json($list));//转换为json数据格式报错
//        }

    }

    //根据用户id，判断用户类型，并返回用户基本信息
    public function getUserInfo($uid = 0) {
        if($uid){
            $type = User::where('uid', '=', $uid)
                ->get();
            //var_dump($type);
            //var_dump($type[0]['attributes']['type']);
            //var_dump($type['attributes']['type']);
            $data = null;
            if ($type[0]['attributes']['type'] == 1) {//普通用户
                $data = DB::table('jobs_personinfo')
                    ->leftjoin('jobs_users','jobs_users.uid','jobs_personinfo.uid')
                    ->where('jobs_personinfo.uid', '=', $uid)
                    ->select('jobs_personinfo.uid','photo','username')
                    ->first();
            } else if ($type[0]['attributes']['type'] == 2) {//企业用户
                $data = Enprinfo::where('uid', '=', $uid)
                    ->select('uid','elogo','ename')
                    ->first();
            } else if ($type[0]['attributes']['type'] == 3) {//管理员
                $data = 'admin';//管理员头像可以用一个固定图片替代
            }
        }
        return $data;
    }

    //发送站内信，传入to_id(原对话from_id)|message,数组形式
    public static function sendMessage(Request $request,$toid='',$content='') {
        $from_id = AuthController::getUid();
        if ($from_id == 0) {
            return view('account.login');
        }
        if($request->has('to_id') && $request->has('content')){
            $to_id = $request->input('to_id');
            $sendcontent = $request->input('content');
        }else if($toid != "" && $content != ""){
            $to_id = $toid;
            $sendcontent = $content;
        }else{
            $data['status'] = 400;
            $data['msg'] = $content;
//            $data['msg'] = "发送回复失败(参数错误)";
            return $data;
        }

        $data = array();
        $message = new Message();
        $message->from_id = $from_id;
        $message->to_id = $to_id;
        $message->is_read = 0;
        $message->content = $sendcontent;
        if ($message->save()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
            $data['msg'] = "发送回复失败(保存失败)";
        }

        return $data;
    }
    //删除整个对话，传入对话人id
    public function delDialog(Request $request,$to_id = -1){
        $uid = AuthController::getUid();

        $data = array();
        if($to_id != -1){
            $did = $to_id;
        }else if($request->has('id')){
            $did = $request->input('id');
        }else
            $did = 0;

        if($did && $uid){
            $dialog = Message::where(function ($query) use($uid,$did){
                $query->where('from_id',$uid)
                    ->where('to_id',$did);
                })
                ->orWhere(function ($query) use ($uid,$did) {
                    $query->where('from_id',$did)->where('to_id',$uid);
                })
                ->update(['is_delete' => 1]);

            $data["status"] = 200;

        } else {
            $data["status"] = 400;
            $data["msg"] = "删除失败";
        }

        return $data;
    }
    //删除站内信,传入待删除的mid数组
    public function delMessage(Request $request) {
        $uid = AuthController::getUid();
        $temp = $request->input('mid');

        $mid = explode(',',$temp);

        $data = array();
        $done = 0;
        foreach ($mid as $item) {
            if ($item != "") {
                $message = Message::find($item);//通过主键查找
                if($message->from_id == $uid)
                    $to_id = $message->to_id;
                else
                    $to_id = $message->from_id;
                //删除整条对话
                $delDialog = $this->delDialog($request,$to_id);
//                if ($message->is_delete == 0) {
//                    $message->is_delete = 1;
//                    if ($message->save())
//                        $done++;
//                }
                if($delDialog['status'] == 200){
                    $done++;
                }
            }
        }

        $data['status'] = 200;
        $data['msg'] = "共" . $done . "条信息已删除";

        return $data;
    }

    //标记为已读状态、传入mid数组
    public function isRead(Request $request) {
        $uid = AuthController::getUid();
        $temp = $request->input('mid');
        $mid = explode(',',$temp);
        $data = array();
        $done = 0;
        foreach ($mid as $item) {
            if ($item != "") {
                $message = Message::find($item);//通过主键查找
                if($message->from_id == $uid)
                    $to_id = $message->to_id;
                else
                    $to_id = $message->from_id;

                $dialog = Message::where(function ($query) use($uid,$to_id){
                    $query->where('from_id',$uid)
                        ->where('to_id',$to_id);
                })
                    ->orWhere(function ($query) use ($uid,$to_id) {
                        $query->where('from_id',$to_id)->where('to_id',$uid);
                    })
                    ->update(['is_read' => 1]);

                $done++;
            }
        }

        $data['status'] = 200;
        $data['msg'] = "共" . $done . "条信息标记为已读";

        return $data;
    }

    //站内信详情，与某人的对话内容，传入from_id,to_id,
    public function detail(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $to_id = $data['uid'];
        if ($to_id == 0) {
            $data['status'] = 400;
            $data['msg'] = "用户未登陆";
//            return view('account.register');
        }

        if (!$request->has('id')) {
            $data['msg'] = "参数错误";
            return $data;
        }

        $id = $request->input('id');
        $data['id'] = $id;
        $data['to_id'] = $to_id;
        $from_user_type = User::where('uid',$id)->first();
        $data['from_type'] = $from_user_type->type;

        if ($id != "" && $to_id != "") {
            $data['message'] = Message::where('is_delete', 0)
                ->where(function ($query) use ($id, $to_id) {
                    $query->where('from_id', $to_id)->where('to_id', $id)
                        ->orWhere('from_id', $id)->where('to_id', $to_id);
                })
                ->orderBy('created_at', 'desc')
                ->get();
            //标记对话为已读
            foreach ($data['message'] as $item){
                $num = Message::where('mid',$item['mid'])
                    ->update(['is_read' => 1]);
            }
            $data['userinfo'][$id] = MessageController::getUserInfo($id);
            $data['userinfo'][$to_id] = MessageController::getUserInfo($to_id);
        }
        return $data;
//        return view('message.detail', ['data' => $data]);
    }

    public function test(Request $request) {
        echo "test";
        $request->session()->put('uid', 1);
        //echo $request->session()->get('uid');
        //dd($request->session()->all());
        $data = ['name' => 'jkjun', 'sex' => 'm'];
        return response()->json($data);
    }

    public function upload(Request $request)//测试文件上传功能
    {
        if ($request->isMethod('POST')) {
            //dd($_FILES);//原生php方法
            $file = $request->file('source');
            $file2 = $request->file('source1');
//            dd($file);
//            exit;
            echo '<pre>';
            var_dump($file);
            var_dump($file2);
            if ($file->isValid()) {//判断文件是否上传成功
                //原文件名
                echo '文件上传成功';
                $originalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //mimetype
                $type = $file->getClientMimeType();
                //临时觉得路径
                $realPath = $file->getRealPath();

                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                echo $originalName . '\n';
                echo $ext . '\n';
                echo $type . '\n';
                echo $realPath . '\n';
                echo $filename;
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                var_dump($bool);
            }
            //dd($file);
            exit;
        }

        return view('upload.upload');

    }
}
