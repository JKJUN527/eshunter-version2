<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Industry;
use App\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller {
    //显示已添加职业
    public function index() {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        $data['occupation'] = Occupation::all();
        return $data;
    }

    public function getAll() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        $data = array();
        $data['industry'] = Industry::all();
        return $data;
    }
    //删除、添加职业
    //添加传入occupation[name,industry_id],删除传入oid
    public function edit(Request $request, $option) {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }

        switch ($option) {
            case 'add':
                //return 'add';
                if ($request->has('name')) {
                    $name = $request->input('name');
                    $industry_id = $request->input('industry_id');

                    $occupation = new Occupation();
                    $occupation->name = $name;
                    $occupation->industry_id = $industry_id;

                    if ($occupation->save()) {
                        $data['status'] = 200;
                    } else {
                        $data['status'] = 400;
                        $data['msg'] = "添加失败";
                    }
                }
                break;
            case 'delete':
                //return 'delete';
                if ($request->has('id')) {
                    $oid = $request->input('id');

                    $del = Occupation::find($oid);

                    if ($del->delete()) {
                        $data['status'] = 200;
                    } else {
                        $data['status'] = 400;
                        $data['msg'] = "删除失败";
                    }
                }
                break;
            default:
                $data['status'] = 400;
                $data['msg'] = "操作命令未知";
                break;

        }

        return $data;
    }
}
