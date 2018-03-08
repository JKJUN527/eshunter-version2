@extends('mobile.layout.master')
@section('esh-css')
    <link rel="stylesheet" type="text/css" href="{{asset('mobile/plugins/mdl-picker/css/mdDateTimePicker.min.css')}}"/>
    @parent
@stop
@section('esh-header')
    @include('mobile.components.header',['title'=> isset($data["egid"])?"修改电竞经历":"新增电竞经历",'buttonLeft'=>true])
@stop
@section('esh-content')
    <form id="esh-game-form">
        <input type="hidden" id="egame-id" name="egame-id"
               value="{{$data["egid"] or '-1'}}" >
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>游戏名称
            </label>
            <div class="esh-select">
                <span class="esh-sval"></span>
                <select class="esh-select-option" id="egame-name" name="egamename">
                    @if(emptyArray($data['egame']))
                        <option value="-1">暂无游戏</option>
                    @endif
                    @foreach($data['egame'] as $egame)
                        <option value="{{$egame->id}}">{{$egame->name}}</option>
                    @endforeach
                </select>
                <label for="egame-name"></label>
            </div>
        </div>
        @foreach($data['egame'] as $egame)
            <div class="esh-edit" id="egrade-display{{$egame->id}}" name = "egrade-display" style="display: none;">
                <label class="esh-label">
                    <em>*</em>段位/排名
                </label>
                <div class="esh-select">
                    <span class="esh-sval"></span>
                    <select class="esh-select-option" name="egamelevel{{$egame->id}}">
                        @foreach($data['egrade'] as $egrade)
                            @if($egrade->egame_id == $egame->id)
                                <option value="{{$egrade->id}}">{{$egrade->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>接触时间
            </label>
            {{--esh-birth-input--}}
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" name="game-begin"
                       value="{{$data["date"] or ''}}"
                       data-date-format="yyyy-mm-dd" id="esh-game-begin" placeholder="请选择入职时间"/>
            </div>
        </div>
        <div class="esh-edit esh-textarea">
            <label class="esh-label">
                备注
            </label>
            <div class="esh-textarea--p">
                <textarea name="game-desc"
                          placeholder="备注你的服务大区、游戏ID、KDA、组排分等信息">{{$data["extra"] or ''}}</textarea>
            </div>
        </div>

        <div class="esh-edit-fb esh-form-sure">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                    type="button" id="esh-game-save">
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
        var ESHUtils = window.ESHUtils;
        ESHUtils.fillSpan();//填充span内容
        //自动关联游戏名称及游戏段位
        $('#egame-name').change(function () {
            var indexid = $("select[name='egamename']").val();
            var id = "#egrade-display" + indexid;
            $('div[name=egrade-display]').css("display", "none");
//        $("#egrade-label").css("display", "block");
            $(id).css("display", "block");
            //            $(id).style.display = block;
        });
        //开始时间
        var beginDate = new mdDateTimePicker.default({
            type: 'date',
            init: moment(moment().subtract(0,"years").format("l"),"YYYY-MM-DD"),
            //init: moment(moment().format("l"),"YYYY-MM-DD"),
            past:moment().subtract(50,"years"),
            ok:"确定",
            cancel:"取消"
        });
        $("#esh-game-begin").on('click',function(){
            beginDate.toggle();
        });
        /**/
        beginDate.trigger = $("#esh-game-begin")[0];
        $("#esh-game-begin").on("onOk",function(){
            //this.value = birthDate.time.toString();
            this.value = beginDate.time.format("YYYY-MM-DD");
        });

        $("#esh-game-save").click(function () {
            if(!$("#esh-game-form").valid()){
                return;
            }
            var gameBegin = $("input[name='game-begin']");
            var egame_id = $("input[name='egame-id']");
            var egameName = $("select[name='egamename']");
            var egrade  = $("select[name='egamelevel" + egameName.val() + "']");
            var gameDesc_raw = $("textarea[name='game-desc']");
            var gameDesc = gameDesc_raw.val().replace(/\r\n/g, '</br>');
            gameDesc = gameDesc.replace(/\n/g, '</br>');
//            gameDesc = gameDesc.replace(/\s/g, '</br>');


            if (egameName.val() === "" ||egameName.val() == "-1") {
                ESHUtils.setError(egameName, "egame-name", "不能为空");
                return;
            } else {
                ESHUtils.removeError(egameName, "egame-name");
            }

            if (egrade.val() === "") {
                ESHUtils.setError(egrade, "game-level", "必填信息");
                return;
            } else {
                ESHUtils.removeError(egrade, "game-level");
            }

//        if (gameBegin.val() === "") {
//            ESHUtils.setError(gameBegin, "game-begin", "不能为空");
//            return;
//        } else {
//            ESHUtils.removeError(gameBegin, "game-begin");
//        }

            var formData = new FormData();
            if(egame_id.val() != -1){
                formData.append('egid', egame_id.val());
            }
            formData.append('game', egameName.val());
            formData.append('level', egrade.val());
            formData.append('date', gameBegin.val());
            formData.append('extra', gameDesc);
            var $this = $(this);
            $this.attr('disabled',true).text('正在保存...');
            $.ajax({
                url: "/m/resume/addGame",
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
//                checkResult(result.status, "电竞经历已添加", result.msg, $intentionPanelUpdate);
                }
            })
        });
    </script>
@stop

