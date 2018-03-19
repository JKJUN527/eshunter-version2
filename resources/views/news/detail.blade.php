@extends('layout.master')
@section('title', '新闻详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/news.css')}}" type="text/css" rel="stylesheet">
    <style>
        .mdl-card__supporting-text{
            /*width: 97% !important;*/
        }
        .containter{
            width: 1000px;
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')
<div class="containter" style="margin-top: 20px;">
                <div class="info-panel">
                    <div class="mdl-card mdl-shadow--2dp info-card news-detail">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text" data-content="{{$data['news']->nid}}">
                                {{$data['news']->title}}
                            </h5>
                        </div>
    
                        <div class="mdl-card__actions mdl-card--border base-info--panel">
                            
                            <label><span>责任编辑: {{$news->subtitle}}</span></label>
                            <label><span>发布时间: {{mb_substr($data['news']->created_at,0,10,'utf-8')}}</span></label>
                            {{--<label><i class="material-icons">visibility</i><span>{{$data['news']->view_count}}</span></label>--}}
                            <label><i class="material-icons">comment</i> <span>{{sizeof($data['review'])}}</span></label>
                        </div>
    
                        <div class="mdl-card__supporting-text">

                        </div>
                    </div>
                </div>
                <div class="info-panel">
                    <div class="comment-panel">
                        <div class="mdl-card info-card comment-card">
                            <form id="comment-form" method="post">
                                <input type="hidden" name="nid" value="{{$data['news']->nid}}">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control" name="content"
                                                  id="additional-content"
                                                  placeholder="写点什么..."></textarea>
                                    </div>
                                    <div class="help-info" id="comment-help">还可输入114字</div>
                                    <label class="error" for="additional-content"></label>
                                </div>
    
                                <button id="btn-comment" type="submit"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky" data-upgraded=",MaterialButton,MaterialRipple">
                                    评论
                                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                            </form>
                        </div>
    
                        <h6>评论列表</h6>
    
                        <div class="mdl-card__actions mdl-card--border comment-list--panel">

                            @if(sizeof($data['review']) === 0)
                                <p>暂无评论</p>
                            @else
                                @foreach($data['review'] as $comment)
                                    <div class="comment-item">
                                        @if($comment->photo == null || $comment->photo == "")
                                            <img src="{{asset('images/default-img.png')}}" class="head-img" width="48"
                                                 height="48"/>
                                        @else
                                            @if($comment->type == 1)
                                                <img src="{{$comment->photo}}" class="head-img" width="48" height="48"/>
                                            @else
                                                <img src="{{$comment->elogo}}" class="head-img" width="48" height="48"/>
                                            @endif
                                        @endif

                                        <div class="comment-content">
                                            <p><b>{{$comment->username}}: </b>&nbsp;&nbsp;{{$comment->content}}</p>
                                            <span>{{$comment->created_at}}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                        </div>
                    </div>
                </div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection

@section('custom-script')
    <script>
        $(document).ready(function () {

            var nid = $(".mdl-card__title-text").attr("data-content");

            $.ajax({
                url: "/news/content?nid=" + nid,
                type: "get",
                success: function (data) {
                    var content = data['news']['content'];
                    var images = data['news']['picture'];
                    var imageTemp = images.split(";");
                    var imagesArray = [];

                    for (var i in imageTemp) {
                        imagesArray[i + ''] = imageTemp[i + ''].split("@");
                    }

                    var baseUrl = imagesArray[0][0].substring(0, imagesArray[0][0].length - 1);
                    imagesArray[0][0] = imagesArray[0][0].replace(baseUrl, '');

//                    console.log(imagesArray);
//                    console.log(baseUrl);
//                    console.log();

                    for (var j = 0; j < imagesArray.length; j++) {
                        content = content.replace("[图片" + imagesArray[j][0] + "]", "<div class='news-image'><img src='" + baseUrl + imagesArray[j][1] + "'/></div>");
                    }

                    $(".mdl-card__supporting-text").html(content);
                }
            })
        });
        var maxSize = 114;

        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $('textarea').keyup(function () {

            var length = $(this).val().length;
            if (length > maxSize) {
                $(".error[for='additional-content']").html("内容超过114字");
                $("#btn-comment").prop("disabled", true);
            } else {
                $(".error[for='additional-content']").html("");
                $("#btn-comment").prop("disabled", false);
            }

            $("#comment-help").html("还可输入" + (maxSize - length < 0 ? 0 : maxSize - length) + "字");

        });

        $commentForm = $("#comment-form");

        $("button[type='submit']").click(function (event) {
            event.preventDefault();
            var $commentContent = $("#additional-content").val();

            if ($commentContent.length === 0) {
                $(".error[for='additional-content']").html("内容不能为空");
                $("#btn-comment").prop("disabled", true);
                return;
            }

            if ($commentContent.length > maxSize) {
                $(".error[for='additional-content']").html("内容超过" + maxSize + "字");
                $("#btn-comment").prop("disabled", true);
                return;
            }

            var formData = new FormData();
            formData.append("nid", $("input[name='nid']").val());
            formData.append("content", $commentContent);

            $.ajax({
                url: "/news/addReview",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    checkResult(result.status, "评论成功", result.msg, null);
                }
            })

        })
    </script>
@endsection
