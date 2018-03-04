@extends('layout.admin')
@section('title', '管理员')

@section('custom-style')
    <style>
        ul.mdl-menu,
        li.mdl-menu__item {
            padding: 0;
        }

        a[data-toggle="modal"] {
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
    @include('components.adminAside', ['title' => 'admin', 'subtitle'=>'', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        管理员列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a data-toggle="modal" data-target="#addAdminModal">添加管理员</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>管理员名</th>
                            <th>是否可用</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($data['admins'] as $admin)
                            <tr>
                                <td>{{$admin->aid}}</td>
                                <td>{{$admin->username}}</td>
                                <td>
                                    @if($admin->status == 0)
                                        可用
                                    @else
                                        禁用
                                    @endif
                                </td>
                                <td>
                                    @if($admin->role == 1)
                                        该管理员不可被操作
                                    @else
                                        <i class="material-icons delete" data-content="{{$admin->aid}}">delete</i>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">暂无管理员</td>
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
    <div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">添加一个管理员</h4>
                </div>
                <form role="form" method="post" id="add_admin_form">
                    <div class="modal-body">

                        <label for="username">登录名</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="username" name="username" class="form-control"
                                       placeholder="登录名(支持:数字 字母 汉字 下滑线)">
                            </div>
                            <label id="username-error" class="error" for="username"></label>
                        </div>

                        <label for="password">密码</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="password" id="password" name="password" class="form-control"
                                       placeholder="密码至少六位">
                            </div>
                            <label id="password-error" class="error" for="password"></label>
                        </div>

                        <label for="password">确认密码</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="password" id="confirm_password" name="password_confirm"
                                       class="form-control"
                                       placeholder="再次输入密码">
                            </div>
                            <label id="confirm-password-error" class="error" for="confirm_password"></label>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect">添加</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">取消</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $("#add_admin_form").submit(function (event) {
            event.preventDefault();
            var $form = $(this);
            var serializedData = $form.serialize();

            //验证管理员名
            if (!checkUsername($("#username"))) {
                return false;
            }

            //验证密码
            if (!checkPassword($("#password"))) {
                return false;
            }

            if (!checkPasswordConfirm($("#confirm_password"), $("#password").val())) {
                return false;
            }

            $('#addAdminModal').modal('toggle');

            $.ajax({
                url: "/admin/register",
                type: "post",
                dataType: 'text',
                data: serializedData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResultWithLocation(result.status, "添加成功", result.msg, "/admin/admin");
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal(xhr.status + "：" + thrownError);
                }
            })
        });

        $("#username").blur(function () {
            checkUsername($(this));
        });
        $("#password").blur(function () {
            checkPassword($(this))
        });

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $(".delete").click(function () {
            var element = $(this);

            swal({
                title: "确认",
                text: "确认删除该管理员吗?",
                type: "warning",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/delete?id=" + element.attr('data-content'),
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
