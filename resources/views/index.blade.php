@extends('layout.master')
@section('title', '电竞猎人|首页')

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 1,'type' => $data['type']])
@endsection

@section('custom-style')
    <link href="{{asset('../style/tao.css?v=2.61')}}" type="text/css" rel="stylesheet">
    <style>
        .jieshao_tb{
            margin-top: 1rem;
        }
        .nav-logo{
            padding: 20px 20px 10px 20px !important;
        }
        .info-panel {
            margin: 7px 0;
        }
        .info-panel--right {
             min-width: 390px;
             width: 20%;
        }
        .info-panel--left, .info-panel--right {
            display: inline-block;
            vertical-align: top;
        }
        .tuwen {
             width: 100%;
             clear: both;
             overflow: hidden;
             /* margin: 20px 0; */
         }
        .image_ad h3, .tuwen h3 {
              line-height: 40px;
              color: #38485A;
              font-size: 18px;
              border-bottom: 1px solid #E6E6E6;
              height: 40px;
              margin-bottom: 1rem;
              font-weight: bold;
          }
        .look-all {
               font-size: 12px;
               color: #666;
        }
        .pull-right {
            float: right!important;
        }
        .tuwen ul {
            padding: 0px;
            padding-left: 10px;
            list-style: none;
        }
        .tuwen li {
            overflow: hidden;
            width: 100%;
            clear: both;
            margin-bottom: 3.5px;
        }
        .tuwen li img {
            width: 100px;
            height: 67px;
            float: left;
            margin-right: 15px;
        }
        .tuwen li b {
            overflow: hidden;
            width: 100%;
            font-weight: normal;
            color: #333;
            font-size: 14px;
            line-height: 22px;
        }
        .tuwen li b:hover{
            color: #D32F2F;
        }
        .taoyige:hover{
            border: 1px solid #D32F2F;
            border-right: 0px;
        }
        .tuwen .new-time{
            float: right;
        }
    </style>
@endsection

@section('content')
    <div style="display:none" class="tishi">
                <span id="tishi_msg"></span>
                <div style="top:5px; right:5px;" class="close_X">X</div>
            </div>
            <div class="hsbj"></div>
            <div style="display:none;" class="whitebg"></div>

            <!--这是加载AJAX的动态转图-->
            <div style="left:50%; float:left; position:fixed; top:50%; z-index:100009; display:none;" id="home_loading">
                <img src="../images/anim_loading_75x75.gif">
            </div>
            <div class="containter">  
                <!-- 左边结束  -->
                <input type="hidden" value="" id="keywd_py">
                <div class="index_con">
                   <!--  <div id="all_divclass" class="all_divclass">
                        <div class="all_divcon">
                            {{--<p class="til">全部职位分类</p>   --}}
                            @foreach($data['industry'] as $industry)
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">{{$industry->name}}</h2>
                                    <?php $i=0; ?>
                                    @foreach($data['occupation'] as $occupation)
                                        @if($occupation->industry_id == $industry->id)
                                            @if($i++ >=4)
                                                @break
                                            @endif
                                            @if($i == 1){{--跳过综合选项--}}
                                                @continue
                                            @endif
                                            <a href="/position/advanceSearch?industry={{$industry->id}}&occupation={{$occupation->id}}">{{$occupation->name}}</a>
                                        @endif
                                    @endforeach
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            @foreach($data['occupation'] as $occupation)
                                                @if($occupation->industry_id == $industry->id)
                                                    <a href="/position/advanceSearch?industry={{$industry->id}}&occupation={{$occupation->id}}">{{$occupation->name}}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>   -->   
                    <div class="jieshao">
                        <form action="/index/search">
                            <div class="taoyige">
                                <div class="left form_div">
                                    <input type="text" placeholder="请输入关键词，如：绝地求生" name="keyword" style="height:100%">
                                </div>
                            </div>
                            <input type="submit" value="搜索" id="chakan">
                        </form>
                        <!-- 热门搜索 -->
                        <div class="taoyige_hotsearch">热门搜索：
                            <a href="/index/search?keyword=绝地求生">绝地求生</a>
                            <a href="/index/search?keyword=ADC">ADC</a>
                            <a href="/index/search?keyword=王者荣耀">王者荣耀</a>
                            <a href="/index/search?keyword=打野">打野</a>
                            <a href="/index/search?keyword=中单">中单</a>
                        </div>
                        <!-- 热门搜索 end-->
                        <!-- banner 轮播-->
                        <div class="m_banner">
                            <div style="cursor:pointer;" class="banner banner1">
                                <img src="../images/banner.jpg" width="800" height="241"/>
                            </div>  
                            {{--<div style="display:none; cursor:pointer;" class="banner banner2">--}}
                                {{--<img src="../images/banner3.jpg" width="800" height="241"/>--}}
                            {{--</div>          --}}
                            {{--<div style="display:none; cursor:pointer;" class="banner banner3">--}}
                                {{--<img src="../images/banner2.jpg" width="800" height="241"/>--}}
                            {{--</div>          --}}
                            <a class="prev" href="javascript:void(0);" style="display: none;"></a>
                            <a class="next" href="javascript:void(0);" style="display: none;"></a>
                        </div>
                        <!-- 轮播end -->
                    </div> 
                    <div class="info-panel--right info-panel" style="padding-left: 16px;">
                        <div class="tuwen">
                            <h3>最新资讯
                                <a href="news/">
                                    <span class="pull-right look-all">查看全部&gt;&gt;</span></a>
                            </h3>
                            <?php
                            $index = 0;
                            $count = 11;
                            ?>
                            <ul>
                                @foreach($data['news']['news'] as $newsItem)
                                    @if($index++ < $count)
                                        @if($newsItem->picture != null)
                                            <?php
//                                            $pics = explode(';', $newsItem->picture);
//                                            $baseurl = explode('@', $pics[0])[0];
//                                            $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
//                                            $imagepath = explode('@', $pics[0])[1];
                                            ?>
                                            <li>
                                                <a href="news/detail?nid={{$newsItem->nid}}" target="_blank">
                                                    @if($newsItem->type ==1)
                                                        <span class="label label-warning">综合电竞</span>
                                                    @elseif($newsItem->type ==2)
                                                        <span class="label label-info">电竞八卦</span>
                                                    @elseif($newsItem->type ==3)
                                                        <span class="label label-default">赛事资讯</span>
                                                    @elseif($newsItem->type ==4)
                                                        <span class="label label-success">游戏快讯</span>
                                                    @elseif($newsItem->type ==5)
                                                        <span class="label label-primary">职场鸡汤</span>
                                                    @endif
                                                    {{--<img src="{{$baseurl}}{{$imagepath}}">--}}
                                                    <b>{{mb_substr($newsItem->title,0,18,'utf-8')}}</b>
                                                    <span class="new-time">{{mb_substr($newsItem->created_at,6,5,'utf-8')}}</span>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="news/detail?nid={{$newsItem->nid}}" target="_blank">
                                                    <img src="http://eshunter.com/storage/newspic/default.jpg">
                                                    <b>{{mb_substr($newsItem->title,0,18,'utf-8')}}</b>
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                                {{--<li>--}}
                                    {{--<a href="news/detail?nid=564">--}}
                                        {{--<img src="http://116.62.198.110/storage/newspic/2018-03-13-17-43-41-5aa79d4d6639cnews1.png">--}}
                                        {{--<b>王者荣耀2018KPL春季赛解说阵容公布</b>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="news/detail?nid=563">--}}
                                        {{--<img src="http://116.62.198.110/storage/newspic/2018-03-13-17-33-18-5aa79adeb13benews1.png">--}}
                                        {{--<b>中国职业选手为何很难进入国外OWL战队</b>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="news/detail?nid=562">--}}
                                        {{--<img src="http://116.62.198.110/storage/newspic/2018-03-13-17-29-25-5aa799f506c0fnews1.jpg">--}}
                                        {{--<b>ESPN战力榜：IG升到全球第三，SKT排名第八</b>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="jieshao_tb">
                    <span v="0" class="active">热门职位</span>
                    <span v="1">最新职位</span>          
                </div>  
                <ul class="jieshao_list hotjobs" style="display: block;">
                    @foreach($data['position']['position'] as $position)
                        <li>
                            <div class="jieshao_list_left left">
                                <div class="list_top">
                                    <div class="clearfix pli_top">
                                        <div class="position_name left">
                                            <h2 class="dib"><a href="/position/detail?pid={{$position->pid}}">{{mb_substr($position->title,0,11,'utf-8')}}</a></h2>
                                            <span class="create_time">&ensp;[{{substr($position->created_at,0,10)}}]&ensp;</span>
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

                                <div class="pli_btm">
                                    <a href="/company?eid={{$position->eid}}" class="left">
                                        <img
                                                @if($position->elogo === "" ||$position->elogo === null)
                                                src="../images/pic0.jpg"
                                                @else
                                                src="{{$position->elogo}}"
                                                @endif
                                                alt="公司logo" class="company-logo" width="40" height="40">
                                    </a>
                                    <div class="bottom-right">
                                        <div class="company_name wordCut">
                                            <a href="/company?eid={{$position->eid}}">
                                                @if($position->byname != "")
                                                    {{$position->byname}}
                                                @else
                                                    {{$position->ename}}
                                                @endif
                                            </a>
                                        </div>
                                        <div class="industry wordCut">
                                            {{--<span>{{mb_substr($position->ebrief,0,20,'utf-8')}}</span>--}}
                                            <span>
                                                @foreach($data['industry'] as $industry)
                                                    @if($industry->id == $position->industry)
                                                        {{$industry->name}}
                                                        @break
                                                    @endif
                                                @endforeach
                                            </span>
                                            <span>
                                                @if($position->enature == null || $position->enature == 0)
                                                    企业类型未知
                                                @elseif($position->enature == 1)
                                                    国有企业
                                                @elseif($position->enature == 2)
                                                    民营企业
                                                @elseif($position->enature == 3)
                                                    中外合资企业
                                                @elseif($position->enature == 4)
                                                    外资企业
                                                @elseif($position->enature == 5)
                                                    社会团体
                                                @endif
                                            </span>
                                            <span>
                                                 @if($position->escale == null || $position->escale == 0)
                                                    规模未知
                                                @elseif($position->escale == 1)
                                                    50人以下
                                                @elseif($position->escale == 2)
                                                    50～200人
                                                @elseif($position->escale == 3)
                                                    200～500人
                                                @elseif($position->escale == 4)
                                                    500～1000人
                                                @elseif($position->escale == 5)
                                                    1000人以上
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="jieshao_list jobs" style="display: none;">
                    @foreach($data['newestposition']['position'] as $position)
                        <li>
                            <div class="jieshao_list_left left">
                                <div class="list_top">
                                    <div class="clearfix pli_top">
                                        <div class="position_name left">
                                            <h2 class="dib"><a href="/position/detail?pid={{$position->pid}}">{{mb_substr($position->title,0,11,'utf-8')}}</a></h2>
                                            <span class="create_time">&ensp;[{{substr($position->created_at,0,10)}}]&ensp;</span>
                                        </div>
                                        <span class="salary right">
                                        @if($position->salary == -1)
                                                工资面议
                                            @else
                                                {{$position->salary/1000}}K-
                                                @if($position->salary_max == -1)
                                                    无上限
                                                @else
                                                    {{$position->salary_max/1000}}K
                                                @endif
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

                                <div class="pli_btm">
                                    <a href="/company?eid={{$position->eid}}" class="left">
                                        <img
                                                @if($position->elogo === "" ||$position->elogo === null)
                                                src="../images/pic0.jpg"
                                                @else
                                                src="{{$position->elogo}}"
                                                @endif
                                                alt="公司logo" class="company-logo" width="40" height="40">
                                    </a>
                                    <div class="bottom-right">
                                        <div class="company_name wordCut">
                                            <a href="/company?eid={{$position->eid}}">
                                                @if($position->byname != "")
                                                    {{$position->byname}}
                                                @else
                                                    {{$position->ename}}
                                                @endif
                                            </a>
                                        </div>
                                        <div class="industry wordCut">
                                            {{--<span>{{mb_substr($position->ebrief,0,20,'utf-8')}}</span>--}}
                                            <span>
                                                @foreach($data['industry'] as $industry)
                                                    @if($industry->id == $position->industry)
                                                        {{$industry->name}}
                                                        @break
                                                    @endif
                                                @endforeach
                                            </span>
                                            <span>
                                                @if($position->enature == null || $position->enature == 0)
                                                    企业类型未知
                                                @elseif($position->enature == 1)
                                                    国有企业
                                                @elseif($position->enature == 2)
                                                    民营企业
                                                @elseif($position->enature == 3)
                                                    中外合资企业
                                                @elseif($position->enature == 4)
                                                    外资企业
                                                @elseif($position->enature == 5)
                                                    社会团体
                                                @endif
                                            </span>
                                            <span>
                                                 @if($position->escale == null)
                                                    规模未知
                                                @elseif($position->escale == 0)
                                                    10人以下
                                                @elseif($position->escale == 1)
                                                    10～50人
                                                @elseif($position->escale == 2)
                                                    50～100人
                                                @elseif($position->escale == 3)
                                                    100～500人
                                                @elseif($position->escale == 4)
                                                    500～1000人
                                                @elseif($position->escale == 5)
                                                    1000人以上
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="more_box"><a href="position/advanceSearch" class="list_more">查看更多</a></div>

                <div class="gongsi_tb">
                    <span v="0" class="active">热门公司</span>
                    <span v="1">推荐公司</span>
                </div> 
                <div class="ad_company gongsi_list">
                    <ul class="ad_company_list clearfix hot-company" data-content="{{ceil(count($data['ad']['ad0'])/5)}}">
                        <?php
                        $i=0;
                        $count=0;
                        ?>
                        @foreach($data['ad']['ad0'] as $ad_big)
                        <li class="company_item" name="hot{{$i}}" @if($i >1) style="display: none" @endif>
                            <div class="item_top">
                                <p>
                                    <a href="/company?eid={{$ad_big->eid}}" target="_blank">
                                        <img src="{{$ad_big->picture or asset('images/house.jpg')}}" alt="" width="200" height="100" style="margin-left: 12.5px;"/>
                                    </a>
                                </p>
                                <p class="company-name wordCut">
                                    <a href="/company?eid={{$ad_big->eid}}" target="_blank">{{$ad_big->title}}</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>{{$ad_big->content}}</span>
                                </p>
                            </div>
                        </li>
                            <?php
                                $count++;
                                if($count >=5){
                                    $count =0;
                                    $i++;
                                }
                            ?>
                        @endforeach
                        <div style="clear: both;"></div>
                    </ul>
                    <ul class="ad_company_list clearfix nav-logos tuijian-company">
                        @foreach($data['ad']['ad1'] as $ad1)
                        <li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319">
                            <div class="nav-img" data-reactid="320" to="/company?eid={{$ad1->eid}}">
                                <img src="{{$ad1->picture or asset('images/house.jpg')}}" width="90" height="90"data-reactid="321">
                                <div class="nav-hover-cycle" data-reactid="322"></div>
                            </div>
                            <div class="company-short-name" data-reactid="323">{{$ad1->title}}</div>
                        </li>
                        @endforeach
                    <div style="clear: both;"></div>
                </ul>
                    <div style="clear: both;"></div>
                </ul>
                </div>
                
            <div class="ad_company">
                
            </div>
            <div class="ad_company"></div>
            {{--<div class="more_box"><a href="#" class="list_more">查看更多</a></div>--}}
               {{--暂时隐藏广告资讯--}}
                {{--<div class="jieshao_tb">--}}
                    {{--<span v="0" class="active">广告资讯</span>--}}
                {{--</div>--}}
                {{--<div class="ad_company" style="    padding-top: 20px;">--}}
                    {{--<ul class="gallery-list">--}}
                        {{--i = 0--}}
                        {{--@foreach($data['news']['news'] as $new)--}}
                                {{--@if($new->picture != null)--}}
                                    {{--$pics = explode(';', $new->picture);--}}
                                    {{--$baseurl = explode('@', $pics[0])[0];--}}
                                    {{--$baseurl = substr($baseurl, 0, strlen($baseurl) - 1);--}}
                                    {{--$imagepath = explode('@', $pics[0])[1];--}}
                                    {{--<li class="gallery-item @if($i ==0 ||$i ==7) larger-item @endif" style="background-image:url({{$baseurl}}{{$imagepath}});">--}}
                                {{--@else--}}
                                    {{--<li class="gallery-item @if($i ==0 ||$i ==7) larger-item @endif" style="background-image:url(http://eshunter.com/storage/newspic/default.jpg);">--}}
                                {{--@endif--}}
                                    {{--<a class="gallery-link" href="news/detail?nid={{$new->nid}}" target="_blank">--}}
                                        {{--<span class="text">{{$new->title}}</span>--}}
                                    {{--</a>--}}
                                    {{--</li>--}}
                        {{--@endforeach--}}
                        {{--<div style="clear: both;"></div>--}}
                        {{----}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="more_box">--}}
                    {{--<a href="/news" class="list_more">查看更多</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            
@endsection


@section('footer')
    @include('components.myfooter')
    {{--@include('components.wheelmenu')--}}
@endsection


@section('custom-script')
    <script charset="utf-8" type="text/javascript" src="{{asset('js/header.js?v=1.00')}}"></script>
    <script>
        
        var openid = "";
        var ad_count_total = $('.hot-company').attr('data-content');//热门广告分组总数
        var ad_count = 0;//热门广告当前显示分组号

        $(function() {
            //定时执行函数
            function changeAdCompany() {
                $('li[name=hot'+ad_count+']').hide();
//                $('li[name=hot'+ad_count+']').fadeToggle("fast");
//                $('li[name=hot'+(ad_count+1)+']').fadeToggle();
                $('li[name=hot'+(ad_count+2)+']').fadeToggle("slow");
                //边界处理
                if(ad_count+2 > ad_count_total-1){
                    $('li[name=hot'+(ad_count+1)+']').hide();
                    ad_count=0;
                    $('li[name=hot'+(ad_count)+']').show();
                    $('li[name=hot'+(ad_count+1)+']').show();
                }else {
                    ad_count +=1;
                }
            }
            //重复执行
            var t1 = window.setInterval(changeAdCompany,5000);
            //加载index_xianxing内容，推荐状况的实时展示

            // 气球客服
            // if($('.QQ_each').offset().top<489){
            //   $('.QQ_each').css({'top':'489px','margin-top':'0'});
            //   }
            // 鼠标滑过banner，箭头出现
            $('.m_banner').mouseover(function() {
                $('.m_banner a').show();
            })
            $('.m_banner').mouseleave(function() {
                $('.m_banner a').hide();
            })
            // 城市部分鼠标滑过
            $('.city_chooseCon').mouseover(function() {
                $('.choosing').stop(true, true).slideDown(150);
            })
            $('.city_chooseCon').mouseleave(function() {
                $('.choosing').stop(true, true).slideUp(150);
            })

            // 职位tab
            $('.jieshao_list').hide();
            $('.jieshao_list').eq(0).show();
            $('.jieshao_tb span').click(function() {
                $(this).addClass('active');
                $('.jieshao_list').eq($(this).index()).show();
                $(this).siblings('span').removeClass('active');
                $('.jieshao_list').eq($(this).index()).siblings('ul').hide();
                var v = $(this).attr('v');
            })
            $('.gongsi_tb span').click(function() {
                $(this).addClass('active').siblings('span').removeClass('active');
                $(this).index() === 0 && $('.gongsi_list').find('.hot-company').show().siblings('.tuijian-company').hide()
                $(this).index() === 1 && $('.gongsi_list').find('.tuijian-company').show().siblings('.hot-company').hide()
                var v = $(this).attr('v');
            })


            // 鼠标滑过边框变色
            $('.all_divclass').on('mouseover', function() {
                
                // 定位导航
                $(document).scroll(function() {
                    var window_height = $(window).height();
                    var to_bottom = $(document).height() - $(window).height() - $(document).scrollTop();
                    if (window_height > 660 && window_height < 920) {
                        if ($(document).scrollTop() >= 200) {
                            $('#all_divclass').addClass('all_static');
                            if (to_bottom > 230) {
                                $('#all_divclass').removeClass('all_static').removeClass('all_absolute').addClass('all_fixed');
                            } else {
                                $('#all_divclass').removeClass('all_static').removeClass('all_fixed').addClass('all_absolute');
                            }
                        }
                        if ($(document).scrollTop() < 100) {
                            $('#all_divclass').addClass('all_static');
                        }
                    }

                    // 屏幕可以放下左边导航和底部的情况
                    if (window_height > 920) {
                        if ($(document).scrollTop() >= 200) {
                            $('#all_divclass').removeClass('all_static').addClass('all_fixed');
                        } else {
                            $('#all_divclass').removeClass('all_fixed').addClass('all_static');
                        }
                    }
                })


//                $('.banner1').on('click', function() {
//                    window.open("#");
//                });
//                $('.banner2').on('click', function() {
//                    window.open("#");
//                });
//                $('.banner3').on('click', function() {
//                    window.open("#");
//                });
                // 二级导航
                $('.all_divlist_border').on('mouseover', function() {
                    $(this).addClass('all_divlist_active');
                    $(this).find('.all_divlist').css({

                    });
                    $(this).prev().find('.all_divlist').css({

                    });
                    $(this).siblings('.all_divlist_border').removeClass('all_divlist_active');
                    $(this).find('.all_divlist_two').show();
                })

                $('.all_divlist_border').on('mouseout', function() {
                    $(this).removeClass('all_divlist_active');
                    $(this).find('.all_divlist_two').hide();
                    $(this).find('.all_divlist').css({

                    });
                    $(this).prev().find('.all_divlist').css({

                    });
                })
            })


        })
    </script>
@endsection


