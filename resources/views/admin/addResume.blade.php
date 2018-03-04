@extends('layout.admin')
@section('title', 'Add Resume')

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
    @include('components.adminAside', ['title' => 'resume', 'subtitle'=>'addresume', 'username' => $data['username']])
@endsection

@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        新增简历
                    </h2>
                    <div class="mdl-card__menu">

                        <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                            <i class="material-icons">more_vert</i>
                        </button>

                        <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                            for="demo-menu-lower-right">
                            <li class="mdl-menu__item">
                                <a href="/admin/resumes">返回简历列表</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="body">
                    <form role="form" method="post" id="add-resume-form">

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="title" name="title" class="form-control" placeholder="简历标题">
                            </div>
                            <label id="title-error" class="error" for="title"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="pname" name="pname" class="form-control" placeholder="真实姓名">
                            </div>
                            <label id="title-error" class="error" for="pname"></label>
                        </div>

                        <div class="input-group">
                            <div class="form-line">
                                <input type="text" id="mail" name="mail" class="form-control"
                                       placeholder="临时简历用户登录账号（eg:tempresume2）">
                            </div>
                            <label id="quote-error" class="error" for="mail"></label>
                        </div>


                        <button id="submit-resume"
                                class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                            添加简历
                        </button>
                    </form>
                </div><!-- #END# .body-->
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">

        $("#submit-resume").click(function (event) {
            event.preventDefault();

            var title = $("#title");
            var pname = $("#pname");
            var mail = $("#mail");

            if (title.val() === '') {
                setError(title, 'title', "不能为空");
                return;
            } else {
                removeError(title, 'title');
            }
            if (pname === '') {
                setError(pname, 'pname', '不能为空');
                return;
            } else {
                removeError(pname, 'pname');
            }
            if (mail === '') {
                setError(mail, 'mail', '不能为空');
                return;
            } else {
                removeError(mail, 'mail');
            }
            var email = mail.val()+"@qq.com";

            var formData = new FormData();
            formData.append("title", title.val());
            formData.append("pname", pname.val());
            formData.append("mail", email);

            $.ajax({
                url: "/admin/addresume",
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
                            self.location = '/admin/resumes';
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
