(function () {

    /*
     fix 返回刷新问题
     */
    window.onpageshow = function (e) {
        var needRefresh = sessionStorage.getItem("need-refresh");
        if(needRefresh){
            sessionStorage.removeItem("need-refresh");
            location.reload();
        }
    };

    var stopEvent,
        goPage,
        pageBack,
        loadList,
        createListItemDoc,
        createListItem,
        createListItemPrompt,
        createListItemPrimaryContent,
        createListItemSecondaryContent,
        createListItemImage,
        ESH_TYPE = {
            job: 'job',
            information: 'information'
        },
        ESH_LIST_LOAD_CLASS = 'esh-list__item-load';

    stopEvent = function (evt) {
        evt.stopPropagation();
        evt.preventDefault();
        return false;
    };


    goPage = function (options) {
        window.location = options.url;
    };

    createListItemImage = function (item, option) {
        var img;

        img = document.createElement('img');
        img.className = 'esh-list__item-image';
        return img;
    };

    createListItemPrimaryContent = function (item, option) {
        var container, title, textBody, info, badge, txt;
        option = option || {};

        container = document.createElement('div');
        container.className = 'mdl-list__item-primary-content esh-list__item-primary-content';

        title = document.createElement('span');
        title.className = 'esh-list_item-title';
        title.textContent = item.title || ' ';

        textBody = document.createElement('span');
        textBody.className = 'mdl-list__item-text-body esh-list__item-text-body';

        info = document.createElement('span');
        info.className = 'esh-list__item-secondary-info';
        info.textContent = item.info;

        switch (option.type) {
            case ESH_TYPE.job:

                badge = document.createElement('span');
                badge.className = 'esh-list__item-secondary-info';
                badge.textContent = item.badge;

                txt = document.createElement('span');
                txt.className = 'esh-list__item-text';
                txt.textContent = item.textContent || ' ';

                info.classList.add('esh-list__item-badge');

                break;
            case ESH_TYPE.information:
                info.textContent = item.dateTime;
                break;
            default:
                break;
        }

        info && textBody.appendChild(info);
        badge && textBody.appendChild(badge);
        txt && textBody.appendChild(txt);

        container.appendChild(title);
        container.appendChild(textBody);
        return container;
    };

    createListItemSecondaryContent = function (item, option) {
        var container, info, date;

        container = document.createElement('div');
        container.className = 'mdl-list__item-secondary-content esh-list__item-secondary-content';

        info = document.createElement('span');
        info.className = 'mdl-list__item-secondary-info';
        info.textContent = item.salary || '薪酬面议';

        date = info.cloneNode(false);
        date.textContent = item.dateTime || '今天';

        container.appendChild(info);
        container.appendChild(date);

        return container;

    };

    createListItemPrompt = function (txt) {
        var listItem, text;
        listItem = document.createElement('li');
        listItem.className = 'esh-list__item esh-list__item-load';

        text = document.createElement('span');
        text.className = 'esh-list__item-load-text mdl-color-text--blue';
        text.textContent = txt || '加载更多';

        listItem.appendChild(text);

        return listItem;

    };

    createListItem = function (item, option) {
        var listItem, img;

        option = option || {};
        listItem = document.createElement('li');
        listItem.className = 'mdl-list__item mdl-list__item--three-line esh-list__item';
        if (option.type === 'information') {
            listItem.setAttribute('data-content', item.nid);
        }


        img = createListItemImage();

        listItem.appendChild(img);
        listItem.appendChild(createListItemPrimaryContent(item, option));

        switch (option.type) {
            case ESH_TYPE.job:
                listItem.classList.add('mdl-list__item--three-line');
                listItem.appendChild(createListItemSecondaryContent(item, option));
                break;
            case ESH_TYPE.information:
                listItem.classList.add('esh-list__item--two-line');
                break;
            default:
                break;
        }

        img.src = item.image;

        return listItem;

    };

    createListItemDoc = function (list, option) {
        var doc, i, len, item;

        if (!Array.isArray(list) || !list.length) {
            return false;
        }

        doc = document.createDocumentFragment();
        len = list.length;

        for (i = 0; i < len; i++) {
            item = list[i];
            doc.appendChild(createListItem(item, option));
        }

        return doc;

    };

    loadList = function (data) {
        var action, callback, targetId, doc, listItemLoad, targetEl;

        if (!data || !data.option || !data.option.targetId || !data.option.action) {
            return false;
        }

        targetId = data.option.targetId;
        action = data.option.action;
        callback = data.option.callback;
        doc = createListItemDoc(data.listData, data.option);

        if (!doc) {
            return false;
        }

        targetEl = document.querySelector('#' + targetId);

        switch (action) {
            case 'append':
                listItemLoad = targetEl && targetEl.querySelector('.' + ESH_LIST_LOAD_CLASS);
                listItemLoad && targetEl.removeChild(listItemLoad);
                break;
            case 'reload':
                targetEl.innerHTML = '';
                break;
            default:
                break;
        }

        data.option.hasLoad && doc.appendChild(createListItemPrompt(data.option.loadText));
        targetEl.appendChild(doc);

        if (typeof callback === 'function') {
            callback(data);
        }
    };


    pageBack = function (options) {
        window.history.back();
    };

    var fillSpan = function () {
        // esh-sval 填充值
        $(".esh-select-option").each(function () {
            $(this).prev().html($(this).find("option:selected").text());
        });
        //点击select选项框
        $(".esh-select-option").change(function () {
            $(this).prev().html($(this).find("option:selected").text());
        });
    };
    var getElementsByName = function (formId) {
        var accountArray = $("#" + formId).serializeArray();
        var formData = new FormData();
        var ranges = [
            '\ud83c[\udf00-\udfff]',
            '\ud83d[\udc00-\ude4f]',
            '\ud83d[\ude80-\udeff]'
        ];
        $.each(accountArray, function () {
            var valueStr = (this.value).replace(new RegExp(ranges.join('|'), 'g'), '');
            formData.append(this.name, valueStr);
        });
        return formData;
    };
    var setError = function (element, forStr, errorStr) {
        element.next().addClass('esh-info-error');
        $(".esh-info-error[for='" + forStr + "']").html(errorStr);
        element.focus();
    };

    var removeError = function (element, forStr) {
        $(".esh-info-error[for='" + forStr + "']").html("");
        element.next().removeClass('esh-info-error');
    };
    var isEmojiCharacter = function (substring) {
        for ( var i = 0; i < substring.length; i++) {
            var hs = substring.charCodeAt(i);
            if (0xd800 <= hs && hs <= 0xdbff) {
                if (substring.length > 1) {
                    var ls = substring.charCodeAt(i + 1);
                    var uc = ((hs - 0xd800) * 0x400) + (ls - 0xdc00) + 0x10000;
                    if (0x1d000 <= uc && uc <= 0x1f77f) {
                        return true;
                    }
                }
            } else if (substring.length > 1) {
                var ls = substring.charCodeAt(i + 1);
                if (ls == 0x20e3) {
                    return true;
                }
            } else {
                if (0x2100 <= hs && hs <= 0x27ff) {
                    return true;
                } else if (0x2B05 <= hs && hs <= 0x2b07) {
                    return true;
                } else if (0x2934 <= hs && hs <= 0x2935) {
                    return true;
                } else if (0x3297 <= hs && hs <= 0x3299) {
                    return true;
                } else if (hs == 0xa9 || hs == 0xae || hs == 0x303d || hs == 0x3030
                    || hs == 0x2b55 || hs == 0x2b1c || hs == 0x2b1b
                    || hs == 0x2b50) {
                    return true;
                }
            }
        }
    };
    var filteremoji = function (str){
        var ranges = [
            '\ud83c[\udf00-\udfff]',
            '\ud83d[\udc00-\ude4f]',
            '\ud83d[\ude80-\udeff]'
        ];
        str = str.replace(new RegExp((ranges.join('|'), 'g'), ''));
        return str;
}

    this.ESHUtils = {
        stopEvent: stopEvent,
        loadList: loadList,
        goPage: goPage,
        pageBack: pageBack,
        fillSpan: fillSpan,
        getElementsByName: getElementsByName,
        setError: setError,
        removeError: removeError,
        isEmojiCharacter:isEmojiCharacter,
        filteremoji: filteremoji

    };


    $(function () {
        var $ESHTabs = $('#esh-tabs'),
            $ESHCurrentTab = $ESHTabs.children('.is-active') || null;

        $ESHTabs.on('click', '.esh-tabs__tab', function (evt) {
            var url, tabId, $this = $(this);

            tabId = $this.attr('id');

            if (!$ESHCurrentTab || $ESHCurrentTab.attr('id') !== tabId) {
                url = tabId.replace('esh-tab-', '');
                $this.siblings().removeClass('is-active').end().addClass('is-active');
                $ESHCurrentTab = $this;
                goPage({url: '../' + url + '/' + url + '.html'});
            }

            return stopEvent(evt);
        });

        $(document).on('click', '.esh-layout-icon--left', function (evt) {

            pageBack();

            return stopEvent(evt);
        });

        $(document).on('click', '.esh-layout-reload-icon--left', function (evt) {
            if (sessionStorage) {
                sessionStorage.setItem("need-refresh", true);
            }

            pageBack();

            // pageBack();

            return stopEvent(evt);
        });

    });
})();