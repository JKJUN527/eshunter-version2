@extends('layout.master')
@if($data["type"] == 1)
    @section('title', '个人中心')
@endif
@if($data["type"] == 2)
    @section('title', '企业中心')
@endif
@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>

        .base-info--position {
            border-top: 3px solid #9C27B0;
            min-height: 0;
        }

        .base-info--apply {
            border-top: 3px solid #9C27B0;
            /*min-height:0;*/
        }

        .base-info--recommendation,
        .base-info--apply__list {
            border-top: 3px solid #FF9800;
            min-height: 0;
        }

        .base-info--apply__list > .mdl-card__menu > button > i {
            color: #FF9800;
        }

        .base-info--enterprise > .mdl-card__menu > button > i {
            color: #F44336;
        }

        .base-info--position > .mdl-card__menu > button > i,
        .base-info--position > .mdl-card__menu > button > span {
            color: #9C27B0;
        }

        .base-info__contact li > span > a {
            text-decoration: none;
            color: #232323;
            font-weight: 300;
        }

        .base-info--resume {
            min-height: 250px;
            border-top: 3px solid #03A9F4;
        }

        .resume-item {
            display: inline-block;
            margin: 8px;
            padding: 8px;
            -webkit-transition: all 0.6s ease;
            -moz-transition: all 0.6s ease;
            -o-transition: all 0.6s ease;
            transition: all 0.6s ease;
        }

        .resume-item a {
            display: inline-block;
        }

        .resume-item p {
            margin: 4px 0 0 0;
            font-weight: 300;
            font-size: 12px;
            text-align: center;
        }

        .resume-bg {
            border-radius: 2px;
            background-color: #03A9F4;
            color: #ffffff;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .recommendation-panel > ul > li {
            width: 280px;
        }

        .word_re {
            margin-left: 16px;
        }

        .re_info {
            padding: 8px;
            border-radius: 3px;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .re_info:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .re_info > h6 {
            margin: 0;
            font-weight: 500;
            padding: 0 !important;
        }

        .re_info > p {
            margin: 0;
        }

        .word_re > .re_info h6,
        .word_re > .re_info p a {
            font-weight: 300;
            color: #000;
            text-decoration: none;
            font-size: 13px;
        }

        .word_re > .re_info h6 {
            padding: 8px 0 0 0;
        }

        .word_re > .re_info p a {
            color: #373737;
            margin-left: 8px;
            font-size: 12px;
        }

        .news-panel ul li a:hover {
            color: #F44336;
        }

        .ad_info > p {
            font-weight: 300;
            margin-bottom: 0;
            padding: 0 8px 8px 8px;
        }

        .apply-panel {
            padding: 0;
        }

        .position-ul,
        .apply-ul {
            width: 100%;
            display: block !important;
        }

        .apply-item {
            display: block !important;
            padding: 8px 16px;
            margin: 0;
            border-bottom: 1px solid #ebebeb;
        }

        .applier-info {
            width: 480px;
            display: inline-block;
            vertical-align: middle;
        }

        .applier-info > p {
            margin-bottom: 0;
            font-weight: 300;
        }

        .applier-info > p > small {
            color: #aaaaaa;
        }

        .applier-info > p > span {
            font-size: 10px;
            cursor: pointer;
        }

        .applier-info > p > span:hover {
            color: #F44336;
        }

        .apply-panel {
            min-height: 0;
            padding: 0;
        }

        .apply-item {
            padding: 16px;
            border-bottom: 1px solid #ebebeb;
            cursor: pointer;
            -webkit-transition: all 0.4s ease;
            -moz-transition: all 0.4s ease;
            -o-transition: all 0.4s ease;
            transition: all 0.4s ease;
        }

        .apply-item > h5,
        .apply-item > p {
            margin: 0;
            display: inline-block;
            width: 450px;
            font-weight: 300;
        }

        .apply-item > span {
            float: right;
            vertical-align: middle;
            text-align: right;
            font-weight: 400;
            font-size: 13px;
        }

        .apply-item:hover {
            background-color: #ebebeb;
        }
    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username']])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2,'type' =>$data['type']])
@endsection


@section('content')
    <div class="info-panel">
        <div class="container">

            <div class="info-panel--left info-panel">
                @if($data["type"] == 1)
                    <div class="mdl-card mdl-shadow--2dp base-info--resume info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">我的简历</h5>
                        </div>

                        <div class="mdl-card__actions mdl-card--border resume-panel">

                            @foreach($data['resumeList'] as $resume)
                                <div class="resume-item">
                                    <a to="/resume/add?rid={{$resume->rid}}"><img src="{{asset('images/resume.png')}}"
                                                                                  width="100px"/></a>
                                    <p>{{$resume->resume_name}}</p>
                                </div>
                            @endforeach

                            @if(count($data['resumeList']) < 3)
                                <div class="resume-item">
                                    <a id="add-resume"><img src="{{asset('images/resume_add.png')}}" width="100px"/></a>
                                    <p>添加简历</p>
                                </div>
                            @endif
                        </div>

                    </div>
                @endif

                @if($data['type'] == 1)
                    <div class="mdl-card mdl-shadow--2dp base-info--apply info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">我的申请记录</h5>
                        </div>

                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-js-button mdl-button--icon" id="check-all"
                                    to="/position/applyList" style="color: #9C27B0;">
                                <i class="material-icons">list</i>
                            </button>

                            <div class="mdl-tooltip" data-mdl-for="check-all">
                                查看所有
                            </div>
                        </div>

                        <div class="mdl-card__actions mdl-card--border apply-panel">
                            <?php
                            $index = 0;
                            $count = 5;
                            ?>

                            @forelse($data["applylist"]["list"] as $position)
                                @if(++$index < $count)
                                    <div class="apply-item" data-content="{{$position->fbinfo}}">
                                        <h5>职位名称：{{$position->title}}</h5><br>
                                        <p style="margin-top: 8px;">
                                            <span>公司名称：{{$data['applylist']['ename'][$position->eid]->ename}}</span>
                                            <span style="margin-left: 32px;">申请时间：{{$position->created_at}}</span></p>
                                        @if($position->status == 0)
                                            <span class="normal-info">状态：投递成功</span>
                                        @elseif($position->status == 1)
                                            <span class="normal-info">状态：企业已查看</span>
                                        @elseif($position->status == 2)
                                            <span class="success-info">状态：已录用</span>
                                        @elseif($position->status == 3)
                                            <span class="danger-info">状态：未录用</span>
                                        @elseif($position->status == 4)
                                            <span class="danger-info">状态：职位已失效</span>
                                        @endif
                                    </div>
                                @endif
                            @empty
                                <div class="apply-empty">
                                    <img src="{{asset('images/apply-empty.png')}}" width="50px">
                                    <span>没有申请记录</span>
                                </div>
                            @endforelse

                            @if(count($data["applylist"]["list"]) > $count)
                                <p style="text-align: center; margin-top: 16px;">
                                    还有 {{count($data["applylist"]["list"]) - $count}} 项申请记录</p>
                            @else
                                <p style="text-align: center; margin-top: 16px;">没有更多了</p>
                            @endif
                        </div>
                    </div>
                @endif

                @if($data["type"] == 1)
                    <div class="mdl-card mdl-shadow--2dp base-info--recommendation info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">为您推荐</h5>
                        </div>

                        {{--<div class="mdl-card__menu">--}}
                        {{--<button class="mdl-button mdl-button--icon mdl-js-button">--}}
                        {{--<i class="material-icons">more</i>--}}
                        {{--</button>--}}
                        {{--</div>--}}

                        <div class="mdl-card__actions mdl-card--border recommendation-panel">
                            <ul>
                                <?php
                                $index = 0;
                                ?>

                                @foreach($data["recommendPosition"]["position"] as $position)
                                    @if(++$index < 9)
                                        <li>
                                            <div class="word_re" to="/position/detail?pid={{$position->pid}}">
                                                <div class="re_info">
                                                    <h6>
                                                    @if(empty($data['recommendPosition']['enprinfo'][$position->eid]->byname) && empty($data['recommendPosition']['enprinfo'][$position->eid]->ename))
                                                        未命名企业
                                                        @elseif($data['recommendPosition']['enprinfo'][$position->eid]->byname)
                                                            {{$data['recommendPosition']['enprinfo'][$position->eid]->byname}}
                                                        @else
                                                            {{$data['recommendPosition']['enprinfo'][$position->eid]->ename}}
                                                        @endif
                                                    </h6>
                                                    <p>
                                                        <small><b>职位:
                                                                {{--{{$position->title or '未命名职位'}}--}}
                                                                {{mb_substr($position->title, 0, 10, 'utf-8')}}
                                                            </b></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>

                            @if(count($data['recommendPosition']["position"]) == 0)
                                <div class="position-empty">
                                    <img src="{{asset('images/desk.png')}}" width="40px">
                                    <span>&nbsp;&nbsp;暂无推荐职位</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if($data["type"] == 2)

                    <div class="mdl-card mdl-shadow--2dp base-info--position info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">发布的职位</h5>
                        </div>

                        <div class="mdl-card__menu">

                            <button class="mdl-button mdl-js-button mdl-button--link" id="publish-position">发布职位
                            </button>
                            <button class="mdl-button mdl-js-button mdl-button--link" to="/position/publishList">查看所有
                            </button>

                        </div>

                        <div class="mdl-card__actions mdl-card--border recommendation-panel">
                            <ul class="position-ul">
                                <?php
                                $index = 0;
                                ?>
                                @forelse($data["positionList"] as $position)
                                    @if(++$index < 9)
                                        <li>
                                            <div class="word_re">
                                                <div class="re_info" to="/position/detail?pid={{$position->pid}}">
                                                    <h6><b>@if($position->title == null || $position->title == "")
                                                                未命名职位 @else {{$position->title}} @endif</b></h6>
                                                    <p>
                                                        <small><b>描述：</b>
                                                            @if($position->pdescribe == null || $position->pdescribe == "")
                                                                没有职位描述
                                                            @else
                                                                {{str_replace("</br>","",substr($position->pdescribe, 0, 20))}}
                                                            @endif
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @empty
                                    <div class="position-empty">
                                        <img src="{{asset('images/desk.png')}}" width="40px">
                                        <span>&nbsp;&nbsp;没有发布职位</span>
                                    </div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @endif

                @if($data["type"] == 2)
                    <div class="mdl-card mdl-shadow--2dp base-info--apply__list info-card">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text">收到的申请记录</h5>
                        </div>

                        <div class="mdl-card__menu">

                            <button class="mdl-button mdl-js-button mdl-button--icon" id="check-all"
                                    to="/position/deliverList">
                                <i class="material-icons">list</i>
                            </button>

                            <div class="mdl-tooltip" data-mdl-for="check-all">
                                查看所有
                            </div>

                        </div>

                        <div class="mdl-card__actions mdl-card--border apply-panel">
                            <ul class="apply-ul">
                                @if($data["applyList"] == null)
                                    <div class="apply-empty">
                                        <img src="{{asset('images/apply-empty.png')}}" width="50px">
                                        <span>&nbsp;&nbsp;没有申请记录</span>
                                    </div>
                                @else
                                    @foreach($data["applyList"] as $id)
                                        <li class="apply-item" to="/position/deliverDetail?did={{$id->did}}">
                                            {{--<img class="img-circle info-head-img" src="{{asset('images/avatar.png')}}"--}}
                                            {{--width="45px"--}}
                                            {{--height="45px">--}}

                                            @if($id->photo == null || $id->photo == "")
                                                <img src="{{asset('images/default-img.png')}}"
                                                     class="img-circle info-head-img"
                                                     style="display: inline"
                                                     width="56"
                                                     height="56"/>
                                            @else
                                                <img src="{{$id->photo}}" class="img-circle info-head-img" style="display: inline" width="56"
                                                     height="56"/>
                                            @endif

                                            <div class="applier-info">
                                                <p>{{$id->pname}}</p>
                                                <p>{{$id->position_title}}</p>
                                                <p>
                                                    <span>详情</span>&nbsp;&nbsp;&nbsp;
                                                    <small>申请时间:{{$id->created_at}}</small>
                                                </p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>

                            <div style="clear:both;"></div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="gap"></div>

            <div class="info-panel--right info-panel">

                @if($data["type"] == 1)
                    @include('components.baseUserProfile', ['isShowEditBtn'=>true, 'isShowFunctionPanel' => true, "info" => $data["personInfo"][0], "messageNum" => $data["messageNum"], "deliveredNum" => $data["deliveredNum"]])
                @elseif($data["type"] == 2)
                    @include('components.baseEnterpriseProfile', ['isShowMenu'=>true, 'isShowFunctionPanel' => true, "info"=>$data["enterpriseInfo"][0], "messageNum" => $data["messageNum"], "industry" => $data["industry"]])
                @endif
            </div>

        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        $('.resume-item').mouseenter(function () {
            $(this).addClass("resume-bg");
        }).mouseleave(function () {
            $(this).removeClass("resume-bg");
        });

        $("#add-resume").click(function () {
            $.ajax({
                url: "/resume/addResume",
                type: "get",
                success: function (data) {
                    if (data['status'] === 200) {
                        self.location = "/resume/add?rid=" + data['rid'];
                    } else if (data['status'] === 400) {
                        alert(data['msg']);
                    }
                }
            });
        });

        $(".verify-flag").click(function () {
            var $verifyElement = $(this);
            var isVerified = $verifyElement.hasClass("verified");
            var unverified = $verifyElement.hasClass("unverified");


            if (isVerified == 1) {
                swal({
                    title: "您已经通过认证",
                    text: "不需要再次认证",
                    confirmButtonText: "确定"
                })
            } else if (unverified == 1) {
                swal({
                    title: "您已经提交审核申请，请耐心等待",
                    text: "不需要再次提交",
                    confirmButtonText: "确定"
                })
            }
            else {
                self.location = "/account/enterpriseVerify";
            }
        });

        $("#publish-position").click(function () {
            $.ajax({
                url: "/position/checkVerification",
                type: "get",
                success: function (data) {
                    if (data['status'] === 400) {
                        swal({
                            title: data['msg'],
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        })
                    } else if (data['is_verify']) {
                        self.location = "/position/publish";
                    } else {
                        swal({
                            type: "error",
                            title: "您的企业还未通过验证",
                            text: "企业通过验证后，才可发布职位！",
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        })
                    }
                }
            })
        })
    </script>
@endsection
