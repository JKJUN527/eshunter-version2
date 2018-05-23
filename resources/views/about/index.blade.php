@extends('layout.master')
@section('title', '关于')

@section('custom-style')
 <link media="all" href="{{asset('../style/about.css')}}" type="text/css" rel="stylesheet">

@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 5,'type' => $data['type']])
@endsection

@section('content')
<div class="detail-wrap">
  <div class="detail-left">
    <div class="product-board">
      <!-- <img src="/static/img/1.0de5539.png"> -->
      <ul>
        <li @if($data['tab'] == 'tab1') class="active" @endif>简历指导</li>
        <li @if($data['tab'] == 'tab2') class="active" @endif>关于我们</li>
        <li @if($data['tab'] == 'tab3') class="active" @endif>联系我们</li>
        <li @if($data['tab'] == 'tab4') class="active" @endif>网站地图</li>
        <li @if($data['tab'] == 'tab5') class="active" @endif>免责申明</li>
    </ul>
    </div>
  </div>
  <div class="detail-right">
    <div class="sales-board @if($data['tab'] == 'tab1') active @endif">
        <div class="sales-board-intro">
        <h2 >简历指导</h2>
        <div class="modal-body">
                    <div class="modal-body-paper">
                        <p>找工作都需要一个认真的态度，对待所有工作都是，对待电竞相关的工作也是如此。<br/>草草敷衍的填写简历，多数企业是不会给予机会嗒。<br/>不管你想打职业，想做赛事，想做幕后，等等...<br/>都希望您认真并属实的填写简历哦！以下为一些简单的范例，从工作经历开始，仅供参考。<br/></p>
                       
                    </div>
                    <div class="modal-body-detail">
                        <p>1. 工作经历：不管实习还是全职工作经历，请填写公司、职位、工作时间，以及详细的工作经历。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain1.png")}}" alt=""></div>
                    <div class="modal-body-detail">
                        <p>2. 每个人寻求的都是不同方向的岗位，想做选手的有一些比赛经历，想做赛事的可以填一些赛事策划或执行的经历，又或者是程序猿有编程项目的经历等等。</p>
                    </div>
                    <div class="modal-body-detail2">
                        <p>（1）有打比赛的经历，请填写赛事名称、游戏、位置、时间，以及比赛的描述。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain2.png")}}" alt=""></div>
                    <div class="modal-body-detail2">
                        <p>（2）有赛事的经历，可以填写赛事名称、负责的职责、时间，以及具体策划或执行的细节。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain3.png")}}" alt=""></div>
                    <div class="modal-body-detail2">
                        <p>（3）又或者您应聘的是电竞公司的程序猿，可以填写一些自己曾经负责或参与开发的APP或者网站项目。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain4.png")}}" alt=""></div>
                    <div class="modal-body-detail">
                        <p>3. 电竞经历：填写自己平时在玩的一些游戏，选择大概的段位，然后在再细致的备注一下游戏里的具体服务器、游戏ID、KDA等等，这也是招聘的加分项哦。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain5.png")}}" alt=""></div>
                    <div class="modal-body-detail">
                        <p>4. 技能特长：职场上还需要自己一些实用技能，比如会编程、熟悉办公软件、会PS，都是企业很看重的。</p>
                    </div>

                    <div class="modal-img"><img src="{{asset("images/resume_explain6.png")}}" alt=""></div>
                </div>
    </div>
    </div>
    <div class="sales-board @if($data['tab'] == 'tab2') active @endif">
        <div class="sales-board-intro">
        <h2 >关于我们</h2>
        <p>电竞猎人平台创建于2017年，隶属于上海汉竞信息科技有限公司。<br/>
        我们是全国第一家专注电子竞技行业的垂直招聘网站。<br/>电竞及相关企业可以通过电竞猎人平台寻找人才，
        企业之间也能在线上互相寻求合作。电竞行业今非昔比，人才数量的需求以及人才质量的要求都在提高，
        我们目标为电竞行业输入一些优秀的外部人才，也致力于打造电竞行业的线上求职及培训的综合性平台。</p></div>
    </div>
    <div class="sales-board @if($data['tab'] == 'tab3') active @endif">
        <div class="sales-board-intro">
        <h2 >联系我们</h2>
        <p>地址：{{$data['about']->address}}</p>
        <p>邮编：200021</p>
        {{--<p>电话：{{$data['about']->tel}}</p>--}}
        <p>邮箱：{{$data['about']->email}}</p>
        <p>招聘事宜：{{$data['about']->recruit}}</p>
        <p>商务合作：{{$data['about']->cooperation}}</p>
        </div>
    </div>
    <div class="sales-board @if($data['tab'] == 'tab4') active @endif">
        <div class="sales-board-intro">
        <h2 >网站地图</h2>
         <p>地址：{{$data['about']->address}}</p>
        <div class="address-map">
                    <div id="map" style="width:100%; height: 600px;"></div>
                </div></div>
    </div>
    <div class="sales-board @if($data['tab'] == 'tab5') active @endif">
      <div class="sales-board-intro">
        <h2 >免责声明</h2>
        <p>电竞猎人平台文章多来源于网络，转载内容只为传播信息无任何商业目的，若涉及版权或侵权的问题请邮件联系我们，核实后我们将删除 联系我们：QQ 1739250429	 邮箱：kefu@eshunter.com</p></div>
    </div>
  </div>
</div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    <script charset="utf-8" type="text/javascript" src="js/header.js?v=1.00"></script>
    <script>
        $('.product-board ul').on('click', 'li', function(event,index) {
            event.preventDefault();
            /* Act on the event */
            $(event.currentTarget).addClass('active').siblings().removeClass('active')
            var num = $(event.currentTarget).index()
            $('.detail-right .sales-board').eq(num).show().siblings().hide()
        });
    </script>
        <script type="text/javascript"
            src="http://webapi.amap.com/maps?v=1.3&key=e143b33668668e4b9be611be3584b0e7"></script>
    <script>

        map = new AMap.Map('map', {
            resizeEnable: true,
            zoom: 13,
            center: [121.48103,31.260517]
        });

        AMap.plugin(['AMap.ToolBar', 'AMap.Scale'],
            function () {
                map.addControl(new AMap.ToolBar());

                map.addControl(new AMap.Scale());

                map.setStatus({scrollWheel: false});
            });

        marker = new AMap.Marker({
            position: [121.48103,31.260517],
            title: "上海汉竞信息科技有限公司",
            map: map
        });
    </script>
@endsection
