@extends('panel.layouts.index', ['sub_title' => __('dashboard.dashboard'), 'is_active' => 'home'])
@section('contion')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    @php 
                   $title_toolbar = __('dashboard.dashboard');
        $statistics = [
            [
                'title' => __('dashboard.posts'),
                'text' => __('dashboard.the_number_of_items_added_to_the_system'),
                'value' => @$posts_count,
                'link' => '#',
                'class' => 'warning',
            ],
            [
                'title' => __('dashboard.products'),
                'text' => __('dashboard.the_number_of_items_added_to_the_system'),
                'value' => @$products_count,
                'link' => '#',
                'class' => 'success',
            ],

        ];
       @endphp
    @include('panel.components.toolbar_container', [
    'toolbar_title' => $title_toolbar,
    'toolbar_links' => []
])
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0">
                    <h3 class="card-title fw-bolder text-dark">
                        {{__('dashboard.general_statistics')}}
                    </h3>
                    <div class="card-toolbar">
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-0">
                    <div class="row">
                        @foreach($statistics as $statistic)                         <div class="col-md-6">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center bg-light-{{@$statistic['class']}} rounded p-5 mb-7">
                                    <!--begin::Icon-->
                                    <span class="svg-icon svg-icon-warning me-5">
                                        <!--begin::Svg Icon | path: icons/duotone/Home/Library.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path
                                                        d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                        fill="#000000"></path>
                                                    <rect fill="#000000" opacity="0.3"
                                                        transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"
                                                        x="16.3255682" y="2.94551858" width="3" height="18" rx="1"></rect>
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <!--end::Icon-->
                                    <!--begin::Title-->
                                    <div class="flex-grow-1 me-2">
                                        <a href="{{@$statistic['link']}}"
                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">
                                            {{@$statistic['title']}}
                                        </a>
                                        <span class="text-muted fw-bold d-block">
                                            {{@$statistic['text']}}
                                        </span>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Lable-->
                                    <span class="fw-bolder text-{{@$statistic['class']}} py-1">
                                        {{@$statistic['value']}}
                                    </span>
                                    <!--end::Lable-->
                                </div>
                                <!--end::Item-->
                            </div>
                        @endforeach
                    </div>
                </div>
                <!--end::Body-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection