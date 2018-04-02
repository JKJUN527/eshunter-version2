<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */

namespace App\Http\Controllers\Admin;

use App\Gameposition;
use App\Http\Controllers\Controller;
use App\Occupation;
use App\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GamePositionController extends Controller {

    //显示已添加选手位置
    public function index() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');

        $data = DashboardController::getLoginInfo();
        $data['gameposition'] = DB::table('jobs_gamingposition')
            ->leftjoin('jobs_occupation','jobs_gamingposition.occupation_id','jobs_occupation.id')
            ->select('jobs_gamingposition.id','jobs_occupation.name as occ_name','jobs_gamingposition.name')
            ->orderby('jobs_gamingposition.occupation_id',"asc")
            ->get();
        $data['occupation'] = Occupation::where('industry_id',4)->get();
//        return $data;
        return view('admin/gameposition', ['data' => $data]);
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
                if ($request->has('name') && $request->has('occ_id')) {
                    $name = $request->input('name');
                    $occ_id = $request->input('occ_id');

                    $gameposition = new Gameposition();
                    $gameposition->name = $name;
                    $gameposition->industry_id = 4;
                    $gameposition->occupation_id = $occ_id;

                    if ($gameposition->save()) {
                        $resultData['status'] = 200;
                    } else {
                        $resultData['status'] = 400;
                        $resultData['msg'] = "添加失败";
                    }
                }
                break;
            case 'delete':
                if ($request->has('id')) {
                    $data = $request->input('id');

                    $del = Gameposition::find($data);
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
