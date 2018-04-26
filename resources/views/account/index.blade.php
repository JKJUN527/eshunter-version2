@extends('layout.master')
@section('title', '个人中心')
@section('custom-style')
    <link media="all" href="{{asset('style/ResumePreview.css?v=2.40')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('style/onlineresume.css?v=2.40')}}" type="text/css" rel="stylesheet">
    <link media="all" href="{{asset('style/tao.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/base.css?v=2.39')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('style/style_qq.css?v=2.33')}}" type="text/css" rel="stylesheet">
    <script src="{{asset('js/')}}" type="text/javascript"></script>
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
        .containter {
            width: 1200px;
            margin: 0 auto;
            padding-bottom: 15px;
            margin-top: 36px;
        }

        .jieshao_list li {
            width: 31.77%;
        }

        .position_name {
            min-width: 230px;
        }

        .mdl-card__actions .resume-item p {
            color: #fff;
            text-align: center;
            font-size: 11px;
            margin-top: 7px;
            margin-left: -4px;
            cursor: pointer;
        }

        .mdl-card__actions .resume-item {
            margin: 10px auto;
            display: inline-block;
            width: 32%;
        }

        .mdl-card__actions span.myhidden {
            font-size: 20px;
            display: block;
            margin: 10px auto;
            text-align: center;
        }

        .mdl-card__actions {
            /*text-align: center;*/
            color: #fff;
        }

        .resume-bg {
            border-radius: 2px;
            background-color: #03A9F4;
            color: #ffffff;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .Resume_con {
            width: auto;
        }

        .Resume_conCenter {
            width: auto !important;
            margin-left: 5rem;
        }
    </style>
@endsection
@section('content')

    <div style="display:none" class="tishi">
        <span id="tishi_msg"></span>
        <div style="top:5px; right:5px;" class="close_X">X</div>
    </div>
    <div class="hsbj"></div>
    <div style="display:none;" class="whitebg"></div>
    <!--这是加载AJAX的动态转图-->
    <div style="left:50%; float:left; position:fixed; top:50%; z-index:100009; display:none;" id="home_loading">
        <img src="images/anim_loading_75x75.gif">
    </div>
    <div class="containter_box">
        <div class="containter">
            <div class="online_left left">
                <!-- 个人资料预览 -->
                <div id="self_info1" class="self_info">
                    <a href="/account/edit?edit=true">
                        <div class="edit_pen" style="display: none;"></div>
                    </a>
                    <div class="Resume_con">
                        <div class="Resume_conLeft">
                            <p class="p_educate">
                                @if($data['personInfo'][0]->education == 9)
                                    未填写最高学历
                                @elseif($data['personInfo'][0]->education == 0)
                                    高中
                                @elseif($data['personInfo'][0]->education == 1)
                                    本科
                                @elseif($data['personInfo'][0]->education == 2)
                                    研究生及以上
                                @elseif($data['personInfo'][0]->education == 3)
                                    大专
                                @endif
                            </p>
                            <p class="p_gzjy">
                                @if($data['personInfo'][0]->work_year == "" ||$data['personInfo'][0]->work_year == null)
                                    未填写工作经验
                                @else
                                    {{date('Y')-$data['personInfo'][0]->work_year}}年工作经验
                                @endif
                            </p>
                            <p class="p_brithday"></p>
                        </div>
                        <div class="Resume_conCenter">
                            <dl>
                                <dt>
                                    @if($data['personInfo'][0]->photo == null)
                                        <img src="{{asset('images/default-img.png')}}">
                                    @else
                                        <img src="{{$data['personInfo'][0]->photo}}">
                                    @endif
                                </dt>
                                <dd><em>{{$data['personInfo'][0]->pname or "姓名未填写"}}</em><span
                                            class="gender @if($data['personInfo'][0]->sex == 1) boy @else woman @endif"></span>
                                </dd>
                            </dl>
                        </div>
                        <div class="Resume_conRight">
                            <p class="p_phone phone">{{$data['personInfo'][0]->tel or "手机号未填写"}}</p>
                            <p class="p_emil email"> {{$data['personInfo'][0]->mail or "邮箱未填写"}}</p>
                            <p class="p_now currentstate">{{$data['personInfo'][0]->self_evalu or "自我评价未填写"}}</p>
                        </div>
                    </div>
                </div>
                <div class="The_job">
                    <p class="p_Label"><span>为你推荐</span></p>
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
            <div class="online_right right">
                <div class="wodebiaoqian">
                    <div class="tdfk1">
                        <a class="a1" href="/message" target="_blank">站内信</a>
                        <a class="a2" href="/position/advanceSearch">查找职位</a>
                        <!--<a href="javascript:void(0);" class="a3" onclick="document.getElementById('f_jianli').click()" class="upload_jianli">上传简历</a>-->
                        <a class="upload_a upload_jianli a3" href="/position/applyList" target="_blank">申请记录</a>
                    </div>
                    <div class="default_send">
                        <!-- <div>默认投递：</div>
                        <div class="seles ">
                            <span class="seles_choose ">请选择</span>
                            <ul class="seles_hide moren default_jianli">
                                <li v="0">在线简历</li>
                                <li v="1">附件简历</li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="my_labels my_labelsie">
                        <div class="mdl-card__actions mdl-card--border resume-panel">
                            <span style="" class="myhidden">一般简历</span>
                            @foreach($data['resumeList'] as $resume)
                                <div class="resume-item">
                                    <a target="_blank" href="/resume/add?rid={{$resume->rid}}">
                                        <img src="http://eshunter.com/images/resume.png" width="70px"></a>
                                    <p>{{$resume->resume_name}}</p>
                                </div>
                            @endforeach
                            @if(count($data['resumeList']) < 3)
                                <div class="resume-item">
                                    <a id="add-resume">
                                        <img src="{{asset('images/resume_add.png')}}" width="70px"/></a>
                                    <p>添加简历</p>
                                </div>
                            @endif
                        </div>
                        <!-- <div class="compete_percent"><span style="" class="myhidden">在线简历完整度</span><a class="xz_a" href="/ro/downloadR/335729/profile/黄金/pdf" target="_blank">下载</a><a target="_blank" href="/ro/selfyulan">预览</a></div>
                        <div style="" data-perc="20" class="progressbar myhidden">
                            <div class="bar" style="width: 41px;"><span></span></div>
                            <div class="label">
                                <div class="perc">20%</div>
                            </div>
                        </div> -->
                    </div>
                    <div class="my_labels my_labelsie">
                        <div class="mdl-card__actions mdl-card--border resume-panel">
                            <span style="" class="myhidden">选手简历</span>
                            @forelse($data['playerResume'] as $resume)
                                <div class="resume-item">
                                    <a target="_blank" href="/resume/player/add?rid={{$resume->rid}}">
                                        <img src="{{asset('images/resume.png')}}" width="70px"/></a>
                                    <p>{{$resume->resume_name}}</p>
                                </div>
                            @empty
                                <div class="resume-item">
                                    <a id="add-player-resume">
                                        <img src="{{asset('images/resume_add.png')}}" width="70px"/></a>
                                    <p>选手简历</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div style="display: none;" class="my_labels">
                        <p>附件简历</p>
                        <div class="scfujianresume">
                            <div class="upload_before">
                                <input type="file" onchange="javascript:uploadjianli(1);" class="upfile" id="f_jianli"
                                       name="f_jianli">
                                <input type="hidden" value="" class="resume_name">
                                <a class="jianli" href="javascript:void(0);"></a>
                                <a class="upload_jianli" onclick="document.getElementById('f_jianli').click()"
                                   href="javascript:void(0);">上传简历</a>
                                <a class="upload_jianli upload_jianliie" href="javascript:void(0);">上传简历</a>
                                <i style="display:none" class="delete_fujian"></i>
                            </div>
                        </div>
                    </div>

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