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
        .all_divcon{
            position: static;
        }
        .nav-logo{
            padding: 20px 20px 10px 20px !important;
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
                    <div id="all_divclass" class="all_divclass">
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
                                            <a href="/position/advanceSearch?industry={{$industry->id}}">{{$occupation->name}}</a>
                                        @endif
                                    @endforeach
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            @foreach($data['occupation'] as $occupation)
                                                @if($occupation->industry_id == $industry->id)
                                                    <a href="/position/advanceSearch?industry={{$industry->id}}">{{$occupation->name}}</a>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>     
                    <div class="jieshao">
                        <div class="taoyige">
                            <div class="left form_div">
                                <input type="text" placeholder="请输入关键词，如：运营策划" value="" name="" id="xinkeywd" style="height:100%">
                            </div>
                        </div>
                        <input type="button" value="搜索" href="/search" name="" id="chakan">
                        <!-- 热门搜索 -->
                        <div class="taoyige_hotsearch">热门搜索：<a href="#">电竞传媒</a><a href="#">ADC</a><a href="#">辅助</a><a href="#">打野</a><a href="#">中单</a></div>
                        <!-- 热门搜索 end-->
                        <!-- banner 轮播-->
                        <div class="m_banner">
                            <div style="cursor:pointer;" class="banner banner1">
                                <img src="../images/banner.jpg" width="800" height="241"/>
                            </div>  
                            <div style="display:none; cursor:pointer;" class="banner banner2">
                                <img src="../images/banner3.jpg" width="800" height="241"/>
                            </div>          
                            <div style="display:none; cursor:pointer;" class="banner banner3">
                                <img src="../images/banner2.jpg" width="800" height="241"/>
                            </div>          
                            <a class="prev" href="javascript:void(0);" style="display: none;"></a>
                            <a class="next" href="javascript:void(0);" style="display: none;"></a>
                        </div>
                        <!-- 轮播end -->
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
                                            <span class="create_time">&ensp;[{{substr($position->updated_at,0,10)}}]&ensp;</span>
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
                                            <span>{{mb_substr($position->ebrief,0,20,'utf-8')}}</span>
                                            {{--<span>未融资</span>--}}
                                            {{--<span>成都-高新pli-btm</span>--}}
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
                                            <span class="create_time">&ensp;[{{substr($position->updated_at,0,10)}}]&ensp;</span>
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
                                            <span>{{mb_substr($position->ebrief,0,20,'utf-8')}}</span>
                                            {{--<span>未融资</span>--}}
                                            {{--<span>成都-高新pli-btm</span>--}}
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
                    <ul class="ad_company_list clearfix hot-company">
                        @foreach($data['ad']['ad0'] as $ad_big)
                        <li class="company_item">
                            <div class="item_top">
                                <p>
                                    <a href="/company?eid={{$ad_big->eid}}" target="_blank">
                                        <img src="{{$ad_big->picture or asset('images/house.jpg')}}" alt="" width="193" height="100"/>
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
                        @endforeach
                        <div style="clear: both;"></div>
                    </ul>
                    <ul class="ad_company_list clearfix nav-logos tuijian-company">
                        @foreach($data['ad']['ad1'] as $ad1)
                        <li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319">
                            <div class="nav-img" data-reactid="320" to="/company?eid={{$ad1->eid}}">
                                <img src="{{$ad1->picture or asset('images/house.jpg')}}" width="70" height="70"data-reactid="321">
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
            <!-- <div class="more_box"><a href="#" class="list_more">查看更多</a></div> -->
            <div class="jieshao_tb">
                <span v="0" class="active">广告资讯</span>
            </div>
            <div class="ad_company" style="    padding-top: 20px;">
                <ul class="gallery-list">
                    <?php $i = 0;?>
                    @foreach($data['news']['news'] as $new)
                            @if($new->picture != null)
                                <?php
                                $pics = explode(';', $new->picture);
                                $baseurl = explode('@', $pics[0])[0];
                                $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                                $imagepath = explode('@', $pics[0])[1];
                                ?>
                                <li class="gallery-item @if($i ==0 ||$i ==7) larger-item @endif" style="background-image:url({{$baseurl}}{{$imagepath}});">
                            @else
                                <li class="gallery-item @if($i ==0 ||$i ==7) larger-item @endif" style="background-image:url(http://eshunter.com/storage/newspic/default.jpg);">
                            @endif
                                <a class="gallery-link" href="news/detail?nid={{$new->nid}}" target="_blank">
                                    <span class="text">{{$new->title}}</span>
                                </a>
                                </li>
                            <?php $i++;?>
                    @endforeach
                	<div style="clear: both;"></div>
                	
                </ul>
            </div>
            <div class="more_box"><a href="/news" class="list_more">查看更多</a></div>
            </div>
            
@endsection


@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
    <script charset="utf-8" type="text/javascript" src="{{asset('js/header.js?v=1.00')}}"></script>
    <script>
        
        var openid = "";
        $(function() {
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


                $('.banner1').on('click', function() {
                    window.open("#");
                });
                $('.banner2').on('click', function() {
                    window.open("#");
                });
                $('.banner3').on('click', function() {
                    window.open("#");
                });
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


