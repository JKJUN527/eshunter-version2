@extends('layout.master')
@section('title', '职位详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/zhiwei.css')}}" type="text/css" rel="stylesheet">
 <link media="all" href="{{asset('../style/modal.css')}}" type="text/css" rel="stylesheet">
 <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
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
     .content_r {
        width: 275px;
    }
    .job_company dt span {
     position: unset; 
    margin: 0px 0 0 21px;
    display: inline-block;
    }
    .job_company dt h2 {
        margin-bottom: 3px;
    }
    .job_company .c_feature a {
        word-break: break-all;
    }
    .similar_list_item_pos p {
        margin: 5px 0px 0 0px;
    }
    .similar_list_item_pos{
            border: 2px dashed #eee;
        padding: 15px;
    }
    .jobs_similar_header span.look-more{
            float: right;
    font-size: 12px;
    color: #D32F2F;
    cursor: pointer;
        padding: 8px;
    }
    .jobs_similar_header {
    border-bottom: 1px solid #eee;
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
                    <span>[{{$data['region']->name}}]</span>
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
                    @if($data['type']==0)
                        <a href="/account/login" rel="nofollow" class="send-CV-btn s-send-btn fr gray" style="display: block;">投个简历</a>
                    @else
                        @if($data['detail']->position_status == 3)
                            <a rel="nofollow"  class="send-CV-btn s-send-btn fr gray" style="display: block;">已下线</a>
                        @elseif($data['detail']->position_status ==1 ||$data['detail']->position_status == 4)
                            <a rel="nofollow" class="deliver-resume send-CV-btn s-send-btn fr"  data-toggle="modal" data-target="#chooseResumeModal">投个简历</a>
                        @else
                            <a rel="nofollow"  class="send-CV-btn s-send-btn fr gray" style="display: block;">无法投递</a>
                        @endif
                    @endif
                </div>
                <!--收藏按钮-->
                {{--<div class="jd_collection  job-collection " data-lg-tj-id="9500" data-lg-tj-no="0001" data-lg-tj-cid="idnull">--}}
                    {{--<i class="iconfont icon-star"> </i>收藏--}}
                {{--</div>--}}
            </div>

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
                <span style="color: #D32F2F;font-size: 14px;">{{$count}}</span>
                <span class="look-more">查看更多>></span>
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


<!-- 模态框（Modal） -->
<div class="modal fade" id="chooseResumeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    选择简历
                </h4>
            </div>
            <div class="modal-body">
                
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                <button type="button" class="btn btn-primary">
                    提交更改
                </button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

@endsection


@section('footer')
   @include('components.myfooter')
   @include('components.wheelmenu')
@endsection


@section('custom-script')
    <script type="text/javascript">
        $(".deliver-resume").click(function () {

            var $pid = $(this).attr("data-content");

            $.ajax({
                url: "/resume/getResumeList",
                type: "get",
                success: function (data) {

                    var html = "<ul class='resume-list'>";
                    if (data.length === 0) {
                        html = "<button onclick='addResume()' " +
                            "class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky'>" +
                            "没有简历，点击添加 </button>"
                    } else {
                        for (var item in data) {

                            var resumeName = data[item]['resume_name'] === null ? "未命名的简历" : data[item]['resume_name'];
                            html += "<li class='resume-item' data-content='" + data[item]['rid'] + "' onclick='resumeChosen(this, " + $pid + ")'>" +
                                "<p>" + resumeName + "</p>" +
                                "</li>";
                        }

                        html += "</ul>";
                    }

                    $(".modal-body").html(html);
                }
            })
        });

        function resumeChosen(element, pid) {
            $("#chooseResumeModal").modal('hide');

            var rid = $(element).attr("data-content");

            var formData = new FormData();
            formData.append('rid', rid);
            formData.append('pid', pid);

            $.ajax({
                url: "/delivered/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    console.log(result);

                    checkResult(result.status, "简历投递成功", result.msg, null);
                }
            })

        }

        function addResume() {
            $.ajax({
                url: "/resume/addResume",
                type: "get",
                success: function (data) {
                    if (data['status'] === 200) {
                        self.location = "/resume/add?rid=" + data['rid'];
                    } else if (data['status'] === 400) {
                        checkResult(data['status'], "", data['msg'], null);
                    }
                }
            });
        }

//        $(".position-view").click(function () {
//            self.location = '/position/detail?pid=' + $(this).attr("data-content");
//        });
            var look_more = $('#look_more')
            var company_text = look_more.prev().text()
            if (company_text.length<100) {
                look_more.hide()
            }else{
                look_more.prev().text(company_text.substr(0,99)+"...") 
                look_more.on('click', function() {
                    if (look_more.prev().text().length!=102) {
                        look_more.prev().text(company_text.substr(0,99)+"...") 
                        look_more.text("查看更多>>")
                    }else{
                     look_more.prev().text(company_text)
                     look_more.text("点击收起")
                    }
                });
            }
    </script>
@endsection
