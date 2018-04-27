@extends('layout.master')
@section('title', '个人中心')
@section('custom-style')
    <link media="all" href="{{asset('style/ResumePreview.css?v=2.40')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('style/onlineresume.css?v=2.40')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('style/tao.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/base.css?v=2.39')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/style_qq.css?v=2.33')}}" type="text/css" rel="stylesheet">
    <script src="{{asset('js/choose.js?v=2.33')}}" type="text/javascript"></script>
    <script src="{{asset('js/placeholder.js?v=2.32')}}" type="text/javascript"></script>
    <script src="{{asset('js/progressbar.js?v=2.32')}}" type="text/javascript"></script>
    <script defer="defer" src="{{asset('js/constants.js?v=2.32')}}" type="text/javascript"></script>
    <script src="{{asset('js/onlineresume.js?v=2.38')}}" charset="utf-8" type="text/javascript"></script>
    <script defer="defer" src="{{asset('js/ajaxfileupload.js?v=2.32')}}" type="text/javascript"></script>
    <script defer="defer" src="{{asset('js/common.js?v=2.34')}}" type="text/javascript"></script>
    <script defer="defer" src="{{asset('js/selectphoto.js?v=2.32')}}" type="text/javascript"></script>
    <script defer="defer" src="{{asset('js/jquery.imgareaselect.pack.js')}}" type="text/javascript"></script>
    <script defer="defer" src="{{asset('js/loading.js?v=2.32')}}" type="text/javascript"></script>

    <script defer="defer" src="{{asset('js/center.js?v=2.32')}}" type="text/javascript"></script>
    <style>
        body {
            background: #EEEEEE;
        }

        .container {
            width: 1200px;
            margin: 36px auto;
            padding-bottom: 15px;
        }

        .info_left, .info_right {
            display: inline-block;
            vertical-align: top;
            background: #fff;
        }

        .info_left {
            width: 210px;
        }

        .info_right {
            width: 965px;
            min-height: 400px;
            float: right;
            margin-bottom: 50px;
        }

        .info_left ul {
            float: left;
            width: 214px;
            background: #FFFFFF;
        }

        .info_left ul li {
            width: 210px;
            height: 58px;
            line-height: 58px;
            border-left: 4px #ffffff solid;
            border-bottom: #E6E6E6 1px solid;
            overflow: hidden;
            vertical-align: middle;
        }

        .info_left ul li.active {
            width: 210px;
            border-left: 4px #00b38a solid !important;
            background: #F7F7F7;
        }

        .info_left ul li:hover {
            width: 210px;
            border-left: 4px #00b38a solid !important;
            background: #F7F7F7;
        }

        .info_left ul li a {
            cursor: pointer;
            display: inline-block;
            width: 210px;
            height: 58px;
        }

        .info_left ul li a i {
            width: 17px;
            height: 17px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 16px;
        }

        .top_info {
            margin: 28px;
            padding-bottom: 28px;
            /*border-bottom: 1px solid #c1c1c1;*/
        }

        .headPic {
            float: left;
        }

        .headPic .pic {
            border: 1px #C1C1C1 solid;
        }

        .per_info {
            float: left;
            margin-top: 5px;
            width: 750px;
        }

        .per_info .detail,
        .per_info .op_num {
            margin-left: 30px;
        }

        dl {
            margin: 0;
            padding: 0;
        }

        .per_info .detail dl dt {
            font-size: 18px;
            color: #444;
        }

        .per_info .detail dl dd {
            font-size: 15px;
            margin-top: 12px;
        }

        .per_info .detail ul {
            margin-top: 8px;
        }

        .per_info .detail ul li {
            float: left;
            height: 20px;
            margin-right: 20px;
            line-height: 20px;
            font-size: 13px;
        }

        .per_info .detail ul li:first-child a {
            font-size: 18px !important;
            color: #000 !important;
        }

        .per_info .detail ul li:last-child {
            float: right !important;
        }

        .detail {
            border-bottom: 1px solid #dddddd;
            padding-bottom: 10px;
            display: block;
        }

        .detail ul li a {
            float: left;
            color: #B2B2B2;
            display: block;
            cursor: default;
        }

        .detail ul li a[href] {
            cursor: pointer;
        }

        .detail ul li a i {
            font-size: 16px;
            position: relative;
            top: 3px;
            margin-right: 8px;
        }

        li.edit_per_info a {
            color: #00b38a !important;
        }

        .op_num {
            margin-top: 25px;
        }

        .op_num ul li {
            float: left;
            width: 120px;
            height: 80px;
            text-align: center;
            border-left: 1px solid #f1f1f1;
            cursor: pointer;
        }

        .op_num ul li:hover {
            background-color: #f1f1f1;
        }

        .op_num ul li a {
            position: relative;
            top: 13px;
        }

        .op_num ul li:first-child {
            border: none;
        }

        .op_num ul li a span:first-child {
            font-size: 24px;
        }

        .op_num ul li a span:last-child {
            display: block;
            margin-top: 10px;
            font-size: 16px;
            color: #7F7F7F;
        }

        .resume_list {
            width: 965px;
            border-top: 1px #D8E3EB solid;
            background: #F5F8FA;
            min-height: 300px;
        }

        .resume_list > p,
        .job_recommendation > p {
            font-size: 18px;
            font-weight: bold;
            padding-left: 15px;
            margin: 20px 0 15px 10px;
            border-left: 3px solid #00b38a;
        }

        .resume-item {
            width: 150px;
            display: inline-block;
            cursor: pointer;
            margin: 10px 0;
            border-right: 1px solid #f1f1f1;
            padding: 10px;
        }

        .resume_list .resume-item:last-child {
            border: none;
        }

        .resume-item:hover {
            background-color: #f1f1f1;
        }

        .resume-item a {
            width: 150px;
            text-align: center;
        }

        .resume-item label {
            color: #505050;
            width: 150px;
            text-align: center;
            font-size: 13px;
            font-weight: bold;
            float: left;
            margin-top: 5px;
        }

        .divider {
            width: 900px;
            height: 1px;
            background-color: #D8E3EB;
            margin: 0 auto;
        }

        .job_recommendation {
            min-height: 300px;
            border-top: 1px solid #D8E3EB;
        }

        .The_job_con {
            margin-left: 15px;
        }

    </style>
@endsection
@section('content')

    <div class="container">
        <div class="info_left info_panel" style="background: white;">
            <ul>
                <li class="active">
                    <a><i class="iconfont icon-home"></i><span>帐户中心</span></a>
                </li>

                <li class="">
                    <a href="/position/applyList">
                        <i class="iconfont icon-jianli"></i>
                        <span>申请记录</span>
                    </a>
                </li>

                <li class="">
                    <a href="/message">
                        <i class="iconfont icon-jianli"></i>
                        <span>站内信</span>
                    </a>
                </li>

                <li class="">
                    <a href="/position/advanceSearch">
                        <i class="iconfont icon-jianli"></i>
                        <span>查找职位</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="info_right info_panel">
            <div class="top_info">
                <div class="headPic">
                    <div class="pic">
                        @if($data['personInfo'][0]->photo == null)
                            <img src="{{asset('images/default-img.png')}}" width="150" height="150">
                        @else
                            <img src="{{$data['personInfo'][0]->photo}}" width="150" height="150">
                        @endif
                    </div>
                </div>

                <div class="per_info">
                    <div class="detail">
                        <ul>
                            <li><a><i></i>{{$data['personInfo'][0]->pname or "姓名未填写"}}</a></li>
                            <li>
                                <a><i class="material-icons">phone</i>
                                    {{$data['personInfo'][0]->tel or "手机号未填写"}}
                                </a>
                            </li>

                            <li>
                                <a><i class="material-icons">mail</i>
                                    {{$data['personInfo'][0]->mail or "邮箱未填写"}}
                                </a>
                            </li>

                            <li>
                                <a><i class="material-icons">work</i>
                                    @if($data['personInfo'][0]->work_year == "" ||$data['personInfo'][0]->work_year == null)
                                        未填写工作经验
                                    @else
                                        {{date('Y')-$data['personInfo'][0]->work_year}}年工作经验
                                    @endif
                                </a>
                            </li>

                            <li>
                                <a><i class="material-icons">school</i>
                                    @if($data['personInfo'][0]->education == 9)
                                        未填写
                                    @elseif($data['personInfo'][0]->education == 0)
                                        高中
                                    @elseif($data['personInfo'][0]->education == 1)
                                        本科
                                    @elseif($data['personInfo'][0]->education == 2)
                                        研究生+
                                    @elseif($data['personInfo'][0]->education == 3)
                                        大专
                                    @endif
                                </a>
                            </li>

                            <li class="edit_per_info">
                                <a href="/account/edit?edit=true"><i class="material-icons">edit</i>编辑</a>
                            </li>
                        </ul>
                        <div style="clear:both;"></div>
                    </div>

                    <div class="op_num">
                        <ul>
                            <li><a href=""><span>?%</span><span>简历完善度</span></a></li>
                            <li><a href=""><span>?</span><span>面试通知</span></a></li>
                            <li><a href=""><span>?</span><span>简历投递记录</span></a></li>
                            <li><a href=""><span>?</span><span>浏览记录</span></a></li>
                            <li><a href=""><span>?</span><span>简历被下载</span></a></li>
                        </ul>
                    </div>
                </div>

                <div style="clear:both;"></div>
            </div>

            <div class="resume_list">
                <p>一般简历</p>

                @foreach($data['resumeList'] as $resume)
                    <div class="resume-item">
                        <a target="_blank" href="/resume/add?rid={{$resume->rid}}">
                            <img src="http://eshunter.com/images/resume.png" width="70px">
                        </a>
                        <label>{{$resume->resume_name}}</label>
                    </div>
                @endforeach

                @if(count($data['resumeList']) < 3)
                    <div class="resume-item">
                        <a id="add-resume">
                            <img src="{{asset('images/resume_add.png')}}" width="70px"/></a>
                        <label>添加一般简历</label>
                    </div>
                @endif

                <div class="divider"></div>

                <p>选手简历</p>
                @forelse($data['playerResume'] as $resume)
                    <div class="resume-item">
                        <a target="_blank" href="/resume/player/add?rid={{$resume->rid}}">
                            <img src="{{asset('images/resume.png')}}" width="70px"/></a>
                        <label>{{$resume->resume_name}}</label>
                    </div>
                @empty
                    <div class="resume-item">
                        <a id="add-player-resume">
                            <img src="{{asset('images/resume_add.png')}}" width="70px"/></a>
                        <label>添加选手简历</label>
                    </div>
                @endforelse
            </div>

            <div class="job_recommendation">
                <p>为你推荐</p>

                <div class="The_job_con">
                    <ul class="jieshao_list hotjobs" style="display: block;">
                        <?php
                        $index = 0;
                        ?>

                        @foreach($data["recommendPosition"]["position"] as $position)
                            @if(++$index <= 9)
                                <li>
                                    <div class="jieshao_list_left left">
                                        <div class="list_top">
                                            <div class="clearfix pli_top">
                                                <div class="position_name left">
                                                    <h2 class="dib"><a
                                                                href="/position/detail?pid={{$position->pid}}">{{mb_substr($position->title,0,9,'utf-8')}}</a>
                                                    </h2>
                                                    <span class="create_time">&ensp;[{{substr($position->updated_at,0,10)}}
                                                        ]&ensp;</span>
                                                </div>
                                                <span class="salary right">
                                                @if($position->salary <= 0)
                                                        月薪面议
                                                    @else
                                                        {{$position->salary/1000}}k-
                                                        @if($position->salary_max ==0) 无上限
                                                        @else {{$position->salary_max/1000}}k
                                                        @endif
                                                        元/月
                                                    @endif
                                            </span>
                                            </div>
                                            <div class="position_main_info">
                                            <span>
                                                @if($position->work_nature == 0)
                                                    兼职
                                                @elseif($position->work_nature == 1)
                                                    实习
                                                @else
                                                    全职
                                                @endif
                                            </span>
                                                <span>
                                                @if($position->education == -1)
                                                        无学历要求
                                                    @elseif($position->education == 0)
                                                        高中及以上
                                                    @elseif($position->education == 3)
                                                        专科及以上
                                                    @elseif($position->education == 1)
                                                        本科及以上
                                                    @elseif($position->education == 2)
                                                        研究生及以上
                                                    @endif
                                            </span>
                                            </div>
                                            <div class="lebel">
                                                <div class="lebel_item">
                                                    @if($position->tag ==="" || $position->tag ===null)
                                                        <span class="wordCut">无标签</span>
                                                    @else
                                                        @foreach(preg_split("/(,| |、)/",$position->tag) as $tag)
                                                            <span class="wordCut">{{$tag}}</span>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pli_btm">
                                            <a href="/company?eid={{$position->eid}}" class="left">
                                                <img
                                                        @if($position->elogo === "" ||$position->elogo === null)
                                                        src="../images/pic0.jpg"
                                                        @else
                                                        src="{{$position->elogo}}"
                                                        @endif
                                                        alt="公司logo" class="company-logo" width="40" height="40">
                                            </a>
                                            <div class="bottom-right">
                                                <div class="company_name wordCut">
                                                    <a href="/company?eid={{$position->eid}}">
                                                        @if($position->byname != "")
                                                            {{$position->byname}}
                                                        @else
                                                            {{$position->ename}}
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="industry wordCut">
                                                    <span>{{mb_substr($position->ebrief,0,20,'utf-8')}}</span>
                                                    {{--<span>未融资</span>--}}
                                                    {{--<span>成都-高新pli-btm</span>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
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
        $("#add-player-resume").click(function () {
            $.ajax({
                url: "/resume/addPlayerResume",
                type: "get",
                success: function (data) {
                    if (data['status'] === 200) {
                        self.location = "/resume/player/add?rid=" + data['rid'];
                    } else if (data['status'] === 400) {
                        alert(data['msg']);
                    }
                }
            });
        });
    </script>
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