@extends('layout.master')
@if($data["type"] == 1)
    @section('title', '个人中心')
    @section('custom-style')
       <link media="all" href="{{asset('style/ResumePreview.css?v=2.40')}}" type="text/css" rel="stylesheet">
       <link media="all" href="{{asset('style/onlineresume.css?v=2.40')}}" type="text/css" rel="stylesheet">
       <link media="all" href="{{asset('style/tao.css')}}" type="text/css" rel="stylesheet">
       <link href="{{asset('style/base.css?v=2.39')}}" type="text/css" rel="stylesheet">
        <link href="{{asset('style/style_qq.css?v=2.33')}}" type="text/css" rel="stylesheet">
        <script src="{{asset('js/')}}" type="text/javascript"></script> 
        <script src="{{asset('js/choose.js?v=2.33')}}" type="text/javascript"></script>
        <script src="{{asset('js/placeholder.js?v=2.32')}}" type="text/javascript"></script>
        <script src="{{asset('js/progressbar.js?v=2.32')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/constants.js?v=2.32')}}" type="text/javascript"></script>
        <script src="{{asset('js/onlineresume.js?v=2.38')}}" charset="utf-8" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/ajaxfileupload.js?v=2.32')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/common.js?v=2.34')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/selectphoto.js?v=2.32')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/jquery.imgareaselect.pack.js')}}" type="text/javascript"></script>
        <script defer="defer" src="{{asset('js/loading.js?v=2.32')}}" type="text/javascript"></script>

        <script defer="defer" src="{{asset('js/center.js?v=2.32')}}" type="text/javascript"></script> 
        <style>
        .containter{    
            width: 1200px;
            margin: 0 auto;
            padding-bottom: 15px;
            margin-top: 36px;
        }
        .jieshao_list li {
            width: 31.77%;
        }
        .position_name {
            min-width: 230px;
        }
        .mdl-card__actions .resume-item p {
            color: #fff;
            text-align: center;
            font-size: 11px;
            margin-top: 7px;
            margin-left: -4px;
            cursor: pointer;
        }
        .mdl-card__actions .resume-item{
            margin:10px auto;
            display: inline-block;
            width: 32%;
        }
        .mdl-card__actions span.myhidden{
            font-size: 20px;
            display: block;
            margin: 10px auto;
            text-align: center;
        }
        .mdl-card__actions{
            /*text-align: center;*/
            color: #fff;
        }
        .resume-bg {
            border-radius: 2px;
            background-color: #03A9F4;
            color: #ffffff;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

            .Resume_con{
                width: auto;
            }
            .Resume_conCenter{
                width: auto !important;
                margin-left: 5rem;
            }
        </style>
    @endsection
    @section('content')
          
        <div style="display:none" class="tishi">
            <span id="tishi_msg"></span>
            <div style="top:5px; right:5px;" class="close_X">X</div>
        </div>
        <div class="hsbj"></div>
        <div style="display:none;" class="whitebg"></div>
        <!--这是加载AJAX的动态转图-->
        <div style="left:50%; float:left; position:fixed; top:50%; z-index:100009; display:none;" id="home_loading">
            <img src="images/anim_loading_75x75.gif">
        </div>
        <div class="containter_box">
            <div class="containter">
                <div class="online_left left">
                    <!-- 个人资料预览 -->
                    <div id="self_info1" class="self_info">
                        <a href="/account/edit?edit=true">
                            <div class="edit_pen" style="display: none;"></div>
                        </a>
                        <div class="Resume_con">
                            <div class="Resume_conLeft">
                                <p class="p_educate">
                                    @if($data['personInfo'][0]->education == 9)
                                        未填写最高学历
                                    @elseif($data['personInfo'][0]->education == 0)
                                        高中
                                    @elseif($data['personInfo'][0]->education == 1)
                                        本科
                                    @elseif($data['personInfo'][0]->education == 2)
                                        研究生及以上
                                    @elseif($data['personInfo'][0]->education == 3)
                                        大专
                                    @endif
                                </p>
                                <p class="p_gzjy">
                                    @if($data['personInfo'][0]->work_year == "" ||$data['personInfo'][0]->work_year == null)
                                        未填写工作经验
                                    @else
                                        {{date('Y')-$data['personInfo'][0]->work_year}}年工作经验
                                    @endif
                                </p>
                                <p class="p_brithday"></p>
                            </div>
                            <div class="Resume_conCenter">
                                <dl>
                                    <dt>
                                        @if($data['personInfo'][0]->photo == null)
                                            <img  src="{{asset('images/default-img.png')}}">
                                        @else
                                            <img src="{{$data['personInfo'][0]->photo}}">
                                        @endif
                                    </dt>
                                    <dd><em>{{$data['personInfo'][0]->pname or "姓名未填写"}}</em><span class="gender @if($data['personInfo'][0]->sex == 1) boy @else woman @endif"></span></dd>
                                </dl>
                            </div>
                            <div class="Resume_conRight">
                                <p class="p_phone phone">{{$data['personInfo'][0]->tel or "手机号未填写"}}</p>
                                <p class="p_emil email"> {{$data['personInfo'][0]->mail or "邮箱未填写"}}</p>
                                <p class="p_now currentstate">{{$data['personInfo'][0]->self_evalu or "自我评价未填写"}}</p>
                            </div>
                        </div>
                    </div>
                  <div class="The_job">
                        <p class="p_Label"><span>为你推荐</span></p>
                        <div class="The_job_con">
                            <ul class="jieshao_list hotjobs" style="display: block;">
                                <?php
                                $index = 0;
                                ?>

                                @foreach($data["recommendPosition"]["position"] as $position)
                                    @if(++$index <= 9)
                                <li>
                                    <div class="jieshao_list_left left">
                                        <div class="list_top">
                                            <div class="clearfix pli_top">
                                                <div class="position_name left">
                                                    <h2 class="dib"><a href="/position/detail?pid={{$position->pid}}">{{mb_substr($position->title,0,9,'utf-8')}}</a></h2>
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
                                                        @foreach(preg_split("/(,| |、)/",$position->tag) as $tag)
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
                                    @endif
                                    @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="online_right right">
                    <div class="wodebiaoqian">
                        <div class="tdfk1">
                            <a class="a1" href="/message"  target="_blank">站内信</a>
                            <a class="a2" href="/position/advanceSearch">查找职位</a>
                            <!--<a href="javascript:void(0);" class="a3" onclick="document.getElementById('f_jianli').click()" class="upload_jianli">上传简历</a>-->
                                <a class="upload_a upload_jianli a3" href="/position/applyList" target="_blank">申请记录</a>
                        </div>
                        <div class="default_send">
                            <!-- <div>默认投递：</div>
                            <div class="seles ">
                                <span class="seles_choose ">请选择</span>
                                <ul class="seles_hide moren default_jianli">
                                    <li v="0">在线简历</li>
                                    <li v="1">附件简历</li>
                                </ul>
                            </div> -->
                        </div>
                        <div class="my_labels my_labelsie">
                        <div class="mdl-card__actions mdl-card--border resume-panel">
                            <span style="" class="myhidden">一般简历</span>
                            @foreach($data['resumeList'] as $resume)
                                <div class="resume-item">
                                    <a target="_blank" href="/resume/add?rid={{$resume->rid}}">
                                        <img src="http://eshunter.com/images/resume.png" width="70px"></a>
                                    <p>{{$resume->resume_name}}</p>
                                </div>
                            @endforeach
                            @if(count($data['resumeList']) < 3)
                                <div class="resume-item">
                                    <a id="add-resume">
                                        <img src="{{asset('images/resume_add.png')}}" width="70px"/></a>
                                    <p>添加简历</p>
                                </div>
                            @endif
                        </div>
                            <!-- <div class="compete_percent"><span style="" class="myhidden">在线简历完整度</span><a class="xz_a" href="/ro/downloadR/335729/profile/黄金/pdf" target="_blank">下载</a><a target="_blank" href="/ro/selfyulan">预览</a></div>
                            <div style="" data-perc="20" class="progressbar myhidden">
                                <div class="bar" style="width: 41px;"><span></span></div>
                                <div class="label">
                                    <div class="perc">20%</div>
                                </div>
                            </div> -->
                        </div>
                        <div class="my_labels my_labelsie">
                            <div class="mdl-card__actions mdl-card--border resume-panel">
                                <span style="" class="myhidden">选手简历</span>
                                @forelse($data['playerResume'] as $resume)
                                    <div class="resume-item">
                                        <a target="_blank" href="/resume/player/add?rid={{$resume->rid}}">
                                            <img src="{{asset('images/resume.png')}}" width="70px"/></a>
                                        <p>{{$resume->resume_name}}</p>
                                    </div>
                                @empty
                                    <div class="resume-item">
                                        <a id="add-player-resume">
                                            <img src="{{asset('images/resume_add.png')}}" width="70px"/></a>
                                        <p>选手简历</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div style="display: none;" class="my_labels">
                            <p>附件简历</p>
                            <div class="scfujianresume">
                                <div class="upload_before">
                                    <input type="file" onchange="javascript:uploadjianli(1);" class="upfile" id="f_jianli" name="f_jianli">
                                    <input type="hidden" value="" class="resume_name">
                                    <a class="jianli" href="javascript:void(0);"></a>
                                    <a class="upload_jianli" onclick="document.getElementById('f_jianli').click()" href="javascript:void(0);">上传简历</a>
                                    <a class="upload_jianli upload_jianliie" href="javascript:void(0);">上传简历</a>
                                    <i style="display:none" class="delete_fujian"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('custom-script')
      <script>
          $('.resume-item').mouseenter(function () {
              $(this).addClass("resume-bg");
          }).mouseleave(function () {
              $(this).removeClass("resume-bg");
          });

          $("#add-resume").click(function () {
              $.ajax({
                  url: "/resume/addResume",
                  type: "get",
                  success: function (data) {
                      if (data['status'] === 200) {
                          self.location = "/resume/add?rid=" + data['rid'];
                      } else if (data['status'] === 400) {
                          alert(data['msg']);
                      }
                  }
              });
          });
          $("#add-player-resume").click(function () {
              $.ajax({
                  url: "/resume/addPlayerResume",
                  type: "get",
                  success: function (data) {
                      if (data['status'] === 200) {
                          self.location = "/resume/player/add?rid=" + data['rid'];
                      } else if (data['status'] === 400) {
                          alert(data['msg']);
                      }
                  }
              });
          });
      </script>
    @endsection
@endif
@if($data["type"] == 2)
    @section('title', '企业中心')
    @section('custom-style')
           <link media="all" href="{{asset('../style/myhome.css')}}" type="text/css" rel="stylesheet">
           <link media="all" href="{{asset('../style/tao.css')}}" type="text/css" rel="stylesheet">
           <link media="all" href="{{asset('../style/delivery.css')}}" type="text/css" rel="stylesheet">
           
            <style>
            .containter{    
                width: 1200px;
                margin: 0 auto;
                padding-bottom: 15px;
                margin-top: 36px;
            }
            #container_left{
                width: 100%;
            }
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
            span.verify-flag {
                width: 150px;
                display: inline-block;
                margin: 2px 8px 2px 16px;
                vertical-align: top;
                cursor: pointer;
                position: relative;
            }

            span.verified {
                color: #4CAF50;
            }

            span.unverified {
                color: #aaaaaa;
            }

            span.verify-flag > i {
                position: absolute;
                top: 4px;

            }

            span.verify-flag > span {
                position: absolute;
                top: 6px;
                left: 24px;
                font-size: 14px;
                font-weight: 400;
            }
            </style>
    @endsection
    @section('content')
        <div class="containter">
            <div class="top_info">
                    <div class="top_info_wrap top_info_content">
                        <img src="{{$data['enterpriseInfo']->elogo}}" alt="公司Logo" width="164" heihgt="164">
                        <div class="company_info">
                            <div class="company_main">
                                <a href="/account/edit" class="edit edit_text" style="margin: 0px 67px 0px 0px;">
                                    <i></i>编辑
                                </a>
                                <h1>
                                    <a href="http://{{str_replace(array('http://','https://'),'',$data['enterpriseInfo']->home_page)}}" class="hovertips" target="_blank" rel="nofollow">
                                        {{$data['enterpriseInfo']->ename}}
                                    </a>
                                </h1>
                                <a href="http://{{str_replace(array('http://','https://'),'',$data['enterpriseInfo']->home_page)}}" class="icon-wrap" target="_blank" rel="nofollow" >
                                    <i></i>
                                </a>
                                <div class="company_word">
                                    <span class="verify-flag
                                        @if($data['enterpriseInfo']->is_verification == 1) verified @endif
                                        @if($data['enterpriseInfo']->is_verification == 0) unverified @endif
                                                ">
                                        <i class="material-icons">verified_user</i>
                                        @if($data['enterpriseInfo']->is_verification === 1)
                                            <span> &nbsp;已认证 </span>
                                        @elseif($data['enterpriseInfo']->is_verification === 0)
                                            <span> 待审核 </span>
                                        @else
                                            <span to="/account/enterpriseVerify/1">点击进行认证 </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="company_data">
                                <ul>
                                    <li>
                                        <strong>
                                            @if($data['enterpriseInfo']->industry == null)
                                                行业未知
                                            @else
                                                @foreach($data['industry'] as $item)
                                                    @if($data['enterpriseInfo']->industry == $item->id)
                                                        {{$item->name}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </strong>
                                    </li>
                                    <li>
                                        <strong>
                                            @if($data['enterpriseInfo']->enature == null || $data['enterpriseInfo']->enature == 0)
                                                企业类型未知
                                            @elseif($data['enterpriseInfo']->enature == 1)
                                                国有企业
                                            @elseif($data['enterpriseInfo']->enature == 2)
                                                民营企业
                                            @elseif($data['enterpriseInfo']->enature == 3)
                                                中外合资企业
                                            @elseif($data['enterpriseInfo']->enature == 4)
                                                外资企业
                                            @elseif($data['enterpriseInfo']->enature == 5)
                                                社会团体
                                            @endif
                                        </strong>
                                    </li>
                                    <li>
                                        <strong>
                                            @if($data['enterpriseInfo']->escale == null)
                                                规模未知
                                            @elseif($data['enterpriseInfo']->escale == 0)
                                                10人以下
                                            @elseif($data['enterpriseInfo']->escale == 1)
                                                10～50人
                                            @elseif($data['enterpriseInfo']->escale == 2)
                                                50～100人
                                            @elseif($data['enterpriseInfo']->escale == 3)
                                                100～500人
                                            @elseif($data['enterpriseInfo']->escale == 4)
                                                500～1000人
                                            @elseif($data['enterpriseInfo']->escale == 5)
                                                1000人以上
                                            @endif
                                        </strong>
                                    </li>
                                    <!-- <li id="mspj" style="cursor:pointer;">
                                        <strong> 暂无</strong>
                                        <br>
                                       
                                    </li>
                                    <li>
                                        <strong>今天</strong><br>
                                       
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div id="company_navs" class="company_navs">
                    <div class="company_navs_wrap">
                        <ul data-pjax="">
                            <li class="li_one current">
                                <a href="javascript:;" class="company_index">公司主页</a>
                            </li>
                            <li class="li_two">
                                <a href="/position/publishList" class="recruit_job">招聘职位（{{$data['positionNum']}}）</a>
                            </li>
                            {{--<li class="li_three">--}}
                                {{--<a href="javascript:;" class="company_ask">公司问答</a>--}}
                                {{--<i class="icon_new"></i>--}}
                            {{--</li>--}}
                        </ul>
                      
                    </div>
                </div>
                <div class="company_navs_shadow"></div>
                <div id="main_container">
                    <div id="container_left">
                        <div id="containerCompanyDetails" class="companyIndex" style="display: block;">
                            <div class="item_container" id="company_products">
                                <div class="item_ltitle">发布的职位</div>
                            
                                <span class="item_ropera item_add disabled add_btn_wrap" to="/position/publish" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_one">新增</span>
                                </span>
                                
                                <div class="item_content item_content_one"  style="display: block;">
                                    <div class="item_empty">
                                        
                                        <div class="The_job_con">
                                            <ul class="jieshao_list hotjobs" style="display: block;">
                                                @foreach($data['positionList'] as $position)
                                                <li>
                                                    <div class="jieshao_list_left left">
                                                        <div class="list_top">
                                                            <div class="clearfix pli_top">
                                                                <div class="position_name left">
                                                                    <h2 class="dib">
                                                                        <a href="/position/detail?pid={{$position->pid}}">
                                                                            {{mb_substr($position->title,0,5)}}
                                                                        </a>
                                                                    </h2>
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
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @if(count($data['positionList']) ==0)
                                            <p class="item_empty_desc">
                                                简洁有趣的职位介绍，能让求职者最快速度了解公司职位任务。把需要的职位展示出来吸引人才围观吧！
                                            </p>
                                            <p class="item_empty_add item_add disabled">
                                                <em class="item_ropeiconp"></em>
                                                <a href="/position/publish">
                                                    <span class="item_ropetext add_product">新增职位发布</span>
                                                </a>
                                            </p>
                                        @else
                                            <div class="more_box">
                                                <a href="/position/publishList" class="list_more">查看全部/修改</a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                               
                            </div>
                            <div class="interview_container item_container" id="interview_container">
                                <div id="interview_anchor"></div>
                                <div class="item_ltitle">收到的申请记录</div>
                                <div class="reviews-empty">
                                    <form id="deliveryForm" class="deliveryAll" style="display: block;">
                                      <ul class="reset my_delivery">
                                          @foreach($data['applyList'] as $apply)
                                            <li to="/position/deliverDetail?did={{$apply->did}}">
                                              <div class="d_item clearfix">
                                                <div class="d_job">
                                                  <a href="/position/deliverDetail?did={{$apply->did}}" class="d_job_link" target="_blank">
                                                    <em class="d_job_name">{{$apply->position_title}}</em>
                                                  </a>
                                                </div>
                                                <div class="d_company">
                                                    <img src="{{$apply->photo}}" style="height: 50px;width: 50px;">
                                                  <a href="/position/deliverDetail?did={{$apply->did}}">{{$apply->pname}}</a>
                                                </div>
                                                <div class="d_resume">
                                                  <a href="javascript:;" class="btn_showprogress delviery_success_btn">
                                                    <span>已接收</span>
                                                    <i class="transform"></i>
                                                  </a>
                                                  <span class="d_time">申请时间:{{$apply->created_at}}</span></div>
                                              </div>
                                            </li>
                                          @endforeach
                                      </ul>
                                      
                                    </form>
                                    @if(count($data['applyList']) ==0)
                                        <span class="empty_icon"></span>
                                        <span class="empty_text">最近没有收到过(未处理)申请记录</span>
                                    @else
                                        <div class="more_box">
                                            <a href="/position/deliverList" class="list_more">
                                                查看全部
                                            </a>
                                        </div>
                                    @endif
                                    
                                </div>
                                
                            </div>
                            <div class="item_container" id="company_intro">
                                <div class="item_ltitle">公司介绍</div>
                                {{--<div class="video_dialog" style="display: none;"> --}}
                                    {{--<video id="my_video" controls="" x5-video-player-type="h5" x5-video-player-fullscreen="true" x5-video-orientation="portraint" playsinline="" preload="auto" x-webkit-airplay="true" webkit-playsinline="true" style="object-fit:fill" src="" poster="">--}}
                                                                {{----}}
                                    {{--</video>--}}
                                {{--</div> --}}
                                {{--<span class="item_ropera disabled" style="display:none;">--}}
                                    {{--<em class="item_ropeiconp item_ropeicone"></em>--}}
                                    {{--<span class="item_ropetext">编辑</span>--}}
                                {{--</span>--}}
                                {{--<span class="item_ropera item_add disabled">--}}
                                    {{--<em class="item_ropeiconp"></em>--}}
                                    {{--<span class="item_ropetext add_two" to="/account/edit">修改</span>--}}
                                {{--</span>--}}
                                
                                <div class="item_content item_content_two" style="display: block;">
                                    <div class="company_intro_text" style="display: block;">
                                        @if($data['enterpriseInfo']->ebrief == "" ||$data['enterpriseInfo']->ebrief == null)
                                            该公司尚未添加公司介绍
                                        @else
                                            {!! $data['enterpriseInfo']->ebrief !!}
                                        @endif
                                    </div>
                                   
                                </div>
                            
                                <div class="item_content_edit_wrap item_content_add_wrap" style="display: none;">
                                    <div class="company_edit_tip">
                                         对公司详尽又生动的图文介绍，是吸引应聘者的最佳利器。
                                    </div>
                                    <span class="item_ropera1 item_ropera_cancel item_ropera1_content" style="display: none;">

                                        <em class="item_ropeiconp item_ropeicons"></em>
                                        <span class="item_ropetext cancel_add_two">取消新增</span>
                                    </span>
                                    
                                </div>
                            </div>

                            {{--<div class="item_container" id="history_container">--}}
                                {{--<div class="item_ltitle">发展历程</div>--}}
                            {{----}}
                                {{--<span class="item_ropera item_add disabled item_add_wrap_three" style="display: block;">--}}
                                    {{--<em class="item_ropeiconp"></em>--}}
                                    {{--<span class="item_ropetext add_three">新增</span>--}}
                                {{--</span>--}}
                                {{----}}
                               {{----}}
                            {{----}}
                                {{--<!-- 展示区域 -->--}}
                                {{--<div class="item_content item_content_three" style="display: block;">--}}
                                        {{--<!-- 空 -->--}}
                                    {{--<div class="item_empty item_add">--}}
                                        {{--<p class="item_empty_desc">--}}
                                            {{--向用户展示公司和产品不断壮大、优秀的过程中的里程碑事件。--}}
                                        {{--</p>--}}
                                        {{--<p class="item_empty_add disabled">--}}
                                            {{--<em class="item_ropeiconp"></em>--}}
                                            {{--<span class="item_ropetext add_process">添加发展历程</span>--}}
                                        {{--</p>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                            {{--</div>--}}

                            {{--<input type="hidden" value="316493" class="companyId">--}}
                            {{--<input type="hidden" value="0" class="totalCount">--}}
                            {{--<input type="hidden" value="true" class="isHide">--}}
                            {{--<input type="hidden" value="false" class="isOpen">--}}
                            {{--<input type="hidden" value="1" class="isupdateState">--}}
                            {{--<div class="address_container item_container" id="location_container">--}}
                                {{--<div class="item_ltitle">公司位置</div>--}}
                            {{----}}
                                {{----}}
                               {{--<!--  <span class="item_ropera   addr_add" style="display: block;">--}}
                                    {{--<em class="item_ropeiconp"></em>--}}
                                    {{--<span class="item_ropetext">新增</span>--}}
                                {{--</span>--}}
                                {{--<span class="item_roper1 dn addr_edit_cancel" style="display: none;">--}}
                                    {{--<em class="item_ropeiconp item_ropeicons"></em>--}}
                                    {{--<span class="item_ropetext">取消编辑</span>--}}
                                {{--</span>--}}
                                {{--<span class="item_ropera1 dn addr_add_cancel">--}}
                                    {{--<em class="item_ropeiconp item_ropeicons"></em>--}}
                                    {{--<span class="item_ropetext">取消新增</span>--}}
                                {{--</span> -->--}}
                                {{----}}
                                {{--<div class="item_content">--}}
                                    {{--<div class="item_con_map amap-container" id="addr_map" style="position: relative; background: rgb(252, 249, 242);">--}}
                                        {{--<img src="../images/map.png"/>--}}
                                    {{--</div>--}}
                                    {{----}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>

                    </div>
                </div>
            </div>
            <div id="cboxOverlay" style="opacity: 0.9; visibility: visible; display: block;"></div>
    @endsection
    @section('custom-script')

        <script type="text/javascript">
            $(document).ready(function(){
                
            });
        </script>
    @endsection
@endif


@section('header-nav')
   @include('components.headerNav',['personInfo'=>$data['username'],'type'=>$data['type'],'uid'=>$data['uid']])
@endsection

@section('header-tab')
   @include('components.headerTab',['activeIndex' => 2,'type' => $data['type']])
@endsection

@section('footer')
   @include('components.myfooter')
@endsection