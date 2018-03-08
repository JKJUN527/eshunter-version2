@extends('layout.admin')
@section('title', 'Add News')

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
    @include('components.adminAside', ['title' => 'news', 'subtitle'=>'addNews', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        发布新闻
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a href="/admin/news">返回新闻列表</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="body">
                    <form role="form" method="post" id="add-news-form">

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title" name="title" class="form-control" placeholder="新闻标题">
                            </div>
                            <label id="title-error" class="error" for="title"></label>
                        </div>

                        {{--<div class="input-group">--}}
                        {{--<div class="form-line">--}}
                        {{--<input type="text" id="subtitle" name="subtitle" class="form-control"--}}
                        {{--placeholder="新闻副标题">--}}
                        {{--</div>--}}
                        {{--<label id="subtitle-error" class="error" for="subtitle"></label>--}}
                        {{--</div>--}}

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="quote" name="quote" class="form-control"
                                       placeholder="Quote">
                            </div>
                            <label id="quote-error" class="error" for="quote"></label>
                        </div>

                        <div class="form-group">
                            {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                            <select class="form-control show-tick selectpicker"
                                    id="newtype" name="newtype">
                                <option value="0">请选择新闻类别</option>
                                <option value="1">综合电竞</option>
                                <option value="2">电竞八卦</option>
                                <option value="3">赛事资讯</option>
                                <option value="4">游戏快讯</option>
                                <option value="5">职场鸡汤</option>
                            </select>
                            <label class="error" for="newtype"></label>
                        </div>

                        <div class="news-content--title">
                            <h6>新闻内容</h6>
                            <a id="insert-image" onclick="insertImage(this)"
                               class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-link">
                                插入图片
                            </a>
                        </div>

                        <div class="input-group">
                            <div id="wangeditor">
                            </div>
                            {{--<div class="form-line">--}}
                                    {{--<textarea rows="8" class="form-control no-resize" id="content" name="content"--}}
                                              {{--placeholder="在这里输入新闻内容..." required></textarea>--}}
                            {{--</div>--}}
                            <label id="content-error" class="error" for="content"></label>
                        </div>

                        <input hidden type="text" name="picture-index" value="" disabled/>

                        <div id="preview-holder">
                        </div>

                        <br>

                        <button id="submit-news"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            添加项目
                        </button>
                    </form>
                </div><!-- #END# .body-->
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript" src="{{asset('js/wangEditor/wangEditor.min.js')}}"></script>
    <script type="text/javascript">
        var index = 1;
        var previewHolder = $("#preview-holder");
        var appendFileInput = true;

        var E = window.wangEditor;
        var editor = new E('#wangeditor');
        editor.customConfig.menus = [
            'head',
            'bold',
            'italic',
            'fontSize',  // 字号
            'underline'
        ];
        editor.create();

        function insertImage() {
//            alert(editor.txt.html());

            if (appendFileInput) {
                previewHolder.append("<input type='file' name='pic" + index + "' hidden onchange='showPreview(this, index)'/>");
                appendFileInput = false;
            }

            $("input[name='pic" + index + "']").click();
        }

        function showPreview(element, i) {
            var isCorrect = true;

            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            var picture = $("input[name='pic" + i + "']");
            var imagePath = picture.val();

            if (!/.(jpg|jpeg|png|JPG|JPEG|PNG)$/.test(imagePath)) {
                isCorrect = false;
                picture.val("");
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
                picture.val("");
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
                            picture.val("");
                            swal({
                                title: "错误",
                                type: "error",
                                text: "当前选择图片分辨率为: " + width + "px * " + height + "px \n图片分辨率应小于 1000像素 * 1000像素",
                                cancelButtonText: "关闭",
                                showCancelButton: true,
                                showConfirmButton: false
                            });
                        } else if (isCorrect) {
                            previewHolder.append("<div class='preview'>" +
                                "<img src='" + objectUrl + "' width='150'>" +
                                "&nbsp;&nbsp;<label>[图片" + i + "]</label>" +
                                "<p><span class='insert' onclick='insertImageCode(" + i + ")'>插入</span>" +
                                "<span class='delete' onclick='deleteImage(this, " + i + ")'>删除</span></p></div>");

                            insertImageCode(i);

                            index++;
                            appendFileInput = true;
                        }
                    };
                    image.src = data;
                };
                reader.readAsDataURL(file);
            }
        }

        function deleteImage(element, i) {
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

                var content = $("#content");
                var pictureIndex = $("input[name='picture-index']");

//                content.val(content.val().replace("[图片" + i + "]", ""));
                editor.txt.html(editor.txt.html().replace("[图片" + i + "]", ""));
                pictureIndex.val(pictureIndex.val().replace("@" + i, ""));


                element.parentNode.parentNode.remove();
                $("input[name='pic" + i + "']").remove();
            });
        }

        function insertImageCode(i) {
            var content = $("#content");
            var pictureIndex = $("input[name='picture-index']");

//            content.val(content.val() + "[图片" + i + "]");
            editor.txt.html(editor.txt.html() + "[图片" + i + "]");
            pictureIndex.val(pictureIndex.val() + "@" + i);
        }

        /**
         * 添加新闻
         *
         * 传递参数：
         * title
         * content （带格式）
         * pictureIndex 表示传递的图片编号，形式为：1@2@5@7
         *                               表示：传递了4张图片，input name 分别为: pic-1, pic-2, pic-5, pic-7
         * pic-X 图片文件 input type=file name=pic-X
         */
        $("#submit-news").click(function (event) {
            event.preventDefault();

            var title = $("#title");
            var quote = $("#quote");
            var newtype = $("select[name=newtype]");
//            var content = $("#content");
            var pictureIndex = $("input[name='picture-index']").val();

            if (title.val() === '') {
                setError(title, 'title', "不能为空");
                return;
            } else {
                removeError(title, 'title');
            }
            if (newtype.val() == 0) {
                setError(newtype, 'newtype', '请选择新闻类别');
                return;
            } else {
                removeError(newtype, 'newtype');
            }

//            var testContent = content.val().replace(/\r\n/g, '');
//            testContent = testContent.replace(/\n/g, '');
//            testContent = testContent.replace(/\s/g, '');
//
//            if (testContent === '') {
//                setError(content, 'content', '不能为空');
//                return;
//            } else {
//                removeError(content, 'content');
//            }
//
//            // 将content中的换行 "\r\n" 或者 "\n" 换成 <br>
//            // '\s'空格替换成"&nbsp;"
//            // 这样可以保持新闻内容的编辑格式
//            var newsContent = content.val().replace(/\r\n/g, '<br>');
//            newsContent = newsContent.replace(/\n/g, '<br>');
//            newsContent = newsContent.replace(/\s/g, '&nbsp;');
            if(editor.txt.text().length === 0){
                setError(content, 'content', '不能为空');
                return;
            }
            var formData = new FormData();
            formData.append("ename", '');
            formData.append("title", title.val());
            formData.append("subtitle", '');
            formData.append("quote", quote.val());
            formData.append("newtype", newtype.val());
            formData.append("tag", '');
            formData.append("content", editor.txt.html());

            pictureIndex = pictureIndex.substring(1);
            formData.append("pictureIndex", pictureIndex);

            var pictureIndexArray = pictureIndex.split('@');
            if (pictureIndexArray[0] !== "") {
                for (var i in pictureIndexArray) {
                    var index = 'pic' + pictureIndexArray[i + ''];
                    formData.append(index, $("input[name='" + index + "']").prop("files")[0]);
                }
            }

            $.ajax({
                url: "/admin/news/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    checkResult(result.status, "添加成功", result.msg, null);

                    if (result.status === 200) {
                        setTimeout(function () {
                            self.location = '/admin/news';
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
