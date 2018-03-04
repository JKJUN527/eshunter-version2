@extends('layout.admin')
@section('title', '广告')

@section('custom-style')
    <style>
        ul.mdl-menu,
        li.mdl-menu__item {
            padding: 0;
        }

        li.mdl-menu__item a {
            cursor: pointer;
            display: block;
            padding: 0 16px;
        }

        i.material-icons {
            cursor: pointer;
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'ad', 'subtitle'=>'adList', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        广告列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a href="/admin/addAds">添加广告</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>标题</th>
                            <th>描述</th>
                            <th>链接</th>
                            <th>截至日期</th>
                            <th>类型</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['adlist'] as $ad)
                            <tr>
                                <td>{{$ad->adid}}</td>
                                <td>{{$ad->title}}</td>
                                <td>{{$ad->content}}</td>
                                <td>{{$ad->homepage or '无'}}</td>
                                <td>{{$ad->validity}}</td>
                                @if($ad->type == 0)
                                    <td>大图</td>
                                @elseif($ad->type == 1)
                                    <td>小图</td>
                                @elseif($ad->type == 2)
                                    <td>文字</td>
                                @endif

                                <td>
                                    <i class="material-icons delete" data-content="{{$ad->adid}}">delete</i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">暂无广告</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                {{--分页--}}

                <nav>
                    {!! $data['adlist']->render() !!}
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $(".delete").click(function () {
            var element = $(this);

            swal({
                title: "确认",
                text: "确认该广告吗?",
                type: "warning",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/ads/del?id=" + element.attr('data-content'),
                    type: "get",
                    success: function (data) {
                        checkResult(data['status'], "删除成功", data['msg'], null);

                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                })
            });
        })
    </script>
@show
