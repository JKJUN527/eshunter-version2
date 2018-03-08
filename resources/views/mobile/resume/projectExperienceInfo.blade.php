@extends('mobile.layout.master')
@section('esh-css')
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/mdl-picker/css/mdDateTimePicker.min.css')}}"/>
    @parent
@stop
@section('esh-header')
    @include('mobile.components.header',['title'=> isset($data["id"])?"修改项目/赛事经历":"新增项目/赛事经历",'buttonLeft'=>true])
@stop
@section('esh-content')
    <form id="esh-project-form">
        <input type="hidden" id="projectex-id" name="projectex-id"
               value="{{$data["id"] or '-1'}}" >
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>项目/赛事
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="project-name"
                       placeholder="请输入项目/赛事名称"
                       value="{{$data['project_name'] or ''}}">
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>项目职责
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="project-position"
                       placeholder="请输入项目职责"
                       value="{{$data['position'] or ''}}">
            </div>
        </div>

        <?php
        $beginDate = "";
        $endDate = "";
        if(isset($data['project_time'])){
            $index = strpos($data['project_time'],"@");
            $beginDate = substr($data['project_time'],0,$index);
            $endDate = substr($data['project_time'],$index+1,strlen($data['project_time'])-1);
        }
        ?>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>开始时间
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="project-begin"
                       value="{{$beginDate}}"
                       data-date-format="yyyy-mm-dd" id="esh-project-begin" placeholder="请选择入职时间"/>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>截止时间
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="project-end"
                       value="{{$endDate}}"
                       data-date-format="yyyy-mm-dd" id="esh-project-end" placeholder="请选择入职时间"/>
            </div>
        </div>
        <div class="esh-edit esh-textarea">
            <label class="esh-label">
                项目描述
            </label>
            <div class="esh-textarea--p">
                    <textarea placeholder="介绍你的项目情况" maxlength="150"
                              name='project-desc'>{{$data['describe'] or ''}}</textarea>
            </div>
        </div>
        <div class="esh-edit-fb esh-form-sure">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                    type="button" id="esh-project-save">
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
//        sessionStorage.setItem("need-refresh", true);
        var beginDate = new mdDateTimePicker.default({
            type: 'date',
            init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
            //init: moment(moment().format("l"),"YYYY-MM-DD"),
            past:moment().subtract(50,"years"),
            ok:"确定",
            cancel:"取消"
        });
        //入职时间
        $("#esh-project-begin").on('click',function(){
            beginDate.toggle();
        });
        /**/
        beginDate.trigger = $("#esh-project-begin")[0];
        $("#esh-project-begin").on("onOk",function(){
            //this.value = birthDate.time.toString();
            this.value = beginDate.time.format("YYYY-MM-DD");
        });

        //离职时间
        var endDate = new mdDateTimePicker.default({
            type: 'date',
            init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
            //init: moment(moment().format("l"),"YYYY-MM-DD"),
            past:moment().subtract(50,"years"),
            ok:"确定",
            cancel:"取消"
        });
        $("#esh-project-end").on('click',function(){
            endDate.toggle();
        });
        /**/
        endDate.trigger = $("#esh-project-end")[0];
        $("#esh-project-end").on("onOk",function(){
            //this.value = birthDate.time.toString();
            this.value = endDate.time.format("YYYY-MM-DD");
        });

        $("#esh-project-save").click(function () {
            if(!$("#esh-project-form").valid()){
                return;
            }
            var projectName = $("input[name='project-name']");
            var projectex_id = $("input[name='projectex-id']");
            var positionName = $("input[name='project-position']");
            var beginDate = $("input[name='project-begin']");
            var endDate = $("input[name='project-end']");
            var projectDesc_raw = $("textarea[name='project-desc']");
            var projectDesc = projectDesc_raw.val().replace(/\r\n/g, '</br>');
            projectDesc = projectDesc.replace(/\n/g, '</br>');


//        if (projectDesc.length >150) {
//            setError(projectDesc_raw, "project-desc", "最大字数不能超过150字");
//            return;
//        } else {
//            removeError(projectDesc_raw, "project-desc");
//        }

            var formData = new FormData();
            if(projectex_id.val() != -1){
                formData.append('id',projectex_id.val());
            }
            formData.append('project_name', projectName.val());
            formData.append('position', positionName.val());
            formData.append('describe', projectDesc);
            formData.append('project_time', beginDate.val() + "@" + endDate.val());

            var $this = $(this);
            $this.attr('disabled',true).text('正在保存...');
            $.ajax({
                url: "/m/resume/addProjectexp",
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
//                checkResult(result.status, "项目经历已添加", result.msg, null);
                }
            })
        });
    </script>
@stop

