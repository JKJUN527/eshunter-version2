// 在线简历
$(function() {
	// 性别选择
	$('.sex_choose span').live("click", function() {
		gender = $(this).attr("v");
		if (gender == 1) {
			$(this).addClass('boyChoosed');
			$(this).siblings('span').removeClass('girlChoosed');
		} else {
			$(this).addClass('girlChoosed');
			$(this).siblings('span').removeClass('boyChoosed');
		}

	});

	// 基本信息取消
	$('.self_info .cancel').live("click", function() {
		$('#self_info1').show();
		$('#self_info2').hide();

		$(".username_msg").hide();
		$('.username_msg').text("");
		$('.xueli_msg').hide();
		$('.xueli_msg').text("");
		$('.workyears_msg').hide();
		$('.workyears_msg').text("");
		$('.state_msg').hide();
		$('.state_msg').text("");
		$('.phone_msg').hide();
		$('.phone_msg').text("");
		$('.email_msg').text("");
		$('.email_msg').hide();
		$('.birthday_msg').hide();
		$('.birthday_msg').text("");
         myfun();
	});

	// 期望工作
	// 默认点击
	$('#expect_con3 .default').live("click", function() {
		$('#expect_con3').hide();
		$('#expect_con2').show();
		var seap_h1 = $('#dragDiv1').height() - 58;
		$('.monitor_pos1 .seap').css({
			'height' : seap_h1
		});
        myfun();
	});
	// 鼠标滑过点击出现
	$('#expect_con1').live('mouseover', function() {
		$('#expect_con1 .span_edit').show();
	});

	$('#expect_con1').live('mouseout', function() {
		$('#expect_con1 .span_edit').hide();
	});

	// 编辑期望工作
	$('#expect_con1 .span_edit').live("click", function() {
		$('#expect_con1').hide();
		$('#expect_con2').show();
		var seap_h1 = $('#dragDiv1').height() - 58;
		$('.monitor_pos1 .seap').css({
			'height' : seap_h1
		});

		// 期望职位
		$('.hope_job').val($('.want_position').text());
		// 期望薪资
		$('.w_salary').text(salary_text);
		$('#salary').val(salary_num);
		// 城市
		if (new_location == "" || new_location == null) {
			new_location = "期望城市";
		}
		$('#location').val(new_location);
		$('#location').siblings('span').show();
		$('#location').siblings('span').text(new_location);
		$('.qita_input').hide();
		$('.qita_input').val("");
		// 求职类型
		if (job_type != "") {
			$('#job_type').val(job_type);
			$('#job_type').siblings('span').text($('.want_type').text());
		} else {
			$('#job_type').val("");
			$('#job_type').siblings('span').text("求职类型");
		}
		// 领域
		if (industry_cd == "") {
			$('.wantIndustry').text("期望领域");
			$('#want_industry').val("");
		} else {
			$('.wantIndustry').text($('.want_industry').text());
			$('#want_industry').val(industry_cd);

			$('.qiwang_position').find('div').each(function(index, node) {
				if ($(this).hasClass('addcss')) {
					$(this).removeClass('addcss');
				}
			});

			var cd = industry_cd.split(',');
			for ( var i = 0; i < cd.length; i++) {
				$(".qiwang_position #" + cd[i]).addClass('addcss');
			}
		}

		// 规模
		if (guimo_cd != "") {
			$('.guimo').text($('.want_guimo').text());
			$('#guimo').val(guimo_cd);
		} else {
			$('.guimo').text("期望规模");
			$('#guimo').val("");
		}
		
		myfun();

	});

	// 期望工作 取消
	$('.qwgz_cancel').live("click", function() {
		$('#expect_con2').hide();
		$('#expect_con1').show();

		$('.want_position_msg').hide();
		$('.want_position_msg').html("");
		$('#lingyu_msg').hide();
		$('#lingyu_msg').html("");
		$('.location_msg').hide();
		$('.location_msg').html("");
		var seap_h1 = $('#dragDiv1').height() - 58;
		$('.monitor_pos1 .seap').css({
			'height' : seap_h1
		});
		myfun();
	});

	// 工作经历默认没有情况
	$('#gzjl3 .default').live("click", function() {
		$('#gzjl3').hide();
		$('#gzjl2').show();
		myfun();
	});
	// 工作经历取消
	$('.gzjy_cancel').live("click",function() {
				if (document.getElementById('gzjl_div').innerHTML.replace(
						/(^\s*)|(\s*$)/g, "") == "") {
					$('#gzjl2').hide();
					$('#gzjl3').show();
					// 公司名称
					$('#company_name').val("");
					// 职位名称
					$('#position_name').val("");
					// 开始时间
					$('#start_year').text("入职年份");
					$('#start_month').text("入职月份");
					$('#jl_s_year').val("");
					$('#jl_s_month').val("");
					// 结束时间
					$('#end_year').text("离职年份");
					$('#end_month').text("离职月份");
					$('#jl_e_year').val("");
					$('#jl_e_month').val("");
					// 公司领域
					var str = $("#c_lingyu").val();
					if (str != '' && str != null) {
						var cd = str.split(',');
						for ( var i = 0; i < cd.length; i++) {
							if (cd[i] != '') {
								$(".company_lingyu ." + cd[i]).removeClass(
										'addcss');
							}
						}
					}
					$('.c_lingyu').text("公司领域");
					$('#c_lingyu').val("");
					// 公司规模
					$('.c_guimo').text("公司规模");
					$('#c_guimo').val("");
					// 职位描述
					$('#c_description').val("");
				} else {
					$(".company_lingyu div").removeClass('addcss');
					$('#gzjl2').hide();
					$('#gzjl1').show();
				}

				$('.c_name_msg').hide();
				$('.c_name_msg').html("");
				$('.c_position_msg').hide();
				$('.c_position_msg').html("");
				$('.jl_s_msg').hide();
				$('.jl_s_msg').html("");
				$('.jl_e_msg').hide();
				$('.jl_e_msg').html("");
				$('.c_lingyu_msg').hide();
				$('.c_lingyu_msg').html("");
				$('.c_description_msg').hide();
				$('.c_description_msg').html("");
				myfun();
			});
	// 鼠标滑过点击出现
	$('#gzjl1').live('mouseover', function() {
		$('#gzjl1 .span_edit').show();
		$('#gzjl1 .span_del').show();
	});

	$('#gzjl1').live('mouseout', function() {
		$('#gzjl1 .span_edit').hide();
		$('#gzjl1 .span_del').hide();
	});
	// 编辑和删除
	// $('#gzjl1 .span_edit').live("click",function(){
	// $('#gzjl3').hide();
	// $('#gzjl2').show();
	// });
	// $('#gzjl1 .span_del').live("click",function(){
	// $('#gzjl1').hide();
	// $('#gzjl2').show();
	// });

	$('#gzjl .cancel').live("click", function() {
		$('#gzjl2').hide();
		myfun();
	});

	// 项目经验默认
	$('#item_exprience3 .default').live("click", function() {
		$('#item_exprience3').hide();
		$('#item_exprience2').show();
		myfun();
	});
	// 项目经验取消
	$('.xmjy_cancel').live("click",function() {
				if (document.getElementById('xmjy_div').innerHTML.replace(
						/(^\s*)|(\s*$)/g, "") == "") {
					$('#item_exprience2').hide();
					$('#item_exprience3').show();

					// 项目名称
					$('#project_name_jy').val("");
					// 职位名称
					$('#position_name_jy').val("");
					// 开始时间
					$('#start_year_jy').text("开始年份");
					$('#start_month_jy').text("开始月份");
					$('#jy_s_year').val("");
					$('#jy_s_month').val("");
					// 结束时间
					$('#end_year_jy').text("结束年份");
					$('#end_month_jy').text("结束月份");
					$('#jy_e_year').val("");
					$('#jy_e_month').val("");
					// 职位描述
					$('#jy_description').val("");
				} else {
					$('#item_exprience2').hide();
					$('#item_exprience1').show();
				}

				$('.company_name_jy_msg').hide();
				$('.company_name_jy_msg').html("");
				$('.position_name_jy_msg').hide();
				$('.position_name_jy_msg').html("");
				$('.jy_s_msg').hide();
				$('.jy_s_msg').html("");
				$('.jy_e_msg').hide();
				$('.jy_e_msg').html("");
				myfun();
			});

	// 教育背景默认
	$('#edu3 .default').live("click", function() {
		$('#edu3').hide();
		$('#edu2').show();
		var seap_h2 = $('#dragDiv4').height() - 58;
		$('.monitor_pos2 .seap').css({
			'height' : seap_h2
		});
        myfun();
	});
	// 教育背景取消
	$('.jybj_cancel').live("click",function() {
				if (document.getElementById('jybj_div').innerHTML.replace(
						/(^\s*)|(\s*$)/g, "") == "") {
					$('#edu2').hide();
					$('#edu3').show();
					var seap_h2 = $('#dragDiv4').height() - 58;
					$('.monitor_pos2 .seap').css({
						'height' : seap_h2
					});

					// 项目名称
					$('#school_name').val("");
					// 职位名称
					$('#zhuanye_name').val("");
					// 学历
					$('#collegeLevel').text("学历");
					$('#college_level').val("");
					// 开始时间
					$('#ruxue_time').text("入学年份");
					$('#ed_s_year').val("");
					// 毕业时间
					$('#biye_time').text("毕业年份");
					$('#ed_e_year').val("");
					// 职位描述
					$('#ed_description').val("");
				} else {
					$('#edu2').hide();
					$('#edu1').show();
					var seap_h2 = $('#dragDiv4').height() - 58;
					$('.monitor_pos2 .seap').css({
						'height' : seap_h2
					});

				}

				$('.school_name_msg').hide();
				$('.school_name_msg').html("");
				$('.college_level_msg').hide();
				$('.college_level_msg').html("");
				$('.zhuanye_name_msg').hide();
				$('.zhuanye_name_msg').html("");
				$('.ed_time_msg').hide();
				$('.ed_time_msg').html("");
				myfun();
			});

	// 自我描述默认
	$('#self_description3 .default').live("click", function() {
		$('#self_description3').hide();
		$('#self_description2').show();
		myfun();
	});
	// 鼠标滑过点击出现
	$('#self_description1').live('mouseover', function() {
		$('#self_description1 .span_edit').show();
		$('#self_description1 .span_del').show();
	});

	$('#self_description1').live('mouseout', function() {
		$('#self_description1 .span_edit').hide();
		$('#self_description1 .span_del').hide();
	});
	// 自我描述编辑
	$('#self_description1 .span_edit').live("click", function() {
		var text = $("#self_des").html().replace(reg2, '\n');
		$('#my_description').val(text);
		$('#self_description1').hide();
		$('#self_description2').show();
		myfun();
	});
	// 删除
	$('#self_description1 .span_del').live("click", function() {
		$('#self_description3').show();
		$('#self_description1').hide();
		$('.self_description').html('');
		$('#my_description').val('');

		deletes(1);
		// $('#dragDiv6').remove();
	});

	// 学历下拉处理2015-02-05

	// 个人资料
	$('#self_info1').live('mouseover', function() {
		$('#self_info1 .edit_pen').show();
	});
	$('#self_info1').live('mouseout', function() {
		$('#self_info1 .edit_pen').hide();
	});
	$('#self_info1 .edit_pen').live("click", function() {
		$('#self_info1').hide();
		$('#self_info2').show();
		// 姓名
		$("#online_name").val($(".Resume_conCenter em").text());
		// 性别
		if (gender_cd == "1") {
			$(".sex_choose .boy").addClass("boyChoosed");
			$(".sex_choose .girl").removeClass("girlChoosed");
		} else if (gender_cd == "2") {
			$(".sex_choose .boy").removeClass("boyChoosed");
			$(".sex_choose .girl").addClass("girlChoosed");
		}

		var str = "";
		// 学历
		str = $(".p_educate").text();
		if (str == "") {
			str = "学历";
		}
		$("#max_xueli").text(str);
		$("#xueli").val(college_level);
		// 经验

		if (workyears == "0") {
			str = "应届生";
		} else if (workyears == "10") {
			str = "10年以上";
		} else if (workyears != "") {
			str = workyears + "年";
		}
		$("#work_time").text(str);
		$("#workyears").val(workyears);

		// 当前状态
		$(".current_state").text($(".currentstate").text());
		$("#state").val(currentstate);
		// 电话
		$("#phone").val($(".phone").text());
		// 邮箱
		$("#email").val($(".email").text());
		// 生日
		if (birthday_year != "") {
			$("#year").val(birthday_year);
			$("#year").siblings(".seles_choose").text(birthday_year);
		} else {
			$("#year").val("");
			$("#year").siblings(".seles_choose").text("出生年");
		}
		if (birthday_month != "") {
			$("#month").val(birthday_month);
			$("#month").siblings(".seles_choose").text(birthday_month);
		} else {
			$("#month").val("");
			$("#month").siblings(".seles_choose").text("出生月");
		}
		if (birthday_day != "") {
			$("#day").val(birthday_day);
			$("#day").siblings(".seles_choose").text(birthday_day);
		} else {
			$("#day").val("");
			$("#day").siblings(".seles_choose").text("出生日");
		}

		// 生日状态
		$("#birthday_flag").val(birthday_flag);
		var str2 = "";
		if (birthday_flag == "0") {
			str2 = "公开,完整显示";
		} else if (birthday_flag == "1") {
			str2 = "只显示星座";
		} else if (birthday_flag == "2") {
			str2 = "只显示月日";
		} else if (birthday_flag == "3") {
			str2 = "保密哦";
		}
		$("#birthday_flag").siblings(".seles_choose").text(str2);

		// 站点
		var weibo = $('.Resume_three_wb').attr('v');
		var github = $('.Resume_three_cat').attr('v');
		var zhanku = $('.Resume_three_zk').attr('v');
		if (weibo != "" && weibo != null) {
			$('.weibo').val(weibo);
		}
		if (github != "" && github != null) {
			$('.github').val(github);
		}
		if (zhanku != "" && zhanku != null) {
			$('.zhanku').val(zhanku);
		}
		
		myfun();
	});

	// 保存
	$('.zpzs_save').live("click", function() {
		$('#works2').hide();
		$('#works1').show();
	});
	// 取消
	$('.zpzs_cancel').live("click", function() {
		$('#works2').hide();
		$('#works1').show();
	});

	// 更多作品
	$('.more_works').live("click", function() {
		$('#works2').show();
	});

	// 右侧点击标签删除
	$('.label_box span').live('click', function() {
		$(this).remove();
	});

	$('.add_span span').live("click",function() {
				var inputCON = $('.add_span input').val();
				if (inputCON.length > 7) {
					alert("不能超过七个字");
					return;
				}
				var nodes = document.getElementById("label_box")
						.getElementsByTagName("span");
				var flag = 0;
				for ( var i = 0; i < nodes.length; i++) {
					var str = nodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"");
					if (str == inputCON) {
						flag = 1;
						break;
					}
				}
				if (flag == 0) {
					$('.label_box').append('<span>' + inputCON + '</span>');
					$('.add_span input').val("");
				}
			});
	$('.box_mb_labels div').live(
			'click',
			function() {
				var con = $(this).text().replace(/(^\s*)|(\s*$)/g, "");
				var nodes = document.getElementById("label_box")
						.getElementsByTagName("span");
				var flag = 0;
				for ( var i = 0; i < nodes.length; i++) {
					var str = nodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,
							"");
					if (str == con) {
						flag = 1;
						break;
					}
				}
				if (flag == 0) {
					$('.label_box').append('<span>' + con + '</span>');
				}
			});

	// 单个编辑
	$('.experience_list').live('mouseover', function() {
		$(this).find('.experience_con p i').show();
	});
	$('.experience_list').live('mouseout', function() {
		$(this).find('.experience_con p i').hide();
	});

	// 教育背景鼠标滑过显示删除修改按钮
	$('.experience_con_jybj').live('mouseover', function() {
		$(this).find('i').show();
	});
	$('.experience_con_jybj').live('mouseout', function() {
		$(this).find('i').hide();
	});
	// 项目经验鼠标滑过显示删除修改按钮
	$('.xiangmujingyan').live('mouseover', function() {
		$(this).find('i').show();
	});
	$('.xiangmujingyan').live('mouseout', function() {
		$(this).find('i').hide();
	});

	// 我的标签取消
	$('.my_labels .cancel').live('click', function() {
		$('.my_labels_edit').hide();
		$('.labelBox').show();
		myfun();
	});

	$('.labelBox .edit_pen').live('click', function() {
		if (tags != null && tags != "") {
			$('.label_box').html("");
			var ts = tags.split(',');
			for ( var i = 0; i < ts.length; i++) {
				$('.label_box').append('<span>' + ts[i] + '</span>');
			}
		}
		$('.add_span').find('input').val('');
		$('.labelBox').hide();
		$('.my_labels_edit').show();
		myfun();
	});
	$('.labelAdd a').live('click', function() {
		$('.labelBox').hide();
		$('.my_labels_edit').show();
	});

	// 添加技能
	$('#zyjn3 .default').live('click', function() {
		$('#add').html("");
		$('#zyjn3').hide();
		$('#zyjn2').show();
		myfun();
	});

	// 技能编辑删除
	$('#zyjn1').live('mouseover', function() {
		$('#zyjn1 .span_edit ').show();
		$('#zyjn1 .span_del ').show();
	});
	$('#zyjn1').live('mouseout', function() {
		$('#zyjn1 .span_edit ').hide();
		$('#zyjn1 .span_del').hide();
	});

	// 编辑专业技能
	$('#zyjn1 .span_edit').live('click',function() {
		$('.add_cons').html('');
		$(".jineng_div .jineng_label").each(function() {
			var str = $(this).text();
			if (str != "") {
				$('.add_cons').append('<li><i>'+ str+ '</i><em class="list_em"></em></li>');
			}
		});
         
		$('#zyjn1').hide();
		$('#zyjn2').show();
		myfun();
	});

	$('#zyjn1 .span_del ').live('click', function() {
		$('#zyjn1').hide();
		$('#zyjn3').show();
		$('.jineng_div').html('');
		$('#add').html('');
		deletes(2);
	});

	// 自我描述鼠标滑过
	$('#self_description1').live('mouseover', function() {
		$('#self_description1 .span_edit ').show();
		$('#self_description1 .span_del ').show();
	});
	$('#self_description1').live('mouseout', function() {
		$('#self_description1 .span_edit ').hide();
		$('#self_description1 .span_del').hide();
	});

	// 公司名称
	$('.gsmc_la .gsmc').keyup(function() {
		$('.gsmc_la ul').slideDown();
	});

	$('.gsmc_la li').live('click', function() {
		var liCon = $(this).text();
		$('.gsmc_la input').val(liCon);
		$('.gsmc_la ul').hide();
	});

	// 微博获得焦点字体颜色变黑
	// $('.show_wb input').focus(function(){
	// $(this).css('color','#474747');
	// });

	// $('.show_wb input').blur(function(){
	// $(this).css('color','#bfbfbf');
	// });

	// 删除不要的项目
	$('.show_wb font').live('click', function() {
		$(this).parent().remove();
	});

	// 鼠标获得焦点后边框颜色变化
	// $('.edit_list input').focus(function(){
	// $(this).addClass('blue_border');
	// });
	// $('.edit_list input').blur(function(){
	// $(this).removeClass('blue_border');
	// });

	// 期望职位相关
	$('.li_div').live(
			'mouseover',
			function() {
				$(this).css({
					'z-index' : '10'
				}).find('span').addClass('bg');
				$(this).find('ul').show();
				$(this).siblings().css({
					'z-index' : '0'
				}).find('span').removeClass('bg');
				$(this).siblings().find('ul').hide();
				$(this).parents('.divides').siblings('.divides')
						.find('.li_div').css({
							'z-index' : '0'
						}).find('span').removeClass('bg');
				$(this).parents('.divides').siblings('.divides')
						.find('.li_div').find('ul').hide();
			});

	$('.li_div').live('mouseout', function() {
		$(this).css({
			'z-index' : '0'
		}).find('span').removeClass('bg');
		$(this).find('ul').hide();

	});

	// 期望职位点击
	$('.li_div span').live("click", function() {
		var spancon = $(this).text().replace(/(^\s*)|(\s*$)/g, "");
		var vacon = $('.hope_job').val();
		var str = vacon.split(" ");
		if (str.length >= 3) {
			alert("最多选择三项");
			return;
		}
		for ( var i = 0; i < str.length; i++) {
			if (str[i] != "" && str[i] == spancon) {
				return;
				;
			}
		}
		if (vacon == "") {
			vacon = spancon;
		} else {
			vacon = vacon + " " + spancon;
		}
		$('.hope_job').val(vacon);
	});

	$('.li_div ul li').live("click", function() {
		var spancon = $(this).text().replace(/(^\s*)|(\s*$)/g, "");
		var vacon = $('.hope_job').val();
		var str = vacon.split(" ");
		if (str.length >= 3) {
			alert("最多选择三项");
			return;
		}
		for ( var i = 0; i < str.length; i++) {
			if (str[i] != "" && str[i] == spancon) {
				return;
				;
			}
		}
		if (vacon == "") {
			vacon = spancon;
		} else {
			vacon = vacon + " " + spancon;
		}
		$('.hope_job').val(vacon);
	});
	
	//设置默认简历
	$('.default_jianli li').live('click',function(){
		var text =  $('.default_jianli').siblings('span').text();
		var v = $(this).attr('v');
		if(v == 1){
			if(jianli_flag == ""){
				alert("您还没有上传附件简历");
				return;
			}
		}else if(v == default_jianli){
			return;
		}
		
		var param = new Object();
		param.param1 = v;
		jQuery.ajax({   
            type: 'post',   
	          contentType : 'application/json; charset=utf-8',   
	          dataType: 'json',   
	          url:BaseJSURL + '/mr/set', 
	          data: JSON.stringify(param),   
	          success: function(data){
	        	  var text = "";
	        	  if(v == 0){
	        		  text = "在线简历";
	        	  }else{
	        		  text = "附件简历";
	        	  }
	        	  default_jianli = v;
	        	   $('.default_jianli').siblings('span').text(text);
	          }
		});
	});
	
	$('.close_fujian').click(function(){
        $('.resumejl_pos').hide();
        $('.hsbj').hide();
    });
	
	$('.Resume_three a').live('click',function(){
		var str = $(this).attr('v');
		if(str.indexOf('http://') < 0){
			str = "http://" + str;
		}
		window.open(str);
	});
	
	$('.a2').live('click',function(){
		$('.qiujian').show();
		$('.online_left').hide();
	});
	
	$('.upload_a').live('click',function(){
		if(jianli_flag != "" && jianli_flag != null){
		  
		}else{
			 document.getElementById('f_jianli').click();
		}
	});

});

//预览附件简历
function yulan(){
	   jQuery.ajax({   
	          type: 'post',   
	          contentType : 'application/json; charset=utf-8',   
	          dataType: 'json',   
	          url:BaseJSURL +  '/mr/gethtml', 
	          data: {},   
	          success: function(date){
	             if(date.ret == 0)
	             {
	                $('.fujian_yulan').attr('src',"http://f.neipin.com/pdfJs/pdf.html?file=/jianli/html/"+date.html.html_name);
	                center($('.resumejl_pos'));
	                $('.resumejl_pos').show();
	                $('.hsbj').show();
	             }
	          }
	    });
}

//删除附件简历
function deleteresume(){
		 jQuery.ajax({   
	         type: 'post',   
	         contentType : 'application/json; charset=utf-8',   
	         dataType: 'json',   
	         url:BaseJSURL +  '/ro/delfujian', 
	         data: {},   
	         success: function(date){
	        	 jianli_flag = "";
	        	 $('.upload_a').text("上传简历");
	        	 $('.upload_a').addClass('a3');
	        	 $('.upload_a').removeClass('a4');
	         }
		 });
}

function onoff(v){
	var param = new Object();
	param.param1 = v;
	jQuery.ajax({ 	  
       type: 'post',   
       contentType : 'application/json; charset=utf-8',   
       dataType: 'json',   
       url: BaseJSURL + '/ro/onoff', 
       data: JSON.stringify(param),   
       success: function(data){
       	if(data.ret == 0){
       		if(v == '1'){
       			$('.on').show();
       			$('.off').hide();
       		}else{
       			$('.on').hide();
       			$('.off').show();
       		}
       	}else if(data.ret == -1){
       		pop("系统繁忙请稍后再试!");
       	}
       }
	});
}