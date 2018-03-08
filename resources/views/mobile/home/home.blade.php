@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['logo'=>true])
@stop

@section('esh-content')
    <div class="esh-panel esh-panel--default">
        <div class="esh-tabs esh-tabs--secondary esh-tabs--icon-large">
            <a class="esh-tabs__tab" href="/m/position/advanceSearch">
                <i class="material-icons">find_in_page</i>
                <span class="esh-tabs__text">找工作</span>
            </a>
            @if(isset($data['type']) and $data['type'] == 2)
                <a class="esh-tabs__tab" href="/m/position/publishList">
                    <i class="material-icons">line_weight</i>
                    <span class="esh-tabs__text">职位发布</span>
                </a>
                <a class="esh-tabs__tab" href="/m/position/deliverList">
                    <i class="material-icons">event_note</i>
                    <span class="esh-tabs__text">职位申请</span>
                </a>
            @else
                <a class="esh-tabs__tab" href="/m/resume">
                    <i class="material-icons">portrait</i>
                    <span class="esh-tabs__text">我的简历</span>
                </a>
                <a class="esh-tabs__tab" href="/m/position/applyList">
                    <i class="material-icons">date_range</i>
                    <span class="esh-tabs__text">申请记录</span>
                </a>
            @endif
            <a class="esh-tabs__tab" href="/m/news">
                <i class="material-icons">public</i>
                <span class="esh-tabs__text">最新资讯</span>
            </a>
        </div>

        <div class="esh-separator__container esh-separator__container--small mdl-color--white">
            <div class="esh-separator esh-separator--line mdl-typography--text-center">
                <div class="esh-title-text">热门公司</div>
            </div>
        </div>




        <ul class="esh-ads clearfix">
            @foreach($data['ad']['ad0'] as $ad0)
                @if($loop->index > 8)
                    @break
                @endif
                <li class="esh-ad__block">
                    <a class="esh-ad__link" href="/m/company?eid={{$ad0->eid}}">
                        <img class="esh-ad__image" src="{{$ad0->picture or asset('images/welcome_card.jpg')}}">
                        <div class="esh-ad__text-body hidden">
                            <h5 class="esh-ad__title esh-text-block--ellipsis">{{$ad0->title}}</h5>
                            <p class="esh-ad__subtitle esh-text-block--ellipsis">{{$ad0->content}}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>

        {{--<ul class="esh-ads clearfix">
            @foreach($data['ad']['ad00'] as $ad00)
                <li class="esh-ad__block">
                    <a class="esh-ad__link" href="/m/company?eid={{$ad00->eid}}">
                        <img class="esh-ad__image" src="{{$ad00->picture or asset('images/welcome_card.jpg')}}">
                        <div class="esh-ad__text-body">
                            <h5 class="esh-ad__title esh-text-block--ellipsis">{{$ad00->title}}</h5>
                            <p class="esh-ad__subtitle esh-text-block--ellipsis">{{$ad00->content}}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>--}}

        {{--<ul class="esh-ads esh-ads--small esh-clearfix mdl-color--white">
            @forelse($data['ad']['ad1'] as $ad1)
                <li class="esh-ad__block">
                    <a class="esh-ad__link" href="/m/company?eid={{$ad1->eid}}">
                        <img class="esh-ad__image" src="{{$ad1->picture or asset('images/house.jpg')}}"
                             width="110" height="48">
                    </a>
                </li>
                @empty
                    <p>暂无小图推荐</p>
            @endforelse
        </ul>--}}


        <div class="esh-separator__container esh-separator__container--small mdl-color--white">
            <div class="esh-separator esh-separator--line mdl-typography--text-center">
                <div class="esh-title-text">热门招聘</div>
            </div>
        </div>


        <ul class="mdl-list esh-media-list esh-media-list--text mdl-color--white" id="esh-info-primary-list">
            @foreach($data['position']['position'] as $position)
                <li class="mdl-list__item mdl-list__item--three-line esh-list__item esh-list__item--two-line" data-content="{{$position->pid}}">
                    <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                        <span class="esh-list_item-title">急聘: {{$position->title}} </span>
                        <span class="mdl-list__item-text-body esh-list__item-text-body">
                            <span class="esh-list__item-secondary-info">
                                @if(empty($position->byname))
                                    {{mb_substr($position->ename, 0, 14, 'utf-8')}}
                                @else
                                    {{mb_substr($position->byname, 0, 14, 'utf-8')}}
                                @endif
                            </span>
                        </span>
                    </div>
                </li>
            @endforeach

            <li class="esh-list__item esh-list__item-load">
                <a class="esh-list__item-load-text mdl-color-text--blue">更多职位&nbsp;&gt;&gt;</a>
            </li>
        </ul>
    </div>
    @stop

@section('esh-footer')
    @include('mobile.components.footerTabs',['activeIndex'=>0,'data'=>$data])
@stop

@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/home/home.js')}}"></script>
@stop