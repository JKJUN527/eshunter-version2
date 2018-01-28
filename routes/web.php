<?php
//z正式网站路由开始
//Route::get('index', function () {//主页返回四类广告（大图、小图、文字、急聘广告、最新新闻（5个）），
//    return view('index');
//});
//测试生成session uid
Route::any('session', ['uses' => 'PositionController@test1']);
//
Route::any('/', ['uses' => 'HomeController@index']);//完成
Route::any('/index', ['uses' => 'HomeController@index']);//完成
Route::any('/index/search', ['uses' => 'HomeController@indexSearch']);//完成

//登录注册
Route::get('account/login', ['uses' => 'LoginController@index']);
Route::get('account/register', ['uses' => 'RegisterController@index']);

Route::post('account/register', ['uses' => 'RegisterController@postRegister']);  //完成
Route::post('account/login', ['uses' => 'LoginController@postLogin']);   //完成

Route::get('account/logout', ['uses' => 'LoginoutController@logout']);   //完成
Route::any('account/sms', ['uses' => 'ValidationController@regSMS']);//发送短信验证码
//发送邮箱
Route::any('account/sendemail', ['uses' => 'ValidationController@sendemail']);
//验证邮箱
Route::any('validate_email', ['uses' => 'ValidationController@verifyEmailCode']);


Route::get('account/findPassword', ['uses' => 'ForgetPwController@view']);
Route::post('account/findPassword/{option}', ['uses' => 'ForgetPwController@index'])->where('option', '[0-2]{1}');

//Route::get('account/findPassword', function () {
//    return view('account.findPassword');
//});
//Route::any('account/resetPassword', ['uses' => 'FixPasswordController@resetPassword']);
//Route::any('account/forgotPasswordReset', ['uses' => 'FixPasswordController@forgotPasswordReset']);
Route::get('account/recommendPosition', ['uses' => 'PersonCenterController@recommendPosition']);

//权限获取
Route::get('account/getType', ['uses' => 'AuthController@getType']);  //完成
Route::get('account/getUid', ['uses' => 'AuthController@getUid']);  //完成
//个人信息获取、新增、更新
//Route::get('account/edit', function () {//进入方法，返回修改界面，带上个人信息。
//    return view('account.edit');
//});
Route::get('account/edit', ['uses' => 'InfoController@index']);//个人、企业基本信息修改界面
Route::get('account/getPersonInfo', ['uses' => 'InfoController@getPersonInfo']);
Route::get('account/getEnprInfo', ['uses' => 'InfoController@getEnprInfo']);
//Route::post('account/editPersonInfo', ['uses' => 'InfoController@editPersonInfo']);
//Route::post('account/editEnprInfo', ['uses' => 'InfoController@editEnprInfo']);
//企业号验证页面
Route::any('account/enterpriseVerify', ['uses' => 'AccountController@enterpriseVerifyView']);
Route::any('account/enterpriseVerify/upload', ['uses' => 'AccountController@uploadVerinfo']);
//个人信息资料修改新增页面
Route::any('account/personinfo/edit', ['uses' => 'AccountController@personinfoEdit']);
//企业信息修改页
Route::any('account/enprinfo/edit', ['uses' => 'AccountController@enprinfoEdit']);

Route::any('account/', ['uses' => 'PersonCenterController@index']);
Route::any('account/index', ['uses' => 'PersonCenterController@index']);
//简历模块
Route::get('resume/add', ['uses' => 'ResumeController@getIndex']);
Route::get('resume/addResume', ['uses' => 'ResumeController@addResume']);
Route::any('resume/getRegion', ['uses' => 'ResumeController@getRegion']);
Route::any('resume/getIndustry', ['uses' => 'ResumeController@getIndustry']);
Route::get('resume/getResumeList', ['uses' => 'ResumeController@getResumeList']);
Route::get('resume/preview', ['uses' => 'ResumeController@previewResume']);

Route::post('resume/rename', ['uses' => 'ResumeController@rename']);
Route::post('resume/addIntention', ['uses' => 'ResumeController@addIntention']);
Route::post('resume/addEducation', ['uses' => 'ResumeController@addEducation']);
Route::post('resume/addGame', ['uses' => 'ResumeController@addEgamexpr']);
Route::post('resume/addWorkexp', ['uses' => 'ResumeController@addWorkexp']);
Route::post('resume/addProjectexp', ['uses' => 'ResumeController@addProjectexp']);
Route::post('resume/addSkill', ['uses' => 'ResumeController@addTag']);
Route::post('resume/addExtra', ['uses' => 'ResumeController@addExtra']);
Route::post('resume/deleteSkill', ['uses' => 'ResumeController@deleteTag']);
Route::get('resume/deleteEducation', ['uses' => 'ResumeController@deleteEducation']);
Route::get('resume/deleteGame', ['uses' => 'ResumeController@deleteGame']);
Route::get('resume/deleteWorkexp', ['uses' => 'ResumeController@deleteWorkexp']);
Route::get('resume/deleteProjectexp', ['uses' => 'ResumeController@deleteProjectexp']);
Route::any('resume/advanceSearch', ['uses' => 'ResumeController@test']);
//以下为新增修改已填写简历功能
Route::post('resume/geteduinfo', ['uses' => 'ResumeController@geteduinfo']);
Route::post('resume/getworkinfo', ['uses' => 'ResumeController@getworkinfo']);
Route::post('resume/getegameinfo', ['uses' => 'ResumeController@getegameinfo']);
Route::post('resume/getprojectinfo', ['uses' => 'ResumeController@getprojectinfo']);

//Route::any('resume/advanceSearch', ['uses' => 'ResumeController@advanceIndex']);

//职位发布、查看
Route::get('position/checkVerification', ['uses' => 'PositionController@checkVerification']);
Route::any('position/publish', ['uses' => 'PositionController@publishIndex']);
Route::any('position/publish/add', ['uses' => 'PositionController@publish']);
Route::any('position/publishList', ['uses' => 'PositionController@publishList']);
Route::any('position/publishList/delete', ['uses' => 'PositionController@delPosition']);
Route::any('position/publishList/online', ['uses' => 'PositionController@onlinePosition']);
Route::any('position/publishList/offline', ['uses' => 'PositionController@offlinePosition']);
Route::post('position/publishList/refresh', ['uses' => 'PositionController@refreshPosition']);
Route::get('position/publishList/edit', ['uses' => 'PositionController@editIndex']);
Route::post('position/publishList/editPost', ['uses' => 'PositionController@edit']);
Route::any('position/publishList/search', ['uses' => 'PositionController@searchPosition']);//发布列表页搜索已发布职位
Route::any('position/detail', ['uses' => 'PositionController@detail']);
Route::any('position/advanceSearch', ['uses' => 'PositionController@advanceIndex']);
//Route::any('position/advanceSearch/search', ['uses' => 'PositionController@advanceSearch']);
//Route::any('position/advanceSearch/testRaw', ['uses' => 'PositionController@testRaw']);

Route::any('delivered/add', ['uses' => 'DeliveredController@delivered']);//投递简历
Route::get('position/applyList', ['uses' => 'PositionController@applyList']);//个人职位申请记录
Route::get('position/deliverList', ['uses' => 'PositionController@deliverListView']);
Route::get('position/deliverDetail', ['uses' => 'PositionController@deliverDetailView']);
Route::any('position/deliverDetail/reply', ['uses' => 'PositionController@reply']);//回复投递简历
Route::any('position/deldeliverRecord', ['uses' => 'PositionController@deldeliverRecord']);//删除简历投递记录
Route::any('position/viewallposition', ['uses' => 'PositionController@viewallposition']);//查看公司发布全部简历

//新闻模块
Route::any('news/{pagnum?}', ['uses' => 'NewsController@SearchNews'])->where('pagnum', '[0-9]+');//完成
//Route::any('news/index',['uses' => 'NewsController@SearchNews']);
Route::any('news/detail', ['uses' => 'NewsController@detail']);
Route::any('news/content', ['uses' => 'NewsController@requestNewsContent']);
Route::any('news/addReview', ['uses' => 'NewsController@addReview']);//添加评论

//Route::get('news/detail', function () {
//    return view('news.detail');
//});
//站内信模块
Route::any('message/', ['uses' => 'MessageController@index']);//站内信主页
Route::any('message/index', ['uses' => 'MessageController@index']);//站内信主页
Route::any('message/detail', ['uses' => 'MessageController@detail']);//站内信详情
Route::any('message/read', ['uses' => 'MessageController@isRead']);//设置已读
Route::any('message/delete', ['uses' => 'MessageController@delMessage']);
Route::any('message/sendMessage', ['uses' => 'MessageController@sendMessage']);//发送站内信
Route::any('message/delDialog', ['uses' => 'MessageController@delDialog']);//发送站内信

//网站信息模块
Route::any('about/', ['uses' => 'AboutController@index']);//网站信息模块
Route::any('about/index', ['uses' => 'AboutController@index']);//网站信息模块

Route::any('company', ['uses' => 'HomeController@companySearch']);//完成
//Route::any('company', function () {
//    return view('company');
//});
//企业圈模块
Route::get('/business', ['uses' => 'CooperationController@index']);
Route::get('/business/publish', ['uses' => 'CooperationController@publishIndex']);
Route::post('/business/publish/upload', ['uses' => 'CooperationController@publishCooperation']);



//网站后台
Route::get('admin/login', function () {
    return view('admin/login');
});
Route::post('admin/login', ['uses' => 'Admin\LoginController@postLogin']);

Route::get('admin/', ['uses' => 'Admin\DashboardController@view']);
Route::get('admin/dashboard', ['uses' => 'Admin\DashboardController@view']);

Route::get('admin/admin', ['uses' => 'Admin\AdminController@view']);


Route::any('admin/industry', ['uses' => 'Admin\IndustryController@index']);//显示行业
Route::any('admin/industry/{option}', ['uses' => 'Admin\IndustryController@edit'])->where('option', '[A-Za-z]+');//显示行业

Route::any('admin/occupation', ['uses' => 'Admin\OccupationController@index']);//显示职业
Route::any('admin/occupation/{option}', ['uses' => 'Admin\OccupationController@edit'])->where('option', '[A-Za-z]+');//显示职业

Route::any('admin/egame', ['uses' => 'Admin\EgamenameController@index']);//显示游戏
Route::any('admin/egame/{option}', ['uses' => 'Admin\EgamenameController@edit'])->where('option', '[A-Za-z]+');//显示行业

Route::any('admin/egrade', ['uses' => 'Admin\EgradeController@index']);//显示职业
Route::any('admin/egrade/{option}', ['uses' => 'Admin\EgradeController@edit'])->where('option', '[A-Za-z]+');//显示职业

Route::any('admin/region', ['uses' => 'Admin\RegionController@index']);//显示地区
Route::any('admin/region/{option}', ['uses' => 'Admin\RegionController@edit'])->where('option', '[A-Za-z]+');//显示地区

//审批企业信息
Route::any('admin/enterprise/{option?}', ['uses' => 'Admin\VerificationController@index'])->where('option', '[0-2]{1}');//显示待审核或已审核的企业信息
Route::any('admin/enterprise/detail', ['uses' => 'Admin\VerificationController@showDetail']);//显示待审核或已审核的企业信息
Route::any('admin/enterprise/examine', ['uses' => 'Admin\VerificationController@passVerfi']);//显示待审核或已审核的企业信息

//登陆注册
Route::post('admin/register', ['uses' => 'Admin\AdminController@addAdmin']);
Route::any('admin/delete', ['uses' => 'Admin\AdminController@deleteAdmin']);


Route::get('admin/index', ['uses' => 'Admin\LoginController@index']);
Route::get('admin/logout', ['uses' => 'Admin\LoginController@logout']);
Route::get('admin/getUid', ['uses' => 'Admin\AdminAuthController@getUid']);
Route::get('admin/getType', ['uses' => 'Admin\AdminAuthController@getType']);

//发布广告
Route::get('admin/addAds', ['uses' => 'Admin\AdvertsController@addAdView']);//显示已发布广告信息

Route::any('admin/ads', ['uses' => 'Admin\AdvertsController@index']);//显示已发布广告信息
Route::any('admin/ads/detail', ['uses' => 'Admin\AdvertsController@detail']);//显示已发布广告信息
Route::any('admin/ads/add', ['uses' => 'Admin\AdvertsController@addAds']);//新增或修改广告信息
Route::any('admin/ads/find', ['uses' => 'Admin\AdvertsController@findAd']);//查找location位置是否有广告
Route::any('admin/ads/del', ['uses' => 'Admin\AdvertsController@delAd']);//删除广告

//发布新闻
Route::any('admin/news', ['uses' => 'Admin\EditnewsController@index']);//显示已发布新闻信息
Route::any('admin/news/detail', ['uses' => 'Admin\EditnewsController@detail']);//显示已发布新闻信息
Route::get('admin/addNews', ['uses' => 'Admin\EditnewsController@addNewsView']);//新增或修改新闻信息
Route::any('admin/news/add', ['uses' => 'Admin\EditnewsController@addNews']);//新增或修改新闻信息
Route::any('admin/news/del', ['uses' => 'Admin\EditnewsController@delNews']);

//管理企业发布职位
Route::any('admin/position', ['uses' => 'Admin\PositionController@index']);//显示已发布的职位信息
Route::any('admin/position/search', ['uses' => 'Admin\PositionController@findPosition']);//根据公司名字搜索对应发布的职位信息
Route::any('admin/position/urgency', ['uses' => 'Admin\PositionController@isUrgency']);//设置职位是否紧急状态
Route::any('admin/position/offposition', ['uses' => 'Admin\PositionController@OffPosition']);//下架职位信息
//管理网站信息
Route::any('admin/about', ['uses' => 'Admin\WebinfoController@index']);//显示已发布广告信息
Route::any('admin/about/setPhone', ['uses' => 'Admin\WebinfoController@setPhone']);
Route::any('admin/about/setEmail', ['uses' => 'Admin\WebinfoController@setEmail']);
Route::any('admin/about/setAddress', ['uses' => 'Admin\WebinfoController@setAddress']);
Route::any('admin/about/setContent', ['uses' => 'Admin\WebinfoController@setContent']);

//end
Route::any('smstest', ['uses' => 'ValidationController@verifySmsCode']);//显示已发布的职位信息
Route::any('sendsms', ['uses' => 'ValidationController@sendSMS']);//显示已发布的职位信息
Route::any('getAllApplyList', ['uses' => 'PersonCenterController@getAllApplyList']);//显示已发布的职位信息

//临时企业用户账号添加
Route::any('addtempUser', ['uses' => 'CreatetempuserController@index']);
Route::any('resumesendmail', ['uses' => 'DeliveredController@sendresumetomail']);

//临时简历用户管理
Route::any('admin/resumes', ['uses' => 'Admin\ResumesController@index']);//显示已创建的临时简历用户
Route::any('admin/addresume', ['uses' => 'Admin\ResumesController@addIndex']);//新增临时简历用户页面
Route::post('admin/addresume', ['uses' => 'Admin\ResumesController@addtempresume']);//新增临时简历用户
Route::get('admin/resume/del', ['uses' => 'Admin\ResumesController@delResume']);//删除临时简历用户，同时删除所有该临时用户的所有信息。

//mobile routes
//index page
Route::any('m/', ['uses' => 'mobile\HomeController@index']);//完成
Route::any('m/index', ['uses' => 'mobile\HomeController@index']);//完成
//登录注册
Route::get('m/account/login', ['uses' => 'mobile\LoginController@index']);//登录
Route::get('m/account/register', ['uses' => 'mobile\RegisterController@index']);
Route::get('m/account/logout', ['uses' => 'mobile\LoginoutController@logout']);   //完成
//权限获取
Route::get('m/account/getType', ['uses' => 'mobile\AuthController@getType']);  //获取类型
Route::get('m/account/getUid', ['uses' => 'mobile\AuthController@getUid']);  //获取id，企业或个人

//我的
Route::any('m/account/', ['uses' => 'mobile\PersonCenterController@index']);
Route::any('m/account/index', ['uses' => 'mobile\PersonCenterController@index']);//跳转我的界面
Route::any('m/account/jobRecommendList', ['uses' => 'mobile\PersonCenterController@recommendIndex']);//跳转我的界面
Route::get('m/account/edit', ['uses' => 'mobile\InfoController@index']);//用户信息编辑界面
Route::get('m/account/getPersonInfo', ['uses' => 'mobile\InfoController@getPersonInfo']);//获取个人信息
//个人信息资料修改新增页面
Route::any('m/account/personinfo/edit', ['uses' => 'mobile\AccountController@personinfoEdit']);
//企业信息修改页
Route::any('m/account/enprinfo/edit', ['uses' => 'mobile\AccountController@enprinfoEdit']);
//企业号验证页面
Route::any('m/account/enterpriseVerify', ['uses' => 'mobile\AccountController@enterpriseVerifyView']);
Route::any('m/account/enterpriseVerify/upload', ['uses' => 'mobile\AccountController@uploadVerinfo']);

//消息
Route::any('m/message/', ['uses' => 'mobile\MessageController@index']);//站内信主页
Route::any('m/message/index', ['uses' => 'mobile\MessageController@index']);//站内信主页
Route::any('m/message/detail', ['uses' => 'mobile\MessageController@detail']);//站内信详情
Route::any('m/message/read', ['uses' => 'mobile\MessageController@isRead']);//设置已读
Route::any('m/message/delete', ['uses' => 'mobile\MessageController@delMessage']);//删除消息
Route::any('m/message/sendMessage', ['uses' => 'mobile\MessageController@sendMessage']);//发送站内信
Route::any('m/message/delDialog', ['uses' => 'mobile\MessageController@delDialog']);//发送站内信


//简历模块
Route::any('m/resume', ['uses' => 'mobile\ResumeController@resumeList']);//跳转resumeList界面
Route::get('m/resume/add', ['uses' => 'mobile\ResumeController@getIndex']);//简历编辑界面
Route::get('m/resume/preview', ['uses' => 'mobile\ResumeController@previewResume']); //简历预览
Route::get('m/resume/addResume', ['uses' => 'mobile\ResumeController@addResume']);//增加简历操作
Route::any('resume/getRegion', ['uses' => 'ResumeController@getRegion']);
Route::any('resume/getIndustry', ['uses' => 'ResumeController@getIndustry']);
Route::get('resume/getResumeList', ['uses' => 'ResumeController@getResumeList']);
Route::any('m/delivered/add', ['uses' => 'DeliveredController@delivered']);
Route::post('m/resume/rename', ['uses' => 'mobile\ResumeController@rename']);//简历重命名

Route::get('m/resume/getIntention', ['uses' => 'mobile\ResumeController@getIntention']);//求职意向页面
Route::get('m/resume/getEduExpInfo', ['uses' => 'mobile\ResumeController@getEduExpInfo']);//教育经历List页面
Route::get('m/resume/getWorkExpInfo', ['uses' => 'mobile\ResumeController@getWorkExpInfo']);//工作经历List页面
Route::get('m/resume/getProExpInfo', ['uses' => 'mobile\ResumeController@getProExpInfo']);//项目经历List页面
Route::get('m/resume/getGameExpInfo', ['uses' => 'mobile\ResumeController@getGameExpInfo']);//电竞经历List页面
Route::get('m/resume/getSkillInfo', ['uses' => 'mobile\ResumeController@getSkillInfo']);//技能List页面

//以下为新增修改已填写简历功能
Route::any('m/resume/geteduinfo', ['uses' => 'mobile\ResumeController@geteduinfo']); //教育经历页面
Route::any('m/resume/getworkinfo', ['uses' => 'mobile\ResumeController@getworkinfo']);//工作经历页面
Route::any('m/resume/getprojectinfo', ['uses' => 'mobile\ResumeController@getprojectinfo']);//项目经历
Route::any('m/resume/getegameinfo', ['uses' => 'mobile\ResumeController@getegameinfo']);//电竞经历页面
Route::any('m/resume/addskillinfo', ['uses' => 'mobile\ResumeController@addskillinfo']);//电竞经历页面

Route::post('m/resume/addIntention', ['uses' => 'mobile\ResumeController@addIntention']);//增加求职意向
Route::post('m/resume/addEducation', ['uses' => 'mobile\ResumeController@addEducation']);//增加、修改教育经历
Route::post('m/resume/addGame', ['uses' => 'mobile\ResumeController@addEgamexpr']);//增加、修改游戏经历
Route::post('m/resume/addWorkexp', ['uses' => 'mobile\ResumeController@addWorkexp']);//增加、修改工作经历
Route::post('m/resume/addProjectexp', ['uses' => 'mobile\ResumeController@addProjectexp']);//增加、修改项目经历
Route::post('m/resume/addSkill', ['uses' => 'mobile\ResumeController@addTag']); //增加技能
Route::post('m/resume/addExtra', ['uses' => 'mobile\ResumeController@addExtra']);//添加附加信息

//删除
Route::post('m/resume/deleteSkill', ['uses' => 'mobile\ResumeController@deleteTag']);
Route::get('m/resume/deleteEducation', ['uses' => 'mobile\ResumeController@deleteEducation']);
Route::get('m/resume/deleteGame', ['uses' => 'mobile\ResumeController@deleteGame']);
Route::get('m/resume/deleteWorkexp', ['uses' => 'mobile\ResumeController@deleteWorkexp']);
Route::get('m/resume/deleteProjectexp', ['uses' => 'mobile\ResumeController@deleteProjectexp']);
Route::any('m/resume/advanceSearch', ['uses' => 'mobile\ResumeController@test']);





//申请记录
Route::get('m/position/applyList', ['uses' => 'mobile\PositionController@applyList']);//个人职位申请记录


//接收申请
Route::get('m/position/deliverList', ['uses' => 'mobile\PositionController@deliverListView']);//企业接收到的申请记录
Route::get('m/position/deliverDetail', ['uses' => 'mobile\PositionController@deliverDetailView']); //查看简历
Route::any('m/position/deliverDetail/reply', ['uses' => 'mobile\PositionController@reply']);//回复投递简历
Route::any('m/position/deldeliverRecord', ['uses' => 'mobile\PositionController@deldeliverRecord']);//删除简历投递记录

//发布的职位
Route::any('m/position/publishList', ['uses' => 'mobile\PositionController@publishList']);//发布职位列表
Route::get('m/position/checkVerification', ['uses' => 'mobile\PositionController@checkVerification']);
Route::any('m/position/publish', ['uses' => 'mobile\PositionController@publishIndex']);//发布职位
Route::any('m/position/publish/add', ['uses' => 'mobile\PositionController@publish']);
Route::any('m/position/publishList/delete', ['uses' => 'mobile\PositionController@delPosition']);
Route::any('m/position/publishList/online', ['uses' => 'mobile\PositionController@onlinePosition']);
Route::any('m/position/publishList/offline', ['uses' => 'mobile\PositionController@offlinePosition']);
Route::post('m/position/publishList/refresh', ['uses' => 'mobile\PositionController@refreshPosition']);
Route::get('m/position/publishList/edit', ['uses' => 'mobile\PositionController@editIndex']);
Route::post('m/position/publishList/editPost', ['uses' => 'mobile\PositionController@edit']);
Route::any('m/position/publishList/search', ['uses' => 'mobile\PositionController@searchPosition']);//发布列表页搜索已发布职位


//职位
Route::any('m/position/advanceSearch', ['uses' => 'mobile\PositionController@advanceIndex']);
Route::any('m/position/detail', ['uses' => 'mobile\PositionController@detail']);
Route::post('m/position/advanceSearch', ['uses' => 'mobile\PositionController@advanceSearch']);
//找回密码
Route::get('m/account/findPassword', ['uses' => 'mobile\ForgetPwController@view']);
Route::post('m/account/findPassword/{option}', ['uses' => 'mobile\ForgetPwController@index'])->where('option', '[0-2]{1}');
Route::get('m/account/register', ['uses' => 'mobile\RegisterController@index']);
Route::post('m/account/register', ['uses' => 'mobile\RegisterController@postRegister']);  //完成
Route::any('m/account/sms', ['uses' => 'mobile\ValidationController@regSMS']);
Route::post('m/account/login', ['uses' => 'mobile\LoginController@postLogin']);
Route::any('m/company', ['uses' => 'mobile\HomeController@companySearch']);//完成

//资讯
Route::any('m/news/{pagnum?}', ['uses' => 'mobile\NewsController@SearchNews'])->where('pagnum', '[0-9]+');//完成
//Route::any('news/index',['uses' => 'NewsController@SearchNews']);
Route::post('m/news/loadMore', ['uses' => 'mobile\NewsController@LoadMore']);
Route::any('m/news/detail', ['uses' => 'mobile\NewsController@detail']);
Route::any('m/news/content', ['uses' => 'mobile\NewsController@requestNewsContent']);
Route::any('m/news/addReview', ['uses' => 'mobile\NewsController@addReview']);//添加评论

//关于
Route::any('m/about/', ['uses' => 'mobile\AboutController@index']);//网站信息模块
Route::any('m/about/index', ['uses' => 'mobile\AboutController@index']);//网站信息模块
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
//招聘网站
//index
// Route::any('123',function (){
//     return "hello";
// });
// Route::get('/',function (){
//     return view('index');
// });
// Route::get('index',function (){
//     return view('index');
// });
// //account
// //打开session
// Route::group(['middleware' => ['web']], function (){
//     Route::any('account/{userid?}',['uses' => 'AccountController@index'])->where('userid','[0-9]+');
//     Route::any('account/login',['uses' => 'AccountController@login']);
//     Route::any('account/register',['uses' => 'AccountController@register']);
//     Route::any('account/findPassword',['uses' => 'AccountController@findPassword']);
//     Route::any('account/edit',['uses' => 'AccountController@edit']);
//     Route::any('account/enterpriseVerify/{options}',['uses' => 'AccountController@enterpriseVerify']);//企业号验证页面
// //resume
//     Route::any('resume/add',['uses' => 'ResumeController@add']);
//     Route::any('resume/edit',['uses' => 'ResumeController@edit']);

// //position
//     Route::any('position/applyList',['uses' => 'PositionController@applyList']);
//     //options 传递参数返回页面（index）新增数据（add）

//     Route::any('position/test1',['uses' => 'PositionController@test1']);
//     Route::any('position/publish/{options}',['uses' => 'PositionController@publish'])->where('options','[A-Za-z]+');
//     Route::any('position/publishList/{options}',['uses' => 'PositionController@publishList'])->where('options','[A-Za-z]+');
//     Route::any('position/detail',['uses' => 'PositionController@detail']);
//     Route::any('position/edit',['uses' => 'PositionController@edit']);
//     Route::any('position/advanceSearch',['uses' => 'PositionController@advanceSearch']);

// //news
//     Route::any('news',['uses' => 'NewsController@index']);
//     Route::any('news/detail',['uses' => 'NewsController@detail']);
//     Route::get('news/search',['uses' => 'NewsController@SearchNews']);//页面12，功能14
//     Route::get('news/list/{num}',['uses' => 'NewsController@SearchNews'])->where('num','[0-9]+');//页面12，功能54 直接输入每页显示数量倒序获取新闻列表


// //message
//     Route::any('message/index/{options}',['uses' => 'MessageController@index'])->where('options','[A-Za-z]+');
//     Route::any('message/detail',['uses' => 'MessageController@detail']);
//     Route::any('message/test',['uses' => 'MessageController@test']);
//     Route::any('message/upload',['uses' => 'MessageController@upload']);

// //about
//     Route::any('about',['uses' => 'AboutController@index']);

//     //发送短信
//     Route::any('validation/sendsms',['uses' => 'ValidationController@sendSMS']);
//     //发送邮箱
//     Route::any('validation/sendemail',['uses' => 'ValidationController@sendemail']);
//     //验证邮箱
//     Route::any('validate_email',['uses' => 'ValidationController@verifyEmailCode']);
// //招聘网站结束
// });

// Route::get('/hello',function(){
//     return "HELLO echo!";
// });
// //多请求路由
// Route::match(['get','post'],'multy1',function(){
//     return "multy1";
// });
// Route::any('test1','StudentController@test1');
// Route::any('query1',['uses' => 'StudentController@query1']);
// Route::any('query2',['uses' => 'StudentController@query2']);
// Route::any('query3',['uses' => 'StudentController@query3']);
// Route::any('query4',['uses' => 'StudentController@query4']);
// Route::any('orm1',['uses' => 'StudentController@orm1']);
// Route::any('orm2',['uses' => 'StudentController@orm2']);
// //路由参数
// Route::get('user/{id}',function ($id){
//     return 'user-id-'.$id;
// })->where('id','[0-9]+');

// //Route::get('user/{name?}',function ($name = 'jkjun'){
// //    return 'user-name-'.$name;
// //});
// //正则表达式来验证输入参数
// Route::get('user/{name?}',function ($name = 'jkjun'){
//     return 'user-name-'.$name;
// })->where('name','[A-Za-z]+');

// Route::get('user/{id?}/{name?}',function ($id ,$name = 'jkjun'){
//     return 'user-id-'.$id.'-name-'.$name;
// })->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);

// //session

// Route::group(['middleware'=> ['web']],function () {
//     Route::any('session1',['uses' => 'StudentController@session1']);
//     Route::any('session2',['uses' => 'StudentController@session2']);
// });
