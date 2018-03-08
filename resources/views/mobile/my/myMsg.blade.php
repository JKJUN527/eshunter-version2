@extends('mobile.layout.master')


@section('title', '我的消息')

@section('esh-header')
    @include('mobile.components.header',['title'=>'我的消息','buttonLeft'=>true,
    'rightContent'=>'<button id="demo-menu-lower-right"
                            class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">more_vert</i>
                    </button>

                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        for="demo-menu-lower-right">
                        <li class="mdl-menu__item" id="delete-all--selected_message">
                            <i class="material-icons esh-vertical--middle">delete_sweep</i>&nbsp;<span class="esh-vertical--middle">删除</span>
                        </li>
                        <li class="mdl-menu__item" id="read-all--message">
                            <i class="material-icons esh-vertical--middle">done_all</i>&nbsp;<span class="esh-vertical--middle">标为已读</span>
                        </li>
                        <li class="mdl-menu__item" id="select-all--message">
                            <i class="material-icons esh-vertical--middle">select_all</i>&nbsp;<span class="esh-vertical--middle" data-mdl-for="select-all--message">选择所有</span>
                        </li>
                    </ul>'])
@stop

@section('esh-content')
        <ul class="esh-msg mdl-list esh-media-list" id="esh-msg-list">
            {{--unread--}}
            @forelse($data['listMessages'] as $message)
            <li class="mdl-list__item mdl-list__item--three-line esh-list__item {{$message->is_read == 0 ? 'unread' : ''}}"
                data-content="{{$message->from_id == $data["uid"] ? $message->to_id : $message->from_id}}"
            >
                <img class="esh-list__item-image" src="{{asset('mobile/styles/default/images/avatar.png')}}"/>
                <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                    <span class="esh-list_item-title">
                        @if($message->from_id == $data['uid'])
                            我
                        @else
                            @if(isset($data['user'][$message->from_id][0]['ename']))
                                {{$data['user'][$message->from_id][0]->ename}}
                            @else
                                {{$data['user'][$message->from_id][0]->username}}
                            @endif
                        @endif
                    </span>
                    <span class="mdl-list__item-text-body esh-list__item-text-body">
                        <span class="esh-list__item-text">{{mb_substr($message->content, 0, 30)}}</span>
                         <span class="esh-list__item-text">{{$message->created_at}}</span>
                    </span>
                </div>
                <div class="mdl-list__item-secondary-content esh-list__item-secondary-content">
                    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect">
                        <input class="mdl-checkbox__input" type="checkbox" data-content="{{$message->mid}}" name="msg"/>
                    </label>
                </div>
            </li>
            @empty
                <li class="mdl-list__item mdl-list__item--three-line esh-list__item esh-no-msg">
                <span class="mdl-list__item-primary-content esh-list__item-primary-content">
                    暂无消息</span>
                </li>
            @endforelse

        </ul>
@stop

@section('esh-js')
    @parent
<script type="text/javascript">
    (function () {
        $(function () {
           /* if(window.name != "origin"){ //强制刷新
                location.reload();
                window.name = "origin";
            }else{
                window.name = "";
            }*/
            var $checkedAll = false,
                $messageList = $("#esh-msg-list");

            $messageList.find("input[type='checkbox']").click(function () {
                var $item = $(this.parentNode.parentNode);
                if ($item.hasClass('checked')) {
                    $item.removeClass('checked');
                } else {
                    $item.addClass('checked');
                }
            });

            $messageList.find(".esh-list__item-image").click(function () {
                self.location = "/m/message/detail?id=" + $(this).parent().data("content");
            });
            $messageList.find(".esh-list__item-primary-content").click(function () {
                self.location = "/m/message/detail?id=" + $(this).parent().data("content");
            });

            $("#select-all--message").click(function () { //全选
                var $items = $("#esh-msg-list").find("li");
                if ($checkedAll) {
                    $checkedAll = false;
                    $items.removeClass("checked");
                    $("#esh-msg-list").find("input[type='checkbox']").trigger('click');//.prop("checked", false);
                    $("span[data-mdl-for='select-all--message']").html("选择所有");
                } else {
                    $checkedAll = true;
                    $items.addClass("checked");
                    $("#esh-msg-list").find("input[type='checkbox']").trigger('click');//.prop("checked", true);
                    $("span[data-mdl-for='select-all--message']").html("取消所有");
                }
            });

            $("#delete-all--selected_message").click(function () {
                var $selected = getSelected();

                if (!$selected.length) {
                    swal({
                        title:"提示",
                        text:"未选择任何消息，请先选择要删除的消息！",
                        confirmButtonText: "确定"
                    });
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
                        url: "/m/message/read",
                        type: "post",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: dataForm,
                        success: function (data) {
                            var result = JSON.parse(data);
                            if(result.status===200){
                                setTimeout(function () {
                                    location.reload()
                                }, 1000);
                            }else{
                                swal({
                                    title:"提示",
                                    text:"删除失败!",
                                    confirmButtonText: "确定"
                                })
                            }

                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            swal({title:'错误',text:'网络错误，请稍后再试！',confirmButtonText: "确定"});
                        }
                    })
                });
            });

            $("#read-all--message").click(function () {
                var $selected = getSelected();

                if ($selected.length === 0) {
                    swal({
                        title:"提示",
                        text: "未选择任何消息，请先选择要标记为已读的消息",
                        confirmButtonText: "确定"
                    });
                    return;
                }

                var dataForm = new FormData();
                dataForm.append("mid", $selected);

                $.ajax({
                    url: "/m/message/read",
                    type: "post",
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: dataForm,
                    success: function (data) {
                        if(data.status===200){
                            setTimeout(function () {
                                location.reload()
                            }, 1000);
                        }else{
                            swal({
                                title:"提示",
                                text:"标记已读失败!",
                                confirmButtonText: "确定"
                            })
                        }
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal({title:'错误',text:'网络错误，请稍后再试！',confirmButtonText: "确定"});
                    }
                })

            });

            function getSelected() {
                return $("input[name='msg']:checked").map(function () {
                    return $(this).attr('data-content');
                }).get();
            }
        });
    })();
</script>

@stop