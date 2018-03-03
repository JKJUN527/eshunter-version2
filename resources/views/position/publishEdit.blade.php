@extends('layout.master')
@section('title', '修改职位')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>

    <style>
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
    @include('components.headerTab', ['activeIndex' => 2, 'type'=>$data['type']])
@endsection

@section('content')
    <div class="info-panel">
        <div class="container">

            <div class="publish-card mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h5 class="mdl-card__title-text">职位修改</h5>
                </div>

                <div class="mdl-card__actions mdl-card--border publish-panel">

                    <form class="publish-form" method="post" id="publish-form">

                        <div class="left-panel">

                            <h3>职位基本信息，必填项</h3>
                            {{--必填项--}}
                            <label for="position-name">职位名称</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="position-id" name="pid" style="display: none" value="{{$data['position']->pid}}">
                                    <input type="text" id="position-name" name="name" class="form-control"
                                           placeholder="职位名称" value="{{$data['position']->title}}">
                                </div>
                                <label class="error" for="position-name"></label>
                            </div>

                            <label for="position-description">职位描述／介绍</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="description" id="position-description"
                                          placeholder="简单介绍一下职位，吸引求职者...">{!! $data['position']->pdescribe !!}</textarea>
                                </div>
                                <label class="error" for="position-description"></label>
                            </div>

                            <label for="position-place">工作地点</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-place"
                                        data-live-search="true" name="place">
                                    <option value="0">请选择工作地点</option>
                                    @foreach($data['region'] as $region)
                                        <option @if($data['position']->region == $region->id)
                                                    selected
                                                @endif
                                                value="{{$region->id}}">{{$region->name}}</option>
                                    @endforeach
                                </select>
                                <label class="error" for="position-place"></label>
                            </div>

                            <label for="position-industry">所属行业</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-industry"
                                        name="industry">
                                    <option value="0">请选择所属行业</option>
                                    @foreach($data['industry'] as $industry)
                                        <option @if($data['position']->industry == $industry->id)
                                                    selected
                                                @endif
                                                value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endforeach
                                </select>
                                <label class="error" for="position-industry"></label>
                            </div>

                            <label for="position-occupation" id="occulabel">所属游戏</label>
                            @foreach($data['industry'] as $industry)
                                <div class="form-group" id="occupation-display{{$industry->id}}"
                                     name="occupation-display"
                                     @if($industry->id != $data['position']->industry)
                                        style="display:none
                                     @endif
                                             ;">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="position-occupation"
                                            name="occupation{{$industry->id}}">
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
                                    <label class="error" for="position-occupation"></label>
                                </div>
                            @endforeach

                            <label for="position-type">职位类型</label>
                            <div class="form-group">
                                {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                <select class="form-control show-tick selectpicker" id="position-type" name="type">
                                    <option value="-1">请选择职位类型</option>
                                    <option @if($data['position']->work_nature == 0) selected  @endif value="0">兼职</option>
                                    <option @if($data['position']->work_nature == 1) selected  @endif value="1">实习</option>
                                    <option @if($data['position']->work_nature == 2) selected  @endif value="2">全职</option>
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
                                <input type="number" id="position-person--number" name="person--number" value="{{$data['position']->total_num}}"/>
                            </div>
                        </div>


                        <div class="right-panel">
                            {{--选填项--}}
                            <h3>附加信息，选填项&nbsp;&nbsp;<small>(提供真实完整的信息可吸引更多的求职者)</small>
                            </h3>

                            <label for="position-tag">福利标签</label>
                            <div class="form-group demo-tagsinput-area">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="tag" id="position-tag"
                                           data-role="tagsinput" value="{{$data['position']->tag}}">
                                </div>
                                <div class="help-info">如有多个标签，请用英文逗号分割</div>
                                <label class="error" for="position-tag"></label>
                            </div>

                            <label for="position-education">学历要求</label>
                            <div class="form-group">
                                <select class="form-control show-tick selectpicker" id="position-education"
                                        name="education">
                                    <option @if($data['position']->work_nature == -1) selected  @endif value="-1">无学历要求</option>
                                    <option @if($data['position']->work_nature == 0) selected  @endif value="0">高中</option>
                                    <option @if($data['position']->work_nature == 3) selected  @endif value="3">专科</option>
                                    <option @if($data['position']->work_nature == 1) selected  @endif value="1">本科</option>
                                    <option @if($data['position']->work_nature == 2) selected  @endif value="2">硕士及以上</option>
                                </select>
                                <label class="error" for="position-education"></label>
                            </div>

                            <label for="position-age">年龄要求(16~99)</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="number" class="form-control" id="position-age"
                                           name="person-age" value="{{$data['position']->max_age}}" min="16" max="99" placeholder="最高年龄限制"/>
                                </div>
                                <label class="error" for="position-age"></label>
                            </div>

                            <label for="position-experience">职位要求</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="experience" id="position-experience"
                                          placeholder="希望求职者具备哪些工作经验...">{!! $data['position']->experience !!}</textarea>
                                </div>
                                <label class="error" for="position-experience"></label>
                            </div>

                            <label for="position-workplace">详细工作地址</label>
                            <div class="form-group">
                                <div class="form-line">
                                <textarea rows="5" class="form-control" name="workplace" id="position-workplace"
                                          placeholder="请填写详细工作地址">{!! $data['position']->workplace !!}</textarea>
                                </div>
                                <label class="error" for="position-workplace"></label>
                            </div>

                        </div>

                        <div style="clear: both;"></div>

                        <button id="publish-button"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            立即更新
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

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/ion-rangeslider/js/ion.rangeSlider.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/locales/bootstrap-datetimepicker.zh-CN.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var workexperience =$("textarea[id=position-experience]").val();
            var positiondesc =$("textarea[id=position-description]").val();
            if(workexperience){
                workexperience = workexperience.replace(/<\/br>/g, "\r\n");
                $("textarea[id=position-experience]").val(workexperience);
            }
            if(positiondesc){
                positiondesc = positiondesc.replace(/<\/br>/g, "\r\n");
                $("textarea[id=position-description]").val(positiondesc);
            }

        });
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
            var id = "#occupation-display" + indexid;
            $('div[name=occupation-display]').css("display", "none");
            $("#occulabel").css("display", "block");
            $(id).css("display", "block");
//            $(id).style.display = block;
        });
        $("#publish-button").click(function (event) {
            event.preventDefault();
            //var publishForm = $("#publish-form");

            var pid = $("input[name='pid']");
            var name = $("input[name='name']");
            var description_raw = $("textarea[name='description']");

            var description = description_raw.val().replace(/\r\n/g, '</br>');
            description = description.replace(/\n/g, '</br>');
//            description = description.replace(/\s/g, '</br>');

            var place = $("select[name='place']");
            var industry = $("select[name='industry']");
            var occupation = $("select[name='occupation" + industry.val() + "']");
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

            if (place.val() === "0") {
                setError(place, "position-place", "请选择工作地点");
                return;
            } else {
                removeError(place, "position-place");
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
            formData.append("pid", pid.val());
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

            formData.append("region", place.val());
            formData.append("work_nature", type.val());
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
                url: "/position/publishList/editPost",
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
                            text: "职位更新成功，稍后就可以在 个人中心->已发布职位 中查看",
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
