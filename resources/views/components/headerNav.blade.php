<div id="es_tbar">
    <div class="inner">
        <div class="es_tbar_l">
            <span class="iconfont icon-shouji"></span>
            <a class="es_app" id="change_to_app"  style="display: none;" href="/m" rel="nofollow">切换到手机版 |</a>
            <a class="es_app" href="/searchcompany" rel="nofollow">电竞黄页</a>
            {{--@if($type == 1)--}}
                {{--<a class="es_os" href="#" rel="nofollow">进入企业版</a>--}}
            {{--@endif--}}
        </div>
        <ul class="es_tbar_r">

            @if($uid != 0)
                <li>
                    <a class="message" href="/message">消息<em class="msg_amount" id="headMsgAmount">{{$personInfo['messageNum']}}</em></a>
                </li>
                @if($type ==1)
                    <li><a href="/account" style="border-left:none;">我的简历</a></li>
                    <li><a href="/position/applyList">投递箱<em class="msg_amount" id="headMsgAmount">{{$personInfo['deliveredNum']}}</em></a></li>
                    <li class="user_dropdown">
                        <a href="/account">{{$personInfo['username']}}<span></span></a>
                        <ul>
                            <!-- <li><a href="">我的订阅</a></li> -->
                            <!-- <li><a href="">职位邀请</a></li> -->
                            <li><a href="/account/edit">账号设置</a></li>
                            <li><a href="/account/checkout">去企业版</a></li>
                            <li><a href="/account/logout">退出</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/position/publishList" style="border-left:none;">已发布职位</a></li>
                    <li><a href="/position/deliverList">收到简历记录</a></li>
                    <li class="user_dropdown">
                        <a href="/account">{{$personInfo['username']}}<span></span></a>
                        <ul>
                            <!-- <li><a href="">我的订阅</a></li> -->
                            <!-- <li><a href="">职位邀请</a></li> -->
                            <li><a href="/account/edit">账号设置</a></li>
                            <li><a href="/account/checkout">去个人版</a></li>
                            <li><a href="/account/logout">退出</a></li>
                        </ul>
                    </li>
                @endif
            @else
                <li>
                    <a class="message" href="/account/login">个人登录</a>
                </li>
                <li>
                    <a href="/account/login">企业登录</a>
                </li>
                <li>
                    <a href="/account/register">免费注册</a>
                </li>
            @endif

        </ul>
    </div>
</div> 