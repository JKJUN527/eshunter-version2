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
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header esh-layout">
    <header class="mdl-layout__header mdl-layout__header--seamed esh-layout__header" id="esh-layout-header">
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">navigate_before</i>
        </div>
        <div class="mdl-layout__header-row esh-layout__header-row esh-layout__header-row--has-button">
            <span class="mdl-layout__title esh-layout__title">发布职位</span>
        </div>
        {{--<div class="mdl-layout-icon esh-layout-icon--right"><i class="material-icons">home</i></div>--}}
    </header>
    <main class="mdl-layout__content esh-publish" id="esh-layout-content">
        {{--编辑页面--}}
        @if(isset($data["position"]))
            <form id="esh-publish-modify">
                <div class="esh-edit">
                    <label class="esh-label">
                        <em>*</em>职位名称
                    </label>
                    <input type="hidden" id="position-id" name="pid" value="{{$data['position']->pid}}"/>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input required" type="text"
                               name="name" id="position-name"
                               value="{{$data['position']->title or ''}}"
                               placeholder="请输入职位名称（必填）">
                    </div>
                </div>
                <div class="esh-edit">
                    <label class="esh-label">
                        <em>*</em>工作地点
                    </label>
                    <div class="esh-select">
                        <span class="esh-sval"></span>
                        <select class="esh-select-option select2" id="position-place" name="place">
                            <option value="0">请选择工作地点</option>
                            @foreach($data['region'] as $region)
                                <option @if($data['position']->region == $region->id)
                                        selected
                                        @endif
                                        value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                        <label for="position-place"></label>
                    </div>
                </div>
                <div class="esh-edit">
                    <label class="esh-label">
                        <em>*</em>所属行业
                    </label>
                    <div class="esh-select">
                        <span class="esh-sval"></span>
                        <select class="esh-select-option select2" id="position-industry"
                                name="industry">
                            <option value="0">请选择所属行业</option>
                            @foreach($data['industry'] as $industry)
                                <option @if($data['position']->industry == $industry->id)
                                        selected
                                        @endif
                                        value="{{$industry->id}}">{{$industry->name}}</option>
                            @endforeach
                        </select>
                        <label for="position-industry"></label>
                    </div>
                </div>
                @foreach($data['industry'] as $industry)
                    <div class="esh-edit esh-game-select" id="occupation-display{{$industry->id}}"
                         name="occupation-display"
                         @if($industry->id != $data['position']->industry)
                         style="display:none;"
                            @endif
                    >
                        <label class="esh-label">
                            <em>*</em>所属游戏
                        </label>
                        <div class="esh-select">
                            <span class="esh-sval"></span>
                            <select class="esh-select-option"
                                    id="position-occupation"
                                    name="occupation{{$industry->id}}" >
                                <option value="0">请选择所属游戏</option>
                                @foreach($data['occupation'] as $occupation)
                                    @if($occupation->industry_id == $industry->id)
                                        <option @if($data['position']->occupation ==$occupation->id )
                                                selected
                                                @endif
                                                value="{{$occupation->id}}">{{$occupation->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <label for="position-occupation"></label>
                        </div>
                    </div>
                @endforeach
                <div class="esh-edit">
                    <label class="esh-label">
                        <em>*</em>职业类型
                    </label>
                    <div class="esh-select">
                        <span class="esh-sval"></span>
                        <select class="esh-select-option" name="type" id="position-type">
                            <option @if($data['position']->work_nature == 0) selected  @endif value="0">兼职</option>
                            <option @if($data['position']->work_nature == 1) selected  @endif value="1">实习</option>
                            <option @if($data['position']->work_nature == 2) selected  @endif value="2">全职</option>
                        </select>
                        <label for="position-type"></label>
                    </div>
                </div>
                <div class="esh-edit esh-checkbox-input">
                    <label class="esh-label">
                        <em>*</em>薪资区间/月
                    </label>
                    <div class="esh-check_inputs">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="esh-negotiable">
                            <input type="checkbox" id="esh-negotiable" class="mdl-checkbox__input">
                            <span class="mdl-checkbox__label">工资面议</span>
                        </label>
                    </div>
                </div>
                <div id="esh-salary" class="esh-no-label">
                    <div class="esh-edit ">
                        <label class="esh-label">
                            <em>*</em>最低薪酬
                        </label>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input required posInt" type="text"  name="salary-min"
                                   placeholder="请输入最低薪酬">
                        </div>
                    </div>
                    <div class="esh-edit">
                        <label class="esh-label">
                            <em>*</em>最高薪酬
                        </label>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input required posInt" type="text" name="salary-max"
                                   placeholder="请输入最高薪酬">
                        </div>
                    </div>
                </div>
                <div class="esh-edit">
                    <label class="esh-label">
                        <em>*</em>招聘人数
                    </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input required posInt" type="text"  min="1" max="50"
                               value="{{$data['position']->total_num}}" name="person--number"
                               placeholder="请输入招聘人数（必填）">
                    </div>
                </div>
                <div class="esh-edit esh-textarea">
                    <label class="esh-label">
                        <em>*</em>职位描述/介绍
                    </label>
                    <div class="esh-textarea--p">
                <textarea placeholder="简单介绍一下职位，吸引求职者…"
                          class="required" maxlength="1000"
                          name="description" id="position-description">{!! $data['position']->pdescribe !!}</textarea>
                    </div>
                </div>


                <div class="esh-edit">
                    <label class="esh-label">
                        福利标签
                    </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name="tag"
                               value="{{$data['position']->tag}}"
                               placeholder="如有多个标签，请用逗号隔开"/>
                    </div>
                </div>
                <div class="esh-edit">
                    <label class="esh-label">
                        年龄要求
                    </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input posInt" type="text"
                               value="{{$data['position']->max_age}}" name="person-age"
                               min="16" max="99"
                               placeholder="请输入16~99">
                    </div>
                </div>
                <div class="esh-edit">
                    <label class="esh-label">
                        学历要求
                    </label>
                    <div class="esh-select">
                        <span class="esh-sval"></span>
                        <select class="esh-select-option" name="education">
                            <option @if($data['position']->work_nature == -1) selected  @endif value="-1">无学历要求</option>
                            <option @if($data['position']->work_nature == 0) selected  @endif value="0">高中</option>
                            <option @if($data['position']->work_nature == 3) selected  @endif value="3">专科</option>
                            <option @if($data['position']->work_nature == 1) selected  @endif value="1">本科</option>
                            <option @if($data['position']->work_nature == 2) selected  @endif value="2">硕士及以上</option>
                        </select>
                    </div>
                </div>
                <div class="esh-edit esh-textarea">
                    <label class="esh-label">
                        职位要求
                    </label>
                    <div class="esh-textarea--p">
                        <textarea placeholder="希望求职者具有哪些工作经验…"
                                  name="experience"
                                  maxlength="500">{!! $data['position']->experience !!}</textarea>
                    </div>
                </div>
                <div class="esh-edit esh-textarea">
                    <label class="esh-label">
                        详细地址
                    </label>
                    <div class="esh-textarea--p">
                        <textarea placeholder="请填写详细的工作地址…"
                                  name="workplace"
                                  maxlength="100">{!! $data['position']->workplace !!}</textarea>
                    </div>
                </div>

                <div class="esh-edit-fb">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" id="esh-update-position">
                        修改
                    </button>
                </div>
            </form>

    @else
    {{--新增页面--}}
    <form id="esh-publish-create">
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>职位名称
            </label>
            {{--@if(isset($data["position"]->pid))--}}
                {{--<input type="hidden" id="position-id" name="pid" value="{{$data['position']->pid}}"/>--}}
            {{--@endif--}}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="name"
                       placeholder="请输入职位名称（必填）">
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>工作省份
            </label>
            <div class="esh-select">
                <span class="esh-sval"></span>
                <select class="esh-select-option select2" id="position-place" name="place">
                    <option value="0">请选择省份</option>
                    @foreach($data['province'] as $province)
                        <option value="{{$province->id}}">{{$province->name}}</option>
                    @endforeach
                </select>
                <label for="position-place"></label>
            </div>
        </div>
        @foreach($data['province'] as $province)
            <div class="esh-edit esh-city-select" style="display: none">
                <label class="esh-label">
                    <em>*</em>工作城市
                </label>
                <div class="esh-select" id="city-display{{$province->id}}"  >
                    <span class="esh-sval"></span>
                    <select name="city{{$province->id}}" class="esh-select-option" id="position-city">
                        <option value="0" selected >任意</option>
                        @foreach($data['city'] as $city)
                            @if($city->parent_id == $province->id)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <label for="position-city"></label>
                </div>
            </div>
        @endforeach

            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>所属行业
                </label>
                <div class="esh-select">
                    <label class="esh-sval"></label>
                    <select class="esh-select-option select2" id="position-industry"
                            name="industry">
                        <option value="0">请选择所属行业</option>
                        @foreach($data['industry'] as $industry)
                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                        @endforeach
                    </select>
                    <label for="position-industry"></label>
                </div>

            </div>
            @foreach($data['industry'] as $industry)
                <div class="esh-edit esh-game-select" id="occupation-display{{$industry->id}}"
                     name="occupation-display" style="display:none;">
                    <label class="esh-label">
                        <em>*</em>所属游戏
                    </label>
                    <div class="esh-select">
                        <span class="esh-sval"></span>
                        <select class="esh-select-option"
                                name="occupation{{$industry->id}}" id="position-occupation">
                            <option value="0">请选择所属游戏</option>
                            @foreach($data['occupation'] as $occupation)
                                @if($occupation->industry_id == $industry->id)
                                    <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                @endif
                            @endforeach
                        </select>
                        <label for="position-occupation"></label>
                    </div>
                </div>
            @endforeach

                <div class="esh-edit">
                    <label class="esh-label">
                        <em>*</em>职业类型
                    </label>
                    <div class="esh-select">
                        <span class="esh-sval"></span>
                        <select class="esh-select-option" name="type" id="position-type">
                            <option value="-1">请选择职位类型</option>
                            <option value="0">兼职</option>
                            <option value="1">实习</option>
                            <option value="2">全职</option>
                        </select>
                        <label for="position-type"></label>
                    </div>
                </div>
                <div class="esh-edit esh-checkbox-input">
                    <label class="esh-label">
                        <em>*</em>薪资区间/月
                    </label>
                    <div class="esh-check_inputs">
                        <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="esh-negotiable">
                            <input type="checkbox" id="esh-negotiable" class="mdl-checkbox__input">
                            <span class="mdl-checkbox__label">工资面议</span>
                        </label>
                    </div>
                </div>
                <div id="esh-salary" class="esh-no-label">
                    <div class="esh-edit ">
                        <label class="esh-label">
                            <em>*</em>最低薪酬
                        </label>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input required posInt" type="text"  maxlength="20" name="salary-min"
                                   placeholder="请输入最低薪酬">
                        </div>
                    </div>
                    <div class="esh-edit">
                        <label class="esh-label">
                            <em>*</em>最高薪酬
                        </label>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input required posInt" type="text"  maxlength="20" name="salary-max"
                                   placeholder="请输入最高薪酬">
                        </div>
                    </div>
                </div>

                <div class="esh-edit">
                    <label class="esh-label">
                        <em>*</em>招聘人数
                    </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input required"  min="1" max="50" type="text"
                               name="person--number" placeholder="请输入招聘人数（必填）">
                    </div>
                </div>
                <div class="esh-edit esh-textarea">
                    <label class="esh-label">
                        <em>*</em>职位描述/介绍
                    </label>
                    <div class="esh-textarea--p">
                    <textarea placeholder="简单介绍一下职位，吸引求职者…"
                              class="required" maxlength="1000"
                              name="description"></textarea>
                    </div>
                </div>


                <div class="esh-edit">
                    <label class="esh-label">
                        福利标签
                    </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="tag" type="text">
                        <label for="tag"></label>
                    </div>
                </div>
                <div class="esh-edit">
                    <label class="esh-label">
                        年龄要求
                    </label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input posInt" type="text" id="position-age"
                               name="person-age" value="" min="16" max="99" placeholder="请输入16~99">
                        <label for="person-age"></label>
                    </div>
                </div>
                <div class="esh-edit">
                    <label class="esh-label">
                        学历要求
                    </label>
                    <div class="esh-select">
                        <span class="esh-sval"></span>
                        <select class="esh-select-option" name="education">
                            <option value="-1">无学历要求</option>
                            <option value="0">高中</option>
                            <option value="3">专科</option>
                            <option value="1">本科</option>
                            <option value="2">硕士及以上</option>
                        </select>
                        <label for="education"></label>
                    </div>
                </div>
                <div class="esh-edit esh-textarea">
                    <label class="esh-label">
                        职位要求
                    </label>
                    <div class="esh-textarea--p">
                        <textarea placeholder="希望求职者具有哪些工作经验…"
                                  maxlength="500"
                                  name="experience"></textarea>
                        <label for="experience"></label>
                    </div>
                </div>
                <div class="esh-edit esh-textarea">
                    <label class="esh-label">
                        详细地址
                    </label>
                    <div class="esh-textarea--p">
                        <textarea placeholder="请填写详细的工作地址…"
                                  maxlength="100"
                                  name="workplace" id="position-workplace"></textarea>
                        <label for="position-workplace"></label>
                    </div>
                </div>

                <div class="esh-edit-fb esh-form-sure">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button"
                            id="esh-save-position">
                        保存
                    </button>
                </div>
            </form>

        @endif
    </main>
</div>
<script src="{{asset('mobile/js/lib/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.method.js')}}"></script>
<script src="{{asset('mobile/js/lib/material.min.js')}}"></script>
<script src="{{asset('mobile/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('mobile/js/utils/utils.js')}}"></script>
<script src="{{asset('mobile/js/job/publishPosition.js')}}"></script>
<script>

</script>
</body>
</html>