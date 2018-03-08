<script src="{{asset('js/jquery.wheelmenu.js')}}" type="text/javascript"></script>
<div class="QQ_each">
  <a class="wheel-button float_qq" href="#wheel" style="opacity: 1;"></a>
  <ul class="wheel" id="wheel">
    <li class="item">
      <a href="#"></a>
    </li>
    <li class="item">
      <a href="#"></a>
    </li>
    <li class="item">
      <a href="#"></a>
    </li>
    <li class="item">
      <a href="#"></a>
    </li>
    <li class="item">
      <a class="bj" href="/position/advanceSearch" target="_blank">寻找<br>工作</a></li>
    <li class="item">
      <a class="wk" href="/position/publish" target="_blank">发布<br>职位</a></li>
    <li class="item">
      <a class="ts" href="/about" target="_blank">联系<br>我们</a></li>
    <li class="item">
      <a href="#"></a>
    </li>
    <li class="item">
      <a href="#"></a>
    </li>
    <li class="item">
      <a href="#"></a>
    </li>
  </ul>
</div>
<a style="display:none;margin-left: 1340px;" class="back_to_top" title="" href="#"></a>
<script type="text/javascript">
    $(".wheel-button").wheelmenu({
        // alert(1);
        trigger: "hover",
        animation: "fly",
        angle: [0, 360]
    });
    $(function(){
      // 返回顶部
      //当滚动条的位置处于距顶部100像素以下时，跳转链接出现，否则消失
      $(window).scroll(function(){
          if ($(window).scrollTop()>200){
              $(".back_to_top").fadeIn(1000);
          }
          else
          {
              $(".back_to_top").fadeOut(1000);
          }
      });
      //当点击跳转链接后，回到页面顶部位置
      $(".back_to_top").click(function(){
          $('body,html').animate({scrollTop:0},20);
          return false;
      });
  });
</script>