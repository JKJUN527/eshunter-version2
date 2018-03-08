<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>简历详情</title>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/mdl/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/default/styles.css')}}"/>
</head>
<body>
    <!--编辑、添加页面共用resumeInfo.html-->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
        <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
            <div class="mdl-layout-icon esh-layout-reload-icon--left">
                <i class="material-icons esh-icon">navigate_before</i>
            </div>
            <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
                {{--esh-edit-title-name--}}
                <span class="mdl-layout__title esh-layout__title " >
                    {{--<!--{{$data['resume']->resume_name}}-->--}}
                    <span id="esh-resume-name">{{$data['resume']->resume_name}}</span>
                    <i class="material-icons esh-edit-icon" id="esh-edit-name">edit</i>

                </span>

            </div>
        </header>
        <main class="mdl-layout__content esh-resume-info" id="esh-content" style="background-color: #f6f6f5;">
            <input type="hidden" name="rid" value="{{$data['rid']}}">
            <div class="mdl-card mdl-card--border">
                <div class="mdl-card__title mdl-card--border esh-href-page"
                     data-esh-href="/m/resume/getIntention?rid={{$data['rid']}}">
                    <h2 class="mdl-card__title-text">求职意向</h2>
                    <div class="mdl-card__menu" >
                       {{-- <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                            --}}{{--<i class="material-icons">chevron_right</i>--}}{{--
                        </button>--}}
                    </div>
                </div>
                <div class="mdl-card__supporting-text">
                    @if($data['intention'] == null)
                    <div class="esh-no-content">
                        您还没有填写过求职意向，点击右上角进行填写
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
            <div class="mdl-card ">
                <div class="mdl-card__title mdl-card--border esh-href-page" data-esh-href="/m/resume/getEduExpInfo">
                    <h2 class="mdl-card__title-text">教育经历</h2>
                   {{-- <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"
                                onclick="window.location.href='commonList.html'">
                            --}}{{--<i class="material-icons">chevron_right</i>--}}{{--
                        </button>
                    </div>--}}
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
                            您还没有填写过教育经历，点击右上角进行填写
                        </div>
                    @endforelse
                </div>

            </div>
            <div class="mdl-card">
                <div class="mdl-card__title mdl-card--border esh-href-page" data-esh-href="/m/resume/getWorkExpInfo">
                    <h2 class="mdl-card__title-text">工作经历</h2>
                    {{--<div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"
                                onclick="window.location.href='commonList.html'">
                            --}}{{--<i class="material-icons">chevron_right</i>--}}{{--
                        </button>
                    </div>--}}
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
                            您还没有填写过工作经历，点击右上角进行填写
                        </div>
                    @endforelse
                    {{--<div class="esh-tlbox">--}}
                        {{--<div class="esh-timeline">--}}
                            {{--<p class="point">2015/9/17~2017/12/17</p>--}}
                            {{--<p class="point">腾讯科技</p>--}}
                            {{--<p class="suptext">web前端</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>

            <div class="mdl-card ">
                <div class="mdl-card__title mdl-card--border esh-href-page" data-esh-href="/m/resume/getProExpInfo">
                    <h2 class="mdl-card__title-text">项目/赛事经历</h2>
                    {{--<div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"
                                onclick="window.location.href='commonList.html'">
                            --}}{{--<i class="material-icons">chevron_right</i>--}}{{--
                        </button>
                    </div>--}}
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
                            您还没有填写过项目经历，点击右上角进行填写
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="mdl-card ">
                <div class="mdl-card__title mdl-card--border esh-href-page" data-esh-href="/m/resume/getGameExpInfo">
                    <h2 class="mdl-card__title-text">电竞经验</h2>
                    {{--<div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                            --}}{{--<i class="material-icons">chevron_right</i>--}}{{--
                        </button>
                    </div>--}}
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
                            您还没有填写过电竞经历
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="mdl-card">
                <div class="mdl-card__title mdl-card--border esh-href-page"
                     data-esh-href="/m/resume/getSkillInfo?rid={{$data['rid']}}">
                    <h2 class="mdl-card__title-text">技能特长</h2>
                    {{--<div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"
                                type="button" id="esh-skill-button">
                            --}}{{--<i class="material-icons">chevron_right</i>--}}{{--
                        </button>
                    </div>--}}
                </div>
                <div class="mdl-card__supporting-text">
                    @if($data['resume']['skill'] == null)
                        <div class="esh-skill"> 您还没有填写过技能特长，点击右上角进行填写</div>
                    @else
                        @foreach($data['resume']['skill'] as $skill)
                            <div class="esh-skill">{{$skill}}</div>
                        @endforeach
                    @endif
                </div>

            </div>
            <div class="mdl-card ">
                {{-- esh-no-after --}}
                <div class="mdl-card__title mdl-card--border" id="esh-extra-message">
                    <h2 class="mdl-card__title-text">附加信息</h2>
                    <div class="mdl-card__menu" id="esh-extra-message">
                        {{--<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"
                            type="button" id="esh-extra-message">
                            <i class="material-icons">edit</i>
                        </button>--}}
                    </div>
                </div>
                <div class="mdl-card__supporting-text">
                    <div class="esh-skill" id="esh-skill-content">
                        {{$data['resume']->extra or "还有什么是我们没想到的？在这里填写你想填写的任意内容"}}
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('mobile/js/utils/utils.js')}}"></script>
    <script src="{{asset('mobile/js/resume/resumeInfo.js')}}"></script>
</body>
</html>