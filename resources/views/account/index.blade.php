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
    font-size: 15px;
    margin-top: 7px;
    margin-left: -10px;
    cursor: pointer;
}
        .mdl-card__actions .resume-item{
            margin:10px auto;
            display: inline-block;
            width: 49%;
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
                <a href="/account/edit">
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
                    <span style="" class="myhidden">我的简历</span>
                    @foreach($data['resumeList'] as $resume)
                        <div class="resume-item">
                            <a to="/resume/add?rid={{$resume->rid}}">
                                <img src="http://eshunter.com/images/resume.png" width="100px"></a>
                            <p>{{$resume->resume_name}}</p>
                        </div>
                    @endforeach
                    @if(count($data['resumeList']) < 3)
                        <div class="resume-item">
                            <a id="add-resume">
                                <img src="{{asset('images/resume_add.png')}}" width="100px"/></a>
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
      </script>
    @endsection
@endif
@if($data["type"] == 2)
    @section('title', '企业中心')
    @section('custom-style')
           <link media="all" href="{{asset('../style/myhome.css')}}" type="text/css" rel="stylesheet">
           
            <style>
            .containter{    
                width: 1200px;
                margin: 0 auto;
                padding-bottom: 15px;
                margin-top: 36px;
            }
            </style>
    @endsection
    @section('content')
        <div class="containter">
            <div class="top_info">
                    <div class="top_info_wrap top_info_content">
                        <img src="../images/1.gif" alt="公司Logo" width="164" heihgt="164">
                        <div class="company_info">
                            <div class="company_main">
                                <a href="javascript:;" class="edit edit_text" style="margin: 0px 67px 0px 0px;">
                                    <i></i>编辑
                                </a>
                                <h1>
                                    <a href="myhome.html" class="hovertips" target="_blank" rel="nofollow">
                                        店小二餐饮连锁公司
                                    </a>
                                </h1>
                                <a href="myhome.html" class="icon-wrap" target="_blank" rel="nofollow" >
                                    <i></i>
                                </a>
                                <div class="company_word">
                                        
                                </div>
                            </div>
                            <div class="company_data">
                                <ul>
                                    <li>
                                        <strong>暂无</strong>
                                        <br>
                                        <span class="tipsys" original-title="该公司的在招职位数量">
                                            <span>招聘职位</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <strong>暂无</strong>
                                        <span class="tipsys" original-title="该公司7日内处理简历数占收取简历数比例">
                                            <span>简历及时处理率</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <strong>暂无</strong>
                                        <br>
                                        <span class="tipsys" original-title="该公司7日内从简历收取到最终处理的平均用时">
                                            <span>简历处理用时</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li id="mspj" style="cursor:pointer;">
                                        <strong> 暂无</strong>
                                        <br>
                                        <span class="tipsys" original-title="该公司收到的面试评价数量">
                                            <span>面试评价</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                    <li>
                                        <strong>今天</strong><br>
                                        <span class="tipsys" original-title="该公司职位管理者最近一次登录时间">
                                            <span>企业最近登录</span>
                                            <span class="tip"></span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="top_info_wrap_edit dn top_info_edit" style="display: none;">
                        <form id="topInfoForm" action="javascript:;" method="post" novalidate="novalidate">
                            <div class="company_logo_edit">
                                <img src="../images/1.gif">
                                <div class="upload_shadow"></div>
                                <div class="upload_text">
                                    <i></i>
                                    <span>
                                        上传LOGO请小于10M
                                        <br>
                                        尺寸：170px*170px
                                    </span>
                                </div>
                                <label>
                                    <input type="file" id="logoUpload" name="filePic">
                                </label>
                            </div>

                            <div class="company_info_edit">
                                <a href="javascript:;" class="cancel_edit cancel_info_edit">
                                    <i></i>
                                    取消编辑
                                </a>
                                <h1> 店小二餐饮连锁公司</h1>
                            
                            
                                <label>
                                    <span class="redstar">*</span>
                                    <input type="text" class="companyUrl" name="companyUrl" value="" placeholder="请输入公司网站" autocomplete="off">
                                </label>
                            
                                <input type="hidden" class="companyName" name="companyName" value="店小二">
                                <div class="longname"><span>店小二</span><span class="tips">（修改公司全称或简称，请发送邮件至gogo@lagou.com）</span>
                                    <a class="tips_link" href="#" target="_blank">
                                        <i class="icon-glyph-question"></i> 
                                        如何发送</a>
                                </div>
                            
                                <label class="edit_wrap">
                                    <span class="redstar">*</span>
                                    <input type="text" class="edit_area long companyIntroduce " name="companyIntroduce" value="" placeholder="一句话概括公司亮点，如：公司愿景、领导团队等" autocomplete="off">
                                    <span class="red numtip">(0/50)</span>
                                </label>
                            
                                <input type="submit" value="保存" class="save">
                                <a href="javascript:;" class="cancel cancel_top_btn">取消</a>
                                <div class="clearfix"><span class="error topinfo_all" style="display:none;"></span></div>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="company_navs" class="company_navs">
                    <div class="company_navs_wrap">
                        <ul data-pjax="">
                            <li class="li_one current">
                                <a href="javascript:;" class="company_index">公司主页</a>
                            </li>
                            <li class="li_two">
                                <a href="javascript:;" class="recruit_job">招聘职位（0）</a>
                            </li>
                            <li class="li_three">
                                <a href="javascript:;" class="company_ask">公司问答</a>
                                <i class="icon_new"></i>
                            </li>
                        </ul>
                        <div class="company_share">
                            <span>分享</span>
                            <a href="javascript:;" class="share_weibo" rel="nofollow" title="分享到微博" ></a>
                            <a href="javascript:;" class="share_weixin" rel="nofollow" title="分享到微信" ></a>
                            <a href="javascript:;" class="share_rountline" rel="nofollow" title="微信扫一扫，用小程序打开分享" ></a>
                            <div class="share_weixin_success" id="companyQrcode">
                                <!-- <img alt="移动端公司主页二维码" /> -->
                                <div class="qrcode_box">
                                <canvas width="120" height="120"></canvas></div>
                            </div>
                
                             <div class="share_rountline_success" id="companyRountLineQrcode">
                                <!-- <img alt="移动端公司主页二维码" /> -->
                                <div class="rountline_qrcode_box">
                                    <img src="" width="130" height="130">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="company_navs_shadow"></div>
                <div id="main_container">
                    <div id="container_left">
                        <div id="containerCompanyDetails" class="companyIndex" style="display: block;">
                            <div class="item_container" id="company_products">
                                <div class="item_ltitle">公司产品</div>
                            
                                <span class="item_ropera item_add disabled add_btn_wrap" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_one">新增</span>
                                </span>
                                
                                <div class="item_content item_content_one"  style="display: block;">
                                    <div class="item_empty">
                                        <p class="item_empty_desc">
                                            简洁有趣的产品介绍，能让用户最快速度了解公司业务。把自家优秀的产品展示出来吸引人才围观吧！
                                        </p>
                                        <p class="item_empty_add item_add disabled">
                                            <em class="item_ropeiconp"></em>
                                            <span class="item_ropetext add_product">添加公司产品</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="item_content item_content_one_edit" style="display: none;">
                                    <div class="item_content_edit_wrap product_item">
                                    <div class="product_edit_tip">
                                        简洁有趣的产品介绍，能让应聘者以最快的速度了解公司业务。
                                    </div>
                                    <span class="item_ropera1 item_ropera_cancel item_cancel_add" style="display: none;">
                                        <em class="item_ropeiconp item_ropeicons"></em>
                                        <span class="item_ropetext cancel_add_one">取消新增</span>
                                    </span>
                                    <div class="item_content_edit">
                                        <form id="productForm" data-id="" action="javascript:;" method="post" novalidate="novalidate">
                                            <div class="upload_product_img">
                                                
                                                    <img src="../images/product_default_1021398.png" alt="产品图片">
                                                
                                                <div class="shadow"></div>
                                                <div class="text">
                                                    <i></i><span>更换产品图片 小于10MB<br>尺寸：300px*180px</span>
                                                </div>
                                                <label>
                                                    <input type="file" id="productUpload" name="filePic">
                                                </label>
                                        </div>
                                            <div class="product_form">
                                                <label>
                                                    <span class="redstar">*</span>
                                                    <input type="text" name="productName" class="productName" value="" autocomplete="off" placeholder="请输入产品名称">
                                                </label>
                                                <label>
                                                    <span class="redstar">*</span>
                                                    <ul class="checktypes">
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="网站" style="display: none;"><span class="no_select lgCheckBox"><em></em>网站</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="客户端" style="display: none;"><span class="no_select lgCheckBox"><em></em>客户端</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="移动app" style="display: none;"><span class="no_select lgCheckBox"><em></em>移动app</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="硬件" style="display: none;"><span class="no_select lgCheckBox"><em></em>硬件</span>
                                                            </li>
                                                        
                                                            <li>
                                                                <input type="checkbox" name="productType" class="checkbox" value="其他" style="display: none;"><span class="no_select lgCheckBox"><em></em>其他</span>
                                                            </li>
                                                        
                                                    </ul>
                                                    <span id="productType-error" class="error" style="display: none;">请选择产品类型</span>
                                                </label>
                                                <label>
                                                    <input type="text" name="productUrl" class="productUrl" value="" autocomplete="off" placeholder="请输入产品主页或产品下载地址">
                                                </label>
                                                <label>
                                                    <div class="edui-container" style="width: 345px; z-index: 999;">
                                                    </div>
                                                    <span class="wordcount">还可输入<b>200</b>字</span>
                                                </label>
                                                <span class="error products_all" style="display:none;"></span>
                                                <input type="submit" value="保存" class="save">
                                                <a href="javascript:;" class="cancel cancel_btn_one">取消</a>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                            <div class="item_container" id="company_intro">
                                <div class="item_ltitle">公司介绍</div>
                                <div class="video_dialog" style="display: none;"> 
                                        <video id="my_video" controls="" x5-video-player-type="h5" x5-video-player-fullscreen="true" x5-video-orientation="portraint" playsinline="" preload="auto" x-webkit-airplay="true" webkit-playsinline="true" style="object-fit:fill" src="" poster="">
                                                                
                                        </video>
                                </div> 
                                <span class="item_ropera disabled" style="display:none;">
                                    <em class="item_ropeiconp item_ropeicone"></em>
                                    <span class="item_ropetext">编辑</span>
                                </span>
                                <span class="item_ropera item_add disabled">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_two" >新增</span>
                                </span>
                                
                                <div class="item_content item_content_two" style="display: block;">
                                    <div class="company_intro_text" style="display: block;">该公司尚未添加公司介绍<br></div>
                                    <div class="company_image_gallery">
                                                    <div class="item_empty">
                                            <p class="item_empty_desc">
                                                添加公司环境、员工照片，给用户展示更生动的公司全貌。
                                            </p>
                                            <p class="item_empty_add disabled">
                                                <em class="item_ropeiconp"></em>
                                                <span class="item_ropetext add_image">添加公司照片</span>
                                            </p>
                                        </div>
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
                                    <div class="item_content_edit item_content_edit_two" style="display: none;">
                                        <form id="introForm" action="javascript:;" method="post" novalidate="novalidate">
                                            <label>
                                                <div class="edui-container" style="width: 676px; z-index: 999;"></div>
                                                <span class="wordcount">还可输入<b>1000</b>字</span>
                                            </label>
                                            <div class="company_images_count">最多可上传10张照片，已上传 <span>(<i>0</i>/10)</span></div>
                                            <ul class="company_images_wrap">
                                                <li data-id="" data-position="0">
                                                    <em>封面</em>
                                                    <img src="../images/0079FDcTtGCpom0U.jpg" width="330" height="234" style="width: 160px; height: 160px;">
                                                    <div class="img_opt">
                                                        <span class="set_default disabled">设置为封面</span> | 
                                                        <span class="img_del cmp_delete" style="position: relative;">
                                                            删除
                                                            <div class="mr_delete_pop" style="display: none; position: absolute;">
                                                                <p>确定删除这张图片？</p>
                                                                <div class="del_content">
                                                                    <span class="mr_del_ok">删除</span>
                                                                    <span class="mr_del_cancel mr_del">取消</span>
                                                                </div>
                                                            </div>
                                                        </span>
                                                    </div>

                                                </li>
                                    
                                                <li data-upload="1" class="uploadimg  img_upload">
                                                    <div class="upload_company_img">
                                                        <i></i>
                                                        <span>
                                                            上传公司图片请小于10M
                                                            <br>
                                                            尺寸：480px*340px
                                                        </span>
                                                        <label class="upload-file-wrap">
                                                            <input type="file" id="uploadIntroImg" name="filePic" >
                                                        </label>
                                                    </div>
                                                </li>
                                    
                                            </ul>
                                            <span class="error cmpintro_all" style="display:none;"></span>
                                            <input type="submit" value="保存" class="save">
                                            <a href="javascript:;" class="cancel cancel_btn_two">取消</a>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="item_container" id="history_container">
                                <div class="item_ltitle">发展历程</div>
                            
                                <span class="item_ropera item_add disabled item_add_wrap_three" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_three">新增</span>
                                </span>
                                
                                <!-- 编辑区域 -->
                                <div class="item_content_edit_wrap item_content_edit_three" style="display: none;">
                                    <span class="item_ropera1 item_ropera_cancel">
                                        <em class="item_ropeiconp item_ropeicons"></em>
                                        <span class="item_ropetext cancel_add_three">取消新增</span>
                                    </span>
                                    <div class="his_tip">向应聘者展示公司和产品不断壮大过程中的里程碑事件。</div>
                                    <form class="item_content_edit common_form history_form" action="javascript:;" method="post" novalidate="novalidate">
                                        <div class="form_item form_date_type">
                                            <!-- 日期 -->
                                            <label class="form_date_con">
                                                <span class="redstar">*</span>
                                                <input type="text" class="form_vinput form_date hasDatepicker" name="date" placeholder="选择事件发生日期" autocomplete="off" value="" readonly="" id="dp1516780341343">
                                            </label>
                                            <!-- 事件类型 -->
                                            <label class="rlabel">
                                                <span class="redstar">*</span>
                                                <div class="simulate_select select_eventtype">
                                                    <input type="hidden" class="eventtype" id="eventtype" name="eventtype" value="">
                                                    <span class="eventtip eventTipOne">
                                                        
                                                            选择事件类型
                                                        
                                                    </span>
                                                    <i class="idropdown"></i>
                                                    <ul class="eventUlOne" style="display: none;">
                                                        
                                                        <li>产品</li>
                                                        
                                                        <li>资本</li>
                                                        
                                                        <li>数据</li>
                                                        
                                                        <li>人员</li>
                                                        
                                                        <li>其他</li>
                                                        
                                                    </ul>
                                                </div>
                                            </label>
                                        </div>
                                        <!-- 事件 -->
                                        <div class="form_item">
                                            
                                                <label class="fs" style="display:none;">
                                                    <span class="redstar">*</span>
                                                    <div class="simulate_select">
                                                        <input type="hidden" class="financeStage" name="financeStage" value="">
                                                        <span class="eventtip">
                                                            
                                                                请选择融资阶段
                                                            
                                                        </span>
                                                        <i></i>
                                                        <ul style="display: none;">
                                                            
                                                            <li>天使轮</li>
                                                            
                                                            <li>A轮</li>
                                                            
                                                            <li>B轮</li>
                                                            
                                                            <li>C轮</li>
                                                            
                                                            <li>D轮及以上</li>
                                                            
                                                            <li>上市公司</li>
                                                            
                                                        </ul>
                                                    </div>
                                                </label>
                                                <label class="en">
                                                    <span class="redstar">*</span><input type="text" class="form_fullinput" name="eventname" placeholder="请输入该事件名称" value="" autocomplete="off">
                                                </label>
                                            
                                        </div>
                                        <!-- 链接 -->
                                        <label>
                                            <input type="text" class="form_fullinput form_link" name="link" id="eventurl" placeholder="请输入报道链接" value="" autocomplete="off">
                                        </label>
                                        <!-- 投资机构 -->
                                        
                                        <label class="tohide ">
                                            <input type="text" class="form_fullinput form_org" name="organization" placeholder="请输入投资机构，多个投资机构以顿号隔开" value="">
                                        </label>
                                    
                                        <label class="tohide ">
                                            <input type="text" class="form_fullinput form_amount" name="amount" placeholder="请输入融资金额" value="" autocomplete="off">
                                        </label>
                                    
                                        <label class="his_des tohide item_show">
                                            <div class="edui-container" style="width: 676px; z-index: 999;"><div class="edui-toolbar"><div class="edui-btn-toolbar" unselectable="on" onmousedown="return false"><div class="edui-btn edui-btn-fullscreen" unselectable="on" onmousedown="return false" data-original-title="全屏"> <div unselectable="on" class="edui-icon-fullscreen edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-source" unselectable="on" onmousedown="return false" data-original-title="源代码"> <div unselectable="on" class="edui-icon-source edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-undo  edui-disabled" unselectable="on" onmousedown="return false" data-original-title="撤销"> <div unselectable="on" class="edui-icon-undo edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-redo  edui-disabled" unselectable="on" onmousedown="return false" data-original-title="重做"> <div unselectable="on" class="edui-icon-redo edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-bold" unselectable="on" onmousedown="return false" data-original-title="加粗"> <div unselectable="on" class="edui-icon-bold edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-italic" unselectable="on" onmousedown="return false" data-original-title="斜体"> <div unselectable="on" class="edui-icon-italic edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-underline" unselectable="on" onmousedown="return false" data-original-title="下划线"> <div unselectable="on" class="edui-icon-underline edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-strikethrough" unselectable="on" onmousedown="return false" data-original-title="删除线"> <div unselectable="on" class="edui-icon-strikethrough edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-superscript" unselectable="on" onmousedown="return false" data-original-title="上标"> <div unselectable="on" class="edui-icon-superscript edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-subscript" unselectable="on" onmousedown="return false" data-original-title="下标"> <div unselectable="on" class="edui-icon-subscript edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-splitbutton edui-splitbutton-forecolor" unselectable="on" data-original-title="字体颜色"><div class="edui-btn" unselectable="on"><div unselectable="on" class="edui-icon-forecolor edui-icon"></div><div class="edui-splitbutton-color-label"></div></div><div unselectable="on" class="edui-btn edui-dropdown-toggle"><div unselectable="on" class="edui-caret"></div></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-splitbutton edui-splitbutton-backcolor" unselectable="on" data-original-title="背景色"><div class="edui-btn" unselectable="on"><div unselectable="on" class="edui-icon-backcolor edui-icon"></div><div class="edui-splitbutton-color-label"></div></div><div unselectable="on" class="edui-btn edui-dropdown-toggle"><div unselectable="on" class="edui-caret"></div></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-removeformat" unselectable="on" onmousedown="return false" data-original-title="清除格式"> <div unselectable="on" class="edui-icon-removeformat edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-insertorderedlist" unselectable="on" onmousedown="return false" data-original-title="有序列表"> <div unselectable="on" class="edui-icon-insertorderedlist edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-insertunorderedlist" unselectable="on" onmousedown="return false" data-original-title="无序列表"> <div unselectable="on" class="edui-icon-insertunorderedlist edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-selectall" unselectable="on" onmousedown="return false" data-original-title="全选"> <div unselectable="on" class="edui-icon-selectall edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-cleardoc" unselectable="on" onmousedown="return false" data-original-title="清空文档"> <div unselectable="on" class="edui-icon-cleardoc edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn- edui-btn-name-paragraph edui-combobox" unselectable="on" onmousedown="return false" data-original-title="段落格式"> <span unselectable="on" onmousedown="return false" class="edui-button-label">段落格式</span><span class="edui-button-spacing"></span><span unselectable="on" onmousedown="return false" class="edui-caret"></span><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn- edui-btn-name-fontfamily edui-combobox" unselectable="on" onmousedown="return false" data-original-title="字体"> <span unselectable="on" onmousedown="return false" class="edui-button-label">arial</span><span class="edui-button-spacing"></span><span unselectable="on" onmousedown="return false" class="edui-caret"></span><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn- edui-btn-name-fontsize edui-combobox" unselectable="on" onmousedown="return false" data-original-title="字号"> <span unselectable="on" onmousedown="return false" class="edui-button-label">字号</span><span class="edui-button-spacing"></span><span unselectable="on" onmousedown="return false" class="edui-caret"></span><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-justifyleft edui-active" unselectable="on" onmousedown="return false" data-original-title="居左对齐"> <div unselectable="on" class="edui-icon-justifyleft edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-justifycenter" unselectable="on" onmousedown="return false" data-original-title="居中对齐"> <div unselectable="on" class="edui-icon-justifycenter edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-justifyright" unselectable="on" onmousedown="return false" data-original-title="居右对齐"> <div unselectable="on" class="edui-icon-justifyright edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-link" unselectable="on" onmousedown="return false" data-original-title="超链接"> <div unselectable="on" class="edui-icon-link edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-unlink" unselectable="on" onmousedown="return false" data-original-title="取消链接"> <div unselectable="on" class="edui-icon-unlink edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-emotion" unselectable="on" onmousedown="return false" data-original-title="表情"> <div unselectable="on" class="edui-icon-emotion edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-image" unselectable="on" onmousedown="return false" data-original-title="图片"> <div unselectable="on" class="edui-icon-image edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-video" unselectable="on" onmousedown="return false" data-original-title="视频"> <div unselectable="on" class="edui-icon-video edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-map" unselectable="on" onmousedown="return false" data-original-title="百度地图"> <div unselectable="on" class="edui-icon-map edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-separator" unselectable="on" onmousedown="return false"></div><div class="edui-btn edui-btn-horizontal" unselectable="on" onmousedown="return false" data-original-title="分隔线"> <div unselectable="on" class="edui-icon-horizontal edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-print" unselectable="on" onmousedown="return false" data-original-title="打印"> <div unselectable="on" class="edui-icon-print edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-preview" unselectable="on" onmousedown="return false" data-original-title="预览"> <div unselectable="on" class="edui-icon-preview edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-drafts" unselectable="on" onmousedown="return false" data-original-title="草稿箱"> <div unselectable="on" class="edui-icon-drafts edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div><div class="edui-btn edui-btn-formula" unselectable="on" onmousedown="return false" data-original-title="数学公式"> <div unselectable="on" class="edui-icon-formula edui-icon"></div><div class="edui-tooltip" unselectable="on" onmousedown="return false" style="z-index: 1000;"><div class="edui-tooltip-arrow" unselectable="on" onmousedown="return false"></div><div class="edui-tooltip-inner" unselectable="on" onmousedown="return false"></div></div></div></div><div class="edui-dialog-container"></div></div><div class="edui-editor-body"><div class="form_fullinput form_des edui-body-container" contenteditable="true" style="width: 646px; min-height: 130px; z-index: 999;"><p><span data-tag="zns6GSI672389sdnxzcxxz" style="font-size:14px;color:#a9a9a9;padding-left:5px;">请输入事件描述</span></p></div><textarea id="history_des" class="form_fullinput form_des valid" name="des" style="height: 150px; display: none;" value="" aria-invalid="false"></textarea></div></div>
                                            <span class="wordcount">还可输入<b>200</b>字</span>
                                        </label>
                                    
                                        <input type="hidden" name="id" value="">
                                        <span class="error history_all" style="display:none;"></span>
                                        <input type="submit" value="保存" class="save">
                                        <a href="javascript:;" class="cancel cancel_btn_three">取消</a>
                                        
                                    </form>
                                </div>
                            
                                <!-- 展示区域 -->
                                <div class="item_content item_content_three" style="display: block;">
                                        <!-- 空 -->
                                    <div class="item_empty item_add">
                                        <p class="item_empty_desc">
                                            向用户展示公司和产品不断壮大、优秀的过程中的里程碑事件。
                                        </p>
                                        <p class="item_empty_add disabled">
                                            <em class="item_ropeiconp"></em>
                                            <span class="item_ropetext add_process">添加发展历程</span>
                                        </p>
                                    </div>
                                    </div>
                            </div>

                            <input type="hidden" value="316493" class="companyId">
                            <input type="hidden" value="0" class="totalCount">
                            <input type="hidden" value="true" class="isHide">
                            <input type="hidden" value="false" class="isOpen">
                            <input type="hidden" value="1" class="isupdateState">

                            <div class="interview_container item_container" id="interview_container">
                                <div id="interview_anchor"></div>
                                <div class="item_ltitle">面试评价</div>
                                <div class="reviews-empty">
                                    <span class="empty_icon"></span>
                                    <span class="empty_text">该公司近2个月内未收到过面试评价</span>
                                </div>
                            </div>

                            <div class="address_container item_container" id="location_container">
                                <div class="item_ltitle">公司位置</div>
                            
                                
                                <span class="item_ropera   addr_add" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext">新增</span>
                                </span>
                                <span class="item_ropera1 dn addr_edit_cancel" style="display: none;">
                                    <em class="item_ropeiconp item_ropeicons"></em>
                                    <span class="item_ropetext">取消编辑</span>
                                </span>
                                <span class="item_ropera1 dn addr_add_cancel">
                                    <em class="item_ropeiconp item_ropeicons"></em>
                                    <span class="item_ropetext">取消新增</span>
                                </span>
                                
                                <div class="item_content">
                                    <div class="item_con_map amap-container" id="addr_map" style="position: relative; background: rgb(252, 249, 242);">
                                        <img src="../images/map.png"/>
                                    </div>
                                    <div class="item_con_mlist mCustomScrollbar _mCS_1">
                                        <div class="mCustomScrollBox mCS-dark-2" id="mCSB_1" style="position:relative; height:100%; overflow:hidden; max-width:100%;">
                                            <div class="mCSB_container mCS_touch mCS_no_scrollbar" style="position:relative; top:0;">
                                                <ul class="con_mlist_ul">
                                                </ul>
                                                <div class="mlist_total_desc">
                                                    该公司共有 
                                                    <span class="mlist_total">0</span> 个地址
                                                </div>
                                            </div>
                                            <div class="mCSB_scrollTools" style="position: absolute; display: none;">
                                                <div class="mCSB_draggerContainer">
                                                    <div class="mCSB_dragger" style="position: absolute; top: 0px;" oncontextmenu="return false;">
                                                        <div class="mCSB_dragger_bar" style="position:relative;"></div>
                                                    </div>
                                                    <div class="mCSB_draggerRail"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--招聘职位-->
                        <div id="containerCompanyDetails" class="recruitJob" style="display: none;">
                            <div class="posfilterlist_container item_container">
                                <div class="item_ltitle">
                                    近两月共有 <span class="list_total"> 0 </span> 个在招职位
                                </div>
                                <div class="item_content">
                                    <div class="item_con_filter">
                                        <span class="con_filter_type">职位：</span>
                                        <ul class="con_filter_ul">
                                                                                                                                                                                                                                                                                                                    </ul>
                                    </div>
                                    <div class="item_con_list_container">该公司近两个月暂无招聘的职位</div>
                                </div>
                            </div>
                        </div>
                        
                        <!--公司问答-->
                        <div id="containerCompanyDetails" class="companyAsk" style="display: none;">               
                            <div class="question-list-container" id="question_container" data-islogin="1">
                                <div class="empty-tips">
                                    <div class="tips-icon tips-draw"></div>
                                    <p class="text">还没有人对这家公司提问</p>
                                </div>
                                <div class="send_question">
                                    <p>提出对店小二餐饮连锁公司感兴趣的问题，邀请过来人帮你解答~</p>
                                    <input type="text" id="searchQuestion" value="" maxlength="50" placeholder="你的问题是什么">
                                    <input type="hidden" class="questionPrompt" value="你为什么选择加入店小二餐饮连锁公司？">
                                    <ul class="company_question_list"></ul>
                                    <a href="javascript:;" class="edit_introduce" >编辑问题补充</a>
                                    <a href="javascript:;" class="submit_question" >提问</a>
                                    <div class="edit_content">
                                        <textarea class="question_supplement" maxlength="500" placeholder="在此补充问题的其他信息，如：背景、相关资料等"></textarea>
                                            <ul class="answer_to">
                                                <li class="ask-to">向谁提问</li>
                                            </ul>
                                            <input type="hidden" value="1" class="default_man">
                                            <div class="submit_content">
                                                <a href="javascript:;"  class="improve_sub">发布问题</a>
                                                <span class="noncommit" >匿名提问</span>
                                                <input type="hidden" value="PC" class="mysource">
                                            </div>     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="container_right">

                        <div class="item_container" id="basic_container">
                            <div class="item_ltitle">公司基本信息</div>
                                <span class="item_ropera iedit disabled edit_text_one" style="display: block;">
                                    <em class="item_ropeiconp item_ropeicone"></em>
                                    <span class="item_ropetext edit_one">编辑</span>
                                </span>
                                <span class="item_ropera icanceledit dn disabled edit_text_edit_one" style="display: none;">
                                    <em class="item_ropeiconp item_ropeicons"></em>
                                    <span class="item_ropetext cancel_edit_one">取消编辑</span>
                                </span>
                                
                            <!-- 展示模式 -->
                            <div class="item_content item_right_one" style="display: block;">
                                <ul>
                                    <li>
                                        <i class="iconfont icon-qita1 icon-glyph-fourSquare"></i>
                                        <span>生活服务,其他</span>
                                    </li>
                                    <li>
                                        <i class="iconfont icon-zhexiantu icon-glyph-trend"></i>
                                        <span>未融资</span>
                                    </li>
                                    <li>
                                        <i class="iconfont icon-ren icon-glyph-figure"></i>
                                        <span>15-50人</span>
                                    </li>
                                </ul>
                            </div>

                            <!-- 编辑模式 -->
                            <div class="item_content_edit_wrap dn item_right_edit_one" style="display: none;">
                                <ul>
                                    <li>
                                        <i class="type"></i>
                                        <span>生活服务,其他</span>
                                    </li>
                                </ul>
                                <div class="item_content_edit">
                                    <form id="basicInfoForm" action="javascript:;" method="post" novalidate="novalidate"><label>
                                        <span class="redstar">*</span>
                                        <div class="simulate_select">
                                            <input type="hidden" class="companyfinancing" name="companyfinancing" value="未融资">
                                            <span class="info_one_dropdown info_invest">未融资</span>
                                            <i class="info_one_dropdown"></i>
                                            <ul class="info_ul_invest" style="display: none;">
                                                
                                                <li>未融资</li>
                                                
                                                <li>天使轮</li>
                                                
                                                <li>A轮</li>
                                                
                                                <li>B轮</li>
                                                
                                                <li>C轮</li>
                                                
                                                <li>D轮及以上</li>
                                                
                                                <li>上市公司</li>
                                                
                                                <li>不需要融资</li>
                                                
                                            </ul>
                                        </div>
                                    </label>
                                    
                                    <label>
                                        <span class="redstar">*</span>
                                        <div class="simulate_select">
                                            <input type="hidden" class="companyscale" name="companyscale" value="15-50人">
                                            <span class="people_one_dropdown info_people">15-50人</span>
                                            <i class="people_one_dropdown "></i>
                                            <ul class="info_ul_people" style="display: none;">
                                                
                                                <li>少于15人</li>
                                                
                                                <li>15-50人</li>
                                                
                                                <li>50-150人</li>
                                                
                                                <li>150-500人</li>
                                                
                                                <li>500-2000人</li>
                                                
                                                <li>2000人以上</li>
                                                
                                            </ul>
                                        </div>
                                    </label>
                                    
                                    <span class="error base_all" style="display:none;"></span>
                                    <input type="submit" value="保存" class="save">
                                    <a href="javascript:;" class="cancel cancel_right_btn_one">取消</a>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="company_managers item_container">
                            <div class="item_ltitle">管理团队</div>
                            <span class="item_ropera manager_new disabled item_right_text_wrap_one" style="display: block;">
                                <em class="item_ropeiconp"></em>
                                <span class="item_ropetext add_right_one">新增</span>
                            </span>
                            <span class="item_ropera item_ropera_cancel item_right_text_edit_one" style="display: none;">
                                <em class="item_ropeiconp item_ropeicons"></em>
                                <span class="item_ropetext cancel_right_add_one">取消新增</span>
                            </span>
                            <div class="company_mangers_item company_manger_wrap" style="display: block;">
                        
                                <div class="item_empty">
                                    <p class="item_empty_desc">
                                        展示公司领导团队，大人物的人格魅力直线提升公司诱人指数！
                                    </p>
                                    <p class="item_empty_add disabled">
                                        <em class="item_ropeiconp"></em>
                                        <span class="item_ropetext add_mangers">添加管理团队</span>
                                    </p>
                                </div>
                            </div>
                            <form id="leaderForm" class="fom_right_one" action="javascript:;" method="post" novalidate="novalidate" style="display: none;">
                                <div class="item_manager_edit item_content">
                                    <div class="item_manger_photo">
                                        
                                            <img src="../images/leader_default_c3e060f.png" width="120" height="120">
                                        
                                        <div class="shadow"></div>
                                        <div class="text">更换头像<br>120px*120px<br>小于10M</div>
                                        <label class="upload-file-wrap">
                                            <input type="file" id="leaderUpload" name="filePic">
                                        </label>
                                    </div>
                                    <div class="form_item">
                                        <span class="redstar">*</span>
                                        <input type="text" class="input_item manager_name" name="name" placeholder="请输入该人物姓名" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <span class="redstar">*</span>
                                        <input type="text" class="input_item manager_name" name="position" placeholder="请输入该人物当前职位" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <input type="text" class="input_item manager_name" name="weibo" placeholder="请输入该人物新浪微博地址" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <input type="text" class="input_item manager_name" name="cyclopediaUrl" placeholder="请输入该人物百度百科地址" value="" autocomplete="off">
                                    </div>
                                    <div class="form_item">
                                        <div class="manager_content_wrap">
                                            <div class="edui-container" style="width: 210px; z-index: 999;"></div>
                                            <span class="wordcount">还可输入<b>500</b>字</span>
                                        </div>
                                    </div>
                                    <div class="item_button">
                                        <span class="error managers_all" style="display:none;"></span>
                                        <input type="submit" class="save" value="保存">
                                        <a href="javascript:;" class="cancel cancel_right_btn_two">取消</a>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tags_container item_container">
                            <div class="item_ltitle">公司标签</div>
                                <span class="item_ropera disabled item_right_text_wrap_two" style="display: block;">
                                    <em class="item_ropeiconp"></em>
                                    <span class="item_ropetext add_right_two">新增</span>
                                </span>
                                <span class="item_ropera tags_edit_now item_right_text_edit_two" style="display: none;">
                                    <em class="item_ropeiconp item_ropeicone"></em>
                                    <span class="item_ropetext cancel_right_add_two">取消新增</span>
                                </span>
                                <div class="tags_warp tags_wrap_one" style="display: block;">
                                    <div class="item_empty">
                                        <p class="item_empty_add disabled">
                                            <em class="item_ropeiconp"></em>
                                            <span class="item_ropetext add_tags">添加公司标签</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="tags_warp tags_warp_block tags_wrap_edit_one" style="display: none;">
                                    <div class="tags_edit">
                                        <p class="title">
                                            <span class="title_content">已选择标签</span>
                                            <span class="tags_num">
                                                (<span class="num_has">0</span>/9)
                                            </span>
                                        </p>
                                        <div class="tags_has_wrapper">
                                            <ul class="tags_has">
                                                <li class="list"><em class="item_tags_del"></em></li>
                                            </ul>
                                            <span class="error"></span>
                                        </div>
                                        <p class="chooseTitle">
                                            <span class="title_content">可选择标签</span>
                                        </p>
                                        <input type="text" class="tag_name" id="tags_input_selected" placeholder="添加自定义标签">
                                        <a href="javascript:;" class="tag_add_btn">贴上</a>
                                        <span class="error input-error"></span>
                                        <ul class="choose item_con_ul clearfix" id="item_con_tags_ul">
                                                
                                                    <li class="con_ul_li">
                                                        年底双薪
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        专项奖金
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        股票期权
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        绩效奖金
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        年终分红
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        带薪年假
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        交通补助
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        通讯津贴
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        午餐补助
                                                    </li>
                                                
                                                    <li class="con_ul_li">
                                                        定期体检
                                                    </li>
                                                
                                            <!--<span class="tag_choose_next">下一页</span>-->
                                        </ul>
                                        <div class="item_button">
                                            <input class="save" type="button" value="保存">
                                            <a href="javascript:;" class="cancel cancel_right_btn_three">取消</a>
                                        </div>
                                        <a href="javascript:;" class="cancel"></a>
                                    </div>
                                    <a href="javascript:;" class="cancel"></a>
                                </div>
                            </div>


                            <div class="navigator_container">
                                <div class="nav_item nav_selected" data-name="#company_products">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">公司产品</span>
                                </div>
                                <div class="nav_item" data-name="#company_intro">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">公司介绍</span>
                                </div>
                                <div class="nav_item" data-name="#history_container">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">发展历程</span>
                                </div>
                                <div class="nav_item" data-name="#interview_container">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">面试评价</span>
                                </div>
                                <div class="nav_item nav_item_last" data-name="#location_container">
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon"></em></div>
                                    <div class="nav_item_icon_wrap"><em class="nav_item_icon_up"></em></div>
                                    <span class="nav_item_text">公司位置</span>
                                </div>
                                <!-- 为了挡住顶部和底部的灰线 -->
                                <span class="nav_vline nav_vline_top"></span>
                                <span class="nav_vline nav_vline_bottom"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="cboxOverlay" style="opacity: 0.9; visibility: visible; display: block;"></div>
    @endsection
    @section('custom-script')
        <!-- <script type="text/javascript">
        $(".wheel-button").wheelmenu({
            // alert(1);
            trigger: "hover",
            animation: "fly",
            angle: [0, 360]
        });
        </script> -->
        <script type="text/javascript">
            $(document).ready(function(){
                $(".company_index").click(function(){
                    $(".companyIndex").show();
                    $(".recruitJob").hide();
                    $(".companyAsk").hide();
                    $(".li_one").addClass("current")
                    $(".li_two").removeClass("current")
                    $(".li_three").removeClass("current")
                });
                $(".recruit_job").click(function(){
                    $(".companyIndex").hide();
                    $(".recruitJob").show();
                    $(".companyAsk").hide();
                    $(".li_two").addClass("current")
                    $(".li_one").removeClass("current")
                    $(".li_three").removeClass("current")
                });
                $(".company_ask").click(function(){
                    $(".companyIndex").hide();
                    $(".recruitJob").hide();
                    $(".companyAsk").show();
                    $(".li_three").addClass("current")
                    $(".li_one").removeClass("current")
                    $(".li_two").removeClass("current")
                });
                $(".add_one,.add_product").click(function(){
                    $(".item_content_one").hide();
                    $(".add_btn_wrap").hide();
                    $(".item_content_one_edit").show();
                    $(".item_cancel_add").show();

                });
                $(".cancel_add_one,.cancel_btn_one").click(function(){
                    $(".item_content_one").show();
                    $(".add_btn_wrap").show();
                    $(".item_content_one_edit").hide();
                    $(".item_cancel_add").hide()
                });
                $(".add_two,.add_image").click(function(){
                    $(".item_ropera1_content").hide();
                    $(".item_content_two").hide();
                    $(".item_content_add_wrap").show();
                    $(".item_content_edit_two").show();
                    $(".item_ropera1_content").show();
                })
                $(".cancel_add_two,.cancel_btn_two").click(function(){
                    $(".item_ropera1_content").show();
                    $(".item_content_two").show();
                    $(".item_content_add_wrap").hide();
                    $(".item_content_edit_two").hide();
                    $(".item_ropera1_content").hide();
                });
                $(".add_three,.add_process").click(function(){
                    $(".item_add_wrap_three").hide()
                    $(".item_content_edit_three").show();
                    $(".item_content_three").hide();
                })
                $(".cancel_btn_three,.cancel_add_three").click(function(){
                    $(".item_add_wrap_three").show()
                    $(".item_content_edit_three").hide();
                    $(".item_content_three").show();
                });
                $(".eventTipOne,.idropdown").click(function(){
                    $(".eventUlOne").toggle();
                });
                $(".edit_one").click(function(){
                    $(".edit_text_one").hide();
                    $(".edit_text_edit_one").show();
                    $(".item_right_one").hide();
                    $(".item_right_edit_one").show();
                })
                $(".cancel_edit_one,.cancel_right_btn_one").click(function(){
                    $(".edit_text_one").show();
                    $(".edit_text_edit_one").hide();
                    $(".item_right_one").show();
                    $(".item_right_edit_one").hide();
                });
                $(".info_one_dropdown").click(function(){
                    $(".info_ul_invest").toggle()
                });
                $(".people_one_dropdown").click(function(){
                    $(".info_ul_people").toggle()
                });
                $(".add_right_one,.add_mangers").click(function(){
                    $(".item_right_text_wrap_one").hide();
                    $(".company_manger_wrap").hide();
                    $(".item_right_text_edit_one").show();
                    $(".fom_right_one").show();
                });
                $(".cancel_right_add_one,.cancel_right_btn_two").click(function(){
                    $(".item_right_text_wrap_one").show();
                    $(".company_manger_wrap").show();
                    $(".item_right_text_edit_one").hide();
                    $(".fom_right_one").hide();
                });
                $(".add_right_two,.add_tags").click(function(){
                    $(".item_right_text_edit_two").show();
                    $(".tags_wrap_edit_one").show();
                    $("item_right_text_wrap_two").hide();
                    $("tags_wrap_one").hide();
                    $(".tags_wrap_one").hide();
                });
                $(".cancel_right_add_two,.cancel_right_btn_three").click(function(){
                    $(".item_right_text_edit_two").hide();
                    $(".tags_wrap_edit_one").hide();
                    $("item_right_text_wrap_two").show();
                    $("tags_wrap_one").show();
                    $(".tags_wrap_one").show();
                });

                /********/
                $(function(){
                    $(".eventUlOne li").bind("click",function(){

                        selectedItem(this);
                    });
                });

                function selectedItem(obj){
                    var $elemThis = $(obj);
                    var txt_this = $elemThis.text();
                    $(".eventTipOne").text(txt_this);
                };

                $(function(){
                    $(".info_ul_invest li").bind("click",function(){

                        selectedItem(this);
                    });
                });

                function selectedItem(obj){
                    var $elemThis = $(obj);
                    var txt_this = $elemThis.text();
                    $(".info_invest").text(txt_this);
                };
                $(function(){
                    $(".info_ul_people li").bind("click",function(){

                        selectedItem(this);
                    });
                });

                function selectedItem(obj){
                    var $elemThis = $(obj);
                    var txt_this = $elemThis.text();
                    $(".info_people").text(txt_this);
                }
                /*******************/
                $(".img_del").click(function(){
                    $(".mr_delete_pop").show();
                })
                $(".mr_del").click(function(){
                    $(".mr_delete_pop").hide();
                })
                $(".edit_text").click(function(){
                    $(".top_info_content").hide();
                    $(".top_info_edit").show();
                });
                $(".cancel_info_edit,.cancel_top_btn").click(function(){
                    $(".top_info_content").show();
                    $(".top_info_edit").hide();
                });
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