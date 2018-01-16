$(document).ready(function(){
		
		$('.phone').bind('keypress',function(event){
			if(event.keyCode == "13") { 
				$('#sendtma').click();
			} 
		});
		
		$('.yzm').bind('keypress',function(event){
			if(event.keyCode == "13") { 
				$('#submit').click();
			} 
		});
		
		$('.email').bind('keypress',function(event){
			if(event.keyCode == "13") { 
				$('.sendemail').click();
			} 
		});
		
		
		


		//发送短信验证
		$('#sendtma').click(function(){
			send();
		});
        //重新发送
		$('.send_2wma em').click(function(){
			send();
			$('.send_2wma span').show();
			$('.send_2wma em').hide();
		})  ; 		
		
		//提交验证码
		$('#submit').click(function(){
			var param = new Object();
			param.param1 = $('.phone').val();
			param.param2 = $('.yzm').val();
			if(param.param2 == "" || param.param2 == "请输入验证码"){
				$(".yzm_tishi").show();
      		    $(".yzm_tishi").text("请输入验证码");
				return;
			}else{
				$(".yzm_tishi").hide();
      		    $(".yzm_tishi").text("");
			}
			
			jQuery.ajax({   
		          type: 'post',   
		          contentType : 'application/json; charset=utf-8',   
		          dataType: 'json',   
		          url: BaseJSURL + '/ajax/checkyzm.do', 
		          data: JSON.stringify(param),   
		          success: function(data){
		        	  if(data.ret == 0){
		        		  $(".yzm_tishi").hide();
		        		  $(".yzm_tishi").text("");
		        		  window.location.href = BaseJSURL + '/fp/forgetpasswordreset?flag=1&oid=' + data.openid;
		        	  }else{
		        		  $(".yzm_tishi").show();
		        		  $(".yzm_tishi").text("验证码错误");
		        	  }
		          }
			});
		});
		
		
		
		$('#password1').bind('keypress',function(event){
			if(event.keyCode == "13") { 
				$("#tijiao").click();
			} 
		});
		
		$('#password2').bind('keypress',function(event){
			if(event.keyCode == "13") { 
				$("#tijiao").click();
			} 
		});
		
		//提交密码
		$("#tijiao").click(function(){
			var my_password1=$("#password1").val();
			if(my_password1=="" || my_password1== "请输入新密码"){
				$("#password_tishi_1").show();
				$("#password_tishi_1").text("密码不能为空");
				return;
			}else{
				$("#password_tishi_1").hide();
				$("#password_tishi_1").text("");
			}
			var my_password2=$("#password2").val();
			if(my_password2=="" || my_password2=="确认新密码"){
				$("#password_tishi_2").show();
				$("#password_tishi_2").text("密码不能为空");
				return;
			}else{
				$("#password_tishi_2").hide();
				$("#password_tishi_2").text("");
			}
			
			if(my_password1!=my_password2){
				$("#password_tishi_2").show();
				$("#password_tishi_2").text("密码不一致");
				return;
			}else{
				$("#password_tishi_2").hide();
				$("#password_tishi_2").text("");
			}
			var param = new Object();
			param.param1=openid;
			param.param2=my_password1;
			jQuery.ajax({   
		        type: 'post',   
		        contentType : 'application/json; charset=utf-8',   
		        dataType: 'json',   
		        url: BaseJSURL +'/ajax/update_password.do', 
		        data: JSON.stringify(param),   
		        success: function(data){
		            if(data.ret==0){
		            	window.location.href = BaseJSURL +'/fp/forgetpasswordsuccess?flag=' + flag;
		            }else{
		            	$("#password_tishi_2").show();
		            	$("#password_tishi_2").text("用户不存在");
		            }
		        }
	   		}); 
			
   		});
		
		
		//发送邮件验证
		$('.sendemail').click(function(){
			var param = new Object();
			param.param1 = $('.email').val();
			if(param.param1 == "请输入注册时使用的邮箱地址" || emil(param.param1) == false){
				$('.email_tishi').show();
        		$('.email_tishi').text("请输入正确的邮箱");
        		return;
			}else{
				$('.email_tishi').hide();
        		$('.email_tishi').text("");
			}
			jQuery.ajax({   
		        type: 'post',   
		        contentType : 'application/json; charset=utf-8',   
		        dataType: 'json',   
		        url: BaseJSURL +'/ajax/checkaccount.do', 
		        data: JSON.stringify(param),   
		        success: function(data){
		        	if(data.ret == 0){
		        		jQuery.ajax({   
		    		        type: 'post',   
		    		        contentType : 'application/json; charset=utf-8',   
		    		        dataType: 'json',   
		    		        url: BaseJSURL +'/ajax/fide_password_sendoutEmil.do', 
		    		        data: JSON.stringify(param),   
		    		        success: function(date){
		    		        	if(date.ret == 0){
		    		        		window.location.href =BaseJSURL + "/fp/forgetpasswordemailtwo?flag=2&email=" + param.param1;
		    		        	}else{
		    		        		$('.email_tishi').show();
		    		        		$('.email_tishi').text("系统繁忙请稍后重试");
		    		        	}
		    		        }
		        		});
		        	}else{
		        		$('.email_tishi').show();
		        		$('.email_tishi').text("用户不存在");
		        	}
		        }
			});
		});
		
		//立即登录
		$('#login').live("click",function(){
			window.location.href = BaseJSURL +'login.html';
		});
		
});

   function send(){
	   var param = new Object();
		param.param1 = $('.phone').val();
		if( param.param1 == "请输入注册时使用的手机号码" || telephone_ce(param.param1) == false){
			$('.phone_tishi').show();
			$('.phone_tishi').text("请输入正确的手机号码");
			return;
		}else{
			$('.phone_tishi').hide();
			$('.phone_tishi').text("");
		}
		
		 jQuery.ajax({   
	          type: 'post',   
	          contentType : 'application/json; charset=utf-8',   
	          dataType: 'json',   
	          url: BaseJSURL + '/ajax/checkaccount.do', 
	          data: JSON.stringify(param),   
	          success: function(data){
	        	  if(data.ret == 0){
	        		  sendDuanXinYzm(param);
	        	  }else{
	        		  $('.phone_tishi').show();
	  				  $('.phone_tishi').text("用户不存在");
	        	  }
	           }
	     });
   }

	
	
	function times(){
		$('.send_2wma span').text("60秒后重新获取验证码");
		var s = 59;
		var t = setInterval(function() {
			if (s == -1) {
				$('.send_2wma span').hide();
				$('.send_2wma em').show();
				clearInterval(t);
				return;
			}
			$('.send_2wma span').text(s + "秒后重新获取验证码");
			s--;
		}, 1000);
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
	            	  times();
	            	 var phone = param.param1;
	                 $(".message").text("短信验证码已经发送到您号码为"+phone.substr(0,2) + "******" +phone.substr(8,3) +"的手机，请在下框中输入验证码：");
	            
	                 $('.message').show();
	         		 $('.stepTwo').show();
	         	     $('.stepOne').hide();
	              }else if(data.ret == "2"){
	            	 $(".phone_tishi").show();
	                 $(".phone_tishi").text("系统认为您在恶意发送");
	              }else{
	            	 $(".phone_tishi").show();
	                 $(".phone_tishi").text("验证码发送失败，请稍后重试");
	              }
	          }
	     });
	}
	
	