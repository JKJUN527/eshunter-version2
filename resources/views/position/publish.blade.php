@extends('layout.master')
@section('title', '发布职位')

@section('custom-style')
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/material.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/icon-fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>

    <style>
    ol,ul{
            margin-bottom: 0px;
        }
        .nav_ul li a {
            text-decoration: none;
        }
        .logo-con {
            float: left;
            margin-top: 5px;
        }
        .publish-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .publish-panel {
            padding: 8px 32px;
        }

        .publish-form {
            margin-top: 16px;
        }

        .publish-form .left-panel,
        .publish-form .right-panel {
            width: 460px;
            display: inline-block;
            vertical-align: top;
            padding: 20px 10px;
        }

        .publish-form .left-panel > h3,
        .publish-form .right-panel > h3 {
            font-size: 18px;
            font-weight: 300;
            margin: 0 0 30px 0;
            padding: 10px 0 10px 10px;
            background: #f5f5f5;
            border-left: 5px solid #03A9F4;
        }

        .publish-form .right-panel {
            margin-left: 10px;
        }

        .publish-form > button[type='submit'] {
            margin-top: 20px;
            float: right;
        }

        .publish-form label {
            display: inline-block;
            margin-bottom: 5px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-control {
            display: inline-block;
            padding: 6px 12px 6px 0;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
        }

        .dropdown-menu li {
            display: inline-block;
            width: 100%;
            margin: 0;
        }

        .bs-searchbox > input {
            display: inline-block;
            width: 385px !important;

            padding: 6px 12px !important;
        }

        label[for='position-salary'],
        label[for='position-person--number'],
        label[for='position-experience'],
        label[for='position-education'] {
            padding-bottom: 12px;
        }
        label[for='salary']{
            margin-left: 1rem;
            font-size: 1rem;
        }

        label[for='salary-uncertain'],
        label[for='position-no--experience'],
        label[for='position-no--education'] {
            height: 25px;
            margin-bottom: 16px;
        }

        .label-info {
            background-color: #ed5565 !important;
        }

        [type="checkbox"].filled-in:checked.chk-col-peach + label:after {
            border: 2px solid #ed5565;
            background-color: #ed5565;
        }

        h3 > i.material-icons {
            font-size: 40px;
            margin-right: 12px;
            color: #4CAF50;
            position: relative;
            top: 5px;
        }

        .js-irs-2 {
            display: block !important;
        }
.publish-form .left-panel, .publish-form .right-panel {
    width: 49%;}
    
    </style>
@endsection

@section('header-nav')
    @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
    @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">

            <div class="publish-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">职位发布</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border publish-panel">

                    <form class="publish-form" method="post" id="publish-form">

                        <div class="left-panel">

                            <h3>职位基本信息，必填项</h3>
                            {{--必填项--}}
                            <label for="position-name">职位名称</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="position-name" name="name" class="form-control"
                                           placeholder="职位名称">
                                </div>
                                <label class="error" for="position-name"></label>
                            </div>

                            <label for="position-description">职位描述／介绍</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="description" id="position-description"
                                          placeholder="简单介绍一下职位，吸引求职者..."></textarea>
                                </div>
                                <label class="error" for="position-description"></label>
                            </div>

                            <label for="position-place">工作省份</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-place"
                                        data-live-search="true" name="place">
                                    <option value="0">请选择省份</option>
                                    @foreach($data['province'] as $province)
                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                    @endforeach
                                </select>
                                <label class="error" for="position-place"></label>
                            </div>

                            <label for="position-city" id="citylabel" style="display: none">工作城市</label>
                            @foreach($data['province'] as $province)
                                <div class="form-group" id="city-display{{$province->id}}"
                                     name="city-display" style="display: none">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="position-city"
                                            data-live-search="true" name="city{{$province->id}}">
                                        <option value="0" selected >任意</option>
                                        @foreach($data['city'] as $city)
                                            @if($city->parent_id == $province->id)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label class="error" for="position-city"></label>
                                </div>
                            @endforeach

                            <label for="position-industry">所属行业</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-industry"
                                        name="industry">
                                    <option value="0">请选择所属行业</option>
                                    @foreach($data['industry'] as $industry)
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endforeach
                                </select>
                                <label class="error" for="position-industry"></label>
                            </div>

                            <label for="position-occupation" id="occulabel" style="display: none">所属游戏</label>
                            @foreach($data['industry'] as $industry)
                                <div class="form-group" id="occupation-display{{$industry->id}}"
                                     name="occupation-display" style="display:none;">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="position-occupation"
                                            name="occupation{{$industry->id}}">
                                        <option value="0">请选择所属游戏</option>
                                        @foreach($data['occupation'] as $occupation)
                                            @if($occupation->industry_id == $industry->id)
                                                <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label class="error" for="position-occupation"></label>
                                </div>
                            @endforeach

                            <label for="position-place" id="placelabel" style="display: none">职位</label>
                            @foreach($data['industry'] as $industry)
                                <div class="form-group" id="place-display{{$industry->id}}"
                                     name="place-display" style="display:none;">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="position-place"
                                            name="place{{$industry->id}}">
                                        <option value="0">(选填)请选择所属职位</option>
                                        @foreach($data['place'] as $place)
                                            @if($place->industry_id == $industry->id)
                                                <option value="{{$place->id}}">{{$place->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label class="error" for="position-place"></label>
                                </div>
                            @endforeach

                            <label for="position-type">职位类型</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-type" name="type">
                                    <option value="-1">请选择职位类型</option>
                                    <option value="0">兼职</option>
                                    <option value="1">实习</option>
                                    <option value="2">全职</option>
                                </select>
                                <label class="error" for="position-type"></label>
                            </div>

                            <label for="position-salary">薪资区间K/月</label>
                            <div class="form-group">
                                <input type="checkbox" id="salary-uncertain" class="filled-in chk-col-peach">
                                <label for="salary-uncertain">薪资面议</label>
                                <br>
                                <label for="salary" id="min-salary">最低薪资</label>
                                <input type="text" id="position-salary-min" name="salary-min" value=""/>
                                <label for="salary" id="max-salary">最高薪资</label>
                                <input type="text" id="position-salary-max" name="salary-max" value=""/>
                                <label class="error" for="position-salary-max"></label>
                            </div>

                            <label for="position-person--number">招聘人数</label>
                            <div class="form-group">
                                <input type="number" id="position-person--number" name="person--number" value=""/>
                            </div>

                            {{--<label for="effective-date" style="margin-top: 16px;">职位有效截至日期</label>--}}
                            {{--<div class="form-group">--}}
                            {{--<div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">--}}
                            {{--<input size="16" type="text"  readonly id="effective-date" name="effective-date" class="form-control" value="" placeholder="职位有效期：格式xxxx-xx-xx">--}}
                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>--}}
                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--关闭职位有效期--}}
                            {{--<label for="effective-date" style="margin-top: 16px;">职位有效截至日期</label>--}}
                            {{--<div class="form-group">--}}
                            {{--<div class="form-line">--}}
                            {{--<input type="date" id="effective-date" name="effective-date" class="form-control"--}}
                            {{--placeholder="职位有效期：格式xxxx-xx-xx">--}}
                            {{--</div>--}}
                            {{--<label class="error" for="effective-date"></label>--}}
                            {{--</div>--}}

                            {{--<label for="position-experience">工作经验要求</label>--}}
                            {{--<div class="form-group">--}}
                            {{--<input type="checkbox" id="position-no--experience" name="no--experience"--}}
                            {{--class="filled-in chk-col-peach" checked>--}}
                            {{--<label for="position-no--experience">不要求工作经验</label>--}}

                            {{--<input type="text" id="position-experience" name="experience" value=""/>--}}
                            {{--</div>--}}

                            {{--<label for="position-education">学历要求</label>--}}
                            {{--<div class="form-group">--}}
                            {{--<input type="checkbox" id="position-no--education" name="no--experience"--}}
                            {{--class="filled-in chk-col-peach" checked>--}}
                            {{--<label for="position-no--education">不要求学历</label>--}}

                            {{--<input type="text" id="position-education" name="education" value=""/>--}}
                            {{--</div>--}}
                        </div>


                        <div class="right-panel">
                            {{--选填项--}}
                            <h3>附加信息，选填项&nbsp;&nbsp;<small>(提供真实完整的信息可吸引更多的求职者)</small>
                            </h3>

                            <label for="position-tag">福利标签</label>
                            <div class="form-group demo-tagsinput-area">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tag" id="position-tag"
                                           data-role="tagsinput">
                                </div>
                                <div class="help-info">如有多个标签，请按回车键</div>
                                <label class="error" for="position-tag"></label>
                            </div>

                            <label for="position-education">学历要求</label>
                            <div class="form-group">
                                <select class="form-control show-tick selectpicker" id="position-education"
                                        name="education">
                                    <option value="-1">无学历要求</option>
                                    <option value="0">高中</option>
                                    <option value="3">专科</option>
                                    <option value="1">本科</option>
                                    <option value="2">硕士及以上</option>
                                </select>
                                <label class="error" for="position-education"></label>
                            </div>

                            <label for="position-age">年龄要求(16~99)</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" id="position-age"
                                           name="person-age" value="" min="16" max="99" placeholder="最高年龄限制"/>
                                </div>
                                <label class="error" for="position-age"></label>
                            </div>

                            <label for="position-experience">职位要求</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="experience" id="position-experience"
                                          placeholder="希望求职者具备哪些工作经验..."></textarea>
                                </div>
                                <label class="error" for="position-experience"></label>
                            </div>

                            <label for="position-workplace">详细工作地址</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="workplace" id="position-workplace"
                                          placeholder="请填写详细工作地址"></textarea>
                                </div>
                                <label class="error" for="position-workplace"></label>
                            </div>

                        </div>

                        <div style="clear: both;"></div>

                        <button id="publish-button"
                                class="btn btn-primary blue-btn">
                            立即发布
                        </button>
                    </form>
                </div>

                {{--<div class="mdl-card__actions mdl-card--border publish-panel">--}}
                {{--<h3><i class="material-icons">check</i>职位已经成功发布</h3>--}}

                {{--<div style="margin-left: 52px;">--}}
                {{--<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky"--}}
                {{--to="/position/detail">--}}
                {{--前往查看--}}
                {{--</button>--}}

                {{--<button class="mdl-button mdl-js-button mdl-js-ripple-effect button-link"--}}
                {{--to="/position/publish">--}}
                {{--继续发布职位--}}
                {{--</button>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/ion-rangeslider/js/ion.rangeSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/locales/bootstrap-datetimepicker.zh-CN.js')}}"></script>

    <script type="text/javascript">
        $('.form_date').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
        $(".form-control").focus(function () {
            $(this.parentNode).addClass("focused");
        }).blur(function () {
            $(this.parentNode).removeClass("focused");
        });

        $("#position-salary-min").ionRangeSlider({
            min: 1,
            max: 50,
            from: 5
        });

        $("#position-salary-max").ionRangeSlider({
            min: 1,
            max: 50,
            from: 5
        });

        $("#position-person--number").ionRangeSlider({
            min: 1,
            max: 50,
            from: 10
        });

        $("#salary-uncertain").click(function () {
            if ($("#salary-uncertain").is(":checked")) {
                $("span.js-irs-0").fadeOut(500);
                $("span.js-irs-1").fadeOut(500);
                $("#min-salary").hide();
                $("#max-salary").hide();
            } else {
                $("span.js-irs-0").fadeIn(500);
                $("span.js-irs-1").fadeIn(500);
                $("#min-salary").show();
                $("#max-salary").show();
            }
        });

        $("span.js-irs-2").hide();
        $("#position-no--experience").prop("checked", true).click(function () {
            if ($("#position-no--experience").is(":checked")) {
                $("span.js-irs-2").fadeOut(500);
            } else {
                $("span.js-irs-2").fadeIn(500);
            }
        });

        $("span.js-irs-3").hide();
        $("#position-no--education").prop("checked", true).click(function () {
            if ($("#position-no--education").is(":checked")) {
                $("span.js-irs-3").fadeOut(500);
            } else {
                $("span.js-irs-3").fadeIn(500);
            }
        });
        //自动关联行业和职业信息
        $('#position-industry').change(function () {
//            document.getElementById("ddlResourceType").options.add(new Option(text,value));
            var indexid = $("select[name='industry']").val();
            var occupation_id = "#occupation-display" + indexid;
            var place_id = "#place-display" + indexid;

            $('div[name=occupation-display]').css("display", "none");
            $('div[name=place-display]').css("display", "none");
            $("#occulabel").css("display", "block");
            $("#placelabel").css("display", "block");
            $(occupation_id).css("display", "block");
            $(place_id).css("display", "block");
//            $(id).style.display = block;
        });
        //自动关联省份和城市
        $('#position-place').change(function () {
            var indexid = $("select[name='place']");
            var id = "#city-display" + indexid.val();
            var city_len = $("select[name='city"+ indexid.val() +"'] option").length;
            if(city_len >1){
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "block");
                $(id).css("display", "block");
            }else{
                $('div[name=city-display]').css("display", "none");
                $("#citylabel").css("display", "none");
            }
        });
        $("#publish-button").click(function (event) {
            event.preventDefault();
            //var publishForm = $("#publish-form");

            var name = $("input[name='name']");
            var description_raw = $("textarea[name='description']");

            var description = description_raw.val().replace(/\r\n/g, '</br>');
            description = description.replace(/\n/g, '</br>');
//            description = description.replace(/\s/g, '</br>');

            var province = $("select[name='place']");
            var city = $("select[name='city"+ province.val() +"']");
            var city_len = $("select[name='city"+ province.val() +"'] option").length;
            var industry = $("select[name='industry']");
            var occupation = $("select[name='occupation" + industry.val() + "']");
            var place = $("select[name='place" + industry.val() + "']");
            var type = $("select[name='type']");

            var salaryCB = $("#salary-uncertain");
            var min_salary = $("input[name='salary-min']");
            var max_salary = $("input[name='salary-max']");

            var personNumber = $("input[name='person--number']");

//            var effectiveDate = $("input[name='effective-date']");

            var tag = $("input[name='tag']");
            var experience_raw = $("textarea[name='experience']");

            var experience = experience_raw.val().replace(/\r\n/g, '</br>');
            experience = experience.replace(/\n/g, '</br>');
//            experience = experience.replace(/\s/g, '</br>');

            var workplace_raw = $("textarea[name='workplace']");

            var workplace = workplace_raw.val().replace(/\r\n/g, '</br>');
            workplace = workplace.replace(/\n/g, '</br>');
//            workplace = workplace.replace(/\s/g, '</br>');

            var education = $("select[name='education']");
            var ageLimit = $("input[name='person-age']");


            if (name.val() === "") {
                setError(name, "position-name", "不能为空");
                return;
            } else {
                removeError(name, "position-name");
            }

            if (description === "") {
                setError(description_raw, "position-description", "不能为空");
                return;
            } else if (description.length > 1000) {
                setError(description_raw, "position-description", "描述应少于1000个字符");
                return;
            } else {
                removeError(description_raw, "position-description");
            }

            if (province.val() === "0") {
                setError(province, "position-place", "请选择工作省份");
                return;
            } else {
                removeError(province, "position-place");
            }
            if (city.val() === "0" && city_len >1) {
                setError(city, "position-city", "请选择工作城市");
                return;
            } else {
                removeError(city, "position-city");
            }

            if (industry.val() === "0") {
                setError(industry, "position-industry", "请选择所属行业");
                return;
            } else {
                removeError(industry, "position-industry");
            }

            if (occupation.val() === "0") {
                setError(occupation, "position-occupation", "请选择所属游戏");
                return;
            } else {
                removeError(occupation, "position-occupation");
            }

            if (type.val() === "-1") {
                setError(type, "position-type", "请选择职位类型");
                return;
            } else {
                removeError(type, "position-type");
            }

//            if (effectiveDate.val() === "") {
//                setError(effectiveDate, "effective-date", "不能为空");
//                return;
//            } else {
//                removeError(effectiveDate, "effective-date");
//            }

            if (ageLimit.val() !== "") {
                if (ageLimit.val() !== parseInt(ageLimit.val(), 10) + "") {
                    setError(ageLimit, "position-age", "年龄必须为整数");
                    return;
                } else if (ageLimit.val() > 99 || ageLimit.val() < 16) {
                    setError(ageLimit, "position-age", "输入值无效");
                    return;
                } else {
                    removeError(ageLimit, "position-age");
                }
            }

            if (experience.length > 500) {
                setError(experience_raw, "position-experience", "工作经验要求应少于500字符");
                return;
            } else {
                removeError(experience_raw, "position-experience");
            }

            if (workplace.length > 100) {
                setError(workplace_raw, "position-workplace", "上班地址详情应少于100字符");
                return;
            } else {
                removeError(workplace_raw, "position-workplace");
            }

            var formData = new FormData();
            formData.append("title", name.val());
            formData.append("tag", tag.val());
            formData.append("pdescribbe", description);

            if (salaryCB.is(":checked")) {
                formData.append("salary", -1);
                formData.append("salary_max", 0);
            } else {
                if(parseInt(min_salary.val()) > parseInt(max_salary.val())) {
                    formData.append("salary", max_salary.val());
                    formData.append("salary_max", min_salary.val());
                }else{
                    formData.append("salary_max", max_salary.val());
                    formData.append("salary", min_salary.val());
                }
            }

            if(city_len >1){//省份有城市--非直辖市
                formData.append("region", city.val());
            }else{
                formData.append("region", province.val());
            }

            formData.append("work_nature", type.val());
            formData.append("place", place.val());
            formData.append("occupation", occupation.val());
            formData.append("industry", industry.val());
            formData.append("experience", experience);
            formData.append("workplace", workplace);
            formData.append("education", education.val());
            formData.append("total_num", personNumber.val());

            if (ageLimit.val() === "")
                formData.append("max_age", "0");
            else
                formData.append("max_age", ageLimit.val());
//            formData.append("vaildity", effectiveDate.val());
            $.ajax({
                url: "/position/publish/add",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    if (result.status === 400) {
                        swal({
                            title: "错误",
                            type: "error",
                            text: result.msg,
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            type: "success",
                            text: "职位发布成功，稍后就可以在 个人中心->已发布职位 中查看",
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            self.location = "/account/";
                        }, 1000);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal({
                        type: "error",
                        title: xhr.status,
                        text: thrownError
                    });
                }
            })
        })
    </script>
@endsection
