@extends('layout.master')
@section('title', '简历管理')

@section('custom-style')
 <link media="all" href="{{asset('../style/delivery.css?v=2.40')}}" type="text/css" rel="stylesheet">
<style>
     .jieshao_list li {
                width: 31.16%;
                height: 116px;
               
            }
            .my_delivery .d_item {
                text-align: left;
            }
            ul.my_delivery {
                overflow: auto;
            }
            .my_delivery li {
                width: 50%;
                float: left;
            }
        .item_ltitle span{
            font-size: 20px;
            float: left;
        }
        .look-resume-btn {
            float: right;
            padding: 4px 6px;
            margin-right: 16px;
            background-color: #03A9F4;
            color: #fff;
            border: none;
            border-radius: 3px;
        }
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
#delete-all--deliver {
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
.item_ltitle{
    line-height: 41px;
    margin: 30px;
        overflow: hidden;
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
     .material-icons{
         cursor:pointer;
         float: left;
         margin: 1rem;
     }
     .normal-info{
         color: #03A9F4;
     }
     .danger-info {
         color: #F44336;
     }
     .success-info {
         color: #4CAF50;
     }
     .warning-info {
         color: #FF9800;
     }
     .position-empty{
        text-align: center;
        padding: 16px 0;
        font-weight: 300;
        color: #737373;
        font-size: 14px;
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
            <span >简历管理</span>
            <div style="float: right;    margin-right: 32px;">
                 <input type="button" value="清空记录" name="" id="delete-all--deliver">
            </div>
        </div>
        
        <div class="reviews-empty">
            <form id="deliveryForm" class="deliveryAll" style="display: block;">
              <ul class="reset my_delivery">
                  <?php
                  $allnum = 0;
                  $per_page =10;
                  $current_num =0;
                  ?>
                  @forelse($data['deliverAll'] as $apply)
                      <?php
                      $allnum++;
                      $current_num++;
                      ?>
                      <li class="apply-item" name="page<?php echo floor($current_num/$per_page) ?>"
                          @if(floor($current_num/$per_page)==0)
                            style="display: block"
                          @else
                            style="display: none"
                          @endif
                      >
                          <div class="d_item clearfix">
                              <div class="d_job">
                                  <a class="d_job_link">
                                      <em class="d_job_name">{{$apply->position_title}}</em>
                                      <span class="deliver-resume look-resume-btn operations-delete" data-content="{{$apply->did}}">删除</span>
                                      <span class="deliver-resume look-resume-btn check-resume-new" data-content="{{$apply->did}}">查看简历</span>
                                  </a>
                              </div>
                              <div class="d_company">
                                  <img src="{{$apply->photo or asset('images/default-img.png')}}" style="height: 50px;width: 50px;">
                                  <a target="_blank" href="/position/deliverDetail?did={{$apply->did}}">{{$apply->pname}}</a>
                              </div>
                              <div class="d_resume">
                                  <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                          @if($apply->status == 0)
                                              <span class="normal-info">状态：待查看</span>
                                          @elseif($apply->status == 1)
                                              <span class="normal-info">状态：已查看</span>
                                          @elseif($apply->status == 2)
                                              <span class="success-info">状态：已录用</span>
                                          @elseif($apply->status == 3)
                                              <span class="danger-info">状态：未录用</span>
                                          @elseif($apply->status == 4)
                                              <span class="danger-info">状态：职位已下架</span>
                                          @endif
                                  </a>
                                  <span class="d_time">申请时间:{{$apply->created_at}}</span></div>
                          </div>
                      </li>
                  @empty
                      <div class="position-empty">
                          <img src="{{asset('images/desk.png')}}" width="40px">
                          <span>暂无投递记录</span>
                      </div>
                  @endforelse
              </ul>
            </form>
            <nav id="page_tools">
                <ul class="pagination">
                    <?php $pagenum = floor($current_num/$per_page) ?>
                    @if($pagenum >0)
                    <li><span name="page" data-content="0">&laquo;</span></li>
                    @for($i=0;$i<$pagenum;$i++)
                        <li><span name="page" data-content="{{$i}}">{{$i+1}}</span></li>
                    @endfor
                    <li><span name="page" data-content="{{$pagenum}}">&raquo;</span></li>
                    @endif
                </ul>
            </nav>
        </div>
       
    </div>
</div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    <script type="text/javascript">
        $(".check-resume-new").click(function () {
            var did = $(this).attr('data-content');
            window.open("/position/deliverDetail?did="+did);
        });
        $("#delete-all--deliver").click(function () {
            swal({
                title: "确认",
                text: "确定删除所有投递记录吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/position/deldeliverRecord?did=-1",
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/deliverList";
                            }, 1200);
                            swal("删除成功");
                        } else if (data['status'] === 400) {
                            alert(data['msg']);
                        }
                    }

                })
            });
        });

        $(".operations-delete").click(function () {
            var element = $(this);

            swal({
                title: "确认",
                text: "确定删除该条投递记录吗",
                type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                var did = element.attr("data-content");
                $.ajax({
                    url: "/position/deldeliverRecord?did=" + did,
                    type: "get",
                    success: function (data) {
                        if (data['status'] === 200) {
                            setTimeout(function () {
                                self.location = "/position/deliverList";
                            }, 1200);
                            swal("删除成功");
                        } else if (data['status'] === 400) {
                            alert(data['msg']);
                        }
                    }
                })
            });
        });
        $("span[name=page]").click(function () {
            var pagenum = $(this).attr('data-content');
            var page = $(".apply-item");
            var pagename = "li[name=page"+pagenum+"]";
            var curr_page = $(pagename);
            page.css('display','none');
            curr_page.css('display','block');
            $('.pagination').children('.active').removeClass('active');
            $(this).parent().addClass('active');
        });
        function gotopage(pagenum) {
            $(this).addClass('active');
            alert($(this));
            var page = $(".apply-item");
            var pagename = "li[name=page"+pagenum+"]";
            var curr_page = $(pagename);
            page.css('display','none');
            curr_page.css('display','block');
        }
    </script>
@endsection
