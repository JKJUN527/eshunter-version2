@extends('layout.master')
@section('title', '高级搜索')

@section('custom-style')
    <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
    <style>
        .jieshao {
     width: 100%; 
     float: unset; }
     .containter h3{
            font-size: 24px;
    padding: 10px 20px;
     }

.topnews { margin: 20px 0; }
.topnews h2 { font-size: 16px; font-weight: bold; line-height: 36px; color: #333; border-bottom: #db6d4c 4px solid; }
.topnews h2 b { }
.topnews h2 span { float: right; font-size: 12px; font-weight: normal; }
.topnews h2 span a { display: inline-block; padding: 0 5px; }
.topnews h2 span a:hover { color: #000 }
.blogs { padding: 30px 0; position: relative; border-bottom: #CCC 1px solid; overflow: hidden }
.blogs h3 { padding-left: 0;;font-size: 16px; font-weight: bold; transition: all .5s; margin-bottom: 10px }
.blogs h3 a { color: #474645; }
.blogs h3 a:hover { color: #066; text-decoration: underline }
.blogs figure { float: left; width: 25%; overflow: hidden; }
.blogs figure img { width: 100%; margin: auto; -moz-transition: all 0.5s; -webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s; }
.blogs figure:hover img { -moz-transform: scale(1.1); -webkit-transform: scale(1.1); -o-transform: scale(1.1); -ms-transform: scale(1.1); }
.blogs ul { float: right; line-height: 22px; width: 72%; color: #756F71; position: relative }
.autor { overflow: hidden; clear: both; margin: 10px 0; display: inline-block; color: #838383; width: 100%; position: absolute; top: 110px; }
.autor span { margin: 0 10px 0 0; }
.autor span a { color: #759b08; }
.autor span a:hover { text-decoration: underline }
.lm { background: url(../images/newsbg01.png) no-repeat left center }
.dtime { background: url(../images/newsbg02.png) no-repeat left center }
.viewnum { background: url(../images/newsbg04.png) no-repeat left center }
.pingl { background: url(../images/newsbg03.png) no-repeat left center }
.tit01 h3 { line-height: 40px; color: #38485A; font-size: 18px; border-bottom: 1px solid #E6E6E6; height: 40px; }
.search-news li:hover{
    box-shadow: none;
}
.search-news li {
    width: 80%;
    padding: 20px;
    height:auto;
    border:none;
    border-bottom: 1px solid #dcdcdc;
}
    </style>
@endsection
{{--@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection--}}
@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 10,'type' =>0])
@endsection

@section('content')
<div class="containter  ">
    <h3>搜索结果</h3>
  <div class="jieshao">
  <div class="taoyige">
    <div class="left form_div">
      <input type="text" placeholder="请输入关键词，如：运营策划" value="" name="" id="xinkeywd" style="height:100%"></div>
  </div>
  <input type="button" value="搜索" name="" id="chakan">
  <!-- 热门搜索 -->
  <div class="taoyige_hotsearch">热门搜索：
    <a href="company.html">电竞传媒</a>
    <a href="#">ADC</a>
    <a href="#">辅助</a>
    <a href="#">打野</a>
    <a href="#">中单</a></div>
  <!-- 热门搜索 end-->
  <!-- banner 轮播-->
  <div class="">
    <div class="jieshao_tb">
                    <span v="0" class="active">新闻资讯</span>
                    <span v="1">其他</span>          
                </div>  
                <ul class="jieshao_list hotjobs search-news" style="display: block;">
                    <li class="blogs">
                        <figure><img src="http://eshunter.com/storage/newspic/2017-10-17-05-44-30-59e598bea31e1news1.png"></figure>
                        <ul>
                          <h3><a href="/">离职后要不要删前同事好友？雷军在乌镇大会用行动给了教科书式回答</a></h3>
                          <p>凡是想要在事业上实现飞黄腾达的野心家，总想多结识点人脉。这已经成了职场中一条黄金般的真理。即使是身家亿万的老板，也不例外。每年的乌镇饭局，就是互联网大佬人脉流动的社交场。</p>
                          <p class="autor"><span class="lm f_l"><a href="/">author_ly</a></span><span class="dtime f_l"> 2017-10-17 05:44:30</span></p>
                        </ul>
                      </li><li class="blogs">
                        <figure><img src="http://eshunter.com/storage/newspic/2017-10-17-05-44-30-59e598bea31e1news1.png"></figure>
                        <ul>
                          <h3><a href="/">离职后要不要删前同事好友？雷军在乌镇大会用行动给了教科书式回答</a></h3>
                          <p>凡是想要在事业上实现飞黄腾达的野心家，总想多结识点人脉。这已经成了职场中一条黄金般的真理。即使是身家亿万的老板，也不例外。每年的乌镇饭局，就是互联网大佬人脉流动的社交场。</p>
                          <p class="autor"><span class="lm f_l"><a href="/">author_ly</a></span><span class="dtime f_l"> 2017-10-17 05:44:30</span></p>
                        </ul>
                      </li><li class="blogs">
                        <figure><img src="http://eshunter.com/storage/newspic/2017-10-17-05-44-30-59e598bea31e1news1.png"></figure>
                        <ul>
                          <h3><a href="/">离职后要不要删前同事好友？雷军在乌镇大会用行动给了教科书式回答</a></h3>
                          <p>凡是想要在事业上实现飞黄腾达的野心家，总想多结识点人脉。这已经成了职场中一条黄金般的真理。即使是身家亿万的老板，也不例外。每年的乌镇饭局，就是互联网大佬人脉流动的社交场。</p>
                          <p class="autor"><span class="lm f_l"><a href="/">author_ly</a></span><span class="dtime f_l"> 2017-10-17 05:44:30</span></p>
                        </ul>
                      </li>
                     
                </ul>
                 <ul class="jieshao_list jobs" style="display: none;">
                    <li>    
                        <div class="jieshao_list_left left">            
                             <div class="list_top">
                                <div class="clearfix pli_top">
                                    <div class="position_name left">
                                        <h2 class="dib"><a href="detail_job.html">英雄联盟职业玩家</a></h2>
                                        <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                    </div>
                                    <span class="salary right">5K-6k</span>
                                </div>
                                <div class="position_main_info">
                                    <span>经验1-3年</span>
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
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="images/pic00.png" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="detail_company.html" target="_blank">蓝洞游戏公司</a>
                                    </div>
                                    <div class="industry wordCut">
                                        <span>游戏服务</span>
                                        <span>上市</span>
                                        <span>美国</span>
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
                                        <h2 class="dib"><a href="detail_job.html">绝地求生职业玩家</a></h2>
                                        <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                    </div>
                                    <span class="salary right">15K-20k</span>
                                </div>
                                <div class="position_main_info">
                                    <span>无经验</span>
                                    <span>专科</span>
                                </div>
                                <div class="lebel">
                                    <div class="lebel_item">
                                        <span class="wordCut">包吃住</span>
                                        <span class="wordCut">陪玩</span>
                                        <span class="wordCut">代打</span>
                                    </div>
                                </div>
                             </div>
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="detail_company.html" target="_blank">EDG俱乐部</a>
                                    </div>
                                    <div class="industry wordCut">
                                        <span>游戏服务、游戏运营</span>
                                        <span>未融资</span>
                                        <span>成都-高新pli-btm</span>
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
                                        <h2 class="dib"><a href="detail_job.html">王者荣耀职业玩家</a></h2>
                                        <span class="create_time">&ensp;[2017-12-30]&ensp;</span>
                                    </div>
                                    <span class="salary right">5K-10k</span>
                                </div>
                                <div class="position_main_info">
                                    <span>经验1年以下</span>
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
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="images/pic00.png" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="detail_company.html" target="_blank">斗鱼俱乐部</a>
                                    </div>
                                    <div class="industry wordCut">
                                        <span>游戏直播</span>
                                        <span>A轮</span>
                                        <span>上海</span>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </li>
                </ul>
  </div>
  <!-- 轮播end --></div>
</div>
@endsection

@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
   <script>
    $('.jieshao_tb span').click(function() {
                    $(this).addClass('active');
                    $('.jieshao_list').eq($(this).index()).show();
                    $(this).siblings('span').removeClass('active');
                    $('.jieshao_list').eq($(this).index()).siblings('ul').hide();
                    var v = $(this).attr('v');
                })
   </script>
@endsection
