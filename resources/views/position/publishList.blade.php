@extends('layout.master')
@section('title', '已发布的职位')

@section('custom-style')
 <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
<style>
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
     .jieshao_list li {
    width: 31.16%;
    height: 116px;
}
.item_ltitle span{
            font-size: 20px;
            float: left;
        }
        .item_ltitle{
    line-height: 41px;
    margin: 30px;
}   
.item_container{
    width: 90%;
    margin: 0 auto;
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
                <input type="text" placeholder="输入职位名称／描述进行搜索" value="" id="name" name="name">
            </div>
        </div>
        <input type="button" value="搜索" name="" id="publish-position">
            </div>
        </div>
        
        <div class="item_container" id="company_products">
                                
                                
                                <div class="item_content item_content_one"  style="display: block;">
                                    <div class="item_empty">
                                        
                                        <div class="The_job_con">
                                            <ul class="jieshao_list hotjobs" style="display: block;">
                                                <li>
                                                    <div class="jieshao_list_left left">
                                                        <div class="list_top">
                                                            <div class="clearfix pli_top">
                                                                <div class="position_name left">
                                                                    <h2 class="dib"><a href="#">王者荣耀职业玩家</a></h2>
                                                                    <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                                                </div>
                                                                <span class="salary right">10K-20k</span>
                                                            </div>
                                                            <div class="position_main_info">
                                                                <span>无经验</span>
                                                                <span>不限</span>
                                                            </div>
                                                            <div class="lebel">
                                                                <div class="lebel_item">
                                                                    <span class="wordCut">包吃住</span>
                                                                    <span class="wordCut">陪玩</span>
                                                                    <span class="wordCut">代打</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="jieshao_list_left left">
                                                        <div class="list_top">
                                                            <div class="clearfix pli_top">
                                                                <div class="position_name left">
                                                                    <h2 class="dib"><a href="#">NB2K职业玩家</a></h2>
                                                                    <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                                                </div>
                                                                <span class="salary right">5K-7k</span>
                                                            </div>
                                                            <div class="position_main_info">
                                                                <span>经验1年左右</span>
                                                                <span>高中</span>
                                                            </div>
                                                            <div class="lebel">
                                                                <div class="lebel_item">
                                                                    <span class="wordCut">包吃住</span>
                                                                    <span class="wordCut">陪玩</span>
                                                                    <span class="wordCut">代打</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="jieshao_list_left left">
                                                        <div class="list_top">
                                                            <div class="clearfix pli_top">
                                                                <div class="position_name left">
                                                                    <h2 class="dib"><a href="#">刀塔2职业玩家</a></h2>
                                                                    <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                                                </div>
                                                                <span class="salary right">10K-15k</span>
                                                            </div>
                                                            <div class="position_main_info">
                                                                <span>经验3-5年</span>
                                                                <span>本科</span>
                                                            </div>
                                                            <div class="lebel">
                                                                <div class="lebel_item">
                                                                    <span class="wordCut">包吃住</span>
                                                                    <span class="wordCut">陪玩</span>
                                                                    <span class="wordCut">代打</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="jieshao_list_left left">
                                                        <div class="list_top">
                                                            <div class="clearfix pli_top">
                                                                <div class="position_name left">
                                                                    <h2 class="dib"><a href="#">刀塔2职业玩家</a></h2>
                                                                    <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                                                </div>
                                                                <span class="salary right">10K-15k</span>
                                                            </div>
                                                            <div class="position_main_info">
                                                                <span>经验3-5年</span>
                                                                <span>本科</span>
                                                            </div>
                                                            <div class="lebel">
                                                                <div class="lebel_item">
                                                                    <span class="wordCut">包吃住</span>
                                                                    <span class="wordCut">陪玩</span>
                                                                    <span class="wordCut">代打</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="jieshao_list_left left">
                                                        <div class="list_top">
                                                            <div class="clearfix pli_top">
                                                                <div class="position_name left">
                                                                    <h2 class="dib"><a href="#">刀塔2职业玩家</a></h2>
                                                                    <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                                                </div>
                                                                <span class="salary right">10K-15k</span>
                                                            </div>
                                                            <div class="position_main_info">
                                                                <span>经验3-5年</span>
                                                                <span>本科</span>
                                                            </div>
                                                            <div class="lebel">
                                                                <div class="lebel_item">
                                                                    <span class="wordCut">包吃住</span>
                                                                    <span class="wordCut">陪玩</span>
                                                                    <span class="wordCut">代打</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li> 
                                               
                                            </ul>
                                           
                                    </div>
                                </div>
                               
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
