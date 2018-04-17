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

class CompanyController extends Controller {

    public function companySearch(Request $request) {
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        if($request->has('type')){//是否入驻公司1、是0 否
            $data['is_join'] = $request->input('type');
        }else{
            $data['is_join'] = 0;
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
            $data['enprinfo'] = Company::find(1);
            $data['industry'] = Industry::all();
            $data['tag'] = array();
        }

        $data['enprinfo']->ebrief = str_replace(array("\r\n", "\r", "\n"), "<br>",$data['enprinfo']->ebrief);
//        return $data;
        return view('company', ['data' => $data]);
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

        $data['companyinfo'] = Company::select('eid','ename','byname','elogo','ebrief','escale','enature','industry','type')
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
}
