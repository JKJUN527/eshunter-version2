@extends('layout.master')
@section('title', '企业中心')
@section('custom-style')
    <link media="all" href="{{asset('../style/myhome.css')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('../style/delivery.css')}}" type="text/css" rel="stylesheet">
    <link media="all" rel="stylesheet" href="{{asset('../style/personal_account.css')}}" type="text/css">

    <style>
        .top_info {
            margin: 28px;
            padding-bottom: 28px;
            border-bottom: 1px solid #c1c1c1;
        }

        .logoPic {
            float: left;
        }

        .logoPic .pic {
            border: 1px #C1C1C1 solid;
        }

        .emp_info {
            float: left;
            margin-top: 5px;
            width: 800px;
        }

        .emp_info .detail {
            margin-left: 30px;
        }

        dl {
            margin: 0;
            padding: 0;
        }

        .emp_info .detail dl dt {
            font-size: 18px;
            color: #444;
        }

        .emp_info .detail dl dd {
            font-size: 15px;
            margin-top: 12px;
        }

        .emp_info .detail ul {
            margin-top: 8px;
        }

        .emp_info .detail ul li {
            float: left;
            height: 20px;
            margin-right: 20px;
            line-height: 20px;
            font-size: 13px;
        }

        .emp_info .detail ul li:last-child {
            float: right !important;
        }

        .detail ul li a {
            float: left;
            color: #B2B2B2;
            display: block;
            cursor: pointer;
        }

        .detail ul li a i {
            font-size: 16px;
            position: relative;
            top: 3px;
            margin-right: 8px;
        }

        li.edit_emp_info a {
            color: #00b38a !important;
        }
        .company_intro_text p{
            font-size: 15px;
            line-height: 2;
        }
        .jieshao_list li{
            height: 150px !important;
        }
        .verified, .verified i,.verified span {
            color: #4CAF50 !important;
        }

    </style>
@endsection
@section('content')
    <div class="containter">
        <div class="info_left info_panel" style="background: white;">
            <ul>
                <li class="active">
                    <a><i class="iconfont icon-home"></i><span>帐户中心</span></a>
                </li>
                <li class="">
                    <a href="/position/publishList">
                        <i class="iconfont icon-jianli"></i>
                        <span>职位管理</span>
                    </a>
                </li>
                <li class="">
                    <a href="/position/deliverList">
                        <i class="iconfont icon-jianli"></i>
                        <span>简历管理</span>
                    </a>
                </li>
                <li class="">
                    <a href="/message">
                        <i class="iconfont icon-jianli"></i>
                        <span>站内信({{$data['username']['messageNum']}})</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="info_right info_panel">
            <div class="top_info">
                <div class="logoPic">
                    <div class="pic">
                        <img src="{{$data['enterpriseInfo']->elogo}}" width="100" height="100">
                    </div>
                </div>

                <div class="emp_info">
                    <div class="detail">
                        <dl>
                            <dt>
                                <a href="http://{{str_replace(array('http://','https://'),'',$data['enterpriseInfo']->home_page)}}"
                                   class="hovertips" target="_blank" rel="nofollow">
                                    {{$data['enterpriseInfo']->ename}}
                                </a>
                            </dt>
                            <dd>电话&nbsp;
                                {{$data['enterpriseInfo']['etel'] or "未填写"}}
                            </dd>
                            <dd>邮箱&nbsp;
                                {{$data['enterpriseInfo']['email'] or "未填写"}}
                            </dd>
                        </dl>

                        <ul>
                            <li class="identification @if($data['enterpriseInfo']->is_verification === 1) verified @endif">
                                <a>
                                    <i class="material-icons">verified_user</i>
                                    @if($data['enterpriseInfo']->is_verification === 1)
                                        <span> &nbsp;已认证 </span>
                                    @elseif($data['enterpriseInfo']->is_verification === 0)
                                        <span> 待审核 </span>
                                    @else
                                        <span to="/account/enterpriseVerify/1">点击进行认证 </span>
                                    @endif
                                </a>
                            </li>

                            <li>
                                <a>
                                    <i></i>
                                    @if($data['enterpriseInfo']->industry == null)
                                        行业未知
                                    @else
                                        @foreach($data['industry'] as $item)
                                            @if($data['enterpriseInfo']->industry == $item->id)
                                                {{$item->name}}
                                            @endif
                                        @endforeach
                                    @endif
                                </a>
                            </li>

                            <li>
                                <a>
                                    <i></i>
                                    @if($data['enterpriseInfo']->enature == null || $data['enterpriseInfo']->enature == 0)
                                        企业类型未知
                                    @elseif($data['enterpriseInfo']->enature == 1)
                                        国有企业
                                    @elseif($data['enterpriseInfo']->enature == 2)
                                        民营企业
                                    @elseif($data['enterpriseInfo']->enature == 3)
                                        中外合资企业
                                    @elseif($data['enterpriseInfo']->enature == 4)
                                        外资企业
                                    @elseif($data['enterpriseInfo']->enature == 5)
                                        社会团体
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i></i>
                                    @if($data['enterpriseInfo']->escale == null)
                                        规模未知
                                    @elseif($data['enterpriseInfo']->escale == 0)
                                        10人以下
                                    @elseif($data['enterpriseInfo']->escale == 1)
                                        10～50人
                                    @elseif($data['enterpriseInfo']->escale == 2)
                                        50～100人
                                    @elseif($data['enterpriseInfo']->escale == 3)
                                        100～500人
                                    @elseif($data['enterpriseInfo']->escale == 4)
                                        500～1000人
                                    @elseif($data['enterpriseInfo']->escale == 5)
                                        1000人以上
                                    @endif
                                </a>
                            </li>

                            <li class="edit_emp_info">
                                <a href="/account/edit"><i class="material-icons">edit</i>编辑资料</a>
                            </li>
                        </ul>

                        <div style="clear:both;"></div>
                    </div>
                </div>

                <div style="clear:both;"></div>
            </div>

            <div id="main_container">
                <div id="containerCompanyDetails" class="companyIndex" style="display: block;">
                    <div class="item_container" id="company_products">
                        <div class="item_ltitle">发布的职位</div>

                        <span class="item_ropera item_add disabled add_btn_wrap" to="/position/publish"
                              style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_one">发布职位</span>
                                </span>

                        <div class="item_content item_content_one" style="display: block;">
                            <div class="item_empty">

                                <div class="The_job_con">
                                    <ul class="jieshao_list hotjobs" style="display: block;">
                                        @foreach($data['positionList'] as $position)
                                            <li>
                                                <div class="jieshao_list_left left">
                                                    <div class="list_top">
                                                        <div class="clearfix pli_top">
                                                            <div class="position_name left">
                                                                <h2 class="dib">
                                                                    <a href="/position/detail?pid={{$position->pid}}">
                                                                        {{mb_substr($position->title,0,5)}}
                                                                    </a>
                                                                </h2>
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
                                </div>
                                @if(count($data['positionList']) ==0)
                                    <p class="item_empty_desc">
                                        简洁有趣的职位介绍，能让求职者最快速度了解公司职位任务。把需要的职位展示出来吸引人才围观吧！
                                    </p>
                                    <p class="item_empty_add item_add disabled">
                                        <em class="item_ropeiconp"></em>
                                        <a href="/position/publish">
                                            <span class="item_ropetext add_product">新增职位发布</span>
                                        </a>
                                    </p>
                                @else
                                    <div class="more_box">
                                        <a href="/position/publishList" class="list_more">查看全部/修改</a>
                                    </div>
                                @endif

                            </div>
                        </div>

                    </div>
                    <div class="interview_container item_container" id="interview_container">
                        <div id="interview_anchor"></div>
                        <div class="item_ltitle">收到的申请记录</div>
                        <div class="reviews-empty">
                            <form id="deliveryForm" class="deliveryAll" style="display: block;">
                                <ul class="reset my_delivery">
                                    @foreach($data['applyList'] as $apply)
                                        <li to="/position/deliverDetail?did={{$apply->did}}">
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="/position/deliverDetail?did={{$apply->did}}"
                                                       class="d_job_link" target="_blank">
                                                        <em class="d_job_name">{{$apply->position_title}}</em>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <img src="{{$apply->photo}}" style="height: 50px;width: 50px;">
                                                    <a href="/position/deliverDetail?did={{$apply->did}}">{{$apply->pname}}</a>
                                                </div>
                                                <div class="d_resume">
                                                    <a href="javascript:;"
                                                       class="btn_showprogress delviery_success_btn">
                                                        <span>已接收</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">申请时间:{{$apply->created_at}}</span></div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                            </form>
                            @if(count($data['applyList']) ==0)
                                <span class="empty_icon"></span>
                                <span class="empty_text">最近没有收到过(未处理)申请记录</span>
                            @else
                                <div class="more_box">
                                    <a href="/position/deliverList" class="list_more">
                                        查看全部
                                    </a>
                                </div>
                            @endif

                        </div>

                    </div>
                    <div class="item_container" id="company_intro">
                        <div class="item_ltitle">公司介绍</div>
                        <div class="item_content item_content_two" style="display: block;">
                            <div class="company_intro_text" style="display: block;">
                                <p>
                                @if($data['enterpriseInfo']->ebrief == "" ||$data['enterpriseInfo']->ebrief == null)
                                    对公司详尽又生动的介绍，是吸引应聘者的最佳利器。
                                @else
                                    {!! $data['enterpriseInfo']->ebrief !!}
                                @endif
                                </p>
                            </div>

                        </div>

                        <div class="item_content_edit_wrap item_content_add_wrap" style="display: none;">
                            <div class="company_edit_tip">
                                对公司详尽又生动的图文介绍，是吸引应聘者的最佳利器。
                            </div>
                            <span class="item_ropera1 item_ropera_cancel item_ropera1_content" style="display: none;">

                                        <em class="item_ropeiconp item_ropeicons"></em>
                                        <span class="item_ropetext cancel_add_two">取消新增</span>
                                    </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="clear: both; margin-bottom: 20px;"></div>

    </div>
    <div id="cboxOverlay" style="opacity: 0.9; visibility: visible; display: block;"></div>
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