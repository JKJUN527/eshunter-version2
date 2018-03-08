@extends('mobile.layout.master')


@section('title', '已发布的职位')

@section('esh-header')
    @include('mobile.components.header',['title'=>'已发布的职位','buttonLeft'=>true,'buttonRight'=>'add'])
@stop

@section('esh-content')
<div class="esh-padding--x-16-y-10 esh-publish-list">
    @forelse($data['position'] as $position)
    <div class="mdl-card mdl-shadow--2dp esh-publish esh-width--1-1">
        <div class="mdl-card__title">
            <h6 class="mdl-card__title-text">
                <i class="material-icons">assignment</i>
                <span>{{empty($position->title) ? '未命名职位' : $position->title}}</span>
            </h6>
        </div>
        <div class="mdl-card__supporting-text">
            <p class="mdl-typography--body-1-force-preferred-font-color-contrast">
                @if(empty($position->pdescribe))
                    职位暂无简介
                @else
                    {{str_replace(array('</br>','</br','</b>','</b'),"",mb_substr($position->pdescribe, 0, 40, 'utf-8'))}}
                @endif
            </p>
            <div class="esh-margin--bottom-5">浏览次数: {{$position->view_count}}<span class="esh-padding--x-1"></span>申请次数: {{$data["dcount"][$position->pid]}}</div>
            <div class="esh-margin--bottom-5">发布日期: {{$position->created_at}}</div>
            <div>失效日期: {{$position->vaildity}}</div>
        </div>
        <div class="mdl-card__menu">
            <button id="menu{{$position->pid}}" class="mdl-button mdl-js-button mdl-button--icon">
                <i class="material-icons">more_vert</i>
            </button>
            <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="menu{{$position->pid}}">
                @if($position->position_status == 2)
                    <li class="mdl-menu__item esh-js-click" data-key="online" data-content="{{$position->pid}}">上线</li>
                @else
                    <li class="mdl-menu__item esh-js-click" data-key="offline" data-content="{{$position->pid}}">下架</li>
                @endif
                <li class="mdl-menu__item esh-js-click" data-key="refresh" data-content="{{$position->pid}}">刷新</li>
                <li class="mdl-menu__item esh-js-click" data-key="edit" data-content="{{$position->pid}}">编辑</li>
            </ul>
        </div>
        <div class="mdl-card__actions mdl-card--border mdl-typography--text-right">
            <a data-key="delete" class="esh-js-click mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--red" data-content="{{$position->pid}}">
                删除
            </a>
            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--blue" href="/m/position/detail?pid={{$position->pid}}">
                查看
            </a>
        </div>
    </div>
    @empty
        <p class="esh-no-record mdl-color-text--grey esh-padding--x-16-y-10">没有发布职位</p>
    @endforelse
</div>
@stop


@section('esh-js')
    @parent
    <script type="text/javascript">
        (function () {
            var ESHUtils = this.ESHUtils;

            $(function () {

                $(".esh-layout-icon--right").click(function(evt){

                    $.ajax({
                        url: "/m/position/checkVerification",
                        type: "get",
                        success: function (data) {
                            if (data['status'] === 400) {
                                swal({
                                    title: data['msg'],
                                    cancelButtonText: "关闭",
                                    showCancelButton: true,
                                    showConfirmButton: false
                                })
                            } else if (data['is_verify']) {
                                self.location = "/m/position/publish";
                            } else {
                                swal({
                                    // type: "error",
                                    title: "您的企业还未通过验证",
                                    text: "企业通过验证后，才可发布职位！",
                                    cancelButtonText: "关闭",
                                    showCancelButton: true,
                                    showConfirmButton: false
                                })
                            }
                        }
                    })

                    return ESHUtils.stopEvent(evt);
                });

                $('.esh-publish').on('click','.esh-js-click',function (evt) {
                    var id, key, $this = $(this), formData = new FormData();

                    id = $(this).attr("data-content");

                    if (!id) {
                        return ESHUtils.stopEvent(evt);
                    }

                    key = $this.data('key');

                    switch (key) {
                        case 'delete':
                            swal({
                                title: "确认",
                                text: "确定删除该职位吗？",
                                confirmButtonText: "确定",
                                cancelButtonText: "取消",
                                showCancelButton: true,
                                closeOnConfirm: false
                            }, function () {
                                return $.ajax({
                                    url: "/m/position/publishList/delete?pid=" + id,
                                    type: "get",
                                    dataType:'json',
                                    success: function (data) {
                                        if (data['status'] === 200) {
                                            swal({
                                                title:'提示',
                                                text: "删除成功！",
                                                confirmButtonText: "确定"
                                            },function () {
                                                self.location = "/m/position/publishList";
                                            });
                                        } else if (data['status'] === 400) {
                                            swal({
                                                title: "提示",
                                                text: '删除失败！',
                                                confirmButtonText: "确定"
                                            });
                                        }
                                    }
                                })
                            });
                            break;

                        case 'online':
                            swal({
                                title: "确认",
                                text: "确定重新上线该职位？",
                                confirmButtonText: "确定",
                                cancelButtonText: "取消",
                                showCancelButton: true,
                                closeOnConfirm: false
                            }, function () {
                                $.ajax({
                                    url: "/m/position/publishList/online?pid=" + id,
                                    type: "get",
                                    dataType: 'json',
                                    success: function (data) {
                                        if (data['status'] === 200) {
                                            swal({
                                                title:'提示',
                                                text: "上线成功！",
                                                confirmButtonText: "确定"
                                            },function () {
                                                self.location = "/m/position/publishList";
                                            });

                                        } else if (data['status'] === 400) {
                                            swal({
                                                title: "提示",
                                                text: "上线失败，请重试！",
                                                confirmButtonText: "确定"
                                            });
                                        }
                                    }
                                })
                            });
                            break;

                        case 'offline':
                            swal({
                                title: "确认",
                                text: "确定下架该职位，职位将不会再收到投递？",
                                confirmButtonText: "确定",
                                cancelButtonText: "取消",
                                showCancelButton: true,
                                closeOnConfirm: false
                            }, function () {
                                $.ajax({
                                    url: "/m/position/publishList/offline?pid=" + id,
                                    type: "get",
                                    dataType:'json',
                                    success: function (data) {
                                        if (data['status'] === 200) {
                                            swal({
                                                title:'提示',
                                                text: "下架成功！",
                                                confirmButtonText: "确定"
                                            },function () {
                                                self.location = "/m/position/publishList";
                                            });
                                        } else if (data['status'] === 400) {
                                            swal({
                                                title: "提示",
                                                text: "下架失败，请重试！",
                                                confirmButtonText: "确定"
                                            });
                                        }
                                    }
                                })
                            });
                            break;

                        case 'refresh':
                            formData.append("pid", id);

                            swal({
                                title: "确认",
                                text: "确定刷新该职位，职位将重新发布？",
                                confirmButtonText: "确定",
                                cancelButtonText: "取消",
                                showCancelButton: true,
                                closeOnConfirm: false
                            }, function () {
                                $.ajax({
                                    url: "/position/publishList/refresh",
                                    type: "post",
                                    dataType: 'json',
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    data: formData,
                                    success: function (data) {

                                        if (data.status === 200) {
                                            swal({
                                                title:'提示',
                                                text: "刷新成功！",
                                                confirmButtonText: "确定"
                                            },function () {
                                                self.location = "/m/position/publishList";
                                            });
                                        } else if (data.status === 400) {
                                            swal({
                                                title: "提示",
                                                text: "刷新失败，请重试！",
                                                confirmButtonText: "确定"
                                            });
                                        }
                                    }
                                })
                            });
                            break;

                        case 'edit':
                            self.location = '/m/position/publishList/edit?pid=' + id;
                            break;
                        default:
                            break;
                    }

                    return ESHUtils.stopEvent(evt);
                });

            });
        })();
    </script>
@stop