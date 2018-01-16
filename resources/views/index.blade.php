@extends('layout.master')
@section('title', '电竞猎人|首页')


@section('custom-style')
    <link href="{{asset('style/base.css?v=2.39')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/style_qq.css?v=2.33')}}" type="text/css" rel="stylesheet">
@endsection


@section('header-nav')
   @include('components.headerNav')
@endsection


@section('header-tab')
   @include('components.headerTab')
@endsection


@section('content')
    <div style="display:none" class="tishi">
                <span id="tishi_msg"></span>
                <div style="top:5px; right:5px;" class="close_X">X</div>
            </div>
            <div class="hsbj"></div>
            <div style="display:none;" class="whitebg"></div>

            <!--这是加载AJAX的动态转图-->
            <div style="left:50%; float:left; position:fixed; top:50%; z-index:100009; display:none;" id="home_loading">
                <img src="images/anim_loading_75x75.gif">
            </div>
            <div class="containter">  
                <!-- 左边结束  -->
                <input type="hidden" value="" id="keywd_py">
                <div class="index_con">
                    <div id="all_divclass" class="all_divclass">
                        <div class="all_divcon">
                            <img src="./images/dh.png" alt="">
                        </div>
                    </div>      
                    <div class="jieshao">
                        <div class="taoyige">
                            <div class="left form_div">
                                <input type="text" placeholder="请输入关键词，如：运营策划" value="" name="" id="xinkeywd" style="height:100%">
                            </div>
                        </div>
                        <input type="button" value="搜索" name="" id="chakan">
                        <!-- 热门搜索 -->
                        <div class="taoyige_hotsearch">热门搜索：<a href="company.html">电竞传媒</a><a href="#">ADC</a><a href="#">辅助</a><a href="#">打野</a><a href="#">中单</a></div>
                        <!-- 热门搜索 end-->
                        <!-- banner 轮播-->
                        <div class="m_banner">
                            <div style="cursor:pointer;" class="banner banner1">
                                <img src="images/banner.jpg" width="800" height="241"/>
                            </div>  
                            <div style="display:none; cursor:pointer;" class="banner banner2">
                                <img src="images/banner3.jpg" width="800" height="241"/>
                            </div>          
                            <div style="display:none; cursor:pointer;" class="banner banner3">
                                <img src="images/banner2.jpg" width="800" height="241"/>
                            </div>          
                            <a class="prev" href="javascript:void(0);" style="display: none;"></a>
                            <a class="next" href="javascript:void(0);" style="display: none;"></a>
                        </div>
                        <!-- 轮播end -->
                          
                    </div> 
                    
                </div>
                <script src="js/jquery.wheelmenu.js" type="text/javascript"></script>
                <!-- <div class="QQ_each">
                    <a class="wheel-button float_qq" href="#wheel" style="opacity: 1;"></a>
                    <ul class="wheel" id="wheel">
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a class="bj" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1538590175&amp;site=qq&amp;menu=yes" >寻找<br>工作</a></li>
                        <li class="item"><a class="wk" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3078167392&amp;site=qq&amp;menu=yes" >发布<br>职位</a></li>
                        <li class="item"><a class="ts" href="http://wpa.qq.com/msgrd?v=3&amp;uin=6281927&amp;site=qq&amp;menu=yes" >联系<br>我们</a></li>      
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                    </ul>
                </div> -->
                <a style="display:none" class="back_to_top" title="" href="#"></a>

                <script type="text/javascript">
                                                            $(".wheel-button").wheelmenu({
                                                    // alert(1);
                                                    trigger: "hover",
                                                            animation: "fly",
                                                            angle: [0, 360]
                                                    });
                </script>
                <div class="jieshao_tb">
                    <span v="0" class="active">热门职位</span>
                    <span v="1">最新职位</span>          
                </div>  
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
                                    <img src="images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
                                </a>
                                <div class="bottom-right">
                                    <div class="company_name wordCut">
                                        <a href="detail_company.html">EDG俱乐部</a>
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
                                    <img src="images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
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
                </ul>
                <ul class="jieshao_list jobs" style="display: none;">
                    <li>    
                        <div class="jieshao_list_left left">            
                             <div class="list_top">
                                <div class="clearfix pli_top">
                                    <div class="position_name left">
                                        <h2 class="dib"><a href="#">英雄联盟职业玩家</a></h2>
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
                                        <h2 class="dib"><a href="#">绝地求生职业玩家</a></h2>
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
                                        <h2 class="dib"><a href="#">王者荣耀职业玩家</a></h2>
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
                <div class="more_box"><a href="#" class="list_more">查看更多</a></div>
                <div class="gongsi_tb">
                    <span v="0" class="active">热门公司</span>
                    <span v="1">推荐公司</span>
                </div> 
                <div class="ad_company gongsi_list">
                    <ul class="ad_company_list clearfix hot-company">
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic1.jpg" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">霖感电竞</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic2.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">正心文化</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                        
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic3.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">LGD</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                            
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic4.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">GHG</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                    
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic5.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">兔玩电竞</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                        
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic1.jpg" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a hhref="detail_company.html" target="_blank">霖感电竞</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic2.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">正心文化</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                        
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic3.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">LGD</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                            
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic4.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">GHG</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                    
                        </li>
                        <li class="company_item">
                            <div class="item_top">
                                <p><a href="detail_company.html" target="_blank"><img src="images/pic5.png" alt="" width="193" height="100"/></a></p>
                                <p class="company-name wordCut">
                                    <a href="detail_company.html" target="_blank">兔玩电竞</a>
                                </p>
                                <p class="indus-stage wordCut">
                                    <span>电竞赛事,教育,传媒</span>
                                    <span>未融资</span>
                                </p>
                            </div>
                        
                        </li>
                        <div style="clear: both;"></div>
                    </ul>
                    <ul class="ad_company_list clearfix nav-logos tuijian-company">
                    <li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li>
                    
                    <div style="clear: both;"></div>
                </ul>
                <ul class="ad_company_list clearfix nav-logos tuijian-company">
                    <li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li><li class="nav-logo" data-tj-exposure="off" data-lg-tj-type="xiaoyuan_ad" data-lg-tj-id="19ng" data-lg-tj-no="idnull" data-lg-tj-cid="7" data-reactid="319"><div class="nav-img" data-reactid="320"><img src="https://www.lgstatic.com/image1/M00/00/01/Cgo8PFTUV_OAH8cPAACZoNxm1EI176.jpg" width="70" height="70" alt="今日头条" data-reactid="321"><div class="nav-hover-cycle" data-reactid="322"></div></div><div class="company-short-name" data-reactid="323">今日头条</div></li>
                    
                    <div style="clear: both;"></div>
                </ul>
                </div>
                
            <div class="ad_company">
                
            </div>
            <!-- <div class="more_box"><a href="#" class="list_more">查看更多</a></div> -->
            <div class="jieshao_tb">
                <span v="0" class="active">广告资讯</span>
            </div>
            <div class="ad_company" style="    padding-top: 20px;">
                <ul class="gallery-list">
                	<li class="gallery-item larger-item" style="background-image:url(https://static.lagou.com/i/image2/M00/2C/C5/CgoB5lovvBaALl-HAADxuS4BJtU399.PNG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">不校招也能进大厂！毕业可留用实习岗机会难得！</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<li class="gallery-item larger-item" style="background-image:url(https://static.lagou.com/i/image2/M00/2C/C5/CgoB5lovvBaALl-HAADxuS4BJtU399.PNG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">不校招也能进大厂！毕业可留用实习岗机会难得！</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<li class="gallery-item " style="background-image:url(https://static.lagou.com/i/image2/M00/3C/43/CgotOVpTJxSAY5OcAAC9sB-g5vc765.JPG);">
                		<a class="gallery-link" href="#" target="_blank">
                		<span class="text">互联网教育公司专场</span>
                		</a>
                	</li>
                	<div style="clear: both;"></div>
                	
                </ul>
            </div>
            <div class="more_box"><a href="#" class="list_more">查看更多</a></div>
            </div>
@endsection


@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
     <script charset="utf-8" type="text/javascript" src="js/header.js?v=1.00"></script>
    <script charset="utf-8" type="text/javascript" src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js"></script>
    <script type="text/javascript">

                                     function tou_jobresult(id){
                                                                window.open("/j/" + id + ".html");
                                                                }

                                                        $(document).ready(function(){

                                                        $("._pel").load("/job/personalinformation");
                                                                var xian = "";
                                                                if (xian == 1){
                                                        $('#search_list').slideDown();
                                                        }


                                                        $(".btn_ss").live("click", function(){
                                                        var keywd = $("#keywd").val();
                                                                if (keywd != "" && keywd != undefined)
                                                        {
                                                        window.location.href = BaseJSURL + "/job/?kwd=" + keywd;
                                                        }
                                                        });
                                                                //下拉导航
                                                                $('.user_names').click(function(event){
                                                        var e = window.event || event;
                                                                if (e.stopPropagation){
                                                        e.stopPropagation();
                                                        } else{
                                                        e.cancelBubble = true;
                                                        }
                                                        $('.user_names_con').show();
                                                        })
                                                                $('.user_names_con').click(function(event){
                                                        var e = window.event || event;
                                                                if (e.stopPropagation){
                                                        e.stopPropagation();
                                                        } else{
                                                        e.cancelBubble = true;
                                                        }
                                                        })
                                                                document.onclick = function(){

                                                                $(".user_names_con").hide();
                                                                        $('.seles_hide').hide();
                                                                };
                                                                $('.hr_sao span').click(function(){
                                                        $(this).parent('.hr_sao').hide();
                                                                $('.hsbj').hide();
                                                        });
                                                        })


                                                                function jiazerwm()
                                                                {
                                                                jQuery.ajax({
                                                                type: 'get',
                                                                        contentType : 'application/json; charset=utf-8',
                                                                        dataType: 'json',
                                                                        url: '/qcode/bind',
                                                                        data: '',
                                                                        success: function(data){
                                                                        $('.hsbj').show();
                                                                                $("#erweima").attr("src", "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" + data.ticket);
                                                                                $('.hr_sao').show();
                                                                        }
                                                                });
                                                                }
                                                        $(document).ready(function(){
                                                        var erweima_flag = "";
                                                                if (erweima_flag == "0")
                                                        {
                                                        setTimeout("jiazerwm();", 2000);
                                                        }

                                                        });
            </script> 
            <script>
                var jianlistatustype = "";
                var tui_user_pro = '';
                var res_tuijian = '';
                var uname = "";
                var ukbn = "";
                var isIE7 = false;
                //验证标识
                var verifyflg = "";

                // F

                $(document).ready(function() {
                    //底部tab切换
                    $('.contact_Con .contactCon').hide();
                    $('.contact_Con .contactCon').eq(0).show();
                    $('.contact_tab span').click(function() {
                        $(this).addClass('active');
                        $(this).siblings().removeClass('active');
                        $('.contact_Con .contactCon').hide();
                        $('.contact_Con .contactCon').eq($(this).index()).show();
                    })

                    //判断是否为ie6
                    var isIE = !!window.ActiveXObject;
                    var isIE6 = isIE && !window.XMLHttpRequest;
                    var isIE8 = isIE && !!document.documentMode;
                    var isIE7 = isIE && !isIE6 && !isIE8;
                    if (isIE) {
                        isIE7 = true;
                        if (isIE6) {
                            $('.bsie').show();
                        }
                    }
                    $('.closeBtn').click(function() {
                        $('.a_box').hide();
                    })

                    //底部二维码
                    $('.about_Us span.ma_img').mouseover(function() {
                        $(this).find('img').show();
                    })
                    $('.about_Us span.ma_img').mouseout(function() {
                            $(this).find('img').hide();
                        })
                        //点击登录
                    $('#login_click').live("click", function() {
                        my_login();
                    });
                    if (ukbn == 1) {
                        getSelectHrJobJianLi();
                    }
                    //点击导航的登录 
                    $('#dl_span').live("click", function() {
                        window.location.href = 'login.html.html';
                    });
                    // 账号的回车事件
                    $('#myusername').keydown(function(event) {
                        if (13 == event.keyCode || 13 == event.which) {
                            my_login();
                        }
                    });
                    //密码的回车事件
                    $('#mypassword').keydown(function(event) {
                        if (13 == event.keyCode || 13 == event.which) {
                            my_login();
                        }
                    });
                    // 搜索职位的回车事件 
                    $('#my_job_form').keydown(function(event) {
                        if (13 == event.keyCode || 13 == event.which) {
                            headtijiao();
                        }
                    });
                    //登录框隐藏与显示
                    //$('.dl_hide').hide();
                    $('.pos_dl').mouseenter(function() {
                        $('.dl_hide').show();
                    });
                    $('.pos_dl').mouseleave(function() {
                        $('.dl_hide').hide();
                    });
                    //鼠标滑过2维码显示
                    $('.wx_pos').mouseover(function() {
                        $(this).find('img').show();
                    })

                    $('.wx_pos').mouseleave(function() {
                        $(this).find('img').hide();
                    })
                    if (uname != "" && uname != null) {
                        // 调用此方法 
                        getSelectProfileJobJianLi();
                    }

                    // 事件关闭
                    $('.event_top span').click(function() {
                        $(this).parent().slideUp();
                    })

                    $('.event_top').click(function() {
                        window.open("/act");
                    })



                    if (uname != "" && uname != null && ukbn == 1) {
                        getHrNewJianliNum();
                    }

                });
                // 查询职位方法 
                function headtijiao() {
                    var xinkeywd = encodeURIComponent($("#my_job_form").val());
                    window.location.href = '/job/?mkwd=' + xinkeywd;
                }
                //查询职位方法结束 

                // 登录方法 
                function my_login() {
                    $("#herders_cuowu").hide();
                    var param = new Object();
                    param.emailAddr = $("#myusername").val();
                    param.passwd = $("#mypassword").val();
                    if (param.emailAddr == "") {
                        $("#herders_cuowu").html("请填写用户名");
                        $("#herders_cuowu").show();
                        return;
                    }
                    if (param.passwd == "") {
                        $("#herders_cuowu").html("请填写密码");
                        $("#herders_cuowu").show();
                        return;
                    }

                    // jQuery.ajax({
                    //     type: 'post',
                    //     contentType: 'application/json; charset=utf-8',
                    //     dataType: 'json',
                    //     url: '/ajax/login.do',
                    //     data: JSON.stringify(param),
                    //     success: function(data) {
                    //         if (data.ret == "0") {
                    //             if (data.ukbn == 1) {
                    //                 //window.location.href = "/hr/";
                    //                 window.location.href = "/job.html";
                    //             } else {
                    //                 window.location.href = "/job.html";
                    //             }
                    //         } else if (data.ret == -1) {
                    //             $("#herders_cuowu").html("用户不存在或密码错误");
                    //             $("#herders_cuowu").show();
                    //         } else {
                    //             $("#herders_cuowu").html("登录失败，请稍候重试");
                    //             $("#herders_cuowu").show();
                    //         }
                    //     }
                    // });
                };
                //查询普通用户没有回复hr面试通知的数量
                function getSelectProfileJobJianLi() {
                    var param = new Object();
                    var total = 0;
                    // jQuery.ajax({
                    //     type: 'post',
                    //     contentType: 'application/json; charset=utf-8',
                    //     dataType: 'json',
                    //     url: '/ajax/getSelectProfileJobJianLi.do',
                    //     data: JSON.stringify(param),
                    //     success: function(data) {
                    //         if (data.np.number0 > 0) {
                    //             total = total + data.np.number0;
                    //             //$("#profile_jianli_number").text(data.np.number0);
                    //             //$("#profile_jianli_number").show();
                    //             $("#profile_jianli_number2").text(data.np.number0);
                    //             $("#profile_jianli_number2").show();
                    //         }
                    //         if (jianlistatustype == 0) {
                    //             if (data.np.number1 > 0) {
                    //                 $("#profile_jianli_number_1").text(data.np.number1);
                    //                 $("#profile_jianli_number_1").show();
                    //             }
                    //             if (data.np.number2 > 0) {
                    //                 $("#profile_jianli_number_2").text(data.np.number2);
                    //                 $("#profile_jianli_number_2").show();
                    //             }
                    //             if (data.np.number3 > 0) {
                    //                 $("#profile_jianli_number_3").text(data.np.number3);
                    //                 $("#profile_jianli_number_3").show();
                    //             }

                    //         }
                    //         if (jianlistatustype == 1) {
                    //             if (data.np.number3 > 0) {
                    //                 $("#profile_jianli_number_1").text(data.np.number4);
                    //                 $("#profile_jianli_number_1").show();
                    //             }
                    //             if (data.np.number4 > 0) {
                    //                 $("#profile_jianli_number_2").text(data.np.number5);
                    //                 $("#profile_jianli_number_2").show();
                    //             }
                    //             if (data.np.number5 > 0) {
                    //                 $("#profile_jianli_number_3").text(data.np.number6);
                    //                 $("#profile_jianli_number_3").show();
                    //             }

                    //         }
                    //         var jk = parseInt(data.np.number1) + parseInt(data.np.number2) + parseInt(data.np.number3);
                    //         var jk1 = parseInt(data.np.number4) + parseInt(data.np.number5) + parseInt(data.np.number6);
                    //         if (jk > 0) {
                    //             $("#profile_jianli_number_4").text(jk);
                    //             $("#profile_jianli_number_4").show();
                    //         }
                    //         if (jk1 > 0) {
                    //             $("#profile_jianli_number_5").text(jk1);
                    //             $("#profile_jianli_number_5").show();
                    //         }
                    //         total = total + jk + jk1;
                    //         if (total > 0) {
                    //             $("#jianli_status").append('<em>' + total + '</em>');
                    //         }
                    //     }
                    // });
                };
                //查询hr没有回复数量 
                function getSelectHrJobJianLi() {
                    // jQuery.ajax({
                    //     type: 'post',
                    //     contentType: 'application/json; charset=utf-8',
                    //     dataType: 'json',
                    //     url: '/ajax/getSelectHrJobJianLi.do',
                    //     data: JSON.stringify(new Object()),
                    //     success: function(data) {
                    //         if (data.np.number1 > 0) {
                    //             $("#hr_mei_jianli").append("<em>" + data.np.number1 + "</em>");
                    //             $("#shou").append("<em>" + data.np.number1 + "</em>");
                    //         }
                    //         if (data.np.number2 > 0) {
                    //             $("#hr_tong_jianli").append("<em>" + data.np.number2 + "</em>");
                    //         }
                    //     }
                    // });
                };
                //查询Hr新简历数
                function getHrNewJianliNum() {
                    // jQuery.ajax({
                    //     type: 'post',
                    //     contentType: 'application/json; charset=utf-8',
                    //     dataType: 'json',
                    //     url: '/ajax/newnum.do',
                    //     data: JSON.stringify(new Object()),
                    //     success: function(data) {
                    //         if (data.newnum > 0) {
                    //             $('.num').show();
                    //             $('.num').text(data.newnum);
                    //         } else {
                    //             $('.num').hide();
                    //         }
                    //     }
                    // });
                }

                //登录结束 
                </script>
@endsection


