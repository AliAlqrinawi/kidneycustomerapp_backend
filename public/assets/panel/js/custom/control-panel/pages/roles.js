$(document).on('change', '#kt_roles_select_all', function () {
    if (!$(this).is(":checked")) {
        $("input:checkbox").each(function () {
            $(this).prop("checked", false);
        });
    } else {
        $("input:checkbox").each(function () {
            $(this).prop("checked", true);
        });
    }
});