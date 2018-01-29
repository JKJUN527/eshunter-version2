@extends('layout.master')
@section('title', '新闻详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/zhiwei.css')}}" type="text/css" rel="stylesheet">
 <style>
    #layout {
        clear: both;
        min-height: auto;
        height: auto !important;
        height: 100%;
        margin-bottom: 20px;
    }
 </style>
@endsection

@section('header-nav')
   @include('components.headerNav')
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')

<script src="js/jquery.wheelmenu.js" type="text/javascript"></script>
<div class="QQ_each">
        <a class="wheel-button float_qq" href="#wheel" style="opacity: 1;"></a>
        <ul class="wheel" id="wheel">
            <li class="item"><a href="404.html"></a></li>
            <li class="item"><a href="404.html"></a></li>
            <li class="item"><a href="404.html"></a></li>
            <li class="item"><a href="404.html"></a></li>
            <!--<li class="item"><a target="_blank" href="404.html" class='sss'>沙僧</a></li>-->
            <li class="item"><a class="bj" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1538590175&amp;site=qq&amp;menu=yes" target="_blank">求职<br>服务</a></li>
            <li class="item"><a class="wk" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3078167392&amp;site=qq&amp;menu=yes" target="_blank">招聘<br>服务</a></li>
            <li class="item"><a class="ts" href="http://wpa.qq.com/msgrd?v=3&amp;uin=6281927&amp;site=qq&amp;menu=yes" target="_blank">bug<br>反馈</a></li>      
            <li class="item"><a href="404.html"></a></li>
            <li class="item"><a href="404.html"></a></li>
            <li class="item"><a href="404.html"></a></li>
        </ul>
    </div>
<a style="display: none;" class="back_to_top" title="" href="404.html"></a>

<script type="text/javascript">
$(".wheel-button").wheelmenu({
    // alert(1);
    trigger: "hover",
    animation: "fly",
    angle: [0, 360]
});
</script>

</div>
<div class="position-head" data-companyid="304142">
    <div class="position-content ">
        <div class="position-content-l">
            <div class="job-name" title="产品助理实习生">
                                <div class="company">原链科技产品部招聘</div>
                                <span class="name">产品助理实习生</span>
                                <span class="outline_tag">（该职位已下线）</span>
                                <div class="marEdit">
                                    </div>
            </div>
            <dd class="job_request">
                <p>
                    <span class="salary">2k-3k </span>
                    <span>/成都 /</span>
                    <span>经验应届毕业生 /</span>
                    <span>大专及以上 /</span>
                    <span>实习</span>
                </p>
                <!-- 职位标签 -->
                <ul class="position-label clearfix">
                                        <li class="labels">产品经理</li>
                                        <li class="labels">实习生</li>
                                        <li class="labels">市场分析</li>
                                    </ul>
                <p class="publish_time">2017-12-25&nbsp; 发布于电竞猎人</p>
            </dd>
        </div>

        <div class="position-content-r clearfix">
            <div class="position-deal clearfix">
                <div class="resume-deliver">
                <!-- <a rel="nofollow" href="javascript:;" class="btn fr btn_sended">已下线</a> -->
                <a rel="nofollow" href="javascript:;" class="send-CV-btn s-send-btn fr gray" style="display: none;">已下线</a>
                <a rel="nofollow" class="send-CV-btn s-send-btn fr"  href="javascript:;" >投个简历</a>
                </div>
                <div class="jd_collection  job-collection " data-lg-tj-id="9500" data-lg-tj-no="0001" data-lg-tj-cid="idnull">
                    <i class="iconfont icon-star"> </i>收藏
                </div>
            </div>

            <!-- 简历状态 -->            
            <ul class="resume-select clearfix">
                            <!-- 用户是否激活 0-否；1-是 -->
                <li class="resume resume-attachment">
                    <span class="select-radio  selected " data-type="0"></span>
                    <span>
                        <a href="#" title="下载XX简历.wps">
                            <i class="iconfont icon-paper-clip"></i>
                            xx简历.wps
                        </a>
                    </span>
                </li>
                <li class="resume no-resume-online">
                    <span>
                        <a href="#" target="_blank" title="完善在线简历" rel="nofollow">
                            <i class="iconfont icon-jianli"></i>
                            完善在线简历
                        </a>
                    </span>
                </li>
            </ul>

        </div>

    </div>

</div>
<div class="info_container clearfix">
    <div class="content_l left">

        <dl class="job_detail" id="job_detail">
            <dt class="clearfix join_tc_icon"></dt>
            <dd class="job_advantage">
                <span class="advantage">职位诱惑:</span>
                <p>五险一金,包三餐,双休,健身房</p>
            </dd>
            <dd class="job_bt">
                <h3 class="descrition">职位描述:</h3>
                <div>
                    <p>职位描述：</p>
                    <p><br></p>
                    <p>1、负责公司相关产品的界面UI设计、优化以及规范管理，活动页面设计；</p>
                    <p><br></p>
                    <p>2、参与制定项目UI的详细设计规范，整理详细功能的设计规范文档；</p>
                    <p><br></p>
                    <p>3、参与公司产品及功能的创意设计的更新迭代。</p>
                    <p><br></p>
                    <p>4、有逻辑的思考，对产品界面进行持续的设计优化，提升用户体验并做到极致；</p>
                    <p><br></p>
                    <p>5、配合同事根据需求完成有效的设计。</p>
                    <p><br></p>
                    <p><br></p>
                    <p>任职要求：</p>
                    <p><br></p>
                    <p>1、本科及以上学历，美术及设计等相关专业；</p>
                    <p><br></p>
                    <p>2、3年以上网站或APP等界面设计经验，有成功的项目设计作品和案例；</p>
                    <p><br></p>
                    <p>3、精通使用Photoshop、Illustrator，会插画，卡通形象，动画设计者优先；</p>
                    <p><br></p>
                    <p>4、对从用户出发的设计理念有深刻的理解，能准确把握用户需求，出色的设计语言表达能力；</p>
                    <p><br></p>
                    <p>5、具有良好的沟通能力和团队合作精神，能在高强度的环境下准时、高效的完成工作。</p>
                    <p><br></p>
                    <p><br></p>
                    <p>注：我们想要年轻有活力、有创造力的设计师，经验和学历都不是重点，但愿能看到你的设计灵魂。（请随简历附上代表作品或相关链接）</p>
                </div>
            </dd>
            <dd class="job_address clearfix">
                <h3 class="address">工作地址</h3>
                <div class="work_addr">
                    <a href="#" rel="nofollow">成都</a>-
                    <a href="#" rel="nofollow">武侯区</a>-创业路49号
                    <a href="javascript:;" id="mapPreview" rel="nofollow">查看地图</a>
                </div>
            </dd> 
            <dd class="job_publisher">
                <h3>职位发布:</h3>
                <div class="border_c clearfix">
                    <img src="../images/pic0.jpg" width="60" height="60"/>
                    <div class="publisher_name">
                        <a title="LGD">
                            <span class="name">一lomo</span>
                            <span class="chat_me"></span>
                        </a>    
                        <span class="pos">HR</span>
                    </div>
                    <div class="publisher_data">
                        <div>
                            <span class="data_title">
                                聊天意愿
                                <i></i>
                            </span>
                            <span class="tip_text">1个月内职位发布者回复聊天的占比</span>
                            <span class="data">很弱</span>
                            <span class="tip_s">
                                回复率
                                <i>--</i>
                                &nbsp;用时
                                <i class="light_tip">13</i>分钟
                            </span>
                        </div>
                        <em></em>
                        <div>
                            <span class="data_title">
                                简历处理
                                <i></i>
                            </span>
                            <span class="tip_text">7日内职位发布者简历处理效率</span>
                            <span class="data">超快</span>
                            <span class="tip_s">
                                处理率
                                <i>--</i>
                                &nbsp;用时
                                <i class="light_tip">1</i>天
                            </span>
                        </div>
                        <em></em>
                        <div>
                            <span class="data_title">
                                活跃时段
                                <i></i>
                            </span>
                            <span class="tip_text">1个月内职位发布者最活跃时段统计</span>
                            <span class="data">下午</span>
                            <span class="tip_s">
                                <i class="light_tip">2</i>点最活跃
                            </span>
                        </div>
                    </div>
                </div>
            </dd>
        </dl>
        <dl class="interview_experience module-container">
            <div class="module-title" id="review_anchor">
                面试评价
            </div>
            <a href="" class="checkAll" style="display: none;">查看该公司全部面试评价</a>
            <div class="reviews-area">
                <div class="list-empty">
                    <i></i>
                    <span>该职位尚未收到面试评价</span>
                    <span class="list_empty_tips">
                        <a href="" target="_blank" class="list_empty_link">其他职位的面试评价</a>
                    </span>
                </div>
            </div>
        </dl>
    </div>
    <div class="content_r">
        <dl class="job_company" id="job_company">
            <dt>
                <a href="#" target="_blank">
                    <img  class="b2" src="../images/pic0.jpg" width="96" height="96"/>
                    <div>
                        <h2 class="left">
                            成都市米彩科技有限公司
                        </h2>
                        <span class="dn">电竞猎人认证企业</span>
                    </div>
                </a>
            </dt>
            <dd>
                <ul class="c_feature">
                    <li>
                        <i class="iconfont icon-qita1"></i>
                        电竞运营，教育
                        <span class="hovertips">领域</span>
                    </li>
                    <li>
                        <i class="iconfont icon-zhexiantu"></i>
                         不需要融资
                        <span class="hovertips">发展阶段</span>
                    </li>
                    <li>
                        <i class="iconfont icon-ren"></i>
                         50-150人
                        <span class="hovertips">规模</span>
                    </li>
                    <li>
                        <i class="iconfont icon-zhuye"></i>
                        <a href="#" target="_blank" title="#" rel="nofollow">http://www.mgm.com/</a>
                        <span class="hovertips">公司主页</span>
                    </li>
                </ul>
            </dd>
        </dl>
        <div class="jobs_similar" id="jobs_similar">
            <h4 class="jobs_similar_header">
                <span>相似职位</span>
            </h4>
            <div class="jobs_similar_content" id="jobs_similar_content" style="display: none;">
                <div class="jobs_similar_detail" id="jobs_similar_detail">
                    <ul class="similar_list reset">
                        <li class="similar_list_item  clearfix">
                            <a href="#" class="position_link clearfix" target="_blank">
                                <div class="similar_list_item_logo">
                                    <img src="../images//pic0.jpg"/ width="56" height="56" style="display: block;">
                                </div>
                                <div class="similar_list_item_pos">
                                    <h2 title="">王者荣耀职业玩家</h2>
                                    <p>7k-10k</p>
                                    <p class="similar_company_name">EDG俱乐部[成都-华阳]</p>
                                </div>
                            </a>
                        </li>
                        <li class="similar_list_item  clearfix">
                            <a href="#" class="position_link clearfix" target="_blank">
                                <div class="similar_list_item_logo">
                                    <img src="../images//pic0.jpg"/ width="56" height="56" style="display: block;">
                                </div>
                                <div class="similar_list_item_pos">
                                    <h2 title="">王者荣耀职业玩家</h2>
                                    <p>7k-10k</p>
                                    <p class="similar_company_name">EDG俱乐部[成都-华阳]</p>
                                </div>
                            </a>
                        </li>
                        <li class="similar_list_item  clearfix">
                            <a href="#" class="position_link clearfix" target="_blank">
                                <div class="similar_list_item_logo">
                                    <img src="../images//pic0.jpg"/ width="56" height="56" style="display: block;">
                                </div>
                                <div class="similar_list_item_pos">
                                    <h2 title="">王者荣耀职业玩家</h2>
                                    <p>7k-10k</p>
                                    <p class="similar_company_name">EDG俱乐部[成都-华阳]</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nodata_similar_list"></div>
        </div>
    </div>
</div>
@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    
@endsection
