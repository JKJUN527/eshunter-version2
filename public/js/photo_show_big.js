$(function(){ 

	var $p_Div=$(".pop_pic_content");
	var $picDiv=$(".pop_pic_lists");
	var picNum=$picDiv.children("ul").children("li").length;
	// alert(picNum);
	var page_count=Math.ceil(picNum/1);	
	var $pDiv_w=$p_Div.width();
	$(".pop_right_btn").click(function(){
		if(page_count>page3){
			$picDiv.animate({left:'-'+page3*$pDiv_w+"px"},"normal");
			page3++;
			$(".pop_left_btn").addClass('pop_left_btn_active'); //strat
			if(page3>=page_count){
				$(this).addClass('pop_right_btn_active');  //stop
			}else{
				$(this).removeClass('pop_right_btn_active');  
			}
		} 
		$(this).siblings(".highlight_tip").find("span").eq((page3-1)).addClass("current").siblings().removeClass("current"); 	
	});
	
	$(".pop_left_btn").click(function(){
		if(page3>1){
			$picDiv.animate({left:"+="+$pDiv_w+'px'},"normal");
			page3--;
			$(".pop_right_btn").removeClass('pop_right_btn_active');  
			if(page3<=1){
				$(this).removeClass('pop_left_btn_active'); //stop
			}else{
				$(this).addClass('pop_left_btn_active');
			}
		}
		$(this).siblings(".highlight_tip").find("span").eq((page3-1)).addClass("current").siblings().removeClass("current"); 	
	});	
	//	点击小图弹出大图
	$('.pic_lists img').live('click',function(){
		$('.popCon').show();
		$('.hsbj').show();
		var num = $(this).attr("v");
		move(num);
	});
	//	点击关闭
	$('.pop_close').live('click',function(){
		$(this).parents('.popCon').hide();
		$('.hsbj').hide();
	});
});

function move(num){
	page3 = parseInt(num);
	var $p_Div=$(".pop_pic_content");
	var $picDiv=$(".pop_pic_lists");
	var picNum=$picDiv.children("ul").children("li").length;
	var page_count=Math.ceil(picNum/1);	
	var $pDiv_w=$p_Div.width();
	
		$picDiv.animate({left:'-'+page3*$pDiv_w+"px"},"normal");
		page3 ++;
	if(page3 > 1 && page3 < page_count){
		$(".pop_left_btn").addClass('pop_left_btn_active');
		$(".pop_right_btn").removeClass('pop_right_btn_active'); 
	}else if(page3>=page_count){
		$(".pop_left_btn").addClass('pop_left_btn_active');
		$(".pop_right_btn").addClass('pop_right_btn_active'); 
	}else{
		$(".pop_left_btn").removeClass('pop_left_btn_active');  
		$(".pop_right_btn").removeClass('pop_right_btn_active');  
	}
	$(this).siblings(".highlight_tip").find("span").eq((page3-1)).addClass("current").siblings().removeClass("current"); 	
}
