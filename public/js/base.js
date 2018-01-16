$(function(){
    $('.spend_none').click(function(){
      $('#spend_con').hide();
      $('.hsbj').hide();
    })
  $('.spendno_btn').click(function(){
      $('#yebz').hide();
      $('.hsbj').hide();
    })
  $('.close_X').live("click",function(){
    $('.cuowutishi').hide();
    $('.tishiwanshan').hide();
    $('.tishiwanshan').hide();
    $('.tishiwanshan_put').hide();
    $('.tishi').hide();
    $('.tishis').hide();
  });
    /*
     * 关闭错误提醒的
     */
	$('.close_X_1').live("click",function(){
        $('.cuowutishi').hide();
	});
  // 文本框
  $('.input_test').each(function(i) {
    var h = $('.input_test').eq(i).val();
    $('.input_test').bind({

      focus:function(){
        var _this = $(this);
        if(_this.val() == h){        
          _this.val('');                 
        }
      },
      blur:function(){
        var _this = $(this);
        if(_this.val() == ''){
          // _this.val(h); 
                 
        }
      }
    })     
  });
  // 电话验证
  $('.phone_number').focus(function() {
    $(this).css({"border":"1px solid #cddf53"})
    setTimeout(function(){$('.alerts').remove()},4000);
  });
  // 电话号码验证
  $('.phone_number').blur(function() {
    var nums = $(this).val(); 
    var len = $(this).length;
    if(nums == ''||len==0)
    {
      var m = $(this).parent().siblings().children('span').text();
      // $(this).parent().append("<div class='alerts' style='top:25px; left:265px;'>提示：\n\n请输入"+m);
      $(this).css({"border":"1px solid #c33838"});
      
          return false;
    } 
    if(telephone_ce(nums)==false&&dian(nums)==false){
      var m = $(this).parent().siblings().children('span').text();
        // $(this).parent().append("<div class='alerts' style='top:25px; left:265px;'>提示：\n\n格式不对"+m);
        $(this).css({"border":"1px solid #c33838"})
            return false;
    }
    else{
      $(this).css( {"border":"1px solid #a2d89e"});
      return false;
    };
  });
  // 右侧提示
    $('.ceshi').each(function(i){
      $(this).click(function(){
        $(this).css({"border":"1px solid #cddf53"})
        setTimeout(function(){$('.alerts').remove()},4000);
      })

      $(this).blur(function(){
        var gs_con = $(this).val();    
        if(gs_con == "")
        {
          var m = $(this).parent().siblings().children('span').text();
          // alert(m);
          // $(this).parent().append("<div class='alerts' style='top:25px; left:265px;'>提示：\n\n请输入"+m);
          $(this).css({"border":"1px solid #c33838"})
            return false;
        }

        if(gs_con !== "")
          {
            
            $(this).css({"border":"1px solid #a2d89e"})
              return false;
          }
        }) 
    })
    // 邮箱验证    
    $(".youxiang").click(function(){
      $(this).css({"border":"1px solid #cddf53"});
      setTimeout(function(){$('.alerts').remove()},4000);
    })
    $(".youxiang").blur(function(){
      var mail = $(".youxiang").val();     
      
      var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
           if(mail==""){ 
            var m = $(this).parent().siblings().children('span').text();            
            // $(this).parent().append("<div class='alerts' style='top:22px; left:265px;'>提示：\n\n请输入"+m);
            $(this).css({"border":"1px solid #c33838"});
            $(this).siblings('.span').css({"margin-left":"190px"});
            return false;
           } 
           
           if(!myreg.test(mail)){           
           var m = $(this).parent().siblings().children('span').text();
            // $(this).parent().append("<div class='alerts' style='top:22px; left:265px;'>提示：\n\n请输入有效的E_mail");
            $(this).css({"border":"1px solid #c33838"})
            $(this).siblings('.span').css({"margin-left":"190px"});
            return false;
           } 
           else
           $(this).css({"border":"1px solid #a2d89e"});
           return false;
           
          
      })  
    //判断密码长度
    $(".passw").click(function(){
      setTimeout(function(){$('.alerts').remove()},4000);
    });
    $(".passw").blur(function(){
      var ps = $(".passw").val();
      var s = ps.length;
      if(s<6)
      {
        
        $(this).parent().append("<div class='alerts' style='top:8px; left:265px;'>提示\n\n你的密码不能少于6位!<s><i></i></s></div>");
        return false;
      }
      
    })   

    //判断两次输入密码是否一致
    $(".rpassw").click(function(){
      setTimeout(function(){$('.alerts').remove()},4000);
    })
    $(".rpassw").blur(function(){
      var rps = $(".rpassw").val();
      var ps = $(".passw").val();
      if(rps!=ps)
      {
        $(this).parent().append("<div class='alerts' style='top:8px; left:265px;'>提示：\n\n你两次输入的密码不一致!<s><i></i></s></div>");
        return false;
      }
    })  
    // 职位详情
    $('.text_area').click(function(){
      $(this).css({"border":"1px solid #cddf53"})
      setTimeout(function(){$('.alerts').hide()},4000);
    })
    $(".text_area").blur(function(){
      var gs_con = $(".text_area").val();   
      if(gs_con == "")
      {
        
        var m = $(this).parent().siblings().children('span').text();
        $(this).parent().append("<div class='alerts' style='top:54px; left:378px;'>提示：\n\n请输入"+m);
        $(this).css({"border":"1px solid #c33838"})
          return false;
      }
      else
        $(this).css({"border":"1px solid #a2d89e"})
        return false;
    })     
   

    $('.seles_hide li').click(function(){
     
      $(this).parent().siblings('.seles_choose').text($(this).text());
      $('.seles_hide').hide();
      $('.qtss').hide();
      $('.dqzt').hide();
      if(typeof($(this).attr("v")) == "undefined")
      {
        $(this).parent().siblings('.input_hide').val($(this).text());
      }
      else
      {
        $(this).parent().siblings('.input_hide').val($(this).attr('v'));
      }
    })
    $('.eee').click(function() {
      $('.qtss').show();
    });


    // 弹出层显示
    $('.close_btn').live('click', function() {
      $('.hsbj').hide();
      $('.jianliyulan').hide();
      $("#frame_yulanjianli").remove();
      $('.tanchu_logo').hide();
      $(".imgareaselect-selection").parent().css({"display":"none"});
      $('.fabu_erweima').hide();
      $(".imgareaselect-outer").css({"display":"none"});
    })

    // 滚轮滚动对关闭按钮和下载按钮定位
    // $('.jianliyulan').scroll(function()
    //   {
    //     $(".load").css("top",$('.jianliyulan').scrollTop()+230+"px");
    //     $(".close_btn").css("top",$('.jianliyulan').scrollTop()+10+"px");
    //   })
    // input获得焦点边框变化
    $('.search_part input').focus(function() {
      
      $(this).css({"border":"1px solid #a2d89e"})
    });

    $('.lv').focus(function() {
      $(this).css({"border":"1px solid #a2d89e"})
    });


    // 停止滚轮滚动
  var canScroll = true;
  var showLayer = function() {
    $("body").addClass("overflow");
    $(".jianliyulan").show();
      canScroll = false;
  };

  var hideLayer = function() {
    $("body").removeClass("overflow");
    $(".jianliyulan").hide();
      canScroll = true;
  };

  var scrollEvent = function(event){
      if( !canScroll ) {
          event.preventDefault();
          event.stopPropagation(); 
      }
  }

  $(".tx img").live( "click", showLayer );
  $(".resumes_right_a").live( "click", function(){
	  if($(this).parent().attr("online_jianli") == 1)
	  {
		  return;
	  }
	  else
	  {
		  showLayer();
	  }
  } );

  $(".close_btn").live( "click", hideLayer );
  $(".downloadjianli").live( "click", hideLayer );
  // 鼠标滚轮事件
  $(document).bind('mousewheel', function(event) {
        scrollEvent(event);
  });
})//jq


