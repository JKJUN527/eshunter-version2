@extends('mobile.layout.master')

@section('esh-css')
    <link rel="stylesheet" href="{{asset('mobile/plugins/mdl-picker/css/mdDateTimePicker.min.css')}}">
    @parent
@stop

@section('esh-header')
    @include('mobile.components.header',['title'=>'基本信息','buttonLeft'=>true])
@stop

@section('esh-content')
    @if($data['type'] == 1)
        <form id="esh-person-info">
            <div class="esh-edit esh-edit-upload">
                <label class="esh-label">
                    头像
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    @if($data['personinfo']->photo != null && $data['personinfo']->photo != "")
                        <img src="{{$data['personinfo']->photo}}" width="38px" height="38px"
                             class="esh-upload-img" id="upload-head--img"/>
                    @else
                        <img src="{{asset('mobile/styles/default/images/default-img.png')}}" width="38px"
                             height="38px"
                             class="esh-upload-img" id="upload-head--img"/>
                    @endif
                    <input type="file" name="head-img" id="input-head--img" accept="image/png,image/jpeg,image/jpg"
                           onchange="showPreview(this)" hidden>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>用户名
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="username"
                           value="{{$data['personinfo']['username']->username}}"
                           maxlength="20" placeholder="请输入用户名(必填)">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>姓名
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    {{--<!--  pattern="^[\u4e00-\u9fa5]{1,10}$"-->--}}
                    <input class="mdl-textfield__input required" type="text"
                           value="{{$data['personinfo']->pname}}"
                           maxlength="10" name="pname" placeholder="请输入姓名(必填)">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>性别
                </label>
                <div class="esh-check_inputs">
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="esh-male">
                        <input type="radio" id="esh-male" class="mdl-radio__button"
                               @if($data['personinfo']->sex == 1 || ($data['personinfo']->sex != 1 && $data['personinfo']->sex != 2)) checked
                               @endif
                               name="sex" value="1">
                        <span class="mdl-radio__label">男</span>
                    </label>
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="esh-female">
                        <input type="radio" id="esh-female" class="mdl-radio__button"
                               @if($data['personinfo']->sex == 2) checked @endif
                               name="sex" value="2">
                        <span class="mdl-radio__label">女</span>
                    </label>
                </div>

            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>居住地
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="residence"
                           value="{{$data['personinfo']->residence}}"
                           placeholder="请输入居住地(必填)"/>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>户口所在地
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="register_place"
                           value="{{$data['personinfo']->register_place}}"
                           placeholder="请输入户口所在地(必填)"/>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>联系电话
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input telephone required" type="text" name="tel"
                           value="{{str_replace("-","",$data['personinfo']->tel)}}"
                           placeholder="请输入手机号(必填)"/>
                    <span class="mdl-textfield__error"></span>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>联系邮箱
                </label>
                {{--<!--pattern="^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$" esh-error-msg="请输入正确的邮箱-->--}}
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="email" name="mail"
                           value="{{$data['personinfo']->mail}}"
                           placeholder="请输入邮箱(必填)"/>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    婚姻状况
                </label>
                <div class="esh-select" id="esh-married-status">
                    <span class="esh-sval"></span>
                    <select name="is_marry" class="esh-select-option">
                        <option value="1" @if($data['personinfo']->is_marry == 1) selected @endif>未婚</option>
                        <option value="2" @if($data['personinfo']->is_marry == 2) selected @endif>已婚</option>
                        <option value="0"
                                @if($data['personinfo']->is_marry != 1 && $data['personinfo']->is_marry != 2) selected @endif>
                            保密
                        </option>
                    </select>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    出生日期
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label esh-birth-input">
                    <input class="mdl-textfield__input" type="text" name="birthday"
                           @if($data['personinfo']->birthday != null)
                           value="{{$data['personinfo']->birthday}}"
                           @endif
                           data-date-format="yyyy-mm-dd" id="esh-birth" placeholder="请选择出生日期"/>
                </div>
            </div>

            <div class="esh-edit">
                <label class="esh-label">
                    工作年份
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text"
                           name="work_year"
                           @if($data['personinfo']->work_year != null) value="{{$data['personinfo']->work_year}}"
                           @endif
                           placeholder="请输入工作年份"/>

                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    政治面貌
                </label>
                <div class="esh-select">
                    <span class="esh-sval"></span>
                    <select class="esh-select-option" id="political" name="political">
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
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    最高学历
                </label>
                <div class="esh-select">
                    <span class="esh-sval">高中</span>
                    <select class="esh-select-option" id="education" name="education">
                        <option value="9" @if($data['personinfo']->education == 9) selected @endif>
                            请选择最高学历
                        </option>
                        <option value="0" @if($data['personinfo']->education == 0) selected @endif>高中
                        </option>
                        <option value="3" @if($data['personinfo']->education == 3) selected @endif>专科
                        </option>
                        <option value="1" @if($data['personinfo']->education == 1) selected @endif>本科
                        </option>
                        <option value="2" @if($data['personinfo']->education == 2) selected @endif>研究生及以上
                        </option>
                    </select>
                </div>
            </div>
            <div class="esh-edit esh-textarea">
                <label class="esh-label">
                    自我评价
                </label>
                <div class="esh-textarea--p">
                        <textarea id="self-evaluation" placeholder="可选"
                                  name="self_evalu">{{$data['personinfo']->self_evalu}}</textarea>
                </div>
            </div>
        </form>
        <div class="esh-edit-fb esh-form-sure">
            <button class="mdl-button mdl-js-button mdl-button--raised
                mdl-js-ripple-effect mdl-button--colored" id="esh-save">
                保存
            </button>
        </div>
    @endif



    @if($data['type']==2)
        <form id="esh-company-info">
            <div class="esh-edit esh-edit-upload">
                <label class="esh-label">
                    公司Logo
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    @if($data['enprinfo']->elogo != null && $data['enprinfo']->elogo != "")
                        <img src="{{$data['enprinfo']->elogo}}" width="38px" height="38px"
                             class="esh-upload-img" id="upload-head--img"/>
                    @else
                        <img src="{{asset('mobile/styles/default/images/default-img.png')}}" width="38px"
                             height="38px"
                             class="esh-upload-img" id="upload-head--img"/>
                    @endif
                    <input type="file" name="head-img" id="input-head--img" accept="image/png,image/jpeg,image/jpg"
                           onchange="showPreview(this)" hidden>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>公司名称
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" name="ename"
                           value="{{$data['enprinfo']->ename}}"
                           maxlength="20" placeholder="请输入用户名(必填)" readonly="readonly">
                    <span class="mdl-textfield__error"></span>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>职位名称
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" name="byname"
                           value="{{$data['enprinfo']->byname}}"
                           maxlength="20" placeholder="请输入职位名称(必填)">
                    <span class="mdl-textfield__error"></span>
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>公司联系电话
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required telephone" type="text" name="etel"
                           value="{{$data['enprinfo']->etel}}"
                           placeholder="请输入联系电话(必填)">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>公司联系邮箱
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="email" name="email"
                           value="{{$data['enprinfo']->email}}"
                           placeholder="请输入公司邮箱(必填)">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    <em>*</em>企业地址
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input required" type="text" name="address"
                           value="{{$data['enprinfo']->address}}"
                           placeholder="请输入地址(必填)">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    公司官网
                </label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" name="home_page"
                           value="{{$data['enprinfo']->home_page}}">
                </div>
            </div>
            <div class="esh-edit">
                <label class="esh-label">
                    企业规模
                </label>
                <div class="esh-select">
                    <span class="esh-sval"></span>
                    <select class="esh-select-option" name="escale">
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
                </div>
            </div>
            <div class="esh-edit esh-textarea">
                <label class="esh-label">
                    公司简介
                </label>
                <div class="esh-textarea--p">
                    <textarea name="ebrief">{{$data['enprinfo']->ebrief}}</textarea>
                </div>
            </div>
            <div class="esh-edit-fb esh-form-sure">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                        id="esh-save-cmpinfo">
                    保存
                </button>
            </div>
        </form>
    @endif
@stop

@section('esh-js')
    @parent
    <script src="{{asset('mobile/plugins/mdl-picker/js/moment.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/mdl-picker/js/lang/zh-cn.js')}}"></script>

    <script src="{{asset('mobile/plugins/mdl-picker/js/scroll-into-view-if-needed.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/mdl-picker/js/draggabilly.pkgd.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/mdl-picker/js/mdDateTimePicker.js')}}"></script>
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.method.js')}}"></script>
    <script src="{{asset('mobile/js/my/accountInfo.js')}}"></script>
@stop