@extends('layout.master')
@if($data["type"] == 1)
    @section('title', '个人中心')
    @section('custom-style')
       <link media="all" href="{{asset('style/ResumePreview.css?v=2.40')}}" type="text/css" rel="stylesheet">
       <link media="all" href="{{asset('style/onlineresume.css?v=2.40')}}" type="text/css" rel="stylesheet">
       <link href="{{asset('style/base.css?v=2.39')}}" type="text/css" rel="stylesheet">
        <link href="{{asset('style/style_qq.css?v=2.33')}}" type="text/css" rel="stylesheet">
        <script src="{{asset('js/')}}" type="text/javascript"></script> 
        <script src="{{asset('js/choose.js?v=2.33')}}" type="text/javascript"></script>
        <script src="{{asset('js/placeholder.js?v=2.32')}}" type="text/javascript"></script>
        <script src="{{asset('js/progressbar.js?v=2.32')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/constants.js?v=2.32')}}" type="text/javascript"></script>
        <script src="{{asset('js/onlineresume.js?v=2.38')}}" charset="utf-8" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/ajaxfileupload.js?v=2.32')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/common.js?v=2.34')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/selectphoto.js?v=2.32')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/jquery.imgareaselect.pack.js')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/loading.js?v=2.32')}}" type="text/javascript"></script>

        <script defer="defer" src="{{asset('js/center.js?v=2.32')}}" type="text/javascript"></script> 
        <style>
        .containter{    
            width: 1200px;
            margin: 0 auto;
            padding-bottom: 15px;
            margin-top: 36px;
        }
        </style>
    @endsection
    @section('content')
            
    <script type="text/javascript">
      var tu=1;
      var x1="";
      var y1="";
      var x2="";
      var y2="";
      var photourl="";
      var paotow="300";
      var paotoh="300";
      var hexFrm = 300;
      var reffer = "";
      var gender = "1";
      var gender_cd = "1";
      var reg=new RegExp("\n","g");
      var reg2=new RegExp("<br>","g");      
      var bar_num = parseInt("20");
      
      var college_level = "2";
      var workyears = "1"
      var currentstate = "4";
      var birthday_year = "";
      var birthday_month = "";
      var birthday_day = "";
      var birthday_flag = "0";
      var site_one_content = "";
      var site_one = "";
      var site_two_content = "";
      var site_two = "";
      var site_three_content = "";
      var site_three = "";
      
      
      var salary_text = "6K-8K";
      var salary_num = "3";
      var new_location = "深圳";
      var job_type = "";
      var industry_cd = "12,13,4";
      var guimo_cd = "";
      
      var tags = "";
      
      var default_jianli = "";
      var jianli_flag = "";
      $(function(){
         // updatebar();
        // 去掉简历完整度
        if($.browser.msie) { 
          $('.myhidden').hide();
        }
        else{
          $('.myhidden').show();
        }
        // 关闭按钮
        $('.sucess_title i').click(function(){
          $(this).parents('.fujian_ie').hide();
          $('.hsbj').hide();
        })
        // 确定
        $('.sucess_then a').click(function(){
          $(this).parents('.fujian_ie').hide();
          $('.hsbj').hide();
        })
            
            //工作经历编辑按钮
        $('.gzjl_div .edit_i').live('click',function(){
            var workid = $(this).attr("id");
            $(".work_id").val(workid);
            //公司名称
            $('#company_name').val($(this).parent().siblings(".company_name").text());
            //职位名称
            $('#position_name').val($(this).parent().siblings("p").find(".position_name").text());
            //开始时间
            $('#start_year').text($(this).parent().siblings(".start_year").val());
            $('#start_month').text($(this).parent().siblings(".start_month").val());
            $('#jl_s_year').val($(this).parent().siblings(".start_year").val());
            $('#jl_s_month').val($(this).parent().siblings(".start_month").val());
            //结束时间
            $('#end_year').text($(this).parent().siblings(".end_year").val());
            if($(this).parent().siblings(".end_year").val() != "至今"){
                $('#end_month').parent().show();
                $('#end_month').text($(this).parent().siblings(".end_month").val());
            }else{
                $('#end_month').parent().hide();
                $('#end_month').text($(this).parent().siblings(".end_month").val("离职月份"));
            }
            
            $('#jl_e_year').val($(this).parent().siblings(".end_year").val());
            $('#jl_e_month').val($(this).parent().siblings(".end_month").val());
            //公司领域
            $('.c_lingyu').text($(this).parent().siblings("p").find(".lingyuName").text());
            $('#c_lingyu').val($(this).parent().siblings(".lingyu_cd").val());
            var str = $(this).parent().siblings(".lingyu_cd").val();
            var cd = str.split(',');
            for(var i=0;i<cd.length;i++){
               if(cd[i] != ''){
                  $(".company_lingyu ."+cd[i]).addClass('addcss');
               }
            }
            //公司规模
            var t = $(this).parent().siblings("p").find(".guimoName").text()
            if(t == null || t==""){
              $('.c_guimo').text("公司规模");
            }else{
               $('.c_guimo').text(t);
            }
            
            $('#c_guimo').val($(this).parent().siblings(".company_guimo").val());
            //职位描述
            $('#c_description').val($(this).parent().siblings(".description").val().replace(reg2,'\n'));
           
            $('#gzjl1').hide();
            $('#gzjl2').show();
            
            myfun();
        });
        
          // 更多经历点击添加经历
         $('.more_jl').live("click",function(){
         
              $(".work_id").val("");
              //公司名称
            $('#company_name').val("");
            //职位名称
            $('#position_name').val("");
            //开始时间
            $('#start_year').text("入职年份");
            $('#start_month').text("入职月份");
            $('#jl_s_year').val("");
            $('#jl_s_month').val("");
            //结束时间
            $('#end_year').text("离职年份");
            $('#end_month').text("离职月份");
            $('#jl_e_year').val("");
            $('#jl_e_month').val("");
            //公司领域
            $('.c_lingyu').text("公司领域");
            $('#c_lingyu').val("");
            $(".company_lingyu div").removeClass('addcss');
            //公司规模
            $('.c_guimo').text("公司规模");
            $('#c_guimo').val("");
            //职位描述
            $('#c_description').val("");
              $('#gzjl2').show();
              if($.browser.msie) { 
                $('#company_name').val("公司名称");     
            $('#position_name').val("职位名称");        
            $('#c_description').val("请具体描述你的工作内容，有助于公司全面了解你的工作能力哦~");
              } 
              myfun();
         });
         
         
         //删除工作经历
         $('.gzjl_div .del_i').live('click',function(){
              var workId = $(this).attr("id");
              var param = new Object();
              param.param1 = workId;
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/dwork', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                       $('.gzjl_div .'+workId).remove();
                       if(document.getElementById('gzjl_div').innerHTML.replace(/(^\s*)|(\s*$)/g,"") == ""){
                          $(".work_id").val("");
                    //公司名称
                  $('#company_name').val("");
                  //职位名称
                  $('#position_name').val("");
                  //开始时间
                  $('#start_year').text("入职年份");
                  $('#start_month').text("入职月份");
                  $('#jl_s_year').val("");
                  $('#jl_s_month').val("");
                  //结束时间
                  $('#end_year').text("离职年份");
                  $('#end_month').text("离职月份");
                  $('#jl_e_year').val("");
                  $('#jl_e_month').val("");
                  //公司领域
                  $('.c_lingyu').text("公司领域");
                  $('#c_lingyu').val("");
                  $(".company_lingyu div").removeClass('addcss');
                  //公司规模
                  $('.c_guimo').text("公司规模");
                  $('#c_guimo').val("");
                  //职位描述
                  $('#c_description').val("");
                          $('#gzjl1').hide();
                          $('#gzjl3').show();
                          
                           updatebar();
                           
                       }
                       myfun();
                     }
                   }
                 });
           });
           
        
        //项目经验编辑
        $('.xmjy_div .edit_i').live('click',function(){
              var projectid = $(this).attr("id");
            $(".project_id").val(projectid);
            //项目名称
            $('#project_name_jy').val($(this).parent().siblings(".project_name").text());
            //职位名称
            $('#position_name_jy').val($(this).parent().siblings(".experience_con").find(".project_position").text());
            //开始时间
            var sty = $(this).parent().siblings(".experience_con").find(".start_year").val();
            if(sty == null || sty == ""){
               $('#start_year_jy').text("开始年份");
            }else{
               $('#start_year_jy').text(sty);
            }
            
            var stm = $(this).parent().siblings(".experience_con").find(".start_month").val();
            if(stm == null || stm == ""){
               $('#start_month_jy').text("开始月份");
            }else{
               $('#start_month_jy').text(stm);
            }
            
            $('#jy_s_year').val(sty);
            $('#jy_s_month').val(stm);
            
            
            
            //结束时间
            var ety = $(this).parent().siblings(".experience_con").find(".end_year").val();
            if(ety == null || ety == ""){
               $('#end_year_jy').text("结束年份");
            }else{
               $('#end_year_jy').text(ety);
            }
             //$('#end_year').text($(this).parent().siblings(".end_year").val());
            
           var etm = "";
            if(ety != "至今"){
                $('#end_month_jy').parent().show();
                etm = $(this).parent().siblings(".experience_con").find(".end_month").val();
                if(etm == null || etm == ""){
                   $('#end_month_jy').text("结束月份");
                }else{
                    $('#end_month_jy').text(etm);
                }
            }else{
               $('#end_month_jy').parent().hide();
               $('#end_month_jy').text("结束月份");
            }
            $('#jy_e_year').val(ety);
            $('#jy_e_month').val(etm);
            
            //职位描述
            $('#jy_description').val($(this).parent().siblings(".experience_con").find(".description").val().replace(reg2,'\n'));
            
              $('#item_exprience2').show();
                  $('#item_exprience1').hide();
                  
                  myfun();
            });
            
             // 更多项目经验
         $('.more_xm').live("click",function(){
            $(".project_id").val("");
            //项目名称
            $('#project_name_jy').val("");
            //职位名称
            $('#position_name_jy').val("");
            //开始时间
            $('#start_year_jy').text("开始年份");
            $('#start_month_jy').text("开始月份");
            $('#jy_s_year').val("");
            $('#jy_s_month').val("");
            //结束时间
            $('#end_year_jy').text("结束年份");
            $('#end_month_jy').text("结束月份");
            $('#jy_e_year').val("");
            $('#jy_e_month').val("");
            //职位描述
            $('#jy_description').val("");
              
              $('#item_exprience2').show();
              
              if($.browser.msie) { 
                $('#project_name_jy').val("项目名称");        
            $('#position_name_jy').val("职务名称");       
            $('#jy_description').val("请具体描述你的项目内容，有助于公司全面了解你哦~");
              } 
              myfun();
         });
         
         //项目经验删除
        $('.xmjy_div .del_i').live('click',function(){
              var projectId = $(this).attr("id");
              var param = new Object();
              param.param1 = projectId;
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/dproject', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                       $('.xmjy_div .'+projectId).remove();
                       if(document.getElementById('xmjy_div').innerHTML.replace(/(^\s*)|(\s*$)/g,"") == ""){
                          $(".project_id").val("");
                  //项目名称
                  $('#project_name_jy').val("");
                  //职位名称
                  $('#position_name_jy').val("");
                  //开始时间
                  $('#start_year_jy').text("开始年份");
                  $('#start_month_jy').text("开始月份");
                  $('#jy_s_year').val("");
                  $('#jy_s_month').val("");
                  //结束时间
                  $('#end_year_jy').text("结束年份");
                  $('#end_month_jy').text("结束月份");
                  $('#jy_e_year').val("");
                  $('#jy_e_month').val("");
                  //职位描述
                  $('#jy_description').val("");
                          $('#item_exprience1').hide();
                          $('#item_exprience3').show();
                          
                           updatebar();
                          
                       }
                        myfun();
                     }
                   }
                 });
        });
        
        
        //教育背景编辑
        $('.jybj_div .edit_i').live('click',function(){
              var educationid = $(this).attr("id");
            $(".education_id").val(educationid);
            //学校名称
            $('#school_name').val($(this).parent().siblings(".jybj_fontbig").find(".school_name").text());
            //专业名称
            $('#zhuanye_name').val($(this).parent().siblings(".jybj_fontbig").find(".zhuanye_name").text());
            //学历
            var t = $(this).parent().siblings(".jybj_fontbig").find(".college_level").text();
            if(t == null || t == ""){
               $('#collegeLevel').text("学历");
            }else{
               $('#collegeLevel').text(t);
            }
            
            $('#college_level').val($(this).parent().siblings(".college").val());
            //开始时间
            $('#ruxue_time').text($(this).parent().siblings(".start_year").val());
            $('#ed_s_year').val($(this).parent().siblings(".start_year").val());
            //毕业时间
            $('#biye_time').text($(this).parent().siblings(".end_year").val());
            $('#ed_e_year').val($(this).parent().siblings(".end_year").val());
            //职位描述
            $('#ed_description').val($(this).parent().siblings(".description").val().replace(reg2,'\n'));
             
              $('#edu2').show();
                  $('#edu1').hide();
                  
                  myfun();
            });
            
             // 更多项目
         $('.more_xl').live("click",function(){
            $(".education_id").val("");
            //学校名称
            $('#school_name').val("");
            //专业名称
            $('#zhuanye_name').val("");
            //学历
            $('#collegeLevel').text("学历");
            $('#college_level').val("");
            //开始时间
            $('#ruxue_time').text("入学年份");
            $('#ed_s_year').val("");
            //毕业时间
            $('#biye_time').text("毕业年份");
            $('#ed_e_year').val("");
            //职位描述
            $('#ed_description').val("");
              
              $('#edu2').show();

              if($.browser.msie) { 
                $('#school_name').val("学校名称");      
            $('#zhuanye_name').val("专业名称");       
            $('#ed_description').val("请填写你的专业学习情况、社团实践活动、论文发表等，有助于公司全面了解你的学习和专业能力哦~");
              } 
              
              myfun();
         });
         
         //教育背景删除
        $('.jybj_div .del_i').live('click',function(){
              var educationId = $(this).attr("id");
              var param = new Object();
              param.param1 = educationId;
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/deduction', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                       $('.jybj_div .'+educationId).remove();
                       if(document.getElementById('jybj_div').innerHTML.replace(/(^\s*)|(\s*$)/g,"") == ""){
                          $(".education_id").val("");
                  //项目名称
                  $('#school_name').val("");
                  //职位名称
                  $('#zhuanye_name').val("");
                  //学历
                  $('#collegeLevel').text("学历");
                  $('#college_level').val("");
                  //开始时间
                  $('#ruxue_time').text("入学年份");
                  $('#ed_s_year').val("");
                  //毕业时间
                  $('#biye_time').text("毕业年份");
                  $('#ed_e_year').val("");
                  //职位描述
                  $('#ed_description').val("");
                          $('#edu1').hide();
                          $('#edu3').show();
                          
                          updatebar();
                          
                       }
                       myfun();
                     }
                  },
                  error: function (data,status,e){  
                  
                      }
                 });
                  
        });
            
            //判断自我描述
             $('#self_description3').show();
             $('#self_description1').hide();
        
        //专业技能
      
          if($.browser.msie) { 
            $('.upload_jianli').show();
            $('.upload_jianliie').show();
            $('.upload_jianli').click(function(){
              $('.fujian_ie').show();
              $('.hsbj').show();
            })
            $('.upload_works').css({'margin-left':'0px;'});
              $('.fileInput').css({'background':'none','width':'320px','padding-top':'10px'})
              $('.fileInput').empty();
              $('.fileInput').append('<input type="file" onchange="javascript:upload();" name="f_product"  id="f_product" style="width:220px"/>');
          } 
          
          //添加社交帐号
          $('.add_social span').live('click',function(){
                var num = document.getElementsByName("site_num").length;
                if(num > 2){
                  alert("只能添加三个社交帐号");
                  return;
                }
                var str = '';
                str = '  <div class="edit_list  edit_wb">'+
                      '  <em></em> ' +
                      '  <div class="seles seles_wb"> '+
                      '      <span class="seles_choose">新浪微博</span> '+
                      '      <ul class="seles_hide">'+
                      '      <li v="1">新浪微博</li>  '+             
                      '      <li v="2">Github</li>    '+           
                      '      <li v="3">站酷</li>'+
                      '      </ul>'+
                      '      <input id="site_num" name="site_num"  type="hidden"  value="1" class="input_hide"/>'+
                      '   </div>'+
                      '   <div class="wb_right">'+
                    '      <input type="text" id="site_content" name="site_content" value="" placeholder="请输入您的社交网址" class="social"/>'+
                    '      <font></font>'+
                    '   </div>'+
                      '   </div>';
               $(".site").append(str);
          });
          
           
            //删除社交帐号
            $('.wb_right font').live('click',function(){
                $(this).parent().parent().remove();
            });
        
        
        // 保存基本信息
        $('.self_info .save').click(function(){
          var param = new Object();
          //名字
          param.param1 = $('#online_name').val();
          //性别
          param.param2 = gender;
          // 学历
          param.param3 = $("#xueli").val();
          // 工作年限
          param.param4 = $("#workyears").val();
          // 手机号码
          param.param5 = $("#phone").val();
          //邮箱
          param.param6 = $("#email").val();
          //出生日期
          var year = $("#year").val();
          var month = $("#month").val();
          var day = $("#day").val();
          param.param7 = year + month + day;
          //显示方式
          param.param8 = $("#birthday_flag").val();
          //站点
          var site_num = document.getElementsByName("site_num");
          
          //站点序号  停用
             //param.param9 ="";
             //param.param10 ="";
             //param.param11 ="";
             //站点内容
             param.param12 = $('.weibo').val();
             if(param.param12 == "微博"){
                param.param12 = "";
             }
             param.param13 = $('.github').val();
             if(param.param13 == "github"){
                param.param13 = "";
             }
             param.param14 = $('.zhanku').val();
             if(param.param14 == "站酷"){
                param.param14 = "";
             }
          
          //目前状态
          param.param15 = $("#state").val();
          
          var flag = 0;
          //验证名字
          if(removeSpace(param.param1) == ""){
             $(".username_msg").show();
             $(".username_msg").text("请输入名字");
             flag = 1;
          }else{
             $(".username_msg").hide();
             $(".username_msg").text("");
          }
          //验证性别
          
          //验证学历
          if(param.param3 == null || param.param3 == ""){
             $(".xueli_msg").show();
             $(".xueli_msg").text("请选择学历");
              flag = 1;
          }else{
             $(".xueli_msg").hide();
             $(".xueli_msg").text("");
          }
          //验证工作年限
          if(param.param4 == null || param.param4 == ""){
             $(".workyears_msg").show();
             $(".workyears_msg").text("请选择学历");
              flag = 1;
          }else{
             $(".workyears_msg").hide();
             $(".workyears_msg").text("");
          }
          
           //验证手机
          if(telephone_ce(param.param5) == false){
             $(".phone_msg").show();
             $(".phone_msg").text("手机" + msa);
              flag = 1;
          }else{
             $(".phone_msg").hide();
             $(".phone_msg").text("");
          }
          
          //验证邮箱
          if(param.param6.length > 50){
              $(".email_msg").show();
              $(".email_msg").text("邮箱不能超过50字符");
              flag = 1;
          }else if(ToUpdateEmail(param.param6) == false){
           $(".email_msg").show();
             $(".email_msg").text("邮箱" + msa);
              flag = 1;
           }else{
             $(".email_msg").hide();
             $(".email_msg").text("");
          }
          
          //验证生日
          if(year == null || year == "" || year == "出生年" || month == null || month == "" || month == "出生月" || day == null || day == "" || day == "出生日"){
             $(".birthday_msg").show();
             $(".birthday_msg").text("请选择完整的生日");
              flag = 1;
           }else{
             $(".birthday_msg").hide();
             $(".birthday_msg").text("");
          }
          
          
          //验证目前状态
          if(param.param15 == null || param.param15 == ""){
             $(".state_msg").show();
             $(".state_msg").text("请选择状态");
              flag = 1;
          }else{
             $(".state_msg").hide();
             $(".state_msg").text("");
          }
         
          
           if(flag == 1){
              return;
           }
          
          jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/sbasic', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                         //名字
                         $('.Resume_conCenter em').text(param.param1);
                         //性别
                         if(param.param2 == 1){
                            $(".gender").addClass("boy");
                            $(".gender").removeClass("girl");
                         }else{
                            $(".gender").addClass("girl");
                            $(".gender").removeClass("boy");
                         }
                         //学历
                         $('.self_info .p_educate').text($('#max_xueli').text());
                         //工作年限
                         if(param.param4 == 0){
                              $('.self_info .p_gzjy').text('应届生');
                         }else if(param.param4 == 10){
                              $('.self_info .p_gzjy').text('10年以上工作经验');
                         }else{
                              $('.self_info .p_gzjy').text(param.param4+'年工作经验');
                         }
                         //生日
                         var birthday_type_value = "";
                         if(param.param8 == "0"){//公开
                             birthday_type_value = year + "年" + month + "月" + day + "日";
                         }else if(param.param8 == "1"){//星座
                             birthday_type_value = getConstellation(param.param7);
                         }else if(param.param8 == "2"){//月日
                             birthday_type_value =  month + "月" + day + "日";
                         }else{
                             birthday_type_value =  "生日保密";
                         }
                         $('.p_brithday').text(birthday_type_value);
                         //电话
                         $('.phone').text(param.param5);
                         //邮箱
                         $('.email').text(param.param6);
                         //求职状态
                         $('.currentstate').text($('.current_state').text());
                         
                         //站点
                         if(param.param12 != "" || param.param13 != "" || param.param14 != ""){
                            $('.Resume_three').show();
                         }else{
                            $('.Resume_three').hide();
                         }
                         if(param.param12 != ""){
                            $('.Resume_three_wb').show();
                            $('.Resume_three_wb').attr('v',param.param12);
                            
                         }else{
                            $('.Resume_three_wb').hide();
                            $('.Resume_three_wb').attr('v','');
                         }
                         
                          if(param.param13 != ""){
                            $('.Resume_three_cat').show();
                            $('.Resume_three_cat').attr('v',param.param13);
                         }else{
                            $('.Resume_three_cat').hide();
                            $('.Resume_three_cat').attr('v','');
                         }
                         
                          if(param.param14 != ""){
                            $('.Resume_three_zk').show();
                            $('.Resume_three_zk').attr('v',param.param14);
                         }else{
                            $('.Resume_three_zk').hide();
                            $('.Resume_three_zk').attr('v','');
                         }
                         
                         $('#self_info1').show();
                           $('#self_info2').hide();
                     }
                     
                     gender_cd = param.param2;
                     college_level = param.param3;
                     workyears = param.param4;
                     currentstate = param.param15;
                     birthday_year = year;
                     birthday_month = month;
                     birthday_day = day;
                     birthday_flag = param.param8;
                     
                       site_one_content = param.param12;
                 site_one = param.param9;
                 site_two_content = param.param13;
                 site_two = param.param10;
                 site_three_content = param.param14;
                 site_three = param.param11;
                  }
           });
        })
        
        // 保存期望工作
        $('.qwgz_save').live("click",function(){
              var param = new Object();
              //期望职位
              param.param1 ="";
              
              var str = $('.hope_job').val().replace(/(^\s*)|(\s*$)/g,"");
              str = str.split(' ');
              for(var i=0;i<str.length;i++){
                  if(str[i] != ''){
                     if(param.param1 == ""){
                        param.param1 = str[i];
                     }else{
                        param.param1 =param.param1 + ',' + str[i];
                     }
                  }
              }
              //期望薪资
              param.param2 = $("#salary").val();
              //期望领域
              param.param3 = $("#want_industry").val();
              //求职类型
              param.param4 = $("#job_type").val();
              //期望 城市
              param.param5 = $("#location").val();
              if(param.param5 == "其他"){
                param.param5 = $('.qita_input').val();
              }
              //期望规模
              param.param6 = $("#guimo").val();
              
              //简历完成度
             // param.param7 = bar_num;
              
              var flag = 0;
              //验证职位
              if(param.param1 == "期望职位" || removeSpace(param.param1) == ""){
                 param.param1 = "";
                 $('.want_position_msg').show();
                 $('.want_position_msg').text("请选择期望职位");
                 flag = 1;
              }else{
                 $('.want_position_msg').hide();
                 $('.want_position_msg').text("");
              }
              
              //验证薪资
              if(param.param2 == null || param.param2 == ""){
                 $('.want_salary_msg').show();
                 $('.want_salary_msg').text("请选择薪水");
                 flag = 1;
              }else{
                 $('.want_salary_msg').hide();
                 $('.want_salary_msg').text("");
              }
              //验证领域
              if(param.param3 == "期望领域" || param.param3.replace(/(^\s*)|(\s*$)/g,"") == ""){
             //    $('#lingyu_msg').show();
            //     $('#lingyu_msg').text("请选择期望领域");
             //    flag = 1;
              }else{
                $('#lingyu_msg').hide();
                 $('#lingyu_msg').text("");
              }
              
              //验证求职类型
              if(param.param4 == null || param.param4 == ""){
                // $('.job_type_msg').show();
                // $('.job_type_msg').text("请选择求职类型");
                // flag = 1;
              }else{
                // $('.job_type_msg').hide();
                // $('.job_type_msg').text("");
              }
              //验证城市
              if(param.param5 == null || removeSpace(param.param5) == "" || param.param5 == "其他城市"){
                 param.param5 = "";
                 $('.location_msg').show();
                 $('.location_msg').text("请选择期望城市");
                 flag = 1;
              }else{
                 $('.location_msg').hide();
                 $('.location_msg').text("");
              }
              
              //验证规模
              if(param.param6 == null || param.param6 == ""){
                 //$('.guimo_msg').show();
                 //$('.guimo_msg').text("请选择期望规模");
                 //flag = 1;
              }else{
                // $('.guimo_msg').hide();
                // $('.guimo_msg').text("");
              }
              
              if(flag == 1){
                 return;
              }
             
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/swwork', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                     
                         if( typeof parent.window.initdata3 == 'function' ){
                       parent.window.initdata3();
                }
                         //期望城市
                         if(param.param5 != ""){
                            $(".want_location").text(param.param5);
    //                        $(".want_location_l").show();
                         }else{
    //                        $(".want_location_l").hide();
                         }
                         //期望类型
                         if(param.param4 == "1"){
                            $(".want_type").text("实习");
    //                        $(".want_type_l").show();
                         }else if(param.param4 == "2"){
                            $(".want_type").text("兼职");
    //                        $(".want_type_l").show();
                         }else if(param.param4 == "3"){
                            $(".want_type").text("全职");
    //                        $(".want_type_l").show();   
                         }else{
    //                        $(".want_type_l").hide();
                         }
                         //期望薪资
                         $(".want_salary").text($('.w_salary').text());
                         //期望职位
                         if(param.param1 != ""){
                            $(".want_position").text($(".hope_job").val());
                            $(".want_position_l").show();
                         }else{
                            $(".want_position_l").hide();
                         }
                         //期望领域
                         if(param.param3 == ""){
                             $(".want_industry").text("");
                             $(".want_industry").parent().hide();
                         }else{
                             $(".want_industry").text($(".wantIndustry").text());
                             $(".want_industry").parent().show();
                         }
                         //期望规模
                         if(param.param6 != null && param.param6 != ""){
                          $(".want_guimo").parent().show();
                          $(".want_guimo").text($(".guimo").text());
                         }else{
                           $(".want_guimo").parent().hide();
                          $(".want_guimo").text("");
                         }
                         //$('.progressbar').attr('data-perc',param.param7);
                        // progressbar();
                         
                         $('#expect_con2').hide();
                             $('#expect_con1').show();
                     }
                     
                     salary_text = $(".w_salary").text();
                     salary_num = param.param2;
                     new_location = param.param5;
                     job_type = param.param4;
                     industry_cd = param.param3;
                     guimo_cd = param.param6;
                     myfun();
                  }
               });
        })
        
        
        $('#lizhiyear li').live('click',function(){
             var name = $(this).attr('v');
             if(name == "至今"){
                $('#end_month').parent().hide();
             }else{
                $('#end_month').parent().show();
             }
             
        });
        
        // 工作经历保存
        $('.gzjy_save').live("click",function(){
              
              var param = new Object();
              //公司名称
              param.param1 = $('#company_name').val();
              //职位名称
              param.param2 = $('#position_name').val();
              //开始时间
              var start_year = $('#jl_s_year').val();
              var start_month = $('#jl_s_month').val();
              param.param3 = start_year+"."+start_month;
              //结束时间
              var end_year = $('#jl_e_year').val();
              var end_month = $('#jl_e_month').val();
              if(end_year == "至今"){
                  param.param4 = end_year;
              }else{
                  param.param4 = end_year+"."+end_month;
              }
              
              //公司领域
              param.param5 = $('#c_lingyu').val();
              //公司规模
              param.param6 = $("#c_guimo").val();
              //职位描述
              param.param7 = $("#c_description").val().replace(reg,"<br>"); 
              if(param.param7 == "请具体描述你的工作内容，有助于公司全面了解你的工作能力哦~"){
                 param.param7 = "";
              }
              //工作ID
              param.param8 = $(".work_id").val();
              
              var flag  = 0;
              //验证公司名称
              if(removeSpace(param.param1) == "" || param.param1 == "公司名称" ){
                 $(".c_name_msg").show();
                 $(".c_name_msg").text("请填写公司名称");
                 flag = 1;
              }else{
                 $(".c_name_msg").hide();
                 $(".c_name_msg").text("");
              }
              //验证职位名称
              if(removeSpace(param.param2) == "" || param.param2 == "职位名称"){
                 $(".c_position_msg").show();
                 $(".c_position_msg").text("请填写职位名称");
                 flag = 1;
              }else{
                 $(".c_position_msg").hide();
                 $(".c_position_msg").text("");
              }
              //验证开始时间
              if(start_year == null || start_year == "" || start_month == null || start_month == ""){
                  $(".jl_s_msg").show();
                  $(".jl_s_msg").text("请选择完整入职年月");
                  flag = 1;
              }else if(end_year != "至今"){
                  //验证入职和离职时间合法性
                if(start_year > end_year){
                    $(".jl_s_msg").show();
                    $(".jl_s_msg").text("入职时间不能大于离职时间");
                    flag = 1;
                }else if(start_year == end_year){
                    if(start_month > end_month){
                        $(".jl_s_msg").show();
                      $(".jl_s_msg").text("入职时间不能大于离职时间");
                      flag = 1;
                    }else{
                        $(".jl_s_msg").hide();
                        $(".jl_s_msg").text("");
                    }
                }else{
                    $(".jl_s_msg").hide();
                    $(".jl_s_msg").text("");
                }
              }
              //验证结束时间
              if(end_year != "至今" && (end_year == null || end_year == "" || end_month == null || end_month == "")){
                  $(".jl_e_msg").show();
                  $(".jl_e_msg").text("请选择完整离职年月");
                  flag = 1;
              }else{
                 $(".jl_e_msg").hide();
                 $(".jl_e_msg").text("");
              }
             
              
              //验证领域
              if(param.param5 == null || param.param5 == ""){
                  $(".c_lingyu_msg").show();
                  $(".c_lingyu_msg").text("请选择公司领域");
                  flag = 1;
              }else{
                 $(".c_lingyu_msg").hide();
                 $(".c_lingyu_msg").text("");
              }
              //验证规模
              if(param.param6 == null || param.param6 == ""){
                  //$(".c_guimo_msg").show();
                  //$(".c_guimo_msg").text("请选择公司领域");
              }
              
              //验证职位描述
              if(param.param7.length > 500){
                  flag = 1;
                  $(".c_description_msg").show();
                  $(".c_description_msg").text("不能超过500字");
              }else{
                  $(".c_description_msg").hide();
                  $(".c_description_msg").text("");
              }
              
              if(flag == 1){
                return;
              }
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/swork', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                        if(param.param8 != null && param.param8 != ""){//ID存在的时候为更新
                            if(param.param6 != "" && param.param6 != null){
                               $(".gzjl_div  ." + param.param8 +" .emi").show();
                            }else{
                               $(".gzjl_div  ." + param.param8 +" .emi").hide();
                            }
                        
                        
                            $(".gzjl_div  ." + param.param8 +" .work_time").text(param.param3+"-" + param.param4);
                            $(".gzjl_div  ." + param.param8 +" .start_year").val(start_year);
                            $(".gzjl_div  ." + param.param8 +" .start_month").val(start_month);
                            $(".gzjl_div  ." + param.param8 +" .end_year").val(end_year);
                            $(".gzjl_div  ." + param.param8 +" .end_month").val(end_month);
                            $(".gzjl_div  ." + param.param8 +" .lingyu_cd").val(param.param5);
                            $(".gzjl_div  ." + param.param8 +" .company_guimo").val(param.param6);
                            $(".gzjl_div  ." + param.param8 +" .description").val(param.param7);
                            $(".gzjl_div  ." + param.param8 +" .company_name").text(param.param1);
                            $(".gzjl_div  ." + param.param8 +" .position_name").text(param.param2);
                            $(".gzjl_div  ." + param.param8 +" .lingyuName").text($(".c_lingyu").text());
                            $(".gzjl_div  ." + param.param8 +" .guimoName").text($(".c_guimo").text());
                            $(".gzjl_div  ." + param.param8 +" .experienceCon").html(param.param7);
                           // $(".gzjl_div  ." + param.param8 +" .experience_img").attr('src','http://f.neipin.com/photo/company/'+data.logo);
                        }else{//id不存在的时候为添加
                          var str = "";
                          str =  '<div class="experience_list '+data.work_id+'" id="'+data.work_id+'">'+
                                 '   <div class="experience_con">'+
                                 '        <p class="pos_p_add"><i class="edit_i" id="' +data.work_id+ '"></i><i class="del_i" id="' +data.work_id+ '"></i></p>'+
                                 '        <p class="company_name">' +param.param1+ '</p>'+
                                 '        <input type="hidden" value="'+start_year+'" class="start_year" />'+
                                 '        <input type="hidden" value="'+start_month+'" class="start_month" />'+
                                 '        <input type="hidden" value="'+end_year+'" class="end_year" />'+
                                 '        <input type="hidden" value="'+end_month+'" class="end_month" />'+
                                 '        <input type="hidden" value="'+param.param5+'" class="lingyu_cd" />'+
                                 '        <input type="hidden" value="'+param.param6+'" class="company_guimo" />'+
                                 '        <input type="hidden" value="'+param.param7+'" class="description" />'+
                                 '        <p>'+
                       '       <span class="work_time" style="margin-left: 0px;">' +param.param3 +'-' + param.param4 +'</span>'+
                       '       <span class="position_name">'+param.param2+'</span><em>|</em>'+
                       '       <span class="lingyuName">'+$(".c_lingyu").text()+'</span>';
                       var guimo = $(".c_guimo").text();
                              if(guimo != "" && guimo != "公司规模"){
                  str +='      <em class="emi">|</em>'+ 
                           '           <span class="guimoName">'+$(".c_guimo").text()+'</span>';
                       }else{
                  str +='      <em class="emi" style="display:none;">|</em>'+ 
                           '           <span class="guimoName"></span>';     
                       }
                  str +='         </p>'+
                             '         <div class="experienceCon experienceCon_top10">'+param.param7+'</div>'+
                                 '   </div>'+
                                 '   <div class="link_seap"></div>               '+     
                                 '</div>';
                           $(".gzjl_div").append(str);
                           
                             updatebar();
                           
                       }
                       
                       
                          $('#gzjl2').hide();
                          $('#gzjl1').show();
                          
                          myfun();
                     }
                  }
               });
        })
        
        
        $('#jieshuyear li').live('click',function(){
             var name = $(this).attr('v');
             if(name == "至今"){
                $('#end_month_jy').parent().hide();
             }else{
                $('#end_month_jy').parent().show();
             }
             
        });
        
        // 项目经验保存
        $('.xmjy_save').live("click",function(){
              var param = new Object();
              //公司名称
              param.param1 = $("#project_name_jy").val();
              //职务名称
              param.param2 = $("#position_name_jy").val();
              //开始时间
              var start_year = $("#jy_s_year").val();
              var start_month = $("#jy_s_month").val();
              param.param3 = start_year + "." +start_month;
              //结束时间
              var end_year = $("#jy_e_year").val();
              var end_month = $("#jy_e_month").val();
              if(end_year == "至今"){
                 param.param4 = end_year;
              }else{
                 param.param4 = end_year + "." + end_month;
              }
              
              //项目描述
              param.param5 = $("#jy_description").val().replace(reg,"<br>"); 
              if(param.param5 == "请具体描述你的项目内容，有助于公司全面了解你哦~"){
                  param.param5 = "";
              }
              //项目ID
              param.param6 = $(".project_id").val();
              
              
              var flag = 0;
              //验证项目名称
              if(removeSpace(param.param1) == "" || param.param1 == "项目名称"){
                  $('.company_name_jy_msg').text("请填写项目名称");
                  $('.company_name_jy_msg').show();
                  flag = 1;
              }else{
                  $('.company_name_jy_msg').text("");
                  $('.company_name_jy_msg').hide();
              }
              //验证职务名称
              if(removeSpace(param.param2) == "" || param.param2 == "职务名称"){
                  $('.position_name_jy_msg').text("请填写职务名称");
                  $('.position_name_jy_msg').show();
                  flag = 1;
              }else{
                  $('.position_name_jy_msg').text("");
                  $('.position_name_jy_msg').hide();
              }
              //验证开始时间
              if(start_year == null || start_year == "" || start_month == null || start_month == ""){
                  $('.jy_s_msg').text("请选择正确时间");
                  $('.jy_s_msg').show();
                  flag = 1;
              }else if(end_year != "至今"){
                       //验证开始时间和结束时间合法性
                  if(start_year > end_year){
                      $('.jy_s_msg').text("项目开始时间不能大于项目结束时间");
                      $('.jy_s_msg').show();
                      flag = 1;
                  }else if(start_year == end_year){
                      if(start_month > end_month){
                          $('.jy_s_msg').text("项目开始时间不能大于项目结束时间");
                        $('.jy_s_msg').show();
                        flag = 1;
                      }else{
                          $('.jy_s_msg').text("");
                        $('.jy_s_msg').hide();
                      }
                  }else{
                       $('.jy_s_msg').text("");
                     $('.jy_s_msg').hide();
                  }
              }
              
              //验证结束时间
              if(end_year != "至今" && (end_year == null || end_year == "" || end_month == null || end_month == "")){
                  $('.jy_e_msg').text("请选择正确时间");
                  $('.jy_e_msg').show();
                  flag = 1;
              }else{
                  $('.jy_e_msg').text("");
                  $('.jy_e_msg').hide();
              }
              
              //验证项目描述
              if(param.param5.length > 500){
                 flag = 1;
                 $(".jy_description_msg").show();
                 $(".jy_description_msg").text("不能超过500字");
              }else{
                 $(".jy_description_msg").hide();
                 $(".jy_description_msg").text("");
              }
              
              if(flag == 1){
                return;
              }
              
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/sproject', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                          if(param.param6 != null && param.param6 != ""){//ID存在的时候为更新
                            $(".xmjy_div  ." + param.param6 +" .project_time").html(param.param3+'-' +param.param4+'<span class="project_position">' +param.param2+ '</span>');
                            $(".xmjy_div  ." + param.param6 +" .start_year").val(start_year);
                            $(".xmjy_div  ." + param.param6 +" .start_month").val(start_month);
                            $(".xmjy_div  ." + param.param6 +" .end_year").val(end_year);
                            $(".xmjy_div  ." + param.param6 +" .end_month").val(end_month);
                            $(".xmjy_div  ." + param.param6 +" .description").val(param.param5);
                            $(".xmjy_div  ." + param.param6 +" .project_name").text(param.param1);
                            $(".xmjy_div  ." + param.param6 +" .project_position").text(param.param2);
                            $(".xmjy_div  ." + param.param6 +" .experienceCon").html(param.param5);
                          }else{//id不存在的时候为添加
                            var str = '';
                              str ='<div class="experience_list xiangmujingyan '+data.project_id+'" id="'+data.project_id+'">'+
                                     '    <p class="project_name">' +param.param1+ '</p>  '+
                               '    <div class="experience_con">'+
                               '         <input type="hidden" value="'+start_year+'" class="start_year" />'+
                               '         <input type="hidden" value="'+start_month+'" class="start_month" />'+
                               '         <input type="hidden" value="'+end_year+'" class="end_year" />'+
                               '         <input type="hidden" value="'+end_month+'" class="end_month" />'+
                               '         <input type="hidden" value="'+param.param5+'" class="description" />'+
                               '         <p class="project_time">' +param.param3+ '-' + param.param4 + '<span class="project_position">' +param.param2+ '</span></p>'+
                               '         <div class="experienceCon experienceCon_top10">'+param.param5+'</div>'+
                               '    </div>'+
                               '    <div class="edit_pos xiangmujingyan"><i class="edit_i" id="'+data.project_id+'"></i><i class="del_i" id="'+data.project_id+'"></i></div>'+
                                   '</div>';
                                   
                             $('.xmjy_div').append(str);
                             
                                updatebar();
                             
                           }  
                           
                           
                         $('#item_exprience2').hide();
                         $('#item_exprience1').show();
                         myfun();
                     }
                  }
               });
        })
        
        // 教育背景保存
        $('.jybj_save').live("click",function(){
          
              var param = new Object();
              //学校名称
              param.param1 = $("#school_name").val();
              //学历
              param.param2 = $("#college_level").val();
              //专业名称
              param.param3 = $("#zhuanye_name").val();
              //开始时间
              param.param4 = $("#ed_s_year").val();
              //结束时间
              param.param5 = $("#ed_e_year").val();
              //学习描述
              param.param6 = $("#ed_description").val().replace(reg,'<br>');
              if(param.param6 == "请填写你的专业学习情况、社团实践活动、论文发表等，有助于公司全面了解你的学习和专业能力哦~"){
                  param.param6 = "";
              }
              //教育ID
              param.param7 = $(".education_id").val();
              
              var flag = 0;
              //验证学校名称
              if(removeSpace(param.param1) == "" || param.param1 == "学校名称" ){
                 $(".school_name_msg").text("请填写学校名称");
                 $(".school_name_msg").show();
                 flag = 1;
              }else{
                 $(".school_name_msg").text("");
                 $(".school_name_msg").hide();
              }
              //验证学历
              if(param.param2 == ""){
                 $('.college_level_msg').text("请选择学历");
                 $('.college_level_msg').show();
                 flag = 1;
              }else{
                 $('.college_level_msg').text("");
                 $('.college_level_msg').hide();
              }
              
              //验证专业名称
              if(removeSpace(param.param3) == "" || param.param3 == "专业名称"){
                  $(".zhuanye_name_msg").text("请填写专业名称");
                  $(".zhuanye_name_msg").show();
                 flag = 1;
              }else{
                 $(".zhuanye_name_msg").text("");
                 $(".zhuanye_name_msg").hide();
              }
              
              //验证毕业时间
              if(param.param4 == null || param.param4 == "" || param.param5 == null || param.param5 == ""){
                 $(".ed_time_msg").text("请选择完整入学和毕业时间");
                 $(".ed_time_msg").show();
                 flag = 1;
              }else{
                  //验证入学和毕业时间合法性
                  if(param.param4 >= param.param5){
                   $(".ed_time_msg").text("请选择合法的入学和毕业时间");
                   $(".ed_time_msg").show();
                   flag = 1;
                }else{
                   $(".ed_time_msg").text("");
                   $(".ed_time_msg").hide();
                }
              }
              
              //验证学习描述
              if(param.param6.length > 500){
                  flag = 1;
                  $(".ed_description_msg").show();
                  $(".ed_description_msg").text("不能 超过500字");
              }else{
                  $(".ed_description_msg").hide();
                  $(".ed_description_msg").text("");
              }
              
              if(flag == 1){
                 return;
              }
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/seduction', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                          if(param.param7 != null && param.param7 != ""){//ID存在的时候为更新
                              $(".jybj_div  ." + param.param7 +" .education_time").text(param.param4+"-" + param.param5);
                              $(".jybj_div  ." + param.param7 +" .start_year").val(param.param4);
                              $(".jybj_div  ." + param.param7 +" .end_year").val(param.param5);
                              $(".jybj_div  ." + param.param7 +" .description").val(param.param6);
                              $(".jybj_div  ." + param.param7 +" .school_name").html(param.param1);
                              $(".jybj_div  ." + param.param7 +" .zhuanye_name").html(param.param3);
                              $(".jybj_div  ." + param.param7 +" .college_level").text($("#collegeLevel").text());
                              $(".jybj_div  ." + param.param7 +" .experienceCon").html(param.param6);
                          }else{//id不存在的时候为添加
                             var str = "";
                             str = '<div class="'+data.education_id+'" id="'+data.education_id+'">'+
                                 '    <div class="experience_point">'+
                                 '    <p></p> '+
                                 '    </div>'+
                                 '    <div class="experience_con experience_con_jybj">'+
                                 '          <input type="hidden" value="'+param.param2+'" class="college" />'+
                                 '          <input type="hidden" value="'+param.param4+'" class="start_year" />'+
                                 '          <input type="hidden" value="'+param.param5+'" class="end_year" />'+
                                 '          <input type="hidden" value="'+param.param6+'" class="description" />'+
                                 '           <div class="jybj_fontbig">'+
                                 '               <span class="school_name">'+param.param1+'</span>'+
                                 '               <span class="education_time">'+param.param4+'-'+param.param5+'</span>'+
                                 '               <span class="zhuanye_name">'+param.param3+'</span>'+
                                 '               <em>|</em>'+
                                 '               <span class="college_level">'+$("#collegeLevel").text()+'</span>'+
                                 '           </div>'+
                               '           <div class="experienceCon experienceCon_jiaoyu">'+param.param6+'</div>'+
                               '          <div class="edit_pos"><i class="edit_i" id="'+data.education_id+'"></i><i class="del_i" id="'+data.education_id+'"></i></div>'+
                                 '    </div>'+
                                 '</div>';
                                 
                                 $(".jybj_div").append(str);
                                 updatebar();
                                 
                             }
                             
                         $('#edu2').hide();
                         $('#edu1').show();
                         myfun();
                     }
                  }
               });
        })
        
        //自我描述
         $('.zwms_save').live("click",function(){
              var param = new Object();
              param.param1 = $("#my_description").val().replace(reg,"<br>"); 
             
              //验证自我描述
              if(param.param1.length > 500){
                 alert("自我描述不能超过500个字符");
                 return;
              }
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/sdesc', 
                  data: JSON.stringify(param),   
                  success: function(data){
                     if(data.ret == 0)
                     {
                         $('#self_des').html(param.param1);
                         $('#self_description2').hide();
                         $('#self_description1').show();
                         
                             updatebar();
                         myfun();
                     }
                  }
               });
        })
        
        $('.zwms_cancel').live("click",function(){
              
              var str = $("#self_des").text(); 
              if(str == ""){
                  $('#self_description2').hide();
                $('#self_description3').show();
                $('#my_description').val("");
              }else{
                   $('#self_description2').hide();
                 $('#self_description1').show();
              }
          myfun();
          });
        
        //保存专业技能
        $(".zyjn_save").live("click",function(){
              var param = new Object();
              param.param1 = "";
                
                 var allNodes = document.getElementById("add").getElementsByTagName("i");
                 for(var i=0; i<allNodes.length ;i++){
                      if(i == 0){
                         param.param1 = allNodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"");
                      }else{
                         param.param1 = param.param1 +"," +  allNodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"");
                      }
                  }
              jQuery.ajax({   
                      type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url: '/ro/skeyword', 
                    data: JSON.stringify(param),   
                    success: function(data){
                       if(data.ret == 0)
                       {
                          if(param.param1.replace(/(^\s*)|(\s*$)/g,"") == ""){
                             $('.jineng_div').html('');
                             $('#zyjn2').hide();
                                   $('#zyjn3').show();
                                   myfun();
                             return;
                          }
                          $(".jineng_div").html("");
                          for(var i=0; i<allNodes.length ;i++){
                             $(".jineng_div").append("<div class='jineng_label'><label>"+allNodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,'')+"</label><i></i></div>");
                          }
                          
                             updatebar();
                          
                           $('#zyjn2').hide();
                                 $('#zyjn1').show();
                                 myfun();
                       }
                    }
                });
        })
        
        
      // 上传作品删除
      $('#zuopin li').live('mouseover',function(){
        $(this).find('i').show();
      })
      $('#zuopin li').live('mouseout',function(){
        $(this).find('i').hide();
      })
      $('.zuopin i').live('click',function(){
          var param = new Object();
          param.param1 = $(this).attr("v");
          
          var thisobj = $(this).parents('li');
          jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/delzuopin', 
                  data: JSON.stringify(param),    
                  success: function(data){
                        thisobj.remove();
                        var size = $('#works1 .zuopin').find('li').length;
                        if(size == '0'){
                          $('#works1').hide();
                          $('#works3').show();
                        }
                        updatebar();
                        myfun();
                  }
             })
      
        
      }) 
       $('.zyjn_cancel').live('click',function(){
                var h = $('.jineng_div').html();
                if(h.replace(/(^\s*)|(\s*$)/g,"") == ""){
                    $('#zyjn2').hide();
                    $('#zyjn3').show();
                }else{
                    $('#zyjn2').hide();
                    $('#zyjn1').show();
                }
                myfun();
       });
        
        //上传
        $(".upFileBtn").live("click",function(){
            var nodes = document.getElementById("zuopin").getElementsByTagName("a");
            if(nodes.length >= 6){
               alert("最多上传六个作品");
               return;
            }
            document.getElementById('f_product').click();
        })
    //    我的标签鼠标滑过编辑按钮显示
        $('.labelBox').live('mouseover',function(){
          if($('.labelAdd').is(":visible")==false){
            $(this).find('.edit_pen').show();       
          }
        })
        $('.labelBox').live('mouseout',function(){
          $(this).find('.edit_pen').hide();
        })
        // 我的标签保存
        $('.my_labels_save').live('click',function(){
              var param = new Object();
              param.param1 = "";
              var nodes = document.getElementById("label_box").getElementsByTagName("span");
              
               $(".labels").html("");
                 if(nodes.length > 0 ){
                    $('.labelAdd').hide();
                    $('.labelBox .edit_pen').show();
                 }else{
                    $('.labelAdd').show();
                    $('.labelBox .edit_pen').hide();
                 }
            for(var i=0;i<nodes.length;i++){
              var str = nodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"");
              if(param.param1 == ""){
                  param.param1 = str;
              }else{
                  param.param1 = param.param1 + ',' + str;
              }
            }
            
             jQuery.ajax({   
                      type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url: '/ro/stag', 
                    data: JSON.stringify(param),   
                    success: function(data){
                       if(data.ret == 0)
                       {
                       
                           for(var i=0;i<nodes.length;i++){
                               var num = i % 6 + 1;
                               $(".labels").append("<span class='c" +num+ "'>"+nodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,'')+"</span>");
                           }
                           
                           tags = param.param1;
                           
                              updatebar();
                              myfun();
                       }
                    }
             });
        
            $('.my_labels_edit').hide();
            $('.labelBox').show();
        })
        
        $('.jianli').live('click',function(){
            downloadjianli();
        })
        // 作品展示鼠标滑过添加加号
        $('#dragDiv7').live('mouseover',function(){
          if($('.default_work').is(":visible")==false){
            $('.upload_works').show();
          }
        })
        $('#dragDiv7').live('mouseout',function(){
          $('.upload_works').hide();
        })
        
        //删除附件简历
        $('.delete_fujian').live('click',function(){
             jQuery.ajax({   
                      type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url: '/ro/delfujian', 
                    data: {},   
                    success: function(data){
                        $('.jianli').text("");
                        $('.upload_jianli').text("上传简历");
                        $('.delete_fujian').hide();
                    }
          })  
        })
          
      })
      
        //上传作品
      function upload()
     {
          start();
          $.ajaxFileUpload({
                  type: 'post',
                  url: '/ajax/uploadproduct.do',
                  secureuri:false,
                  fileElementId: 'f_product',
                  dataType: 'json',  
                  data: {},   
                  success: function (data,status){
                     if(data.ret == 0){
                            var param = new Object();
                  //作品真实名字
                  param.param1 = data.originalName;
                  //作品物理名字
                  param.param2 = data.product_name;
                  //作品ID
                  param.param3 = "";
                  
                          jQuery.ajax({   
                          type: 'post',   
                        contentType : 'application/json; charset=utf-8',   
                        dataType: 'json',   
                        url: '/ro/spro', 
                        data: JSON.stringify(param),   
                        success: function(date){
                           stop();
                           if(date.ret == 0)
                           {
                             //$("#upfileResult").html('<i>'+data.originalName + '</i>   <font color="green">&amp;nbsp;&amp;nbsp;上传成功</font>');
                               //$("#resumeTmpNm").val(data.product_name);
                              // $("#uploadresumeName").val(data.originalName); 
                               $(".zuopin").append("<li><p><a href='javascript:download("+date.product_id+");' class=' " +date.houzhui+ "'>"+data.originalName+"</a><i v='"+date.product_id+"'></i></p></li>");
                             
                             $('#works3').hide();
                             $('#works1').show();
                             myfun();
                             updatebar();
                            
                           }
                        }
                    });
                     }else if(data.maxSizeErr == "1")
                     {
                         stop();
                         alert('文件太大，不能超过5M');
                         $('.whitebg').hide();
                         return;
                     }
                    else if(data.type_error == "1")
                     {
                         stop();
                         alert("文件格式错误");
                         $('.whitebg').hide();
                        return;
                    }
                  },
                  error: function (data,status,e){  
                     stop();
                     alert('上传失败,请重试。');
                     $('.whitebg').hide();
                  }
          }); 
      //$("#upfileResult").html('<i>上传文件名称</i>   <font color="green">&amp;nbsp;&amp;nbsp;上传成功</font>');
    }


       //更新完整度
       // function updatebar(){
       //      //var param = new Object();
       //      //param.param1 = barnum;
       //      jQuery.ajax({   
       //              type: 'post',   
       //            contentType : 'application/json; charset=utf-8',   
       //            dataType: 'json',   
       //            url: '/ro/updatebar', 
       //            data: {},   
       //            success: function(data){
       //              $('.progressbar').attr('data-perc',data.bar_num);
       //             progressbar();
       //            }
       //   })
       // }


      function delebarnum(){
           var param = new Object();
           param.param1 = bar_num;
           jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/dbar', 
                  data: JSON.stringify(param),   
                  success: function(data){
                  
                  
                  }
         })
      }


      //下载
      function download(id){
        window.open("/ro/download/"+id);
      }
      
      //上传简历
       function uploadjianli(num)
      {
          var id = "";
          if(num == 0){
             id = "ie_jianli";
          }else{
             id = "f_jianli";
          }
          start();
          $(".cuowutishi").hide();
          $.ajaxFileUpload({
                   type: 'post',
                   url: '/ajax/newuploadjianli.do',
                   secureuri:false,
                   fileElementId: id,
                   dataType: 'json',  
                   data: {}, 
                   success: function (data,status){
                      if(data.maxSizeErr == "1")
                      {
                          alert('简历文件太大，不能超过3M');
                          $('.whitebg').hide();
                          return;
                      }
                      else if(data.type_error == "1")
                      {
                          alert("文件格式错误");
                          $('.whitebg').hide();
                          return;
                      }
                      
                      var param = new Object();
                      param.param1 = $(".resume_name").val();//原简历名字
                      param.param2 = data.jianli_name;//新简历名字
                      param.param3 = data.originalName;
                      //上传成功
                       jQuery.ajax({   
                          type: 'post',   
                        contentType : 'application/json; charset=utf-8',   
                        dataType: 'json',   
                        url: '/ro/sjianli', 
                        data: JSON.stringify(param),   
                        success: function(date){
                           stop();
                           if(date.ret == 0)
                           {
                              if($.browser.msie) { 
                                  $('.ie_success').text("上传成功！");
                               }
                           
                              $(".resume_name").val(param.param2);
                              $(".jianli").text(param.param3);
                              $('.upload_a').text("已上传");
                              $('.upload_a').addClass('a4');
                              $('.upload_a').removeClass('a3');
                                      
                                      jianli_flag = param.param3;
                           }
                        }
                    });
                      
                   },
                   error: function (data,status,e){  
                       stop();
                      alert('简历上传失败,请重试。');
                   }
           }); 
      }
      
      //下载简历
      function downloadjianli(){
          window.open("/p/download/335729");
      }
      
      function selectImage()
       {
      
      jQuery.ajaxFileUpload({
                 type: 'post',
                 url: '/ajax/uploadPhoto.do',
                 secureuri:false,
                 fileElementId:'fileToUpload',
                 dataType: 'json',  
                 data: {}, 
                 success: function (data){
                   if(data.ret==0){
                    paotow=data.photow;
                    paotoh=data.photoh;
                    var leftw=(hexFrm-paotow)/2
                    var toph=(hexFrm-paotoh)/2
                    photourl=data.profilphotoName;
                    var w1=paotow * 2; 
                    var h1=paotoh * 2; 
                    $('.images_left img').attr({src: "http://f.neipin.com/photo/temp/"+data.profilphotoName});
                    $('.images_left img').css({ "margin-top": toph+"px" });
                    $("#tixing").text("");
                      setTimeout("tupianchufa()",500);
                      setTimeout(function(){cheng(w1,h1,data.profilphotoName);},1000)
                    
                   }else if(date.ret==-3){
                    $("#tixing").text("上传图片格式不对");
                   }else{
                    $("#tixing").text("上传图片不能大于3M");
                   }
                 },
                 error: function(XMLHttpRequest, textStatus, errorThrown){
                  $("#tixing").text("上传失败,请重试或者换张图片");
                 }
               }
            ); 
    }

    function tupianchufa(){
      $('#photo').imgAreaSelect({
        aspectRatio: '1:1',
        x1:0,y1:0,x2:180,y2:180,
        onSelectChange: function (img, selection) {
            if (!selection.width || !selection.height)
                return;
              var scaleX = 180 / selection.width;
              var scaleY = 180 / selection.height;
              $('.images_right img').css({
                  width: Math.round(paotow * scaleX),
                  height: Math.round(paotoh * scaleY),
                  marginLeft: -Math.round(scaleX * selection.x1),
                  marginTop: -Math.round(scaleY * selection.y1)
              });
              x1=selection.x1;
            y1=selection.y1;
            x2=selection.x2;
            y2=selection.y2;
          }
      });
    } 

    function cheng(w,h,m){
      $('.images_right img').attr({src: "http://f.neipin.com/photo/temp/"+m});
      x1=0;y1=0;x2=180;y2=180;
      var scaleX =180/180*paotow;
      var scaleY = 180/180*paotoh;
      scaleX= scaleX+"px";
      scaleY= scaleY+"px";
      $('.images_right img').css({"width":scaleX,"height":scaleY,"margin-left": "0px", "margin-top":"0px"});

    }

        //确认图片
        function getImage(){
          var param = new Object();
            param.param1 = x1;
            param.param2 = y1;
            param.param3 = x2;
            param.param4 = y2;
            param.param5 = photourl;
            param.param6 = "";
            param.param7 = 2;
            if(param.param5==""){
              $("#tixing").text("请先上传图片");
              return;
            }
            var post_url = "";
              
            jQuery.ajax({   
                 type: 'post',   
                 contentType : 'application/json; charset=utf-8',   
                 dataType: 'json',   
                 url: '/ajax/getPhoto2.do', 
                 data: JSON.stringify(param),   
                 success: function(data){
                  if(data.ret==0){
                      getImage1();
                      $(".self_head").attr({"src": "http://f.neipin.com/photo/"+data.newlogo_url});
                  }else{
                    return;
                  }
                 },
                 error: function(XMLHttpRequest, textStatus, errorThrown){
                 }
            });        
        };
      function getImage1(){
        $('.close_btn').click();
        
      }


       //保存拖拽顺序
       function modularSort(){
             var param = new Object();
             var allDragDiv = document.getElementsByName("dragDiv");
             var tmpDiv;
             for(var i =0;i<allDragDiv.length;i++){
                tmpDiv = allDragDiv[i];
                if(tmpDiv.className == "dragDiv"){
                   var v = tmpDiv.getAttribute("v");
                   if(v == 1){//期望工作
                     param.param1 = i + 1;
                   }else if(v == 2){//工作经历
                     param.param2 =  i + 1;
                   }else if(v == 3){//项目经验
                     param.param3 =  i + 1;
                   }else if(v == 4){//教育背景
                     param.param4 =  i + 1;
                   }else if(v == 5){//专业技能
                     param.param5 =  i + 1;
                   }else if(v == 6){//自我描述
                     param.param6 =  i + 1;
                   }else if(v == 7){//作品展示 
                     param.param7 =  i + 1;
                   }
                }
             }
             
              jQuery.ajax({   
                    type: 'post',   
                  contentType : 'application/json; charset=utf-8',   
                  dataType: 'json',   
                  url: '/ro/ssort', 
                  data: JSON.stringify(param),   
                  success: function(date){
                     if(date.ret == 0)
                     {
                     }
                  }
              });
             
       }
       
       // function deletes(flag){
       //       var param = new Object();
       //       param.param1 = flag;
       //       jQuery.ajax({   
       //              type: 'post',   
       //            contentType : 'application/json; charset=utf-8',   
       //            dataType: 'json',   
       //            url: '/ro/deletes', 
       //            data: JSON.stringify(param),   
       //            success: function(date){
       //               if(date.ret == 0)
       //               {
       //                   updatebar();
       //                   myfun();
       //               }
       //            }
       //        });
       // }
       
       $(function(){
              $('.close_btn').live("click",function(){
                $(".hsbj").hide();
                $(".tanchu_logo").hide();
                $(".imgareaselect-selection").parent().css({"display":"none"});
                $(".imgareaselect-outer").css({"display":"none"});
              });
          
        
           if($.browser.msie) { 
              //$('.fileInput').css({'background':'none','width':'220px','padding-top':'10px'})
              //$('.fileInput').empty();
              //$('.fileInput').append('<input type="file" onchange="javascript:upload();" name="f_jianli"  id="f_jianli" style="width:70px"/>');
           } 
        
            // 组件鼠标滑过
            $(".search_ul li").live("mousemove",function(event){
                  $(this).css("background","#eee");
              });
            $(".search_ul li").live("mouseout",function(event){
                  currentSelIndex = -1;
                  oldSelIndex = -1;
                  $(this).css("background","#fff");
              });
        
          var flg = 0;
        // 添加专业名词
          $('#add_ci').click(function(){
                $('#input_str').focus();
                $('#add_ci code').hide();
                var heig = $(this).height() + 2;
                $('.tab_list').css({'top':heig});
                $('.tab_list').slideDown();
                $('.keys').hide();
                if(flg == 0){
                     flg = 1;
                     $('.moren').click();
                }
            })
            
            $(document).keyup(function(event){
                selectItem(event);
            })
        
            //关键字查询部分
            var oldContent = "";//文本变化前的内容，使用它和新内容对比，发生了变化才发送ajax请求
            $('#add_ci').keyup(function(event){
                  if ((event.keyCode == 38 || event.keyCode == 40 || event.keyCode == 13)) {  
                     return;
                  }
                var content = $("#input_str").val().replace(/(^\s*)|(\s*$)/g,"");
                if(content == "" || (oldContent == "" && content == oldContent))
                {
                    oldContent = "";
                    $('.search_ul').hide();
                    return;//没有输入内容或者文本内容没有发生变化时就返回
                  }
                  oldContent = content;
                
                  var param = new Object();
                  param.param1 = $("#input_str").val().replace(/(^\s*)|(\s*$)/g,"");
                  jQuery.ajax({   
                        type: 'post',   
                        contentType : 'application/json; charset=utf-8',   
                        dataType: 'json',   
                        url: '/ajax/selectKw.do', 
                        data: JSON.stringify(param),   
                        success: function(data){
                           if(data.ret == "0")
                           {
                                if(data.keywords.length > 0){
                              
                                   $('.tab_list').hide();
          
                                   $('.keys').slideDown();
                                   $('.search_ul').html("");
                                   $('.search_ul').show();
                                   var length = data.keywords.length;
                                   if(length > 10){
                                       length = 10;
                                    }
                                    for(var i=0;i<length;i++){
                                      $('.search_ul').append("<li id='li_"+i+"'><span>"+data.keywords[i].node_name+"</span><label>"+data.keywords[i].p_name+"</label></li>");
                                    }
                                  }else{
                                   $('.tab_list').hide();
                                   $('.keys').slideDown();
                                   $('.search_ul').hide();
                                  }
                              }
                          }
                     });
               })
        
        $('.tab_li span').click(function(){
              $(this).addClass('active').siblings('span').removeClass('active');
              //$('.tab_con').empty().append('<li><i>123</i><em class="list_em"></em></li>');
              var str = $(this).text();
              requestKeyword(str);
          })
        
         // 点击提交到input
         $('.tab_con i').live('click',function(event){
              $(this).parent().addClass('active');
              var e=window.event || event;
              if(e.stopPropagation){
                  e.stopPropagation();
              }else{
                  e.cancelBubble = true;
              }  
              var val = $(this).text().replace(/(^\s*)|(\s*$)/g,""); 
            
             var allNodes = document.getElementById("add").getElementsByTagName("i");
             for(var i=0; i<allNodes.length ;i++){
                 if(val == allNodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"")){
                    return;
                 }
             }
             $(this).parents('.tab_list').siblings('#add_ci').find('.add_cons').show().append('<li><i>'+ val + '</i><em class="list_em"></em></li>');
             var heig = $(this).parents('.tab_list').siblings('#add_ci').height() + 2;
             $('.tab_list').css({'top':heig});
             $('.remove_con').show();
          })
          // 清空
          $('.remove_con').click(function(){
              $(this).hide();
              $('.add_cons').empty();
              $('.tab_con li').removeClass('active');
          })
        
          // 删除自定义的标签
          $('.tab_con .list_em').live('click',function(event){
             var param = new Object();
              param.param1 = $(this).siblings('#delete_id').val();
              var node = $(this).parent();
               jQuery.ajax({   
                        type: 'post',   
                        contentType : 'application/json; charset=utf-8',   
                        dataType: 'json',   
                        url: '/ajax/deleteSelfKw.do', 
                        data: JSON.stringify(param),   
                        success: function(data){
                           if(data.ret == "0")
                           {
                               node.remove();
                           }
                        }
                   });
              
           });
        
          $('.search_ul li').live('click',function(event){
            var e=window.event || event;
              if(e.stopPropagation){
               e.stopPropagation();
              }else{
               e.cancelBubble = true;
              } 
              var val = $(this).find('span').text().replace(/(^\s*)|(\s*$)/g,"");
              
              
              var allNodes = document.getElementById("add").getElementsByTagName("i");
              for(var i=0; i<allNodes.length ;i++){
                   if(val == allNodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"")){
                        return;
                   }
              }
              
              $(this).parents('.keys').siblings('#add_ci').find('.add_cons').show().append('<li><i>'+ val + '</i><em class="list_em"></em></li>');
              $(this).parents('.keys').siblings('#add_ci').find('input').val('');
              $('#input_str').focus();
               $(".remove_con").show();
          })
        // 加号
        if ($('#add').has('li')) {
          $('#add_ci code').hide();
        };
          $('.label_s code').live('click',function(){
              $('#add_ci code').hide();
              $('.tab_list').slideDown();
          })
        
          $('.tab_li font').live('click',function(){
               $('.tab_list').slideUp();
          })
          $('.add_cons em').live('click',function(){
              $(this).parents('li').remove();
              var heig = $('#add_ci').height();
              $('.tab_list').css({'top':heig});
          })
        
          //添加自定义
          $('.add_tj a').live('click',function(){
              $('.hsbj').show();
              $('.add_new_label').show();
              var cal = $('#add_ci input').val();
              $('.wbd').val(cal);
          })
          
          $('.tanclosebtn').click(function(){
          $('.add_new_label').hide();
          $('.hsbj').hide();
      })
      $('.que_xiao .no').live('click',function(){
        $('.add_new_label').hide();
        $('.hsbj').hide();
      })

      $('.que_xiao .sure').live('click',function(){
        $('.add_new_label').hide();
        $('.hsbj').hide();
        var param = new Object();
        param.param1 = $(".seles_bqlb").text().replace(/(^\s*)|(\s*$)/g,"");
        param.param2 = $(".wbd").val();
        if(param.param1 == "请选择"){
          param.param1 = "";
        }
        if(param.param2 == ""){
           return;
        }
         
         jQuery.ajax({   
                    type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url: '/ajax/saveSelfKw.do', 
                    data: JSON.stringify(param),   
                    success: function(data){
                       if(data.ret == "0")
                       {
                         var val = $('.wbd').val();
                         $('#add_ci').find('input').val('');
                         var allNodes = document.getElementById("add").getElementsByTagName("i");
                         for(var i=0; i<allNodes.length ;i++){
                              if(val == allNodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"")){
                                     return;
                              }
                          }
                         $('#add_ci').find('.add_cons').show().append('<li><i>'+ val + '</i><em class="list_em"></em></li>');
                         $(".remove_con").show();
                       }
                    }
               });
      })
    //简历预览删除显示
    $('.yishangchuan_pos').live('mouseover',function(){
        if(jianli_flag != "" && jianli_flag != null){
           $(this).find('.yishangchuan_hover').show();
        }
    })
    $('.yishangchuan_pos').live('mouseout',function(){
      $(this).find('.yishangchuan_hover').hide();
    })

    //加号显示
    $('.dragDiv').live('mouseover',function(){
      if($('#item_exprience2').is(":visible")==false || $('#gzjl2').is(":visible")==false){
        $(this).find('.more_experience').show();
      } 
      
    })
    $('.dragDiv').live('mouseout',function(){
      $(this).find('.more_experience').hide();
    })


      })
      
        function tanchu_logo(){
          // $('.tanchu_logo .jietuqu .images_left img').attr({src: "images/d_default.png"});
          //   $('.tanchu_logo .jietuqu .images_left img').css({"width":"300px","height":"300px", "margin-top": "0px" });
          //   $('.tanchu_logo .jietuqu .images_right img').attr({src: "/images/x_default.png"});
          //   $('.tanchu_logo .jietuqu .images_right img').css({"width":"120px","height":"120px","margin-right":"50px","margin-left": "0px", "margin-top":"0px"});
          $(".hsbj").show();
          $(".tanchu_logo").show();
        }
        
        function requestKeyword(str){
          var param = new Object();
          param.param1 = str;
          jQuery.ajax({   
                    type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url: '/ajax/requestKw.do', 
                    data: JSON.stringify(param),   
                    success: function(data){
                       if(data.ret == "0")
                       {
                           $('.tab_con').empty();
                           if(str == "自定义"){
                                for(var i =0;i<data.keywords.length ;i++){
                                   $(".tab_con").append("<li><i>"+data.keywords[i].node_name+"</i><em class='list_em'></em><input type='hidden' value='"+data.keywords[i].id+"' id='delete_id'/></li>");
                                }
                           }else{
                                for(var i =0;i<data.keywords.length ;i++){
                                   $('.tab_con').append('<li><i>'+data.keywords[i].node_name+'</i></li>');
                                }
                           }
                       }
                    }
               });
          }
        
            var currentSelIndex = -1;  
            var oldSelIndex = -1;  
            function selectItem(event) {  
                    var liLength = document.getElementById("ulItems").getElementsByTagName("li").length;
                    //获取列表数量  
                    if ((event.keyCode == 38 || event.keyCode == 40)) {  
                        if (liLength > 0) {  
                            oldSelIndex = currentSelIndex;  
                            //上移  
                            if (event.keyCode == 38) {  
                                if (currentSelIndex == -1) {  
                                    currentSelIndex = liLength - 1;  
                                }else {  
                                    currentSelIndex --;  
                                    if (currentSelIndex < 0) {  
                                        currentSelIndex = liLength - 1;  
                                    }  
                                }  
                                if (currentSelIndex != -1) {  
                                    document.getElementById("li_" + currentSelIndex).style.backgroundColor = "#eee";  
                                }  
                                if (oldSelIndex != -1) {  
                                    document.getElementById("li_" + oldSelIndex).style.backgroundColor = "#ffffff";  
                                }  
                            }  
                            //下移  
                            if (event.keyCode == 40) {  
                                if (currentSelIndex == liLength - 1) {  
                                    currentSelIndex = 0;  
                                }else {  
                                    currentSelIndex ++;  
                                    if (currentSelIndex > liLength - 1) {  
                                        currentSelIndex = 0;  
                                    }  
                                }  
                                if (currentSelIndex != -1) {  
                                    document.getElementById("li_" + currentSelIndex).style.backgroundColor = "#eee";  
                                }  
                                if (oldSelIndex != -1) {  
                                    document.getElementById("li_" + oldSelIndex).style.backgroundColor = "#ffffff";  
                                }  
                            } 
                          } 
                    } else if (event.keyCode == 13) { 
                      if ((document.getElementById("ulItems").style.display == "" || document.getElementById("ulItems").style.display != "none" ) && currentSelIndex != -1) {  
                          var val =$("#li_" + currentSelIndex).find("span").text().replace(/(^\s*)|(\s*$)/g,"");
                          var allNodes = document.getElementById("add").getElementsByTagName("i");
                          for(var i=0; i<allNodes.length ;i++){
                              if(val == allNodes.item(i).innerHTML.replace(/(^\s*)|(\s*$)/g,"")){
                                  return;
                              }
                          }
                          document.getElementById("ulItems").style.display = "none";  
                          currentSelIndex = -1;  
                          oldSelIndex = -1;  
                          $('#add_ci').find('.add_cons').show().append('<li><i>'+ val + '</i><em class="list_em"></em></li>');
                          $('#input_str').val('');
                          $(".remove_con").show();
                          $(".search_ul").html("");
                          $(".keys").hide();
                        }  
                    } 
                }  
        function getImage1(){
        $('.close_btn').click();
        }
    </script>
   
    
    
    <script>
    var jianlistatustype="";
    var tui_user_pro='';
    var res_tuijian='';
    var uname = "416148489@qq.com";
    var ukbn = "0";
    var isIE7 = false;
    //验证标识
    var verifyflg="0";
      
    function logout(){
        jQuery.ajax({   
            type: 'post',   
            contentType : 'application/json; charset=utf-8',   
            dataType: 'json',   
            url: '/ajax/logout.do', 
            data: JSON.stringify(new Object()),   
            success: function(data){
                window.location.href = "/";
            }
        })
    }

    $(document).ready(function(){    
    //底部tab切换
      $('.contact_Con .contactCon').hide();
      $('.contact_Con .contactCon').eq(0).show();
      $('.contact_tab span').click(function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $('.contact_Con .contactCon').hide();
        $('.contact_Con .contactCon').eq($(this).index()).show();
        
      })

    //判断是否为ie6
        var isIE=!!window.ActiveXObject;
        var isIE6=isIE&&!window.XMLHttpRequest;
        var isIE8=isIE&&!!document.documentMode;
        var isIE7=isIE&&!isIE6&&!isIE8;
        if (isIE){
            isIE7 = true;
            if (isIE6){
              $('.bsie').show();
            }
        }
        $('.closeBtn').click(function(){
        $('.a_box').hide();
        })
      
    //底部二维码
      $('.about_Us span.ma_img').mouseover(function(){
      $(this).find('img').show();
      })
      $('.about_Us span.ma_img').mouseout(function(){
      $(this).find('img').hide();
      })
      //点击登录
      $('#login_click').live("click",function(){
        my_login();
      });
      
      if(ukbn==1){
        getSelectHrJobJianLi();
      }
      //点击导航的登录 
      $('#dl_span').live("click",function(){
        window.location.href='login.html.html';
      });
      
      // 账号的回车事件
      $('#myusername').keydown(function(event){
        if(13 == event.keyCode || 13 == event.which){
          my_login();
        }
      });
      
      //密码的回车事件
      $('#mypassword').keydown(function(event){
        if(13 == event.keyCode || 13 == event.which){
          my_login();
        }
      });
      
      // 搜索职位的回车事件 
      $('#my_job_form').keydown(function(event){
        if(13 == event.keyCode || 13 == event.which){
          headtijiao();
        }
      });
      

      //登录框隐藏与显示
      //$('.dl_hide').hide();
      $('.pos_dl'). mouseenter(function(){
        $('.dl_hide').show();
      });
      $('.pos_dl').mouseleave(function(){
        $('.dl_hide').hide();
      });

      //鼠标滑过2维码显示
      $('.wx_pos').mouseover(function(){
        $(this).find('img').show();
      })

      $('.wx_pos').mouseleave(function(){
        $(this).find('img').hide();
      })  
      if(uname!=""&&uname!=null){
        // 调用此方法 
        // getSelectProfileJobJianLi();
      }
      
      // 事件关闭
          $('.event_top span').click(function(){
            $(this).parent().slideUp();
          })       
          
          $('.event_top').click(function(){
              window.open("/act");
          })
      
      
      
      if(uname != "" && uname != null && ukbn == 1){
          getHrNewJianliNum();
      }
      
    });

    // 查询职位方法 
    function headtijiao(){
      var xinkeywd = encodeURIComponent($("#my_job_form").val());
      window.location.href='/job/?mkwd='+xinkeywd;
    }
    //查询职位方法结束 

    // 登录方法 
    function my_login(){
      $("#herders_cuowu").hide();
      var param = new Object();
      param.emailAddr = $("#myusername").val();
      param.passwd = $("#mypassword").val();
      if(param.emailAddr == "")
            {
                $("#herders_cuowu").html("请填写用户名");
                $("#herders_cuowu").show();
                return;
            }
      if(param.passwd == "")
            {
                $("#herders_cuowu").html("请填写密码");
                $("#herders_cuowu").show();
                return;
            }
            
      jQuery.ajax({   
        type: 'post',   
        contentType : 'application/json; charset=utf-8',   
        dataType: 'json',   
        url: '/ajax/login.do', 
        data: JSON.stringify(param),   
        success: function(data){
          if(data.ret == "0")
            {
              if(data.ukbn==1){
                            //window.location.href = "/hr/";
                            window.location.href = "/job.html";
                          } else{
                            window.location.href = "/job.html";
                          }
            }
                    else if(data.ret == -1)
                    {
                            $("#herders_cuowu").html("用户不存在或密码错误");
                            $("#herders_cuowu").show();
                    }
                    else
                    {
                            $("#herders_cuowu").html("登录失败，请稍候重试");
                            $("#herders_cuowu").show();
                    }
            }
      });
    };
    //查询普通用户没有回复hr面试通知的数量
    function getSelectProfileJobJianLi(){
      var param = new Object();
      var total = 0;
      jQuery.ajax({   
        type: 'post',   
        contentType : 'application/json; charset=utf-8',   
        dataType: 'json',   
        url: '/ajax/getSelectProfileJobJianLi.do', 
        data: JSON.stringify(param),   
        success: function(data){
          if(data.np.number0>0)
          {
              total = total + data.np.number0;
            //$("#profile_jianli_number").text(data.np.number0);
            //$("#profile_jianli_number").show();
            $("#profile_jianli_number2").text(data.np.number0);
            $("#profile_jianli_number2").show();
          }
          if(jianlistatustype==0){
            if(data.np.number1>0)
            {
              $("#profile_jianli_number_1").text(data.np.number1);
              $("#profile_jianli_number_1").show();
            }
            if(data.np.number2>0)
            {
              $("#profile_jianli_number_2").text(data.np.number2);
              $("#profile_jianli_number_2").show();
            }
            if(data.np.number3>0)
            {
              $("#profile_jianli_number_3").text(data.np.number3);
              $("#profile_jianli_number_3").show();
            }
            
          }
          if(jianlistatustype==1){
            if(data.np.number3>0)
            {
              $("#profile_jianli_number_1").text(data.np.number4);
              $("#profile_jianli_number_1").show();
            }
            if(data.np.number4>0)
            {
              $("#profile_jianli_number_2").text(data.np.number5);
              $("#profile_jianli_number_2").show();
            }
            if(data.np.number5>0)
            {
              $("#profile_jianli_number_3").text(data.np.number6);
              $("#profile_jianli_number_3").show();
            }
            
          }
          var jk=parseInt(data.np.number1)+parseInt(data.np.number2)+parseInt(data.np.number3);
          var jk1=parseInt(data.np.number4)+parseInt(data.np.number5)+parseInt(data.np.number6);
          if(jk>0)
          {
              $("#profile_jianli_number_4").text(jk);
              $("#profile_jianli_number_4").show();
          }
          if(jk1>0)
          {
              $("#profile_jianli_number_5").text(jk1);
              $("#profile_jianli_number_5").show();
          }
          total = total + jk + jk1;
          if(total > 0)
          {
              $("#jianli_status").append('<em>'+total+'</em>');
          }
            }
      });
    };

    //查询hr没有回复数量 
    function getSelectHrJobJianLi(){
      jQuery.ajax({   
        type: 'post',   
        contentType : 'application/json; charset=utf-8',   
        dataType: 'json',   
        url: '/ajax/getSelectHrJobJianLi.do', 
        data: JSON.stringify(new Object()),   
        success: function(data){
          if(data.np.number1>0){
            $("#hr_mei_jianli").append("<em>"+data.np.number1+"</em>");
            $("#shou").append("<em>"+data.np.number1+"</em>");
          }
          if(data.np.number2>0){
            $("#hr_tong_jianli").append("<em>"+data.np.number2+"</em>");
          }
            }
      }); 
    };

    //查询Hr新简历数
    function getHrNewJianliNum(){
        jQuery.ajax({ 
             type: 'post',   
            contentType : 'application/json; charset=utf-8',   
            dataType: 'json',   
            url: '/ajax/newnum.do', 
            data: JSON.stringify(new Object()),   
            success: function(data){
               if(data.newnum > 0){
                  $('.num').show();
                  $('.num').text(data.newnum);
               }else{
                  $('.num').hide();
               }
            }
        });
    }

    //登录结束 
    </script>
    
    <div style="display:none" class="tishi">
            <span id="tishi_msg"></span>
            <div style="top:5px; right:5px;" class="close_X">X</div>
    </div>
    <div class="hsbj"></div>
    <div style="display:none;" class="whitebg"></div>

    <!--这是加载AJAX的动态转图-->
      <div style="left:50%; float:left; position:fixed; top:50%; z-index:100009; display:none;" id="home_loading">
        <img src="images/anim_loading_75x75.gif">
      </div>
    <div class="containter_box">
        <div class="containter">
              <div style="display:none;" class="qiujian left">
                <div class="jian_top">
                  <img alt="" src="images/jian_resume.jpg">
                  <p>将我推荐至合适的岗位，从此登上人生巅峰。</p>
                  <div>
                  <a style="display:none;" class="on" href="javascript:onoff(0);">快速开启</a>
                  <a style="" class="off" href="javascript:onoff(1);">关闭推荐</a>
                  </div>
                </div>
                <div class="jian_process">
                  <p></p>
                  <div>
                    <div>开启极速<br>推荐功能</div>
                    <div>将您匿名<br>推荐给HR</div>
                    <div>收到HR<br>面试邀请</div>
                    <div style="height:40px; line-height:40px;">面试</div>
                  </div>
                </div>
                <div class="jian_QA">
                  <p></p>
                  <div>
                    <div class="qa">
                      <p>1、什么叫求推荐？</p>
                      <div>答：开启求推荐功能之后，内聘网的资深职业顾问会将你的简历以匿名方式推荐给与你期望职位匹配的企业。</div>
                    </div>
                    <div class="qa qb">
                      <p>2、会不会将我的简历推荐到我以前或者现在的公司？</p>
                      <div>答：我们的职业顾问绝逼不会酱紫，推荐的简历是匿名的、联系方式是隐藏的，只有你同意去面试后，才会将你的个人信息显示给HR。</div>
                    </div>
                    <div class="qa">
                      <p>3、是我自己投递的好呢？还是你们推荐的好？</p>
                      <div>答：开启求推荐的功能后，不用自己找工作啦，内聘网以大数据和人工智能为依据，力图为你匹配出最适合你的职位，免费享受高质量的求职服务。我们比你更了解你自己。</div>
                    </div>
                    <div class="qa qb">
                      <p>4、职业顾问主要是干嘛的？</p>
                      <div>答：内聘网的职业顾问不仅有在人力资源行业工作十年以上的资深人士，还有90后萌妹纸、小鲜肉帮你修改简历&mdash;面试辅导&mdash;推荐工作&mdash;畅谈梦想，一条龙式服务，你懂哒！</div>
                    </div>
                  </div>
                </div>
                <div class="jian_Tips">
                  <p></p>
                  <div>
                    <div>1、虽然职业顾问将你推荐给HR，但是也会有HR觉得你的简历不合适，如果HR觉得不合适，我们暂时不会通知你，如果你想知道些“为什么”的话，我们会询问HR详细原因并反馈给你。</div>
                    <div>2、HR对你的简历满意，你当然也可以傲娇的拒绝。
    </div>
                    <div>3、最后，求职的你们一定要先完善在线简历，如果你是毕业生，必须要填写教育背景，如果你已工作，必须填写工作经历。</div>
                  </div>
                </div>
              </div>
              <div class="online_left left">
              <!-- 个人资料预览 -->
              <div id="self_info1" class="self_info">
                <!--<div class='img_Con'>-->
                  <!--<img src="images/xx.jpg" onerror="javascript:this.src='images/d_default.png'" class='self_head'/>
                  <div class='self_information'>
                    <div class='self_name'>
                    <span class='left'>黄金</span><div class='edit_pen'></div></div>
                    <div class='self_list'><div class='sex'></div>
                    <div class='xl'>大专</div>
                    <div class='gz_time'>1年工作经验</div>
                    <div class="birthday_type"></div>
                    </div>
                    <div class='self_list'><div class='phone'>18005151538</div><div class='email'>416148489@qq.com</div></div>
                    <div class='self_list'><div class='currentstate'>我暂时不想找工作</div></div>
                  </div>-->
                  <div class="edit_pen" style="display: none;"></div>
                  <div class="Resume_con">
                    <div class="Resume_conLeft">
                      <p class="p_educate">大专</p>
                      <p class="p_gzjy">1年工作经验</p>
                      <p class="p_brithday"></p>
                    </div>
                    <div class="Resume_conCenter">
                      <dl>
                        <dt><img onerror="javascript:this.src='images/d_default.png'" src="images/d_default.png"></dt>
                        <dd><em>黄金</em><span class="gender boy"></span></dd>
                      </dl>
                   </div>
                    <div class="Resume_conRight">
                      <p class="p_phone phone">18005151538</p>
                      <p class="p_emil email">416148489@qq.com</p>
                      <p class="p_now currentstate">暂时不想找工作</p>
                    </div>
                  </div>
                  <div style="display:none;" class="Resume_three">
                    <a style="display:none;" class="Resume_three_wb" v="" href="javascript:void(0);" rel="nofollow"></a>
                    <a style="display:none;" class="Resume_three_cat" v="" href="javascript:void(0);" rel="nofollow"></a>
                    <a style="display:none;" class="Resume_three_zk" v="" href="javascript:void(0);" rel="nofollow"></a>
                </div>
              </div>
              <!-- 编辑个人资料 -->
              <div id="self_info2" style="" class="self_info"><!--display:none;-->
                <div class="img_Con">
                  <a onclick="tanchu_logo()" href="javascript:void(0)" class="img_box">
                    <img class="self_head" onerror="javascript:this.src='images/d_default.png'" alt="" src="images/d_default.png">
                    <div>上传头像</div>
                    <input type="hidden" value="" id="photo_name">
                  </a>            
                  <div class="self_edit">
                    <div class="self_edit_left left">
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em>*</em>姓名</span>
                        <input type="text" id="online_name" value="黄金">
                        <div class="sex_choose">
                          <span class="girl" v="2"></span>
                          <span class="boy" v="1"></span>
                        </div>
                      </div>
                      <div class="mis_alert username_msg"></div>
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em>*</em>学历</span>
                        <div class="seles seles_xl">
                          <span id="max_xueli" class="seles_choose">大专</span>
                          <ul class="seles_hide">
                            <li v="1">大专以下</li>               
                            <li v="2">大专</li>
                            <li v="3">本科</li>               
                            <li v="4">硕士</li>
                            <li v="5">博士</li>
                          </ul>
                          <input type="hidden" class="input_hide" value="2" id="xueli">
                        </div>  
                      </div>
                      <div class="mis_alert xueli_msg"></div>
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em>*</em>工作经验</span>
                        <div class="seles seles_L">
                          <span id="work_time" class="seles_choose">
                             1年
                          </span>
                          <ul class="seles_hide">
                            <li v="0">应届生</li>               
                            <li v="1">1年</li>
                            <li v="2">2年</li>               
                            <li v="3">3年</li>
                            <li v="4">4年</li>
                            <li v="5">5年</li>
                            <li v="6">6年</li>
                            <li v="7">7年</li>
                            <li v="8">8年</li>
                            <li v="9">9年</li>
                            <li v="10">10年以上</li>
                          </ul>
                          <input type="hidden" class="input_hide" value="1" id="workyears">
                        </div>  
                      </div>
                      <div class="mis_alert workyears_msg"></div>
                      <div class="edit_list edit_list_fff">
                      <span class="span_fff"><em>*</em>出生日期</span>
                      <div class="seles seles_nian">
                        <span class="seles_choose">出生年</span>
                        <ul class="seles_hide">
                          <li v="1998">1998</li>               
                          <li v="1997">1997</li>               
                          <li v="1996">1996</li>               
                          <li v="1995">1995</li>               
                          <li v="1994">1994</li>               
                          <li v="1993">1993</li>               
                          <li v="1992">1992</li>               
                          <li v="1991">1991</li>               
                          <li v="1990">1990</li>               
                          <li v="1989">1989</li>               
                          <li v="1988">1988</li>               
                          <li v="1987">1987</li>               
                          <li v="1986">1986</li>               
                          <li v="1985">1985</li>               
                          <li v="1984">1984</li>               
                          <li v="1983">1983</li>               
                          <li v="1982">1982</li>               
                          <li v="1981">1981</li>               
                          <li v="1980">1980</li>
                          <li v="1979">1979</li>
                          <li v="1978">1978</li>
                          <li v="1977">1977</li>
                          <li v="1976">1976</li>
                          <li v="1975">1975</li>
                          <li v="1974">1974</li>
                          <li v="1973">1973</li>
                          <li v="1972">1972</li>
                          <li v="1971">1971</li>
                          <li v="1970">1970</li>
                        </ul>
                        <input type="hidden" class="input_hide" value="" id="year">
                      </div>
                      <div class="seles seles_yue">
                        <span class="seles_choose">出生月</span>
                        <ul class="seles_hide">
                          <li v="01">01</li>               
                          <li v="02">02</li>               
                          <li v="03">03</li>
                          <li v="04">04</li>
                          <li v="05">05</li>
                          <li v="06">06</li>
                          <li v="07">07</li>
                          <li v="08">08</li>
                          <li v="09">09</li>
                          <li v="10">10</li>
                          <li v="11">11</li>
                          <li v="12">12</li>
                        </ul>
                        <input type="hidden" class="input_hide" value="" id="month">
                      </div>
                      <div class="seles seles_yue">
                        <span class="seles_choose">出生日</span>
                        <ul class="seles_hide">
                          <li v="01">01</li>               
                          <li v="02">02</li>               
                          <li v="03">03</li>
                          <li v="04">04</li>
                          <li v="05">05</li>
                          <li v="06">06</li>
                          <li v="07">07</li>
                          <li v="08">08</li>
                          <li v="09">09</li>
                          <li v="10">10</li>
                          <li v="11">11</li>
                          <li v="12">12</li>
                          <li v="13">13</li>               
                          <li v="14">14</li>               
                          <li v="15">15</li>
                          <li v="16">16</li>
                          <li v="17">17</li>
                          <li v="18">18</li>
                          <li v="19">19</li>
                          <li v="20">20</li>
                          <li v="21">21</li>
                          <li v="22">22</li>
                          <li v="23">23</li>
                          <li v="24">24</li>
                          <li v="25">25</li>               
                          <li v="26">26</li>               
                          <li v="27">27</li>
                          <li v="28">28</li>
                          <li v="29">29</li>
                          <li v="30">30</li>
                          <li v="31">31</li>
                        </ul>
                        <input type="hidden" class="input_hide" value="" id="day">
                      </div>
                      <div class="seles seles_pub">
                        <span class="seles_choose">
                                          公开,完整显示
                        </span>
                        <ul class="seles_hide">
                          <li v="0">公开,完整显示</li>               
                          <li v="1">只显示星座</li>               
                          <li v="2">只显示月日</li>               
                          <li v="3">保密哦</li>
                        </ul>
                        <input type="hidden" class="input_hide" value="0" id="birthday_flag">
                      </div>
                    </div>
                    <div class="mis_alert birthday_msg"></div>
                    </div>
                    <div class="self_edit_right right"> 
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em>*</em>电话</span>
                        <input type="text" style="width:225px;" placeholder="手机号码" value="18005151538" id="phone">
                      </div>
                      <div class="mis_alert phone_msg"></div>                   
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em>*</em>邮箱</span>
                        <input type="text" placeholder="您接收面试通知的邮箱" value="416148489@qq.com" id="email">
                      </div>
                      <div class="mis_alert email_msg"></div>
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em>*</em>目前状态</span>
                        <div style="width: 240px;" class="seles seles_xl">
                          <span class="seles_choose current_state">
                                 暂时不想找工作
                          
                          </span>
                          <ul style="width: 240px;" class="seles_hide">
                            <li v="1">目前在职，正考虑换个新环境</li> 
                            <li v="2">目前已离职,可快速到岗</li> 
                            <li v="4">暂时不想找工作</li>                     
                          </ul>       
                          <input type="hidden" class="input_hide" value="4" id="state">
                        </div>
                      </div>
                      <div class="mis_alert state_msg"></div>
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em></em>微博</span>
                        <input type="text" style="width:225px;" placeholder="微博" class="weibo">
                      </div>
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em></em>github</span>
                        <input type="text" style="width:225px;" placeholder="github" class="github">
                      </div>
                      <div class="edit_list edit_list_fff">
                        <span class="span_fff"><em></em>站酷</span>
                        <input type="text" style="width:225px;" placeholder="站酷" class="zhanku">
                      </div>
                       <!--<div class="site">
                   </div>
                     <div class='mis_alert'></div>-->
                      
                    </div>
                    <div class="btns">
                      <a class="save" href="javascript:void(0);">保存</a>
                      <a class="cancel" href="javascript:void(0);">取消</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="dragDiv_edit">            
            <div class="top_seap"></div>
              <!-- 期望工作 -->
              <div id="dragDiv1" name="dragDiv" v="1" class="dragDiv">
                <div class="monitor monitor_job">
                    <div class="monitor_pos monitor_pos1"><div class="seap" style="height: 66px;"></div></div>
                 </div>
                   <div id="expect_con1" class="expect_con">
                    <div class="expect_title">期望工作</div>
                        <div class="self_list">
                          <div>
                            <span>期望职位</span>
                            <div class="want_position">俱乐部 赛事方</div>
                          </div>
                          <div>
                            <span>期望薪资</span>
                            <div class="want_salary">6K-8K</div>
                          </div>
                          <div>
                            <span>期望地点</span>
                            <div class="want_location">深圳</div>
                          </div>
                          <div style="display:none;">
                            <span>工作性质</span>
                            <div class="want_type"></div>
                          </div>
                          <div style="">
                            <span>期望领域</span>
                            <div class="want_industry">服务 文化艺术 在线旅游</div>
                          </div>
                        </div>                    
                        <div class="footer_edit"><span class="span_edit" style="display: none;"></span></div>
                        </div>
                        <div style="display:none;" id="expect_con2" class="expect_con">
                      <div class="expect_title">期望工作</div>
                          <div class="expect_con_left">
                            <div class="edit_list">
                          <span>期望职位<em>*</em></span>
                              <div class="seles selesjob_part">
                                <span style="position:relative; z-index:11;" class="seles_choose seles_xiala lala">
                                  <input type="text" class="hope_job lala" placeholder="期望职位" value="赛事运营 ">
                                  <div class="labels_con lala">
                                    <div class="divides">
                                      <span class="left left_item">俱乐部：</span>
                                      <div class="ul_div">
                                        <div class="li_div">
                                            <span>名称</span>
                                            <ul>
                                          <li>LGD</li>
                                          <li>EDG</li>
                                          <li>QG</li>
                                          <li>OMG</li>
                                          <li>SKT</li>
                                          <li>WE</li>
                                      </ul>
                                        </div>
                                        
                                    </div>
                                    <div class="divides">
                                      <span class="left left_item">赛事方：</span>
                                      <div class="ul_div">
                                        <div class="li_div">
                                          <span>视觉设计</span>
                                          <ul>
                                            <li>视觉设计师</li>
                                            <li>网页设计师</li>
                                            <li>Flash设计师</li>
                                            <li>APP设计师</li>
                                            <li>UI设计师</li>
                                            <li>平面设计师</li>
                                            <li>美术设计师（2D/3D）</li>
                                            <li>广告设计师</li>
                                            <li>多媒体设计师</li>
                                            <li>原画师</li>
                                            <li>游戏特效</li>
                                            <li>游戏界面设计师</li>
                                            <li>游戏场景</li>
                                            <li>游戏角色</li>
                                            <li>游戏动作</li>
                                          </ul>
                                        </div>
                                        <div class="li_div">
                                          <span>交互设计</span>
                                          <ul>
                                            <li>交互设计师</li>
                                            <li>无线交互设计师</li>
                                            <li>网页交互设计师</li>
                                            <li>硬件交互设计师</li>
                                          </ul>
                                        </div>
                                        <div class="li_div">
                                          <span>用户研究</span>
                                          <ul>
                                            <li>数据分析师</li>
                                            <li>用户研究员</li>
                                            <li>游戏数值策划</li>
                                          </ul>
                                        </div>
                                        <div style="width:125px;" class="li_div">
                                          <span style="width:120px;">高端设计职位</span>
                                          <ul>
                                            <li>设计经理/主管</li>
                                            <li>设计总监</li>
                                            <li>视觉设计经理/主管</li>
                                            <li>视觉设计总监</li>
                                            <li>交互设计经理/主管</li>
                                            <li>交互设计总监</li>
                                            <li>用户研究经理/主管</li>
                                            <li>用户研究总监</li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="divides">
                                      <span class="left left_item">电竞传媒：</span>
                                      <div class="ul_div">
                                        <div class="li_div">
                                            <span>运营</span>
                                            <ul>
                                              <li>用户运营</li>
                                          <li>产品运营</li>
                                          <li>数据运营</li>
                                          <li>内容运营</li>
                                          <li>活动运营</li>
                                          <li>商家运营</li>
                                          <li>品类运营</li>
                                          <li>游戏运营</li>
                                          <li>网络推广</li>
                                          <li>运营专员</li>
                                          <li>网店运营</li>
                                          <li>新媒体运营</li>
                                          <li>海外运营</li>
                                          <li>运营经理</li>
                                            </ul>
                                        </div>
                                        <div class="li_div">
                                            <span>编辑</span>
                                            <ul>
                                              <li>副主编</li>
                                          <li>内容编辑</li>
                                          <li>文案策划</li>
                                          <li>记者</li>
                                            </ul>
                                        </div>
                                        <div class="li_div">
                                            <span>客服</span>
                                            <ul>
                                              <li>售前咨询</li>
                                          <li>售后客服</li>
                                          <li>淘宝客服</li>
                                          <li>客服经理</li>
                                            </ul>
                                        </div>
                                        <div style="width:125px;" class="li_div">
                                          <span style="width:120px;">高端运营职位</span>
                                          <ul>
                                            <li>主编</li>
                                            <li>运营总监</li>
                                            <li>COO</li>
                                        <li>客服总监</li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="divides">
                                      <span class="left left_item">游戏开发：</span>
                                      <div class="ul_div">
                                        <div class="li_div">
                                            <span>市场/营销</span>
                                            <ul>
                                              <li>市场营销</li>
                                          <li>市场策划</li>
                                          <li>市场顾问</li>
                                          <li>市场推广</li>
                                          <li>SEO</li>
                                          <li>SEM</li>
                                          <li>商务渠道</li>
                                          <li>商业数据分析</li>
                                          <li>活动策划</li>
                                          <li>网络营销</li>
                                          <li>海外市场</li>
                                          <li>政府关系</li>
                                            </ul>
                                        </div>
                                        <div class="li_div">
                                          <span>公关</span>
                                          <ul>
                                            <li>媒介经理</li>
                                            <li>广告协调</li>
                                            <li>品牌公关</li>
                                          </ul>
                                        </div>
                                        <div class="li_div">
                                            <span>销售</span>
                                            <ul>
                                              <li>销售专员</li>
                                          <li>销售经理</li>
                                          <li>客户代表</li>
                                          <li>大客户代表</li>
                                          <li>BD经理</li>
                                          <li>商务渠道</li>
                                          <li>渠道销售</li>
                                          <li>代理商销售</li>
                                          <li>销售助理</li>
                                          <li>电话销售</li>
                                          <li>销售顾问</li>
                                          <li>商品经理</li>
                                            </ul>
                                        </div>
                                        <div class="li_div">
                                      <span>供应链</span>
                                      <ul class="pos_right">
                                        <li>物流</li>
                                        <li>仓储</li>
                                      </ul>
                                  </div>
                                  <div class="li_div">
                                      <span>采购</span>
                                      <ul>
                                          <li>采购专员</li>
                                          <li>采购经理</li>
                                          <li>商品经理</li>
                                      </ul>
                                  </div>
                                  <div class="li_div">
                                      <span>投资</span>
                                      <ul>
                                          <li>投资分析师</li>
                                          <li>投资顾问</li>
                                          <li>投资经理</li>
                                      </ul>
                                  </div>
                                        <div style="width:125px;" class="li_div">
                                            <span style="width:120px;">高端市场职位</span>
                                            <ul>
                                              <li>市场总监</li>
                                          <li>销售总监</li>
                                          <li>商务总监</li>
                                          <li>CMO</li>
                                          <li>公关总监</li>
                                          <li>投资总监</li>
                                          <li>采购总监</li>
                                            </ul>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="divides">
                                  <span class="left left_item">游戏运营：</span>
                                  <div class="ul_div">
                                    <div class="li_div">
                                      <span>人力资源</span>
                                      <ul>
                                        <li>人事专员</li>
                                        <li>招聘经理</li>
                                        <li>HRBP</li>
                                        <li>人事/HR</li>
                                        <li>培训经理</li>
                                        <li>薪资福利经理</li>
                                        <li>绩效考核经理</li>
                                        <li>员工关系</li>
                                        <li>人事主管</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>行政</span>
                                      <ul>
                                        <li>助理</li>
                                        <li>前台</li>
                                        <li>行政</li>
                                        <li>总经理助理</li>
                                        <li>文秘</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>财务</span>
                                      <ul class="pos_right">
                                        <li>会计</li>
                                        <li>出纳</li>
                                        <li>资金</li>
                                        <li>财务</li>
                                        <li>结算</li>
                                        <li>税务</li>
                                        <li>审计</li>
                                        <li>风控</li>
                                      </ul>
                                    </div>
                                    <div style="width:125px;" class="li_div">
                                      <span style="width:120px;">高端职能职位</span>
                                      <ul class="pos_rights">
                                        <li>行政总监/经理</li>
                                        <li>财务总监/经理</li>
                                        <li>HRD/HRM</li>
                                        <li>CFO</li>                          
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>法务</span>
                                      <ul>
                                        <li>法务专员</li>
                                        <li>律师</li>
                                        <li>专利</li>
                                        <li>法务经理</li>
                                      </ul>
                                    </div>
                                  </div>
                              </div>
                              <div class="divides">
                                  <span class="left left_item">电竞教育：</span>
                                  <div class="ul_div">
                                    <div class="li_div">
                                      <span>人力资源</span>
                                      <ul>
                                        <li>人事专员</li>
                                        <li>招聘经理</li>
                                        <li>HRBP</li>
                                        <li>人事/HR</li>
                                        <li>培训经理</li>
                                        <li>薪资福利经理</li>
                                        <li>绩效考核经理</li>
                                        <li>员工关系</li>
                                        <li>人事主管</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>行政</span>
                                      <ul>
                                        <li>助理</li>
                                        <li>前台</li>
                                        <li>行政</li>
                                        <li>总经理助理</li>
                                        <li>文秘</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>财务</span>
                                      <ul class="pos_right">
                                        <li>会计</li>
                                        <li>出纳</li>
                                        <li>资金</li>
                                        <li>财务</li>
                                        <li>结算</li>
                                        <li>税务</li>
                                        <li>审计</li>
                                        <li>风控</li>
                                      </ul>
                                    </div>
                                    <div style="width:125px;" class="li_div">
                                      <span style="width:120px;">高端职能职位</span>
                                      <ul class="pos_rights">
                                        <li>行政总监/经理</li>
                                        <li>财务总监/经理</li>
                                        <li>HRD/HRM</li>
                                        <li>CFO</li>                          
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>法务</span>
                                      <ul>
                                        <li>法务专员</li>
                                        <li>律师</li>
                                        <li>专利</li>
                                        <li>法务经理</li>
                                      </ul>
                                    </div>
                                  </div>
                              </div>
                              <div class="divides">
                                  <span class="left left_item">电竞门户：</span>
                                  <div class="ul_div">
                                    <div class="li_div">
                                      <span>人力资源</span>
                                      <ul>
                                        <li>人事专员</li>
                                        <li>招聘经理</li>
                                        <li>HRBP</li>
                                        <li>人事/HR</li>
                                        <li>培训经理</li>
                                        <li>薪资福利经理</li>
                                        <li>绩效考核经理</li>
                                        <li>员工关系</li>
                                        <li>人事主管</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>行政</span>
                                      <ul>
                                        <li>助理</li>
                                        <li>前台</li>
                                        <li>行政</li>
                                        <li>总经理助理</li>
                                        <li>文秘</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>财务</span>
                                      <ul class="pos_right">
                                        <li>会计</li>
                                        <li>出纳</li>
                                        <li>资金</li>
                                        <li>财务</li>
                                        <li>结算</li>
                                        <li>税务</li>
                                        <li>审计</li>
                                        <li>风控</li>
                                      </ul>
                                    </div>
                                    <div style="width:125px;" class="li_div">
                                      <span style="width:120px;">高端职能职位</span>
                                      <ul class="pos_rights">
                                        <li>行政总监/经理</li>
                                        <li>财务总监/经理</li>
                                        <li>HRD/HRM</li>
                                        <li>CFO</li>                          
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>法务</span>
                                      <ul>
                                        <li>法务专员</li>
                                        <li>律师</li>
                                        <li>专利</li>
                                        <li>法务经理</li>
                                      </ul>
                                    </div>
                                  </div>
                              </div>
                              <div class="divides">
                                  <span class="left left_item">电竞协会：</span>
                                  <div class="ul_div">
                                    <div class="li_div">
                                      <span>人力资源</span>
                                      <ul>
                                        <li>人事专员</li>
                                        <li>招聘经理</li>
                                        <li>HRBP</li>
                                        <li>人事/HR</li>
                                        <li>培训经理</li>
                                        <li>薪资福利经理</li>
                                        <li>绩效考核经理</li>
                                        <li>员工关系</li>
                                        <li>人事主管</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>行政</span>
                                      <ul>
                                        <li>助理</li>
                                        <li>前台</li>
                                        <li>行政</li>
                                        <li>总经理助理</li>
                                        <li>文秘</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>财务</span>
                                      <ul class="pos_right">
                                        <li>会计</li>
                                        <li>出纳</li>
                                        <li>资金</li>
                                        <li>财务</li>
                                        <li>结算</li>
                                        <li>税务</li>
                                        <li>审计</li>
                                        <li>风控</li>
                                      </ul>
                                    </div>
                                    <div style="width:125px;" class="li_div">
                                      <span style="width:120px;">高端职能职位</span>
                                      <ul class="pos_rights">
                                        <li>行政总监/经理</li>
                                        <li>财务总监/经理</li>
                                        <li>HRD/HRM</li>
                                        <li>CFO</li>                          
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>法务</span>
                                      <ul>
                                        <li>法务专员</li>
                                        <li>律师</li>
                                        <li>专利</li>
                                        <li>法务经理</li>
                                      </ul>
                                    </div>
                                  </div>
                              </div>
                              <div class="divides">
                                  <span class="left left_item">其他：</span>
                                  <div class="ul_div">
                                    <div class="li_div">
                                      <span>人力资源</span>
                                      <ul>
                                        <li>人事专员</li>
                                        <li>招聘经理</li>
                                        <li>HRBP</li>
                                        <li>人事/HR</li>
                                        <li>培训经理</li>
                                        <li>薪资福利经理</li>
                                        <li>绩效考核经理</li>
                                        <li>员工关系</li>
                                        <li>人事主管</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>行政</span>
                                      <ul>
                                        <li>助理</li>
                                        <li>前台</li>
                                        <li>行政</li>
                                        <li>总经理助理</li>
                                        <li>文秘</li>
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>财务</span>
                                      <ul class="pos_right">
                                        <li>会计</li>
                                        <li>出纳</li>
                                        <li>资金</li>
                                        <li>财务</li>
                                        <li>结算</li>
                                        <li>税务</li>
                                        <li>审计</li>
                                        <li>风控</li>
                                      </ul>
                                    </div>
                                    <div style="width:125px;" class="li_div">
                                      <span style="width:120px;">高端职能职位</span>
                                      <ul class="pos_rights">
                                        <li>行政总监/经理</li>
                                        <li>财务总监/经理</li>
                                        <li>HRD/HRM</li>
                                        <li>CFO</li>                          
                                      </ul>
                                    </div>
                                    <div class="li_div">
                                      <span>法务</span>
                                      <ul>
                                        <li>法务专员</li>
                                        <li>律师</li>
                                        <li>专利</li>
                                        <li>法务经理</li>
                                      </ul>
                                    </div>
                                  </div>
                              </div>
                                  </div>
                                </span>
                              </div>
                            </div>
                            <div class="mis_alert want_position_msg"></div> 
                        <div class="edit_list">
                          <span>期望薪资<em>*</em></span>
                          <div class="seles selesjob_part">
                            <span class="seles_choose w_salary">6K-8K</span>
                            <ul class="seles_hide">
                              <li v="1">4K以下</li> 
                              <li v="2">4K-6K</li> 
                              <li v="3">6K-8K</li> 
                              <li v="4">8K-10K</li> 
                              <li v="5">10K-15K</li> 
                              <li v="6">15K-20K</li> 
                              <li v="7">20K-30K</li> 
                              <li v="8">30K以上</li>
                            </ul>       
                            <input type="hidden" class="input_hide" value="3" id="salary">
                          </div>
                        </div>
                        <div class="mis_alert want_salary_msg"></div>
                            <div style="position:relative; z-index:8;" class="edit_list">
                          <span>期望地点<em>*</em></span>
                              <div class="seles selesjob_part">
                                <span class="seles_choose">深圳</span>
                                <ul class="seles_hide seles_hide_city">
                                  <li v="北京">北京</li> 
                                  <li v="上海">上海</li> 
                                  <li v="深圳">深圳</li> 
                                  <li v="广州">广州</li> 
                                  <li v="杭州">杭州</li> 
                                  <li v="天津">天津</li> 
                                  <li v="成都">成都</li> 
                                  <li v="西安">西安</li> 
                                  <li v="重庆">重庆</li> 
                                  <li v="南京">南京</li> 
                                  <li v="沈阳">沈阳</li>                 
                                  <li v="武汉">武汉</li>                 
                                  <li v="郑州">郑州</li>                 
                                  <li v="大连">大连</li>                 
                                  <li v="济南">济南</li>                 
                                  <li class="eee lala" v="其他">其他</li>                 
                                </ul>       
                                <input type="hidden" class="input_hide" value="深圳" id="location">
                              </div>
                              <input type="text" style="display:none;" class="qita_input lala" placeholder="其他城市" value="">
                            </div>
                            <div class="mis_alert location_msg"></div>                   
                      </div>
                      <div class="expect_con_right">                    
                            <div class="edit_list">
                          <span>工作性质<em></em></span>
                          <div class="seles selesjob_part">
                            <span class="seles_choose">
                                          求职类型
                            </span>
                            <ul class="seles_hide">
                              <li v="1">实习</li> 
                              <li v="2">兼职</li> 
                              <li v="3">全职</li> 
                            </ul>       
                            <input type="hidden" class="input_hide" value="" id="job_type">
                          </div>
                        </div>
                        <div class="mis_alert job_type_msg"></div>  
                        <div class="edit_list">
                          <span>期望领域<em></em></span>
                              <div class="seles selesjob_part">
                                <span style="position:relative; z-index:11;" class="seles_choose seles_xiala lala">
                                  <div id="lingyu" class="lala lingyu_shuru wantIndustry ">服务 文化艺术 在线旅游</div>
                                  <div style="width:420px;" class="labels_con lala qiwang_position">
                                    <div class="lingyu1 lingyu ">
                                        <div class="gaga" id="7">O2O</div>
                                <div class="gaga" id="9">社交</div>
                                <div class="gaga addcss" id="12">服务</div>
                                <div class="gaga" id="2">游戏</div>
                                <div class="gaga" id="18">硬件</div>
                                <div class="gaga" id="21">搜索</div>
                                <div class="gaga" id="25">安全</div>
                                <div class="gaga" id="26">媒体</div>
                                    </div>
                                    <div class="lingyu2 lingyu gaga">
                                       <div class="gaga" id="6">电子商务</div>
                               <div class="gaga" id="10">企业服务</div>
                               <div class="gaga addcss" id="13">文化艺术</div>
                               <div class="gaga addcss" id="4">在线旅游</div>
                               <div class="gaga" id="19">健康医疗</div>
                               <div class="gaga" id="22">生活服务</div>
                                    </div>
                                    <div class="lingyu2 lingyu gaga">
                                       <div class="gaga" id="5">在线教育</div>
                               <div class="gaga" id="11">移动广告</div>
                               <div class="gaga" id="14">智能家居</div>
                               <div class="gaga" id="16">智能电视</div>
                               <div class="gaga" id="20">分类信息</div>
                               <div class="gaga" id="23">在线招聘</div>
                                    </div>
                                    <div class="lingyu3 lingyu gaga">
                                       <div class="gaga" id="8">移动互联网</div>
                               <div class="gaga" id="1">互联网金融</div>
                               <div class="gaga" id="15">社会化营销</div>
                               <div class="gaga" id="17">视频多媒体</div>
                               <div class="gaga" id="3">可穿戴设备</div>
                               <div class="gaga" id="24">云计算/大数据</div>
                                    </div>
                                    <input type="hidden" value="12,13,4" class="input_hide" id="want_industry">
                                  </div>
                                </span>
                              </div>
                            </div>  
                            <div id="lingyu_msg" class="mis_alert lingyu_msg"></div>                 
                          </div>
                          
                          <div class="btns">
                            <a class="qwgz_save save" href="javascript:void(0);">保存</a>
                            <a class="qwgz_cancel cancel" href="javascript:void(0);">取消</a>
                          </div>
                        </div>
                        <div id="expect_con3" class="expect_con" style="display: none;">
                      <div class="default"><span>添加期望选项</span></div>
                    </div>
                </div>
                <!-- 教育背景编辑 -->
                    <div id="dragDiv4" name="dragDiv" v="4" class="dragDiv">
                      <div class="monitor monitor_job">
                        <div class="monitor_pos monitor_pos2"><div class="seap" style="height: 80px;"></div></div>
                     </div>
                     <div class="gzjl1CON">
                          <div id="titleBar4" class="expect_title">教育背景</div>
                          <div style="display:none;" id="edu1" class="expect_con">
                            <div id="jybj_div" class="jybj_div">
                            </div>
                            <div style="display: none;" class="more_experience"><span class="more_xl"></span></div>
                          </div> 
                          <div style="display:none;" id="edu2" class="expect_con">
                            <input type="hidden" value="" class="education_id">
                            <div class="expect_con_left">
                                <div class="edit_list">
                                  <span>学校名称<em>*</em></span>
                                  <input type="text" placeholder="学校名称" id="school_name" class="gsmc">
                                </div>
                                <div class="mis_alert school_name_msg"></div>
                                <div class="edit_list">
                                  <span>专业名称<em>*</em></span>
                                  <input type="text" placeholder="专业名称" id="zhuanye_name" class="gsmc">
                                </div>
                                <div class="mis_alert zhuanye_name_msg"></div>
                            </div>
                            <div class="expect_con_right">
                              <div class="edit_list">
                                <span>最高学历<em>*</em></span>
                                <div class="seles selesjob_part">
                                  <span id="collegeLevel" class="seles_choose">学历</span>
                                  <ul class="seles_hide">
                                    <li v="1">大专以下</li>               
                                    <li v="2">大专</li>
                                    <li v="3">本科</li>               
                                    <li v="4">硕士</li>
                                    <li v="5">博士</li>
                                  </ul>
                                  <input type="hidden" class="input_hide" value="" id="college_level">
                                </div>   
                              </div>
                              <div class="mis_alert college_level_msg"></div>
                              <div class="edit_list">
                                <span>入学年份<em>*</em></span>
                                <div class="seles seles_start">
                                  <span id="ruxue_time" class="seles_choose">入学年份</span>
                                  <ul class="seles_hide">
                                    <li v="2015">2015</li>
                                    <li v="2014">2014</li>     
                                  <li v="2013">2013</li>     
                                  <li v="2012">2012</li>     
                                  <li v="2011">2011</li>     
                                  <li v="2010">2010</li>     
                                  <li v="2009">2009</li>     
                                  <li v="2008">2008</li>     
                                  <li v="2007">2007</li>     
                                  <li v="2006">2006</li>     
                                  <li v="2005">2005</li>     
                                  <li v="2004">2004</li>     
                                  <li v="2003">2003</li>     
                                    <li v="2002">2002</li>               
                                    <li v="2001">2001</li>
                                    <li v="2000">2000</li>               
                                    <li v="1999">1999</li>               
                                    <li v="1998">1998</li>               
                                    <li v="1997">1997</li>               
                                    <li v="1996">1996</li>               
                                    <li v="1995">1995</li>               
                                    <li v="1994">1994</li>               
                                    <li v="1993">1993</li>               
                                    <li v="1992">1992</li>               
                                    <li v="1991">1991</li>               
                                    <li v="1990">1990</li>               
                                    <li v="1989">1989</li>               
                                    <li v="1988">1988</li>               
                                    <li v="1987">1987</li>               
                                    <li v="1986">1986</li>               
                                    <li v="1985">1985</li>               
                                    <li v="1984">1984</li>               
                                    <li v="1983">1983</li>               
                                    <li v="1982">1982</li>               
                                    <li v="1981">1981</li>               
                                    <li v="1980">1980</li>
                                    <li v="1979">1979</li>               
                                    <li v="1978">1978</li>               
                                    <li v="1977">1977</li>               
                                    <li v="1976">1976</li>               
                                    <li v="1975">1975</li>               
                                    <li v="1974">1974</li>               
                                    <li v="1973">1973</li>               
                                    <li v="1972">1972</li>               
                                    <li v="1971">1971</li>               
                                    <li v="1970">1970</li>     
                                  </ul>
                                  <input type="hidden" class="input_hide" value="" id="ed_s_year">
                                </div>
                                <div style="margin-right:0px;" class="seles seles_start">
                                  <span id="biye_time" class="seles_choose">毕业年份</span>
                                  <ul class="seles_hide">
                                  <li v="2020">2020</li>    
                                  <li v="2019">2019</li>    
                                  <li v="2018">2018</li>    
                                  <li v="2017">2017</li>    
                                  <li v="2016">2016</li>    
                                  <li v="2015">2015</li>    
                                    <li v="2014">2014</li>     
                                  <li v="2013">2013</li>     
                                  <li v="2012">2012</li>     
                                  <li v="2011">2011</li>     
                                  <li v="2010">2010</li>     
                                  <li v="2009">2009</li>     
                                  <li v="2008">2008</li>     
                                  <li v="2007">2007</li>     
                                  <li v="2006">2006</li>     
                                  <li v="2005">2005</li>     
                                  <li v="2004">2004</li>     
                                  <li v="2003">2003</li>     
                                    <li v="2002">2002</li>               
                                    <li v="2001">2001</li>
                                    <li v="2000">2000</li>               
                                    <li v="1999">1999</li>               
                                    <li v="1998">1998</li>               
                                    <li v="1997">1997</li>               
                                    <li v="1996">1996</li>               
                                    <li v="1995">1995</li>               
                                    <li v="1994">1994</li>               
                                    <li v="1993">1993</li>               
                                    <li v="1992">1992</li>               
                                    <li v="1991">1991</li>               
                                    <li v="1990">1990</li>               
                                    <li v="1989">1989</li>               
                                    <li v="1988">1988</li>               
                                    <li v="1987">1987</li>               
                                    <li v="1986">1986</li>               
                                    <li v="1985">1985</li>               
                                    <li v="1984">1984</li>               
                                    <li v="1983">1983</li>               
                                    <li v="1982">1982</li>               
                                    <li v="1981">1981</li>               
                                    <li v="1980">1980</li>
                                    <li v="1979">1979</li>               
                                    <li v="1978">1978</li>               
                                    <li v="1977">1977</li>               
                                    <li v="1976">1976</li>               
                                    <li v="1975">1975</li>               
                                    <li v="1974">1974</li>               
                                    <li v="1973">1973</li>               
                                    <li v="1972">1972</li>               
                                    <li v="1971">1971</li>               
                                    <li v="1970">1970</li>     
                                  </ul>
                                  <input type="hidden" class="input_hide" value="" id="ed_e_year">
                                </div>
                              </div>
                              <div class="mis_alert ed_time_msg"></div>
                            </div>
                            <div class="con_textarea">
                              <div class="edit_list">
                                <textarea placeholder="请填写你的专业学习情况、社团实践活动、论文发表等，有助于公司全面了解你的学习和专业能力哦~" id="ed_description"></textarea>
                                <p class="yu"><font>您还可以输入500字</font></p>
                                <div class="mis_alert ed_description_msg"></div>
                              </div>
                            </div>
                            <div style="padding-top:0px;" class="btns">
                              <a class="jybj_save save" href="javascript:void(0);">保存</a>
                              <a class="jybj_cancel cancel" href="javascript:void(0);">取消</a>
                            </div>
                          </div>
                          <div id="edu3" class="expect_con">
                            <div class="default"><span style="padding-top:13px;">是学霸还是学渣，晒晒不就知道了嘛！这年头，不管学霸学渣，只要努力，都能成为人生赢家！</span></div>
                          </div>
                      </div>
                    </div>
                      <!-- 工作经历编辑 -->
                    <div id="dragDiv2" name="dragDiv" v="2" class="dragDiv">
                      <div class="monitor monitor_job">
                        <div class="monitor_pos monitor_pos3"><div class="seap" style="height: 80px;"></div></div>
                     </div>
                     <div class="gzjl1CON">
                          <div id="titleBar2" class="expect_title">工作经历</div>
                        <div style="display:none;" id="gzjl1" class="expect_con">
                          <div id="gzjl_div" class="gzjl_div">      
                          </div>
                            <div style="display: none;" class="more_experience"><span class="more_jl"></span></div>
                        </div> 
                        <div style="display:none;" id="gzjl2" class="expect_con">
                          <input type="hidden" value="" class="work_id">
                          <div class="expect_con_left">
                            <div class="edit_list gsmc_la">
                                <span>公司名称<em>*</em></span>
                              <input type="text" placeholder="公司名称" id="company_name" class="gsmc">
                            </div>
                            <div class="mis_alert c_name_msg"></div>
                            <div class="edit_list">
                                <span>入职年月<em>*</em></span>
                              <div class="seles seles_start">
                                <span id="start_year" class="seles_choose">入职年份</span>
                                <ul class="seles_hide">
                                  <li v="2015">2015</li>   
                                <li v="2014">2014</li>     
                                <li v="2013">2013</li>     
                                <li v="2012">2012</li>     
                                <li v="2011">2011</li>     
                                <li v="2010">2010</li>     
                                <li v="2009">2009</li>     
                                <li v="2008">2008</li>     
                                <li v="2007">2007</li>     
                                <li v="2006">2006</li>     
                                <li v="2005">2005</li>     
                                <li v="2004">2004</li>     
                                <li v="2003">2003</li>     
                                  <li v="2002">2002</li>               
                                  <li v="2001">2001</li>
                                  <li v="2000">2000</li>               
                                  <li v="1999">1999</li>               
                                  <li v="1998">1998</li>               
                                  <li v="1997">1997</li>               
                                  <li v="1996">1996</li>               
                                  <li v="1995">1995</li>               
                                  <li v="1994">1994</li>               
                                  <li v="1993">1993</li>               
                                  <li v="1992">1992</li>               
                                  <li v="1991">1991</li>               
                                  <li v="1990">1990</li>               
                                  <li v="1989">1989</li>               
                                  <li v="1988">1988</li>               
                                  <li v="1987">1987</li>               
                                  <li v="1986">1986</li>               
                                  <li v="1985">1985</li>               
                                  <li v="1984">1984</li>               
                                  <li v="1983">1983</li>               
                                  <li v="1982">1982</li>               
                                  <li v="1981">1981</li>               
                                  <li v="1980">1980</li>
                                  <li v="1979">1979</li>               
                                  <li v="1978">1978</li>               
                                  <li v="1977">1977</li>               
                                  <li v="1976">1976</li>               
                                  <li v="1975">1975</li>               
                                  <li v="1974">1974</li>               
                                  <li v="1973">1973</li>               
                                  <li v="1972">1972</li>               
                                  <li v="1971">1971</li>               
                                  <li v="1970">1970</li>               
                                </ul>
                                <input type="hidden" class="input_hide" value="" id="jl_s_year">
                              </div>
                              <div style="margin-right:0px;" class="seles seles_start">
                                <span id="start_month" class="seles_choose">入职月份</span>
                                <ul class="seles_hide">
                                    <li v="01">01</li>               
                                <li v="02">02</li>               
                                <li v="03">03</li>
                                <li v="04">04</li>
                                <li v="05">05</li>
                                <li v="06">06</li>
                                <li v="07">07</li>
                                <li v="08">08</li>
                                <li v="09">09</li>
                                <li v="10">10</li>
                                <li v="11">11</li>
                                <li v="12">12</li>
                                </ul>
                                <input type="hidden" class="input_hide" value="" id="jl_s_month">
                              </div>
                            </div>
                            <div class="mis_alert jl_s_msg"></div>
                            <div class="edit_list">
                                  <span>公司领域<em>*</em></span>
                                <div class="seles selesjob_part">
                                  <span style="position:relative; z-index:11;" class="seles_choose seles_xiala lala">
                                    <div class="lala lingyu_shuru c_lingyu">公司领域</div>
                                    <div style="width:420px;" class="labels_con lala company_lingyu">
                                      <div class="lingyu1 lingyu">
                                        <div class="7" id="7">O2O</div>
                                <div class="9" id="9">社交</div>
                                <div class="12" id="12">服务</div>
                                <div class="2" id="2">游戏</div>
                                <div class="18" id="18">硬件</div>
                                <div class="21" id="21">搜索</div>
                                <div class="25" id="25">安全</div>
                                <div class="26" id="26">媒体</div>
                                    </div>
                                    <div class="lingyu2 lingyu">
                                       <div class="6" id="6">电子商务</div>
                               <div class="10" id="10">企业服务</div>
                               <div class="13" id="13">文化艺术</div>
                               <div class="4" id="4">在线旅游</div>
                               <div class="19" id="19">健康医疗</div>
                               <div class="22" id="22">生活服务</div>
                                    </div>
                                    <div class="lingyu2 lingyu">
                                       <div class="5" id="5">在线教育</div>
                               <div class="11" id="11">移动广告</div>
                               <div class="14" id="14">智能家居</div>
                               <div class="16" id="16">智能电视</div>
                               <div class="20" id="20">分类信息</div>
                               <div class="23" id="23">在线招聘</div>
                                    </div>
                                    <div class="lingyu3 lingyu">
                                       <div class="8" id="8">移动互联网</div>
                               <div class="1" id="1">互联网金融</div>
                               <div class="15" id="15">社会化营销</div>
                               <div class="17" id="17">视频多媒体</div>
                               <div class="3" id="3">可穿戴设备</div>
                               <div class="24" id="24">云计算/大数据</div>
                                    </div>
                                    <input type="hidden" value="" class="input_hide" id="c_lingyu">
                                    </div>
                                  </span>
                                </div>
                              </div> 
                              <div class="mis_alert c_lingyu_msg"></div>
                          </div>
                          <div class="expect_con_right">
                            <div class="edit_list">
                                <span>职位名称<em>*</em></span>
                              <input type="text" placeholder="职位名称" id="position_name" class="gsmc">
                            </div>
                            <div class="mis_alert c_position_msg"></div>
                            <div class="edit_list">
                                <span>离职年月<em>*</em></span>
                              <div class="seles seles_start">
                                <span id="end_year" class="seles_choose">离职年份</span>
                                <ul id="lizhiyear" class="seles_hide">
                                  <li v="至今">至今</li>
                                  <li v="2015">2015</li>
                                  <li v="2014">2014</li>     
                                <li v="2013">2013</li>     
                                <li v="2012">2012</li>     
                                <li v="2011">2011</li>     
                                <li v="2010">2010</li>     
                                <li v="2009">2009</li>     
                                <li v="2008">2008</li>     
                                <li v="2007">2007</li>     
                                <li v="2006">2006</li>     
                                <li v="2005">2005</li>     
                                <li v="2004">2004</li>     
                                <li v="2003">2003</li>     
                                  <li v="2002">2002</li>               
                                  <li v="2001">2001</li>
                                  <li v="2000">2000</li>               
                                  <li v="1999">1999</li>               
                                  <li v="1998">1998</li>               
                                  <li v="1997">1997</li>               
                                  <li v="1996">1996</li>               
                                  <li v="1995">1995</li>               
                                  <li v="1994">1994</li>               
                                  <li v="1993">1993</li>               
                                  <li v="1992">1992</li>               
                                  <li v="1991">1991</li>               
                                  <li v="1990">1990</li>               
                                  <li v="1989">1989</li>               
                                  <li v="1988">1988</li>               
                                  <li v="1987">1987</li>               
                                  <li v="1986">1986</li>               
                                  <li v="1985">1985</li>               
                                  <li v="1984">1984</li>               
                                  <li v="1983">1983</li>               
                                  <li v="1982">1982</li>               
                                  <li v="1981">1981</li>               
                                  <li v="1980">1980</li>
                                  <li v="1979">1979</li>               
                                  <li v="1978">1978</li>               
                                  <li v="1977">1977</li>               
                                  <li v="1976">1976</li>               
                                  <li v="1975">1975</li>               
                                  <li v="1974">1974</li>               
                                  <li v="1973">1973</li>               
                                  <li v="1972">1972</li>               
                                  <li v="1971">1971</li>               
                                  <li v="1970">1970</li>     
                                </ul>
                                <input type="hidden" class="input_hide" value="" id="jl_e_year">
                              </div>
                              <div style="margin-right:0px;display:none;" class="seles seles_start">
                                <span id="end_month" class="seles_choose">离职月份</span>
                                <ul class="seles_hide">
                                    <li v="01">01</li>               
                                <li v="02">02</li>               
                                <li v="03">03</li>
                                <li v="04">04</li>
                                <li v="05">05</li>
                                <li v="06">06</li>
                                <li v="07">07</li>
                                <li v="08">08</li>
                                <li v="09">09</li>
                                <li v="10">10</li>
                                <li v="11">11</li>
                                <li v="12">12</li>
                                </ul>
                                <input type="hidden" class="input_hide" value="" id="jl_e_month">
                              </div>
                            </div>  
                            <div class="mis_alert jl_e_msg"></div>
                            <div class="edit_list">
                                <span>公司规模<em></em></span>
                              <div class="seles selesjob_part">
                                <span class="seles_choose c_guimo">公司规模</span>
                                <ul class="seles_hide">
                                  <li v="1">少于15人</li>
                                  <li v="2">15-50人</li>
                                  <li v="3">50-100人</li>
                                  <li v="4">100-500人</li>
                                  <li v="5">500-2000人</li>
                                  <li v="6">2000人以上</li>
                                </ul>
                                <input type="hidden" class="input_hide" value="" id="c_guimo">
                              </div>
                            </div>  
                            <div class="mis_alert c_guimo_msg"></div>
                          </div>
                          <div class="con_textarea">
                            <div class="edit_list">
                              <textarea placeholder="请具体描述你的工作内容，有助于公司全面了解你的工作能力哦~" id="c_description"></textarea>
                              <p class="yu"><font>您还可以输入500字</font></p>
                              <div class="mis_alert c_description_msg"></div>
                            </div>
                          </div>
                          <div style="padding-top:0px;" class="btns">
                            <a class="gzjy_save save" href="javascript:void(0);">保存</a>
                            <a class="gzjy_cancel cancel" href="javascript:void(0);">取消</a>
                          </div>
                        </div>
                        <div id="gzjl3" class="expect_con">
                            <div class="default"><span>HR还是蛮看重有没有工作经历的！赶紧告诉TA你以前干过啥呗</span></div>
                          </div>
                        </div>
                    </div>
                      <!-- 项目经验编辑 -->
                      <div id="dragDiv3" name="dragDiv" v="3" class="dragDiv">
                        <div class="monitor monitor_job">
                        <div class="monitor_pos monitor_pos4"><div class="seap" style="height: 80px;"></div></div>
                     </div>
                     <div class="gzjl1CON">
                           <div id="titleBar3" class="expect_title">项目/赛事经验</div>
                        <div style="display:none;" id="item_exprience1" class="expect_con">
                            <div id="xmjy_div" class="xmjy_div">
                             </div>
                            <div style="display: none;" class="more_experience"><span class="more_xm"></span></div>
                        </div>
                        <div style="display:none;" id="item_exprience2" class="expect_con">
                          <input type="hidden" value="" class="project_id">
                          <div class="expect_con_left">
                              <div class="edit_list">
                                  <span>项目名称<em>*</em></span>
                                <input type="text" placeholder="项目名称" id="project_name_jy" class="gsmc">
                              </div>
                              <div class="mis_alert company_name_jy_msg"></div>
                              <div class="edit_list">
                                    <span>开始年月<em>*</em></span>
                                  <div class="seles seles_start">
                                    <span id="start_year_jy" class="seles_choose">开始年份</span>
                                    <ul class="seles_hide">
                                      <li v="2015">2015</li>
                                      <li v="2014">2014</li>     
                                    <li v="2013">2013</li>     
                                    <li v="2012">2012</li>     
                                    <li v="2011">2011</li>     
                                    <li v="2010">2010</li>     
                                    <li v="2009">2009</li>     
                                    <li v="2008">2008</li>     
                                    <li v="2007">2007</li>     
                                    <li v="2006">2006</li>     
                                    <li v="2005">2005</li>     
                                    <li v="2004">2004</li>     
                                    <li v="2003">2003</li>     
                                      <li v="2002">2002</li>               
                                      <li v="2001">2001</li>
                                      <li v="2000">2000</li>               
                                      <li v="1999">1999</li>               
                                      <li v="1998">1998</li>               
                                      <li v="1997">1997</li>               
                                      <li v="1996">1996</li>               
                                      <li v="1995">1995</li>               
                                      <li v="1994">1994</li>               
                                      <li v="1993">1993</li>               
                                      <li v="1992">1992</li>               
                                      <li v="1991">1991</li>               
                                      <li v="1990">1990</li>               
                                      <li v="1989">1989</li>               
                                      <li v="1988">1988</li>               
                                      <li v="1987">1987</li>               
                                      <li v="1986">1986</li>               
                                      <li v="1985">1985</li>               
                                      <li v="1984">1984</li>               
                                      <li v="1983">1983</li>               
                                      <li v="1982">1982</li>               
                                      <li v="1981">1981</li>               
                                      <li v="1980">1980</li>
                                      <li v="1979">1979</li>               
                                      <li v="1978">1978</li>               
                                      <li v="1977">1977</li>               
                                      <li v="1976">1976</li>               
                                      <li v="1975">1975</li>               
                                      <li v="1974">1974</li>               
                                      <li v="1973">1973</li>               
                                      <li v="1972">1972</li>               
                                      <li v="1971">1971</li>               
                                      <li v="1970">1970</li>     
                                    </ul>
                                    <input type="hidden" class="input_hide" value="" id="jy_s_year">
                                  </div>
                                <div style="margin-right:0px;" class="seles seles_start">
                                    <span id="start_month_jy" class="seles_choose">开始月份</span>
                                    <ul class="seles_hide">
                                        <li v="01">01</li>               
                                    <li v="02">02</li>               
                                    <li v="03">03</li>
                                    <li v="04">04</li>
                                    <li v="05">05</li>
                                    <li v="06">06</li>
                                    <li v="07">07</li>
                                    <li v="08">08</li>
                                    <li v="09">09</li>
                                    <li v="10">10</li>
                                    <li v="11">11</li>
                                    <li v="12">12</li>
                                    </ul>
                                    <input type="hidden" class="input_hide" value="" id="jy_s_month">
                                </div>
                              </div>
                              <div class="mis_alert jy_s_msg"></div>
                          </div>
                          <div class="expect_con_right">
                              <div class="edit_list">
                                  <span>职务名称<em>*</em></span>
                                <input type="text" placeholder="职务名称" id="position_name_jy" class="gsmc">
                              </div>
                              <div class="mis_alert position_name_jy_msg"></div>
                              <div class="edit_list">
                                  <span>结束年月<em>*</em></span>
                                <div id="jieshuyear" class="seles seles_start">
                                  <span id="end_year_jy" class="seles_choose">结束年份</span>
                                  <ul class="seles_hide">
                                    <li v="至今">至今</li>  
                                    <li v="2015">2015</li>    
                                    <li v="2014">2014</li>     
                                  <li v="2013">2013</li>     
                                  <li v="2012">2012</li>     
                                  <li v="2011">2011</li>     
                                  <li v="2010">2010</li>     
                                  <li v="2009">2009</li>     
                                  <li v="2008">2008</li>     
                                  <li v="2007">2007</li>     
                                  <li v="2006">2006</li>     
                                  <li v="2005">2005</li>     
                                  <li v="2004">2004</li>     
                                  <li v="2003">2003</li>     
                                    <li v="2002">2002</li>               
                                    <li v="2001">2001</li>
                                    <li v="2000">2000</li>               
                                    <li v="1999">1999</li>               
                                    <li v="1998">1998</li>               
                                    <li v="1997">1997</li>               
                                    <li v="1996">1996</li>               
                                    <li v="1995">1995</li>               
                                    <li v="1994">1994</li>               
                                    <li v="1993">1993</li>               
                                    <li v="1992">1992</li>               
                                    <li v="1991">1991</li>               
                                    <li v="1990">1990</li>               
                                    <li v="1989">1989</li>               
                                    <li v="1988">1988</li>               
                                    <li v="1987">1987</li>               
                                    <li v="1986">1986</li>               
                                    <li v="1985">1985</li>               
                                    <li v="1984">1984</li>               
                                    <li v="1983">1983</li>               
                                    <li v="1982">1982</li>               
                                    <li v="1981">1981</li>               
                                    <li v="1980">1980</li>
                                    <li v="1979">1979</li>               
                                    <li v="1978">1978</li>               
                                    <li v="1977">1977</li>               
                                    <li v="1976">1976</li>               
                                    <li v="1975">1975</li>               
                                    <li v="1974">1974</li>               
                                    <li v="1973">1973</li>               
                                    <li v="1972">1972</li>               
                                    <li v="1971">1971</li>               
                                    <li v="1970">1970</li>     
                                  </ul>
                                  <input type="hidden" class="input_hide" value="" id="jy_e_year">
                                </div>
                                <div style="margin-right:0px;display:none;" class="seles seles_start">
                                  <span id="end_month_jy" class="seles_choose">结束月份</span>
                                  <ul class="seles_hide">
                                      <li v="01">01</li>               
                                  <li v="02">02</li>               
                                  <li v="03">03</li>
                                  <li v="04">04</li>
                                  <li v="05">05</li>
                                  <li v="06">06</li>
                                  <li v="07">07</li>
                                  <li v="08">08</li>
                                  <li v="09">09</li>
                                  <li v="10">10</li>
                                  <li v="11">11</li>
                                  <li v="12">12</li>
                                  </ul>
                                  <input type="hidden" class="input_hide" value="" id="jy_e_month">
                                </div>
                              </div>
                              <div class="mis_alert jy_e_msg"></div>
                          </div>
                          <div class="con_textarea">
                              <div class="edit_list">
                                <textarea placeholder="请具体描述你的项目内容，有助于公司全面了解你哦~" id="jy_description"></textarea>
                                <p class="yu"><font>您还可以输入500字</font></p>
                                <div class="mis_alert jy_description_msg"></div>
                              </div>
                          </div>
                          <div style="padding-top:0px;" class="btns">
                              <a class="xmjy_save save" href="javascript:void(0);">保存</a>
                              <a class="xmjy_cancel cancel" href="javascript:void(0);">取消</a>
                          </div>
                        </div>
                        <div id="item_exprience3" class="expect_con">
                             <div class="default"><span>理工科咖，没做过项目？不应该吧…<br>文科咖还能原谅一下…</span></div>
                        </div> 
                    </div>
                      </div>
                      
                      <!-- 专业技能 -->
                    <div id="dragDiv5" name="dragDiv" v="5" class="dragDiv">
                      <div class="monitor monitor_job">
                        <div class="monitor_pos monitor_pos5"><div class="seap" style="height: 90px;"></div></div>
                     </div>
                     <div class="gzjl1CON">
                          <div id="titleBar5" class="expect_title">电竞经验</div>
                        <div style="display:none" id="zyjn1" class="expect_con">
                           <div class="jineng_div">
                          </div>
                          <div class="footer_edit "><span class="span_del"></span><span class="span_edit"></span>
                          </div>
                        </div>
                        <div style="display:none" id="zyjn2" class="expect_con">
                          <div class="label_s">
                            <div class="lala" id="add_ci">
                              <ul id="add" class="add_cons">
                              </ul>
                              <input type="text" autocomplete="OFF" placeholder="输入你擅长的互联网技能名词（如：html5）" value="" id="input_str">
                              <code style="display: none;">+</code>
                              <div class="remove_con">
                                
                              </div>
                            </div>
                            <div class="tab_list lala">
                              <div class="tab_li"><span class="active moren">常用</span><span>ABCD</span><span>EFG</span><span>HIJK</span><span>LMN</span><span>OPQ</span><span>RST</span><span>UVW</span><span>XYZ</span><span>自定义</span><font></font>
                              </div>
                              <ul class="tab_con">
                              </ul>
                            </div>
                            <div class="keys lala">
                              <div class="add_tj">
                                <span>若系统标签不合适，请添加自定义标签</span> <a title="" href="javascript:void(0);">添加</a>
                              </div>
                              <ul id="ulItems" class="search_ul">
                              </ul>
                            </div>
                          </div>
                          <div class="btns">
                            <a class="zyjn_save save" href="javascript:void(0);">保存</a>
                            <a class="zyjn_cancel cancel" href="javascript:void(0);">取消</a>
                          </div>
                        </div>
                        <div id="zyjn3" class="expect_con">
                            <div class="default"><span>新时代，新青年，谁还没有一两个绝世技能？</span></div>
                          </div>
                        </div>
                    </div>
                      <!-- 作品展示 -->
                    <div id="dragDiv7" name="dragDiv" v="7" class="dragDiv">
                      <div class="monitor monitor_job">
                        <div class="monitor_pos monitor_pos6"><div class="seap" style="height: 90px;"></div></div>
                     </div>
                     <div class="gzjl1CON">
                          <div id="titleBar7" class="expect_title">技能特长</div>
                          <div style="display:none;" id="works1" class="expect_con">
                            <ul id="zuopin" class="zuopin works_a">
                          </ul>
                        </div>
                        <div id="works2" class="expect_con">
                          <div class="upload_works">
                            <div class="fileInput">
                              <input type="button" value="上传作品" class="upFileBtn">
                               <input type="file" onchange="javascript:upload();" class="upfile" id="f_product" name="f_product">
                              <li id="upedfile"></li>
                            </div>
                            <input type="hidden" value="" id="resumeTmpNm">
                            <input type="hidden" value="" id="uploadresumeName">
                              <!--<span class="tip left" id="upfileResult">提示：请上传单个文件不超过5M的文档、图片、压缩包。</span>-->
                          </div>
                        </div>
                          <div id="works3" class="expect_con">
                            <div class="default_work"><span onclick="document.getElementById('f_product').click()">大咖们，把伟大的作品晒出来，HR们不懂也会装懂的啦…你懂的！</span></div>
                          </div>
                      </div>
          </div>
                      <!-- 自我描述 -->
                    <div id="dragDiv6" name="dragDiv" v="6" class="dragDiv">
                      <div class="monitor monitor_job">
                        <div class="monitor_pos monitor_pos7"><div class="seap" style="height: 80px;"></div></div>
                     </div>
                     <div class="gzjl1CON">
                          <div id="titleBar6" class="expect_title">自我描述</div>
                          <div style="display:none;" id="self_description1" class="expect_con">
                            <div id="self_des" class="self_description"></div>
                            <div class="footer_edit "><span class="span_del"></span><span class="span_edit"></span>
                            </div>
                          </div>
                          <div style="display:none;" id="self_description2" class="expect_con">
                            <div class="con_textarea">
                              <div class="edit_list">
                                <textarea placeholder="请你描述职业规划、外语技能、兴趣爱好、特长等，有助于公司全面了解你哦~" id="my_description"></textarea>
                                <p class="yu"><font>您还可以输入500字</font></p>
                              </div>
                            </div>
                            <div style="padding-top:0px;" class="btns">
                              <a class="zwms_save save" href="javascript:void(0);">保存</a>
                              <a class="zwms_cancel cancel" href="javascript:void(0);">取消</a>
                            </div>
                          </div>
                          <div id="self_description3" class="expect_con">
                            <div class="default"><span>亲们，HR要是看到一篇真诚的或是幽默的自我描述，TA绝笔会泪牛满面的看上你…</span></div>
                          </div>
                        </div>
                    </div>
                    <!--我的标签-->
                    <div id="dragDiv8" class="dragDiv">
                      <div class="monitor monitor_job">
                        <div class="monitor_pos monitor_pos8"><div class="seap" style="height: 100px;"></div></div>
                    </div>
                    <div class="my_labels tables_mine">
                  <p>我的标签</p>
                   <div class="labelBox">
                       <div class="labels">
                       </div>
                          <div class="labelAdd"><a href="javascript:void(0);">给自己加点标签，我就是我，骄傲的我!爱咋地咋地！</a></div>
                          <div style="display:none" class="edit_pen"></div>
                       
                  </div>
                  <div class="my_labels_edit">
                    <div id="label_box" class="label_box">
                    </div>
                        <div class="add_span"><input type="text" placeholder="输入你的标签，限七个字以内"><span>添加</span></div>
                    <div class="maybe_labels">
                      <p class="maybe_mate">您可能符合的标签：</p>
                      <div class="box_mb_labels">
                        <div class="c1">资深专业人士</div>
                        <div class="c2">电商经验</div>
                        <div class="c3">互联网医疗</div>
                        <div class="c4">技能大牛</div>
                        <div class="c5">科技控</div>
                        <div class="c6">奋斗</div>
                        <div class="c1">完美主义</div>
                        <div class="c2">设计达人</div>
                        <div class="c3">创意</div>
                        <div class="c4">踏实</div>
                        <div class="c5">看书</div>
                        <div class="c6">游泳</div>
                        <div class="c1">爱交友</div>
                        <div class="c2">吃货</div>
                        <div class="c3">幽默</div>
                        <div class="c4">靠谱</div>
                        <div class="c5">英语口语流利</div>
                        <div class="c6">学生会主席</div>
                        <div class="c1">丰富实践经验</div>
                        <div class="c2">985高校</div>
                        <div class="c3">四级</div>
                      </div>
                    </div>
                    <div class="btns">
                      <a style="margin-right:10px;" class="my_labels_save save" href="javascript:void(0);">保存</a>
                      <a class="my_labels_cancel cancel" href="javascript:void(0);">取消</a>
                    </div>
                  </div>          
                </div>
                    </div>
               </div>
          </div>
          


        <div class="tanchu_logo"><div class="tanchu_logo_li">
      <div class="standard_div_02 standard_line_height55">上传图片</div>
      <div class="close_btn"></div>
    </div>
    <div style="margin-top: 20px;">
      <div style="margin-left: 25px;" class="standard_margin_top10">
          <a onclick="document.getElementById('fileToUpload').click();" title="" href="javascript:void(0);" class="standard_a_01 standard_a_02">本地上传</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div style="margin-left: 35px;" class="bdsc_bri">支持JPG、GIF、PNG格式的图片，文件小于3M</div>
          <input type="file" accept="image/*" onchange="selectImage();" style="visibility:hidden;" size="10" name="fileToUpload" id="fileToUpload">
        </div>
        <span style="color:red" id="tixing"></span>    
    </div>
    <div class="jietuqu tstandard_float" style="margin-left: 25px;">
      <div class="images_left left">
        <img alt="" src="images/d_default.png" id="photo">
      </div>
      <div style="margin-right:25px;" class="images_right right">
        <img alt="" src="images/x_default.png?v=20150604">
      </div>
    </div>
    <div style="margin-bottom: 30px; overflow: hidden; " class="tstandard_float standard_margin_top10">
      <a style="margin-left:25px;" title="" onclick="getImage()" class="standard_a_01" href="javascript:void(0);">保存</a>
      <a title="" onclick="getImage1()" class="standard_a_01 standard_a_01_qx standard_margin_left15" href="javascript:void(0);">取消</a>
    </div>
    </div>
      <div class="add_new_label">
      <p><font>添加新标签</font><span class="tanclosebtn"></span></p>
      <div class="add_new_con">
        <div class="form_leftcon">
          <span class="sec label_mc">标签名称</span>
          <input type="text" placeholder="" value="" class="wbd">
        </div>
        <div class="form_leftcon">
          <span class="sec label_mc">标签类别</span>
          <div style="width:212px;" class="seles">
            <span class="seles_choose seles_bqlb">请选择</span>
            <ul style="width:212px; border:1px solid #319897; border-top:none;" id="p_node" class="seles_hide">
               <li><span>前端</span></li>
               <li><span>UI设计</span></li>
               <li><span>后台</span></li>
               <li><span>框架</span></li>
               <li><span>移动开发</span></li>
               <li><span>数据库</span></li>
               <li><span>服务器</span></li>
            </ul>
            <input type="hidden" class="input_hide" id="workyears" value="">
          </div>
        </div>
        <div class="que_xiao">
          <a class="sure" title="" href="javascript:void(0);">确认</a>
          <a class="no" title="" href="javascript:void(0);">取消</a>
        </div>
      </div>
    </div>
    <div style="display:none;" class="resumejl_pos">
              <iframe frameborder="0" src="" class="fujian_yulan"></iframe>
            <div class="bi_btn">
              <a class="close_fujian" href="javascript:void(0);">关闭</a>
            </div>
          </div>


    </div>
    <div class="online_right right">
            <div class="wodebiaoqian">
                <div class="tdfk1">
                  <a class="a1" href="/mr/">投递反馈</a>
                  <a class="a2" href="javascript:void(0);">求推荐</a>
                  <!--<a href="javascript:void(0);" class="a3" onclick="document.getElementById('f_jianli').click()" class="upload_jianli">上传简历</a>-->
                  <div class="yishangchuan_pos">
                    <a class="upload_a upload_jianli a3" href="javascript:void(0);">上传简历</a>
                    <!--鼠标滑过预览和删除-->
                    <div class="yishangchuan_hover" style="display: none;">
                      <span></span>
                    <div><a href="javascript:yulan();">预览</a><a href="javascript:deleteresume();">删除</a><a onclick="document.getElementById('f_jianli').click()" href="javascript:void(0);">上传</a>
                    </div>
                    </div>
                  </div>              
                </div>
                <div class="default_send">
                  <div>默认投递：</div>
                  <div class="seles ">
                            <span class="seles_choose ">请选择</span>
                            <ul class="seles_hide moren default_jianli">
                              <li v="0">在线简历</li> 
                              <li v="1">附件简历</li>
                            </ul>       
                          </div>
                </div>
                <div class="my_labels my_labelsie">
                  <div class="compete_percent"><span style="" class="myhidden">在线简历完整度</span><a class="xz_a" href="/ro/downloadR/335729/profile/黄金/pdf" target="_blank">下载</a><a target="_blank" href="/ro/selfyulan">预览</a></div>
                  <div style="" data-perc="20" class="progressbar myhidden">
                    <div class="bar" style="width: 41px;"><span></span></div>
                    <div class="label"><div class="perc">20%</div></div>
                  </div>
                </div>
                <div style="display: none;" class="my_labels">
                    <p>附件简历</p>
                    <div class="scfujianresume">
                      <div class="upload_before">                   
                          <input type="file" onchange="javascript:uploadjianli(1);" class="upfile" id="f_jianli" name="f_jianli">
                          <input type="hidden" value="" class="resume_name">
                          <a class="jianli" href="javascript:void(0);"></a>
                          <a class="upload_jianli" onclick="document.getElementById('f_jianli').click()" href="javascript:void(0);">上传简历</a>
                          <a class="upload_jianli upload_jianliie" href="javascript:void(0);">上传简历</a>
                          
                             <i style="display:none" class="delete_fujian"></i>
                      </div>
                  </div>        
              </div>
          </div>
              <!--<a target="_blank" href="/ycd" class="user_h5"><img src="images/User_h5.jpg" ></a>-->
          </div>
    </div>  
    <script>
          //判断工作经历
            
            //判断项目经验
        
        //判断教育背景
        
          //判断期望领域
               $(".qiwang_position #12").toggleClass('addcss');
               $(".qiwang_position #13").toggleClass('addcss');
               $(".qiwang_position #4").toggleClass('addcss');
            
            
               //简历完成度
               $('.progressbar').attr('data-perc',20);
           // progressbar();
      
            //性别
             $(".gender").addClass("boy");
            
                    
            //判断期望工作
                $('#expect_con3').hide();
                $('#expect_con1').show();

        myfun();
        
        //     页面加载完后执行
      //window.onload=myfun;
      function myfun(){
        //  期望工作长度
        var seap_h1 = $('#dragDiv1').height()-58;
        $('.monitor_pos1 .seap').css({'height':seap_h1});
        //  教育背景长度
        var seap_h2 = $('#dragDiv4').height()-58;
        $('.monitor_pos2 .seap').css({'height':seap_h2});
        //  工作经历长度
        var seap_h3 = $('#dragDiv2').height()-58;
        $('.monitor_pos3 .seap').css({'height':seap_h3});
        //  项目经验长度
        var seap_h4 = $('#dragDiv3').height()-58;
        $('.monitor_pos4 .seap').css({'height':seap_h4});
        //  专业技能长度
        var seap_h5 = $('#dragDiv5').height()-58;
        $('.monitor_pos5 .seap').css({'height':seap_h5}); 
        //  作品展示长度
        var seap_h6 = $('#dragDiv7').height()-58;
        $('.monitor_pos6 .seap').css({'height':seap_h6});   
        //  自我描述长度
        var seap_h7 = $('#dragDiv6').height()-58;
        $('.monitor_pos7 .seap').css({'height':seap_h7});   
        //  我的标签长度
        var seap_h8 = $('#dragDiv8').height()-58;
        $('.monitor_pos8 .seap').css({'height':seap_h8}); 

    //  var seap_h1 = $('.Resume_h1').height()-25;
    //  $('.monitor_pos .seap').css({'height':seap_h1});

      }
    </script>
    <!-- ie上传附件简历 -->
    <div class="sucess_yes fujian_ie">
        <div class="sucess_title">
            <span>上传附件简历</span>
            <i></i>
        </div>
        <div class="ie_con">
            <div style=" margin-top: 40px; margin-bottom: 20px; overflow:hidden;"><span class="ie_success"></span>
          <input type="file" onchange="javascript:uploadjianli(0);" id="ie_jianli" name="f_jianli"></div>
          <p>支持word、excel等格式文件</p>
          <p>文件大小需小于3M</p>
          <div class="zhu">注：若从其他网站下载的word简历，请将文件另存为.docx格式后上传</div>
        </div>
        <div class="sucess_then"><a href="javascript:uploadsuccess();">确定</a></div>
    </div>
    @endsection

    @section('custom-script')
      
    @endsection
@endif
@if($data["type"] == 2)
    @section('title', '企业中心')
    @section('custom-style')
           <link media="all" href="{{asset('../style/myhome.css')}}" type="text/css" rel="stylesheet">
           
            <style>
            .containter{    
                width: 1200px;
                margin: 0 auto;
                padding-bottom: 15px;
                margin-top: 36px;
            }
            </style>
    @endsection
    @section('content')
        <div class="containter">
            <div class="top_info">
                    <div class="top_info_wrap top_info_content">
                        <img src="../images/1.gif" alt="公司Logo" width="164" heihgt="164">
                        <div class="company_info">
                            <div class="company_main">
                                <a href="javascript:;" class="edit edit_text" style="margin: 0px 67px 0px 0px;">
                                    <i></i>编辑
                                </a>
                                <h1>
                                    <a href="myhome.html" class="hovertips" target="_blank" rel="nofollow">
                                        店小二餐饮连锁公司
                                    </a>
                                </h1>
                                <a href="myhome.html" class="icon-wrap" target="_blank" rel="nofollow" >
                                    <i></i>
                                </a>
                                <div class="company_word">
                                        
                                </div>
                            </div>
                            <div class="company_data">
                                <ul>
                                    <li>
                                        <strong>暂无</strong>
                                        <br>
                                        <span class="tipsys" original-title="该公司的在招职位数量">
                                            <span>招聘职位</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <strong>暂无</strong>
                                        <span class="tipsys" original-title="该公司7日内处理简历数占收取简历数比例">
                                            <span>简历及时处理率</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <strong>暂无</strong>
                                        <br>
                                        <span class="tipsys" original-title="该公司7日内从简历收取到最终处理的平均用时">
                                            <span>简历处理用时</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li id="mspj" style="cursor:pointer;">
                                        <strong> 暂无</strong>
                                        <br>
                                        <span class="tipsys" original-title="该公司收到的面试评价数量">
                                            <span>面试评价</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <strong>今天</strong><br>
                                        <span class="tipsys" original-title="该公司职位管理者最近一次登录时间">
                                            <span>企业最近登录</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="top_info_wrap_edit dn top_info_edit" style="display: none;">
                        <form id="topInfoForm" action="javascript:;" method="post" novalidate="novalidate">
                            <div class="company_logo_edit">
                                <img src="../images/1.gif">
                                <div class="upload_shadow"></div>
                                <div class="upload_text">
                                    <i></i>
                                    <span>
                                        上传LOGO请小于10M
                                        <br>
                                        尺寸：170px*170px
                                    </span>
                                </div>
                                <label>
                                    <input type="file" id="logoUpload" name="filePic">
                                </label>
                            </div>

                            <div class="company_info_edit">
                                <a href="javascript:;" class="cancel_edit cancel_info_edit">
                                    <i></i>
                                    取消编辑
                                </a>
                                <h1> 店小二餐饮连锁公司</h1>
                            
                            
                                <label>
                                    <span class="redstar">*</span>
                                    <input type="text" class="companyUrl" name="companyUrl" value="" placeholder="请输入公司网站" autocomplete="off">
                                </label>
                            
                                <input type="hidden" class="companyName" name="companyName" value="店小二">
                                <div class="longname"><span>店小二</span><span class="tips">（修改公司全称或简称，请发送邮件至gogo@lagou.com）</span>
                                    <a class="tips_link" href="#" target="_blank">
                                        <i class="icon-glyph-question"></i> 
                                        如何发送</a>
                                </div>
                            
                                <label class="edit_wrap">
                                    <span class="redstar">*</span>
                                    <input type="text" class="edit_area long companyIntroduce " name="companyIntroduce" value="" placeholder="一句话概括公司亮点，如：公司愿景、领导团队等" autocomplete="off">
                                    <span class="red numtip">(0/50)</span>
                                </label>
                            
                                <input type="submit" value="保存" class="save">
                                <a href="javascript:;" class="cancel cancel_top_btn">取消</a>
                                <div class="clearfix"><span class="error topinfo_all" style="display:none;"></span></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="company_navs" class="company_navs">
                    <div class="company_navs_wrap">
                        <ul data-pjax="">
                            <li class="li_one current">
                                <a href="javascript:;" class="company_index">公司主页</a>
                            </li>
                            <li class="li_two">
                                <a href="javascript:;" class="recruit_job">招聘职位（0）</a>
                            </li>
                            <li class="li_three">
                                <a href="javascript:;" class="company_ask">公司问答</a>
                                <i class="icon_new"></i>
                            </li>
                        </ul>
                        <div class="company_share">
                            <span>分享</span>
                            <a href="javascript:;" class="share_weibo" rel="nofollow" title="分享到微博" ></a>
                            <a href="javascript:;" class="share_weixin" rel="nofollow" title="分享到微信" ></a>
                            <a href="javascript:;" class="share_rountline" rel="nofollow" title="微信扫一扫，用小程序打开分享" ></a>
                            <div class="share_weixin_success" id="companyQrcode">
                                <!-- <img alt="移动端公司主页二维码" /> -->
                                <div class="qrcode_box">
                                <canvas width="120" height="120"></canvas></div>
                            </div>
                
                             <div class="share_rountline_success" id="companyRountLineQrcode">
                                <!-- <img alt="移动端公司主页二维码" /> -->
                                <div class="rountline_qrcode_box">
                                    <img src="" width="130" height="130">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="company_navs_shadow"></div>
                <div id="main_container">
                    <div id="container_left">
                        <div id="containerCompanyDetails" class="companyIndex" style="display: block;">
                            <div class="item_container" id="company_products">
                                <div class="item_ltitle">公司产品</div>
                            
                                <span class="item_ropera item_add disabled add_btn_wrap" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_one">新增</span>
                                </span>
                                
                                <div class="item_content item_content_one"  style="display: block;">
                                    <div class="item_empty">
                                        <p class="item_empty_desc">
                                            简洁有趣的产品介绍，能让用户最快速度了解公司业务。把自家优秀的产品展示出来吸引人才围观吧！
                                        </p>
                                        <p class="item_empty_add item_add disabled">
                                            <em class="item_ropeiconp"></em>
                                            <span class="item_ropetext add_product">添加公司产品</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="item_content item_content_one_edit" style="display: none;">
                                    <div class="item_content_edit_wrap product_item">
                                    <div class="product_edit_tip">
                                        简洁有趣的产品介绍，能让应聘者以最快的速度了解公司业务。
                                    </div>
                                    <span class="item_ropera1 item_ropera_cancel item_cancel_add" style="display: none;">
                                        <em class="item_ropeiconp item_ropeicons"></em>
                                        <span class="item_ropetext cancel_add_one">取消新增</span>
                                    </span>
                                    <div class="item_content_edit">
                                        <form id="productForm" data-id="" action="javascript:;" method="post" novalidate="novalidate">
                                            <div class="upload_product_img">
                                                
                                                    <img src="../images/product_default_1021398.png" alt="产品图片">
                                                
                                                <div class="shadow"></div>
                                                <div class="text">
                                                    <i></i><span>更换产品图片 小于10MB<br>尺寸：300px*180px</span>
                                                </div>
                                                <label>
                                                    <input type="file" id="productUpload" name="filePic">
                                                </label>
                                        </div>
                                            <div class="product_form">
                                                <label>
                                                    <span class="redstar">*</span>
                                                    <input type="text" name="productName" class="productName" value="" autocomplete="off" placeholder="请输入产品名称">
                                                </label>
                                                <label>
                                                    <span class="redstar">*</span>
                                                    <ul class="checktypes">
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="网站" style="display: none;"><span class="no_select lgCheckBox"><em></em>网站</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="客户端" style="display: none;"><span class="no_select lgCheckBox"><em></em>客户端</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="移动app" style="display: none;"><span class="no_select lgCheckBox"><em></em>移动app</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="硬件" style="display: none;"><span class="no_select lgCheckBox"><em></em>硬件</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="其他" style="display: none;"><span class="no_select lgCheckBox"><em></em>其他</span>
                                                            </li>
                                                        
                                                    </ul>
                                                    <span id="productType-error" class="error" style="display: none;">请选择产品类型</span>
                                                </label>
                                                <label>
                                                    <input type="text" name="productUrl" class="productUrl" value="" autocomplete="off" placeholder="请输入产品主页或产品下载地址">
                                                </label>
                                                <label>
                                                    <div class="edui-container" style="width: 345px; z-index: 999;">
                                                    </div>
                                                    <span class="wordcount">还可输入<b>200</b>字</span>
                                                </label>
                                                <span class="error products_all" style="display:none;"></span>
                                                <input type="submit" value="保存" class="save">
                                                <a href="javascript:;" class="cancel cancel_btn_one">取消</a>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                            <div class="item_container" id="company_intro">
                                <div class="item_ltitle">公司介绍</div>
                                <div class="video_dialog" style="display: none;"> 
                                        <video id="my_video" controls="" x5-video-player-type="h5" x5-video-player-fullscreen="true" x5-video-orientation="portraint" playsinline="" preload="auto" x-webkit-airplay="true" webkit-playsinline="true" style="object-fit:fill" src="" poster="">
                                                                
                                        </video>
                                </div> 
                                <span class="item_ropera disabled" style="display:none;">
                                    <em class="item_ropeiconp item_ropeicone"></em>
                                    <span class="item_ropetext">编辑</span>
                                </span>
                                <span class="item_ropera item_add disabled">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_two" >新增</span>
                                </span>
                                
                                <div class="item_content item_content_two" style="display: block;">
                                    <div class="company_intro_text" style="display: block;">该公司尚未添加公司介绍<br></div>
                                    <div class="company_image_gallery">
                                                    <div class="item_empty">
                                            <p class="item_empty_desc">
                                                添加公司环境、员工照片，给用户展示更生动的公司全貌。
                                            </p>
                                            <p class="item_empty_add disabled">
                                                <em class="item_ropeiconp"></em>
                                                <span class="item_ropetext add_image">添加公司照片</span>
                                            </p>
                                        </div>
                                                </div>
                                </div>
                            
                                <div class="item_content_edit_wrap item_content_add_wrap" style="display: none;">
                                    <div class="company_edit_tip">
                                         对公司详尽又生动的图文介绍，是吸引应聘者的最佳利器。
                                    </div>
                                    <span class="item_ropera1 item_ropera_cancel item_ropera1_content" style="display: none;">

                                        <em class="item_ropeiconp item_ropeicons"></em>
                                        <span class="item_ropetext cancel_add_two">取消新增</span>
                                    </span>
                                    <div class="item_content_edit item_content_edit_two" style="display: none;">
                                        <form id="introForm" action="javascript:;" method="post" novalidate="novalidate">
                                            <label>
                                                <div class="edui-container" style="width: 676px; z-index: 999;"></div>
                                                <span class="wordcount">还可输入<b>1000</b>字</span>
                                            </label>
                                            <div class="company_images_count">最多可上传10张照片，已上传 <span>(<i>0</i>/10)</span></div>
                                            <ul class="company_images_wrap">
                                                <li data-id="" data-position="0">
                                                    <em>封面</em>
                                                    <img src="../images/0079FDcTtGCpom0U.jpg" width="330" height="234" style="width: 160px; height: 160px;">
                                                    <div class="img_opt">
                                                        <span class="set_default disabled">设置为封面</span> | 
                                                        <span class="img_del cmp_delete" style="position: relative;">
                                                            删除
                                                            <div class="mr_delete_pop" style="display: none; position: absolute;">
                                                                <p>确定删除这张图片？</p>
                                                                <div class="del_content">
                                                                    <span class="mr_del_ok">删除</span>
                                                                    <span class="mr_del_cancel mr_del">取消</span>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>

                                                </li>
                                    
                                                <li data-upload="1" class="uploadimg  img_upload">
                                                    <div class="upload_company_img">
                                                        <i></i>
                                                        <span>
                                                            上传公司图片请小于10M
                                                            <br>
                                                            尺寸：480px*340px
                                                        </span>
                                                        <label class="upload-file-wrap">
                                                            <input type="file" id="uploadIntroImg" name="filePic" >
                                                        </label>
                                                    </div>
                                                </li>
                                    
                                            </ul>
                                            <span class="error cmpintro_all" style="display:none;"></span>
                                            <input type="submit" value="保存" class="save">
                                            <a href="javascript:;" class="cancel cancel_btn_two">取消</a>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="item_container" id="history_container">
                                <div class="item_ltitle">发展历程</div>
                            
                                <span class="item_ropera item_add disabled item_add_wrap_three" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_three">新增</span>
                                </span>
                                
                                <!-- 编辑区域 -->
                                <div class="item_content_edit_wrap item_content_edit_three" style="display: none;">
                                    <span class="item_ropera1 item_ropera_cancel">
                                        <em class="item_ropeiconp item_ropeicons"></em>
                                        <span class="item_ropetext cancel_add_three">取消新增</span>
                                    </span>
                                    <div class="his_tip">向应聘者展示公司和产品不断壮大过程中的里程碑事件。</div>
                                    <form class="item_content_edit common_form history_form" action="javascript:;" method="post" novalidate="novalidate">
                                        <div class="form_item form_date_type">
                                            <!-- 日期 -->
                                            <label class="form_date_con">
                                                <span class="redstar">*</span>
                                                <input type="text" class="form_vinput form_date hasDatepicker" name="date" placeholder="选择事件发生日期" autocomplete="off" value="" readonly="" id="dp1516780341343">
                                            </label>
                                            <!-- 事件类型 -->
                                            <label class="rlabel">
                                                <span class="redstar">*</span>
                                                <div class="simulate_select select_eventtype">
                                                    <input type="hidden" class="eventtype" id="eventtype" name="eventtype" value="">
                                                    <span class="eventtip eventTipOne">
                                                        
                                                            选择事件类型
                                                        
                                                    </span>
                                                    <i class="idropdown"></i>
                                                    <ul class="eventUlOne" style="display: none;">
                                                        
                                                        <li>产品</li>
                                                        
                                                        <li>资本</li>
                                                        
                                                        <li>数据</li>
                                                        
                                                        <li>人员</li>
                                                        
                                                        <li>其他</li>
                                                        
                                                    </ul>
                                                </div>
                                            </label>
                                        </div>
                                        <!-- 事件 -->
                                        <div class="form_item">
                                            
                                                <label class="fs" style="display:none;">
                                                    <span class="redstar">*</span>
                                                    <div class="simulate_select">
                                                        <input type="hidden" class="financeStage" name="financeStage" value="">
                                                        <span class="eventtip">
                                                            
                                                                请选择融资阶段
                                                            
                                                        </span>
                                                        <i></i>
                                                        <ul style="display: none;">
                                                            
                                                            <li>天使轮</li>
                                                            
                                                            <li>A轮</li>
                                                            
                                                            <li>B轮</li>
                                                            
                                                            <li>C轮</li>
                                                            
                                                            <li>D轮及以上</li>
                                                            
                                                            <li>上市公司</li>
                                                            
                                                        </ul>
                                                    </div>
                                                </label>
                                                <label class="en">
                                                    <span class="redstar">*</span><input type="text" class="form_fullinput" name="eventname" placeholder="请输入该事件名称" value="" autocomplete="off">
                                                </label>
                                            
                                        </div>
                                        <!-- 链接 -->
                                        <label>
                                            <input type="text" class="form_fullinput form_link" name="link" id="eventurl" placeholder="请输入报道链接" value="" autocomplete="off">
                                        </label>
                                        <!-- 投资机构 -->
                                        
                                        <label class="tohide ">
                                            <input type="text" class="form_fullinput form_org" name="organization" placeholder="请输入投资机构，多个投资机构以顿号隔开" value="">
                                        </label>
                                    
                                        <label class="tohide ">
                                            <input type="text" class="form_fullinput form_amount" name="amount" placeholder="请输入融资金额" value="" autocomplete="off">
                                        </label>
                                    
                                        <label class="his_des tohide item_show">
                                            <div class="edui-container" style="width: 676px; z-index: 999;"><div class="edui-toolbar"><div class="edui-btn-toolbar" unselectable="on" onmousedown="return false"><div class="edui-btn edui-btn-fullscreen" unselectable="on" onmousedown="return false" data-original-title="全屏"> <div unselectable="on" class="edui-icon-fullscreen edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-source" unselectable="on" onmousedown="return false" data-original-title="源代码"> <div unselectable="on" class="edui-icon-source edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-undo  edui-disabled" unselectable="on" onmousedown="return false" data-original-title="撤销"> <div unselectable="on" class="edui-icon-undo edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-redo  edui-disabled" unselectable="on" onmousedown="return false" data-original-title="重做"> <div unselectable="on" class="edui-icon-redo edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-bold" unselectable="on" onmousedown="return false" data-original-title="加粗"> <div unselectable="on" class="edui-icon-bold edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-italic" unselectable="on" onmousedown="return false" data-original-title="斜体"> <div unselectable="on" class="edui-icon-italic edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-underline" unselectable="on" onmousedown="return false" data-original-title="下划线"> <div unselectable="on" class="edui-icon-underline edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-strikethrough" unselectable="on" onmousedown="return false" data-original-title="删除线"> <div unselectable="on" class="edui-icon-strikethrough edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-superscript" unselectable="on" onmousedown="return false" data-original-title="上标"> <div unselectable="on" class="edui-icon-superscript edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-subscript" unselectable="on" onmousedown="return false" data-original-title="下标"> <div unselectable="on" class="edui-icon-subscript edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-splitbutton edui-splitbutton-forecolor" unselectable="on" data-original-title="字体颜色"><div class="edui-btn" unselectable="on"><div unselectable="on" class="edui-icon-forecolor edui-icon"></div><div class="edui-splitbutton-color-label"></div></div><div unselectable="on" class="edui-btn edui-dropdown-toggle"><div unselectable="on" class="edui-caret"></div></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-splitbutton edui-splitbutton-backcolor" unselectable="on" data-original-title="背景色"><div class="edui-btn" unselectable="on"><div unselectable="on" class="edui-icon-backcolor edui-icon"></div><div class="edui-splitbutton-color-label"></div></div><div unselectable="on" class="edui-btn edui-dropdown-toggle"><div unselectable="on" class="edui-caret"></div></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-removeformat" unselectable="on" onmousedown="return false" data-original-title="清除格式"> <div unselectable="on" class="edui-icon-removeformat edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-insertorderedlist" unselectable="on" onmousedown="return false" data-original-title="有序列表"> <div unselectable="on" class="edui-icon-insertorderedlist edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-insertunorderedlist" unselectable="on" onmousedown="return false" data-original-title="无序列表"> <div unselectable="on" class="edui-icon-insertunorderedlist edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-selectall" unselectable="on" onmousedown="return false" data-original-title="全选"> <div unselectable="on" class="edui-icon-selectall edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-cleardoc" unselectable="on" onmousedown="return false" data-original-title="清空文档"> <div unselectable="on" class="edui-icon-cleardoc edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn- edui-btn-name-paragraph edui-combobox" unselectable="on" onmousedown="return false" data-original-title="段落格式"> <span unselectable="on" onmousedown="return false" class="edui-button-label">段落格式</span><span class="edui-button-spacing"></span><span unselectable="on" onmousedown="return false" class="edui-caret"></span><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn- edui-btn-name-fontfamily edui-combobox" unselectable="on" onmousedown="return false" data-original-title="字体"> <span unselectable="on" onmousedown="return false" class="edui-button-label">arial</span><span class="edui-button-spacing"></span><span unselectable="on" onmousedown="return false" class="edui-caret"></span><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn- edui-btn-name-fontsize edui-combobox" unselectable="on" onmousedown="return false" data-original-title="字号"> <span unselectable="on" onmousedown="return false" class="edui-button-label">字号</span><span class="edui-button-spacing"></span><span unselectable="on" onmousedown="return false" class="edui-caret"></span><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-justifyleft edui-active" unselectable="on" onmousedown="return false" data-original-title="居左对齐"> <div unselectable="on" class="edui-icon-justifyleft edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-justifycenter" unselectable="on" onmousedown="return false" data-original-title="居中对齐"> <div unselectable="on" class="edui-icon-justifycenter edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-justifyright" unselectable="on" onmousedown="return false" data-original-title="居右对齐"> <div unselectable="on" class="edui-icon-justifyright edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-link" unselectable="on" onmousedown="return false" data-original-title="超链接"> <div unselectable="on" class="edui-icon-link edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-unlink" unselectable="on" onmousedown="return false" data-original-title="取消链接"> <div unselectable="on" class="edui-icon-unlink edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-emotion" unselectable="on" onmousedown="return false" data-original-title="表情"> <div unselectable="on" class="edui-icon-emotion edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-image" unselectable="on" onmousedown="return false" data-original-title="图片"> <div unselectable="on" class="edui-icon-image edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-video" unselectable="on" onmousedown="return false" data-original-title="视频"> <div unselectable="on" class="edui-icon-video edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-map" unselectable="on" onmousedown="return false" data-original-title="百度地图"> <div unselectable="on" class="edui-icon-map edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-horizontal" unselectable="on" onmousedown="return false" data-original-title="分隔线"> <div unselectable="on" class="edui-icon-horizontal edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-print" unselectable="on" onmousedown="return false" data-original-title="打印"> <div unselectable="on" class="edui-icon-print edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-preview" unselectable="on" onmousedown="return false" data-original-title="预览"> <div unselectable="on" class="edui-icon-preview edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-drafts" unselectable="on" onmousedown="return false" data-original-title="草稿箱"> <div unselectable="on" class="edui-icon-drafts edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-formula" unselectable="on" onmousedown="return false" data-original-title="数学公式"> <div unselectable="on" class="edui-icon-formula edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false" style="z-index: 1000;"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div></div><div class="edui-dialog-container"></div></div><div class="edui-editor-body"><div class="form_fullinput form_des edui-body-container" contenteditable="true" style="width: 646px; min-height: 130px; z-index: 999;"><p><span data-tag="zns6GSI672389sdnxzcxxz" style="font-size:14px;color:#a9a9a9;padding-left:5px;">请输入事件描述</span></p></div><textarea id="history_des" class="form_fullinput form_des valid" name="des" style="height: 150px; display: none;" value="" aria-invalid="false"></textarea></div></div>
                                            <span class="wordcount">还可输入<b>200</b>字</span>
                                        </label>
                                    
                                        <input type="hidden" name="id" value="">
                                        <span class="error history_all" style="display:none;"></span>
                                        <input type="submit" value="保存" class="save">
                                        <a href="javascript:;" class="cancel cancel_btn_three">取消</a>
                                        
                                    </form>
                                </div>
                            
                                <!-- 展示区域 -->
                                <div class="item_content item_content_three" style="display: block;">
                                        <!-- 空 -->
                                    <div class="item_empty item_add">
                                        <p class="item_empty_desc">
                                            向用户展示公司和产品不断壮大、优秀的过程中的里程碑事件。
                                        </p>
                                        <p class="item_empty_add disabled">
                                            <em class="item_ropeiconp"></em>
                                            <span class="item_ropetext add_process">添加发展历程</span>
                                        </p>
                                    </div>
                                    </div>
                            </div>

                            <input type="hidden" value="316493" class="companyId">
                            <input type="hidden" value="0" class="totalCount">
                            <input type="hidden" value="true" class="isHide">
                            <input type="hidden" value="false" class="isOpen">
                            <input type="hidden" value="1" class="isupdateState">

                            <div class="interview_container item_container" id="interview_container">
                                <div id="interview_anchor"></div>
                                <div class="item_ltitle">面试评价</div>
                                <div class="reviews-empty">
                                    <span class="empty_icon"></span>
                                    <span class="empty_text">该公司近2个月内未收到过面试评价</span>
                                </div>
                            </div>

                            <div class="address_container item_container" id="location_container">
                                <div class="item_ltitle">公司位置</div>
                            
                                
                                <span class="item_ropera   addr_add" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext">新增</span>
                                </span>
                                <span class="item_ropera1 dn addr_edit_cancel" style="display: none;">
                                    <em class="item_ropeiconp item_ropeicons"></em>
                                    <span class="item_ropetext">取消编辑</span>
                                </span>
                                <span class="item_ropera1 dn addr_add_cancel">
                                    <em class="item_ropeiconp item_ropeicons"></em>
                                    <span class="item_ropetext">取消新增</span>
                                </span>
                                
                                <div class="item_content">
                                    <div class="item_con_map amap-container" id="addr_map" style="position: relative; background: rgb(252, 249, 242);">
                                        <img src="../images/map.png"/>
                                    </div>
                                    <div class="item_con_mlist mCustomScrollbar _mCS_1">
                                        <div class="mCustomScrollBox mCS-dark-2" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                                            <div class="mCSB_container mCS_touch mCS_no_scrollbar" style="position:relative; top:0;">
                                                <ul class="con_mlist_ul">
                                                </ul>
                                                <div class="mlist_total_desc">
                                                    该公司共有 
                                                    <span class="mlist_total">0</span> 个地址
                                                </div>
                                            </div>
                                            <div class="mCSB_scrollTools" style="position: absolute; display: none;">
                                                <div class="mCSB_draggerContainer">
                                                    <div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;">
                                                        <div class="mCSB_dragger_bar" style="position:relative;"></div>
                                                    </div>
                                                    <div class="mCSB_draggerRail"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--招聘职位-->
                        <div id="containerCompanyDetails" class="recruitJob" style="display: none;">
                            <div class="posfilterlist_container item_container">
                                <div class="item_ltitle">
                                    近两月共有 <span class="list_total"> 0 </span> 个在招职位
                                </div>
                                <div class="item_content">
                                    <div class="item_con_filter">
                                        <span class="con_filter_type">职位：</span>
                                        <ul class="con_filter_ul">
                                                                                                                                                                                                                                                                                                                    </ul>
                                    </div>
                                    <div class="item_con_list_container">该公司近两个月暂无招聘的职位</div>
                                </div>
                            </div>
                        </div>
                        
                        <!--公司问答-->
                        <div id="containerCompanyDetails" class="companyAsk" style="display: none;">               
                            <div class="question-list-container" id="question_container" data-islogin="1">
                                <div class="empty-tips">
                                    <div class="tips-icon tips-draw"></div>
                                    <p class="text">还没有人对这家公司提问</p>
                                </div>
                                <div class="send_question">
                                    <p>提出对店小二餐饮连锁公司感兴趣的问题，邀请过来人帮你解答~</p>
                                    <input type="text" id="searchQuestion" value="" maxlength="50" placeholder="你的问题是什么">
                                    <input type="hidden" class="questionPrompt" value="你为什么选择加入店小二餐饮连锁公司？">
                                    <ul class="company_question_list"></ul>
                                    <a href="javascript:;" class="edit_introduce" >编辑问题补充</a>
                                    <a href="javascript:;" class="submit_question" >提问</a>
                                    <div class="edit_content">
                                        <textarea class="question_supplement" maxlength="500" placeholder="在此补充问题的其他信息，如：背景、相关资料等"></textarea>
                                            <ul class="answer_to">
                                                <li class="ask-to">向谁提问</li>
                                            </ul>
                                            <input type="hidden" value="1" class="default_man">
                                            <div class="submit_content">
                                                <a href="javascript:;"  class="improve_sub">发布问题</a>
                                                <span class="noncommit" >匿名提问</span>
                                                <input type="hidden" value="PC" class="mysource">
                                            </div>     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="container_right">

                        <div class="item_container" id="basic_container">
                            <div class="item_ltitle">公司基本信息</div>
                                <span class="item_ropera iedit disabled edit_text_one" style="display: block;">
                                    <em class="item_ropeiconp item_ropeicone"></em>
                                    <span class="item_ropetext edit_one">编辑</span>
                                </span>
                                <span class="item_ropera icanceledit dn disabled edit_text_edit_one" style="display: none;">
                                    <em class="item_ropeiconp item_ropeicons"></em>
                                    <span class="item_ropetext cancel_edit_one">取消编辑</span>
                                </span>
                                
                            <!-- 展示模式 -->
                            <div class="item_content item_right_one" style="display: block;">
                                <ul>
                                    <li>
                                        <i class="iconfont icon-qita1 icon-glyph-fourSquare"></i>
                                        <span>生活服务,其他</span>
                                    </li>
                                    <li>
                                        <i class="iconfont icon-zhexiantu icon-glyph-trend"></i>
                                        <span>未融资</span>
                                    </li>
                                    <li>
                                        <i class="iconfont icon-ren icon-glyph-figure"></i>
                                        <span>15-50人</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- 编辑模式 -->
                            <div class="item_content_edit_wrap dn item_right_edit_one" style="display: none;">
                                <ul>
                                    <li>
                                        <i class="type"></i>
                                        <span>生活服务,其他</span>
                                    </li>
                                </ul>
                                <div class="item_content_edit">
                                    <form id="basicInfoForm" action="javascript:;" method="post" novalidate="novalidate"><label>
                                        <span class="redstar">*</span>
                                        <div class="simulate_select">
                                            <input type="hidden" class="companyfinancing" name="companyfinancing" value="未融资">
                                            <span class="info_one_dropdown info_invest">未融资</span>
                                            <i class="info_one_dropdown"></i>
                                            <ul class="info_ul_invest" style="display: none;">
                                                
                                                <li>未融资</li>
                                                
                                                <li>天使轮</li>
                                                
                                                <li>A轮</li>
                                                
                                                <li>B轮</li>
                                                
                                                <li>C轮</li>
                                                
                                                <li>D轮及以上</li>
                                                
                                                <li>上市公司</li>
                                                
                                                <li>不需要融资</li>
                                                
                                            </ul>
                                        </div>
                                    </label>
                                    
                                    <label>
                                        <span class="redstar">*</span>
                                        <div class="simulate_select">
                                            <input type="hidden" class="companyscale" name="companyscale" value="15-50人">
                                            <span class="people_one_dropdown info_people">15-50人</span>
                                            <i class="people_one_dropdown "></i>
                                            <ul class="info_ul_people" style="display: none;">
                                                
                                                <li>少于15人</li>
                                                
                                                <li>15-50人</li>
                                                
                                                <li>50-150人</li>
                                                
                                                <li>150-500人</li>
                                                
                                                <li>500-2000人</li>
                                                
                                                <li>2000人以上</li>
                                                
                                            </ul>
                                        </div>
                                    </label>
                                    
                                    <span class="error base_all" style="display:none;"></span>
                                    <input type="submit" value="保存" class="save">
                                    <a href="javascript:;" class="cancel cancel_right_btn_one">取消</a>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="company_managers item_container">
                            <div class="item_ltitle">管理团队</div>
                            <span class="item_ropera manager_new disabled item_right_text_wrap_one" style="display: block;">
                                <em class="item_ropeiconp"></em>
                                <span class="item_ropetext add_right_one">新增</span>
                            </span>
                            <span class="item_ropera item_ropera_cancel item_right_text_edit_one" style="display: none;">
                                <em class="item_ropeiconp item_ropeicons"></em>
                                <span class="item_ropetext cancel_right_add_one">取消新增</span>
                            </span>
                            <div class="company_mangers_item company_manger_wrap" style="display: block;">
                        
                                <div class="item_empty">
                                    <p class="item_empty_desc">
                                        展示公司领导团队，大人物的人格魅力直线提升公司诱人指数！
                                    </p>
                                    <p class="item_empty_add disabled">
                                        <em class="item_ropeiconp"></em>
                                        <span class="item_ropetext add_mangers">添加管理团队</span>
                                    </p>
                                </div>
                            </div>
                            <form id="leaderForm" class="fom_right_one" action="javascript:;" method="post" novalidate="novalidate" style="display: none;">
                                <div class="item_manager_edit item_content">
                                    <div class="item_manger_photo">
                                        
                                            <img src="../images/leader_default_c3e060f.png" width="120" height="120">
                                        
                                        <div class="shadow"></div>
                                        <div class="text">更换头像<br>120px*120px<br>小于10M</div>
                                        <label class="upload-file-wrap">
                                            <input type="file" id="leaderUpload" name="filePic">
                                        </label>
                                    </div>
                                    <div class="form_item">
                                        <span class="redstar">*</span>
                                        <input type="text" class="input_item manager_name" name="name" placeholder="请输入该人物姓名" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <span class="redstar">*</span>
                                        <input type="text" class="input_item manager_name" name="position" placeholder="请输入该人物当前职位" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <input type="text" class="input_item manager_name" name="weibo" placeholder="请输入该人物新浪微博地址" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <input type="text" class="input_item manager_name" name="cyclopediaUrl" placeholder="请输入该人物百度百科地址" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <div class="manager_content_wrap">
                                            <div class="edui-container" style="width: 210px; z-index: 999;"></div>
                                            <span class="wordcount">还可输入<b>500</b>字</span>
                                        </div>
                                    </div>
                                    <div class="item_button">
                                        <span class="error managers_all" style="display:none;"></span>
                                        <input type="submit" class="save" value="保存">
                                        <a href="javascript:;" class="cancel cancel_right_btn_two">取消</a>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tags_container item_container">
                            <div class="item_ltitle">公司标签</div>
                                <span class="item_ropera disabled item_right_text_wrap_two" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_right_two">新增</span>
                                </span>
                                <span class="item_ropera tags_edit_now item_right_text_edit_two" style="display: none;">
                                    <em class="item_ropeiconp item_ropeicone"></em>
                                    <span class="item_ropetext cancel_right_add_two">取消新增</span>
                                </span>
                                <div class="tags_warp tags_wrap_one" style="display: block;">
                                    <div class="item_empty">
                                        <p class="item_empty_add disabled">
                                            <em class="item_ropeiconp"></em>
                                            <span class="item_ropetext add_tags">添加公司标签</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="tags_warp tags_warp_block tags_wrap_edit_one" style="display: none;">
                                    <div class="tags_edit">
                                        <p class="title">
                                            <span class="title_content">已选择标签</span>
                                            <span class="tags_num">
                                                (<span class="num_has">0</span>/9)
                                            </span>
                                        </p>
                                        <div class="tags_has_wrapper">
                                            <ul class="tags_has">
                                                <li class="list"><em class="item_tags_del"></em></li>
                                            </ul>
                                            <span class="error"></span>
                                        </div>
                                        <p class="chooseTitle">
                                            <span class="title_content">可选择标签</span>
                                        </p>
                                        <input type="text" class="tag_name" id="tags_input_selected" placeholder="添加自定义标签">
                                        <a href="javascript:;" class="tag_add_btn">贴上</a>
                                        <span class="error input-error"></span>
                                        <ul class="choose item_con_ul clearfix" id="item_con_tags_ul">
                                                
                                                    <li class="con_ul_li">
                                                        年底双薪
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        专项奖金
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        股票期权
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        绩效奖金
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        年终分红
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        带薪年假
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        交通补助
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        通讯津贴
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        午餐补助
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        定期体检
                                                    </li>
                                                
                                            <!--<span class="tag_choose_next">下一页</span>-->
                                        </ul>
                                        <div class="item_button">
                                            <input class="save" type="button" value="保存">
                                            <a href="javascript:;" class="cancel cancel_right_btn_three">取消</a>
                                        </div>
                                        <a href="javascript:;" class="cancel"></a>
                                    </div>
                                    <a href="javascript:;" class="cancel"></a>
                                </div>
                            </div>


                            <div class="navigator_container">
                                <div class="nav_item nav_selected" data-name="#company_products">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">公司产品</span>
                                </div>
                                <div class="nav_item" data-name="#company_intro">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">公司介绍</span>
                                </div>
                                <div class="nav_item" data-name="#history_container">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">发展历程</span>
                                </div>
                                <div class="nav_item" data-name="#interview_container">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">面试评价</span>
                                </div>
                                <div class="nav_item nav_item_last" data-name="#location_container">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">公司位置</span>
                                </div>
                                <!-- 为了挡住顶部和底部的灰线 -->
                                <span class="nav_vline nav_vline_top"></span>
                                <span class="nav_vline nav_vline_bottom"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cboxOverlay" style="opacity: 0.9; visibility: visible; display: block;"></div>
    @endsection
    @section('custom-script')
        <!-- <script type="text/javascript">
        $(".wheel-button").wheelmenu({
            // alert(1);
            trigger: "hover",
            animation: "fly",
            angle: [0, 360]
        });
        </script> -->
        <script type="text/javascript">
            $(document).ready(function(){
                $(".company_index").click(function(){
                    $(".companyIndex").show();
                    $(".recruitJob").hide();
                    $(".companyAsk").hide();
                    $(".li_one").addClass("current")
                    $(".li_two").removeClass("current")
                    $(".li_three").removeClass("current")
                });
                $(".recruit_job").click(function(){
                    $(".companyIndex").hide();
                    $(".recruitJob").show();
                    $(".companyAsk").hide();
                    $(".li_two").addClass("current")
                    $(".li_one").removeClass("current")
                    $(".li_three").removeClass("current")
                });
                $(".company_ask").click(function(){
                    $(".companyIndex").hide();
                    $(".recruitJob").hide();
                    $(".companyAsk").show();
                    $(".li_three").addClass("current")
                    $(".li_one").removeClass("current")
                    $(".li_two").removeClass("current")
                });
                $(".add_one,.add_product").click(function(){
                    $(".item_content_one").hide();
                    $(".add_btn_wrap").hide();
                    $(".item_content_one_edit").show();
                    $(".item_cancel_add").show();
                    
                });
                $(".cancel_add_one,.cancel_btn_one").click(function(){
                    $(".item_content_one").show();
                    $(".add_btn_wrap").show();
                    $(".item_content_one_edit").hide();
                    $(".item_cancel_add").hide()
                });
                $(".add_two,.add_image").click(function(){
                    $(".item_ropera1_content").hide();
                    $(".item_content_two").hide();
                    $(".item_content_add_wrap").show();
                    $(".item_content_edit_two").show();
                    $(".item_ropera1_content").show();
                })
                $(".cancel_add_two,.cancel_btn_two").click(function(){
                    $(".item_ropera1_content").show();
                    $(".item_content_two").show();
                    $(".item_content_add_wrap").hide();
                    $(".item_content_edit_two").hide();
                    $(".item_ropera1_content").hide();
                });
                $(".add_three,.add_process").click(function(){
                    $(".item_add_wrap_three").hide()
                    $(".item_content_edit_three").show();
                    $(".item_content_three").hide();
                })
                $(".cancel_btn_three,.cancel_add_three").click(function(){
                    $(".item_add_wrap_three").show()
                    $(".item_content_edit_three").hide();
                    $(".item_content_three").show();
                });
                $(".eventTipOne,.idropdown").click(function(){
                    $(".eventUlOne").toggle();
                });
                $(".edit_one").click(function(){
                    $(".edit_text_one").hide();
                    $(".edit_text_edit_one").show();
                    $(".item_right_one").hide();
                    $(".item_right_edit_one").show();
                })
                $(".cancel_edit_one,.cancel_right_btn_one").click(function(){
                    $(".edit_text_one").show();
                    $(".edit_text_edit_one").hide();
                    $(".item_right_one").show();
                    $(".item_right_edit_one").hide();
                });
                $(".info_one_dropdown").click(function(){
                    $(".info_ul_invest").toggle()
                });
                $(".people_one_dropdown").click(function(){
                    $(".info_ul_people").toggle()
                });
                $(".add_right_one,.add_mangers").click(function(){
                    $(".item_right_text_wrap_one").hide();
                    $(".company_manger_wrap").hide();
                    $(".item_right_text_edit_one").show();
                    $(".fom_right_one").show();
                });
                $(".cancel_right_add_one,.cancel_right_btn_two").click(function(){
                    $(".item_right_text_wrap_one").show();
                    $(".company_manger_wrap").show();
                    $(".item_right_text_edit_one").hide();
                    $(".fom_right_one").hide();
                });
                $(".add_right_two,.add_tags").click(function(){
                    $(".item_right_text_edit_two").show();
                    $(".tags_wrap_edit_one").show();
                    $("item_right_text_wrap_two").hide();
                    $("tags_wrap_one").hide();
                    $(".tags_wrap_one").hide();
                });
                $(".cancel_right_add_two,.cancel_right_btn_three").click(function(){
                    $(".item_right_text_edit_two").hide();
                    $(".tags_wrap_edit_one").hide();
                    $("item_right_text_wrap_two").show();
                    $("tags_wrap_one").show();
                    $(".tags_wrap_one").show();
                });
                
                /********/
                $(function(){
                    $(".eventUlOne li").bind("click",function(){
                        
                        selectedItem(this);
                    });
                });
                    
                function selectedItem(obj){
                    var $elemThis = $(obj);
                    var txt_this = $elemThis.text();
                    $(".eventTipOne").text(txt_this);
                };
                
                $(function(){
                    $(".info_ul_invest li").bind("click",function(){
                        
                        selectedItem(this);
                    });
                });
                    
                function selectedItem(obj){
                    var $elemThis = $(obj);
                    var txt_this = $elemThis.text();
                    $(".info_invest").text(txt_this);
                };
                $(function(){
                    $(".info_ul_people li").bind("click",function(){
                        
                        selectedItem(this);
                    });
                });
                    
                function selectedItem(obj){
                    var $elemThis = $(obj);
                    var txt_this = $elemThis.text();
                    $(".info_people").text(txt_this);
                }
                /*******************/
                $(".img_del").click(function(){
                    $(".mr_delete_pop").show();
                })
                $(".mr_del").click(function(){
                    $(".mr_delete_pop").hide();
                })
                $(".edit_text").click(function(){
                    $(".top_info_content").hide();
                    $(".top_info_edit").show();
                });
                $(".cancel_info_edit,.cancel_top_btn").click(function(){
                    $(".top_info_content").show();
                    $(".top_info_edit").hide();
                });
            });
        </script>
    @endsection
@endif


@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('footer')
       @include('components.myfooter')
    @endsection