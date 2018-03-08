/**
 * Created by Love_sandy on 17-12-16.
 */
(function(){
    var ESHUtils = this.ESHUtils;
    $(function(){
        $(".esh-href-page").click(function(){
            var url = $(this).data("url");
            self.location = url;
        });
        $("#esh-company-auth").click(function () {
            var $verifyElement = $(this);
            var isVerified = $verifyElement.hasClass("verified");
            var unverified = $verifyElement.hasClass("unverified");

            if (isVerified) {
                swal({
                    title: "提示",
                    text: "您已经通过认证，不需要再次认证",
                    confirmButtonText: "确定"
                })
            } else if (unverified) {
                swal({
                    title: "提示",
                    text: "您已经提交审核申请，不需要再次提交，请耐心等待",
                    confirmButtonText: "确定"
                })
            }else {
                self.location = "/m/account/enterpriseVerify";
            }
        });
        $("#esh-loginout").click(function(){
            self.location = "/m/account/logout";
        });

        $('.esh-media-list').on('click','.mdl-list__item',function (evt) {
            var $this = $(this);

            ESHUtils.goPage({url: "/m/position/detail?pid=" + $this.data('pid')});

            return ESHUtils.stopEvent(evt);
        });

    });


})(this);

var verfiyCompany = function(verifyCode){

    if(verifyCode==0){
        swal({
            title:"提示",
            text:"您的企业号的状态为待审核，企业号审核通过后即可修改资料",
            confirmButtonText: "确定"
        });
    }else if(verifyCode== -1){
        swal({
            title:"提示",
            text:"您的企业号尚未提交审核，请点击“企业认证”进行审核！",
            confirmButtonText: "确定"
        });
    }else if(verifyCode == 2){
        swal({
            title:"提示",
            text:"您的企业号审核失败，请重新点击“企业认证”进行审核！",
            confirmButtonText: "确定"
        });
    }
};