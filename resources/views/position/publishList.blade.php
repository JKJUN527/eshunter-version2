@extends('layout.master')
@section('title', '已发布职位')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>

    <style>
        .publish-panel {
            min-height: 500px;
            padding: 0;
        }

        .publish-item {
            border-bottom: 1px solid #ebebeb;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .position-info {
            padding: 16px 0 16px 16px;
            display: inline-block;
            width: 500px;
        }

        .position-info > h5 {
            margin: 0 0 8px 0;
            cursor: pointer;
            display: inline-block;

        }

        .position-info > p {
            margin: 0;
            display: inline-block;
            font-size: 12px;
            font-weight: 300;
        }

        .position-info > span {
            font-size: 12px;
            color: #aaaaaa;
            margin-right: 6px;
        }

        .del-operate {
            color: #2e3436;
            font-size: 12px;
            margin-left: 0.5rem;
            cursor: pointer;
        }
        .offline-operate {
            color: cornflowerblue;
            font-size: 14px;
            margin-left: 0.5rem;
            cursor: pointer;
        }
        .online-operate {
            color: cornflowerblue;
            font-size: 14px;
            margin-left: 0.5rem;
            cursor: pointer;
        }
        .refresh-operate {
            color: cornflowerblue;
            font-size: 14px;
            margin-left: 0.5rem;
            cursor: pointer;
        }
        .edit-operate{
            color: cornflowerblue;
            font-size: 14px;
            margin-left: 0.5rem;
            cursor: pointer;
        }
        .edit-operate
        .refresh-operate
        .offline-operate
        .online-operate
        .del-operate:hover {
            color: #000 !important;
            text-decoration: underline;
        }

        .position-data {
            display: inline-block;
            width: 70px;
            height: 86px;
            margin-left: 1rem;
            vertical-align: top;
            font-weight: 300;
            font-size: 13px;
            text-align: left;
            padding: 12px 6px;
            color: #ffffff;
            background-image: url({{asset('images/tag-bg.png')}});
        }

        .position-data span small {
            font-size: 14px;
            font-weight: 500;
        }

        .publish-item:hover {
            background-color: #ebebeb;
        }

        .mdl-card__title-text {
            margin-left: 16px;
            position: relative;
            top: -3px;
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
                <div class="mdl-card mdl-shadow--2dp info-card">
                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/account/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <h5 class="mdl-card__title-text">已发布的职位</h5>
                    </div>

                    <div class="mdl-card__menu">

                        <button class="mdl-button mdl-button--icon mdl-js-button" id="publish-position"
                                to="/position/publish">
                            <i class="material-icons">add</i>
                        </button>

                        {{--<button class="mdl-button mdl-button--icon mdl-js-button" id="sort-position">--}}
                        {{--<i class="material-icons">sort</i>--}}
                        {{--</button>--}}

                        <div class="mdl-tooltip" data-mdl-for="publish-position">
                            发布新职位
                        </div>

                        {{--<div class="mdl-tooltip" data-mdl-for="sort-position">--}}
                        {{--选择排序方法--}}
                        {{--</div>--}}

                        {{--<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"--}}
                        {{--for="sort-position">--}}
                        {{--<li class="mdl-menu__item"><a href="#">发布时间</a></li>--}}
                        {{--<li class="mdl-menu__item"><a href="#">浏览次数</a></li>--}}
                        {{--<li class="mdl-menu__item"><a href="#">申请次数</a></li>--}}
                        {{--</ul>--}}
                    </div>

                    <div class="mdl-card__actions mdl-card--border publish-panel">
                        @forelse($data['position'] as $position)
                            <div class="publish-item">
                                <div class="position-info">
                                    @if($position->title == null || $position->title == "")
                                        <h5 to="/position/detail?pid={{$position->pid}}">未命名职位</h5><br>
                                    @else
                                        <h5 to="/position/detail?pid={{$position->pid}}">{{$position->title}}</h5><br>
                                    @endif

                                    @if($position->pdescribe == null || $position->pdescribe == "")
                                        <p>职位暂无简介</p><br>
                                    @else
                                        <p>{{str_replace(array('</br>','</br','</b>','</b'),"",mb_substr($position->pdescribe, 0, 40, 'utf-8'))}}</p><br>
                                    @endif
                                    <span>发布日期：{{$position->created_at}}</span>
                                    <span>失效日期：{{$position->vaildity}} </span></br>
                                    <a class="del-operate" data-content="{{$position->pid}}">删除</a>
                                    <a class="offline-operate" data-content="{{$position->pid}}">下架</a>
                                    <a class="refresh-operate" data-content="{{$position->pid}}">刷新</a>
                                        @if($position->position_status ==2)
                                            <a class="online-operate" data-content="{{$position->pid}}">上线</a>
                                        @endif
                                    <a class="edit-operate" data-content="{{$position->pid}}">修改</a>
                                </div>

                                <div class="position-data">
                                    <span>浏览&nbsp;&nbsp;<small>{{$position->view_count}}</small></span><br>
                                    <span>申请&nbsp;&nbsp;<small>{{$data["dcount"][$position->pid]}}</small></span>
                                </div>
                            </div>
                        @empty
                            <div class="position-empty">
                                <img src="{{asset('images/desk.png')}}" width="40px">
                                <span>&nbsp;&nbsp;没有发布职位</span>
                            </div>
                        @endforelse

                        <nav>
                            {!! $data['position']->render() !!}
                        </nav>
                    </div>
                </div>
            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">
                <form method="get" id="search-form" action="/position/publishList/search">
                    <div class="form-group mdl-card mdl-shadow--2dp search-position">
                        <div class="form-line">
                            <input type="text" id="keyword" name="keyword" class="form-control"
                                   placeholder="输入职位名称／描述进行搜索">
                            <button class="mdl-button mdl-button--icon mdl-js-button" id="search-position">
                                <i class="material-icons">search</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script type="text/javascript">
        $(".del-operate").click(function () {
            var id = $(this).attr("data-content");

            if (id === null || id === "") {
                return;
            }

            swal({
                title: "确认",
                text: "确定删除该职位吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/position/publishList/delete?pid=" + id,
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/publishList";
                            }, 1200);
                            swal({
                                type: "success",
                                title: "删除成功"
                            });
                        } else if (data['status'] === 400) {
                            swal({
                                type: "error",
                                title: "删除失败"
                            })
                        }
                    }
                })
            });
        })
        $(".online-operate").click(function () {
            var id = $(this).attr("data-content");

            if (id === null || id === "") {
                return;
            }

            swal({
                title: "确认",
                text: "确定重新上线该职位？",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/position/publishList/online?pid=" + id,
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/publishList";
                            }, 1200);
                            swal({
                                type: "success",
                                title: "上线成功"
                            });
                        } else if (data['status'] === 400) {
                            swal({
                                type: "error",
                                title: "上线失败！请重试"
                            })
                        }
                    }
                })
            });
        })
        $(".offline-operate").click(function () {
            var id = $(this).attr("data-content");

            if (id === null || id === "") {
                return;
            }

            swal({
                title: "确认",
                text: "确定下架该职位？职位将不会再收到投递",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/position/publishList/offline?pid=" + id,
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/publishList";
                            }, 1200);
                            swal({
                                type: "success",
                                title: "下架成功"
                            });
                        } else if (data['status'] === 400) {
                            swal({
                                type: "error",
                                title: "下架失败！请重试"
                            })
                        }
                    }
                })
            });
        })
        $(".refresh-operate").click(function () {
            var id = $(this).attr("data-content");

            if (id === null || id === "") {
                return;
            }
            var formData = new FormData();
            formData.append("pid", id);

            swal({
                title: "确认",
                text: "确定刷新该职位？职位将重新发布",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/position/publishList/refresh",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        if (result.status === 200) {
                            setTimeout(function () {
                                self.location = "/position/publishList";
                            }, 1200);
                            swal({
                                type: "success",
                                title: "刷新成功"
                            });
                        } else if (result.status === 400) {
                            swal({
                                type: "error",
                                title: "刷新失败！请重试"
                            })
                        }
                    }
                })
            });
        })
        $(".edit-operate").click(function () {
            var id = $(this).attr("data-content");

            if (id === null || id === "") {
                return;
            }
            self.location = "/position/publishList/edit?pid="+id;
        })
    </script>
@endsection
