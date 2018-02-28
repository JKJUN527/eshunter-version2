@extends('layout.master')
@section('title', '申请记录')

@section('custom-style')
    <link media="all" href="{{asset('../style/delivery.css')}}" type="text/css" rel="stylesheet">
    <style>
        .QQ_each{
            margin-left: 1260px;
        }
        nav#page_tools ul li:hover,nav#page_tools ul li.active{
            background-color: #03A9F4;
            color: #fff!important;
        }
        nav#page_tools ul li:hover a{
            color: #fff!important;
        }
        nav#page_tools ul li a,nav#page_tools ul li span{
            display: inline-block;
            padding: 15px;
        }
        nav#page_tools ul li {
            display:inline-block;
            margin-bottom: 0px;
            cursor: pointer;
        }
        nav#page_tools{
            margin: 20px auto;
            text-align: center;
        }
        #page_tools li{
            padding: 0;
        }
        .transform{
            position: initial !important;
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
    <div id="container_content">
        <div class="content_c clearfix">
            <div class="new_section left">
                <dl class="c_delivery">
                    <dt>
                    <h1>
                        <em></em>
                        已投递简历状态
                    </h1>
                    {{--<div class="select_input">--}}
                        {{--<span>1周内投递</span>--}}
                        {{--<i></i>--}}
                    {{--</div>--}}
                    {{--<div class="select_options dn">--}}
                        {{--<span>2个月前投递</span>--}}
                    {{--</div>--}}
                    <a onclick="location.reload();" class="d_refresh">刷新</a>
                    </dt>
                    <dd>
                        <div class="delivery_tabs">
                            <ul class="reset">
                                <li class="current li_one">
                                    <a  class="all_border tabs_all">全部</a>
                                </li>
                                <li class="li_two">
                                    <a  class="tabs_delivery_success">投递成功</a>
                                </li>
                                <li class="li_three">
                                    <a  class="tabs_look" >被查看</a>
                                </li>
                                <li class="li_four">
                                    <a  class="tabs_say">已录用</a>
                                </li>
                                <li class="li_five">
                                    <a  class="tabs_review">未录用</a>
                                </li>
                                {{--<li class="last li_six">--}}
                                    {{--<a href="#" class="tabs_nosuit">失效</a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                        <form id="deliveryForm" class="deliveryAll" style="display: block;">
                            <ul class="reset my_delivery">
                                @foreach($data['applylist']['list'] as $apply)
                                    <li>
                                        <div class="d_item clearfix">
                                            <div class="d_job">
                                                <a href="/position/detail?pid={{$apply->pid}}" class="d_job_link" target="_blank">
                                                    <em class="d_job_name">{{mb_substr($apply->title,0,20,'utf-8')}}...</em>
                                                    <span class="d_job_salary">
                                                        @if($apply->salary == -1)
                                                            工资面议
                                                        @elseif($apply->salary_max == 0)
                                                            （{{$apply->salary/1000}}k-不限）
                                                        @else
                                                            （{{$apply->salary/1000}}k-{{$apply->salary_max/1000}}k）
                                                        @endif
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="d_company">
                                                <a href="#" target="_blank">{{$data['applylist']['ename'][$apply->eid]->ename}}</a>
                                            </div>
                                            <div class="d_resume">
                                                使用简历：
                                                <span class="d_resume_type">{{$apply->resume_name}}</span>
                                                <a class="btn_showprogress delviery_success_btn" onclick="show_progress({{$apply->pid}});">
                                                    <span>
                                                        @if($apply->status == 0)
                                                            投递成功
                                                        @elseif($apply->status == 1)
                                                            企业已查看
                                                        @elseif($apply->status == 2)
                                                            企业已录用
                                                        @elseif($apply->status == 3)
                                                            未录用
                                                        @elseif($apply->status == 4)
                                                            无效投递
                                                        @endif
                                                    </span>
                                                    <i class="transform"></i>
                                                </a>
                                                <span class="d_time">{{substr($apply->updated_at,0,10)}}</span>
                                            </div>
                                        </div>
                                        <div class="progress_status progress_status_one{{$apply->pid}} dn" style="display: none;">
                                            <ul class="status_steps">
                                                <li class="@if($apply->status >= 0) status_done @else status_grey @endif status_1">1</li>
                                                <li class="status_line @if($apply->status >=1) status_line_done @else status_line_grey @endif"><span></span></li>
                                                <li class="@if($apply->status >=1) status_done @else status_grey @endif"><span>2</span></li>
                                                <li class="status_line @if($apply->status >=2) status_line_done @else status_line_grey @endif"><span></span></li>
                                                <li class="@if($apply->status >=2) status_done @else status_grey @endif"><span>3</span></li>
                                            </ul>
                                            <ul class="status_text clearfix">
                                                <li>投递成功</li>
                                                <li class="status_text_2">简历被查看</li>
                                                @if($apply->status ==3)
                                                    <li class="status_text_3">不合适</li>
                                                @else
                                                    <li class="status_text_3">已录用</li>
                                                @endif
                                            </ul>
                                            <ul class="status_list">
                                                <li class="top1">
                                                    <div class="list_time">
                                                        <em></em>
                                                        {{$apply->updated_at}}
                                                    </div>
                                                    <div class="list_body">
                                                        <img src="{{$data['applylist']['ename'][$apply->eid]->elogo}}" style="border-radius:50%;" width="60" heigth="60">
                                                        <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                            {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部
                                                            @if($apply->status == 0)
                                                                已成功接收你的简历
                                                            @elseif($apply->status == 1)
                                                                已查看了你的简历，请耐心等待
                                                            @elseif($apply->status == 2)
                                                                你的简历已经通过初筛，企业可能会在近期与你沟通，请保持联系方式畅通
                                                            @elseif($apply->status == 3)
                                                                您的简历被标记为不合适
                                                            @endif
                                                        </h3>
                                                        @if($apply->status == 3)
                                                            <div>
                                                                {{$apply->fbinfo}}<br>
                                                                非常荣幸收到您的简历，经过我们评估，认为您与该职位不太合适，无法进入面试阶段。建议参考STAR法则对简历进行修改，并突出您在专业知识方面的优势。相信更好的机会一定还在翘首期盼着您，赶快调整心态，做好充足的准备重新出发吧！
                                                            </div>
                                                        @elseif($apply->status == 2)
                                                            <div>
                                                                {{$apply->fbinfo}}<br>
                                                                恭喜你！经过我们评估，认为您非常适合本职位，我们将尽快安排面试，请保持电话畅通！
                                                            </div>
                                                        @endif
                                                    </div>
                                                </li>
                                                @if($apply->status >0)
                                                    <li class="bottom">
                                                        <div class="list_time">
                                                            <em></em>{{$apply->created_at}}
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部 接收了你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                            <a class="btn_closeprogress up_btn" onclick="hide_progress({{$apply->pid}})"></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                                <nav id="page_tools">
                                    {!! $data['applylist']['list']->render() !!}
                                </nav>
                        </form>

                        <form id="deliveryForm" class="deliverySuccess" style="display: none;">
                            <ul class="reset my_delivery">
                                @foreach($data['applylist']['list'] as $apply)
                                    @if($apply->status == 0)
                                    <li>
                                        <div class="d_item clearfix">
                                            <div class="d_job">
                                                <a href="/position/detail?pid={{$apply->pid}}" class="d_job_link" target="_blank">
                                                    <em class="d_job_name">{{mb_substr($apply->title,0,20,'utf-8')}}...</em>
                                                    <span class="d_job_salary">
                                                        @if($apply->salary == -1)
                                                            工资面议
                                                        @elseif($apply->salary_max == 0)
                                                            （{{$apply->salary/1000}}k-不限）
                                                        @else
                                                            （{{$apply->salary/1000}}k-{{$apply->salary_max/1000}}k）
                                                        @endif
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="d_company">
                                                <a href="#" target="_blank">{{$data['applylist']['ename'][$apply->eid]->ename}}</a>
                                            </div>
                                            <div class="d_resume">
                                                使用简历：
                                                <span class="d_resume_type">{{$apply->resume_name}}</span>
                                                <a class="btn_showprogress delviery_success_btn" onclick="show_progress({{$apply->pid}});">
                                                    <span>
                                                        投递成功
                                                    </span>
                                                    <i class="transform"></i>
                                                </a>
                                                <span class="d_time">{{substr($apply->updated_at,0,10)}}</span>
                                            </div>
                                        </div>
                                        <div class="progress_status progress_status_one{{$apply->pid}} dn" style="display: none;">
                                            <ul class="status_steps">
                                                <li class="status_done status_1">1</li>
                                                <li class="status_line status_line_grey"><span></span></li>
                                                <li class="status_grey"><span>2</span></li>
                                                <li class="status_line status_line_grey"><span></span></li>
                                                <li class="status_grey"><span>3</span></li>
                                            </ul>
                                            <ul class="status_text clearfix">
                                                <li>投递成功</li>
                                                <li class="status_text_2">简历被查看</li>
                                                <li class="status_text_3">已录用</li>
                                            </ul>
                                            <ul class="status_list">
                                                <li class="top1">
                                                    <div class="list_time">
                                                        <em></em>
                                                        {{$apply->updated_at}}
                                                    </div>
                                                    <div class="list_body">
                                                        <img src="{{$data['applylist']['ename'][$apply->eid]->elogo}}" style="border-radius:50%;" width="60" heigth="60">
                                                        <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                            {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部
                                                                已成功接收你的简历
                                                        </h3>
                                                    </div>
                                                </li>
                                            </ul>
                                            <a class="btn_closeprogress up_btn" onclick="hide_progress({{$apply->pid}})"></a>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                            <nav id="page_tools">
                                {!! $data['applylist']['list']->render() !!}
                            </nav>
                        </form>

                        <form id="deliveryForm" class="deliveryLook" style="display: none;">
                            <ul class="reset my_delivery">
                                @foreach($data['applylist']['list'] as $apply)
                                    @if($apply->status == 1)
                                    <li>
                                        <div class="d_item clearfix">
                                            <div class="d_job">
                                                <a href="/position/detail?pid={{$apply->pid}}" class="d_job_link" target="_blank">
                                                    <em class="d_job_name">{{mb_substr($apply->title,0,20,'utf-8')}}...</em>
                                                    <span class="d_job_salary">
                                                        @if($apply->salary == -1)
                                                            工资面议
                                                        @elseif($apply->salary_max == 0)
                                                            （{{$apply->salary/1000}}k-不限）
                                                        @else
                                                            （{{$apply->salary/1000}}k-{{$apply->salary_max/1000}}k）
                                                        @endif
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="d_company">
                                                <a href="#" target="_blank">{{$data['applylist']['ename'][$apply->eid]->ename}}</a>
                                            </div>
                                            <div class="d_resume">
                                                使用简历：
                                                <span class="d_resume_type">{{$apply->resume_name}}</span>
                                                <a class="btn_showprogress delviery_success_btn" onclick="show_progress({{$apply->pid}});">
                                                    <span>
                                                        企业已查看
                                                    </span>
                                                    <i class="transform"></i>
                                                </a>
                                                <span class="d_time">{{substr($apply->updated_at,0,10)}}</span>
                                            </div>
                                        </div>
                                        <div class="progress_status progress_status_one{{$apply->pid}} dn" style="display: none;">
                                            <ul class="status_steps">
                                                <li class="status_done status_1">1</li>
                                                <li class="status_line status_line_done"><span></span></li>
                                                <li class="status_done"><span>2</span></li>
                                                <li class="status_line status_line_grey"><span></span></li>
                                                <li class="status_grey"><span>3</span></li>
                                            </ul>
                                            <ul class="status_text clearfix">
                                                <li>投递成功</li>
                                                <li class="status_text_2">简历被查看</li>
                                                <li class="status_text_3">已录用</li>
                                            </ul>
                                            <ul class="status_list">
                                                <li class="top1">
                                                    <div class="list_time">
                                                        <em></em>
                                                        {{$apply->updated_at}}
                                                    </div>
                                                    <div class="list_body">
                                                        <img src="{{$data['applylist']['ename'][$apply->eid]->elogo}}" style="border-radius:50%;" width="60" heigth="60">
                                                        <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                            {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部
                                                                已查看了你的简历，请耐心等待
                                                        </h3>
                                                    </div>
                                                </li>
                                                @if($apply->status >0)
                                                    <li class="bottom">
                                                        <div class="list_time">
                                                            <em></em>{{$apply->created_at}}
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部 接收了你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                            <a class="btn_closeprogress up_btn" onclick="hide_progress({{$apply->pid}})"></a>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </form>
                        <form id="deliveryForm" class="deliverySay" style="display: none;">
                            <ul class="reset my_delivery">
                                @foreach($data['applylist']['list'] as $apply)
                                    @if($apply->status == 2)
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="/position/detail?pid={{$apply->pid}}" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">{{mb_substr($apply->title,0,20,'utf-8')}}...</em>
                                                        <span class="d_job_salary">
                                                        @if($apply->salary == -1)
                                                                工资面议
                                                            @elseif($apply->salary_max == 0)
                                                                （{{$apply->salary/1000}}k-不限）
                                                            @else
                                                                （{{$apply->salary/1000}}k-{{$apply->salary_max/1000}}k）
                                                            @endif
                                                    </span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank">{{$data['applylist']['ename'][$apply->eid]->ename}}</a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">{{$apply->resume_name}}</span>
                                                    <a class="btn_showprogress delviery_success_btn" onclick="show_progress({{$apply->pid}});">
                                                    <span>
                                                        企业已录用
                                                    </span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">{{substr($apply->updated_at,0,10)}}</span>
                                                </div>
                                            </div>
                                            <div class="progress_status progress_status_one{{$apply->pid}} dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>2</span></li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>3</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">已录用</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            {{$apply->updated_at}}
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="{{$data['applylist']['ename'][$apply->eid]->elogo}}" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部:
                                                                你的简历已经通过初筛，企业可能会在近期与你沟通，请保持联系方式畅通
                                                            </h3>
                                                            <div>
                                                                {{$apply->fbinfo}}<br>
                                                                恭喜你！经过我们评估，认为您非常适合本职位，我们将尽快安排面试，请保持电话畅通！
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @if($apply->status >0)
                                                        <li class="bottom">
                                                            <div class="list_time">
                                                                <em></em>{{$apply->created_at}}
                                                            </div>
                                                            <div class="list_body">
                                                                <h3 class="contact_title">
                                                                    {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部 接收了你的简历
                                                                </h3>
                                                            </div>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <a class="btn_closeprogress up_btn" onclick="hide_progress({{$apply->pid}})"></a>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </form>
                        <form id="deliveryForm" class="deliveryReview" style="display: none;">
                            <ul class="reset my_delivery">
                                @foreach($data['applylist']['list'] as $apply)
                                    @if($apply->status == 3)
                                    <li>
                                        <div class="d_item clearfix">
                                            <div class="d_job">
                                                <a href="/position/detail?pid={{$apply->pid}}" class="d_job_link" target="_blank">
                                                    <em class="d_job_name">{{mb_substr($apply->title,0,20,'utf-8')}}...</em>
                                                    <span class="d_job_salary">
                                                        @if($apply->salary == -1)
                                                            工资面议
                                                        @elseif($apply->salary_max == 0)
                                                            （{{$apply->salary/1000}}k-不限）
                                                        @else
                                                            （{{$apply->salary/1000}}k-{{$apply->salary_max/1000}}k）
                                                        @endif
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="d_company">
                                                <a href="#" target="_blank">{{$data['applylist']['ename'][$apply->eid]->ename}}</a>
                                            </div>
                                            <div class="d_resume">
                                                使用简历：
                                                <span class="d_resume_type">{{$apply->resume_name}}</span>
                                                <a class="btn_showprogress delviery_success_btn" onclick="show_progress({{$apply->pid}});">
                                                    <span>
                                                        未录用
                                                    </span>
                                                    <i class="transform"></i>
                                                </a>
                                                <span class="d_time">{{substr($apply->updated_at,0,10)}}</span>
                                            </div>
                                        </div>
                                        <div class="progress_status progress_status_one{{$apply->pid}} dn" style="display: none;">
                                            <ul class="status_steps">
                                                <li class="status_done status_1">1</li>
                                                <li class="status_line status_line_done"><span></span></li>
                                                <li class="status_done"><span>2</span></li>
                                                <li class="status_line status_line_done"><span></span></li>
                                                <li class="status_done"><span>3</span></li>
                                            </ul>
                                            <ul class="status_text clearfix">
                                                <li>投递成功</li>
                                                <li class="status_text_2">简历被查看</li>
                                                <li class="status_text_3">不合适</li>
                                            </ul>
                                            <ul class="status_list">
                                                <li class="top1">
                                                    <div class="list_time">
                                                        <em></em>
                                                        {{$apply->updated_at}}
                                                    </div>
                                                    <div class="list_body">
                                                        <img src="{{$data['applylist']['ename'][$apply->eid]->elogo}}" style="border-radius:50%;" width="60" heigth="60">
                                                        <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                            {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部:
                                                                您的简历被标记为不合适
                                                        </h3>
                                                        <div>
                                                            {{$apply->fbinfo}}<br>
                                                            非常荣幸收到您的简历，经过我们评估，认为您与该职位不太合适，无法进入面试阶段。建议参考STAR法则对简历进行修改，并突出您在专业知识方面的优势。相信更好的机会一定还在翘首期盼着您，赶快调整心态，做好充足的准备重新出发吧！
                                                        </div>
                                                    </div>
                                                </li>
                                                @if($apply->status >0)
                                                    <li class="bottom">
                                                        <div class="list_time">
                                                            <em></em>{{$apply->created_at}}
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                {{$data['applylist']['ename'][$apply->eid]->ename}}人力资源部 接收了你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                            <a class="btn_closeprogress up_btn" onclick="hide_progress({{$apply->pid}})"></a>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </form>
                    </dd>
                </dl>
            </div>
            <div class="content_r">
                <div class="deliveries_nav_button">
                    <div class="mr_r_nav">
                        <ul class="clearfix">
                            <li>
                                <a href="#" >
                                    投递箱
                                    <i class="td"></i>
                                    <em class="count1">{{$data['username']['deliveredNum']}}</em>
                                </a>
                            </li>
                            {{--<li>--}}
                                {{--<a href="#" >--}}
                                    {{--邀请函--}}
                                    {{--<i class="yq"></i>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        </ul>
                    </div>
                </div>
                <div class="deliveries_recommend">
                    <div class="position_recommend">
                        <ul class="position_head">
                            <li class="guess_selected">猜你喜欢</li>
                        </ul>
                        <div class="similar_content" id="similar_content">
                            <div class="position_detail_content">
                                <ul class="guess_like reset">
                                    <?php
                                    $index = 0;
                                    ?>
                                    @foreach($data["recommendPosition"]["position"] as $position)
                                        @if(++$index < 9)
                                            <li class="guess_like_list_item  clearfix">
                                                <a class="position_link clearfix" href="/position/detail?pid={{$position->pid}}" target="_blank">
                                                    <div class="guess_like_list_item_logo">
                                                        <img src="{{$data['recommendPosition']['enprinfo'][$position->eid]->elogo}}"  width="56" height="56">
                                                    </div>
                                                    <div class="guess_like_list_item_pos">
                                                        <h2 title="{{$position->title}}" > {{mb_substr($position->title, 0, 10, 'utf-8')}}</h2>
                                                        <p>
                                                            @if($position->salary == -1)
                                                                工资面议
                                                            @elseif($position->salary_max == 0)
                                                                （{{$position->salary/1000}}k-不限）
                                                            @else
                                                                （{{$position->salary/1000}}k-{{$position->salary_max/1000}}k）
                                                            @endif
                                                        </p>
                                                        <p class="company_name">
                                                            <span class="company_name_span">
                                                                @if(empty($data['recommendPosition']['enprinfo'][$position->eid]->byname) && empty($data['recommendPosition']['enprinfo'][$position->eid]->ename))
                                                                    未命名企业
                                                                @elseif($data['recommendPosition']['enprinfo'][$position->eid]->byname)
                                                                    {{$data['recommendPosition']['enprinfo'][$position->eid]->byname}}
                                                                @else
                                                                    {{$data['recommendPosition']['enprinfo'][$position->eid]->ename}}
                                                                @endif
                                                            </span>
                                                            {{--<span class="company_position_span" >[成都·中和]</span>--}}
                                                        </p>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                <a href="/position/advanceSearch" class="similar_position_footer" target="_blank" >更多职位</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a style="display: none;" class="back_to_top" title="" href="#"></a>
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
            $(".deliveryLook").hide();
            $(".deliverySay").hide();
            $(".deliveryReview").hide();
            $(".deliveryNoSuit").hide();
            $(".li_one").addClass("current");
            $(".li_two").removeClass("current");
            $(".li_three").removeClass("current");
            $(".li_four").removeClass("current");
            $(".li_five").removeClass("current");
            $(".li_six").removeClass("current");

        });
        $(".tabs_delivery_success").click(function(){
            alert(123);
            $(".deliverySuccess").show();
            $(".deliveryAll").hide();
            $(".deliveryLook").hide();
            $(".deliverySay").hide();
            $(".deliveryReview").hide();
            $(".deliveryNoSuit").hide();
            $(".li_one").removeClass("current");
            $(".li_two").addClass("current");
            $(".li_three").removeClass("current");
            $(".li_four").removeClass("current");
            $(".li_five").removeClass("current");
            $(".li_six").removeClass("current");
        });
        $(".tabs_look").click(function(){
            $(".deliverySuccess").hide();
            $(".deliveryAll").hide();
            $(".deliveryLook").show();
            $(".deliverySay").hide();
            $(".deliveryReview").hide();
            $(".deliveryNoSuit").hide();
            $(".li_one").removeClass("current");
            $(".li_two").removeClass("current");
            $(".li_three").addClass("current");
            $(".li_four").removeClass("current");
            $(".li_five").removeClass("current");
            $(".li_six").removeClass("current");
        });
        $(".tabs_say").click(function(){
            $(".deliverySuccess").hide();
            $(".deliveryAll").hide();
            $(".deliveryLook").hide();
            $(".deliverySay").show();
            $(".deliveryReview").hide();
            $(".deliveryNoSuit").hide();
            $(".li_one").removeClass("current");
            $(".li_two").removeClass("current");
            $(".li_three").removeClass("current");
            $(".li_four").addClass("current");
            $(".li_five").removeClass("current");
            $(".li_six").removeClass("current");
        });
        $(".tabs_review").click(function(){
            $(".deliverySuccess").hide();
            $(".deliveryAll").hide();
            $(".deliveryLook").hide();
            $(".deliverySay").hide();
            $(".deliveryReview").show();
            $(".deliveryNoSuit").hide();
            $(".li_one").removeClass("current");
            $(".li_two").removeClass("current");
            $(".li_three").removeClass("current");
            $(".li_four").removeClass("current");
            $(".li_five").addClass("current");
            $(".li_six").removeClass("current");
        });
        $(".tabs_nosuit").click(function(){
            $(".deliverySuccess").hide();
            $(".deliveryAll").hide();
            $(".deliveryLook").hide();
            $(".deliverySay").hide();
            $(".deliveryReview").hide();
            $(".deliveryNoSuit").show();
            $(".li_one").removeClass("current");
            $(".li_two").removeClass("current");
            $(".li_three").removeClass("current");
            $(".li_four").removeClass("current");
            $(".li_five").removeClass("current");
            $(".li_six").addClass("current");
        });
    });
//        var techtag = "";
//        var jieduan = "";
//        var area = "";
//        var xinkeywd = "";
//        var currPage = parseInt("1");
//        var totalPage = 0;
//        $(function(){
//            // 鼠标滑过边框变色
//            $('.jieshao_list li').on('mouseover', function(){
//                $(this).addClass('greenborder_li');
//                $(this).siblings().removeClass('greenborder_li');
//            });
//            $('.jieshao_list li').on('mouseleave', function(){
//                $(this).removeClass('greenborder_li');
//            });             l
//        });
</script>
@endsection
