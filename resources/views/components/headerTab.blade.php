<div class="header">
  <div class="header_con">
    <div class="logo-con">
      <a title="" href="#">
        <img src="../images/logo-black.png" style="height:43px;width:132px"></a>
      <span style="padding-left:10px;font-size:12px;color:#999;display: inline-block;margin-top: 25px;">电竞猎人 - 做专业的竞技游戏职业招聘网站</span></div>
    <ul class="nav_ul">
      <li id="cuan">
        @if($activeIndex === 1)
            <a class="home home_active" title="电竞猎人" href="/index/index">首页</a>
        @else
            <a class="home" title="电竞猎人" href="/index/index">首页</a>
        @endif
      </li>
      <li id="company">
        @if($activeIndex === 3)
            <a class="qiye home_active" title="" href="/jobs/jobs_search" rel="nofollow">职位搜索</a>
        @else
            <a class="qiye" title="" href="/jobs/jobs_search" rel="nofollow">职位搜索</a>
        @endif
        
      </li>
      <li class="pos_relative" id="xiu">
        @if($activeIndex === 6)
            <a class="xiu home_active" title="精准推荐" href="/master/master_lib" rel="nofollow">大神库</a>
        @else
            <a class="xiu" title="精准推荐" href="/master/master_lib" rel="nofollow">大神库</a>
        @endif
        
      </li>
      <li id="cuan">
        @if($activeIndex === 4)
            <a class="post_Jb home_active" title="" href="/news/news_center" rel="nofollow">资讯中心</a>
        @else
            <a class="post_Jb" title="" href="/news/news_center" rel="nofollow">资讯中心</a>
        @endif
      </li>
 
      <li id="person_center">
        @if($activeIndex === 2)
              @if($type === 1)
                  <a class="post_Jb home_active" title="" href="/news/news_center" rel="nofollow">个人中心</a>
              @elseif($type ===2)
                  <a class="post_Jb home_active" title="" href="/news/news_center" rel="nofollow">企业中心</a>
              @endif
          @else
              @if($type === 1)
                  <a class="post_Jb" title="" href="/news/news_center" rel="nofollow">个人中心</a>
              @elseif($type ===2)
                  <a class="post_Jb" title="" href="/news/news_center" rel="nofollow">企业中心</a>
              @endif
          @endif
        </li>
    </ul>
  </div>
</div>