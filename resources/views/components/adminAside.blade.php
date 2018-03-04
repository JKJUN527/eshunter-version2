<!-- Side Bar-->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li
                        @if($title === 'dashboard')
                        class="active"
                        @endif
                >
                    <a href="/admin/dashboard">
                        <i class="material-icons">home</i>
                        <span>网站信息</span>
                    </a>
                </li>

                <li
                        @if($title === 'admin')
                        class="active"
                        @endif
                >
                    <a href="/admin/admin">
                        <i class="material-icons">verified_user</i>
                        <span>管理员</span>
                    </a>
                </li>

                <li
                        @if($title === 'enterprise')
                        class="active"
                        @endif
                >
                    <a href="/admin/enterprise">
                        <i class="material-icons">people</i>
                        <span>企业审核</span>
                    </a>
                </li>

                <li
                        @if($title === 'region')
                        class="active"
                        @endif
                >
                    <a href="/admin/region">
                        <i class="material-icons">place</i>
                        <span>地区</span>
                    </a>
                </li>

                <li
                        @if($title === 'industry')
                        class="active"
                        @endif
                >
                    <a href="/admin/industry">
                        <i class="material-icons">business</i>
                        <span>行业-职业</span>
                    </a>
                </li>
                <li
                        @if($title === 'egame')
                        class="active"
                        @endif
                >
                    <a href="/admin/egame">
                        <i class="material-icons">face</i>
                        <span>游戏-段位</span>
                    </a>
                </li>

                <li
                        @if($title === 'position')
                        class="active"
                        @endif
                >
                    <a href="/admin/position">
                        <i class="material-icons">work</i>
                        <span>已发布职位</span>
                    </a>
                </li>

                <li
                        @if($title === 'news')
                        class="active"
                        @endif
                >
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">subject</i>
                        <span>新闻</span>
                    </a>
                    <ul class="ml-menu">
                        <li
                                @if($subtitle === 'newsList')
                                class="active"
                                @endif
                        >
                            <a href="/admin/news">新闻列表</a>
                        </li>
                        <li
                                @if($subtitle === 'addNews')
                                class="active"
                                @endif
                        >
                            <a href="/admin/addNews">发布新闻</a>
                        </li>
                    </ul>
                </li>

                <li
                        @if($title === 'ad')
                        class="active"
                        @endif
                >
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">business_center</i>
                        <span>广告</span>
                    </a>
                    <ul class="ml-menu">
                        <li
                                @if($subtitle === 'adList')
                                class="active"
                                @endif
                        >
                            <a href="/admin/ads">广告列表</a>
                        </li>
                        <li
                                @if($subtitle === 'addAds')
                                class="active"
                                @endif
                        >
                            <a href="/admin/addAds">发布广告</a>
                        </li>
                    </ul>
                </li>

                <li
                        @if($title === 'resume')
                        class="active"
                        @endif
                >
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">contacts</i>
                        <span>临时简历</span>
                    </a>
                    <ul class="ml-menu">
                        <li
                                @if($subtitle === 'resumeList')
                                class="active"
                                @endif
                        >
                            <a href="/admin/resumes">简历列表</a>
                        </li>
                        <li
                                @if($subtitle === 'addresume')
                                class="active"
                                @endif
                        >
                            <a href="/admin/addresume">新增简历</a>
                        </li>
                    </ul>
                </li>

                <li class="header"></li>

                <li>
                    <a>
                        <i class="material-icons">person</i>
                        <span>欢迎 {{$username or 'xxx admin'}}</span>
                    </a>
                </li>

                <li>
                    <a id="cu-logout" href="/admin/logout">
                        <i class="material-icons">exit_to_app</i>
                        <span>退出</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:void(0);">&copy; 2017-2018|four2nine - dashboard</a>
                </li>
            </ul>
        </div>

    </aside>
    <!-- #END# Left Sidebar -->
</section>
<!-- #END# Side Bar-->
