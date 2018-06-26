@extends('layout.master')
@section('title', '收藏夹')

@section('custom-style')
    {{--<link media="all" href="{{asset('../style/delivery.css')}}" type="text/css" rel="stylesheet">--}}
    <link media="all" href="{{asset('../style/news.css')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('style/tao_company.css')}}" type="text/css" rel="stylesheet">
    {{--<link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">--}}
    <link media="all" href="{{asset('../style/apply.css')}}" type="text/css" rel="stylesheet">
    <link media="all" rel="stylesheet" href="{{asset('../style/personal_account.css')}}" type="text/css">
    <link media="all" href="{{asset('../style/advanceSearch.css')}}" type="text/css" rel="stylesheet">
    <style>
        .QQ_each{
            margin-left: 1260px;
        }
        #page_tools li{
            padding: 0;
        }
        .transform{
            position: initial !important;
        }
        .d_job_company{
            font-size: 1.2rem;
            padding: 10px 0;
        }
        .d_job_company a:hover{
            color: #0d9572;
        }
        .jieshao_list li {
            height:150px;
            margin: 25px 10px 0 12px;
        }
        .position_main_info{
            margin-top: 1.8rem;
        }
        .create_time{
            padding-top: 1.8rem;
        }
        .info-card{
            padding: 10px;
        }

        .companydiv li {
            /*border-bottom: none;*/
            margin-bottom: 16px;
        }
        .containter{
            width: 1080px;
        }
        .companydiv li>div{
            float: left;
        }
        .companydiv li {
            float: left;
            border: 1px solid #dcdcdc;
            margin: 11px 6px;
            width: 96%;
        }
        /*冲突解决*/
        .info_panel {
            margin: 0 !important;
        }

        .gsdiv {
            width: 42%;

        }
        #publish-position{
            width: 104px;
            overflow: hidden;
            height: 38px;
            float: left;
            -webkit-border-top-right-radius: 4px;
            -moz-border-top-right-radius: 4px;
            border-top-right-radius: 4px;
            -moz-border-bottom-right-radius: 4px;
            -webkit-border-bottom-right-radius: 4px;
            border-bottom-right-radius: 4px;
            line-height: 38px;
            background: #D32F2F;
            border: none;
            color: #fff;
            font-size: 18px;
            font-family: 'Microsoft Yahei';
            cursor: pointer;
        }
        #publish-position:hover{
            background: #6F6969;
        }
        .gs_rank_item span.active {
            background: none;
            color: #D32F2F;
            font-weight: bold;
        }
        .gsdiv .brif .toujianli{
            /* float: right; */
            padding: 10px 40px;
            /* margin-right: -87px; */
            background-color: #03A9F4;
            color: #fff;
            border: none;
            border-radius: 3px;
        }
        .gs_rank_item {
            padding: 6px 17px;
            background: #919191;
            overflow: hidden;
            font-size: 15px;
        }
        .resume-list {
            width: 100%;
            display: block;
        }

        .resume-item {
            border: 1px solid #ebebeb;
            display: block;
            padding: 8px 16px;
            margin-bottom: 16px;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .resume-item:hover {
            background-color: #03A9F4;
            color: #ffffff;
        }

        .resume-item p {
            margin: 0;
        }
        .gsdiv .div_s {
            /*height: 64px;*/
            padding: 10px 0;
        }
        #page_tools li{
            padding: 0;
        }
        .major-list li{
            width: 116px;
            height: 92px;
        }
        .major-list li a{
            width: 116px;
            height: 92px;
        }

        .gsdiv .div_s span {
            margin-right: 3px;
            word-break: initial;
            border: 1px solid #ddd;
            padding: 3px 5px;
            border-radius: 3px;
            line-height: 32px;
        }
        .jieshao_list li:hover{box-shadow: 2px 2px 2px #ebebeb;}
        .region{
            color: #00b38a;
        }
        .companydiv li .company-all {
            margin-left: 30px !important;
        }
    </style>
@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 13,'type' => $data['type']])
@endsection

@section('content')

    <div class="container">
        <div class="info_left info_panel" style="background: white;">
            <ul>
                <li class="">
                    <a href="/account"><i class="iconfont icon-homepage"></i>
                        <span>帐户中心</span>
                    </a>
                </li>

                @if($data["type"] == 1)
                    <li class="">
                        <a href="/position/applyList">
                            <i class="iconfont icon-order"></i>
                            <span>申请记录</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="/message">
                            <i class="iconfont icon-message_fill"></i>
                            <span>站内信({{$data['username']['messageNum']}})</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="/position/advanceSearch">
                            <i class="iconfont icon-manage"></i>
                            <span>查找职位</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/collection/index">
                            <i class="iconfont icon-praise"></i>
                            <span>收藏夹</span>
                        </a>
                    </li>
                @elseif($data["type"] == 2)
                    <li class="">
                        <a href="/position/publishList">
                            <i class="iconfont icon-createtask_fill"></i>
                            <span>职位管理</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/position/deliverList">
                            <i class="iconfont icon-businesscard"></i>
                            <span>简历管理</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="/message">
                            <i class="iconfont icon-message_fill"></i>
                            <span>站内信({{$data['username']['messageNum']}})</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="/collection/index">
                            <i class="iconfont icon-praise"></i>
                            <span>收藏夹</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="info_right info_panel new_section">
            <dl class="c_delivery">
                <dt>
                    <h1>
                        <em></em>
                        收藏夹
                    </h1>
                    <a onclick="location.reload();" class="d_refresh">刷新</a>
                </dt>
                <dd>
                    <div class="delivery_tabs">
                        <ul class="reset">
                            <li class="current li_one">
                                <a class="all_border tabs_all">职位</a>
                            </li>
                            <li class="li_two">
                                <a class="tabs_delivery_success">资讯</a>
                            </li>
                        </ul>
                    </div>
                    <form id="deliveryForm" class="deliveryAll" style="display: block;">
                        <ul class="jieshao_list companydiv">
                            @foreach($data['collectionPosition'] as $position)
                                <li>
                                    <div class="gsdiv">
                                        <p class="b7">
                                            <a href="/position/detail?pid={{$position->pid}}" target="_blank" class="zw_name">
                                                @if(empty($position->title))
                                                    没有填写职位名称
                                                @else
                                                    {{mb_substr($position->title, 0, 15, 'utf-8')}}
                                                @endif
                                            </a>
                                            <span class="region">[{{$position->name}}]</span>
                                            <?php
                                            $time_now = time();
                                            $created_time = strtotime($position->created_at);
                                            $sub_time = ceil(($time_now - $created_time)/86400);
                                            ?>
                                            @if($sub_time == 1)
                                                {{mb_substr($position->created_at,11,5,'utf-8')}}发布
                                            @elseif($sub_time >1 && $sub_time <=2)
                                                1天前发布
                                            @elseif($sub_time >2 && $sub_time <=5)
                                                2天前发布
                                            @else
                                                {{substr($position->created_at,0,10)}}发布
                                            @endif
                                            {{--{{substr($position->created_at,0,10)}}发布--}}
                                        </p>
                                        <div class="brif">
                                            <font style="color: #fd5f39;font-size: 15px">
                                                @if($position->salary <= 0)
                                                    月薪面议
                                                @else
                                                    {{$position->salary/1000}}k-
                                                    @if($position->salary_max ==0) 无上限
                                                    @else {{$position->salary_max/1000}}k
                                                    @endif
                                                    元/月
                                                @endif
                                            </font >
                                            {{--                                            <span>|</span>{{mb_substr($position->ebrief, 0, 15, 'utf-8')}}--}}
                                            <span>|</span>{{$position->byname}}

                                        </div>
                                        <div class="div_s">
                                            {{--行业--}}
                                            @foreach($data['industry'] as $industry)
                                                @if($position->jobindustry == $industry->id)
                                                    <span>{{$industry->name}}</span>
                                                    @break
                                                @endif
                                            @endforeach
                                            {{--游戏--}}
                                            @foreach($data['occupation'] as $occupation)
                                                @if($position->occupation == $occupation->id)
                                                    <span>{{$occupation->name}}</span>
                                                    @break
                                                @endif
                                            @endforeach
                                            {{--职位--}}
                                            @foreach($data['place'] as $place)
                                                @if($position->place == $place->id)
                                                    <span>{{$place->name}}</span>
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                        {{--关闭投递简历按钮--}}
                                        {{--<div class="brif">--}}
                                        {{--@if($data['type']==0)--}}
                                        {{--<button class="deliver-resume toujianli" to="/account/login">投个简历</button>--}}
                                        {{--@elseif($position->position_status==1 ||$position->position_status==4)--}}
                                        {{--<button class="deliver-resume toujianli"--}}
                                        {{--data-content="{{$position->pid}}"--}}
                                        {{--data-toggle="modal" data-target="#chooseResumeModal">投个简历</button>--}}
                                        {{--@else--}}
                                        {{--<button class="deliver-resume toujianli">无法投递</button>--}}
                                        {{--@endif--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="company-all">
                                        <p class="company-name" style="cursor:pointer;" to="/company?eid={{$position->eid}}">
                                            <span class="name">{{$position->ename}}</span>
                                            <i class="material-icons">verified_user</i>
                                        </p>
                                        <p class="company-feature">
                                            @foreach($data['industry'] as $industry)
                                                @if($industry->id == $position->eindustry)
                                                    {{$industry->name}}/
                                                    @break
                                                @endif
                                            @endforeach
                                            @if($position->enature == null || $position->enature == 0)
                                                企业类型未知/
                                            @elseif($position->enature == 1)
                                                国有企业/
                                            @elseif($position->enature == 2)
                                                民营企业/
                                            @elseif($position->enature == 3)
                                                中外合资企业/
                                            @elseif($position->enature == 4)
                                                外资企业/
                                            @elseif($position->enature == 5)
                                                社会团体/
                                            @endif

                                            @if($position->escale == null)
                                                规模未知/
                                            @elseif($position->escale == 0)
                                                10人以下/
                                            @elseif($position->escale == 1)
                                                10～50人/
                                            @elseif($position->escale == 2)
                                                50～100人/
                                            @elseif($position->escale == 3)
                                                100～500人/
                                            @elseif($position->escale == 4)
                                                500～1000人/
                                            @elseif($position->escale == 5)
                                                1000人以上/
                                            @endif
                                        </p>
                                        <p class="company-bunefits">

                                            @if($position->tag ==="" || $position->tag ===null)
                                                <span>无标签</span>
                                            @else
                                                {{$position->tag}}
                                                {{--@foreach(preg_split("/(,| |、)/",$position->tag) as $tag)--}}
                                                {{--<span>{{$tag}}</span>--}}
                                                {{--@endforeach--}}
                                            @endif
                                        </p>
                                    </div>
                                    <div class="company-logo">
                                        @if($position->elogo == null)
                                            <img src="../images/1.gif"/>
                                        @else
                                            <img src="{{$position->elogo}}"/>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <nav id="page_tools">
                            {!! $data['collectionPosition']->render() !!}
                        </nav>
                    </form>

                    <form id="deliveryForm" class="deliverySuccess" style="display: none;">
                        <div class="mdl-card info-card">
                            @foreach($data['collectionNews'] as $news)
                                <div class="hot-news-body" data-content="{{$news->nid}}">
                                    @if($news->picture != null)
                                        <?php
                                        $pics = explode(';', $news->picture);
                                        $baseurl = explode('@', $pics[0])[0];
                                        $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                                        $imagepath = explode('@', $pics[0])[1];
                                        ?>
                                        <div class="hot-news-aside">
                                            <img src="{{$baseurl}}{{$imagepath}}" />
                                        </div>
                                    @else
                                        <div class="news-aside">
                                            <img src="{{asset('images/lamian.jpg')}}"/>
                                        </div>
                                    @endif
                                    <div class="hot-news-content">
                                        <h3><b>{{mb_substr($news->title, 0, 8)}}</b></h3>
                                        <p class="content-body" style="margin-bottom: 0px;">
                                            {{--{{mb_substr(str_replace(array("<br>","<br","<b","&nbsp;", "&nbs"),'', $news->content), 0, 35)}}--}}
                                            {{mb_substr(str_replace(array("[图片1]","[图片2]"),"",strip_tags($news->content)), 0, 35)}}
                                        </p>
                                        <small class="content-appendix">
                                            <span>发布时间: {{mb_substr($news->created_at,0,10,'utf-8')}}</span></small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <nav id="page_tools">
                            {!! $data['collectionNews']->render() !!}
                        </nav>
                    </form>
                </dd>
            </dl>
        </div>
    </div>

@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
<script type="text/javascript">
//    $(".wheel-button").wheelmenu({
//        // alert(1);
//        trigger: "hover",
//        animation: "fly",
//        angle: [0, 360]
//    });
    function show_progress(id) {
        $(".progress_status_one"+id).toggle();
    }
    function hide_progress(id) {
        $(".progress_status_one"+id).hide();
    }
    $(document).ready(function(){
        //点击查看投递详情
//        $(".delviery_success_btn").click(function(){
//            $(".progress_status_one").toggle()
//        });
//        $(".up_btn").click(function(){
//            $(".progress_status_one").hide()
//        });
        //切换tab
        $(".tabs_all").click(function(){
            $(".deliveryAll").show();
            $(".deliverySuccess").hide();
            $(".li_one").addClass("current");
            $(".li_two").removeClass("current");
        });
        $(".tabs_delivery_success").click(function(){
            $(".deliverySuccess").show();
            $(".deliveryAll").hide();
            $(".li_one").removeClass("current");
            $(".li_two").addClass("current");
        });
    });
    $(".hot-news-body").click(function () {
        window.open("/news/detail?nid=" + $(this).attr('data-content'));
    });
</script>
@endsection
