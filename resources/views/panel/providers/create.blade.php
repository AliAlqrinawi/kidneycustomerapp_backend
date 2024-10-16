@extends('panel.layouts.index', [
    'sub_title' => __('dashboard.providers'),
    'is_active' => 'admins',
])
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" />
<style>
    .iti {
        width: 100%;
    }
</style>
@endsection
@section('contion')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        @php
            $title_toolbar = __('dashboard.providers');
            $toolbar_links = [
                [
                    'title' => __('dashboard.home'),
                    'link' => route('panel.home'),
                ],
                [
                    'title' => __('dashboard.institutions_management'),
                    'link' => '#',
                ],
                [
                    'title' => __('dashboard.providers'),
                    'link' => '#',
                ],
            ];
        @endphp
        <!--begin::Toolbar-->
        @include('panel.components.toolbar_container', [
            'toolbar_title' => $title_toolbar,
            'toolbar_links' => $toolbar_links,
        ])
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Messenger-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <div class="card-title">
                            <!--begin::User-->
                            <div class="d-flex justify-content-center flex-column me-3">
                                <h2 class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">
                                    {{ @$title_toolbar }}
                                </h2>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <form id="form" method="{{ isset($item) ? 'POST' : 'POST' }}" to="{{ url()->current() }}"
                        url="{{ url()->current() }}" class="w-100">
                        @csrf
                        <input type="hidden" id="image" name="image" value="{{ @$item->image }}" />
                        <!--begin::Card body-->
                        <div class="card-body">
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="d-block fw-bold fs-6 mb-5">
                                    {{ __('dashboard.avatar') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url(/assets/panel/media/avatars/blank.png)">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px"
                                        style="background-image: url({{ imageUrl(@$item->image) }})"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow "
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="{{ __('dashboard.change') }}">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="hidden" id="width_image" value="100" />
                                        <input type="hidden" id="height_image" value="100" />
                                        <input type="hidden" id="custome_path" value="admins" />
                                        <input class="file-upload" type="file" name="avatar"
                                            accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        title="{{ __('dashboard.remove') }}">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">
                                    {{ __('dashboard.allowed_image_type', ['types' => 'png, jpg, jpeg']) }}
                                </div>
                                <!--end::Hint-->
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">
                                    {{ __('dashboard.name') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="name" class="form-control form-control-solid"
                                    value="{{ @$item->name }}" required id="exampleInputPassword1" placeholder="" />
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">
                                    {{ __('dashboard.email') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" name="email" class="form-control form-control-solid"
                                    value="{{ @$item->email }}" required id="exampleInputPassword1" placeholder="" />
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    {{ __('dashboard.phone') }}
                                </label>
                                <br>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="tel" name="phone" id="phone" class="form-control form-control-solid"
                                    value="{{ @$item->phone }}" id="exampleInputPassword1" placeholder="" />
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <label class="fs-6 fw-bold mb-2">
                                    {{ __('dashboard.country') }}
                                </label>
                                <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                    data-hide-search="true" name="country"
                                    data-placeholder="{{ __('dashboard.select_a_country') }}">
                                    <option value="{{ @$item->country }}" selected>{{ @$item->country }}</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                </select>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <label class="fs-6 fw-bold mb-2">
                                    {{ __('dashboard.location') }}
                                </label>
                                <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                    data-hide-search="true" name="location_id"
                                    data-placeholder="{{ __('dashboard.select_location') }}">
                                    <option value=""></option>
                                    @foreach ($areas as $areaRow)
                                        <option value="{{ $areaRow->id }}"
                                            {{ @$item->location_id == $areaRow->id ? 'selected' : '' }}>
                                            {{ $areaRow->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7 fv-plugins-icon-container"
                                {{ Auth::guard('admin')->user()->hasRole('admins') ? '' : 'hidden' }}>
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">
                                    {{ __('dashboard.institution') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                    data-hide-search="true" name="institution_id"
                                    data-placeholder="{{ __('dashboard.select_an_institution') }}">
                                    <option></option>
                                    @foreach ($institutions as $institutionData)
                                        <option value="{{ $institutionData->id }}"
                                            {{ @$item->institution_id == $institutionData->id ? 'selected' : '' }}
                                            {{ $institutionId == $institutionData->id ? 'selected' : '' }}>
                                            {{ $institutionData->name }}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-white btn-active-light-primary me-2">
                                {{ __('dashboard.discard') }}
                            </button>
                            @include('panel.components.btn_submit', [
                                'btn_submit_text' => __('dashboard.save'),
                            ])
                        </div>
                        <!--end::Card footer-->
                    </form>
                </div>
                <!--end::Messenger-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    @push('panel_js')
        <script src="{{ asset('assets/panel/js/custom/control-panel/jqueryValidate.min.js') }}"></script>
        <script src="{{ asset('assets/panel/js/custom/control-panel/post.js') }}"></script>
        <script src="{{ asset('assets/panel/js/custom/documentation/forms/image-input.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
        <script>
            const input = document.querySelector("#phone");
            var iti = window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    fetch('https://ipinfo.io/json', {
                            headers: {
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(json => callback(json.country))
                        .catch(() => callback('us'));
                },
            });
        </script>
    @endpush
@stop
