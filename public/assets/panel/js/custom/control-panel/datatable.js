"use strict";
// Class definition
var datatable;
var KTDatatableRemoteAjaxDemo = function () {
    // Private functions

    // basic demo
    var demo = function () {
        datatable = $('#kt_datatable_example_2').DataTable({
            "scrollY": 300,
            "scrollX": true,
            "language": {
                "search": window.search + " : ",
            },
            processing: true,
            serverSide: true,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true,
            paging: true,
            dom:
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">",
            "responsive": true,
            ajax: {
                url: window.data_url,
                data: window.data_search
            },
            columns: window.columns,
        });

    };

    return {
        // public functions
        init: function () {
            demo();
        },
    };
}();


$(document).on('click', '.delete-item', function (event) {
    var delete_url = $(this).data('url');
    event.preventDefault();
    Swal.fire({
        title: '<span class="info">' + window.deletion_confirmation_message + '</span>',
        type: 'question',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: window.delete,
        cancelButtonText: window.cancel,
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
                url: delete_url,
                method: 'delete',
                type: 'json',
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        $('#kt_datatable_example_2').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    toastr.error("Error");
                }
            });
        }
    });
});


jQuery(document).ready(function () {
    KTDatatableRemoteAjaxDemo.init();
});
