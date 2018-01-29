@extends('layout.master')
@section('title', '新闻详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/gsxx.css?v=2.40')}}" type="text/css" rel="stylesheet">
 <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">

@endsection

@section('header-nav')
   @include('components.headerNav')
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')

<div class="containter_box">
    <div style="margin-top: 0; padding-bottom: 0;" class="containter">
            <div class="crumbs">
                <a title="" href="company.html?techtag=8">移动互联网</a><strong>></strong>
                <span>公司信息</span>
            </div>
        <div class="gsxxi_top">
            <div style="margin-right:15px; margin-left:30px;" class="left">
                <div class="gs_logoimg">
                    <img class="left logo" alt="摩天轮" title="摩天轮" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/GO6VtZ1mlfTspfgS.png">
                </div>
            </div>
            <div class="left gsxxi_con">                
                <div class="jbxx">
                    <div class="dianzan">
                        <span>已有0人认为该公司值得加入</span>
                        <i class="praise "></i>
                    </div>
                    <div style=" width:100%; overflow: hidden;">
                        <h2>摩天轮</h2>
                        <h3>广州市摩天轮网络科技有限公司</h3>
                    </div>                  
                </div>
                <div style="margin:25px 0 5px;  width:100%; overflow:hidden;">
                    <div class="onetalk"></div>
                </div>
                <div class="welfare">
                     <label class="c1"><i>股票期权</i><em></em></label>
                     <label class="c2"><i>提升快</i><em></em></label>
                     <label class="c3"><i>年度游玩</i><em></em></label>
                     <label class="c4"><i>五险一金</i><em></em></label>
                     <label class="c1"><i>弹性工作</i><em></em></label>
                     <label class="c2"><i>节日礼物</i><em></em></label>
                     <label class="c3"><i>年终奖金</i><em></em></label>
                     <label class="c4"><i>年度分红</i><em></em></label>
                     <label class="c1"><i>带薪年假</i><em></em></label>
                     <label class="c2"><i>专项奖金</i><em></em></label>
                     <label class="c3"><i>美女多</i><em></em></label>
                     <label class="c4"><i>帅哥多</i><em></em></label>
               </div>
            </div>
        </div>
        <div class="gsxxi_part">     
            <div class="gsxxi left">
                <!--公司介绍-->
                <div class="company_presentation">
                    <p class="p_Label"><span>公司介绍</span></p>
                    <div class="company_presentation_con">
                      我们：<br><br>大家可能都用过QQ、微信、facebook,它们无一例外都是拥有庞大的用户量。几亿的用户里面有多少人跟我们存在联系？多少人认识我？多少人愿意帮助我？多少人我愿意帮助他？也许只有几十人甚至更少，那如此大的用户量跟我又有什么关系呢？ <br>很多普通人并不优秀但是他们还是非常乐观的消费着各种各样的东西，但是很多商品很多服务他们根本消费不起，于是他们选择了信用卡预支消费变成卡奴，背负着各种压力生活着。 <br><br>摩天轮-互筹社交：让每一个人帮助别人，让每一个人帮助你。 
                    </div>
                </div>
                <!-- 公司实拍 -->
            <!-- 公司实拍 end-->
                <div class="product_presentation">
                </div>              
                <div class="The_job">
                    <p class="p_Label"><span>在招职位</span><font>该公司近一个月共发布5个招聘职位</font></p>
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
                
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="../images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="#">EDG俱乐部</a>
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
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="../images/pic00.png" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="#">斗鱼俱乐部</a>
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
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="../images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="#">蓝洞游戏公司</a>
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
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="../images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="#">蓝洞游戏公司</a>
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
                             <div class="pli_btm">
                                <a href="#" class="left">
                                    <img src="../images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="#">蓝洞游戏公司</a>
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
                </ul>
                    </div>
                </div>
            </div> 
            <!-- 公司信息 -->
            <div class="gs_part right">             
                <ul class="company_brief">
                    <p class="p_Label p_Label_pos"><span class="gray">公司信息</span></p> 
                    <li><span class="liwai">城市：</span><em>广州</em></li>
                   
                    <li><span class="liwai">领域：</span><em>移动互联网,社交</em></li>
                    <li><span class="liwai">规模：</span><em class="gsgm" id="gm">少于15人</em></li>
                    <li>
                        <span class="liwai">融资：</span><em>天使轮</em>
                    </li>
                </ul>
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
            <li class="item"><a class="bj" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1538590175&amp;site=qq&amp;menu=yes" target="_blank">求职<br>服务</a></li>
            <li class="item"><a class="wk" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3078167392&amp;site=qq&amp;menu=yes" target="_blank">招聘<br>服务</a></li>
            <li class="item"><a class="ts" href="http://wpa.qq.com/msgrd?v=3&amp;uin=6281927&amp;site=qq&amp;menu=yes" target="_blank">bug<br>反馈</a></li>      
            <li class="item"><a href="#"></a></li>
            <li class="item"><a href="#"></a></li>
            <li class="item"><a href="#"></a></li>
        </ul>
    </div>
<a style="display: none;" class="back_to_top" title="" href="#"></a>

<script type="text/javascript">
$(".wheel-button").wheelmenu({
    // alert(1);
    trigger: "hover",
    animation: "fly",
    angle: [0, 360]
});
</script>

    </div>
</div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    <script defer="defer" type="text/javascript">
var page = 1;
 var page2 = 1;
 var page3 = 1;

    function more(){
      var param = new Object();
      param.param1 = "16801";
      jQuery.ajax({   
                    type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url:'/ajax/moreport.do', 
                    data: JSON.stringify(param),   
                    success: function(data){
                       $(".baodao").html("");
                       $(".moreA").hide();
                       $.each(data.result.reports,function(index,report){
                          var str ='<li>'+
                                       ' <a rel="nofollow" target="_blank" href="' +report.report_url+ '" title="" class="bd">' +report.report_title+ '</a>'+
                                       '</li>';
                           $('.baodao').append(str);
                       });
                    }
      });
    
         
    }
//  点赞
    $(function(){
        $('.praise').live('click',function(){
            if($(this).hasClass('active')){
               return;
            }else{
               var param = new Object();
               param.param1 = "16801";
               jQuery.ajax({   
                    type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url:'/ajax/praise.do', 
                    data: JSON.stringify(param),   
                    success: function(data){
                       var praise = "0";
                       if(praise == null || praise == ""){
                          praise = 0;
                       }else{
                          praise = "0";
                       }
                       praise ++;
                       $('.dianzan span').text("已有" +praise+ "人认为该公司值得加入");
                       $('.praise').addClass('active');
                    }
                    
                });
            }
        })
    })
</script>
@endsection
