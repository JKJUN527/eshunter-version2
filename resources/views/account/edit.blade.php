@extends('layout.master')
@section('title', '修改资料')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate-css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset("plugins/sweetalert/sweetalert.css")}}"/>
    <style>
        .edit-card {
            width: 100%;
            margin: 50px 0;
            padding-bottom: 20px;
        }

        .edit-panel {
            padding: 20px 32px;

        }

        .head-img--holder {
            display: inline-block;
            border: 2px dashed #ebebeb;
            margin-right: 32px;
            position: relative;
        }

        .head-img--holder i.material-icons {
            position: absolute;
            top: -9px;
            right: -9px;
            background: #F44336;
            color: #ffffff;
            border: 1px solid #f5f5f5;
            border-radius: 18px;
            cursor: pointer;
            font-size: 18px;

        }

        .head-img--holder i.material-icons:hover {
            background: #D32F2F;
            color: #ffffff;
        }

        .base-info-holder {
            width: 500px;
            display: inline-block;
            vertical-align: top;
        }

        .head-img--holder .head-img {
            width: 100px;
            height: 100px;
            display: inline-block;
        }

        .head-img--holder span {
            display: inline-block;
            cursor: pointer;
            width: 100px;
            padding: 3px 10px;
            font-size: 14px;
            text-align: center;
        }

        .head-img--holder span:hover {
            background: #ebebeb;
        }

        label[for="male"],
        label[for="female"],
        label[for="married"],
        label[for="unmarried"] {
            margin-right: 48px;
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

        .waiting-verified > h3 {
            font-size: 30px;
        }

        .waiting-verified > h3 > i {
            color: #aaaaaa;
            position: relative;
            top: 5px;
            font-size: 30px;
            margin-right: 16px;
        }

        .waiting-verified > p {
            margin-left: 48px;
        }

        .verify-panel {
            padding: 8px 32px;
        }
    </style>
@endsection

@section('header-nav')
    @if($data['uid'] === 0)
        @include('components.headerNav', ['isLogged' => false])
    @else
        @include('components.headerNav', ['isLogged' => true, 'username' => $data['username'] ])
    @endif
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('content')
    <div class="info-panel">

        <div class="container">
            @if($data['type'] == 1)
                <div class="edit-card mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                to="/account/">
                            <i class="material-icons">arrow_back</i>
                        </button>
                        <h5 class="mdl-card__title-text" style="margin-left: 16px;">个人资料修改</h5>
                    </div>

                    <div class="mdl-card__actions mdl-card--border edit-panel">
                        <form class="edit-form" method="post" id="edit-form"
                              onkeydown="if(event.keyCode==13){return false;}">
                            <div class="head-img--holder">
                                <i class="material-icons hidden" onclick="restoreHeadImage()">close</i>
                                @if($data['personinfo']->photo != null && $data['personinfo']->photo != "")
                                    <img class="head-img" id="head-img" src="{{$data['personinfo']->photo}}"><br>
                                @else
                                    <img class="head-img" id="head-img" src="{{asset('images/default-img.png')}}"><br>
                                @endif
                                <input type="file" hidden name="head-img" id="input-head--img"
                                       onchange="showPreview(this)">
                                <span id="upload-head--img">上传头像</span>
                            </div>

                            <div class="base-info-holder">
                                <label for="username">用户名</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="username" name="username" class="form-control"
                                               value="{{$data['personinfo']['username']->username}}"
                                               placeholder="用户名">
                                    </div>
                                    <div class="help-info">选填，将显示在登陆界面</div>
                                    <label class="error" for="username"></label>
                                </div>

                                <label for="pname">名字</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="pname" name="pname" class="form-control"
                                               value="{{$data['personinfo']->pname}}"
                                               placeholder="真实姓名">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中，建议填写真实姓名</div>
                                    <label class="error" for="pname"></label>
                                </div>

                                <label for="residence">居住地</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="residence" name="residence" class="form-control"
                                               value="{{$data['personinfo']->residence}}"
                                               placeholder="现居住城市">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中，建议填写：城市-区县</div>
                                    <label class="error" for="residence"></label>
                                </div>

                                <label for="register_place">户口所在地</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="register_place" name="register_place"
                                               value="{{$data['personinfo']->register_place}}"
                                               class="form-control"
                                               placeholder="户口所在地">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中，建议填写：省份-城市-区县</div>
                                    <label class="error" for="register_place"></label>
                                </div>

                                <label for="tel">联系电话</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="tel" name="tel" class="form-control phone"
                                               value="{{$data['personinfo']->tel}}"
                                               placeholder="手机号: 999-9999-9999">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中</div>
                                    <label class="error" for="tel"></label>
                                </div>

                                <label for="mail">联系邮箱</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="mail" name="mail" class="form-control email"
                                               value="{{$data['personinfo']->mail}}"
                                               placeholder="邮箱地址: example@example.com">
                                    </div>
                                    <div class="help-info">必填，将显示在简历中</div>
                                    <label class="error" for="mail"></label>
                                </div>

                                <div style="height: 100px;"></div>

                                <label for="male">性别</label>
                                <div class="form-group" style="margin-top: 8px;">
                                    <div class="form-line">
                                        <input name="sex" type="radio" id="male" class="radio-col-light-blue"
                                               value="1" @if($data['personinfo']->sex == 1) checked @endif/>
                                        <label for="male">男</label>
                                        <input name="sex" type="radio" id="female" class="radio-col-light-blue"
                                               value="2" @if($data['personinfo']->sex == 2) checked @endif/>
                                        <label for="female">女</label>
                                        <input name="sex" type="radio" id="sex-question" class="radio-col-light-blue"
                                               value="0"
                                               @if($data['personinfo']->sex != 1 && $data['personinfo']->sex != 2) checked @endif/>
                                        <label for="sex-question">未填写</label>
                                    </div>
                                    <div class="help-info">将显示在简历中</div>
                                </div>

                                <label for="marriage">婚姻</label>
                                <div class="form-group" style="margin-top: 8px;">
                                    <div class="form-line">
                                        <input name="is_marry" type="radio" id="unmarried" class="radio-col-light-blue"
                                               value="1" @if($data['personinfo']->is_marry == 1) checked @endif/>
                                        <label for="unmarried">未婚</label>
                                        <input name="is_marry" type="radio" id="married" class="radio-col-light-blue"
                                               value="2" @if($data['personinfo']->is_marry == 2) checked @endif/>
                                        <label for="married">已婚</label>
                                        <input name="is_marry" type="radio" id="question-marry"
                                               class="radio-col-light-blue"
                                               value="0"
                                               @if($data['personinfo']->is_marry != 1 && $data['personinfo']->is_marry != 2) checked @endif/>
                                        <label for="question-marry">未填写</label>
                                    </div>
                                    <div class="help-info">将显示在简历中</div>
                                </div>

                                <label for="birthday">出生日期</label>
                                <div class="form-group">
                                    <div class="form-line input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                        <input size="16" type="text"  readonly id="birthday" name="birthday" class="form-control"
                                               @if($data['personinfo']->birthday != null)
                                                value="{{$data['personinfo']->birthday}}"
                                               @endif
                                               placeholder="不能为空">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    
                                    <div class="help-info">将用于职位推荐</div>
                                    <label class="error" for="birthday"></label>
                                </div>

                                <label for="work_year">工作年份（4位数字）</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="work_year" name="work_year" class="form-control year"
                                               @if($data['personinfo']->work_year != null) value="{{$data['personinfo']->work_year}}"
                                               @endif
                                               placeholder="开始工作的年份，例如：2008">
                                    </div>
                                    <div class="help-info">将用于职位推荐</div>
                                    <label class="error" for="work_year"></label>
                                </div>

                                <label for="political">政治面貌</label>
                                <div class="form-group">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="political"
                                            name="political">
                                        <option value="-1"
                                                @if($data['personinfo']->political < 0 || $data['personinfo']->political >5 ) selected @endif>
                                            请选择政治面貌
                                        </option>
                                        <option value="0" @if($data['personinfo']->political == 0) selected @endif>少先队
                                        </option>
                                        <option value="1" @if($data['personinfo']->political == 1) selected @endif>
                                            共青团团员
                                        </option>
                                        <option value="2" @if($data['personinfo']->political == 2) selected @endif>
                                            共产党党员
                                        </option>
                                        <option value="3" @if($data['personinfo']->political == 3) selected @endif>
                                            其他党派
                                        </option>
                                        <option value="4" @if($data['personinfo']->political == 4) selected @endif>
                                            无党派人士
                                        </option>
                                        <option value="5" @if($data['personinfo']->political == 5) selected @endif>
                                            人民群众
                                        </option>
                                    </select>
                                    <div class="help-info"></div>
                                    <label class="error" for="enterprise-type"></label>
                                </div>

                                <label for="education">最高学历</label>
                                <div class="form-group">
                                    {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                    <select class="form-control show-tick selectpicker" id="education"
                                            name="education">
                                        <option value="9" @if($data['personinfo']->education == 9) selected @endif>
                                            请选择最高学历
                                        </option>
                                        <option value="0" @if($data['personinfo']->education == 0) selected @endif>高中
                                        </option>
                                        <option value="3" @if($data['personinfo']->education == 3) selected @endif>专科
					</option>
					<option value="1" @if($data['personinfo']->education == 1) selected @endif>本科
                                        </option>
                                        <option value="2" @if($data['personinfo']->education == 2) selected @endif>
                                            研究生及以上
                                        </option>
                                    </select>
                                    <div class="help-info">将用于职位推荐</div>
                                    <label class="error" for="education"></label>
                                </div>

                                <label for="self-evaluation">自我评价</label>
                                <div class="form-group">
                                    <div class="form-line">
                                <textarea rows="3" class="form-control" name="self_evalu" id="self-evaluation"
                                          placeholder="可选">{{$data['personinfo']->self_evalu}}</textarea>
                                    </div>
                                    <div class="help-info">将显示在简历中</div>
                                    <label class="error" for="self-evaluation"></label>
                                </div>

                                <button id="personal-info--change_button"
                                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                    确认修改
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif


            @if($data['type']==2)
                @if($data['enprinfo']->is_verification != 1)
                    <div class="edit-card mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__actions mdl-card--border verify-panel waiting-verified">
                            <h3><i class="material-icons">verified_user</i>企业号尚未通过审核</h3>
                            <p>企业号审核通过后即可修改资料
                                <br>
                                <br>
                                @if($data['enprinfo']->is_verification == 0)
                                    <button style="margin-top: 12px;" to="#"
                                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
                                        待审核
                                    </button>
                                @endif
                                @if($data['enprinfo']->is_verification == -1)
                                    <button style="margin-top: 12px;" to="/account/enterpriseVerify"
                                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
                                        点击立即审核
                                    </button>
                                @endif
                                @if($data['enprinfo']->is_verification == 2)
                                    <button style="margin-top: 12px;" to="/account/enterpriseVerify"
                                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-cucumber">
                                        审核失败-重新提交
                                    </button>
                                @endif
                                <button to="/account/" style="margin-top: 12px; margin-left: 16px;"
                                        class="mdl-button mdl-js-button mdl-js-ripple-effect button-link">
                                    返回企业中心
                                </button>
                            </p>

                        </div>
                    </div>
                @else
                    <div class="edit-card mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title">
                            <button class="mdl-button mdl-button--icon mdl-js-button" id="back-to--message-list"
                                    to="/account/">
                                <i class="material-icons">arrow_back</i>
                            </button>
                            <h5 class="mdl-card__title-text" style="margin-left: 16px;">公司资料修改</h5>
                        </div>

                        <div class="mdl-card__actions mdl-card--border edit-panel">
                            <form class="edit-form" method="post" id="edit-form"
                                  onkeydown="if(event.keyCode==13){return false;}">
                                <div class="head-img--holder">
                                    <i class="material-icons hidden" onclick="restoreHeadImage()">close</i>
                                    @if($data['enprinfo']->elogo != null && $data['enprinfo']->elogo != "")
                                        <img class="head-img" id="head-img" src="{{$data['enprinfo']->elogo}}"><br>
                                    @else
                                        <img class="head-img" id="head-img" src="{{asset('images/default-img.png')}}">
                                        <br>
                                    @endif
                                    <input type="file" hidden name="head-img" id="input-head--img"
                                           onchange="showPreview(this)">
                                    <span id="upload-head--img">上传Logo</span>
                                </div>

                                <div class="base-info-holder">

                                    <label for="name">公司名称</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" name="ename" class="form-control"
                                                   value="{{$data['enprinfo']->ename}}"
                                                   disabled="disabled">
                                        </div>
                                        <div class="help-info" style="color: #F44336">公司名称只有在企业审核时修改</div>
                                        <label class="error" for="ename"></label>
                                    </div>
                                    <label for="byname">职位发布显示名称</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="by_name" name="byname" class="form-control"
                                                   value="{{$data['enprinfo']->byname}}"
                                                   placeholder="可选，Ex: XXX俱乐部">
                                        </div>
                                        <div class="help-info" style="color: #F44336">公司别名便于个人用户了解公司业务</div>
                                        <label class="error" for="byname"></label>
                                    </div>

                                    <label for="phone">公司联系电话</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="enterprise-phone" name="etel" class="form-control"
                                                   value="{{$data['enprinfo']->etel}}"
                                                   placeholder="必填，Ex: (999)999999">
                                        </div>
                                        <div class="help-info" style="color: #F44336">必填项</div>
                                        <label class="error" for="etel"></label>
                                    </div>

                                    <label for="email">公司联系邮箱</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="enterprise-email" name="email"
                                                   class="form-control"
                                                   value="{{$data['enprinfo']->email}}"
                                                   placeholder="必填，Ex: example@example.com">
                                        </div>
                                        <div class="help-info" style="color: #F44336">必填项</div>
                                        <label class="error" for="email"></label>
                                    </div>

                                    <label for="enterprise-address">企业地址</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                <textarea rows="3" class="form-control" name="address" id="enterprise-address"
                                          placeholder="必填，Ex: xx省 xx市 xx区/县  xxx街道xxx号">{{$data['enprinfo']->address}}</textarea>
                                        </div>
                                        <div class="help-info" style="color: #F44336">必填项</div>
                                        <label class="error" for="address"></label>
                                    </div>

                                    <label for="enterprise-url">公司官网</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="url" id="enterprise-url" name="home_page"
                                                   class="url form-control"
                                                   value="{{$data['enprinfo']->home_page}}"
                                                   placeholder="可选，Ex：www.example.com">
                                        </div>
                                        <div class="help-info">将显示在已发布的职位详情中，请以 http://, https://开头</div>
                                        <label class="error" for="home_page"></label>
                                    </div>

                                    <label for="enterprise-scale">企业规模</label>
                                    <div class="form-group">
                                        {{--如果想要添加动态查找，向select中添加属性：data-live-search="true"--}}
                                        <select class="form-control show-tick selectpicker" id="enterprise-scale"
                                                name="scale">
                                            <option value="0" @if($data['enprinfo']->escale == null) selected @endif>
                                                请选择企业规模
                                            </option>
                                            <option value="1" @if($data['enprinfo']->escale == 1) selected @endif>
                                                少于50人
                                            </option>
                                            <option value="2" @if($data['enprinfo']->escale == 2) selected @endif>
                                                50人至200人
                                            </option>
                                            <option value="3" @if($data['enprinfo']->escale == 3) selected @endif>
                                                200至500人
                                            </option>
                                            <option value="4" @if($data['enprinfo']->escale == 4) selected @endif>
                                                500人至1000人
                                            </option>
                                            <option value="5" @if($data['enprinfo']->escale == 5) selected @endif>
                                                1000人以上
                                            </option>
                                        </select>
                                        <div class="help-info">将显示在已发布的职位详情中</div>
                                        <label class="error" for="scale"></label>
                                    </div>

                                    <label for="self-evaluation">公司简介</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                <textarea rows="3" class="form-control" name="description" id="description"
                                          placeholder="可选">{{$data['enprinfo']->ebrief}}</textarea>
                                        </div>
                                        <div class="help-info">将显示在已发布的职位详情中</div>
                                        <label class="error" for="description"></label>
                                    </div>

                                    <button id="enterprise-info--change_button"
                                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky">
                                        确认修改
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap-datapicker/locales/bootstrap-datetimepicker.zh-CN.js')}}"></script>

    <script type="text/javascript">

        var isCorrect;
        var isChangeHeadImg = false;
        var originalHeadImg;
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

        $editForm = $(".edit-form");
        $editForm.find(".email").inputmask({alias: "email"});
        $editForm.find(".phone").inputmask('999-9999-9999', {placeholder: '___-____-____'});
        $editForm.find(".year").inputmask('9999', {placeholder: '____'});

        $("#upload-head--img").click(function (event) {
            event.preventDefault();
            swal({
                title: "要求",
                text: "上传图片要求：格式为：.jpg，.jpeg，.png\n分辨率最大支持 1000像素 * 1000像素\n图片文件大小最大支持5MB",
                confirmButtonText: "知道了",
                closeOnConfirm: true
            }, function () {
                $("input[name='head-img']").click();
            });
        });

        function restoreHeadImage() {
            if (originalHeadImg !== null) {
                $("#head-img").attr("src", originalHeadImg);
                $("input[name='head-img']").val("");
                $(".head-img--holder").find("i.material-icons").addClass("hidden");
            }
        }

        $("#enterprise-info--change_button").click(function (event) {
            event.preventDefault();
            var file = $("#input-head--img");

            var ename = $("input[name='ename']");
            var byname = $("input[name='byname']");
            var etel = $("input[name='etel']");
            var email = $("input[name='email']");
            var address = $("textarea[name='address']");

            var homePage = $("input[name='home_page']").val();
            var scale = $("select[name='scale']").val();
            var description = $("textarea[name='description']").val();

            if (ename.val === "") {
                setError(ename, "ename", "不能为空");
                return;
            } else {
                removeError(ename, "ename");
            }
//            if (byname.val === "") {
//                setError(byname, "byname", "不能为空");
//                return;
//            } else {
//                removeError(byname, "byname");
//            }

            if (etel.val() === "") {
                setError(etel, "etel", "不能为空");
                return;
            } else {
                removeError(etel, "etel");
            }

            if (email.val() === "") {
                setError(email, "email", "不能为空");
                return;
            } else {
                var re=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
                if (re.test(email.val()) != true) {
                    setError(email, "email", "邮箱格式不正确");
                    return;
                }else {
                    removeError(email, "email");
                }
            }

            if (address.val() === "") {
                setError(address, "address", "不能为空");
                return;
            } else {
                removeError(address, "address");
            }

            var formData = new FormData();

            formData.append("byname", byname.val());
            formData.append("email", email.val());
            formData.append("etel", etel.val());
            formData.append("address", address.val());

            formData.append("ebrief", description);
            formData.append("home_page", homePage);
            formData.append("escale", scale);

            if (file.prop("files")[0] === undefined) {
                console.log("file is empty");
                //formData.append('photo', "");
            } else {
                formData.append('elogo', file.prop("files")[0]);
            }

            $.ajax({
                url: "/account/enprinfo/edit",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    checkResult(result.status, "资料已修改", result.msg, null);
                    self.location='/account';
		// window.location.href="/account";
                }
            })
        });

        $("#personal-info--change_button").click(function (event) {
            event.preventDefault();

            var file = $("#input-head--img");

            var pname = $("input[name='pname']");
            var username = $("input[name='username']");
            var residence = $("input[name='residence']");
            var registerPlace = $("input[name='register_place']");
            var tel = $("input[name='tel']");
            var mail = $("input[name='mail']");

            // optional
            var gender = $("input[name='sex']:checked").val();
            var marriage = $("input[name='is_marry']:checked").val();
            var birthday = $("input[name='birthday']").val();
            var workYear = $("input[name='work_year']").val();
            var political = $("select[name='political']").val();
            var degree = $("select[name='education']").val();
            var selfEvaluation = $("textarea[name='self_evalu']").val();

            if (pname.val() === "") {
                setError(pname, "pname", "不能为空");
                return;
            } else {
                removeError(pname, "pname");
            }

            if (residence.val() === "") {
                setError(residence, "residence", "不能为空");
                return;
            } else {
                removeError(residence, "residence");
            }

            if (registerPlace.val() === "") {
                setError(registerPlace, "register_place", "不能为空");
                return;
            } else {
                removeError(registerPlace, "register_place");
            }

            if (tel.val() === "") {
                setError(tel, "tel", "不能为空");
                return;
            } else {
                removeError(tel, "tel");
            }

            if (mail.val() === "") {
                setError(mail, "mail", "不能为空");
                return;
            } else {
                removeError(mail, "mail");
            }

            var formData = new FormData();
            formData.append("username", username.val());
            formData.append("pname", pname.val());
            formData.append("residence", residence.val());
            formData.append("register_place", registerPlace.val());
            formData.append("tel", tel.val());
            formData.append("mail", mail.val());
            formData.append("sex", gender);
            formData.append("is_marry", marriage);
            formData.append("birthday", birthday);
            formData.append("work_year", workYear);
            formData.append("political", political);
            formData.append("education", degree);
            formData.append("self_evalu", selfEvaluation);


            if (file.prop("files")[0] === undefined) {
                console.log("file is empty");
                //formData.append('photo', "");
            } else {

                formData.append('photo', file.prop("files")[0]);
            }

            $.ajax({
                url: "/account/personinfo/edit",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    console.log(data);
                    var result = JSON.parse(data);
                    checkResult(result.status, "资料已修改", result.msg, null);
//                    window.history.back(-1);
                    self.location='/account';
		   //window.location.href="http://www.eshunter.com/account";
		 }
            })
        });

        function showPreview(element) {
            isCorrect = true;

            var file = element.files[0];
            var anyWindow = window.URL || window.webkitURL;
            var objectUrl = anyWindow.createObjectURL(file);
            window.URL.revokeObjectURL(file);

            console.log(objectUrl);


            var headImagePath = $("input[name='head-img']").val();

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
                            } else if (isCorrect) {
                                originalHeadImg = $("#head-img").attr("src");
                                $("#head-img").attr("src", objectUrl);
                                $(".head-img--holder").find("i.material-icons").removeClass("hidden");
                                isChangeHeadImg = true;
                            }
                        };
                        image.src = data;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endsection
