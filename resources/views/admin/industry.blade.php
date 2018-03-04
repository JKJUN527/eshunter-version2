@extends('layout.admin')
@section('title', '行业及职业')

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
    @include('components.adminAside', ['title' => 'industry', 'subtitle'=>'', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        行业列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="industry-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="industry-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a data-toggle="modal" data-target="#addIndustryModal">添加行业</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>行业名称</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['industry'] as $industry)
                            <tr onclick="onIndustrySelected({{$industry->id}})">
                                <td>{{$industry->id}}</td>
                                <td>{{$industry->name}}</td>
                                <td>
                                    <i class="material-icons delete-industry"
                                       data-content="{{$industry->id}}">delete</i>
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

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        职业列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a data-toggle="modal" data-target="#addOccupationModal">添加职业</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>职业名称</th>
                            <th>所属行业</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['occupation'] as $occupation)
                            <tr>
                                <td>{{$occupation->id}}</td>
                                <td>{{$occupation->name}}</td>

                                <td>
                                    @foreach($data['industry'] as $industry)
                                        @if($occupation->industry_id == $industry->id)
                                            {{$industry->name}}
                                        @endif
                                    @endforeach
                                </td>

                                <td>
                                    <i class="material-icons delete-occupation" data-content="{{$occupation->id}}">delete</i>
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

    <!-- Modal Dialogs ================================================================================================== -->
    <!-- Default Size -->
    <div class="modal fade" id="addIndustryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">添加一个行业</h4>
                </div>
                <form role="form" method="post" id="add_industry_form">
                    <div class="modal-body">

                        <label for="name">行业名称</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="name" name="name" class="form-control"
                                       placeholder="行业名称">
                            </div>
                            <label id="name-error" class="error" for="name"></label>
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

    <div class="modal fade" id="addOccupationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">添加一个职业</h4>
                </div>
                <form role="form" method="post" id="add_occupation_form">
                    <div class="modal-body">

                        <label for="name">职业名称</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="name-occupation" name="name-occupation" class="form-control"
                                       placeholder="职业名称">
                            </div>
                            <label id="name-error" class="error" for="name-occupation"></label>
                        </div>

                        <label for="parent-industry">所属行业</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" data-live-search="true"
                                    id="parent-industry" name="industry">
                                <option value="">请选择所属行业</option>
                                @foreach($data['industry'] as $industry)
                                    <option value="{{$industry->id}}">{{$industry->name}}</option>
                                @endforeach
                            </select>
                            <label class="error" for="parent-industry"></label>
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
        function onIndustrySelected(id) {

        }

        $("#add_industry_form").submit(function (event) {
            event.preventDefault();

            var name = $("#name");

            if (name.val() === '') {
                setError(name, 'name', '不能为空');
                return;
            } else {
                removeError(name, 'name');
            }

            var formData = new FormData();
            formData.append("name", name.val());

            $.ajax({
                url: "/admin/industry/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $("#addIndustryModal").modal('toggle');
                    var result = JSON.parse(data);

                    checkResult(result.status, "操作成功", result.msg, null);

                    setTimeout(function () {
                        location.reload();
                    }, 1200);
                }
            })
        });

        $("#add_occupation_form").submit(function (event) {
            event.preventDefault();

            var name = $("#name-occupation");
            var industry = $("#parent-industry");

            if (name.val() === '') {
                setError(name, 'name-occupation', '不能为空');
                return;
            } else {
                removeError(name, 'name-occupation');
            }

            if (industry.val() === '') {
                setError(industry, 'parent-industry', '请选择所属行业');
                return;
            } else {
                removeError(industry, 'parent-industry');
            }

            var formData = new FormData();
            formData.append("name", name.val());
            formData.append("industry_id", industry.val());


            $.ajax({
                url: "/admin/occupation/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $("#addOccupationModal").modal('toggle');
                    var result = JSON.parse(data);

                    checkResult(result.status, "操作成功", result.msg, null);

                    setTimeout(function () {
                        location.reload();
                    }, 1200);
                }
            })
        });

        $(".delete-industry").click(function () {
            var element = $(this);

            swal({
                type: "warning",
                title: "确认",
                text: "确定删除该行业吗？",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/industry/delete?id=" + element.attr("data-content"),
                    type: "get",
                    success: function (data) {
                        checkResult(data['status'], '操作成功', data['msg'], null);
                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                })
            });
        });

        $(".delete-occupation").click(function () {
            var element = $(this);

            swal({
                type: "warning",
                title: "确认",
                text: "确定删除该职业吗？",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/occupation/delete?id=" + element.attr("data-content"),
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
