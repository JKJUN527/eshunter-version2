<?php
/**
 * Created by PhpStorm.
 * User: JKJUN
 * Date: 2017/7/28
 * Time: 17:15
 */
namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index (Request $request)
    {
        $data = array();
        $data['uid'] = AuthController::getUid();
        $data['username'] = InfoController::getUsername();
        $data['type'] = AuthController::getType();
        $data['about'] = About::orderBy('wid','desc')
            ->first();
        if($request->has('page'))
            $data['tab'] = $request->input('page');
        else
            $data['tab'] = 'tab2';
//        return $data;
        return view('about/index', ['data' => $data]);
    }
}
