function progressbar() {
		
	$('.progressbar').each(function(){
		var t = $(this),
		dataperc = t.attr('data-perc'),
		barperc = Math.round(dataperc*2.05);
		t.find('.bar').animate({width:barperc}, dataperc*25);

		function perc(){
			var length = t.find('.bar').css('width'),
			perc = Math.round(parseInt(length)/2.05),//此5.56为百分之百的时候为556px,按比例过来的。
			labelpos = (parseInt(length)-18);//这里是显示百分比的标签的位置
			t.find('.label').css('left', labelpos);
			t.find('.perc').text(perc+'%');
		}
		perc();
		setInterval(perc, 0); 
	});
	
};
