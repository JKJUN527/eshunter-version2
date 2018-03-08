/**
 * Created by asusps on 2018/1/1.
 */
(function () {



    $(function () {
        var rid = $("input[name='rid']");

        $("#esh-edit-name").click(function () {
            var inputVal = $("#esh-resume-name").html();
            swal({
                    title: "修改简历名称",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-top",
                    inputValue: inputVal,
                    confirmButtonText: "确定",
                    cancelButtonText: "取消"

                },
                function (inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("请输入简历名称！");
                        return false
                    }
                    if (inputValue.replace(/[^\x00-\xff]/g, "01").length > 24) {
                        swal.showInputError("简历名称过长！");
                        return false;
                    }
                    $("#esh-resume-name").html(inputValue);
                    swal.close();
                    var formData = new FormData();
                    formData.append('rid', rid.val());
                    formData.append('name', inputValue);
                    $.ajax({
                        url: '/m/resume/rename',
                        type: 'post',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            var result = JSON.parse(data);
                            if (result.status = "success") {
                                $("#esh-resume-name").html(inputValue);
                                swal.close();
                            }
                        }
                    });

                });
        });

        $(".esh-href-page").click(function () {
            var url = $(this).data("esh-href");
            window.location.href = url;
        });


        $("#esh-extra-message").click(function () {//附加信息
            var inputVal = $.trim($("#esh-skill-content").html());
            swal({
                    title: "添加附加信息",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    animation: "slide-from-bottom",
                    inputValue: inputVal,
                    confirmButtonText: "确定",
                    cancelButtonText: "取消"

                },
                function (inputValue) {
                    if (inputValue === false) return false;
                    //
                    // if (inputValue === "") {
                    //     swal.showInputError("请输入简历名称！");
                    //     return false
                    // }
                    // $("#esh-resume-name").html(inputValue);
                    // var rid = $("input[name='rid']");
                    swal.close();
                    // var extra = $("textarea[name='additional-content']");

                    var formData = new FormData();
                    formData.append('rid', rid.val());
                    formData.append('extra', inputValue);

                    $.ajax({
                        url: '/m/resume/addExtra',
                        type: 'post',
                        dataType: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            var result = JSON.parse(data);
                            if (result.status === 200) {
                                $("#esh-skill-content").html(inputValue);
                            } else {
                                swal({
                                    title: "错误",
                                    text: result.msg,
                                    confirmButtonText: "确定"
                                })
                            }
                            // checkResult(result.status, "附加内容已修改", result.msg, $additionalPanelUpdate);
                        }
                    })

                });
        });
    });
}).call(this)