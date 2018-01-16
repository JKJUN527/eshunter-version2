$(document).ready(
		function() {
			$('.sucess_title i').live('click', function() {
				$(this).parents('.sucess_yes').hide();
				uploadsuccess();
				$('.hsbj').hide();
				default_jianli = default_jianli2;
				$('.resume_list span').removeClass('active');
			});
			// 默认简历
			$('.resume_list span').click(function() {
				default_jianli = $(this).parent().attr('v');
				if (myflag == '2') {
					if (default_jianli == '1') {
						default_jianli = "";
						alert("请先上传附件简历");
						return;
					}
				}
				if (myflag == '3') {
					if (default_jianli == '0') {
						default_jianli = "";
						alert("请先完善在线简历");
						return;
					}
				}

				$(this).addClass('active');
				$(this).parent().siblings('.resume_list').find('span').removeClass('active');
			});
			$('.resume_default span').click(function() {
				$(this).toggleClass('active');
				if ($(this).hasClass('active')) {
					default_flag = 1;
				} else {
					default_flag = 0;
				}
			});

			if (uname != "") {
				// 二维码
				jQuery.ajax({
					type : 'get',
					contentType : 'application/json; charset=utf-8',
					dataType : 'json',
					url : BaseJSURL + '/qcode/bind',
					data : '',
					success : function(data) {
						$("#home_loading").ajaxStart(function() {
							$(this).show();
							$('.whitebg').show();
						});
						$("#home_loading").ajaxStop(function() {
							$(this).hide();
							$('.whitebg').hide();
						});
						$("#erweima").attr("src","https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket="+ data.ticket);
					}
				});
			}

			$('.saosao').mouseover(function() {
				$('.erwei_bgs').fadeIn();
			});

			$('.saosao').mouseleave(function() {
				$('.erwei_bgs').fadeOut();
			});
			jQuery('.float_erweima').qrcode({
				width : 120,
				height : 120,
				correctLevel : 0,
				text : "http://www.neipin.com/j/" + jobid + "?oid=" + openid
			});

			if ($.browser.msie) {
				$('.upload_jianli').hide();
				$('.upload_jianliie').css({
					'display' : 'inline-block'
				});
				$('.upload_jianliie').click(function() {
					ie_num = $(this).attr('num');
					$('.fujian_ie').show();
					$('.hsbj').show();
				});
			}

			// 投递简历之前判断用户是否上传简历
			$('.toEmplay').live('click', function() {
				if (uname == null || uname == "") {
					// 返回登录
					window.location.href = BaseJSURL + "login.html";
					return;
				}

				if ($(this).text() == "已投递") {
					return;
				}

				if (myflag == '1') {
					if (default_jianli == '0' || default_jianli == "1") {
						sendResume();
						return;
					}
				} else if (myflag == '2') {
					if (default_jianli == '0') {
						sendResume();
						return;
					}
				} else if (myflag == '3') {
					if (default_jianli == '1') {
						sendResume();
						return;
					}
				} else if (myflag == '4') {

				}

				if (myflag == '1') {
					$(".toudi_1").show();
					$('.hsbj').show();
				} else if (myflag == '2') {
					$(".toudi_2").show();
					$('.hsbj').show();
				} else if (myflag == '3') {
					$(".toudi_3").show();
					$('.hsbj').show();
				} else if (myflag == '4') {
					$(".toudi_4").show();
					$('.hsbj').show();
				} else {
					window.location.href = BaseJSURL + "/ro/";
				}

			});

			// 上传用户信息
			$("#queren_user").live("click", function() {
				$("#errMsg").hide();
				var param = new Object();
				param.param1 = $("#username").val();
				param.param2 = $("#gender").val();
				param.param3 = $("#college").val();
				param.param4 = $("#workyears").val();
				param.param5 = $("#phone").val();
				param.param6 = $("#email").val();

				var msg = "";
				if (common_length(param.param1, 20) == false) {
					msg = "姓名";
				} else if (telephone_ce(param.param5) == false) {
					msg = "手机号";
				} else if (ToUpdateEmail(param.param6) == false) {
					msg = "邮箱";
				}

				if (msg != "") {
					$("#errMsg").show();
					$("#errMsg").html(msg + msa);
					return;
				}

				jQuery.ajax({
					type : 'post',
					contentType : 'application/json; charset=utf-8',
					dataType : 'json',
					url : BaseJSURL + '/ajax/addUseryi.do',
					data : JSON.stringify(param),
					success : function(date) {
						// $('.tanclosebtn').click();
						if (date.ret == 1) {
							$('.toEmplay').click();
						}
					}
				});
			});
			
			 $('.hr_sao span').click(function(){
					$(this).parent('.hr_sao').hide();
					$('.hsbj').hide();
			});

		});

// 上传简历
function uploadjianli(num, id) {
	var fid = "";
	if ($.browser.msie) {
		num = ie_num;
	}
	if (id == 1) {
		fid = "ie_jianli";
	} else {
		fid = "f_jianli";
	}
	$(".cuowutishi").hide();

	start();
	$.ajaxFileUpload({
		type : 'post',
		url : BaseJSURL + '/ajax/newuploadjianli.do',
		secureuri : false,
		fileElementId : fid,
		dataType : 'json',
		data : {},
		success : function(data, status) {
			if (data.maxSizeErr == "1") {
				alert('简历文件太大，不能超过3M');
				return;
			} else if (data.type_error == "1") {
				alert("文件格式错误");
				return;
			}
			var param = new Object();
			param.param1 = $(".resume_name_" + num).val();// 原简历名字
			param.param2 = data.jianli_name;// 新简历名字
			param.param3 = data.originalName;
			// 上传成功
			jQuery.ajax({
				type : 'post',
				contentType : 'application/json; charset=utf-8',
				dataType : 'json',
				url : BaseJSURL + '/ro/sjianli',
				data : JSON.stringify(param),
				success : function(date) {
					stop();
					if (date.ret == 0) {
						if ($.browser.msie) {
							$('.ie_success').text("上传成功！");
						} else {

							$('.upload_success').show();
							$('.toudi_1').hide();
							$('.toudi_2').hide();
							$('.toudi_3').hide();
							$('.toudi_4').hide();
						}
						$('.hsbj').show();
						num_flag = num;
						val_1 = param.param2;
						val_2 = param.param3;
						// uploadsuccess(num,param.param2,param.param3);
					}
				}
			});

		},
		error : function(data, status, e) {
			stop();
			alert('简历上传失败,请重试。');
		}
	});
}

function uploadsuccess() {
	$('.upload_success').hide();
	$('.fujian_ie').hide();
	$(".hsbj").hide();
	$('.sucess_yes').hide();

	if ($.browser.msie) {
		location.reload();
	}

	if (num_flag == 3) {
		location.reload();
	} else if (num_flag == 4) {
		location.reload();
	} else {
		$(".resume_name_" + num_flag).val(val_1);
		$("#fujian_" + num_flag).text(val_2);

		$('#fujian_4').text(val_2);
		$(".resume_name_4").val(val_1);

		$('.default_fujian').text(val_2);
	}
}

function sendResume() {
	$(".hsbj").hide();
	$('#confirm-layer').hide();
	$('#form-layer').hide();
	$('#mask').hide();
	var param = new Object();
	param.param1 = jobid;
	param.param2 = default_jianli;
	param.param3 = toudi_state;
	param.param4 = default_flag;
	jQuery.ajax({
		type : 'post',
		contentType : 'application/json; charset=utf-8',
		dataType : 'json',
		url : BaseJSURL + '/ajax/sendResume.do',
		data : JSON.stringify(param),
		success : function(date) {
//			if (date.ret == 0) {
//				window.location.href = BaseJSURL + "login.html";
//			} else 
			if (date.ret == 1) {
				$('.toEmplay').addClass("grey_tou");
				$('.toEmplay').text("已投递");
				tishi_msg("简历发送成功");
				$('.sucess_yes').hide();
				jQuery.ajax({
					type : 'get',
					contentType : 'application/json; charset=utf-8',
					dataType : 'json',
					url : BaseJSURL + '/qcode/bind',
					data : '',
					success : function(data) {
						$('.hr_sao').show();
						$('.hsbj').show();
						$("#erweima").attr(
								"src",
								"https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket="
										+ data.ticket);
					}
				});
			} else if (date.ret == 2) {
				tishi_msg("同一个职位，每天只能投递一次");
			} else if (date.ret == 5) {
				tishi_msg("每天只能投递五次");
			} else if (date.ret == 9) {
				tishi_msg("你已投递过该职位");
			} else {
				tishi_msg("简历发送失败，请重新发送");
			}
		}
	});
}

function setdefaultjianli() {
	if (default_jianli == null || default_jianli == '') {
		alert("请选择要投递的简历");
		return;
	}
	if (flag == 0) {
		sendResume();
	} else {
		var param = new Object();
		param.param1 = default_jianli;
		jQuery.ajax({
			type : 'post',
			contentType : 'application/json; charset=utf-8',
			dataType : 'json',
			url : BaseJSURL + '/ajax/setdefaultjianli.do',
			data : JSON.stringify(param),
			success : function(date) {
				if (date.ret == 0) {
					location.reload();
				}
			}
		});

	}
	$('.sucess_yes').hide();
	$('.hsbj').hide();
}

function reset() {
	flag = 1;
	$('.ok').text("保存设置");
	$('.sucess_title span').text("设置默认投递简历");
	$('.resume_default').hide();
	if (myflag == '1') {
		$(".toudi_1").show();
		$('.hsbj').show();
	} else if (myflag == '2') {
		$(".toudi_2").show();
		$('.hsbj').show();
	} else if (myflag == '3') {
		$(".toudi_3").show();
		$('.hsbj').show();
	} else if (myflag == '4') {
		$(".toudi_4").show();
		$('.hsbj').show();
	}
}