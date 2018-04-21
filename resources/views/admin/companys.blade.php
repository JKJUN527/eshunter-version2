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
            color: green;
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
                            <th>公司规模</th>
                            <th>公司类型</th>
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
                                <td>
                                    @if($company->escale == null)
                                        规模未知
                                    @elseif($company->escale == 0)
                                        10人以下
                                    @elseif($company->escale == 1)
                                        10～50人
                                    @elseif($company->escale == 2)
                                        50～100人
                                    @elseif($company->escale == 3)
                                        100～500人
                                    @elseif($company->escale == 4)
                                        500～1000人
                                    @elseif($company->escale == 5)
                                        1000人以上
                                    @endif
                                </td>
                                <td>
                                    @if($company->enature == null || $company->enature == 0)
                                        企业类型未知
                                    @elseif($company->enature == 1)
                                        国有企业
                                    @elseif($company->enature == 2)
                                        民营企业
                                    @elseif($company->enature == 3)
                                        中外合资企业
                                    @elseif($company->enature == 4)
                                        外资企业
                                    @elseif($company->enature == 5)
                                        社会团体
                                    @endif
                                </td>
                                <td>
                                    @if($company->type ==0)
                                        未入驻
                                    @else
                                        已入驻
                                    @endif
                                </td>
                                <td>
                                    <i class="material-icons check @if($company->is_verification == 1) is_pass @endif" data-content="{{$company->id}}">check</i>
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
@endsection

@section('custom-script')
    <script type="text/javascript">

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
        $(".check").click(function () {
            var element = $(this);
            var status = "" ;
            if(element.hasClass('is_pass')){
                status = "审核拒绝";
            }else{
                status = "审核通过";
            }
            swal({
                title: "确认",
                text: "确认"+status+"该公司信息吗?",
                type: "warning",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: true
            }, function () {
                $.ajax({
                    url: "/admin/company/pass?id=" + element.attr('data-content'),
                    type: "get",
                    success: function (data) {
                        checkResult(data['status'], "审核成功", data['msg'], null);
                        setTimeout(function () {
                            location.reload();
                        }, 1200);
                    }
                });
            });
        });
    </script>
@show
