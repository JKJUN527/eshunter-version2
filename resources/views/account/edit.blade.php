@extends('layout.master')
@section('title', '账号设置')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-select/css/bootstrap-select.min.css')}}">
    <link media="all" href="{{asset('../style/user_style.css')}}" type="text/css" rel="stylesheet">
    <style>
        ol,ul{
            margin-bottom: 0px;
        }
        .nav_ul li a {
            text-decoration: none;
        }
        .logo-con {
            float: left;
            margin-top: 5px;
        }
        .userinfo_edit .userinfo_sex {
            height: 46px;
            line-height: 46px;
        }
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
        
        .form-line{
            width: 100%;
        }
        span.verify-flag {
            /*width: 150px;*/
            display: inline-block;
            margin: 2px 8px 2px 16px;
            vertical-align: top;
            cursor: pointer;
            position: relative;
        }

        span.verified {
            color: #4CAF50;
            /*text-align: right;*/
        }

        span.unverified {
            color: #aaaaaa;
        }

        span.verify-flag > i {
           float: right;
        }

        span.verify-flag > span {
            position: absolute;
            top: 6px;
            left: 24px;
            font-size: 14px;
            font-weight: 400;
        }
        .input-group-addon{
            padding: 3px;
        }
        #birthday{
            background-color: #fff;   
            /*padding: 3px;*/
            line-height: 26px;
            text-indent: 10px;      
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
                        <div class="hadInfo" @if(isset($data['open_edit'])) style="display: none" @endif>
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
                        <form id="userinfoEditForm" onkeydown="if(event.keyCode==13){return false;}" @if(isset($data['open_edit'])) style="display: block" @endif>
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
                                <input type="text" id="username" name="username" placeholder="用户名"
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
                            <!-- <div style="height: 100px;"></div> -->
                            <div class="form-title">性别</div>
                            <div class="userinfo_sex input_box">
                                <input type="radio" class="magic-radio" id="male" name="sex" value="1" @if($data['personinfo']->sex == 1) checked @endif />
                                <label for="male">男</label>
                                <input type="radio" class="magic-radio" id="female" name="sex" value="2" @if($data['personinfo']->sex == 2) checked @endif />
                                <label for="female">女</label>
                                <input type="radio" class="magic-radio" id="sex-question" name="sex" value="0" @if($data['personinfo']->sex != 1 && $data['personinfo']->sex != 2) checked @endif />
                                <label for="sex-question">未填写</label>
                                <div class="help-info" style="margin-top: 34px;">将显示在简历中</div>
                            </div>
                            <div class="form-title" style="padding-top: 10px;">婚姻</div>
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
                                <div class="help-info" style="margin-top: -11px;">将显示在简历中</div>
                            </div>
                            <div class="form-title" style="padding-top: 21px;">出生日期</div>
                            <div class="username input_box" style="height: 54px;">
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
                                <a class="btn userinfo_save" id="personal-info--change_button" >确认修改</a>
                            </div>
                        </form>
                        <p class="tips">* 请认真填写，该信息将同步到简历中</p>
                    </div>
                @endif
                @if($data['type'] == 2)
                        <div class="userinfo_edit">
                            @if($data['enprinfo']->is_verification != 1)
                                <div class="hadInfo">
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
                            @else
                            <div class="hadInfo">
                                <span class="edit_link" id="edit_link">编辑</span>
                                <div class="view_avatar">
                                    @if($data['enprinfo']->elogo != null && $data['enprinfo']->elogo != "")
                                        <img class="avatar_img"  src="{{$data['enprinfo']->elogo}}" width="100" height="100"><br>
                                    @else
                                        <img class="avatar_img"  src="{{asset('images/default-img.png')}}" width="100" height="100"><br>
                                    @endif
                                </div>
                                <div class="view_nickname">
                                    <span>{{$data['enprinfo']->ename}}</span>
                                </div>
                                <div class="view_nickname">
                                    <span class="verify-flag
                                        @if($data['enprinfo']->is_verification == 1) verified @endif
                                    @if($data['enprinfo']->is_verification == 0) unverified @endif">
                                        <i class="material-icons">verified_user</i>
                                        <font>@if($data['enprinfo']->is_verification === 1) &nbsp;已认证 @elseif($data['enprinfo']->is_verification === 0) 待审核 @else 点击进行认证 @endif</font>
                                    </span>
                                </div>
                                <div class="view_position">
                                    @if($data['enprinfo']->industry == null)
                                        行业未知
                                    @else
                                        @foreach($data['industry'] as $item)
                                            @if($data['enprinfo']->industry == $item->id)
                                                {{$item->name}}
                                            @endif
                                        @endforeach
                                    @endif|
                                        @if($data['enprinfo']->enature == null || $data['enprinfo']->enature == 0)
                                            企业类型未知
                                        @elseif($data['enprinfo']->enature == 1)
                                            国有企业
                                        @elseif($data['enprinfo']->enature == 2)
                                            民营企业
                                        @elseif($data['enprinfo']->enature == 3)
                                            中外合资企业
                                        @elseif($data['enprinfo']->enature == 4)
                                            外资企业
                                        @elseif($data['enprinfo']->enature == 5)
                                            社会团体
                                        @endif|

                                        @if($data['enprinfo']->escale == null)
                                            规模未知
                                        @elseif($data['enprinfo']->escale == 0)
                                            10人以下
                                        @elseif($data['enprinfo']->escale == 1)
                                            10～50人
                                        @elseif($data['enprinfo']->escale == 2)
                                            50～100人
                                        @elseif($data['enprinfo']->escale == 3)
                                            100～500人
                                        @elseif($data['enprinfo']->escale == 4)
                                            500～1000人
                                        @elseif($data['enprinfo']->escale == 5)
                                            1000人以上
                                        @endif
                                </div>
                            </div>
                            @endif
                            <form id="userinfoEditForm" onkeydown="if(event.keyCode==13){return false;}">
                                <div class="avatar">
                                    @if($data['enprinfo']->elogo != null && $data['enprinfo']->elogo != "")
                                        <img class="avatar_img" id="head-img" src="{{$data['enprinfo']->elogo}}" width="100" height="100">
                                    @else
                                        <img class="avatar_img" id="head-img" src="{{asset('images/default-img.png')}}" width="100" height="100">
                                    @endif
                                    <input type="file" hidden name="head-img" id="input-head--img"
                                           onchange="showPreview(this)">
                                </div>
                                <div class="form-title">公司名称</div>
                                <div class="username input_box">
                                    <input type="text" id="name" name="ename" placeholder="用户名"
                                           value="{{$data['enprinfo']->ename}}"
                                           disabled="disabled">
                                    <div class="help-info">公司名称只有在企业审核时修改</div>
                                </div>
                                <div class="form-title">职位发布显示名称</div>
                                <div class="username input_box">
                                    <input type="text" id="by_name" name="byname" placeholder="可选，Ex: XXX俱乐部"
                                           value="{{$data['enprinfo']->byname}}">
                                    <div class="help-info">选填,公司别名便于个人用户了解公司业务</div>
                                </div>
                                <div class="form-title">公司联系电话</div>
                                <div class="username input_box">
                                    <input type="text" id="enterprise-phone" name="etel"
                                           placeholder="必填，Ex: (999)999999"
                                           value="{{$data['enprinfo']->etel}}">
                                    <div class="help-info">必填项</div>
                                </div>
                                <div class="form-title">公司联系邮箱</div>
                                <div class="username input_box">
                                    <input type="text" id="enterprise-email" name="email" placeholder="必填，Ex: example@example.com"
                                           value="{{$data['enprinfo']->email}}">
                                    <div class="help-info">必填项</div>
                                </div>

                                <div class="form-title">企业地址</div>
                                <div class="username input_box">
                                    <div class="form-line">
                                        <textarea rows="3" class="form-control" name="address" id="enterprise-address"
                                                  placeholder="必填，Ex: xx省 xx市 xx区/县  xxx街道xxx号"
                                                  value="{{$data['enprinfo']->address}}">
                                        </textarea>
                                    </div>
                                    <div class="help-info">必填项</div>
                                </div>
                                <div class="form-title">公司官网</div>
                                <div class="username input_box">
                                    <input type="text" id="enterprise-url" name="home_page"
                                           placeholder="可选，Ex：www.example.com"
                                           value="{{$data['enprinfo']->home_page}}">
                                    <div class="help-info">将显示在已发布的职位详情中，请以 http://, https://开头</div>
                                </div>
                                <div class="form-title">企业规模</div>
                                <div class="username input_box">
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
                                </div>

                                <div class="form-title">公司简介</div>
                                <div class="username input_box">
                                    <div class="form-line">
                                <textarea rows="3" class="form-control" name="description" id="description"
                                          placeholder="可选">{{$data['enprinfo']->ebrief}}</textarea>
                                    </div>
                                    <div class="help-info">将显示在已发布的职位详情中</div>
                                </div>


                                <div class="toolbar">
                                    <a class="btn userinfo_save" id="enterprise-info--change_button" >确认修改</a>
                                </div>
                            </form>
                            <p class="tips">* 请认真填写，该信息将同步到企业信息中</p>
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
                $("#userinfoEditForm").show();
            });
            // $("#edit_link").click(function(){
            // });
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
        var selfEvaluation = $("textarea[name='self_evalu']");

        if (pname.val() === "") {
            swal("","姓名不能为空","error");
            return;
        }

        if (residence.val() === "") {
            swal("","居住地不能为空","error");
            return;
        }

        if (registerPlace.val() === "") {
            swal("","户口所在地不能为空","error");
            return;
        }

        if (tel.val() === "") {
            swal("","联系电话不能为空","error");
            return;
        }

        if (mail.val() === "") {
            swal("","邮箱不能为空","error");
            return;
        }

        if (selfEvaluation.val().length > 500) {
            setError(selfEvaluation, "self-evaluation", "自我评价应少于500个字符");
            return;
        } else {
            removeError(selfEvaluation, "self-evaluation");
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
        formData.append("self_evalu", selfEvaluation.val());


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
            swal("","公司名称不能为空","error");
            return;
        }
//            if (byname.val === "") {
//                setError(byname, "byname", "不能为空");
//                return;
//            } else {
//                removeError(byname, "byname");
//            }

        if (etel.val() === "") {
            swal("","公司电话不能为空","error");
            return;
        }

        if (email.val() === "") {
            swal("","公司邮箱不能为空","error");
            return;
        } else {
            var re=/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
            if (re.test(email.val()) != true) {
                swal("","邮箱格式不正确","error");
                return;
            }
        }

        if (address.val() === "") {
            swal("","企业地址不能为空","error");
            return;
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
//                console.log(data);
                var result = JSON.parse(data);
                checkResult(result.status, "资料已修改", result.msg, null);
                self.location='/account';
            }
        })
    });
    </script>
@endsection
