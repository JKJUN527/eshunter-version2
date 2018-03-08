<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/mdl/material.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/sweetalert/sweetalert.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/select2/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/styles/default/styles.css')}}"/>
    <title>简历信息</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-header">
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">navigate_before</i>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
            @if(isset($data["education"]))
                <span class="mdl-layout__title esh-layout__title">教育经历</span>
            @elseif(isset($data["work"]))
                <span class="mdl-layout__title esh-layout__title">工作经历</span>
            @elseif(isset($data["project"]))
                <span class="mdl-layout__title esh-layout__title">项目/赛事经历</span>
            @elseif(isset($data["game"]))
                <span class="mdl-layout__title esh-layout__title">电竞经历</span>
            @else
                <span class="mdl-layout__title esh-layout__title">技能特长</span>
            @endif
        </div>
    </header>
    <main class="mdl-layout__content esh-common-list" id="esh-content">
        @if(isset($data["education"]))
            <div class="mdl-list">
                @foreach($data['education'] as $education)
                <div class="mdl-list__item">
                    <div class="mdl-list__item-primary-content">
                        <span>{{$education->school}}</span>
                    </div>
                    <span class="mdl-list__item-secondary-action esh-edit-href esh-href-page"
                          data-esh-href="/m/resume/geteduinfo?eduid={{$education->eduid}}">
                        <i class="material-icons mdl-color-text--red">edit</i>
                    </span>
                    <span class="mdl-list__item-secondary-action esh-del-href esh-edu-del"
                          data-content-id="{{$education->eduid}}">
                        <i class="material-icons esh-del-education" >delete_sweep</i>
                    </span>
                </div>
                @endforeach
            </div>
            <div class="esh-bottom-option">
                <button class="mdl-button mdl-js-button mdl-button--primary mdl-color-text--blue esh-href-page"
                        data-esh-href="/m/resume/geteduinfo">
                    <i class="material-icons">add</i><span class="esh-add-text">添加教育经验</span>
                </button>
            </div>
        @endif

        @if(isset($data["work"]))
            <div class=" mdl-list">
                @foreach($data['work'] as $work)
                    <div class="mdl-list__item">
                        <div class="mdl-list__item-primary-content">
                            <span>{{$work->position}}</span>
                        </div>
                        <span class="mdl-list__item-secondary-action esh-edit-href esh-href-page"
                              data-esh-href="/m/resume/getworkinfo?id={{$work->id}}">
                            <i class="material-icons mdl-color-text--red">edit</i>
                            </span>
                        <span class="mdl-list__item-secondary-action esh-del-href esh-del-work"
                              data-content-id="{{$work->id}}">
                                <i class="material-icons ">delete_sweep</i>
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="esh-bottom-option">
                <button class="mdl-button mdl-js-button mdl-button--primary mdl-color-text--blue esh-href-page"
                        data-esh-href="/m/resume/getworkinfo">
                    <i class="material-icons">add</i><span class="esh-add-text">添加工作经历</span>
                </button>
            </div>
        @endif

        @if(isset($data["project"]))
            <div class=" mdl-list">
                @foreach($data['project'] as $project)
                    <div class="mdl-list__item">
                        <div class="mdl-list__item-primary-content">
                            <span>{{$project->project_name}}</span>
                        </div>
                        <span class="mdl-list__item-secondary-action esh-edit-href esh-href-page"
                              data-esh-href="/m/resume/getprojectinfo?id={{$project->id}}">
                            <i class="material-icons mdl-color-text--red">edit</i>
                        </span>
                        <span class="mdl-list__item-secondary-action esh-del-href esh-del-project"
                              data-content-id="{{$project->id}}">
                            <i class="material-icons">delete_sweep</i>
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="esh-bottom-option">
                <button class="mdl-button mdl-js-button mdl-button--primary mdl-color-text--blue esh-href-page"
                        data-esh-href="/m/resume/getprojectinfo">
                    <i class="material-icons">add</i><span class="esh-add-text">添加项目/赛事经历</span>
                </button>
            </div>
        @endif


        @if(isset($data["game"]))
            <div class=" mdl-list">
                @foreach($data['game'] as $game)
                    <div class="mdl-list__item">
                        <div class="mdl-list__item-primary-content">
                            <span>{{$game->ename}}</span>
                        </div>
                        <span class="mdl-list__item-secondary-action esh-edit-href esh-href-page"
                              data-esh-href="/m/resume/getegameinfo?egid={{$game->egid}}">
                            <i class="material-icons mdl-color-text--red">edit</i>
                        </span>
                        <span class="mdl-list__item-secondary-action esh-del-href esh-del-game"
                              data-content-id="{{$game->egid}}">
                            <i class="material-icons">delete_sweep</i>
                        </span>
                    </div>
                @endforeach
            </div>
            <div class="esh-bottom-option">
                <button class="mdl-button mdl-js-button mdl-button--primary mdl-color-text--blue esh-href-page"
                        data-esh-href="/m/resume/getegameinfo">
                    <i class="material-icons">add</i><span class="esh-add-text">添加电竞经验</span>
                </button>
            </div>
        @endif

        @if(isset($data["rid"]))
            <div class=" mdl-list">
                @if(isset($data["resume"]["skill"]))
                    @foreach($data["resume"]["skill"] as $skill)
                        <div class="mdl-list__item">
                            <div class="mdl-list__item-primary-content" >
                                <input type="hidden" value="{{$data["rid"]}}" name='rid'/>
                                <span id="skill-content">{{$skill}}</span>
                            </div>
                            {{--<span class="mdl-list__item-secondary-action esh-edit-href esh-href-page"--}}
                                  {{--data-esh-href="/m/resume/geteduinfo?id={{$education->eduid}}">--}}
                                {{--<i class="material-icons">edit</i>--}}
                            {{--</span>--}}
                            <span class="mdl-list__item-secondary-action esh-del-href esh-del-skill">
                                <i class="material-icons">delete_sweep</i>
                            </span>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="esh-bottom-option">
                <button class="mdl-button mdl-js-button mdl-button--primary mdl-color-text--blue esh-href-page"
                        data-esh-href="/m/resume/addskillinfo?rid={{$data["rid"]}}">
                    <i class="material-icons">add</i><span class="esh-add-text">添加技能特长</span>
                </button>
            </div>
        @endif
    </main>
</div>
<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
<script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('mobile/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('mobile/js/utils/utils.js')}}"></script>
<script src="{{asset('mobile/js/resume/commonList.js')}}"></script>

</body>
</html>