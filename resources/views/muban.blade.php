@extends('layout.master')
@section('title', '消息通知')

@section('custom-style')

@endsection

@section('content')
ddd
@endsection

@section('custom-script')

@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('footer')
   @include('components.myfooter')
@endsection