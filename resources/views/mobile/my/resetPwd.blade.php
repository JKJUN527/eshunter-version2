@extends('mobile.layout.master')


@section('title', '重置密码')


@section('esh-header')
    @include('mobile.components.header',['title'=>'重置密码','buttonLeft'=>true])
@stop


@section('esh-content')
    <div class="mdl-card esh-width--1-1 esh-margin--top-50">
        <div class="mdl-card__supporting-text">
            设置新的登录密码
        </div>
        <div class="mdl-card__actions">
            <form id="esh-reg-phone" class="esh-form__container">
                <span id="errorMsg" class="esh-msg__error"></span>
                <div class="esh-form-group">
                    <div class="esh-form-input">
                        <input type="password" id="account" placeholder="请输入密码…"/>
                    </div>
                    <div class="esh-form-input esh-last">
                        <input type="password" placeholder="请确认密码…" id="rpwdemail"/>
                    </div>
                </div>
                <div class="esh-form-footer esh-form__actions">
                    <div class="esh-form-sure">
                        <button type="button"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                                onclick="window.location.href='resetPwd.blade.php'">确认重置</button>
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
                $("#send-SMS").click(function () {


                });
            });
        })();
    </script>
@stop