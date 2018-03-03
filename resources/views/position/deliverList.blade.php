@extends('layout.master')
@section('title', '收到的申请记录')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .apply-panel {
            padding: 0;
        }

        .apply-ul {
            width: 100%;
            display: block !important;
        }

        .apply-item {
            display: block !important;
            padding: 8px 16px;
            margin: 0;
            cursor: pointer;
            border-bottom: 1px solid #ebebeb;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
            position: relative;
        }

        .apply-item:hover {
            background-color: #f5f5f5;
        }

        .applier-info {
            width: 480px;
            display: inline-block;
            vertical-align: middle;
            padding-left: 13px;
            margin-top: 4px;
        }

        .applier-info > p {
            margin-bottom: 0;
            font-weight: 300;
        }

        .applier-info > p > small {
            color: #aaaaaa;
        }

        .applier-info > p > span {
            font-size: 10px;
            cursor: pointer;
        }

        .applier-info > p > span:hover {
            color: #F44336;
        }

        .mdl-card__title-text {
            margin-left: 16px;
            position: relative;
            top: -3px;
        }

        .operations {
            display: block;
            position: absolute;
            bottom: 10px;
            right: 20px;
        }
        .apply-item img{
            margin: 0;
                margin-left: 2px;
        }
        .operations span {
            display: none;
        }

        .apply-item:hover .operations span {
            display: inline-block;

        }

        .operations-check {
            margin-right: 15px;
        }

        .operations-check:hover,
        .operations-delete:hover {
            text-decoration: underline;
            color: #1976D2;
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
            <div class="info-panel--left info-panel">
                <div class="mdl-card mdl-shadow--2dp base-info--resume info-card">
                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/account/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <h5 class="mdl-card__title-text">收到投递记录</h5>

                        <div class="mdl-card__menu">
                            {{--<button class="mdl-button mdl-button--icon mdl-js-button" id="filter-message">--}}
                            {{--<i class="material-icons">filter_list</i>--}}
                            {{--</button>--}}

                            <button class="mdl-button mdl-button--icon mdl-js-button" id="delete-all--deliver">
                                <i class="material-icons">delete_sweep</i>
                            </button>

                            <div class="mdl-tooltip" data-mdl-for="delete-all--selected_message">
                                删除全部投递记录
                            </div>
                        </div>
                    </div>

                    <div class="mdl-card__actions mdl-card--border apply-panel">
                        <ul class="apply-ul">
                            @foreach($data['deliverAll'] as $item)
                                <li class="apply-item">

                                    @if($item->photo == null || $item->photo == "")
                                        <img  src="{{asset('images/default-img.png')}}" class="img-circle info-head-img"
                                             width="56"
                                             height="56"/>
                                    @else
                                        <img src="{{$item->photo}}" class="img-circle info-head-img" width="56"
                                             height="56"/>
                                    @endif

                                    <div class="applier-info">
                                        <p>{{$item->pname}}</p>
                                        <p>{{$item->position_title}}</p>
                                        <p>
                                            <small>申请时间:{{$item->created_at}}</small>
                                        </p>
                                        @if($item->status == 0)
                                            <span class="normal-info">状态：待查看</span>
                                        @elseif($item->status == 1)
                                            <span class="normal-info">状态：已查看</span>
                                        @elseif($item->status == 2)
                                            <span class="success-info">状态：已录用</span>
                                        @elseif($item->status == 3)
                                            <span class="danger-info">状态：未录用</span>
                                        @elseif($item->status == 4)
                                            <span class="danger-info">状态：职位已下架</span>
                                        @endif
                                    </div>

                                    <div class="operations">
                                        <span class="operations-check" to="/position/deliverDetail?did={{$item->did}}">查看简历</span>
                                        <span data-content="{{$item->did}}" class="operations-delete">删除</span>
                                    </div>

                                </li>
                            @endforeach
                        </ul>

                        <div style="clear:both;"></div>
                        @if(empty($data['deliverAll']))
                            <div class="apply-empty">
                                <img src="{{asset('images/apply-empty.png')}}" width="50px">
                                <span>&nbsp;&nbsp;没有申请记录</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">
        $("#delete-all--deliver").click(function () {
            swal({
                title: "确认",
                text: "确定删除所有投递记录吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/position/deldeliverRecord?did=-1",
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/deliverList";
                            }, 1200);
                            swal("删除成功");
                        } else if (data['status'] === 400) {
                            alert(data['msg']);
                        }
                    }

                })
            });
        });

        $(".operations-delete").click(function () {
            var element = $(this);

            swal({
                title: "确认",
                text: "确定删除该条投递记录吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                var did = element.attr("data-content");
                $.ajax({
                    url: "/position/deldeliverRecord?did=" + did,
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/deliverList";
                            }, 1200);
                            swal("删除成功");
                        } else if (data['status'] === 400) {
                            alert(data['msg']);
                        }
                    }
                })
            });
        })
    </script>
@endsection
