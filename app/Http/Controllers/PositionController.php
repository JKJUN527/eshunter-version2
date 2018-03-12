<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Adverts;
use App\Backup;
use App\Delivered;
use App\Enprinfo;
use App\Industry;
use App\Occupation;
use App\Personinfo;
use App\Place;
use App\Position;
use App\Region;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller {

    //个人职位申请记录
    public function applyList() {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        //未登陆用户不能直接访问路由
        if ($data['uid'] == 0) {
            return redirect('index');
        }
        $personCenter = new PersonCenterController;
        $data['applylist'] = $this->getPersonApplyList($data['uid']);
        $data['recommendPosition'] = $personCenter->recommendPosition();

//        return $data;
        return view('position/applyList', ['data' => $data]);
    }

    public static function getPersonApplyList($uid) {
        $result = array();
        //时间限制
        $dateLimt = date("y-m-d h:i:s", strtotime('-30 day', time()));  //当前时间向前回退30天

        $result['list'] = DB::table('jobs_delivered')
            ->join('jobs_position','jobs_delivered.pid','=','jobs_position.pid')
            ->leftjoin('jobs_resumes','jobs_resumes.rid','=','jobs_delivered.rid')
            ->select('jobs_position.title','jobs_position.eid','jobs_delivered.pid','jobs_position.salary','jobs_position.salary_max','jobs_resumes.resume_name','jobs_delivered.status','jobs_delivered.created_at','jobs_delivered.updated_at','fbinfo')
            ->where('jobs_delivered.created_at','>=',$dateLimt)
            ->where('jobs_delivered.uid',$uid)
            ->orderBy('jobs_delivered.updated_at','desc')
            ->paginate(9);
        //查询企业信息
        $eid = array();
        $allpid = Delivered::where('uid', $uid)->get();
        foreach ($allpid as $item) {
            $eid[] = Position::where('pid', '=', $item['pid'])->select('eid')->first();
        }
//        return $eid;
        foreach ($eid as $item) {
            $result['ename'][$item['eid']] = Enprinfo::where('eid', $item['eid'])->select('ename','elogo')->first();
        }
//        $result['enprinfo'] =

        return $result;
    }

    public function deliverListView() {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        if (AuthController::getUid() == 0)
            return view("account/login", ['data' => $data]);

        if (AuthController::getType() != 2)
            return redirect()->back();

        //查看所有投递记录
        $data['deliverAll'] = PersonCenterController::getAllApplyList();
//        return $data;
        return view('position/deliverList', ['data' => $data]);
    }
    //企业删除收到的投递记录（清空或删除所有）
    //传入did
    public function deldeliverRecord(Request $request){
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        $data=array();
        if($request->has('did') && $type ==2){
            $did = $request->input('did');
            if($did < 0){
                $eid = Enprinfo::where('uid', '=', $uid)
                    ->select('eid')
                    ->get();
                $eid = $eid[0]['eid'];
                $pidArray = Position::where('eid', '=', $eid)
                    //->where('position_status', '=', 1)
                    ->select('pid')
                    ->get();
                foreach ($pidArray as $value) {
                    $num = Delivered::where('pid', '=', $value['pid'])
                        ->where('status', '!=', "-1")//删除投递记录
                        ->update(['status' => -1]);
                    }
                    if($num){
                        $data['status']=200;
                        $data['msg']="清空成功！";
                        return $data;
                    }
                $data['status']=400;
                $data['msg']="清空失败！";
            }
            else{
                $num = Delivered::where('did',$did)
                    ->where('status', '!=', "-1")//删除投递记录
                    ->update(['status' => -1]);
                if($num){
                    $data['status']=200;
                    $data['msg']="删除成功！";
                    return $data;
                }
                $data['status']=200;
                $data['msg']="删除失败！";
            }
        }else{
            $data['status']=400;
            $data['msg']="参数错误！";
        }
        return $data;
    }
    //企业用户查看对应的申请记录信息//传递did  backup id
    public function deliverDetailView(Request $request) {
        $data = array();
        if ($request->has('did')) {
            $data['uid'] = AuthController::getUid();
            $data['username'] = InfoController::getUsername();
            $data['type'] = AuthController::getType();
            //验证当前用户是否是该简历的投递方。
            $eid = Backup::where('did', $request->input('did'))->first();
            $verid = Enprinfo::find($eid['eid']);
            if ($data['type'] != 2 || $verid->uid != $data['uid']) {
                return redirect()->back();
            }

            $data['personinfo'] = $this->getPerson($request->input('did'));
            $data['intention'] = Backup::find($request->input('did'));

            //设置简历投递状态为已查看
            $deid = Delivered::where('did', '=', $data['intention']->did)->get();
            $deliverStatus = Delivered::find($deid[0]['deid']);
            $data['status'] = $deliverStatus->status;
            if($deliverStatus->status == 0){
                $deliverStatus->status = 1;
                $deliverStatus->save();
                $content = "您投递的"  . $data['intention']->position_title . "的简历已被公司查阅,我们会尽快给你回复，谢谢！";
                $msgStatus = MessageController::sendMessage($request,$data['intention']->uid,$content);
            }

//            return $data;
            return view('position/deliverDetail', ['data' => $data]);
        } else {
            return redirect()->back();
        }
    }

    public function getPerson($did) {
        $result = array();

        $uid = Backup::find($did);

        $result = Personinfo::where('uid', $uid['uid'])
            ->select('pname', 'birthday', 'photo', 'sex', 'tel', 'mail', 'self_evalu', 'residence')
            ->first();

        return $result;
    }
    //回复简历投递
    //content 为回复内容
    //employ 为录取状态 已查看、已录用、未录用、失效 1234
    public function reply(Request $request) {
        $data = array();

        if ($request->has('content') && $request->has('employ') && $request->has('did')) {
            $content = $request->input('content');
            $employ = $request->input('employ');
            $did = $request->input('did');
            //发送站内信
            if ($employ == 2 || $employ == 3) {
                $mesUid = Backup::find($did);
                if ($employ == 2) {
                    $einfo = Enprinfo::find($mesUid['eid']);
                    $sendcontent = "恭喜你!你已经被我们录取了！请尽快与我们取得联系,电话:".$einfo['etel']."邮箱:".$einfo['email'];
                    $msgStatus = MessageController::sendMessage($request, $mesUid['uid'], $sendcontent);
                } else {
                    $msgStatus = MessageController::sendMessage($request, $mesUid['uid'], "很抱歉！你不符合我们公司的招聘条件！");
                }
            }
            $deid = Delivered::where('did', $did)->get();
            $rePly = Delivered::find($deid[0]['deid']);
            $rePly->status = $employ;
            $rePly->fbinfo = $content;
            if ($rePly->save()) {
                $data['status'] = 200;
                $data['msg'] = "回复成功";
                return $data;
            }
            $data['status'] = 400;
            $data['msg'] = "回复失败";
            return $data;

        }
        $data['status'] = 400;
        $data['msg'] = "参数错误";
        return $data;
    }

    public function checkVerification() {
        $data = array();
        $uid = AuthController::getUid();
        $type = AuthController::getType();

        if ($uid == 0 || $type != 2) {
            $data['status'] = 400;
            $data['msg'] = "用户未登录或无权限";
        } else {
            $enterprise = Enprinfo::where('uid', $uid)->first();

            $data['status'] = 200;
            $data['is_verify'] = $enterprise->is_verification == 1;
        }

        return $data;
    }

    //发布职位首页.
    //返回职位发布页中所需数据
    public function publishIndex() {
        $uid = AuthController::getUid();
        if ($uid == 0) {
            return view('account.login');
        }
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $uid = $data['uid'];
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return redirect()->back();
        }

        //企业通过验证后才可以发布职位
        $enterprise = Enprinfo::where('uid', $uid)->first();
        if ($enterprise->is_verification != 1) {
            return redirect()->back();
        }

        //查询工作地区
        $data['province'] = Region::where('parent_id',0)->get();
        $data['city'] = Region::where('parent_id','!=',0)->get();
        //查询游戏
        $data['occupation'] = Occupation::orderBy('updated_at','asc')->get();
        //职位
        $data['place'] = Place::orderBy('updated_at','asc')->get();
        //查询行业
        $data['industry'] = Industry::all();
//        return $data;
        return view('position/publish', ['data' => $data]);
    }

    //发布职位，添加数据库，返回执行结果
    public function publish(Request $request) {
        //$position = Position::all();
        //可以使用批量赋值方法creat()
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $uid = AuthController::getUid();
        if ($uid == 0) {
            return view('account.login', ['data' => $data]);
        }
        if($request->input('salary') ==-1){
            $salary = -1;
        }else{
            $salary = $request->input('salary')*1000;
        }
        if($request->input('salary_max') ==0){
            $salary_max = 0;
        }else{
            $salary_max = $request->input('salary_max')*1000;
        }
        $eid = Enprinfo::where('uid',$data['uid'])->first();
        if ($request->isMethod('POST')) {
            //还未验证字段合法性
//            $data = $request->input(position);
            $position = new position();
            $position->eid = $eid->eid;
            $position->title = $request->input('title');
            $position->tag = $request->input('tag');
            $position->pdescribe = $request->input('pdescribbe');
            $position->salary = $salary;
            $position->salary_max = $salary_max;
            $position->region = $request->input('region');//工作地区，这里应为地区id，指向jobs_region
            $position->work_nature = $request->input('work_nature');//工作性质（兼职|实习|全职）int
            $position->place = $request->input('place');//职业，这里应为职业id，指向jobs_place
            $position->occupation = $request->input('occupation');//游戏，这里应为游戏id，指向jobs_occupation
            $position->industry = $request->input('industry');//行业，这里应为行业id，指向jobs_industry
            $position->experience = $request->input('experience');//
            $position->workplace = $request->input('workplace');
            $position->education = $request->input('education');
            $position->total_num = $request->input('total_num');
            $position->max_age = $request->input('max_age');
//            $position->vaildity = $request->input('vaildity');
            if($data['username']['username']=="tempUser"){
                $position->position_status = 4;
            }
            if ($position->save()) {
                $data['status'] = 200;
            } else {
                $data['status'] = 400;
                $data['msg'] = "职位发布失败";
            }

            return $data;
        } else {
            $data['status'] = 400;
            $data['msg'] = "500 inter server error";
            return $data;
        }
    }
    //修改职位页面
    //返回职位数据/传入职位ID
    public function editIndex(Request $request) {
        $uid = AuthController::getUid();
        if ($uid == 0) {
            return view('account.login');
        }
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $uid = $data['uid'];
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return redirect()->back();
        }
        if(!$request->has('pid')){
            return redirect()->back();
        }else
            $pid = $request->input('pid');
        //企业通过验证后才可以发布职位
        $enterprise = Enprinfo::where('uid', $uid)->first();
        if ($enterprise->is_verification != 1) {
            return redirect()->back();
        }

        //查询工作地区
        $data['position'] = Position::find($pid);

        //处理边界数据
        if($data['position']->workplace == -1) $data['position']->workplace="";
//        if($data['position']->experience) $data['position']->experience = preg_replace('/<\/br>/i','\r\n',$data['position']->experience);
        //职位必须是对应企业发布才有权限修改
        if($data['position']->eid != $enterprise->eid){
            return redirect()->back();
        }
        $data['region'] = Region::all();
        //查询职业
        $data['occupation'] = Occupation::orderBy('updated_at','asc')->get();
        //查询行业
        $data['industry'] = Industry::all();
//        return $data;
        return view('position/publishEdit', ['data' => $data]);
    }

    //修改职位，更新数据库，返回执行结果
    public function edit(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $uid = AuthController::getUid();
        if ($uid == 0) {
            return view('account.login', ['data' => $data]);
        }
        if(!$request->has('pid')){
            $data['status'] = 400;
            $data['msg'] = "请传入职位id";
            return $data;
        }else
            $pid = $request->input('pid');
        if($request->input('salary') ==-1){
            $salary = -1;
        }else{
            $salary = $request->input('salary')*1000;
        }
        if($request->input('salary_max') ==0){
            $salary_max = 0;
        }else{
            $salary_max = $request->input('salary_max')*1000;
        }
        $eid = Enprinfo::where('uid',$data['uid'])->first();
        if ($request->isMethod('POST')) {
            $position = Position::find($pid);
            $position->eid = $eid->eid;
            $position->title = $request->input('title');
            $position->tag = $request->input('tag');
            $position->pdescribe = $request->input('pdescribbe');
            $position->salary = $salary;
            $position->salary_max = $salary_max;
            $position->region = $request->input('region');//工作地区，这里应为地区id，指向jobs_region
            $position->work_nature = $request->input('work_nature');//工作性质（兼职|实习|全职）int
            $position->occupation = $request->input('occupation');//职业，这里应为职业id，指向jobs_occupation
            $position->industry = $request->input('industry');//行业，这里应为行业id，指向jobs_industry
            $position->experience = $request->input('experience');//
            $position->workplace = $request->input('workplace');
            $position->education = $request->input('education');
            $position->total_num = $request->input('total_num');
            $position->max_age = $request->input('max_age');
//            $position->vaildity = $request->input('vaildity');
            if($data['username']['username']=="tempUser"){
                $position->position_status = 4;
            }
            if ($position->save()) {
                $data['status'] = 200;
            } else {
                $data['status'] = 400;
                $data['msg'] = "职位更新失败";
            }

            return $data;
        } else {
            $data['status'] = 400;
            $data['msg'] = "500 inter server error";
            return $data;
        }
    }
    //查询企业已发布职位信息
    //返回值，$data['position']--职位列表
    //$data['dcount']--每个职位所对应的已投递次数
    //查看已发布职位前，先查看其有效时间，时间过期则更新状态。
    public function publishList(Request $request) {
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $uid = $data['uid'];
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return redirect()->back();
        }

        $eid = Enprinfo::select('eid')
            ->where('uid', '=', $uid)
            ->get();

        //更新职位时间状态
        //取消企业职位有效期
//        $temp = Position::select('pid')
//            ->where('eid', '=', $eid[0]['eid'])
//            ->where('vaildity', '<', date('Y-m-d H-i-s'))
//            ->where('position_status', '=', 1)
//            ->get();
//        foreach ($temp as $item) {
//            $temp_pos = Position::find($item['pid']);
//            $temp_pos->position_status = 2;
//            $temp_pos->save();
//        }

        $data['position'] = Position::where('eid', '=', $eid[0]['eid'])
            ->where('position_status', '!=', 3)
            //select('pid', 'title', 'tag', 'salary', 'region', 'work_nature', 'total_num')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        //查询每一个职位对应的投递次数

        //获取每一个职位对应的pid，查询其被投递次数
        $dcount = array();
        foreach ($data['position'] as $item) {
            // var_dump($item['attributes']['pid']);
            $pid = $item['attributes']['pid'];
            $dcount[$pid] = Delivered::where('pid', '=', $pid)
                ->count();
        }
        $data['dcount'] = $dcount;

//        return $data;
        return view('position.publishList', ['data' => $data]);
        //return $position;
    }

    //在职位发布列表搜索已发布的职位
    public function searchPosition(Request $request) {
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $uid = $data['uid'];
        $type = AuthController::getType();

        if ($uid == 0) return view("account.login", ['data' => $data]);

        if ($type != 2) return redirect()->back();

        if ($request->has('keyword'))
            $keyword = $request->input('keyword');
        else
            $keyword = "";

        $eid = Enprinfo::select('eid')
            ->where('uid', '=', $uid)
            ->get();

        $data['position'] = Position::where('eid', '=', $eid[0]['eid'])
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('pdescribe', 'like', '%' . $keyword . '%');
            })
            ->where('position_status', '!=', 3)
            ->orderBy('updated_at', 'desc')
            ->paginate(15);

        //查询每一个职位对应的投递次数

        //获取每一个职位对应的pid，查询其被投递次数
        $dcount = array();
        foreach ($data['position'] as $item) {
            // var_dump($item['attributes']['pid']);
            $pid = $item['attributes']['pid'];
            $dcount[$pid] = Delivered::where('pid', '=', $pid)
                ->count();
        }
        $data['dcount'] = $dcount;

        //return $data;
        return view('position.publishList', ['data' => $data]);
    }

    //删除已发布职位
    public function delPosition(Request $request) {
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return view('account.login')->with('error', '请登录后操作');
        }
        $pid = $request->input('pid');
        $position = Position::find($pid);

        $data = array();
        $data['status'] = 400;
        if ($position) {
            $bool = $position->delete();
            if ($bool) {
                $data['status'] = 200;
            }
        }
        return $data;
    }
    //重新发布已过期职位
    public function onlinePosition(Request $request) {
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return view('account.login')->with('error', '请登录后操作');
        }
        $pid = $request->input('pid');
        $position = Position::find($pid);

        $data = array();
        $data['status'] = 400;
        if ($position) {
//            $position->vaildity=date('Y-m-d H:i:s', strtotime('+7 day'));
            $position->position_status=1;
            if ($position->save()) {
                $data['status'] = 200;
            }
        }
        return $data;
    }
    //下架公司职位
    public function offlinePosition(Request $request) {
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if ($uid == 0 || $type != 2) {
            return view('account.login')->with('error', '请登录后操作');
        }
        $pid = $request->input('pid');
        $position = Position::find($pid);

        $data = array();
        $data['status'] = 400;
        if ($position) {
//            $position->vaildity=date('Y-m-d H:i:s', strtotime('+7 day'));
            $position->position_status=2;
            if ($position->save()) {
                $data['status'] = 200;
            }
        }
        return $data;
    }
    //刷新公司职位信息---修改职位发布时间为当前时间
    public function refreshPosition(Request $request){
        $uid = AuthController::getUid();
        $type = AuthController::getType();
        $data = array();
        $data['status'] = 400;
        if ($uid == 0 || $type != 2) {
            return view('account.login')->with('error', '请登录后操作');
        }
        if($request->isMethod('post')){
            $pid = $request->input('pid');
            $position = Position::find($pid);
            $position->created_at = time();
            if($position->save()){
                $data['status'] = 200;
            }
        }
        return $data;
    }
    //职位详情页面
    //返回值：data[detail]--职位基本详情
    //data[dcount]--职位被投递次数
    //data[enprinfo]--公司基本信息
    //data[position]--公司其他职位
    //增加简历浏览次数
    public function detail(Request $request) {
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        //根据pid号返回职位信息
        if ($request->has('pid')) {
            $pid = $request->input('pid');//获取前台传来的pid
            $detail1 = Position::find($pid);
            $detail1->view_count += 1;
            $detail1->save();
            $data['detail'] = DB::table('jobs_position')
                ->leftjoin('jobs_occupation', 'jobs_position.occupation', '=', 'jobs_occupation.id')
                ->leftjoin('jobs_industry', 'jobs_position.industry', '=', 'jobs_industry.id')
                ->leftjoin('jobs_place', 'jobs_position.place', '=', 'jobs_place.id')
                ->select('jobs_position.pid','jobs_position.eid','jobs_position.title','jobs_position.tag','jobs_position.pdescribe','jobs_position.salary','salary_max','jobs_position.region','work_nature','jobs_position.occupation','jobs_position.industry','jobs_position.experience','jobs_position.education','jobs_position.total_num','jobs_position.max_age','jobs_position.workplace','jobs_position.position_status','jobs_position.view_count','jobs_position.created_at','jobs_occupation.name as occupation_name','jobs_industry.name as industry_name','jobs_place.name as place_name')
                ->where('pid', '=', $pid)
                ->first();

            $data['region'] = Region::where('id', '=', $detail1['attributes']['region'])->first();

            $data['dcount'] = Delivered::where('pid', '=', $pid)
                ->count();
            $eid = $detail1['attributes']['eid'];

            $data['industry'] = Industry::all();

            $data['enprinfo'] = Enprinfo::where('eid', '=', $eid)
                ->get();
            $data['position'] =DB::table('jobs_position')
                ->leftjoin('jobs_region','jobs_region.id','=','jobs_position.region')
                ->where('eid', '=', $eid)
                ->where('pid', '!=', $pid)
//                ->where('position_status', '=', 1)
                ->where(function ($query){
                    $query->where('position_status',1)
                        ->orwhere('position_status',4);
                })
//                ->where('vaildity', '>=', date('Y-m-d H-i-s'))
                ->get();
            $data['is_tempuser']=User::where('uid', $data['enprinfo'][0]->uid)->select('username')->first();
        }
//         return $data;
        return view('position/detail', ["data" => $data]);
    }

    //职位高级搜索|根据行业、地区、薪酬、类型信息查找对应的职位信息
    //其中，salary 1:<3k 2:3k>= & <5k 3:5k>= & <10k 4:10k>= & <15k 5:15k>= & <20k 6:20k>= & <25k 7:25k>= & <50k 8:>=50k
    public function advanceSearch(Request $request) {
        $data = array();
        //$data['position'] = Position::select('pid','eid','title','tag','pdescribe','salary','region','work_nature','occupation',)
        $orderBy = "jobs_position.created_at";
        $desc = "desc";
        if ($request->has('orderBy')) {//0:热度排序2:时间排序1:薪水
            $data["orderBy"] = $request->input('orderBy');

            switch ($request->input('orderBy')) {
                case 0:
                    $orderBy = "view_count";
                    break;
                case 1:
                    $orderBy = "salary";
                    break;
                case 2:
                    $orderBy = "jobs_position.created_at";
                    break;
            }
        }

        if ($request->has('desc')) {
            if ($request->input('desc') == 1) {
                $data["desc"] = 1;
                $desc = "desc";
            } else if ($request->input('desc') == 2) {
                $data["desc"] = 2;
                $desc = "asc";
            }
        }

        if ($request->has('industry')) $data['industry'] = $request->input('industry');
        if ($request->has('occupation')) $data['occupation'] = $request->input('occupation');
        if ($request->has('place')) $data['place'] = $request->input('place');

        $city_set =array();
        if ($request->has('region-pro')) {
            $data['region-pro'] = $request->input('region-pro');
            $citys = Region::where('parent_id',$data['region-pro'])->get();
            $city_set[] = $data['region-pro'];
            foreach ($citys as $city){
                $city_set[] = $city['id'];
            }
        }
        if ($request->has('region-city')) {
            $data['region-city'] = $request->input('region-city');
        }
        if ($request->has('salary')) $data['salary'] = $request->input('salary');
        if ($request->has('work_nature')) $data['work_nature'] = $request->input('work_nature');
        if ($request->has('keyword')) $data['keyword'] = $request->input('keyword');

        //return $data;

        $data['position'] = DB::table('jobs_position')
            ->select('pid', 'title','tag','ename','byname','ebrief','salary','salary_max','jobs_region.name','position_status')
            ->leftjoin('jobs_enprinfo', 'jobs_enprinfo.eid', '=', 'jobs_position.eid')
            ->leftjoin('jobs_region', 'jobs_region.id', '=', 'jobs_position.region')
            //关闭企业职位有效期
//            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
//        $data['position'] = Position::where('vaildity', '>=', date('Y-m-d H-i-s'))
//            ->where('position_status', '=', 1)
            ->where(function ($query){
                $query->where('position_status',1)
                    ->orwhere('position_status',4);
            })
            ->where(function ($query) use ($request,$city_set) {
                if ($request->has('industry')) {//行业
                    $query->where('jobs_position.industry', '=', $request->input('industry'));
                }
                if ($request->has('occupation')) {//游戏
                    $query->where('jobs_position.occupation', '=', $request->input('occupation'));
                }
                if ($request->has('place')) {//职位
                    $query->where('jobs_position.place', '=', $request->input('place'));
                }
                if ($request->has('region-pro') && $request->has('region-city')) {
//                    $query->whereIn('jobs_position.region',$city_set)
//                        ->orWhere(function ($query) use ($request) {
//                            $query->where('jobs_position.region',$request->input('region-city'));
//                        });
                    $query->where('jobs_position.region',$request->input('region-city'));
                }
                if($request->has('region-pro') && !$request->has('region-city')){
                    $query->whereIn('jobs_position.region', $city_set);
                }
                if(!$request->has('region-pro') && $request->has('region-city')){
                    $query->where('jobs_position.region', '=', $request->input('region-city'));
                }
                if ($request->has('salary')) {
                    switch ($request->input('salary')) {
                        case 1:
                            $query->where('jobs_position.salary', '<', 3000);
                            break;
                        case 2:
                            $query->where('jobs_position.salary', '>=', 3000);
                            $query->where('jobs_position.salary', '<', 5000);
                            break;
                        case 3:
                            $query->where('jobs_position.salary', '>=', 5000);
                            $query->where('jobs_position.salary', '<', 10000);
                            break;
                        case 4:
                            $query->where('jobs_position.salary', '>=', 10000);
                            $query->where('jobs_position.salary', '<', 15000);
                            break;
                        case 5:
                            $query->where('jobs_position.salary', '>=', 15000);
                            $query->where('jobs_position.salary', '<', 20000);
                            break;
                        case 6:
                            $query->where('jobs_position.salary', '>=', 20000);
                            $query->where('jobs_position.salary', '<', 25000);
                            break;
                        case 7:
                            $query->where('jobs_position.salary', '>=', 25000);
                            $query->where('jobs_position.salary', '<', 50000);
                            break;
                        case 8:
                            $query->where('jobs_position.salary', '>', 50000);
                            break;
                        default:
                            break;
                    }
                }
                if ($request->has('work_nature')) {
                    $query->where('jobs_position.work_nature', '=', $request->input('work_nature'));
                }
                //未加入对公司名称以及公司别名的搜索
                if ($request->has('keyword')) {
                    $keyword = $request->input('keyword');
                    $query->where('jobs_position.title', 'like', '%' . $keyword . '%')
                        ->orWhere(function ($query) use ($keyword) {
                            $query->where('jobs_position.pdescribe', 'like', '%' . $keyword . '%');
                        });
                }
            })
            ->orderBy($orderBy, $desc)
            ->paginate(14);
        return $data;
    }

    public function advanceIndex(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['industry'] = Industry::all();
        $data['occupation'] = Occupation::all();
        $data['place'] = Place::all();
        $data['region-pro'] = Region::where('parent_id',0)
            ->orderBy('created_at','asc')
            ->get();
        $data['region-city'] = Region::where('parent_id','!=',0)->get();
        $data['result'] = $this->advanceSearch($request);
        $data['hot-ad-company'] = Adverts::where('validity', '>=', date('Y-m-d H-i-s'))
            ->where('type', '=', '0')
//            ->where('location', '<', 13)
            ->orderBy('updated_at', 'desc')
            ->take(12)
            ->get();

        $data['condition'] = $request->all();
//        return $data;
        return view('position/advanceSearch', ['data' => $data]);
    }

    //职位详情页，查看某公司全部职位信息。
    public function viewallposition(Request $request){
            $data = array();
            $data['uid'] = AuthController::getUid();
            $data['username'] = InfoController::getUsername();

            $news = array();
            $position = array();
            //主页搜索功能，传入keywords返回关键字匹配的新闻及position相关数据。
            if ($request->has('eid')) {
                if ($request->isMethod('GET')) {
                    $eid = $request->input('eid');
                    $position = Position::where(function ($query){
                        $query->where('position_status',1)
                            ->orwhere('position_status',4);
                    })
//                    ->where('vaildity', '>=', date('Y-m-d H-i-s'))
//                    ->where('position_status', 1)
                        ->where('eid',$eid)
                        ->orderBy('created_at','desc')
                        ->get();
                }
            }
            // ly:添加返回搜索的关键字
            $searchResult['keyword'] = "";
            $searchResult['news'] = $news;
            $searchResult['position'] = $position;

            // ly:返回首页搜索结果页面
            //return $data;
            return view('search', [
                "data" => $data,
                "searchResult" => $searchResult
            ]);
    }

    public function test1(Request $request) {
//        $request->session()->put('uid', 1);
        $request->session()->flush();
        var_dump($request->session()->all());
    }

    /**
     * @return mixed
     */
    public function testRaw() {
        $data['position'] = DB::select("select * from jobs_position where CONCAT(title,pdescribe) LIKE '%业%'");
//        $data['position'] = Position::whereRaw("? and ? and ? and ?", array('industry=1',1,1,1))
//            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
//            ->where('position_status', '=', 1)
//            ->get();
        return $data;
    }
}
