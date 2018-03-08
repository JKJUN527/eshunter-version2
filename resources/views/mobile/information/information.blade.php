@extends('mobile.layout.master')

@section('title', '资讯')

@section('esh-header')
    @include('mobile.components.header',['logo'=> true])
@stop

@section('esh-content')
    <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        <div class="mdl-tabs__tab-bar">
            <a @if(isset($data['newtype']) && $data['newtype'] == 1)
               class="mdl-tabs__tab esh-tabs_news___tab is-active"
               @endif
               id="esh-tabs-tab-1" href="#esh-tabs-panel-typography" class="mdl-tabs__tab esh-tabs_news___tab"
               data-content="1">综合</a>
            <a @if(isset($data['newtype']) && $data['newtype'] == 3)
               class="mdl-tabs__tab esh-tabs_news___tab is-active"
               @endif
               id="esh-tabs-tab-3" href="#esh-tabs-panel-tables" class="mdl-tabs__tab esh-tabs_news___tab"
               data-content="3">赛事</a>
            <a @if(isset($data['newtype']) && $data['newtype'] == 4)
               class="mdl-tabs__tab esh-tabs_news___tab is-active"
               @endif
               id="esh-tabs-tab-4" href="#esh-tabs-panel-forms" class="mdl-tabs__tab esh-tabs_news___tab"
               data-content="4">游戏</a>
            <a @if(isset($data['newtype']) && $data['newtype'] == 2)
               class="mdl-tabs__tab esh-tabs_news___tab is-active"
               @endif
               id="esh-tabs-tab-2" href="#esh-tabs-panel-code" class="mdl-tabs__tab esh-tabs_news___tab"
               data-content="2">八卦</a>
            <a @if(isset($data['newtype']) && $data['newtype'] == 5)
               class="mdl-tabs__tab esh-tabs_news___tab is-active"
               @endif
               id="esh-tabs-tab-5" href="#esh-tabs-panel-buttons" class="mdl-tabs__tab esh-tabs_news___tab"
               data-content="5">职场</a>
        </div>
    </div>

    <div class="mdl-tabs__tab-bar esh-tabs__tab-bar-sub">
        <a id="esh-tabs-tab-newest" href="#esh-tabs-panel-new"
           class="mdl-tabs__tab esh-tabs__tab is-active">最新</a>
        <a id="esh-tabs-tab-hottest" href="#esh-tabs-panel-hot" class="mdl-tabs__tab esh-tabs__tab">最热</a>
    </div>
    <!--    your code   -->
    <ul class="mdl-list esh-media-list" id="esh-info-primary-newest">

        @foreach($data['newest'] as $news)

            <li class="mdl-list__item mdl-list__item--three-line esh-list__item esh-list__item--two-line"
                data-content="{{$news->nid}}">
                @if($news->picture != null)
                    <?php
                    $pics = explode(';', $news->picture);
                    $baseurl = explode('@', $pics[0])[0];
                    $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                    $imagepath = explode('@', $pics[0])[1];
                    ?>
                    {{--<img src="{{$news->picture or asset('images/lamian.jpg')}}"/>--}}
                    <img class="esh-list__item-image" src="{{$baseurl}}{{$imagepath}}"/>
                @endif
                <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                    <span class="esh-list_item-title">{{mb_substr($news->title, 0, 30)}}</span>
                    <span class="mdl-list__item-text-body esh-list__item-text-body">
                        <span class="esh-list__item-secondary-info">{{mb_substr($news->created_at,0,10,'utf-8')}}</span>
                    </span>
                </div>
            </li>

        @endforeach

        <li class="esh-list__item esh-list__item-load" data-action="load-more" id="esh-list-load">
            <span class="esh-list__item-load-text mdl-color-text--blue" id="esh-information-list-load-text">加载更多</span>
        </li>
    </ul>

    <!--    your code   -->
    <ul class="mdl-list esh-media-list esh-display-none" id="esh-info-primary-hottest">

        @foreach($data['hottest'] as $news)

            <li class="mdl-list__item mdl-list__item--three-line esh-list__item esh-list__item--two-line"
                data-content="{{$news->nid}}">
                @if($news->picture != null)
                    <?php
                    $pics = explode(';', $news->picture);
                    $baseurl = explode('@', $pics[0])[0];
                    $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                    $imagepath = explode('@', $pics[0])[1];
                    ?>
                    {{--<img src="{{$news->picture or asset('images/lamian.jpg')}}"/>--}}
                    <img class="esh-list__item-image" src="{{$baseurl}}{{$imagepath}}"/>
                @endif
                <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                    <span class="esh-list_item-title">{{mb_substr($news->title, 0, 32)}}</span>
                    <span class="mdl-list__item-text-body esh-list__item-text-body">
                        <span class="esh-list__item-secondary-info">{{mb_substr($news->created_at,0,10,'utf-8')}}</span>
                    </span>
                </div>
            </li>

        @endforeach

    </ul>
@stop
@section('esh-footer')
    @include('mobile.components.footerTabs',['activeIndex'=>2, 'data'=>$data])
@stop

@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/information/information.js')}}"></script>
@stop
