$("#kt_signin_password_button button").on("click", function () {
    $(this).hide();
    $('#kt_signin_password').hide();
    $('#kt_signin_password_edit').removeClass('d-none');
});

$("#kt_password_cancel").on("click", function () {
    $("#kt_signin_password_button button").show();
    $('#kt_signin_password').show();
    $('#kt_signin_password_edit').addClass('d-none');
});