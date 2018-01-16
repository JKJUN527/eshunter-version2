var flag = "duanxin";
var regist_type = 1; //0:邮箱 1：手机
$(document).ready(function(){
	//选择 注册方式 之 邮箱
	$('.phone_text .no_phone span').click(function(){
	    $('.phone_text').hide();
	    $('.email_text').show();
	    $('.test_number').hide();
	    $('.verifyFlag').hide();
	    //隐藏语音提示
		$('#yuyin_tishi').hide();
	    $('.cuocuo').hide();
	    regist_type = 0;
	    clearMsg();
	  });
	  //选择 注册方式 之 手机
	 $('.email_text .no_phone span').click(function(){
		$('.phone_text').show();
		$('.email_text').hide();
		$('.test_number').show();
		$('.verifyFlag').show();
		$('.cuocuo').hide();
	    regist_type = 1;
	    clearMsg();
	  });
	  
	// 点击获取验证码
	$('.send_yzm').live('click',function(){
		//清空验证码的数据
		$('#verifycd').val('');
		//显示语音提示
		$('#yanzhengma').show();
		clearMsg();
	    sendYzm();
	});
	
	// 语音获取
	$('.cuocuo a.yuyin').live('click', function() {
		clearMsg();
		flag = "yuyin";
		sendYzm();
	});

	$('.shibie').click(function(event) {
		var e = window.event || event;
		if (e.stopPropagation) {
			e.stopPropagation();
		} else {
			e.cancelBubble = true;
		}
		$('.imgHide').show();
	});
	$('.imgHide').click(function(event) {
		var e = window.event || event;
		if (e.stopPropagation) {
			e.stopPropagation();
		} else {
			e.cancelBubble = true;
		}
	});
	document.onclick = function() {
		$(".imgHide").hide();
	};

	// 鼠标获得焦点边框变色
	$('.bsie7').click(function() {
		$(this).addClass('addBorder');
	});
	$('.bsie7').blur(function() {
		$(this).removeClass('addBorder');
	});
	$('.zidong_choose').click(function() {
		$(this).find('i').toggleClass('add_i');
	});
	// 查看密码
	$('.see_password').click(function() {
		$(this).toggleClass('nosee_password');
		if($(this).hasClass("nosee_password")){
			password_flag = 0; //明文显示密码
			if(ukbn == 0){
				$(".user_password2").val($(".user_password").val());
			}else{
				$(".hr_password2").val($(".hr_password").val());
			}
		}else{
			password_flag = 1;//隐藏显示密码
			if(ukbn == 0){
				$(".user_password").val($(".user_password2").val());
			}else{
				$(".hr_password").val($(".hr_password2").val());
			}
		}
		$(this).siblings('.text_pos').toggle();
	});
	// 提示显示企业邮箱
	$('.emil_hrResist').click(function() {
		$('.emil_alert').show();
	});
	//鼠标离开HR帐号
	$('.emil_hrResist').blur(function() {
		$('.emil_alert').remove();
		regist_type=0;
		var v = $(this).val();
		v=trim(v);
		$(this).val(v);
		if(v.length == 0){
			$('.error_msg_1').text('请填写邮箱');
			$(this).siblings('em').attr('class','no');
		}else
			if(emil(v) == false){
				$('.error_msg_1').html('邮箱格式错误');
				$(this).siblings('em').attr('class','no');
			}else{
				//==========================================判断邮箱是否为企业邮箱=======================================================
				isHrEmail(v,$('.emil_hrResist'));
				//$('.error_msg_1').html('');
				//$(this).siblings('em').attr('class','yes');
			}
		
		$(this).siblings('em').show();
	});
	//判断邮箱是否为企业邮箱
	function isHrEmail(v,elment){
		var dataVal={
			"email":v+""
		};
		jQuery.ajax({   
	            type: 'get',   
	            contentType : 'application/json; charset=utf-8',   
	            dataType: 'json',   
	            url: BaseJSURL + '/ajax/isHrEmail.do', 
	            data:dataVal,
	            success: function(data){
	            	//判断邮箱是否为企业邮箱
	            	if(data){
	            		$('.error_msg_1').html('邮箱必须填写企业邮箱');
						$(elment).siblings('em').attr('class','no');
	            	}else{
	            		$('.error_msg_1').html('');
						$(elment).siblings('em').attr('class','yes');
	            	}
	            	
	            },error:function(XMLHttpRequest, textStatus, errorThrown){
					alert(XMLHttpRequest.status);
				}
	      });
	}
	// 去空格
	function trim(str) {
		if(str==undefined){
			return '';
		}
		return str.replace(/^(\s|\u00A0)+/, '').replace(/(\s|\u00A0)+$/, '');
	}
	//鼠标离开USER帐号
	$('.user_account').blur(function() {
		var v = $(this).val();
		v=trim(v);
		$(this).val(v);
		if(emil(v) == false && telephone_ce(v) == false){
			v=trim(v);
			if(v.length == 0){
				$('.error_msg_1').html('请填写手机或邮箱');
			}else
				if(!isNaN(v)){
				    if(telephone_ce(v) == false){
						$('.error_msg_1').html('手机号码格式错误');
						$('.verifyFlag').show();
						regist_type=1;
					}
				}else{
					if(emil(v) == false){
						$('.error_msg_1').html('邮箱格式错误');
						$('.verifyFlag').hide();
					    //隐藏语音提示
						$('#yuyin_tishi').hide();
						regist_type=0;
						$("#very_msg").text('');
					}
				}
			$(this).siblings('em').attr('class','no');
			if(ukbn == 0){
				$('.add_number').hide();
			}
		}else{
			//验证码输入框显示问题
			if(v.indexOf("@") > 0 ){
				$('.verifyFlag').hide();
			    //隐藏语音提示
				$('#yuyin_tishi').hide();
				regist_type=0;
			}else{
				//手机注册用户
				//判断运营商
				/* 返回值:
				*      0 不是手机号码
				*      1 移动
				*      2 联通
				*      3 电信
				*      4 不确定
				*/
				var n=isPhoneNum(v);
				switch (n)
		        {
		         case 0:
		        	 $('.add_number').text('不是手机号码');
		        	 break;
		         case 1:
		        	 $('.add_number').text('中国移动');
		        	 break;
		         case 2:
		        	 $('.add_number').text('中国联通');
		        	 break;
		         case 3:
			         $('.add_number').text('中国电信');
			         break;
		         case 4:
			         $('.add_number').text('');
			         break;
		        }
				$('.verifyFlag').show();
				
			}
			$('.error_msg_1').html('');
			$(this).siblings('em').attr('class','yes');
			if(ukbn == 0 && telephone_ce(v)){
				$('.add_number').show();
				regist_type=1;
			}else{
				$('.add_number').hide();
				regist_type=0;
			}
		}
		$(this).siblings('em').show();
	});
	/*
	 * 判断是否是正确的手机号，以及手机的运营商
	 * @param {String} num
	 * 
	 * 返回值:
	 *      0 不是手机号码
	 *      1 移动
	 *      2 联通
	 *      3 电信
	 *      4 不确定
	 */
	function isPhoneNum (num) {
	    var flag = 0;
	    var phoneRe = /^1\d{10}$/;  
	    var dx = [133,153,177,180,181,189]; /*电信*/
	    var lt = [130,131,132,145,155,156,185,186];/*联通*/
	    var yd = [134,135,136,137,138,139,147,150,151,152,157,158,159,178,182,183,184,187,188];/*移动*/
	     
	    function inArray(val,arr){
	        for(i in arr){
	            if(val == arr[i]) return true;
	        }
	        return false;
	    }   
	 
	    if(phoneRe.test(num)){
	        var temp = num.slice(0,3);
	        if(inArray(temp,yd)) return 1;
	        if(inArray(temp,lt)) return 2;
	        if(inArray(temp,dx)) return 3;
	        return 4;
	    }
	    return flag;    
	}
	//鼠标离开密码
	$('.password').blur(function(){
		var v = $(this).val();
		v=trim(v);
		$(this).val(v);
		if(v == '' || v == '请输入6-16个字符，建议字母加数字的组合' || v.length < 6 || v.length > 16){
			var errorMsg='';
			if(v == ''){
				errorMsg='请填写密码';
			}else if(v == '请输入6-16个字符，建议字母加数字的组合'){
				errorMsg='请填写密码';
			}else if(v.length < 6){
				errorMsg='密码不能低于6位数';
			}else if(v.length >16){
				errorMsg='密码不能高于16位';
			}
			$('.error_msg_2').html(errorMsg);
			$(this).siblings('em').attr('class','no');
		}else{
			$('.error_msg_2').html('');
			$(this).siblings('em').attr('class','yes');
		}
		//验证码输入框显示问题
		var user='';
		if(ukbn == 0){
			user=$('.user_account').val();
		}else{
			user=$('.emil_hrResist').val();
		}
		user=trim(user);
		if(user.length==0){
			
		}else{
			if(!isNaN(user)){
				$('.verifyFlag').show();
			}else{
				$('.verifyFlag').hide();
			    //隐藏语音提示
				$('#yuyin_tishi').hide();
			}
		}
		
		$(this).siblings('em').show();
	});

	//注册
	$("#btnRegist").live("click",function(){
		//先判断协议是否选择
		if(!$("#xieyi_label").hasClass("add_i")){
			alert('请遵守《内聘网用户协议》');
			return;
		}
		if(regist_flag == 1){
			return;
		}
		//密码明文与隐文文本值切换
		var password_falg2=$('.password_falg2').val();
		var password_falg=$('.password_falg').val();
		if($('.see_password').hasClass('nosee_password')){
			//明文
			$('.password_falg').val(password_falg2);
		}else{
			//隐文
			$('.password_falg2').val(password_falg);
		}
		msg_flag = 1;
        var param = new Object();
        var msg_flag = 0;
        //用户账号类型0是手机，1是邮箱和空
        var param1Type=1;
        var account='';
		if(ukbn == 0){
			account='user_account';
			param.param1 =$('.user_account').val();
			if(!isNaN(param.param1)){
				param1Type=0;
				regist_type=1;
			}else{
				param1Type=1;
				regist_type=0;
			}
		}else{
			account='emil_hrResist';
			param.param1 =$('.emil_hrResist').val();
			param1Type=1;
			regist_type=0;
		}
		param.param2 = $(".password").val();
        if(regist_type==1)//求职者注册
        {
        	 if(param.param1 == "" || param.param1 == "请填写手机或邮箱" || param.param1.replace(/(^\s*)|(\s*$)/g,"") == "")
             {
        		param1Type=1;
        		msg_flag = 1;
             	showErr($("#phone_msg"),"请填写手机或邮箱");
             	$('.user_account').siblings('em').attr('class','no');
             }else if(isNaN(param.param1)){
            	 if(emil(param.param1) == true){
            		 $('.user_account').siblings('em').attr('class','yes');
            	 }else{
            		 msg_flag = 1;
                	 $('.error_msg_1').text('邮箱格式错误');
                	 $('.user_account').siblings('em').attr('class','no');
            	 }
            	 
             }else if(telephone_ce(param.param1) == false){
            	msg_flag = 1;
              	showErr($("#phone_msg"),"手机号码格式错误");
              	$('.user_account').siblings('em').attr('class','no');
             }else{
            	 $('.user_account').siblings('em').attr('class','yes');
             }
             if(param.param2 == "" || param.param2 == "请设置密码" || param.param2.replace(/(^\s*)|(\s*$)/g,"") == "")
             {
            	 msg_flag = 1;
             	showErr($("#passwd_phone_msg"),"请填写密码");
             	$('.password').siblings('em').attr('class','no');
             }else if(param.param2.length < 6){
            	 msg_flag = 1;
              	showErr($("#passwd_phone_msg"),"密码不能低于6位数");
              	$('.password').siblings('em').attr('class','no');
             }else if(param.param2.length > 16){
            	msg_flag = 1;
               	showErr($("#passwd_phone_msg"),"密码不能高于16位");
               	$('.password').siblings('em').attr('class','no');
              }else{
            	 $('.password').siblings('em').attr('class','yes');
             }
             $('.user_account').siblings('em').show();
        }
        else//邮箱注册
        {
        	 if(param.param1 == "" || param.param1 == "邮箱地址" || param.param1.replace(/(^\s*)|(\s*$)/g,"") == "")
             {
        		 msg_flag = 1;
        		 $('.error_msg_1').text('请填写邮箱');
        		 $('.emil_hrResist').siblings('em').attr('class','no');
             }else if(emil(param.param1) == false){
            	 msg_flag = 1;
            	 $('.error_msg_1').text('邮箱格式错误');
            	 $('.emil_hrResist').siblings('em').attr('class','no');
             }else{
            	 if(ukbn == 1){
                 	//邮箱过滤
                     isHrEmail(param.param1,$('.emil_hrResist'));
                 }else
                	 $('.emil_hrResist').siblings('em').attr('class','yes');
             }
             if(param.param2 == "" || param.param2 == "请设置密码" || param.param2.replace(/(^\s*)|(\s*$)/g,"") == "")
             {
            	 msg_flag = 1;
            	 $('.error_msg_2').text('请填写密码');
            	 $('.password').siblings('em').attr('class','no');
             }else if(param.param2.length < 6){
            	 msg_flag = 1;
            	 $('.error_msg_2').text('密码不能低于6位数');
            	 $('.password').siblings('em').attr('class','no');
             }else if(param.param2.length > 16){
            	msg_flag = 1;
               	showErr($("#passwd_phone_msg"),"密码不能高于16位");
               	$('.password').siblings('em').attr('class','no');
              }else{
            	 $('.password').siblings('em').attr('class','yes');
             }
             $('.emil_hrResist').siblings('em').show();
        }
        $('.password').siblings('em').show();
        
        param.param3 = $("#verifycd").val();
        param.param4 = ukbn;
        if(param1Type==0&&regist_type == 1 && param.param3 == "")
        {
        	msg_flag = 1;
        	showErr($("#very_msg"),"请填写验证码");
        }
        
        if(ukbn == ""){
        	msg_flag = 1;
        	showErr($("#mudi_msg"),"请选择您来内聘的目的！");
        }
        
       if(msg_flag == 1){
    	   regist_flag = 0;
          return;
       }
       clearMsg();
       param.param5 = 0;//PC端
        jQuery.ajax({   
                type: 'post',   
                contentType : 'application/json; charset=utf-8',   
                dataType: 'json',   
                url: BaseJSURL + '/ajax/new_regist.do', 
                data: JSON.stringify(param),   
                success: function(data){
                   if(data.ret == "0")
                   {
                	   if(ukbn == 0){
                    	   var param_2 = new Object();
                    	   param_2.emailAddr = param.param1;
                    	   param_2.passwd = param.param2;
                         jQuery.ajax({   
                             type: 'post',   
                             contentType : 'application/json; charset=utf-8',   
                             dataType: 'json',   
                             url: BaseJSURL + '/ajax/login.do', 
                             data: JSON.stringify(param_2),   
                             success: function(data){
                                if(data.ret == "0")
                                {
  			                       window.location.href = BaseJSURL + "/p/edit/";
                                }
                             }
                         });
                	   }else{
                		 //alert(BaseJSURL + "/p/registActivation?email="+param.param1);
                		 //企业注册成功后需要跳转到邮箱验证
                		 window.location.href = BaseJSURL + "/p/registActivation?email="+param.param1;
                	   }
                       msg_flag = 0;
                   }
                   else if(data.ret == "1")
                   {
                	   $(".error_msg_1").show();
                	   if(regist_type == 0){
                		   showErr($(".error_msg_1"),"该邮箱已经注册");
                	   }else{
                		   showErr($(".error_msg_1"),"该手机已经注册");
                	   }
                	   $('.'+account).siblings('em').attr('class','no');
            		   $('.'+account).siblings('em').show();
                	   
                   }
                   else if(data.ret == "2")
                   {
                	   showErr($("#very_msg"),"验证码不正确");
                   }
                   else if(data.ret == "3"){
                	   $('.error_msg_1').html('邮箱必须填写企业邮箱');
					   $('.'+account).siblings('em').attr('class','no');
                   }else
                   {
                	    showErr($("#yuyin_msg"),"注册失败，请稍候重试");
                   }
                }
           });
    });
});
var send_flag = 0;
function sendYzm() {
	if (send_flag == 1) {
		return;
	}
	var param = new Object();
    param.param1=$(".number").val();
    if(param.param1 == "" || param.param1 == "请您输入手机号码" || param.param1.replace(/(^\s*)|(\s*$)/g,"") == ""){
 	   showErr($("#phone_msg"),"请输入手机号码");
        return;
    }else if(telephone_ce(param.param1) == false){
 	   showErr($("#phone_msg"),"手机号码格式错误");
    	   return;
    }
	if (flag == "duanxin") {
		sendDuanXinYzm(param);
		$('.send_yzm').addClass('gray');
		$('.send_yzm').val("60秒后重新获取短信验证码").css({
			'font-size' : '13px'
		});
		send_flag = 1;
		var s = 59;
		var t = setInterval(function() {
			if (s == -1) {

				send_flag = 0;
				$('.send_yzm').removeClass('gray');
				$('.send_yzm').val('重新获取短信验证码').css({
					'font-size' : '16px'
				});
				clearInterval(t);
				return;
			}

			$('.send_yzm').val(s + "秒后重新获取短信验证码");
			s--;
		}, 1000);
		setTimeout("showYuyintishi()", 15000);
	} else {
		sendYuYinYzm(param);
	}
};
function showErr(sobj, msg)
{
	sobj.html(msg);
	sobj.show();
}

function showYuyintishi()
{
	$("#yuyin_tishi").show();
}
function sendDuanXinYzm(param){
    jQuery.ajax({   
          type: 'post',   
          contentType : 'application/json; charset=utf-8',   
          dataType: 'json',   
          url: BaseJSURL + '/event/send', 
          data: JSON.stringify(param),   
          success: function(data){
              if(data.ret == "0")
              {
                 $(".yzm_msg").text("验证码发送成功");
                 $(".yzm_msg").show();
              }else if(data.ret == "2"){
                 $(".yzm_msg").text("系统认为您在恶意发送");
                 $(".yzm_msg").show();
              }else{
                 $(".yzm_msg").text("验证码发送失败，请稍后重试");
                 $(".yzm_msg").show();
              }
          }
     });
}
function sendYuYinYzm(param){
    jQuery.ajax({   
          type: 'post',   
          contentType : 'application/json; charset=utf-8',   
          dataType: 'json',   
          url: BaseJSURL + '/ajax/send.do', 
          data: JSON.stringify(param),   
          success: function(data){
              if(data.ret == "0")
              {
                 $("#yuyin_msg").text("正在呼叫，请保持您的电话畅通");
                 $("#yuyin_msg").show();
              }else if(data.ret == "2"){
                 $("#yuyin_msg").text("系统认为您在恶意发送");
                 $("#yuyin_msg").show();
              }else{
                 $("#yuyin_msg").text("验证码发送失败，请稍后重试");
                 $("#yuyin_msg").show();
              }
          }
     });
 }

function clearMsg()
{
	//$(".baocuo").hide();
	$(".baocuo").text("");
	$("#phone_msg").text("");
	$("#yuyin_msg").text("");
	$("#mudi_msg").text("");
	$("#very_msg").text("");
}

function SetFocus() {
	document.getElementById('tbUserName').focus();
}

function checkEnter(event) {
	if (event.keyCode == 13) {
		if (document.getElementById("tbPassword").value == '') {
			document.getElementById("tbPassword").focus();
			return false;
		}
	}
	return true;
}

function enterregist() {
	var event = window.event || arguments.callee.caller.arguments[0];
	if (event.keyCode == 13) {
		document.getElementById("btnRegist").click();
	};
};
