@extends('layout.master')
@section('title', '申请记录')

@section('custom-style')
    <link media="all" href="{{asset('../style/delivery.css')}}" type="text/css" rel="stylesheet">
    <style>
        .QQ_each{
            margin-left: 1260px;
        }
    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username'] ])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('content')
 <script>
                                        var techtag = "";
                                        var jieduan = "";
                                        var area = "";
                                        var xinkeywd = "";
                                        var currPage = parseInt("1");
                                        var totalPage = 0;
                                        $(function(){
                                        // 鼠标滑过边框变色
                                        $('.jieshao_list li').live('mouseover', function(){
                                        $(this).addClass('greenborder_li');
                                                $(this).siblings().removeClass('greenborder_li');
                                        });
                                                $('.jieshao_list li').live('mouseleave', function(){
                                        $(this).removeClass('greenborder_li');
                                        });
//                                                l
                                        });
        
        </script>
            
            <div id="container_content">
                <div class="content_c clearfix">
                    <div class="new_section left">
                        <dl class="c_delivery">
                            <dt>
                                <h1>
                                    <em></em>
                                    已投递简历状态
                                </h1>
                                <div class="select_input">
                                    <span>2个月内投递</span>
                                    <i></i>
                                </div>
                                <div class="select_options dn">
                                    <span>2个月前投递</span>
                                </div>
                                <a href="javascript:;" class="d_refresh">刷新</a>
                            </dt>
                            <dd>
                                <div class="delivery_tabs">
                                    <ul class="reset">
                                        <li class="current li_one">
                                            <a href="#" class="all_border tabs_all">全部</a>
                                        </li>
                                        <li class="li_two">
                                            <a href="#" class="tabs_delivery_success">投递成功</a>
                                        </li>
                                        <li class="li_three">
                                            <a href="#" class="tabs_look" >被查看</a>
                                        </li>
                                        <li class="li_four">
                                            <a href="#" class="tabs_say">待沟通</a>
                                        </li>
                                        <li class="li_five">
                                            <a href="#" class="tabs_review">邀请面试</a>
                                        </li>
                                        <li class="last li_six">
                                            <a href="#" class="tabs_nosuit">不合适</a>
                                        </li>
                                    </ul>
                                </div>
                                <form id="deliveryForm" class="deliveryAll" style="display: block;">
                                    <ul class="reset my_delivery">
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                                        <span>投递成功</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status progress_status_one dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>2</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                                                                   舍得软件人力资源部&nbsp;已成功接收你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress up_btn"></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress">
                                                        <span>投递成功</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>2</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                                                                   舍得软件人力资源部&nbsp;已成功接收你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress"></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress">
                                                        <span>投递成功</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>2</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                                                                   舍得软件人力资源部&nbsp;已成功接收你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress"></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>

                                </form>
                                
                                <form id="deliveryForm" class="deliverySuccess" style="display: none;">
                                    <ul class="reset my_delivery">
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                                        <span>投递成功</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status progress_status_one dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>2</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                                                                   舍得软件人力资源部&nbsp;已成功接收你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress up_btn"></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress">
                                                        <span>投递成功</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>2</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                                                                   舍得软件人力资源部&nbsp;已成功接收你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress"></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress">
                                                        <span>投递成功</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>2</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                                                                   舍得软件人力资源部&nbsp;已成功接收你的简历
                                                            </h3>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress"></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>

                                </form>
                                
                                <form id="deliveryForm" class="deliveryLook" style="display: none;">
                                    <ul class="reset my_delivery">
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                                        <span>被查看</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status progress_status_one dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>2</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">
                                                                kiven&nbsp;查看了你的简历                                 
                                                            </h3>
                                                        </div>
                                                    </li>
                                                    <li class="bottom">
                                                        <div class="list_time">
                                                            <em></em>2017-12-28 12:01
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                kiven&nbsp;已成功接收你的简历
                                                            </h3>
                                                                                                                                                                                                                                                    
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress up_btn"></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>

                                </form>
                                <form id="deliveryForm" class="deliverySay" style="display: none;">
                                    <ul class="reset my_delivery">
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                                        <span>待沟通</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status progress_status_one dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>2</span></li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>3</span></li>
                                                    <li class="status_line status_line_grey"><span></span></li>
                                                    <li class="status_grey"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2;">
                                                                你的简历已经通过初筛，企业可能会在近期与你沟通，请保持联系方式畅通                             
                                                            </h3>
                                                            <div class="check_content" style="margin-top:-10px;margin-left:1px">
                                                                <div>联系人：<span>kitty.fan</span></div>
                                                                <div>联系邮箱：<span>kitty.fan@kboxsoft.com</span></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_time">
                                                            <em></em>2017-12-18 16:00
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                                                                     查看了你的简历
                                                            </h3>
                                                                                                                                                                                                                                                    
                                                        </div>
                                                    </li>
                                                    <li class="bottom">
                                                        <div class="list_time">
                                                            <em></em>2017-12-28 12:01
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                    已成功接收你的简历
                                                            </h3>
                                                                                                                                                                                                                                                    
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress up_btn"></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>

                                </form>
                                <form id="deliveryForm" class="deliveryReview" style="display: none;">
                                    <ul class="reset my_delivery">
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                    <a href="#" class="go-review">评价面试体验</a>
                                                    <a class="confirm-receive">确认收到offer</a>
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                                        <span>邀请面试</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status progress_status_one dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>2</span></li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>3</span></li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">面试</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <img src="../images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                                                            <h3 class="contact_title" style="position:relative;z-index:2; display: inline-block;">
                                                                黄XX&nbsp;给你发来面试邀请                            
                                                            </h3>
                                                            <div class="check_content" style="margin-top:-29px;margin-left:74px">
                                                                <div>面试时间：<span>2017-12-27 13:00</span></div>
                                                                <div>联系人：<span>黄XX</span></div>
                                                                <div>联系电话：<span>028-86xxx178</span></div>
                                                                <div>面试地点：<span>电话面试</span></div>
                                                                <div>补充内容：<span>我们将于12月27日13:00通过1500009994这个手机号联系您。面试大约会持续15至30分钟，面试主要是以您和我们的互相自我介绍为主，也会包含少量的技术相关问题。面试过程中，您无需准备电脑或者其它计算设备。LGD期待您的加入。</span></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_time">
                                                            <em></em>2017-12-26 16:25
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                                                                   你的简历已经通过初筛，企业可能会在近期与你沟通，请保持联系方式畅通
                                                                <a href="javascript:;" class="checkCommunication" data-id="945571287806914560" style="font-size:12px;"></a>
                                                            </h3>
                                                            <div>联系人：<span>黄XX</span></div>
                                                            <div>联系邮箱：<span>qq@qq.com.cn</span></div>
                                                       </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_time">
                                                            <em></em>2017-12-18 16:00
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                                                                     黄XX查看了你的简历
                                                            </h3>
                                                                                                                                                                                                                                                    
                                                        </div>
                                                    </li>
                                                    <li class="bottom">
                                                        <div class="list_time">
                                                            <em></em>2017-12-28 12:01
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                    黄XX已成功接收你的简历
                                                            </h3>
                                                                                                                                                                                                                                                    
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress up_btn"></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>

                                </form>
                                <form id="deliveryForm" class="deliveryNoSuit" style="display: none;">
                                    <ul class="reset my_delivery">
                                        <li>
                                            <div class="d_item clearfix">
                                                <div class="d_job">
                                                    <a href="#" class="d_job_link" target="_blank">
                                                        <em class="d_job_name">英雄联盟职业玩家（实...</em>
                                                        <span class="d_job_salary">（2k-4k）</span>
                                                    </a>
                                                    
                                                </div>
                                                <div class="d_company">
                                                    <a href="#" target="_blank" title="舍得软件">舍得软件 <span>[成都]</span></a>
                                                </div>
                                                <div class="d_resume">
                                                    使用简历：
                                                    <span class="d_resume_type">
                                                        附件简历
                                                    </span>
                                                    <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                                        <span>不合适</span>
                                                        <i class="transform"></i>
                                                    </a>
                                                    <span class="d_time">2017-12-28 14:54</span>
                                                </div>
                                            </div>
                                            <div class="progress_status progress_status_one dn" style="display: none;">
                                                <ul class="status_steps">
                                                    <li class="status_done status_1">1</li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>2</span></li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>3</span></li>
                                                    <li class="status_line status_line_done"><span></span></li>
                                                    <li class="status_done"><span>4</span></li>
                                                </ul>
                                                <ul class="status_text clearfix">
                                                    <li>投递成功</li>
                                                    <li class="status_text_2">简历被查看</li>
                                                    <li class="status_text_3">待沟通</li>
                                                    <li class="status_text_4 status_text_6">不合适</li>
                                                </ul>
                                                <ul class="status_list">
                                                    <li class="top1">
                                                        <div class="list_time">
                                                            <em></em>
                                                            2017-12-28 14:54
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title" style="position:relative;z-index:2; display: inline-block;">
                                                                简历被标记为不合适                            
                                                            </h3>
                                                            <div>
                                                                非常荣幸收到您的简历，经过我们评估，认为您与该职位不太合适，无法进入面试阶段。建议参考STAR法则对简历进行修改，并突出您在专业知识方面的优势。相信更好的机会一定还在翘首期盼着您，赶快调整心态，做好充足的准备重新出发吧！
                                                            </div>
                                                       </div>
                                                    </li>
                                                    
                                                    <li>
                                                        <div class="list_time">
                                                            <em></em>2017-12-18 16:00
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                                                                    查看了你的简历
                                                            </h3>
                                                                                                                                                                                                                                                    
                                                        </div>
                                                    </li>
                                                    <li class="bottom">
                                                        <div class="list_time">
                                                            <em></em>2017-12-28 12:01
                                                        </div>
                                                        <div class="list_body">
                                                            <h3 class="contact_title">
                                                                                                                   已成功接收你的简历
                                                            </h3>
                                                                                                                                                                                                                                                    
                                                        </div>
                                                    </li>
                                                </ul>
                                                <a href="javascript:;" class="btn_closeprogress up_btn"></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>

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
                                        <em class="count1">2</em>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" >
                                        邀请函
                                        <i class="yq"></i>
                                    </a>
                                </li>
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
                                        <li class="guess_like_list_item  clearfix">
                                            <a class="position_link clearfix" href="#" target="_blank">
                                                <div class="guess_like_list_item_logo">
                                                    <img src="../images/pic11.png"  width="56" height="56">
                                                </div>
                                                <div class="guess_like_list_item_pos">
                                                    <h2 title="产品专员" >产品专员</h2>
                                                    <p>5k-9k</p>
                                                    <p class="company_name">
                                                        <span class="company_name_span">卡莱博尔</span>
                                                        <span class="company_position_span" >[成都·中和]</span>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="guess_like_list_item  clearfix">
                                            <a class="position_link clearfix" href="#" target="_blank">
                                                <div class="guess_like_list_item_logo">
                                                    <img src="../images/pic11.png"  width="56" height="56">
                                                </div>
                                                <div class="guess_like_list_item_pos">
                                                    <h2 title="产品专员" >产品专员</h2>
                                                    <p>5k-9k</p>
                                                    <p class="company_name">
                                                        <span class="company_name_span">卡莱博尔</span>
                                                        <span class="company_position_span" >[成都·中和]</span>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="guess_like_list_item  clearfix">
                                            <a class="position_link clearfix" href="#" target="_blank">
                                                <div class="guess_like_list_item_logo">
                                                    <img src="../images/pic11.png"  width="56" height="56">
                                                </div>
                                                <div class="guess_like_list_item_pos">
                                                    <h2 title="产品专员" >产品专员</h2>
                                                    <p>5k-9k</p>
                                                    <p class="company_name">
                                                        <span class="company_name_span">卡莱博尔</span>
                                                        <span class="company_position_span" >[成都·中和]</span>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <a href="#" class="similar_position_footer" target="_blank" >更多猜你喜欢职位</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <script src="{{asset('../js/jquery.wheelmenu.js')}}" type="text/javascript"></script>
        <div class="QQ_each">
                <a class="wheel-button float_qq" href="#wheel" style="opacity: 1;"></a>
                <ul class="wheel" id="wheel">
                    <li class="item"><a href="#"></a></li>
                    <li class="item"><a href="#"></a></li>
                    <li class="item"><a href="#"></a></li>
                    <li class="item"><a href="#"></a></li>
                    <!--<li class="item"><a target="_blank" href="#" class='sss'>沙僧</a></li>-->
                    <li class="item"><a class="bj" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1538590175&amp;site=qq&amp;menu=yes" target="_blank">求职<br>服务</a></li>
                    <li class="item"><a class="wk" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3078167392&amp;site=qq&amp;menu=yes" target="_blank">招聘<br>服务</a></li>
                    <li class="item"><a class="ts" href="http://wpa.qq.com/msgrd?v=3&amp;uin=6281927&amp;site=qq&amp;menu=yes" target="_blank">bug<br>反馈</a></li>      
                    <li class="item"><a href="#"></a></li>
                    <li class="item"><a href="#"></a></li>
                    <li class="item"><a href="#"></a></li>
                </ul>
            </div>
        <a style="display: none;" class="back_to_top" title="" href="#"></a>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
<script type="text/javascript">
        $(".wheel-button").wheelmenu({
            // alert(1);
            trigger: "hover",
            animation: "fly",
            angle: [0, 360]
        });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".select_input").click(function(){
                    $(".select_options").toggle()
                })
                $(".delviery_success_btn").click(function(){
                    $(".progress_status_one").toggle()
                })
                $(".up_btn").click(function(){
                    $(".progress_status_one").hide()
                });
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
                })
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
                })
            });
            
        </script>
@endsection
