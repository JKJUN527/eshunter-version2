@extends('layout.master')
@section('title', '已发布的职位')

@section('custom-style')
 <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
<style>
.taoyige {
    width: 300px;
    display: inline-block;
    float: left;
    border: 1px solid #D32F2F;
    border-right: 0px;
}
.form_div {
    height: 36px;
    overflow: hidden;
    width: 508px;
}
.taoyige input[type='text'] {
    width: 480px;
    overflow: hidden;
    border: none;
    color: #5e5e5e;
    font-size: 16px;
    font-family: 'Microsoft YaHei';
    height: 100%;
    text-indent: 13px;
    float: left;
}
#publish-position {
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
     .jieshao_list li {
    width: 31.16%;
    height: 130px;
}
.item_ltitle span{
            font-size: 20px;
            float: left;
        }
        .item_ltitle{
    line-height: 41px;
    margin: 30px;
}   
.item_container{
    width: 90%;
    margin: 0 auto;
}
    .lebel .lebel_option span{
        display: inline-block;
        width: 30px;
        height: 20px;
        padding: 0 5px;
        font-size: 12px;
        line-height: 20px;
        color: #999;
        border: 1px solid #ddd;
        border-radius: 3px;
        text-align: center;
        background-color: #add8e6;
    }
    .lebel .lebel_option span:hover{
        border: 1px solid #D32F2F;
    }
    .option{
        cursor:pointer;
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
    .position-empty{
        text-align: center;
        padding: 16px 0;
        font-weight: 300;
        color: #737373;
        font-size: 14px;
    }
    .material-icons{
        cursor:pointer;
        float: left;
        margin: 1rem;
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
<div class="containter">
    <div class="interview_container item_container" id="interview_container">
        <div id="interview_anchor"></div>
        <div class="item_ltitle">
            <i class="material-icons" to="/account">arrow_back</i>
            <span >已发布职位</span>
            <div style="float: right;    margin-right: 32px;">
                <form method="get" id="search-form" action="/position/publishList/search">
                <div class="taoyige">
                    <div class="left form_div">
                        <input type="text" placeholder="输入职位名称／描述进行搜索" id="keyword" name="keyword">
                    </div>
                </div>
                <input type="submit" value="搜索" name="" id="publish-position" />
                </form>
            </div>
        </div>
        <div class="item_container" id="company_products">
            <div class="item_content item_content_one"  style="display: block;">
                <div class="item_empty">
                    <div class="The_job_con">
                        <ul class="jieshao_list hotjobs" style="display: block;">
                            @forelse($data['position'] as $position)
                            <li>
                                <div class="jieshao_list_left left">
                                    <div class="list_top">
                                        <div class="clearfix pli_top">
                                            <div class="position_name left">
                                                <h2 class="dib">
                                                    <a href="/position/detail?pid={{$position->pid}}">
                                                        @if($position->title == null || $position->title == "")
                                                            未命名职位
                                                        @else
                                                            {{mb_substr($position->title,0,8,'utf-8')}}
                                                        @endif
                                                    </a>
                                                </h2>
                                                <span class="create_time">&ensp;[{{substr($position->updated_at,0,10)}}]&ensp;</span>
                                            </div>
                                            <span class="salary right">
                                                 @if($position->salary == -1)
                                                    工资面议
                                                 @else
                                                    {{$position->salary/1000}}K-
                                                    @if($position->salary_max == -1)
                                                        无上限
                                                    @else
                                                        {{$position->salary_max/1000}}K
                                                    @endif
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
                                            <span class="salary right">
                                                申请人数:{{$data["dcount"][$position->pid]}}
                                            </span>
                                        </div>
                                        <div class="lebel">
                                            <div class="lebel_item" style="width: 100%;">
                                                @if($position->tag ==="" || $position->tag ===null)
                                                    <span class="wordCut">无标签</span>
                                                @else
                                                    @foreach(preg_split("/(,| |、|;|，)/",$position->tag) as $tag)
                                                        <span class="wordCut">{{$tag}}</span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="lebel">
                                            <div class="lebel_option">
                                                <span  class="wordCut option del-operate" data-content="{{$position->pid}}">删除</span>
                                                <span  class="wordCut option offline-operate" data-content="{{$position->pid}}">下架</span>
                                                <span  class="wordCut option refresh-operate" data-content="{{$position->pid}}">刷新</span>
                                                @if($position->position_status ==2)
                                                    <span class="wordCut option online-operate" data-content="{{$position->pid}}">上线</span>
                                                @endif
                                                <span class="wordCut option edit-operate" data-content="{{$position->pid}}">修改</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @empty
                                <div class="position-empty">
                                    <img src="{{asset('images/desk.png')}}" width="40px">
                                    <span>&nbsp;&nbsp;没有搜索到相关职位</span>
                                </div>
                            @endforelse
                        </ul>
                        <nav id="page_tools">
                            {!! $data['position']->render() !!}
                        </nav>
                    </div>
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
            $(".del-operate").click(function () {
                var id = $(this).attr("data-content");

                if (id === null || id === "") {
                    return;
                }

                swal({
                    title: "确认",
                    text: "确定删除该职位吗",
                    type: "info",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: "/position/publishList/delete?pid=" + id,
                        type: "get",
                        success: function (data) {
                            if (data['status'] === 200) {
                                setTimeout(function () {
                                    self.location = "/position/publishList";
                                }, 1200);
                                swal({
                                    type: "success",
                                    title: "删除成功"
                                });
                            } else if (data['status'] === 400) {
                                swal({
                                    type: "error",
                                    title: "删除失败"
                                })
                            }
                        }
                    })
                });
            });
            $(".online-operate").click(function () {
                var id = $(this).attr("data-content");

                if (id === null || id === "") {
                    return;
                }

                swal({
                    title: "确认",
                    text: "确定重新上线该职位？",
                    type: "info",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: "/position/publishList/online?pid=" + id,
                        type: "get",
                        success: function (data) {
                            if (data['status'] === 200) {
                                setTimeout(function () {
                                    self.location = "/position/publishList";
                                }, 1200);
                                swal({
                                    type: "success",
                                    title: "上线成功"
                                });
                            } else if (data['status'] === 400) {
                                swal({
                                    type: "error",
                                    title: "上线失败！请重试"
                                })
                            }
                        }
                    })
                });
            });
            $(".offline-operate").click(function () {
                var id = $(this).attr("data-content");

                if (id === null || id === "") {
                    return;
                }

                swal({
                    title: "确认",
                    text: "确定下架该职位？职位将不会再收到投递",
                    type: "info",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: "/position/publishList/offline?pid=" + id,
                        type: "get",
                        success: function (data) {
                            if (data['status'] === 200) {
                                setTimeout(function () {
                                    self.location = "/position/publishList";
                                }, 1200);
                                swal({
                                    type: "success",
                                    title: "下架成功"
                                });
                            } else if (data['status'] === 400) {
                                swal({
                                    type: "error",
                                    title: "下架失败！请重试"
                                })
                            }
                        }
                    })
                });
            });
            $(".refresh-operate").click(function () {
                var id = $(this).attr("data-content");

                if (id === null || id === "") {
                    return;
                }
                var formData = new FormData();
                formData.append("pid", id);

                swal({
                    title: "确认",
                    text: "确定刷新该职位？职位将重新发布",
                    type: "info",
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    showCancelButton: true,
                    closeOnConfirm: false
                }, function () {
                    $.ajax({
                        url: "/position/publishList/refresh",
                        type: "post",
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            var result = JSON.parse(data);
                            if (result.status === 200) {
                                setTimeout(function () {
                                    self.location = "/position/publishList";
                                }, 1200);
                                swal({
                                    type: "success",
                                    title: "刷新成功"
                                });
                            } else if (result.status === 400) {
                                swal({
                                    type: "error",
                                    title: "刷新失败！请重试"
                                })
                            }
                        }
                    })
                });
            });
            $(".edit-operate").click(function () {
                var id = $(this).attr("data-content");

                if (id === null || id === "") {
                    return;
                }
                self.location = "/position/publishList/edit?pid="+id;
            });
    </script>
@endsection
