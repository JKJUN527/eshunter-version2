@extends('mobile.layout.master')


@section('title', '登录')


@section('esh-header')
    @include('mobile.components.header',['logo'=> true,'buttonLeft'=>true])
@stop


@section('esh-content')
    <div class="mdl-card esh-margin--top-50 esh-width--1-1">
        <div class="mdl-card__actions esh-padding--x-16">
            <form id="loginForm" class="esh-form">
                <div class="esh-form-group">
                    <div class="esh-form-input esh-form-input--icon">
                        <i class="material-icons mdl-color-text--grey">account_circle</i>
                        <input type="text" class="form-ctrl" id="account" placeholder="请输入手机号或邮箱…"/>
                    </div >
                    <div class="esh-form-input esh-form-input--icon esh-last">
                        <i class="material-icons mdl-color-text--grey">lock</i>
                        <input type="password" class="form-ctrl" placeholder="请输入密码…" id="pwd"/>
                    </div>
                </div>
                <div class="esh-margin--bottom-5">
                    <a class="esh-pull--right mdl-color-text--red" href="/m/account/register">立即注册</a>
                    <a class=" mdl-color-text--red" href="/m/account/findPassword">忘记密码？</a>
                </div>
                <div class="esh-form-footer esh-form__actions">
                    <span id="errorMsg" class="esh-msg__error"></span>
                    <div class="esh-form-sure">
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--raised mdl-button--colored">登录</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop


@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/my/login.js')}}"></script>
@stop
