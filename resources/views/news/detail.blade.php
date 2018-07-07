@extends('layout.master')
@section('title', $data['news']->title)

@section('custom-style')
 <link media="all" href="{{asset('../style/news.css')}}" type="text/css" rel="stylesheet">
    <style>
        .mdl-card__supporting-text{
            /*width: 97% !important;*/
        }
        .containter{
            /*width: 1000px;*/
            margin-top: 20px;
        }
        .news-image img{
            max-width:100%;
            height: auto;
        }
        .comment-content span{
            float: right;
            font-size: 0.9rem;
        }
        .comment-content p{
            display: inline-block;
        }
        .floatRight{
            width: 20%;
            margin-right: 6%;
            float: right;
        }
        .floatLeft{
            width: 65%;
            margin-left: 6%;
            float: left;
        }
        .module_title{
            display: block;
            margin-top: 20px;
        }
        .module_title h2 p.chinese {
            font-size: 24px;
            color: #474747;
            line-height: 30px;
        }
        .module_title h2 p.english {
            font-size: 12px;
            color: #aeaead;
            line-height: 20px;
            margin-bottom: 10px;
            font-weight: normal;
        }
        .module_title h2 span.mark_line {
            display: block;
            width: 35px;
            height: 2px;
            background: #474747;
        }
        .Hot_news_list {
            margin-top: 34px;
        }
        .Hot_news_list li {
            line-height: 20px;
            height: 20px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
            margin-bottom: 24px;
        }
        .Hot_news_list li i.first {
            background: #D32F2F;
            color: #fff;
        }
        .Hot_news_list li i.secend {
            background: #f0ad4e;
            color: #fff;
        }
        .Hot_news_list li i.thrid {
            background: #474747;
            color: #fff;
        }
        .Hot_news_list li i {
            display: block;
            width: 20px;
            height: 20px;
            background: #f3f3f3;
            color: #b1b1b1;
            text-align: center;
            float: left;
            margin-right: 15px;
            font-style: normal;
        }
        .Hot_news_list li a:hover {
            color: #D32F2F;;
        }
        .recently li a {
            margin-left: 5px;
        }
        .love-lable{
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
            margin-left: 1rem;
            width: 6.5rem;
            height: 2.5rem;
            float: right;
            cursor:pointer
        }
        .love-lable:hover{
            color: #f4d03e;
        }
        .love-lable span{
            padding: 0.5rem 0.5rem;
            display: flex;
        }
        /*.news-list{*/
            /*padding: 5px 8px 15px 8px;*/
            /*border-top: 2px solid #ff5454;*/
        /*}*/
        /*.news-list dd{*/
            /*height: 20px;*/
            /*line-height: 20px;*/
            /*margin-top: 10px;*/
            /*color: #fff;*/
            /*cursor: pointer;*/
            /*position: relative;*/
        /*}*/
        /*.news-list dd:hover{*/
            /*background-color: #ff5454;*/
        /*}*/
        /*.news-list dd a:hover{*/
            /*color: #ffffff;*/
        /*}*/
        /*.news-list dd::before{*/
            /*content: " ";*/
            /*width: 2px;*/
            /*height: 12px;*/
            /*background: #ff5454;*/
            /*position: absolute;*/
            /*left: 0;*/
            /*top: 4px;*/
        /*}*/
        /*.news-list dd a{*/
            /*display: inline-block;*/
            /*height: 20px;*/
            /*line-height: 20px;*/
            /*margin-left: 10px;*/
            /*color: #707c87;*/
            /*max-width: 285px;*/
            /*overflow: hidden;*/
            /*text-overflow: ellipsis;*/
            /*white-space: nowrap;*/
        /*}*/

    </style>
@endsection

@section('header-nav')
    @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')
<div class="containter floatLeft">
                <div class="info-panel">
                    <div class="mdl-card mdl-shadow--2dp info-card news-detail">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text" data-content="{{$data['news']->nid}}">
                                {{$data['news']->title}}
                            </h5>
                            <div class="love-lable">
                                <span>
                                    @if($data['isfavorite'] == 0)
                                        <i class="material-icons">star_outline</i>收藏
                                    @else
                                        <i class="material-icons collect-star">star</i>已收藏
                                    @endif
                                </span>
                            </div>
                        </div>
    
                        <div class="mdl-card__actions mdl-card--border base-info--panel">
                            
                            <label><span>责任编辑: {{$data['news']->subtitle or 'admin'}}</span></label>
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
                                        <div class="comment-content">
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
                                            <span>{{$comment->created_at}}</span>
                                                <p><b>{{$comment->username}}: </b></p>
                                                <p>{{$comment->content}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            
                        </div>
                    </div>
                </div>
    </div>
    <div class="containter floatRight">
        <div class="module_title">
            <h2>
                <p class="chinese">热门资讯</p>
                <p class="english">HOT NEWS</p>
                <span class="mark_line"></span>
            </h2>
        </div>
        <div class="Hot_news_list">
            <ul>
                <?php $i=1;?>
                @foreach($data['hottest'] as $item)
                    <li>
                        <i
                                @if($i ==1 )
                                    class="first"
                                @elseif($i ==2 )
                                    class="secend"
                                @elseif($i ==3 )
                                    class="thrid"
                                @endif
                        >{{$i++}}</i>
                        <a href="/news/detail?nid={{$item->nid}}">{{$item->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="module_title">
            <h2>
                <p class="chinese">最新资讯</p>
                <p class="english">RECENTLY NEWS</p>
                <span class="mark_line"></span>
            </h2>
        </div>
        <div class="Hot_news_list recently">
            <ul>
                @foreach($data['newest'] as $item)
                    <li>
                        @if($item->type ==1)
                            <span class="label label-warning">综合</span>
                        @elseif($item->type ==2)
                            <span class="label label-info">趣闻</span>
                        @elseif($item->type ==3)
                            <span class="label label-default">赛事</span>
                        @elseif($item->type ==4)
                            <span class="label label-success">游戏</span>
                        @elseif($item->type ==5)
                            <span class="label label-primary">职场</span>
                        @endif
                        <a href="/news/detail?nid={{$item->nid}}" >{{$item->title}}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
    {{--<div class="containter floatRight">--}}
        {{--<div class="info-panel">--}}
            {{--<div class="mdl-card mdl-shadow--2dp info-card news-detail">--}}
                {{--<div class="mdl-card__title">--}}
                    {{--<h5 class="mdl-card__title-text">--}}
                        {{--最新 最热--}}
                    {{--</h5>--}}
                {{--</div>--}}
                    {{--<dl class="news-list">--}}
                        {{--@foreach($data['newest'] as $item)--}}
                            {{--<dd>--}}
                                {{--<a href="/news/detail?nid={{$item->nid}}" title="{{$item->title}}">{{$item->title}}</a>--}}
                            {{--</dd>--}}
                        {{--@endforeach--}}
                    {{--</dl>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
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
        $(".love-lable").click(function () {
            var nid = $(".mdl-card__title-text").attr("data-content");
            var formData = new FormData();
            formData.append('nid', nid);
            $.ajax({
                url: "/collection/news",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    console.log(result.status);
                    if(result.status === 200){
                        var job_collection = $('.love-lable ');
                        var start = $('.love-lable .material-icons ');
                        if(start.hasClass('collect-star')){
                            start.removeClass('collect-star');
                            job_collection.html(job_collection.html().replace("已收藏","收藏"));
                        }else{
                            start.addClass('collect-star');
                            job_collection.html(job_collection.html().replace("收藏","已收藏"));
                        }
//                        window.location.reload();
                    }else{
                        swal("",result.msg,"error");
                        return;
                    }
                }
            })
        });
    </script>
@endsection
