@extends('layout.master')
@section('title', '电竞猎人|职位搜索')

@section('custom-style')
   <link media="all" href="{{asset('style/tao_company.css')}}" type="text/css" rel="stylesheet">
   <link href="{{asset('style/fenyestyle.css?v=2.33')}}" type="text/css" rel="stylesheet">
   <link href="{{asset('style/icon-font/iconfont.css')}}" type="text/css" rel="stylesheet">
   <link media="all" href="{{asset('../style/modal.css')}}" type="text/css" rel="stylesheet">
 <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
   <style>
    .companydiv li {
        /*border-bottom: none;*/
            margin-bottom: 16px;
    }
    .companydiv li:nth-child(odd) {
        float: left;
            border: 1px solid #dcdcdc;
    }
    .companydiv li:nth-child(even) {
            border: 1px solid #dcdcdc;
            float: right;
    }
    .companydiv li:hover{
        border: 1px solid #D32F2F;
    }
    .gsdiv {
        width: 390px;

    }
    #publish-position{
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
    #publish-position:hover{
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
          float: right;
      padding: 4px 6px;
      margin-top: -26px;
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
        height: 48px;
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
   </style>
@endsection


@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 3,'type' => $data['type']])
@endsection

@section('content')
	
            <div class="containter">
                <div style="width:100%; overflow:hidden;">
                    <div style="padding-bottom:0px; float:left;" class="jieshao">
                        <!-- 热门搜索 -->
                        <div class="taoyige">        
                            <div class="left form_div">
                                <input type="text" placeholder="请输入职位关键字" value="@if(isset($data['result']['keyword'])){{$data['result']['keyword']}}@endif" id="name" name="name">
                            </div>
                        </div>
                        <input type="button" value="搜索" name="" id="publish-position">
                        <!-- 热门搜索的链接没有写 -->
                        <div class="taoyige_hotsearch">热门搜索：<a href="javascript:void(0);">小米</a><a href="javascript:void(0);">同程旅游</a><a href="javascript:void(0);">知聊</a><a href="javascript:void(0);">状元理财</a></div>
                        <div class="tao_change">
                            <div class="gs_rank">
                                <div style="display:block" class="gs_rank_item">
                                    <div>排序：</div>
                                    @if(!isset($data['result']['orderBy']))
                                        <span class="sort-item" data-content="0" id="sort-hotness">热度<i class="material-icons"></i></span>
                                        <span class="sort-item" data-content="0" id="sort-salary">薪水<i class="material-icons"></i></span>
                                        <span class="sort-item active" data-content="1" id="sort-publish-time">发布时间<i class="iconfont icon-paixu-down"></i></span>
                                    @elseif($data['result']['orderBy'] == 0)
                                        @if($data['result']['desc'] == 1)
                                            <span class="sort-item active" data-content="1" id="sort-hotness">热度<i class="iconfont icon-paixu-down"></i></span>
                                        @else
                                            <span class="sort-item active" data-content="2" id="sort-hotness">热度<i class="iconfont icon-paixu"></i></span>
                                        @endif
                                        <span class="sort-item" data-content="0" id="sort-salary">薪水<i
                                                    class="material-icons"></i></span>
                                        <span class="sort-item" data-content="0" id="sort-publish-time">发布时间<i
                                                    class="material-icons"></i></span>
                                    @elseif($data['result']['orderBy'] == 1)
                                        <span class="sort-item" data-content="0" id="sort-hotness">热度<i
                                                    class="material-icons"></i></span>
                                        @if($data['result']['desc'] == 1)
                                            <span class="sort-item active" data-content="1" id="sort-salary">薪水<i class="iconfont icon-paixu-down"></i></span>
                                        @else
                                            <span class="sort-item active" data-content="2" id="sort-salary">薪水<i class="iconfont icon-paixu"></i></span>
                                        @endif
                                        <span class="sort-item" data-content="0" id="sort-publish-time">发布时间<i
                                                    class="material-icons"></i></span>
                                    @elseif($data['result']['orderBy'] == 2)
                                        <span class="sort-item" data-content="0" id="sort-hotness">热度<i
                                                    class="material-icons"></i></span>
                                        <span class="sort-item" data-content="0" id="sort-salary">薪水<i
                                                    class="material-icons"></i></span>

                                        @if($data['result']['desc'] == 1)
                                            <span class="sort-item active" data-content="1" id="sort-publish-time">发布时间<i class="iconfont icon-paixu-down"></i></span>
                                        @else
                                            <span class="sort-item active" data-content="2" id="sort-publish-time">发布时间<i class="iconfont icon-paixu"></i></span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="searchPart">
                            <form method="get" id="search-form">
                                <input type="hidden" name="industry">
                                <input type="hidden" name="region-pro">
                                <input type="hidden" name="region-city">
                                <input type="hidden" name="salary">
                                <input type="hidden" name="work_nature">
                                <input type="hidden" name="keyword">
                                <input type="hidden" name="orderBy">
                                <input type="hidden" name="desc">
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
                                <div class="stander_list">
                                    <span>省份：</span>
                                    <div class="stander_div3 span-holder-region region-province-holder">
                                    	<a rel="nofollow" @if(!isset($data['result']['region-pro'])) class="active"
                                           @endif data-content="-1">全部</a>
                                        @foreach($data['region-pro'] as $province)
                                            <a rel="nofollow" data-content="{{$province->id}}"
                                                  @if(isset($data['result']['region-pro']) && $data['result']['region-pro'] == $province->id)
                                                  class="active"
                                                    @endif
                                            >{{$province->name}}</a>
                                        @endforeach
	                                </div>
                                </div>
                                @foreach($data['region-pro'] as $province)
                                    <div class="stander_list" id="city{{$province->id}}" name="cityid"
                                        @if(isset($data['result']['region-pro']) &&$data['result']['region-pro']==$province->id)
                                        style="display: inline-block">
                                        @else
                                            style="display: none">
                                        @endif
                                        <span>城市：</span>
                                        <div class="stander_div3 span-holder-region region-city{{$province->id}}-holder">
                                            <a rel="nofollow" @if(!isset($data['result']['region-city']))class="active"
                                                @endif data-content="-1">全部</a>
                                                @foreach($data['region-city'] as $city)
                                                    @if($province->id == $city->parent_id)
                                                        <a rel="nofollow" data-content="{{$city->id}}"
                                                            @if(isset($data['result']['region-city']) && $data['result']['region-city'] == $city->id)
                                                            class="active"
                                                                @endif
                                                        >{{$city->name}}</a>
                                                    @endif
                                                @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <div class="stander_list">
                                    <span>薪酬：</span>
                                    <div class="stander_div3 span-holder salary-holder">
                                        @if(!isset($data['result']['salary']))
                                            <a rel="nofollow" class="active" data-content="-1">不限</a>
                                            <a rel="nofollow" data-content="1">3K以下</a>
                                            <a rel="nofollow" data-content="2">3K-5K</a>
                                            <a rel="nofollow" data-content="3">5K-10K</a>
                                            <a rel="nofollow" data-content="4">10K-15K</a>
                                            <a rel="nofollow" data-content="5">15K-20K</a>
                                            <a rel="nofollow" data-content="6">20K-25K</a>
                                            <a rel="nofollow" data-content="7">25K-50K</a>
                                            <a rel="nofollow" data-content="8">50K以上</a>
                                        @else
                                            <a rel="nofollow" data-content="-1">不限</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 1) class="active" @endif data-content="1">3K以下</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 2) class="active" @endif data-content="2">3K-5K</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 3) class="active" @endif data-content="3">5K-10K</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 4) class="active" @endif data-content="4">10K-15K</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 5) class="active" @endif data-content="5">15K-20K</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 6) class="active" @endif data-content="6">20K-25K</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 7) class="active" @endif data-content="7">25K-50K</a>
                                            <a rel="nofollow" @if($data['result']['salary'] == 8) class="active" @endif data-content="8">50K以上</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="stander_list">
                                    <span>类型：</span>
                                    <div class="stander_div3 span-holder type-holder">
                                        @if(!isset($data['result']['work_nature']))
                                            <a rel="nofollow"  class="active" data-content="-1">不限</a>
                                            <a rel="nofollow" data-content="0">兼职</a>
                                            <a rel="nofollow" data-content="1">实习</a>
                                            <a rel="nofollow" data-content="2">全职</a>
                                        @else
                                            <a rel="nofollow" data-content="-1">不限</a>
                                            <a rel="nofollow" @if($data['result']['work_nature'] == 0) class="active" @endif data-content="0">兼职</a>
                                            <a rel="nofollow" @if($data['result']['work_nature'] == 1) class="active" @endif data-content="1">实习</a>
                                            <a rel="nofollow" @if($data['result']['work_nature'] == 2) class="active" @endif data-content="2">全职</a>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>      
                            <!-- 公司搜索条件 end-->
                        </div>
                        <div class="jieshao_list">
                        <!-- 职位改之后 -->
                            @if($data['result']['position']->total() ==0)
                                <div style="display:block" class="company_nojob">
                                    <img alt="" src="../images/ergou.jpg">
                                    <div>暂时没有符合条件的公司信息！</div>
                                </div>
                            @endif
                          <ul class="jieshao_list companydiv">
                            @foreach($data['result']['position'] as $position)
                                <li>
                                  <div class="gsdiv">
                                    <p class="b7">
                                      <a href="/position/detail?pid={{$position->pid}}" target="_blank" class="zw_name">
                                          @if(empty($position->title))
                                              没有填写职位名称
                                          @else
                                              {{mb_substr($position->title, 0, 15, 'utf-8')}}
                                          @endif
                                      </a>
                                        [{{$position->name}}]
                                    </p>
                                      <div class="brif">
                                          <font style="color: #fd5f39;font-size: 15px">
                                              @if($position->salary <= 0)
                                                  月薪面议
                                              @else
                                                  {{$position->salary/1000}}k-
                                                  @if($position->salary_max ==0) 无上限
                                                  @else {{$position->salary_max/1000}}k
                                                  @endif
                                                  元/月
                                              @endif
                                          </font >
                                            <span>|</span>{{mb_substr($position->ebrief, 0, 15, 'utf-8')}}
                                      </div>
                                      <div class="div_s">
                                          @if($position->tag ==="" || $position->tag ===null)
                                              <span>无标签</span>
                                          @else
                                              @foreach(preg_split("/(,| |、)/",$position->tag) as $tag)
                                                  <span>{{$tag}}</span>
                                              @endforeach
                                          @endif
                                      </div>
                                    <div class="brif">
                                        @if($data['type']==0)
                                            <button class="deliver-resume toujianli" to="/account/login">投简历</button>
                                        @elseif($position->position_status==1 ||$position->position_status==4)
                                            <button class="deliver-resume toujianli" data-content="{{$position->pid}}"
                                                    data-toggle="modal" data-target="#chooseResumeModal">投简历</button>
                                        @else
                                            <button class="deliver-resume toujianli">无法投递</button>
                                        @endif
                                    </div>
                                  </div>
                                </li>
                            @endforeach
                          </ul>
                          {{--<div class="Page" id="pagination">--}}
                              <nav id="page_tools">
                                  {!! $data['result']['position']->appends($data['condition'])->render() !!}
                              </nav>
                          {{--</div>--}}
                        </div>
                    </div>
                    <!-- 右边 -->
                    <div style="float:right; height: 730px;" class="all_divclass">
                        <div style="margin-top:0px" class="banner_con"> 
                            <div class="num_part"><span>热招企业</span></div>
                            <ul id="hotCompanyList" class="slides major-list">
                                @foreach($data['hot-ad-company'] as $company)
                                    <li class="major-item">
                                        <a href="/company?eid={{$company->eid}}" target="_blank">
                                            <span style="background: rgba(0, 0, 0, 0) url(&quot;{{$company->picture or asset('images/house.jpg')}}&quot;) no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 90px;" class="tongyong_loge">
                                            </span>
                                            <span class="back-face">
                                                <h2>{{$company->title}}</h2>
                                                <div>{{$company->content}}</div>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                        </div>
                        {{--<a target="_blank" href="http://old.ui.cn/joblist.php"><img style="margin-top:20px;" src="../images/UIchina.jpg"></a>--}}
                    </div>   
                </div>
                
            </div>

            <!-- 模态框（Modal） -->
<div class="modal fade" id="chooseResumeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    选择简历
                </h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                </button>
                {{--<button type="button" class="btn btn-primary">--}}
                    {{--提交更改--}}
                {{--</button>--}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
@endsection

@section('footer')
   @include('components.myfooter')
   @include('components.wheelmenu')
@endsection

@section('custom-script')
<script type="text/javascript">
    var sortHotness = $("#sort-hotness");
    var sortSalary = $("#sort-salary");
    var sortTime = $("#sort-publish-time");

    function resetSort() {
        sortHotness.attr('data-content', 0);
        sortSalary.attr('data-content', 0);
        sortTime.attr('data-content', 0);

        sortHotness.find("i").attr("class","material-icons");
        sortSalary.find("i").attr("class","material-icons");
        sortTime.find("i").attr("class","material-icons");

        sortHotness.removeClass("active");
        sortSalary.removeClass("active");
        sortTime.removeClass("active");
    }


    $(".sort-item").click(function () {

        if ($(this).attr('data-content') === '0') {
            resetSort();
            $(this).attr('data-content', 1);
            $(this).find('i').attr("class","iconfont icon-paixu-down");
            if (!$(this).hasClass('active'))
                $(this).addClass('active');
        } else if ($(this).attr('data-content') === '1') {
            resetSort();
            $(this).attr('data-content', 2);
            $(this).find('i').attr("class","iconfont icon-paixu");
            if (!$(this).hasClass('active'))
                $(this).addClass('active');
        } else if ($(this).attr('data-content') === '2') {
            resetSort();
            $(this).attr('data-content', 1);
            $(this).find('i').attr("class","iconfont icon-paixu-down");
            if (!$(this).hasClass('active'))
                $(this).addClass('active');
        }

        goSearch();
    });

    $('#publish-position').click(function (event) {
        event.preventDefault();
        goSearch();
    });

    $(".span-holder").find("a").click(function () {
        var clickedElement = $(this);
        clickedElement.addClass("active");
        clickedElement.siblings().removeClass("active");

        goSearch();
    });
    $(".span-holder-region").find("a").click(function () {
        var clickedElement = $(this);
        clickedElement.addClass("active");
        clickedElement.siblings().removeClass("active");
        var cityid = "city"+$(".region-province-holder").find("a.active").attr("data-content");

        $("div[name='cityid']").css('display','none');
        $("#"+cityid).css('display','inline-block');
        goSearch();
    });
    function goSearch() {
        var industry = $(".industry-holder").find("a.active").attr("data-content");
        var region_pro = $(".region-province-holder").find("a.active").attr("data-content");
        var cityid = "region-city"+region_pro+"-holder";
        var region_city = $("."+cityid).find("a.active").attr("data-content");
        var salary = $(".salary-holder").find("a.active").attr("data-content");
        var type = $(".type-holder").find("a.active").attr("data-content");
        var search = $("input[name='name']").val();

//            console.log(industry);
//            return;

        if (industry !== "-1")
            $("input[name='industry']").val(industry);
        if (region_pro !== "-1")
            $("input[name='region-pro']").val(region_pro);
        if (region_city !== "-1")
            $("input[name='region-city']").val(region_city);
        if (salary !== "-1")
            $("input[name='salary']").val(salary);
        if (type !== "-1")
            $("input[name='work_nature']").val(type);
        if (search !== "")
            $("input[name='keyword']").val(search);

        if (sortHotness.attr('data-content') !== '0') {
            $("input[name='orderBy']").val(0);
            $("input[name='desc']").val(sortHotness.attr("data-content"));
        }

        if (sortSalary.attr('data-content') !== '0') {
            $("input[name='orderBy']").val(1);
            $("input[name='desc']").val(sortSalary.attr("data-content"));
        }

        if (sortTime.attr('data-content') !== '0') {
            $("input[name='orderBy']").val(2);
            $("input[name='desc']").val(sortTime.attr("data-content"));
        }

        var $searchForm = $("#search-form");
        $searchForm.action = '/position/advanceSearch';
        $searchForm.submit();
    }
        $(".deliver-resume").click(function () {

            var $pid = $(this).attr("data-content");

            $.ajax({
                url: "/resume/getResumeList",
                type: "get",
                success: function (data) {

                    var html = "<ul class='resume-list'>";
                    if (data.length === 0) {
                        html = "<button onclick='addResume()' " +
                            "class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky'>" +
                            "没有简历，点击添加 </button>"
                    } else {
                        for (var item in data) {

                            var resumeName = data[item]['resume_name'] === null ? "未命名的简历" : data[item]['resume_name'];
                            html += "<li class='resume-item' data-content='" + data[item]['rid'] + "' onclick='resumeChosen(this, " + $pid + ")'>" +
                                "<p>" + resumeName + "</p>" +
                                "</li>";
                        }

                        html += "</ul>";
                    }

                    $(".modal-body").html(html);
                }
            })
        });

        function resumeChosen(element, pid) {
            $("#chooseResumeModal").modal('hide');

            var rid = $(element).attr("data-content");

            var formData = new FormData();
            formData.append('rid', rid);
            formData.append('pid', pid);

            $.ajax({
                url: "/delivered/add",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    console.log(result);
                    if(result.status === 200){
                        swal("","简历投递成功！","success");
                        return;
                    }else{
                        swal("",result.msg,"error");
                        return;
                    }
                }
            })

        }

        function addResume() {
            $.ajax({
                url: "/resume/addResume",
                type: "get",
                success: function (data) {
//                    console.log(data);
                    if (data['status'] === 200) {
                        self.location = "/resume/add?rid=" + data['rid'];
                    } else if (data['status'] === 400) {
//                        swal("",data['msg'],"error");
                        swal("",data['msg'],"error");
                        return;
//                        checkResult(data['status'], "", data['msg'], null);
                    }
                }
            });
        }
    </script>
@endsection