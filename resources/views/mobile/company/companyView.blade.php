@extends('mobile.layout.master')

@section('title', '企业详情')

@section('esh-header')
    @include('mobile.components.header',['title'=> '企业详情','buttonLeft'=>true])
@stop

@section('esh-content')
    <div class="esh-panel esh-panel--default">
        <div class="esh-panel__body">
            @empty($data['enprinfo'])
                <div class="esh-block--empty">
                    该企业未入驻平台
                </div>
            @endempty

            <div class="esh-card-group">
                <a class="esh-card">
                    <img src="{{$data["enprinfo"]->elogo == null ? asset('images/default-img.png') : $data["enprinfo"]->elogo}}" height="70" width="70">
                    <div class="esh-card-body">
                        <span class="mdl-typography--subhead">{{$data["enprinfo"]->ename or "公司名称未填写"}}</span>
                        {{--<div class="mdl-typography--body-1 esh-card-body--text">{{$data["enprinfo"]->byname or "公司别名未填写"}}</div>--}}
                        <div class="mdl-typography--body-1 esh-card-body--text">
                                <span>
                                    @if($data["enprinfo"]->industry == null)
                                        行业未知
                                    @else
                                        @foreach($data["industry"] as $item)
                                            @if($data["enprinfo"]->industry == $item->id)
                                                {{$item->name}}
                                            @endif
                                        @endforeach
                                    @endif
                                </span> |
                            <span>
                                    @if($data["enprinfo"]->enature == null || $data["enprinfo"]->enature == 0)
                                    企业类型未知
                                @elseif($data["enprinfo"]->enature == 1)
                                    国有企业
                                @elseif($data["enprinfo"]->enature == 2)
                                    民营企业
                                @elseif($data["enprinfo"]->enature == 3)
                                    中外合资企业
                                @elseif($data["enprinfo"]->enature == 4)
                                    外资企业
                                @elseif($data["enprinfo"]->enature == 5)
                                    社会团体
                                @endif
                                </span> |
                            <span>
                                    @if($data["enprinfo"]->escale == null)
                                    规模未知
                                @elseif($data["enprinfo"]->escale == 0)
                                    10人以下
                                @elseif($data["enprinfo"]->escale == 1)
                                    10～50人
                                @elseif($data["enprinfo"]->escale == 2)
                                    50～100人
                                @elseif($data["enprinfo"]->escale == 3)
                                    100～500人
                                @elseif($data["enprinfo"]->escale == 4)
                                    500～1000人
                                @elseif($data["enprinfo"]->escale == 5)
                                    1000人以上
                                @endif
                                </span>
                        </div>
                    </div>
                    <div class="mdl-list__item-secondary-content mdl-typography--text-center">
                                <span class="mdl-typography--caption {{$data["enprinfo"]->is_verification == 1 ? 'mdl-color-text--green' : 'mdl-color-text--grey'}}">
                                    <i class="material-icons">verified_user</i>
                                    <span class="esh-visible--block">
                                        {{$data["enprinfo"]->is_verification == 1 ? '已认证' : '待审核'}}
                                    </span>
                                </span>
                    </div>
                </a>
                @if(empty($data["enprinfo"]->home_page))
                    <div class="esh-card__addon mdl-color-text--grey">
                        <i class="material-icons esh-vertical--middle">apps</i>
                        <span class="esh-card__addon-text">企业主页未填写</span>
                    </div>
                @else
                    <a class="esh-card__addon mdl-color-text--blue" href="
                    @if(strpos($data["enprinfo"]->home_page, "http://") !== false ||strpos($data["enprinfo"]->home_page, "https://") !== false)
                    {{$data["enprinfo"]->home_page or '#'}}
                    @else
                    {!! "http://".$data["enprinfo"]->home_page !!}
                    @endif" target="_blank">
                        <i class="material-icons esh-vertical--middle">apps</i>
                        <span class="esh-card__addon-text esh-pull--right">进入</span>
                        <span class="esh-card__addon-text">企业主页</span>
                    </a>
                @endif
            </div>

            <div class="mdl-color--white">
                <div class="mdl-typography--body-2 esh-padding--x-16-y-10">公司简介</div>
                <div class="esh-padding--x-16-y-10">
                    <p>{{$data["enprinfo"]->ebrief or "公司简介暂无"}}</p>
                </div>
            </div>
            <div class="mdl-typography--body-2 esh-padding--x-16-y-10">招聘职位<small>(共{{count($data['position'])}}个)</small></div>
            <div class="esh-section__container">
                @forelse($data['position'] as $position)
                    <a class="esh-section" href="/m/position/detail?pid={{$position->pid}}">
                        <span class="mdl-typography--body-2 esh-section--title">
                            @if(empty($position->title))
                                没有填写职位名称
                            @else
                                {{mb_substr($position->title, 0, 20, 'utf-8')}}
                            @endif
                        </span>
                        <span class="mdl-typography--body-1 esh-section--subtitle esh-text-block--ellipsis">
                            <span>上班地点：{{$position->name}}</span>
                            <span class="esh-padding--x-1">月薪：
                                @if($position->salary <= 0)
                                    薪资面议
                                @else
                                    {{$position->salary}}元/月
                                @endif
                            </span>
                        </span>
                    </a>
                @empty
                    <div class="esh-block--empty">
                        该公司没有其他职位
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@stop

@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/company/companyView.js')}}"></script>
@stop
