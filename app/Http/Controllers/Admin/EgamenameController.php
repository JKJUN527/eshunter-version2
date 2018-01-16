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

class EgamenameController extends Controller {
    //显示已添加游戏及段位
    public function index() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');

        $data = DashboardController::getLoginInfo();
        $data['egame'] = Egame::all();
        $data['egrade'] = Egrade::all();
        return view('admin.egame', ['data' => $data]);
    }

    //删除、添加行业
    //添加传入industry[name],删除传入inid
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
                    $egame = new Egame();
                    $egame->name = $name;

                    if ($egame->save()) {
                        $data['status'] = 200;
                    } else {
                        $resultData['status'] = 400;
                        $resultData['msg'] = "添加失败";
                    }
                }
                break;
            case 'delete':
                //return 'delete';
                if ($request->has('id')) {
                    $id = $request->input('id');

                    $delegame = Egame::find($id);
                    $bool = $delegame->delete();

                    $delegrade = Egrade::where('egame_id',$id)->delete();

                    if ($bool) {
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
