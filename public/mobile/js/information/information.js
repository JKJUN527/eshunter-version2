/**
 * Created by Love_sandy on 17-12-16.
 */


(function () {

    var stopEvent = this.ESHUtils.stopEvent,
        ESH_CONSTANT = {
            ESH_INFO_LIST_PRIMARY_CLASS: 'esh-media-list',
            ESH_INFO_LIST_PRIMARY_ID: 'esh-info-primary-newest',
            PRIMARY_LIST_ITEM_CLASS: 'esh-list__item',
            PRIMARY_LIST_ITEM_LOAD_CLASS: 'esh-list__item-load',
            PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS: 'esh-list__item-load-text',
        };

    var getAppendListData = function (result) {

        var newsArr = [];

        for (var i = 0; i < result.news.length; i++) {
            var listObj = result.news[i];
            var pictureStr = listObj.picture;
            var imgUrl = pictureStr.substring(0, pictureStr.indexOf("@") - 1) + pictureStr.substring(pictureStr.indexOf("@") + 1, pictureStr.indexOf(";"));
            var newsObj = {
                image: imgUrl,
                title: listObj.title.substring(0, 30),
                dateTime: listObj.created_at.substring(0, 10),
                nid: listObj.nid
            };
            newsArr.push(newsObj);
        }


        // console.log(this.id);
        //
        return {
            listData: newsArr,
            option: {
                type: 'information',
                action: 'append',
                hasLoad: true,
                targetId: ESH_CONSTANT.ESH_INFO_LIST_PRIMARY_ID,
                callback: function (data) {
                    console.log('success!');
                }
            }
        };
    };

    var loadMore = function () {
        //减去加载更多
        var listLength = $("#esh-info-primary-newest li").length - 1;
        var type = $(".mdl-tabs__tab.esh-tabs_news___tab.is-active").attr('data-content');

        var formData = new FormData();

        formData.append("type", type);
        formData.append("currentNum", String(listLength));
        formData.append("needNum", String(5));
        $.ajax({
            url: "/m/news/loadMore",
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            type: "post",
            data: formData,
            success: function (data) {
                var result = JSON.parse(data);
                if (result.status === 200) {

                    var appendList = getAppendListData(result);
                    // console.log(appendList);
                    ESHUtils.loadList(appendList);

                    // $("#esh-main-div-getVerify").css("display", "none");
                    // $("#esh-main-div-resetPwd").css("display", "block");
                } else {
                    swal({
                        title: "错误",
                        text: "加载更多出错",
                        confirmButtonText: "关闭"
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                swal({
                    title: xhr.status + "：" + thrownError,
                    confirmButtonText: "关闭"
                });
            }
        });
    };


    $('.mdl-tabs__tab-bar').on('click', '.esh-tabs_news___tab', function (event) {
        event.preventDefault();
        // $(this).addClass('is-active').siblings('a').removeClass('is-active');
        self.location = "/m/news?newtype=" + $(this).attr('data-content');
    });
    $('.esh-tabs__tab-bar-sub').on('click', '.esh-tabs__tab', function (event) {
        event.preventDefault();
        $(this).addClass('is-active').siblings('a').removeClass('is-active');
        if ($(this)[0].id === 'esh-tabs-tab-newest') {
            $("#esh-info-primary-hottest").css("display", "none");
            $("#esh-info-primary-newest").css("display", "block");
        } else {
            $("#esh-info-primary-newest").css("display", "none");
            $("#esh-info-primary-hottest").css("display", "block");

        }
        // self.location = "/news?newtype=" + $(this).attr('data-content');
    });


    // 加载更多点击事件监听
    $('.' + ESH_CONSTANT.ESH_INFO_LIST_PRIMARY_CLASS).on('click', '.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS, function (evt) {
        // ESHUtils.loadList(getListData('append'));
        loadMore();
    }).on('click', '.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_CLASS, function (evt) {
        var $this = $(this);
        if ($this.hasClass(ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_CLASS)) {
            return stopEvent(evt);
        }
        window.location = '/m/news/detail?nid=' + $(this).attr('data-content');
    });

    // $(document).ready(function () {
    //     if (document.body.clientWidth < 1400 && $('.bs-docs-sidebar').offset().top - $(document).scrollTop() < 10) {
    //         $('.bs-docs-sidebar').addClass('fixed');
    //     }
    //     $(window).scroll(function () {
    //         if (document.body.clientWidth < 1400 && $('.bs-docs-sidebar').offset().top - $(document).scrollTop() < 10) {
    //             $('.bs-docs-sidebar').addClass('fixed');
    //         }
    //         if (document.body.clientWidth < 1400 && $('.bs-docs-sidebar').offset().top < 200) {
    //             $('.bs-docs-sidebar').removeClass('fixed');
    //         }
    //     });
    // });

})();