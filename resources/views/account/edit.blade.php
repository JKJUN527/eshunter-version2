@extends('layout.master')
@section('title', '账号设置')

@section('custom-style')
    <link media="all" href="{{asset('../style/user_style.css')}}" type="text/css" rel="stylesheet">
    <style>
        .form-title{
            font-size: 17px;
    color: #000;
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
<script>
                                            var jianlistatustype = "";
                                            var tui_user_pro = '';
                                            var res_tuijian = '';
                                            var uname = "";
                                            var ukbn = "";
                                            var isIE7 = false;
            

                                    $(document).ready(function(){
            //底部tab切换
                                    $('.contact_Con .contactCon').hide();
                                            $('.contact_Con .contactCon').eq(0).show();
                                            $('.contact_tab span').click(function(){
                                    $(this).addClass('active');
                                            $(this).siblings().removeClass('active');
                                            $('.contact_Con .contactCon').hide();
                                            $('.contact_Con .contactCon').eq($(this).index()).show();
                                    })

            //判断是否为ie6
                                            var isIE = !!window.ActiveXObject;
                                            var isIE6 = isIE && !window.XMLHttpRequest;
                                            var isIE8 = isIE && !!document.documentMode;
                                            var isIE7 = isIE && !isIE6 && !isIE8;
                                            if (isIE){
                                    isIE7 = true;
                                            if (isIE6){
                                    $('.bsie').show();
                                    }
                                    }
                                    $('.closeBtn').click(function(){
                                    $('.a_box').hide();
                                    })

            //底部二维码
                                            $('.about_Us span.ma_img').mouseover(function(){
                                    $(this).find('img').show();
                                    })
                                            $('.about_Us span.ma_img').mouseout(function(){
                                    $(this).find('img').hide();
                                    })
                                            
                                            
                                            $('.pos_dl').mouseenter(function(){
                                    $('.dl_hide').show();
                                    });
                                            $('.pos_dl').mouseleave(function(){
                                    $('.dl_hide').hide();
                                    });
                                            //鼠标滑过2维码显示
                                            $('.wx_pos').mouseover(function(){
                                    $(this).find('img').show();
                                    })

                                            $('.wx_pos').mouseleave(function(){
                                    $(this).find('img').hide();
                                    })
                                            
                                    });
            
          
            </script>
    <div class="wrapper_content clearfix">
                
                <div class="user_bindSidebar">
                    <ul class="user_sideBarmenu">
                        <li>
                            <a href="/account/edit" class="hover_ac" >个人信息</a>
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
                    </div>
                </div>
            </div>
@endsection
@section('footer')
    @include('components.myfooter')
@endsection
@section('custom-script')
    <script type="text/javascript">
                $(document).ready(function(){
                    $("#edit_link").click(function(){
                      $(".hadInfo").hide();
                    });
                    $("#edit_link").click(function(){
                      $("#userinfoEditForm").show();
                    });
                });
            </script>
@endsection
