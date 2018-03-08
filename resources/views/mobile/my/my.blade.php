@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['logo'=>true])
@stop

@section('esh-content')
    <div class="esh-article">
    <div class="esh-account-info mdl-card">
        @if($data["type"] == 1)
            @if($data["personInfo"][0]["photo"]== null)
            <div class="mdl-card__title">
                <img src="{{asset('mobile/styles/default/images/default-img.png')}}"
                     class="esh-account-img" id="upload-head--img"/>
            </div>
            @else
            <div class="mdl-card__title">
                <img src="{{$data["personInfo"][0]["photo"]}}" class="esh-account-img" id="upload-head--img"/>
            </div>
            @endif
        <div class="mdl-card__supporting-text">
           <span class="esh-text-l">{{$data["personInfo"][0]["pname"] or "姓名未填写"}}</span>
            <div>

                <span>
                    @if($data["personInfo"][0]["sex"] == null)
                        性别未填写
                    @elseif($data["personInfo"][0]["sex"] == 1)
                        男
                    @elseif($data["personInfo"][0]["sex"] == 2)
                        女
                    @endif
                </span>|
                <span>{{$data["personInfo"][0]["birthday"] or "生日未填写"}}&nbsp;</span>|
                <span>{{$data["personInfo"][0]["residence"] or "居住地未填写"}}</span>
            </div>
        </div>
        <div class="mdl-card__menu esh-person">
            <a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--red" href="/m/account/edit">
                <i class="material-icons">create</i>
            </a>
        </div>

       @elseif($data["type"] == 2)
           <div class="mdl-card__title">
                @if($data["enterpriseInfo"][0]["elogo"]==null)
                <img src="{{asset('mobile/styles/default/images/default-img.png')}}"  class="esh-account-img" id="upload-head--img"/>
                @else
                   <img src="{{$data["enterpriseInfo"][0]["elogo"]}}"  class="esh-account-img" id="upload-head--img"/>
                @endif
            </div>
            <div class="mdl-card__supporting-text">
                <div class="esh-text-l">{{$data["enterpriseInfo"][0]["ename"] or "公司名称未填写"}} </div>
                <div>{{$data["enterpriseInfo"][0]["byname"] or "公司别名未填写"}} </div>
                <div>
                    <span>
                        @if($data["enterpriseInfo"][0]["industry"] == null)
                            行业未知
                        @else
                            @foreach($data["industry"] as $item)
                                @if($data["enterpriseInfo"][0]["industry"] == $item->id)
                                    {{$item->name}}
                                @endif
                            @endforeach
                        @endif
                    </span>|
                    <span>
                        @if($data["enterpriseInfo"][0]["enature"] == null || $data["enterpriseInfo"][0]["enature"] == 0)
                            企业类型未知
                        @elseif($data["enterpriseInfo"][0]["enature"] == 1)
                            国有企业
                        @elseif($data["enterpriseInfo"][0]["enature"] == 2)
                            民营企业
                        @elseif($data["enterpriseInfo"][0]["enature"] == 3)
                            中外合资企业
                        @elseif($data["enterpriseInfo"][0]["enature"] == 4)
                            外资企业
                        @elseif($data["enterpriseInfo"][0]["enature"] == 5)
                            社会团体
                        @endif
                    </span>|
                    <span>
                        @if($data["enterpriseInfo"][0]["escale"] == null)
                            规模未知
                        @elseif($data["enterpriseInfo"][0]["escale"] == 0)
                            10人以下
                        @elseif($data["enterpriseInfo"][0]["escale"] == 1)
                            10～50人
                        @elseif($data["enterpriseInfo"][0]["escale"] == 2)
                            50～100人
                        @elseif($data["enterpriseInfo"][0]["escale"] == 3)
                            100～500人
                        @elseif($data["enterpriseInfo"][0]["escale"] == 4)
                            500～1000人
                        @elseif($data["enterpriseInfo"][0]["escale"] == 5)
                            1000人以上
                        @endif
                    </span>
                </div>
            </div>
            <div class="mdl-card__menu esh-company">
                @if($data["enterpriseInfo"][0]["is_verification"] != 2 &&
                    $data["enterpriseInfo"][0]["is_verification"] != -1 &&
                    $data["enterpriseInfo"][0]["is_verification"]!=0)
                    <a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect" href="/m/account/edit">
                        <i class="material-icons">create</i>
                    </a>
                @else
                    <a class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect"
                        onclick="verfiyCompany({{$data["enterpriseInfo"][0]["is_verification"]}})">
                        <i class="material-icons">create</i>
                    </a>
                @endif
            </div>
        @endif
    </div>



    <!--subs -->
    <div class="esh-subs esh-article__section mdl-list" id="esh-subs">
       @if($data["type"] == 1)
        <div class="mdl-list__item esh-href-page" data-url="/m/resume" >
            <span class="mdl-list__item-primary-content">
              <i class="material-icons mdl-list__item-icon mdl-color-text--red">person</i>
              <span>我的简历</span>
            </span>
            <span class="mdl-list__item-secondary-action">{{--<i class="material-icons">chevron_right</i>--}}</span>
        </div>
        <div class="mdl-list__item esh-href-page" data-url="/m/position/applyList">
            <div class="mdl-list__item-primary-content" >
              <i class="material-icons mdl-list__item-icon mdl-color-text--red">event_note</i>
               {{-- @if($data["deliveredNum"] <= 9)
                <div class="material-icons mdl-badge mdl-badge--overlap mdl-color-text--red" data-badge=" {{$data["deliveredNum"]}}">event_note</div>
                @else
                    <div class="material-icons mdl-badge mdl-badge--overlap mdl-color-text--red" data-badge="9+">event_note_box</div>
                @endif--}}
              <span id="esh-sub-second-title">我的申请记录</span>

            </div>
            <div class="mdl-list__item-secondary-action">
                <span class="esh-counts">
                    共
                    <span class="mdl-color-text--red">
                        @if($data["deliveredNum"] <= 9)
                            {{$data["deliveredNum"]}}
                        @else
                            9+
                        @endif
                  </span>
                    条
                </span>
            </div>
        </div>
        <div class="mdl-list__item esh-href-page" data-url="/m/message">
            <div class="mdl-list__item-primary-content ">
              <i class="material-icons mdl-list__item-icon  mdl-color-text--red">textsms</i>
               {{-- @if($data["messageNum"] <= 9)
                    <div class="material-icons mdl-badge mdl-badge--overlap mdl-color-text--red" data-badge=" {{$data["messageNum"]}}">textsms</div>
                @else
                    <div class="material-icons mdl-badge mdl-badge--overlap mdl-color-text--red" data-badge="9+">textsms</div>
                @endif--}}
              <div>我的消息

              </div>
            </div>
            <div class="mdl-list__item-secondary-content">
                <span class="esh-counts">
                    共
                     <span class="mdl-color-text--red">
                         @if($data["messageNum"] <= 9)
                             {{$data["messageNum"]}}
                         @else
                             9+
                         @endif
                  </span>
                    条
                </span>
              {{--<div class="mdl-list__item-secondary-action">

              </div>--}}
            </div>
        </div>
        <div class="mdl-list__item esh-href-page" data-url="/m/account/jobRecommendList">
            <span class="mdl-list__item-primary-content">
              <i class="material-icons mdl-list__item-icon mdl-color-text--red">&#xE84F;</i>
              <span>职业推荐</span>
            </span>
                <span class="mdl-list__item-secondary-content">
              <span class="mdl-list__item-secondary-action">{{--<i class="material-icons">chevron_right</i>--}}</span>
            </span>
        </div>
       @endif

        @if($data["type"] == 2)
        <div class="mdl-list__item esh-href-page" data-url="/m/position/publishList">
            <span class="mdl-list__item-primary-content">
              <i class="material-icons mdl-list__item-icon mdl-color-text--red">person</i>
              <span>发布的职位</span>
            </span>
            <span class="mdl-list__item-secondary-action">{{--<i class="material-icons">chevron_right</i>--}}</span>
        </div>
        <div class="mdl-list__item esh-href-page" data-url="/m/position/deliverList">
            <span class="mdl-list__item-primary-content " >
              <i class="material-icons mdl-list__item-icon mdl-color-text--red">event_note</i>
              <span >收到的申请记录</span>
            </span>
            <span class="mdl-list__item-secondary-action">{{--<i class="material-icons">chevron_right</i>--}}</span>
        </div>

        <div class="mdl-list__item esh-href-page" data-url="/m/message">
            <span class="mdl-list__item-primary-content">
              <i class="material-icons mdl-list__item-icon mdl-color-text--red">textsms</i>
              <span>我的消息</span>
            </span>
            <span class="mdl-list__item-secondary-content">
              <span class="mdl-list__item-secondary-action" >
                  <span class="esh-counts">
                    共
                     <span class="mdl-color-text--red">
                         @if($data["messageNum"] <= 9)
                             {{$data["messageNum"]}}
                         @else
                             9+
                         @endif
                  </span>
                    条
              </span>
            </span>
            </span>
        </div>
       <div  id="esh-company-auth"
               class="mdl-list__item
                @if($data["enterpriseInfo"][0]["is_verification"] == 1) verified @endif
                @if($data["enterpriseInfo"][0]["is_verification"] == 0) unverified @endif" >
            <span class="mdl-list__item-primary-content" >
            <i class="material-icons mdl-list__item-icon mdl-color-text--red">verified_user</i>
            <span >
                @if($data["enterpriseInfo"][0]["is_verification"] === 1) &nbsp;已认证
                @elseif($data["enterpriseInfo"][0]["is_verification"]  === 0) 待审核
                @else 点击进行认证
                @endif
            </span>
            </span>
                   <span class="mdl-list__item-secondary-action">
                {{--<i class="material-icons">chevron_right</i>--}}
            </span>
       </div>
        @endif
           <div class="mdl-list__item esh-href-page" data-url="/m/about/index">
            <span class="mdl-list__item-primary-content ">
              <i class="material-icons mdl-list__item-icon mdl-color-text--red">person</i>
              <span>关于我们</span>
            </span>
               <span class="mdl-list__item-secondary-action">{{--<i class="material-icons">chevron_right</i>--}}</span>
           </div>
    </div>
        <div class="esh-edit-fb esh-form-sure"  id="esh-loginout">
            <button class="mdl-button mdl-js-button mdl-color--red mdl-button--raised
                    mdl-js-ripple-effect mdl-button--colored" type="button">
                退出登录
            </button>
        </div>
    </div>
@stop

@section('esh-footer')
    @include('mobile.components.footerTabs',['activeIndex'=>3,'data'=>$data])
@stop

@section('esh-js')
    @parent
    <script src="{{asset('mobile/js/my/my.js')}}"></script>
@stop

