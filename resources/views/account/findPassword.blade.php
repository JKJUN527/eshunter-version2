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
    @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
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
                        <li class="active left" id="step1">
                            <span class="icon_step step1"></span>
                            验证手机号
                        </li>
                        <li class="line right" id="step2-phone">
                            <span class="icon_step step2"></span>
                            重置密码
                        </li>
                    </ul>
                    <div class="form_body reset-1" data-view="phoneFindStep1">
                        <div class="input_item clearfix"  style="display: block;" id="phone-form">
                            {{--<span class="area_code">0086</span>--}}
                            {{--<div class="area_code_list" style="display: none;">--}}
                                {{--<dl class="code_list_main"><dt>常用</dt><dd>中国<span>0086</span></dd><dd>中国香港<span>00852</span></dd><dd>中国台湾<span>00886</span></dd><dd>中国澳门<span>00853</span></dd><dd>美国<span>001</span></dd><dt>A</dt><dd>澳大利亚<span>0061</span></dd><dd>中国澳门<span>00853</span></dd><dt>B</dt><dd>巴西<span>0055</span></dd><dt>D</dt><dd>德国<span>0049</span></dd><dt>E</dt><dd>俄罗斯<span>007</span></dd><dt>F</dt><dd>法国<span>0033</span></dd><dt>H</dt><dd>韩国<span>0082</span></dd><dt>J</dt><dd>加拿大<span>001</span></dd><dt>M</dt><dd>马来西亚<span>0060</span></dd><dd>美国<span>001</span></dd><dt>R</dt><dd>日本<span>0081</span></dd><dt>T</dt><dd>中国台湾<span>00886</span></dd><dd>泰国<span>0066</span></dd><dt>X</dt><dd>中国香港<span>00852</span></dd><dd>新加坡<span>0065</span></dd><dt>Y</dt><dd>印度<span>0091</span></dd><dd>英国<span>0044</span></dd><dt>Z</dt><dd>中国<span>0086</span></dd></dl>--}}
                                {{--<p class="tips">如果没有找到您的所在归属地，请拨打客服电话4006282835解决。</p>--}}
                            {{--</div>--}}
                            <input type="text" class="input input_white" id="phone" name="tel" placeholder="请输入注册时使用的手机号" data-required="required" autocomplete="off">
                        </div>
                        {{--<div class="input_item clearfix"  style="display: block;">--}}
                            {{--<div class="input_group clearfix">--}}
                                {{--<input type="text" class="input input_white left" name="" placeholder="请证明你不是机器人" data-required="required" autocomplete="off">--}}
                                {{--<img src="https://passport.lagou.com/vcode/create?from=register&amp;refresh=1517301289576" alt="点击重试" class="yzm" width="98" height="40">--}}
                                {{--<a rel="nofollow" href="javascript:;" class="reflash"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="input_item clearfix"  style="display: block;" id="phone-verify-code--holder">
                            <div class="input_group clearfix">
                                <input type="text" class="input input_white first_child" id="phone-verify-code" name="verify-code" placeholder="请输入短信验证码" data-required="required" autocomplete="off">
                                <input type="button" class="btn btn_active btn_lg last_child" id="send-SMS" value="获取验证码" data-required="required">
                            </div>
                        </div>
                        {{--<div class="input_item verify_tips"  style="display: block;">--}}
                            {{--<p class="verify_tips_main">收不到短信？请使用--}}
                                {{--<input type="button" class="auto_phone" value="语音验证">--}}
                            {{--</p>--}}
                            {{--<p class="verify_tips_count_down">语音发送成功</p>--}}
                        {{--</div>--}}
                        
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="button" class="btn btn_green btn_active btn_block next-step" value="找回密码">
                        </div>
                    </div>
                    <div class="form_body reset-2" style="display:none" data-view="phoneFindStep2">
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="password" class="input input_white" id="password" name="password" placeholder="请输入新密码 " data-required="required" autocomplete="off">
                        </div>
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="password" class="input input_white" id="conform-password" name="passwordConfirm" placeholder="请再次输入密码" data-required="required" autocomplete="off">
                        </div>
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="button" class="btn btn_green btn_active btn_block next-step"  value="确定">
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
                    <ul class="form_head clearfix">
                        <li class="active left" id="step1">
                            <span class="icon_step step1"></span>
                            验证邮箱地址
                        </li>
                        <li class="line right" id="step2-mail">
                            <span class="icon_step step2"></span>
                            重置密码
                        </li>
                    </ul>
                    <div class="form_body reset-1" data-view="emailFindStep1" style="display: block;" id="email-form">
                        <div class="input_item clearfix"  style="display: block;">
                            <input type="text" class="input input_white" id="email" name="mail" placeholder="请输入注册时使用的邮箱地址" data-required="required" autocomplete="off">
                        </div>
                        {{--<div class="input_item clearfix"  style="display: none;">--}}
                            {{--<div class="input_group clearfix">--}}
                                {{--<input type="text" class="input input_white" name="" placeholder="请证明你不是机器人" data-required="required" autocomplete="off">--}}
                                {{--<img src="" alt="点击重试" class="yzm" width="98" height="40">--}}
                                {{--<a rel="nofollow" href="javascript:;" class="reflash"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="input_item clearfix"  style="display: block;" id="email-verify-code--holder">
                            <div class="input_group clearfix">
                                <input type="text" class="input input_white first_child" id="email-verify-code" name="verify-code"
                                       placeholder="请输入邮箱验证码" data-required="required" autocomplete="off">
                                <input type="button" class="btn btn_active btn_lg last_child" id="send-email" value="发送验证码邮件" data-required="required">
                            </div>
                        </div>

                        <div class="input_item clearfix"  style="display: block;">
                            <input type="button" class="btn btn_green btn_active btn_block next-step" value="找回密码">
                        </div>
                    </div>
                    <div class="form_body reset-2" style="display: none;">
                        <div class="input_item clearfix">
                            <input type="password" class="input input_white" id="password-mail" name="password-mail" placeholder="请输入新密码" data-required="required" autocomplete="off">
                        </div>
                        <div class="input_item clearfix">
                            <input type="password" class="input input_white" id="conform-password-mail" name="passwordConfirm-mail" placeholder="请再次输入新密码" data-required="required" autocomplete="off">
                        </div>
                        <div class="input_item clearfix">
                            <input type="button" class="btn btn_green btn_active btn_block next-step" value="确定" >
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
       var currentStep = 1;
       var uid;
       var type = 0;//0手机找回密码  1邮箱找回密码

       $(document).ready(function(){
           $phoneVerifyCode = $("#phone-verify-code");
           $phoneVerifyCode.prop("disabled", true);

           $emailVerifyCode = $("#email-verify-code");
//           $emailVerifyCode.prop("disabled", true);

           $step2 = $(".reset-1");
           $step3 = $(".reset-2");

           $(".area_code").click(function(){
               $(".area_code_list").toggle();
           });
           $(".go_mail").click(function(){
               $("#findPwd1").hide();
               $("#findPwd2").show();
               type = 1;
               currentStep =1;
           });
           $(".go_phone").click(function(){
               $("#findPwd1").show();
               $("#findPwd2").hide();
               type = 0;
               currentStep =1;
           })
       });
       $("#send-SMS").click(function () {
           var phone = $('#phone');

           if (phone.val() === '') {
               swal("","手机号不能为空","error");
               return;
           } else if (phone.is(":visible") && !/^1[34578]\d{9}$/.test(phone.val())) {
               swal("","手机号格式不正确","error");
               return;
           } else {
               var form_data = new FormData();
               form_data.append('tel', phone.val());
               $.ajax({
                   url: "/account/findPassword/0",
                   dataType: 'text',
                   cache: false,
                   contentType: false,
                   processData: false,
                   type: "post",
                   data: form_data,
                   success: function (data) {
                       console.log(data);
                       var result = JSON.parse(data);

                       if (result.status === 200) {
                           swal({
                               type: "success",
                               title: "短信验证码已发送",
                               confirmButtonText: "关闭"
                           });
                           uid = result.uid;
                           $phoneVerifyCode.prop("disabled", false);
                           $phoneVerifyCode.focus();
                           countDown(this, 60);
                       } else {
                           swal({
                               type: "error",
                               title: result.msg,
                               confirmButtonText: "关闭"
                           });
                       }
                   },
                   error: function (xhr, ajaxOptions, thrownError) {
                       swal(xhr.status + "：" + thrownError);
                       //checkResult(400, "", xhr.status + "：" + thrownError, null);
                   }
               })

           }

       });

       $("#send-email").click(function () {
           var email = $("#email");

           if (email.val() === '') {
               swal("","邮箱不能为空","error");
               return;
           } else if (email.is(":visible") &&
                   !/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
               swal("","请输入格式正确的邮箱","error");
               return;
           }
           var form_data = new FormData();
           form_data.append('email', email.val());
           countDown(this, 60);
           $.ajax({
               url: "/account/findPassword/0",
               dataType: 'text',
               cache: false,
               contentType: false,
               processData: false,
               type: "post",
               data: form_data,
               success: function (data) {
                   console.log(data);
                   var result = JSON.parse(data);

                   if (result.status === 200) {
                       swal({
                           type: "success",
                           title: "验证码已发送至您的邮箱",
                           confirmButtonText: "关闭"
                       });
                       uid = result.uid;
                       $emailVerifyCode.prop("disabled", false);
                       $emailVerifyCode.focus();
                   } else {
                       swal({
                           type: "error",
                           title: result.msg,
                           confirmButtonText: "关闭"
                       });
                   }
               },
               error: function (xhr, ajaxOptions, thrownError) {
                   swal(xhr.status + "：" + thrownError);
                   //checkResult(400, "", xhr.status + "：" + thrownError, null);
               }
           })

       });

       function countDown(obj, second) {

           // 如果秒数还是大于0，则表示倒计时还没结束
           if (second >= 0) {
               // 获取默认按钮上的文字
               if (typeof buttonDefaultValue === 'undefined') {
                   buttonDefaultValue = obj.defaultValue;
               }
               // 按钮置为不可点击状态
               obj.disabled = true;
               // 按钮里的内容呈现倒计时状态
               obj.value = buttonDefaultValue + ' (' + second + ')';
               // 时间减一
               second--;
               // 一秒后重复执行
               setTimeout(function () {
                   countDown(obj, second);
               }, 1000);
               // 否则，按钮重置为初始状态
           } else {
               // 按钮置未可点击状态
               obj.disabled = false;
               // 按钮里的内容恢复初始状态
               obj.value = buttonDefaultValue;
           }
       }

       $(".next-step").click(function () {
           currentStep++;
           if (currentStep === 2) {//验证验证码是否正确
               var formData = new FormData();
               if (type === 0) {
                   // phone
                   var phone = $("#phone");
                   var phoneCode = $phoneVerifyCode.val();

                   if (phone.val() === '') {
                       swal("","手机号不能为空","error");
                       currentStep--;
                       return;
                   } else if (phone.is(":visible") && !/^1[34578]\d{9}$/.test(phone.val())) {
                       swal("", "手机号格式不正确", "error");
                       currentStep--;
                       return;
                   }

                   if (phoneCode === '') {
                       swal("","验证码不能为空","error");
                       currentStep--;
                       return;
                   } else if(!/\d{6}/.test(phoneCode)){
                       swal("","验证码格式不正确","error");
                       currentStep--;
                       return;
                   }

                   formData.append("tel", phone.val());
                   formData.append("code", phoneCode);

               } else if (type === 1) {
                   // email
                   var email = $("#email");
                   var emailCode = $emailVerifyCode.val();

                   if (email.val() === '') {
                       swal("","邮箱不能为空","error");
                       currentStep--;
                       return;
                   }

                   if (emailCode === '') {
                       swal("","邮箱验证码不能为空","error");
                       currentStep--;
                       return;
                   }

                   formData.append('email', email.val());
                   formData.append('code', emailCode);
                   formData.append('uid', uid);
               }

               $.ajax({
                   url: "/account/findPassword/1",
                   dataType: 'text',
                   cache: false,
                   contentType: false,
                   processData: false,
                   type: "post",
                   data: formData,
                   success: function (data) {
                       var result = JSON.parse(data);

                       if (result.status === 200) {
                           $step2.hide();
                           $("#step2-phone").addClass("active");
                           $("#step2-mail").addClass("active");
                           $step3.fadeIn(500);
                       } else {
                           swal({
                               type: "error",
                               title: "验证码输入错误",
                               confirmButtonText: "关闭"
                           });
                           currentStep--;
                       }
                   },
                   error: function (xhr, ajaxOptions, thrownError) {
                       swal(xhr.status + "：" + thrownError);
                       //checkResult(400, "", xhr.status + "：" + thrownError, null);
                       currentStep--;
                   }
               });
           }
           if (currentStep > 2) {
               if(type === 0){
                   var password = $("#password");
                   var confirmPassword = $("#conform-password");
               }else{
                   var password = $("#password-mail");
                   var confirmPassword = $("#conform-password-mail");
               }

               if (password.val() === '') {
                   swal("", "密码不能为空", "error");
                   currentStep--;
                   return;
               }

               if (confirmPassword.val() === '') {
                   swal("", "再次输入密码", "error");
                   currentStep--;
                   return;
               }

               if (confirmPassword.val() !== password.val()) {
                   swal("", "两次密码输入不一致", "error");
                   currentStep--;
                   return;
               }

               if (uid === null) {
                   console.log("uid is empty");
                   swal({
                       type: "error",
                       title: "内部错误，请重试",
                       confirmButtonText: "关闭"
                   });

                   setTimeout(function () {
                       location.reload();
                   }, 1500);
               }

               var formData2 = new FormData();
               formData2.append("password", password.val());
               formData2.append("uid", uid);

               $.ajax({
                   url: "/account/findPassword/2",
                   dataType: 'text',
                   cache: false,
                   contentType: false,
                   processData: false,
                   type: "post",
                   data: formData2,
                   success: function (data) {
                       var result = JSON.parse(data);

                       if (result.status === 200) {
                           swal({
                               type: "success",
                               title: "密码已重置",
                               confirmButtonText: "关闭"
                           });

                           setTimeout(function () {
                               self.location = '/account/login';
                           }, 1000);
                       } else {
                           currentStep = 2;
                           swal({
                               type: "error",
                               title: "密码重置失败",
                               confirmButtonText: "关闭"
                           });
                       }

                   }
               });
           }
       });


   </script>
@endsection
