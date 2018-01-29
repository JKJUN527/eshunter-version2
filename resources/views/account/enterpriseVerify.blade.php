@extends('layout.master')
@section('title', '企业号验证')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .verify-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .verify-card > .mdl-card__title {
            padding-bottom: 3px;
        }

        .verify-card > .mdl-card__supporting-text {
            padding-top: 3px;
        }

        .verify-panel {
            padding: 8px 32px;
        }

        .verify-form {
            margin-top: 16px;
        }

        .verify-form {
            width: 100%;
            display: inline-block;
            vertical-align: top;
            padding: 20px 10px;
        }

        .verify-form h3 {
            font-size: 18px;
            font-weight: 500;
            margin: 0 0 30px 0;
            padding: 10px 0 10px 10px;
            background: #f5f5f5;
            /*border-left: 5px solid #03A9F4;*/
            /*width: 380px;*/
        }

        .mdl-card__title-text i {
            color: #4CAF50;
            position: relative;
            font-size: 30px;
            margin-right: 16px;
        }

        .submit-holder {
            margin-top: 24px;
            text-align: end;
        }

        /*.verify-form > button[type='submit'] {*/
        /*text-align: end;*/
        /*}*/

        .verify-form label {
            display: inline-block;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            display: inline-block;
            padding: 6px 12px 6px 0;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
        }

        .dropdown-menu li {
            display: inline-block;
            width: 100%;
            margin: 0;
        }

        .bs-searchbox > input {
            display: inline-block;
            width: 385px !important;

            padding: 6px 12px !important;
        }

        .preview {
            display: inline-block;
            min-width: 100px;
            max-width: 400px;
            min-height: 100px;
            border: 6px solid #ebebeb;
            margin-bottom: 32px;
            position: relative;
        }

        .preview i.material-icons {
            cursor: pointer;
            position: absolute;
            top: 0;
            right: 0;
            background: #F44336;
            color: #ffffff;
        }

        .waiting-verified > h3 {
            font-size: 30px;
        }

        .waiting-verified > h3 > i {
            color: #4CAF50;
            position: relative;
            top: 5px;
            font-size: 30px;
            margin-right: 16px;
        }

        .waiting-verified > p {
            margin-left: 48px;
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

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2, 'type'=>$data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">

            <div class="verify-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                            to="/account/">
                        <i class="material-icons">arrow_back</i>
                    </button>
                    <h5 class="mdl-card__title-text" style="margin-left: 16px;"><i
                                class="material-icons">verified_user</i>企业号验证</h5>
                </div>

                <div class="mdl-card__supporting-text" style="margin-left: 48px;">
                    通过企业号验证后即可发布职位，您提交的企业信息仅作为合法性审核使用。
                </div>

                <div class="mdl-card__actions mdl-card--border verify-panel">

                    <form class="verify-form" onkeydown="if(event.keyCode==13){return false;}">
                        {{--必填项--}}
                        <label for="enterprise-name">企业名称</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="enterprise-name" name="enterprise-name" class="form-control"
                                       placeholder="不能为空" value="{{$data['enterprise']->ename}}">
                            </div>
                            <div class="help-info" style="color: #F44336">必填项，提交审核后公司名称将无法再次修改</div>
                            <label class="error" for="enterprise-name"></label>
                        </div>

                        <label for="enterprise-industry">所属行业</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="enterprise-industry"
                                    name="enterprise-industry">
                                <option value="0">请选择行业</option>
                                @foreach($data['industry'] as $industry)
                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                @endforeach
                            </select>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-industry"></label>
                        </div>

                        <label for="enterprise-type">企业类型</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="enterprise-type"
                                    name="enterprise-type">
                                <option value="0">请选择企业类型</option>
                                <option value="1">国有企业</option>
                                <option value="2">民营企业</option>
                                <option value="3">中外合资企业</option>
                                <option value="4">外资企业</option>
                                <option value="5">社会团体</option>
                            </select>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-type"></label>
                        </div>

                        <label for="enterprise-email">企业联系邮箱</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="enterprise-email" name="enterprise-email"
                                       class="form-control email"
                                       placeholder="必填，Ex: example@example.com"
                                       value="{{$data['enterprise']->email}}">
                            </div>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-email"></label>
                        </div>

                        <label for="enterprise-phone">企业联系电话</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" id="enterprise-phone" name="enterprise-phone" class="form-control"
                                       placeholder="必填，Ex: (999)999999"
                                       value="{{$data['enterprise']->etel}}">
                            </div>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-phone"></label>
                        </div>

                        <label for="enterprise-address">企业地址</label>
                        <div class="form-group">
                            <div class="form-line">
                                <textarea rows="3" class="form-control" name="enterprise-address"
                                          id="enterprise-address"
                                          placeholder="必填，Ex: xx省 xx市 xx区/县  xxx街道xxx号"
                                          value="{{$data['enterprise']->address}}"></textarea>
                            </div>
                            <div class="help-info" style="color: #F44336">必填项</div>
                            <label class="error" for="enterprise-address"></label>
                        </div>

                        <label for="enterprise-id__card">相关负责人手持身份证照片</label><br>

                        <div class="form-group" id="id-card_holder" style="margin-top: 16px">
                            <button id="id-card__upload-btn"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
                                点击上传
                            </button>
                        </div>

                        <div id="id-card__preview-holder">
                        </div>

                        <label for="enterprise-license">企业营业执照</label><br>

                        <div class="form-group" id="license_holder" style="margin-top: 16px">
                            <button id="license__upload-btn"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
                                点击上传
                            </button>
                        </div>

                        <div id="license__preview-holder">
                        </div>

                        {{--<img class="license-img" src="{{asset('images/default-img.png')}}" width="128px">--}}

                        <br>
                        <div class="submit-holder">
                            <button id="submit-verify"
                                    class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                提交审核
                            </button>
                        </div>
                    </form>

                    <div class="mdl-card__actions mdl-card--border verify-panel waiting-verified hidden">
                        <h3><i class="material-icons">verified_user</i>您的企业号审核已经成功提交，请耐心等待。</h3>
                        <p>企业号审核通过后即可发布职位</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        var isUploadIdCard = false;
        var isUploadLicense = false;

        var idCardHolder = $("#id-card_holder");
        var licenseHolder = $("#license_holder");
        var idCardPreviewHolder = $("#id-card__preview-holder");
        var licensePreviewHolder = $("#license__preview-holder");

        $("#id-card__upload-btn").click(function (event) {
            event.preventDefault();
            swal({
                title: "要求",
                type: "info",
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
                type: "info",
                text: "营业执照干净，字迹清晰，没有涂改",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                licenseHolder.append("<input type='file' hidden name='license' onchange='showLicensePreview(this)'/>");
                $("input[name='license']").click();
            });
        });

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
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else if (file.size > 5 * 1024 * 1024) {
                swal({
                    title: "错误",
                    type: "error",
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
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else if (file.size > 5 * 1024 * 1024) {
                swal({
                    title: "错误",
                    type: "error",
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

        $("#submit-verify").click(function (event) {
            event.preventDefault();

            var idCard = $("input[name='id-card']");
            var license = $("input[name='license']");

            var name = $("input[name='enterprise-name']");
            var industry = $("select[name='enterprise-industry']");
            var type = $("select[name='enterprise-type']");
            var email = $("input[name='enterprise-email']");
            var phone = $("input[name='enterprise-phone']");
            var address = $("textarea[name='enterprise-address']");

            if (name.val() === "") {
                setError(name, "enterprise-name", "不能为空");
                return;
            } else {
                removeError(name, "enterprise-name");
            }

            if (industry.val() === "0") {
                setError(industry, "enterprise-industry", "请选择所属行业");
                return;
            } else {
                removeError(industry, "enterprise-industry");
            }

            if (type.val() === "0") {
                setError(type, "enterprise-type", "请选择企业类型");
                return;
            } else {
                removeError(type, "enterprise-type");
            }

            if (email.val() === "") {
                setError(email, "enterprise-email", "不能为空");
                return;
            } else {
                removeError(email, "enterprise-email");
            }

            if (phone.val() === "") {
                setError(phone, "enterprise-phone", "不能为空");
                return;
            } else {
                removeError(phone, "enterprise-phone");
            }

            if (address.val() === "") {
                setError(address, "enterprise-address", "不能为空");
                return;
            } else {
                removeError(address, "enterprise-address");
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
                    type: "error",
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
                    type: "error",
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
                url: "/account/enterpriseVerify/upload",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    checkResultWithLocation(result.status, result.msg, result.msg, '/account');
                }
            })
        });


        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $verifyForm = $(".verify-form");
        $verifyForm.find(".email").inputmask({alias: "email"});
        $verifyForm.find(".id-card").inputmask('999999 99999999 999*', {placeholder: '______ ________ ____'});
    </script>
@endsection
