@extends('layout.admin')
@section('title', '地区')

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
    @include('components.adminAside', ['title' => 'region', 'subtitle'=>'', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        地区列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a data-toggle="modal" data-target="#addRegionModal1">添加省份</a>
                            </li>
                            <li class="mdl-menu__item">
                                <a data-toggle="modal" data-target="#addRegionModal2">添加市区</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>省/市</th>
                            <th>地区</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['region'] as $region)
                            <tr>
                                <td>{{$region->id}}</td>
                                <td>
                                    @if($region->parent_id ==0)
                                        省
                                    @else
                                        市
                                    @endif
                                </td>
                                <td>{{$region->name}}</td>
                                <td>
                                    <i class="material-icons delete" data-content="{{$region->id}}">delete</i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">暂无地区</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dialogs ====================================================================================================================== -->
    <!-- Default Size -->
    <div class="modal fade" id="addRegionModal1" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">添加一个省份</h4>
                </div>
                <form role="form" method="post" id="add_region_province_form">
                    <div class="modal-body">

                        <label for="name">省份名称</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="province_name" name="province_name" class="form-control"
                                       placeholder="省份名称">
                            </div>
                            <label id="name-error" class="error" for="province_name"></label>
                        </div>

                        {{--<label for="parent-place">父级地区</label>--}}
                        {{--<div class="form-group">--}}
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        {{--<select class="form-control show-tick selectpicker" data-live-search="true"--}}
                        {{--id="parent-place" name="parent-place">--}}
                        {{--<option value="0">无</option>--}}
                        {{--<option value="1">中国-China</option>--}}
                        {{--<option value="2">四川-SiChuan</option>--}}
                        {{--</select>--}}
                        {{--</div>--}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary waves-effect">添加</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addRegionModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">添加一个市区</h4>
                </div>
                <form role="form" method="post" id="add_region_city_form">
                    <div class="modal-body">

                        <label for="name">市区名称</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="city_name" name="city_name" class="form-control"
                                       placeholder="市区名称">
                            </div>
                            <label id="name-error" class="error" for="city_name"></label>
                        </div>

                        <label for="parent-place">父级地区</label>
                        <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" data-live-search="true"
                        id="parent-place" name="parent-place" data-live-search="true">
                            <option value="0">无</option>
                            @forelse($data['region'] as $region)
                                @if($region->parent_id ==0)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endif
                            @endforeach
                        </select>
                            <label id="name-error" class="error" for="parent-place"></label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary waves-effect">添加</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $("#add_region_province_form").submit(function (event) {
            event.preventDefault();

            var name = $("#province_name");

            if (name.val() === '') {
                setError(name, 'province_name', '不能为空');
                return;
            } else {
                removeError(name, 'province_name');
            }

            var formData = new FormData();
            formData.append("name", name.val());

            $.ajax({
                url: "/admin/region/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $("#addRegionModal").modal('toggle');
                    var result = JSON.parse(data);

                    checkResult(result.status, "操作成功", result.msg, null);

                    setTimeout(function () {
                        location.reload();
                    }, 1200);
                }
            })
        });
        $("#add_region_city_form").submit(function (event) {
            event.preventDefault();

            var name = $("#city_name");
            var parent_id = $("select[name='parent-place']");

            if (name.val() === '') {
                setError(name, 'city_name', '不能为空');
                return;
            } else {
                removeError(name, 'city_name');
            }
            if (parent_id.val() == 0) {
                setError(name, 'parent-place', '不能为空');
                return;
            } else {
                removeError(name, 'parent-place');
            }

            var formData = new FormData();
            formData.append("name", name.val());
            formData.append("parent_id", parent_id.val());

            $.ajax({
                url: "/admin/region/addcity",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $("#addRegionModal").modal('toggle');
                    var result = JSON.parse(data);

                    checkResult(result.status, "操作成功", result.msg, null);

                    setTimeout(function () {
                        location.reload();
                    }, 1200);
                }
            })
        });

        $(".delete").click(function () {
            var element = $(this);

            swal({
                type: "warning",
                title: "确认",
                text: "确定删除该地区吗？",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/region/delete?rid=" + element.attr("data-content"),
                    type: "get",
                    success: function (data) {
                        checkResult(data['status'], '操作成功', data['msg'], null);
                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                })
            });
        })
    </script>
@show
