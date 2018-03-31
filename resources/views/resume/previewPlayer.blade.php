@extends('layout.master')
@section('title', '预览选手简历')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('style/font-awesome.min.css')}}"/>
    <style>
        ol,ul{
            margin-bottom: 0px!important;
        }
        ul li{
            margin-bottom: 0px!important;
            
        }
        .nav_ul li a {
            text-decoration: none;
        }
        .logo-con {
            float: left;
            margin-top: 5px;
        }
        .resume-card {
            width: 100%;
            margin: 50px 0 20px 0;
            min-height: 0;
        }

        .mdl-card__title i{
            color:tomato;
            margin-right: 2px;
            /*padding-bottom: 3px;*/
        }

        .mdl-card__supporting-text {
            padding-top: 3px;
        }

        .resume-child-card {
            width: 100%;
            min-height: 0;
            padding-bottom: 40px;
            /*margin-bottom:20px;*/
        }

        .resume-child-card .mdl-card__title-text {
            font-size: 18px;
            font-weight: 600;
            /*margin-bottom: 12px;*/
        }

        .intention-panel p,
        .baseinfo-panel p,
        .PlayerResume-panel p,
        .education-panel p,
        .work-panel p {
            padding: 5px 25px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p,
        .baseinfo-panel p,
        .PlayerResume-panel p,
        .work-panel p {
            display: block !important;
        }

        .education-panel p span,
        .work-panel p span {
            margin-right: 10px;
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            text-overflow: ellipsis;
        }
        .education-panel p span:first-child{
            /*min-width: 103px;*/
            width: 105px;
        }
        .education-panel p span:nth-child(2){
            /*width: 80px;*/
            /*max-width: 100px;*/
        }
        .education-panel p span:last-child{
            min-width: 103px;
            max-width: 200px;
        }

        .education-panel p span,
        .work-panel p span {
            margin-right: 10px;
        }

        .intention-panel p span {
            color: #737373;
            font-size: 14px;

        }
        .baseinfo-panel p span {
            color: #737373;
            font-size: 14px;
        }
        .PlayerResume-panel span{
            color: #737373;
            font-size: 14px;
        }

        .PlayerResume-panel p span,
        .education-panel p span,
        .work-panel p span {
            margin-right: 10px;
            /*overflow: hidden;*/
            white-space: nowrap;
            display: inline-block;
            text-overflow: ellipsis;
        }

        .skill-panel span {
            display: inline-block;
            background: #03A9F4;
            padding: 8px 25px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: #ffffff;
            border-radius: 3px;
            position: relative;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        .mdl-card__supporting-text a {
            cursor: pointer;
            color: #232323;
        }

        .mdl-card__supporting-text a:hover {
            text-decoration: underline;
        }

        .base-info__title {
            width: 800px !important;
        }
        .PlayerResume-panel p span:last-child{
            min-width: 103px;
            max-width: 200px;
        }
        .education-panel p i,
        .PlayerResume-panel p i,
        .work-panel p i {
            float: right;
            cursor: pointer;
            font-size: 16px;
            color: #D32F2F;
            position: relative;
            top: 5px;
            border-radius: 16px;
            background: #f5f5f5;
        }

    </style>
@endsection

@section('header-nav')
    @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
    @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection


@section('footer')
   @include('components.myfooter')
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="resume-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                            to="/resume/add?rid={{$data['rid']}}">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    <h5 class="mdl-card__title-text" style="margin-left: 16px;">预览选手简历</h5>
                </div>

                <div class="mdl-card__supporting-text" style="margin-left: 48px;">
                    以下简历为效果预览
                </div>
            </div>

            <div id="resume_preview">
 <link rel="stylesheet" type="text/css" href="http://eshunter.com/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/material.style.min.css">
    <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/material.css">
        <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/icon-fonts.css">
    <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="http://eshunter.com/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="http://eshunter.com/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://eshunter.com/favicon/favicon-16x16.png">
    <style>
        .resume-card {
            width: 100%;
            margin: 50px 0 20px 0;
            min-height: 0;
        }

        .mdl-card__title i{
            color:tomato;
            margin-right: 2px;
            /*padding-bottom: 3px;*/
        }

        .mdl-card__supporting-text {
            padding-top: 3px;
        }

        .resume-child-card {
            width: 100%;
            min-height: 0;
            padding-bottom: 40px;
            /*margin-bottom:20px;*/
        }

        .resume-child-card .mdl-card__title-text {
            font-size: 18px;
            font-weight: 600;
            /*margin-bottom: 12px;*/
        }

        .intention-panel p,
        .education-panel p,
        .work-panel p {
            padding: 5px 25px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p,
        .work-panel p {
            display: block !important;
        }

        .education-panel p span,
        .work-panel p span {
            margin-right: 10px;
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            text-overflow: ellipsis;
        }
        .education-panel p span:first-child{
            /*min-width: 103px;*/
            width: 105px;
        }
        .education-panel p span:nth-child(2){
            /*width: 80px;*/
            /*max-width: 100px;*/
        }
        .education-panel p span:last-child{
            min-width: 103px;
            max-width: 200px;
        }

        .education-panel p span,
        .work-panel p span {
            margin-right: 10px;
        }

        .skill-panel span {
            display: inline-block;
            background: #03A9F4;
            padding: 8px 25px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: #ffffff;
            border-radius: 3px;
            position: relative;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        .mdl-card__supporting-text a {
            cursor: pointer;
            color: #232323;
        }

        .mdl-card__supporting-text a:hover {
            text-decoration: underline;
        }

        .base-info__title {
            width: 800px !important;
        }

    </style>
            <div class="mdl-card resume-child-card base-info--user" style="padding-bottom: 20px;">

                @if(count($data['personInfo']) != 0)
                    <div class="base-info__header">
                        <img class="img-circle info-head-img"
                             src="{{$data['personInfo'][0]->photo or asset('images/avatar.png')}}" width="70px"
                             height="70px">

                        <div class="base-info__title">
                            <p>{{$data['personInfo'][0]->pname or "姓名未填写"}}</p>
                            <p><span>
                                    @if($data['personInfo'][0]->sex == null)
                                        性别未填写
                                    @elseif($data['personInfo'][0]->sex == 1)
                                        男
                                    @elseif($data['personInfo'][0]->sex == 2)
                                        女
                                    @endif
                                </span> |
                                <span>{{$data['personInfo'][0]->birthday or "生日未填写"}}</span> |
                                <span>
                                    @if($data['personInfo'][0]->residence == null)
                                        居住地未填写
                                    @else
                                        {{$data['personInfo'][0]->residence}}
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border">
                        <div class="mdl-card__title">
                            <i class="fa fa-user-circle-o fa-2" aria-hidden="true"></i><h6 class="mdl-card__title-text">自我评价</h6>
                        </div>

                        <div class="mdl-card__supporting-text">
                            {{$data['personInfo'][0]->self_evalu or "自我评价未填写"}}
                        </div>
                    </div>

                    <ul class="mdl-list base-info__contact">
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">phone</i>
                                {{$data['personInfo'][0]->tel or "手机号未填写"}}
                            </span>
                        </li>
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">email</i>
                                {{$data['personInfo'][0]->mail or "邮箱未填写"}}
                            </span>
                        </li>
                    </ul>
                @else
                    <div class="mdl-card__supporting-text"
                         style="padding: 24px 0 8px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                        <p>个人资料暂未填写，资料填写后这里将显示您的基本信息</p>
                    </div>
                @endif
            </div>

            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <i class="fa fa-pencil fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">求职意向</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border intention-panel">

                    @if($data['intention'] == null)
                        <div class="mdl-card__supporting-text">
                            您还没有填写过求职意向
                        </div>
                    @else
                        <p>地区：
                            <span>
                                    @foreach($data['region'] as $region)
                                    @if($data['intention']->region == $region->id)
                                        {{$region->name}}
                                        @break
                                    @elseif($data['intention']->region == -1)
                                        任意
                                        @break
                                    @endif
                                @endforeach
                                </span>
                        </p>
                        <p>行业分类：
                            <span>
                                    @foreach($data['industry'] as $industry)
                                    @if($data['intention']->industry == $industry->id)
                                        {{$industry->name}}
                                        @break
                                    @elseif($data['intention']->industry == -1)
                                        任意
                                        @break
                                    @endif
                                @endforeach
                                </span>
                        </p>
                        <p>职业分类：
                            <span>
                                    @foreach($data['occupation'] as $occupation)
                                    @if($data['intention']->occupation == $occupation->id)
                                        {{$occupation->name}}
                                        @break
                                    @elseif($data['intention']->occupation == -1)
                                        任意
                                        @break
                                    @endif
                                @endforeach
                                </span>
                        </p>
                        <p>工作类型：
                            <span>
                                    @if($data['intention']->work_nature == -1)
                                    任意
                                @elseif($data['intention']->work_nature == 0)
                                    兼职
                                @elseif($data['intention']->work_nature == 1)
                                    实习
                                @elseif($data['intention']->work_nature == 2)
                                    全职
                                @endif
                                </span>
                        </p>

                        <p>期望薪资（月）:
                            <span>
                                    @if($data['intention']->salary < 0)
                                    未指定
                                @else
                                    {{$data['intention']->salary}} 元
                                @endif
                                </span>
                        </p>
                    @endif
                </div>
            </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-graduation-cap fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">选手经历</h5>
                    </div>
                    <div class="mdl-card__actions mdl-card--border PlayerResume-panel">

                        @forelse($data['playerResume'] as $playerResume)
                            <p id="playerResume_info" name="playerResume_info" data-content="{{$playerResume->id}}">
                                游戏ID：<span>{{$playerResume->game_id}}</span>
                                游戏名称：<span>{{$playerResume->egame}}</span>
                                选手位置：<span>{{$playerResume->place}}</span>
                                服务器：<span>{{$playerResume->service}}</span>
                                最高排位：<span>{{$playerResume->best_result}}</span>
                                胜率：<span>{{$playerResume->probability*10}}%~{{($playerResume->probability+1)*10}}%</span>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                您还没有填写过选手经历，点击右上角进行填写
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-list fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">选手信息</h5>
                    </div>
                    <div class="mdl-card__actions mdl-card--border baseinfo-panel">
                        @if($data['resume'] == null)
                            <div class="mdl-card__supporting-text">
                                您还没有填写过选手基本信息，点击右上角进行填写
                            </div>
                        @else
                            <p>是否职业选手：
                                <span>
                                    @if($data['resume']->professional == 0)
                                        否
                                    @else
                                        是
                                    @endif
                                </span>
                            </p>
                            <p>曾效力俱乐部：
                                <span>
                                    @if($data['resume']->club == null ||$data['resume']->club == "")
                                        暂无
                                    @else
                                        {{$data['resume']->club}}
                                    @endif
                                </span>
                            </p>
                            <p>是否有合同：
                                <span>
                                    @if($data['resume']->is_contract == 0)
                                        暂无
                                    @else
                                        有签订合同
                                    @endif
                                </span>
                            </p>
                            <p>监护人意见：
                                <span>
                                    @if($data['resume']->opinion == 0)
                                        沟通中
                                    @else
                                        同意
                                    @endif
                                </span>
                            </p>
                        @endif
                    </div>
                </div>


            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <i class="fa fa-tags fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">技能特长</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border skill-panel">
                    {{--|@|王者荣耀|至尊星耀|@|LOL|最强王者--}}
                    @if($data['resume']['skill'] == null)
                        <div class="mdl-card__supporting-text">
                            无技能特长
                        </div>
                    @else
                        @foreach($data['resume']['skill'] as $skill)
                            <span>
                                    <small class="skill-item" style="font-size: 120%;">{{$skill}}</small>
                                </span>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="mdl-card resume-child-card">
                <div class="mdl-card__title">
                    <i class="fa fa-plus-square fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">附加信息</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border additional-panel">

                    @if($data['resume']->extra == null)
                        <div class="mdl-card__supporting-text">
                            无附加信息
                        </div>
                    @else
                        <p>{{$data['resume']->extra}}</p>
                    @endif
                </div>
            </div>
            </div>
        <!-- <div class="tips" style="display: none;">
            正在生成PDF中。。。
        </div> -->
        <div style="text-align: center;margin-top: 12px;">
            <a class="btn btn-primary" id="download_resume">下载预览</a>
        </div>

    </div>
@endsection

@section('custom-script')
    <script src="{{asset('js/pdf.js')}}"></script>


    <script  type="text/javascript">
        document.getElementById("download_resume").onclick = function () {
            
            /*
            * Create a document with parameters
            */
            var doc = new PDF24Doc({
                charset : "UTF-8",
                // headline : "电竞猎人个人简历",
                // headlineUrl : "http://www.pdf24.org",
                // baseUrl : "http://www.pdf24.org",
                filename : "个人简历",
                pageSize : "210x297",
                emailTo : "stefanz@pdf24.org",
                emailFrom : "stefanz@pdf24.org",
                emailSubject: "电竞猎人简历中心",
                emailBody: "感谢您使用电竞猎人！",
                emailBodyType: "text"
            });

            /*
            * Add an element without using PDF24Element
            */
            doc.addElement({
                // title : "This is a title",
                // url : "http://www.pdf24.org",
                // author : "Stefan Ziegler",
                // dateTime : "2010-04-15 8:00",
                body :$('#resume_preview').html()
            });

            /*
            * Create the PDF file
            */
            doc.create();
        }
    
    </script>
@endsection
