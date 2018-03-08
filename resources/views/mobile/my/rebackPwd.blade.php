@extends('mobile.layout.master')


@section('title', '找回密码')


@section('esh-header')
    @include('mobile.components.header',['title'=>'找回密码','buttonLeft'=>true])
@stop

@section('esh-content')
        <div class="mdl-card esh-width--1-1 esh-margin--top-50" id="esh-main-div-getVerify">
            {{--<div class="mdl-card__supporting-text">--}}
            {{--选择重置密码的方式--}}
            {{--</div>--}}
            <div class="mdl-card__actions esh-padding--x-16">
                {{--<div class="esh-reg-forgetPwd-item">--}}
                    {{--<a href="#" class=" esh-reg-phone esh-active">通过手机或邮箱找回</a>--}}
                    {{--<a href="#" class="esh-reg-mail esh-active">通过邮箱找回</a>--}}
                {{--</div>--}}
                <form id="esh-reg-account" class="esh-form__container">
                    <div class="esh-form-group">
                        <div class="esh-form-input">
                            <input type="text" id="account" class="form-ctrl" placeholder="请输入手机号或邮箱号…"/>
                        </div>
                        <div class="esh-form-input esh-form-verify esh-last">
                            <input type="password" class="form-ctrl" placeholder="请输入验证码…" id="verifyCode"/>
                            <button type="button"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                发送验证码
                            </button>
                        </div>
                    </div>
                    <div class="esh-form-footer esh-form__actions">
                        <span id="errorMsg" class="esh-msg__error"></span>
                        <div class="esh-form-sure">
                            <button id="nextStep"
                                    type="button"
                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">
                                    下一步
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="mdl-card esh-display-none esh-width--1-1 esh-margin--top-50" id="esh-main-div-resetPwd">
            {{--<div class="mdl-card__supporting-text">--}}
            {{--设置新的登录密码--}}
            {{--</div>--}}
            <div class="mdl-card__actions esh-padding--x-16">
                <form id="esh-reg-phone" class="esh-form__container">
                    <span id="errorMsg" class="esh-msg__error"></span>
                    <div class="esh-form-group">
                        <div class="esh-form-input">
                            <input type="password" id="password" placeholder="请输入密码…"/>
                        </div>
                        <div class="esh-form-input esh-last">
                            <input type="password" placeholder="请确认密码…" id="conform-password"/>
                        </div>
                    </div>
                    <div class="esh-form-footer esh-form__actions">
                        <div class="esh-form-sure">
                            <button id="confirmBtn"
                                    type="button"
                                    class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">确认重置
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@stop


@section('esh-js')
    @parent
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.min.js')}}"></script>

    <script type="text/javascript">

        (function () {

            $(function () {
                var timer = null,
                    timerRunning = 0,
                    totalTime = 60,
                    phoneVal = false,
                    emailVal = false,
                    uid = null,
                    $verifyCode = $("#verifyCode");

                $verifyCode.prop("disabled", true);

                $('#esh-reg-account').on('click', '.mdl-js-button', function (evt) {

                    var $this = $(this);
                    var account = $('#account');
                    var $errorMsg = $('#errorMsg');
                    phoneVal = /^1[34578]\d{9}$/.test(account.val());
                    emailVal = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(account.val());
                    var validate = account.is(":visible") && (phoneVal || emailVal);
                    if (account.val() === '') {
                        $errorMsg.text('请输入手机号或邮箱！');
                    } else if (!validate) {
                        $errorMsg.text('手机号或邮箱格式不正确!');
                        return ESHUtils.stopEvent(evt);
                    } else {
                        var form_data = new FormData();
                        if (phoneVal) {
                            form_data.append('tel', account.val());
                        }
                        if (emailVal) {
                            //邮箱timer总时间30秒
                            totalTime = 30;
                            form_data.append('email', account.val());
                        }

                        if (timerRunning) {
                            return ESHUtils.stopEvent(evt);
                        }

                        $.ajax({
                            url: "/account/findPassword/0",
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: "post",
                            data: form_data,
                            success: function (data) {
                                console.log(data);
                                var result = JSON.parse(data);

                                if (result.status === 200) {
                                    swal({
                                        title: "短信验证码已发送",
                                        confirmButtonText: "关闭"
                                    });
                                    uid = result.uid;
                                    $verifyCode.prop("disabled", false);
                                    $verifyCode.focus();
                                    $this.text('获取验证码(' + totalTime + ' s)');
                                    timer = setInterval(function () {
                                        var time = totalTime - timerRunning;
                                        if (!time) {
                                            $this.text('获取验证码');
                                            timerRunning = 0;
                                            clearInterval(timer);
                                        } else {
                                            timerRunning++;
                                            $this.text('获取验证码(' + time + ' s)');
                                        }

                                    }, 1000);
                                } else {
                                    swal({
                                        title: "短信验证码发送失败",
                                        confirmButtonText: "关闭"
                                    });
                                }

                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                // console.log(thrownError);
                                swal({
                                    title: xhr.status + "：" + thrownError,
                                    confirmButtonText: "关闭"
                                });
                                // swal(xhr.status + "：" + thrownError);
                                //checkResult(400, "", xhr.status + "：" + thrownError, null);
                            }
                        })

                    }

                }).on('input', '.form-ctrl', function (evt) {
                    var $errorMsg = $('#errorMsg');
                    $errorMsg.text() && $errorMsg.text('');

                    return ESHUtils.stopEvent(evt);
                });


                // next step
                $('.esh-form-sure').on('click', '#nextStep', function (evt) {
                    var $this = $(this),
                        $errorMsg = $('#errorMsg');
                    if (!emailVal && !phoneVal) {
                        $errorMsg.text('手机号或邮箱格式不正确!');
                        return ESHUtils.stopEvent(evt);
                    }

                    var formData = new FormData();
                    var account = $("#account").val();
                    var verifyCode = $verifyCode.val();
                    if (phoneVal) {
                        // phone


                        if (account === '') {
                            $errorMsg("手机号不能为空！");
                            return;
                        } else {
                            $errorMsg.text() && $errorMsg.text('');
                        }

                        if (verifyCode === '') {
                            $errorMsg("验证码不能为空！");
                            return;
                        } else {
                            $errorMsg.text() && $errorMsg.text('');
                        }

                        formData.append("tel", account);
                        formData.append("code", verifyCode);

                    } else if (emailVal) {
                        // email
                        if (account === '') {
                            $errorMsg("邮箱不能为空！");
                            return;
                        } else {
                            $errorMsg.text() && $errorMsg.text('');
                        }

                        if (verifyCode === '') {
                            $errorMsg("验证码不能为空！");
                            return;
                        } else {
                            $errorMsg.text() && $errorMsg.text('');
                        }

                        formData.append("email", account);
                        formData.append("code", verifyCode);
                    }

                    $this.attr('disabled',true).text('跳转中...');
                    $.ajax({
                        url: "/account/findPassword/1",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "post",
                        data: formData,
                        success: function (data) {
                            $this.attr('disabled',false).text('下一步');
                            var result = JSON.parse(data);
                            if (result.status === 200) {
                                $("#esh-main-div-getVerify").css("display", "none");
                                $("#esh-main-div-resetPwd").css("display", "block");
                            } else {
                                swal({
                                    title: "验证码输入错误",
                                    confirmButtonText: "关闭"
                                });
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            $this.attr('disabled',false).text('下一步');
                            swal({
                                title: xhr.status + "：" + thrownError,
                                confirmButtonText: "关闭"
                            });
                            //checkResult(400, "", xhr.status + "：" + thrownError, null);
                        }
                    });
                });

                // 确认重置
                $('.esh-form-sure').on('click', '#confirmBtn', function (evt) {
                    var password = $("#password");
                    var confirmPassword = $("#conform-password");

                    var $errorMsg = $('#errorMsg');
                    if (password.val() === '') {
                        $errorMsg("重置密码不能为空！");
                        return ESHUtils.stopEvent(evt);
                    } else {
                        $errorMsg.text() && $errorMsg.text('');
                    }

                    if (confirmPassword.val() === '') {
                        $errorMsg("确认密码不能为空！");
                        return ESHUtils.stopEvent(evt);
                    } else {
                        $errorMsg.text() && $errorMsg.text('');
                    }

                    if (confirmPassword.val() !== password.val()) {
                        $errorMsg("前后密码不一致！");
                        return ESHUtils.stopEvent(evt)
                    } else {
                        $errorMsg.text() && $errorMsg.text('');
                    }

                    if (uid === null) {
                        console.log("uid is empty");
                        swal({
                            title: "内部错误，请重试",
                            confirmButtonText: "关闭"
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }

                    var formData2 = new FormData();
                    formData2.append("password", password.val());
                    formData2.append("uid", uid);

                    $.ajax({
                        url: "/account/findPassword/2",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "post",
                        data: formData2,
                        success: function (data) {
                            var result = JSON.parse(data);

                            if (result.status === 200) {
                                swal({
                                    title: "密码已重置",
                                    confirmButtonText: "关闭"
                                });

                                setTimeout(function () {
                                    self.location = 'login';
                                }, 1000);
                            } else {
                                currentStep = 3;
                                swal({
                                    title: "密码重置失败",
                                    confirmButtonText: "关闭"
                                });
                            }

                        }
                    });
                });
            });

        })();
    </script>
@stop
