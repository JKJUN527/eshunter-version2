    var tu=1;
	var x1="";
	var y1="";
	var x2="";
	var y2="";
	var paotow="";
	var paotoh="";
	var cutsize = 0;
	var cutsize2 = 0;
	var photourl="";
	var photo_url = "";
	var type;
$(document).ready(function(){
	
	
	
	
	
	
  // 弹出上传头像
  if($.browser.msie) {
      $(".tanchu_logo").load(BaseJSURL + "/job/jiettu");
   }else{
    $(".tanchu_logo").load(BaseJSURL + "/job/jietu");
   }
  
  //关闭弹出上传头像
  $('.close_btn').live("click",function(){
      $(".hsbj").hide();
      $(".tanchu_logo").hide();
      $(".imgareaselect-selection").parent().css({"display":"none"});
      $(".imgareaselect-outer").css({"display":"none"});
  });
});

// 弹出函数
  function tanchu_logo(name){
     if(name == "company"){
    	 photo_url = company_photo_url;
    	 cutsize = 160;
    	 cutsize2 = 160;
    	 type = 3;
     }else if(name == "profile"){
    	 photo_url = user_photo_url;
    	 cutsize = 180;
    	 cutsize2 =180;
    	 type = 2;
     }
     
    $('.tanchu_logo .jietuqu .images_left img').attr({src: BaseJSURL + "/images/d_default.png"});
      $('.tanchu_logo .jietuqu .images_left img').css({"width":"300px","height":"300px", "margin-top": "0px" });
            
      $('.tanchu_logo .jietuqu .images_right img').attr({src: BaseJSURL + "/images/x_default.png"});
      $('.tanchu_logo .jietuqu .images_right img').css({"width":"180px","height":"180px","margin-right":"50px","margin-left": "0px", "margin-top":"0px"});
    
    $(".hsbj").show();
    $(".tanchu_logo").show();
  }

function selectImage()
{
	$("#tixing").text("");
	jQuery.ajaxFileUpload({
		type: 'post',
        url: BaseJSURL + '/ajax/uploadPhoto.do',
		secureuri:false,
		fileElementId:'fileToUpload',
		dataType: 'json',  
		data: {}, 
		success: function (data){
			if(data.ret==0){
	            	paotow=data.photow;
	             	paotoh=data.photoh;
	             	var leftw=(300-paotow)/2;
	             	var toph=(300-paotoh)/2;
	             	photourl=data.profilphotoName;
	             	$('.tanchu_logo .jietuqu .images_left img').attr({src: photo_url + "/temp/" + data.profilphotoName});
	             	var w1=paotow * 2; 
	             	var h1=paotoh * 2; 
	             	$('.images_left img').attr({src: user_photo_url + "/temp/"+data.profilphotoName});
	             	$('.images_left img').css({ "height": paotoh+"px" });
	             	$('.images_left img').css({ "width": paotow+"px" });
	             	$('.images_left img').css({ "margin-top": toph+"px" });
	             	setTimeout("tupianchufa()",500);
	             	setTimeout(function(){cheng(w1,h1,data.profilphotoName);},1000);
	             }else if(data.ret==-3){
	            	 $("#tixing").text("上传图片不能大于3M");
	             }else{
	            	 $("#tixing").text("上传图片格式不对");
	             }
             },
             error: function (data){  
             	$("#tixing").text("上传失败,请重试或者换张图片");
             }
           }
       ); 
}

function tupianchufa(){
	$('#photo').imgAreaSelect({
		aspectRatio: '1:1',
		x1:0,y1:0,x2:cutsize,y2:cutsize2,
		onSelectChange: function (img, selection) {
		    if (!selection.width || !selection.height)
        		return;
		    	var scaleX = cutsize / selection.width;
    			var scaleY = cutsize2 / selection.height;
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
	$('.images_right img').attr({src: user_photo_url + "/temp/"+m});
	x1=0;y1=0;x2=cutsize;y2=cutsize2;
	var scaleX =cutsize/cutsize*paotow;
	var scaleY = cutsize2/cutsize2*paotoh;
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
     var index = $("#photo_name").val().lastIndexOf("/");
    if(index == -1){
      param.param6 = "";
    }else{
      param.param6 = $("#photo_name").val().substr(index+1);
    }
    
    param.param7 = type;
    if(param.param5==""){
    	$("#tixing").text("请先上传图片");
    	return;
    }
    jQuery.ajax({   
         type: 'post',   
         contentType : 'application/json; charset=utf-8',   
         dataType: 'json',   
         url: BaseJSURL + '/ajax/getPhoto2.do', 
         data: JSON.stringify(param),   
         success: function(data){
         	if(data.ret==0){
         		getImage1();
         	     $("#photo_name").val(photo_url + "/"+data.newlogo_url);
         	     $("#tanchu_logo").find("img").attr({src:photo_url + "/"+data.newlogo_url});
         	}else{
         		return;
         	}
         }
    });        
}

function getImage1(){
	$('.close_btn').click();
	//photologo(BaseJSURL + "/ajax/selectPhoto.do",BaseJSURL + "/",2);
}
//图片加载
function photologo(url,imgurl,type){
	var	param = new Object();
		param.param1 = type;
	$.ajax({   
		type: 'post',   
        contentType : 'application/json; charset=utf-8',   
        dataType: 'json',   
        url: url, 
        data: JSON.stringify(param),   
        success: function(data){
          if(data.ret==0){
            if(type==1){
              $("#companylogo").attr({src:imgurl+data.photo});
              $("#hr_companylogo").val(data.photo);
            }else{
              $("#userlogo").attr({src:data.photo});
              $("#userlogo1").val(data.photo);
            }
          }
        }
    });        
}