@extends('layout.master')
@section('title', '账号设置')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link media="all" href="{{asset('../style/user_style.css')}}" type="text/css" rel="stylesheet">
    <style>
        .form-title{
            font-size: 17px;
            color: #000;
            font-weight: 700;
            max-width: 100%;
            margin-bottom: 5px;
        }
        .dropdown-toggle{
                background-color: #fff;
            color: #555;
                }
                .userinfo_edit input[type=text], .userinfo_edit textarea {
            height: auto
            }
            .input-group-addon {
             background-color: #fff; 
             border-color:#fff;
             cursor: pointer; 
        }
        #birthday{
         background-color: #fff;   
        }
        .form-line{
            width: 100%;
        }
    </style>
@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('content')
    <div class="wrapper_content clearfix">

        <div class="user_bindSidebar">
            <ul class="user_sideBarmenu">
                <li>
                    <a href="/account/edit" class="hover_ac" >
                        @if($data['type'] == 1)
                            个人信息
                        @elseif($data['type'] == 2)
                            企业信息
                        @endif
                    </a>
                </li>
                <!-- <li>
                    <a href="accoutBind.html" >帐号绑定</a>
                </li>
                <li>
                    <a href="#" >隐私设置</a>
                </li> -->
                <li>
                    <a href="/account/updatePwd" >修改密码</a>
                </li>
            </ul>
        </div>
        <div class="user_userinfo_content1">
            <div class="c_section">
                @if($data['type'] == 1)
                    <div class="userinfo_edit">
                        <div class="hadInfo">
                            <span class="edit_link" id="edit_link">编辑</span>
                            <div class="view_avatar">
                                @if($data['personinfo']->photo != null && $data['personinfo']->photo != "")
                                    <img class="avatar_img"  src="{{$data['personinfo']->photo}}" width="100" height="100"><br>
                                @else
                                    <img class="avatar_img"  src="{{asset('images/default-img.png')}}" width="100" height="100"><br>
                                @endif
                            </div>
                            <div class="view_nickname">
                                <span>{{$data['personinfo']->pname or $data['personinfo']['username']->username}}</span>
                                <i class="icon-gender @if($data['personinfo']->sex == 1) man @else woman @endif"></i>
                            </div>
                            <div class="view_position">
                                @if($data['personinfo']->sex == null)
                                    性别未填写
                                @elseif($data['personinfo']->sex == 1)
                                    男
                                @elseif($data['personinfo']->sex == 2)
                                    女
                                @endif|
                                    {{$data['personinfo']->birthday or "生日未填写"}}|

                                    @if($data['personinfo']->residence == null)
                                        居住地未填写
                                    @else
                                        {{$data['personinfo']->residence}}
                                    @endif
                            </div>
                            <div class="view_introduce">{{$data['personinfo']->self_evalu or "自我评价未填写"}}</div>
                        </div>
                        <form id="userinfoEditForm" onkeydown="if(event.keyCode==13){return false;}">
                            <div class="avatar">
                                @if($data['personinfo']->photo != null && $data['personinfo']->photo != "")
                                    <img class="avatar_img" id="head-img" src="{{$data['personinfo']->photo}}" width="100" height="100">
                                @else
                                    <img class="avatar_img" id="head-img" src="{{asset('images/default-img.png')}}" width="100" height="100">
                                @endif
                                    <input type="file" hidden name="head-img" id="input-head--img"
                                           onchange="showPreview(this)">
                            </div>
                            <div class="form-title">用户名</div>
                            <div class="username input_box">
                                <input type="text" id="username" name="userName" placeholder="用户名"
                                       value="{{$data['personinfo']['username']->username}}" maxlength="15" data-maxlength="15">
                                <div class="help-info">选填，将显示在登陆界面</div>
                            </div>
                            <div class="form-title">姓名</div>
                            <div class="username input_box">
                                <input type="text" id="pname" name="pname" placeholder="真实姓名"
                                       value="{{$data['personinfo']->pname}}" maxlength="15" data-maxlength="15">
                                <div class="help-info">必填，将显示在简历中，建议填写真实姓名</div>
                            </div>
                            <div class="form-title">居住地</div>
                            <div class="username input_box">
                                <input type="text" id="residence" name="residence" placeholder="现居住城市"
                                       value="{{$data['personinfo']->residence}}" maxlength="15" data-maxlength="15">
                                <div class="help-info">必填，将显示在简历中，建议填写：城市-区县</div>
                            </div>
                            <div class="form-title">户口所在地</div>
                            <div class="username input_box">
                                <input type="text" id="register_place" name="register_place" placeholder="户口所在地"
                                       value="{{$data['personinfo']->register_place}}" maxlength="15" data-maxlength="15">
                                <div class="help-info">必填，将显示在简历中，建议填写：省份-城市-区县</div>
                            </div>
                            <div class="form-title">联系电话</div>
                            <div class="username input_box">
                                <input type="text" id="tel" name="tel" placeholder="手机号: 999-9999-9999"
                                       value="{{$data['personinfo']->tel}}">
                                <div class="help-info">必填，将显示在简历中</div>
                            </div>
                            <div class="form-title">联系邮箱</div>
                            <div class="username input_box">
                                <input type="text" id="mail" name="mail" placeholder="邮箱地址: example@example.com"
                                       value="{{$data['personinfo']->mail}}">
                                <div class="help-info">必填，将显示在简历中</div>
                            </div>
                            <div style="height: 100px;"></div>
                            <div class="form-title">性别</div>
                            <div class="userinfo_sex input_box">
                                <input type="radio" class="magic-radio" id="male" name="sex" value="1" @if($data['personinfo']->sex == 1) checked @endif />
                                <label for="male">男</label>
                                <input type="radio" class="magic-radio" id="female" name="sex" value="2" @if($data['personinfo']->sex == 2) checked @endif />
                                <label for="female">女</label>
                                <input type="radio" class="magic-radio" id="sex-question" name="sex" value="0" @if($data['personinfo']->sex != 1 && $data['personinfo']->sex != 2) checked @endif />
                                <label for="sex-question">未填写</label>
                                <div class="help-info">将显示在简历中</div>
                            </div>
                            <div class="form-title">婚姻</div>
                            <div class="userinfo_sex input_box">
                                <input type="radio" class="magic-radio" id="unmarried" name="is_marry"
                                       value="1" checked="checked" @if($data['personinfo']->is_marry == 1) checked @endif/>
                                <label for="unmarried">已婚</label>
                                <input type="radio" class="magic-radio" id="married" name="is_marry"
                                       value="2" @if($data['personinfo']->is_marry == 2) checked @endif/>
                                <label for="married">未婚</label>
                                <input type="radio" class="magic-radio" id="question-marry" name="is_marry"
                                       value="0" @if($data['personinfo']->is_marry != 1 && $data['personinfo']->is_marry != 2) checked @endif/>
                                <label for="question-marry">未填写</label>
                                <div class="help-info">将显示在简历中</div>
                            </div>
                            <div class="form-title">出生日期</div>
                            <div class="username input_box">
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
                            </div>
                            <div class="form-title">工作年份（4位数字）</div>
                            <div class="username input_box">
                                <input type="text" id="work_year" name="work_year"
                                       @if($data['personinfo']->work_year != null) value="{{$data['personinfo']->work_year}}"
                                       @endif
                                       placeholder="开始工作的年份，例如：2008">
                                <!-- <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span> -->
                                <div class="help-info">将用于职位推荐</div>
                            </div>
                            <div class="form-title">政治面貌</div>
                            <div class="username input_box">
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
                            </div>
                            <div class="form-title">最高学历</div>
                            <div class="username input_box">
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
                            </div>
                            <div class="form-title">自我评价</div>
                            <div class="username input_box">
                                <div class="form-line">
                                <textarea rows="3" class="form-control" name="self_evalu" id="self-evaluation"
                                          placeholder="可选">{{$data['personinfo']->self_evalu}}</textarea>
                                </div>
                                <div class="help-info">将显示在简历中</div>
                            </div>


                            <div class="toolbar">
                                <a class="btn userinfo_save" href="javascript:;" >保存</a>
                            </div>
                        </form>
                        <p class="tips">* 请认真填写，该信息将同步到简历中</p>
                    </div>
                @endif
                @if($data['type'] == 2)
                     <div class="userinfo_edit">
                         <div class="hadInfo">
                                <span class="edit_link" id="edit_link">编辑</span>
                                <div class="view_avatar">
                                    <img class="avatar_img" src="../images/pic0.jpg" width="100" height="100">
                                </div>
                                <div class="view_nickname">
                                    <span>某某</span>
                                    <i class="icon-gender man"></i>
                                </div>
                                <div class="view_position">学生·成都理工大学</div>
                                <div class="view_introduce">我还没填写个人介绍</div>
                            </div>
                         <form id="userinfoEditForm">
                                <div class="avatar">
                                    <img class="avatar_img" src="../images/pic0.jpg" width="100" height="100" >
                                    <input type="hidden" name="" value="">
                                </div>
                                <input type="file" class="avatar_upload" id="avatarUpload" name="headPic" defaultvalue="" title="支持jpg、jpeg、gif、png格式，文件小于10M">
                                <div class="form-title">用户名</div>
                                <div class="username input_box">
                                    <input type="text" id="userinfoEditUserName" name="userName" placeholder="请输入用户名" value="" maxlength="15" data-maxlength="15">
                                </div>
                                <div class="form-title">名字</div>
                                <div class="username input_box">
                                    <input type="text" id="userinfoEditUserName" name="userName" placeholder="请输入名字" value="" maxlength="15" data-maxlength="15">
                                </div>
                                <div class="form-title">居住地</div>
                                <div class="username input_box">
                                    <input type="text" id="userinfoEditUserName" name="userName" placeholder="请输入居住地" value="" maxlength="15" data-maxlength="15">
                                </div>
                                <div class="form-title">户口所在地</div>
                                <div class="username input_box">
                                    <input type="text" id="userinfoEditUserName" name="userName" placeholder="请输入户口所在地" value="" maxlength="15" data-maxlength="15">
                                </div>
                                <div class="form-title">联系电话</div>
                                <div class="username input_box">
                                    <input type="text" id="userinfoEditUserName" name="userName" placeholder="请输入联系电话" value="" maxlength="15" data-maxlength="15">
                                </div>
                                <div class="form-title">联系邮箱</div>
                                <div class="username input_box">
                                    <input type="text" id="userinfoEditUserName" name="userName" placeholder="请输入联系邮箱" value="" maxlength="15" data-maxlength="15">
                                </div>
                                <div class="form-title">性别</div>
                                <div class="userinfo_sex input_box">
                                    <input type="radio" class="magic-radio" id="userinfoEditSexMale" name="sex" value="MALE" checked="checked">
                                    <label for="userinfoEditSexMale">男</label>
                                    <input type="radio" class="magic-radio" id="userinfoEditSexFemale" name="sex" value="FEMALE">
                                    <label for="userinfoEditSexFemale">女</label>
                                </div>
                                <div class="form-title">婚姻</div>
                                <div class="userinfo_sex input_box">
                                    <input type="radio" class="magic-radio" id="userinfoEditMarriageY" name="marriage" value="YES" checked="checked">
                                    <label for="userinfoEditMarriageY">已婚</label>
                                    <input type="radio" class="magic-radio" id="userinfoEditMarriageN" name="marriage" value="NO">
                                    <label for="userinfoEditMarriageN">未婚</label>
                                    <input type="radio" class="magic-radio" id="userinfoEditMarriage" name="marriage" value="NONEED">
                                    <label for="userinfoEditMarriage">未填写</label>
                                </div>

                                <div class="toolbar">
                                    <a class="btn userinfo_save" href="javascript:;" >保存</a>
                                </div>
                            </form>
                         <p class="tips">* 此信息用于站内言职社区功能，不会同步修改简历</p>
                     </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
<script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datapicker/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('plugins/bootstrap-datapicker/locales/bootstrap-datetimepicker.zh-CN.js')}}"></script>
    <script type="text/javascript">
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
        $(document).ready(function(){
            $("#edit_link").click(function(){
                $(".hadInfo").hide();
            });
            $("#edit_link").click(function(){
                $("#userinfoEditForm").show();
            });
        });
        $("#head-img").click(function (event) {
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
