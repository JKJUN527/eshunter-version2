@extends('layout.master')
@section('title', '新闻详情')

@section('custom-style')
 <link media="all" href="{{asset('../style/news.css')}}" type="text/css" rel="stylesheet">
@endsection

@section('header-nav')
   @include('components.headerNav')
@endsection

@section('header-tab')
    @include('components.headerTab', ['activeIndex' => 4,'type' =>$data['type']])
@endsection

@section('content')
<div class="containter" style="margin-top: 20px;">
                <div class="info-panel">
                    <div class="mdl-card mdl-shadow--2dp info-card news-detail">
                        <div class="mdl-card__title">
                            <h5 class="mdl-card__title-text" data-content="280">
                                                       离职后要不要删前同事好友？雷军在乌镇大会用行动给了教科书式回答
                            </h5>
                        </div>
    
                        <div class="mdl-card__actions mdl-card--border base-info--panel">
                            
                            <label><span>责任编辑: admin</span></label>
                            <label><span>发布时间: 2018-01-12</span></label>
                            
                            <label><i class="material-icons">comment</i> <span>0</span></label>
                        </div>
    
                        <div class="mdl-card__supporting-text">凡是想要在事业上实现飞黄腾达的野心家，总想多结识点人脉。这已经成了职场中一条黄金般的真理。即使是身家亿万的老板，也不例外。<br><br>每年的乌镇饭局，就是互联网大佬人脉流动的社交场。<br><br>如果说2015年的丁磊饭局覆盖了中国「互联网业半壁江山」，那么今年的饭局出席阵容则把覆盖范围扩大到了三分之二，也有人称这是东半球最有影响力的科技饭局。<br><br><div class="news-image"><img src="http://www.eshunter.com/storage/newspic/2018-01-12-17-43-59-5a58835f9f8banews1.jpg"></div><br>首次亮相的“东兴会”饭局规模也不小。出席饭局大佬除了刘强东、王兴，还有马化腾、雷军、杨元庆、程维、姚劲波、张一鸣，以及摩拜单车CEO王晓峰、快手CEO宿华、知乎创始人周源、红杉资本沈南鹏、高瓴资本张磊、金沙江创投朱啸虎、美团点评王慧文、京东金融陈生强，共计16人。<br><br>世上没有无缘无故的爱，也没有无缘无故的饭局。我们无法得知，觥筹交错间，大佬们到底交换了什么思想。但通过这张饭桌上，却仍可窥见大佬之间关于人脉的格局。<br><br>当晚现身的互联网大佬包括：网易董事局主席兼CEO丁磊、腾讯董事会主席兼CEO马化腾、百度董事长兼CEO李彦宏、京东董事局主席兼CEO刘强东、搜狐董事局主席兼CEO张朝阳、中国联通集团总经理陆益民、宽带资本董事长田溯宁、联想集团董事长兼CEO杨元庆、小米科技董事长兼CEO雷军、奇虎360董事长周鸿祎、今日头条CEO张一鸣、百度总裁张亚勤、微软全球执行副总裁沈向洋、红杉资本全球执行合伙人沈南鹏、华为技术有限公司高级副总裁余承东、58集团CEO姚劲波、爱奇艺CEO龚宇、滴滴出行CEO程维、美团点评CEO王兴等人。<br><br>吃饭不重要，重要的是跟谁在一起吃<br><br>今年的乌镇饭局，有两张菜单引发了讨论。一张是丁磊的手写家乡菜菜单，另一张则是把出席伙伴全部写入菜名的东兴局菜单。<br><br><div class="news-image"><img src="http://www.eshunter.com/storage/newspic/2018-01-12-17-43-59-5a58835fa22f7news2.jpg"></div><br>然而，饭局之意不在饭，在局。吃什么不重要，重要的是，跟谁在一起吃。<br><br>中国人赵丹阳就曾花211万美金，拍下巴菲特午宴上座机会，并成功借助那次饭局，和巴菲特建立了联系，不仅时常收到巴菲特寄来的资料，许多曾经百思不得其解的问题也能得到巴菲特直接解答。<br><br>而在东兴局，面对在席的各位大佬，刘强东和王兴自然也不会放过这个机会。刘强东带上了京东金融陈生强，并且让他坐在明星投资人朱啸虎身旁，而王兴带的则是出行板块负责人王慧文，位置则紧挨着目前出行领域势头正盛的摩拜单车CEO王晓峰。<br><br>将自己的得力干将安排在行业权威身旁，不管是探探虚实还是听取经验指导，饭局都是最容易得到答案的场所。<br><br>一口好饭，也许就能促成下一个用头脑风暴在味蕾上绽放的商业帝国。<br><br><div class="news-image"><img src="http://www.eshunter.com/storage/newspic/2018-01-12-17-43-59-5a58835fa577anews3.jpg"></div><br>所以，年到岁末，各种饭局潮涌，去什么饭局，跟谁去饭局，仍然是决定下一年公司业务发展的重要因素之一。<br><br>不要忘记你的前同事<br><br>曾经朋友圈有个热门话题，“离职后，要不要删前同事好友？”雷军的答案，从这次饭局能看出端倪：不删。<br><br>在今年的乌镇饭局，想要IPO的雷军显得尤其忙碌。<br><br><div class="news-image"><img src="http://www.eshunter.com/storage/newspic/2018-01-12-17-43-59-5a58835fa5b03news4.jpg"></div><br>他不仅赶场了丁磊局、东兴局两场饭局，还在深夜参与了极客公园发起的茶话会。<br><br>在丁磊饭局，他和联想杨元庆坐在一起喝了好几杯，1个小时后，又和杨元庆双双出现在东兴局。<br><br>两人如何认识的呢？原来，这两个人曾经是前同事。<br><br>在1997年，金山急需要钱又要市场的情况下，联想带着450万美元的投资出现了，而雷军也在这次投资后被任命为总经理，从程序员骨干开始转型到管理岗，从此人生轨迹发生改变。<br><br><div class="news-image"><img src="http://www.eshunter.com/storage/newspic/2018-01-12-17-43-59-5a58835fa8c86news5.jpg"></div><br>时任联想副总裁的杨元庆则被指派为金山董事长，直接代表联想在金山挥斥方遒，两人在那时结下革命友谊。<br><br>在去年互联网大会，两人还被拍到坐在一起，关系甚好。虽然这两年联想出手机，小米出电脑，两人从合作伙伴变为竞争对手，但这并不影响两人私交。<br><br>人的本质是社会关系的总和。深谙此道的雷军对年末社交的机会倍加珍惜，并且前同事是职场人社交网络中极其重要的一部分，同一圈子更加如此，他们不仅会成为你人脉的链接，而且人在江湖，说不定哪一天他们的举手之劳，就能为你解决燃眉之急。<br><br>及时组局互换资源<br><br>结交别人之前，先经营自己。建立人脉的关键在于共享和付出，只有首先奉献，才会有收获。<br><br>王兴在东兴局的角色就像付出者和互利者，他与在座绝大部分大佬都有过多年的交情。<br><br>快手宿华是他清华的校友、知乎周源在创业时曾问过他要不要起一个和“饭否”一样文艺的名字，而58姚劲波更和王兴是多年的老友，王兴在决定创业时，还曾咨询过姚劲波，而沈南鹏、张磊、马化腾则都是美团点评投资人，对王兴的认可不言而喻。<br><br>王兴个人的关系就串起了这场饭局，他和丁磊一样，是人脉资源的分享者。<br><br>人脉资源说到底是利益关系的互换，资源多的人自然容易讨人喜欢，也更有可能与另一个拥有同等资源数量或质量的人进行交换。<br><br>在这种情况下，“公平交易”、“多边共赢”更容易产生，人脉的连接可以得到迅速的裂变。<br><br>刘强东、王兴为什么要组东兴局？一切也许就是那句菜单上的“互利共赢”，这场饭局是大佬之间人脉关系的互换场，而人脉背后究其本质，还是个人所代表的资源。<br><br>虽然大多数普通人也许永远都无法坐上那张饭桌，获得与他们同等的金钱、财富、名誉。<br><br>但大佬们对待人脉的态度、对待商业战场的屡败屡战、在绝境中呈现出来的坚韧生命力，仍然是这个以丧文化为流行的时代，鼓励年轻人拼搏时不可或缺的品质。<br><br>想要经营好自己，首先得提高自己以及团队的整体实力和能力。</div>
                    </div>
                </div>
                <div class="info-panel">

                    <div class="comment-panel">
                        <div class="mdl-card info-card comment-card">
                            <form id="comment-form" method="post">
                                <input type="hidden" name="nid" value="280">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="2" class="form-control" name="content" id="additional-content" placeholder="写点什么..."></textarea>
                                    </div>
                                    <div class="help-info" id="comment-help">还可输入114字</div>
                                    <label class="error" for="additional-content"></label>
                                </div>
    
                                <button id="btn-comment" type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button-blue-sky" data-upgraded=",MaterialButton,MaterialRipple">
                                    评论
                                <span class="mdl-button__ripple-container"><span class="mdl-ripple"></span></span></button>
                            </form>
                        </div>
    
                        <h6>评论列表</h6>
    
                        <div class="mdl-card__actions mdl-card--border comment-list--panel">
    
                                                        <p>暂无评论</p>
                            
                        </div>
                    </div>

                </div>
                <script src="js/jquery.wheelmenu.js" type="text/javascript"></script>
                <div class="QQ_each">
                    <a class="wheel-button float_qq" href="#wheel" style="opacity: 1;"></a>
                    <ul class="wheel" id="wheel">
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <!--<li class="item"><a target="_blank" href="#" class='sss'>沙僧</a></li>-->
                        <li class="item"><a class="bj" href="http://wpa.qq.com/msgrd?v=3&amp;uin=1538590175&amp;site=qq&amp;menu=yes" target="_blank">寻找<br>工作</a></li>
                        <li class="item"><a class="wk" href="http://wpa.qq.com/msgrd?v=3&amp;uin=3078167392&amp;site=qq&amp;menu=yes" target="_blank">发布<br>职位</a></li>
                        <li class="item"><a class="ts" href="http://wpa.qq.com/msgrd?v=3&amp;uin=6281927&amp;site=qq&amp;menu=yes" target="_blank">联系<br>我们</a></li>      
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                        <li class="item"><a href="#"></a></li>
                    </ul>
                </div>
                <a style="display:none" class="back_to_top" title="" href="#"></a>

                <script type="text/javascript">
                    $(".wheel-button").wheelmenu({
                        // alert(1);
                        trigger: "hover",
                        animation: "fly",
                        angle: [0, 360]
                    });
                </script>

            </div>

@endsection


@section('footer')
   @include('components.myfooter')
@endsection


@section('custom-script')
    <script>
                                        var techtag = "";
                                        var jieduan = "";
                                        var area = "";
                                        var xinkeywd = "";
                                        var currPage = parseInt("1");
                                        var totalPage = 0;
                                        $(function(){
                                        // 鼠标滑过边框变色
                                        $('.jieshao_list li').live('mouseover', function(){
                                        $(this).addClass('greenborder_li');
                                                $(this).siblings().removeClass('greenborder_li');
                                        });
                                                $('.jieshao_list li').live('mouseleave', function(){
                                        $(this).removeClass('greenborder_li');
                                        });
//                                                loadHotCompany();
                                        });
        // 加载热门企业信息
                                        function loadHotCompany() {
                                        var url = "/nas/getHotCompany";
                                                jQuery.ajax({
                                                type : 'get',
                                                        contentType : 'application/json; charset=utf-8',
                                                        dataType : 'json',
                                                        url : url,
                                                        data : {},
                                                        success : function(data) {
                                                        var companys = data['result'];
                                                                var html = "";
                                                                jQuery.each(companys, function(i, company) {
                                                                var imgLoge = "http://f.neipin.com/photo/company/" + company['company_logo'];
                                                                        var youshi = company['youshi'];
                                                                        var companyName = company['companyName'];
                                                                        var company_ltd = company['company_ltd'];
                                                                        if (company_ltd.length < 0){
                                                                company_ltd = companyName;
                                                                }
                                                                var company_id = company['company_id'];
                                                                        html = html +
                                                                        '<li class="major-item">' +
                                                                        '<a target="_blank" href="/c/' + company_id + '.html" >' +
                                                                        '<span class="tongyong_loge" style=\'background: rgba(0, 0, 0, 0) url("' + imgLoge + '") no-repeat scroll 0 0;z-index:2;background-size:114px 114px;-webkit-background-size: 114px 114px;\'></span>' +
                                                                        '<span class="back-face" >' +
                                                                        '<h2>' + company_ltd + '</h2>' +
                                                                        '<div>' + youshi + '</div>' +
                                                                        '</span>' +
                                                                        '</a>' +
                                                                        '</li>';
                                                                });
                                                                $('#hotCompanyList').html('');
                                                                $('#hotCompanyList').html(html);
                                                        },
                                                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                                                        alert(XMLHttpRequest.status);
                                                        }
                                                });
                                        }
        </script>
        
@endsection
