@extends('layout.master')
@section('title', '邮箱验证')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <style>

        .verify-card-holder {
            width: 100%;
            min-height: 450px;
            background: url({{asset('images/akali_vs_baron_3.jpg')}}) no-repeat center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            padding: 80px 0
        }

        .verify-card-holder > h3,
        .verify-card-holder > p {
            min-width: 800px;
            font-weight: 300;
            text-align: center;
            /*color: #333333;*/
            color: white;
        }

        .verify-card-holder > p {
            padding-bottom: 32px;
        }

        .verify-card {
            width: 800px;
            height: 300px;
            margin: 0 auto;
            padding: 0 30px;
            background-color: rgba(255, 255, 255, .95);
            border: 1px solid lightgray;
        }

        .verify-card > h5 {
            font-weight: 300;
            text-align: center;
            color: rgb(0, 0, 0);
        }

        .verify-card p {
            font-size: 16px;
            margin-top: 24px;
        }

        button {
            display: inline-block;
            width: 88px;
        }

    </style>
@endsection

@section('header-nav')
    @include('components.headerNav', ['isLogged' => false])
@endsection

@section('content')

    <div class="verify-card-holder">
        <h3><?=$site_name ?> <?=$site_desc ?></h3>
        {{--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.--}}
        {{--Aenan convallis.</p>--}}

        <div class="verify-card mdl-card mdl-shadow--2dp">

            <h5>邮箱激活 <?=$site_name?></h5>

            @if($data["status"] ==  200)
                <p id="verify-result">{{$data["user"]->mail}} 邮箱激活成功，<br>请使用该邮箱直接登录</p>
                <button to="/account/login"
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                    点击登录
                </button>
                @elseif($data["status"] == 400)
                <p id="verify-result">{{$data["msg"]}}<br>请重新发送邮箱验证！</p>
            @endif

            {{--<p>激活链接已失效</p>--}}
            {{--<button id="resend"--}}
            {{--class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">--}}
            {{--重新发送验证码--}}
            {{--</button>--}}
        </div>
    </div>


@endsection


@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script type="text/javascript">

    </script>
@endsection
