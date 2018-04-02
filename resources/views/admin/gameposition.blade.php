@extends('layout.admin')
@section('title', '选手位置')

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
    @include('components.adminAside', ['title' => 'gameposition', 'subtitle'=>'', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        选手位置列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a data-toggle="modal" data-target="#addRegionModal2">添加位置</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>所属行业</th>
                            <th>所属游戏</th>
                            <th>位置</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['gameposition'] as $gameposition)
                            <tr>
                                <td>{{$gameposition->id}}</td>
                                <td>
                                    俱乐部
                                </td>
                                <td>{{$gameposition->occ_name}}</td>
                                <td>{{$gameposition->name}}</td>
                                <td>
                                    <i class="material-icons delete" data-content="{{$gameposition->id}}">delete</i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">暂无选手游戏位置</td>
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
    <div class="modal fade" id="addRegionModal2" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">添加一个选手位置</h4>
                </div>
                <form role="form" method="post" id="add_game_place_form">
                    <div class="modal-body">

                        <label for="name">位置名称</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="place_name" name="place_name" class="form-control"
                                       placeholder="位置名称">
                            </div>
                            <label id="name-error" class="error" for="city_name"></label>
                        </div>

                        <label for="parent-game">选手游戏</label>
                        <div class="form-group">
                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                        <select class="form-control show-tick selectpicker" data-live-search="true"
                        id="parent-game" name="parent-game" data-live-search="true">
                            @foreach($data['occupation'] as $occupation)
                                <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                            @endforeach
                        </select>
                            <label id="name-error" class="error" for="parent-game"></label>
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
        $("#add_game_place_form").submit(function (event) {
            event.preventDefault();

            var name = $("#place_name");
            var parent_id = $("select[name='parent-game']");

            if (name.val() === '') {
                setError(name, 'place_name', '不能为空');
                return;
            } else {
                removeError(name, 'place_name');
            }
            if (parent_id.val() == 0) {
                setError(name, 'parent-game', '不能为空');
                return;
            } else {
                removeError(name, 'parent-game');
            }

            var formData = new FormData();
            formData.append("name", name.val());
            formData.append("occ_id", parent_id.val());

            $.ajax({
                url: "/admin/gameposition/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $("#addRegionModal1").modal('toggle');
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
                    url: "/admin/gameposition/delete?id=" + element.attr("data-content"),
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
