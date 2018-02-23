$(document).ready(function () {
    if (jQuery().validate) {
        var removeSuccessClass = function (e) {
            $(e).closest('.form-group').removeClass('has-success');
        }
        $('#myform').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                username: {
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 6
                },
                code: {
                    required: true,
                    minlength: 5,
                    maxlength: 5
                }
            },
            messages: {
                username: {
                    required: langary_jsall['username_required']
                },
                password: {
                    required: langary_jsall['password_required']
                },
                code: {
                    required: langary_jsall['code_required']
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit

            },

            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                setTimeout(function () {
                    removeSuccessClass(element);
                }, 3000);
            },

            success: function (label) {
                label.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
            }
        });
        $('#forgot').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                forgotme_email: {
                    required: true,
                    minlength: 3
                },
            },
            messages: {
                forgotme_email: {
                    required: langary_jsall['forgotme_email']
                },
            },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change dony by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
                setTimeout(function () {
                    removeSuccessClass(element);
                }, 3000);
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
            }
        });
    }
    $('#formbtn').click(function () {
        var $this = $(this);
        var $form = $('#myform');
        var $alert = $form.find('#alertdiv');
        $alert.removeClass('alert-danger').addClass('alert-info').html('<strong>'+langary_jsall['formbtn_alert']+'</strong>'+langary_jsall['formbtn_alert2']);
        //if ($form.valid()){
        $('#formcontent').hide();
        startFadeInOut($alert);
        $.ajax({
            url: 'chklogin.php',
            cache: false,
            type: "POST",
            data: {
                username: $('#username').val(),
                password: $('#password').val(),
                code: $('#code').val(),
                actype: $("#loginform").attr("myac"),
                remember_me: $('#remember_me:checked').val()
            },
            dataType: "json",
            success: function (data) {
                setTimeout(function () {
                    vaildResult($alert, data, 'formcontent');
                }, 500);
            }
            , error: function (xhr, ajaxOptions, thrownError) {
                var data = new Array();
                data['result'] = false;
                data['msg'] = langary_jsall['oops_error'] + thrownError;
                vaildResult($alert, data, 'formcontent');
            }
        });


        //}

    });
    $("#forgot").submit(function () {
        return false;
    })
    $('#sendauthemail').click(function () {
        var $this = $(this);
        var $form = $('#forgot');
        var $alert = $form.find('#alertdiv_email');
        $alert.removeClass('alert-danger').addClass('alert-info').html('<strong>'+langary_jsall['sendauthemail']+'</strong>'+langary_jsall['sendauthemail2']);
        //if ($form.valid()){
        $('#formforgot').hide();
        startFadeInOut($alert);
        $.ajax({
            url: 'forgetpw_email/sendauthemail.php',
            cache: false,
            type: "POST",
            data: {forgotme_email: $('#forgotme_email').val()},
            dataType: "json",
            success: function (data) {
                setTimeout(function () {
                    vaildResult($alert, data, 'formforgot', 'login.php', langary_jsall['sendauthemail_vaildResult']);
                }, 2000);
            }
            , error: function (xhr, ajaxOptions, thrownError) {
                var data = new Array();
                data['result'] = false;
                data['msg'] = langary_jsall['oops_error'] + thrownError;
                vaildResult($alert, data, 'formforgot', 'login.php');
            }
        });


        //}

    });

    function vaildResult(obj, data, formid, targethref, targettext) {
        targethref = targethref || 'home/index.php';
        targettext = targettext || '<strong> '+langary_jsall['vaildResult']+' </strong> '+langary_jsall['vaildResult2'];
        stopFadeInOut(obj);
        obj.removeClass('alert-info');
        $('#codeimg').trigger('click');
        if (data['result'] == true) {
            obj.addClass('alert-success');
            obj.html(targettext);
            setTimeout(function () {
                $('body').fadeOut(function () {
                    location.href = targethref;
                })
            }, 500);
        }
        else {
            obj.addClass('alert-danger');
            obj.html('<strong> '+langary_jsall['vaildResult3']+' </strong>' + data['msg']);
            $('#' + formid).show();
        }
    }

    function goToForm(form) {
        $('.login-wrapper > form:visible').fadeOut(500, function () {
            $('#' + form).fadeIn(500);
        });
    }

    $(function () {
        $('.goto-login').click(function () {
            goToForm('myform');
        });
        $('.goto-forgot').click(function () {
            goToForm('forgot');
        });
    });
});