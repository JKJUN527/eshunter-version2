<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Adverts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertsController extends Controller {
    //显示已发布广告
    //如果传入显示广告type，则按type返回
//    public function __construct()
//    {
//        $uid = AdminAuthController::getUid();
//        if($uid == 0){
//            return redirect('admin/login');
//        }
//    }
    public function index(Request $request) {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');

        $data = DashboardController::getLoginInfo();
        if ($request->has('type')) {
            $type = $request->input('type');
            $data['adlist'] = Adverts::where('type', '=', $type)
                ->orderBy('updated_at', 'desc')
                ->paginate(20);
        } else {
            $data['adlist'] = Adverts::orderBy('updated_at', 'desc')
                ->paginate(20);
        }

        //return $data;
        return view('admin.ads', ['data' => $data]);
    }

    //根据广告id 返回每个具体的广告详情
    public function detail(Request $request) {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        if ($request->has('adid')) {
            $adid = $request->input('adid');
        } else
            $adid = 1;

        $data['advert'] = Adverts::find($adid);

        return $data;
    }
    //发布广告、以及修改广告
    //如果传入广告id，则修改对应广告
    //广告信息域用adsinfo  \ 广告图片域adpic
    public function addAds(Request $request) {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        if ($request->has('adid')) {
            $ad = Adverts::find('adid');//修改已有广告
        } else {
            $ad = new Adverts();//新增广告
        }
        //验证该广告位是否已发布广告，且在有效期内
        $isexist = Adverts::where('type', $request->input('type'))
            ->where('location', $request->input('location'))
            ->where('validity', '>=', date('Y-m-d H-i-s'))
            ->get();
        if ($isexist->count()) {
            $data['status'] = 400;
            $data['msg'] = "该广告位已存在广告，删除后才能进行添加";
            return $data;
        }
        //接收参数
//        $data = $request->input('adsinfo');//接收广告除图片之外的信息。

        if ($request->input('type') == 0 || $request->input('type') == 1) {//大图和小图广告\图片上传
            if ($request->hasFile('adpic')) {
                $adpic = $request->file('adpic');//取得上传文件信息
                if ($adpic->isValid()) {//判断文件是否上传成功
                    //取得原文件名
                    $originalName = $adpic->getClientOriginalName();
                    //扩展名
                    $ext = $adpic->getClientOriginalExtension();
                    //mimetype
                    $type = $adpic->getClientMimeType();
                    //临时觉得路径
                    $realPath = $adpic->getRealPath();
                    //生成文件名
                    $picname = date('Y-m-d-H-i-s') . '-' . uniqid() . 'adpic' . '.' . $ext;

                    $bool = Storage::disk('adpic')->put($picname, file_get_contents($realPath));

                    $ad->picture = asset('storage/adpic/' . $picname);

                }
            } else {
                $data['status'] = 400;
                $data['msg'] = "发布该广告需上传图片";
                return $data;
            }
        }
        //ad信息保存到数据库
        $ad->uid = $uid;//从登陆验证接口获取
        $ad->title = $request->input('title');
        $ad->eid = $request->input('eid');
        $ad->content = $request->input('content');
        $ad->type = $request->input('type');
        $ad->location = $request->input('location');
        $ad->homepage = $request->input('homepage');
        $ad->validity = $request->input('validity');

        if ($ad->save()) {
            $data['status'] = 200;
            $data['msg'] = "新增成功";
            return $data;
//            return redirect()->back()->with('success','新增广告成功');
        }
        $data['status'] = 400;
        $data['msg'] = "新增失败";
        return $data;
    }
    //通过location查找该位置是否已有广告
    //传入type location
    public function findAd(Request $request) {
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        if ($request->has('location') && $request->has('type')) {
            $location = $request->input('location');
            $type = $request->input('type');
            $isexist = Adverts::where('type', $type)
                ->where('location', $location)
                ->where('validity', '>=', date('Y-m-d H-i-s'))
                ->get();
            if ($isexist->count()) {
                $data['status'] = 401;
                $data['msg'] = "该广告位已存在广告，删除后才能进行添加";
                return $data;
            } else {
                $data['status'] = 200;
                $data['msg'] = "广告位空闲";
                return $data;
            }
        }
        $data['status'] = 400;
        $data['msg'] = "查询参数错误";
        return $data;
//        return redirect()->back()->with('success','该位置暂无广告');
    }
    //删除广告位置.
    //传入type,通过location,或者adid删除
    public function delAd(Request $request) {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        // 什么意思？没看懂
//        if ($request->has('type')) {
//            $type = $request->input('type');
//            if ($request->has('location')) {
//                $location = $request->input('location');
//                $ad = Adverts::where('location', '=', $location)
//                    ->where('type', '=', $type)
//                    ->delete();
//            } else if ($request->has('adid')) {
//                $adid = $request->input('adid');
//                $ad = Adverts::where('adid', '=', $adid)
//                    ->where('type', '=', $type)
//                    ->delete();
//            }
//            $data['status'] = 200;
//            $data['msg'] = "删除成功";
//            return $data;
//        }

        // 重写：
        if ($request->has('type') && $request->has('location')) {
            $type = $request->input('type');
            $location = $request->input('location');
            Adverts::where('location', '=', $location)
                ->where('type', '=', $type)
                ->delete();
            $data['status'] = 200;
        } else if ($request->has('id')) {
            $adid = $request->input('id');
            Adverts::where('adid', '=', $adid)
                    ->delete();
            $data['status'] = 200;
        } else {
            $data['status'] = 400;
            $data['msg'] = "删除失败";
        }
        return $data;
    }

    public function addAdView() {
        return view('admin.addAds', ['data' => DashboardController::getLoginInfo()]);
    }
}
