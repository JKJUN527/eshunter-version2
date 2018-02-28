@extends('layout.master')
@section('title', '公司详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/gsxx.css?v=2.40')}}" type="text/css" rel="stylesheet">
 <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">

@endsection

@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 3,'type' => $data['type']])
@endsection

@section('content')

<div class="containter_box">
    <div style="margin-top: 0; padding-bottom: 0;" class="containter">
            <div class="crumbs">
                <a href="http://eshunter.com">电竞猎人</a><strong>></strong>
                <span>公司信息</span>
            </div>
        <div class="gsxxi_top">
            <div style="margin-right:15px; margin-left:30px;" class="left">
                <div class="gs_logoimg">
                    @if($data['enprinfo']->elogo == null)
                        <img class="left logo" src="{{asset('images/default-img.png')}}">
                    @else
                        <img class="left logo" src="{{$data['enprinfo']->elogo}}">
                    @endif
                </div>
            </div>
            <div class="left gsxxi_con">                
                <div class="jbxx">
                    <div class="dianzan">
                        <span>已有0人认为该公司值得加入</span>
                        <i class="praise "></i>
                    </div>
                    <div style=" width:100%; overflow: hidden;">
                        <h2>{{$data['enprinfo']->byname or "公司别名未填写"}}</h2>
                        <h3>{{$data['enprinfo']->ename or "公司名称未填写"}}</h3>
                    </div>                  
                </div>
                <div style="margin:25px 0 5px;  width:100%; overflow:hidden;">
                    <div class="onetalk">
                        @if($data['enprinfo']->industry == null)
                            行业未知
                        @else
                            @foreach($data['industry'] as $item)
                                @if($data['enprinfo']->industry == $item->id)
                                    {{$item->name}}
                                @endif
                            @endforeach
                        @endif |

                        @if($data['enprinfo']->enature == null || $data['enprinfo']->enature == 0)
                                企业类型未知
                        @elseif($data['enprinfo']->enature == 1)
                                国有企业
                        @elseif($data['enprinfo']->enature == 2)
                                民营企业
                        @elseif($data['enprinfo']->enature == 3)
                                中外合资企业
                        @elseif($data['enprinfo']->enature == 4)
                                外资企业
                        @elseif($data['enprinfo']->enature == 5)
                                社会团体
                        @endif|

                            @if($data['enprinfo']->escale == null)
                                规模未知
                            @elseif($data['enprinfo']->escale == 0)
                                10人以下
                            @elseif($data['enprinfo']->escale == 1)
                                10～50人
                            @elseif($data['enprinfo']->escale == 2)
                                50～100人
                            @elseif($data['enprinfo']->escale == 3)
                                100～500人
                            @elseif($data['enprinfo']->escale == 4)
                                500～1000人
                            @elseif($data['enprinfo']->escale == 5)
                                1000人以上
                            @endif
                    </div>
                </div>
                <div class="welfare">
                    @foreach($data['tag'] as $tag)
                        <label class="c1"><i>
                                @if($tag == '')
                                    暂无标签
                                @else
                                    {{$tag}}
                                @endif
                            </i><em></em></label>
                    @endforeach
               </div>
            </div>
        </div>
        <div class="gsxxi_part">     
            <div class="gsxxi left">
                <!--公司介绍-->
                <div class="company_presentation">
                    <p class="p_Label"><span>公司介绍</span></p>
                    <div class="company_presentation_con">
                        {!! $data['enprinfo']->ebrief or "公司简介暂无" !!}
                    </div>
                </div>
                <!-- 公司实拍 -->
            <!-- 公司实拍 end-->
                <div class="product_presentation">
                </div>              
                <div class="The_job">
                    <p class="p_Label"><span>在招职位</span><font>该公司共发布{!! $data['position']->total() !!}个招聘职位</font></p>
                    <div class="The_job_con">
                        <ul class="jieshao_list hotjobs" style="display: block;">
                            @foreach($data['position'] as $position)
                            <li>
                                <div class="jieshao_list_left left">
                                    <div class="list_top">
                                        <div class="clearfix pli_top">
                                            <div class="position_name left">
                                                <h2 class="dib">
                                                    <a href="/position/detail?pid={{$position->pid}}">
                                                        {{mb_substr($position->title,0,11,'utf-8')}}
                                                    </a>
                                                </h2>
                                                <span class="create_time">[{{substr($position->updated_at,0,10)}}]</span>
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
                                        </div>
                                        <div class="lebel">
                                            <div class="lebel_item">
                                                @if($position->tag ==="" || $position->tag ===null)
                                                    <span class="wordCut">无标签</span>
                                                @else
                                                    @foreach(preg_split("/(,| |、|;)/",$position->tag) as $tag)
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div> 
            <!-- 公司信息 -->
            <!-- <div class="gs_part right">             
                <ul class="company_brief">
                    <p class="p_Label p_Label_pos"><span class="gray">公司信息</span></p> 
                    <li><span class="liwai">城市：</span><em>广州</em></li>
                   
                    <li><span class="liwai">领域：</span><em>移动互联网,社交</em></li>
                    <li><span class="liwai">规模：</span><em class="gsgm" id="gm">少于15人</em></li>
                    <li>
                        <span class="liwai">融资：</span><em>天使轮</em>
                    </li>
                </ul>
            </div> -->
        </div>           
    </div>
</div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    <script defer="defer" type="text/javascript">
var page = 1;
 var page2 = 1;
 var page3 = 1;

//  点赞
    $(function(){
        $('.praise').on('click',function(){
            if($(this).hasClass('active')){
               return;
            }else{
               var param = new Object();
               param.param1 = "16801";
               jQuery.ajax({   
                    type: 'post',   
                    contentType : 'application/json; charset=utf-8',   
                    dataType: 'json',   
                    url:'/ajax/praise.do', 
                    data: JSON.stringify(param),   
                    success: function(data){
                       var praise = "0";
                       if(praise == null || praise == ""){
                          praise = 0;
                       }else{
                          praise = "0";
                       }
                       praise ++;
                       $('.dianzan span').text("已有" +praise+ "人认为该公司值得加入");
                       $('.praise').addClass('active');
                    }
                    
                });
            }
        })
    })
</script>
@endsection
