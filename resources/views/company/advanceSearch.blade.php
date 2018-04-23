@extends('layout.master')
@section('title', '电竞猎人|电竞黄页')

@section('custom-style')
   <link media="all" href="{{asset('style/company.css')}}" type="text/css" rel="stylesheet">
   <link media="all" href="{{asset('style/tao_company.css')}}" type="text/css" rel="stylesheet">
   <link href="{{asset('style/fenyestyle.css?v=2.33')}}" type="text/css" rel="stylesheet">
   <link href="{{asset('style/icon-font/iconfont.css')}}" type="text/css" rel="stylesheet">
   <link media="all" href="{{asset('../style/modal.css')}}" type="text/css" rel="stylesheet">
   <link media="all" href="{{asset('../style/advanceSearch.css')}}" type="text/css" rel="stylesheet">
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
   <style>
       .clear{
           clear: both;
       }
    .companydiv li {
        /*border-bottom: none;*/
            margin-bottom: 16px;
    }
    .containter{
            width: 1080px;
        }
    .companydiv li>div{
        float: left;
    }
    .companydiv li {
        float: left;
            border: 1px solid #dcdcdc;
            margin: 11px 6px;
            width: 96%;
    }
   

    .gsdiv {
        width: 42%;

    }
    #search-company{
        width: 104px;
        overflow: hidden;
        height: 38px;
        float: left;
        -webkit-border-top-right-radius: 4px;
        -moz-border-top-right-radius: 4px;
        border-top-right-radius: 4px;
        -moz-border-bottom-right-radius: 4px;
        -webkit-border-bottom-right-radius: 4px;
        border-bottom-right-radius: 4px;
        line-height: 38px;
        background: #D32F2F;
        border: none;
        color: #fff;
        font-size: 18px;
        font-family: 'Microsoft Yahei';
        cursor: pointer;
    }
    #search-company:hover{
        background: #6F6969;
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
    .gs_rank_item span.active {
      background: none;
      color: #D32F2F;
      font-weight: bold;
    }
    .gsdiv .brif .toujianli{
              /* float: right; */
    padding: 10px 40px;
    /* margin-right: -87px; */
    background-color: #03A9F4;
    color: #fff;
    border: none;
    border-radius: 3px;
    }
    .gs_rank_item {
        padding: 6px 17px;
        background: #919191;
        overflow: hidden;
        font-size: 15px;
    }
    .resume-list {
        width: 100%;
        display: block;
    }

    .resume-item {
        border: 1px solid #ebebeb;
        display: block;
        padding: 8px 16px;
        margin-bottom: 16px;
        -webkit-transition: all 0.4s ease;
        -moz-transition: all 0.4s ease;
        -o-transition: all 0.4s ease;
        transition: all 0.4s ease;
        cursor: pointer;
    }

    .resume-item:hover {
        background-color: #03A9F4;
        color: #ffffff;
    }

    .resume-item p {
        margin: 0;
    }
    .gsdiv .div_s {
               /*height: 64px;*/
    padding: 10px 0;
    }
    #page_tools li{
        padding: 0;
    }
    .major-list li{
        width: 116px;
        height: 92px;
    }
    .major-list li a{
        width: 116px;
        height: 92px;
    }

    .gsdiv .div_s span {
    margin-right: 3px;
    word-break: initial;
    border: 1px solid #ddd;
    padding: 3px 5px;
    border-radius: 3px;
    line-height: 32px;
}
.jieshao_list li:hover{box-shadow: 2px 2px 2px #ebebeb;}
       .region{
           color: #00b38a;
       }

       .pull-right{
           margin-left: 3.4rem;
           /*height: 38px;*/
           background-color: #00b38a;
           border: 1px solid #00b38a;
       }
   </style>
@endsection


@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 5,'type' => $data['type']])
@endsection

@section('content')
            <div class="containter">
                <div style="width:100%; overflow:hidden;">
                    <div style="padding-bottom:0px; float:left;" class="jieshao">
                        <!-- 热门搜索 -->
                        <div class="taoyige">        
                            <div class="left form_div">
                                <input type="text" placeholder="请输入公司名称" value="@if(isset($data['result']['keyword'])){{$data['result']['keyword']}}@endif" id="name" name="name">
                            </div>
                        </div>
                        <input type="button" value="搜索" name="" id="search-company">
                        <a class="btn btn-danger pull-right" href="/company/add/index" target="_blank">提交公司信息</a>
                        <div class="taoyige_hotsearch">热门搜索：
                            <a href="/searchcompany?keyword=电竞教育">电竞教育</a>
                            <a href="/searchcompany?keyword=俱乐部">俱乐部</a>
                            <a href="/searchcompany?keyword=电子竞技协会">电子竞技协会</a>
                        </div>
                        <!-- 热门搜索的链接没有写 -->
                        <div class="searchPart">
                            <form method="get" id="search-form">
                                <input type="hidden" name="industry">
                                <input type="hidden" name="enature">
                                <input type="hidden" name="escale">
                                <input type="hidden" name="keyword">
                            </form>
                            <!-- 公司搜索条件 -->
                            <div class="search_stander">
                                <div class="stander_list">
                                    <span>行业：</span>
                                     <div class="span-holder stander_div3 industry-holder">
	                                    <a rel="nofollow" @if(!isset($data['result']['industry'])) class="active"
                                           @endif data-content="-1">全部</a>
                                         @foreach($data['industry'] as $industry)
                                             <a rel="nofollow" data-content="{{$industry->id}}"
                                                   @if(isset($data['result']['industry']) && $data['result']['industry'] == $industry->id)
                                                   class="active"
                                                     @endif
                                             >{{$industry->name}}</a>
                                         @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="search_stander">
                                <div class="stander_list">
                                    <span>性质：</span>
                                    <div class="span-holder stander_div3 enature-holder">
                                        <a rel="nofollow" @if(!isset($data['result']['enature'])) class="active"
                                           @endif data-content="-1">全部</a>
                                            <a rel="nofollow" data-content="1"
                                                        @if(isset($data['result']['enature']) && $data['result']['enature'] == 1)
                                                        class="active"
                                                @endif
                                        >国有企业</a>
                                        <a rel="nofollow" data-content="2"
                                           @if(isset($data['result']['enature']) && $data['result']['enature'] == 2)
                                           class="active"
                                                @endif
                                        >民营企业</a>
                                        <a rel="nofollow" data-content="3"
                                                    @if(isset($data['result']['enature']) && $data['result']['enature'] == 3)
                                                    class="active"
                                                @endif
                                        >中外合资</a>
                                        <a rel="nofollow" data-content="4"
                                           @if(isset($data['result']['enature']) && $data['result']['enature'] == 4)
                                           class="active"
                                                @endif
                                        >外资企业</a>
                                        <a rel="nofollow" data-content="5"
                                           @if(isset($data['result']['enature']) && $data['result']['enature'] == 5)
                                           class="active"
                                                @endif
                                        >社会团体</a>
                                    </div>
                                </div>
                            </div>
                            <div class="search_stander">
                                <div class="stander_list">
                                    <span>规模：</span>
                                    <div class="span-holder stander_div3 escale-holder">
                                        <a rel="nofollow" @if(!isset($data['result']['escale'])) class="active"
                                           @endif data-content="-1">全部</a>
                                        <a rel="nofollow" data-content="1"
                                           @if(isset($data['result']['escale']) && $data['result']['escale'] == 1)
                                           class="active"
                                                @endif
                                        > > 50</a>
                                        <a rel="nofollow" data-content="2"
                                           @if(isset($data['result']['escale']) && $data['result']['escale'] == 2)
                                           class="active"
                                                @endif
                                        >50~200</a>
                                        <a rel="nofollow" data-content="3"
                                           @if(isset($data['result']['escale']) && $data['result']['escale'] == 3)
                                           class="active"
                                                @endif
                                        >200~500</a>
                                        <a rel="nofollow" data-content="4"
                                           @if(isset($data['result']['escale']) && $data['result']['escale'] == 4)
                                           class="active"
                                                @endif
                                        >500~1000</a>
                                        <a rel="nofollow" data-content="5"
                                           @if(isset($data['result']['escale']) && $data['result']['escale'] == 5)
                                           class="active"
                                                @endif
                                        > < 1000</a>
                                    </div>
                                </div>
                            </div>
                            <!-- 公司搜索条件 end-->
                        </div>
                        <div id="company_list">
                            @if($data['result']['companyinfo']->total() ==0)
                                <div style="display:block" class="company_nojob">
                                    <img alt="" src="../images/ergou.jpg">
                                    <div>暂时没有符合条件的公司信息！</div>
                                </div>
                            @endif
                            <ul class="item_con_list">
                                @foreach($data['result']['companyinfo'] as $company)
                                    {{--@if($company->ename == null && $company->byname == null)--}}
                                        {{--@continue--}}
                                    {{--@endif--}}
                                    <li class="company-item">
                                        <div class="top">
                                            <p>
                                                <a href="/company?eid={{$company->eid}}&type={{$company->type}}&id={{$company->id}}" target="_blank">
                                                    <img src="{{$company->elogo or asset('images/avatar.png')}}" alt="公司logo" width="80" height="80">
                                                </a>
                                            </p>
                                            <p class="company-name wordCut">
                                                <a href="/company?eid={{$company->eid}}&type={{$company->type}}&id={{$company->id}}" target="_blank" title="{{$company->ename}}">
                                                    {{$company->byname or $company->ename}}
                                                </a>
                                            </p>
                                            <p class="indus-stage wordCut">
                                                @foreach($data['industry'] as $industry)
                                                    @if($industry->id == $company->industry)
                                                        {{$industry->name}}/
                                                        @break
                                                    @endif
                                                @endforeach
                                                @if($company->enature == null || $company->enature == 0)
                                                    企业类型未知/
                                                @elseif($company->enature == 1)
                                                    国有企业/
                                                @elseif($company->enature == 2)
                                                    民营企业/
                                                @elseif($company->enature == 3)
                                                    中外合资企业/
                                                @elseif($company->enature == 4)
                                                    外资企业/
                                                @elseif($company->enature == 5)
                                                    社会团体/
                                                @endif

                                                @if($company->escale == null)
                                                    规模未知/
                                                @elseif($company->escale == 0)
                                                    10人以下/
                                                @elseif($company->escale == 1)
                                                    10～50人/
                                                @elseif($company->escale == 2)
                                                    50～100人/
                                                @elseif($company->escale == 3)
                                                    100～500人/
                                                @elseif($company->escale == 4)
                                                    500～1000人/
                                                @elseif($company->escale == 5)
                                                    1000人以上/
                                                @endif
                                            </p>
                                            <p class="advantage wordCut">
                                                {{$company->ebrief}}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                                <div class = "clear"></div>
                            </ul>
                                <nav id="page_tools">
                                    {!! $data['result']['companyinfo']->appends($data['condition'])->render() !!}
                                </nav>
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
    $('#name').keypress(function (event) {
        if(event.which == 13){
            goSearch();
        }
    });
    $('#search-company').click(function (event) {
        event.preventDefault();
        goSearch();
    });

    $(".span-holder").find("a").click(function () {
        var clickedElement = $(this);
        clickedElement.addClass("active");
        clickedElement.siblings().removeClass("active");

        goSearch();
    });

    function goSearch() {
        var industry = $(".industry-holder").find("a.active").attr("data-content");
        var enature = $(".enature-holder").find("a.active").attr("data-content");
        var escale = $(".escale-holder").find("a.active").attr("data-content");
        var search = $("input[name='name']").val();

        if (industry !== "-1")
            $("input[name='industry']").val(industry);
        if (enature !== "-1")
            $("input[name='enature']").val(enature);
        if (escale !== "-1")
            $("input[name='escale']").val(escale);
        if (search !== "")
            $("input[name='keyword']").val(search);

        var $searchForm = $("#search-form");
        $searchForm.action = '/searchcompany';
        $searchForm.submit();
    }
    </script>
@endsection