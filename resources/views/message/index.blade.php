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
                                                        <div class="title @if($message->is_read == 0) unread @endif">
                                                            <div class="sender">
                                                                <span class="from"
                                                                      @if($message->from_id == $data["uid"])
                                                                        data-content="{{$message->to_id}}"
                                                                      @else
                                                                        data-content="{{$message->from_id}}"
                                                                      @endif
                                                                >
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
                                <p class="chalk-content-title">对话详情</p>
                                <div class="chalk-content">
                                    <ul id="talk_list">
                                    </ul>
                                </div>
                                <div class="chalk-bottom" style="display: none">
                                    <textarea row="3" class="input-msg" data-content=""></textarea>
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
        var my_img_url = "";
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
//            self.location = "/message/detail?id=" + $(this).attr('data-content');
            //查找对应的对话信息
            var message_id = $(this).attr('data-content');
            var formData = new FormData();
            formData.append('id', message_id);
            $.ajax({
                url: "/message/detail",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    var my_info = result.userinfo[result.to_id];
                    var from_id = result.id;//对方id
                    var from_type = result.from_type;
                    var img_url = "";
                    var talk_title = $(".chalk-content-title");
                    var talk_list = $("#talk_list");
                    var input_msg = $(".input-msg");

                    console.log(result);
                    //设置对话标题,及对方的头像
                    if(from_type === 1){
                        talk_title.html(result.userinfo[from_id]['username']);
                        img_url = result.userinfo[from_id]['photo'];
                    } else if (from_type === 2){
                        talk_title.html(result.userinfo[from_id]['ename']);
                        img_url = result.userinfo[from_id]['elogo'];
                    } else{
                        talk_title.html(result.userinfo[from_id]);
                        img_url = "{{asset('images/avatar.png')}}";
                    }
                    //设置自己的头像
                    if(result.type === 1){
                        my_img_url = my_info['photo'];
                    } else if (result.type === 2){
                        my_img_url = my_info['elogo'];
                    } else{
                        my_img_url = "{{asset('images/avatar.png')}}";
                    }

                    //设置对话内容
                    var list_html = "";
                    for (temp in result.message){
                        if(result.message[temp].from_id == from_id){//对方发的消息
                            list_html += "<li class='company'><p class='time'>"+result.message[temp].created_at +"</p>"+
                                            "<div class='text'><span class='touxiang'><img src='"+ img_url + "'></span>"+
                                            "<p class='chalk-detail-span'>"+ result.message[temp].content + "</p></div></li>";
                        }else{//我发的消息
                            list_html += "<li class='me'><p class='time'>"+result.message[temp].created_at +"</p>"+
                                    "<div class='text'><span class='touxiang'><img src='"+ my_img_url + "'></span>"+
                                    "<p class='chalk-detail-span'>"+ result.message[temp].content + "</p></div></li>";
                        }
                    }
                    talk_list.html(list_html);
                    //设置发送框的id为对方uid
                    input_msg.attr('data-content',from_id);
                    input_msg.parent().show();
                    {{--<li class="me">--}}
                            {{--<p class="time">2018-03-02 09:52:41</p>--}}
                    {{--<div class="text">--}}
                            {{--<span class="touxiang"><img src="http://eshunter.com/images/avatar.png" alt=""></span>--}}
                            {{--<p class="chalk-detail-span">谢谢，期待合作愉快！</p>--}}
                    {{--</div>--}}
                    {{--</li>--}}


//                    setTimeout(function () {
//                        location.reload()
//                    }, 1000);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal(xhr.status + "：" + thrownError);
                    //checkResult(400, "", xhr.status + "：" + thrownError, null);
                }
            })
        });
        $(".send").click(function () {
            var input_msg = $(".input-msg");
            var to_id = input_msg.attr('data-content');
            if(to_id === "" || to_id===null){
                swal("","发送失败-未知的对话用户","error");
                return;
            }
            if(input_msg.val().length === 0){
                swal("","发送内容不能为空","error");
                return;
            }

            if(input_msg.val().length > 140){
                swal("","站内信长度不能大于140字，当前字数："+input_msg.val().length,"error");
                return;
            }
            var formData = new FormData();
            formData.append('to_id', to_id);
            formData.append('content', input_msg.val());

            $.ajax({
                url: "/message/sendMessage",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.status === 200){
                        //处理新增对话消息
                        var myDate = new Date();//获取系统当前时间
                        var talk_list = $("#talk_list");
                        var list_html = talk_list.html();
                        list_html = "<li class='me'><p class='time'>"+ myDate.toLocaleString( ) +"</p>"+
                                "<div class='text'><span class='touxiang'><img src='"+ my_img_url + "'></span>"+
                                "<p class='chalk-detail-span'>"+ input_msg.val() + "</p></div></li>"+
                                list_html;

                        talk_list.html(list_html);
                    }else{
                        swal("",result.msg,"error");
                        return;
                    }

                }
            })

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
            var selected = getSelected();
            console.log(selected);

            if (selected.length === 0) {
                swal("未选择任何消息，请先选择要删除的消息");
                return;
            }

            var dataForm = new FormData();
            dataForm.append("mid", selected);

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