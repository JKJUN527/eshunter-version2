@extends('layout.master')
@section('title', '公司详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/gsxx.css?v=2.40')}}" type="text/css" rel="stylesheet">

@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 3,'type' => $data['type']])
@endsection

@section('content')

@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
	<script charset="utf-8" type="text/javascript" src="js/header.js?v=1.00"></script>
@endsection
