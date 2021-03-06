@extends('layout.master')
@section('title', '添加选手简历')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('style/font-awesome.min.css')}}"/>

    <style>
        ol, ul {
            margin-bottom: 0px;
        }

        .nav_ul li a {
            text-decoration: none;
        }

        .resume-card {
            width: 99.52%;
            margin: 50px 0 20px 0;
            min-height: 0;
            position: relative;
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
            font-weight: 500;
            /*margin-bottom: 12px;*/
        }

        .intention-panel p,
        .baseinfo-panel p,
        .PlayerResume-panel p,
        .work-panel p {
            padding: 5px 10px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .baseinfo-panel p,
        .PlayerResume-panel p,
        .work-panel p {
            display: block !important;
            border: 1px solid #f5f5f5;
            margin: 16px;
            vertical-align: middle;
        }

        .project-panel p {
            padding: 5px 10px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
            display: block !important;
            border: 1px solid #f5f5f5;
            margin: 16px;
            vertical-align: middle;
        }

        .education-panel p:hover,
        .baseinfo-panel p:hover,
        .PlayerResume-panel p:hover,
        .work-panel p:hover {
            background-color: #f5f5f5;
        }

        .project-panel p:hover {
            background-color: #f5f5f5;
        }

        .intention-panel p span {
            color: #737373;
            font-size: 14px;
        }

        .baseinfo-panel p span {
            color: #737373;
            font-size: 14px;
        }

        .PlayerResume-panel span {
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
            min-width: 9rem;
            max-width: 15rem;
            overflow: hidden;
        }

        .project-panel p span {
            margin-right: 10px;
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            text-overflow: ellipsis;
        }

        .education-panel p span:first-child {
            /*min-width: 103px;*/
            /*width: 105px;*/
        }

        .education-panel p span:nth-child(2) {
            /*width: 80px;*/
            /*max-width: 100px;*/
        }

        .PlayerResume-panel p span:last-child {
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

        .project-panel p i {
            float: right;
            cursor: pointer;
            font-size: 16px;
            color: #D32F2F;
            position: relative;
            top: 5px;
            border-radius: 16px;
            background: #f5f5f5;
        }

        .skill-panel span i:hover,
        .education-panel p i:hover,
        .baseinfo-panel p i:hover,
        .PlayerResume-panel p i:hover,
        .work-panel p i:hover {
            background: #ebebeb;
            color: #F44336;
        }

        .project-panel p i:hover {
            background: #ebebeb;
            color: #F44336;
        }

        .skill-panel span {
            display: inline-block;
            background: #03A9F4;
            padding: 8px 30px 8px 12px;
            margin: 6px;
            font-size: 13px;
            font-weight: 300;
            color: #ffffff;
            border-radius: 3px;
            position: relative;
        }

        .skill-panel span i {
            position: absolute;
            right: 8px;
            top: 27%;
            font-size: 16px;
            color: #D32F2F;
            border-radius: 16px;
            background: #f5f5f5;
            cursor: pointer;
        }

        .additional-panel p {
            padding: 0 8px;
        }

        .intention-panel-update,
        .baseinfo-panel-update,
        .skill-panel-update,
        .PlayerResume-panel-update,
        .additional-panel-update,
        .game-panel-update {
            padding: 20px;
            background-color: #f5f5f5;
            z-index: auto;
        }

        /*------------------*/

        .form-group {
            display: inline-block;
            margin-bottom: 25px;
        }

        .form-control {
            display: inline-block;
            padding: 6px 12px 6px 0;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #f5f5f5;
        }

        .form-control button[type="button"] {
            background-color: #f5f5f5 !important;
        }

        .dropdown-menu {
            z-index: 999;
        }

        .dropdown-menu li {
            display: block;
            width: 100%;
            margin: 0;
        }

        .bs-searchbox > input {
            display: inline-block;
            width: 385px !important;
            padding: 6px 12px !important;
            background-color: #ffffff !important;
        }

        .resume-name--form {
            width: 180px;
            padding-left: 16px;
        }

        .resume-name--form input {
            background-color: transparent;
        }

        /*#resume-name--change {*/
        /*width: 88px;*/
        /*position: absolute;*/
        /*left: 200px;*/
        /*top: 89px;*/
        /*}*/

        #indicatorContainer {
            position: absolute;
            right: 2rem;
            top: 1rem;
        }

        .blue-btn {
            height: 36px;
            padding: 0 16px;
        }

        .button-panel button {
            margin: auto 25px;
        }

        .button-panel {
            text-align: center;
            padding: 20px;
        }

        .datetimepicker {
            left: 60% !important;
        }

        .datetimepicker-years .year {
            margin-left: 1rem;
        }

        .datetimepicker-months .month {
            margin-left: 1rem;
        }

        /*重新设计简历页面*/

        body {
            background: #ffffff;
        }

        .info_panel {
            min-height: 300px;
            margin-top: 45px;
        }

        .left_panel {
            float: left;
            width: 835px;
            background: #fafafa;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #f2f2f2;
        }

        .right_panel {
            float: right;
            width: 260px;
        }

        .resume_header {
            width: 835px;
            height: 200px;
            background: url({{asset("images/resume/resume_header.jpg")}});
            border-radius: 5px;
            position: relative;
        }

        .cover {
            width: 835px;
            height: 200px;
            /*background-color: rgba(0, 0, 0, .3);*/
            position: absolute;
            border-radius: 10px 10px 0 0;
        }

        .head_pic input {
            opacity: 0;
            cursor: pointer;
            border-radius: 50%;
            position: absolute;
            left: 353px;
            top: 100px;
            width: 129px;
            height: 129px;
        }

        .head_pic_img {
            cursor: pointer;
            border-radius: 50%;
            position: absolute;
            left: 353px;
            top: 100px;
            padding: 5px;
            background-color: #fafafa;
        }

        .shadow {
            position: absolute;
            left: 353px;
            top: 100px;
            opacity: 0;
        }

        .head_pic:hover .shadow {
            opacity: 1;
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

        .base_info p:hover {
            background-color: #fefef2;
        }

        .base_info p:hover .edit {
            display: block;
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

        .edit {
            font-size: 12px !important;
            color: #00b38a;
            position: absolute;
            top: 2px;
            right: 10px;
            display: none;
        }

        .edit a {
            text-decoration: none;
            cursor: pointer;
        }

        .edit i {
            font-size: 12px !important;
        }

        .edit:hover {
            color: #00b38a;
            text-decoration: none;
        }

        .mdl-card {
            background: #fafafa !important;
        }

        .mdl-card__title {
            padding-bottom: 20px;
            text-align: center !important;
        }

        .mdl-card__title i.fa {
            color: #00B38A;
            margin-right: 10px;
        }

        /*right panel*/

        .right-item {
            padding: 16px 10px;
            background-color: #fafafa;
            border: 1px solid #f2f2f2;
            border-radius: 3px;
            margin-bottom: 20px;
        }

        .progress {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            -ms-border-radius: 0;
            border-radius: 3px;
            height: 8px;
            margin: 15px 10px;
        }

        .progress .progress-bar {
            line-height: 23px;
            height: 23px;
            background-color: #00b38a;
        }

        .progress-bar {
            float: left;
            width: 0;
            height: 100%;
            font-size: 12px;
            line-height: 20px;
            color: #fff;
            text-align: center;
            background-color: #00b38a;
            -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
            box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .1);
            -webkit-transition: width .6s ease;
            -o-transition: width .6s ease;
            transition: width .6s ease;
        }

        .progress-info {
            margin: 0 10px;
            font-weight: lighter;
        }

        .right-item span em,
        .right-item a {
            color: #00b38a;
            text-decoration: none;
        }

        .right-item a {
            float: right;
            font-weight: normal;
            font-size: 12px;
            cursor: pointer;
        }

        .resume-name {
            margin: 0 10px;
        }

        #resume-name-update {

        }

        .dn {
            display: none;
        }

        .right-nav {
            border-left: 1px solid #f2f2f2;
        }

        .right-nav ul li a {
            line-height: 50px;
            cursor: pointer;
            display: block;
            height: 50px;
            color: #333;
            border-left: 2px solid transparent;
            text-decoration: none;
        }

        .right-nav ul li a i {
            margin: 0 15px 0 30px;
        }

        .right-nav ul li a:hover {
            background-color: #fafafa;
            border-left: 2px solid #00b38a;
            color: #00B38A;
        }

        .active-nav-item {
            background-color: #fafafa;
            border-left: 2px solid #00b38a;
            color: #00B38A;
        }

        .right-nav.affix {
            top: 10px;
        }

        .line-left {
            width: 319px;
            height: 1px;
            border-top: 1px solid #ededed;
        }

        .line-right {
            width: 240px;
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

        .mdl-card__actions {
            min-height: 100px;
        }

        .mdl-card__menu button i {
            color: #00B38A;
        }

        .update-resume-name {
            vertical-align: central;
        }

        input[name='resume-name'] {
            width: 140px;
            font-size: 10px;
            padding: 2px 5px;
        }

        input[name='name'] {
            width: 200px;
            height: 30px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .save-btn {
            background-color: #00B38A;
            -moz-border-radius: 2px;
            -webkit-border-radius: 2px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: lighter;
            color: #fff;
            padding: 0 5px;
            margin: 0 5px;
            position: relative;
            top: -1px;
        }

        .save-btn-big {
            background-color: #00B38A;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 6px;
            font-weight: lighter;
            color: #fff;
            padding: 12px 18px;
            font-size: 16px;
            vertical-align: middle;
        }

        .base_info__name,
        .bio {
            text-align: center;
            margin-bottom: 16px;
        }

        form.form_base_info__name,
        form.form_base_info__bio {
            position: relative;
        }

        #cancel_update_name,
        #cancel_update_bio {
            font-weight: normal;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
            color: #00B38A;
            position: absolute;
            right: 10px;
            top: 6px;
        }

        #cancel_update_others {
            padding: 12px 18px;
            font-size: 16px;
            vertical-align: middle;
            text-decoration: none;
            color: #00B38A;
            cursor: pointer;
            font-weight: 300;
        }

        .base_info__name form input[type="submit"],
        .bio form input[type="submit"] {
            position: absolute;
            right: 50px;
            top: 5px;
        }

        .form_base_info__others {
            background: #fefef2;
        }

        .form_base_info__others input,
        .form_base_info__others select,
        .form_base_info__others select option {
            text-align: left;
            padding-left: 17px;
            width: 327px;
            height: 44px;
            background-color: #fff;
        }

        .form_base_info__others label {
            display: block;
            font-size: 15px;
            font-weight: 300;
            margin-top: 20px;
        }

        .others form {
            padding: 35px 40px;
        }

        .right-item h6 {
            margin-top: 0;
            margin-left: 10px;
        }

        .help_guide {
            padding-right: 10px;
            color: #8c8c8c !important;
            font-weight: 200 !important;
        }

        .help_guide:hover {
            color: #00B38A !important;
            cursor: help;
        }

        .affix {
            width: 260px;
        }
        .mini-title{
            color: #333333 !important;
            font-size: 16px !important;
            min-width:6rem !important;
            margin-right: 0 !important;
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
        <div class="left_panel info_panel">
            <div class="resume_header">
                <div class="cover"></div>
                <div class="head_pic">
                    <img src="{{$data['userinfo']->photo or asset("images/resume/default_headpic.png")}}" alt=""
                         class="head_pic_img" width="120"
                         height="120">
                    <img src={{asset("images/resume/head_pic_shadow.png")}} alt="" class="shadow" width="120"
                         height="120">
                    <input type="file" name="head_pic" title="支持jpg、jpeg、gif、png格式，文件小于10M"
                           onchange="showPreview(this);"/>
                </div>
            </div>

            <input type="hidden" name="rid" value="{{$data['rid']}}">

            <div class="base_info" id="base-info">
                <p class="name base_info__name">
                    <span>{{$data['userinfo']->pname or "姓名未填写"}}</span>
                    <a class="edit edit-name" id="update_name__btn"><i class="material-icons">edit</i> 编辑</a>
                </p>

                <div class="dn base_info__name">
                    <form action="" class="form_base_info__name">
                        <input type="text" name="pname" value="{{$data['userinfo']->pname or "姓名未填写"}}">
                        <input type="submit" value="保存" class="save-btn">
                        <a id="cancel_update_name">取消</a>
                    </form>
                </div>

                <p class="bio">
                    <span>{{$data['userinfo']->self_evalu or "自我评价未填写"}}</span>
                    <a class="edit edit-bio" id="update_bio_btn"><i class="material-icons">edit</i> 编辑</a>
                </p>

                <div class="dn bio">
                    <form action="" class="form_base_info__bio">
                        <input type="text" name="self_evalu" value="{{$data['userinfo']->self_evalu or "自我评价未填写"}}">
                        <input type="submit" value="保存" class="save-btn">
                        <a id="cancel_update_bio">取消</a>
                    </form>
                </div>

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
                    <a class="edit edit-others" id="update_others_btn"><i class="material-icons">edit</i>编辑</a>
                </p>
            </div>

            <div class="others dn">
                <form action="" class="form_base_info__others">
                    {{--<label for="base_info__school">毕业院校</label>--}}
                    {{--<input type="text" id="base_info__school" class="base_info__school" name="base_info__school" value="{{$data['education'][0]->school}}">--}}

                    {{--<label for="base_info__major">主修专业</label>--}}
                    {{--<input type="text" id="base_info__major" class="base_info__major" name="base_info__major" value="{{$data['education'][0]->major}}">--}}

                    <label for="base_info__degree">最高学历</label>
                    <select name="base_info__degree" id="base_info__degree">
                        <option value="9" @if($data['userinfo']->education == 9) selected @endif>
                            请选择最高学历
                        </option>
                        <option value="0" @if($data['userinfo']->education == 0) selected @endif>高中
                        </option>
                        <option value="3" @if($data['userinfo']->education == 3) selected @endif>专科
                        </option>
                        <option value="1" @if($data['userinfo']->education == 1) selected @endif>本科
                        </option>
                        <option value="2" @if($data['userinfo']->education == 2) selected @endif>
                            研究生及以上
                        </option>
                    </select>

                    {{--工作年限--}}
                    {{--<label for="base_info__workingyears">工作年限</label>--}}
                    {{--<select name="base_info__workingyears" id="base_info__workingyears">--}}
                    {{--<option value="0">应届毕业生</option>--}}
                    {{--@foreach([1,2,3,4,5,6,7,8,9,10] as $working_years)--}}
                    {{--<option value="1">{{$working_years}}年</option>--}}
                    {{--@endforeach--}}
                    {{--<option value="11">10年以上</option>--}}
                    {{--</select>--}}

                    <label for="base_info__city">城市</label>
                    <input type="text" id="base_info__city" class="base_info__city" name="base_info__city"
                           value="{{$data['userinfo']->residence}}">

                    <label for="base_info__phonenumber">手机号码</label>
                    <input type="text" id="base_info__phonenumber" class="base_info__phonenumber"
                           name="base_info__phonenumber" value="{{$data['userinfo']->tel}}">

                    <label for="base_info__email">联系邮箱</label>
                    <input type="text" id="base_info__email" class="base_info__email" name="base_info__email"
                           value="{{ $data['userinfo']->mail }} ">

                    <div style="margin-top: 20px;">
                        <button class="save-btn-big" id="save_othres">保存</button>
                        <a id="cancel_update_others">取消</a>
                    </div>
                </form>
            </div>

            <div class="mdl-card resume-child-card" id="intention">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">求职意向</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-intention">
                        <i class="material-icons">mode_edit</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-intention">
                        修改
                    </div>
                </div>

                <div class="mdl-card__actions intention-panel">

                    @if($data['intention'] == null)
                        <div class="mdl-card__supporting-text">
                            您还没有填写过求职意向，点击右上角进行填写
                        </div>
                    @else
                        <p>地区：
                            <span>
                                    @foreach($data['province'] as $province)
                                    @if($data['intention']->region == $province->id)
                                        {{$province->name}}
                                        @break
                                    @endif
                                @endforeach
                                @foreach($data['city'] as $city)
                                    @if($data['intention']->region == $city->id)
                                        {{$city->name}}
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

                <div class="mdl-card__actions mdl-card--border intention-panel-update">
                    <label for="position-place">意向省份</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" id="position-place"
                                data-live-search="true" name="place">
                            @if($data['intention'] == null)
                                <option value="-1">任意</option>
                                @foreach($data['province'] as $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                @endforeach
                            @else
                                @if($data['intention']->region == -1)
                                    <option value="-1" selected>任意</option>
                                @else
                                    <option value="-1">任意</option>
                                @endif
                                {{$default_province =$data['intention']->region }}
                                @foreach($data['province'] as $province)
                                    @foreach($data['city'] as $city)
                                        @if($data['intention']->region == $city->id)
                                            <?php $default_province = $city->parent_id ?>
                                            @break
                                        @endif
                                    @endforeach
                                    @if($default_province == $province->id)
                                        <option value="{{$province->id}}" selected>{{$province->name}}</option>
                                    @else
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        <label class="error" for="position-place"></label>
                    </div>
                    <label for="position-city" id="citylabel" style="display: none">意向城市</label>
                    @foreach($data['province'] as $province)
                        <div class="form-group" id="city-display{{$province->id}}"
                             name="city-display" style="display: none">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-city"
                                    data-live-search="true" name="city{{$province->id}}">
                                <option value="-1" selected>任意</option>
                                @foreach($data['city'] as $city)
                                    @if($city->parent_id == $province->id)
                                        @if($data['intention']->region == $city->id)
                                            <option value="{{$city->id}}" selected>{{$city->name}}</option>
                                        @else
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            <label class="error" for="position-city"></label>
                        </div>
                    @endforeach

                    <label for="position-industry">行业意向</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" disabled id="position-industry"
                                name="industry">

                            @if($data['intention'] == null)
                                <option value="-1">任意</option>
                                @foreach($data['industry'] as $industry)
                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                @endforeach
                            @else
                                @if($data['intention']->industry == -1)
                                    <option value="-1" selected>任意</option>
                                @else
                                    <option value="-1">任意</option>
                                @endif
                                @foreach($data['industry'] as $industry)
                                    @if($data['intention']->industry == $industry->id)
                                        <option value="{{$industry->id}}" selected>{{$industry->name}}</option>
                                    @else
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <label for="position-occupation" id="occulabel" style="display:none">游戏意向</label>
                    @foreach($data['industry'] as $industry)
                        <div class="form-group" id="occupation-display{{$industry->id}}" name="occupation-display"
                             style="display:none;">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="position-occupation"
                                    name="occupation{{$industry->id}}">

                                @if($data['intention'] == null)
                                    <option value="-1">任意</option>
                                    @foreach($data['occupation'] as $occupation)
                                        @if($occupation->industry_id == $industry->id)
                                            <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                        @endif
                                    @endforeach

                                @else
                                    @if($data['intention']->occupation == -1)
                                        <option value="-1" selected>任意</option>
                                    @else
                                        <option value="-1">任意</option>
                                    @endif
                                    @foreach($data['occupation'] as $occupation)
                                        @if($occupation->industry_id == $industry->id)
                                            @if($data['intention']->occupation == $occupation->id)
                                                <option value="{{$occupation->id}}"
                                                        selected>{{$occupation->name}}</option>
                                            @else
                                                <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    @endforeach

                    <label for="position-type">工作类型意向</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" id="position-type" name="type">
                            @if($data['intention'] == null)
                                <option value="-1">任意</option>
                                <option value="0">兼职</option>
                                <option value="1">实习</option>
                                <option value="2">全职</option>
                            @else
                                <option value="-1" {{$data['intention']->work_nature==-1?"selected":""}}>任意</option>
                                <option value="0" {{$data['intention']->work_nature==0?"selected":""}}>兼职</option>
                                <option value="1" {{$data['intention']->work_nature==1?"selected":""}}>实习</option>
                                <option value="2" {{$data['intention']->work_nature==2?"selected":""}}>全职</option>
                            @endif
                        </select>
                    </div>

                    <label for="position-salary">薪资意向（月）</label>
                    <div class="form-group">
                        <div class="form-line">
                            @if($data['intention'] == null || $data['intention']->salary < 0)
                                <input type="number" id="position-salary" name="salary" class="form-control"
                                       step="1" placeholder="薪资意向(单位：元)，选填">
                            @else
                                <input type="number" id="position-salary" name="salary" class="form-control"
                                       step="1" placeholder="薪资意向(单位：元)，选填"
                                       value="{{$data['intention']->salary}}">
                            @endif
                        </div>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-intention--button"
                                class="btn btn-primary blue-btn">
                            确认修改／新增
                        </button>
                    </div>
                </div>
            </div>

            <div class="mdl-card resume-child-card" id="egameexp">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">游戏段位</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-PlayerResume">
                        <i class="material-icons">add</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-PlayerResume">
                        添加
                    </div>
                </div>

                <div class="mdl-card__actions PlayerResume-panel">

                    @forelse($data['playerResume'] as $playerResume)
                        <p id="playerResume_info" name="playerResume_info" data-content="{{$playerResume->id}}">
                            <span class="mini-title">游戏ID：</span><span>{{$playerResume->game_id}}</span>
                            <span class="mini-title">游戏名称：</span><span>{{$playerResume->egame}}</span>
                            <span class="mini-title">选手位置：</span><span>{{$playerResume->place}}</span>
                            <br>
                            <span class="mini-title">服务器：</span><span>{{$playerResume->service}}</span>
                            <span class="mini-title">胜率：</span><span>{{$playerResume->probability*10}}%~{{($playerResume->probability+1)*10}}
                                %</span>
                            <span class="mini-title">最高排位：</span><span>{{$playerResume->best_result}}</span>
                            <br>
                            @if($playerResume->has_event == 0)
                                无赛事经历
                            @else
                                赛事名称：<span>{{$playerResume->event_name}}</span>
                                赛事排名：<span>{{$playerResume->event_ranking}}</span>
                            @endif
                            <i class="material-icons playerResume-delete playerResume-item"
                               data-content="{{$playerResume->id}}">close</i>
                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            您还没有填写过选手经历，点击右上角进行填写
                        </div>
                    @endforelse
                </div>

                <div class="mdl-card__actions mdl-card--border PlayerResume-panel-update">

                    <label for="PlayerResume-gameID">游戏ID</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="gameID" name="gameID" class="form-control" placeholder="不能为空">
                            <input type="text" id="PlayerResumeID" name="PlayerResumeID" class="form-control"
                                   value="-1" style="display: none">
                        </div>
                        <label class="error" for="school"></label>
                    </div>

                    <label for="PlayerResume-gamename">游戏种类</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" id="PlayerResume-gamename"
                                name="PlayerResume-gamename">
                            <option value="-1">请选择游戏种类</option>
                            @foreach($data['occupation'] as $occupation)
                                <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                            @endforeach
                        </select>
                        <label class="error" for="PlayerResume-gamename"></label>
                    </div>

                    <label for="PlayerResume-place">选手位置</label>
                    @foreach($data['occupation'] as $occupation)
                        <div class="form-group" style="display: none" id="game-place{{$occupation->id}}"
                             name="game-place">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker"
                                    id="PlayerResume-place{{$occupation->id}}" name="PlayerResume-place">
                                @foreach($data['gamingposition'] as $item)
                                    @if($item->occupation_id == $occupation->id)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endif
                                @endforeach
                                <option value="-1">其他</option>
                            </select>
                        </div>
                    @endforeach

                    <label for="PlayerResume-service">所在服务器</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="PlayerResume-service" name="PlayerResume-service"
                                   class="form-control"
                                   placeholder="可以为空">
                        </div>
                    </div>
                    <label for="PlayerResume-grade">最高段位</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="PlayerResume-grade" name="PlayerResume-grade"
                                   class="form-control"
                                   placeholder="可填写段位，排名，KDA等各种信息">
                        </div>
                    </div>
                    <label for="PlayerResume-probability">排位胜率</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" id="PlayerResume-probability"
                                name="PlayerResume-probability">
                            <option value="0">0~10%</option>
                            <option value="1" selected>10~20%</option>
                            <option value="2">20~30%</option>
                            <option value="3">30~40%</option>
                            <option value="4">40~50%</option>
                            <option value="5">50~60%</option>
                            <option value="6">60~70%</option>
                            <option value="7">70~80%</option>
                            <option value="8">80~90%</option>
                            <option value="9">90~100%</option>
                        </select>
                    </div>
                    <label for="PlayerResume-event">赛事经历</label>
                    <div class="form-group">
                        <select class="form-control show-tick selectpicker" id="PlayerResume-event"
                                name="PlayerResume-event">
                            <option value="0">无赛事经历</option>
                            <option value="1">有赛事经历</option>
                        </select>
                        <div class="form-line">
                            <input  style="display: none;" type="text" id="PlayerResume-eventname" name="PlayerResume-eventname"
                                   class="form-control"
                                   placeholder="赛事名称">
                            <label class="error" for="PlayerResume-eventname"></label>
                        </div>
                        <div class="form-line">
                            <input style="display: none;" type="text" id="PlayerResume-eventranking" name="PlayerResume-eventranking"
                                   class="form-control"
                                   placeholder="赛事排名">
                            <label class="error" for="PlayerResume-eventranking"></label>
                        </div>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-PlayerResume--button"
                                class="btn btn-primary blue-btn">
                            确认添加
                        </button>
                    </div>

                </div>
            </div>

            <div class="mdl-card resume-child-card" id="player_info">

                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">选手信息</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-baseinfo">
                        <i class="material-icons">mode_edit</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-intention">
                        修改
                    </div>
                </div>

                <div class="mdl-card__actions baseinfo-panel">

                    @if($data['resume'] == null)
                        <div class="mdl-card__supporting-text">
                            您还没有填写过选手基本信息，点击右上角进行填写
                        </div>
                    @else
                        <p>是否曾是职业选手：
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

                <div class="mdl-card__actions mdl-card--border baseinfo-panel-update">
                    <label for="baseinfo-professional">是否曾是职业选手</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" id="baseinfo-professional"
                                name="baseinfo-professional">
                            <option value="0" @if($data['resume']->professional == 0) selected @endif>不是</option>
                            <option value="1" @if($data['resume']->professional == 1) selected @endif>是</option>
                        </select>
                        <label class="error" for="professional"></label>
                    </div>
                    <label for="baseinfo-club">曾效力俱乐部</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="baseinfo-club" name="baseinfo-club" class="form-control"
                                   placeholder="曾经效力俱乐部" value="{{$data['resume']->club or "暂无"}}">
                        </div>
                        <label class="error" for="baseinfo-club"></label>
                    </div>
                    <label for="baseinfo-is_contract">是否有签订合同</label>
                    <div class="form-group">
                        <select class="form-control show-tick selectpicker" id="baseinfo-is_contract"
                                name="is_contract">
                            <option value="0" @if($data['resume']->is_contract == 0) selected @endif>没有</option>
                            <option value="1" @if($data['resume']->is_contract == 1) selected @endif>有</option>
                        </select>
                        <label class="error" for="baseinfo-is_contract"></label>
                    </div>
                    <label for="baseinfo-opinion">监护人意见</label>
                    <div class="form-group">
                        <select class="form-control show-tick selectpicker" id="baseinfo-opinion"
                                name="baseinfo-opinion">
                            <option value="0" @if($data['resume']->opinion == 0) selected @endif>沟通中</option>
                            <option value="1" @if($data['resume']->opinion == 1) selected @endif>同意</option>
                        </select>
                        <label class="error" for="baseinfo-opinion"></label>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-baseinfo--button"
                                class="btn btn-primary blue-btn">
                            确认修改／新增
                        </button>
                    </div>
                </div>
            </div>

            <div class="mdl-card resume-child-card" id="skill">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">技能特长</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-skill">
                        <i class="material-icons">add</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-skill">
                        添加
                    </div>
                </div>

                <div class="mdl-card__actions skill-panel">
                    {{--|@|王者荣耀|至尊星耀|@|LOL|最强王者--}}
                    @if($data['resume']['skill'] == null)
                        <div class="mdl-card__supporting-text">
                            您还没有填写过技能特长，点击右上角进行填写
                        </div>
                    @else
                        @foreach($data['resume']['skill'] as $skill)
                            <span>
                                    <small class="skill-item" style="font-size:120%">{{$skill}}</small>
                                    <i class="material-icons skill-item skill-delete">close</i>
                                </span>
                        @endforeach
                    @endif
                </div>

                <div class="mdl-card__actions mdl-card--border skill-panel-update">

                    <label for="skill-name">技能特长名称</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="skill-name" name="skill-name" class="form-control"
                                   placeholder="不能为空">
                        </div>
                        <label class="error" for="skill-name"></label>
                    </div>

                    <label for="skill-degree">级别</label>&nbsp;&nbsp;<small>例如：熟练度，分数，等级</small>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="skill-degree" name="skill-degree" class="form-control"
                                   placeholder="不能为空">
                        </div>
                        <label class="error" for="skill-degree"></label>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-skill--button"
                                class="btn btn-primary blue-btn">
                            确认添加
                        </button>
                    </div>
                </div>
            </div>

            <div class="mdl-card resume-child-card" id="additional">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">附加信息</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-additional">
                        <i class="material-icons">mode_edit</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-additional">
                        添加/修改
                    </div>
                </div>

                <div class="mdl-card__actions additional-panel">

                    @if($data['resume']->extra == null)
                        <div class="mdl-card__supporting-text">
                            写下您对电竞行业或者某个游戏的理解和想法
                        </div>
                    @else
                        <p>{{$data['resume']->extra}}</p>
                    @endif
                </div>

                <div class="mdl-card__actions additional-panel-update">

                    <label for="additional-content">添加附加内容</label>
                    <div class="form-group">
                        <div class="form-line">
                            @if($data['resume']->extra == null)
                                <textarea rows="5" class="form-control" name="additional-content"
                                          id="additional-content"
                                          placeholder="还有什么是我们没想到的？在这里填写你想填写的任意内容"></textarea>
                            @else
                                <textarea rows="5" class="form-control" name="additional-content"
                                          id="additional-content"
                                          placeholder="还有什么是我们没想到的？在这里填写你想填写的任意内容">{{$data['resume']->extra}}</textarea>
                            @endif
                        </div>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="additional-content--button"
                                class="btn btn-primary blue-btn">
                            确认
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="right_panel info_panel">

            <div class="right-item">
                <h6>选手简历</h6>
                <div class="resume-name">
                    <span>{{$data['resume']->resume_name}}</span>
                    <a id="update-resume-name">修改</a>
                </div>

                <div class="resume-name dn">
                    <form action="" class="update-resume-name">
                        <input type="text" name="resume-name" value="{{$data['resume']->resume_name}}">
                        <input type="submit" value="保存" class="save-btn" id="resume-name--change">
                        <a id="cancel-update-resume-name">取消</a>
                    </form>
                </div>
            </div>

            <div class="right-item">
                <div class="progress-info">
                    <span>简历完整度：<em>85%</em></span>
                    <a href="/resume/previewPlayer?rid={{$data['rid']}}">预览简历</a>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0"
                         aria-valuemax="100"
                         style="width: 85%;">
                        <span class="sr-only">85% Complete</span>
                    </div>
                </div>

                <a href="/about?page=tab1" target="_blank" class="help_guide"><i class="fa fa-question fa-2"></i>
                    简历指导</a>

                <div style="clear: both;"></div>
            </div>

            <div class="right-nav" data-spy="affix" data-offset-top="323">
                <ul>
                    <li class="">
                        <a href="#base-info" onclick="activeThis(this, e)"><i class="fa fa-pencil fa-2"
                                                                              aria-hidden="true"></i>基本信息</a>
                    </li>
                    <li>
                        <a href="#intention"><i class="fa fa-pencil fa-2" aria-hidden="true"></i>求职意向</a>
                    </li>

                    <li>
                        <a href="#egameexp"><i class="fa fa-gamepad fa-2" aria-hidden="true"></i>游戏段位</a>
                    </li>

                    <li>
                        <a href="#player_info"><i class="fa fa-list fa-2" aria-hidden="true"></i>选手信息</a>
                    </li>

                    <li>
                        <a href="#skill"><i class="fa fa-tags fa-2" aria-hidden="true"></i>技能特长</a>
                    </li>
                    <li>
                        <a href="#additional"><i class="fa fa-plus-square fa-2" aria-hidden="true"></i>附加信息</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/locales/bootstrap-datetimepicker.zh-CN.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('plugins/jquery/radialindicator.min.js')}}"></script>


    <script type="text/javascript">
        $(function () {
            var indexid = $("select[name='place']");
            var id = "#city-display" + indexid.val();
            var city_len = $("select[name='city" + indexid.val() + "'] option").length;
            if (city_len > 1) {
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "block");
                $(id).css("display", "block");
            } else {
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "none");
            }
        });

        $(".right-nav").find("ul li").click(function () {
            $(".active-nav-item").removeClass("active-nav-item");
            $(this).addClass("active-nav-item");
        });

        $("#update-resume-name").click(function () {
            $(".resume-name:first").addClass('dn');
            $(".resume-name:last").removeClass('dn');
        });

        $("#cancel-update-resume-name").click(function () {
            $(".resume-name:first").removeClass('dn');
            $(".resume-name:last").addClass('dn');
        });

        $("#update_name__btn").click(function () {
            $(".base_info__name:first").addClass("dn");
            $(".base_info__name:last").removeClass("dn");
        });

        $("#cancel_update_name").click(function () {
            $(".base_info__name:first").removeClass("dn");
            $(".base_info__name:last").addClass("dn");
        });

        $("#update_bio_btn").click(function () {
            $(".bio:first").addClass("dn");
            $(".bio:last").removeClass("dn");
        });

        $("#cancel_update_bio").click(function () {
            $(".bio:first").removeClass("dn");
            $(".bio:last").addClass("dn");
        });

        $("#update_others_btn").click(function () {
            $(".others:first").addClass("dn");
            $(".others:last").removeClass("dn");
        });

        $("#cancel_update_others").click(function () {
            $(".others:first").removeClass("dn");
            $(".others:last").addClass("dn");
        });

        $('.form_date').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 3,
            minView: 3,
            forceParse: 0,
            format: 'yyyy-mm'
        });
        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $intentionPanelUpdate = $(".intention-panel-update");
        $baseinfoPanelUpdate = $(".baseinfo-panel-update");
        $PlayerResumePanelUpdate = $(".PlayerResume-panel-update");
        $skillPanelUpdate = $(".skill-panel-update");
        $additionalPanelUpdate = $(".additional-panel-update");

        $intentionPanelUpdate.hide();
        $baseinfoPanelUpdate.hide();
        $PlayerResumePanelUpdate.hide();
        $skillPanelUpdate.hide();
        $additionalPanelUpdate.hide();

        $("#update-intention").click(function () {
            $intentionPanelUpdate.fadeIn();
        });
        $("#update-baseinfo").click(function () {
            $baseinfoPanelUpdate.fadeIn();
        });

        $("#update-PlayerResume").click(function () {

            $("input[id=gameID]").val("");//清空游戏id
            $("input[id=PlayerResume-service]").val("");//清空服务器
            $("input[id=PlayerResume-grade]").val("");//清空段位

            $PlayerResumePanelUpdate.fadeIn();
        });

        $("#update-skill").click(function () {
            $skillPanelUpdate.fadeIn();
        });

        $("#update-additional").click(function () {
            $additionalPanelUpdate.fadeIn();
        });

        $intentionPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $intentionPanelUpdate.hide();
        });

        $baseinfoPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $baseinfoPanelUpdate.hide();
        });

        $PlayerResumePanelUpdate.find(".button-panel>button.cancel").click(function () {
            $PlayerResumePanelUpdate.hide();
        });

        $skillPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $skillPanelUpdate.hide();
        });

        $additionalPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $additionalPanelUpdate.hide();
        });
        //修改已填写的选手经历
        $editPlayer = $("p[name=playerResume_info]");

        $editPlayer.click(function () {
            $playerid = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('id', $playerid);
            $.ajax({
                url: '/resume/getPlayerResumeinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditPlayer(result);
//                    console.log(result);
                }
            })

        });

        function showeditPlayer(data) {
            $("input[id=gameID]").val(data.game_id);//
            $("input[id=PlayerResumeID]").val(data.id);//
            $("select[id=PlayerResume-gamename] option[value='26']").attr("selected", true);
            $("select[name=PlayerResume-place]").find("option:contains(data.place)").attr("selected", true);
//            $("select[id=education-degree]").val(data.degree);//
            $("input[id=PlayerResume-service]").val(data.service);//
            $("input[id=PlayerResume-grade]").val(data.best_result);//
            $("select[id=PlayerResume-probability]").find("option:contains(data.probability)").attr("selected", true);
            $PlayerResumePanelUpdate.fadeIn();

        }

        //自动关联游戏和选手位置
        $('#PlayerResume-gamename').change(function () {
            var occupation_id = $('#PlayerResume-gamename').val();
            var position_id = "#game-place" + occupation_id;
            $("div[name=game-place]").hide();
            $(position_id).show();
        });
        //自动关联行业和职业信息
        $('#position-industry').change(function () {
//            document.getElementById("ddlResourceType").options.add(new Option(text,value));
            var indexid = $("select[name='industry']").val();
            var id = "#occupation-display" + indexid;
            $('div[name=occupation-display]').css("display", "none");
            $("#occulabel").css("display", "block");
            $(id).css("display", "block");
//            $(id).style.display = block;
        });
        //自动关联省份和城市
        $('#position-place').change(function () {
            var indexid = $("select[name='place']");
            var id = "#city-display" + indexid.val();
            var city_len = $("select[name='city" + indexid.val() + "'] option").length;
            if (city_len > 1) {
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "block");
                $(id).css("display", "block");
            } else {
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "none");
            }
        });
        //关联赛事经历
        $('#PlayerResume-event').change(function () {
            var event_name = $("#PlayerResume-eventname");
            var event_ranking = $("#PlayerResume-eventranking");
            if($(this).val() == 0){
//                alert($(this).val());
                event_name.fadeOut();
                event_ranking.fadeOut();
            }else{
                event_name.fadeIn();
                event_ranking.fadeIn();
            }
        });
        $("#resume-name--change").click(function () {

            var rid = $("input[name='rid']");
            var resumeName = $("input[name='resume-name']");

            if (resumeName.val() === "") {
                setError(resumeName, "resume-name", "不能为空");
                return;
            } else {
                removeError(resumeName, "resume-name");
            }

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('name', resumeName.val());

            $.ajax({
                url: '/resume/rename',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "简历名称已修改", result.msg, null);
                }
            })
        });

        $("#add-intention--button").click(function () {
            var rid = $("input[name='rid']");
//            var place = $("select[name='place']");
            var province = $("select[name='place']");
            var city = $("select[name='city" + province.val() + "']");
            var city_len = $("select[name='city" + province.val() + "'] option").length;
            var industry = $("select[name='industry']");
//            var occupation = $("select[name='occupation']");
            var occupation = $("select[name='occupation" + industry.val() + "']");
            var type = $("select[name='type']");
            var salary = $("input[name='salary']");

            if (province.val() != "-1" && city.val() === "-1" && city_len > 1) {
                setError(city, "position-city", "请选择工作城市");
                return;
            } else {
                removeError(city, "position-city");
            }

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('work_nature', type.val());
            formData.append('industry', industry.val());
            if (industry.val() == -1) {
                formData.append('occupation', -1);
            } else
                formData.append('occupation', occupation.val());

            if (city_len > 1) {//省份有城市--非直辖市
                formData.append("region", city.val());
            } else {
                formData.append("region", province.val());
            }
//            formData.append('region', place.val());


            if (salary.val() === '') {
                formData.append('salary', -1);
            } else {
                formData.append('salary', salary.val());
            }

            $.ajax({
                url: "/resume/addIntention",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    checkResult(result.status, "求职意向已更新", result.msg, $intentionPanelUpdate);
                }
            })
        });

        $("#add-PlayerResume--button").click(function () {

            var playerID = $("input[name='PlayerResumeID']");
            var gameid = $("input[name='gameID']");
            var gamename = $("select[name='PlayerResume-gamename']");

            var place_id = "#PlayerResume-place" + gamename.val();
            var place = $(place_id);
            var service = $("input[name='PlayerResume-service']");
            var grade = $("input[name='PlayerResume-grade']");
            var probability = $("select[name='PlayerResume-probability']");

            var event = $("#PlayerResume-event");
            var event_name = $("#PlayerResume-eventname");
            var event_ranking = $("#PlayerResume-eventranking");


            if (gameid.val() === "") {
                setError(gameid, "gameID", "不能为空");
                return;
            } else {
                removeError(gameid, "gameID");
            }

            if (gamename.val() === "-1") {
                setError(gamename, "PlayerResume-gamename", "请选择游戏种类");
                return;
            } else {
                removeError(gamename, "PlayerResume-gamename");
            }

            if (service.val() === "") {
                setError(service, "PlayerResume-service", "不能为空");
                return;
            } else {
                removeError(service, "PlayerResume-service");
            }

            if (grade.val() === "") {
                setError(grade, "PlayerResume-grade", "不能为空");
                return;
            } else {
                removeError(grade, "PlayerResume-grade");
            }
            if(event.val() == 1 && event_name.val() === ""){
                setError(event_name, "PlayerResume-eventname", "不能为空");
                return;
            }
            else {
                removeError(event_name, "PlayerResume-eventname");
            }
            if(event.val() == 1 && event_ranking.val() === ""){
                setError(event_ranking, "PlayerResume-eventranking", "不能为空");
                return;
            }
            else {
                removeError(event_ranking, "PlayerResume-eventranking");
            }

            var formData = new FormData();
            if (playerID.val() != -1) {
                formData.append('playerId', playerID.val());
            }
            formData.append('game_id', gameid.val());
            formData.append('egame', gamename.find("option:selected").text());
            formData.append('place', place.find("option:selected").text());
            formData.append('service', service.val());
            formData.append('best_result', grade.val());
            formData.append('probability', probability.val());
            formData.append('event', event.val());
            formData.append('event_name', event_name.val());
            formData.append('event_ranking', event_ranking.val());

            $.ajax({
                url: "/resume/addPlayerResumeExp",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "选手经历已添加", result.msg, $PlayerResumePanelUpdate);
                }
            })
        });
        $("#add-baseinfo--button").click(function () {

            var rid = $("input[name='rid']");
            var professional = $("select[name='baseinfo-professional']");
            var club = $("input[name='baseinfo-club']");
            var is_contract = $("select[name='is_contract']");
            var opinion = $("select[name='baseinfo-opinion']");

            if (professional.val() === '1' && club.val().length <= 0) {
                setError(club, "baseinfo-club", "不能为空");
                return;
            } else {
                removeError(club, "baseinfo-club");
            }

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('professional', professional.val());
            formData.append('club', club.val());
            formData.append('is_contract', is_contract.val());
            formData.append('opinion', opinion.val());

            $.ajax({
                url: "/resume/addPlayerBaseinfoResume",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "选手信息已设置", result.msg, $baseinfoPanelUpdate);
                }
            })
        });

        $("#add-skill--button").click(function () {
            var rid = $("input[name='rid']");
            var skillName = $("input[name='skill-name']");
            var skillDegree = $("input[name='skill-degree']");

            if (skillName.val() === "") {
                setError(skillName, "skill-name", "不能为空");
                return;
            } else {
                removeError(skillName, "skill-name");
            }

            if (skillDegree.val() === "") {
                setError(skillDegree, "skill-degree", "不能为空");
                return;
            } else {
                removeError(skillDegree, "skill-degree");
            }


            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('skill', skillName.val());
            formData.append('level', skillDegree.val());

            $.ajax({
                url: "/resume/addSkill",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "技能特长已添加", result.msg, $skillPanelUpdate);
                }
            })
        });

        $("#additional-content--button").click(function () {
            var rid = $("input[name='rid']");
            var extra = $("textarea[name='additional-content']");

            var formData = new FormData();
            formData.append('rid', rid.val());
            formData.append('extra', extra.val());

            $.ajax({
                url: '/resume/addExtra',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "附加内容已修改", result.msg, $additionalPanelUpdate);
                }
            })
        });

        $(".playerResume-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条选手经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deletePlayerExp?id=" + id,
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });

        $(".skill-delete").click(function () {
            var $deleteBtn = $(this);

            swal({
                title: "确认",
                text: "确定删除该条技能特长吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                var formData = new FormData();
                formData.append('rid', $("input[name='rid']").val());
                formData.append('tag', $deleteBtn.siblings().html());

                $.ajax({
                    url: "/resume/deleteSkill",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        swal(result.status === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });
        $('#indicatorContainer').radialIndicator({
            barColor: {
                0: '#FF0000',
                33: '#FFFF00',
                66: '#0066FF',
                100: '#33CC33'
            },
            percentage: true,
            initValue: $('#completionvalue').val()
        });
    </script>
@endsection
