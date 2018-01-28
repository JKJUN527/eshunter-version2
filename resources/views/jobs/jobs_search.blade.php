@extends('layout.master')
@section('title', '电竞猎人|首页')

@section('custom-style')
   <link media="all" href="{{asset('../style/tao_company.css')}}" type="text/css" rel="stylesheet">
@endsection


@section('header-nav')
   @include('components.headerNav')
@endsection


@section('header-tab')
   @include('components.headerTab',['activeIndex' => 3,'type' => 0])
@endsection

@section('content')
	<link href="css/fenyestyle.css?v=2.33" type="text/css" rel="stylesheet">
            <div class="containter">
                <div style="width:100%; overflow:hidden;">
                    <div style="padding-bottom:0px; float:left;" class="jieshao">
                        <!-- 热门搜索 -->
                        <div class="taoyige">        
                            <div class="left form_div">
                                <input type="text" placeholder="请输入公司名" value="" name="" id="xinkeywd">
                            </div>
                        </div>
                        <input type="button" value="搜索" name="" id="chakan">
                        <!-- 热门搜索的链接没有写 -->
                        <div class="taoyige_hotsearch">热门搜索：<a href="javascript:void(0);">小米</a><a href="javascript:void(0);">同程旅游</a><a href="javascript:void(0);">知聊</a><a href="javascript:void(0);">状元理财</a></div>
                        <div class="searchPart">      
                            <!-- 公司搜索条件 -->
                            <div class="search_stander">
                                <div class="stander_list">
                                    <span>行业：</span>
                                     <div class="stander_div3">
	                                    <a rel="nofollow" href="javascript:;"  class="active">全部</a>
	                                    <a rel="nofollow" href="javascript:;"  >俱乐部</a>
	                                    <a rel="nofollow" href="javascript:;"  >赛事方</a>
	                                    <a rel="nofollow" href="javascript:;"  >电竞传媒</a>
	                                    <a rel="nofollow" href="javascript:;"  >游戏开发</a>
	                                    <a rel="nofollow" href="javascript:;"  >游戏运营</a>
	                                    <a rel="nofollow" href="javascript:;"  >电竞教育</a>
	                                    <a rel="nofollow" href="javascript:;"  >电竞门户</a>
	                                    <a rel="nofollow" href="javascript:;"  >电竞协会</a>
	                                    <a rel="nofollow" href="javascript:;"  >其他</a>
                                    </div>
                                </div>
                                <div class="stander_list">
                                    <span>省份：</span>
                                    <div class="stander_div3">
                                    	<a rel="nofollow" href="javascript:;"  class="active">全部</a>
	                                    <a rel="nofollow" href="javascript:;"  >北京</a>
	                                    <a rel="nofollow" href="javascript:;"  >上海</a>
	                                    <a rel="nofollow" href="javascript:;"  >重庆</a>
	                                    <a rel="nofollow" href="javascript:;"  >天津</a>
	                                    <a rel="nofollow" href="javascript:;"  >四川</a>
	                                    <a rel="nofollow" href="javascript:;"  >湖南</a>
	                                    <a rel="nofollow" href="javascript:;"  >湖北</a>
	                                    <a rel="nofollow" href="javascript:;"  >全部</a>
	                                    <a rel="nofollow" href="javascript:;"  >北京</a>
	                                    <a rel="nofollow" href="javascript:;"  >上海</a>
	                                    <a rel="nofollow" href="javascript:;"  >重庆</a>
	                                    <a rel="nofollow" href="javascript:;"  >天津</a>
	                                    <a rel="nofollow" href="javascript:;"  >四川</a>
	                                    <a rel="nofollow" href="javascript:;"  >湖南</a>
	                                    <a rel="nofollow" href="javascript:;"  >湖北</a>
	                                    <a rel="nofollow" href="javascript:;"  >全部</a>
	                                    <a rel="nofollow" href="javascript:;"  >北京</a>
	                                    <a rel="nofollow" href="javascript:;"  >上海</a>
	                                    <a rel="nofollow" href="javascript:;"  >重庆</a>
	                                    <a rel="nofollow" href="javascript:;"  >天津</a>
	                                    <a rel="nofollow" href="javascript:;"  >四川</a>
	                                    <a rel="nofollow" href="javascript:;"  >湖南</a>
	                                    <a rel="nofollow" href="javascript:;"  >湖北</a>
	                                </div>
                                </div>
                                <div class="stander_list">
                                    <span>薪酬：</span>
                                    <div class="stander_div3">
                                        <a rel="nofollow" href="javascript:;"  class="active">不限</a>
	                                    <a rel="nofollow" href="javascript:;"  >3k以下</a>
	                                    <a rel="nofollow" href="javascript:;"  >3k-5k</a>
	                                    <a rel="nofollow" href="javascript:;"  >5k-10k</a>
	                                    <a rel="nofollow" href="javascript:;"  >10k-15k</a>
	                                    <a rel="nofollow" href="javascript:;"  >15k-20k</a>
	                                    <a rel="nofollow" href="javascript:;"  >20k-25k</a>
	                                    <a rel="nofollow" href="javascript:;"  >25k-50k</a>
                                    </div>
                                </div>
                                <div class="stander_list">
                                    <span>类型：</span>
                                    <div class="stander_div3">
                                        <a rel="nofollow" href="javascript:;"  class="active">不限</a>
	                                    <a rel="nofollow" href="javascript:;"  >兼职</a>
	                                    <a rel="nofollow" href="javascript:;"  >实习</a>
	                                    <a rel="nofollow" href="javascript:;"  >全职</a>
                                        
                                    </div>
                                </div>
                            </div>      
                            <!-- 公司搜索条件 end-->
                        </div>
                        <div class="jieshao_list">
                            <!-- 职位改之后 -->
                            <ul class="jieshao_list companydiv"><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16904.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/DPerssKikYp9Ng6Q.png">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16904.html" target="_blank" class="zw_name">图房网</a>[北京]        </p>        <div class="brif">电子商务             <span>|</span>D轮以上             <span>|</span>50-100人        </div>        <div class="div_s">            <span>带薪年假</span>            <span>规范管理</span>            <span>领导好好</span>            <span>年度游玩</span>            <span>五险一金</span>         </div>        <div class="brif">         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16903.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/IocUvTdGeZ05awR9.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16903.html" target="_blank" class="zw_name">爱福窝</a>[上海]        </p>        <div class="brif">O2O,电子商务,云计算,大数据,社会化营销             <span>|</span>B轮             <span>|</span>50-100人        </div>        <div class="div_s">            <span>股票期权</span>            <span>五险一金</span>            <span>年终奖金</span>            <span>美女多</span>            <span>帅哥多</span>            <span>提升快</span>            <span>年度游玩</span>            <span>领导好好</span>            <span>节日礼物</span>            <span>餐补</span>            <span>扁平管理</span>            <span>绩效奖金</span>            <span>带薪年假</span>            <span>规范管理</span>            <span>年度分红</span>            <span>弹性工作</span>            <span>技能培训</span>         </div>        <div class="brif">         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16902.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/dvz7MrBel3mku8K0.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16902.html" target="_blank" class="zw_name">阿姨800</a>[北京]        </p>        <div class="brif">O2O,移动互联网             <span>|</span>A轮             <span>|</span>50-100人        </div>        <div class="div_s">            <span>五险一金</span>            <span>绩效奖金</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46895?ts=0">微信运营经理</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46894?ts=0">网络推广</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46893?ts=0">UI设计师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46892?ts=0">PHP</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16901.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/w5segpUpkSkAk43G.png">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16901.html" target="_blank" class="zw_name">挥杆伴侣</a>[北京]        </p>        <div class="brif">移动互联网,O2O,社交             <span>|</span>天使轮             <span>|</span>15-50人        </div>        <div class="div_s">            <span>股票期权</span>            <span>五险一金</span>            <span>绩效奖金</span>            <span>项目提成</span>            <span>早九晚六</span>            <span>领导好好</span>            <span>年终奖金</span>            <span>技能培训</span>            <span>帅哥多</span>            <span>美女多</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46886?ts=0">iOS</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46885?ts=0">PHP</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46883?ts=0">Java</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46882?ts=0">C++</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16900.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/G5YgYfmrHdgPilsk.png">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16900.html" target="_blank" class="zw_name">付尔代</a>[杭州]        </p>        <div class="brif">移动互联网,社交             <span>|</span>天使轮             <span>|</span>15-50人        </div>        <div class="div_s">            <span>五险一金</span>            <span>弹性工作</span>            <span>节日礼物</span>            <span>年终奖金</span>            <span>早九晚六</span>            <span>技能培训</span>            <span>美女多</span>            <span>帅哥多</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46879?ts=0">web前端</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16899.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/UubAmDey50Ur07mE.png">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16899.html" target="_blank" class="zw_name">国广星空</a>[北京]        </p>        <div class="brif">移动互联网,媒体,移动广告             <span>|</span>B轮             <span>|</span>50-100人        </div>        <div class="div_s">            <span>五险一金</span>            <span>早九晚六</span>            <span>定期休假</span>            <span>餐补</span>            <span>年度游玩</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46891?ts=0">新媒体运营</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46890?ts=0">UI设计师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46888?ts=0">销售总监</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46887?ts=0">互联网广告销售</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16897.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/gsLOGO.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16897.html" target="_blank" class="zw_name">众智兴达</a>[北京]        </p>        <div class="brif">硬件,云计算,大数据             <span>|</span>未融资             <span>|</span>少于15人        </div>        <div class="div_s">            <span>领导好好</span>            <span>早九晚六</span>            <span>扁平管理</span>            <span>提升快</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46878?ts=0">助理</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16896.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/TUobXiZtEgfbmau4.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16896.html" target="_blank" class="zw_name">铭仁教育</a>[北京]        </p>        <div class="brif">移动互联网,在线教育             <span>|</span>A轮             <span>|</span>15-50人        </div>        <div class="div_s">            <span>五险一金</span>            <span>节日礼物</span>            <span>早九晚六</span>            <span>绩效奖金</span>            <span>年度游玩</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46877?ts=0">图像识别工程师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46875?ts=0">Android/IOS开发工程师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46874?ts=0">Web前端开发工程师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46873?ts=0">Java开发工程师</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16895.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/ey7aB2r3ge5vMcoO.png">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16895.html" target="_blank" class="zw_name">无花果</a>[北京]        </p>        <div class="brif">移动互联网,互联网金融             <span>|</span>天使轮             <span>|</span>少于15人        </div>        <div class="div_s">            <span>提升快</span>            <span>年度游玩</span>            <span>扁平管理</span>            <span>餐补</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46869?ts=0">PHP</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46868?ts=0">网页设计师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46866?ts=0">web前端</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16894.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/krhxXuIGf6RUeIyM.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16894.html" target="_blank" class="zw_name">酷跑科技</a>[合肥]        </p>        <div class="brif">O2O,移动互联网,游戏,企业服务             <span>|</span>未融资             <span>|</span>50-100人        </div>        <div class="div_s">            <span>帅哥多</span>            <span>美女多</span>            <span>五险一金</span>            <span>规范管理</span>            <span>领导好好</span>            <span>节日礼物</span>            <span>餐补</span>            <span>话费补贴</span>            <span>绩效奖金</span>            <span>项目提成</span>            <span>管吃住</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46872?ts=0">总经理助理</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46871?ts=0">营销策划副总</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46870?ts=0">销售代表</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46851?ts=0">iOS工程师</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16893.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="http://f.neipin.com/photo/company/4Gcki8SQy5ZdTNSo.JPG">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16893.html" target="_blank" class="zw_name">全利汇丰</a>[北京]        </p>        <div class="brif">互联网金融             <span>|</span>未融资             <span>|</span>50-100人        </div>        <div class="div_s">            <span>五险一金</span>            <span>餐补</span>            <span>扁平管理</span>            <span>话费补贴</span>            <span>带薪年假</span>            <span>帅哥多</span>            <span>美女多</span>            <span>定期休假</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46856?ts=0">新媒体运营</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46855?ts=0">活动策划执行</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46854?ts=0">IOS开发工程师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46853?ts=0">Android开发工程师 </a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46852?ts=0">售后客服</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16892.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/nDyUsS3ASi4WVLpr.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16892.html" target="_blank" class="zw_name">绿点科技</a>[西安]        </p>        <div class="brif">移动互联网,云计算,大数据             <span>|</span>未融资             <span>|</span>100-500人        </div>        <div class="div_s">            <span>五险一金</span>            <span>规范管理</span>            <span>带薪年假</span>            <span>绩效奖金</span>            <span>年度游玩</span>            <span>领导好好</span>            <span>节日礼物</span>            <span>定期休假</span>            <span>技能培训</span>            <span>年终奖金</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46862?ts=0">Linux系统运维工程师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46861?ts=0">新媒体运营</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46860?ts=0">运营策划</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46859?ts=0">iOS工程师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46858?ts=0">Android工程师</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16891.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/swriXx6mdcLRi6um.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16891.html" target="_blank" class="zw_name">百分点科技</a>[北京]        </p>        <div class="brif">云计算,大数据             <span>|</span>C轮             <span>|</span>500-2000人        </div>        <div class="div_s">            <span>提升快</span>            <span>帅哥多</span>            <span>美女多</span>            <span>五险一金</span>            <span>餐补</span>            <span>话费补贴</span>            <span>带薪年假</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46843?ts=0">Python java 工程师</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46842?ts=0">销售代表</a>         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16890.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/0079FDcTtGCpom0U.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16890.html" target="_blank" class="zw_name">零壹财经</a>[北京]        </p>        <div class="brif">互联网金融             <span>|</span>未融资             <span>|</span>50-100人        </div>        <div class="div_s">            <span>股票期权</span>            <span>五险一金</span>            <span>带薪年假</span>            <span>绩效奖金</span>            <span>领导好好</span>            <span>年度游玩</span>            <span>弹性工作</span>            <span>节日礼物</span>            <span>专项奖金</span>            <span>扁平管理</span>            <span>年终奖金</span>         </div>        <div class="brif">         </div>   </div></li><li>   <a target="_blank" class="gssearch_img" href="http://www.neipin.com/c/16886.html">        <img alt="" onerror="javascript:this.src='images/gsLOGO.jpg'" src="../images/9BVnCiGZKgarw92g.jpg">   </a>   <div class="gsdiv">        <p class="b7">            <a href="http://www.neipin.com/c/16886.html" target="_blank" class="zw_name">恒大地产</a>[广州]        </p>        <div class="brif">O2O,电子商务,移动互联网,社交,互联网金融,企业服务             <span>|</span>天使轮             <span>|</span>2000以上        </div>        <div class="div_s">            <span>五险一金</span>            <span>管吃住</span>            <span>绩效奖金</span>            <span>年终奖金</span>            <span>带薪年假</span>         </div>        <div class="brif">              <a target="_blank" href="http://www.neipin.com/j/46801?ts=0">市场推广经理</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46800?ts=0">前端开发工程师（互联网家居方向）</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46799?ts=0">文案策划</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46798?ts=0">产品经理（互联网家居方向）</a>              <span>|</span><a target="_blank" href="http://www.neipin.com/j/46797?ts=0">中、高级Java开发工程师</a>         </div>   </div></li></ul>
                            <div class="Page" id="pagination"><a href="javascript:void(0)" goto="1" class="show gopage">1</a><a href="javascript:void(0)" goto="2" class="gopage">2</a><a href="javascript:void(0)" goto="3" class="gopage">3</a><a href="javascript:void(0)" goto="4" class="gopage">4</a><a href="javascript:void(0)" goto="5" class="gopage">5</a><a href="javascript:void(0)" goto="6" class="gopage">6</a><a href="javascript:void(0)" goto="7" class="gopage">7</a><a href="javascript:void(0)" goto="8" class="gopage">8</a><a href="javascript:void(0)" target="_self" flg="down" class="page_down pageup">下一页</a></div>
                        </div>
                        <div class="tao_change">
                            <div class="gs_rank">
                                <div style="display:none" class="gs_rank_item">
                                    <div>排序：</div><span v="1" class="1">最受欢迎公司</span><span v="2" class="2">HR反馈最快</span>
                                </div>
                                <div style="display:none" class="company_nojob">
                                    <img alt="" src="../images/ergou.jpg">
                                    <div>暂时没有符合条件的公司信息！</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 右边 -->
                    <div style="float:right; height: 730px;" class="all_divclass">
                        <div style="margin-top:0px" class="banner_con"> 
                            <div class="num_part"><span>热招企业</span></div>
                            <ul id="hotCompanyList" class="slides major-list"><li class="major-item"><a href="/c/1857.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/fi3RGYQKoEdhBcAF.jpg&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>小说阅读网</h2><div>中文阅读与移动阅读领域的领导者</div></span></a></li><li class="major-item"><a href="/c/16862.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/d74lhzYaXNG1BH2V.jpg&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>一米兼职</h2><div>基于地理位置的移动互联网兼职服务产品</div></span></a></li><li class="major-item"><a href="/c/15257.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/1slNcb4CzP5GcOsP.jpg&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>微投</h2><div>金融大咖和技术达人的同台好戏</div></span></a></li><li class="major-item"><a href="/c/16841.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/idWeDQsTM5dEnkaD.jpg&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>陌陌</h2><div>总有新奇在身边</div></span></a></li><li class="major-item"><a href="/c/16808.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/mSCzYMVoEoeLM3k7.png&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>ETM</h2><div>专注提供早期教育管理产品与解决方案</div></span></a></li><li class="major-item"><a href="/c/16662.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/XB6SmGeRsuQQsD3w.png&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>Viscovery</h2><div>亚洲领先的图像及动态影像辨识技术</div></span></a></li><li class="major-item"><a href="/c/16755.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/FAkSs0BoUbrGsIBM.png&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>百度</h2><div>百度一下，你就知道</div></span></a></li><li class="major-item"><a href="/c/16757.html" target="_blank"><span style="background: rgba(0, 0, 0, 0) url(&quot;http://f.neipin.com/photo/company/bitZ3zap6ND3Uk5D.png&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;" class="tongyong_loge"></span><span class="back-face"><h2>小猪短租</h2><div>有人情味的住宿</div></span></a></li></ul>
                        </div>
                        <a target="_blank" href="http://old.ui.cn/joblist.php"><img style="margin-top:20px;" src="../images/UIchina.jpg"></a>
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
                        <li class="item"><a class="bj" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1538590175&amp;site=qq&amp;menu=yes" target="_blank">寻找<br>工作</a></li>
                        <li class="item"><a class="wk" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3078167392&amp;site=qq&amp;menu=yes" target="_blank">发布<br>职位</a></li>
                        <li class="item"><a class="ts" href="http://wpa.qq.com/msgrd?v=3&amp;uin=6281927&amp;site=qq&amp;menu=yes" target="_blank">联系<br>我们</a></li>      
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                    </ul>
                </div>
                <a style="display:none" class="back_to_top" title="" href="#"></a>

                <script type="text/javascript">
                                                $(".wheel-button").wheelmenu({
                                        // alert(1);
                                        trigger: "hover",
                                                animation: "fly",
                                                angle: [0, 360]
                                                });
                </script>

            </div>
@endsection

@section('footer')
   @include('components.myfooter')
@endsection

@section('custom-script')
@endsection