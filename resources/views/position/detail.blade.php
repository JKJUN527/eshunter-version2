@extends('layout.master')
@section('title', '职位详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/zhiwei.css')}}" type="text/css" rel="stylesheet">
 <style>
    #layout {
        clear: both;
        min-height: auto;
        height: auto !important;
        height: 100%;
        margin-bottom: 0px;
    }
    .advantage,.descrition{
        font-weight: bold;
        font-size: 18px;
    }
    .work_addr,.job_advantage p {
        margin: 1em 0;
        margin-left: 20px;
    }
    .job_bt p {
        margin-left: 20px;  
    }
     .dn{
         display: block;
     }
 </style>
@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 3,'type' => $data['type']])
@endsection

@section('content')
<div class="position-head" data-companyid="304142">
    <div class="position-content ">
        <div class="position-content-l">
            <div class="job-name" title="{{$data['detail']->title}}">
                <div class="company">{{$data['enprinfo'][0]->ename}}招聘</div>
                <span class="name">{{$data['detail']->title}}</span>
                <span class="outline_tag">
                    @if($data['detail']->position_status == 1)
                        该职位正在招聘中
                    @elseif($data['detail']->position_status == 2)
                        该职位已过有效期
                    @elseif($data['detail']->position_status == 3)
                        该职位已下架
                    @else
                        临时职位
                    @endif
                </span>
                <div class="marEdit"></div>
            </div>
            <dd class="job_request">
                <p>
                    <span class="salary">
                        @if($data['detail']->salary <= 0)
                            月薪面议
                        @else
                            {{$data['detail']->salary/1000}}k-
                            @if($data['detail']->salary_max ==0) 无上限
                            @else {{$data['detail']->salary_max/1000}}k
                            @endif
                            元/月
                        @endif
                    </span>
                    <span>/{{$data['region']->name}}/</span>
                </p>
                <!-- 职位标签 -->
                <ul class="position-label clearfix">
                    <li class="labels">
                        @if($data['detail']->max_age == -1 ||$data['detail']->max_age == 0)
                            无年龄要求
                        @else
                            {{$data['detail']->max_age}}岁以下
                        @endif
                    </li>
                    <li class="labels">
                        @if($data['detail']->education < 0)
                            无学历要求
                        @elseif($data['detail']->education == 0)
                            高中及以上
                        @elseif($data['detail']->education == 3)
                            专科及以上
                        @elseif($data['detail']->education == 1)
                            本科以上
                        @elseif($data['detail']->education == 2)
                            研究生及以上
                        @endif
                    </li>
                    <li class="labels">
                        @if($data['detail']->work_nature == 0)
                            兼职
                        @elseif($data['detail']->work_nature == 1)
                            实习
                        @elseif($data['detail']->work_nature == 2)
                            全职
                        @endif
                    </li>
                </ul>
                <p class="publish_time">{{substr($data['detail']->created_at,0,10)}}  发布于电竞猎人</p>
            </dd>
        </div>

        <div class="position-content-r clearfix">
            <div class="position-deal clearfix">
                <div class="resume-deliver">
                {{--<a rel="nofollow" href="javascript:;" class="btn fr btn_sended">已下线</a>--}}
                    @if($data['detail']->position_status == 3)
                        <a rel="nofollow" href="javascript:;" class="send-CV-btn s-send-btn fr gray" style="display: block;">已下线</a>
                    @else
                        <a rel="nofollow" class="send-CV-btn s-send-btn fr"  href="javascript:;" >投个简历</a>
                    @endif
                </div>
                <!--收藏按钮-->
                {{--<div class="jd_collection  job-collection " data-lg-tj-id="9500" data-lg-tj-no="0001" data-lg-tj-cid="idnull">--}}
                    {{--<i class="iconfont icon-star"> </i>收藏--}}
                {{--</div>--}}
            </div>

            <!-- 简历状态 -->            
            <ul class="resume-select clearfix">
                            <!-- 用户是否激活 0-否；1-是 -->
                <li class="resume resume-attachment">
                    <span class="select-radio  selected " data-type="0"></span>
                    <span>
                        <a href="#" title="下载XX简历.wps">
                            <i class="iconfont icon-paper-clip"></i>
                            xx简历.wps
                        </a>
                    </span>
                </li>
                <li class="resume no-resume-online">
                    <span>
                        <a href="#" target="_blank" title="完善在线简历" rel="nofollow">
                            <i class="iconfont icon-jianli"></i>
                            完善在线简历
                        </a>
                    </span>
                </li>
            </ul>

        </div>

    </div>
</div>

<div class="info_container clearfix">
    <div class="content_l left">

        <dl class="job_detail" id="job_detail">
            <dt class="clearfix join_tc_icon"></dt>
            <dd class="job_advantage">
                <span class="advantage">职位诱惑:</span>
                <p>{{$data['detail']->tag}}</p>
            </dd>
            <dd class="job_bt">
                <h3 class="descrition">岗位介绍:</h3>
                <div>
                    <p>{!! $data['detail']->pdescribe !!}</p>
                </div>
            </dd>
            <dd class="job_bt">
                <h3 class="descrition">职位要求:</h3>
                <div>
                    <p>
                        @if(empty($data['detail']->experience))
                            无经验要求
                        @else
                            {!! $data['detail']->experience !!}
                        @endif
                    </p>
                </div>
            </dd>
            <dd class="job_address clearfix">
                <h3 class="address">工作地址</h3>
                <div class="work_addr">
                    <a href="#" rel="nofollow">
                        @if($data['detail']->workplace =="-1" ||strlen($data['detail']->workplace)==0)
                            上班地址待定
                        @else
                            {{--{{str_replace(array('</br>','</br','</b>','</b'),"",$data['detail']->workplace)}}--}}
                            {!! $data['detail']->workplace!!}
                        @endif
                    </a>
                    {{--<a href="javascript:;" id="mapPreview" rel="nofollow">查看地图</a>--}}
                </div>
            </dd>
            <!--简历处理情况展示-->
            {{--<dd class="job_publisher">--}}
                {{--<h3>职位发布:</h3>--}}
                {{--<div class="border_c clearfix">--}}
                    {{--<img src="../images/pic0.jpg" width="60" height="60"/>--}}
                    {{--<div class="publisher_name">--}}
                        {{--<a title="LGD">--}}
                            {{--<span class="name">一lomo</span>--}}
                            {{--<span class="chat_me"></span>--}}
                        {{--</a>    --}}
                        {{--<span class="pos">HR</span>--}}
                    {{--</div>--}}
                    {{--<div class="publisher_data">--}}
                        {{--<div>--}}
                            {{--<span class="data_title">--}}
                                {{--聊天意愿--}}
                                {{--<i></i>--}}
                            {{--</span>--}}
                            {{--<span class="tip_text">1个月内职位发布者回复聊天的占比</span>--}}
                            {{--<span class="data">很弱</span>--}}
                            {{--<span class="tip_s">--}}
                                {{--回复率--}}
                                {{--<i>--</i>--}}
                                {{--&nbsp;用时--}}
                                {{--<i class="light_tip">13</i>分钟--}}
                            {{--</span>--}}
                        {{--</div>--}}
                        {{--<em></em>--}}
                        {{--<div>--}}
                            {{--<span class="data_title">--}}
                                {{--简历处理--}}
                                {{--<i></i>--}}
                            {{--</span>--}}
                            {{--<span class="tip_text">7日内职位发布者简历处理效率</span>--}}
                            {{--<span class="data">超快</span>--}}
                            {{--<span class="tip_s">--}}
                                {{--处理率--}}
                                {{--<i>--</i>--}}
                                {{--&nbsp;用时--}}
                                {{--<i class="light_tip">1</i>天--}}
                            {{--</span>--}}
                        {{--</div>--}}
                        {{--<em></em>--}}
                        {{--<div>--}}
                            {{--<span class="data_title">--}}
                                {{--活跃时段--}}
                                {{--<i></i>--}}
                            {{--</span>--}}
                            {{--<span class="tip_text">1个月内职位发布者最活跃时段统计</span>--}}
                            {{--<span class="data">下午</span>--}}
                            {{--<span class="tip_s">--}}
                                {{--<i class="light_tip">2</i>点最活跃--}}
                            {{--</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</dd>--}}

        </dl>

        {{--<dl class="interview_experience module-container">--}}
            {{--<div class="module-title" id="review_anchor">--}}
                {{--面试评价--}}
            {{--</div>--}}
            {{--<a href="" class="checkAll" style="display: none;">查看该公司全部面试评价</a>--}}
            {{--<div class="reviews-area">--}}
                {{--<div class="list-empty">--}}
                    {{--<i></i>--}}
                    {{--<span>该职位尚未收到面试评价</span>--}}
                    {{--<span class="list_empty_tips">--}}
                        {{--<a href="" target="_blank" class="list_empty_link">其他职位的面试评价</a>--}}
                    {{--</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</dl>--}}

    </div>
    <div class="content_r">
        <dl class="job_company" id="job_company">
            <dt>
                <a href="#" target="_blank">
                    @if($data['enprinfo'][0]->elogo == null)
                        <img  class="b2" src="../images/pic0.jpg" width="96" height="96"/>
                    @else
                        <img  class="b2" src="{{$data['enprinfo'][0]->elogo}}" width="96" height="96"/>
                    @endif
                    <div>
                        <h2 class="left">
                            <b>{{$data['enprinfo'][0]->ename or "公司名称未填写"}}</b>
                        </h2>
                        <h2 class="left">
                            {{$data['enprinfo'][0]->byname or "公司别名未填写"}}
                        </h2>
                        <span class="dn">电竞猎人已认证</span>
                    </div>
                </a>
            </dt>
            <dd>
                <ul class="c_feature">
                    <li>
                        <i class="iconfont icon-qita1"></i>
                        @foreach($data['industry'] as $item)
                            @if($data['enprinfo'][0]->industry == $item->id)
                                {{$item->name}}
                                @break
                            @endif
                        @endforeach
                        <span class="hovertips">领域</span>
                    </li>
                    <li>
                        <i class="iconfont icon-zhexiantu"></i>
                        @if($data['enprinfo'][0]->enature == null || $data['enprinfo'][0]->enature == 0)
                            企业类型未知
                        @elseif($data['enprinfo'][0]->enature == 1)
                            国有企业
                        @elseif($data['enprinfo'][0]->enature == 2)
                            民营企业
                        @elseif($data['enprinfo'][0]->enature == 3)
                            中外合资企业
                        @elseif($data['enprinfo'][0]->enature == 4)
                            外资企业
                        @elseif($data['enprinfo'][0]->enature == 5)
                            社会团体
                        @endif
                        <span class="hovertips">发展阶段</span>
                    </li>
                    <li>
                        <i class="iconfont icon-ren"></i>
                        @if($data['enprinfo'][0]->escale == null)
                            规模未知
                        @elseif($data['enprinfo'][0]->escale == 0)
                            10人以下
                        @elseif($data['enprinfo'][0]->escale == 1)
                            10～50人
                        @elseif($data['enprinfo'][0]->escale == 2)
                            50～100人
                        @elseif($data['enprinfo'][0]->escale == 3)
                            100～500人
                        @elseif($data['enprinfo'][0]->escale == 4)
                            500～1000人
                        @elseif($data['enprinfo'][0]->escale == 5)
                            1000人以上
                        @endif
                        <span class="hovertips">规模</span>
                    </li>
                    <li>
                        <i class="iconfont icon-zhuye"></i>
                        <a href="{{$data['enprinfo'][0]->home_page}}" target="_blank" rel="nofollow">
                            @if($data['enprinfo'][0]->home_page =="" ||$data['enprinfo'][0]->home_page ==null)
                                未填写公司主页
                            @else
                                {{$data['enprinfo'][0]->home_page}}
                            @endif
                        </a>
                        <span class="hovertips">公司主页</span>
                    </li>
                </ul>
            </dd>
        </dl>
        <div class="jobs_similar" id="jobs_similar">
            <?php
            $index = 0;
            $count = count($data['position']);
            ?>
            <h4 class="jobs_similar_header">
                <span>其他职位</span>
                <span>{{$count}}</span>
            </h4>
            @if($count >0)
            <div class="jobs_similar_content" id="jobs_similar_content" style="display: block;">
                <div class="jobs_similar_detail" id="jobs_similar_detail">
                    <ul class="similar_list reset">
                        @foreach($data['position'] as $position)
                            @if(++$index <= 4)
                            <li class="similar_list_item  clearfix">
                                <a href="/position/detail?pid={{$position->pid}}" class="position_link clearfix" target="_blank">
                                    {{--<div class="similar_list_item_logo">--}}
                                        {{--<img src="../images//pic0.jpg"/ width="56" height="56" style="display: block;">--}}
                                    {{--</div>--}}
                                    <div class="similar_list_item_pos">
                                        <h2 title="">
                                            @if(empty($position->title))
                                                没有填写职位名称
                                            @else
                                                {{mb_substr($position->title, 0, 15, 'utf-8')}}
                                            @endif
                                        </h2>
                                        <p>薪资：
                                            @if($position->salary <= 0)
                                                月薪面议
                                            @else
                                                {{$position->salary}}元/月
                                            @endif
                                        </p>
                                        <p class="similar_company_name">工作地区：
                                            {{$position->name}}
                                        </p>
                                    </div>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @else
            <div class="nodata_similar_list"></div>
            @endif
        </div>
    </div>
</div>
@endsection


@section('footer')
   @include('components.myfooter')
   @include('components.wheelmenu')
@endsection


@section('custom-script')
    
@endsection
