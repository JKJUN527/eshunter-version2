@extends('layout.master')
@section('title', '电竞猎人|首页')

@section('custom-style')
   
@endsection


@section('header-nav')
   @include('components.headerNav')
@endsection


@section('header-tab')
   @include('components.headerTab',['activeIndex' => 6,'type' => 0])
@endsection

@section('content')
<div class="containter">

	<h1 style="text-align: center;font-size: 25px;    margin-top: 100px;">本网站大神库即将开放，即可根据年纪，性别，学历，电竞经历及分段等要求筛选公司需求的人才。</h1>
</div>
@endsection

@section('footer')
   @include('components.myfooter')
@endsection

@section('custom-script')
@endsection