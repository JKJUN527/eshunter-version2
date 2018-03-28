@extends('layout.master')
@section('title', '登录')

@section('custom-style')
    <link media="all" href="{{asset('../style/sub.css?v=2.39')}}" type="text/css" rel="stylesheet">
    <style>
        #header{height:auto;}
        #layout{
                background-color: #242d3c;
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
        <span>登录</span>
      </div>
    </div>
    
    <div class="denglu_pages">
      <div class="denglu_pages_left left">        
      <script>
        function enterlogin()
             {       
                var event = window.event || arguments.callee.caller.arguments[0];
                if (event.keyCode == 13)
                {
                    document.getElementById("btnRegist").click();
                }
             }     
      </script>
        <form style="width:100%; overflow:hidden;" accept-charset="utf-8">
          <input type="text" class="bsie7" onkeydown="enterlogin()" placeholder="手机号/邮箱" value="" name="" id="tbUserName">
          <div style="text-indent:5px;" class="baocuo username_msg"></div>
          <input type="password" class="bsie7" onkeydown="enterlogin()" placeholder="密码" value="" name="" id="tbPassword">
          <div style="text-indent:5px;" class="baocuo password_msg"></div>
          <div class="zidong">
            <div style="width:100px; overflow:hidden;" class="left zidong_choose">              
              <!-- <input type="checkbox" name="" value="" id="mm" /> -->
              <i></i>
            <label for="mm">自动登录</label>
            </div>
            <a title="" href="/account/findPassword">忘记密码?</a>
          </div>
          <input type="button" value="登&nbsp;录" name="" id="btnRegist">
        </form>
      </div>
      <div class="denglu_pages_right right" id="">
        <div class="zhuce">还没有账号？</div>
        <div class="zhuce"><a title="" href="/account/register">立即注册</a></div>
        <!-- <div class="zhijie_dl">使用以下账号登录</div>
        <div class="denglu_for">
          <a title="" href="https://api.weibo.com/oauth2/authorize?client_id=3301819272&amp;redirect_uri=http://www.neipin.com/job/sinaLogin&amp;response_type=code"><img alt="" src="images/weibo.png?v=20150609"><span>微博登录</span></a>
          <a title="" href="http://www.neipin.com/job/qtoken"><img class="Qq" alt="" src="images/qq1.png?v=20150609"><span>QQ登录</span></a>
        </div> -->
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

//  if($.browser.msie) {
//    if($('#tbPassword').val()!=='')
//     {
//      $("#pwdPlaceholder").hide();
//      $('#tbPassword').show();
//
//      }
//    }
  // 鼠标获得焦点边框变色
    // $('.bsie7').click(function(){

    //    $(this).css({"border":"1px solid #cddf53"})

    // })
    // $('.bsie7').blur(function(){

    //   $(this).css({"border":"1px solid #EBE8E8"})
    // })

    $('.zidong_choose').click(function(){
      $(this).find('i').toggleClass('add_i');
    });

    $("#btnRegist").click(function(){
        $(".baocuo").html("");
        var param = new Object();
        param.emailAddr = $("#tbUserName").val();
        param.passwd = $("#tbPassword").val();
        param.zidong = 0;
        if($('.zidong').find('i').hasClass('add_i')){
            param.zidong = 1;
        }
        var flag = 0;
        if(param.emailAddr == "手机号/邮箱" || param.emailAddr.replace(/(^\s*)|(\s*$)/g,"") == "")
        {
            //$(".username_msg").show();
            $(".username_msg").html("请填写手机号/邮箱");
            flag = 1;
        }else{
            //$(".username_msg").hide();
            $(".username_msg").html("");
        }
        if(param.passwd == "密码" || param.passwd.replace(/(^\s*)|(\s*$)/g,"") == "")
        {
            //$(".password_msg").show();
            $(".password_msg").html("请填写密码");
             flag = 1;
        }else{
            //$(".password_msg").hide();
            $(".password_msg").html("");
        }
        if(!/^[0-9a-z][_.0-9a-z-]{0,31}@([0-9a-z][0-9a-z-]{0,30}[0-9a-z]\.){1,4}[a-z]{2,4}$/.test(param.emailAddr)
          &&!/^1[34578]\d{9}$/.test(param.emailAddr)
          ){
          $(".username_msg").html("请填写正确的手机号/邮箱");
            flag = 1;
        }    
        if(flag == 1){
           return;        
        }
        var formData = new FormData();
        if(!/^1[34578]\d{9}$/.test(param.emailAddr)){
          formData.append("email", param.emailAddr);
        }else{
          formData.append("phone",  param.emailAddr);
        }
        formData.append("password", param.passwd);
        $.ajax({
                url: "/account/login",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    //console.log(data);
                    var result = JSON.parse(data);
                    // checkResultWithLocation(result.status, "登录成功，正在跳转", result.msg, "/index");
                    if(result.status == 200){
//                      window.location.href="/";
                        window.location.href=document.referrer;
                    }else{
                      $(".username_msg").html(result.msg);
                    }
                    
                }
            });

});

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
           
      
})
</script>
@endsection
