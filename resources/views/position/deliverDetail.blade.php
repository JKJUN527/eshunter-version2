@extends('layout.master')
@section('title', '投递详情')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('style/font-awesome.min.css')}}"/>
    <style>
        .mdl-card__title-text {
            position: relative;
            /*top: 4px;*/
        }
        .info-card .mdl-card__title h5.mdl-card__title-text{
            margin-top: 0;
        }
        .mdl-card__title h5{
            /*border-left: 5px solid #03A9F4;*/
            /*padding-left: 16px;*/
            /*font-size: 20px;*/
        }
        .mdl-card__title i{
            color:tomato;
            margin-right: 4px;
            /*padding-bottom: 3px;*/
        }
        .base-info__title {
            width: 480px !important;
        }

        .resume-child-card {
            width: 100%;
            min-height: 0;
            /*padding-bottom: 40px;*/
            /*margin-bottom:20px;*/
        }
        .base-info__header img{
            margin-left: 2px;
        }
        .base-info__header{
            text-align: center;
        }

        .resume-child-card .mdl-card__title-text {
            font-size: 18px;
            font-weight: 500;
            /*margin-bottom: 12px;*/
        }

        .resume-child-card .mdl-card__supporting-text {
            padding-bottom: 0;
        }

        .intention-panel p,
        .education-panel p {
            padding: 5px 25px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p {
            display: block !important;
        }

        .intention-panel p span {
            color: #737373;
            font-size: 14px;
        }

        .education-panel p span {
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

        h6.resume-response--title {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin: 24px 0 16px 0;
        }

        .response-card {
            padding: 12px;
            min-height: 0;
        }

        #btn-response {
            margin-top: 12px;
            float: right;
        }

        .error[for='response-content'] {
            min-height: 20px;
        }

        #btn-response {
            float: right;
        }
        .game-extra {
            margin-left: 1rem;
            font-size: small;
        }
    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2, 'type'=>$data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">
            <div class="info-panel--left info-panel" id="deliver_resume">

                <div class="mdl-card mdl-shadow--2dp info-card">
                    <div class="mdl-card resume-child-card">
                        <div class="mdl-card__title">
                            <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                    to="/position/deliverList">
                                <i class="material-icons">arrow_back</i>
                            </button>
                            @if( $data['personinfo'] != NULL)
                                <h5 class="mdl-card__title-text"
                                    style="margin-left: 16px;">{{$data['personinfo']->pname}}的简历</h5>
                            @else
                                <h5 class="mdl-card__title-text" style="margin-left: 16px;">未知姓名的简历</h5>
                            @endif

                        </div>
                        <div id="resume">
                             <link rel="stylesheet" type="text/css" href="http://eshunter.com/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/material.style.min.css">
    <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/material.css">
        <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/icon-fonts.css">
    <link rel="stylesheet" type="text/css" href="http://eshunter.com/style/style.css">
    <link rel="icon" type="image/png" sizes="32x32" href="http://eshunter.com/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="http://eshunter.com/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://eshunter.com/favicon/favicon-16x16.png">
    <style>
        .mdl-card__title-text {
            position: relative;
            /*top: 4px;*/
        }
        .info-card .mdl-card__title h5.mdl-card__title-text{
            margin-top: 0;
        }
        .mdl-card__title h5{
            /*border-left: 5px solid #03A9F4;*/
            /*padding-left: 16px;*/
            /*font-size: 20px;*/
        }
        .mdl-card__title i{
            color:tomato;
            margin-right: 4px;
            /*padding-bottom: 3px;*/
        }
        .base-info__title {
            width: 480px !important;
        }

        .resume-child-card {
            width: 100%;
            min-height: 0;
            /*padding-bottom: 40px;*/
            /*margin-bottom:20px;*/
        }
        .base-info__header img{
            margin-left: 2px;
        }
        .base-info__header{
            text-align: center;
        }

        .resume-child-card .mdl-card__title-text {
            font-size: 18px;
            font-weight: 500;
            /*margin-bottom: 12px;*/
        }

        .resume-child-card .mdl-card__supporting-text {
            padding-bottom: 0;
        }

        .intention-panel p,
        .education-panel p {
            padding: 5px 25px;
            display: inline-block;
            color: #333333;
            font-size: 16px;
            margin-bottom: 0;
        }

        .education-panel p {
            display: block !important;
        }

        .intention-panel p span {
            color: #737373;
            font-size: 14px;
        }

        .education-panel p span {
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

        h6.resume-response--title {
            font-size: 16px;
            font-weight: 400;
            line-height: 24px;
            margin: 24px 0 16px 0;
        }

        .response-card {
            padding: 12px;
            min-height: 0;
        }

        #btn-response {
            margin-top: 12px;
            float: right;
        }

        .error[for='response-content'] {
            min-height: 20px;
        }

        #btn-response {
            float: right;
        }
    </style>
                        {{--base resume info--}}
                        {{--<div class="mdl-card resume-child-card base-info--user" style="padding-bottom: 50px;">--}}
                        <div class="mdl-card resume-child-card base-info--user">
                            <div class="base-info__header">

                                @if($data['personinfo']->photo == null || $data['personinfo']->photo == "")
                                    <img src="{{asset('images/default-img.png')}}" class="img-circle info-head-img"
                                         width="70"
                                         height="70" style="margin: auto"/>
                                @else
                                    <img src="{{$data['personinfo']->photo}}" class="img-circle info-head-img"
                                         width="70" height="70" style="margin: auto"/>
                                @endif

                                <div class="base-info__title">
                                    @if( $data['personinfo']->pname != NULL)
                                        <p>{{$data['personinfo']->pname}}</P>
                                    @else
                                        <P>未知姓名</P>
                                    @endif

                                    <p>
                                        @if( $data['personinfo']->sex == null || ($data['personinfo']->sex != 1 && $data['personinfo']->sex != 2))
                                            <span>性别未填写</span> |
                                        @elseif($data['personinfo']->sex == 1)
                                            <span>男</span> |
                                        @elseif($data['personinfo']->sex == 2)
                                            <span>女</span> |
                                        @endif
                                        @if( $data['personinfo']->birthday != NULL)
                                            <span>{{$data['personinfo']->birthday}}</span> |
                                        @else
                                            <span>生日未填写</span> |
                                        @endif
                                        @if( $data['personinfo']->residence != NULL)
                                            <span>{{$data['personinfo']->residence}}</span>
                                        @else
                                            <span>居住地未填写</span>
                                        @endif

                                    </p>
                                </div>
                            </div>

                            <div class="mdl-card__actions mdl-card--border" style="margin-top: 12px;">
                                <div class="mdl-card__supporting-text">
                                    @if($data['personinfo']->self_evalu != null)
                                        {{$data['personinfo']->self_evalu}}
                                    @else
                                        未填写自我评价
                                    @endif
                                </div>
                            </div>

                            <ul class="mdl-list base-info__contact">
                                <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">phone</i>
                                @if($data['personinfo']->tel != null)
                                    {{$data['personinfo']->tel}}
                                @else
                                    手机号未填写
                                @endif
                            </span>
                                </li>
                                <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">email</i>
                                @if($data['personinfo']->mail != null)
                                    {{$data['personinfo']->mail}}
                                @else
                                    邮箱未填写
                                @endif
                            </span>
                                </li>
                            </ul>
                        </div>

                        {{--intention--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <i class="fa fa-pencil fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">求职意向</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border intention-panel">
                                {{--<div class="mdl-card__supporting-text">--}}
                                {{--没有填写求职意向--}}
                                {{--</div>--}}

                                <p>地区：
                                    @if($data["intention"]->region == null)
                                        <span>任意</span>
                                    @else
                                        <span>{{$data["intention"]->region}}</span>
                                    @endif
                                </p>

                                <p>行业分类：
                                    @if($data["intention"]->industry == null)
                                        <span>任意</span>
                                    @else
                                        <span>{{$data["intention"]->industry}}</span>
                                    @endif
                                </p>

                                <p>职业分类：
                                    @if($data["intention"]->occupation == null)
                                        <span>任意</span>
                                    @else
                                        <span>{{$data["intention"]->occupation}}</span>
                                    @endif
                                </p>
                                <p>工作类型：
                                    @if($data["intention"]->work_nature == null)
                                        <span>任意</span>
                                    @else
                                        <span>{{$data["intention"]->work_nature}}</span>
                                    @endif
                                </p>

                                <p>期望薪资（月）:
                                    @if($data["intention"]->salary <= 0)

                                        <span>未指定薪资要求</span>
                                    @else

                                        <span>{{$data["intention"]->salary}}</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{--education--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <i class="fa fa-graduation-cap fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">教育经历</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border education-panel">
                                @if($data["intention"]->education1 != null)
                                    <p>
                                        <span>{{explode('@',$data["intention"]->education1)[0]}}</span>
                                        <span>{{explode('@',$data["intention"]->education1)[1]}}</span>
                                        <span>{{explode('@',$data["intention"]->education1)[2]}}</span>
                                        <span>
                                            @if(explode('@',$data["intention"]->education1)[3] ==0)
                                                高中
                                            @elseif(explode('@',$data["intention"]->education1)[3] ==1)
                                                本科
                                            @elseif(explode('@',$data["intention"]->education1)[3] ==2)
                                                研究生及以上
                                            @else
                                                专科
                                            @endif
                                        </span>
                                    </p>
                                @endif
                                @if($data["intention"]->education2 != null)
                                    <p>
                                        <span>{{explode('@',$data["intention"]->education2)[0]}}</span>
                                        <span>{{explode('@',$data["intention"]->education2)[1]}}</span>
                                        <span>{{explode('@',$data["intention"]->education2)[2]}}</span>
                                        <span>
                                            @if(explode('@',$data["intention"]->education1)[3] ==0)
                                                高中
                                            @elseif(explode('@',$data["intention"]->education1)[3] ==1)
                                                本科
                                            @elseif(explode('@',$data["intention"]->education1)[3] ==2)
                                                研究生及以上
                                            @else
                                                专科
                                            @endif
                                        </span>
                                    </p>
                                @endif
                                @if($data["intention"]->education3 != null)
                                    <p>
                                        <span>{{explode('@',$data["intention"]->education3)[0]}}</span>
                                        <span>{{explode('@',$data["intention"]->education3)[1]}}</span>
                                        <span>{{explode('@',$data["intention"]->education3)[2]}}</span>
                                        <span>
                                            @if(explode('@',$data["intention"]->education1)[3] ==0)
                                                高中
                                            @elseif(explode('@',$data["intention"]->education1)[3] ==1)
                                                本科
                                            @elseif(explode('@',$data["intention"]->education1)[3] ==2)
                                                研究生及以上
                                            @else
                                                专科
                                            @endif
                                        </span>
                                    </p>
                                @endif

                                @if($data["intention"]->education1 == null &&
                                    $data["intention"]->education2 == null &&
                                    $data["intention"]->education3 == null)

                                    <div class="mdl-card__supporting-text">
                                        没有填写教育经历
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{--workexp--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <i class="fa fa-list fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">工作经历</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border education-panel">
                                @if($data["intention"]->workexp1 != null)
                                    <p>
                                        <span>{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp1)[1],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp1)[2],0,7,'utf-8'))}}</span>
                                        <span style="font-size: 1.3rem"><b>{{explode('@',$data["intention"]->workexp1)[3]}}</b></span>
                                        <span>{{explode('@',$data["intention"]->workexp1)[4]}}(
                                            @if(explode('@',$data["intention"]->workexp1)[0] ==0)
                                                全职
                                            @elseif(explode('@',$data["intention"]->workexp1)[0] ==1)
                                                实习
                                            @endif
                                         )
                                        </span>
                                        <br>
                                        <span>工作描述：</span></br>
                                        <span>{!! explode('@',$data["intention"]->workexp1)[5] !!}</span>
                                        {{--<br>--}}
                                        {{--<span>{{explode('@',$data["intention"]->workexp1)[1]}} 入职</span>--}}
                                        {{--<span>{{explode('@',$data["intention"]->workexp1)[2]}} 离职</span>--}}
                                    </p>
                                @endif
                                @if($data["intention"]->workexp2 != null)
                                    <p>
                                        <span>{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp2)[1],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp2)[2],0,7,'utf-8'))}}</span>
                                        <span style="font-size: 1.3rem"><b>{{explode('@',$data["intention"]->workexp2)[3]}}</b></span>
                                        <span>{{explode('@',$data["intention"]->workexp2)[4]}}(
                                            @if(explode('@',$data["intention"]->workexp2)[0] ==0)
                                                全职
                                            @elseif(explode('@',$data["intention"]->workexp2)[0] ==1)
                                                实习
                                            @endif
                                         )
                                        </span>
                                        <br>
                                        <span>工作描述：</span></br>
                                        <span>{!! explode('@',$data["intention"]->workexp2)[5] !!}</span>
                                    </p>
                                @endif
                                @if($data["intention"]->workexp3 != null)
                                    <p>
                                        <span>{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp3)[1],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp3)[2],0,7,'utf-8'))}}</span>
                                        <span style="font-size: 1.3rem"><b>{{explode('@',$data["intention"]->workexp3)[3]}}</b></span>
                                        <span>{{explode('@',$data["intention"]->workexp3)[4]}}(
                                            @if(explode('@',$data["intention"]->workexp3)[0] ==0)
                                                全职
                                            @elseif(explode('@',$data["intention"]->workexp3)[0] ==1)
                                                实习
                                            @endif
                                            )
                                        </span>
                                        <br>
                                        <span>工作描述：</span></br>
                                        <span>{!! explode('@',$data["intention"]->workexp3)[5] !!}</span>
                                    </p>
                                @endif

                                @if($data["intention"]->workexp1 == null &&
                                    $data["intention"]->workexp2 == null &&
                                    $data["intention"]->workexp3 == null)

                                    <div class="mdl-card__supporting-text">
                                        没有填写工作经历
                                    </div>
                                @endif
                            </div>
                        </div>

                            {{--workexp--}}
                            <div class="mdl-card resume-child-card">
                                <div class="mdl-card__title">
                                    <i class="fa fa-list fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">项目/赛事经历</h5>
                                </div>

                                <div class="mdl-card__actions mdl-card--border education-panel">
                                    @if($data["intention"]->projectexp1 != null)
                                        <p>
                                            <span>{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp1)[0],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp1)[1],0,7,'utf-8'))}}</span>
                                            <span style="font-size: 1.3rem"><b>{{explode('@',$data["intention"]->projectexp1)[2]}}</b></span>
                                            <span>{{explode('@',$data["intention"]->projectexp1)[3]}}</span>
                                            <br>
                                            <span>项目描述：</span></br>
                                            <span>{!! explode('@',$data["intention"]->projectexp1)[4] !!}</span>
                                            {{--<br>--}}
                                            {{--<span>{{explode('@',$data["intention"]->workexp1)[1]}} 入职</span>--}}
                                            {{--<span>{{explode('@',$data["intention"]->workexp1)[2]}} 离职</span>--}}
                                        </p>
                                    @endif
                                    @if($data["intention"]->projectexp2 != null)
                                            <p>
                                                <span>{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp2)[0],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp2)[1],0,7,'utf-8'))}}</span>
                                                <span style="font-size: 1.3rem"><b>{{explode('@',$data["intention"]->projectexp2)[2]}}</b></span>
                                                <span>{{explode('@',$data["intention"]->projectexp2)[3]}}</span>
                                                <br>
                                                <span>项目描述：</span></br>
                                                <span>{!! explode('@',$data["intention"]->projectexp2)[4] !!}</span>
                                                {{--<br>--}}
                                                {{--<span>{{explode('@',$data["intention"]->workexp1)[1]}} 入职</span>--}}
                                                {{--<span>{{explode('@',$data["intention"]->workexp1)[2]}} 离职</span>--}}
                                            </p>
                                    @endif
                                    @if($data["intention"]->projectexp3 != null)
                                            <p>
                                                <span>{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp3)[0],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp3)[1],0,7,'utf-8'))}}</span>
                                                <span style="font-size: 1.3rem"><b>{{explode('@',$data["intention"]->projectexp3)[2]}}</b></span>
                                                <span>{{explode('@',$data["intention"]->projectexp3)[3]}}</span>
                                                <br>
                                                <span>项目描述：</span></br>
                                                <span>{!! explode('@',$data["intention"]->projectexp3)[4] !!}</span>
                                                {{--<br>--}}
                                                {{--<span>{{explode('@',$data["intention"]->workexp1)[1]}} 入职</span>--}}
                                                {{--<span>{{explode('@',$data["intention"]->workexp1)[2]}} 离职</span>--}}
                                            </p>
                                    @endif

                                    @if($data["intention"]->projectexp1 == null &&
                                        $data["intention"]->projectexp2 == null &&
                                        $data["intention"]->projectexp3 == null)

                                        <div class="mdl-card__supporting-text">
                                            没有填写项目经历
                                        </div>
                                    @endif
                                </div>
                            </div>

                        {{--egamexpr--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <i class="fa fa-gamepad fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">电竞经历</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border education-panel">
                                @if($data["intention"]->egamexpr1 != null)
                                    <p>
                                        <span>{{explode('@',$data["intention"]->egamexpr1)[0]}}</span>
                                        <span>段位:{{explode('@',$data["intention"]->egamexpr1)[2]}}</span>
                                        <span>{{explode('@',$data["intention"]->egamexpr1)[1]}}年开始接触</span>
                                        @if(count(explode('@',$data["intention"]->egamexpr1))>=4)
                                            @if(explode('@',$data["intention"]->egamexpr1)[3] !="")
                                             <br>
                                                <p class="game-extra">{!! explode('@',$data["intention"]->egamexpr1)[3] !!}</p>
                                            @endif
                                        @endif
                                    </p>
                                @endif
                                @if($data["intention"]->egamexpr2 != null)
                                    <p>
                                        <span>{{explode('@',$data["intention"]->egamexpr2)[0]}}</span>
                                        <span>段位:{{explode('@',$data["intention"]->egamexpr2)[2]}}</span>
                                        <span>{{explode('@',$data["intention"]->egamexpr2)[1]}}年开始接触</span>
                                        @if(count(explode('@',$data["intention"]->egamexpr2))>=4)
                                            @if(explode('@',$data["intention"]->egamexpr2)[3] !="")
                                                <br>
                                        <p class="game-extra">{!! explode('@',$data["intention"]->egamexpr2)[3] !!}</p>
                                            @endif
                                        @endif
                                    </p>
                                @endif
                                @if($data["intention"]->egamexpr3 != null)
                                    <p>
                                        <span>{{explode('@',$data["intention"]->egamexpr3)[0]}}</span>
                                        <span>段位:{{explode('@',$data["intention"]->egamexpr3)[2]}}</span>
                                        <span>{{explode('@',$data["intention"]->egamexpr3)[1]}}年开始接触</span>
                                        @if(count(explode('@',$data["intention"]->egamexpr3))>=4)
                                            @if(explode('@',$data["intention"]->egamexpr3)[3] !="")
                                                <br>
                                        <p class="game-extra">{!! explode('@',$data["intention"]->egamexpr3)[3] !!}</p>
                                            @endif
                                        @endif
                                    </p>
                                @endif

                                @if($data["intention"]->egamexpr1 == null &&
                                    $data["intention"]->egamexpr2 == null &&
                                    $data["intention"]->egamexpr3 == null)

                                    <div class="mdl-card__supporting-text">
                                        没有填写电竞经历
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{--skill--}}
                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <i class="fa fa-tags fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">技能特长</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border skill-panel">
                                {{--|@|王者荣耀|至尊星耀|@|LOL|最强王者--}}

                                {{--<div class="mdl-card__supporting-text">--}}
                                {{--没有填写技能特长--}}
                                {{--</div>--}}
                                @if($data["intention"]->skill != null)
                                    @foreach(explode('|@|',$data["intention"]->skill) as $item )
                                        @if($item != "")
                                            <span>
                                            <small class="skill-item">{{$item}}</small>
                                        </span>
                                        @endif
                                    @endforeach

                                @else
                                    <div class="mdl-card__supporting-text">未填写技能</div>
                                @endif

                            </div>
                        </div>

                        <div class="mdl-card resume-child-card">
                            <div class="mdl-card__title">
                                <i class="fa fa-plus-square fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">附加信息</h5>
                            </div>

                            <div class="mdl-card__actions mdl-card--border additional-panel">

                                <div class="mdl-card__supporting-text" style="padding-bottom: 2rem;">
                                    @if($data["intention"]->extra != null)
                                        {{$data["intention"]->extra}}
                                    @else
                                        没有填写附加信息
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="gap"></div>
            @if($data["status"] != 2 && $data["status"] != 3)

                <div class="info-panel--right info-panel">

                    <h6 class="resume-response--title">
                        回复{{$data['personinfo']->pname}}的简历
                    </h6>

                    <div class="mdl-card info-card response-card">
                        <form method="post" id="response-form">
                            <input type="hidden" name="did" value="{{$data["intention"]->did}}"/>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="3" class="form-control" name="content"
                                          id="response-content"
                                          placeholder="写点什么..."></textarea>
                                </div>
                                <div class="help-info" id="response-help">还可输入114字</div>
                                <label class="error" for="response-content"></label>

                                <div class="form-group">
                                    <input name="employ" type="radio" id="unknown" class="radio-col-light-blue"
                                           value="1"
                                           checked/>
                                    <label for="unknown">暂不确定</label><br>
                                    <input name="employ" type="radio" id="accept" class="radio-col-light-blue"
                                           value="2"/>
                                    <label for="accept">立即录用</label><br>
                                    <input name="employ" type="radio" id="reject" class="radio-col-light-blue"
                                           value="3"/>
                                    <label for="reject">委婉拒绝</label>
                                </div>
                                <button id="btn-response" type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    回应
                                </button>
                            </div>
                        </form>
                    </div>
                    <div style="text-align: left;margin-top: 12px;">
                        <a class="btn btn-primary " id="download_resume">下载简历</a>
                    </div>
                </div>
            @else
                <div class="info-panel--right info-panel">

                    <h6 class="resume-response--title">
                        已处理过{{$data['personinfo']->pname}}的简历
                    </h6>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('js/pdf.js')}}"></script>
    <script type="text/javascript">

        var maxSize = 114;

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $('textarea').keyup(function () {
            var length = $(this).val().length;
            if (length > maxSize) {
                $(".error[for='response-content']").html("内容超过114字");
                $("#btn-response").prop("disabled", true);
            } else {
                $(".error[for='response-content']").html("");
                $("#btn-response").prop("disabled", false);
            }

            $("#response-help").html("还可输入" + (maxSize - length < 0 ? 0 : maxSize - length) + "字");

        });

        $responseForm = $("#response-form");

        $("button[type='submit']").click(function (event) {
            event.preventDefault();

            var did = $("input[name='did']").val();
            var content = $("#response-content").val();
            var employ = $("input[name='employ']:checked").val();

            if (content.length === 0) {
                $(".error[for='response-content']").html("内容不能为空");
                $("#btn-response").prop("disabled", true);
                return;
            }

            if (content.length > maxSize) {
                $(".error[for='response-content']").html("内容超过" + maxSize + "字");
                $("#btn-response").prop("disabled", true);
                return;
            }

            var formData = new FormData();
            formData.append('did', did);
            formData.append('content', content);
            formData.append('employ', employ);

            $.ajax({
                url: "/position/deliverDetail/reply",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "回复成功", result.msg, null);
                }
            })
        })
        
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
                body :$('#resume').html()
            });

            /*
            * Create the PDF file
            */
            doc.create();
        }

        
    </script>
@endsection
