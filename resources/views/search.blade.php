@extends('layout.master')
@section('title', '搜索结果')

@section('custom-style')
    <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
    <style>
        .jieshao {
     width: 100%; 
     float: unset; }
     .containter h3{
            font-size: 24px;
    padding: 10px 20px;
     }

.topnews { margin: 20px 0; }
.topnews h2 { font-size: 16px; font-weight: bold; line-height: 36px; color: #333; border-bottom: #db6d4c 4px solid; }
.topnews h2 b { }
.topnews h2 span { float: right; font-size: 12px; font-weight: normal; }
.topnews h2 span a { display: inline-block; padding: 0 5px; }
.topnews h2 span a:hover { color: #000 }
.blogs { padding: 30px 0; position: relative; border-bottom: #CCC 1px solid; overflow: hidden }
.blogs h3 { padding-left: 0;;font-size: 16px; font-weight: bold; transition: all .5s; margin-bottom: 10px }
.blogs h3 a { color: #474645; }
.blogs h3 a:hover { color: #066; text-decoration: underline }
.blogs figure { float: left; width: 25%; overflow: hidden; }
.blogs figure img { width: 100%; margin: auto; -moz-transition: all 0.5s; -webkit-transition: all 0.5s; -o-transition: all 0.5s; transition: all 0.5s; }
.blogs figure:hover img { -moz-transform: scale(1.1); -webkit-transform: scale(1.1); -o-transform: scale(1.1); -ms-transform: scale(1.1); }
.blogs ul { float: right; line-height: 22px; width: 72%; color: #756F71; position: relative }
.autor { overflow: hidden; clear: both; margin: 10px 0; display: inline-block; color: #838383; width: 100%; position: absolute; top: 110px; }
.autor span { margin: 0 10px 0 0; }
.autor span a { color: #759b08; }
.autor span a:hover { text-decoration: underline }
.lm { background: url(../images/newsbg01.png) no-repeat left center }
.dtime { background: url(../images/newsbg02.png) no-repeat left center }
.viewnum { background: url(../images/newsbg04.png) no-repeat left center }
.pingl { background: url(../images/newsbg03.png) no-repeat left center }
.tit01 h3 { line-height: 40px; color: #38485A; font-size: 18px; border-bottom: 1px solid #E6E6E6; height: 40px; }
.search-news li:hover{
    box-shadow: none;
}
.search-news li {
    width: 80%;
    padding: 20px;
    height:auto;
    border:none;
    border-bottom: 1px solid #dcdcdc;
}
        .no_result{
            margin-top: 2rem;
        }
    </style>
@endsection
@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection
@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 10,'type' =>0])
@endsection

@section('content')
<div class="containter  ">
    <h3>搜索结果:
        <small style="font-size: smaller">共计 {{count($searchResult['position']) + count($searchResult['news'])}} 个</small>
    </h3>
  <div class="jieshao">
      <form action="/index/search">
          <div class="taoyige">
            <div class="left form_div">
              <input type="text" placeholder="请输入关键词，如：绝地求生" name="keyword" style="height:100%"></div>
          </div>
          <input type="submit" value="搜索" name="" id="chakan">
      </form>
  <!-- 热门搜索 -->
  <div class="taoyige_hotsearch">热门搜索：
      <a href="/index/search?keyword=绝地求生">绝地求生</a>
      <a href="/index/search?keyword=ADC">ADC</a>
      <a href="/index/search?keyword=王者荣耀">王者荣耀</a>
      <a href="/index/search?keyword=打野">打野</a>
      <a href="/index/search?keyword=中单">中单</a>
  </div>
  <!-- 热门搜索 end-->
  <!-- banner 轮播-->
  <div class="">
    <div class="jieshao_tb">
                    <span v="0" class="active">新闻资讯</span>
                    <span v="1">在招职位</span>
                </div>  
                <ul class="jieshao_list hotjobs search-news" style="display: block;">
                    @forelse($searchResult['news'] as $news)
                    <li class="blogs">
                        <figure>
                            @if($news->picture != null)
                                <?php
                                $pics = explode(';', $news->picture);
                                $baseurl = explode('@', $pics[0])[0];
                                $baseurl = substr($baseurl, 0, strlen($baseurl) - 1);
                                $imagepath = explode('@', $pics[0])[1];
                                ?>
                                <img src="{{$baseurl}}{{$imagepath}}">
                            @else
                                <img src="{{asset('images/lamian.jpg')}}"/>
                            @endif
                        </figure>
                        <ul>
                          <h3>
                              <a href="/news/detail?nid={{$news->nid}}">
                                  [{{$news->quote}}] {{mb_substr($news->title,0,30)}}
                              </a>
                          </h3>
                          <p>
                              {{str_replace("</br>","",mb_substr(strip_tags($news->content), 0, 100, 'utf-8'))}}
                          </p>
                          <p class="autor">
                              <span class="lm f_l">
                                  <a href="#">作者: admin</a>
                              </span>
                              <span class="dtime f_l">
                                  发布时间: {{$news->created_at}}
                              </span>
                          </p>
                        </ul>
                    </li>
                    @empty
                        <p class="no_result">未搜索到与"{{$searchResult['keyword']}}"相关的新闻资讯</p>
                    @endforelse
                </ul>
                 <ul class="jieshao_list jobs" style="display: none;">
                     @forelse($searchResult['position'] as $position)
                     <li>
                         <div class="jieshao_list_left left">
                             <div class="list_top">
                                 <div class="clearfix pli_top">
                                     <div class="position_name left">
                                         <h2 class="dib"><a href="/position/detail?pid={{$position->pid}}">{{mb_substr($position->title,0,11,'utf-8')}}</a></h2>
                                         <span class="create_time">&ensp;[{{substr($position->updated_at,0,10)}}]&ensp;</span>
                                     </div>
                                     <span class="salary right">
                                        @if($position->salary <= 0)
                                             月薪面议
                                         @else
                                             {{$position->salary/1000}}k-
                                             @if($position->salary_max ==0) 无上限
                                             @else {{$position->salary_max/1000}}k
                                             @endif
                                             元/月
                                         @endif
                                    </span>
                                 </div>
                                 <div class="position_main_info">
                                    <span>
                                        @if($position->work_nature == 0)
                                            兼职
                                        @elseif($position->work_nature == 1)
                                            实习
                                        @else
                                            全职
                                        @endif
                                    </span>
                                     <span>
                                        @if($position->education == -1)
                                             无学历要求
                                         @elseif($position->education == 0)
                                             高中及以上
                                         @elseif($position->education == 3)
                                             专科及以上
                                         @elseif($position->education == 1)
                                             本科及以上
                                         @elseif($position->education == 2)
                                             研究生及以上
                                         @endif
                                    </span>
                                 </div>
                                 <div class="lebel">
                                     <div class="lebel_item">
                                         @if($position->tag ==="" || $position->tag ===null)
                                             <span class="wordCut">无标签</span>
                                         @else
                                             @foreach(preg_split("/(,| |、|;|，)/",$position->tag) as $tag)
                                                 <span class="wordCut">{{$tag}}</span>
                                             @endforeach
                                         @endif
                                     </div>
                                 </div>
                             </div>

                             <div class="pli_btm">
                                 <a href="/company?eid={{$position->eid}}" class="left">
                                     <img
                                             @if($position->elogo === "" ||$position->elogo === null)
                                             src="../images/pic0.jpg"
                                             @else
                                             src="{{$position->elogo}}"
                                             @endif
                                             alt="公司logo" class="company-logo" width="40" height="40">
                                 </a>
                                 <div class="bottom-right">
                                     <div class="company_name wordCut">
                                         <a href="/company?eid={{$position->eid}}">
                                             @if($position->byname != "")
                                                 {{$position->byname}}
                                             @else
                                                 {{$position->ename}}
                                             @endif
                                         </a>
                                     </div>
                                     <div class="industry wordCut">
                                         <span>{{mb_substr($position->ebrief,0,20,'utf-8')}}</span>
                                         {{--<span>未融资</span>--}}
                                         {{--<span>成都-高新pli-btm</span>--}}
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </li>
                     @empty
                         <p class="no_result">未搜索到与"{{$searchResult['keyword']}}"相关的职位</p>
                     @endforelse
                </ul>
  </div>
  <!-- 轮播end --></div>
</div>
@endsection

@section('footer')
    @include('components.myfooter')
@endsection


@section('custom-script')
   <script>
    $('.jieshao_tb span').click(function() {
                    $(this).addClass('active');
                    $('.jieshao_list').eq($(this).index()).show();
                    $(this).siblings('span').removeClass('active');
                    $('.jieshao_list').eq($(this).index()).siblings('ul').hide();
                    var v = $(this).attr('v');
                })
   </script>
@endsection
