<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>预览简历</title>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/mdl/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/default/styles.css')}}"/>
</head>
<body id="resume_preview">
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">navigate_before</i>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
                <span class="mdl-layout__title esh-layout__title esh-edit-title-name" >
                    <span id="esh-resume-name">预览简历</span>
                </span>
        </div>
    </header>
    <main class="mdl-layout__content esh-resume-info esh-preview" >
        @if(count($data['personInfo']) != 0)
        <div class="esh-account-info mdl-card">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">个人信息</h2>
            </div>
                <div class="mdl-card__title">
                    <div class="esh-preview__img">
                        @if($data["personInfo"][0]["photo"]== null)
                            <img src="{{asset('mobile/styles/default/images/default-img.png')}}"
                                 class="esh-account-img" id="upload-head--img"/>
                        @else
                        <img src="{{$data["personInfo"][0]["photo"]}}" class="esh-account-img" id="upload-head--img"/>
                        @endif
                    </div>
                    <div class="esh-preview__info">
                        <span class="esh-text-l">{{$data["personInfo"][0]["pname"] or "姓名未填写"}}</span>
                        <div class="esh-text-l">
                            <span>
                                @if($data["personInfo"][0]["sex"] == null)
                                    性别未填写
                                @elseif($data["personInfo"][0]["sex"] == 1)
                                    男
                                @elseif($data["personInfo"][0]["sex"] == 2)
                                    女
                                @endif
                            </span>|
                            <span>{{$data["personInfo"][0]["residence"] or "居住地未填写"}}</span>
                        </div>
                        <div>出生日期：{{$data["personInfo"][0]["birthday"] or "生日未填写"}}</div>
                        <div>手机号码：{{$data["personInfo"][0]["tel"] or "手机号未填写"}}</div>
                        <div>联系邮箱：{{$data["personInfo"][0]["mail"]  or "邮箱未填写"}}</div>
                    </div>
                </div>
           {{-- <div class="mdl-card__supporting-text">
                <span class="esh-text-l">{{$data["personInfo"][0]["pname"] or "姓名未填写"}}</span>
                <div>
                <span>
                    @if($data["personInfo"][0]["sex"] == null)
                        性别未填写
                    @elseif($data["personInfo"][0]["sex"] == 1)
                        男
                    @elseif($data["personInfo"][0]["sex"] == 2)
                        女
                    @endif
                </span>|
                    <span>{{$data["personInfo"][0]["birthday"] or "生日未填写"}}&nbsp;</span>|
                    <span>{{$data["personInfo"][0]["residence"] or "居住地未填写"}}</span>
                </div>
                <div>手机：{{$data["personInfo"][0]["tel"] or "手机号未填写"}}</div>
                <div>邮箱：{{$data["personInfo"][0]["mail"]  or "邮箱未填写"}}</div>
            </div>--}}
        </div>
        <div class="mdl-card ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">自我评价</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="esh-no-content">
                    {{$data["personInfo"][0]["self_evalu"] or "自我评价未填写"}}
                </div>
            </div>
        </div>
        @else
            <div class="mdl-card ">
                <div class="mdl-card__title mdl-card--border">
                    <h2 class="mdl-card__title-text">个人信息</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <div class="esh-no-content">
                        个人资料暂未填写，资料填写后这里将显示您的基本信息
                    </div>
                </div>
            </div>
        @endif
        <!--可以从resumeInfo里面提取-->
        <div class="mdl-card mdl-card--border">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">求职意向</h2>
                <!--<div class="mdl-card__menu">-->
                    <!--<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"-->
                            <!--onclick="window.location.href='jobIntension.html'">-->
                        <!--<i class="material-icons">chevron_right</i>-->
                    <!--</button>-->
                <!--</div>-->
            </div>
            <div class="mdl-card__supporting-text">
                @if($data['intention'] == null)
                    <div class="esh-no-content">
                        未填写求职意向
                    </div>
                @else
                    <div class="esh-resume-info-t">
                        <label>工作地点</label>
                        <div>
                            @foreach($data['region'] as $region)
                                @if($data['intention']->region == $region->id)
                                    {{$region->name}}
                                    @break
                                @elseif($data['intention']->region == -1)
                                    任意
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>行业分类</label>
                        <div>
                            @foreach($data['industry'] as $industry)
                                @if($data['intention']->industry == $industry->id)
                                    {{$industry->name}}
                                    @break
                                @elseif($data['intention']->industry == -1)
                                    任意
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>职业分类</label>
                        <div>
                            @foreach($data['occupation'] as $occupation)
                                @if($data['intention']->occupation == $occupation->id)
                                    {{$occupation->name}}
                                    @break
                                @elseif($data['intention']->occupation == -1)
                                    任意
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>工作类型</label>
                        <div>
                            @if($data['intention']->work_nature == -1)
                                任意
                            @elseif($data['intention']->work_nature == 0)
                                兼职
                            @elseif($data['intention']->work_nature == 1)
                                实习
                            @elseif($data['intention']->work_nature == 2)
                                全职
                            @endif
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>期望薪资</label>
                        <div>
                            @if($data['intention']->salary < 0)
                                未指定
                            @else
                                {{$data['intention']->salary}} 元
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </div>
        <div class="mdl-card">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">教育经历</h2>
                <!--<div class="mdl-card__menu">-->
                    <!--<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"-->
                            <!--onclick="window.location.href='commonList.html'">-->
                        <!--<i class="material-icons">chevron_right</i>-->
                    <!--</button>-->
                <!--</div>-->
            </div>
            <div class="mdl-card__supporting-text">
                @forelse($data['education'] as $education)
                    <div class="esh-tlbox" data-content="{{$education->eduid}}">
                        <div class="esh-timeline">
                            @if($education->gradu_date !=NULL)
                                <p class="point">{{str_replace('-','/',$education->date)}}-{{str_replace('-','/',$education->gradu_date)}}</p>
                            @else
                                <p class="point">{{$education->date}}- -</p>
                            @endif
                            <p class="point">{{$education->school}}</p>
                            <p class="suptext">
                                <span>{{$education->major}}</span>|
                                @if($education->degree == 0)
                                    高中
                                @elseif($education->degree == 1)
                                    本科
                                @elseif($education->degree == 2)
                                    硕士及以上
                                @elseif($education->degree == 3)
                                    专科
                                @endif
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="esh-no-content">
                        未填写教育经历
                    </div>
                @endforelse
            </div>

        </div>
        <div class="mdl-card  ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">工作经历</h2>
            </div>
            <div class="mdl-card__supporting-text">
                @forelse($data['work'] as $work)
                    <div class="esh-tlbox"  data-content="{{$work->id}}">
                        <?php
                        $index = 1;
                        ?>
                        <div class="esh-timeline">
                            <p class="point">
                                @foreach(explode('@', $work->work_time) as $time)
                                    @if($index == 1)
                                        {{str_replace('-','/',$time)}} --
                                    @elseif($index == 2)
                                        {{str_replace('-','/',$time)}}
                                    @endif
                                    <?php $index++ ?>
                                @endforeach
                            </p>
                            <p class="point">{{$work->ename}}</p>
                            <p class="suptext">{{$work->position}}</p>
                            <p class="suptext">{!! $work->describe !!}</p>
                        </div>
                    </div>
                @empty
                    <div class="esh-no-content">
                        未填写工作经历
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mdl-card ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">项目/赛事经历</h2>
                <!--<div class="mdl-card__menu">-->
                    <!--<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"-->
                            <!--onclick="window.location.href='commonList.html'">-->
                        <!--<i class="material-icons">chevron_right</i>-->
                    <!--</button>-->
                <!--</div>-->
            </div>
            <div class="mdl-card__supporting-text">
                @forelse($data['project'] as $project)
                    <div class="esh-tlbox" data-content="{{$project->id}}">
                        <?php
                        $index = 1;
                        ?>
                        <div class="esh-timeline">
                            <p class="point">
                                @foreach(explode('@', $project->project_time) as $time)
                                    @if($index == 1)
                                        {{str_replace('-','/',$time)}} --
                                    @elseif($index == 2)
                                        {{str_replace('-','/',$time)}}
                                    @endif
                                    <?php $index++ ?>
                                @endforeach
                            </p>
                            <p class="point">{{$project->project_name}}</p>
                            <p class="suptext">{{$project->position}}</p>
                            <p class="suptext">{!! $project->describe !!}</p>
                        </div>
                    </div>
                @empty
                    <div class="esh-no-content">
                        未填写赛事经历
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mdl-card ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">电竞经验</h2>
                <!--<div class="mdl-card__menu">-->
                    <!--<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"-->
                            <!--onclick="window.location.href='commonList.html'">-->
                        <!--<i class="material-icons">chevron_right</i>-->
                    <!--</button>-->
                <!--</div>-->
            </div>
            <div class="mdl-card__supporting-text">
                @forelse($data['game'] as $game)
                    <div class="esh-tlbox" data-content="{{$game->egid}}">
                        <div class="esh-timeline">
                            <p class="point">{{str_replace('-','/',$game->date)}} 开始接触</p>
                            <p class="point">{{$game->ename}}</p>
                            <p class="suptext">{{$game->level}}</p>
                            @if($game->extra != null && $game->extra != "")
                                <p class="suptext">{!! $game->extra !!}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="esh-no-content">
                        未填写电竞经历
                    </div>
                @endforelse
            </div>
        </div>
        <div class="mdl-card">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">技能特长</h2>
                <!--<div class="mdl-card__menu">-->
                    <!--<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">-->
                        <!--<i class="material-icons">edit</i>-->
                    <!--</button>-->
                <!--</div>-->
            </div>
            <div class="mdl-card__supporting-text">
                @if($data['resume']['skill'] == null)
                    <div class="esh-skill"> 未填写技能特长</div>
                @else
                    @foreach($data['resume']['skill'] as $skill)
                        <div class="esh-skill">{{$skill}}</div>
                    @endforeach
                @endif
            </div>

        </div>
        <div class="mdl-card ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">附加信息</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="esh-skill"> {{$data['resume']->extra or "未填写附加信息"}}</div>
            </div>
        </div>

        {{--<div class="esh-edit-fb">--}}
            {{--<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"--}}
                {{--id="esh-download-resume">--}}
                {{--下载简历--}}
            {{--</button>--}}
        {{--</div>--}}
    </main>
</div>
<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
<script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('mobile/js/utils/utils.js')}}"></script>
<script src="{{asset('mobile/plugins/pdf.js')}}"></script>
<script>
    $("#esh-download-resume").click(function(){
        var doc = new PDF24Doc({
            charset : "UTF-8",
            // headline : "电竞猎人个人简历",
            // headlineUrl : "http://www.pdf24.org",
            // baseUrl : "http://www.pdf24.org",
            filename : "个人简历",
            pageSize : "210x297",
            emailTo : "stefanz@pdf24.org",
            emailFrom : "stefanz@pdf24.org",
            emailSubject: "电竞猎人简历中心",
            emailBody: "感谢您使用电竞猎人！",
            emailBodyType: "text"
        });

        /*
         * Add an element without using PDF24Element
         */
        doc.addElement({
            // title : "This is a title",
            // url : "http://www.pdf24.org",
            // author : "Stefan Ziegler",
            // dateTime : "2010-04-15 8:00",
            body :$('#resume_preview').html()
        });

        /*
         * Create the PDF file
         */
        doc.create();
    });
</script>
</body>
</html>