/**
 * Created by Love_sandy on 17-12-16.
 */


(function(){

    var openModal,
        closeModal,
        updateFilter,
        updateSelectedElement,
        resetSelectedElement,
        updateCityArea,
        updateJobList,
        ESHUtils = this.ESHUtils,
        stopEvent = this.ESHUtils.stopEvent,
        filterKeys = ['industry','salary','work_nature','region-city','region-pro','orderBy','desc'],
        filterData = {
            industry:{
                val: '',
                text: '',
                selected: null,
                tempSelected: null,
                defaultText: '行业'
            },
            salary:{
                val: '',
                text: '',
                selected: null,
                tempSelected: null,
                defaultText: '薪酬'
            },
            'work_nature':{
                val: '',
                text: '',
                selected: null,
                tempSelected: null,
                defaultText: '类型'
            },
            'region-pro':{
                val: '',
                text: '',
                selected: null,
                tempSelected: null,
                defaultText: '地区'
            },
            'region-city':{
                val: '',
                text: '',
                selected: null,
                tempSelected: null,
                defaultText: '城市'
            },
            orderBy:{
                val: '',
                text: '',
                selected: null,
                tempSelected: null,
                defaultText: '热度'
            },
            desc:{
                val: '1',
                text: '',
                selected: null,
                tempSelected: null,
                defaultText: '降序'
            },
            toModel:function(){
                var key, i, len = filterKeys.length, model = {};

                for(i=0;i<len;i++){
                    key = filterKeys[i];
                    model[key] = filterData[key].val;
                }

                return model;


            }
        },
        ESH_CONSTANT = {
            MODAL_ID: 'esh-modal-filter',
            MODAL_BODY_ID: 'esh-modal-body',
            MODAL_BUTTON_CLASS: 'mdl-button',
            PAGE_HEADER_ID: 'esh-layout-header',
            PAGE_SUB_HEADER_ID: 'esh-layout-sub-header',
            SEARCH_FORM_ID: 'esh-search-form',
            FILTER_KEY_LIST_CLASS: 'esh-list--magnetic',
            FILTER_KEY_LIST_ITEM_CLASS: 'esh-list__item',
            FILTER_KEY_LIST_LINK_CLASS: 'esh-list__link',
            PRIMARY_LIST_ID: 'esh-primary-list',
            PRIMARY_LIST_ITEM_CLASS: 'esh-list__item',
            PRIMARY_LIST_ITEM_LOAD_CLASS: 'esh-list__item-load',
            PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS: 'esh-list__item-load-text',
            PRIMARY_LIST_ITEM_LOAD_TEXT_ID: 'esh-primary-list-load-text',
            NAV_LINK_PREFIX: 'esh-nav-link-',
            NAV_LINK_CLASS: 'esh-navigation__text',
            NAV_LINK_TEXT_CLASS: 'esh-navigation__text',
            TABS_TAB_PREFIX: 'esh-tabs-tab-',
            TABS_PANEL_PREFIX: 'esh-tabs-panel-',
            SEARCH_INPUT_ID: 'esh-search-input',
            ACTION_LOADING_MORE: 'load-more',
            ACTION_ENTER: 'enter',
            ACTION_CANCEL:'cancel'
        },

        $modal = $('#' + ESH_CONSTANT.MODAL_ID),
        $searchForm = $('#' + ESH_CONSTANT.SEARCH_FORM_ID);

    openModal = function(evt){

        $modal && $modal.fadeIn(100);

        return stopEvent(evt);
    };

    closeModal = function(evt){

        $modal && $modal.fadeOut(100);

        return stopEvent(evt);
    };


    updateFilter = function(){
        var key, i, len = filterKeys.length;

        for(i=0; i<len; i++){
            key = filterKeys[i];
            $('#' + ESH_CONSTANT.NAV_LINK_PREFIX + key).children('.' + ESH_CONSTANT.NAV_LINK_TEXT_CLASS).text(filterData[key].text || filterData[key].defaultText);
        }
    };

    updateSelectedElement = function(){
        var key, i, len = filterKeys.length;

        for(i=0;i<len;i++){
            key = filterKeys[i];
            if(!filterData[key].tempSelected) {
                continue;
            }

            filterData[key].selected = filterData[key].tempSelected.siblings().removeClass('is-active').end().addClass('is-active');
            filterData[key].val = filterData[key].selected.data('content') === -1 ? '' : filterData[key].selected.data('content');
            filterData[key].text = filterData[key].selected.find('.' + ESH_CONSTANT.FILTER_KEY_LIST_LINK_CLASS).text();

            if(key === 'region-pro') {
                filterData[key].text = filterData['region-city'].selected.find('.' + ESH_CONSTANT.FILTER_KEY_LIST_LINK_CLASS).text();
            }

            filterData[key].tempSelected = null;
        }
    };

    resetSelectedElement = function(){
        var key, i, len = filterKeys.length;

        for(i=0;i<len;i++){
            key = filterKeys[i];
            filterData[key].tempSelected = null;

            if(!filterData[key].selected) {
                continue;
            }

            filterData[key].selected.siblings().removeClass('is-active').end().addClass('is-active');

        }
        updateCityArea(filterData['region-pro'].val || '-1');
    };

    updateCityArea = function (proId) {
        var $items, parentId = parseInt(proId);

        $items = $('#' + ESH_CONSTANT.TABS_PANEL_PREFIX + 'region-city').find('.esh-list__item');

        if(typeof parentId !== 'number'){
            $items.show();
        }else if(parentId < 0) {
            $items.show();
        }else {
            $.each($items,function (i,item) {
                var $item = $(item);

                if(!i) {
                    return;
                }

                return parseInt($item.data('parentid')) === parentId ? $item.show() : $item.hide();
            });
        }
    };


    updateJobList = function (list) {
        var i, len, data, $container, $item, $image,
            $primaryContent,$title,$textBody,
            $primaryInfo,$itemText,$secondaryContent,
            $secondaryInfo1,$secondaryInfo2;


        if(!Array.isArray(list) || !list.length) {
            return;
        }

        len = list.length;

        $container = $('<div/>');

        for(i = 0; i < len; i++) {
            data = list[i];
            $item = $('<li/>',{'class': 'mdl-list__item mdl-list__item--three-line esh-list__item','data-pid': data.pid});
            $image = $('<img/>',{'class':'esh-list__item-image',src: data.elogo || '/mobile/styles/default/images/avatar.png'});
            $primaryContent = $('<div/>',{'class': 'mdl-list__item-primary-content esh-list__item-primary-content'});
            $title = $('<span/>',{'class': 'esh-list_item-title'}).text(data.title || '没有填写职位名称');
            $textBody = $('<span/>',{'class': 'mdl-list__item-text-body esh-list__item-text-body'});
            $primaryInfo = $('<span/>',{'class':'esh-list__item-secondary-info'}).text(data.name);
            $itemText = $('<span/>',{'class':'esh-list__item-text'}).text(data.byname || data.ename || '未知企业');
            $secondaryContent = $('<div/>',{'class':'mdl-list__item-secondary-content esh-list__item-secondary-content'});
            $secondaryInfo1 = $('<span/>',{'class':'mdl-list__item-secondary-info mdl-typography--text-right'}).text(data.salary <= 0 ? '月薪面议' : data.salary + '-' + (data.salary_max || '无上限'));
            $secondaryInfo2 = $('<span/>',{'class':'mdl-list__item-secondary-info'}).text((data.updated_at && data.created_at.substring(0,10)) || '今天');

            $secondaryInfo1.append($('<br/>')).append($('<span/>').text('元/月'));
            $textBody.append($primaryInfo).append($itemText);
            $primaryContent.append($title).append($textBody);
            $secondaryContent.append($secondaryInfo1).append($secondaryInfo2);
            $item.append($image).append($primaryContent).append($secondaryContent);
            $container.append($item);
        }

        return $container;
    };



    $(function(){

        $.each(filterKeys, function (i, key) {
            var $tabPanel = $('#' + ESH_CONSTANT.TABS_PANEL_PREFIX + key),
            $item = $tabPanel.find('.is-active');

            if(filterData[key]){
                filterData[key].selected = $item;
                filterData[key].val = $item.data('content') === -1 ? '' : $item.data('content');
                filterData[key].text = $item.data('content') === -1 ? '' : $item.find('.esh-list__link').text();


                if(key === 'region-pro' && filterData['region-city'].val) {
                    filterData[key].text = filterData['region-city'].text;
                }
            }
        });

        updateFilter();

        updateCityArea(filterData['region-pro'].val || '-1');

        $modal.on('click',function(evt){

            var $target = $(evt.target);

            if($target.attr('id') === ESH_CONSTANT.MODAL_ID) {
                closeModal(evt);
            }
            return stopEvent(evt);
        }).on('click','.' + ESH_CONSTANT.MODAL_BUTTON_CLASS, function(evt){
            var $this = $(this);

            switch($this.data('action').toLowerCase()){
                case ESH_CONSTANT.ACTION_CANCEL:
                    resetSelectedElement();
                    break;
                case ESH_CONSTANT.ACTION_ENTER:
                    updateSelectedElement();
                    updateFilter();
                    $searchForm && $searchForm.trigger('submit');
                    break;
                default:
                    break;
            }

            return closeModal(evt);
        });



        $('#' + ESH_CONSTANT.PAGE_SUB_HEADER_ID).on('click', '.esh-js-modal-trigger', function(evt){

            var linkId, tabName, $this = $(this);

            linkId = $this.attr('id');
            tabName = linkId && linkId.replace(ESH_CONSTANT.NAV_LINK_PREFIX, '');

            if(!tabName) {
                return stopEvent(evt);
            }

            $('#' + ESH_CONSTANT.TABS_TAB_PREFIX + tabName).siblings().removeClass('is-active').end().addClass('is-active');
            $('#' + ESH_CONSTANT.TABS_PANEL_PREFIX + tabName).siblings().removeClass('is-active').end().addClass('is-active');

            filterData[tabName].selected && filterData[tabName].selected.addClass('is-active').siblings().removeClass('is-active');
            return  openModal(evt);
        });

        $('#' + ESH_CONSTANT.MODAL_BODY_ID).on('click','.' + ESH_CONSTANT.FILTER_KEY_LIST_ITEM_CLASS, function(evt){
            var key, clickEvent, cityObj, activeCity, $this = $(this);

            key = $this.data('key');

            if(!key || !filterData[key]) {
                return stopEvent(evt);
            }

            if(key === 'region-pro') {
                updateCityArea($this.data('content'));
                cityObj = filterData['region-city'];
                activeCity = cityObj.selected;

                if(activeCity.data('parentid') !== $this.data('content')){
                    cityObj.tempSelected = activeCity.parent().find(':first').siblings().removeClass('is-active').end().addClass('is-active');
                }else {
                    activeCity.siblings().removeClass('is-active').end().addClass('is-active');
                }

                clickEvent = new MouseEvent('click', {
                    cancelable: true,
                    bubble: true,
                    view: window
                });

                document.querySelector('#' + ESH_CONSTANT.TABS_TAB_PREFIX + 'region-city').dispatchEvent(clickEvent);
            }

            $this.addClass('is-active').siblings().removeClass('is-active');


            filterData[key].tempSelected = $this;

            return stopEvent(evt);
        });

        $('#' + ESH_CONSTANT.SEARCH_INPUT_ID).attr('placeholder','输入职位进行搜索...').on();

        $('#' + ESH_CONSTANT.PRIMARY_LIST_ID).on('click', '.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_CLASS,function(evt){
            var model, keyword, page, $list, $this = $(this);

            if($this.hasClass(ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_CLASS)) {
                page = $this.data('page') || 1;

                if(page < 0){
                    return stopEvent(evt);
                }

                keyword = $('#' + ESH_CONSTANT.SEARCH_INPUT_ID).val().trim();
                model = filterData.toModel();
                model['keyword'] = keyword;
                model['isSearch'] = true;
                model['page'] = page < 2 ? 2 : page;

                $.ajax({
                    type:'post',
                    url: '/m/position/advanceSearch',
                    dataType:'json',
                    data:$.param(model),
                    success: function (data) {
                        var position = data['position'];

                        if(!data || !position || !position.data) {
                            return;
                        }

                        $list = updateJobList(position.data);

                        if($list && $list.children().length) {
                            $this.before($list.unwrap());
                        }

                        if(page === position['last_page']) {
                            $this.data('page',-1).addClass('mdl-color-text--grey').text('职位全部加载完了～');
                        }else {
                            $this.data('page',position['current_page'] + 1);
                        }
                    },
                    error: function (err) {
                        swal({title:'提示','text': '网络错误，请稍后再试！'});
                    }
                });



                return stopEvent(evt);
            }

            ESHUtils.goPage({url: "/m/position/detail?pid=" + $this.data('pid')});

            return stopEvent(evt);
        });

        $searchForm.on('submit', function(evt){
            var keyword, model,url = '/m/position/advanceSearch';

            keyword = $('#' + ESH_CONSTANT.SEARCH_INPUT_ID).val().trim();
            model = filterData.toModel();
            model['keyword'] = keyword;
            model['isSearch'] = true;
            ESHUtils.goPage({url: url + '?' + $.param(model)});

            return stopEvent(evt);
        }).on('click', '.esh-button--icon', function(evt){
            $searchForm.trigger('submit');
            return stopEvent(evt);
        });

    });
})();