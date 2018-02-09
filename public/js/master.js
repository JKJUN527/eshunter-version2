/**
 * Created by liuyang on 2017/9/13.
 */

function setError(element, forStr, errorStr) {
    element.parent().addClass('error');
    $(".error[for='" + forStr + "']").html(errorStr);
    element.focus();
}

function removeError(element, forStr) {
    element.parent().removeClass('error');
    $(".error[for='" + forStr + "']").html("");
}

function showNotification(colorName, text, placementFrom, placementAlign, animateEnter, animateExit) {
    if (colorName === null || colorName === '') {
        colorName = 'bg-black';
    }
    if (text === null || text === '') {
        text = 'Turning standard Bootstrap alerts';
    }
    if (animateEnter === null || animateEnter === '') {
        animateEnter = 'animated fadeInDown';
    }
    if (animateExit === null || animateExit === '') {
        animateExit = 'animated fadeOutUp';
    }
    var allowDismiss = true;

    $.notify({
            message: text
        },
        {
            type: colorName,
            allow_dismiss: allowDismiss,
            newest_on_top: true,
            timer: 10,
            placement: {
                from: placementFrom,
                align: placementAlign
            },
            animate: {
                enter: animateEnter,
                exit: animateExit
            },
            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
            '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
            '</div>'
        });
}

function locationTimeout(url, second) {
    setTimeout(function () {
        location.href = url;
    }, second * 1000);
}

/**
 * 判断 ajax 返回的数据，执行一些操作
 * @param status
 * @param succeedInfo
 * @param failedInfo
 * @param element
 */
function checkResult(status, succeedInfo, failedInfo, element) {
    if (status === 200) {
        setTimeout(function () {
            location.reload()
        }, 1000);

        swal({
            title: "",
            type: "success",
            text: succeedInfo,
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });

        if (element !== null) element.hide();
    } else if (status === 400) {
        swal({
            title: "",
            type: "error",
            text: failedInfo,
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    }
}

function checkResultWithLocation(status, succeedInfo, failedInfo, url) {
    if (status === 200) {
        setTimeout(function () {
            self.location = url;
        }, 1000);

        swal({
            title: "成功",
            type: "success",
            text: succeedInfo,
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    } else if (status === 400) {
        swal({
            title: "失败",
            type: "error",
            text: failedInfo,
            cancelButtonText: "关闭",
            showCancelButton: true,
            showConfirmButton: false
        });
    }
}
