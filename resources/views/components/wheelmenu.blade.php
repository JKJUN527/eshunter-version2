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
{{--<a style="display:none;margin-left: 1340px;" class="back_to_top" title="" href="#"></a>--}}
<script type="text/javascript">
    $(".wheel-button").wheelmenu({
        // alert(1);
        trigger: "hover",
        animation: "fly",
        angle: [0, 360]
    });
</script>