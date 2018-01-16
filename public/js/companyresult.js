$(function() {
	if(area != null && area != ""){
		$('.stander_div1').find('.' + area).addClass('active');
	}
	
	if(jieduan != null && jieduan != ""){
		$('.stander_div2').find('.' + jieduan).addClass('active');
	}
	
	if(techtag != null && techtag != ""){
		$('.stander_div3').find('.' + techtag).addClass('active');
	}
	
	
	initdata();
	// 鼠标滑过边框变色(首页职位/公司搜索页面都有)
    $('.jieshao_list li').mouseover(function(){
      $(this).addClass('greenborder_li');
      $(this).siblings().removeClass('greenborder_li');
    });
    $('.jieshao_list li').mouseleave(function(){
      $(this).removeClass('greenborder_li');
    });	
	//公司地点
	$('.stander_div1').find('div').live('click',function(){
		 if($(this).hasClass('active')){
			 $(this).removeClass('active');
			 area = "";
		 }else{
			 $(this).siblings('div').removeClass('active');
			 $(this).addClass('active');
			 area = $(this).attr('v');
		 }
		 loaddata(1);
	});
	
	
	//发展阶段
	$('.stander_div2').find('div').live('click',function(){
		 if($(this).hasClass('active')){
			 $(this).removeClass('active');
			 jieduan = "";
		 }else{
			 $(this).siblings('div').removeClass('active');
			 $(this).addClass('active');
			 jieduan = $(this).attr('v');
		 }
		 loaddata(1);
	});
	
	//行业领域
	$('.stander_div3').find('div').live('click',function(){
		 if($(this).hasClass('active')){
			 $(this).removeClass('active');
			 techtag = "";
		 }else{
			 $(this).siblings('div').removeClass('active');
			 $(this).addClass('active');
			 techtag = $(this).attr("v");
		 }
		 loaddata(1);
	});
	
	//搜索框回车事件
	$("#xinkeywd").keyup(function(event){
        if(event.keyCode == 13){
           $('#chakan').click();
        }
    });

    $('#chakan').live("click",function(){
    	xinkeywd = $('#xinkeywd').val();
    	area = "";
        techtag = "";
        jieduan = "";
        $(".search_stander").find('div').removeClass('active');
    	loaddata(1);
    });
    
    //热门职位搜索
    $('.taoyige_hotsearch a').live('click',function(){
    	xinkeywd = $(this).text();
    	$('#xinkeywd').val(xinkeywd);
    	area = "";
        techtag = "";
        jieduan = "";
        loaddata(1);
    });

});

function loaddata(page) {
	window.location.href = BaseJSURL + "company.html?mkwd=" + xinkeywd + "&area=" + area + "&techtag=" + techtag + "&jieduan=" + jieduan +"&cp=" + page;
}

function initdata(){
	var param = new Object();
	param.param1 =xinkeywd ;
	if (param.param1 == "请输入公司名") {
		param.param1 = "";
	}
	param.param2 = "";
	if(area != null && area != ""){
		param.param2 = $('.stander_div1').find('.' + area).text();
	}
	if (param.param2 == '全国') {
		param.param2 = "";
	}
	param.param3 = jieduan;// 阶段
	param.param4 = techtag;// 领域
	param.param5 = "";// 排序方式
	param.param6 = currPage;

	jQuery.ajax({
				type : 'post',
				contentType : 'application/json; charset=utf-8',
				dataType : 'json',
				url : BaseJSURL + '/cs/more',
				data : JSON.stringify(param),
				success : function(data) {
					
					currPage = data.currPage;
		            totalPage = data.searchResult.totalPages;
		            
		            $('.companydiv').html("");
					if ((currPage == 0 || currPage == 1)&& data.searchResult.companyList.length == 0) {
						$(".company_nojob").show();
					}else{
						$(".company_nojob").hide();
						
						var str = "";
						
						$.each(data.searchResult.companyList,function(index, company) {
									str +='<li>'+
								             '   <a href="' +BaseJSURL+ '/c/'+ company.id+ '.html" class="gssearch_img">'+
									         '        <img src="' +user_photo_url+ '/company/'+company.company_logo +'" onerror="javascript:this.src=\''+BaseJSURL+'/img/web/gsLOGO.jpg\'" alt="" />'+
									         '   </a>'+
								             '   <div class="gsdiv">'+
								             '        <p class="b7">'+
								             '            <a class="zw_name" target="_blank" href="' +BaseJSURL+ '/c/'+ company.id+ '.html" >' +company.companyname+ '</a>';
									         if(company.company_location != null && company.company_location != ""){
									str +='[' +company.company_location+ ']';
									         }
									str +='        </p>'+
								             '        <div class="brif">' ;
									         if(company.company_techtag != null && company.company_techtag != ""){
									        	 var e=new RegExp("/","g");
									str +=company.company_techtag.replace(e, ","); 
									         }
									         if(company.jieduan != null && company.jieduan != ""){
									str +='             <span>|</span>' +company.jieduan;
									         }
									         if(company.guimo != null && company.guimo != ""){
									str +='             <span>|</span>' + company.guimo;       	 
									         }
									str +='        </div>'+
								             '        <div class="div_s">';
									         if(company.company_biaoqian != null && company.company_biaoqian != ""){
									        	 var biaoqian = company.company_biaoqian.split(',');
									        	 for(var i=0;i<biaoqian.length;i++){
								   str +='            <span>' +biaoqian[i]+ '</span>';       		 
									        	 }
									         }
								   str +='         </div>'+
								             '        <div class="brif">';
								   $.each(company.jobList,function(index2, job) {
									   if(index2 == 0){
								   str +='              <a href="'+BaseJSURL+'/j/'+job.id+'?ts=0" target="_blank">' +job.name + '</a>';		   
									   }else{
								   str +='              <span>|</span><a href="'+BaseJSURL+'/j/'+job.id+'?ts=0" target="_blank">' + job.name + '</a>';		   
									   }
								   });
								   str +='         </div>'+
								             '   </div>'+
								             '</li>';
						});
						
						$('.companydiv').append(str);
					}
					
					fenye();
					
				}
			});
}