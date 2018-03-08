/**
 * Created by asusps on 2018/1/9.
 */

(function(){
    $(".esh-arecord-list").click(function () {
        var feedback;
        if ($(this).data("content") === "") {
            feedback = "暂无回复，当企业回复您的简历时，我们会通过站内信通知您"
        } else {
            feedback = $(this).data("content");
        }
        swal({
            title: "企业回复",
            text: feedback,
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    });

})(this);