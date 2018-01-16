<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers;

use App\News;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller {
    public function index() {
        $data['type'] = AuthController::getType();
        return view('news/index');
    }

    //根据post的新闻id，返回新闻详情
    public function detail(Request $request) {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();

        if ($request->has('nid')) {
            $nid = $request->input('nid');

            $news = News::find($nid);
            $data['news'] = $news;
            $news->view_count += 1;//浏览次数加1
            $news->save();

            $data['review'] = DB::table('jobs_users')
                ->select('jobs_newsreview.uid', 'username', 'type' ,'photo','elogo','content', 'jobs_newsreview.created_at')
                ->leftjoin('jobs_enprinfo', 'jobs_enprinfo.uid', '=', 'jobs_users.uid')
                ->leftjoin('jobs_personinfo', 'jobs_personinfo.uid', '=', 'jobs_users.uid')
                ->rightjoin('jobs_newsreview','jobs_newsreview.uid','=','jobs_users.uid')
                ->where('nid', '=', $nid)
                ->where('is_valid', '=', 1)
                ->orderBy('jobs_newsreview.created_at', 'desc')
                ->paginate(10);//默认显示10条评论
        }

//        return $data;
        return view('news/detail', ['data' => $data]);
    }

    public function requestNewsContent(Request $request) {
        $data = array();
        if ($request->has('nid')) {
            $nid = $request->input('nid');
            $data['news'] = News::find($nid);
        } else {
            $data['news'] = null;
        }

        return $data;
    }

    //资讯中心页面、返回最新及最热门新闻,输入
    //返回值：data[]
    public function SearchNews(Request $request, $pagnum = 9) {
        $data = array();
        if($request->has('newtype')){
            $type = $request->input('newtype');
        }else{
            $type = 1;//默认搜索综合电竞新闻
        }
        $data['newtype'] = $type;
        $data['newest'] = NewsController::searchNewest($pagnum,$type);//最新新闻
        $data['hottest'] = NewsController::searchHottest($type);//最热新闻
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        //return $data;
        return view('news.index', ['data' => $data]);
    }

    public function searchNewest($num,$type) {
        $data = array();
        $data = News::where('type',$type)
            ->orderBy('created_at', 'desc')
            ->paginate($num);
        return $data;
    }

    public function searchHottest($type) {
        //取6条最热新闻
        $data = array();
        $data = News::where('type',$type)
            ->orderBy('view_count', 'desc')
            ->take(6)
            ->get();
        return $data;
    }

    public function addReview(Request $request) {
        $data = array();
        $data['status'] = 400;
        $data['msg'] = "未登录用户不能进行评论操作";

        $uid = AuthController::getUid();

        if ($uid == 0)
            return $data;

        if (!$request->has('nid') || !$request->has('content')) {
            $data['msg'] = "参数错误";
            return $data;
        }

        $input = $request->all();
        $num = Review::where('uid',$uid)->where('nid',(int)$input['nid'])->get();
        if($num->count() >3){
            $data['status'] = 400;
            $data["msg"] = "你对该新闻的评论次数已达上限";
            return $data;
        }
        $addReview = new Review();
        $addReview->uid = $uid;
        $addReview->nid = (int)$input['nid'];
        $addReview->content = $input['content'];

        if ($addReview->save()) {
            $data['status'] = 200;
            $data["msg"] = "评论成功";
        } else {
            $data['msg'] = "评论失败";
        }

        return $data;
    }
}
