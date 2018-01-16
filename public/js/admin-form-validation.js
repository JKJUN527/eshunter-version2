function checkUsername(input) {
    var username = input.val();
    var pattern = /^[a-zA-Z0-9_\u4e00-\u9fa5]+$/;

    if (username === "") {
        input.parents('.form-line').addClass('error');
        $('#username-error').html("不能为空");
        username.focus();
        return false;
    } else if (username.length > 20) {
        input.parents('.form-line').addClass('error');
        $('#username-error').html("长度不能超过20个字符");
        username.focus();
        return false;
    } else if (!pattern.test(username)) {
        input.parents('.form-line').addClass('error');
        $('#username-error').html("不能包括除下划线以外的特殊字符");
        username.focus();
        return false;
    } else {
        input.parents('.form-line').removeClass('error');
        $('#username-error').html("");
        return true;
    }
}

function checkPassword(input) {
    var password = input.val();

    if (password === "") {
        input.parents('.form-line').addClass('error');
        $('#password-error').html("不能为空");
        password.focus();
        return false;
    } else if (password.length < 6) {
        input.parents('.form-line').addClass('error');
        $('#password-error').html("不能少于6位");
        password.focus();
        return false;
    } else {
        input.parents('.form-line').removeClass('error');
        $('#password-error').html("");
        return true;
    }
}

function checkPasswordConfirm(input, password) {
    var password_confirm = input.val();

    if (password_confirm === "") {
        input.parents('.form-line').addClass('error');
        $('#confirm-password-error').html("不能为空");
        password_confirm.focus();
        return false;
    } else if (password_confirm !== password) {
        input.parents('.form-line').addClass('error');
        $('#confirm-password-error').html("两次输入不一致");
        password_confirm.focus();
        return false;
    } else {
        input.parents('.form-line').removeClass('error');
        $('#confirm-password-error').html("");
        return true;
    }
}

function checkTitle(input) {
    if (input.val() === "") {
        input.parents('.form-line').addClass('error');
        $("#title-error").html("不能为空");
        input.focus();
        return false;
    } else {
        input.parents('.form-line').removeClass('error');
        $('#title-error').html("");
        return true;
    }
}

function checkSubtitle(input) {
    if (input.html() === "") {
        input.parents('.form-line').addClass('error');
        $("#subtitle-error").html("不能为空");
        input.focus();
        return false;
    } else {
        input.parents('.form-line').removeClass('error');
        $('#subtitle-error').html("");
        return true;
    }
}

function checkPicture(input) {
    var pattern = /\.jpg$/;
    if (input.val() !== "" && !pattern.test(input.val())) {
        input.parents('.form-line').addClass('error');
        $("#picture-error").html("图片格式只能为jpg");
        input.focus();
        return false;
    } else {
        input.parents('.form-line').removeClass('error');
        $('#picture-error').html("");
        return true;
    }
}
