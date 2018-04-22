@extends('layout.admin')
@section('title', '公司信息列表')

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
        .is_pass{
            color: red;
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'company', 'subtitle'=>'companyList', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        公司信息列表
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a href="/admin/addcompany">新增公司</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-striped" id="cu-admin-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>公司名称</th>
                            <th>公司别名</th>
                            <th>所属行业</th>
                            <th>审核状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data['companys'] as $company)
                            <tr>
                                <td>{{$company->id}}</td>
                                <td>{{$company->ename}}</td>
                                <td>{{$company->byname or "无别名"}}</td>
                                <td>{{$company->industry}}</td>
                                {{--<td>--}}
                                    {{--@if($company->escale == null)--}}
                                        {{--规模未知--}}
                                    {{--@elseif($company->escale == 0)--}}
                                        {{--10人以下--}}
                                    {{--@elseif($company->escale == 1)--}}
                                        {{--10～50人--}}
                                    {{--@elseif($company->escale == 2)--}}
                                        {{--50～100人--}}
                                    {{--@elseif($company->escale == 3)--}}
                                        {{--100～500人--}}
                                    {{--@elseif($company->escale == 4)--}}
                                        {{--500～1000人--}}
                                    {{--@elseif($company->escale == 5)--}}
                                        {{--1000人以上--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--@if($company->enature == null || $company->enature == 0)--}}
                                        {{--企业类型未知--}}
                                    {{--@elseif($company->enature == 1)--}}
                                        {{--国有企业--}}
                                    {{--@elseif($company->enature == 2)--}}
                                        {{--民营企业--}}
                                    {{--@elseif($company->enature == 3)--}}
                                        {{--中外合资企业--}}
                                    {{--@elseif($company->enature == 4)--}}
                                        {{--外资企业--}}
                                    {{--@elseif($company->enature == 5)--}}
                                        {{--社会团体--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                                <td>
                                    @if($company->is_verification == -1)
                                        <span class="label label-primary">未审核</span>
                                    @elseif($company->is_verification == 1)
                                        <span class="label label-success">审核通过</span>
                                    @endif
                                </td>
                                <td>
                                    {{--@if($company->is_verification == 1)--}}
                                        {{--<i class="material-icons check  is_pass" data-content="{{$company->id}}">close</i>--}}
                                    {{--@else--}}
                                        {{--<i class="material-icons check" data-content="{{$company->id}}">check</i>--}}
                                    {{--@endif--}}
                                    <i class="material-icons detail" data-content="{{$company->id}}"
                                       data-toggle='modal' data-target='#detailApplyModal'>visibility</i>
                                    <i class="material-icons delete" data-content="{{$company->id}}"
                                       style="margin-left: 16px;">delete</i>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">暂无公司信息</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <nav>
                        {!! $data['companys']->render() !!}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Dialogs ====================================================================================================================== -->
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
            var id = $("#enterprise_id").html();

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
                doPostVerify(id, 1);
            });
        }

        function deny() {
            var id = $("#enterprise_id").html();

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
                doPostVerify(id, 0);
            });
        }

        $(".delete").click(function () {
            var element = $(this);

            swal({
                title: "确认",
                text: "确认删除该公司信息吗?",
                type: "warning",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/company/del?id=" + element.attr('data-content'),
                    type: "get",
                    success: function (data) {
                        checkResult(data['status'], "删除成功", data['msg'], null);
                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                });
            });
        });
        function doPostVerify($eid, $status) {
            $.ajax({
                url: "/admin/company/pass?id=" + $eid + "&status=" + $status,
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
        // function doPostVerify(eid ,option) {
        //
        //     if(option){
        //         status = "审核拒绝";
        //     }else{
        //         status = "审核通过";
        //     }
        //     swal({
        //         title: "确认",
        //         text: "确认"+status+"该公司信息吗?",
        //         type: "warning",
        //         confirmButtonText: "确定",
        //         cancelButtonText: "取消",
        //         showCancelButton: true,
        //         closeOnConfirm: true
        //     }, function () {
        //         $.ajax({
        //             url: "/admin/company/pass?id=" + eid,
        //             type: "get",
        //             success: function (data) {
        //                 checkResult(data['status'], "审核成功", data['msg'], null);
        //                 setTimeout(function () {
        //                     location.reload();
        //                 }, 1200);
        //             }
        //         });
        //     });
        // }
        $(".detail").click(function () {
            var element = $(this);
            var id = element.attr("data-content");

            $.ajax({
                url: "/admin/company/detail?id=" + id,
                type: "get",
                success: function (data) {
                    var enpri = data['enprinfo'];
                    // console.log(enpri);

                    var html = "<tr class='hide'><td>item</td><td id='enterprise_id'>" + enpri['detail_id'] + "</td></tr>";
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
                        "<td>所属行业</td>" +
                        "<td>" + enpri['industry_name'] + "</td>" +
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

                        var scale = "";
                        if(enpri['escale'] == 1)
                            scale = "50人以下";
                        else if(enpri['escale'] == 2)
                            scale = "50~200人";
                        else if(enpri['escale'] == 3)
                            scale = "200~500人";
                        else if(enpri['escale'] == 4)
                            scale ="500~1000人";
                        else if(enpri['escale'] == 5)
                            scale = "1000人以上";
                    html += "<tr>" +
                        "<td>公司规模</td>" +
                        "<td>" + scale + "</td>" +
                        "</tr>";

                    html += "<tr>" +
                        "<td colspan='2'>公司logo</td></tr>" +
                        "<tr><td colspan='2'><img src=" + enpri['elogo'] + " width='100%'/></td>" +
                        "</tr>";


                    $("#cu-apply-detail-table").find("tbody").html(html);
                }
            })
        })
    </script>
@show
