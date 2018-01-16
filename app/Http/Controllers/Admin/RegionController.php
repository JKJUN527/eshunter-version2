<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Region;
use Illuminate\Http\Request;

class RegionController extends Controller {

    //显示已添加地区
    public function index() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');

        $data = DashboardController::getLoginInfo();
        $data['region'] = Region::all();
        //return $data;
        return view('admin/region', ['data' => $data]);
    }
    //删除、添加地区
    //添加传入region[name],删除传入rid
    public function edit(Request $request, $option) {
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }

        $resultData = array();

        switch ($option) {
            case 'add':
                if ($request->has('name')) {
                    $name = $request->input('name');

                    $region = new Region();
                    $region->name = $name;

                    if ($region->save()) {
                        $resultData['status'] = 200;
                    } else {
                        $resultData['status'] = 400;
                        $resultData['msg'] = "添加失败";
                    }
                }
                break;
            case 'addcity':
                if ($request->has('name') && $request->has('parent_id')) {
                    $name = $request->input('name');
                    $parent_id = $request->input('parent_id');

                    $region = new Region();
                    $region->name = $name;
                    $region->parent_id = $parent_id;

                    if ($region->save()) {
                        $resultData['status'] = 200;
                    } else {
                        $resultData['status'] = 400;
                        $resultData['msg'] = "添加失败";
                    }
                }
                break;
            case 'delete':
                if ($request->has('rid')) {
                    $data = $request->input('rid');

                    $del = Region::find($data);
                    $bool = $del->delete();

                    if ($bool) {
                        $resultData['status'] = 200;
                    } else {
                        $resultData['status'] = 400;
                        $resultData['msg'] = "删除失败";
                    }
                }
                break;
            default:
                $resultData['status'] = 400;
                $resultData['msg'] = "无效操作";
                break;
        }

        return $resultData;
    }
}
