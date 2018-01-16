<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditnewsController extends Controller {
    //显示已发布广告,传入pagesize(每页大小)
    //返回data['news']
    public function index(Request $request) {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');
        $data = DashboardController::getLoginInfo();
        $data['news'] = News::orderBy('updated_at', 'desc')
            ->paginate(20);

        return view('admin.news', ['data' => $data]);
    }

    //根据新闻id 返回每个具体的新闻详情
    public function detail(Request $request) {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        if ($request->has('nid')) {
            $nid = $request->input('nid');
        } else
            $nid = 1;
        $data['new'] = News::find($nid);

        return $data;
    }

    public function addNewsView() {
        return view('admin.addNews', ['data' => DashboardController::getLoginInfo()]);
    }

    //发布新闻以及修改已发布新闻
    //如果传入新闻id，则表示修改新闻，否则新增新闻。
    public function addNews(Request $request) {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        if ($request->has('nid')) {
            $new = News::find('nid');//修改已有新闻
        } else {
            $new = new News();//新增新闻
        }

        //接收参数
        $picture = $request->input('pictureIndex');
        if($picture != ""){
            $pictures = explode('@', $picture);
            $picfilepath = "";
            foreach ($pictures as $Item) {//对每一个照片进行操作。

                $pic = $request->file('pic' . $Item);//取得上传文件信息
                if ($pic->isValid()) {//判断文件是否上传成功
                    //取得原文件名
                    $originalName1 = $pic->getClientOriginalName();
                    //扩展名
                    $ext1 = $pic->getClientOriginalExtension();
                    //mimetype
                    $type1 = $pic->getClientMimeType();
                    //临时觉得路径
                    $realPath = $pic->getRealPath();
                    //生成文件名
                    $picname = date('Y-m-d-H-i-s') . '-' . uniqid() . 'news' . $Item . '.' . $ext1;

                    $picfilepath = $picfilepath . $Item . '@' . $picname . ';';
                    $bool = Storage::disk('newspic')->put($picname, file_get_contents($realPath));
                    $new->picture = asset('storage/newspic/' . $picfilepath);
                }
            }
        }
        //保存都数据库
        $new->title = $request->input('title');
        $new->subtitle = $request->input('subtitle');
        $new->uid = $uid;//uid 后期通过登录注册方法获取
        $new->quote = $request->input('quote');
        $new->type = $request->input('newtype');
        $new->content = $request->input('content');
        $new->tag = $request->input('tag');
        if ($new->save()) {
            $data['status'] = 200;
            $data['msg'] = "操作成功";
            return $data;
        } else {
            $data['status'] = 400;
            $data['msg'] = "操作失败";
            return $data;
        }
    }

    function delNews(Request $request) {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }

        if ($request->has('id')) {
            $nid = $request->input('id');
            News::where('nid', '=', $nid)
                ->delete();
            $data['status'] = 200;
        } else {
            $data['status'] = 200;
            $data['msg'] = "删除失败";
        }

        return $data;
    }

}
