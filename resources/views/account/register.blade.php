@extends('layout.master')
@section('title', '注册')

@section('custom-style')
    <link media="all" href="{{asset('../style/sub.css?v=2.39')}}" type="text/css" rel="stylesheet">
    <style>
        #header{height:auto;}
        #layout{
                background-color: #242d3c;
        }
        .denglu_pages_left input{
          width: 375px;
          height:24px;
        }
        .see_password{
          right:34px;
        }
        .denglu_pages_right p.use-register a{
          color: #03A9F4;
        }
        .denglu_pages_right p{
          line-height: 20px;
          font-size: 16px;
        }
        .per-com-res input{
          width: 30px;
    float: unset;
    vertical-align: middle;
        }
        .sms #send-SMS{
              width: 121px!important;
    font-size: 17px!important;
    margin-top: 0;
    margin-left: 4px;
        }
        .sms #register-verify-code{
          width: 249px!important;
        }
       .denglu_pages{
        margin-bottom: 20px;
       }
    </style>
@endsection

{{--@section('header-nav')--}}
    {{--@if($data['uid'] === 0)--}}
        {{--@include('components.headerNav', ['isLogged' => false])--}}
    {{--@else--}}
        {{--@include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])--}}
    {{--@endif--}}
{{--@endsection--}}

@section('content')

    <div class="body_center">
    <div class="logo_con">
      <div class="logo_conCenter">
        <a href="/"><img alt="" src="../images/logo-white.png" height="50"></a>
        <span style="padding-left:10px;font-size:12px;color:#999;display: inline-block;border:none;margin-top: 20px;margin-left: 0;">电竞猎人 - 做专业的竞技游戏职业招聘网站</span>
        <span>注册</span>
      </div>
    </div>
    <div class="denglu_pages">
      <div class="denglu_pages_left left">
        <!-- <div class="emil_alert">
          <span>◆</span>
          <div>亲，如果是企业用户，请填写企业邮箱喔，目前主流企业邮箱服务商腾讯、网易等都提供免费版企业邮箱服务~如仍有问题，请联系客服：021-63339866</div>
        </div> -->
        <form accept-charset="utf-8">
          <div class="have_phone">
            <div class=" phone_text phone">
              <div class="form_dv">
                <span>手机号：</span>
                <input type="text" id="phone" onkeydown="enterregist()" placeholder="请填写手机号" value="" name="" class="number bsie7 phone_hrResist">
                
                <div for="phone" class="baocuo error error_msg_1" style="display: inline-block;width: 60%;"></div>
              </div>
            </div>
            <div class=" phone_text email" style="display: none;">
              <div class="form_dv">
                <span>邮箱：</span>
                <input type="text" onkeydown="enterregist()" placeholder="请填写邮箱" value="" name="" class="number bsie7 emil_hrResist" id="email">
                
                <div for="email" class="baocuo error error_msg_1" ></div>
              </div>
            </div>

            <div class="form_dv sms" id="phone-verify-code">
                <span>验证码：</span>
                <input type="text" id="register-verify-code" name="verify-code" class="form-control" placeholder="验证码..." disabled="">
                <input type="button" id="send-SMS" value="发送验证码" class="mdl-button mdl-js-button mdl-button-default button-border" data-upgraded=",MaterialButton">
                
                <div for="register-verify-code" class="baocuo error error_msg_sms" style="display: inline-block;width: 60%;"></div>
            </div>
            <div class="form_dv form_pos">
              <span>密码：</span>
              <input type="password" class="bsie7 password password_falg hr_password" onkeydown="enterregist()" placeholder="请输入6-16个字符，建议字母加数字的组合" value="" name="" id="password">
              
              <input type="text" class="bsie7 text_pos password_falg2 password hr_password2" onkeydown="enterregist()" placeholder="请输入6-16个字符，建议字母加数字的组合">
              <!-- <div class="see_password"></div> -->
            </div>
            
            <div for="password" class="baocuo error error_msg_2"></div>
          </div>
          <div class="form_dv form_pos">
              <span>确认密码：</span>
              <input type="password" class="bsie7  password_falg hr_password" onkeydown="enterregist()" placeholder="请确认密码" value="" name="" id="conform-password">
              
              <input type="text" class="bsie7 text_pos password_falg2 password hr_password2" onkeydown="enterregist()" placeholder="请确认密码">
              <!-- <div class="see_password"></div> -->
            
            
            <div for="conform-password" class="baocuo error error_msg_3"></div>
          </div>
          <div class="login_button per-com-res">
              <input name="type" type="radio" id="personal" class="radio-col-light-blue" value="1" checked="">
              <label for="personal">个人用户注册</label>&nbsp;&nbsp;&nbsp;&nbsp;
              <input name="type" type="radio" id="enterprise" class="radio-col-light-blue" value="2">
              <label for="enterprise">企业用户注册</label>
          </div>
          <div class="login_button">
            <input type="button" value="注&nbsp;册" name="" id="register-btn">
            <div style=" padding-top:15px;" class="zidong">
              <div style="width:100%; margin-left:0;" class="left">
              <span class="zidong_choose">
                <i style="height:19px;margin-right:1px;" id="xieyi_label" class="add_i"></i>
                <label for="mm">我已阅读并同意</label>
              </span>
              <a style="color: #17b385; float: none; margin-right:0px;" target="_blank" href="/account/privacy">《电竞猎人用户协议》</a>
              </div>
            </div>
          </div>
        </form>
        
      </div>
      <div class="denglu_pages_right right" id="">
        <div class="zhuce">已有账号直接登录</div>
        <div class="zhuce"><a title="" href="/account/login">登录</a></div>
        <p class="use-type">你还可以使用<span>邮箱</span>来注册 esport hunter</p>
        <p class="use-register">
            <a for="phone-form" onclick="switchRegisterType(this,0)" style="display: none;">使用手机号注册</a>
            <a for="email-form" onclick="switchRegisterType(this,1)" >使用邮箱注册</a>
        </p>
      </div>
     
    </div>
  </div>
  <input type="hidden" value="http://www.neipin.comreg.html" id="my_tou_url">


@endsection

@section('footer')
    @include('components.myfooter')
@endsection

@section('custom-script')
<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script type="text/javascript">
        var registerType = 0; //0:phone; 1:email;

        $registerForm = $("#register-form");
        $registerVerifyCode = $("#register-verify-code");

        $("#email-form").hide();
        $("a[for='phone-form']").hide();
        $registerVerifyCode.prop("disabled", true);

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        function switchRegisterType(type) {
            if (type === 0) {
                $("a[for='phone-form']").hide();
                $("a[for='email-form']").fadeIn(500);
                $("#email-form").hide();
                $("#phone-form").fadeIn(500);
                $("#phone-verify-code").fadeIn(500);
                $("#phone").val("");
                registerType = 0;
            } else if (type === 1) {
                $("a[for='phone-form']").fadeIn(500);
                $("a[for='email-form']").hide();
                $("#email-form").fadeIn(500);
                $("#phone-form").hide();
                $("#phone-verify-code").hide();
                $("#email").val("");
                registerType = 1;
            }
        }
function setError(element, forStr, errorStr) {
    element.parent().addClass('error');
    $(".error[for='" + forStr + "']").html(errorStr);
    element.focus();
}

function removeError(element, forStr) {
    element.parent().removeClass('error');
    $(".error[for='" + forStr + "']").html("");
}
        //        $registerForm.find(".email").inputmask({alias: "email"});
        //        $registerForm.find(".phone").inputmask('99999999999', {placeholder: '___________'});

        $("#send-SMS").click(function () {
            var phone = $('#phone');

            if (phone.is(":visible") && phone.val() === '') {
              // $('.error_msg_1').text('不能为空')
                setError(phone, 'phone', '不能为空');
                return;
            } else if (phone.is(":visible") && !/^1[34578]\d{9}$/.test(phone.val())) {
                setError(phone, 'phone', '手机号格式不正确');
                // $('.error_msg_1').text('手机号格式不正确')
                return;
            } else {
              // $('.error_msg_1').text('')
                removeError(phone, 'phone');
            }

            var form_data = new FormData();
            form_data.append('telnum', phone.val());

            sendSmsBtn = this;
            swal({
                title: phone.val(),
                text: "将发送短信验证码到此手机号",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/account/sms",
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
                            swal("短信验证码已发送");

                            // 倒计时30秒
                            countDown(sendSmsBtn, 30);

                            $registerVerifyCode.prop("disabled", false);
                            $registerVerifyCode.focus();
                        } else if (result.status === 400) {
                            swal(result.msg);
                        }
                    }
                });
            });
        });


        $("#register-btn").click(function (event) {
            event.preventDefault();

            var phone = $('#phone');
            var email = $('#email');
            var code = $('#register-verify-code');
            var pwd = $('#password');
            var conformPwd = $('#conform-password');
            var type = $("input[name='type']:checked");

            if (phone.is(':visible') && phone.val() === '') {
                setError(phone, 'phone', '不能为空');
                return;
            } else {
                removeError(phone, 'phone');
            }

            if (code.is(':visible') && code.val() === '') {
                setError(code, 'register-verify-code', '不能为空');
                return;
            } else {
                removeError(code, 'register-verify-code');
            }

            if (email.is(':visible') && email.val() === '') {
                setError(email, 'email', '不能为空');
                return;
            } else if (email.is(':visible') &&
                !/^[0-9a-z][_.0-9a-z-]{0,31}@([0-9a-z][0-9a-z-]{0,30}[0-9a-z]\.){1,4}[a-z]{2,4}$/.test(email.val())) {
                setError(email, 'email', '邮箱格式不正确');
                return;
            } else {
                removeError(email, 'email')
            }

            if (pwd.val() === '') {
                setError(pwd, 'password', '不能为空');
                return;
            } else if (pwd.val().length < 6 || pwd.val().length > 60) {
                setError(pwd, 'password', '密码至少6位，至多60位');
                return;
            } else {
                removeError(pwd, 'password');
            }

            if (conformPwd.val() === '') {
                setError(conformPwd, 'conform-password', '不能为空');
                return;
            } else if (pwd.val() !== conformPwd.val()) {
                setError(conformPwd, 'conform-password', '两次密码输入不一致');
                return;
            } else {
                removeError(conformPwd, 'conform-password');
            }

            var formData = new FormData();
            if (registerType === 0) {
                formData.append("phone", phone.val());
                formData.append("code", code.val());
            }

            if (registerType === 1)
                formData.append("email", email.val());

            formData.append("password", pwd.val());
            formData.append("type", type.val());

            console.log("type: " + type.val());

            if (registerType === 1) {
                swal({
                    title: email.val(),
                    text: "确定使用该邮箱注册吗",
                    type: "info",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                }, function () {

                    $.ajax({
                        url: "/account/register",
                        type: "post",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            var result = JSON.parse(data);
                            if (result.status === 200) {
                                swal({
                                    title: "注册成功",
                                    text: "激活邮件已发送到邮箱：" + email.val() + "\n一周之内有效，请尽快激活!",
                                    confirmButtonText: "返回登录页面"
                                }, function () {
                                    self.location = "/account/login";
                                });

                            } else if (result.status === 400) {
                                swal(result.msg);
                            }
                        }
                    })
                });
            } else if (registerType === 0) {
                $.ajax({
                    url: "/account/register",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        if (result.status === 200) {
                            swal({
                                title: "注册成功",
                                text: "点击确定立即登录",
                                type: "info",
                                confirmButtonText: "确定",
                                closeOnConfirm: false
                            }, function () {
                                self.location = "/account/login";
                            });
                        } else if (result.status === 400) {
                            swal(result.msg);
                        }
                    }
                })
            }

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
        if($('#user_agreeent').attr('checked')){
            $('#register-btn').attr('disabled',false)
        }
        $('#user_agreeent').click(function () {
            var chk = $("#user_agreeent");
            var checked = chk.is(':checked');
            if (checked) {
                $('#register-btn').attr('disabled',false)
            } else {
                $('#register-btn').attr('disabled',true)
            }
        });
    </script>
    <script type="text/javascript">
    var my_tou="1";
    var ukbn = "1";
    var password_flag = 1;//0 明文显示密码  1 隐藏显示密码
    var my_tou="1";
    var regist_flag = 0;
</script>
<script src="{{asset('js/regist.js?v=2.35')}}"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('.shibie').click(function(event) {  
        var e=window.event || event;
        if(e.stopPropagation){
         e.stopPropagation();
        }else{
         e.cancelBubble = true;
        }        
         $('.imgHide').show();
    });
    $('.imgHide').click(function(event) {
       var e=window.event || event;
    if(e.stopPropagation){
         e.stopPropagation();
      }else{
         e.cancelBubble = true;
      }
    });
    document.onclick = function(){
      $(".imgHide").hide();
    };

  // 重新获取短信验证码
  $('.cuocuo a.sms_repeat').on('click',function(){
    $('.send_yzm').click();
  })
  $('#xieyi_label').on('click',function(){
    if ($(this).hasClass('add_i')) {
      $('#btnRegist').removeAttr('disabled').css('background-color', '#eee');
    }else{
      $('#btnRegist').attr('disabled','disabled').css('background-color', '#17b385');
    }
    
  })
})
function SetFocus() {
    document.getElementById('tbUserName').focus();
}
function switchRegisterType(e,a){
      $(e).hide().siblings().show()
      if (a===0) {
        $('.use-type span').text('邮箱')
        $('.have_phone .phone,.sms').show().siblings('.have_phone .email').hide()

      }else{
        $('.use-type span').text('手机号')
        $('.have_phone .phone,.sms').hide().siblings('.have_phone .email').show()
      }
    }
function checkEnter(event) {
  if (event.keyCode == 13) {
    if (document.getElementById("tbPassword").value == '') {
       document.getElementById("tbPassword").focus();
       return false;
    }
  }
         return true;
}     
</script>
@endsection
