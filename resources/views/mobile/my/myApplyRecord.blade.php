@extends('mobile.layout.master')


@section('title', '我的申请记录')


@section('esh-header')
    @include('mobile.components.header',['title'=>'我的申请记录','buttonLeft'=>true])
@stop


@section('esh-content')
    <ul class="esh-arecord mdl-list">
        @forelse($data["applylist"]["list"] as $position)
        <li class="mdl-list__item mdl-list__item--three-line esh-arecord-list" data-content="{{$position->fbinfo}}">
            <div class="mdl-list__item-primary-content">
                <div>{{$position->title}}</div>
                <div class="mdl-list__item-text-body">
                    <div>{{$data['applylist']['ename'][$position->eid]->ename}}</div>
                    <div>{{$position->created_at}}</div>
                </div>
            </div>
            {{--<span class="mdl-list__item-secondary-content">
            </span>--}}
            @if($position->status == 0)
                <span class="mdl-list__item-secondary-content">投递成功</span>
            @elseif($position->status == 1)
                <span class="mdl-list__item-secondary-content">企业已查看</span>
            @elseif($position->status == 2)
                <span class="mdl-list__item-secondary-content">已录用</span>
            @elseif($position->status == 3)
                <span class="mdl-list__item-secondary-content">未录用</span>
            @elseif($position->status == 4)
                <span class="mdl-list__item-secondary-content">职位已失效</span>
            @endif
            @empty
                <div class="mdl-list__item-primary-content">
                    <div class="mdl-list__item-text-body esh-no-record">没有申请记录</div>
                </div>
        </li>
        @endforelse
      </ul>
@stop


@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/my/myApplyRecord.js')}}"></script>
@stop
