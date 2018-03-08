@extends('mobile.layout.master')
@section('esh-header')
@include('mobile.components.header',['title'=> "我的简历",'buttonLeft'=>true])
@stop
@section('esh-content')
    @foreach($data['resumeList']["resumes"] as $resume)
        <div class="esh-resume mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h3 class="mdl-card__title-text">
                    <i class="material-icons mdl-color-text--red">assignment</i>{{$resume->resume_name}}
                </h3>
            </div>
            <div class="mdl-card__supporting-text">
                简历完善度:<span>
                        {{$data['resumeList']['completion'][$resume->rid]}}%
                        </span>
            </div>
            <div class="mdl-card__actions mdl-card--border mdl-typography--text-right">
                <a class="esh-js-click mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800"
                   href="/m/resume/add?rid={{$resume->rid}}">
                    编辑
                </a>
                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--blue"
                   href="/m/resume/preview?rid={{$resume->rid}}">
                    预览
                </a>
                <!--<a class="mdl-button mdl-button&#45;&#45;colored mdl-js-button mdl-js-ripple-effect">-->
                <!--删除-->
                <!--</a>-->
            </div>
        </div>
    @endforeach

    @if(count($data['resumeList']["resumes"]) < 3)
        <div class="esh-bottom-option"  id="add-resume">
            <button class="mdl-button mdl-js-button mdl-button--colored"
            >
                <i class="material-icons">add</i><span class="esh-add-text">创建简历</span>
            </button>
        </div>
    @endif
@stop
@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/resume/resume.js')}}"></script>
@stop



{{--
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>我的简历</title>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/mdl/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/default/styles.css')}}"/>
</head>
<body>
    --}}
{{-- 需要resumeList --}}{{--

    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
        <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
            <div class="mdl-layout-icon esh-layout-icon--left">
                <i class="material-icons esh-icon">navigate_before</i>
            </div>
            <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
                <span class="mdl-layout__title esh-layout__title">我的简历</span>
            </div>
        </header>
        <main class="mdl-layout__content" id="esh-content">
            @foreach($data['resumeList']["resumes"] as $resume)
            <div class="esh-resume mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h3 class="mdl-card__title-text">
                        <i class="material-icons mdl-color-text--red">assignment</i>{{$resume->resume_name}}
                    </h3>
                </div>
                <div class="mdl-card__supporting-text">
                    简历完善度:<span>
                        {{$data['resumeList']['completion'][$resume->rid]}}%
                        </span>
                </div>
                <div class="mdl-card__actions mdl-card--border mdl-typography--text-right">
                    <a class="esh-js-click mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--grey-800"
                       href="/m/resume/add?rid={{$resume->rid}}">
                       编辑
                    </a>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--blue"
                       href="/m/resume/preview?rid={{$resume->rid}}">
                        预览
                    </a>
                    <!--<a class="mdl-button mdl-button&#45;&#45;colored mdl-js-button mdl-js-ripple-effect">-->
                        <!--删除-->
                    <!--</a>-->
                </div>
            </div>
            @endforeach

            @if(count($data['resumeList']["resumes"]) < 3)
            <div class="esh-bottom-option"  id="add-resume">
                <button class="mdl-button mdl-js-button mdl-button--colored"
                         >
                    <i class="material-icons">add</i><span class="esh-add-text">创建简历</span>
                </button>
            </div>
            @endif
        </main>
    </div>


    <script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('mobile/js/utils/utils.js')}}"></script>
    <script src="{{asset('mobile/js/resume/resume.js')}}"></script>

</body>
</html>--}}
