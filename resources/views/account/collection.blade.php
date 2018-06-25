@extends('layout.master')
@section('title', '收藏夹')

@section('custom-style')
    {{--<link media="all" href="{{asset('../style/delivery.css')}}" type="text/css" rel="stylesheet">--}}
    <link media="all" href="{{asset('../style/news.css')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('../style/apply.css')}}" type="text/css" rel="stylesheet">
    <link media="all" rel="stylesheet" href="{{asset('../style/personal_account.css')}}" type="text/css">
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
                                <a class="all_border tabs_all">收藏职位</a>
                            </li>
                            <li class="li_two">
                                <a class="tabs_delivery_success">收藏新闻</a>
                            </li>
                        </ul>
                    </div>
                    <form id="deliveryForm" class="deliveryAll" style="display: block;">
                        <ul class="jieshao_list hotjobs" style="display: block;">
                            @foreach($data['collectionPosition'] as $position)
                                <li>
                                    <div class="jieshao_list_left left">
                                        <div class="list_top">
                                            <div class="clearfix pli_top">
                                                <div class="position_name left">
                                                    <h2 class="dib"><a
                                                                href="/position/detail?pid={{$position->pid}}">{{mb_substr($position->title,0,11,'utf-8')}}</a>
                                                    </h2>
                                                    <br>
                                                    <span class="create_time">&ensp;[{{substr($position->created_at,0,10)}}
                                                        ]&ensp;</span>
                                                </div>
                                                <span class="salary right">
                                        @if($position->salary <= 0)
                                                        月薪面议
                                                    @else
                                                        {{$position->salary/1000}}k-
                                                        @if($position->salary_max ==0) 无上限
                                                        @else {{$position->salary_max/1000}}k
                                                        @endif
                                                        元/月
                                                    @endif
                                    </span>
                                            </div>
                                            <div class="position_main_info">
                                    <span>
                                        @if($position->work_nature == 0)
                                            兼职
                                        @elseif($position->work_nature == 1)
                                            实习
                                        @else
                                            全职
                                        @endif
                                    </span>
                                                <span>
                                        @if($position->education == -1)
                                                        无学历要求
                                                    @elseif($position->education == 0)
                                                        高中及以上
                                                    @elseif($position->education == 3)
                                                        专科及以上
                                                    @elseif($position->education == 1)
                                                        本科及以上
                                                    @elseif($position->education == 2)
                                                        研究生及以上
                                                    @endif
                                    </span>
                                            </div>
                                            <div class="lebel">
                                                <div class="lebel_item">
                                                    @if($position->tag ==="" || $position->tag ===null)
                                                        <span class="wordCut">无标签</span>
                                                    @else
                                                        @foreach(preg_split("/(,| |、|;|，)/",$position->tag) as $tag)
                                                            <span class="wordCut">{{$tag}}</span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
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
