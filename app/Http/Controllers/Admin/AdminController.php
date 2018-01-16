<?php
/**
 * Created by PhpStorm.
 * User: Lishuai
 * Date: 2017/9/11
 * Time: 15:52
 */

namespace App\Http\Controllers\Admin;

use App\Admininfo;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller {
    public function view() {
        $uid = AdminAuthController::getUid();
        if ($uid == 0)
            return view('admin.login');

        $data = DashboardController::getLoginInfo();
        $data['admins'] = $this->getAdminList();
        return view('admin.admin', ["data" => $data]);
    }

    public function addAdmin(Request $request) {
        $input = $request->all();
        $data = array();
        if (AdminAuthController::isAdmin()) {
            $validator = Validator::make($input, [
                'username' => ['required', 'max:20', 'regex:/^[a-zA-Z0-9!"#$%&\'()*+,-.\/:;<=>?^_`~{|}\]]+$/']
            ]);
            if (!($validator->fails())) {
                $username = $input['username'];
                $isexist = User::where('username', '=', $username)
                    ->get();
                if (!($isexist->count())) {
                    $user = new User();
                    $user->username = $input['username'];
                    $user->password = bcrypt($input['password']);
                    $user->type = 3;
                    if ($user->save()) {
                        $adminInfo = new Admininfo();
                        $adminInfo->uid = $user->uid;
                        $adminInfo->save();
                        $data['status'] = 200;
                        $data['msg'] = '管理员添加成功';
                    } else {
                        $data['status'] = 400;
                        $data['msg'] = '管理员添加失败';
                    }
                } else {
                    $data['status'] = 400;
                    $data['msg'] = '用户名已存在，添加失败';
                }
            } else {
                $data['status'] = 400;
                $data['msg'] = '用户名信息不符合规范';
            }
            return $data;
        }
        $data['status'] = 400;
        $data['msg'] = '没有权限进行添加管理员操作';
        return $data;
    }

    public function deleteAdmin(Request $request) {
        $data = array();
        $data['status'] = 400;
        $data['msg'] = '删除的管理员ID不存在';

        if (!$request->has('id')) {
            return $data;
        }

        $aid = $request->input('id');

        if (AdminAuthController::isAdmin()) {
            $admin = Admininfo::find($aid);
            if (!$admin) {
                $data['status'] = 400;
                $data['msg'] = '删除的管理员ID不存在';
                return $data;
            }
            $uid = $admin->uid;
            $flag = $admin->delete();
            if ($flag) {
                $user = User::find($uid);
                if ($user->delete()) {
                    $data['status'] = 200;
                    $data['msg'] = '删除成功';
                } else {
                    $data['status'] = 400;
                    $data['msg'] = '删除失败';
                }
            } else {
                $data['status'] = 400;
                $data['msg'] = '删除失败';
            }
            return $data;
        }
        $data['status'] = 400;
        $data['msg'] = '没有权限进行删除管理员操作';
        return $data;
    }

    public function getAdminList() {

        $uid = AdminAuthController::getUid();
        if ($uid == 0) {
            return redirect('admin/login');
        }

        $admins = DB::table('jobs_users')
            ->join('jobs_admininfo', 'jobs_admininfo.uid', '=', 'jobs_users.uid')
            ->select('aid', 'username', 'permission', 'role', 'status')
            ->get();

        return $admins;
    }
}
