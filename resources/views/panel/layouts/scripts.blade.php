<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('assets/panel/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('assets/panel/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->
<script src="{{asset('assets/panel/js/custom/control-panel/jqueryValidate.min.js')}}"></script>

@stack('panel_js')
<!--end::Javascript-->
<script>
    window.deletion_confirmation_message = "{{__('dashboard.deletion_confirmation_message')}}";
    window.delete = "{{__('dashboard.delete')}}";
    window.cancel = "{{__('dashboard.cancel')}}";
    window.search = "{{__('dashboard.search')}}";
    window.ok = "{{__('website.ok')}}";
    window.unexpected_error = "{{__('message.unexpected_error')}}";
    window.please_wait_while_the_images_are_uploaded = "{{__('message.please_wait_while_the_images_are_uploaded')}}"
    window.the_following_errors_occurred = "{{__('message.the_following_errors_occurred')}}"
    window.tinymce_language = "{{app()->getLocale()}}";
    window.tinymce_directionality = "{{app()->isLocale('ar') ? 'rtl' : 'lrt'}}";

    jQuery.extend(jQuery.validator.messages, {
        required: "{{ __('validator.required') }}",
        remote: "{{ __('validator.remote') }}",
        email: "{{ __('validator.email') }}",
        url: "{{ __('validator.url') }}",
        date: "{{ __('validator.date') }}",
        dateISO: "{{ __('validator.dateISO') }}",
        number: "{{ __('validator.number') }}",
        digits: "{{ __('validator.digits') }}.",
        creditcard: "{{ __('validator.creditcard') }}",
        equalTo: "{{ __('validator.equalTo') }}",
        accept: "{{ __('validator.accept') }}",
        maxlength: jQuery.validator.format("{{ __('validator.maxlength') }} {0} "),
        minlength: jQuery.validator.format("{{ __('validator.minlength') }} {0} "),
        rangelength: jQuery.validator.format(
            "{{ __('validator.rangelength') }} {0} {{ __('and') }} {1}."),
        range: jQuery.validator.format("{{ __('validator.range') }} {0} {{ __('and') }} {1}."),
        max: jQuery.validator.format("{{ __('validator.max') }} {0}."),
        min: jQuery.validator.format("{{ __('validator.min') }} {0}.")
    });


</script>