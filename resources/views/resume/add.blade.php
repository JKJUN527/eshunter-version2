@extends('layout.master')
@section('title', '添加简历')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.css')}}">
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

        .logo-con {
            float: left;
            margin-top: 5px;
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
        .education-panel p,
        .work-panel p {
            padding: 5px 10px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p,
        .work-panel p {
            display: block !important;
            border: 1px dashed #00B38A;
            margin: 16px;
            vertical-align: middle;
        }

        .project-panel p {
            padding: 5px 10px;
            color: #333333;
            font-size: 16px;
            display: block !important;
            border: 1px dashed #00B38A;
            margin: 16px;
            vertical-align: middle;
        }

        .education-panel p:hover,
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

        .education-panel p span,
        .work-panel p span {
            margin-right: 10px;
            overflow: hidden;
            white-space: nowrap;
            display: inline-block;
            text-overflow: ellipsis;
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

        .education-panel p span:last-child {
            min-width: 103px;
            max-width: 200px;
        }

        .education-panel p i,
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
        .education-panel-update,
        .education-panel-edit,
        .work-panel-update,
        .project-panel-update,
        .skill-panel-update,
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
            display: block;
        }

        .datetimepicker-months .month {
            margin-left: 1rem;
        }

        .guide {
            width: auto;
            margin-left: 10px;
            position: fixed;
            /*left:50%;*/
            /*bottom:134px;*/
            _position: absolute;
            _top: expression(documentElement.scrollTop+documentElement.clientHeight - this.clientHeight - 134+'px');
            display: block;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .guide a {
            display: block;
            width: auto;
            /*height:50px;*/
            /*background:url(images/sprite_v2.png) no-repeat;*/
            /*margin-top:10px;*/
            text-decoration: none;
            font: 16px/50px "Microsoft YaHei";
            text-align: center;
            /*color:#fff;*/
            border-radius: 2px;
        }

        .guide a span {
            /*display:none;*/
            text-align: center;
            margin: 2rem;
            color: black;
        }

        .guide a:hover {
            text-decoration: none;
            background-color: #39F;
            color: #fff;
        }

        .guide a:hover span {
            margin: 2rem;
            display: block;
            width: auto;
            background: #39F
        }

        /* 更新简历页面 - 重新设计*/
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
            background-color: rgba(0, 0, 0, .3);
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

        input[name='resume-name'] {
            width: 140px;
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
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="left_panel info_panel">
            <div class="resume_header">
                <div class="cover"></div>
                <div class="head_pic">
                    <img src="{{$data['userinfo']->photo or asset("images/resume/default_headpic.png")}}" alt="" class="head_pic_img" width="120"
                         height="120">
                    <img src={{asset("images/resume/head_pic_shadow.png")}} alt="" class="shadow" width="120"
                         height="120">
                    <input type="file" name="head_pic" title="支持jpg、jpeg、gif、png格式，文件小于10M" onchange="showPreview(this);"/>
                </div>
            </div>

            <div class="base_info" id="base-info">
                <p class="name"><span>{{$data['userinfo']->pname or "姓名未填写"}}</span><a class="edit edit-name"><i class="material-icons">edit</i> 编辑</a>
                </p>
                <p class="bio"><span>{{$data['userinfo']->self_evalu or "自我评价未填写"}}</span><a class="edit edit-bio"><i
                                class="material-icons">edit</i> 编辑</a></p>
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
                    <a class="edit edit-others"><i class="material-icons">edit</i>编辑</a>
                </p>
            </div>

            {{--<div class="info-panel--left">--}}
            <input type="hidden" name="rid" value="{{$data['rid']}}">

            <div class="mdl-card resume-child-card" id="intention">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">求职意向</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-intention">
                        <i class="material-icons">add</i>
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

                    {{--<label for="position-place">工作地区意向</label>--}}
                    {{--<div class="form-group">--}}
                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                    {{--<select class="form-control show-tick selectpicker" data-live-search="true"--}}
                    {{--id="position-place" name="place">--}}
                    {{--@if($data['intention'] == null)--}}
                    {{--<option value="-1">任意</option>--}}
                    {{--@foreach($data['region'] as $region)--}}
                    {{--<option value="{{$region->id}}">{{$region->name}}</option>--}}
                    {{--@endforeach--}}
                    {{--@else--}}
                    {{--@if($data['intention']->region == -1)--}}
                    {{--<option value="-1" selected>任意</option>--}}
                    {{--@else--}}
                    {{--<option value="-1">任意</option>--}}
                    {{--@endif--}}
                    {{--@foreach($data['region'] as $region)--}}
                    {{--@if($data['intention']->region == $region->id)--}}
                    {{--<option value="{{$region->id}}" selected>{{$region->name}}</option>--}}
                    {{--@else--}}
                    {{--<option value="{{$region->id}}">{{$region->name}}</option>--}}
                    {{--@endif--}}
                    {{--@endforeach--}}
                    {{--@endif--}}
                    {{--</select>--}}
                    {{--</div>--}}
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
                        <select class="form-control show-tick selectpicker" id="position-industry"
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

            <div class="mdl-card resume-child-card" id="education">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">教育经历</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-education">
                        <i class="material-icons">add</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-education">
                        添加
                    </div>
                </div>

                <div class="mdl-card__actions education-panel">

                    @forelse($data['education'] as $education)
                        <p id="education_info" name="education_info" data-content="{{$education->eduid}}">
                            <span>{{$education->school}}</span>
                            @if($education->gradu_date !=NULL)
                                <span>{{str_replace('-','/',$education->date)}}
                                    -{{str_replace('-','/',$education->gradu_date)}}</span>
                            @else
                                <span>{{$education->date}}- -</span>
                            @endif
                            <span>
                                    @if($education->degree == 0)
                                    高中
                                @elseif($education->degree == 1)
                                    本科
                                @elseif($education->degree == 2)
                                    硕士及以上
                                @elseif($education->degree == 3)
                                    专科
                                @endif
                                </span>
                            <span>{{$education->major}}</span>
                            <i class="material-icons edu-delete education-item"
                               data-content="{{$education->eduid}}">close</i>
                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            您还没有填写过教育经历，点击右上角进行填写
                        </div>
                    @endforelse
                </div>

                <div class="mdl-card__actions mdl-card--border education-panel-update">

                    <label for="school-name">学校</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="school" name="school" class="form-control"
                                   placeholder="不能为空">
                            <input type="text" id="eduid" name="eduid" class="form-control" value="-1"
                                   style="display: none">
                        </div>
                        <label class="error" for="school"></label>
                    </div>

                    <label for="education-degree">学历</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" id="education-degree" name="degree">
                            <option value="0">高中</option>
                            <option value="3">专科</option>
                            <option value="1" selected>本科</option>
                            <option value="2">硕士及以上</option>
                        </select>
                    </div>

                    <label for="subject-name">专业</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="subject-name" name="subject" class="form-control"
                                   placeholder="可以为空">
                        </div>
                    </div>

                    <label for="education-begin">入学时间</label>
                    <div class="form-group">

                        <div class="form-line input-group date form_date col-md-5" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                             data-link-format="yyyy-mm-dd">
                            <input class="form-control" size="16" type="text" name="education-begin" value=""
                                   readonly placeholder="不能为空">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                        <label class="error" for="education-begin"></label>
                    </div>
                    <label for="education-end">毕业时间</label>
                    <div class="form-group">
                        <div class="form-line input-group date form_date col-md-5" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                             data-link-format="yyyy-mm-dd">
                            <input size="16" type="text" value="" readonly id="education-end" name="education-end"
                                   class="form-control"
                                   placeholder="如在读状态请勿填写">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-education--button"
                                class="btn btn-primary blue-btn">
                            确认添加
                        </button>
                    </div>

                </div>
            </div>

            <div class="mdl-card resume-child-card" id="workexp">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">工作经历</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-work">
                        <i class="material-icons">add</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-work">
                        添加
                    </div>
                </div>

                <div class="mdl-card__actions work-panel">

                    @forelse($data['work'] as $work)
                        <p id="work_info" name="work_info" data-content="{{$work->id}}">
                            <?php
                            $index = 1;
                            ?>
                            <span>
                                @foreach(explode('@', $work->work_time) as $time)
                                    @if($index == 1)
                                        {{str_replace('-','/',$time)}} --
                                    @elseif($index == 2)
                                        {{str_replace('-','/',$time)}}
                                    @endif
                                    <?php $index++ ?>
                                @endforeach
                                </span>
                            <span>{{$work->ename}}</span>
                            <span>{{$work->position}}</span>
                            <span style="width: 90%">{!! $work->describe !!}</span>

                            <i class="material-icons work-delete"
                               data-content="{{$work->id}}">close</i>
                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            您还没有填写过工作经历，点击右上角进行填写
                        </div>
                    @endforelse
                </div>

                <div class="mdl-card__actions mdl-card--border work-panel-update">

                    <label for="company-name">公司名称</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="company-name" name="company-name" class="form-control"
                                   placeholder="不能为空">
                            <input type="text" id="workex-id" name="workex-id" class="form-control"
                                   style="display: none;" value="-1">
                        </div>
                        <label class="error" for="company-name"></label>
                    </div>

                    <label for="position">职位</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="position" name="position" class="form-control"
                                   placeholder="不能为空">
                        </div>
                        <label class="error" for="position"></label>
                    </div>

                    <label for="work-begin">入职时间</label>
                    <div class="form-group">
                        <div class="form-line input-group date form_date col-md-5" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                             data-link-format="yyyy-mm-dd">
                            <input size="16" type="text" value="" readonly id="work-begin" name="work-begin"
                                   class="form-control" placeholder="不能为空">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                        <label class="error" for="work-begin"></label>
                    </div>

                    <label for="work-end">离职时间</label>
                    <div class="form-group">
                        <div class="form-line input-group date form_date col-md-5" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                             data-link-format="yyyy-mm-dd">
                            <input size="16" type="text" value="" readonly id="work-end" name="work-end"
                                   class="form-control" placeholder="不能为空">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                        <label class="error" for="work-end"></label>
                    </div>

                    <label for="work-type">工作类型</label>
                    <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" id="work-type" name="work-type">
                            <option value="0" selected>全职</option>
                            <option value="1">实习</option>
                        </select>
                    </div>

                    <label for="work-desc">工作描述</label>
                    <div class="form-group">
                        <div class="form-line">
                                <textarea rows="5" class="form-control" name="work-desc" id="work-desc"
                                          placeholder="介绍你的工作内容..."></textarea>
                        </div>
                        <label class="error" for="work-desc"></label>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-work--button"
                                class="btn btn-primary blue-btn">
                            确认添加
                        </button>
                    </div>

                </div>
            </div>

            <div class="mdl-card resume-child-card" id="projectexp">
                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">项目/赛事经历</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-project">
                        <i class="material-icons">add</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-project">
                        添加
                    </div>
                </div>

                <div class="mdl-card__actions project-panel">

                    @forelse($data['project'] as $project)
                        <p id="project_info" name="project_info" data-content="{{$project->id}}">
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

                            <i class="material-icons project-delete"
                               data-content="{{$project->id}}">close</i>
                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            您还没有填写过项目经历，点击右上角进行填写
                        </div>
                    @endforelse
                </div>

                <div class="mdl-card__actions mdl-card--border project-panel-update">

                    <label for="project-name">项目/赛事</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="project-name" name="project-name" class="form-control"
                                   placeholder="不能为空">
                            <input type="text" id="projectex-id" name="projectex-id" class="form-control"
                                   style="display: none;" value="-1">
                        </div>
                        <label class="error" for="project-name"></label>
                    </div>

                    <label for="project-position">项目职责</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="project-position" name="project-position" class="form-control"
                                   placeholder="不能为空">
                        </div>
                        <label class="error" for="project-position"></label>
                    </div>

                    <label for="project-begin">开始时间</label>
                    <div class="form-group">
                        <div class="form-line input-group date form_date col-md-5" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                             data-link-format="yyyy-mm-dd">
                            <input size="16" type="text" value="" readonly id="project-begin" name="project-begin"
                                   class="form-control" placeholder="不能为空">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                        <label class="error" for="project-begin"></label>
                    </div>

                    <label for="project-end">截止时间</label>
                    <div class="form-group">
                        <div class="form-line input-group date form_date col-md-5" data-date=""
                             data-date-format="yyyy-mm" data-link-field="dtp_input2" data-link-format="yyyy-mm">
                            <input size="16" type="text" value="" readonly id="project-end" name="project-end"
                                   class="form-control" placeholder="不能为空">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                        <label class="error" for="project-end"></label>
                    </div>

                    <label for="project-desc">项目描述</label>
                    <div class="form-group">
                        <div class="form-line">
                                <textarea rows="5" class="form-control" name="project-desc" id="project-desc"
                                          placeholder="介绍你的项目情况..."></textarea>
                        </div>
                        <label class="error" for="project-desc"></label>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-project--button"
                                class="btn btn-primary blue-btn">
                            确认添加
                        </button>
                    </div>

                </div>
            </div>

            <div class="mdl-card resume-child-card" id="egameexp">

                <div class="mdl-card__title">
                    <span class="line-left"></span>
                    <span class="mdl-card__title-text">电竞经历</span>
                    <span class="line-right"></span>
                </div>

                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="update-game">
                        <i class="material-icons">add</i>
                    </button>

                    <div class="mdl-tooltip" data-mdl-for="update-game">
                        添加
                    </div>
                </div>

                <div class="mdl-card__actions education-panel">
                    @forelse($data['game'] as $game)
                        <p id="egame_info" name="egame_info" data-content="{{$game->egid}}">
                            <span>{{$game->ename}}</span>
                            <span>{{$game->level}}</span>
                            <span>{{str_replace('-','/',$game->date)}} 开始接触</span>
                            @if($game->extra != null && $game->extra != "")
                                <span style="width: 90%">{!! $game->extra !!}</span>
                            @endif

                            <i class="material-icons education-item game-delete"
                               data-content="{{$game->egid}}">close</i>
                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            您还没有填写过电竞经历
                        </div>
                    @endforelse
                </div>

                <div class="mdl-card__actions mdl-card--border game-panel-update">

                    <label for="game-name">游戏名称</label>
                    <div class="form-group">
                        <input id="egame-id" name="egame-id" style="display: none;" value="-1">
                        <select class="form-control show-tick selectpicker" id="egame-name"
                                name="egamename">
                            @if(emptyArray($data['egame']))
                                <option value="-1">暂无游戏</option>
                            @endif
                            @foreach($data['egame'] as $egame)
                                <option value="{{$egame->id}}">{{$egame->name}}</option>
                            @endforeach
                        </select>
                        <label class="error" for="game-name"></label>
                    </div>

                    <label for="game-level" id="egrade-label" style="display: none;">段位／排名</label>
                    @foreach($data['egame'] as $egame)
                        <div class="form-group" id="egrade-display{{$egame->id}}" name="egrade-display"
                             style="display: none;">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" name="egamelevel{{$egame->id}}">
                                @foreach($data['egrade'] as $egrade)
                                    @if($egrade->egame_id == $egame->id)
                                        <option value="{{$egrade->id}}">{{$egrade->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label class="error" for="game-level"></label>
                        </div>
                    @endforeach
                    <label for="game-begin">接触时间</label>
                    <div class="form-group">
                        <div class="form-line input-group date form_date col-md-5" data-date=""
                             data-date-format="yyyy-mm-dd" data-link-field="dtp_input2"
                             data-link-format="yyyy-mm-dd">
                            <input size="16" type="text" value="" readonly id="game-begin" name="game-begin"
                                   class="form-control"
                                   placeholder="从何时开始接触这款游戏">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span
                                        class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                        <label class="error" for="game-begin"></label>
                    </div>
                    <label for="game-desc">备注</label>
                    <div class="form-group">
                        <div class="form-line">
                                <textarea rows="5" class="form-control" name="game-desc" id="game-desc"
                                          placeholder="备注你的服务大区、游戏ID、KDA、组排分等信息"></textarea>
                        </div>
                    </div>

                    <div class="button-panel">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect cancel">
                            取消
                        </button>
                        <button id="add-game--button"
                                class="btn btn-primary blue-btn">
                            确认添加
                        </button>
                    </div>

                </div>

                {{--<div class="mdl-card__actions mdl-card--border egamexper-panel">--}}

                {{--@forelse($data['egamexper'] as $egamexper)--}}
                {{--<p>--}}
                {{--<span>英雄联盟</span>--}}
                {{--<span>2012</span>--}}
                {{--<span>黄金</span>--}}
                {{--<i class="material-icons egame-delete egamexper-item"--}}
                {{--data-content="1">close</i>--}}
                {{--</p>--}}
                {{--@empty--}}
                {{--<div class="mdl-card__supporting-text">--}}
                {{--您还没有填写过电竞经历，点击右上角进行填写--}}
                {{--</div>--}}
                {{--@endforelse--}}
                {{--</div>--}}
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
                        <i class="material-icons">add</i>
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

                <div class="mdl-card__actions mdl-card--border additional-panel-update">

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
            {{--</div>--}}
        </div>

        <div class="right_panel info_panel">

            <div class="right-item">
                <div class="resume-name">
                    <span>{{$data['resume']->resume_name}}</span>
                    <a id="update-resume-name">修改</a>
                </div>

                {{--
                <div class="form-group resume-name--form">
                    <div class="form-line">
                        <input type="text" id="resume-name" name="resume-name" class="form-control"
                               placeholder="不能为空" value="{{$data['resume']->resume_name}}">
                    </div>
                    <label class="error" for="resume-name"></label>
                </div>

                <button id="resume-name--change"
                        class="btn btn-primary blue-btn">
                    修改
                </button>

                --}}

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
                    <span>简历完整度：<em>60%</em></span>
                    <a href="/resume/preview?rid={{$data['rid']}}">预览简历</a>
                </div>

                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                         aria-valuemax="100"
                         style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                    </div>
                </div>
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
                        <a href="#education"><i class="fa fa-graduation-cap fa-2" aria-hidden="true"></i>教育经历</a>
                    </li>
                    <li>
                        <a href="#workexp"><i class="fa fa-list fa-2" aria-hidden="true"></i>工作经历</a>
                    </li>
                    <li>
                        <a href="#projectexp"><i class="fa fa-list fa-2" aria-hidden="true"></i>项目/赛事经历</a>
                    </li>
                    <li>
                        <a href="#egameexp"><i class="fa fa-gamepad fa-2" aria-hidden="true"></i>电竞经历</a>
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

@section('header-nav')
    @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
    @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
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
        //预览头像
        var isCorrect = true;
        function showPreview(element) {
//            var isCorrect = true;

            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            console.log(objectUrl);


            var headImagePath = $("input[name='head_pic']").val();

            console.log(headImagePath);


            if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(headImagePath)) {
                isCorrect = false;
                swal({
                    title: "错误",
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else {
                var size = file.size;
                console.log(size);

                if (size > 2 * 1024 * 1024) {
                    swal({
                        title: "错误",
                        type: "error",
                        text: "图片文件最大支持：2MB",
                        cancelButtonText: "关闭",
                        showCancelButton: true,
                        showConfirmButton: false
                    });
                } else {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var data = e.target.result;
                        //加载图片获取图片真实宽度和高度
                        var image = new Image();
                        image.onload = function () {
                            var width = image.width;
                            var height = image.height;
                            console.log(width + "//" + height);

                            if (width > 1000 || height > 1000) {
                                isCorrect = false;

                                swal({
                                    title: "错误",
                                    type: "error",
                                    text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n图片分辨率最大支持 1000像素 * 1000像素",
                                    cancelButtonText: "关闭",
                                    showCancelButton: true,
                                    showConfirmButton: false
                                });
                            } else if (isCorrect) {
                                originalHeadImg = $(".head_pic_img").attr("src");
                                $(".head_pic_img").attr("src", objectUrl);
                                //上传头像
                                var file = $("input[name='head_pic']");
                                var formData = new FormData();
                                formData.append('photo', file.prop("files")[0]);
                                $.ajax({
                                    url: "/resume/changePhoto",
                                    type: 'post',
                                    dataType: 'text',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function (data) {
                                        console.log(data);
                                        var result = JSON.parse(data);
                                    }
                                })

                            }
                        };
                        image.src = data;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }

        $(".right-nav").find("ul li").click(function () {
            $(".active-nav-item").removeClass("active-nav-item");
            $(this).addClass("active-nav-item");
        });

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
        $educationPanelUpdate = $(".education-panel-update");
        $workPanelUpdate = $(".work-panel-update");
        $projectPanelUpdate = $(".project-panel-update");
        $gamePanelUpdate = $(".game-panel-update");
        $skillPanelUpdate = $(".skill-panel-update");
        $additionalPanelUpdate = $(".additional-panel-update");

        $intentionPanelUpdate.hide();
        $educationPanelUpdate.hide();
        $workPanelUpdate.hide();
        $projectPanelUpdate.hide();
        $gamePanelUpdate.hide();
        $skillPanelUpdate.hide();
        $additionalPanelUpdate.hide();

        var intention_isClose = true;
        var education_isClose = true;
        var work_isClose = true;
        var project_isClose = true;
        var game_isClose = true;
        var skill_isClose = true;
        var additional_isClose = true;

        $intention_update_button = $('#update-intention').find("i.material-icons");
        $("#update-intention").click(function () {
            if (intention_isClose) {
                $intentionPanelUpdate.fadeIn();
                $intention_update_button.html("close")
            } else {
                $intentionPanelUpdate.fadeOut();
                $intention_update_button.html("add")
            }
            intention_isClose = !intention_isClose;
        });

        $education_update_button = $('#update-education').find("i.material-icons");
        $("#update-education").click(function () {
            $("input[id=school]").val("");//设置学校值
            $("input[id=eduid]").val(-1);//设置教育经历id
            $("input[id=subject-name]").val("");//设置专业信息
            $("input[id=education-begin]").val("");//设置入学时间
            $("input[id=education-end]").val("");//设置毕业时间

            if (education_isClose) {
                $educationPanelUpdate.fadeIn();
                $education_update_button.html("close");
            } else {
                $educationPanelUpdate.fadeOut();
                $education_update_button.html("add");
            }
            education_isClose = !education_isClose;
        });

        $work_update_button = $("#update-work").find("i.material-icons");
        $("#update-work").click(function () {
            $("input[id=company-name]").val("");//设置公司名称
            $("input[id=workex-id]").val(-1);//设置公司名称
            $("input[id=position]").val("");//设置职位
            $("input[id=work-begin]").val("");//设置入职时间
            $("input[id=work-end]").val("");//设置离职时间
            $("textarea[id=work-desc]").val("");//设置离职时间
            if (work_isClose) {
                $workPanelUpdate.fadeIn();
                $work_update_button.html("close");
            } else {
                $workPanelUpdate.fadeOut();
                $work_update_button.html("add");
            }

            work_isClose = !work_isClose;
        });

        $project_update_button = $("#update-project").find("i.material-icons");
        $("#update-project").click(function () {
            $("input[id=project-name]").val("");//设置项目名称
            $("input[id=projectex-id]").val(-1);//设置项目id
            $("input[id=project-position]").val("");//设置职位
            $("input[id=project-begin]").val("");//设置入职时间
            $("input[id=project-end]").val("");//设置离职时间
            $("textarea[id=project-desc]").val("");//设置项目描述
            if (project_isClose) {
                $projectPanelUpdate.fadeIn();
                $project_update_button.html("close");
            } else {
                $projectPanelUpdate.fadeOut();
                $project_update_button.html("add");
            }
            project_isClose = !project_isClose;
        });

        $game_update_button = $("#update-game").find("i.material-icons");
        $("#update-game").click(function () {
            $("input[id=egame-id]").val(-1);//设置游戏经历id
            $("input[id=game-begin]").val("");
            if (game_isClose) {
                $gamePanelUpdate.fadeIn();
                $game_update_button.html("close")
            } else {
                $gamePanelUpdate.fadeOut();
                $game_update_button.html("add")
            }
            game_isClose = !game_isClose;
        });

        $skill_update_button = $("#update-skill").find("i.material-icons");
        $("#update-skill").click(function () {
            if (skill_isClose) {
                $skillPanelUpdate.fadeIn();
                $skill_update_button.html("close")
            } else {
                $skillPanelUpdate.fadeOut();
                $skill_update_button.html("add")
            }
            skill_isClose = !skill_isClose;
        });

        $additional_update_button = $("#update-additional").find("i.material-icons");
        $("#update-additional").click(function () {
            if (additional_isClose) {
                $additionalPanelUpdate.fadeIn();
                $additional_update_button.html("close");
            } else {
                $additionalPanelUpdate.fadeOut();
                $additional_update_button.html("add");
            }
            additional_isClose = !additional_isClose;
        });

        $intentionPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $intentionPanelUpdate.hide();
        });
        $educationPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $educationPanelUpdate.hide();
        });
        $workPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $workPanelUpdate.hide();
        });
        $projectPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $projectPanelUpdate.hide();
        });
        $gamePanelUpdate.find(".button-panel>button.cancel").click(function () {
            $gamePanelUpdate.hide();
        });
        $skillPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $skillPanelUpdate.hide();
        });
        $additionalPanelUpdate.find(".button-panel>button.cancel").click(function () {
            $additionalPanelUpdate.hide();
        });


        //修改已填写的教育经历
        $editEducation = $("p[name=education_info]");
        //修改工作经历
        $editWork = $("p[name=work_info]");
        //修改项目经历
        $editProject = $("p[name=project_info]");
        //修改电竞经历
        $editEgame = $("p[name=egame_info]");

        $editEducation.click(function () {
            $eduid = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('eduid', $eduid);
            $.ajax({
                url: '/resume/geteduinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditEdu(result);
//                    console.log(result);
                }
            })

        });
        $editWork.click(function () {
            $id = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('id', $id);
            $.ajax({
                url: '/resume/getworkinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditWork(result);
//                    console.log(result);
                }
            })

        });
        $editProject.click(function () {
            $id = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('id', $id);
            $.ajax({
                url: '/resume/getprojectinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditProject(result);
//                    console.log(result);
                }
            })

        });
        $editEgame.click(function () {
            $egid = $(this).attr("data-content");
            var formData = new FormData();
            formData.append('egid', $egid);
            $.ajax({
                url: '/resume/getegameinfo',
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    //调用函数打开编辑框
                    showeditEgame(result);
//                    console.log(result);
                }
            })

        });

        function showeditEdu(data) {
            $("input[id=school]").val(data.school);//设置学校值
            $("input[id=eduid]").val(data.eduid);//设置教育经历id
//            $("select[id=education-degree]").find("option:contains(3)").attr("selected",true);
//            $("select[id=education-degree]").val(data.degree);//设置学位信息
            $("input[id=subject-name]").val(data.major);//设置专业信息
            $("input[id=education-begin]").val(data.date);//设置入学时间
            $("input[id=education-end]").val(data.gradu_date);//设置毕业时间
            $educationPanelUpdate.fadeIn();

        }

        function showeditWork(data) {
            $("input[id=company-name]").val(data.ename);//设置公司名称
            $("input[id=workex-id]").val(data.id);//设置公司名称
            $("input[id=position]").val(data.position);//设置职位
            $("input[id=work-begin]").val(data.work_time.split('@')[0]);//设置入职时间
            $("input[id=work-end]").val(data.work_time.split('@')[1]);//设置离职时间
            if (data.describe) {
                data.describe = data.describe.replace(/<\/br>/g, "\r\n");
            }
            $("textarea[id=work-desc]").val(data.describe);
            $workPanelUpdate.fadeIn();

        }

        function showeditProject(data) {
            $("input[id=project-name]").val(data.project_name);//设置项目名称
            $("input[id=projectex-id]").val(data.id);//设置项目id
            $("input[id=project-position]").val(data.position);//设置职位
            $("input[id=project-begin]").val(data.project_time.split('@')[0]);//设置开始时间
            $("input[id=project-end]").val(data.project_time.split('@')[1]);//设置结束时间
            if (data.describe) {
                data.describe = data.describe.replace(/<\/br>/g, "\r\n");
            }
            $("textarea[id=project-desc]").val(data.describe);
            $projectPanelUpdate.fadeIn();

        }

        function showeditEgame(data) {
            $("input[id=egame-id]").val(data.egid);//设置游戏经历id
            $("input[id=game-begin]").val(data.date);
            if (data.extra) {
                data.extra = data.extra.replace(/<\/br>/g, "\r\n");
            }
            $("textarea[id=game-desc]").val(data.extra);//设置备注信息
            $gamePanelUpdate.fadeIn();

        }

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
        //自动关联游戏名称及游戏段位
        $('#egame-name').change(function () {
            var indexid = $("select[name='egamename']").val();
            var id = "#egrade-display" + indexid;
            $('div[name=egrade-display]').css("display", "none");
            $("#egrade-label").css("display", "block");
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

        $("#add-work--button").click(function () {
            var companyName = $("input[name='company-name']");
            var workex_id = $("input[name='workex-id']");
            var positionName = $("input[name='position']");
            var beginDate = $("input[name='work-begin']");
            var endDate = $("input[name='work-end']");
            var type = $("select[name='work-type']");
            var workDesc_raw = $("textarea[name='work-desc']");
            var workDesc = workDesc_raw.val().replace(/\r\n/g, '</br>');
            workDesc = workDesc.replace(/\n/g, '</br>');
//            workDesc = workDesc.replace(/\s/g, '</br>');

            if (companyName.val() === "") {
                setError(companyName, "company-name", "不能为空");
                return;
            } else {
                removeError(companyName, "company-name");
            }

            if (positionName.val() === "") {
                setError(positionName, "position", "不能为空");
                return;
            } else {
                removeError(positionName, "position");
            }

            if (beginDate.val() === "") {
                setError(beginDate, "work-begin", "不能为空");
                return;
            } else {
                removeError(beginDate, "work-begin");
            }

            if (endDate.val() === "") {
                setError(endDate, "work-end", "不能为空");
                return;
            } else {
                removeError(endDate, "work-end");
            }
            if (workDesc.length > 500) {
                setError(workDesc_raw, "work-desc", "最大字数不能超过500字");
                return;
            } else {
                removeError(workDesc_raw, "work-desc");
            }

            var formData = new FormData();
            if (workex_id.val() != -1) {
                formData.append('id', workex_id.val());
            }
            formData.append('ename', companyName.val());
            formData.append('position', positionName.val());
            formData.append('type', type.val());
            formData.append('describe', workDesc);
            formData.append('work_time', beginDate.val() + "@" + endDate.val());

            $.ajax({
                url: "/resume/addWorkexp",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "工作经历已添加", result.msg, null);
                }
            })
        });

        $("#add-project--button").click(function () {
            var projectName = $("input[name='project-name']");
            var projectex_id = $("input[name='projectex-id']");
            var positionName = $("input[name='project-position']");
            var beginDate = $("input[name='project-begin']");
            var endDate = $("input[name='project-end']");
            var projectDesc_raw = $("textarea[name='project-desc']");
            var projectDesc = projectDesc_raw.val().replace(/\r\n/g, '</br>');
            projectDesc = projectDesc.replace(/\n/g, '</br>');

            if (projectName.val() === "") {
                setError(projectName, "project-name", "不能为空");
                return;
            } else {
                removeError(projectName, "project-name");
            }

            if (positionName.val() === "") {
                setError(positionName, "project-position", "不能为空");
                return;
            } else {
                removeError(positionName, "project-position");
            }

            if (beginDate.val() === "") {
                setError(beginDate, "project-begin", "不能为空");
                return;
            } else {
                removeError(beginDate, "project-begin");
            }

            if (endDate.val() === "") {
                setError(endDate, "project-end", "不能为空");
                return;
            } else {
                removeError(endDate, "project-end");
            }
            if (projectDesc.length > 500) {
                setError(projectDesc_raw, "project-desc", "最大字数不能超过500字");
                return;
            } else {
                removeError(projectDesc_raw, "project-desc");
            }

            var formData = new FormData();
            if (projectex_id.val() != -1) {
                formData.append('id', projectex_id.val());
            }
            formData.append('project_name', projectName.val());
            formData.append('position', positionName.val());
            formData.append('describe', projectDesc);
            formData.append('project_time', beginDate.val() + "@" + endDate.val());

            $.ajax({
                url: "/resume/addProjectexp",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "项目经历已添加", result.msg, null);
                }
            })
        });

        $("#add-education--button").click(function () {
            var school = $("input[name='school']");
            var eduid = $("input[name='eduid']");
            var degree = $("select[name='degree']");
            var subject = $("input[name='subject']");
            var starDate = $("input[name='education-begin']");
            var endDate = $("input[name='education-end']");

            if (school.val() === "") {
                setError(school, "school", "不能为空");
                return;
            } else {
                removeError(school, "school");
            }

            if (starDate.val() === "") {
                setError(starDate, "education-begin", "不能为空");
                return;
            } else {
                removeError(starDate, "education-begin");
            }

            var formData = new FormData();
            if (eduid.val() != -1) {
                formData.append('eduid', eduid.val());
            }
            formData.append('school', school.val());
            formData.append('date', starDate.val());
            formData.append('gradu_date', endDate.val());
            formData.append('major', subject.val());
            formData.append('degree', degree.val());

            $.ajax({
                url: "/resume/addEducation",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "教育经历已添加", result.msg, $educationPanelUpdate);
                }
            })
        });

        $("#add-game--button").click(function () {
            var gameBegin = $("input[name='game-begin']");
            var egame_id = $("input[name='egame-id']");
            var egameName = $("select[name='egamename']");
            var egrade = $("select[name='egamelevel" + egameName.val() + "']");
            var gameDesc_raw = $("textarea[name='game-desc']");
            var gameDesc = gameDesc_raw.val().replace(/\r\n/g, '</br>');
            gameDesc = gameDesc.replace(/\n/g, '</br>');
//            gameDesc = gameDesc.replace(/\s/g, '</br>');


            if (egameName.val() === "" || egameName.val() == "-1") {
                setError(egameName, "game-name", "不能为空");
                return;
            } else {
                removeError(egameName, "game-name");
            }

            if (egrade.val() === "") {
                setError(egrade, "game-level", "不能为空");
                return;
            } else {
                removeError(egrade, "game-level");
            }

            if (gameBegin.val() === "") {
                setError(gameBegin, "game-begin", "不能为空");
                return;
            } else {
                removeError(gameBegin, "game-begin");
            }

            var formData = new FormData();
            if (egame_id.val() != -1) {
                formData.append('egid', egame_id.val());
            }
            formData.append('game', egameName.val());
            formData.append('level', egrade.val());
            formData.append('date', gameBegin.val());
            formData.append('extra', gameDesc);

            $.ajax({
                url: "/resume/addGame",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "电竞经历已添加", result.msg, $intentionPanelUpdate);
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

        $(".work-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条工作经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteWorkexp?id=" + id,
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

        $(".project-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条项目经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteProjectexp?id=" + id,
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

        $(".edu-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条教育经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteEducation?eduid=" + id,
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

        $(".game-delete").click(function () {
            var id = $(this).attr("data-content");
            swal({
                title: "确认",
                text: "确定删除该条电竞经历吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/resume/deleteGame?id=" + id,
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

        $("#update-resume-name").click(function () {
            $(".resume-name:first").addClass('dn');
            $(".resume-name:last").removeClass('dn');
        });

        $("#cancel-update-resume-name").click(function () {
            $(".resume-name:first").removeClass('dn');
            $(".resume-name:last").addClass('dn');
        });
    </script>
@endsection
