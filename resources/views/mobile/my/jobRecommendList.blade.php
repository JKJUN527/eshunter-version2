@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['title'=>'推荐职位','buttonLeft'=>true])
@stop

@section('esh-content')
    <ul class="mdl-list esh-media-list">
        @forelse($data['recommendPosition']["position"] as $position)
                <li class="mdl-list__item mdl-list__item--two-line esh-list__item" data-pid="{{$position->pid}}">
                    <div class="mdl-list__item-primary-content esh-list__item-primary-content">
                        <span class="esh-list_item-title">
                            @if(empty($data['recommendPosition']['enprinfo'][$position->eid]->byname) && empty($data['recommendPosition']['enprinfo'][$position->eid]->ename))
                                未命名企业
                            @elseif($data['recommendPosition']['enprinfo'][$position->eid]->byname)
                                {{$data['recommendPosition']['enprinfo'][$position->eid]->byname}}
                            @else
                                {{$data['recommendPosition']['enprinfo'][$position->eid]->ename}}
                            @endif
                        </span>
                        <span class="mdl-list__item-text-body esh-list__item-text-body">
                            <span class="esh-list__item-secondary-info">{{$position->name}}</span>
                            <span class="esh-list__item-text mdl-color-text--grey">
                                职位:
                                {{mb_substr($position->title, 0, 20, 'utf-8')}}
                            </span>
                        </span>
                    </div>
                    <div class="mdl-list__item-secondary-content esh-list__item-secondary-content esh-height--1-1">
                    <span class="mdl-list__item-secondary-info mdl-typography--text-right">
                        @if($position->salary <= 0)
                            月薪面议
                        @else
                            {{$position->salary}}-
                            @if($position->salary_max ==0) 无上限
                            @else {{$position->salary_max}}
                            @endif
                            <br/>元/月
                        @endif
                    </span>

                        <span class="mdl-list__item-secondary-info">{{empty($position->updated_at) ? '今天' : mb_substr($position->updated_at, 0, 10, 'utf-8')}}</span>
                    </div>
                </li>

            @empty
            <li><p class="mdl-color-text--grey">暂无职位推荐</p></li>
        @endforelse

    </ul>
@stop



@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/my/my.js')}}"></script>
@stop