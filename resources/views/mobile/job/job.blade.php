@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['logo'=>true])
    <div class="esh-layout__sub-header" id="esh-layout-sub-header">
        <div class="mdl-layout__header-row esh-layout__header-row esh-height--auto">
            <form class="mdl-textfield mdl-js-textfield esh-textfield--search" id="esh-search-form">
                <button class="mdl-button mdl-button--icon esh-button--icon">
                    <i class="material-icons">search</i>
                </button>
                <input class="mdl-textfield__input esh-textfield__input" type="search" value="{{isset($data['result']['keyword']) ? $data['result']['keyword'] : ""}}" id="esh-search-input">
            </form>
            <button class="mdl-button mdl-button--icon esh-button--sort esh-js-modal-trigger" id="esh-nav-link-orderBy">
                <i class="material-icons">sort</i>
            </button>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-height--auto">
            <div class="mdl-navigation esh-navigation">
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-industry" href="#">
                    <span class="esh-navigation__text">行业</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-work_nature" href="#">
                    <span class="esh-navigation__text">类型</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-salary" href="#">
                    <span class="esh-navigation__text">薪水</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
                <a class="mdl-navigation__link esh-navigation__link esh-js-modal-trigger" id="esh-nav-link-region-pro" href="#">
                    <span class="esh-navigation__text">地区</span>
                    <i class="material-icons esh-icons">keyboard_arrow_down</i>
                </a>
            </div>
        </div>
    </div>
    @stop


@section('esh-content')
    <ul class="mdl-list esh-media-list" id="esh-primary-list">
        {{--@if(!empty($data['condition']))--}}
        {{--<li class="esh-list__item--alert">共搜索到{{$data['result']['position']->total()}}个结果</li>--}}
        {{--@endif--}}

        @foreach($data['result']['position'] as $position)
            <li class="mdl-list__item mdl-list__item--three-line esh-list__item" data-pid="{{$position->pid}}">
                <img src="{{empty($position->elogo) ? asset('mobile/styles/default/images/avatar.png') : $position->elogo}}" class="esh-list__item-image">
                <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                    <span class="esh-list_item-title">
                        @if(empty($position->title))
                            没有填写职位名称
                        @else
                            {{$position->title}}
                        @endif
                    </span>
                    <span class="mdl-list__item-text-body esh-list__item-text-body">
                        {{--<span class="esh-list__item-secondary-info esh-list__item-badge">电竞教育</span>--}}
                        <span class="esh-list__item-secondary-info">{{$position->name}}</span>
                        <span class="esh-list__item-text">
                            @if(empty($position->byname) && empty($position->ename))
                                未知企业
                            @elseif(!empty($position->byname))
                                {{$position->byname}}
                            @elseif(!empty($position->ename))
                                {{$position->ename}}
                            @endif
                        </span>
                    </span>
                </div>
                <div class="mdl-list__item-secondary-content esh-list__item-secondary-content">
                    <span class="mdl-list__item-secondary-info mdl-typography--text-right">
                        @if($position->salary <= 0)
                            月薪面议
                        @else
                            {{$position->salary}}-{{$position->salary_max == 0 ? '无上限' : $position->salary_max}}
                            <br/><span>元/月</span>
                        @endif
                    </span>

                    <span class="mdl-list__item-secondary-info">{{empty($position->created_at) ? '今天' : mb_substr($position->created_at,0,10,'utf-8')}}</span>
                </div>
            </li>
        @endforeach

        @if($data['result']['position']->total() < $data['result']['position']->perPage())
            <li class="esh-list__item esh-list__item-load" data-page="-1">
                <span class="esh-list__item-load-text mdl-color-text--grey">{{$data['result']['position']->total() == 0 ? '暂无相关职位' : '职位全部加载完了～'}}</span>
            </li>
        @else
            <li class="esh-list__item esh-list__item-load" data-page="{{$data['result']['position']->currentPage()}}">
                <span class="esh-list__item-load-text mdl-color-text--blue">加载更多</span>
            </li>
        @endif
    </ul>
    @stop

@section('esh-footer')
    @include('mobile.components.footerTabs',['activeIndex'=>1, 'data'=>$data])
    <div class="esh-modal__mask" id="esh-modal-filter">
        <div class="esh-modal__container">
            <div class="esh-modal__body" id="esh-modal-body">
                <div class="mdl-tabs esh-tabs--vertical mdl-js-tabs">
                    <div class="mdl-tabs__tab-bar esh-tabs__tab-bar">
                        <a id="esh-tabs-tab-industry" href="#esh-tabs-panel-industry" class="mdl-tabs__tab esh-tabs__tab is-active">行业</a>
                        <a id="esh-tabs-tab-work_nature" href="#esh-tabs-panel-work_nature" class="mdl-tabs__tab esh-tabs__tab">类型</a>
                        <a id="esh-tabs-tab-salary" href="#esh-tabs-panel-salary" class="mdl-tabs__tab esh-tabs__tab">薪资</a>
                        <a id="esh-tabs-tab-region-pro" href="#esh-tabs-panel-region-pro" class="mdl-tabs__tab esh-tabs__tab">省份</a>
                        <a id="esh-tabs-tab-region-city" href="#esh-tabs-panel-region-city" class="mdl-tabs__tab esh-tabs__tab">城市</a>
                        <a id="esh-tabs-tab-orderBy" href="#esh-tabs-panel-orderBy" class="mdl-tabs__tab esh-tabs__tab">排序</a>
                    </div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-industry">
                        <ul class="esh-list esh-list--magnetic esh-list--magnetic-two-column clearfix">
                            <li data-key="industry" data-content="-1" class="esh-list__item {{isset($data['result']['industry']) ? null : 'is-active'}}">
                                <span class="esh-list__link">全部</span>
                            </li>
                            @foreach($data['industry'] as $industry)
                                <li data-key="industry" data-content="{{$industry->id}}" class="esh-list__item {{(isset($data['result']['industry']) && $data['result']['industry'] == $industry->id) ? 'is-active': null}}">
                                    <span class="esh-list__link">{{$industry->name}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-work_nature">
                        <ul class="esh-list esh-list--magnetic esh-list--magnetic-two-column clearfix">
                            <li data-key="work_nature" data-content="-1" class="esh-list__item {{isset($data['result']['work_nature']) ? null : 'is-active'}}">
                                <span class="esh-list__link">不限</span>
                            </li>
                            @foreach(['兼职','实习','全职'] as $type)
                                <li data-key="work_nature" data-content="{{$loop->index}}" class="esh-list__item {{(isset($data['result']['work_nature']) && $data['result']['work_nature'] == $loop->index) ? 'is-active': null}}">
                                    <span class="esh-list__link">{{$type}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-salary">
                        <ul class="esh-list esh-list--magnetic esh-list--magnetic-two-column clearfix">
                            <li data-key="salary" data-content="-1" class="esh-list__item {{isset($data['result']['salary']) ? null : 'is-active'}}">
                                <span class="esh-list__link">不限</span>
                            </li>
                            @foreach(['3K以下','3K-5K','5K-10K','10K-15K','15K-20K','20K-25K','25K-50K','50K以上'] as $salary)
                                <li data-key="salary" data-content="{{$loop->index + 1}}" class="esh-list__item {{(isset($data['result']['salary']) && $data['result']['salary'] == $loop->index + 1) ? 'is-active': null}}">
                                    <span class="esh-list__link">{{$salary}}</span>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-region-pro">
                        <ul class="esh-list esh-list--magnetic esh-list--magnetic-two-column clearfix">
                            <li data-key="region-pro" data-content="-1" class="esh-list__item {{isset($data['result']['region-pro']) ? null : 'is-active'}}">
                                <span class="esh-list__link">全部</span>
                            </li>
                            @foreach($data['region-pro'] as $province)
                                <li data-key="region-pro" data-content="{{$province->id}}" class="esh-list__item {{(isset($data['result']['region-pro']) && $data['result']['region-pro'] == $province->id) ? 'is-active': null}}">
                                    <span class="esh-list__link">{{$province->name}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-region-city">
                        <ul class="esh-list esh-list--magnetic esh-list--magnetic-two-column clearfix">
                            <li data-key="region-city" data-content="-1" class="esh-list__item {{isset($data['result']['region-city']) ? null : 'is-active'}}">
                                <span class="esh-list__link">全部</span>
                            </li>
                            @foreach($data['region-city'] as $city)
                                <li data-key="region-city" data-parentid="{{$city->parent_id}}" data-content="{{$city->id}}" class="esh-list__item {{(isset($data['result']['region-city']) && $data['result']['region-city'] == $city->id) ? 'is-active': null}}">
                                    <span class="esh-list__link">{{$city->name}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="mdl-tabs__panel esh-tabs__panel" id="esh-tabs-panel-orderBy">
                        <ul class="esh-list esh-list--magnetic esh-list--magnetic-two-column clearfix">
                            @foreach(['热度','薪水','发布时间'] as $order)
                                @if(isset($data['result']['orderBy']))
                                    <li data-key="orderBy" data-content="{{$loop->index}}"
                                        class="esh-list__item {{$data['result']['orderBy'] == $loop->index ? 'is-active': null}}">
                                        <span class="esh-list__link">{{$order}}</span>
                                    </li>
                                @else
                                    <li data-key="orderBy" data-content="{{$loop->index}}"
                                        class="esh-list__item {{$loop->index == 2 ? 'is-active': null}}">
                                        <span class="esh-list__link">{{$order}}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="esh-modal__footer">
                <button class="mdl-button mdl-js-button mdl-color-text--blue" data-action="enter">&nbsp;确定&nbsp;</button>
                <button class="mdl-button mdl-js-button" data-action="cancel">&nbsp;取消&nbsp;</button>
            </div>
        </div>
    </div>
    @stop

@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/job/job.js')}}"></script>
    @stop