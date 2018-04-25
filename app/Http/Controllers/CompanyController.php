<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Adverts;
use App\Company;
use App\Enprinfo;
use App\Industry;
use App\News;
use App\Occupation;
use App\Place;
use App\Position;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller {

    public function companySearch(Request $request) {
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        if($request->has('type')){//是否入驻公司1、是0 否
            $data['is_join'] = $request->input('type');
        }else{
            $data['is_join'] = 1;
        }

        $data['position'] = null;
        if($data['is_join'] == 1){//入驻公司
            if ($request->has('eid')) {
                $eid = $request->input('eid');
                $data['position'] = DB::table('jobs_position')
                    ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
                    ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.created_at')
                    ->where('jobs_position.eid', $eid)
//                ->where('vaildity', '>=', date('Y-m-d H-i-s'))
                    ->where(function ($query){
                        $query->where('position_status',1)
                            ->orwhere('position_status',4);
                    })
                    ->orderBy('jobs_position.created_at','desc')
                    ->paginate(9);

                $data['enprinfo'] = Enprinfo::find($eid);
                $data['industry'] = Industry::all();
                //搜索企业标签--发布职位的所有标签和
                $data['tag'] = array();
                foreach ($data['position'] as $position){
                    foreach (preg_split("/(,| |、|;)/",$position->tag) as $tag){
                        if(!in_array($tag,$data['tag'])){
                            $data['tag'][] = $tag;
                        }
                    }
                }
            }
        }else{
            $data['source'] = 1;
            $id = $request->input('id');
            $data['enprinfo'] = Company::find($id);
            $data['industry'] = Industry::all();
            $data['tag'] = array();
        }

        $data['enprinfo']->ebrief = str_replace(array("\r\n", "\r", "\n"), "<br>",$data['enprinfo']->ebrief);
//        return $data;
        return view('company.company', ['data' => $data]);
    }

    public function companyIndex(Request $request){
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['industry'] = Industry::all();

        $data['result'] = $this->advanceSearch($request);

        $data['condition'] = $request->all();
//        return $data;
        return view('company/advanceSearch', ['data' => $data]);
    }
    public function advanceSearch(Request $request) {
        $data = array();

        if ($request->has('industry')) $data['industry'] = $request->input('industry');
        if ($request->has('enature')) $data['enature'] = $request->input('enature');
        if ($request->has('escale')) $data['escale'] = $request->input('escale');
        if ($request->has('keyword')) $data['keyword'] = $request->input('keyword');

        //return $data;

        $data['companyinfo'] = Company::select('id','eid','ename','byname','elogo','ebrief','escale','enature','industry','type')
            ->where('is_verification','1')
            ->where('ename','!=','')
            ->where('byname','!=','')
            ->where(function ($query) use ($request) {
                if ($request->has('industry')) {//行业
                    $query->where('industry',$request->input('industry'));
                }
                if ($request->has('enature')) {//性质
                    $query->where('enature', $request->input('enature'));
                }
                if ($request->has('escale')) {//规模
                    $query->where('escale', '=', $request->input('escale'));
                }
                //未加入对公司名称以及公司别名的搜索
                if ($request->has('keyword')) {
                    $keyword = $request->input('keyword');
                    $query->where('ename', 'like', '%' . $keyword . '%')
                        ->orWhere(function ($query) use ($keyword) {
                            $query->where('byname', 'like', '%' . $keyword . '%');
                        });
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return $data;
    }

    public function addIndex(Request $request){
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['industry'] = Industry::all();

        if($data['uid'] == 0){
            return view('account.login');
        }

//        return $data;
        return view('company/upload', ['data' => $data]);
    }
    public function addPost(Request $request){
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        if ($data['uid'] == 0) {//用户未登陆
            $data['status'] = 400;
            $data['msg'] = "请先登陆再进行操作";
            return $data;
        }
        //上传头像;
        $companyinfo = new Company();

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
                    $companyinfo->elogo = asset('storage/profiles/' . $filename);
                }
            }
        }
        if($request->has('byname')) $companyinfo->byname = $request->input('byname');
        if($request->has('ename')) $companyinfo->ename = $request->input('ename');
        if($request->has('ebrief')) $companyinfo->ebrief = $request->input('ebrief');
        if($request->has('escale')) $companyinfo->escale = $request->input('escale');
        if($request->has('enature')) $companyinfo->enature = $request->input('enature');
        if($request->has('industry')) $companyinfo->industry = $request->input('industry');
        if($request->has('home_page')) $companyinfo->home_page = $request->input('home_page');
        if($request->has('address')) $companyinfo->address = $request->input('address');
        $companyinfo->uid = $data['uid'];
        $companyinfo->author = $data['username']['username'];


        if ($companyinfo->save()) {
            $data['status'] = 200;
            $data['msg'] = "操作成功";
        } else {
            $data['status'] = 400;
            $data['msg'] = "操作失败";
        }

        return $data;
    }
}
