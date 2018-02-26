@extends('layout.master')
@section('title', '消息通知')

@section('custom-style')
 <link media="all" href="{{asset('../style/msgDetail.css')}}" type="text/css" rel="stylesheet">
@endsection

@section('content')
<div id="messageContainer" class="container cleafix">
			<div class="content-left">
				<div class="left-wrap">
					<div class="setting-box">
					    <h2 class="main-title">我的消息</h2>
					    <div class="setting-btn" style="display: none;">
					        <a href="#" data-lg-tj-id="1810" >设置</a>
					    </div>
					</div>
					<div class="category-tab">
					    <div class="item-wrap">
					        <ul class="tab" id="tabContainer">
					            <li class="tab-item item_1 active">
					            	<a href="javascript:;">全部</a></li>
					            <li class="sep">
					            	<span>|</span>
					            </li>
					            <li class="tab-item item_2">
					            	<a  href="javascript:;">投递反馈</a>
					            </li>
					            <li class="sep">
					            	<span>|</span>
					            </li>
					            <li class="tab-item item_3">
					            	<a href="javascript:;">职位邀请</a>
					            </li>
					            <li class="sep">
					            	<span>|</span>
					            </li>
					            
					            <li class="tab-item item_4">
					            	<a href="javascript:;">系统通知</a>
					            </li>
					        </ul>
					    </div>
					</div>
					<div class="twrap">
						<div class="tab-content" id="msgContent">
							<!--全部-->
							<div class="t-content-item t-content-item_1 active" style="display: none;">
								<ul class="msg-list" id="allListContainer">
									<li class="msg-box" >
							            <div class="msg-body">
							                <div class="msg-type"><i class="msg-avant apply-v"></i></div>
							                <div class="msg-content ">
							                    <div class="msg-head ">
							                        <div class="left">投递反馈</div>
							                        <div class="right">2018-01-30 15:16</div>
							                    </div>
							                    <dl class="info">
							                        <dt>
							                            <a class="company-logo" target="_blank" href="#">
							                                <img class="" src="images/pic0.jpg">
							                            </a>
							                        </dt>
							                        <dd class="msg-info">
							                            <h4>
							                                <a href="#" target="_blank" class="job-title">王者荣耀玩家</a>
							                                <em>·</em>
							                                <a href="#" target="_blank">LGD俱乐部</a>
							                            </h4>
							                            <div class="msg-status">
							                                <span>最新状态：</span>
							                                <a href="#" target="_blank">不合适</a>
							                            </div>
							                            <a class="to-detail" target="_blank" href="#">去看看</a>
							                        </dd>
							                    </dl>
							                </div>
							            </div>
							        </li>
							        <li class="msg-box" >
							            <div class="msg-body">
							                <div class="msg-type"><i class="msg-avant apply-v"></i></div>
							                <div class="msg-content ">
							                    <div class="msg-head ">
							                        <div class="left">投递反馈</div>
							                        <div class="right">2018-01-30 15:16</div>
							                    </div>
							                    <dl class="info">
							                        <dt>
							                            <a class="company-logo" target="_blank" href="#">
							                                <img class="" src="images/pic0.jpg">
							                            </a>
							                        </dt>
							                        <dd class="msg-info">
							                            <h4>
							                                <a href="#" target="_blank" class="job-title">王者荣耀玩家</a>
							                                <em>·</em>
							                                <a href="#" target="_blank">LGD俱乐部</a>
							                            </h4>
							                            <div class="msg-status">
							                                <span>最新状态：</span>
							                                <a href="#" target="_blank">不合适</a>
							                            </div>
							                            <a class="to-detail" target="_blank" href="#">去看看</a>
							                        </dd>
							                    </dl>
							                </div>
							            </div>
							        </li>
							        <li class="msg-box" >
							            <div class="msg-body">
							                <div class="msg-type"><i class="msg-avant apply-v"></i></div>
							                <div class="msg-content ">
							                    <div class="msg-head ">
							                        <div class="left">投递反馈</div>
							                        <div class="right">2018-01-30 15:16</div>
							                    </div>
							                    <dl class="info">
							                        <dt>
							                            <a class="company-logo" target="_blank" href="#">
							                                <img class="" src="images/pic0.jpg">
							                            </a>
							                        </dt>
							                        <dd class="msg-info">
							                            <h4>
							                                <a href="#" target="_blank" class="job-title">王者荣耀玩家</a>
							                                <em>·</em>
							                                <a href="#" target="_blank">LGD俱乐部</a>
							                            </h4>
							                            <div class="msg-status">
							                                <span>最新状态：</span>
							                                <a href="#" target="_blank">不合适</a>
							                            </div>
							                            <a class="to-detail" target="_blank" href="#">去看看</a>
							                        </dd>
							                    </dl>
							                </div>
							            </div>
							        </li>
								</ul>
							</div>
							<!--投递反馈-->
							<div class="t-content-item t-content-item_2" style="display: none;">
								<ul class="msg-list" id="allListContainer">
									<li class="msg-box" >
							            <div class="msg-body">
							                <div class="msg-type"><i class="msg-avant apply-v"></i></div>
							                <div class="msg-content ">
							                    <div class="msg-head ">
							                        <div class="left">投递反馈</div>
							                        <div class="right">2018-01-30 15:16</div>
							                    </div>
							                    <dl class="info">
							                        <dt>
							                            <a class="company-logo" target="_blank" href="#">
							                                <img class="" src="images/pic0.jpg">
							                            </a>
							                        </dt>
							                        <dd class="msg-info">
							                            <h4>
							                                <a href="#" target="_blank" class="job-title">王者荣耀玩家</a>
							                                <em>·</em>
							                                <a href="#" target="_blank">LGD俱乐部</a>
							                            </h4>
							                            <div class="msg-status">
							                                <span>最新状态：</span>
							                                <a href="#" target="_blank">不合适</a>
							                            </div>
							                            <a class="to-detail" target="_blank" href="#">去看看</a>
							                        </dd>
							                    </dl>
							                </div>
							            </div>
							        </li>
							        <li class="msg-box" >
							            <div class="msg-body">
							                <div class="msg-type"><i class="msg-avant apply-v"></i></div>
							                <div class="msg-content ">
							                    <div class="msg-head ">
							                        <div class="left">投递反馈</div>
							                        <div class="right">2018-01-30 15:16</div>
							                    </div>
							                    <dl class="info">
							                        <dt>
							                            <a class="company-logo" target="_blank" href="#">
							                                <img class="" src="images/pic0.jpg">
							                            </a>
							                        </dt>
							                        <dd class="msg-info">
							                            <h4>
							                                <a href="#" target="_blank" class="job-title">王者荣耀玩家</a>
							                                <em>·</em>
							                                <a href="#" target="_blank">LGD俱乐部</a>
							                            </h4>
							                            <div class="msg-status">
							                                <span>最新状态：</span>
							                                <a href="#" target="_blank">不合适</a>
							                            </div>
							                            <a class="to-detail" target="_blank" href="#">去看看</a>
							                        </dd>
							                    </dl>
							                </div>
							            </div>
							        </li>
							        <li class="msg-box" >
							            <div class="msg-body">
							                <div class="msg-type"><i class="msg-avant apply-v"></i></div>
							                <div class="msg-content ">
							                    <div class="msg-head ">
							                        <div class="left">投递反馈</div>
							                        <div class="right">2018-01-30 15:16</div>
							                    </div>
							                    <dl class="info">
							                        <dt>
							                            <a class="company-logo" target="_blank" href="#">
							                                <img class="" src="images/pic0.jpg">
							                            </a>
							                        </dt>
							                        <dd class="msg-info">
							                            <h4>
							                                <a href="#" target="_blank" class="job-title">王者荣耀玩家</a>
							                                <em>·</em>
							                                <a href="#" target="_blank">LGD俱乐部</a>
							                            </h4>
							                            <div class="msg-status">
							                                <span>最新状态：</span>
							                                <a href="#" target="_blank">不合适</a>
							                            </div>
							                            <a class="to-detail" target="_blank" href="#">去看看</a>
							                        </dd>
							                    </dl>
							                </div>
							            </div>
							        </li>
								</ul>
							</div>
							<!--职位邀请-->
							<div class="t-content-item t-content-item_3" style="display: none;">
							    <ul class="msg-list" id="invitationListContainer">
								    <li class="no-msg">
								        <div class="no-msg-text">
								            <p class="lg_msg_avatar no_msg_i">暂时没有新的消息~</p>
								        </div>
								    </li>
							    </ul>
							    <div class="item_con_pager"></div>
							</div>
							<!--系统通知-->
							<div class="t-content-item t-content-item_4" style="display: block;">
							    <ul class="msg-list" id="invitationListContainer">
								    <li class="msg-box">
								        <div class="msg-body">
					                        <div class="msg-type"><i class="msg-avant system-v"></i></div>
					                        <div class="msg-content">
					                            <div class="msg-head">
					                                <div class="left">系统通知</div>
					                                <div class="right">2017-04-07 12:19</div>
					                            </div>
					                            <div class="info">
					                                <div class="pai-info">
					                                    
					                                                                 【电竞猎人邀请你】一拍专注中高端人才求职，无需主动投递简历，3500家名企虚位以待，1次申请，10个面试机会，2周敲定更好工作。
					                                    <a class="complete-link" href="#" target="_blank" >去试试</a>
					
					                                </div>
					                                <!-- <a class="to-detail" href="">去看看</a> -->
					                            </div>
					                        </div>
					                    </div>
								    </li>
								    
								    <li class="msg-box">
								        <div class="msg-body">
					                        <div class="msg-type"><i class="msg-avant system-v"></i></div>
					                        <div class="msg-content">
					                            <div class="msg-head">
					                                <div class="left">系统通知</div>
					                                <div class="right">2017-04-07 12:19</div>
					                            </div>
					                            <div class="info">
					                                <p class="system-info">
					                                        <a class="sys-link" href="#" target="_blank">
					                                                <span class="sys-title">成都国美大数据线下干货分享&amp;招聘狂欢趴~高薪职位等你来！</span>
					                                                <img src="images/Cgp.PNG" >
					                                        </a>
					                                        4月8日，相约在成都市高新区萃华路89号国际科技节能大厦17楼
					                                </p>
					                                    <a class="to-detail" href="#" target="_blank">查看详情</a>
					                            </div>
					                        </div>
					                    </div>
								    </li>
							    </ul>
							    <div class="item_con_pager"></div>
							</div>
						</div>
					</div>
					<div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>
				</div>
			</div>
			
		</div>
@endsection

@section('custom-script')
<script type="text/javascript">
        	$(document).ready(function(){
        		$(".item_1").click(function(){
        			$(".item_1").addClass("active")
        			$(".item_2").removeClass("active")
        			$(".item_3").removeClass("active")
        			$(".item_4").removeClass("active")
        			$(".t-content-item_1").show();
        			$(".t-content-item_2").hide();
        			$(".t-content-item_3").hide();
        			$(".t-content-item_4").hide();
        		})
        		$(".item_2").click(function(){
        			$(".item_1").removeClass("active")
        			$(".item_2").addClass("active")
        			$(".item_3").removeClass("active")
        			$(".item_4").removeClass("active")
        			$(".t-content-item_1").hide();
        			$(".t-content-item_2").show();
        			$(".t-content-item_3").hide();
        			$(".t-content-item_4").hide();
        		})
        		$(".item_3").click(function(){
        			$(".item_1").removeClass("active")
        			$(".item_2").removeClass("active")
        			$(".item_3").addClass("active")
        			$(".item_4").removeClass("active")
        			$(".t-content-item_1").hide();
        			$(".t-content-item_2").hide();
        			$(".t-content-item_3").show();
        			$(".t-content-item_4").hide();
        		})
        		$(".item_4").click(function(){
        			$(".item_1").removeClass("active")
        			$(".item_2").removeClass("active")
        			$(".item_3").removeClass("active")
        			$(".item_4").addClass("active")
        			$(".t-content-item_1").hide();
        			$(".t-content-item_2").hide();
        			$(".t-content-item_3").hide();
        			$(".t-content-item_4").show();
        		})
        	})
        </script>
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