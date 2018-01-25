@extends('layout.master')
@section('title', '电竞猎人|资讯中心')

@section('custom-style')
   
@endsection


@section('header-nav')
   @include('components.headerNav')
@endsection


@section('header-tab')
   @include('components.headerTab')
@endsection

@section('content')
	<link href="css/fenyestyle.css?v=2.33" type="text/css" rel="stylesheet">
            
            <div class="containter" style="margin-top: 20px;">
                <div class="news" id="news">
                	<div class="news_tab" id="newsTab">
                		<ul>
                			<li class="current">综合电竞</li>
                			<li>赛事资讯</li>
                			<li>游戏快讯</li>
                			<li>八卦趣闻</li>
                			<li>职场鸡汤</li>
                		</ul>
                	</div>
                </div>
                <div class="news_info_left info_panel left ">
                	<div class="mdl_card_title">
                		<h5 class="mdl_card_title_text">最新</h5>
                	</div>
                	<div class="mdl-card info-card">
                		<div class="news-body">
                			<div class="news-aside">
                				<a href="news_detail.html"><img src="../images/news1.jpg"/></a>
                			</div>
                			<div class="news-content">
                				<h3><a href="news_detail.html">工作第一年，什么比薪水更重要？</a></h3>
                				<div class="content-body">
                                                                 见过很多这样的论调：情怀、发展什么的都是虚的，钱才是实打实的。永远不要相信老板对
                                </div>
                                <small class="content-appendix">
                                    <span>责任编辑: admin</span><span>新闻来源:插坐学院</span><span>发布时间: 2018-01-17</span>
                                </small>
                			</div>
                		</div>
                		<div class="news-body" data-content="291">
                            <div class="news-aside">
                                <a href="news.html"><img src="../images/news2.jpg"/></a>
                            </div>
                            <div class="news-content">
                                <h3><a href="news_detail.html">人年轻的时候应该多跳槽吗？</a></h3>
                                <div class="content-body">
                                                                 知乎上曾经有个热门问题，“人年轻的时候就该多跳槽吗？”;
                                </div>
                                <small class="content-appendix">
                                    <span>责任编辑: admin</span><span>新闻来源:馒头商学院</span><span>发布时间: 2018-01-15</span>
                                </small>
                            </div>
                        </div>
                        <div class="news-body" data-content="291">
                            <div class="news-aside">
                                <a href=""><img src="../images/news1.jpg"/></a>
                            </div>
                            <div class="news-content">
                                <h3><a href="#">人年轻的时候应该多跳槽吗？</a></h3>
                                <div class="content-body">
                                                                 知乎上曾经有个热门问题，“人年轻的时候就该多跳槽吗？”;
                                </div>
                                <small class="content-appendix">
                                    <span>责任编辑: admin</span><span>新闻来源:馒头商学院</span><span>发布时间: 2018-01-15</span>
                                </small>
                            </div>
                        </div>
                        <div class="news-body" data-content="291">
                            <div class="news-aside">
                                <a href=""><img src="../images/news2.jpg"/></a>
                            </div>
                            <div class="news-content">
                                <h3><a href="#">人年轻的时候应该多跳槽吗？</a></h3>
                                <div class="content-body">
                                                                 知乎上曾经有个热门问题，“人年轻的时候就该多跳槽吗？”;
                                </div>
                                <small class="content-appendix">
                                    <span>责任编辑: admin</span><span>新闻来源:馒头商学院</span><span>发布时间: 2018-01-15</span>
                                </small>
                            </div>
                        </div>
                        <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>
                	</div>
                </div>
                <div class="news_info_right info_panel right  ">
                	<div class="mdl_card_title">
                		<h5 class="mdl_card_title_text">最热</h5>
                	</div>
                	<div class="mdl-card info-card">
                		<div class="hot-news-body" data-content="181">
							<div class="hot-news-aside">
                                <a href="news_detail.html"><img src="../images/news2.jpg"/></a>
                            </div>
                            <div class="hot-news-content">
                                <h3><a href="news_detail.html">想进入电竞行业工</a></h3>
                                <div class="content-body">
                                                                 想要从事电子竞技，并不是凭一腔热血。对游戏的热爱固然可贵，但更重要的是
                                </div>
                                <small class="content-appendix">
                                    <span>发布时间: 2017-12-13</span>
                                </small>
                            </div>
                        </div>
                        <div class="mdl-card info-card">
                		<div class="hot-news-body" data-content="181">
							<div class="hot-news-aside">
                                <a href="news_detail.html"><img src="../images/news1.jpg"/></a>
                            </div>
                            <div class="hot-news-content">
                                <h3><a href="news_detail.html">想进入电竞行业工</a></h3>
                                <div class="content-body">
                                                                 想要从事电子竞技，并不是凭一腔热血。对游戏的热爱固然可贵，但更重要的是
                                </div>
                                <small class="content-appendix">
                                    <span>发布时间: 2017-12-13</span>
                                </small>
                            </div>
                        </div>
                	</div>
                	</div>
                </div>
                <script src="js/jquery.wheelmenu.js" type="text/javascript"></script>
                <div class="QQ_each">
                    <a class="wheel-button float_qq" href="#wheel" style="opacity: 1;"></a>
                    <ul class="wheel" id="wheel">
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <!--<li class="item"><a target="_blank" href="#" class='sss'>沙僧</a></li>-->
                        <li class="item"><a class="bj" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1538590175&amp;site=qq&amp;menu=yes" target="_blank">寻找<br>工作</a></li>
                        <li class="item"><a class="wk" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3078167392&amp;site=qq&amp;menu=yes" target="_blank">发布<br>职位</a></li>
                        <li class="item"><a class="ts" href="http://wpa.qq.com/msgrd?v=3&amp;uin=6281927&amp;site=qq&amp;menu=yes" target="_blank">联系<br>我们</a></li>      
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                    </ul>
                </div>
                <a style="display:none" class="back_to_top" title="" href="#"></a>

                <script type="text/javascript">
                	$(".wheel-button").wheelmenu({
						// alert(1);
						trigger: "hover",
						animation: "fly",
						angle: [0, 360]
					});
                </script>

            </div>
@endsection

@section('footer')
   @include('components.myfooter')
@endsection

@section('custom-script')
@endsection