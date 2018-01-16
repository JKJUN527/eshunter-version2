<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Egame;
use App\Egrade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EgradeController extends Controller {
    //显示已添加职业
    public function index() {
        $data = array();
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        $data['egrade'] = Egrade::all();
        return $data;
    }

    public function getAll() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }
        $data = array();
        $data['egame'] = Egame::all();
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
                    $egame_id = $request->input('egame_id');

                    $egrade = new Egrade();
                    $egrade->name = $name;
                    $egrade->egame_id = $egame_id;

                    if ($egrade->save()) {
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

                    $del = Egrade::find($oid);

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
