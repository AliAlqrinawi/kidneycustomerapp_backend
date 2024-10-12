"use strict";
var KTGeneralImageInputDemos = {


    init: function () {

        $('.file-upload').change(function () {
            $('#btn_submit').prop('disabled', true);
            if ($(this).val() !== '') {
                var formData = new FormData();
                var width = $('#width_image').val();
                var height = $('#height_image').val();
                var custome_path = $('#custome_path').val();
                var token = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', token);
                formData.append('width', width);
                formData.append('height', height);
                formData.append('custome_path', custome_path);
                formData.append('image', $(this)[0].files[0]);
                $.ajax({
                    url: '/image/upload',
                    type: 'POST',
                    data: formData,
                    success: function (res) {
                        if (res.status) {
                            if (res.file_name !== undefined && res.file_name !== '') {
                                $('#image').val(res.file_name);
                            }
                        } else {
                            swal(
                                'Unknown Error Occurred',
                                res.message,
                                'error'
                            )
                        }
                        $('#btn_submit').prop('disabled', false);
                    },

                    error: function () {
                        swal(
                            'Unknown Error Occurred',
                            '',
                            'error'
                        )
                        $('#btn_submit').prop('disabled', false);

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });

        $('.file-upload-2').change(function () {
            $('#btn_submit').prop('disabled', true);
            if ($(this).val() !== '') {
                var formData = new FormData();
                var width = $('#width_image').val();
                var height = $('#height_image').val();
                var custome_path = $('#custome_path').val();
                var token = $('meta[name="csrf-token"]').attr('content');
                formData.append('_token', token);
                formData.append('width', width);
                formData.append('height', height);
                formData.append('custome_path', custome_path);
                formData.append('image', $(this)[0].files[0]);
                $.ajax({
                    url: '/image/upload',
                    type: 'POST',
                    data: formData,
                    success: function (res) {
                        if (res.status) {
                            if (res.file_name !== undefined && res.file_name !== '') {
                                $('#image_2').val(res.file_name);
                            }
                        } else {
                            swal(
                                'Unknown Error Occurred',
                                res.message,
                                'error'
                            )
                        }
                        $('#btn_submit').prop('disabled', false);
                    },

                    error: function () {
                        swal(
                            'Unknown Error Occurred',
                            '',
                            'error'
                        )
                        $('#btn_submit').prop('disabled', false);

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });

    }
};
KTUtil.onDOMContentLoaded((function () {
    KTGeneralImageInputDemos.init()
}));