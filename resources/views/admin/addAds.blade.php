@extends('layout.admin')
@section('title', 'Add Ads')

@section('custom-style')
    <style>
        .top-border {
            border-top: 1px solid #f5f5f5;
        }

        .operate-btn {
            height: 80px !important;
            margin-bottom: 16px !important;
            cursor: pointer !important;
        }

        .operate-content {
            min-height: 400px;
        }

        .operate-content > p {
            text-align: center;
            margin-top: 24px;
        }

        .preview-holder {
            margin: 16px 0;
        }

        .preview-holder .delete-image {
            cursor: pointer;
            font-size: 18px;
            margin-left: 8px;
            color: #D32F2F;
            border: 2px solid #F44336;
            border-radius: 20px;
        }

        .preview-holder .delete-image:hover {
            background-color: #f5f5f5;
        }

        .image-preview img {
            border: 3px solid #f5f5f5;
        }

        .search-position {
            padding: 16px;
            background-color: #f5f5f5;
        }

        .search-position .form-line {
            width: 350px;
            display: inline-block;
            margin-right: 24px;
        }

        .search-position .form-line input {
            display: inline-block;
            width: 300px;
            background-color: #f5f5f5;
        }

        .big-image--ad,
        .small-image--ad,
        .word--ad {
            padding: 24px;
        }

        .dropdown-menu {
            max-height: 300px !important;
        }

    </style>
@endsection

@section('sidebar')
    @include('components.adminAside', ['title' => 'ad', 'subtitle'=>'addAds', 'username' => $data['username']])
@endsection

@section('content')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    发布广告
                </h2>
            </div>

            <div class="body">

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn big-image--btn">
                    <div class="info-box-3 bg-indigo hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">crop_3_2</i>
                        </div>
                        <div class="content">
                            <div class="text">发布大图片广告</div>
                            <div class="number" id="cu-applies-num"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn small-image--btn">
                    <div class="info-box-3 bg-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">crop_7_5</i>
                        </div>
                        <div class="content">
                            <div class="text">发布小图片广告</div>
                            <div class="number" id="cu-users-num"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn word--btn">
                    <div class="info-box-3 bg-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">font_download</i>
                        </div>
                        <div class="content">
                            <div class="text">发布文字广告</div>
                            <div class="number" id="cu-users-num"></div>
                        </div>
                    </div>
                </div>

                {{--<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 operate-btn hiring--btn">--}}
                {{--<div class="info-box-3 bg-red hover-zoom-effect">--}}
                {{--<div class="icon">--}}
                {{--<i class="material-icons">whatshot</i>--}}
                {{--</div>--}}
                {{--<div class="content">--}}
                {{--<div class="text">设置急聘职位</div>--}}
                {{--<div class="number" id="cu-users-num"></div>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--</div>--}}

                <div style="clear:both;"></div>
            </div>

            <div class="top-border operate-content">
                <p class="undefined-type">请先选择操作类型</p>

                <div class="big-image--ad">

                    <h4>发布大图片广告</h4>

                    <form role="form" method="post" id="add-big-image--form">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="file" id="picture-big" name="picture-big" class="form-control"
                                       onchange='showBigPreview(this)'/>
                            </div>
                            <div class="help-info" for="picture-big">.jpg 或 .png格式，200×100 像素</div>
                            <label id="picture-big-error" class="error" for="picture-big"></label>
                        </div>

                        <div id="preview-holder-big" class="preview-holder">
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title-big" name="title-big" class="form-control"
                                       placeholder="标题，例如公司名称">
                            </div>
                            <label id="title-big-error" class="error" for="title-big"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="subtitle-big" name="subtitle-big" class="form-control"
                                       placeholder="副标题，例如公司介绍／职位">
                            </div>
                            <label id="subtitle-big-error" class="error" for="subtitle-big"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="url-big" name="url-big" class="form-control"
                                       placeholder="链接">
                            </div>
                            <div class="help-info" for="url-big">公司网址链接</div>
                            <label id="url-big-error" class="error" for="url-big"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="number" id="eid-big" name="eid-big" min="1" step="1" class="form-control"
                                       placeholder="公司ID">
                            </div>
                            <div class="help-info" for="eid-big"></div>
                            <label id="eid-big-error" class="error" for="eid-big"></label>
                        </div>

                        <label for="date-big">有效截至日期</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="date" id="date-big" name="date-big" class="form-control"
                                       placeholder="有效截至日期">
                            </div>
                            <label id="date-big-error" class="error" for="date-big"></label>
                        </div>

                        <label for="big-image--location">位置</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="big-image--location"
                                    name="big-image--location">
                                <option value="0">请选择广告位置</option>
                                @foreach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47] as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach

                            </select>
                            <label class="error" for="big-image--location"></label>
                        </div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            发布
                        </button>
                    </form>
                </div>

                <div class="small-image--ad">

                    <h4>发布小图片广告</h4>

                    <form role="form" method="post" id="add-small-image--form">
                        <div class="input-group">
                            <div class="form-line">
                                <input type="file" id="picture-small" name="picture-small" class="form-control"
                                       onchange="showSmallPreview(this)"/>
                            </div>
                            <div class="help-info" for="picture">.jpg 或 .png格式，100×50 像素</div>
                            <label id="picture-error" class="error" for="picture"></label>
                        </div>

                        <div id="preview-holder-small" class="preview-holder">
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title-small" name="title-small" class="form-control"
                                       placeholder="标题，例如公司名称"
                                       required>
                            </div>
                            <label id="title-small-error" class="error" for="title-small"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="url-small" name="url-small" class="form-control"
                                       placeholder="链接">
                            </div>
                            <div class="help-info" for="url-small">公司网址链接</div>
                            <label id="url-small-error" class="error" for="url-small"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="number" id="eid-small" min="1" step="1" name="eid-small"
                                       class="form-control"
                                       placeholder="公司ID">
                            </div>
                            <div class="help-info" for="eid-small"></div>
                            <label id="eid-small-error" class="error" for="eid-small"></label>
                        </div>

                        <label for="date-small">有效截至日期</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="date" id="date-small" name="date-small" class="form-control"
                                       placeholder="有效截至日期">
                            </div>
                            <label id="date-small-error" class="error" for="date-small"></label>
                        </div>

                        <label for="small-image--location">位置</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="small-image--location"
                                    name="small-image--location">
                                <option value="0">请选择广告位置</option>
                                @foreach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15] as $position)
                                    <option value="{{$position}}">{{$position}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            发布
                        </button>
                    </form>
                </div>

                <div class="word--ad">
                    <h4>发布文字广告</h4>

                    <form role="form" method="post" id="add-word--form">

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title-word" name="title-word" class="form-control"
                                       placeholder="公司名称"
                                       required>
                            </div>
                            <label id="title-word-error" class="error" for="title-word"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="url-word" name="url-word" class="form-control"
                                       placeholder="链接">
                            </div>
                            <div class="help-info" for="url-word">公司网址链接，可以为空</div>
                            <label id="url-word-error" class="error" for="url-word"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="number" id="eid-word" name="eid-word" min="1" step="1" class="form-control"
                                       placeholder="公司ID">
                            </div>
                            <div class="help-info" for="eid-word"></div>
                            <label id="eid-word-error" class="error" for="eid-word"></label>
                        </div>

                        <label for="date-word">有效截至日期</label>
                        <div class="input-group">
                            <div class="form-line">
                                <input type="date" id="date-word" name="date-word" class="form-control"
                                       placeholder="有效截至日期">
                            </div>
                            <label id="date-word-error" class="error" for="date-word"></label>
                        </div>

                        <label for="word--location">位置</label>
                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker" id="word--location"
                                    data-live-search="true"
                                    name="word--location">
                                <option value="0">请选择广告位置</option>
                                @foreach([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22] as $position)
                                    <option value="{{$position}}">{{$position}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            发布
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        var bigImageAd = $(".big-image--ad");
        var smallImageAd = $(".small-image--ad");
        var wordAd = $(".word--ad");
        var hiringAd = $(".hiring--ad");

        var undefinedType = $(".undefined-type");

        bigImageAd.hide();
        smallImageAd.hide();
        wordAd.hide();
        hiringAd.hide();

        $(".big-image--btn").click(function (event) {
            undefinedType.hide();
            smallImageAd.hide();
            wordAd.hide();
            hiringAd.hide();

            bigImageAd.fadeIn(500);
        });

        $(".small-image--btn").click(function (event) {
            undefinedType.hide();
            bigImageAd.hide();
            wordAd.hide();
            hiringAd.hide();

            smallImageAd.fadeIn(500);
        });

        $(".word--btn").click(function (event) {
            undefinedType.hide();
            bigImageAd.hide();
            smallImageAd.hide();
            hiringAd.hide();

            wordAd.fadeIn(500);
        });

        $(".hiring--btn").click(function (event) {
            undefinedType.hide();
            bigImageAd.hide();
            smallImageAd.hide();
            wordAd.hide();

            hiringAd.fadeIn(500);
        });

        function showBigPreview(element) {
            var isCorrect = true;

            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            var bigImagePath = $("input[name='picture-big']").val();
            if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(bigImagePath)) {
                isCorrect = false;
                $("#picture-big").val("");
                swal({
                    title: "错误",
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else if (file.size > 2 * 1024 * 1024) {
                isCorrect = false;
                $("#picture-big").val("");
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

                        if (width !== 200 || height !== 100) {
                            isCorrect = false;
                            $("#picture-big").val("");
                            swal({
                                title: "错误",
                                type: "error",
                                text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n大图片广告分辨率应为 200像素 * 100像素",
                                cancelButtonText: "关闭",
                                showCancelButton: true,
                                showConfirmButton: false
                            });
                        } else if (isCorrect) {
                            $("#preview-holder-big").html("<div class='image-preview'>" +
                                "<img src='" + objectUrl + "' width='200' height='100'>" +
                                "<i class='material-icons delete-image' onclick='deleteBigImage(this)'>close</i></div>");
                        }
                    };
                    image.src = data;
                };
                reader.readAsDataURL(file);
            }
        }

        function showSmallPreview(element) {
            var isCorrect = true;

            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            var smallImagePath = $("input[name='picture-small']").val();
            if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(smallImagePath)) {
                isCorrect = false;
                $("#picture-small").val("");
                swal({
                    title: "错误",
                    type: "error",
                    text: "图片格式错误，支持：.jpg .jpeg .png类型。请选择正确格式的图片后再试！",
                    cancelButtonText: "关闭",
                    showCancelButton: true,
                    showConfirmButton: false
                });
            } else if (file.size > 2 * 1024 * 1024) {
                isCorrect = false;
                $("#picture-small").val("");
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

                        if (width !== 100 || height !== 50) {
                            isCorrect = false;
                            $("#picture-small").val("");
                            swal({
                                title: "错误",
                                type: "error",
                                text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n小图片广告分辨率应为 100像素 * 50像素",
                                cancelButtonText: "关闭",
                                showCancelButton: true,
                                showConfirmButton: false
                            });
                        } else if (isCorrect) {
                            $("#preview-holder-small").html("<div class='image-preview'>" +
                                "<img src='" + objectUrl + "' width='100' height='50'>" +
                                "<i class='material-icons delete-image' onclick='deleteSmallImage(this)'>close</i></div>");
                        }
                    };
                    image.src = data;
                };
                reader.readAsDataURL(file);
            }
        }

        function deleteBigImage(element) {

            var imageHolder = element.parentNode;

            swal({
                title: "确认",
                text: "确认删除图片吗",
                type: "info",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                swal("图片已删除");
                $("#picture-big").val(null);
                imageHolder.remove();
            });
        }

        function deleteSmallImage(element) {

            var imageHolder = element.parentNode;

            swal({
                title: "确认",
                text: "确认删除图片吗",
                type: "info",
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                swal("图片已删除");
                $("#picture-small").val(null);
                imageHolder.remove();
            });
        }

        $("#add-big-image--form").submit(function (event) {
            event.preventDefault();

            var file = $("#picture-big");
            var title = $("input[name='title-big']");
            var subtitle = $("input[name='subtitle-big']");
            var eid = $("input[name='eid-big']");
            var date = $("input[name='date-big']");
            var url = $("input[name='url-big']");
            var location = $("select[name='big-image--location']");

            if (title.val() === '') {
                setError(title, 'title-big', "不能为空");
                return;
            } else {
                removeError(title, 'title-big');
            }

            if (subtitle.val() === '') {
                setError(subtitle, 'subtitle-big', "不能为空");
                return;
            } else {
                removeError(subtitle, 'subtitle-big');
            }

            if (url.val() === '') {
                setError(url, 'url-big', "不能为空");
                return;
            } else {
                removeError(url, 'url-big');
            }

            if (eid.val() === '') {
                setError(eid, 'eid-big', "不能为空");
                return;
            } else {
                removeError(eid, 'eid-big');
            }

            if (date.val() === '') {
                setError(date, 'date-big', "不能为空");
                return;
            } else {
                removeError(date, 'date-big');
            }

            if (location.val() === '0') {
                setError(location, "big-image--location", "请选择广告位置");
                return;
            } else {
                removeError(location, "big-image--location");
            }

            var formData = new FormData();

            if (file.prop("files")[0] === undefined) {
                console.log("file is empty");
                setError(file, 'picture-big', "请上传广告图片200像素 * 100像素");
                return;
            } else {
                removeError(file, 'picture-big');
                formData.append('adpic', file.prop("files")[0]);
            }

            formData.append('type', 0);
            formData.append('title', title.val());
            formData.append('content', subtitle.val());
            formData.append('homepage', url.val());
            formData.append('validity', date.val());
            formData.append('location', location.val());
            formData.append('eid', eid.val());

            $.ajax({
                url: "/admin/ads/find?type=0&location=" + location.val(),
                type: "get",
                success: function (data) {

                    if (data['status'] === 401) {
                        swal({
                            type: "warning",
                            title: "提醒",
                            text: location.val() + "号位置已有广告，确定替换吗？",
                            confirmButtonText: "确认",
                            cancelButtonText: "取消",
                            showCancelButton: true,
                            closeOnConfirm: true
                        }, function () {
                            $.ajax({
                                url: "/admin/ads/del?type=0&location=" + location.val(),
                                type: "get",
                                success: function (data) {
                                    if (data['status'] === 400) {
                                        swal({
                                            type: "error",
                                            title: "删除错误",
                                            cancelButtonText: "关闭",
                                            showCancelButton: true,
                                            showConfirmButton: false
                                        })
                                    } else {
                                        $.ajax({
                                            url: "/admin/ads/add",
                                            type: "post",
                                            dataType: 'text',
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            data: formData,
                                            success: function (data) {
                                                var result = JSON.parse(data);
                                                checkResult(result.status, "添加成功", result.msg, null);
                                            },
                                            error: function (xhr, ajaxOptions, thrownError) {
                                                swal(xhr.status + "：" + thrownError);
                                            }
                                        })
                                    }
                                }
                            })
                        })
                    } else if (data['status'] === 200) {
                        $.ajax({
                            url: "/admin/ads/add",
                            type: "post",
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function (data) {
                                var result = JSON.parse(data);
                                checkResult(result.status, "添加成功", result.msg, null);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal(xhr.status + "：" + thrownError);
                            }
                        })
                    }
                }
            })
        });

        $("#add-small-image--form").submit(function (event) {
            event.preventDefault();

            var file = $("#picture-small");
            var title = $("input[name='title-small']");
            var date = $("input[name='date-small']");
            var eid = $("input[name='eid-small']");
            var url = $("input[name='url-small']");
            var location = $("select[name='small-image--location']");

            if (title.val() === '') {
                setError(title, 'title-small', "不能为空");
                return;
            } else {
                removeError(title, 'title-small');
            }

            if (url.val() === '') {
                setError(url, 'url-small', "不能为空");
                return;
            } else {
                removeError(url, 'url-small');
            }

            if (eid.val() === '') {
                setError(eid, 'eid-small', "不能为空");
                return;
            } else {
                removeError(eid, 'eid-small');
            }

            if (date.val() === '') {
                setError(date, 'date-small', "不能为空");
                return;
            } else {
                removeError(date, 'date-small');
            }

            if (location.val() === '0') {
                setError(location, "small-image--location", "请选择广告位置");
                return;
            } else {
                removeError(location, "small-image--location");
            }

            var formData = new FormData();

            if (file.prop("files")[0] === undefined) {
                console.log("file is empty");
                setError(file, 'picture-small', "请上传广告图片200像素 * 80像素");
                return;
            } else {
                removeError(file, 'picture-small');
                formData.append('adpic', file.prop("files")[0]);
            }

            formData.append('type', 1);
            formData.append('title', title.val());
            formData.append('content', 'empty');
            formData.append('homepage', url.val());
            formData.append('validity', date.val());
            formData.append('location', location.val());
            formData.append('eid', eid.val());

            $.ajax({
                url: "/admin/ads/find?type=1&location=" + location.val(),
                type: "get",
                success: function (data) {

                    if (data['status'] === 401) {
                        swal({
                            type: "warning",
                            title: "提醒",
                            text: location.val() + "号位置已有广告，确定替换吗？",
                            confirmButtonText: "确认",
                            cancelButtonText: "取消",
                            showCancelButton: true,
                            closeOnConfirm: true
                        }, function () {
                            $.ajax({
                                url: "/admin/ads/del?type=1&location=" + location.val(),
                                type: "get",
                                success: function (data) {
                                    if (data['status'] === 400) {
                                        swal({
                                            type: "error",
                                            title: "删除错误",
                                            cancelButtonText: "关闭",
                                            showCancelButton: true,
                                            showConfirmButton: false
                                        })
                                    } else {
                                        $.ajax({
                                            url: "/admin/ads/add",
                                            type: "post",
                                            dataType: 'text',
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            data: formData,
                                            success: function (data) {
                                                var result = JSON.parse(data);
                                                checkResult(result.status, "添加成功", result.msg, null);
                                            },
                                            error: function (xhr, ajaxOptions, thrownError) {
                                                swal(xhr.status + "：" + thrownError);
                                            }
                                        })
                                    }
                                }
                            })
                        })
                    } else if (data['status'] === 200) {
                        $.ajax({
                            url: "/admin/ads/add",
                            type: "post",
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function (data) {
                                var result = JSON.parse(data);
                                checkResult(result.status, "添加成功", result.msg, null);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal(xhr.status + "：" + thrownError);
                            }
                        })
                    }
                }
            })
        });

        $("#add-word--form").submit(function (event) {
            event.preventDefault();

            var title = $("input[name='title-word']");
            var date = $("input[name='date-word']");
            var url = $("input[name='url-word']");
            var location = $("select[name='word--location']");
            var eid = $("input[name='eid-word']");

            if (title.val() === '') {
                setError(title, 'title-word', "不能为空");
                return;
            } else {
                removeError(title, 'title-word');
            }

            if (url.val() === '') {
                setError(url, 'url-word', "不能为空");
                return;
            } else {
                removeError(url, 'url-word');
            }

            if (eid.val() === '') {
                setError(eid, 'eid-word', "不能为空");
                return;
            } else {
                removeError(eid, 'eid-word');
            }

            if (date.val() === '') {
                setError(date, 'date-word', "不能为空");
                return;
            } else {
                removeError(date, 'date-word');
            }

            if (location.val() === '0') {
                setError(location, "word--location", "请选择广告位置");
                return;
            } else {
                removeError(location, "word--location");
            }

            var formData = new FormData();

            formData.append('type', 2);
            formData.append('title', title.val());
            formData.append('content', 'empty');
            formData.append('homepage', url.val());
            formData.append('validity', date.val());
            formData.append('location', location.val());
            formData.append('eid', eid.val());

            $.ajax({
                url: "/admin/ads/find?type=2&location=" + location.val(),
                type: "get",
                success: function (data) {

                    if (data['status'] === 401) {
                        swal({
                            type: "warning",
                            title: "提醒",
                            text: location.val() + "号位置已有广告，确定替换吗？",
                            confirmButtonText: "确认",
                            cancelButtonText: "取消",
                            showCancelButton: true,
                            closeOnConfirm: true
                        }, function () {
                            $.ajax({
                                url: "/admin/ads/del?type=2&location=" + location.val(),
                                type: "get",
                                success: function (data) {
                                    if (data['status'] === 400) {
                                        swal({
                                            type: "error",
                                            title: "删除错误",
                                            cancelButtonText: "关闭",
                                            showCancelButton: true,
                                            showConfirmButton: false
                                        })
                                    } else {
                                        $.ajax({
                                            url: "/admin/ads/add",
                                            type: "post",
                                            dataType: 'text',
                                            cache: false,
                                            contentType: false,
                                            processData: false,
                                            data: formData,
                                            success: function (data) {
                                                var result = JSON.parse(data);
                                                checkResult(result.status, "添加成功", result.msg, null);
                                            },
                                            error: function (xhr, ajaxOptions, thrownError) {
                                                swal(xhr.status + "：" + thrownError);
                                            }
                                        })
                                    }
                                }
                            })
                        })
                    } else if (data['status'] === 200) {
                        $.ajax({
                            url: "/admin/ads/add",
                            type: "post",
                            dataType: 'text',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function (data) {
                                var result = JSON.parse(data);
                                checkResult(result.status, "添加成功", result.msg, null);
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                swal(xhr.status + "：" + thrownError);
                            }
                        })
                    }
                }
            })
        })
    </script>
@show
