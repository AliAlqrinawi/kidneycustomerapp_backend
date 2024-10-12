var form = $('#form');
var save_btn = $('#btn_submit');
var save_btn = $('#form').find('#btn_submit');
window.is_all_images_uploaded = true;

form.validate({
    rules: {
        password: {
            minlength: 6
        },
        password_confirmation: {
            minlength: 6,
            equalTo: "#password"
        }
    },
    highlight: function (element) {
        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function (element) {
        jQuery(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    },
    submitHandler: function (f, e) {
        e.preventDefault();

        $('.summernote').each(function () {
            $(this).summernote("code", $(this).summernote('code').replace(/(<div)/igm, '<p').replace(/<\/div>/igm, '</p>').replace(/<p><\/p>/igm, ''));
        });

        if (window.is_all_images_uploaded) {

            $(save_btn).attr("disabled", true);
            $(save_btn).find('.spinner-border').show();
            var formData = new FormData(form[0]);
            var url = form.attr('action');
            var redirectUrl = form.attr('to');
            var repeater = $('#m_repeater_1');
            var _method = form.attr('method');

            if (window.images !== undefined && window.images !== null) { formData.append('images', JSON.stringify(window.images)); }

            if (window.videos !== undefined && window.videos !== null) { formData.append('videos', JSON.stringify(window.videos)); }

            if (window.repeater) { formData.append('list', JSON.stringify(repeater.repeaterVal()[''])); }

            $.ajax({
                url: url,
                method: _method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $(save_btn).attr("disabled", false);
                    $(save_btn).find('.spinner-border').hide();
                    if (response.status) {
                        $('#form')[0].reset();
                        customSweetAlert(
                            'success',
                            response.message,
                            response.item,
                            function (event) {
                                showLoader();
                                window.location = redirectUrl;
                            }
                        );
                    } else {
                        customSweetAlert(
                            'error',
                            response.message,
                            response.errors_object
                        );
                    }
                },
                error: function (jqXhr) {
                    $(save_btn).attr("disabled", false);
                    $(save_btn).find('.spinner-border').hide();
                    getErrors(jqXhr, '/panel/login');
                }
            });
        } else {
            customSweetAlert(
                'warning',
                window.please_wait_while_the_images_are_uploaded,
                ''
            );
        }
    }
});

var form_2 = $('#form_2');
var save_btn_2 = $('#form_2').find('#btn_submit');
window.is_all_images_uploaded = true;

form_2.validate({
    rules: {
        password: {
            minlength: 6
        },
        password_confirmation: {
            minlength: 6,
            equalTo: "#password"
        }
    },
    highlight: function (element) {
        jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function (element) {
        jQuery(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    },
    submitHandler: function (f, e) {
        e.preventDefault();

        $('.summernote').each(function () {
            $(this).summernote("code", $(this).summernote('code').replace(/(<div)/igm, '<p').replace(/<\/div>/igm, '</p>').replace(/<p><\/p>/igm, ''));
        });

        if (window.is_all_images_uploaded) {

            $(save_btn_2).attr("disabled", true);
            $(save_btn_2).find('.spinner-border').show();
            var formData = new FormData(form_2[0]);
            var url = form_2.attr('action');
            var redirectUrl = form_2.attr('to');
            var repeater = $('#m_repeater_1');
            var _method = form_2.attr('method');

            if (window.images !== undefined && window.images !== null) { formData.append('images', JSON.stringify(window.images)); }

            if (window.videos !== undefined && window.videos !== null) { formData.append('videos', JSON.stringify(window.videos)); }

            if (window.repeater) { formData.append('list', JSON.stringify(repeater.repeaterVal()[''])); }

            $.ajax({
                url: url,
                method: _method,
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $(save_btn_2).attr("disabled", false);
                    $(save_btn_2).find('.spinner-border').hide();
                    if (response.status) {
                        $('#form_2')[0].reset();
                        customSweetAlert(
                            'success',
                            response.message,
                            response.item,
                            function (event) {
                                showLoader();
                                window.location = redirectUrl;
                            }
                        );
                    } else {
                        customSweetAlert(
                            'error',
                            response.message,
                            response.errors_object
                        );
                    }
                },
                error: function (jqXhr) {
                    $(save_btn_2).attr("disabled", false);
                    $(save_btn_2).find('.spinner-border').hide();
                    getErrors(jqXhr, '/panel/login');
                }
            });
        } else {
            customSweetAlert(
                'warning',
                window.please_wait_while_the_images_are_uploaded,
                ''
            );
        }
    }
});



function getErrors(jqXhr, path) {
    hideLoader();
    switch (jqXhr.status) {
        case 401:
            $(location).prop('pathname', path);
            break;
        case 400:
            customSweetAlert(
                'error',
                jqXhr.responseJSON.message,
                ''
            );
            break;
        case 422:
            (function ($) {
                var $errors = jqXhr.responseJSON.errors;
                var errorsHtml = '<ul style="list-style-type: none">';
                $.each($errors, function (key, value) {
                    errorsHtml += '<li >' + value[0] + '</li>';
                });
                errorsHtml += '</ul>';
                customSweetAlert(
                    'error',
                    window.the_following_errors_occurred,
                    errorsHtml
                );
            })(jQuery);

            break;
        default:
            errorCustomSweet();
            break;
    }
    return false;
}

$(document).on('click', '.confirm-category', function (event) {
    var url = $(this).data('url');
    var id = $(this).data('id');
    var row = $(this).data('row');
    event.preventDefault();
    Swal.fire({
        title: "<span class='info'>" + window.are_your_sure + "</span>",
        type: 'question',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: window.confirm_text + "",
        cancelButtonText: window.cancel_text + "",
        confirmButtonColor: '#56ace0',
        allowOutsideClick: false
    }).then(function (result) {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'post',
                type: 'json',
                data: { id: id },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        $('#' + row).css('display', 'none');
                    } else {
                        customSweetAlert(
                            'error',
                            response.message,
                            response.errors_object
                        );

                    }
                },
                error: function (response) {
                    errorCustomSweet();
                }
            });
        }
    });
});






function customSweetAlert(type, title, html, func) {
    var then_function = func || function () {
    };
    Swal.fire({
        title: '<span class="' + type + '">' + title + '</span>',
        icon: type,
        html: html,
        confirmButtonText: window.ok,
        confirmButtonColor: '#56ace0',
        customClass: { confirmButton: "btn btn-primary", cancelButton: "btn btn-active-light" }

    }).then(then_function);
}


function errorCustomSweet() {
    customSweetAlert(
        'error',
        window.unexpected_error
    );
}
function successCustomSweet(text) {
    customSweetAlert(
        'success',
        text
    );
}

function showLoader() {
    $('#load').show();
}

function hideLoader() {
    $('#load').hide();
}

