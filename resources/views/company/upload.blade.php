@extends('layout.master')
@section('title', '提交公司信息')

@section('custom-style')
 <link media="all" href="{{asset('../style/gsxx.css?v=2.40')}}" type="text/css" rel="stylesheet">
 <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
 <link media="all" href="{{asset('../style/upload_company.css')}}" type="text/css" rel="stylesheet">
 <link media="all" href="{{asset('../plugins/bootstrap/css/bootstrap.css')}}" type="text/css" rel="stylesheet">
 <style>
     .header{
         display: block;
     }
 </style>

@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 5,'type' => $data['type']])
@endsection

@section('content')
    <div class="container pin-container">
        <div class="row">



            <div class="editing hidden-xs hidden-sm">
                <div class="col-md-8">
                    <div class="detail-title">
                        <a href="/" title="首页">首页 &gt;</a>
                        <a href="/company" title="公司">公司 &gt;</a>
                        <a href="#nogo" title="首页" style="color: #000">添加公司信息</a>
                    </div>
                    <div class="detail-left">
                        <form id="product_baseinfo" class="form-horizontal"  method="post">
                            <div class="edit-box">
                                <h4>添加公司信息</h4>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司全称 <span>*</span></label>
                                    <div class="col-sm-6 col-lg-7">
                                        <input class="form-control" type="text" name="ename" id="ename" value="" placeholder="例如 上海汉竞信息科技有限公司"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司简称&nbsp;&nbsp;</label>
                                    <div class="col-sm-6 col-lg-7">
                                        <input type="text" class="form-control" name="byname" id="byname" value=""  placeholder="例如 电竞猎人" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司行业 <span>*</span></label>
                                    <div class="col-sm-6 col-lg-7">
                                        <select class="form-control" name="industry">
                                            <option value="-1">请选择公司行业</option>
                                        @foreach($data['industry'] as $industry)
                                                <option value="{{$industry->id}}">{{$industry->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司规模 <span>*</span></label>
                                    <div class="col-sm-6 col-lg-7">
                                        <select class="form-control" name="escale">
                                            <option value="-1">请选择公司规模</option>
                                            <option value="1">50以内</option>
                                            <option value="2">50~200人</option>
                                            <option value="3">200~500人</option>
                                            <option value="4">500~1000人</option>
                                            <option value="5">1000人以上</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司性质 <span>*</span></label>
                                    <div class="col-sm-6 col-lg-7">
                                        <select class="form-control" name="enature">
                                            <option value="-1">请选择公司性质</option>
                                            <option value="1">国有企业</option>
                                            <option value="2">民营企业</option>
                                            <option value="3">中外合资</option>
                                            <option value="4">外资企业</option>
                                            <option value="5">社会团体</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司地址 <span>*</span></label>
                                    <div class="col-sm-6 col-lg-7">
                                        <input type="text" class="form-control" id="address" value=""  placeholder="例如 上海市静安区公兴路155号二层" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司简介&nbsp;&nbsp;</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control img-responsive" rows="3" name="ebrief" placeholder="请输入公司简介,最多500个字符" ></textarea>
                                    </div>
                                </div>

                                <div class="pull-right thumb">
                                    <img src="{{asset('images/bg_grain_200x200.png')}}" id="icon_privew" alt=""  style="height: 130px"/>
                                    <input style="display: none" type="file" name="elogo" value="" id="elogo" onchange="previewLogo(this)" />
                                    <span style="top: 85px">建议上传200*180的实底图标 支持PNG、JPG</span>
                                    <br>
                                    <div class="text-center">
                                        <div id="singleBtn" class="webuploader-pick">选择图标</div>
                                    </div>
                                </div>
                            </div>

                            <div class="edit-box">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">公司网址</label>
                                    <div class="col-sm-6 col-lg-7">
                                        <input class="form-control" type="text" name="url" placeholder="例如 http://eshunter.com" value="" />
                                    </div>
                                </div>
                                {{--<div class="form-group">--}}
                                    {{--<label class="col-sm-2 control-label">上线时间</label>--}}
                                    {{--<div class="col-sm-3">--}}
                                        {{--<input class="form-control" type="text" name="buildyear" id="buildyear" placeholder="例如 2013" value=""/>--}}
                                    {{--</div>--}}
                                    {{--<div class="pull-left form-control-static">年</div>--}}
                                    {{--<div class="col-sm-3">--}}
                                        {{--<select class="form-control" name="buildmonth">--}}
                                            {{--<option value="1" >1</option>--}}
                                            {{--<option value="2" >2</option>--}}
                                            {{--<option value="3" >3</option>--}}
                                            {{--<option value="4" >4</option>--}}
                                            {{--<option value="5" >5</option>--}}
                                            {{--<option value="6" >6</option>--}}
                                            {{--<option value="7" >7</option>--}}
                                            {{--<option value="8" >8</option>--}}
                                            {{--<option value="9" >9</option>--}}
                                            {{--<option value="10" >10</option>--}}
                                            {{--<option value="11" >11</option>--}}
                                            {{--<option value="12" >12</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="pull-left form-control-static">月</div>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-success btn-block" id="upload_company">提交信息</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-right">
                        <div class="edit-box" style="min-height: 611px">
                            <h4>欢迎您在电竞猎人参与贡献</h4>
                            <p>您提交的公司信息将保存在数据库中，管理员审核通过后将展示最新资料。<br>
                                <br>
                                电竞猎人旨在为电竞产业链，尤其是电竞人才招聘上提供最新最全的公司、人才信息，方便大家更快捷的找对公司、找对人才。<br>
                                <br>
                                感谢您，祝您在电竞猎人有所收获！
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    <script>
        $("#singleBtn").click(function (event) {
            // alert(123);
            event.preventDefault();
            swal({
                title: "要求",
                text: "上传图片要求：格式为：.jpg，.jpeg，.png\n分辨率最大支持 1000像素 * 1000像素\n图片文件大小最大支持2MB",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                $("#elogo").click();
            });
        });
        function previewLogo(element) {
            // alert(123);
            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            console.log(objectUrl);


            var headImagePath = $("input[name='elogo']").val();

            console.log(headImagePath);


            if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(headImagePath)) {
                isCorrect = false;
                swal({
                    title: "错误",
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else {
                var size = file.size;
                console.log(size);

                if (size > 2 * 1024 * 1024) {
                    swal({
                        title: "错误",
                        type: "error",
                        text: "图片文件最大支持：2MB",
                        cancelButtonText: "关闭",
                        showCancelButton: true,
                        showConfirmButton: false
                    });
                } else {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var data = e.target.result;
                        //加载图片获取图片真实宽度和高度
                        var image = new Image();
                        image.onload = function () {
                            var width = image.width;
                            var height = image.height;
                            console.log(width + "//" + height);

                            if (width > 1000 || height > 1000) {
                                isCorrect = false;

                                swal({
                                    title: "错误",
                                    type: "error",
                                    text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n图片分辨率最大支持 1000像素 * 1000像素",
                                    cancelButtonText: "关闭",
                                    showCancelButton: true,
                                    showConfirmButton: false
                                });
                            } else{
                                originalHeadImg = $("#icon_privew").attr("src");
                                $("#icon_privew").attr("src", objectUrl);
                            }
                        };
                        image.src = data;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
        $("#upload_company").click(function (event) {
            event.preventDefault();
            var ename = $('#ename');
            var byname = $('#byname');
            var elogo = $('#elogo');

            var industry = $("select[name='industry']").val();
            var enature = $("select[name='enature']").val();
            var escale = $("select[name='escale']").val();
            var address = $("#address");
            var ebrief = $("textarea[name=ebrief]").val();
            var home_page = $("input[name=url]").val();
            ebrief = ebrief.replace(/\r\n/g, '<br>');
            ebrief = ebrief.replace(/\n/g, '<br>');
            ebrief = ebrief.replace(/\s/g, '&nbsp;');

            if(ename.val() === "" || ename.val() === null){
                swal("","公司名称不能为空","error");
                return;
            }
            if(industry === "-1"){
                swal("","请选择公司行业","error");
                return;
            }
            if(escale === "-1"){
                swal("","请选择公司规模","error");
                return;
            }
            if(enature === "-1"){
                swal("","请选择公司性质","error");
                return;
            }
            if(address.val() === "" || address.val() === null){
                swal("","公司地址不能为空","error");
                return;
            }
            if(ebrief.length >500){
                swal("","公司简介最多为500字","error");
                return;
            }
            var formData = new FormData();

            if (elogo.prop("files")[0] === undefined) {
                console.log("file is empty");
                swal("","请上传公司logo","error");
                return;
                //formData.append('photo', "");
            } else {

                formData.append('elogo', elogo.prop("files")[0]);
            }
            formData.append("ename", ename.val());
            formData.append("byname", byname.val());
            formData.append("industry", industry);
            formData.append("enature", enature);
            formData.append("escale", escale);
            formData.append("ebrief", ebrief);
            formData.append("address", address.val());
            formData.append("home_page", home_page);
            $.ajax({
                url: "/company/add/event",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    checkResult(result.status, "资料已提交", result.msg, null);
                   // window.history.back(-1);
                   //  self.location='/searchcompany';
                    //window.location.href="http://www.eshunter.com/account";
                }
            })



        });
    </script>
@endsection
