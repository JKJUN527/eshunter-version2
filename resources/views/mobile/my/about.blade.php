@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['title'=>'关于我们','buttonLeft'=>true])
@stop

@section('esh-content')
    <div class="mdl-card esh-width--1-1">
        <div class="mdl-card__title mdl-card--expand">
            <h2 class="mdl-card__title-text esh-about-logo">
                <img src="{{asset('mobile/styles/default/images/esh-logo.png')}}">
            </h2>
        </div>
        <div class="mdl-card__supporting-text">
            电竞猎人平台创建于2017年，隶属于上海汉竞信息科技有限公司。<br>
            我们是全国第一家专注电子竞技行业的垂直招聘网站。电竞及相关企业可以通过电竞猎人平台寻找人才，<br>
            企业之间也能在线上互相寻求合作。电竞行业今非昔比，人才数量的需求以及人才质量的要求都在提高，<br>
            我们目标为电竞行业输入一些优秀的外部人才，也致力于打造电竞行业的线上求职及培训的综合性平台。
        </div>
        <div class="mdl-card__actions mdl-card--border">
            地址：<span>{{$data['about']->address or '地址未填写'}}</span>
        </div>
        <div class="mdl-card__actions mdl-card--border">
            邮编：200021
        </div>
        <div class="mdl-card__actions mdl-card--border">
            电话：{{$data['about']->tel or '联系电话未填写'}}
        </div>
        <div class="mdl-card__actions mdl-card--border">
            邮箱：{{$data['about']->email or '邮箱未填写'}}
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <div id="map" style="width:100%; height: 600px;"></div>
        </div>
    </div>
@stop

@section('esh-js')
    @parent
    <script type="text/javascript"
            src="http://webapi.amap.com/maps?v=1.3&key=e143b33668668e4b9be611be3584b0e7"></script>
    <script>
        map = new AMap.Map('map', {
            resizeEnable: true,
            zoom: 13,
            center: [121.48944, 31.228947]
        });

        AMap.plugin(['AMap.ToolBar', 'AMap.Scale'],
            function () {
                map.addControl(new AMap.ToolBar());

                map.addControl(new AMap.Scale());

                map.setStatus({scrollWheel: false});
            });

        marker = new AMap.Marker({
            position: [121.48944, 31.228947],
            title: "company name",
            map: map
        });
    </script>
@stop

