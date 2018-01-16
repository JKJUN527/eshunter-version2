$(document).ready(function(){
	var tNum=$(".m_banner .banner").length-1;
	var nNum=0;		
	$(".m_banner .prev").click(function(){
		(nNum-1)<0?n2=tNum:n2=nNum-1;
		bSwitch(nNum,n2);
		nNum=n2;
	});	
	$(".m_banner .next").click(function(){
		(nNum+1)>tNum?n2=0:n2=nNum+1;
		bSwitch(nNum,n2);
		nNum=n2;
	});
	function bSwitch(nNum,n2){
		$(".m_banner .banner:eq("+nNum+")").fadeOut();
		$(".m_banner .banner:eq("+n2+")").fadeIn();
	};
							
	$(function(){
		var switchTime;
	 	$(".m_banner").hover(function(){
			clearInterval(switchTime);
		},function(){
		switchTime = setInterval(function(){
			(nNum+1)>tNum?n2=0:n2=nNum+1;
			bSwitch(nNum,n2);
			nNum=n2;
		},5000);
		}).trigger("mouseleave");
	});

});