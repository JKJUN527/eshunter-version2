@extends('layout.master')
@section('title', '预览一般简历')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('style/font-awesome.min.css')}}"/>
    <style>
        ol, ul {
            margin-bottom: 0px !important;
        }

        ul li {
            margin-bottom: 0px !important;

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

        .mdl-card__title i {
            color: tomato;
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

        .education-panel p span:first-child {
            /*min-width: 103px;*/
            width: 105px;
        }

        .education-panel p span:nth-child(2) {
            /*width: 80px;*/
            /*max-width: 100px;*/
        }

        .education-panel p span:last-child {
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

    <div class="container">

        <div class="resume-card mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                        to="/resume/add?rid={{$data['rid']}}">
                    <i class="material-icons">arrow_back</i>
                </button>
                <h5 class="mdl-card__title-text" style="margin-left: 16px;">预览一般简历</h5>
            </div>

            <div class="mdl-card__menu">
                <button class="mdl-button mdl-js-button btn btn-link waves-effect" id="download_resume">
                    <i class="material-icons">file_download</i> 下载简历预览
                </button>
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
                #resume_preview {
                    margin: 40px 0;
                }

                .resume-card {
                    width: 100%;
                    margin: 50px 0 20px 0;
                    min-height: 0;
                }

                .mdl-card__title i {
                    color: tomato;
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

                .education-panel p span:first-child {
                    /*min-width: 103px;*/
                    width: 105px;
                }

                .education-panel p span:nth-child(2) {
                    /*width: 80px;*/
                    /*max-width: 100px;*/
                }

                .education-panel p span:last-child {
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

                .info_panel {
                    min-height: 300px;
                    margin-top: 45px;
                }

                .left_panel {
                    width: 900px;
                    margin: 0 auto;
                    background: #fafafa;
                    border-radius: 5px;
                    border: 1px solid #f2f2f2;
                }

                .resume_header {
                    width: 900px;
                    height: 200px;
                    background: url({{asset("images/resume/resume_header.jpg")}});
                    border-radius: 5px;
                    position: relative;
                }

                .cover {
                    width: 900px;
                    height: 200px;
                    background-color: rgba(0, 0, 0, .3);
                    position: absolute;
                    border-radius: 10px 10px 0 0;
                }

                .head_pic input {
                    opacity: 0;
                    cursor: pointer;
                    border-radius: 50%;
                    position: absolute;
                    left: 385.5px;
                    top: 100px;
                    width: 129px;
                    height: 129px;
                }

                .head_pic_img {
                    cursor: pointer;
                    border-radius: 50%;
                    position: absolute;
                    left: 385.5px;
                    top: 100px;
                    padding: 5px;
                    background-color: #fafafa;
                }

                .base_info {
                    padding: 35px 40px;
                    margin-top: 15px;
                }

                .base_info p {
                    text-align: center;
                    padding: 5px 0;
                    position: relative;
                }

                p.name {
                    font-size: 24px;
                    font-weight: bold;
                    color: #000;
                }

                p.bio {
                    font-size: 16px;
                    color: #404040;
                }

                p.others span {
                    color: #a3a3a3;
                    font-size: 12px;
                    margin-right: 15px;
                }

                p.others i {
                    font-size: 12px;
                    position: relative;
                    top: 2px;
                    margin-right: 10px;
                }

                .line-left {
                    width: 340px;
                    height: 1px;
                    border-top: 1px solid #ededed;
                }

                .line-right {
                    width: 340px;
                    height: 1px;
                    border-top: 1px solid #ededed;
                }

                span.mdl-card__title-text {
                    width: 170px;
                    font-size: 18px;
                    padding: 6px 24px;
                    display: inline-block;
                    text-align: center !important;
                    background-color: #eee;
                    margin: 0 13px;
                    -moz-border-radius: 26px;
                    -webkit-border-radius: 26px;
                    border-radius: 26px;
                }

            </style>

            <div class="left_panel info_panel">
                {{--头像显示不了，我就隐藏了！--}}
                <div class="resume_header">
                <div class="cover"></div>
                <div class="head_pic">
                <img src="{{ $data['userinfo']->photo or  asset("images/resume/default_headpic.png")}}" alt="" class="head_pic_img" width="120"
                height="120">
                </div>
                </div>

                <div class="base_info" id="base-info">
                    <p class="name"><span>{{$data['userinfo']->pname or "姓名未填写"}}</span></p>
                    <p class="bio"><span>{{$data['userinfo']->self_evalu or "自我评价未填写"}}</span></p>
                    <p class="others">
                        <span><i class="material-icons">school</i>
                            @if(isset($data['education'][0]))
                                {{$data['education'][0]->major}}-{{$data['education'][0]->school}}
                            @else
                                未知专业-未知学校
                            @endif
                        </span><br>
                        <span><i class="material-icons">people</i>
                            @if($data['userinfo']->education == 0)
                                高中
                            @elseif($data['userinfo']->education == 1)
                                本科
                            @elseif($data['userinfo']->education == 2)
                                硕士及以上
                            @elseif($data['userinfo']->education == 3)
                                专科
                            @endif
                            -
                            {{$data['userinfo']->residence}}
                        </span><br>

                        <span><i class="material-icons">phone</i>{{$data['userinfo']->tel or "电话未填写"}}</span>
                        <span><i class="material-icons">email</i>{{$data['userinfo']->mail or "邮箱未填写"}}</span>
                    </p>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <span class="line-left"></span>
                        <span class="mdl-card__title-text">求职意向</span>
                        <span class="line-right"></span>
                    </div>

                    <div class="mdl-card__actions intention-panel">

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
                        <span class="line-left"></span>
                        <span class="mdl-card__title-text">教育经历</span>
                        <span class="line-right"></span>
                    </div>

                    <div class="mdl-card__actions education-panel">

                        @forelse($data['education'] as $education)
                            <p>
                                <span>{{$education->school}}</span>
                                @if($education->gradu_date !=NULL)
                                    <span>{{$education->date}}-{{$education->gradu_date}}</span>
                                @else
                                    <span>{{$education->date}}- -</span>
                                @endif
                                <span>
                                    @if($education->degree == 0)
                                        高中
                                    @elseif($education->degree == 1)
                                        本科
                                    @elseif($education->degree == 3)
                                        专科
                                    @elseif($education->degree == 2)
                                        硕士及以上
                                    @endif
                                </span>
                                <span>{{$education->major}}</span>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                无教育经历
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <span class="line-left"></span>
                        <span class="mdl-card__title-text">工作经历</span>
                        <span class="line-right"></span>
                    </div>

                    <div class="mdl-card__actions work-panel">

                        @forelse($data['work'] as $work)
                            <p>
                                <?php
                                $index = 1;
                                ?>
                                <span>
                            @foreach(explode('@', $work->work_time) as $time)
                                        @if($index == 1)
                                            {{$time}}--
                                        @elseif($index == 2)
                                            {{$time}}
                                        @endif

                                        <?php $index++ ?>
                                    @endforeach
                            </span>
                                <span>{{$work->ename}}</span>
                                <span>{{$work->position}}</span></br>
                            <p style="width: auto">{!! $work->describe !!}</p>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                无工作经历
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <span class="line-left"></span>
                        <span class="mdl-card__title-text">项目/赛事经历</span>
                        <span class="line-right"></span>
                    </div>

                    <div class="mdl-card__actions work-panel">

                        @forelse($data['project'] as $project)
                            <p>
                                <?php
                                $index = 1;
                                ?>
                                <span>
                                @foreach(explode('@', $project->project_time) as $time)
                                        @if($index == 1)
                                            {{str_replace('-','/',$time)}} --
                                        @elseif($index == 2)
                                            {{str_replace('-','/',$time)}}
                                        @endif
                                        <?php $index++ ?>
                                    @endforeach
                                </span>
                                <span>{{$project->project_name}}</span>
                                <span>{{$project->position}}</span>
                                <span style="width: 90%">{!! $project->describe !!}</span>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                无项目经历
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <span class="line-left"></span>
                        <span class="mdl-card__title-text">电竞经历</span>
                        <span class="line-right"></span>
                    </div>

                    <div class="mdl-card__actions education-panel">
                        @forelse($data['game'] as $game)
                            <p>
                                <span>{{$game->ename}}</span>
                                <span>{{$game->level}}</span>
                                <span>{{$game->date}} 开始接触</span>
                            @if($game->extra != null && $game->extra != "")
                                <p style="width: auto">{!! $game->extra !!}</p>
                                @endif
                                </p>
                                @empty
                                    <div class="mdl-card__supporting-text">
                                        无电竞经历
                                    </div>
                                @endforelse
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <span class="line-left"></span>
                        <span class="mdl-card__title-text">技能特长</span>
                        <span class="line-right"></span>
                    </div>

                    <div class="mdl-card__actions skill-panel">
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
                        <span class="line-left"></span>
                        <span class="mdl-card__title-text">附加信息</span>
                        <span class="line-right"></span>
                    </div>

                    <div class="mdl-card__actions additional-panel">

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

            {{--<div class="mdl-card resume-child-card base-info--user" style="padding-bottom: 20px;">--}}

            {{--@if(count($data['personInfo']) != 0)--}}
            {{--<div class="base-info__header">--}}
            {{--<img class="img-circle info-head-img"--}}
            {{--src="{{$data['personInfo'][0]->photo or asset('images/avatar.png')}}" width="70px"--}}
            {{--height="70px">--}}

            {{--<div class="base-info__title">--}}
            {{--<p>{{$data['personInfo'][0]->pname or "姓名未填写"}}</p>--}}
            {{--<p><span>--}}
            {{--@if($data['personInfo'][0]->sex == null)--}}
            {{--性别未填写--}}
            {{--@elseif($data['personInfo'][0]->sex == 1)--}}
            {{--男--}}
            {{--@elseif($data['personInfo'][0]->sex == 2)--}}
            {{--女--}}
            {{--@endif--}}
            {{--</span> |--}}
            {{--<span>{{$data['personInfo'][0]->birthday or "生日未填写"}}</span> |--}}
            {{--<span>--}}
            {{--@if($data['personInfo'][0]->residence == null)--}}
            {{--居住地未填写--}}
            {{--@else--}}
            {{--{{$data['personInfo'][0]->residence}}--}}
            {{--@endif--}}
            {{--</span>--}}
            {{--</p>--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<div class="mdl-card__actions mdl-card--border">--}}
            {{--<div class="mdl-card__title">--}}
            {{--<i class="fa fa-user-circle-o fa-2" aria-hidden="true"></i><h6--}}
            {{--class="mdl-card__title-text">自我评价</h6>--}}
            {{--</div>--}}

            {{--<div class="mdl-card__supporting-text">--}}
            {{--{{$data['personInfo'][0]->self_evalu or "自我评价未填写"}}--}}
            {{--</div>--}}
            {{--</div>--}}

            {{--<ul class="mdl-list base-info__contact">--}}
            {{--<li class="mdl-list__item">--}}
            {{--<span class="mdl-list__item-primary-content">--}}
            {{--<i class="material-icons mdl-list__item-icon">phone</i>--}}
            {{--{{$data['personInfo'][0]->tel or "手机号未填写"}}--}}
            {{--</span>--}}
            {{--</li>--}}
            {{--<li class="mdl-list__item">--}}
            {{--<span class="mdl-list__item-primary-content">--}}
            {{--<i class="material-icons mdl-list__item-icon">email</i>--}}
            {{--{{$data['personInfo'][0]->mail or "邮箱未填写"}}--}}
            {{--</span>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--@else--}}
            {{--<div class="mdl-card__supporting-text"--}}
            {{--style="padding: 24px 0 8px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">--}}
            {{--<p>个人资料暂未填写，资料填写后这里将显示您的基本信息</p>--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--</div>--}}
        </div>
        <!-- <div class="tips" style="display: none;">
            正在生成PDF中。。。
        </div> -->
        {{--<div style="text-align: center;margin-top: 12px;">--}}
        {{--<a class="btn btn-primary" id="download_resume">下载预览</a>--}}
        {{--</div>--}}

    </div>
@endsection

@section('custom-script')
    <script src="{{asset('js/pdf.js')}}"></script>


    <script type="text/javascript">
        document.getElementById("download_resume").onclick = function () {

            /*
            * Create a document with parameters
            */
            var doc = new PDF24Doc({
                charset: "UTF-8",
                // headline : "电竞猎人个人简历",
                // headlineUrl : "http://www.pdf24.org",
                // baseUrl : "http://www.pdf24.org",
                filename: "个人简历",
                pageSize: "210x297",
                emailTo: "stefanz@pdf24.org",
                emailFrom: "stefanz@pdf24.org",
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
                body: $('#resume_preview').html()
            });

            /*
            * Create the PDF file
            */
            doc.create();

            //发送简历下载到服务器，修改对应简历下载次数

        }

    </script>
@endsection
