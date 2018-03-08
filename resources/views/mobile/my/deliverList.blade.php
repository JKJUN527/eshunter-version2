@extends('mobile.layout.master')


@section('title', '收到的申请记录')

@section('esh-header')
    @include('mobile.components.header',['title'=>'收到的申请记录','buttonLeft'=>true,'buttonRight'=>'delete_sweep'])
@stop

@section('esh-content')
    <div class="esh-deliver-list esh-padding--x-16-y-10">
        @forelse($data['deliverAll'] as $item)
            <div class="mdl-card mdl-shadow--2dp esh-width--1-1">
                <div class="mdl-card__title">
                    <img src="{{empty($item->photo) ? asset('images/default-img.png') : $item->photo}}" class="esh-account-img" id="upload-head--img"/>
                    <div class="mdl-card__supporting-text">
                        <div class="esh-text-block--ellipsis mdl-typography--body-2">{{$item->pname}}</div>
                        <div>{{$item->position_title}}</div>
                        <div>
                            <span>{{$item->created_at}}</span>
                            <div class="esh-deliver-status">
                                @if($item->status == 0)
                                    <span class="normal-info">待查看</span>
                                @elseif($item->status == 1)
                                    <span class="normal-info">已查看</span>
                                @elseif($item->status == 2)
                                    <span class="success-info">已录用</span>
                                @elseif($item->status == 3)
                                    <span class="danger-info">未录用</span>
                                @elseif($item->status == 4)
                                    <span class="danger-info">职位已下架</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mdl-card__actions mdl-card--border mdl-typography--text-right">
                    <a data-content="{{$item->did}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--red esh-del-deliver">
                        删除
                    </a>
                    <a href="/m/position/deliverDetail?did={{$item->did}}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-color-text--blue">
                        查看简历
                    </a>
                </div>
            </div>
        @empty
            <p class="esh-no-record mdl-color-text--grey esh-padding--x-16-y-10">没有申请记录</p>
        @endforelse
    </div>
@stop

@section('esh-js')
    @parent
    <script type="text/javascript">
        (function () {
            var ESHUtils = this.ESHUtils;

            $(function () {
                $(".esh-layout-icon--right").click(function (evt) {
                    swal({
                        title: "确认",
                        text: "确定删除所有投递记录吗？",
                        confirmButtonText: "确定",
                        cancelButtonText: "取消",
                        showCancelButton: true,
                        closeOnConfirm: false
                    }, function () {
                        $.ajax({
                            url: "/m/position/deldeliverRecord?did=-1",
                            type: "get",
                            dataType: 'json',
                            success: function (data) {
                                if (data['status'] === 200) {
                                    swal({
                                        title:'提示',
                                        text: "删除成功！",
                                        confirmButtonText: "确定"
                                    },function () {
                                        self.location = "/m/position/deliverList";
                                    });

                                } else if (data['status'] === 400) {
                                    swal({
                                        title: "提示",
                                        text: data['msg'],
                                        confirmButtonText: "确定"
                                    });
                                }
                            }
                        });
                    });

                    return ESHUtils.stopEvent(evt);
                });

                $(".esh-del-deliver").click(function (evt) {
                    var did = $(this).attr("data-content");

                    if(!did){
                        return ESHUtils.stopEvent(evt);
                    }

                    swal({
                        title: "确认",
                        text: "确定删除该条投递记录吗？",
                        confirmButtonText: "确定",
                        cancelButtonText: "取消",
                        showCancelButton: true,
                        closeOnConfirm: false
                    }, function () {

                        $.ajax({
                            url: "/m/position/deldeliverRecord?did=" + did,
                            type: "get",
                            dataType:'json',
                            success: function (data) {
                                if (data['status'] === 200) {
                                    swal({
                                        title:'提示',
                                        text: "删除成功！",
                                        confirmButtonText: "确定"
                                    },function () {
                                        self.location = "/m/position/deliverList";
                                    });
                                } else if (data['status'] === 400) {
                                    swal({
                                        title: "提示",
                                        text: data['msg'],
                                        confirmButtonText: "确定"
                                    });
                                }
                            }
                        })
                    });
                });
            });
        })();
    </script>
@stop