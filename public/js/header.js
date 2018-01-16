$(function(){
    // $(".sou_bor").focus(function(){
    //   $(this).addClass('foucus');
    //   $(this).siblings('label').hide();
    // });
    // $('.search_dl label').click(function() {
    //   $(".sou_bor").focus();
    //   $(".sou_bor").addClass('foucus');
    //  $(this).hide();
    // });
    // $(".sou_bor").blur(function(){
    //   var input_zhi=$(this).val();
    //   if(input_zhi==""||input_zhi==null || input_zhi.length==0){
    //     $(this).siblings('label').show();
    //     $(this).removeClass('foucus');
    //   }
    // });
    //下拉导航
    $(".ksnvas").mouseover(function(){
      
      $('.user_names_con').show();
      $('.ksnvas').addClass('ksnvas_active');
      $('.yonghuming i').addClass('active');
      $('.yonghuming em').show();
    });
    $(".ksnvas").mouseleave(function(){
      
      $('.user_names_con').hide();
      $('.ksnvas').removeClass('ksnvas_active');
      $('.yonghuming i').removeClass('active');
      $('.yonghuming em').hide();
    });


    // 淘人才和收简历js暂时存放
      // 搜索部分点击
    $('.outside_search_list li').click(function(){
      $(this).addClass('active').siblings('.active').removeClass('active');
    });

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