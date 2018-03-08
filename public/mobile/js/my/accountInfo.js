/**
 * Created by asusps on 2017/12/25.
 */

(function(){
    var ESHUtils = this.ESHUtils;
    $(function(){
        //初始化日历插件
        var birthDate = new mdDateTimePicker.default({
            type: 'date',
            init: moment(moment().subtract(10,"years").format("l"),"YYYY-MM-DD"),
            //init: moment(moment().format("l"),"YYYY-MM-DD"),
            past:moment().subtract(50,"years"),
            ok:"确定",
            cancel:"取消"
        });
        $("#esh-birth").on('click',function(evt){
            birthDate.toggle();
            $(this).blur();
            return ESHUtils.stopEvent(evt);
        });
        /**/
        birthDate.trigger = $("#esh-birth")[0];
        $("#esh-birth").on("onOk",function(){
            //this.value = birthDate.time.toString();
            this.value = birthDate.time.format("YYYY-MM-DD");
        });
        ESHUtils.fillSpan();//填充span内容
        initEvents();
    });

    var initEvents = function(){
        $("#upload-head--img").click(function (event) { //添加上传图片点击事件
            event.preventDefault();
            swal({
                title: "要求",
                text: "上传图片要求：格式为：.jpg，.jpeg，.png\n分辨率最大支持 1000像素 * 1000像素\n图片文件大小最大支持5MB",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                $("input[name='head-img']").click();
            });
        });
        //保存person内容
        $("#esh-save").click(function(event){//添加保存点击事件
            event.preventDefault();
            if(!$("#esh-person-info").valid()){
                return;
            }
            var formData = ESHUtils.getElementsByName("esh-person-info");
            var file = $("#input-head--img");
            if(file.prop("files")[0]){
                formData.append('photo', file.prop("files")[0]);
            }
            $(this).attr('disabled',true).text('正在保存...');
            $.ajax({
                url: "/m/account/personinfo/edit",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $(this).attr('disabled',true).text('保存');
                    var result = JSON.parse(data);
                    if(result.status=="200"){
                        self.location=document.referrer;
                        // window.history.back();
                    }
                }
            })
        });
        //保存company内容
        $("#esh-save-cmpinfo").click(function(){
            event.preventDefault();
            if(!$("#esh-company-info").valid()){
                return;
            }
            var formData = ESHUtils.getElementsByName("esh-company-info");
            var file = $("#input-head--img");
            if(file.prop("files")[0]){
                formData.append('elogo', file.prop("files")[0]);
            }
            $(this).attr('disabled',true).text('正在保存...');
            $.ajax({
                url: "/m/account/enprinfo/edit",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $(this).attr('disabled',true).text('保存');
                    console.log(data);
                    var result = JSON.parse(data);
                    if(result.status=="200"){
                        self.location=document.referrer;
                        // window.history.back();
                    }
                }
            })
        });
    }
}).call(this);



var showPreview = function(element){ //预览图片
    // var isCorrect = true;
    var isChangeHeadImg = false;
    var file = element.files[0];
    if(!file)
        return;
    var anyWindow = window.URL || window.webkitURL;
    var objectUrl = anyWindow.createObjectURL(file);
    window.URL.revokeObjectURL(file);

    var headImagePath = $("input[name='head-img']").val();

    if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(headImagePath)) {
        // isCorrect = false;
        swal({
            title: "错误",
            // type: "error",
            text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
        return;
    }
    if (file.size > 5 * 1024 * 1024) {
        swal({
            title: "错误",
            // type: "error",
            text: "图片文件最大支持：5MB",
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
        return;
    }
    var reader = new FileReader();
    reader.onload = function (e) {
        var data = e.target.result;
        //加载图片获取图片真实宽度和高度
        var image = new Image();
        image.onload = function () {
            var width = image.width;
            var height = image.height;
            console.log(width + "//" + height);
            $("#upload-head--img").attr("src", objectUrl);
            isChangeHeadImg = true;
            /*if (width > 1000 || height > 1000) {
                isCorrect = false;
                swal({
                    title: "错误",
                    // type: "error",
                    text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n图片分辨率最大支持 1000像素 * 1000像素",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else if (isCorrect) {
                $("#upload-head--img").attr("src", objectUrl);
                isChangeHeadImg = true;
            }*/
        };
        image.src = data;
    };
    reader.readAsDataURL(file);
};

/**/



