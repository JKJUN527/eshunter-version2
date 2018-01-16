// 图片加载
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