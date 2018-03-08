<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>电竞猎人</title>
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
                <span class="mdl-layout__title esh-layout__title esh-chart-title-name" >
                    <span id="esh-resume-name">{{$data['personinfo']->pname}}</span>
                </span>
        </div>
    </header>
    <main class="mdl-layout__content esh-resume-info esh-deliver-detail" >
        <div class="esh-account-info mdl-card">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">个人信息</h2>
            </div>
            <div class="mdl-card__title">
                <div class="esh-preview__img">
                    @if($data["personinfo"]->photo== null || $data['personinfo']->photo == "")
                    <img src="{{asset('mobile/styles/default/images/default-img.png')}}"
                         class="esh-account-img" id="upload-head--img"/>
                    @else
                        <img src="{{$data["personinfo"]["photo"]}}" class="esh-account-img" id="upload-head--img"/>
                    @endif
                </div>
                <div class="esh-preview__info">
                    <span class="esh-text-l">{{$data["personinfo"]["pname"] or "姓名未填写"}}</span>
                    <div class="esh-text-l">
                        <span>
                            @if($data["personinfo"]["sex"] == null)
                                性别未填写
                            @elseif($data["personinfo"]["sex"] == 1)
                                男
                            @elseif($data["personinfo"]["sex"] == 2)
                                女
                            @endif
                        </span>|
                        <span>{{$data["personinfo"]["residence"] or "居住地未填写"}}</span>
                    </div>
                    <div>出生日期：{{$data["personinfo"]["birthday"] or "生日未填写"}}</div>
                    <div>手机号码：{{$data["personinfo"]["tel"] or "手机号未填写"}}</div>
                    <div>联系邮箱：{{$data["personinfo"]["mail"]  or "邮箱未填写"}}</div>
                </div>
            </div>

            {{--<div class="mdl-card__supporting-text">
                <span class="esh-text-l">{{$data["personinfo"]["pname"] or "姓名未填写"}}</span>
                <div>
                <span>
                    @if($data["personinfo"]["sex"] == null)
                        性别未填写
                    @elseif($data["personinfo"]["sex"] == 1)
                        男
                    @elseif($data["personinfo"]["sex"] == 2)
                        女
                    @endif
                </span>|
                    <span>{{$data["personinfo"]["birthday"] or "生日未填写"}}&nbsp;</span>|
                    <span>{{$data["personinfo"]["residence"] or "居住地未填写"}}</span>
                </div>
                <div>手机：{{$data["personinfo"]["tel"] or "手机号未填写"}}</div>
                <div>邮箱：{{$data["personinfo"]["mail"]  or "邮箱未填写"}}</div>
            </div>--}}
        </div>
        <div class="mdl-card ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">自我评价</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="esh-no-content">
                    {{$data["personinfo"]["self_evalu"] or "自我评价未填写"}}
                </div>
            </div>
        </div>
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
                            @if($data["intention"]->region == null)
                                <span>任意</span>
                            @else
                                <span>{{$data["intention"]->region}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>行业分类</label>
                        <div>
                            @if($data["intention"]->industry == null)
                                <span>任意</span>
                            @else
                                <span>{{$data["intention"]->industry}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>职业分类</label>
                        <div>
                            @if($data["intention"]->occupation == null)
                                <span>任意</span>
                            @else
                                <span>{{$data["intention"]->occupation}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>工作类型</label>
                        <div>
                            @if($data["intention"]->work_nature == null)
                                <span>任意</span>
                            @else
                                <span>{{$data["intention"]->work_nature}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="esh-resume-info-t">
                        <label>期望薪资</label>
                        <div>
                            @if($data["intention"]->salary <= 0)
                                <span>未指定薪资要求</span>
                            @else

                                <span>{{$data["intention"]->salary}}</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </div>
        <div class="mdl-card ">
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
                {{--@forelse($data['education'] as $education)--}}
                @if($data["intention"]->education1 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">{{explode('@',$data["intention"]->education1)[0]}}</p>
                            <p class="point">{{explode('@',$data["intention"]->education1)[1]}}</p>
                            <p class="suptext">
                                <span>{{explode('@',$data["intention"]->education1)[2]}}</span>|
                                @if(explode('@',$data["intention"]->education1)[3] ==0)
                                    高中
                                @elseif(explode('@',$data["intention"]->education1)[3] ==1)
                                    本科
                                @elseif(explode('@',$data["intention"]->education1)[3] ==2)
                                    研究生及以上
                                @else
                                    专科
                                @endif
                            </p>
                        </div>
                    </div>
                @endif

                @if($data["intention"]->education2 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">{{explode('@',$data["intention"]->education2)[0]}}</p>
                            <p class="point">{{explode('@',$data["intention"]->education2)[1]}}</p>
                            <p class="suptext">
                                <span>{{explode('@',$data["intention"]->education2)[2]}}</span>|
                                @if(explode('@',$data["intention"]->education2)[3] ==0)
                                    高中
                                @elseif(explode('@',$data["intention"]->education2)[3] ==1)
                                    本科
                                @elseif(explode('@',$data["intention"]->education2)[3] ==2)
                                    研究生及以上
                                @else
                                    专科
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
                @if($data["intention"]->education3 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">{{explode('@',$data["intention"]->education3)[0]}}</p>
                            <p class="point">{{explode('@',$data["intention"]->education3)[1]}}</p>
                            <p class="suptext">
                                <span>{{explode('@',$data["intention"]->education3)[2]}}</span>|
                                @if(explode('@',$data["intention"]->education3)[3] ==0)
                                    高中
                                @elseif(explode('@',$data["intention"]->education3)[3] ==1)
                                    本科
                                @elseif(explode('@',$data["intention"]->education3)[3] ==2)
                                    研究生及以上
                                @else
                                    专科
                                @endif
                            </p>
                        </div>
                    </div>
                @endif
                @if($data["intention"]->education1 == null &&
                     $data["intention"]->education2 == null &&
                     $data["intention"]->education3 == null)
                    <div class="esh-no-content">
                        没有填写教育经历
                    </div>
                @endif

            </div>

        </div>
        <div class="mdl-card ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">工作经历</h2>
            </div>
            <div class="mdl-card__supporting-text">
                {{--@forelse($data['work'] as $work)--}}
                @if($data["intention"]->workexp1 != null)
                    <div class="esh-tlbox">
                        <?php
                        $index = 1;
                        ?>
                        <div class="esh-timeline">
                            <p class="point">
                                {{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp1)[1],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp1)[2],0,7,'utf-8'))}}
                            </p>
                            <p class="point">{{explode('@',$data["intention"]->workexp1)[3]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->workexp1)[4]}}(
                                @if(explode('@',$data["intention"]->workexp1)[0] ==0)
                                    全职
                                @elseif(explode('@',$data["intention"]->workexp1)[0] ==1)
                                    实习
                                @endif
                             )</p>
                            <p class="suptext">{!! explode('@',$data["intention"]->workexp1)[5] !!}</p>

                        </div>
                    </div>
                @endif

                @if($data["intention"]->workexp2 != null)
                    <div class="esh-tlbox">
                        <?php
                        $index = 1;
                        ?>
                        <div class="esh-timeline">
                            <p class="point">
                                {{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp2)[1],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp2)[2],0,7,'utf-8'))}}
                            </p>
                            <p class="point">{{explode('@',$data["intention"]->workexp2)[3]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->workexp2)[4]}}(
                                @if(explode('@',$data["intention"]->workexp2)[0] ==0)
                                    全职
                                @elseif(explode('@',$data["intention"]->workexp2)[0] ==1)
                                    实习
                                @endif
                             )</p>
                            <p class="suptext">{!! explode('@',$data["intention"]->workexp2)[5] !!}</p>

                        </div>
                    </div>
                @endif

                @if($data["intention"]->workexp3 != null)
                    <div class="esh-tlbox">
                        <?php
                        $index = 1;
                        ?>
                        <div class="esh-timeline">
                            <p class="point">
                                {{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp3)[1],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->workexp3)[2],0,7,'utf-8'))}}
                            </p>
                            <p class="point">{{explode('@',$data["intention"]->workexp3)[3]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->workexp3)[4]}}(
                                @if(explode('@',$data["intention"]->workexp3)[0] ==0)
                                    全职
                                @elseif(explode('@',$data["intention"]->workexp3)[0] ==1)
                                    实习
                                @endif
                             )</p>
                            <p class="suptext">{!! explode('@',$data["intention"]->workexp3)[5] !!}</p>

                        </div>
                    </div>
                @endif
                @if($data["intention"]->workexp1 == null &&
                                $data["intention"]->workexp2 == null &&
                                $data["intention"]->workexp3 == null)

                    <div class="esh-no-content">
                        没有填写工作经历
                    </div>
                @endif
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
                {{--@forelse($data['project'] as $project)--}}
                @if($data["intention"]->projectexp1 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">
                                {{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp1)[0],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp1)[1],0,7,'utf-8'))}}
                            </p>
                            <p class="point">{{explode('@',$data["intention"]->projectexp1)[2]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->projectexp1)[3]}}</p>
                            <p class="suptext">{!! explode('@',$data["intention"]->projectexp1)[4] !!}</p>
                        </div>
                    </div>
                @endif
                @if($data["intention"]->projectexp2 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">
                                {{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp2)[0],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp2)[1],0,7,'utf-8'))}}
                            </p>
                            <p class="point">{{explode('@',$data["intention"]->projectexp2)[2]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->projectexp2)[3]}}</p>
                            <p class="suptext">{!! explode('@',$data["intention"]->projectexp2)[4] !!}</p>
                        </div>
                    </div>
                @endif
                @if($data["intention"]->projectexp3 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">
                                {{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp3)[0],0,7,'utf-8'))}}--{{str_replace('-','/',mb_substr(explode('@',$data["intention"]->projectexp3)[1],0,7,'utf-8'))}}
                            </p>
                            <p class="point">{{explode('@',$data["intention"]->projectexp3)[2]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->projectexp3)[3]}}</p>
                            <p class="suptext">{!! explode('@',$data["intention"]->projectexp3)[4] !!}</p>
                        </div>
                    </div>
                @endif
                @if($data["intention"]->projectexp1 == null &&
                                   $data["intention"]->projectexp2 == null &&
                                   $data["intention"]->projectexp3 == null)

                    <div class="esh-no-content">
                        没有填写项目经历
                    </div>
                @endif
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
                @if($data["intention"]->egamexpr1 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">{{explode('@',$data["intention"]->egamexpr1)[1]}}年开始接触</p>
                            <p class="point">{{explode('@',$data["intention"]->egamexpr1)[0]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->egamexpr1)[2]}}</p>
                            @if(count(explode('@',$data["intention"]->egamexpr1))>=4)
                                @if(explode('@',$data["intention"]->egamexpr1)[3] !="")
                                <p class="suptext">{!! explode('@',$data["intention"]->egamexpr1)[3] !!}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
                @if($data["intention"]->egamexpr2 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">{{explode('@',$data["intention"]->egamexpr2)[1]}}年开始接触</p>
                            <p class="point">{{explode('@',$data["intention"]->egamexpr2)[0]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->egamexpr2)[2]}}</p>
                            @if(count(explode('@',$data["intention"]->egamexpr2))>=4)
                                @if(explode('@',$data["intention"]->egamexpr2)[3] !="")
                                    <p class="suptext">{!! explode('@',$data["intention"]->egamexpr2)[3] !!}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
                @if($data["intention"]->egamexpr3 != null)
                    <div class="esh-tlbox">
                        <div class="esh-timeline">
                            <p class="point">{{explode('@',$data["intention"]->egamexpr3)[1]}}年开始接触</p>
                            <p class="point">{{explode('@',$data["intention"]->egamexpr3)[0]}}</p>
                            <p class="suptext">{{explode('@',$data["intention"]->egamexpr3)[2]}}</p>
                            @if(count(explode('@',$data["intention"]->egamexpr3))>=4)
                                @if(explode('@',$data["intention"]->egamexpr3)[3] !="")
                                    <p class="suptext">{!! explode('@',$data["intention"]->egamexpr3)[3] !!}</p>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
                @if($data["intention"]->egamexpr1 == null &&
                               $data["intention"]->egamexpr2 == null &&
                               $data["intention"]->egamexpr3 == null)

                    <div class="esh-no-content">
                        没有填写电竞经历
                    </div>
                @endif
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
                @if($data["intention"]->skill != null)
                    @foreach(explode('|@|',$data["intention"]->skill) as $item )
                        @if($item != "")
                            <div class="esh-skill">{{$item}}</div>
                        @endif
                    @endforeach
                @else
                    <div class="esh-no-content"> 未填写技能特长</div>
                @endif
            </div>

        </div>
        <div class="mdl-card ">
            <div class="mdl-card__title mdl-card--border">
                <h2 class="mdl-card__title-text">附加信息</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="esh-skill"> {{$data["intention"]->extra or "未填写附加信息"}}</div>
            </div>
        </div>

        {{--<div class="esh-edit-fb">--}}
            {{--<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"--}}
                {{--id="esh-download-resume">--}}
                {{--下载简历--}}
            {{--</button>--}}
        {{--</div>--}}
    </main>

    <footer class="esh-chartl-footer">
        @if($data["status"] != 2 && $data["status"] != 3)
        <form class="esh-edit esh-textarea" method="post" id="response-form">
            <input type="hidden" name="did" value="{{$data["intention"]->did}}"/>
            <div class="esh-textarea--p">
                <textarea placeholder="写点什么..."
                          id="response-content"></textarea>
            </div>
            <div class="esh-chart-help-info" id="response-help">还可输入114字</div>
            <div class="esh-replay-error" id="esh-replay-error"></div>
            <div class="esh-replay-button">
                <div class="esh-mdl-radios">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect esh-chart-label" for="unknown" >
                        <input type="radio" id="unknown" class="mdl-radio__button" name="employ" value="1" checked>
                        <span class="mdl-radio__label">暂不确定</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect esh-chart-label" for="accept" >
                        <input type="radio" id="accept" class="mdl-radio__button" name="employ" value="2">
                        <span class="mdl-radio__label">立即录用</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect esh-chart-label" for="reject">
                        <input type="radio" id="reject" class="mdl-radio__button" name="employ" value="3">
                        <span class="mdl-radio__label">委婉拒绝</span>
                    </label>
                </div>


                <button class="mdl-button mdl-js-button mdl-button--colored" id="btn-response" type="submit">
                    回复
                </button>
            </div>
        </form>
        @else
            <div class="mdl-color-text--blue tip">已处理过{{$data['personinfo']->pname}}的简历</div>
        @endif
    </footer>
</div>
<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
<script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('mobile/js/utils/utils.js')}}"></script>
<script src="{{asset('mobile/plugins/pdf.js')}}"></script>
<script>
    var maxSize = 114;
    $('textarea').keyup(function () {
        var length = $(this).val().length;
        if (length > maxSize) {
            $("#esh-replay-error").html("内容超过114字");
            $("#btn-response").prop("disabled", true);
        } else {
            $("#esh-replay-error").html("");
            $("#btn-response").prop("disabled", false);
        }
        $("#response-help").html("还可输入" + (maxSize - length < 0 ? 0 : maxSize - length) + "字");

    });
    $("button[type='submit']").click(function (event) {
        event.preventDefault();

        var did = $("input[name='did']").val();
        var content = $("#response-content").val();
        var employ = $("input[name='employ']:checked").val();

        if (content.length === 0) {
            $("#esh-replay-error").html("内容不能为空");
            $("#btn-response").prop("disabled", true);
            return;
        }

        if (content.length > maxSize) {
            $("#esh-replay-error").html("内容超过" + maxSize + "字");
            $("#btn-response").prop("disabled", true);
            return;
        }

        var formData = new FormData();
        formData.append('did', did);
        formData.append('content', content);
        formData.append('employ', employ);

        $.ajax({
            url: "/m/position/deliverDetail/reply",
            type: "post",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.status===200){
                    swal({
                        title:"提示",
                        text:"回复成功",
                        showCancelButton:false,
                        showConfirmButton:"true",
                        confirmButtonText:"确定",
                    },function(){
                        self.location.reload();
                    });
                }else{
                    swal(result.msg);
                }


            }
        })
    });
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