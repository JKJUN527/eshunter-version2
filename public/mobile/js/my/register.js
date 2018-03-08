/**
 * Created by root on 18-1-5.
 */
(function(){
    var ESHUtils = this.ESHUtils;

    $(function(){
        var $registerWay = $('.mdl-js-tabs'),
            $currentWay = $registerWay.find('.is-active'),
            prevId = $currentWay && $currentWay.data('target'),
            $userAgreementDialog = $("#esh-user-agreement"),
            $account = $('#account'),
            $errorMsg = $('.esh-msg__error'),
            timer = null,
            timerRunning = 0,
            totalTime = 90,
            $verifyBlock = $('.esh-form-verify'),
            registerData = {
                email: {
                    label: '邮箱',
                    placeholder: '请输入邮箱…',
                    validate: /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i
                },
                phone: {
                    label: '手机号',
                    placeholder: '请输入手机号…',
                    validate: /^1[345789]\d{9}$/
                }
            };

        $registerWay.on('click','.mdl-tabs__tab',function(evt){
            var $this = $(this),
                id = $this.data('target');

            if(prevId !== id){
                $this.siblings().removeClass('is-active').end().addClass('is-active');
                $account.attr('placeholder',(registerData[id] && registerData[id].placeholder) || '');
                $verifyBlock.toggle(id === 'phone');
                !$account.val().trim() && $errorMsg.text('');
                prevId = id;
                $currentWay = $this;
            }

            return ESHUtils.stopEvent(evt);
        });

        $verifyBlock.on('click','.mdl-js-button',function(evt){
            var $this = $(this), phone = $account.val().trim();

            if(!registerData[prevId] || !registerData[prevId].validate.test(phone)) {
                $errorMsg.text('输入的手机号有误！');
                return ESHUtils.stopEvent(evt);
            }

            if(timerRunning){
                return ESHUtils.stopEvent(evt);
            }



            $.ajax({
                type: "POST",
                url: '/m/account/sms',
                dataType: "json",
                data: {'telnum': phone},
                success:function(data){
                    if(data.status === 200){
                        swal({title:'提示','text':'验证码发送成功！',confirmButtonText: "确定"});
                        $this.text('获取验证码(' + totalTime + ' s)');
                        timer = setInterval(function(){
                            var time = totalTime - timerRunning;
                            if(!time){
                                $this.text('获取验证码');
                                timerRunning = 0;
                                clearInterval(timer);
                            }else {
                                timerRunning++;
                                $this.text('获取验证码(' + time + ' s)');
                            }

                        },1000);
                    }else {
                        swal({title:'提示','text':data.msg,confirmButtonText: "确定"});
                    }
                }
            });

            return ESHUtils.stopEvent(evt);
        });

        $('.esh-form-footer').on('click', '.mdl-js-button', function(evt){
            var postData = {},
                key = registerData[prevId] || {},
                account = $account.val().trim(),
                pwd1 = $('#registerPwd1').val().trim(),
                pwd2 = $('#registerPwd2').val().trim(),
                verifyCode = $('#verifyCode').val().trim(),
                isValid = false;

            if(key.validate && key.validate.test(account)){
                postData[prevId] = account;
                isValid = true;
            }else {
                isValid = false;
                $errorMsg.text('输入的' + (key.label || '注册帐号') + '不正确！');
            }
            
            if(isValid){
                if(pwd1.length > 5 && pwd2.length > 5){
                    if(pwd1 !== pwd2) {
                        isValid = false;
                        $errorMsg.text('两次输入的密码不相同！');
                    }else {
                        postData['password'] = pwd1;
                        isValid = true;
                    }
                }else {
                    isValid = false;
                    $errorMsg.text('密码和确认密码长度必须大于等于6位！');
                }
            }
            
            if(isValid && prevId === 'phone'){
                if(verifyCode.length === 6 && /[0-9]{6}/.test(verifyCode)) {
                    postData['code'] = verifyCode;
                    isValid = true;
                }else {
                    isValid = false;
                    $errorMsg.text('验证码错误！');
                }
            }

            if(isValid){
                if($('#agreement').is(':checked')){
                    isValid = true;
                }else {
                    isValid = false;
                    $errorMsg.text('请同意用户协议！');
                }
            }

            if(isValid) {
                postData['type'] = $('.esh-reg-type').find('.mdl-radio__button:checked').val();

                $.ajax({
                    type: "POST",
                    url: '/m/account/register',
                    dataType: "json",
                    data: $.param(postData),
                    success:function(data){
                        if(data.status === 200) {
                            if(prevId !== 'phone'){
                                swal({
                                    title: "注册成功",
                                    text: "激活邮件已发送到邮箱：" + account + "\n一周之内有效，请尽快激活!",
                                    confirmButtonText: "返回登录页面"
                                }, function () {
                                    self.location = "/m/account/login";
                                });
                            }else {
                                swal({
                                    title: "提示",
                                    text: "帐号注册成功！",
                                    confirmButtonText: "确定",
                                    closeOnConfirm: false
                                }, function () {
                                    self.location = "/m/account/login";
                                });
                            }
                        }else {
                            swal({title:'提示','text':data.msg,confirmButtonText: "确定"});
                        }
                    },
                    error:function(error){
                        swal({title:'提示','text':'网络错误，请稍后再试！',confirmButtonText: "确定"});
                    }
                });
            }

            return ESHUtils.stopEvent(evt);
        });

        $('.esh-form').on('input','input',function (evt) {

            $errorMsg.text().trim() && $errorMsg.text('');

            return ESHUtils.stopEvent(evt);
        }).on('click','.esh-js-user-agreement',function (evt) {
            $userAgreementDialog.fadeIn(100);
            return ESHUtils.stopEvent(evt);
        });

        $userAgreementDialog.on('click','.mdl-button',function (evt) {

            $userAgreementDialog.fadeOut(100);

            return ESHUtils.stopEvent(evt);
        });
    });

})();