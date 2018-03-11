<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/13
 * Time: 0:00
 */

namespace App\Http\Controllers;

use App\Backup;
use App\Delivered;
use App\Enprinfo;
use App\Industry;
use App\Message;
use App\Personinfo;
use App\Position;
use Faker\Provider\lv_LV\Person;
use Illuminate\Support\Facades\DB;

class PersonCenterController extends Controller {

    public function index() {

        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        if (AuthController::getUid() == 0) {
            return view("/account/login",['data'=>$data]);
        }

        switch (AuthController::getType()) {
            case 1:
                $resume = new ResumeController();
                $data['uid'] = AuthController::getUid();
                $data['type'] = 1;
                $data['resumeList'] = $resume->getResumeList();
                $info = new InfoController();
                $data['personInfo'] = $info->getPersonInfo();
                $data['recommendPosition'] = $this->recommendPosition();
                $data['messageNum'] = $this->getMessageNum();
                $data['deliveredNum'] = $this->getDeliveredNum();
                $data['applylist'] = PositionController::getPersonApplyList($data['uid']);
                break;
            case 2:
                $data['type'] = 2;
                $eid = Enprinfo::where('uid', '=', $data['uid'])
                    ->first();
                $info = new InfoController();
                $data['uid'] = AuthController::getUid();
                $data['enterpriseInfo'] = $info->getEnprInfo();
                $data['positionList'] = $this->getPostionList($eid['eid']);
//                $data['messageNum'] = $this->getMessageNum();
                $data['positionNum'] = $this->getPositionNum($eid['eid']);
                $data['applyList'] = $this->getApplyList($eid['eid']);
                $data['industry'] = Industry::all();
                break;
        }

//        return $data;
        return view('account.index', ['data' => $data]);
    }

    public function recommendPosition() {

        $uid = AuthController::getUid();
        if($uid == 0){//用户未登陆
            return redirect('index');
        }
        $intentions = DB::table('jobs_personinfo')->join('jobs_intention', 'jobs_personinfo.uid', '=', 'jobs_intention.uid')
            ->where('jobs_intention.uid', '=', $uid)
            ->select('sex', 'work_nature', 'occupation', 'industry', 'region', 'salary')
            ->get();
        $result = array();
        $data = array();
        //获取最高学历
        $degree = Personinfo::where('uid','=',$uid)->first();
//        echo  $degree['education'];
        $pid = array();
//        return $degree['education'];
        foreach ($intentions as $item) {
            $result = DB::table('jobs_position')
                ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
                ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.updated_at')
                ->where(function ($query){//职位状态
                    $query->where('position_status',1)
                        ->orwhere('position_status',4);
                })
                ->where(function($query) use ($item,$degree){
                    $query->where('jobs_position.work_nature', '=', $item->work_nature )
                        ->orwhere('jobs_position.education', '<=', $degree['education'])
                        ->orwhere('jobs_position.industry', '=', $item->industry)
                        ->orwhere('jobs_position.occupation', '=', $item->occupation );
//                        ->orWhere(function ($query) use ($degree,$item){
//                            $query->where('education', '<=', $degree['education'])
//                                ->orWhere(function ($query) use($item){
//                                    $query->where('industry', '=', $item->industry );
//                                });
//                        });

//                        ->orWhere('industry', '=', $item->industry )
//                        ->orWhere('occupation', '=', $item->occupation );
                })
                ->orderBy('view_count','desc')
                ->take(5)
                ->get();
            foreach ($result as $item1){
                if(in_array($item1->pid,$pid)){
                    continue;
                }
                $pid[] = $item1->pid;
                $data['position'][] = $item1;
            }

        }
            $result2=DB::table('jobs_position')
                ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
                ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.updated_at')
                ->where(function ($query){//职位状态
                    $query->where('position_status',1)
                        ->orwhere('position_status',4);
                })
                ->where('is_urgency', '=', 1)
                ->get();
            foreach ($result2 as $item){
                if(in_array($item->pid,$pid)){
                    continue;
                }
                $pid[] = $item->pid;
                $data['position'][] = $item;
            }
            $result3= DB::table('jobs_position')
                ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
                ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.updated_at')
                ->where(function ($query){//职位状态
                    $query->where('position_status',1)
                        ->orwhere('position_status',4);
                })
                ->orderBy('view_count','desc')
                ->take(5)
                ->get();

            foreach ($result3 as $item){
                if(in_array($item->pid,$pid)){
                    continue;
                }
                $pid[] = $item->pid;
                $data['position'][] = $item;
            }
        //需要让多维数组变成一维数组
        //返回相关企业名称
        $eid = array();
        foreach ($data['position'] as $item){
            if(in_array($item->eid,$eid)){
                continue;
            }
            $eid[] = $item->eid;
            $data['enprinfo'][$item->eid] = Enprinfo::select('ename','byname','elogo')->find($item->eid);
        }

        return $data;
    }

    public function getMessageNum() {
        $uid = AuthController::getUid();
        $num = Message::where('to_id', '=', $uid)
            ->where('is_read', '=', '0')
            ->where("is_delete", "=", "0")
            ->count();
        if ($num > 99)
            return 99;
        else
            return $num;
    }
    //在招职位数
    public function getPositionNum($eid) {
        $num = Position::where('eid', '=', $eid)
            ->where(function ($query){
                $query->where('position_status', '=', '1')
                    ->orwhere('position_status', '=', '4');
            })
            ->count();
        if ($num > 99)
            return 99;
        else
            return $num;
    }

    //获取近30天的简历数目
    public function getDeliveredNum() {
        $uid = AuthController::getUid();
        $dateLimt = date("y-m-d h:i:s", strtotime('-30 day', time()));  //当前时间向前回退30天
//        echo $dateLimt;
        $num = Backup::where('uid', '=', $uid)
//            ->where('created_at', '>', $dateLimt)
            ->count();
        return $num;
    }

    //获取简历列表
    public function getDeliveredList() {
        $uid = AuthController::getUid();
        $dateLimt = date("y-m-d h:i:s", strtotime('-30 day', time()));  //当前时间向前回退30天
        $result = Backup::where('uid', '=', $uid)
            ->where('created_at', '>', $dateLimt)
            ->select('did', 'eid', 'position_title', 'created_at')
            ->orderBy('created_at', 'desc')//根据创建时间进行排序
            ->get();
        //通过遍历对每一条记录进行状态查询
        foreach ($result as $delivered) {
            $delivered['enterpriseName'] = Enprinfo::where('eid', '=', $delivered['eid'])
                ->select('ename')
                ->get();
            $delivered['enterpriseName'] = $delivered['enterpriseName'][0]['ename'];
            $delivered['status'] = Delivered::where('did', '=', $delivered['did'])
                ->select('status', 'pid')
                ->get();
            $pid = $delivered['status'][0]['pid'];
            $delivered['status'] = $delivered['status'][0]['status'];
            if ($delivered['status'] == 0 || $delivered['status'] == 1) {
                $position_status = Position::where('pid', '=', $pid)
                    ->select('position_status')
                    ->get();
                $position_status = $position_status[0]['position_status'];
                if ($position_status != 1)  //若果职位状态非正常，则将投递状态改为失效，并对数据库进行操作
                {
                    $delivered['status'] = 4;
                    Deliverd::where('did', '=', $delivered['did'])->update(['status'=>4]);
                }
            }
        }
        return $result;
    }

    public function getPostionList($eid) {
        $result = Position::where('eid', '=', $eid)
            ->where(function ($query){
                $query->where('position_status',1)
                    ->orwhere('position_status',4);
            })
//            ->select('title', 'pdescribe', 'pid')
            ->orderBy('updated_at','desc')
            ->take(6)
            ->get();
        return $result;
    }

    //申请记录列表只包含未查看的简历
    public function getApplyList($eid) {
        $pidArray = Position::where('eid', '=', $eid)
            ->where(function ($query){
                $query->where('position_status',1)
                    ->orwhere('position_status',4);
            })
            ->select('pid')
            ->get();
        $result = array();
        foreach ($pidArray as $value) {
            $didArray = Delivered::where('pid', '=', $value['pid'])
                ->where('status', '=', 0)
                ->select('did')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach ($didArray as $backup) {
//                $temp = Backup::where('did', '=', $backup['did'])
//                    ->get();
                $temp = DB::table('jobs_backup')
                    ->join('jobs_personinfo','jobs_personinfo.uid','=','jobs_backup.uid')
                    ->select('did','jobs_personinfo.pname','jobs_personinfo.photo','position_title','salary','jobs_backup.created_at')
                    ->where('did','=',$backup['did'])
                    ->get();

                if (sizeof($temp) == 0)
                    $result = null;
                else
                    $result[] = $temp[0];
            }
        }
        return $result;
    }

    //查看所有
    public static function getAllApplyList() {
        $uid = AuthController::getUid();
        $dateLimt = date("y-m-d h:i:s", strtotime('-30 day', time()));  //当前时间向前回退30天
        $eid = Enprinfo::where('uid', '=', $uid)
            ->select('eid')
            ->get();
        $eid = $eid[0]['eid'];
        $pidArray = Position::where('eid', '=', $eid)
            //->where('position_status', '=', 1)
            ->select('pid')
            ->get();

        $result = array();
        $didArray = array();
        foreach ($pidArray as $value) {
            $Arraytemp = Delivered::where('pid', '=', $value['pid'])
                ->select('did')
                ->where('status','!=',"-1")//删除投递记录
                ->orderBy('created_at', 'desc')
                ->get();
            foreach ($Arraytemp as $backup) {
                array_push($didArray,$backup['did']);
            }
        }
        rsort($didArray);
//        return $didArray;
            foreach ($didArray as $backup) {
                $temp = DB::table('jobs_backup')
                    ->join('jobs_personinfo','jobs_personinfo.uid','=','jobs_backup.uid')
                    ->leftjoin('jobs_delivered','jobs_backup.did','=','jobs_delivered.did')
                    ->select('jobs_backup.did','jobs_personinfo.pname','jobs_personinfo.photo','position_title','salary','status','jobs_backup.created_at')
//                    ->where('jobs_backup.created_at', '>=', $dateLimt)
                    ->where('jobs_backup.did','=',$backup)
                    ->get();
                if($temp->count())
                    $result[] = $temp[0];
            }

        return $result;
    }

    //查看简历的方法
    public function getResumeDetail($did) {
        //1.将状态设置为已查阅
        $deid = Delivered::where('did', '=', $did)
            ->select('deid')
            ->get();
        $deid = $deid[0]['$deid'];
        $delivered = Delivered::find($deid);
        $delivered->status = 1;
        $delivered->save();
        //2.准备好简历详细信息
        $backup = Backup::where('did', '=', $did)
            ->get();
        $personInfo = Person::where('uid', '=', $backup[0]['uid'])
            ->get();
        $result['backup'] = $backup[0];
        $result['personInfo'] = $personInfo;
        //3.发送站内信
        $position_title = $backup[0]['position_title'];
        $uid = AuthController::getUid();
        $enterpriseName = Enprinfo::where('uid', '=', $uid)
            ->select('ename')
            ->get();
        $enterpriseName = $enterpriseName[0]['ename'];
        $message = new Message();
        $message->to_id = $backup[0]['uid'];
        $message->from_id = $uid;
        $message->content = "您投递的" . $enterpriseName . $position_title . "的简历已被公司查阅";
        $message->save();
        return $result;
    }
}
