@extends('layout.master')
@section('title', '简历管理')

@section('custom-style')
    <link media="all" href="{{asset('../style/delivery.css?v=2.40')}}" type="text/css" rel="stylesheet">
    <link media="all" rel="stylesheet" href="{{asset('../style/personal_account.css')}}" type="text/css">
    <style>
        .jieshao_list li {
            width: 31.16%;
            height: 116px;

        }

        .my_delivery .d_item {
            text-align: left;
        }

        ul.my_delivery {
            overflow: auto;
        }

        .my_delivery li {

        }

        .item_ltitle span {
            font-size: 20px;
            float: left;
        }

        .look-resume-btn {
            float: right;
            padding: 6px 8px;
            margin-right: 16px;
            background-color: #03A9F4;
            color: #fff;
            border: none;
            border-radius: 3px;
            margin-top: 3.2rem;
        }

        .taoyige {
            width: 300px;
            display: inline-block;
            float: left;
            border: 1px solid #D32F2F;
            border-right: 0px;
        }

        .form_div {
            height: 36px;
            overflow: hidden;
            width: 508px;
        }

        .taoyige input[type='text'] {
            width: 480px;
            overflow: hidden;
            border: none;
            color: #5e5e5e;
            font-size: 16px;
            font-family: 'Microsoft YaHei';
            height: 100%;
            text-indent: 13px;
            float: left;
        }

        .material-icons {
            cursor: pointer;
            float: left;
            margin: 1rem;
        }

        .base-info {
            font-size: 14px;
            position: absolute;
            top: 0;
            right: 240px;
            cursor: text;
        }

        .normal-info {
            color: #03A9F4;
        }

        .danger-info {
            color: #F44336;
        }

        .success-info {
            color: #4CAF50;
        }

        .warning-info {
            color: #FF9800;
        }

        .position-empty {
            text-align: center;
            padding: 16px 0;
            font-weight: 300;
            color: #737373;
            font-size: 14px;
        }

        #delete-all--deliver {
            border: none;
            border-radius: 2px;
            height: 30px;
            margin: 0;
            min-width: 64px;
            padding: 0 10px;
            display: inline-block;
            font-family: "Roboto", "Helvetica", "Arial", sans-serif;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            line-height: 1;
            letter-spacing: 0;
            overflow: hidden;
            will-change: box-shadow;
            transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1), color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .button-blue-sky,
        .button-blue-sky:hover,
        .button-blue-sky.mdl-button--raised {
            font-weight: 200 !important;
            color: rgb(255, 255, 255);
            background-color: #03A9F4;
        }

        .item_ltitle {
            padding: 20px;
            overflow: hidden;
            position: relative;
            border-bottom: 1px solid #f2f2f2;
        }

        .item_ltitle > button {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        .my_delivery .d_time {
            position: absolute;
            top: 0;
            right: 10px;
            color: #999;
        }
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
    @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('content')
    <div class="container">
        <div class="info_left info_panel" style="background: white;">
            <ul>
                <li class="">
                    <a href="/account"><i class="iconfont icon-homepage"></i>
                        <span>帐户中心</span>
                    </a>
                </li>
                <li class="">
                    <a href="/position/publishList">
                        <i class="iconfont icon-createtask_fill"></i>
                        <span>职位管理</span>
                    </a>
                </li>
                <li class="active">
                    <a href="/position/deliverList">
                        <i class="iconfont icon-businesscard"></i>
                        <span>简历管理</span>
                    </a>
                </li>
                <li class="">
                    <a href="/message">
                        <i class="iconfont icon-message_fill"></i>
                        <span>站内信({{$data['username']['messageNum']}})</span>
                    </a>
                </li>
                <li class="">
                    <a href="/collection/index">
                        <i class="iconfont icon-praise"></i>
                        <span>收藏夹</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="info_right info_panel">
            <div class="interview_container item_container" id="interview_container">
                <div id="interview_anchor"></div>
                <div class="item_ltitle">
                    <span>收到的简历</span>
                    <button id="delete-all--deliver" class="button-blue-sky mdl-button--raised">清空记录</button>
                </div>

                <div class="delivery_tabs">
                    <ul class="reset">
                        <li class="li_one @if($data['status'] == -1) current @endif">
                            <a class="all_border tabs_all" href="/position/deliverList">全部</a>
                        </li>
                        <li class="li_two @if($data['status'] == 1) current @endif">
                            <a class="tabs_delivery_success" href="/position/deliverList?status=1">已查看</a>
                        </li>
                        <li class="li_three @if($data['status'] == 0) current @endif">
                            <a class="tabs_look" href="/position/deliverList?status=0">待沟通</a>
                        </li>
                        <li class="li_four @if($data['status'] == 2) current @endif">
                            <a class="tabs_review" href="/position/deliverList?status=2">已录用</a>
                        </li>
                        <li class="li_five @if($data['status'] == 3) current @endif">
                            <a class="tabs_say" href="/position/deliverList?status=3">不合适</a>
                        </li>
                        {{--<li class="li_five">--}}
                        {{--<a class="tabs_review">未录用</a>--}}
                        {{--</li>--}}
                        {{--<li class="last li_six">--}}
                        {{--<a href="#" class="tabs_nosuit">失效</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>

                <div class="reviews-empty">
                    <form id="deliveryForm" class="deliveryAll" style="display: block;">
                        <ul class="reset my_delivery">
                            <?php
                            $allnum = 0;
                            $per_page = 10;
                            $current_num = 0;
                            ?>
                            @forelse($data['deliverAll'] as $apply)
                                <?php
                                $allnum++;
                                $current_num++;
                                ?>
                                <li class="apply-item" name="page<?php echo floor($current_num / $per_page) ?>"
                                    @if(floor($current_num/$per_page)==0)
                                    style="display: block"
                                    @else
                                    style="display: none"
                                        @endif
                                >
                                    <div class="d_item clearfix">
                                        <div class="d_job">
                                            <a class="d_job_link">
                                                <em class="d_job_name">申请职位: {{$apply->position_title}}</em>
                                            </a>

                                            @if($apply->status == 0)
                                                <em class="base-info normal-info">状态：待查看</em>
                                            @elseif($apply->status == 1)
                                                <em class="base-info normal-info">状态：已查看</em>
                                            @elseif($apply->status == 2)
                                                <em class="base-info success-info">状态：已录用</em>
                                            @elseif($apply->status == 3)
                                                <em class="base-info danger-info">状态：未录用</em>
                                            @elseif($apply->status == 4)
                                                <em class="base-info danger-info">状态：职位已下架</em>
                                            @endif
                                            <em class="d_time">申请时间:{{$apply->created_at}}</em>
                                        </div>
                                        <div class="d_company">
                                            <img src="{{$apply->photo or asset('images/default-img.png')}}"
                                                 style="height: 50px;width: 50px;">
                                            <a target="_blank"
                                               href="/position/deliverDetail?did={{$apply->did}}">{{$apply->pname}}</a>

                                            <span class="deliver-resume look-resume-btn operations-delete"
                                                  data-content="{{$apply->did}}">删除</span>
                                            <span class="deliver-resume look-resume-btn check-resume-new"
                                                  data-content="{{$apply->did}}">查看简历</span>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <div class="position-empty">
                                    <img src="{{asset('images/desk.png')}}" width="40px">
                                    <span>暂无投递记录</span>
                                </div>
                            @endforelse
                        </ul>
                    </form>
                    <nav id="page_tools">
                        <ul class="pagination">
                            <?php $pagenum = floor($current_num / $per_page) ?>
                            @if($pagenum >0)
                                <li><span name="page" data-content="0">&laquo;</span></li>
                                @for($i=0;$i<$pagenum;$i++)
                                    <li><span name="page" data-content="{{$i}}">{{$i+1}}</span></li>
                                @endfor
                                <li><span name="page" data-content="{{$pagenum}}">&raquo;</span></li>
                            @endif
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
    <script type="text/javascript">
        $(".check-resume-new").click(function () {
            var did = $(this).attr('data-content');
            window.open("/position/deliverDetail?did=" + did);
        });
        $("#delete-all--deliver").click(function () {
            swal({
                title: "确认",
                text: "确定删除所有投递记录吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/position/deldeliverRecord?did=-1",
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/deliverList";
                            }, 1200);
                            swal("删除成功");
                        } else if (data['status'] === 400) {
                            alert(data['msg']);
                        }
                    }

                })
            });
        });

        $(".operations-delete").click(function () {
            var element = $(this);

            swal({
                title: "确认",
                text: "确定删除该条投递记录吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                var did = element.attr("data-content");
                $.ajax({
                    url: "/position/deldeliverRecord?did=" + did,
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/deliverList";
                            }, 1200);
                            swal("删除成功");
                        } else if (data['status'] === 400) {
                            alert(data['msg']);
                        }
                    }
                })
            });
        });
        $("span[name=page]").click(function () {
            var pagenum = $(this).attr('data-content');
            var page = $(".apply-item");
            var pagename = "li[name=page" + pagenum + "]";
            var curr_page = $(pagename);
            page.css('display', 'none');
            curr_page.css('display', 'block');
            $('.pagination').children('.active').removeClass('active');
            $(this).parent().addClass('active');
        });

        function gotopage(pagenum) {
            $(this).addClass('active');
            alert($(this));
            var page = $(".apply-item");
            var pagename = "li[name=page" + pagenum + "]";
            var curr_page = $(pagename);
            page.css('display', 'none');
            curr_page.css('display', 'block');
        }
    </script>
@endsection
