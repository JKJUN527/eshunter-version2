<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Education;
use App\Egame;
use App\Egamexp;
use App\Egamexpr;
use App\Egrade;
use App\Industry;
use App\Intention;
use App\Occupation;
use App\Projectexp;
use App\Region;
use App\Resumes;
use App\Workexp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumeController extends Controller {
//    public function __construct() {
//        $this->middleware('auth');
//    }

    // 返回添加简历页面的基本信息
    // 同时设置intention 表
    public function addResume() {
        $data = array();

        $uid = AuthController::getUid();
        $type = AuthController::getType();
        if($type == 1 ){
            $resume = new Resumes();
            $resume->uid = $uid;
            $resume->resume_name = "未命名简历";
            $count = Resumes::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
            if ($count > 2) {
                $data['status'] = 400;
                $data['msg'] = "简历数大于上限";
            } else {
                $resume->save();

                $intention = new Intention();
                $intention->rid = $resume->rid;
                $intention->uid = $uid;
                $intention->work_nature = -1;
                $intention->occupation = -1;
                $intention->industry = -1;
                $intention->region = -1;
                $intention->salary = -1;
                $intention->save();

                $updateresume = Resumes::where('rid',$resume->rid)
                    ->update(['inid'=>$intention->inid]);

                $data['status'] = 200;
                $data['rid'] = $resume->rid;
            }
        }else{
            $data['status'] = 400;
            $data['msg'] = "仅个人用户才能添加简历";
        }

        return $data;
    }

    public function getIndex(Request $request) {
        $input = $request->all();
        $data = array();

        $data['uid'] = AuthController::getUid();

        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        if (!($request->has('rid'))) return redirect()->back();

        $resume = Resumes::where('rid', $input['rid'])->get();

        if (sizeof($resume) == 0) return redirect()->back();

        if ($resume[0]->uid != $data['uid']) return redirect()->back();

        $data['rid'] = $input['rid'];
        $data['resume'] = Resumes::find($data['rid']);
        $data['intention'] = Intention::find($data['resume']['inid']);

        $skillStr = $data['resume']['skill'];
        if ($skillStr == null) {
            $data['resume']['skill'] = null;
        } else {
            $data['resume']['skill'] = explode("|@|", substr($skillStr, 3));
        }

        $data['education'] = $this->getEducation();
        $data['game'] = $this->getEgamexpr();
        $data['work'] = $this->getWorkexp();
        $data['project'] = $this->getProjectexp();
        $person = new InfoController();
        $data['personInfo'] = $person->getPersonInfo();
        //查询工作地区
        $data['province'] = Region::where('parent_id',0)->get();
        $data['city'] = Region::where('parent_id','!=',0)->get();
        $data['industry'] = Industry::all();
        $data['occupation'] = Occupation::orderBy('updated_at','asc')->get();
        $data['egame'] = Egame::all();
        $data['egrade'] = Egrade::all();
        $data['completion'] = $this->Completion_total($data['rid']);

//        return $data;
        return view('resume/add', ["data" => $data]);
    }
    public function Completion_total($rid){
        $data = 0;//初始完成度为0
        //检查简历表中技能及额外填写情况
        $resume = Resumes::find($rid);
        if($resume->skill != null){
            $data = $data + 10;
        }
        if($resume->extra != null){
            $data = $data + 5;
        }
        //检查意向表是否填写
        $intention = Intention::find($resume['inid']);
        if(!empty($intention)){
            $data = $data +25;
        }
        //检查教育经历是否填写
        $education = Education::where('uid',$resume['uid'])->get();
        if($education->count()>0){
            $data = $data +10;
        }
        //检查工作经历是否填写
        $workexp = Workexp::where('uid',$resume['uid'])->get();
        if($workexp->count()>0){
            $data = $data +15;
        }
        //检查电竞经历是否填写
        $egamecp = Egamexpr::where('uid',$resume['uid'])->get();
        if($egamecp->count()>0){
            $data = $data +20;
        }
        //检查项目经历是否填写
        $projectexp = Projectexp::where('uid',$resume['uid'])->get();
        if($projectexp->count()>0){
            $data = $data +15;
        }
        return $data;
    }

    /**
     * 修改简历名称
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function rename(Request $request) {
        if (!($request->has('rid'))) {
            return redirect()->back()->with('error', '参数错误');
        }

        $input = $request->all();
        $rid = $input['rid'];

        $resume = Resumes::find($rid);

        $resume->resume_name = $input['name'];

        $data = array();
        if ($resume->save()) {
            $data['resume_name'] = $resume->resume_name;
            $data['status'] = 200;
        } else {
            $data['msg'] = "简历名称修改失败";
            $data['status'] = 400;
        }

        return $data;
    }

    /*简历列表
    */
    public function getResumeList() {
        $uid = AuthController::getUid();
        $result = Resumes::where('uid', '=', $uid)
            ->select('rid', 'inid', 'resume_name')
            ->get();
        return $result;
    }

    //预览简历
    public function previewResume(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['type'] = AuthController::getType();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $input = $request->all();
        if (!($request->has('rid'))) {
            return redirect()->back() - with('error', '参数错误');
        }

        $data['rid'] = $input['rid'];

        $person = new InfoController();
        $data['personInfo'] = $person->getPersonInfo();
        $data['resume'] = Resumes::find($data['rid']);
        $data['intention'] = Intention::find($data['resume']['inid']);
        $data['education'] = $this->getEducation();
        $data['game'] = $this->getEgamexpr();
        $data['work'] = $this->getWorkexp();
        $data['project'] = $this->getprojectexp();

        $skillStr = $data['resume']['skill'];
        if ($skillStr == null) {
            $data['resume']['skill'] = null;
        } else {
            $data['resume']['skill'] = explode("|@|", substr($skillStr, 3));
        }

        $data['region'] = Region::all();
        $data['industry'] = Industry::all();
        $data['occupation'] = Occupation::orderBy('updated_at','asc')->get();

//        return $data;
        return view('resume/preview', ["data" => $data]);
    }

    //基本信息的获取
//    public function generateRid() {
//        $uid = AuthController::getUid();
//        $resume = new Resumes();
//        $resume->uid = $uid;
//        $nums = Resumes::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
//        if ($nums > 2)
//            return "简历数大于上限";           //进行简历数的一个判断
//        else {
//            $resume->save();                //save()之后$resume就是一个返回的东西!!!
//            $rid = $resume->rid;           //插入成功之后返回主键
//            return $rid;
//        }
//    }

//    public function getRegion() {
//        $region = Region::select('id', 'name', 'parent_id')->get();
//        return $region;
//    }
//
//    public function getIndustry() {
//        $industry = Industry::select('id', 'name')->get();
//        return $industry;
//    }


    /**
     * 添加/修改求职意向
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function addIntention(Request $request) {
        $input = $request->all();
        $rid = $input['rid'];

        $result = Intention::where('rid', '=', $rid)->get();
        if ($result->isEmpty()) {
            $intention = new Intention();
            $intention->uid = AuthController::getUid();

            $intention->rid = $rid;
            $intention->work_nature = $input['work_nature'];
            $intention->occupation = $input['occupation'];
            $intention->industry = $input['industry'];
            $intention->region = $input['region'];
            $intention->salary = $input['salary'];
        } else {                      //执行更新操作
            $inid = Intention::where('rid', '=', $rid)
                ->select('inid')
                ->get();
            $inid = $inid[0]['inid'];
            $intention = Intention::find($inid);
            $intention->work_nature = $input['work_nature'];
            $intention->occupation = $input['occupation'];
            $intention->industry = $input['industry'];
            $intention->region = $input['region'];
            $intention->salary = $input['salary'];
        }

        $data = array();
        if ($intention->save()) {
            $resume = Resumes::find($rid);
            $resume->inid = $intention->inid;
            if ($resume->save()) {
                $data['status'] = 200;
                $data['intention'] = $intention;
            } else {
                $data['status'] = 400;
                $data['msg'] = '简历更新失败';
            }
        } else {
            $data['status'] = 400;
            $data['msg'] = '求职意向添加／更新失败';
        }

        return $data;
    }

    //最多写出最高的三个教育经历，依次从高到底填写；最少写出一个教育经历
    public function addEducation(Request $request) {
        $uid = AuthController::getUid();

        $data = array();
        $input = $request->all();
        if(!$request->has('eduid')){
            $count = Education::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
            if ($count > 2) {
                $data['status'] = 400;
                $data['msg'] = "最多添加3个教育经历";
                return $data;
            } else {
                $education = new Education();
            }
        }else{
            $education = Education::find($input['eduid']);
        }
        $education->uid = $uid;
        $education->school = $input['school'];
        $education->date = $input['date'];
        $education->gradu_date = $input['gradu_date'];
        $education->major = $input['major'];
        $education->degree = $input['degree'];

        if ($education->save()) {
            $data['status'] = 200;
            $data['education'] = $education;
        } else {
            $data['status'] = 400;
            $data['msg'] = "添加教育经历失败";
        }
        return $data;
    }

    //最多写出最高的三个电竞经历，依次从高到底填写；最少写出一个教育经历
    public function addEgamexpr(Request $request) {
        $uid = AuthController::getUid();

        $data = array();
        $input = $request->all();
        if(!$request->has('egid')){
            $count = Egamexpr::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
            if ($count > 2) {
                $data['status'] = 400;
                $data['msg'] = "最多添加3个电竞经历";
                return $data;
            } else {
                $game = new Egamexpr();
            }
        }else{
            $game = Egamexpr::find($input['egid']);
        }
        $egamename = Egame::find($input['game']);
        $egrade = Egrade::find($input['level']);
        $game->uid = $uid;
        $game->ename = $egamename['name'];
        $game->level = $egrade['name'];
        $game->date = $input['date'];
        $game->extra = $input['extra'];

        if ($game->save()) {
            $data['status'] = 200;
            $data['game'] = $game;
        } else {
            $data['status'] = 400;
            $data['msg'] = "添加电竞经历失败";
        }
        return $data;
    }
    //最多写出最高的三个工作经历，依次从高到底填写；最少写出一个工作经历
    public function addWorkexp(Request $request) {
        $uid = AuthController::getUid();

        $data = array();
        $input = $request->all();
        if(!$request->has('id')){
            $count = Workexp::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
            if ($count > 2) {
                $data['status'] = 400;
                $data['msg'] = "最多添加3个工作经历";
            } else {
                $work = new Workexp();
            }
        }else{
            $work = Workexp::find($input['id']);
        }

        $work->uid = $uid;
        $work->type = $input['type'];
        $work->work_time = $input['work_time'];//时间保存格式xxxx-xx@xxxx-xx
        $work->ename = $input['ename'];
        $work->position = $input['position'];
        $work->describe = $input['describe'];

        if ($work->save()) {
            $data['status'] = 200;
            $data['msg'] = "添加工作经历成功";
        } else {
            $data['status'] = 400;
            $data['msg'] = "添加工作经历失败";
        }
        return $data;
    }
    //最多写出最高的三个项目经历，依次从高到底填写；最少写出一个工作经历
    public function addProjectexp(Request $request) {
        $uid = AuthController::getUid();

        $data = array();
        $input = $request->all();
        if(!$request->has('id')){
            $count = Projectexp::where('uid', '=', $uid)->count();       //ORM聚合函数的用法
            if ($count > 2) {
                $data['status'] = 400;
                $data['msg'] = "最多添加3个项目经历";
                return $data;
            } else {
                $project = new Projectexp();
            }
        }else{
            $project = Projectexp::find($input['id']);
        }

        $project->uid = $uid;
        $project->project_time = $input['project_time'];//时间保存格式xxxx-xx@xxxx-xx
        $project->project_name = $input['project_name'];
        $project->position = $input['position'];
        $project->describe = $input['describe'];

        if ($project->save()) {
            $data['status'] = 200;
            $data['msg'] = "添加项目经历成功";
        } else {
            $data['status'] = 400;
            $data['msg'] = "添加项目经历失败";
        }
        return $data;
    }
    public static function getEducation() {
        return Education::where('uid', '=', AuthController::getUid())->get();
    }

    public static function getEgamexpr() {
        return Egamexpr::where('uid', '=', AuthController::getUid())->get();
    }
    public static function getWorkexp() {
        return Workexp::where('uid', '=', AuthController::getUid())->get();
    }
    public static function getProjectexp() {
        return Projectexp::where('uid', '=', AuthController::getUid())->get();
    }

    public function deleteEducation(Request $request) {
        $data = array();
        if (Education::find($request->input('eduid'))->delete()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
        }

        return $data;
    }

    public function deleteGame(Request $request) {
        $data = array();
        if (Egamexpr::find($request->input('id'))->delete()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
        }

        return $data;
    }
    public function deleteWorkexp(Request $request) {
        $data = array();
        if (Workexp::find($request->input('id'))->delete()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
        }

        return $data;
    }
    public function deleteProjectexp(Request $request) {
        $data = array();
        if (Projectexp::find($request->input('id'))->delete()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
        }

        return $data;
    }

//    public function updateEducation(Request $request) {
//        $input = $request->all();
//        $uid = AuthController::getUid();
//        $eduid = $input['eduid'];
//        $education = Education::find($eduid);
//        $education->uid = $uid;
//        $education->school = $input['school'];
//        $education->date = $input['date'];
//        $education->major = $input['major'];
//        $education->degree = $input['degree'];
//        if ($education->save()) {
//            return $education;
//        } else {
//            return "操作数据库失败";
//        }
//    }

    //添加技能
    public function addTag(Request $request) {
        $input = $request->all();
        $rid = $input['rid'];
        $tag = $input['skill'] . '|' . $input['level'];
        $skill = Resumes::where('rid', '=', $rid)
            ->select('skill')
            ->get();

        $data = array();

        $skill = $skill[0]['skill'];
        if ($skill == '[]') {
            $skill = '|@|' . $tag;
        } else {
            $skill = $skill . '|@|' . $tag;
        }

        $resume = Resumes::find($rid);
        $resume->skill = $skill;
        if ($resume->save()) {
            $data['status'] = 200;
            $data['skill'] = $resume->skill;
        } else {
            $data['status'] = 400;
            $data['msg'] = "新增技能特长失败";
        }

        return $data;
    }

    public function deleteTag(Request $request) {
        $data = array();

        $input = $request->all();
        $rid = $input['rid'];
        $string = $input['tag'];
        $skill = Resumes::where('rid', '=', $rid)
            ->select('skill')
            ->get();
        $skill = $skill[0]['skill'];

        $string = '|@|' . $string;
        $skill = str_replace($string, "", $skill);
        $resume = Resumes::find($rid);
        $resume->skill = $skill;
        if ($resume->save()) {
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
        }

        return $data;
    }

    //添加额外信息
    public function addExtra(Request $request) {
        $input = $request->all();
        $rid = $input['rid'];
        $resume = Resumes::find($rid);
        $resume->extra = $input['extra'];
        $data = array();
        if ($resume->save()) {
            $data['status'] = 200;
            $data['extra'] = $resume->extra;
        } else {
            $data['status'] = 400;
            $data['msg'] = "附加内容添加失败";
        }

        return $data;
    }

    //简历高级搜索|根据行业、地区、薪酬、类型信息查找对应的职位信息
    //其中，salary 1:<3k 2:3k>= & <5k 3:5k>= & <10k 4:10k>= & <15k 5:15k>= & <20k 6:20k>= & <25k 7:25k>= & <50k 8:>=50k
    public function advanceSearch(Request $request) {
        $data = array();
        //$data['position'] = Position::select('pid','eid','title','tag','pdescribe','salary','region','work_nature','occupation',)
        $orderBy = "view_count";
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
        if ($request->has('region')) $data['region'] = $request->input('region');
        if ($request->has('salary')) $data['salary'] = $request->input('salary');
        if ($request->has('work_nature')) $data['work_nature'] = $request->input('work_nature');
        if ($request->has('keyword')) $data['keyword'] = $request->input('keyword');

        //return $data;

        $data['position'] = DB::table('jobs_position')
            ->select('pid', 'title', 'ename','byname' ,'pdescribe')
            ->leftjoin('jobs_enprinfo', 'jobs_enprinfo.eid', '=', 'jobs_position.eid')
            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
//        $data['position'] = Position::where('vaildity', '>=', date('Y-m-d H-i-s'))
            ->where('position_status', '=', 1)
            ->where(function ($query) use ($request) {
                if ($request->has('industry')) {//行业
                    $query->where('jobs_position.industry', '=', $request->input('industry'));
                }
                if ($request->has('region')) {
                    $query->where('jobs_position.region', '=', $request->input('region'));
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
            ->paginate(15);
        return $data;
    }
    public function advanceIndex(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['industry'] = Industry::all();
        $data['region'] = Region::all();
        $data['result'] = $this->advanceSearch($request);

        $data['condition'] = $request->all();
        //return $data;
        return view('resume/advanceSearch', ['data' => $data]);
    }
    //获取待修改教育经历数据信息
    public function geteduinfo(Request $request){
        $data =array();
        if($request->has('eduid')){
            $data = Education::find($request->input('eduid'));
        }
        return $data;
    }
    //获取待修改工作经历数据信息
    public function getworkinfo(Request $request){
        $data =array();
        if($request->has('id')){
            $data = Workexp::find($request->input('id'));
        }
        return $data;
    }
    //获取待修改项目经历数据信息
    public function getprojectinfo(Request $request){
        $data =array();
        if($request->has('id')){
            $data = Projectexp::find($request->input('id'));
        }
        return $data;
    }
    //获取待修改电竞经历数据信息
    public function getegameinfo(Request $request){
        $data =array();
        if($request->has('egid')){
            $data = Egamexpr::find($request->input('egid'));
        }
        return $data;
    }
    public function test(){
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        return view('resume/index', ['data' => $data]);
    }

}
