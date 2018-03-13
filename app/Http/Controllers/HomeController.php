<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\Adverts;
use App\Enprinfo;
use App\Industry;
use App\News;
use App\Occupation;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
    public function index() {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $data['ad'] = HomeController::searchAd();
        $data['position'] = HomeController::searchPosition();//搜索急聘职位
        //搜索最新职位
        $data['newestposition'] = HomeController::searchNewestPosition();
        $data['news'] = HomeController::searchNews();
        $data['industry'] = Industry::all();
        $data['occupation'] = Occupation::orderBy('updated_at','desc')->get();

//        return $data;
        return view('index', ["data" => $data]);
    }

    public function searchAd() {
        $data = array();//用以存放最终返回页面数组
        //查询广告,根据广告location倒序，符合有效期返回，大图6个，小图9个，文字21个
        $ad0 = Adverts::where('validity', '>=', date('Y-m-d H-i-s'))
            ->where('type', '=', '0')
            ->where('location', '<=', 15)
            ->orderBy('location', 'asc')
            ->take(10)
            ->get();
//        $ad00 = Adverts::where('validity', '>=', date('Y-m-d H-i-s'))
//            ->where('type', '=', '0')
//            ->where('location', '>=', 13)
//            ->orderBy('location', 'asc')
//            ->take(35)
//            ->get();
        $ad1 = Adverts::where('validity', '>=', date('Y-m-d H-i-s'))
            ->where('type', '=', '1')
            ->orderBy('location', 'asc')
            ->take(15)
            ->get();
//        $ad2 = Adverts::where('validity', '>=', date('Y-m-d H-i-s'))
//            ->where('type', '=', '2')
//            ->orderBy('location', 'asc')
//            ->take(21)
//            ->get();
        $adnum = Adverts::where('validity', '>=', date('Y-m-d H-i-s'))
            ->count();
        //return $adnum;
        $data['ad0'] = $ad0;
//        $data['ad00'] = $ad00;
        $data['ad1'] = $ad1;
//        $data['ad2'] = $ad2;
        $data['adnum'] = $adnum;//有效期内，所有广告数量
        return $data;
    }
    public function searchNewestPosition(){
        $data = array();
        //搜索急聘职位信息（急聘和热门不一样）
        $position = DB::table('jobs_position')
            ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
            ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.created_at')
            ->where(function ($query){
                $query->where('position_status',1)
                    ->orwhere('position_status',4);
            })
            ->orderBy('jobs_position.created_at', 'desc')//最新程度
            ->take(6)
            ->get();
        $data['position'] = $position;
        return $data;
    }
    public function searchPosition() {
        $data = array();
        //搜索急聘职位信息（急聘和热门不一样）
        $position = DB::table('jobs_position')
            ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
            ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.created_at')
            //            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
            ->where(function ($query){//职位状态
                $query->where('position_status',1)
                    ->orwhere('position_status',4);
            })
            ->where('is_urgency', '=', 1)//职位是急聘状态
            ->orderBy('view_count', 'desc')//热门程度
            ->take(6)
            ->get();
//        $position = Position::where('vaildity', '>=', date('Y-m-d H-i-s'))
//            ->where('position_status', '=', 1)//职位状态
//            ->where('is_urgency', '=', 1)//职位是急聘状态
//            ->orderBy('view_count', 'desc')//热门程度
//            ->take(12)
//            ->get();
        $num = Position::where(function ($query){
            $query->where('position_status',1)
                ->orwhere('position_status',4);
            })//职位状态
//            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
            ->count();
        $data['position'] = $position;
        $data['num'] = $num;
        return $data;
    }

    public function searchNews() {
        $data = array();
        //搜索最新新闻信息5条
        $new = News::orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $data['news'] = $new;
        return $data;
    }
    //主页搜索功能，传入keywords返回关键字匹配的新闻及position相关数据。
    //返回值：data['news']--搜索到的新闻信息
    //      data['position']--搜索到的职位信息
    public function indexSearch(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        $news = array();
        $position = array();
        //主页搜索功能，传入keywords返回关键字匹配的新闻及position相关数据。

        $keywords = "";
        //不能搜索公司
        if ($request->has('keyword')) {
            //if ($request->isMethod('POST')) {
            if ($request->isMethod('GET')) {
                $keywords = $request->input('keyword');
                //$keywords = 'lol';
                //$num = $request->input('num');
                $news = News::where('content', 'like', '%' . $keywords . '%')
                    ->orWhere('title', 'like', '%' . $keywords . '%')
                    ->orWhere('subtitle', 'like', '%' . $keywords . '%')
                    //->paginate($num);
                    ->get();

//                $position = Position::where('vaildity', '>=', date('Y-m-d H-i-s'))
////                    ->where('position_status', 1)
//                    ->where(function ($query){
//                        $query->where('position_status',1)
//                            ->orwhere('position_status',4);
//                    })
//                    ->where(function ($query) use ($keywords) {
//                        $query->orwhere('title', 'like', '%' . $keywords . '%')
//                            ->orwhere('pdescribe', 'like', '%' . $keywords . '%')
//                            ->orwhere('experience', 'like', '%' . $keywords . '%');
//                    })
//                    ->get();
                $position = DB::table('jobs_position')
                    ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
                    ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.created_at')
                    //            ->where('vaildity', '>=', date('Y-m-d H-i-s'))
                    ->where(function ($query){//职位状态
                        $query->where('position_status',1)
                            ->orwhere('position_status',4);
                    })
                    ->where(function ($query) use ($keywords) {
                        $query->orwhere('title', 'like', '%' . $keywords . '%')
                            ->orwhere('pdescribe', 'like', '%' . $keywords . '%')
                            ->orwhere('experience', 'like', '%' . $keywords . '%');
                    })
                    ->orderBy('view_count', 'desc')//热门程度
                    ->get();
            }
        }
        // ly:添加返回搜索的关键字
        $searchResult['keyword'] = $keywords;
        $searchResult['news'] = $news;
        $searchResult['position'] = $position;

        // ly:返回首页搜索结果页面
//        return $searchResult;
        return view('search', [
            "data" => $data,
            "searchResult" => $searchResult
        ]);
    }

    public function companySearch(Request $request) {
        $data = array();

        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['position'] = null;

        if ($request->has('eid')) {
            $eid = $request->input('eid');
            $data['position'] = DB::table('jobs_position')
                ->leftjoin('jobs_enprinfo', 'jobs_position.eid', '=', 'jobs_enprinfo.eid')
                ->select('pid', 'title','tag','salary','salary_max','work_nature','education','jobs_enprinfo.eid','ename','elogo', 'byname','ebrief','jobs_position.updated_at')
                ->where('jobs_position.eid', $eid)
//                ->where('vaildity', '>=', date('Y-m-d H-i-s'))
                ->where(function ($query){
                    $query->where('position_status',1)
                        ->orwhere('position_status',4);
                })
                ->orderBy('jobs_position.updated_at','desc')
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
        $data['enprinfo']->ebrief = str_replace(array("\r\n", "\r", "\n"), "<br>",$data['enprinfo']->ebrief);
//        return $data;
        return view('company', ['data' => $data]);
    }
}
