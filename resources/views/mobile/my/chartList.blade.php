<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/mdl/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/default/styles.css')}}"/>
    <title>对话页面</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">

    <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">navigate_before</i>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button ">
            <span class="mdl-layout__title esh-layout__title esh-chart-title-name">
                 @if(is_array($data['userinfo']) && ($data['userinfo'] == null || $data['userinfo']->ename == ""))
                    未命名
                @elseif(isset($data['userinfo']['ename']))
                    {{$data['userinfo']->ename}}
                @elseif(isset($data['userinfo']['pname']))
                    {{$data['userinfo']->pname}}
                @else
                    系统消息
                @endif
            </span>
            <div class="esh-right-wrapper">
                <!-- Right aligned menu below button -->
                <button id="demo-menu-lower-right"
                        class="mdl-button mdl-js-button mdl-button--icon">
                    <i class="material-icons">more_vert</i>
                </button>

                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    for="demo-menu-lower-right">
                    <li class="mdl-menu__item" id="delete-message"><i class="material-icons esh-vertical--middle">delete_sweep</i>&nbsp;<span class="esh-vertical--middle">删除对话</span></li>
                </ul>
            </div>
        </div>
    </header>
    <main class="mdl-layout__content esh-chart-list" id="esh-content">
        <input type="hidden" name="id" value="{{$data["id"]}}"/>

        <ul class="esh-msg mdl-list esh-media-list esh-chart-list" id="esh-primary-list">
            @foreach($data['message'] as $item)
            <li class="mdl-list__item mdl-list__item--three-line esh-list__item" >

                <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                    <div class="esh-time">
                        <div class="esh-time-content"></div>
                        <span>{{$item->created_at}}</span>
                    </div>
                    <span class="esh-list_item-title">
                        <img class="esh-list__item-image" src="{{asset('images/avatar.png')}}"/>
                        @if($data['id'] == $item->from_id)
                            @if(is_array($data['userinfo']) && ($data['userinfo'] == null || $data['userinfo']->ename == ""))
                                未命名
                            @elseif(isset($data['userinfo']['ename']))
                                {{$data['userinfo']->ename}}
                            @elseif(isset($data['userinfo']['pname']))
                                {{$data['userinfo']->pname}}
                            @else
                                系统消息
                            @endif
                        @else
                            我
                        @endif
                    </span>
                    <span class="mdl-list__item-text-body esh-list__item-text-body">
                        <span class="esh-list__item-text">{{$item->content}}</span>
                         <!--<span class="esh-list__item-text">2017-9-17</span>-->
                    </span>
                </div>
               <!-- <div class="mdl-list__item-secondary-content esh-list__item-secondary-content">
                    <input type="checkbox" />
                </div>-->
            </li>
            @endforeach
        </ul>

    </main>
    <footer class="esh-chartl-footer">
        <form class="esh-edit esh-textarea" method="post" id="response-form">
            <input type="hidden" name="to_id" value="{{$data['id']}}"/>
            <div class="esh-textarea--p">
                <textarea placeholder="写点什么..."
                          id="response-content"></textarea>

            </div>
            <div class="esh-chart-help-info" id="response-help">还可输入114字</div>
            <div class="esh-replay-error" id="esh-replay-error"></div>
            <div class="esh-replay-button">
                <button class="mdl-button mdl-js-button mdl-button--colored mdl-color-text--blue" id="btn-response" type="submit">
                    回复
                </button>
            </div>
        </form>
    </footer>
</div>
<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
<script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('mobile/js/utils/utils.js')}}"></script>
<script>
    var maxSize = 114;
    $("body").addClass("esh-sweetalert");
    $("#delete-message").click(function () {
        swal({
            title: "确认",
            text: "确定删除整个对话吗",
//            type: "info",
            confirmButtonText: "确定",
            cancelButtonText: "取消",
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function () {

            $.ajax({
                url: "/m/message/delDialog?id=" + $("input[name='id']").val(),
                type: "get",
                success: function (data) {
                    swal(data['status'] === 200 ? "删除成功" : "删除失败");

                    if (data['status'] === 200) {
                        setTimeout(function () {
                            self.location = "/m/message";
                        }, 1000);
                    }
                }
            });
        });
    });
    $('textarea').keyup(function () {
        var length = $(this).val().length;
        if (length > maxSize) {
            $("#esh-replay-error").html("内容超过114字");
            $("#btn-response").prop("disabled", true);
        } else {
            $("#esh-replay-error").html("");
            $("#btn-response").prop("disabled", false);
        }
        $("#response-help").html("还可输入" + (maxSize - length < 0 ? 0 : maxSize - length) + "字");

    });
    $responseForm = $("#response-form");

    $("button[type='submit']").click(function (event) {
        event.preventDefault();

        var content = $("#response-content").val();
        var to_id = $("input[name='to_id']").val();

        if (content.length === 0) {
            $("#esh-replay-error").html("内容不能为空");
            $("#btn-response").prop("disabled", true);
            return;
        }

        if (content.length > maxSize) {
            $("#esh-replay-error").html("内容超过" + maxSize + "字");
            $("#btn-response").prop("disabled", true);
            return;
        }

        console.log(to_id);
        console.log(content);

        var formData = new FormData();
        formData.append('to_id', to_id);
        formData.append('content', content);

        $.ajax({
            url: "/m/message/sendMessage",
            type: "post",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.status===200){
                    setTimeout(function () {
                        location.reload()
                    }, 1000);
                }else{
                    swal({
                        title:"提示",
                        text:"标记已读失败"
                    })
                }
            }
        })
    })
</script>
</body>
</html>