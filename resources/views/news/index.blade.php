@extends('layout.master')
@section('title', '电竞猎人|资讯中心')

@section('custom-style')
   <link media="all" href="{{asset('style/news.css')}}" type="text/css" rel="stylesheet">
   <link media="all" href="{{asset('style/fenyestyle.css?v=2.33')}}" type="text/css" rel="stylesheet">
    <style>
        .news_tab ul li {
            float: left;
            margin-bottom: 0;
            width: 100px;
            height: 46px;
            line-height: 46px;
            text-align: center;
            font-size: 16px;
            color: #08c;
            cursor: pointer;
        }
        .news_tab ul{
            background-color: #fff;
            /*padding-left: 10%;*/
        }
        .news_tab{
            width: 100%;
            height: 46px;
            z-index: 30;
            margin:0;
            position: inherit;
            background-color: #fff;
        }
        .fixed{
            position: fixed;
            top: 0;
        }

        .news_tab .active  a{
            color: #fff!important;
        }
        .news_tab .active {
            background-color: #08c!important;
        }
        nav#page_tools ul li:hover,nav#page_tools ul li.active{
            background-color: #03A9F4;
            color: #fff!important;
        }
        nav#page_tools ul li:hover a{
            color: #fff!important;
        }
        nav#page_tools ul li a,nav#page_tools ul li span{
            display: inline-block;
            padding: 15px;
        }
        nav#page_tools ul li {
            display:inline-block;
            margin-bottom: 0px;
            cursor: pointer;
        }
        nav#page_tools{
            margin: 20px auto;
            text-align: center;
        }
        #page_tools li{
            padding: 0;
        }
    </style>
@endsection


@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 4,'type' => $data['type']])
@endsection

@section('content')
            <div class="containter" style="margin-top: 20px;">
                <div class="news_tab news" id="newsTab">
                  <ul>
                    <li @if(isset($data['newtype']) &&$data['newtype'] == 1)
                        class="active"
                        @endif
                        data-content="1" ><a href="#typography"><i class="icon-chevron-right"></i> 综合电竞</a></li>
                      <li @if(isset($data['newtype']) &&$data['newtype'] == 3)
                          class="active"
                          @endif
                          data-content="3"><a href="#tables"><i class="icon-chevron-right"></i> 赛事资讯</a></li>
                      <li @if(isset($data['newtype']) &&$data['newtype'] == 4)
                          class="active"
                          @endif
                          data-content="4"><a href="#forms"><i class="icon-chevron-right"></i> 游戏快讯</a></li>
                      <li @if(isset($data['newtype']) &&$data['newtype'] == 2)
                          class="active"
                          @endif
                          data-content="2"><a href="#code"><i class="icon-chevron-right"></i>八卦趣闻</a></li>
                      <li @if(isset($data['newtype']) &&$data['newtype'] == 5)
                          class="active"
                          @endif
                          data-content="5"><a href="#buttons"><i class="icon-chevron-right"></i> 职场鸡汤</a></li>
                  </ul>
                </div>
              <div class="news_info_left info_panel left ">
                <div class="mdl_card_title">
                  <h5 class="mdl_card_title_text">最新</h5></div>
                <div class="mdl-card info-card">
                    @foreach($data['newest'] as $news)
                      <div class="news-body" data-content="{{$news->nid}}">
                          @if($news->picture != null)
                              <?php
                              $pics = explode(';', $news->picture);
                              $baseurl = explode('@', $pics[0])[0];
                              $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                              $imagepath = explode('@', $pics[0])[1];
                              ?>
                              <div class="news-aside">
                                  <img src="{{$baseurl}}{{$imagepath}}"/>
                              </div>
                          @else
                              <div class="news-aside">
                                  <img src="{{asset('images/lamian.jpg')}}"/>
                              </div>
                          @endif
                        <div class="news-content">
                          <h3><b>
                            {{mb_substr($news->title, 0, 30)}}</b></h3>
                          <p class="content-body">
                              {{--{{mb_substr(str_replace(array("<br>","<br","<b","&nbsp;", "&nbs"),'', $news->content), 0, 40)}}--}}
                              {{mb_substr(strip_tags($news->content), 0, 70)}}
                          </p>
                          <small class="content-appendix">
                            <span>责任编辑: {{$news->subtitle or 'admin'}}</span>
                            <span>新闻来源:{{$news->quote}}</span>
                            <span>发布时间:{{mb_substr($news->created_at,0,10,'utf-8')}}</span>
                          </small>
                        </div>
                      </div>
                    @endforeach
                      <nav id="page_tools">
                          {!! $data['newest']->appends(['newtype' => $data['newtype']])->render() !!}
                      </nav>
                </div>
              </div>
              <div class="news_info_right info_panel right  ">
                <div class="mdl_card_title">
                  <h5 class="mdl_card_title_text">最热</h5></div>
                <div class="mdl-card info-card">
                    @foreach($data['hottest'] as $news)
                      <div class="hot-news-body" data-content="{{$news->nid}}">
                          @if($news->picture != null)
                              <?php
                              $pics = explode(';', $news->picture);
                              $baseurl = explode('@', $pics[0])[0];
                              $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                              $imagepath = explode('@', $pics[0])[1];
                              ?>
                            <div class="hot-news-aside">
                                <img src="{{$baseurl}}{{$imagepath}}" />
                            </div>
                          @else
                              <div class="news-aside">
                                  <img src="{{asset('images/lamian.jpg')}}"/>
                              </div>
                          @endif
                        <div class="hot-news-content">
                          <h3><b>{{mb_substr($news->title, 0, 8)}}</</h3>
                          <p class="content-body" style="margin-bottom: 0px;">
                              {{--{{mb_substr(str_replace(array("<br>","<br","<b","&nbsp;", "&nbs"),'', $news->content), 0, 35)}}--}}
                              {{mb_substr(strip_tags($news->content), 0, 35)}}
                          </p>
                          <small class="content-appendix">
                            <span>发布时间: {{mb_substr($news->created_at,0,10,'utf-8')}}</span></small>
                        </div>
                      </div>
                    @endforeach
                </div>
              </div>

            </div>
@endsection

@section('footer')
   @include('components.myfooter')
@endsection

@section('custom-script')
    <script>
        $(".news-body").click(function () {
            window.open("/news/detail?nid=" + $(this).attr('data-content'));
        });

        $(".hot-news-body").click(function () {
            window.open("/news/detail?nid=" + $(this).attr('data-content'));
        });
        $('.news_tab ul').on('click', 'li', function(event) {
            event.preventDefault();
            $(this).addClass('active').siblings('li').removeClass('active');
             self.location = "/news?newtype=" + $(this).attr('data-content');
        });
        $(document).ready(function(){
            if (/*document.body.clientWidth < 1400 &&*/ $('.news_tab').offset().top-$(document).scrollTop() <10) {
                $('.news_tab').addClass('fixed');
            }
          $(window).scroll(function() {
            if (/*document.body.clientWidth < 1400 &&*/ $('.news_tab').offset().top-$(document).scrollTop() <10) {
                $('.news_tab').addClass('fixed');
            }
            if (/*document.body.clientWidth < 1400 &&*/ $('.news_tab').offset().top <200) {
                $('.news_tab').removeClass('fixed');
            }
          });
        });
    </script>
@endsection