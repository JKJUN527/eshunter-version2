@extends('layout.master')
@section('title', '重置密码')

@section('custom-style')
   <link media="all" href="{{asset('../style/login_style.css')}}" type="text/css" rel="stylesheet">
   <style>
        .content_box .input {
                box-sizing: border-box;
                width: 100%;
                border-radius: 0;
            }
            .btn {
                font-size: 16px;
                line-height: 44px;
                display: inline-block;
                height: 44px;
                padding: 0 30px;
                text-align: center;
                text-decoration: none;
                color: #fff;
                border: 1px solid #fff;
                outline: 0;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border-radius: 2px;
                -webkit-transition: .05s linear;
                -o-transition: .05s linear;
                transition: .05s linear;
            }
            .btn_green:hover, .btn_green.btn_active {
                color: #fff;
                border-color: #D32F2F;
                background-color: #D32F2F;
            }
            #layout {
    background-color: #242d3c;
}
   </style>
@endsection

@section('header-nav')
    @include('components.headerNav')
@endsection

@section('content')
   <section class="content_box" id="findPwd1" style="display: block;">
            <!-- 通过手机号找回密码 -->
            <div class="findPwd">
                <h5 class="change_way">
                    <a rel="nofollow" href="/account/login">返回登录</a>
                    <span class="separate">|</span>
                    <a class="go_mail" rel="nofollow" href="javascript:;">通过邮箱找回<span class="iconfont icon-youjiantou"></span></a>
                </h5>
                <form action="" method="">
                    <ul class="form_head clearfix">
                        <li class="active left">
                            <span class="icon_step step1"></span>
                            验证手机号
                        </li>
                        <li class="line right">
                            <span class="icon_step step2"></span>
                            重置密码
                        </li>
                    </ul>
                    <div class="form_body" data-view="phoneFindStep1">
                        <div class="input_item clearfix"  style="display: block;">
                            <span class="area_code">0086</span>
                            <div class="area_code_list" style="display: none;">
                                <dl class="code_list_main"><dt>常用</dt><dd>中国<span>0086</span></dd><dd>中国香港<span>00852</span></dd><dd>中国台湾<span>00886</span></dd><dd>中国澳门<span>00853</span></dd><dd>美国<span>001</span></dd><dt>A</dt><dd>澳大利亚<span>0061</span></dd><dd>中国澳门<span>00853</span></dd><dt>B</dt><dd>巴西<span>0055</span></dd><dt>D</dt><dd>德国<span>0049</span></dd><dt>E</dt><dd>俄罗斯<span>007</span></dd><dt>F</dt><dd>法国<span>0033</span></dd><dt>H</dt><dd>韩国<span>0082</span></dd><dt>J</dt><dd>加拿大<span>001</span></dd><dt>M</dt><dd>马来西亚<span>0060</span></dd><dd>美国<span>001</span></dd><dt>R</dt><dd>日本<span>0081</span></dd><dt>T</dt><dd>中国台湾<span>00886</span></dd><dd>泰国<span>0066</span></dd><dt>X</dt><dd>中国香港<span>00852</span></dd><dd>新加坡<span>0065</span></dd><dt>Y</dt><dd>印度<span>0091</span></dd><dd>英国<span>0044</span></dd><dt>Z</dt><dd>中国<span>0086</span></dd></dl>
                                <p class="tips">如果没有找到您的所在归属地，请拨打客服电话4006282835解决。</p>
                            </div>
                            <input type="text" class="input input_white" name="" placeholder="请输入注册时使用的手机号" data-required="required" autocomplete="off"> 
                        </div>
                        <div class="input_item clearfix"  style="display: block;">
                            <div class="input_group clearfix">
                                <input type="text" class="input input_white left" name="" placeholder="请证明你不是机器人" data-required="required" autocomplete="off">
                                <img src="https://passport.lagou.com/vcode/create?from=register&amp;refresh=1517301289576" alt="点击重试" class="yzm" width="98" height="40">
                                <a rel="nofollow" href="javascript:;" class="reflash"></a>
                            </div>
                        </div>
                        <div class="input_item clearfix"  style="display: block;">
                            <div class="input_group clearfix">
                                <input type="text" class="input input_white first_child" name="" placeholder="请输入短信验证码" data-required="required" autocomplete="off">
                                <input type="button" class="btn btn_active btn_lg last_child" value="获取验证码" data-required="required">
                            </div>
                        </div>
                        <div class="input_item verify_tips"  style="display: block;">
                            <p class="verify_tips_main">收不到短信？请使用
                                <input type="button" class="auto_phone" value="语音验证">
                            </p>
                            <p class="verify_tips_count_down">语音发送成功</p>
                        </div>
                        
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="button" class="btn btn_green btn_active btn_block" value="找回密码">
                        </div>
                    </div>
                    <div class="form_body" style="display:none" data-view="phoneFindStep2">
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="password" class="input input_white" name="" placeholder="请输入新密码 " data-required="required" autocomplete="off"> 
                        </div>
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="password" class="input input_white" name="" placeholder="请再次输入密码" data-required="required" autocomplete="off"> 
                        </div>
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="button" class="btn btn_green btn_active btn_block" value="确定">
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section class="content_box" id="findPwd2" style="display: none;">
            <!-- 通过邮箱来找回密码 -->
            <div class="findPwd">
                <h5 class="change_way">
                    <a rel="nofollow" href="/account/login">返回登录</a>
                    <span class="separate">|</span>
                    <a class="go_phone" rel="nofollow" href="javascript:;" id="go-phone">通过手机号找回<span class="iconfont icon-youjiantou"></a>
                </h5>
                <form action="" method="">
                    <ul class="form_head1 clearfix">
                        <li class="active left">
                            <span class="icon_step step1"></span>
                            输入邮箱地址
                        </li>
                        <li class="left line">
                            <span class="icon_step step2"></span>
                            验证邮箱
                        </li>
                        <li class="right">
                            <span class="icon_step step3"></span>
                            重置密码
                        </li>
                    </ul>
                    <div class="form_body" data-view="emailFindStep1" style="display: block;">
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="text" class="input input_white" name="" placeholder="请输入注册时使用的邮箱地址" data-required="required" autocomplete="off"> 
                        </div>
                        <div class="input_item clearfix"  style="display: none;">
                            <div class="input_group clearfix">
                                <input type="text" class="input input_white" name="" placeholder="请证明你不是机器人" data-required="required" autocomplete="off">
                                <img src="" alt="点击重试" class="yzm" width="98" height="40">
                                <a rel="nofollow" href="javascript:;" class="reflash"></a>
                            </div>
                        </div>
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="button" class="btn btn_green btn_active btn_block" value="找回密码">
                        </div>
                    </div>
                    <div class="form_body" style="display: none;">
                        <div class="input_item clearfix">
                            <h3 class="reset_mail">密码重置邮件已发送至你的邮箱：<span class="des_mail">clear@com.com</span></h3>
                            <p class="reset_tips">请在24小时内登录你的邮箱接收邮件,链接激活后可重置密码。</p>
                        </div>
                        <div class="input_item clearfix" style="display:none;" id="gotoVerify">
                            <input type="button" class="btn btn_green btn_active btn_block" value="登录邮箱查看" id="step2">
                        </div>
                    </div>
                    <div class="form_body" style="display: none;">
                        <div class="input_item clearfix">
                            <input type="text" class="input input_white" name="" placeholder="请输入新密码" data-required="required" autocomplete="off"> 
                        </div>
                        <div class="input_item clearfix">
                            <input type="text" class="input input_white" name="" placeholder="请再次输入新密码" data-required="required" autocomplete="off"> 
                        </div>
                        <div class="input_item clearfix">
                            <input type="button" class="btn btn_green btn_active btn_block" value="确定" id="step3" > 
                        </div>
                    </div>
                </form>
            </div>
        </section>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section("custom-script")
   <script type="text/javascript">
            $(document).ready(function(){
                $(".area_code").click(function(){
                    $(".area_code_list").toggle();
                });
                $(".go_mail").click(function(){
                    $("#findPwd1").hide();
                    $("#findPwd2").show();
                })
                $(".go_phone").click(function(){
                    $("#findPwd1").show();
                    $("#findPwd2").hide();
                })
            })
        </script>
@endsection
