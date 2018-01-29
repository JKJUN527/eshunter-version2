@extends('layout.master')
@section('title', '电竞猎人|首页')

@section('custom-style')
   <link media="all" href="{{asset('../style/style.css')}}" type="text/css" rel="stylesheet">
@endsection


@section('header-nav')
   @include('components.headerNav')
@endsection


@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')
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
        <div class="content_wrap clearfix">
            <div class="content aboutus">
                <dl>
                    <dt>
                        <h2> 
                            <em></em>
                            联系我们
                        </h2>
                    </dt>
                    <dd class="clearfix">
                        <img class="photo" alt="电竞猎人团队" src="images/news1.jpg" width="186" height="215">
                        <div class="intro">
                            <p>
                                                电竞猎人（隶属于上海汉竞信息科技有限公司）是专注电竞职业机会的招聘网站，我们是全国第一家专注电子竞技行业的垂直招聘网站。电竞及相关企业可以通过电竞猎人平台寻找人才，
企业之间也能在线上互相寻求合作。电竞行业今非昔比，人才数量的需求以及人才质量的要求都在提高，
我们目标为电竞行业输入一些优秀的外部人才，也致力于打造电竞行业的线上求职及培训的综合性平台。
                            </p>
                            <p>我们是一个热爱电竞的年轻团队，我们用责任来做这件事情，致力于打造最专业的电竞游戏招聘平台。</p>
                        </div>
                        <ul>
                            <li class="cli1">
                                <h3>商务合作</h3>
                                                 邮箱：
                                <a href="mailto:market@lagou.com" style="display:inline;">kefu@eshunter.com</a>
                            </li>
                            <li class="cli2">
                                <h3>客户服务中心</h3>
                                <div class="service service_fl">
                                                客服邮箱：
                                    <a href="mailto:kefu@eshunter.com">kefu@eshunter.com</a>
                                </div>
                                <div class="service service_fr">
                                                       客服热线：021-63339866
                                </div>
                                <p style="clear: both;">
                                                       地址：上海市黄浦区会稽路8号金天地国际大厦708室
                                </p>
                            </li>
                            <li class="cli3">
                                <h3>电竞猎人服务站</h3>
                                <p>上海服务站：上海市黄浦区会稽路8号金天地国际大厦708室</p>
                                <p>广州服务站：无</p>
                                <p>深圳服务站：无</p>
                                <p>成都服务站：无</p>
                                <p>杭州服务站：无</p>
                            </li>
                            <li class="cli4">
                                <img alt="服务热线" src="images/hotline_6c5691a.png" height="52" width="52">
                                <p>服务热线</p>
                                <span>Service hotline</span>
                                <div class="telephone">
                                    <p>021-63339866</p>
                                    <span>仅收市话费</span>
                                </div>
                            </li>
                            <li class="cli5">
                                400 service is powered by
                                <a href="http://www.ti-net.com.cn/" target="_blank"> <strong>T&amp;I</strong>
                                    <span>天润融通</span>
                                </a>
                            </li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
@endsection

@section('footer')
   @include('components.myfooter')
@endsection

@section('custom-script')
@endsection