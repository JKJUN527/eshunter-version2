/**
 * Created by asusps on 2017/12/28.
 */
(function(){

    $(function(){

        $("#add-resume").click(function(){//添加简历
            $.ajax({
                url: "/m/resume/addResume",
                type: "get",
                success: function (data) {
                    if (data['status'] === 200) {
                        self.location = "/m/resume/add?rid=" + data['rid'];
                    } else if (data['status'] === 400) {
                        swal(data['msg']);
                    }
                }
            });
        });
    });
    /*$("#del-resume").click(function(){ //删除简历
        $.ajax({
            url: "/resume/delResume",
            type: "get",
            success: function (data) {
                if (data['status'] === 200) {
                    $()
                } else if (data['status'] === 400) {
                    alert(data['msg']);
                }
            }
        });
    })*/
})();
