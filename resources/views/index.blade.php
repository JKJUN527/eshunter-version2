@extends('layout.master')
@section('title', '电竞猎人|首页')


@section('custom-style')
    <link href="{{asset('../style/tao.css?v=2.61')}}" type="text/css" rel="stylesheet">
    <script>
            var openid = "";
            $(function() {
                //加载index_xianxing内容，推荐状况的实时展示
                
                // 气球客服
                // if($('.QQ_each').offset().top<489){
                //   $('.QQ_each').css({'top':'489px','margin-top':'0'});
                //   }
                // 鼠标滑过banner，箭头出现
                $('.m_banner').mouseover(function() {
                    $('.m_banner a').show();
                })
                $('.m_banner').mouseleave(function() {
                        $('.m_banner a').hide();
                    })
                    // 城市部分鼠标滑过
                $('.city_chooseCon').mouseover(function() {
                    $('.choosing').stop(true, true).slideDown(150);
                })
                $('.city_chooseCon').mouseleave(function() {
                    $('.choosing').stop(true, true).slideUp(150);
                })

                // 职位tab
                $('.jieshao_list').hide();
                $('.jieshao_list').eq(0).show();
                $('.jieshao_tb span').click(function() {
                    $(this).addClass('active');
                    $('.jieshao_list').eq($(this).index()).show();
                    $(this).siblings('span').removeClass('active');
                    $('.jieshao_list').eq($(this).index()).siblings('ul').hide();
                    var v = $(this).attr('v');
                })
                $('.gongsi_tb span').click(function() {
                    $(this).addClass('active').siblings('span').removeClass('active');
                    $(this).index() === 0 && $('.gongsi_list').find('.hot-company').show().siblings('.tuijian-company').hide()
                    $(this).index() === 1 && $('.gongsi_list').find('.tuijian-company').show().siblings('.hot-company').hide()
                    var v = $(this).attr('v');
                })


                // 鼠标滑过边框变色
                $('.jieshao_list li').live('mouseover', function() {
                    // $(this).addClass('greenborder_li');
                    //         $(this).siblings().removeClass('greenborder_li');
                    // })
                    //         $('.jieshao_list li').live('mouseleave', function(){
                    // $(this).removeClass('greenborder_li');
                    // })
                    // 定位导航
                    $(document).scroll(function() {
                        var window_height = $(window).height();
                        var to_bottom = $(document).height() - $(window).height() - $(document).scrollTop();
                        if (window_height > 660 && window_height < 920) {
                            if ($(document).scrollTop() >= 200) {
                                $('#all_divclass').addClass('all_static');
                                if (to_bottom > 230) {
                                    $('#all_divclass').removeClass('all_static').removeClass('all_absolute').addClass('all_fixed');
                                } else {
                                    $('#all_divclass').removeClass('all_static').removeClass('all_fixed').addClass('all_absolute');
                                }
                            }
                            if ($(document).scrollTop() < 100) {
                                $('#all_divclass').addClass('all_static');
                            }
                        }

                        // 屏幕可以放下左边导航和底部的情况
                        if (window_height > 920) {
                            if ($(document).scrollTop() >= 200) {
                                $('#all_divclass').removeClass('all_static').addClass('all_fixed');
                            } else {
                                $('#all_divclass').removeClass('all_fixed').addClass('all_static');
                            }
                        }
                    })


                    $('.banner1').live('click', function() {
                        window.open("#");
                    });
                    $('.banner2').live('click', function() {
                        window.open("#");
                    });
                    $('.banner3').live('click', function() {
                        window.open("#");
                    });
                    // 二级导航  
                    $('.all_divlist_border').live('mouseover', function() {
                        $(this).addClass('all_divlist_active');
                        $(this).find('.all_divlist').css({
                           
                        });
                        $(this).prev().find('.all_divlist').css({
                            
                        });
                        $(this).siblings('.all_divlist_border').removeClass('all_divlist_active');
                        $(this).find('.all_divlist_two').show();
                    })

                    $('.all_divlist_border').live('mouseout', function() {
                        $(this).removeClass('all_divlist_active');
                        $(this).find('.all_divlist_two').hide();
                        $(this).find('.all_divlist').css({
                           
                        });
                        $(this).prev().find('.all_divlist').css({
                            
                        });
                    })
                })

                
            })
        </script>
@endsection


@section('header-nav')
   @include('components.headerNav')
@endsection


@section('header-tab')
   @include('components.headerTab',['activeIndex' => 1,'type' => 0])
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
                <img src="../images/anim_loading_75x75.gif">
            </div>
            <div class="containter">  
                <!-- 左边结束  -->
                <input type="hidden" value="" id="keywd_py">
                <div class="index_con">
                    <div id="all_divclass" class="all_divclass">
                        <div class="all_divcon">
                            <p class="til">全部职位分类</p>   
                            
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">俱乐部</h2>
                                    <a href="#">LGD</a>
                                    <a href="#">WDG</a>
                                    <a href="#">WE</a>
                                    <a href="#">SKT</a>
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            <a href="#">EDG</a>  
                                            <a href="#">LGD</a>  
                                            <a href="#">QG</a>  
                                            <a href="#">SKT</a>  
                                            <a href="#">Longzhu</a>  
                                            <a href="#">WE</a>  
                                            <a href="#">Snake</a>  
                                            <a href="#">NB</a>  
                                            <a href="#">RNG</a>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">赛事方</h2>
                                    <a href="#">腾讯</a>
                                    <a href="#">百度</a>
                                    <a href="#">拳头</a>
                                    <a href="#">网易</a>
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            <a href="#">腾讯</a>
                                            <a href="#">百度</a>
                                            <a href="#">拳头</a>
                                            <a href="#">网易</a>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">电竞传媒</h2>
                                    <a href="#">斗鱼</a>
                                    <a href="#">龙珠</a>
                                    <a href="#">熊猫</a>
                                    <a href="#">虎牙</a>
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            <a href="#">斗鱼</a>
                                            <a href="#">龙珠</a>
                                            <a href="#">熊猫</a>
                                            <a href="#">虎牙</a>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">游戏开发</h2>
                                    <a href="#">腾讯</a>
                                    <a href="#">网易</a>
                                    <a href="#">百度</a>
                                    <a href="#">拳头</a>
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            <a href="#">EDG</a>  
                                            <a href="#">LGD</a>  
                                            <a href="#">QG</a>  
                                            <a href="#">SKT</a>  
                                            <a href="#">Longzhu</a>  
                                            <a href="#">WE</a>  
                                            <a href="#">Snake</a>  
                                            <a href="#">NB</a>  
                                            <a href="#">RNG</a>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">电竞门户</h2>
                                    <a href="#">LGD</a>
                                    <a href="#">EDG</a>
                                    <a href="#">WE</a>
                                    <a href="#">OMGG</a>
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            <a href="#">EDG</a>  
                                            <a href="#">LGD</a>  
                                            <a href="#">QG</a>  
                                            <a href="#">SKT</a>  
                                            <a href="#">Longzhu</a>  
                                            <a href="#">WE</a>  
                                            <a href="#">Snake</a>  
                                            <a href="#">NB</a>  
                                            <a href="#">RNG</a>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">电竞协会</h2>
                                    <a href="#">LGD</a>
                                    <a href="#">SKT</a>
                                    <a href="#">Longzhu</a>
                                    <a href="#">QG</a>
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            <a href="#">EDG</a>  
                                            <a href="#">LGD</a>  
                                            <a href="#">QG</a>  
                                            <a href="#">SKT</a>  
                                            <a href="#">Longzhu</a>  
                                            <a href="#">WE</a>  
                                            <a href="#">Snake</a>  
                                            <a href="#">NB</a>  
                                            <a href="#">RNG</a>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="all_divlist_border all_divlist_border1">
                                <div class="all_divlist">
                                    <h2 class="jlb">其他</h2>
                                    <a href="#">NBA2K</a>
                                    <a href="#">FIFA</a>
                                    <a href="#">WC</a>
                                    <a href="#">FFW</a>
                                    <i class="arrow"></i>
                                </div>
                                <div class="all_divlist_two all_divlist_two1">
                                    <div>
                                        <div>
                                            <a href="#">EDG</a>  
                                            <a href="#">LGD</a>  
                                            <a href="#">QG</a>  
                                            <a href="#">SKT</a>  
                                            <a href="#">Longzhu</a>  
                                            <a href="#">WE</a>  
                                            <a href="#">Snake</a>  
                                            <a href="#">NB</a>  
                                            <a href="#">RNG</a>  
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                <img src="../images/banner.jpg" width="800" height="241"/>
                            </div>  
                            <div style="display:none; cursor:pointer;" class="banner banner2">
                                <img src="../images/banner3.jpg" width="800" height="241"/>
                            </div>          
                            <div style="display:none; cursor:pointer;" class="banner banner3">
                                <img src="../images/banner2.jpg" width="800" height="241"/>
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
                                    <img src="../images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
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
                                    <img src="../images/pic00.png" alt="公司logo" class="company-logo" width="40" height="40">
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
                                    <img src="../images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
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
                                    <img src="../images/pic00.png" alt="公司logo" class="company-logo" width="40" height="40">
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
                                    <img src="../images/pic0.jpg" alt="公司logo" class="company-logo" width="40" height="40">
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
                                    <img src="../images/pic00.png" alt="公司logo" class="company-logo" width="40" height="40">
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic1.jpg" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic2.png" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic3.png" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic4.png" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic5.png" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic1.jpg" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic2.png" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic3.png" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic4.png" alt="" width="193" height="100"/></a></p>
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
                                <p><a href="detail_company.html" target="_blank"><img src="../images/pic5.png" alt="" width="193" height="100"/></a></p>
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

@endsection


