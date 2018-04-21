<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Adverts;
use App\Company;
use App\Education;
use App\Egamexpr;
use App\Http\Controllers\Controller;
use App\Industry;
use App\Intention;
use App\Personinfo;
use App\Projectexp;
use App\Resumes;
use App\User;
use App\Workexp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanysController extends Controller {
    //显示已创建的临时简历
    public function index(){
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');
        $data = DashboardController::getLoginInfo();

        $data['companys'] = DB::table('jobs_companyinfo')
            ->select('jobs_companyinfo.id','ename','byname','jobs_industry.name as industry','enature','escale','is_verification','type')
            ->leftjoin('jobs_industry','jobs_industry.id','jobs_companyinfo.industry')
            ->orderBy('jobs_companyinfo.created_at','desc')
            ->paginate(20);
//        return $data;
        return view('admin.companys',['data'=>$data]);
    }
    public function addIndex(){
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');
        $data = DashboardController::getLoginInfo();
        $data['industry'] = Industry::all();

        return view('admin.addCompany',['data'=>$data]);
    }
    /**
     * 删除临时简历信息
     * 删除信息包括所有和user相关联表
     * 传入UID
     */
    public function delCompany(Request $request){
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');
        $data['status'] =400;
        $data['msg'] = "参数错误";
        if($request->has('id')){
            $data['msg'] = "删除失败";
            $id = $request->input('id');
            $company = Company::find($id);
            $bool = $company->delete();
            if($bool){
                $data['status'] =200;
                $data['msg'] = "删除成功";
            }
        }
        return $data;
    }

    public function addcompany(Request $request){
        $data = array();
        $companyinfo = new Company();
        if ($request->hasFile('logo')) {
            $adpic = $request->file('logo');//取得上传文件信息
            if ($adpic->isValid()) {//判断文件是否上传成功
                //扩展名
                $ext = $adpic->getClientOriginalExtension();
                //临时觉得路径
                $realPath = $adpic->getRealPath();
                //生成文件名
                $picname = date('Y-m-d-H-i-s') . '-' . uniqid() . 'elogo' . '.' . $ext;
                $bool = Storage::disk('profile')->put($picname, file_get_contents($realPath));

                $companyinfo->elogo = asset('storage/profiles/' . $picname);
            }

            //保存其他信息
            $companyinfo->ename = $request->input('ename');
            $companyinfo->byname = $request->input('byname');
            $companyinfo->industry = $request->input('industry');
            $companyinfo->escale = $request->input('escale');
            $companyinfo->enature = $request->input('enature');
            $companyinfo->ebrief = $request->input('ebrief');
            $companyinfo->address = $request->input('address');
            $companyinfo->home_page = $request->input('home_page');
            $companyinfo->author = "系统管理员";

            $companyinfo->save();
            $data['status'] = 200;
            $data['msg'] = "新增成功";
            return $data;
        } else {
            $data['status'] = 400;
            $data['msg'] = "需上传企业logo";
            return $data;
        }
    }

    public function passCompany(Request $request){
        $data = array();
        $data['status'] = 400;
        $data['msg'] = "未知错误";
        if($request->has('id')){
            $id = $request->input('id');
            $companyinfo = Company::find($id);
            if($companyinfo){
                if($companyinfo->is_verification == -1) $companyinfo->is_verification = 1;
                else $companyinfo->is_verification = -1;
                if($companyinfo->save()){
                    $data['status'] = 200;
                    $data['mag'] = "审核成功";
                }
            }else{
                $data['msg'] = "未查询到相关公司信息";
            }
        }
        return $data;
    }

}
