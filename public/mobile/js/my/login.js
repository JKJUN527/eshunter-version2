/**
 * Created by root on 18-1-4.
 */
(function(){
    var ESHUtils = this.ESHUtils;

    $(function(){
        var $errorMsg = $('.esh-msg__error');

        $('#loginForm').on('click','.mdl-button',function(evt){
            var user, pwd, validated, type, $this = $(this), data = new FormData();
            user = $('#account').val().trim();
            pwd = $('#pwd').val().trim();

            validated = false;

            if(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(user)){
                validated = true;
                type = 'email';
            }

            if(!validated && user.length === 11 && /^1[345789]\d{9}$/.test(user)){
                validated = true;
                type = 'phone';
            }

            if(validated && pwd.length < 6){
                validated = false;
            }

            if(!validated){
                $errorMsg.text('帐号或密码错误！');
            }else {
                $errorMsg.text('');
                data.append(type, user);
                data.append('password',pwd);
                $this.attr('disabled',true).text('登录中...');
                $.ajax({
                    url: "/m/account/login",
                    type: "post",
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data:data,
                    success: function (data) {
                        if(data.status === 200){
                            ESHUtils.goPage({url: '/m/index'});
                        }else {
                            swal({title:'提示','text':data.msg,confirmButtonText: "确定"});
                        }
                        $this.attr('disabled',false).text('登录');
                    },
                    error: function (err) {
                        $this.attr('disabled',false).text('登录');
                        swal({title:'提示','text': '网络错误，请稍后再试！',confirmButtonText: "确定"});
                    }
                });
            }

            return ESHUtils.stopEvent(evt);
        }).on('input','.form-ctrl',function(evt){

            $errorMsg.text() && $errorMsg.text('');

            return ESHUtils.stopEvent(evt);
        });


    });
})();