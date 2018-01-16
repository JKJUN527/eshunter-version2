<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Adverts;
use App\Education;
use App\Egamexpr;
use App\Http\Controllers\Controller;
use App\Intention;
use App\Personinfo;
use App\Projectexp;
use App\Resumes;
use App\User;
use App\Workexp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResumesController extends Controller {
    //显示已创建的临时简历
    public function index(){
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');
        $data = DashboardController::getLoginInfo();

//        $data['tempresumes'] = User::where('username','tempresume_admin')->get();
        $data['tempresumes'] = DB::table('jobs_users')
            ->select('jobs_users.uid','username','jobs_users.mail','pname','resume_name')
            ->leftjoin('jobs_personinfo','jobs_personinfo.uid','jobs_users.uid')
            ->leftjoin('jobs_resumes','jobs_resumes.uid','jobs_users.uid')
            ->where('username','tempresume_admin')
            ->orderBy('jobs_resumes.created_at','desc')
            ->paginate(20);

        return view('admin.resumes',['data'=>$data]);
    }
    public function addIndex(){
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');
        $data = DashboardController::getLoginInfo();

        return view('admin.addResume',['data'=>$data]);
    }
    /**
     * 删除临时简历信息
     * 删除信息包括所有和user相关联表
     * 传入UID
     */
    public function delResume(Request $request){
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');
        $data['status'] =400;
        $data['msg'] = "参数错误";
        if($request->has('uid')){
            $data['msg'] = "删除失败";
            $temp_uid = $request->input('uid');
            $user = User::find($temp_uid);
            if($user){
                //删除工作经历
                $workexps = Workexp::where('uid',$user->uid)->get();
                foreach ($workexps as $work){
                    $delwork = Workexp::find($work->id);
                    $bool = $delwork->delete();
                }
                //删除项目经历
                $proexps = Projectexp::where('uid',$user->uid)->get();
                foreach ($proexps as $project){
                    $delproject = Projectexp::find($project->id);
                    $bool = $delproject->delete();
                }
                //删除电竞经历
                $gameexps = Egamexpr::where('uid',$user->uid)->get();
                foreach ($gameexps as $egame){
                    $delegame = Egamexpr::find($egame->id);
                    $bool = $delegame->delete();
                }
                //删除教育经历
                $educationexps = Education::where('uid',$user->uid)->get();
                foreach ($educationexps as $education){
                    $deleducation = Education::find($education->id);
                    $bool = $deleducation->delete();
                }
                //删除求职意向
                $intentions = Intention::where('uid',$user->uid)->get();
                foreach ($intentions as $intention){
                    $delintention = Intention::find($intention->inid);
                    $bool = $delintention->delete();
                }
                //删除个人信息
                $personinfo = Personinfo::where('uid',$user->uid)->first();
                $delperson = Personinfo::find($personinfo->pid);
                $delperson->delete();
                //删除登录信息
                $bool = $user->delete();
                if($bool){
                    $data['status'] =200;
                    $data['msg'] = "删除成功";
                }
            }
        }
        return $data;
    }

    /**
     * @param Request $request
     * 新增简历
     * 包括新增用户登录信息表 user
     * 新增用户信息表  userinfo
     * 新增简历表 resume
     * 新增求职意向表 intention
     */
    public function addtempresume(Request $request){
        $data = array();
        //注册临时用户信息
        //检查该邮箱是否已经被注册
        if($request->has('mail') && $request->has('pname') &&$request->has('title')) {
            $isexist = User::where('mail', '=', $request->input('mail'))->get();
            if ($isexist->count()) {
                $data['status'] = 400;
                $data['msg'] = "该用户已注册！请直接登录";
                return $data;
            }
            $username = "tempresume_admin";
            $password = "admin123456";
            $user = new User();
            $user->mail = $request->input('mail');
            $user->password = bcrypt($password);
            $user->type = 1;
            $user->username = $username;
            $user->email_vertify = 1;
            if ($user->save()) {
                $perinfo = new Personinfo();
                $perinfo->uid = $user->uid;
                $perinfo->pname = $request->input('pname');
                $perinfo->register_way = 1;
                $perinfo->save();
            }else{
                $data['status'] = 400;
                $data['msg'] = "临时用户添加失败";
                return $data;
            }

            //创建临时简历
            $resume = new Resumes();
            $resume->uid = $user->uid;
            $resume->resume_name = $request->input('title');
            $count = Resumes::where('uid', '=', $user->uid)->count();       //ORM聚合函数的用法
            if ($count > 2) {
                $data['status'] = 400;
                $data['msg'] = "简历数大于上限";
                return $data;
            } else {
                $resume->save();
                $intention = new Intention();
                $intention->rid = $resume->rid;
                $intention->uid = $user->uid;
                $intention->work_nature = -1;
                $intention->occupation = -1;
                $intention->industry = -1;
                $intention->region = -1;
                $intention->salary = -1;
                $intention->save();

                $data['status'] = 200;
                $data['rid'] = $resume->rid;
            }
            return $data;
        }
        return $data;
    }

}
