@extends('panel.layouts.index', [
    'sub_title' => __('dashboard.inbox'),
    'is_active' => 'inbox'
])
@section('contion')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    @php 
                                                                                                    $title_toolbar = __('dashboard.inbox');
        $toolbar_links = [
            [
                'title' => __('dashboard.home'),
                'link' => route('panel.home')
            ],
            [
                'title' => __('dashboard.system_content_management'),
                'link' => '#'
            ],
            [
                'title' => __('dashboard.inbox'),
                'link' => '#'
            ],
        ];
       @endphp
    <!--begin::Toolbar-->
    @include('panel.components.toolbar_container', [
    'toolbar_title' => $title_toolbar,
    'toolbar_links' => $toolbar_links
])
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">

            <!-- begin details -->
            <div class="col-md-12">
                <div class="card card-flush h-lg-100">
                    <!--begin::Header-->
                    <div class="card-header pt-5">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">
                                {{__('dashboard.detalis')}}
                            </span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">
                                {{__('dashboard.from')}} : {{@$item->name}}
                            </span>
                        </h3>
                        <!--end::Title-->

                        <!--begin::Toolbar-->
                        <div class="card-toolbar">

                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Header-->

                    @php 
                                                                                                                                                                                                                                                $items = [
                            [
                                'title' => __('dashboard.name'),
                                'value' => $item->name
                            ],
                            [
                                'title' => __('dashboard.email'),
                                'value' => $item->email
                            ],
                            [
                                'title' => __('dashboard.mobile'),
                                'value' => $item->mobile
                            ],
                            [
                                'title' => __('dashboard.date'),
                                'value' => $item->created_at
                            ],
                            [
                                'title' => __('dashboard.subject'),
                                'value' => $item->subject
                            ],
                            [
                                'title' => __('dashboard.message'),
                                'value' => $item->text
                            ],
                        ];


                    @endphp

                    <!--begin::Body-->
                    <div class="card-body pt-5">
                        @foreach($items as $item_data)
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="text-gray-700 fw-semibold fs-6 me-2">
                                    {{@$item_data['title']}}
                                </div>
                                <!--end::Section-->

                                <!--begin::Value-->
                                <div class="d-flex align-items-senter">
                                    {{@$item_data['value']}}
                                </div>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                        @endforeach





                    </div>
                    <!--end::Body-->
                </div>

            </div>

            <!-- end details -->

            <!-- begin from replay -->

            <div class="col-md-12 mt-5">
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <div class="card-title">
                            <!--begin::User-->
                            <div class="d-flex justify-content-center flex-column me-3">
                                <h2 class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">
                                    {{__('dashboard.reply_to_the_message')}}
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

                    @php $replays = $item->replays @endphp
                    @foreach($replays as $reply)

                        <div class="cursor-pointer shadow-xs toggle-off mt-2">
                            <!--begin::Message Heading-->
                            <div
                                class="d-flex card-spacer-x py-6 flex-column flex-md-row flex-lg-column flex-xxl-row justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="symbol symbol-circle symbol-65px ms-2 me-2">
                                        <span class="symbol-label"
                                            style="background-image: url('{{imageUrl(getSeting('logo'))}}')"></span>
                                    </span>
                                    <div class="d-flex flex-column flex-grow-1 flex-wrap ms-2 me-2">
                                        <div class="d-flex">
                                            <a href="#"
                                                class="font-size-lg font-weight-bolder text-dark-75 ms-2">{{@$reply->admin->name}}</a>
                                            <div class="font-weight-bold text-muted">
                                                <span
                                                    class="label label-success label-dot ms-2"></span>{{@$reply->diffForHumans()}}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="toggle-off-item mt-2">
                                                <span class="font-weight-bold cursor-pointer"
                                                    data-toggle="dropdown">{!!@$reply->text!!}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    @endforeach

                    <form class="mt-4" id="form" method="{{isset($item) ? 'POST' : 'POST'}}" to="{{url()->current()}}"
                        url="{{url()->current()}}" class="w-100">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body">



                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">

                                    {{__('dashboard.message')}}

                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <textarea type="text" name="text" class="form-control form-control-solid tinymce"
                                    rows="4" required></textarea>
                                <!--end::Input-->
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>






                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-white btn-active-light-primary me-2">
                                {{__('dashboard.discard')}}
                            </button>
                            @include('panel.components.btn_submit', ['btn_submit_text' => __('dashboard.save')])
                        </div>
                        <!--end::Card footer-->
                    </form>
                </div>
            </div>

            <!-- end from replay -->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@push('panel_js')
    <script src="{{asset('assets/panel/js/custom/control-panel/jqueryValidate.min.js')}}"></script>
    <script src="{{asset('assets/panel/js/custom/control-panel/post.js')}}"></script>
    <script src="{{asset('assets/panel/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
    <script src="{{asset('assets/panel/plugins/custom/tinymce/tinymce.js')}}"></script>

@endpush
@stop