$(function(){ 
	var $p_Div=$(".pic_content");
//	var $picDiv=$(".pic_lists");
	var $pDiv_w=$p_Div.width()+12;

	$(".pic_one .right_btn").live('click',function(){
		var picNum=$(this).parent().find("ul").children("li").length;
		var page_count=Math.ceil(picNum/3);
		
		if(page_count>page && page == 1){
			$(this).parent().find(".pic_lists").animate({left:'-'+page*$pDiv_w+"px"},"normal");
			if(page < 2){
				page++;
			}
		} 
		
		if(page == 2){
			$(this).siblings(".left_btn").addClass('left_btn_active'); //strat
			$(this).addClass('right_btn_active');  //stop
		}
		
		$(this).siblings(".highlight_tip").find("span").eq((page-1)).addClass("current").siblings().removeClass("current"); 	
	});
	
	$(".pic_one .left_btn").live('click',function(){
		if(page>1){
			$(this).parent().find(".pic_lists").animate({left:"+="+$pDiv_w+'px'},"normal");
			page--;
			$(this).siblings(".right_btn").removeClass('right_btn_active');  
		}
		
		if(page == 1){
			$(this).removeClass('left_btn_active'); //strat
		}
		$(this).siblings(".highlight_tip").find("span").eq((page-1)).addClass("current").siblings().removeClass("current"); 	
	});	
	
	$(".pic_two .right_btn").live('click',function(){
		var picNum=$(this).parent().find("ul").children("li").length;
		var page_count=Math.ceil(picNum/3);
		
		if(page_count>page2 && page2 == 1){
			$(this).parent().find(".pic_lists").animate({left:'-'+page2*$pDiv_w+"px"},"normal");
			if(page2 < 2){
				page2++;
			}
		} 
		
		if(page2 == 2){
			$(this).siblings(".left_btn").addClass('left_btn_active'); //strat
			$(this).addClass('right_btn_active');  //stop
		}
		
		$(this).siblings(".highlight_tip").find("span").eq((page-1)).addClass("current").siblings().removeClass("current"); 	
	});
	
	$(".pic_two .left_btn").live('click',function(){
		if(page2>1){
			$(this).parent().find(".pic_lists").animate({left:"+="+$pDiv_w+'px'},"normal");
			page2--;
			$(this).siblings(".right_btn").removeClass('right_btn_active');  
		}
		
		if(page2 == 1){
			$(this).removeClass('left_btn_active'); //strat
		}
		$(this).siblings(".highlight_tip").find("span").eq((page-1)).addClass("current").siblings().removeClass("current"); 	
	});	
});
