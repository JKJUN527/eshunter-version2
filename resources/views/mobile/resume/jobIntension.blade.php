@extends('mobile.layout.master')
@section('esh-css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/select2/css/select2.css')}}">
@stop
@section('esh-header')
    @include('mobile.components.header',['title'=> "求职意向",'buttonLeft'=>true])
@stop
@section('esh-content')
    <form id="esh-job-intention">
        <input type="hidden" name="rid" value="{{$data['rid']}}">
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>地点
            </label>
            <div class="esh-select">
                <select class="esh-select-option esh-select2" name="place">
                    @if($data['intention'] == null)
                        <option value="-1">任意</option>
                        @foreach($data['region'] as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                    @else
                        @if($data['intention']->region == -1)
                            <option value="-1" selected>任意</option>
                        @else
                            <option value="-1">任意</option>
                        @endif
                        @foreach($data['region'] as $region)
                            @if($data['intention']->region == $region->id)
                                <option value="{{$region->id}}" selected>{{$region->name}}</option>
                            @else
                                <option value="{{$region->id}}">{{$region->name}}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>行业
            </label>
            <div class="esh-select">
                {{--<span class="esh-sval"></span>--}}
                <select class="esh-select-option esh-select2" name="industry" id="esh-industry-intention">
                    @if($data['intention'] == null)
                        <option value="-1">任意</option>
                        @foreach($data['industry'] as $industry)
                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                        @endforeach
                    @else
                        @if($data['intention']->industry == -1)
                            <option value="-1" selected>任意</option>
                        @else
                            <option value="-1">任意</option>
                        @endif
                        @foreach($data['industry'] as $industry)
                            @if($data['intention']->industry == $industry->id)
                                <option value="{{$industry->id}}" selected>{{$industry->name}}</option>
                            @else
                                <option value="{{$industry->id}}">{{$industry->name}}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <!--if 行业为任意，不显示-->
        @foreach($data['industry'] as $industry)
            <div class="esh-edit esh-occup-display" id="occupation-display{{$industry->id}}"
                 style="display:none;">
                <label class="esh-label">
                    <em>*</em>游戏
                </label>
                <div class="esh-select">
                    <!--<span class="esh-sval"></span>-->
                    <select class="esh-select-option esh-select2"  id="position-occupation"
                            name="occupation{{$industry->id}}">
                        @if($data['intention'] == null)
                            <option value="-1">任意</option>
                            @foreach($data['occupation'] as $occupation)
                                @if($occupation->industry_id == $industry->id)
                                    <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                @endif
                            @endforeach
                        @else
                            @if($data['intention']->occupation == -1)
                                <option value="-1" selected>任意</option>
                            @else
                                <option value="-1">任意</option>
                            @endif
                            @foreach($data['occupation'] as $occupation)
                                @if($occupation->industry_id == $industry->id)
                                    @if($data['intention']->occupation == $occupation->id)
                                        <option value="{{$occupation->id}}"
                                                selected>{{$occupation->name}}</option>
                                    @else
                                        <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        @endforeach
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>类型
            </label>
            <div class="esh-select">
                <!--<span class="esh-sval"></span>-->
                <select class="esh-select-option esh-select2" name="type">
                    @if($data['intention'] == null)
                        <option value="-1">任意</option>
                        <option value="0">兼职</option>
                        <option value="1">实习</option>
                        <option value="2">全职</option>
                    @else
                        <option value="-1" {{$data['intention']->work_nature==-1?"selected":""}}>任意</option>
                        <option value="0" {{$data['intention']->work_nature==0?"selected":""}}>兼职</option>
                        <option value="1" {{$data['intention']->work_nature==1?"selected":""}}>实习</option>
                        <option value="2" {{$data['intention']->work_nature==2?"selected":""}}>全职</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>期望薪资（月）
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="esh-salary">
                @if($data['intention'] == null || $data['intention']->salary < 0)
                    <input class="mdl-textfield__input posInt" type="text" name="salary">
                @else
                    <input class="mdl-textfield__input posInt" type="text"

                           value="{{$data['intention']->salary}}"
                           name="salary">
                @endif
            </div>
        </div>

        <div class="esh-edit-fb esh-form-sure">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                    type="button" id="esh-save-jobintention">
                保存
            </button>
        </div>
    </form>
@stop
@section('esh-js')
    @parent
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.method.js')}}"></script>
    <script src="{{asset('mobile/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('mobile/js/resume/jobIntension.js')}}"></script>
@stop

