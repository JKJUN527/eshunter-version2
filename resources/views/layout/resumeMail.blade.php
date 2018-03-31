<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="baidu-site-verification" content="2qvzcodiFx" />
    <title>发送简历到邮箱</title>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/style.css')}}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicon/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicon/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicon/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicon/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicon/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicon/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicon/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicon/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-icon-180x180.png')}}">

    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('favicon/android-icon-192x192.png')}}">

    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicon/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicon/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    @section('custom-style')
        <link rel="stylesheet" type="text/css" href="{{asset('style/font-awesome.min.css')}}"/>
        <style>
            .resume-card {
                width: 100%;
                margin: 50px 0 20px 0;
                min-height: 0;
            }

            .mdl-card__title i{
                color:tomato;
                margin-right: 2px;
                /*padding-bottom: 3px;*/
            }

            .mdl-card__supporting-text {
                padding-top: 3px;
            }

            .resume-child-card {
                width: 100%;
                min-height: 0;
                padding-bottom: 40px;
                /*margin-bottom:20px;*/
            }

            .resume-child-card .mdl-card__title-text {
                font-size: 18px;
                font-weight: 600;
                /*margin-bottom: 12px;*/
            }

            .intention-panel p,
            .education-panel p,
            .work-panel p {
                padding: 5px 25px;
                display: inline-block;
                color: #333333;
                font-size: 16px;
                margin-bottom: 0;
            }

            .education-panel p,
            .work-panel p {
                display: block !important;
            }

            .education-panel p span,
            .work-panel p span {
                margin-right: 10px;
                overflow: hidden;
                white-space: nowrap;
                display: inline-block;
                text-overflow: ellipsis;
            }
            .education-panel p span:first-child{
                /*min-width: 103px;*/
                /*width: 105px;*/
            }
            .education-panel p span:nth-child(2){
                /*width: 80px;*/
                /*max-width: 100px;*/
            }
            .education-panel p span:last-child{
                min-width: 103px;
                max-width: 200px;
            }

            .education-panel p span,
            .work-panel p span {
                margin-right: 10px;
            }

            .skill-panel span {
                display: inline-block;
                background: #03A9F4;
                padding: 8px 25px 8px 12px;
                margin: 6px;
                font-size: 13px;
                font-weight: 300;
                color: #ffffff;
                border-radius: 3px;
                position: relative;
            }

            .additional-panel p {
                padding: 0 8px;
            }

            .mdl-card__supporting-text a {
                cursor: pointer;
                color: #232323;
            }

            .mdl-card__supporting-text a:hover {
                text-decoration: underline;
            }

            .base-info__title {
                width: 800px !important;
            }

        </style>
    @show
</head>
<body>

<header class="header-layout">

</header>

@section('content')
    <div class="info-panel">
        <div class="container">
            <div id="resume_preview">
                <div class="mdl-card resume-child-card base-info--user" style="padding-bottom: 20px;">

                    @if(count($personInfo) != 0)
                        <div class="base-info__header">
                            <img class="img-circle info-head-img"
                                 src="{{$personInfo[0]->photo or asset('images/avatar.png')}}" width="70px"
                                 height="70px">

                            <div class="base-info__title">
                                <p>{{$personInfo[0]->pname or "姓名未填写"}}</p>
                                <p><span>
                                    @if($personInfo[0]->sex == null)
                                            性别未填写
                                        @elseif($personInfo[0]->sex == 1)
                                            男
                                        @elseif($personInfo[0]->sex == 2)
                                            女
                                        @endif
                                </span> |
                                    <span>{{$personInfo[0]->birthday or "生日未填写"}}</span> |
                                    <span>
                                    @if($personInfo[0]->residence == null)
                                            居住地未填写
                                        @else
                                            {{$personInfo[0]->residence}}
                                        @endif
                                </span>
                                </p>
                            </div>
                        </div>

                        <div class="mdl-card__actions mdl-card--border">
                            <div class="mdl-card__title">
                                <i class="fa fa-user-circle-o fa-2" aria-hidden="true"></i><h6 class="mdl-card__title-text">自我评价</h6>
                            </div>

                            <div class="mdl-card__supporting-text">
                                {{$personInfo[0]->self_evalu or "自我评价未填写"}}
                            </div>
                        </div>

                        <ul class="mdl-list base-info__contact">
                            <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">phone</i>
                                {{$personInfo[0]->tel or "手机号未填写"}}
                            </span>
                            </li>
                            <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">email</i>
                                {{$personInfo[0]->mail or "邮箱未填写"}}
                            </span>
                            </li>
                        </ul>
                    @else
                        <div class="mdl-card__supporting-text"
                             style="padding: 24px 0 8px 24px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                            <p>个人资料暂未填写，资料填写后这里将显示您的基本信息</p>
                        </div>
                    @endif
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-pencil fa-2" aria-hidden="true"></i>
                        <h5 class="mdl-card__title-text">求职意向</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border intention-panel">

                        @if($intention == null)
                            <div class="mdl-card__supporting-text">
                                您还没有填写过求职意向
                            </div>
                        @else
                            <p>地区：
                                <span>
                                    @foreach($region as $tempregion)
                                        @if($intention->region == $tempregion->id)
                                            {{$tempregion->name}}
                                            @break
                                        @elseif($intention->region == -1)
                                            任意
                                            @break
                                        @endif
                                    @endforeach
                                </span>
                            </p>
                            <p>行业分类：
                                <span>
                                    @foreach($industry as $tempindustry)
                                        @if($intention->industry == $tempindustry->id)
                                            {{$tempindustry->name}}
                                            @break
                                        @elseif($intention->industry == -1)
                                            任意
                                            @break
                                        @endif
                                    @endforeach
                                </span>
                            </p>
                            <p>职业分类：
                                <span>
                                    @foreach($occupation as $tempccupation)
                                        @if($intention->occupation == $tempccupation->id)
                                            {{$tempccupation->name}}
                                            @break
                                        @elseif($intention->occupation == -1)
                                            任意
                                            @break
                                        @endif
                                    @endforeach
                                </span>
                            </p>
                            <p>工作类型：
                                <span>
                                    @if($intention->work_nature == -1)
                                        任意
                                    @elseif($intention->work_nature == 0)
                                        兼职
                                    @elseif($intention->work_nature == 1)
                                        实习
                                    @elseif($intention->work_nature == 2)
                                        全职
                                    @endif
                                </span>
                            </p>

                            <p>期望薪资（月）:
                                <span>
                                    @if($intention->salary < 0)
                                        未指定
                                    @else
                                        {{$intention->salary}} 元
                                    @endif
                                </span>
                            </p>
                        @endif
                    </div>
                </div>
            @if($resume['type'] == 0)
                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-graduation-cap fa-2" aria-hidden="true"></i>
                        <h5 class="mdl-card__title-text">教育经历</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border education-panel">

                        @forelse($education as $tempeducation)
                            <p>
                                <span>{{$tempeducation->school}}</span>
                                <span>{{$tempeducation->date}}入学</span>
                                <span>{{$tempeducation->major}}</span>
                                <span>
                                    @if($tempeducation->degree == 0)
                                        高中
                                    @elseif($tempeducation->degree == 1)
                                        本科
                                    @elseif($tempeducation->degree == 3)
                                        专科
                                    @elseif($tempeducation->degree == 2)
                                        硕士及以上
                                    @endif
                                </span>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                没有填写过教育经历
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-list fa-2" aria-hidden="true"></i>
                        <h5 class="mdl-card__title-text">工作经历</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border work-panel">

                        @forelse($work as $tempwork)
                            <p>
                                <span>{{$tempwork->ename}}</span>
                                <?php
                                $index = 1;
                                ?>
                                @foreach(explode('@', $tempwork->work_time) as $time)
                                    @if($index == 1)
                                        <span>{{$time}} 入职</span>
                                    @elseif($index == 2)
                                        <span>{{$time}} 离职</span>
                                    @endif

                                    <?php $index++ ?>
                                @endforeach
                                <span>{{$tempwork->position}}</span>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                没有填写过工作经历
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="mdl-card__actions mdl-card--border project-panel">
                    <div class="mdl-card__title">
                        <i class="fa fa-pencil fa-2" aria-hidden="true"></i>
                        <h5 class="mdl-card__title-text">项目经历</h5>
                    </div>

                    @forelse($project as $tempproject)
                        <p>
                            <?php
                            $index = 1;
                            ?>
                            <span>
                                @foreach(explode('@', $tempproject->project_time) as $time)
                                    @if($index == 1)
                                        {{str_replace('-','/',$time)}} --
                                    @elseif($index == 2)
                                        {{str_replace('-','/',$time)}}
                                    @endif
                                    <?php $index++ ?>
                                @endforeach
                                </span>
                            <span>{{$tempproject->project_name}}</span>
                            <span>{{$tempproject->position}}</span>
                            <span style="width: 90%">{!! $tempproject->describe !!}</span>

                        </p>
                    @empty
                        <div class="mdl-card__supporting-text">
                            没有填写过项目经历
                        </div>
                    @endforelse
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-gamepad fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">电竞经历</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border education-panel">
                        @forelse($game as $tempgame)
                            <p>
                                <span>{{$tempgame->ename}}</span>
                                <span>{{$tempgame->level}}</span>
                                <span>{{$tempgame->date}} 开始接触</span>
                            </p>
                        @empty
                            <div class="mdl-card__supporting-text">
                                还没有填写过电竞经历
                            </div>
                        @endforelse
                    </div>
                </div>
            @else
                    <div class="mdl-card resume-child-card">
                        <div class="mdl-card__title">
                            <i class="fa fa-graduation-cap fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">选手经历</h5>
                        </div>

                        <div class="mdl-card__actions mdl-card--border PlayerResume-panel">

                            @forelse($playerResume as $player)
                                <p id="playerResume_info" name="playerResume_info" data-content="{{$player->id}}">
                                    游戏ID：<span>{{$player->game_id}}</span>
                                    游戏名称：<span>{{$player->egame}}</span>
                                    选手位置：<span>{{$player->place}}</span>
                                    服务器：<span>{{$player->service}}</span>
                                    最高排位：<span>{{$player->best_result}}</span>
                                    胜率：<span>{{$player->probability*10}}%~{{($player->probability+1)*10}}%</span>
                                </p>
                            @empty
                                <div class="mdl-card__supporting-text">
                                    您还没有填写过选手经历，点击右上角进行填写
                                </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="mdl-card resume-child-card">
                        <div class="mdl-card__title">
                            <i class="fa fa-list fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">选手信息</h5>
                        </div>

                        <div class="mdl-card__menu">
                            <button class="mdl-button mdl-button--icon mdl-js-button" id="update-baseinfo">
                                <i class="material-icons">mode_edit</i>
                            </button>

                            <div class="mdl-tooltip" data-mdl-for="update-intention">
                                修改
                            </div>
                        </div>

                        <div class="mdl-card__actions mdl-card--border baseinfo-panel">

                                <p>是否职业选手：
                                    <span>
                                    @if($resume['professional'] == 0)
                                            否
                                        @else
                                            是
                                        @endif
                                </span>
                                </p>
                                <p>曾效力俱乐部：
                                    <span>
                                    @if($resume['club'] == null ||$resume['club'] == "")
                                            暂无
                                        @else
                                            {{$resume['club']}}
                                        @endif
                                </span>
                                </p>
                                <p>是否有合同：
                                    <span>
                                    @if($resume['is_contract'] == 0)
                                            暂无
                                        @else
                                            有签订合同
                                        @endif
                                </span>
                                </p>
                                <p>监护人意见：
                                    <span>
                                    @if($resume['opinion'] == 0)
                                            沟通中
                                        @else
                                            同意
                                    @endif
                                </span>
                                </p>
                        </div>
                    </div>
            @endif

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-tags fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">技能特长</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border skill-panel">
                        {{--|@|王者荣耀|至尊星耀|@|LOL|最强王者--}}
                        @if($resume['skill'] == null)
                            <div class="mdl-card__supporting-text">
                                您还没有填写过技能特长
                            </div>
                        @else
                            @foreach($resume['skill'] as $skill)
                                <span>
                                    <small class="skill-item">{{$skill}}</small>
                                </span>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="mdl-card resume-child-card">
                    <div class="mdl-card__title">
                        <i class="fa fa-plus-square fa-2" aria-hidden="true"></i><h5 class="mdl-card__title-text">附加信息</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border additional-panel">

                        @if($resume->extra == null)
                            <div class="mdl-card__supporting-text">
                                还没有填写过附加信息
                            </div>
                        @else
                            <p>{{$resume->extra}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@show

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/material.js')}}"></script>
<script src="{{asset('js/master.js')}}"></script>
<script type="text/javascript">
    $("*[to]").click(function () {
        self.location = $(this).attr('to');
    });
</script>

@section('custom-script')
@show
</body>
</html>
