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
    </style>
@endsection

<!-- @section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection -->

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
        <div class="emil_alert">
          <span>◆</span>
          <div>亲，如果是企业用户，请填写企业邮箱喔，目前主流企业邮箱服务商腾讯、网易等都提供免费版企业邮箱服务~如仍有问题，请联系客服：021-63339866</div>
        </div>
        <form accept-charset="utf-8">
          <div class="have_phone">
            <div class=" phone_text">
              <div class="form_dv">
                <span>邮箱：</span>
                <input type="text" onkeydown="enterregist()" placeholder="请填写邮箱" value="" name="" class="number bsie7 emil_hrResist">
                <em style="display:none;" class="yes"></em>
              </div>
            </div>
            <div class="baocuo error_msg_1"></div>
            <div class="form_dv form_pos">
              <span>密码：</span>
              <input type="password" class="bsie7 password password_falg hr_password" onkeydown="enterregist()" placeholder="请输入6-16个字符，建议字母加数字的组合" value="" name="">
              
              <input type="text" class="bsie7 text_pos password_falg2 password hr_password2" onkeydown="enterregist()" placeholder="请输入6-16个字符，建议字母加数字的组合">
              <div class="see_password"></div>
            </div>
            <div class="baocuo error_msg_2"></div>
          </div>
          <div class="login_button">
            <input type="button" value="注&nbsp;册" name="" id="btnRegist">
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
      </div>
     
    </div>
  </div>
  <input type="hidden" value="http://www.neipin.comreg.html" id="my_tou_url">


@endsection

@section('footer')
    @include('components.myfooter')
@endsection

@section('custom-script')
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
    // $('.denglu_pages_left input').click(function(){
    //    $(this).css({"border":"1px solid #cddf53"});
    // })
    // $('.denglu_pages_left input').blur(function(){
    //   $(this).css({"border":"1px solid #EBE8E8"});
    // })
    
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
  $('.cuocuo a.sms_repeat').live('click',function(){
    $('.send_yzm').click();
  })

})
function SetFocus() {
    document.getElementById('tbUserName').focus();
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
