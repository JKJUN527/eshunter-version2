@extends('layout.admin')
@section('title', '企业审核')

@section('custom-style')
    <style>
        i.material-icons {
            cursor: pointer;
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'enterprise', 'subtitle'=>'', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        企业列表
                    </h2>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-apply-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>企业名称</th>
                            <th>审核状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['enprinfo'] as $enterprise)
                            <tr>
                                <td>{{$enterprise->eid}}</td>
                                <td>{{$enterprise->ename or '未命名'}}</td>
                                <td>
                                    @if($enterprise->is_verification == 0)
                                        <span class="label label-primary">未审核</span>
                                    @elseif($enterprise->is_verification == 1)
                                        <span class="label label-success">审核通过</span>
                                    @elseif($enterprise->is_verification == 2)
                                        <span class="label label-danger">审核拒绝</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="material-icons detail" data-content="{{$enterprise->eid}}"
                                       data-toggle='modal' data-target='#detailApplyModal'>visibility</i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">无待审核企业</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

            <nav>
                {!! $data['enprinfo']->render() !!}
            </nav>

        </div>
    </div>

    <!-- Modal Dialogs ====================================================================================================================== -->
    <!-- Default Size -->
    <div class="modal fade" id="detailApplyModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">企业详情/审核</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped" id="cu-apply-detail-table">
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success waves-effect" onclick="pass()">审核通过</button>
                    <button type="button" class="btn btn-danger waves-effect" onclick="deny()">审核拒绝</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">

        function pass() {
            var eid = $("#enterprise_id").html();

            swal({
                title: "确认",
                text: "确认审核通过？",
                type: "info",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: true
            }, function () {
                doPostVerify(eid, 1);
            });
        }

        function deny() {
            var eid = $("#enterprise_id").html();

            swal({
                title: "确认",
                text: "确认拒绝审核？",
                type: "info",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: true
            }, function () {
                doPostVerify(eid, 0);
            });
        }

        function doPostVerify($eid, $status) {
            $.ajax({
                url: "/admin/enterprise/examine?eid=" + $eid + "&status=" + $status,
                type: "get",
                success: function (data) {
                    $("#detailApplyModal").modal('hide');

                    checkResult(data['status'], "操作成功", data['msg'], null);
                    setTimeout(function () {
                        location.reload();
                    }, 1200);
                }
            })
        }


        $(".detail").click(function () {
            var element = $(this);
            var eid = element.attr("data-content");

            $.ajax({
                url: "/admin/enterprise/detail?eid=" + eid,
                type: "get",
                success: function (data) {
                    var enpri = data['enprinfo'];

                    var html = "<tr class='hide'><td>item</td><td id='enterprise_id'>" + enpri['eid'] + "</td></tr>";
                    html += "<tr>" +
                        "<td>公司名称</td>" +
                        "<td>" + enpri['ename'] + "</td>" +
                        "</tr>";
                    html += "<tr>" +
                        "<td>公司简介</td>" +
                        "<td>" + enpri['ebrief'] + "</td>" +
                        "</tr>";
                    html += "<tr>" +
                        "<td>公司地址</td>" +
                        "<td>" + enpri['address'] + "</td>" +
                        "</tr>";
                    html += "<tr>" +
                        "<td>公司电话</td>" +
                        "<td>" + enpri['etel'] + "</td>" +
                        "</tr>";
                    html += "<tr>" +
                        "<td>公司邮箱</td>" +
                        "<td>" + enpri['email'] + "</td>" +
                        "</tr>";

                    html += "<tr>" +
                        "<td>所属行业</td>" +
                        "<td>" + enpri['name'] + "</td>" +
                        "</tr>";

                    var type = '';
                    if (enpri['enature'] === 1) {
                        type = "国有企业";
                    } else if (enpri['enature'] === 2) {
                        type = "民营企业";
                    } else if (enpri['enature'] === 3) {
                        type = "中外合资企业";
                    } else if (enpri['enature'] === 4) {
                        type = "外资企业";
                    }else if (enpri['enature'] === 5) {
                        type = "社会团体";
                    }

                    html += "<tr>" +
                        "<td>类型</td>" +
                        "<td>" + type + "</td>" +
                        "</tr>";
                    html += "<tr>" +
                        "<td colspan='2'>法人手持身份证照片</td></tr>" +
                        "<tr><td colspan='2'><img src=" + enpri['lcertifi'] + " width='100%'/></td>" +
                        "</tr>";
                    html += "<tr>" +
                        "<td colspan='2'>营业执照</td></tr>" +
                        "<tr><td colspan='2'><img src=" + enpri['ecertifi'] + " width='100%'/></td>" +
                        "</tr>";


                    $("#cu-apply-detail-table").find("tbody").html(html);
                }
            })
        })
    </script>
@show
