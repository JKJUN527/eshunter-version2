/**
 * Created by asusps on 2018/1/12.
 */
var isUploadIdCard = false;
var isUploadLicense = false;
(function(){
    var ESHUtils = this.ESHUtils;
    $(function () {
        $("body").addClass("esh-sweetalert");
        ESHUtils.fillSpan();//填充span内容
        var idCardHolder = $("#id-card_holder");
        var licenseHolder = $("#license_holder");

        $("#id-card__upload-btn").click(function (event) {
            event.preventDefault();
            swal({
                title: "要求",
                // type: "info",
                text: "请相关法人手持身份证，正面照相\n照相人免冠，五官应位于照片正中间\n身份证上字体清晰可辨",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                idCardHolder.append("<input type='file' name='id-card' hidden onchange='showIdCardPreview(this)'/>");
                $("input[name='id-card']").click();
            });
        });

        $("#license__upload-btn").click(function (event) {
            event.preventDefault();
            swal({
                title: "要求",
                // type: "info",
                text: "营业执照干净，字迹清晰，没有涂改",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                licenseHolder.append("<input type='file' hidden name='license' onchange='showLicensePreview(this)'/>");
                $("input[name='license']").click();
            });
        });


        $("#esh-submit-verify").click(function (event) {//提交认证
            event.preventDefault();
            if(!$("#esh-company-auth-form").valid()){
                return;
            }
            var idCard = $("input[name='id-card']");//身份证照
            var license = $("input[name='license']");//营业执照
            var name = $("input[name='enterprise-name']");
            var industry = $("select[name='enterprise-industry']");
            var type = $("select[name='enterprise-type']");
            var email = $("input[name='enterprise-email']");
            var phone = $("input[name='enterprise-phone']");
            var address = $("textarea[name='enterprise-address']");

            // if (name.val() === "") {
            //     setError(name, "enterprise-name", "不能为空");
            //     return;
            // } else {
            //     removeError(name, "enterprise-name");
            // }

            if (industry.val() === "0") {
                ESHUtils.setError(industry, "enterprise-industry", "请选择所属行业");
                return;
            } else {
                ESHUtils.removeError(industry, "enterprise-industry");
            }

            if (type.val() === "0") {
                ESHUtils.setError(type, "enterprise-type", "请选择企业类型");
                return;
            } else {
                ESHUtils.removeError(type, "enterprise-type");
            }
            var formData = new FormData();

            formData.append("ename", name.val());
            formData.append("industry", industry.val());
            formData.append("enature", type.val());
            formData.append("email", email.val());
            formData.append("etel", phone.val());
            formData.append("address", address.val());

            if (!isUploadIdCard) {
                swal({
                    title: "错误",
                    // type: "error",
                    text: "请上传法人手持身份证照片",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
                return;
            } else {
                formData.append('lcertifi', idCard.prop("files")[0]);
            }

            if (!isUploadLicense) {
                swal({
                    title: "错误",
                    // type: "error",
                    text: "请上传企业营业执照",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
                return;
            } else {
                formData.append('ecertifi', license.prop("files")[0]);
            }

            $.ajax({
                url: "/m/account/enterpriseVerify/upload",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    if(result.status===200){
                        setTimeout(function () {
                            self.location = "/m/account";
                        }, 1000);
                    }else{
                        swal({
                            title: "错误",
                            // type: "error",
                            text: result.msg,
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });
                    }
                    // checkResultWithLocation(result.status, result.msg, result.msg, '/account');
                }
            })
        });
    })
}).call(this);

var idCardPreviewHolder = $("#id-card__preview-holder");
var licensePreviewHolder = $("#license__preview-holder");
function showIdCardPreview(element) {


    var file = element.files[0];
    var anyWindow = window.URL || window.webkitURL;
    var objectUrl = anyWindow.createObjectURL(file);
    window.URL.revokeObjectURL(file);

    var idCardPath = $("input[name='id-card']").val();

    if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(idCardPath)) {
        isCorrect = false;
        swal({
            title: "错误",
            // type: "error",
            text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    } else if (file.size > 5 * 1024 * 1024) {
        swal({
            title: "错误",
            // type: "error",
            text: "图片文件最大支持：5MB",
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    } else {
        idCardPreviewHolder.html("<div class='preview'>" +
            "<i class='material-icons' onclick='removeIdCardPreview()'>close</i>" +
            "<img src='" + objectUrl + "' width='384'></div>");
        isUploadIdCard = true;
    }
}

function showLicensePreview(element) {

    var file = element.files[0];
    var anyWindow = window.URL || window.webkitURL;
    var objectUrl = anyWindow.createObjectURL(file);
    window.URL.revokeObjectURL(file);

    var licensePath = $("input[name='license']").val();

    if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(licensePath)) {
        isCorrect = false;
        swal({
            title: "错误",
            // type: "error",
            text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    } else if (file.size > 5 * 1024 * 1024) {
        swal({
            title: "错误",
            // type: "error",
            text: "图片文件最大支持：5MB",
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    } else {

        licensePreviewHolder.html("<div class='preview'>" +
            "<i class='material-icons' onclick='removeLicensePreview()'>close</i>" +
            "<img src='" + objectUrl + "' width='384'></div>");
        isUploadLicense = true;
    }

}
function removeIdCardPreview() {
    swal({
        title: "确认",
        text: "确认删除该图片吗？",
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        showCancelButton: true,
        closeOnConfirm: true
    }, function () {
        idCardPreviewHolder.html("");
        isUploadIdCard = false;
        $("input[name='id-card']").remove();
    });
}

function removeLicensePreview() {
    swal({
        title: "确认",
        text: "确认删除该图片吗？",
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        showCancelButton: true,
        closeOnConfirm: true
    }, function () {
        licensePreviewHolder.html("");
        isUploadLicense = false;
        $("input[name='license']").remove();
    });
}