@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['title'=> '资讯详情','buttonLeft'=>true])
@stop

@section('esh-content')
    <div class="esh-news-detail-container">
        <div class="mdl-card mdl-shadow--2dp esh-info-card esh-news-detail">
            <!--title-->
            <div class="mdl-card__title ">
                <h5 class="mdl-card__title-text esh-news-title" data-content="{{$data['news']->nid}}">
                    {{$data['news']->title}}
                </h5>
            </div>
            <!--panel-->
            <div class="mdl-card__actions mdl-card--border base-info--panel">
                <label><span>新闻来源: {{$data['news']->quote}}</span></label>
                <label><span>发布时间: {{mb_substr($data['news']->created_at,0,10,'utf-8')}}</span></label>
                <label><i class="material-icons">comment</i> <span>{{sizeof($data['review'])}}</span></label>
            </div>
            <!--content-->
            <div class="mdl-card__supporting-text ">

            </div>

        </div>

        <div  class="esh-news-edit-name">
            <label><span>责任编辑: admin</span></label>
        </div>

        <div class="esh-comment-panel">
            <div class="mdl-card esh-info-card esh-comment-card">
                <form id="comment-form" method="post">
                    <input type="hidden" name="nid" value="{{$data['news']->nid}}"/>
                    <div class="esh-form-group clearfix">
                        <div class="form-line">
                                    <textarea rows="4" class="esh-news-textarea esh-news-detail-form-control" name="content"
                                              id="additional-content"
                                              placeholder="说点什么..."></textarea>
                        </div>
                        <div class="esh-help-info" id="comment-help">还可输入114字</div>
                        <label class="error" for="additional-content"></label>
                    </div>

                    <button id="btn-comment" type="submit"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">
                        评论
                    </button>
                </form>

            </div>

            <h5>评论列表</h5>

            <div class="mdl-card__actions mdl-card--border comment-list--panel">

                @if(sizeof($data['review']) === 0)
                    <p>暂无评论</p>
                @else
                    @foreach($data['review'] as $comment)
                        <div class="esh-comment-item">
                            @if($comment->photo == null || $comment->photo == "")
                                <img src="{{asset('images/default-img.png')}}" class="esh-head-img" width="48"
                                     height="48"/>
                            @else
                                @if($comment->type == 1)
                                    <img src="{{$comment->photo}}" class="esh-head-img" width="48" height="48"/>
                                @else
                                    <img src="{{$comment->elogo}}" class="esh-head-img" width="48" height="48"/>
                                @endif
                            @endif

                            <div class="esh-comment-content">
                                <p><b>{{$comment->username}}: </b>&nbsp;&nbsp;{{$comment->content}}</p>
                                <span>{{$comment->created_at}}</span>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>

        </div>
    </div>
@stop

@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/information/infoDetail.js')}}"></script>
@stop

