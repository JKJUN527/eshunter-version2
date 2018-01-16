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

class IndustryController extends Controller {
    //显示已添加行业
    public function index() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');

        $data = DashboardController::getLoginInfo();
        $data['industry'] = Industry::all();
        $data['occupation'] = Occupation::all();
        return view('admin.industry', ['data' => $data]);
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
                    $industry = new Industry();
                    $industry->name = $name;

                    if ($industry->save()) {
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

                    $del = Industry::find($id);
                    $bool = $del->delete();

                    $delocc = Occupation::where('industry_id',$id)->delete();

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
