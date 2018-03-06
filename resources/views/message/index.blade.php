@extends('layout.master')
@section('title', '消息通知')

@section('custom-style')
 <link media="all" href="{{asset('../style/msgDetail.css')}}" type="text/css" rel="stylesheet">
    <style>
        .unread{
            color: yellowgreen;
        }
    </style>
@endsection

@section('content')
<div id="messageContainer" class="container cleafix">
    <div class="content-left">
        <div class="left-wrap">
            <div class="setting-box">
                <h2 class="main-title">我的消息</h2>
                <div class="setting-btn" style="display: none;">
                    <a href="#" data-lg-tj-id="1810" >设置</a>
                </div>
            </div>
            <div class="twrap">
                <div class="tab-content" id="msgContent">
                    <div class="t-content-item t-content-item_3 company-chalk" style="display: block;">
                        <div class="chalk-wrap clearfix">
                            <div class="left chalk-company-list">
                                <div class="mdl-card mdl-shadow--2dp info-card">
                                    <div class="mdl-card__title clearfix">
                                    <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list left"  title="">
                                        <i class="material-icons">email</i>
                                    </button>
                                        <span class="mdl-card__menu right">
                                            <button class="mdl-button mdl-button--icon mdl-js-button" id="delete-all--selected_message" title="删除">
                                                <i class="material-icons">delete_sweep</i></button>
                                            <button class="mdl-button mdl-button--icon mdl-js-button" id="read-all--message" title="标为已读">
                                                <i class="material-icons">done_all</i></button>
                                            <button class="mdl-button mdl-button--icon mdl-js-button" id="select-all--message" title="全选">
                                                <i class="material-icons">select_all</i></button>
                                        </span>
                                    </div>
                                    <div class="mdl-card__actions mdl-card--border message-panel">
                                        <div class="message-list">
                                            <ul>
                                                @forelse($data['listMessages'] as $message)
                                                <li>
                                                    <div class="pic">
                                                        <a href="" class="img-a">
                                                            @if(isset($data['user'][$message->from_id]->elogo))
                                                                <img src="{{$data['user'][$message->from_id]->elogo}}">
                                                            @elseif(isset($data['user'][$message->from_id]->photo))
                                                                <img src="{{$data['user'][$message->from_id]->photo}}">
                                                            @else
                                                                <img src="{{asset('images/avatar.png')}}">
                                                            @endif
                                                        </a>
                                                        <div class="title @if($message->is_read == 0) unread @endif"
                                                             @if($message->from_id == $data["uid"])
                                                                data-content="{{$message->to_id}}"
                                                             @else
                                                                data-content="{{$message->from_id}}"
                                                             @endif
                                                        >
                                                            <div class="sender">
                                                                <span class="from">
                                                                    @if($message->from_id == $data['uid'])
                                                                        我
                                                                    @else
                                                                        @if(isset($data['user'][$message->from_id]->ename))
                                                                            {{$data['user'][$message->from_id]->ename}}
                                                                        @else
                                                                            {{$data['user'][$message->from_id]->username}}
                                                                        @endif
                                                                    @endif
                                                                </span>
                                                                <span class="select right">
                                                                    <input type="checkbox" name="msg" data-content="{{$message->mid}}" class="chk-col-teal"></span>
                                                                {{--<span class="operations right" ><a>删除</a>--}}
                                                                {{--</span>--}}
                                                            </div>
                                                            <p>
                                                                <span class="text">{{mb_substr($message->content, 0, 15)}}</span>
                                                                <span class="time right">{{$message->created_at}}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="right chalk-detail">
                                <p class="chalk-content-title">北京舒福乐科技有限公司</p>
                                <div class="chalk-content">
                                    <ul>
                                        <li class="company">
                                            <p class="time">2018-03-02 09:52:41</p>
                                            <div class="text">
                                                <span class="touxiang"><img src="http://eshunter.com/images/avatar.png" alt=""></span>
                                                <p class="chalk-detail-span">恭喜你!你已经被我们录取了！请尽快与我们取得联系,电话:18612363454邮箱:sunze@leidata.com</p></div>
                                        </li>
                                        <li class="me">
                                            <p class="time">2018-03-02 09:52:41</p>
                                            <div class="text">
                                                <span class="touxiang"><img src="http://eshunter.com/images/avatar.png" alt=""></span>
                                                <p class="chalk-detail-span">谢谢，期待合作愉快！</p>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                                <div class="chalk-bottom">
                                    <textarea row="3" class="input-msg"></textarea>
                                    <a class="btn send right">发送</a>
                                </div>
                            </div>

                            <div class="item_con_pager"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
<script type="text/javascript">
        $checkedAll = false;
        $messageList = $(".message-list");

        $messageList.find("input[type='checkbox']").click(function () {
            $item = $(this.parentNode.parentNode);
            if ($item.hasClass('checked')) {
                $item.removeClass('checked');
            } else {
                $item.addClass('checked');
            }
        });

        $messageList.find(".from").click(function () {
            self.location = "/message/detail?id=" + $(this).attr('data-content');
        });

        $("#select-all--message").click(function () {
            $items = $(".message-list").find("li");
            if ($checkedAll) {
                $checkedAll = false;
                $items.removeClass("checked");
                $(".message-list").find("input[type='checkbox']").prop("checked", false);
                $("div[data-mdl-for='select-all--message']").html("选择所有");
            } else {
                $checkedAll = true;
                $items.addClass("checked");
                $(".message-list").find("input[type='checkbox']").prop("checked", true);
                $("div[data-mdl-for='select-all--message']").html("取消所有");
            }
        });

        $("#delete-all--selected_message").click(function () {
            var $selected = getSelected();

            if ($selected.length === 0) {
                swal("未选择任何消息，请先选择要删除的消息");
                return;
            }

            var dataForm = new FormData();
            dataForm.append("mid", $selected);

            swal({
                title: "确认",
                text: "确定删除该条消息吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/message/delete",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: dataForm,
                    success: function (data) {
                        var result = JSON.parse(data);
                        swal(result.status === 200 ? "删除成功" : "删除失败");

                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal(xhr.status + "：" + thrownError);
                        //checkResult(400, "", xhr.status + "：" + thrownError, null);
                    }
                })
            });
        });

        $("#read-all--message").click(function () {

            var $selected = getSelected();

            if ($selected.length === 0) {
                swal("未选择任何消息，请先选择要标记为已读的消息");
                return;
            }

            var dataForm = new FormData();
            dataForm.append("mid", $selected);

            $.ajax({
                url: "/message/read",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: dataForm,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, result.msg, "", null);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    checkResult(400, "", xhr.status + "：" + thrownError, null);
                }
            })

        });

        function getSelected() {
            return $("input[name='msg']:checked").map(function () {
                return $(this).attr('data-content');
            }).get();
        }
        //    $(document).ready(function(){
        //
        //        $(".item_1").click(function(){
        //            $(".item_1").addClass("active")
        //            $(".item_2").removeClass("active")
        //            $(".item_3").removeClass("active")
        //            $(".item_4").removeClass("active")
        //            $(".t-content-item_1").show();
        //            $(".t-content-item_2").hide();
        //            $(".t-content-item_3").hide();
        //            $(".t-content-item_4").hide();
        //        })
        //        $(".item_2").click(function(){
        //            $(".item_1").removeClass("active")
        //            $(".item_2").addClass("active")
        //            $(".item_3").removeClass("active")
        //            $(".item_4").removeClass("active")
        //            $(".t-content-item_1").hide();
        //            $(".t-content-item_2").show();
        //            $(".t-content-item_3").hide();
        //            $(".t-content-item_4").hide();
        //        })
        //        $(".item_3").click(function(){
        //            $(".item_1").removeClass("active")
        //            $(".item_2").removeClass("active")
        //            $(".item_3").addClass("active")
        //            $(".item_4").removeClass("active")
        //            $(".t-content-item_1").hide();
        //            $(".t-content-item_2").hide();
        //            $(".t-content-item_3").show();
        //            $(".t-content-item_4").hide();
        //        })
        //        $(".item_4").click(function(){
        //            $(".item_1").removeClass("active")
        //            $(".item_2").removeClass("active")
        //            $(".item_3").removeClass("active")
        //            $(".item_4").addClass("active")
        //            $(".t-content-item_1").hide();
        //            $(".t-content-item_2").hide();
        //            $(".t-content-item_3").hide();
        //            $(".t-content-item_4").show();
        //        })
        //    })
</script>
@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('footer')
   @include('components.myfooter')
@endsection