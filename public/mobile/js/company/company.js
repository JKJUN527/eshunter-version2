/**
 * Created by root on 17-12-31.
 */

(function(){

    var ESHUtils = this.ESHUtils;

    $(function(){

        var ESH_CONSTANT = {
            PRIMARY_LIST_ID:'esh-company-list',
            PRIMARY_LIST_ITEM_LOAD_CLASS:'esh-list__item-load',
            PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS: 'esh-list__item-load-text',
            PRIMARY_LIST_ITEM_CLASS: 'esh-list__item'
        };

        $('#' + ESH_CONSTANT.PRIMARY_LIST_ID).on('click','.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_TEXT_CLASS, function(evt){
            ESHUtils.loadList({
                listData:[
                    {
                        title:'上海网映文化传播股份有限公司',
                        image: 'http://www.eshunter.com/storage/adpic/2017-11-13-18-02-50-5a096dcab6cb6adpic.png',
                        info: ' 电竞传媒/电竞赛事'
                    },
                    {
                        title:'乐竞文化传媒（上海）有限公司',
                        image: 'http://www.eshunter.com/storage/adpic/2017-10-23-15-02-08-59ed93f04d866adpic.png',
                        info: ' 电竞内容运营'
                    },
                    {
                        title:'津联盟电竞互联网科技有限公司北京分公司',
                        image: 'http://www.eshunter.com/storage/adpic/2017-11-17-14-38-26-5a0e83e2171c6adpic.png',
                        info: ' 电竞赛事/电竞馆'
                    }
                ],
                option: {
                    type: 'information',
                    action: 'append',
                    targetId: ESH_CONSTANT.PRIMARY_LIST_ID,
                    hasLoad: true,
                    callback:function(data){
                        console.log('success!');
                    }
                }

            });
        }).on('click', '.' + ESH_CONSTANT.PRIMARY_LIST_ITEM_CLASS,function(evt){
            var $this = $(this);

            if($this.hasClass(ESH_CONSTANT.PRIMARY_LIST_ITEM_LOAD_CLASS)) {
                return stopEvent(evt);
            }

            ESHUtils.goPage({url:'companyView.html'});

        });
    });

})();