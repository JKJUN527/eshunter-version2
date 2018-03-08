/**
 * Created by apple on 17/12/27.
 */
(function () {


    $(function () {
        $(document).ready(function () {

            var nid = $(".mdl-card__title-text").attr("data-content");
            $.ajax({
                url: "/news/content?nid=" + nid,
                type: "get",
                success: function (data) {
                    var content = data['news']['content'];
                    var images = data['news']['picture'];
                    var imageTemp = images.split(";");
                    var imagesArray = [];

                    for (var i in imageTemp) {
                        imagesArray[i + ''] = imageTemp[i + ''].split("@");
                    }

                    var baseUrl = imagesArray[0][0].substring(0, imagesArray[0][0].length - 1);
                    imagesArray[0][0] = imagesArray[0][0].replace(baseUrl, '');

//                    console.log(imagesArray);
//                    console.log(baseUrl);
//                    console.log();

                    for (var j = 0; j < imagesArray.length; j++) {
                        content = content.replace("[图片" + imagesArray[j][0] + "]", "<div class='news-image'><img src='" + baseUrl + imagesArray[j][1] + "'/></div>");
                    }

                    $(".mdl-card__supporting-text").html(content);
                }
            });

        });
        var maxSize = 114;

        $(".form-control").focus(function () {
            // $(this.parentNode).addClass("focused");
        }).blur(function () {
            // $(this.parentNode).removeClass("focused");
        });

        $('textarea').keyup(function () {

            var length = $(this).val().length;
            if (length > maxSize) {
                $(".error[for='additional-content']").html("内容超过114字");
                $("#btn-comment").prop("disabled", true);
            } else {
                $(".error[for='additional-content']").html("");
                $("#btn-comment").prop("disabled", false);
            }

            $("#comment-help").html("还可输入" + (maxSize - length < 0 ? 0 : maxSize - length) + "字");

        });

        $commentForm = $("#comment-form");

        $("button[type='submit']").click(function (event) {
            event.preventDefault();
            var $commentContent = $("#additional-content").val();

            if ($commentContent.length === 0) {
                $(".error[for='additional-content']").html("内容不能为空");
                $("#btn-comment").prop("disabled", true);
                return;
            }

            if ($commentContent.length > maxSize) {
                $(".error[for='additional-content']").html("内容超过" + maxSize + "字");
                $("#btn-comment").prop("disabled", true);
                return;
            }

            var formData = new FormData();
            formData.append("nid", $("input[name='nid']").val());
            formData.append("content", $commentContent);

            $.ajax({
                url: "/news/addReview",
                type: "post",
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);
                    if (result.status === 200) {
                        swal({
                            title: '评论成功',
                            confirmButtonText: '确定'
                        })
                    } else {
                        swal({title: result.msg, confirmButtonText: "确定"});
                    }
                }
            })

        })
    })
})();