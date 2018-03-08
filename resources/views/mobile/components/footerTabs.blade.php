<footer
        class="esh-tabs-container esh-layout__footer {{$styles or null}}"
        id="{{empty($id) ? 'esh-layout-footer' : $id}}"
>
    <div class="esh-tabs">
        <a class="esh-tabs__tab {{$activeIndex === 0 ? 'is-active' : null}}" href="/m/index">
            <i class="material-icons">home</i>
            <span class="esh-tabs__text">首页</span>
        </a>
        <a class="esh-tabs__tab {{$activeIndex === 1 ? 'is-active' : null}}" href="/m/position/advanceSearch">
            <i class="material-icons">view_list</i>
            <span class="esh-tabs__text">职位</span>
        </a>
        <a class="esh-tabs__tab {{$activeIndex === 2 ? 'is-active' : null}}" href="/m/news/">
            <i class="material-icons">sms</i>
            <span class="esh-tabs__text">资讯</span>
        </a>
        <a class="esh-tabs__tab {{$activeIndex === 3 ? 'is-active' : null}}" href="/m/account/index">
            <i class="material-icons">{{(isset($data['type']) and $data['type'] == 2) ? 'account_balance' : 'person'}}</i>
            <span class="esh-tabs__text">{{(isset($data['type']) and $data['type'] == 2) ? '企业' : '我'}}</span>
        </a>
    </div>
</footer>