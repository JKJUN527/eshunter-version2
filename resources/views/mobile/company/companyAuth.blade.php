@extends('mobile.layout.master')


@section('title', '企业认证')


@section('esh-header')
    @include('mobile.components.header',['title'=>'企业认证','buttonLeft'=>true])
@stop


@section('esh-content')
    <form id="esh-company-auth-form">
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>企业名称
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="text" id="enterprise-name" name="enterprise-name"
                       value="{{$data['enterprise']->ename}}"
                        placeholder="必填项，提交审核后将无法再次修改">
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>所属行业
            </label>
            <div class="esh-select" >
                <span class="esh-sval"></span>
                <select name="enterprise-industry" class="esh-select-option" id="enterprise-industry">
                    <option value="0">请选择行业</option>
                    @foreach($data['industry'] as $industry)
                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                    @endforeach
                </select>
                <label for="enterprise-industry"></label>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>企业类型
            </label>
            <div class="esh-select" >
                <span class="esh-sval"></span>
                {{--@if($data['personinfo']->is_marry == 2) selected @endif--}}
                <select class="esh-select-option" id="enterprise-type"
                        name="enterprise-type">
                    <option value="0">请选择企业类型</option>
                    <option value="1">国有企业</option>
                    <option value="2">民营企业</option>
                    <option value="3">中外合资企业</option>
                    <option value="4">外资企业</option>
                    <option value="5">社会团体</option>
                </select>
                <label for="enterprise-type"></label>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>企业联系邮箱
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required" type="email" id="enterprise-email" name="enterprise-email"
                       value="{{$data['enterprise']->email}}"
                       placeholder="请输入邮箱(必填)"/>
            </div>
        </div>
        <div class="esh-edit">
            <label class="esh-label">
                <em>*</em>企业联系电话
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input required telephone" type="text" name="enterprise-phone"
                       value="{{$data['enterprise']->etel}}"
                       placeholder="请输入联系电话(必填)"/>
            </div>
        </div>
        <div class="esh-edit esh-textarea">
            <label class="esh-label">
                <em>*</em>企业地址
            </label>
            <div class="esh-textarea--p">
                <textarea class="required"  name="enterprise-address" id="enterprise-address"
                       value="{{$data['enterprise']->address}}"
                          placeholder="必填，Ex: xx省 xx市 xx区/县  xxx街道xxx号"></textarea>
            </div>
        </div>

        <div class="esh-edit esh-edit-upload">
            <label class="esh-label">
                <em>*</em>相关负责人手持身份证照片
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="id-card_holder">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored esh-upload-button"
                        id="id-card__upload-btn">
                    上传
                </button>
                {{--<img src="../../styles/default/images/default-img.png" width="38px" height="38px"--}}
                     {{--class="esh-upload-img"  id="upload-head--img1"/>--}}
                {{--<input type="file" name="head-img" id="input-head--img1" accept="image/png,image/jpeg,image/jpg"--}}
                       {{--class="required"--}}
                       {{--onchange="showPreview(this)"  hidden>--}}
            </div>

        </div>
        <div id="id-card__preview-holder">
        </div>
        <div class="esh-edit esh-edit-upload">
            <label class="esh-label">
                <em>*</em>企业营业执照
            </label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="license_holder">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored esh-upload-button"
                        id="license__upload-btn">
                    上传
                </button>
                {{--<img src="../../styles/default/images/default-img.png" width="38px" height="38px"--}}
                     {{--class="esh-upload-img"  id="id-card__upload-btn"/>--}}
                {{--<input type="file" name="head-img" id="input-head--img2" accept="image/png,image/jpeg,image/jpg"
                       class="required"
                       onchange="showPreview(this)"  hidden>--}}
            </div>

        </div>
        <div id="license__preview-holder">
        </div>
        <div class="esh-edit-fb esh-form-sure">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"
                    type="button" id="esh-submit-verify">
                保存
            </button>
        </div>
    </form>
@stop


@section('esh-js')
    @parent
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('mobile/plugins/jquery-validation/jquery.validate.method.js')}}"></script>
    <script src="{{asset('mobile/js/company/companyAuth.js')}}"></script>
@stop
