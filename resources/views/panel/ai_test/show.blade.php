@extends('panel.layouts.index', [
    'sub_title' => __('dashboard.ai_test'),
    'is_active' => 'admins',
])
@section('css')
    <style>
        .message-box {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .message-green {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .message-yellow {
            background-color: #fff3cd;
            border-color: #ffeeba;
        }

        .message-red {
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .modal-footer {
            justify-content: center;
        }

        .add-btn {
            background-color: #9b59b6;
            color: white;
            font-size: 16px;
            padding: 10px 30px;
            border-radius: 25px;
            border: none;
        }
    </style>
@endsection
@section('contion')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        @php
            $title_toolbar = __('dashboard.ai_test');
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
                    'title' => __('dashboard.ai_test'),
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
                @include('panel.ai_test.models')
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
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <table id="kt_datatable_example_2" class="table table-striped table-row-bordered gy-5 gs-7 w-100">
                            <thead>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                    <!--end::Card body-->
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
        <script src="{{ asset('assets/panel/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <script src="{{ asset('assets/panel/js/custom/control-panel/datatable.js') }}"></script>
        <script>
            window.data_url = '{{ route("panel.aiTest.show.data" , ["id" => request()->route("id")]) }}';
            window.columns = [{
                    data: 'test_number',
                    name: 'id',
                    title: '{{ __('dashboard.test_number') }}',
                },
                {
                    data: 'test_date',
                    title: '{{ __('dashboard.test_date') }}',
                },
                {
                    data: 'test_aI_results',
                    title: '{{ __('dashboard.test_aI_results') }}',
                },
                {
                    data: 'test_ai_details',
                    title: '{{ __('dashboard.test_ai_details') }}',
                },
                {
                    data: 'call',
                    title: '{{ __('dashboard.call') }}',
                    orderable: false
                },
                {
                    data: 'notification',
                    title: '{{ __('dashboard.notification') }}',
                    orderable: false
                },
                {
                    data: 'chat',
                    title: '{{ __('dashboard.chat') }}',
                    orderable: false
                },
                {
                    data: 'appointment',
                    title: '{{ __('dashboard.appointment') }}',
                    orderable: false
                }
            ];
            window.data_search = function(d) {
                d.search = $('input[type="search"]').val()
            }
        </script>
        <script>
            $(document).on("click", "#appointment", function (e) {
                var user_id = $(this).data("user_id");
                var user_id = $("#user_id").val(user_id);
            });
        </script>
    @endpush
@stop
