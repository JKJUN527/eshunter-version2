@extends('mobile.layout.master')

@section('esh-header')
    @include('mobile.components.header',['title'=> '职位详情','buttonLeft'=>true])
    @stop

@section('esh-content')
    <div class="esh-panel esh-panel--default">
        <div class="esh-panel__header">
           {{-- <div class="esh-title-right">
                <span>
                    @if($data['detail']->salary <= 0)
                        薪资面议
                    @else
                        {{$data['detail']->salary}} -
                        @if($data['detail']->salary_max ==0) 无上限
                        @else {{$data['detail']->salary_max}}
                        @endif
                        元/月
                    @endif
                </span>
            </div>--}}
            <h5 class="mdl-typography--title">
                @if(empty($data['detail']->title))
                    没有填写职位名称
                @else
                    {{$data['detail']->title}}
                @endif
            </h5>

            <div class="mdl-typography--body-1-force-preferred-font">
                <div class="esh-list--title">
                    <div class="esh-list--title__left">{{--招聘人数：--}}
                        <i class="material-icons mdl-color-text--red">supervisor_account</i>
                        <span class="esh-title--value">
                            @if($data['detail']->total_num == null)
                                若干人
                            @else
                                {{$data['detail']->total_num}}
                            @endif
                            </span>
                    </div>

                    <div class="esh-list--title__left">
                        {{--<span class="mdl-color-text--red">--}}{{--<i class="material-icons mdl-color-text--red">attach_money</i>--}}{{--￥</span>--}}
                        <span class="esh-list--title__salary">
                            <span></span>
                            @if($data['detail']->salary <= 0)
                                薪资面议
                            @else
                                {{$data['detail']->salary}} -
                                @if($data['detail']->salary_max ==0) 无上限
                                @else {{$data['detail']->salary_max}}
                                @endif
                                元/月
                            @endif
                        </span>
                    </div>

                    <div class="esh-list--title__left">{{--发布时间：--}}
                        <i class="material-icons mdl-color-text--red">access_time</i>
                        <span class="esh-title--value">{!!mb_substr($data['detail']->created_at,0,10,'utf-8') !!}</span>
                    </div>
                </div>
                {{--<div>发布时间：{!!mb_substr($data['detail']->created_at,0,10,'utf-8') !!}</div>--}}
            </div>
        </div>
        <div class="esh-panel__body">
            <div class="esh-list--float clearfix mdl-color--white">
                <span class="esh-list__item">学历：
                    <span class="esh-js-value">
                        @if($data['detail']->education < 0)
                            无学历要求
                        @elseif($data['detail']->education == 0)
                            高中及以上
                        @elseif($data['detail']->education == 3)
                            专科及以上
                        @elseif($data['detail']->education == 1)
                            本科及以上
                        @elseif($data['detail']->education == 2)
                            研究生及以上
                        @else
                            无学历要求
                        @endif
                    </span>
                </span>
                <span class="esh-list__item">年龄：
                    <span class="esh-js-value">
                        @if($data['detail']->max_age == 0)
                            无年龄要求
                        @else
                            {{$data['detail']->max_age}}以内
                        @endif
                    </span>
                </span>
                {{--<span class="esh-list__item">薪资：
                    <span class="esh-js-value">
                        @if($data['detail']->salary <= 0)
                            薪资面议
                        @else
                            {{$data['detail']->salary}} -
                            @if($data['detail']->salary_max ==0) 无上限
                            @else {{$data['detail']->salary_max}}
                            @endif
                            元/月
                        @endif
                    </span>
                </span>
                <span class="esh-list__item">招聘人数：
                    <span class="esh-js-value">
                        @if($data['detail']->total_num == null)
                            若干人
                        @else
                            {{$data['detail']->total_num}} 人
                        @endif
                    </span>
                </span>--}}
                <span class="esh-list__item">工作地点：
                    <span class="esh-js-value">{{$data['region']->name or "待定"}}</span>
                </span>
                <span class="esh-list__item esh-width--1-1">上班地址：
                    <span class="esh-js-value">
                        @if($data['detail']->workplace =="-1" ||strlen($data['detail']->workplace)==0)
                            上班地址待定
                        @else
                            {!! $data['detail']->workplace!!}
                        @endif
                    </span>
                </span>
                <span class="esh-list__item esh-width--1-1">福利标签：<span class="esh-js-value">{{$data['detail']->tag or "无标签"}}</span></span>
            </div>
            <div>
                <div class="mdl-typography--body-2 esh-padding--x-16-y-10">职位描述</div>
                <div class="mdl-color--white esh-padding--x-16-y-10">
                    <p><b>所属游戏：</b><span class="esh-js-value">{{$data['detail']->name}}</span></p>
                    <p><b>岗位介绍：</b>
                        <span class="esh-js-value esh-visible--block">
                            @if($data['detail']->pdescribe == null || $data['detail']->pdescribe == "")
                                暂无职位介绍
                            @else
                                {!! $data['detail']->pdescribe !!}
                            @endif
                        </span></p>
                    <p><b>职位要求：</b>
                        <span class="esh-js-value esh-visible--block">
                            <ul class="esh-list--unstyled">
                                <li class="esh-list__item">
                                    @if(empty($data['detail']->experience))
                                        无经验要求
                                    @else
                                        {!! $data['detail']->experience !!}
                                    @endif
                                </li>

                            </ul>
                        </span>
                    </p>
                </div>

            </div>

            <div class="esh-card-group">
                <a class="esh-card" href="/m/company?eid={{$data["enprinfo"][0]->eid}}">
                    <img src="{{$data["enprinfo"][0]->elogo == null ? asset('images/default-img.png') : $data["enprinfo"][0]->elogo}}" height="70" width="70">
                    <div class="esh-card-body">
                        <span class="mdl-typography--subhead">{{$data["enprinfo"][0]->ename or "公司名称未填写"}}</span>
                        {{--<div class="mdl-typography--body-1 esh-card-body--text">{{$data["enprinfo"][0]->byname or "公司别名未填写"}}</div>--}}
                        <div class="mdl-typography--body-1 esh-card-body--text">
                            <span>
                                @if($data["enprinfo"][0]->industry == null)
                                                行业未知
                                            @else
                                                @foreach($data["industry"] as $item)
                                                    @if($data["enprinfo"][0]->industry == $item->id)
                                                        {{$item->name}}
                                                    @endif
                                                @endforeach
                                            @endif
                            </span> |
                            <span>
                                @if($data["enprinfo"][0]->enature == null || $data["enprinfo"][0]->enature == 0)
                                                企业类型未知
                                            @elseif($data["enprinfo"][0]->enature == 1)
                                                国有企业
                                            @elseif($data["enprinfo"][0]->enature == 2)
                                                民营企业
                                            @elseif($data["enprinfo"][0]->enature == 3)
                                                中外合资企业
                                            @elseif($data["enprinfo"][0]->enature == 4)
                                                外资企业
                                            @elseif($data["enprinfo"][0]->enature == 5)
                                                社会团体
                                            @endif
                            </span> |
                            <span>
                                @if($data["enprinfo"][0]->escale == null)
                                                规模未知
                                            @elseif($data["enprinfo"][0]->escale == 0)
                                                10人以下
                                            @elseif($data["enprinfo"][0]->escale == 1)
                                                10～50人
                                            @elseif($data["enprinfo"][0]->escale == 2)
                                                50～100人
                                            @elseif($data["enprinfo"][0]->escale == 3)
                                                100～500人
                                            @elseif($data["enprinfo"][0]->escale == 4)
                                                500～1000人
                                            @elseif($data["enprinfo"][0]->escale == 5)
                                                1000人以上
                                            @endif
                            </span>
                        </div>
                    </div>
                    <div class="mdl-list__item-secondary-content mdl-typography--text-center">
                            <span class="mdl-typography--caption {{$data["enprinfo"][0]->is_verification == 1 ? 'mdl-color-text--green' : 'mdl-color-text--grey'}}">
                                <i class="material-icons">verified_user</i>
                                <span class="esh-visible--block">
                                    {{$data["enprinfo"][0]->is_verification == 1 ? '已认证' : '待审核'}}
                                </span>
                            </span>
                    </div>
                </a>
                @if(empty($data["enprinfo"][0]->home_page))
                    <div class="esh-card__addon mdl-color-text--grey">
                        <i class="material-icons esh-vertical--middle">apps</i>
                        <span class="esh-card__addon-text">企业主页未填写</span>
                    </div>
                @else
                    <a class="esh-card__addon mdl-color-text--blue" href="
                    @if(strpos($data["enprinfo"][0]->home_page, "http://") !== false ||strpos($data["enprinfo"][0]->home_page, "https://") !== false)
                        {{$data["enprinfo"][0]->home_page or '#'}}
                    @else
                        {!! "http://".$data["enprinfo"][0]->home_page !!}
                    @endif" target="_blank">
                        <i class="material-icons esh-vertical--middle">apps</i>
                        <span class="esh-card__addon-text esh-pull--right">进入</span>
                        <span class="esh-card__addon-text">企业主页</span>
                    </a>
                @endif

            </div>
            <div class="mdl-color--white">
                <div class="mdl-typography--body-2 esh-padding--x-16-y-10">公司简介</div>
                <div class="esh-padding--x-16-y-10">
                    <p>{{$data["enprinfo"][0]->ebrief or "公司简介暂无"}}</p>
                </div>
            </div>
            <div class="mdl-typography--body-2 esh-padding--x-16-y-10">公司其他职位<small>(共{{count($data['position'])}}个)</small></div>
            <div class="esh-section__container">
                @forelse($data['position'] as $position)
                    <a class="esh-section" href="/m/position/detail?pid={{$position->pid}}">
                        <span class="mdl-typography--body-2 esh-section--title">
                            @if(empty($position->title))
                                没有填写职位名称
                            @else
                                {{mb_substr($position->title, 0, 20, 'utf-8')}}
                            @endif
                        </span>
                        <span class="mdl-typography--body-1 esh-section--subtitle esh-text-block--ellipsis">
                            <span>上班地点：{{$position->name}}</span>
                            <span class="esh-padding--x-1">月薪：
                                @if($position->salary <= 0)
                                    薪资面议
                                @else
                                    {{$position->salary}}元/月
                                @endif
                            </span>
                        </span>
                    </a>
                    @break($loop->index > 2)
                @empty
                    <div class="esh-block--empty mdl-color-text--grey">
                        该公司没有其他职位
                    </div>
                @endforelse

                @if(count($data['position']) > 4)
                    <a class="esh-block--link" href="/m/company?eid={{$data['position'][0]->eid}}">查看全部职位</a>
                @endif
            </div>
        </div>

    </div>
    @stop

@section('esh-footer')
    <footer class="esh-layout__footer">
        <div class="esh-layout__actions">
            @if($data['type'] == 0)
                <a class="mdl-button esh-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="/m/account/login">投递简历</a>
            @elseif($data['detail']->position_status==1 || $data['detail']->position_status==4)
                <div class="esh-dialog__container">
                    <div class="mdl-dialog esh-dialog esh-js-list--resume">
                        <h4 class="mdl-dialog__title">选择简历</h4>
                        <div class="mdl-dialog__content"></div>
                        <div class="mdl-dialog__actions">
                            <button type="button" class="mdl-button esh-js-dialog--close">取消</button>
                        </div>
                    </div>
                </div>


                <a class="mdl-button esh-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect esh-js-button--deliver" data-content="{{$data['detail']->pid}}">投递简历</a>
            @else
                <a class="mdl-button esh-button mdl-button--raised mdl-button--colored mdl-js-button mdl-js-ripple-effect">无法投递简历</a>
            @endif
        </div>
    </footer>
    @stop


@section('esh-js')
    @parent
    @if($data['detail']->position_status==1 ||$data['detail']->position_status==4)
        <script type="text/javascript">
            (function(){

                var ESHUtils = this.ESHUtils;

                $(function(){

                    var $dialog = $(".esh-dialog__container");

                    $dialog.on('click','.esh-js-button--add-resume',function(evt){

                        $.ajax({
                            url: "/resume/addResume",
                            type: "get",
                            dataType: 'json',
                            success: function (data) {
                                if (data['status'] === 200) {
                                    self.location = "/m/resume/add?rid=" + data['rid'];
                                } else if (data['status'] === 400) {
                                    swal({title:'提示','text':data.msg,confirmButtonText: "确定"});
                                }
                            },
                            error: function (err) {
                                swal({title:'提示','text': '网络错误，请稍后再试！',confirmButtonText: "确定"});
                            }
                        });

                        return ESHUtils.stopEvent(evt);
                    }).on('click','.esh-doc__page',function (evt) {
                        var $this = $(this),data = new FormData();

                        data.append('rid',$this.data('content'));
                        data.append('pid',$this.data('pid'));

                        $.ajax({
                            url: "/m/delivered/add",
                            type: "post",
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: data,
                            success: function (data) {
                                if(data.status === 200 ){
                                    swal({title:'提示','text': '简历投递成功！',confirmButtonText: "确定"});
                                }else {
                                    swal({title:'提示','text':data.msg, confirmButtonText: "确定"});
                                }
                            },
                            error: function (err) {
                                swal({title:'提示','text': '网络错误，请稍后再试！',confirmButtonText: "确定"});
                            }
                        });

                        $dialog && $dialog.fadeOut(100);

                        return ESHUtils.stopEvent(evt);
                    }).on('click','.esh-js-dialog--close',function (evt) {

                        $dialog && $dialog.fadeOut(100);

                        return ESHUtils.stopEvent(evt);
                    });

                    $(".esh-js-button--deliver").click(function () {

                        var $this = $(this);

                        $this.attr('disabled', true);
                        $dialog && $dialog.fadeIn(100);

                        $.ajax({
                            url: "/resume/getResumeList",
                            type: "get",
                            success: function (data) {
                                var len,$link = null, $list = null, $item = null, $icon = null,$text = null;

                                len = data.length;

                                if (!len) {
                                    $link = $('<a/>',{'class':'esh-doc__button mdl-color-text--blue esh-js-button--add-resume'})
                                        .append($('<i/>',{'class': 'material-icons'}).text('add'))
                                        .append($('<span/>',{'class':'esh-doc__button-text'}).text('没有简历，点击添加'));
                                } else {
                                    $list = $('<ul/>',{'class': 'esh-doc'});

                                    for (var i = 0; i < len; i++) {
                                        $item = $('<li/>',{'class': 'esh-doc__page','data-content': data[i]['rid'], 'data-pid': $this.data("content")});
                                        $icon = $('<i/>',{'class': 'material-icons'}).text('content_paste');
                                        $text = $('<span/>',{'class':'esh-doc__title'}).text(data[i]['resume_name'] === null ? "未命名的简历" : data[i]['resume_name']);
                                        $item.append($icon).append($text);
                                        $list.append($item);
                                    }
                                }

                                $(".mdl-dialog__content").empty().append($link || $list);
                            }
                        });

                        $this.attr('disabled', false);
                    });
                });

            })();
        </script>

    @endif
    @stop
