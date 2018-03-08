/**
 * Created by asusps on 2018/1/12.
 */
(function(){
    var ESHUtils = this.ESHUtils;

    $(function(){
        ESHUtils.fillSpan();//填充span内容
        $("#esh-negotiable").click(function(){
            if ($("#esh-negotiable").is(":checked")) {
                $("#esh-salary").addClass("esh-no-chose");
            } else {
                $("#esh-salary").removeClass("esh-no-chose");
            }
        });

        /*新增页面*/
        //自动关联省份和城市
//    $(this).prev().html($(this).find("option:selected").text());
        $('#position-place').change(function () {
            var indexid = $("select[name='place']");
            var id = "#city-display" + indexid.val();
            var city_len = $("select[name='city"+ indexid.val() +"'] option").length;
            if(city_len >1){
                $('.esh-city-select').css("display", "none");
                $(id).parent().css("display", "block");
            }else{
                $('.esh-city-select').css("display", "none");
            }
        });
        //发布职位
        $("#esh-save-position").click(function (event) {
            event.preventDefault();
            //var publishForm = $("#publish-form");
            if(!$("#esh-publish-create").valid()){
                return;
            }
            var name = $("input[name='name']");
            var description_raw = $("textarea[name='description']");

            var description = description_raw.val().replace(/\r\n/g, '</br>');
            description = description.replace(/\n/g, '</br>');
//            description = description.replace(/\s/g, '</br>');

            var province = $("select[name='place']");
            var city = $("select[name='city"+ province.val() +"']");
            var city_len = $("select[name='city"+ province.val() +"'] option").length;
            var industry = $("select[name='industry']");
            var occupation = $("select[name='occupation" + industry.val() + "']");
            var type = $("select[name='type']");

            var salaryCB = $("#esh-negotiable");
            var min_salary = $("input[name='salary-min']");
            var max_salary = $("input[name='salary-max']");

            var personNumber = $("input[name='person--number']");

//            var effectiveDate = $("input[name='effective-date']");

            var tag = $("input[name='tag']");
            var experience_raw = $("textarea[name='experience']");

            var experience = experience_raw.val().replace(/\r\n/g, '</br>');
            experience = experience.replace(/\n/g, '</br>');
//            experience = experience.replace(/\s/g, '</br>');

            var workplace_raw = $("textarea[name='workplace']");

            var workplace = workplace_raw.val().replace(/\r\n/g, '</br>');
            workplace = workplace.replace(/\n/g, '</br>');
//            workplace = workplace.replace(/\s/g, '</br>');

            var education = $("select[name='education']");
            var ageLimit = $("input[name='person-age']");


            if (province.val() === "0") {
                setError(province, "position-place", "请选择工作省份");
                return;
            } else {
                removeError(province, "position-place");
            }
            if (city.val() === "0" && city_len >1) {
                setError(city, "position-city", "请选择工作城市");
                return;
            } else {
                removeError(city, "position-city");
            }
            if (industry.val() === "0") {
                setError(industry, "position-industry", "请选择所属行业");
                return;
            } else {
                removeError(industry, "position-industry");
            }

            if (occupation.val() === "0") {
                setError(occupation, "position-occupation", "请选择所属游戏");
                return;
            } else {
                removeError(occupation, "position-occupation");
            }

            if (type.val() === "-1") {
                setError(type, "position-type", "请选择职位类型");
                return;
            } else {
                removeError(type, "position-type");
            }

            var formData = new FormData();
            formData.append("title", name.val());
            formData.append("tag", tag.val());
            formData.append("pdescribbe", description);

            if (salaryCB.is(":checked")) {
                formData.append("salary", -1);
                formData.append("salary_max", 0);
            } else {
                if(parseInt(min_salary.val()) > parseInt(max_salary.val())) {
                    formData.append("salary", max_salary.val());
                    formData.append("salary_max", min_salary.val());
                }else{
                    formData.append("salary_max", max_salary.val());
                    formData.append("salary", min_salary.val());
                }
            }

            if(city_len >1){//省份有城市--非直辖市
                formData.append("region", city.val());
            }else{
                formData.append("region", province.val());
            }
            formData.append("work_nature", type.val());
            formData.append("occupation", occupation.val());
            formData.append("industry", industry.val());
            formData.append("experience", experience);
            formData.append("workplace", workplace);
            formData.append("education", education.val());
            formData.append("total_num", personNumber.val());

            if (ageLimit.val() === "")
                formData.append("max_age", "0");
            else
                formData.append("max_age", ageLimit.val());
//            formData.append("vaildity", effectiveDate.val());
            $.ajax({
                url: "/m/position/publish/add",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    if (result.status === 400) {
                        swal({
                            title: "错误",
                            // type: "error",
                            text: result.msg,
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            // type: "success",
                            text: "职位发布成功，稍后就可以在 个人中心->已发布职位 中查看",
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            self.location = "/m/account/";
                        }, 1000);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal({
                        // type: "error",
                        title: xhr.status,
                        text: thrownError
                    });
                }
            })
        });




        /*********编辑界面***********
         * ***************************/
        //自动关联行业和职业信息
        $('#position-industry').change(function () {
//            document.getElementById("ddlResourceType").options.add(new Option(text,value));
            var indexid = $("select[name='industry']").val();
            var id = "#occupation-display" + indexid;
            $('.esh-game-select').css("display", "none");
            $(id).css("display", "block");
//        $(id).css("display", "block");
//            $(id).style.display = block;
        });
        //修改职位
        $("#esh-update-position").click(function (event) {
            event.preventDefault();
            if(!$("#esh-publish-modify").valid()){
                return;
            }
            //var publishForm = $("#publish-form");

            var pid = $("input[name='pid']");
            var name = $("input[name='name']");
            var description_raw = $("textarea[name='description']");

            var description = description_raw.val().replace(/\r\n/g, '</br>');
            description = description.replace(/\n/g, '</br>');
//            description = description.replace(/\s/g, '</br>');

            var place = $("select[name='place']");
            var industry = $("select[name='industry']");
            var occupation = $("select[name='occupation" + industry.val() + "']");
            var type = $("select[name='type']");

            var salaryCB = $("#esh-negotiable");
            var min_salary = $("input[name='salary-min']");
            var max_salary = $("input[name='salary-max']");

            var personNumber = $("input[name='person--number']");

//            var effectiveDate = $("input[name='effective-date']");

            var tag = $("input[name='tag']");
            var experience_raw = $("textarea[name='experience']");

            var experience = experience_raw.val().replace(/\r\n/g, '</br>');
            experience = experience.replace(/\n/g, '</br>');
//            experience = experience.replace(/\s/g, '</br>');

            var workplace_raw = $("textarea[name='workplace']");

            var workplace = workplace_raw.val().replace(/\r\n/g, '</br>');
            workplace = workplace.replace(/\n/g, '</br>');
//            workplace = workplace.replace(/\s/g, '</br>');

            var education = $("select[name='education']");
            var ageLimit = $("input[name='person-age']");

            if (place.val() === "0") {
                setError(place, "position-place", "请选择工作地点");
                return;
            } else {
                removeError(place, "position-place");
            }

            if (industry.val() === "0") {
                setError(industry, "position-industry", "请选择所属行业");
                return;
            } else {
                removeError(industry, "position-industry");
            }

            if (occupation.val() === "0") {
                setError(occupation, "position-occupation", "请选择所属游戏");
                return;
            } else {
                removeError(occupation, "position-occupation");
            }

            if (type.val() === "-1") {
                setError(type, "position-type", "请选择职位类型");
                return;
            } else {
                removeError(type, "position-type");
            }

            var formData = new FormData();
            formData.append("pid", pid.val());
            formData.append("title", name.val());
            formData.append("tag", tag.val());
            formData.append("pdescribbe", description);

            if (salaryCB.is(":checked")) {
                formData.append("salary", -1);
                formData.append("salary_max", 0);
            } else {
                if(parseInt(min_salary.val()) > parseInt(max_salary.val())) {
                    formData.append("salary", max_salary.val());
                    formData.append("salary_max", min_salary.val());
                }else{
                    formData.append("salary_max", max_salary.val());
                    formData.append("salary", min_salary.val());
                }
            }

            formData.append("region", place.val());
            formData.append("work_nature", type.val());
            formData.append("occupation", occupation.val());
            formData.append("industry", industry.val());
            formData.append("experience", experience);
            formData.append("workplace", workplace);
            formData.append("education", education.val());
            formData.append("total_num", personNumber.val());

            if (ageLimit.val() === "")
                formData.append("max_age", "0");
            else
                formData.append("max_age", ageLimit.val());
//            formData.append("vaildity", effectiveDate.val());
            $.ajax({
                url: "/m/position/publishList/editPost",
                type: 'post',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    var result = JSON.parse(data);

                    if (result.status === 400) {
                        swal({
                            title: "错误",
                            type: "error",
                            text: result.msg,
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });
                    } else {
                        swal({
                            type: "success",
                            text: "职位更新成功，稍后就可以在 个人中心->已发布职位 中查看",
                            cancelButtonText: "关闭",
                            showCancelButton: true,
                            showConfirmButton: false
                        });

                        setTimeout(function () {
                            self.location = "/m/account/";
                        }, 1000);
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    swal({
                        type: "error",
                        title: xhr.status,
                        text: thrownError
                    });
                }
            })
        })




        /*ther function*/
        function setError(element, forStr, errorStr) {
            element.next().addClass('esh-info-error');
            $(".esh-info-error[for='" + forStr + "']").html(errorStr);
            element.focus();
        }

        function removeError(element, forStr) {
            $(".esh-info-error[for='" + forStr + "']").html("");
            element.next().removeClass('esh-info-error');
        }
    });

}).call(this);