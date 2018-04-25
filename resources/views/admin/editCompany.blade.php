@extends('layout.admin')
@section('title', '修改公司信息')

@section('custom-style')
    <style>
        ul.mdl-menu,
        li.mdl-menu__item {
            padding: 0;
        }

        li.mdl-menu__item a {
            cursor: pointer;
            display: block;
            padding: 0 16px;
        }

        button[type="submit"] {
            margin-top: 16px;
        }

        .news-content--title {
            position: relative;
            height: 50px;
            border-bottom: 1px solid #ebebeb;
            margin: 64px 0 32px 0;
        }

        .news-content--title h6 {
            display: inline-block;
            margin: 0;
            vertical-align: middle;
        }

        #insert-image {
            position: absolute;
            right: 0;
            vertical-align: middle;
        }

        .preview {
            margin-top: 16px;
            border: 1px solid #F5F5F5;
            position: relative;
        }

        .preview label {
            margin: 0 24px 0 16px;
        }

        .preview p {
            display: inline-block;
            /*position: absolute;*/
            /*top: 30px;*/
            /*left:116px;*/
            font-size: 12px;
        }

        .preview p span {
            cursor: pointer;
            margin-right: 6px;
            padding: 2px 4px;
        }

        span.insert:hover {
            text-decoration: underline;
        }

        span.delete:hover {
            background-color: #ebebeb;
        }

        span.delete {
            color: #aaaaaa;
            border: 2px solid #ebebeb;
            background-color: #f5f5f5;
        }

        span.insert {
            color: #4CAF50;
        }

        .preview img {
            padding: 5px;
            border: 1px solid #f5f5f5;
            background-color: #f5f5f5;
        }
    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'company', 'subtitle'=>'companyList', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        修改公司信息
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a href="/admin/companys">返回公司列表</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="body">
                    <form role="form" method="post" id="add-company-form" data-content="{{$data['companyinfo']->id}}">

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="ename" name="ename" class="form-control" placeholder="公司名称" value="{{$data['companyinfo']->ename}}">
                            </div>
                            <label id="ename-error" class="error" for="ename"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="byname" name="byname" class="form-control" placeholder="公司别名" value="{{$data['companyinfo']->byname}}">
                            </div>
                            <label id="byname-error" class="error" for="byname"></label>
                        </div>

                        <label for="industry">所属行业</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" data-live-search="true"
                                    id="industry" name="industry" data-live-search="true">
                                <option value="0">无</option>
                                @foreach($data['industry'] as $industry)
                                    <option value="{{$industry->id}}" @if($data['companyinfo']->industry === $industry->id) selected @endif>{{$industry->name}}</option>
                                @endforeach
                            </select>
                            <label id="industry-error" class="error" for="industry"></label>
                        </div>
                        <label for="escale">公司规模</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" data-live-search="true"
                                    id="escale" name="escale" data-live-search="true">
                                <option value="0" @if($data['companyinfo']->escale === 0) selected @endif>请选择公司规模</option>
                                <option value="1" @if($data['companyinfo']->escale === 1) selected @endif>50人以下</option>
                                <option value="2" @if($data['companyinfo']->escale === 2) selected @endif>50～100人</option>
                                <option value="3" @if($data['companyinfo']->escale === 3) selected @endif>100～500人</option>
                                <option value="4" @if($data['companyinfo']->escale === 4) selected @endif>500～1000人</option>
                                <option value="5" @if($data['companyinfo']->escale === 5) selected @endif>1000人以上</option>
                            </select>
                            <label id="escale-error" class="error" for="escale"></label>
                        </div>
                        <label for="enature">公司类型</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" data-live-search="true"
                                    id="enature" name="enature" data-live-search="true">
                                <option value="1" @if($data['companyinfo']->enature === 1) selected @endif>国有企业</option>
                                <option value="2" @if($data['companyinfo']->enature === 2) selected @endif>民营企业</option>
                                <option value="3" @if($data['companyinfo']->enature === 3) selected @endif>中外合资企业</option>
                                <option value="4" @if($data['companyinfo']->enature === 4) selected @endif>外资企业</option>
                                <option value="5" @if($data['companyinfo']->enature === 5) selected @endif>社会团体</option>
                            </select>
                            <label id="enature-error" class="error" for="enature"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="address" name="address" class="form-control" placeholder="公司地址" value="{{$data['companyinfo']->address}}">
                            </div>
                            <label id="address-error" class="error" for="address"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="home_page" name="home_page" class="form-control" placeholder="公司官网链接地址" value="{{$data['companyinfo']->home_page}}">
                            </div>
                            <label id="home_page-error" class="error" for="home_page"></label>
                        </div>

                        <label for="ebrief">公司简介</label>
                        <div class="input-group">
                            <div class="form-line">
                                <textarea rows="8" class="form-control no-resize" id="ebrief" name="ebrief"
                                placeholder="在这里输入公司介绍内容..." required>{{str_replace("</br>","\r\n",$data['companyinfo']->ebrief)}}</textarea>
                            </div>
                            <label id="ebrief-error" class="error" for="ebrief"></label>
                        </div>

                        <label for="ebrief">企业LOGO</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="file" id="logo" name="logo" style="display: none" onchange="showPreview(this);">
                                <img id="choiceLogo" src="{{asset('images/addbg.png')}}" width="40">
                            </div>
                            <div id="previewLogo">
                                <img src='{{$data['companyinfo']->elogo}}' width='200' height='200'>
                            </div>
                            <label id="logo-error" class="error" for="logo"></label>
                        </div>


                        <button id="submit-company"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            修改公司信息
                        </button>
                    </form>
                </div><!-- #END# .body-->
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        function showPreview(element) {
            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            var ImagePath = $("input[name='logo']").val();
            if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(ImagePath)) {
                swal({
                    title: "错误",
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else if (file.size > 2 * 1024 * 1024) {
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
                            swal({
                                title: "错误",
                                type: "error",
                                text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n图片分辨率最大支持 1000像素 * 1000像素",
                                cancelButtonText: "关闭",
                                showCancelButton: true,
                                showConfirmButton: false
                            });
                        } else {
                            $("#previewLogo").html("<img src='" + objectUrl + "' width='200' height='200'>");
                        }
                    };
                    image.src = data;
                };
                reader.readAsDataURL(file);
            }
        }
        $("#choiceLogo").click(function () {
            $("#logo").click();
        });

        $("#submit-company").click(function (event) {
            event.preventDefault();
            var eid = $("#add-company-form").attr('data-content');

            var ename = $("#ename");
            var byname = $("#byname");
            var industry = $("select[name='industry']");
            var escale = $("select[name='escale']");
            var enature = $("select[name='enature']");
            var address = $("#address");
            var home_page = $("#home_page");
            var ebrief = $("#ebrief");
            var logo = $("#logo");

            if (ename.val() === '') {
                setError(ename, 'ename', "不能为空");
                return;
            } else {
                removeError(ename, 'ename');
            }
            if (industry.val() == 0) {
                setError(industry, 'industry', '不能为空');
                return;
            } else {
                removeError(industry, 'industry');
            }
            if (escale.val() == 0) {
                setError(escale, 'escale', '不能为空');
                return;
            } else {
                removeError(escale, 'escale');
            }
            if (enature.val() == 0) {
                setError(enature, 'enature', '不能为空');
                return;
            } else {
                removeError(enature, 'enature');
            }

            var testContent = ebrief.val().replace(/\r\n/g, '');
            testContent = testContent.replace(/\n/g, '');
            testContent = testContent.replace(/\s/g, '');

            if (testContent === '') {
                setError(ebrief, 'ebrief', '不能为空');
                return;
            } else {
                removeError(ebrief, 'ebrief');
            }

            var formData = new FormData();

            if (logo.prop("files")[0] === undefined) {
                console.log("file is empty");
                setError(logo, 'logo', "请上传公司logo-200像素 * 200像素");
                return;
            } else {
                removeError(logo, 'logo');
                formData.append('logo', logo.prop("files")[0]);
            }
            formData.append("eid", eid);
            formData.append("ename", ename.val());
            formData.append("byname", byname.val());
            formData.append("industry", industry.val());
            formData.append("escale", escale.val());
            formData.append("enature", enature.val());
            formData.append("ebrief", testContent);
            formData.append("home_page", home_page.val());
            formData.append("address", address.val());

            $.ajax({
                url: "/admin/addcompany",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    checkResult(result.status, "操作成功", result.msg, null);

                    if (result.status === 200) {
                        setTimeout(function () {
                            self.location = '/admin/companys';
                        }, 1200);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal(xhr.status + "：" + thrownError);
                }
            })

        })
    </script>
@show
