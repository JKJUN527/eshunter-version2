$(function(){
	$('.seles_choose').live("click",function(event){
      $('.seles_choose').parent().css({"z-index":"0"});
      $(this).parents('li').siblings('li').find('.seles').css({"z-index":"0"});
      
      $(this).parent().css({"z-index":"10"});
      $(this).parents('.edit_list').siblings('.edit_list').find('.seles').css({"z-index":"0"});
      $('.show_label').slideUp();
      $('.labels_con').hide();
      // 处理发布职位bug
      $(this).parents('.publish_list').siblings('.publish_list').find('.labels_con').hide();
      
      var e=window.event || event;
      if(e.stopPropagation){
       e.stopPropagation();
      }else{
       e.cancelBubble = true;
      }  
      $('.seles_hide').hide();
      $(this).parent().children('.seles_hide').show();
      e.stopPropagation;
    });
    
    $('.seles_hide').live("click",function(event){  
    	if(document.getElementById("p_node") 
    			&& document.getElementById("p_node") != undefined 
    			&& document.getElementById("p_node")!=""
    			&& document.getElementById("p_node") != null)
		{
    		 var allNodes = document.getElementById("p_node").getElementsByTagName("li");
        	 for(var i = 0;i<allNodes.length ;i++){
        			if(event.target == allNodes.item(i) || event.target == allNodes.item(i).firstChild){
        	        	return;
        	      }
        	 }
		}
    	
          var e=window.event || event;
        
          if(e.stopPropagation){
               e.stopPropagation();
          }else{
              e.cancelBubble = true;
          }  
    })

     $(document).bind("click",function(e){
      var target  = $(e.target);
      if(target.closest(".seles_choose").length == 0){
       // $(".labels_con").hide();
       $('.lala').parents('li').siblings('li').find('.seles').removeClass('ie_index');
       $('.w_520_pos').removeClass('ie_index');
       $('.w_520_pos').css({"z-index":"0"});
       
       $('.keys').slideUp();
       $('.gsmc_la ul').slideUp();
       $('.seles_hide').hide();
       
       if(target.closest(".qita_input").length == 0){
    	   $('.seles').removeClass('seles_greenborder');
	       $('.seles_choose').removeClass('seles_choose_green');
       }
      }
     // 处理期望职位下拉后出发点击空白事件
      if(target.closest(".lala").length == 0){
       $(".labels_con").hide();
       $('.tab_list').slideUp();
      }
      
      // 发布职位的职位诱惑的下拉
      if(target.closest("#jobBiaoqian").length == 0){
        $('#jobBiaoqian').removeClass('seles_greenborder');
        $('.show_label').slideUp();
      }
     })

     //下拉里点击项目
     $('.seles_hide li').live("click",function(){
      
      $('.seles_hide').hide();
      // $('.qtss').hide();
      $('.dqzt').hide();
      
      if($(this).parent().hasClass('default_jianli')){
 		 return;
 	 }
      
      $(this).parent().siblings('.seles_choose').text($(this).text());
      if(typeof($(this).attr("v")) == "undefined")
      {
    	  $(this).parent().siblings('.input_hide').val($(this).text());
      }
      else
      {
    	  $(this).parent().siblings('.input_hide').val($(this).attr('v'));
      }
      $(this).parent(".seles_hide").siblings(".seles_choose").addClass("colors");
    })
     $('.seles_hide_city li').live("click",function(){
       $('.qita_input').hide();
      

     })
    $('.seles_hide li.eee').live("click",function(){
      $('.qita_input').show().focus();
    })
    
    // 期望领域
    $('.lingyu div').live('click',function(){
  	    var lingyuCon = $(this).parents('.labels_con').siblings('.lingyu_shuru').text().replace(/(^\s*)|(\s*$)/g,"");
  	    var lingyuCd = $(this).parent().siblings('.input_hide').val();
  	    var str = lingyuCon.split(" ");
    	var cd = lingyuCd.split(",");
  	    if($(this).hasClass("gaga") && cd.length >= 3 && !$(this).hasClass('addcss')){
  	    	$('#lingyu_msg').show();
  	    	$('#lingyu_msg').text("最多只能选择三个");
  	    	return;
  	    }else{
  	    	$('#lingyu_msg').hide();
  	    	$('#lingyu_msg').text("");
  	    }
  	    var thisCon =$(this).text();
	    var thisCd = $(this).attr("id");
	    $(this).toggleClass('addcss');
  	    if(lingyuCon == "期望领域" || lingyuCon == "公司领域" || lingyuCon == "" || lingyuCon == "请选择公司领域,可多选" || lingyuCon == "请选择公司标签,可多选"){
  	    	$(this).parents('.labels_con').siblings('.lingyu_shuru').text("");
  	    	$(this).parents('.labels_con').siblings('.lingyu_shuru').text(thisCon);
  	    	$(this).parent().siblings('.input_hide').val(thisCd);
  	    }else{
  	    	var str2="";
  	    	var cd2="";
  	    	var flag = 0;
  	    	for(var i=0;i<str.length;i++){
  	    		if(str[i] != "" && str[i] == thisCon){
  	    			flag = 1;
  	    			continue;
  	    		}else{
  	    			if(str2 == ""){
  	    				str2 = str[i];
  	    				cd2 = cd[i];
  	    			}else{
  	    				str2 = str2 + " " + str[i];
  	    				cd2 = cd2 + "," + cd[i];
  	    			}
  	    		}
  	    	}
  	    	if(flag == 0){
  	    		lingyuCon = str2 + " " + thisCon;
  	    		lingyuCd = cd2 + "," + thisCd;
  	    	}else{
  	    		lingyuCon = str2;
  	    		lingyuCd = cd2;
  	    	}
  	    	if(lingyuCon == ""){
  	    		//lingyuCon="";
  	    		lingyuCd = "";
  	    	}
  	    	$(this).parents('.labels_con').siblings('.lingyu_shuru').text(lingyuCon);
  	    	$(this).parent().siblings('.input_hide').val(lingyuCd);
  	    }
    });
	
	
	  // 期望职位
	  $('.seles_xiala').live('click',function(){
	    $(this).find('.labels_con').show();
	  });

    
})