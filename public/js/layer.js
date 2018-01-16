/*弹层效果*/
(function(win,$){
	var iPageX = $(document).innerHeight();
	var oToEmplay = $('#toEmplay');
	var oMask = $('#mask');
	var oFormLayer = $('#form-layer');
	var confirmLayer = $('#confirm-layer');
	var oCloseLayer = oFormLayer.find('p.layer-top').find('span');
	var oCloseLayer2 = confirmLayer.find('p.layer-top2').find('span');
	var oBindBtn = oFormLayer.find('input.bind-btn');
	var aHide = oFormLayer.find('li.hide');

	oCloseLayer.live('click', function() {
		oMask.animate({opacity: 0}, 300, function() {
			oMask.hide();
		});
		oFormLayer.animate({opacity: 0}, 300, function() {
			oFormLayer.hide();
			aHide.hide();
			oBindBtn.parents('li').show();
		});
	});
	
	oCloseLayer2.live('click', function() {
		oMask.animate( function() {
			oMask.hide();
		});
		confirmLayer.animate( function() {
			confirmLayer.hide();
			aHide.hide();
			oBindBtn.parents('li').show();
		});
	});
	
	oBindBtn.live('click', function() {
		$(this).parents('li').hide();
		aHide.show();
		var iTop = oFormLayer.outerHeight()/2;
		oFormLayer.css('marginTop',-iTop );
		
	});

})(window,jQuery);