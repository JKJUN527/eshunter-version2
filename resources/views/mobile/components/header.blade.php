<header
        class="mdl-layout__header mdl-layout__header--seamed esh-layout__header {{$styles or null}}"
        id="{{empty($id) ? 'esh-layout-header' : $id}}"
>
    @isset($buttonLeft)
        <div class="mdl-layout-icon esh-layout-icon--left">
            <i class="material-icons esh-icon">{{is_string($buttonLeft) ? $buttonleft : 'navigate_before'}}</i>
        </div>
    @endisset

    @if(isset($rightContent) or isset($buttonRight))
        <div class="mdl-layout-icon esh-layout-icon--right">
            @if(!empty($rightContent))
                {!! $rightContent !!}
            @elseif(!empty($buttonRight))
                <i class="material-icons esh-icon">{{$buttonRight}}</i>
            @endif
        </div>
    @endif
    <div class="mdl-layout__header-row esh-layout__header-row {{(!empty($buttonLeft) or !empty($buttonRight)) ? 'esh-layout__header-row--has-button' : null}}">
        @if(empty($logo))
            <span class="mdl-layout__title esh-layout__title">{{$title or '电竞猎人'}}</span>
        @else
            <span class="mdl-layout__title esh-layout__title">
                <span class="esh-layout__logo" style="background-image: url({{asset('mobile/styles/default/images/logo-header.png')}})">{{$title or '电竞猎人'}}</span>
            </span>
        @endif
    </div>
</header>