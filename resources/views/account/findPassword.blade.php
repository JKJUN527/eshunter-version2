@extends('layout.master')
@section('title', '重置密码')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>

    <style>
        .findPassword-card-holder {
            width: 100%;
            min-height: 450px;
            background: url({{asset('images/akali_vs_baron_3.jpg')}}) no-repeat center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 80px 0
        }

        .form-group .form-line input {
            background-color: transparent;
        }

        .findPassword-card {
            width: 800px;
            height: 380px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, .95);
            padding: 0 30px;
            border: 1px solid lightgray;
        }

        .findPassword-card > h5 {
            font-weight: 300;
            text-align: center;
            color: rgb(0, 0, 0);
            padding-bottom: 40px;
        }

        .findPassword-input {
            width: 370px;
            display: block;
        }

        /*#phone-verify-code .form-line input[type='button'],*/
        /*#email-verify-code .form-line input[type='button'] {*/
        /*width: 150px;*/
        /*position: absolute;*/
        /*right: 0;*/
        /*bottom: 1px;*/
        /*color: #232323;*/
        /*}*/

        #send-SMS,
        #send-email {
            width: 150px;
            position: absolute;
            right: 0;
            bottom: 1px;
            color: #232323;
        }

        #send-SMS:hover,
        #send-email:hover {
            color: #232323;
        }

        /*#phone-verify-code .form-line input[type="button"]:hover,*/
        /*#email-verify-code .form-line input[type="button"]:hover {*/
        /*color: #232323;*/
        /*}*/

        .findPassword-card > button {
            width: 88px;
            margin-right: 16px;
        }

        small {
            margin-bottom: 16px;
        }

        .reset-type--btn {
            width: 200px !important;
            vertical-align: middle;
            margin-bottom: 24px;
        }
    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('content')
    <div class="findPassword-card-holder">

        <div class="findPassword-card mdl-card mdl-shadow--2dp reset-1">
            <h5>忘记密码了？重置密码</h5>
            <small>第1步：选择验证方式</small>

            <button data-content="phone"
                    class="reset-type--btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                <i class="material-icons">phone</i>&nbsp;&nbsp;使用手机号重置密码
            </button>

            <button data-content="email"
                    class="reset-type--btn mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                <i class="material-icons">email</i>&nbsp;&nbsp;使用邮箱重置密码
            </button>
        </div>

        <div class="findPassword-card mdl-card mdl-shadow--2dp reset-2">
            <h5>忘记密码了？重置密码</h5>
            <small>第2步：验证手机号／邮箱</small>

            <div class="form-group findPassword-input" id="phone-form">
                <div class="form-line">
                    <input type="text" id="phone" name="tel" class="phone form-control"
                           placeholder="手机号...">
                </div>
                <label class="error" for="phone"></label>
            </div>

            <div class="findPassword-input form-group" id="phone-verify-code--holder">
                <div class="form-line">
                    <input type="text" id="phone-verify-code" name="verify-code" class="form-control"
                           placeholder="手机验证码...">
                    <input type="button" id="send-SMS" value="发送验证码"
                           class="mdl-button mdl-js-button mdl-button-default button-border"/>
                </div>
                <label class="error" for="phone-verify-code"></label>
            </div>

            <div class="findPassword-input form-group" id="email-form">
                <div class="form-line">
                    <input type="text" id="email" name="mail" class="email form-control"
                           placeholder="邮箱...">
                </div>
                <label class="error" for="email"></label>
            </div>

            <div class="findPassword-input form-group" id="email-verify-code--holder">
                <div class="form-line">
                    <input type="text" id="email-verify-code" name="verify-code" class="form-control"
                           placeholder="邮箱验证码...">
                    <input type="button" id="send-email" value="发送验证码"
                           class="mdl-button mdl-js-button mdl-button-default button-border"/>
                </div>
                <label class="error" for="email-verify-code"></label>
            </div>

            <label>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky next-step">
                    下一步
                </button>
                <button class="mdl-button button-link prev-step">
                    返回上一步
                </button>
            </label>
        </div>

        <div class="findPassword-card mdl-card mdl-shadow--2dp reset-3">
            <h5>忘记密码了？重置密码</h5>
            <small>第3步：设置新的登录密码</small>

            <div class="findPassword-input form-group">
                <div class="form-line">
                    <input type="password" id="password" name="password" class="password form-control"
                           placeholder="密码...">
                </div>
                <label class="error" for="password"></label>
            </div>

            <div class="findPassword-input form-group">
                <div class="form-line">
                    <input type="password" id="conform-password" name="passwordConfirm"
                           class="form-control"
                           placeholder="确认密码...">
                </div>
                <label class="error" for="conform-password"></label>
            </div>

            <label>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky next-step">
                    确认重置
                </button>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link prev-step">
                    上一步
                </button>
            </label>
        </div>
    </div>
@endsection

@section("custom-script")
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">
        var currentStep = 1;
        var uid;

        $phoneVerifyCode = $("#phone-verify-code");
        $phoneVerifyCode.prop("disabled", true);

        $emailVerifyCode = $("#email-verify-code");
        $emailVerifyCode.prop("disabled", true);

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $(".email").inputmask({alias: "email"});
        $(".phone").inputmask('99999999999', {placeholder: '___________'});

        $step1 = $(".reset-1");
        $step2 = $(".reset-2");
        $step3 = $(".reset-3");

        $step2.hide();
        $step3.hide();

        var type = 1; // 1:phone; 2:email;

        $(".reset-type--btn[data-content='phone']").click(function () {
            $step1.hide();
            currentStep = 2;
            type = 1;

            $("#email-form").hide();
            $("#email-verify-code--holder").hide();

            $("#phone-form").show();
            $("#phone-verify-code--holder").show();
            $step2.fadeIn(500);
        });

        $(".reset-type--btn[data-content='email']").click(function () {
            $step1.hide();
            currentStep = 2;
            type = 2;

            $("#email-form").show();
            $("#email-verify-code--holder").show();

            $("#phone-form").hide();
            $("#phone-verify-code--holder").hide();

            $step2.fadeIn(500);
        });

        $(".prev-step").click(function () {
            currentStep--;
            if (currentStep === 1) {
                $step1.fadeIn(500);
                $step2.hide();
                $step3.hide();
            }
            if (currentStep === 2) {
                $step1.hide();
                $step2.fadeIn(500);
                $step3.hide();
            }
        });

        $(".next-step").click(function () {
            currentStep++;
            if (currentStep === 2) {
                $step1.hide();
                $step2.fadeIn(500);
                $step3.hide();
            }

            if (currentStep === 3) {
                var formData = new FormData();

                if (type === 1) {
                    // phone
                    var phone = $("#phone");
                    var phoneCode = $phoneVerifyCode.val();

                    if (phone.val() === '') {
                        setError(phone, 'phone', "不能为空");
                        return;
                    } else {
                        removeError(phone, 'phone');
                    }

                    if (phoneCode === '') {
                        setError($phoneVerifyCode, 'phone-verify-code', '不能为空');
                        return;
                    } else {
                        removeError($phoneVerifyCode, 'phone-verify-code');
                    }

                    formData.append("tel", phone.val());
                    formData.append("code", phoneCode);

                } else if (type === 2) {
                    // email
                    var email = $("#email");
                    var emailCode = $emailVerifyCode.val();

                    if (email.val() === '') {
                        setError(email, 'email', "不能为空");
                        return;
                    } else {
                        removeError(email, 'email');
                    }

                    if (emailCode === '') {
                        setError($emailVerifyCode, 'email-verify-code', '不能为空');
                        return;
                    } else {
                        removeError($emailVerifyCode, 'email-verify-code');
                    }

                    formData.append('email', email.val());
                    formData.append('code', emailCode);
                }

                $.ajax({
                    url: "/account/findPassword/1",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    type: "post",
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);

                        if (result.status === 200) {
                            $step1.hide();
                            $step2.hide();
                            $step3.fadeIn(500);
                        } else {
                            swal({
                                type: "error",
                                title: "验证码输入错误",
                                confirmButtonText: "关闭"
                            });
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal(xhr.status + "：" + thrownError);
                        //checkResult(400, "", xhr.status + "：" + thrownError, null);
                    }
                });
            }

            if (currentStep > 3) {
                var password = $("#password");
                var confirmPassword = $("#conform-password");

                if (password.val() === '') {
                    setError(password, 'password', "不能为空");
                    return;
                } else {
                    removeError(password, 'password');
                }

                if (confirmPassword.val() === '') {
                    setError(confirmPassword, 'conform-password', "不能为空");
                    return;
                } else {
                    removeError(confirmPassword, 'conform-password');
                }

                if (confirmPassword.val() !== password.val()) {
                    setError(confirmPassword, 'conform-password', "确认密码不一致");
                    return;
                } else {
                    removeError(confirmPassword, 'conform-password');
                }

                if (uid === null) {
                    console.log("uid is empty");
                    swal({
                        type: "error",
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
                                type: "success",
                                title: "密码已重置",
                                confirmButtonText: "关闭"
                            });

                            setTimeout(function () {
                                self.location = '/account/login';
                            }, 1000);
                        } else {
                            currentStep = 3;
                            swal({
                                type: "error",
                                title: "密码重置失败",
                                confirmButtonText: "关闭"
                            });
                        }

                    }
                });
            }
        });

        $("#send-SMS").click(function () {
            var phone = $('#phone');

            if (phone.val() === '') {
                setError(phone, 'phone', '不能为空');
            } else if (phone.is(":visible") && !/^1[34578]\d{9}$/.test(phone.val())) {
                setError(phone, 'phone', '手机号格式不正确');
            } else {
                removeError(phone, 'phone');
                var form_data = new FormData();
                form_data.append('tel', phone.val());

                countDown(this, 60);

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
                                type: "success",
                                title: "短信验证码已发送",
                                confirmButtonText: "关闭"
                            });
                            uid = result.uid;
                            $phoneVerifyCode.prop("disabled", false);
                            $phoneVerifyCode.focus();
                        } else {
                            swal({
                                type: "error",
                                title: "短信验证码发送失败",
                                confirmButtonText: "关闭"
                            });
                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal(xhr.status + "：" + thrownError);
                        //checkResult(400, "", xhr.status + "：" + thrownError, null);
                    }
                })

            }

        });

        $("#send-email").click(function () {
            var email = $("#email");

            if (email.val() === '') {
                setError(email, 'email', "不能为空");
            } else if (email.is(":visible") &&
                !/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val())) {
                setError(email, 'email', "请输入格式正确的邮箱");
            } else {
                removeError(email, 'email');

                var form_data = new FormData();
                form_data.append('email', email.val());

                countDown(this, 30);

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
                                type: "success",
                                title: "验证码已发送至您的邮箱",
                                confirmButtonText: "关闭"
                            });
                            uid = result.uid;
                            $emailVerifyCode.prop("disabled", false);
                            $emailVerifyCode.focus();
                        } else {
                            swal({
                                type: "error",
                                title: "邮箱验证码发送失败",
                                confirmButtonText: "关闭"
                            });
                        }

                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal(xhr.status + "：" + thrownError);
                        //checkResult(400, "", xhr.status + "：" + thrownError, null);
                    }
                })
            }
        });

        function countDown(obj, second) {

            // 如果秒数还是大于0，则表示倒计时还没结束
            if (second >= 0) {
                // 获取默认按钮上的文字
                if (typeof buttonDefaultValue === 'undefined') {
                    buttonDefaultValue = obj.defaultValue;
                }
                // 按钮置为不可点击状态
                obj.disabled = true;
                // 按钮里的内容呈现倒计时状态
                obj.value = buttonDefaultValue + ' (' + second + ')';
                // 时间减一
                second--;
                // 一秒后重复执行
                setTimeout(function () {
                    countDown(obj, second);
                }, 1000);
                // 否则，按钮重置为初始状态
            } else {
                // 按钮置未可点击状态
                obj.disabled = false;
                // 按钮里的内容恢复初始状态
                obj.value = buttonDefaultValue;
            }
        }
    </script>
@endsection
