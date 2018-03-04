@extends('layout.master')
@section('title', '公司详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/delivery.css?v=2.40')}}" type="text/css" rel="stylesheet">
<style>
     .jieshao_list li {
                width: 31.16%;
                height: 116px;
               
            }
            .my_delivery .d_item {
                text-align: left;
            }
            ul.my_delivery {
                overflow: auto;
            }
            .my_delivery li {
                width: 50%;
                float: left;
            }
        .item_ltitle span{
            font-size: 20px;
            float: left;
        }
        .look-resume-btn {
            float: right;
            padding: 4px 6px;
            margin-right: 16px;
            background-color: #03A9F4;
            color: #fff;
            border: none;
            border-radius: 3px;
        }
        .taoyige {
    width: 300px;
    display: inline-block;
    float: left;
    border: 1px solid #D32F2F;
    border-right: 0px;
}
.form_div {
    height: 36px;
    overflow: hidden;
    width: 508px;
}
.taoyige input[type='text'] {
    width: 480px;
    overflow: hidden;
    border: none;
    color: #5e5e5e;
    font-size: 16px;
    font-family: 'Microsoft YaHei';
    height: 100%;
    text-indent: 13px;
    float: left;
}
#publish-position {
    width: 104px;
    overflow: hidden;
    height: 38px;
    float: left;
    -webkit-border-top-right-radius: 4px;
    -moz-border-top-right-radius: 4px;
    border-top-right-radius: 4px;
    -moz-border-bottom-right-radius: 4px;
    -webkit-border-bottom-right-radius: 4px;
    border-bottom-right-radius: 4px;
    line-height: 38px;
    background: #D32F2F;
    border: none;
    color: #fff;
    font-size: 18px;
    font-family: 'Microsoft Yahei';
    cursor: pointer;
}
.item_ltitle{
    line-height: 41px;
    margin: 30px;
        overflow: hidden;
}
</style>
@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('content')
<div class="containter">
    <div class="interview_container item_container" id="interview_container">
        <div id="interview_anchor"></div>
        <div class="item_ltitle">
            <span >收到的申请记录</span>
            <div style="float: right;    margin-right: 32px;">   
<div class="taoyige">        
            <div class="left form_div">
                <input type="text" placeholder="请输入职位关键字" value="" id="name" name="name">
            </div>
        </div>
        <input type="button" value="搜索" name="" id="publish-position">
            </div>
        </div>
        
        <div class="reviews-empty">
            <form id="deliveryForm" class="deliveryAll" style="display: block;">
              <ul class="reset my_delivery">
                <li>
                  <div class="d_item clearfix">
                    <div class="d_job">
                      <a href="#" class="d_job_link" target="_blank">
                        <em class="d_job_name">贾军</em>
                        <span class="d_job_salary">（2k-4k）</span>
                        </a>
                        <button class="deliver-resume look-resume-btn">删除</button>
                        <button class="deliver-resume look-resume-btn">查看简历</button>
                    </div>
                    <div class="d_company">
                      <a href="#" target="_blank" title="舍得软件">舍得软件
                        <span>[成都]</span></a>
                    </div>
                    <div class="d_resume">使用简历：
                      <span class="d_resume_type">附件简历</span>
                      <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                        <span>已接收</span>
                      </a>
                      <span class="d_time">2017-12-28 14:54</span></div>
                  </div>
                  <div class="progress_status progress_status_one dn" style="display: none;">
                    <ul class="status_steps">
                      <li class="status_done status_1">1</li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>2</span></li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>3</span></li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>4</span></li>
                    </ul>
                    <ul class="status_text clearfix">
                      <li>已接收</li>
                      <li class="status_text_2">简历已查看</li>
                      <li class="status_text_3">待沟通</li>
                      <li class="status_text_4 status_text_6">面试</li></ul>
                    <ul class="status_list">
                      <li class="top1">
                        <div class="list_time">
                          <em></em>2017-12-28 14:54</div>
                        <div class="list_body">
                          <img src="images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                          <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">舍得软件人力资源部&nbsp;已成功接收某XX的简历</h3></div>
                      </li>
                    </ul>
                    <a href="javascript:;" class="btn_closeprogress up_btn"></a>
                  </div>
                </li>
                <li>
                  <div class="d_item clearfix">
                    <div class="d_job">
                      <a href="#" class="d_job_link" target="_blank">
                        <em class="d_job_name">贾军</em>
                        <!-- <span class="d_job_salary">（2k-4k）</span></a> -->
                        <button class="deliver-resume look-resume-btn">删除</button>
                        <button class="deliver-resume look-resume-btn">查看简历</button>
                    </div>
                    <div class="d_company">
                      <a href="#" target="_blank" title="舍得软件">舍得软件
                        <span>[成都]</span></a>
                    </div>
                    <div class="d_resume">使用简历：
                      <span class="d_resume_type">附件简历</span>
                      <a href="javascript:;" class="btn_showprogress">
                        <span>已接收</span>
                      </a>
                      <span class="d_time">2017-12-28 14:54</span></div>
                  </div>
                  <div class="progress_status dn" style="display: none;">
                    <ul class="status_steps">
                      <li class="status_done status_1">1</li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>2</span></li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>3</span></li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>4</span></li>
                    </ul>
                    <ul class="status_text clearfix">
                      <li>已接收</li>
                      <li class="status_text_2">简历已查看</li>
                      <li class="status_text_3">待沟通</li>
                      <li class="status_text_4 status_text_6">面试</li></ul>
                    <ul class="status_list">
                      <li class="top1">
                        <div class="list_time">
                          <em></em>2017-12-28 14:54</div>
                        <div class="list_body">
                          <img src="images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                          <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">舍得软件人力资源部&nbsp;已成功接收某XX的简历</h3></div>
                      </li>
                    </ul>
                    <a href="javascript:;" class="btn_closeprogress"></a>
                  </div>
                </li>
                <li>
                  <div class="d_item clearfix">
                    <div class="d_job">
                      <a href="#" class="d_job_link" target="_blank">
                        <em class="d_job_name">贾军</em>
                        <!-- <span class="d_job_salary">（2k-4k）</span></a> -->
                        <button class="deliver-resume look-resume-btn">删除</button>
                        <button class="deliver-resume look-resume-btn">查看简历</button>
                    </div>
                    <div class="d_company">
                      <a href="#" target="_blank" title="舍得软件">舍得软件
                        <span>[成都]</span></a>
                    </div>
                    <div class="d_resume">使用简历：
                      <span class="d_resume_type">附件简历</span>
                      <a href="javascript:;" class="btn_showprogress">
                        <span>已接收</span>
                      </a>
                      <span class="d_time">2017-12-28 14:54</span></div>
                  </div>
                  <div class="progress_status dn" style="display: none;">
                    <ul class="status_steps">
                      <li class="status_done status_1">1</li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>2</span></li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>3</span></li>
                      <li class="status_line status_line_grey">
                        <span></span>
                      </li>
                      <li class="status_grey">
                        <span>4</span></li>
                    </ul>
                    <ul class="status_text clearfix">
                      <li>已接收</li>
                      <li class="status_text_2">简历已查看</li>
                      <li class="status_text_3">待沟通</li>
                      <li class="status_text_4 status_text_6">面试</li></ul>
                    <ul class="status_list">
                      <li class="top1">
                        <div class="list_time">
                          <em></em>2017-12-28 14:54</div>
                        <div class="list_body">
                          <img src="images/pic00.png" style="border-radius:50%;" width="60" heigth="60">
                          <h3 class="contact_title" style="position:relative;z-index:2;display:inline-block;">舍得软件人力资源部&nbsp;已成功接收某XXS的简历</h3></div>
                      </li>
                    </ul>
                    <a href="javascript:;" class="btn_closeprogress"></a>
                  </div>
                </li>
              </ul>
              
            </form>
          
        </div>
       
    </div>
</div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    <script charset="utf-8" type="text/javascript" src="js/header.js?v=1.00"></script>
@endsection
