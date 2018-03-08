@extends('mobile.layout.master')
@section('esh-css')
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/mdl-picker/css/mdDateTimePicker.min.css')}}"/>
    @parent
@stop
@section('esh-header')
@include('mobile.components.header',['title'=> isset($data["eduid"])?"修改教育经历":"新增教育经历",'buttonLeft'=>true])
@stop
@section('esh-content')
    <form id="esh-edu-form">
        <input type="hidden" id="eduid" name="eduid" class="form-control"

               value="{{$data["eduid"] or '-1'}}" >
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>学校
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="school"
                       placeholder="请输入学校名称"
                       value="{{$data["school"]  or ''}}">
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>学历
            </label>
            <div class="esh-select">
                <span class="esh-sval">高中</span>
                <select name="degree" class="esh-select-option">
                    @if(isset($data["degree"]))
                        <option value="0" @if($data["degree"] == "0") selected @endif>高中</option>
                        <option value="1" @if($data["degree"] == "1") selected @endif>专科</option>
                        <option value="2" @if($data["degree"] == "2") selected @endif>本科</option>
                        <option value="3" @if($data["degree"] == "3") selected @endif>研究生及以上</option>
                    @else
                        <option value="0" >高中</option>
                        <option value="1" >专科</option>
                        <option value="2" >本科</option>
                        <option value="3" >研究生及以上</option>
                    @endif
                </select>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                专业
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text"
                       placeholder="请输入所属专业"
                       value="{{$data["major"] or ''}}" name="subject">
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>入学时间
            </label>
            {{--esh-birth-input--}}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="education-begin"
                       value="{{$data['date'] or ''}}"
                       data-date-format="yyyy-mm-dd" id="esh-education-begin" placeholder="请选择入学时间"/>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>毕业时间
            </label>
            {{--esh-birth-input--}}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="education-end"
                       value="{{$data['gradu_date'] or ''}}"
                       data-date-format="yyyy-mm-dd" id="esh-education-end" placeholder="请选择毕业时间"/>
            </div>
        </div>

        <div class="esh-edit-fb esh-form-sure">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                    type="button" id="esh-edu-save">
                保存
            </button>
        </div>
    </form>
@stop
@section('esh-js')
    @parent
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.method.js')}}"></script>
    <script src="{{asset('mobile/plugins/mdl-picker/js/moment.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/mdl-picker/js/lang/zh-cn.js')}}"></script>

    <script src="{{asset('mobile/plugins/mdl-picker/js/scroll-into-view-if-needed.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/mdl-picker/js/draggabilly.pkgd.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/mdl-picker/js/mdDateTimePicker.js')}}"></script>
    <script>
        (function () {
//            sessionStorage.setItem("need-refresh", true);
            var ESHUtils = this.ESHUtils;
            $(function () {
                var beginDate, endDate, $beginDateTrigger, $endDateTrigger, dateTimePickerOption;

                ESHUtils.fillSpan();//填充span内容

                dateTimePickerOption = {
                    type: 'date',
                    init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
                    //init: moment(moment().format("l"),"YYYY-MM-DD"),
                    past:moment().subtract(50,"years"),
                    ok:"确定",
                    cancel:"取消"
                };

                $beginDateTrigger = $("#esh-education-begin");

                $endDateTrigger = $("#esh-education-end");

                //入学时间
                beginDate = new mdDateTimePicker.default(dateTimePickerOption);

                //毕业时间
                endDate = new mdDateTimePicker.default(dateTimePickerOption);

                beginDate.trigger = $beginDateTrigger[0];
                endDate.trigger = $endDateTrigger[0];


                $beginDateTrigger.on('click',function(evt){
                    $(this).blur();
                    beginDate.show();
                    return ESHUtils.stopEvent(evt);
                }).on("onOk",function(evt){
                    this.value = beginDate.time.format("YYYY-MM-DD");
                    return ESHUtils.stopEvent(evt);
                });

                $endDateTrigger.on('click',function(evt){
                    $(this).blur();
                    endDate.show();
                    return ESHUtils.stopEvent(evt);
                }).on("onOk",function(evt){
                    //this.value = birthDate.time.toString();
                    this.value = endDate.time.format("YYYY-MM-DD");
                    return ESHUtils.stopEvent(evt);
                });

                //
                $("#esh-edu-save").click(function (evt) { //保存
                    if(!$("#esh-edu-form").valid()){
                        return ESHUtils.stopEvent(evt);
                    }

                    var school = $("input[name='school']");
                    var eduid = $("input[name='eduid']");
                    var degree = $("select[name='degree']");
                    var subject = $("input[name='subject']");
                    var starDate = $("input[name='education-begin']");
                    var endDate = $("input[name='education-end']");

                    var formData = new FormData();
                    if(eduid.val()!= -1){
                        formData.append('eduid', eduid.val());
                    }
                    formData.append('school', school.val());
                    formData.append('date', starDate.val());
                    formData.append('gradu_date', endDate.val());
                    formData.append('major', subject.val());
                    formData.append('degree', degree.val());

                    ESHUtils.stopEvent(evt);
                    var $this = $(this);
                    $this.attr('disabled',true).text('正在保存...');
                    return $.ajax({
                        url: "/m/resume/addEducation",
                        type: 'post',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            sessionStorage.setItem("need-refresh", true);
                            $this.attr('disabled',true).text('保存');
                            var result = JSON.parse(data);
                            if(result.status===200){
                                history.back();
//                    self.location=document.referrer;
                            }else{
                                swal(result.msg);
                            }
//                checkResult(result.status, "教育经历已添加", result.msg, $educationPanelUpdate);
                        }
                    })
                });
            });
        })();

    </script>
@stop
