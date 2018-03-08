/**
 * Created by asusps on 2018/1/13.
 */
(function(){
    $(function(){
        if(sessionStorage.getItem("need-refresh")){
            location.reload();
            sessionStorage.removeItem("need-refresh");
        }
        /*if(window.name != "origin"){ //强制刷新
            location.reload();
            window.name = "origin";
        }else{
            window.name = "";
        }*/
        $(".esh-href-page").click(function(){
            var url = $(this).data("esh-href");
            window.location.href = url;
        });
        $(".esh-edu-del").click(function () { //删除教育经历
            var id = $(this).data("content-id");
            swal({
                title: "确认",
                text: "确定删除该条教育经历吗",
                // type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/m/resume/deleteEducation?eduid=" + id,
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });
        $(".esh-del-work").click(function () {
            var id = $(this).data("content-id");
            swal({
                title: "确认",
                text: "确定删除该条工作经历吗",
                // type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "/m/resume/deleteWorkexp?id=" + id,
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });
        $(".esh-del-project").click(function () {
            var id = $(this).data("content-id");
            swal({
                title: "确认",
                text: "确定删除该条项目经历吗",
                // type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/m/resume/deleteProjectexp?id=" + id,
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });
        $(".esh-del-game").click(function(){
            var id = $(this).data("content-id");
            swal({
                title: "确认",
                text: "确定删除该条电竞经历吗",
                // type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {

                $.ajax({
                    url: "/m/resume/deleteGame?id=" + id,
                    type: "get",
                    success: function (data) {
                        swal(data['status'] === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });
        $(".esh-del-skill").click(function(){
            swal({
                title: "确认",
                text: "确定删除该条技能特长吗",
                // type: "info",
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                showCancelButton: true,
                closeOnConfirm: false
            }, function () {
                var formData = new FormData();
                formData.append('rid', $("input[name='rid']").val());
                formData.append('tag', $("#skill-content").html());

                $.ajax({
                    url: "/m/resume/deleteSkill",
                    type: "post",
                    dataType: 'text',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (data) {
                        var result = JSON.parse(data);
                        swal(result.status === 200 ? "删除成功" : "删除失败");
                        setTimeout(function () {
                            location.reload()
                        }, 1000);
                    }
                });
            });
        });
    });
}).call(this)