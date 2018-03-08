$(function(){
	// hotjobs();
	// jobs();
	// zixun();
	
	$("#xinkeywd").keyup(function(event){
        if(event.keyCode == 13){
           $('#chakan').click();
        }
    });

    // $('#chakan').on("click",function(){
    // 	var xinkeywd = $("#xinkeywd").val();
    // 	if(xinkeywd=="请输入关键词，如：运营策划" || xinkeywd==""){
    // 		xinkeywd="";
    // 	}else{
    // 		if(CheckStr(xinkeywd) == false){
    //     		alert("搜索词包含非法字符");
    //     		return;
    //     	}
    // 	}
    // 	if(xinkeywd == "打野" || xinkeywd == "打野"){
    // 		xinkeywd =xinkeywd.substring(0,1) +  "jiajia";
    // 	}
    // 	if(xinkeywd == "电竞" || xinkeywd == "电竞"){
    // 		xinkeywd =xinkeywd.substring(0,1) +  "jing";
    // 	}
    // 	window.location.href =BaseJSURL + "/jc/?mkwd=" + xinkeywd;
    // });
    
//   $('.choosing li').on("click",function(){
//	   var area = $(this).text();
//	   window.location.href =BaseJSURL + "/jc/?area=" + area;
//   });
	
	//热门职位搜索
//    $('.taoyige_hotsearch a').on('click',function(){
//    	 var keywd = $(this).text();
//    	 if(keywd == "c++" || keywd == "C++"){
//    		 keywd =keywd.substring(0,1) +  "jiajia";
//     	}
//     	if(keywd == "c#" || keywd == "C#"){
//     		keywd =keywd.substring(0,1) +  "jing";
//     	}
//    	 window.location.href = BaseJSURL + "/jc/?mkwd=" + keywd;
//    });
	
	//左边分类点击
//    $('.myzhuanhuang').on('click',function(){
//   	     var keywd = $(this).text();
//	   	 if(keywd == "c++" || keywd == "C++"){
//	   		keywd =keywd.substring(0,1) +  "jiajia";
//	  	 }
//	  	 if(keywd == "c#" || keywd == "C#"){
//	  		keywd =keywd.substring(0,1) +  "jing";
//	  	 }
//    	 window.location.href = BaseJSURL + "/jc/?mkwd=" + keywd;
//    });
});

// //热门职位
// function hotjobs(){
// 	jQuery.ajax({   
//         type: 'post',   
//         contentType : 'application/json; charset=utf-8',   
//         dataType: 'json',   
//         url: BaseJSURL + '/ajax/hotjob.do', 
//         data: {},   
//         success: function(data){
//         	var str = '';
//         	$.each(data.hotjobs.hotjobs,function(index,job){
//         		str +='<li>'+
//                          '    <div class="jieshao_list_left left">'+
//                          '            <p class="b7"><a class="zw_name" target="_blank" href="' +BaseJSURL + '/j/' + job.id + '.html" >' + job.name+'</a>';
// 		        		if(job.nature != null && job.nature != ""){
// 				        	 if(job.nature == "1"){
// 			   str +='[实习]';   	        		 
// 				        	 }else if(job.nature == "2" || job.nature == "3"){
// 			   str +='[全职]';   	 
// 				        	 }else if(job.nature == "4"){
// 			   str +='[兼职]';     		 
// 				        	 }
// 				         }
// 				         if(job.area != null && job.area != ""){
// 				str +='[' + job.area + ']';
// 				         }
// 		       str +='           </p>'+
// 		                '     <div class="brif">';
// 		        		if(job.jobsalary != null && job.jobsalary != ""){
// 			    str += job.jobsalary;
// 			             }
// 				         if(job.workyear != null && job.workyear != ""){
// 			            	 if(job.workyear == "经验不限"){
// 			   str +='                   <span>|</span>' + job.workyear ;            		 
// 			            	 }else{
// 			   str +='                   <span>|</span>' + job.workyear  + '工作经验';             		 
// 			            	 }
// 			             }
// 				         if(job.college != null && job.college != ""){
// 			    str +='                   <span>|</span>' + job.college ;        	 
// 			             }
//         		str +='            </div>';
//         		         if(job.youhuo != null && job.youhuo != ""){
//         		str +='            <div class="div_s" style="margin-top:5px;">';
//         		              var youhuo = job.youhuo.split(',');
//         		              for(var i=0;i<youhuo.length;i++){
//         		            	  if(i < 3){
//         		            		 str +='        	        <font class="">' +youhuo[i]+ '</font>';  
//         		            	  }
//         		              }
//                 str +='            </div>';
//         		         }
//         		         if(job.suqiu != null && job.suqiu != ""){
//         		str +='        	 <div class="div_s">'+
//         	             '                <label class="left">核心要求：</label>'+
//         	             '                <div class="suqiu">';
//         		               var suqiu = job.suqiu.split('|');
//         		               for(var i =0;i<suqiu.length;i++){
//         		            	   if(i < 3){
//         		 str +='           		   <div>' +suqiu[i]+ '</div>';
//         		            	   }
//         		               }
//         	     str +='               </div>'+
//         	              '          </div>';
//         		         }
//                 str +='    </div>'+
//                          '    <div class="jieshao_list_right left">';
//                          if(job.companyid != null && job.companyid != ""){
//                 str +='         <p class="ac"><a target="_blank" href="' +BaseJSURL+ '/c/' +job.companyid +'.html">'+job.hrcompanyname+'</a></p>'+
//                          '         <div class="brif">';
//                          if(job.hrcompanytechtag != null && job.hrcompanytechtag != ""){
//                 str +=job.hrcompanytechtag.split(",")[0] + '<span>|</span>';
//                          }      
//                          if(job.jieduan != null && job.jieduan != ""){
//                 str +=job.jieduan + '<span>|</span> ';     	 
//                          }         
//                          if(job.guimo != null && job.guimo != ""){
//                 str += job.guimo;      	 
//                          }      
//                 str +='         </div>';
//                          if(job.hrcompanybiaoqian != null && job.hrcompanybiaoqian != ""){
//                 str +='         <div class="ware_fu">';
//                                var techtag = job.hrcompanybiaoqian.split(",");
//                                for(var i=0;i<techtag.length;i++){
//                             	   if(i < 4){
//                 str +='             	  <span>' +techtag[i]+ '</span>';
//                             	   }
//                                }
//                 str +='          </div>';
//                          }
//                          }
//                 str +='    </div>'+
//                          '</li>';
//         	});
        	
//         	$('.hotjobs').append(str);
//         }
// 	});
// }

// //最新职位
// function jobs(){
// 	jQuery.ajax({   
//         type: 'post',   
//         contentType : 'application/json; charset=utf-8',   
//         dataType: 'json',   
//         url: BaseJSURL + '/ajax/indexjob.do', 
//         data: {},   
//         success: function(data){
//         	var str = '';
//         	$.each(data.jobs.jobList,function(index,job){
//         		str +='<li>'+
//                          '    <div class="jieshao_list_left left">'+
//                          '            <p class="b7"><a class="zw_name" target="_blank" href="' +BaseJSURL + '/j/' + job.id + '.html" >' + job.name+'</a>';
// 		        		if(job.nature != null && job.nature != ""){
// 				        	 if(job.nature == "1"){
// 			   str +='[实习]';   	        		 
// 				        	 }else if(job.nature == "2" || job.nature == "3"){
// 			   str +='[全职]';   	 
// 				        	 }else if(job.nature == "4"){
// 			   str +='[兼职]';     		 
// 				        	 }
// 				         }
// 				         if(job.area != null && job.area != ""){
// 				str +='[' + job.area + ']';
// 				         }
//                 str +='           </p>'+
//                          '     <div class="brif">';
//         		         if(job.jobsalary != null && job.jobsalary != ""){
//  		        str += job.jobsalary;
//  		                 }
//         		         if(job.workyear != null && job.workyear != ""){
// 	                    	 if(job.workyear == "经验不限"){
// 	           str +='                   <span>|</span>' + job.workyear ;            		 
// 	                    	 }else{
// 	           str +='                   <span>|</span>' + job.workyear  + '工作经验';             		 
// 	                    	 }
// 	                     }
//         		         if(job.college != null && job.college != ""){
// 	            str +='                   <span>|</span>' + job.college ;        	 
// 	                     }
        		
//         		str +='            </div>';
//         		         if(job.youhuo != null && job.youhuo != ""){
//         		str +='            <div class="div_s" style="margin-top:5px;">';
//         		              var youhuo = job.youhuo.split(',');
//         		              for(var i=0;i<youhuo.length;i++){
//         		            	  if(i < 3){
//         		            		  str +='        	        <font class="">' +youhuo[i]+ '</font>';        		  
//         		            	  }
//         		              }
//                 str +='            </div>';
//         		         }
//         		         if(job.suqiu != null && job.suqiu != ""){
//         		str +='        	 <div class="div_s">'+
//         	             '                <label class="left">核心要求：</label>'+
//         	             '                <div class="suqiu">';
//         		               var suqiu = job.suqiu.split('|');
//         		               for(var i =0;i<suqiu.length;i++){
//         		            	   if(i < 3){
//         		 str +='           		   <div>' +suqiu[i]+ '</div>';
//         		            	   }
//         		               }
//         	     str +='               </div>'+
//         	              '          </div>';
//         		         }
//                 str +='    </div>'+
//                          '    <div class="jieshao_list_right left">';
//                          if(job.companyid != null && job.companyid != ""){
//                 str +='         <p class="ac"><a target="_blank" href="' +BaseJSURL+ '/c/' +job.companyid +'.html">'+job.hrcompanyname+'</a></p>'+
//                          '         <div class="brif">';
//                          if(job.hrcompanytechtag != null && job.hrcompanytechtag != ""){
//                 str +=job.hrcompanytechtag.split(",")[0] + '<span>|</span>';
//                          }      
//                          if(job.jieduan != null && job.jieduan != ""){
//                 str +=job.jieduan + '<span>|</span> ';     	 
//                          }         
//                          if(job.guimo != null && job.guimo != ""){
//                 str += job.guimo;      	 
//                          }      
//                 str +='         </div>';
//                          if(job.hrcompanybiaoqian != null && job.hrcompanybiaoqian != ""){
//                 str +='         <div class="ware_fu">';
//                                var techtag = job.hrcompanybiaoqian.split(",");
//                                for(var i=0;i<techtag.length;i++){
//                             	   if(i < 4){
//                 str +='             	  <span>' +techtag[i]+ '</span>';
//                             	   }
//                                }
//                 str +='          </div>';
//                          }
//                          }
//                 str +='    </div>'+
//                          '    <div class="time_fb"><span>'+job.update_time+'</span></div>';
//                          '</li>';
//         	});
        	
//         	$('.jobs').append(str);
//         }
// 	});
// }

// //资讯
// function zixun(){
// 	jQuery.ajax({   
//         type: 'post',   
//         contentType : 'application/json; charset=utf-8',   
//         dataType: 'json',   
//         url: BaseJSURL + '/ajax/indexzx.do', 
//         data: {},   
//         success: function(data){
//         	var str = '';
//         	$.each(data.zixunList,function(index,zixun){
//         		if(index == 0){
//         	str+='<div class="search_fuhe">'+
//   		            '     <img src="'+user_photo_url+'/article/'+zixun.imgpath+'" alt="" />'+
//   		            '     <div class="search_fuhediv">'+
//   		            '          <p><a target="_blank" href="' +BaseJSURL+ '/zixun/info?id='+zixun.id+'">'+zixun.title+'</a></p>'+
//   		            '          <div>' + zixun.content+'</div>'+
//   		            '     </div>'+
//   		            '</div>';
//         		}else{
//         	str+='<div class="search_link">'+
//         	        '     <a target="_blank" href="' +BaseJSURL+ '/zixun/info?id=' +zixun.id + '">' + zixun.title+'</a>'+
//         	        '</div>';
//         		}
//         	});
//         	str +='<a href="' +BaseJSURL+ '/zixun/" target="_blank" class="seemoresearch">查看更多</a>';
//         	$('.search_left').append(str);
//         }
// 	});
// }

