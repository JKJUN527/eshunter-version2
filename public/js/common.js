var msa="";
$(document).ready(function(){
	
	$("#home_loading").hide();
    $("#home_loading").ajaxStart(function(){
        $(this).show();
    });
    $("#home_loading").ajaxStop(function(){
        $(this).hide();
    });
});

//换行转换
function replaceRt(text)
{
	var reg=new RegExp("\n","g");
	text= text.replace(reg,"<br>"); 
	return text;
}

function replaceBr(text)
{
	var reg=new RegExp("<br>","g");
	text= text.replace(reg,"\n"); 
	return text;
}

//空格转换
function replaceKg(text)
{
//	text= text.replace(/(^\s*)|(\s*$)/g,"&nbsp;"); 
	text= text.replace(/\s+/g,"&nbsp;&nbsp;&nbsp;&nbsp;"); 
	return text;
}

/**
 * 验证结果
 */
function showerr(msg)
{
	
	$(".cuowutishi").show();
	$(".cuowutishi_put").html(msg+msa);
	pageScroll();
}


/**
 * 回到头部
 */
function pageScroll(){
    //把内容滚动指定的像素数（第一个参数是向右滚动的像素数，第二个参数是向下滚动的像素数）
    window.scrollBy(0,-1000);
    //延时递归调用，模拟滚动向上效果
    scrolldelay = setTimeout('pageScroll()',10);
    //获取scrollTop值，声明了DTD的标准网页取document.documentElement.scrollTop，否则取document.body.scrollTop；因为二者只有一个会生效，另一个就恒为0，所以取和值可以得到网页的真正的scrollTop值
    var sTop=document.documentElement.scrollTop+document.body.scrollTop;
    //判断当页面到达顶部，取消延时代码（否则页面滚动到顶部会无法再向下正常浏览页面）
    if(sTop==0) clearTimeout(scrolldelay);
}

/**
 * 邮箱验证
 */
function emil(_str){
	if(_str == "" || _str.length == 0)
	{
		msa="不能为空";
		return false;
	}
	else if(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/.test(_str) == false )  
	{
		msa="格式不对";
		return false;
	}
	
    return true;
}

/**
 * 手机验证
 */
function telephone_ce(_str){
	if(_str == "" || _str.length == 0)
	{
		msa="不能为空";
		return false;
	}else if(/^0{0,1}1(3|5|8|7|4)[0-9]{9}$/.test(_str) == false)
	{
		msa="格式不对";
		return false;
	}else if(_str.length!=11)
	{
		msa="长度为11位";
		return false;
	}
	
    return true;
}

/**
 * 电话验证
 */
function dian(_str){
	if(_str == "" || _str.length == 0)
	{
		msa="不能为空";
		return false;
	}
	else if(/^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/.test(_str) == false)
	{
		msa="格式不对";
		return false;
	}
	
    return true;
}

/**
 * 验证手机号码和座机号码
 */
 function regNumber(str){
	 if(str == "" || str.length == 0){
		 msa = "不能为空";
		 return false;
	 }else if(/(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/.test(str) == false){
		 msa = "格式不对";
		 return false;
	 }
	 return true;
 }

/**
 * 普通验证
 */
function common_length(str,len ){
	if(str == "" || str.length == 0)
	{
		msa="不能为空";
		return false;
	}
	if(str.length>len)
	{
		msa="过长，不超过"+len+"字";
		return false;
	}
	return true;
}

/**
 * 关注领域
 */
function common_techtag(str){
	if(str == "" || str.length == 0)
	{
		msa="不能为空";
		return false;
	}else{
		var cishu=str.split(" ");
		var h=0;
		for(var i=0;i<cishu.length;i++){
			if(cishu[i].length>0){
				h++;
				if(h>4){
					msa="过长，只能选择4个关键词语";
					return false;
				};
			};
		};
	}
	
	return true;
};

function tishi_msg(msg)
{
	$('.tishi').attr("style","");
	$("#tishi_msg").html(msg);
	$('body,html').animate({scrollTop:0},20);
	setTimeout(function(){$('.tishi').fadeOut(3000);},2000);
}

function go_back()
{
	window.location.href = document.referrer;
}
/**
 * 20140418:更新email的匹配格式 验证邮箱格式是否正确
 * @param str
 * @returns {Boolean}
 */
function ToUpdateEmail(str){
	if(str == "" || str.length == 0 || str == null )
	{
		msa="不能为空";
		return false;
	}else if(isChn(str)==false){
		msa="不能有中文";
		return false;
	}else if(str.indexOf("@")<=0){
		msa="格式不对";
		return false;
	}else if(str.indexOf(".")<=0){
		msa="格式不对";
		return false;
	}
	return true;
};

/**
 * 20140418更新: 验证字符串中是否含有中文；含有返回false ，反之true
 * @param str
 * @returns {Boolean}
 */
function  isChn(str){
	if(/[^\x00-\xff]/g.test(str)){
		return false;
	} else {
		return true;
	} 
}

var nameReg = /^[\u4e00-\u9fa5]+$/i;
/**
 * 验证汉字
 * l1 最少位数
 * l2 最多位数
 * @param str
 */
function checkName(name,l1,l2){
	 if(name == null || name.length < l1 || name.length > l2 || name.search(nameReg) == -1){
	    return false;
	 }else{
		 return true;
	 }
}
//根据生日返回星座
function getConstellation(birthday){
	var month = parseInt(birthday.substring(4, 6));
	var day = parseInt(birthday.substring(6, 8));
	var Constellation = "";
	if( (month == 3 && day >= 21) || (month == 4 && day <= 19)){
		Constellation = "白羊座";
	}else if((month  == 4 && day >= 20) || (month == 5 && day <= 20)){
		Constellation = "金牛座";
	}else if((month == 5 && day >= 21 ) || (month == 6 && day <= 21)){
		Constellation = "双子座";
	}else if((month == 6 && day >= 22 ) || (month == 7 && day <= 22)){
		Constellation = "巨蟹座";
	}else if((month == 7 && day >= 23 ) || (month == 8 && day <= 22)){
		Constellation = "狮子座";
	}else if((month == 8 && day >= 23 ) || (month == 9 && day <= 22)){
		Constellation = "处女座";
	}else if((month == 9 && day >= 23 ) || (month == 10 && day <= 23)){
		Constellation = "天枰座";
	}else if((month == 10 && day >= 24) || (month == 11 && day <= 22)){
		Constellation = "天蝎座";
	}else if((month == 11 && day >= 23) || (month == 12 && day <= 21)){
		Constellation = "射手座";
	}else if((month == 12 && day >= 22) || (month == 1 && day <=19)){
		Constellation = "摩羯座";
	}else if((month == 1 && day >= 20 ) || (month == 2 && day <= 18)){
		Constellation = "水瓶座";
	}else if((month == 2 && day >= 19 ) || (month == 3 && day <= 20)){
		Constellation = "双鱼座";
	}
	return Constellation;
}

//把空格替换为逗号s
function replaceSpace(str){
	var reg=new RegExp(/(^\s*)|(\s*$)/,"g");
	str= str.replace(reg,","); 
	return str;
}

//转换时间格式 例如 2014-02-02  21:22:22
function getTime(obj){
	if(obj == null || obj == ""){
		return "";
	}
    var time = JSON.parse(obj);
	 time = new Date(time);
	 var year = time.getFullYear();
	 var month = time.getMonth() + 1;
	 var day = time.getDate() ;
	 var hour = time.getHours();
	 var min = time.getMinutes();
	 var sec = time.getSeconds();
	 if(year < 10){
		 year = "0" + year;
	 }
	 if(month < 10){
		 month = "0" + month;
	 }
	 if(day < 10){
		 day = "0" + day;
	 }
	 if(hour < 10){
	    hour = "0" + hour;
	 }
	 if(min < 10){
	    min = "0" + min;
	 }
	 if(sec < 10){
	    sec = "0" + sec;
	 }
	 time = year + "-" + month + "-" + day
	 + " " + hour +":"+ min +":"+ sec;
  return time;
}

/**
 * 获取年月日 
 * 例如 2014-02-02
 */
function getTime2(obj){
	if(obj == null || obj == ""){
		return "";
	}
    var time = JSON.parse(obj);
	 time = new Date(time);
	 var year = time.getFullYear();
	 var month = time.getMonth() + 1;
	 var day = time.getDate() ;
	 if(year < 10){
		 year = "0" + year;
	 }
	 if(month < 10){
		 month = "0" + month;
	 }
	 if(day < 10){
		 day = "0" + day;
	 }
	 time = year + "-" + month + "-" + day;
	return time;
}

/**
 * 获取时分秒
 * 例如 20:02:02
 */
function getTime3(obj){
	if(obj == null || obj == ""){
		return "";
	}
    var time = JSON.parse(obj);
	 time = new Date(time);
	 var hour = time.getHours();
	 var min = time.getMinutes();
	 var sec = time.getSeconds();
	 if(hour < 10){
	    hour = "0" + hour;
	 }
	 if(min < 10){
	    min = "0" + min;
	 }
	 if(sec < 10){
	    sec = "0" + sec;
	 }
	 time = hour +":"+ min +":"+ sec;
	 return time;
}

/**
 * 获取星期
 * 例如 周三
 */
function getTime4(obj){
	if(obj == null || obj == ""){
		return "";
	}
    var time = JSON.parse(obj);
	time = new Date(time);
	var day = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六")[time.getDay()];
	return day;
}

/**
 * 检查是否包含中文
 * @param s
 * @returns {Boolean}
 */
function checkChina(s){
	var patrn=/[\u4E00-\u9FA5]|[\uFE30-\uFFA0]/gi;
	if(patrn.exec(s)){
		return true;
	}
}

/**
 * 验证是否包含特殊字符
 * @param str
 * @returns {Boolean}
 */
function CheckStr(str){
    var myReg = /^[^@\'\\\"$%<>&\^\*]+$/;
    if(myReg.test(str)) return true; 
    return false; 
}

/**
 * 去除空格
 * @param str
 * @returns
 */
function removeSpace(str){
	return str.replace(/(^\s*)|(\s*$)/g,"");
}
