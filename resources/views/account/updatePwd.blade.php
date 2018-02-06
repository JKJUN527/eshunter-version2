@extends('layout.master')
@section('title', '账号设置')

@section('custom-style')
    <link media="all" href="{{asset('style/user_style.css')}}" type="text/css" rel="stylesheet">
@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('content')
<script>
                                            var jianlistatustype = "";
                                            var tui_user_pro = '';
                                            var res_tuijian = '';
                                            var uname = "";
                                            var ukbn = "";
                                            var isIE7 = false;
            
                                    $(document).ready(function(){
            //底部tab切换
                                    $('.contact_Con .contactCon').hide();
                                            $('.contact_Con .contactCon').eq(0).show();
                                            $('.contact_tab span').click(function(){
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
                                            if (isIE){
                                    isIE7 = true;
                                            if (isIE6){
                                    $('.bsie').show();
                                    }
                                    }
                                    $('.closeBtn').click(function(){
                                    $('.a_box').hide();
                                    })

            //底部二维码
                                            $('.about_Us span.ma_img').mouseover(function(){
                                    $(this).find('img').show();
                                    })
                                            $('.about_Us span.ma_img').mouseout(function(){
                                    $(this).find('img').hide();
                                    })
                                            
                                    
                                            $('.pos_dl').mouseenter(function(){
                                    $('.dl_hide').show();
                                    });
                                            $('.pos_dl').mouseleave(function(){
                                    $('.dl_hide').hide();
                                    });
                                            //鼠标滑过2维码显示
                                            $('.wx_pos').mouseover(function(){
                                    $(this).find('img').show();
                                    })

                                            $('.wx_pos').mouseleave(function(){
                                    $(this).find('img').hide();
                                    })
                                })
            </script>
            <div class="wrapper_content clearfix">
                
                <div class="user_bindSidebar">
                    <ul class="user_sideBarmenu">
                        <li>
                            <a href="userInfo.html" >个人信息</a>
                        </li>
                        <li>
                            <a href="accoutBind.html">帐号绑定</a>
                        </li>
                        <li>
                            <a href="resumePrivacy.html" >隐私设置</a>
                        </li>
                        <li>
                            <a href="updatePwd.html" class="hover_ac">修改密码</a>
                        </li>
                    </ul>
                </div>
                <div class="user_modifyContent">
                    <dl class="c_section">
                        <dt>
                            <p>登录帐号： 189xxxx8765 </p>
                        </dt>
                        <dd>
                            <form id="updatePswForm">
                                <div class="input_item">
                                    <input type="password" name="oldpassword" id="oldpassword" placeholder="请输入当前密码" autocomplete="off">
                                    <span for="oldpassword" generated="true" class="error error1" style="display: none;">请输入当前密码</span>
                                </div>
                                <div class="input_item">
                                    <input type="password" name="newpassword" id="newpassword" placeholder="请输入新密码" autocomplete="off">
                                    <span for="newpassword" generated="true" class="error error2" style="display: none;">请输入新密码</span>
                                </div>
                                <div class="input_item">
                                    <input type="password" name="comfirmpassword" id="comfirmpassword" placeholder="确认新密码" autocomplete="off">
                                    <span for="comfirmpassword" generated="true" class="error error3" style="display: none;">请再次输入新密码</span>
                                </div>
                                <span class="error" style="display:none;" id="updatePwd_beError"></span>
                                <div class="input_item">
                                    <input type="submit" value="保 存">
                                </div>
                
                            </form>
                        </dd>
                    </dl>
                </div>
            </div>
            <!--弹窗-->
            <div id="cboxOverlay" style="opacity: 0.9;display: none;"></div>
            <div id="colorbox" style="display: none; visibility: visible; top: 0px; left: 412px; position: absolute; width: 526px; height: 488px;">
                <div id="cboxWrapper" style="height: 488px; width: 526px;">
                    <div>
                        <div id="cboxTopLeft" style="float: left;"></div>
                        <div id="cboxTopCenter" style="float: left; width: 500px;"></div>
                        <div id="cboxTopRight" style="float: left;"></div>
                    </div>
                    <div style="clear: left;">
                        <div id="cboxMiddleLeft" style="float: left; height: 462px;"></div>
                        <div id="cboxContent" style="float: left; width: 500px; height: 462px;">
                            <div id="cboxLoadedContent" style="width: 500px; overflow: hidden; height: 418px;">
                                <div id="changePhone" class="popup user_popup">
                                    <p class="bding_title" style="margin-bottom:28px">验证你的手机号，完成手机帐号的绑定</p>
                                    <div class="form_body clearfix" style="display: block;">
                                        <div class="input_item clearfix" style="display: block;">
                                            <span class="area_code">0086</span>
                                            <div class="area_code_list" style="display: none;">
                                                <dl class="code_list_main"><dt>常用</dt><dd>中国<span>0086</span></dd><dd>中国香港<span>00852</span></dd><dd>中国台湾<span>00886</span></dd><dd>中国澳门<span>00853</span></dd><dd>美国<span>001</span></dd><dt>A</dt><dd>澳大利亚<span>0061</span></dd><dd>中国澳门<span>00853</span></dd><dt>B</dt><dd>巴西<span>0055</span></dd><dt>D</dt><dd>德国<span>0049</span></dd><dt>E</dt><dd>俄罗斯<span>007</span></dd><dt>F</dt><dd>法国<span>0033</span></dd><dt>H</dt><dd>韩国<span>0082</span></dd><dt>J</dt><dd>加拿大<span>001</span></dd><dt>M</dt><dd>马来西亚<span>0060</span></dd><dd>美国<span>001</span></dd><dt>R</dt><dd>日本<span>0081</span></dd><dt>T</dt><dd>中国台湾<span>00886</span></dd><dd>泰国<span>0066</span></dd><dt>X</dt><dd>中国香港<span>00852</span></dd><dd>新加坡<span>0065</span></dd><dt>Y</dt><dd>印度<span>0091</span></dd><dd>英国<span>0044</span></dd><dt>Z</dt><dd>中国<span>0086</span></dd></dl>
                                                <p class="tips">如果没有找到您的所在归属地，请拨打客服电话4006282835解决。</p>
                                            </div>
                                            <input type="text" class="input input_white input_warning" id="" name="" placeholder="请输入常用手机号" data-required="required" autocomplete="off">
                                            <span data-valid-message="" class="input_tips">输入号码与归属地不匹配</span>
                                        </div>
                                        <div class="input_item clearfix"  style="display: block;">
                                            <div class="input_group clearfix">
                                                <input type="text" class="input input_white fl" name="" placeholder="请证明你不是机器人" data-required="required" autocomplete="off">
                                                <img alt="点击重试" class="yzm" width="98" height="40" src="https://account.lagou.com/vcode/create?from=register&amp;refresh=1516426783908">
                                                <a rel="nofollow" href="javascript:;" class="reflash"></a>
                                            </div>
                                        </div>
                                        <div class="input_item" style="display: block;">
                                            <div class="input_group clearfix">
                                                <input type="text" class="input input_white first_child" id="" name="" placeholder="请输入验证码" data-required="required" autocomplete="off">
                                                <input type="button" class="btn btn_green btn_active btn_lg last_child" value="获取验证码" data-required="required">
                                            </div>
                                            <span data-valid-message="" class="input_tips">请输入6位数字验证码</span>
                                        </div>
                                        <div class="input_item verify_tips" style="display: block;">
                                            <p class="verify_tips_main">收不到短信？请使用
                                                <input type="button" class="auto_phone" value="获取验证码">
                                            </p>
                                            <p class="verify_tips_count_down">语音发送成功</p>
                                        </div>
                                        <div class="input_item left clearfix"  style="display: block;">
                                            <input type="button" class="btn btn_green btn_active btn_block btn_lg" value="完成绑定">
                                        </div>
                                        <div class="input_item left "  style="display: block;">
                                            <input type="button" class="btn btn_link btn_lg" value="返回">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="cboxTitle" style="float: left; display: block;">帐号绑定</div>
                            <button type="button" id="cboxClose">close</button>
                        </div>
                        <div id="cboxMiddleRight" style="float: left; height: 462px;"></div>
                    </div>
                    <div style="clear: left;">
                        <div id="cboxBottomLeft" style="float: left;"></div>
                        <div id="cboxBottomCenter" style="float: left; width: 500px;"></div>
                        <div id="cboxBottomRight" style="float: left;"></div>
                    </div>
                </div>
            </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
<script type="text/javascript">
                $(document).ready(function(){
                    $("#cboxClose").click(function(){
                      $("#colorbox").hide();
                      $("#cboxOverlay").hide();
                    });
                    $("#changePhoneBtn").click(function(){
                      $("#colorbox").show();
                      $("#cboxOverlay").show();
                    });
                    $('input').blur(function () {
                        this.style.borderColor = this.value == '' ? 'red' : 'green';
                    })
                    $('#oldpassword').blur(function(){
                        if ($('#oldpassword').val() == '') {
                            $(".error1").show()
                        } else{
                            $(".error1").hide()
                        }
                    })
                    $('#newpassword').blur(function(){
                        if ($('#oldpassword').val() == '') {
                            $(".error2").show()
                        } else{
                            $(".error2").hide()
                        }
                    })
                    $('#comfirmpassword').blur(function(){
                        if ($('#oldpassword').val() == '') {
                            $(".error3").show()
                        } else{
                            $(".error3").hide()
                        }
                    })
                });
            </script>
@endsection
