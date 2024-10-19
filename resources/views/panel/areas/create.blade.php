@extends('panel.layouts.index', [
    'sub_title' => __('dashboard.areas'),
    'is_active' => 'admins',
])
@section('contion')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        @php
            $title_toolbar = __('dashboard.areas');
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
                    'title' => __('dashboard.areas'),
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
                        <!--begin::Card body-->
                        <div class="card-body">
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
                                    value="{{ @$item->admin->email }}" required id="exampleInputPassword1" placeholder="" />
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
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
                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="{{ !isset($item) ? 'required' : '' }} fs-6 fw-bold mb-2">
                                    {{ __('dashboard.password') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" name="password" class="form-control form-control-solid"
                                    value="" id="exampleInputPassword1" placeholder=""
                                    @if (!isset($item)) required @endif />
                                <!--end::Input-->
                                @if (!isset($item))
                                    <div class="form-text">
                                        {{ __('dashboard.leave_it_blank_if_you_do_not_want_to_change_your_password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="fv-row mb-10" hidden>
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold form-label mb-2">
                                    {{ __('dashboard.roles') }}
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="role_id" data-control="select2"
                                    data-placeholder="{{ __('dashboard.roles') }}" data-hide-search="true"
                                    class="form-select form-select-solid fw-bolder" required>
                                    @foreach ($roles as $role)
                                        <option value="{{ @$role->id }}" selected>{{ @$role->name }}
                                        </option>
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
    @endpush
@stop
