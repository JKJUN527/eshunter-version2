<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers\mobile;

use App\About;

class AboutController extends Controller
{
    public function index ()
    {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['about'] = About::orderBy('wid','desc')
            ->first();
        //return $data;
        return view('mobile/my/about', ['data' => $data]);
    }
}
