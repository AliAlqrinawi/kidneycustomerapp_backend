@extends('panel.layouts.index', ['sub_title' => __('dashboard.dashboard'), 'is_active' => 'home'])
@section('css')
    <style>
        .gender-box {
            display: flex;
            align-items: center;
        }

        .gender-icon {
            font-size: 24px;
            margin-right: 8px;
        }

        .female-icon {
            color: #ff69b4;
            /* Pink for female */
        }

        .male-icon {
            color: #1e90ff;
            /* Blue for male */
        }

        .percentage {
            font-size: 24px;
            font-weight: bold;
        }

        .divider {
            border-left: 1px solid #ddd;
            height: 50px;
            margin: 0 20px;
        }

        .divider2 {
            border-left: 1px solid #ddd;
            height: 260px;
            margin: 0 20px;
        }

        .card-custom {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: inline-block;
        }

        .circle-red {
            background-color: #ff4d4d;
            /* Red */
        }

        .circle-yellow {
            background-color: #ffc107;
            /* Yellow */
        }

        .circle-green {
            background-color: #28a745;
            /* Green */
        }

        .user-count {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .total-users {
            font-size: 1rem;
            color: #6c757d;
        }
    </style>
@endsection
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
            'toolbar_links' => [],
        ])
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <div class="card card-xl-stretch mb-xl-8">
                    <!--begin::Header-->
                    {{-- <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>
                        </h3>
                    </div> --}}
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div id="kt_charts_widget_1_chart" style="height: 250px"></div>
                            </div>
                            {{-- <div class="col-md-1 d-flex justify-content-center align-items-center">
                                <div class="divider2"></div>
                            </div> --}}
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="row text-center offset-md-1">
                                    <div class="col-6">
                                        <!--begin: Statistics Widget 6-->
                                        <div class="card bg-light-white card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body my-3">
                                                <a href="#"
                                                    class="card-title fw-bolder text-dark fs-5 mb-3 d-block">Total user
                                                </a>
                                                <div class="">
                                                    <span class="text-dark" style="font-size: 30px;">100,356</span>
                                                </div>
                                                <div class="progress h-7px bg-secondary bg-opacity-50 mt-7">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <!--end:: Body-->
                                        </div>
                                        <!--end: Statistics Widget 6-->
                                    </div>
                                    <div class="col-6">
                                        <!--begin: Statistics Widget 6-->
                                        <div class="card bg-light-white card-xl-stretch mb-xl-8">
                                            <!--begin::Body-->
                                            <div class="card-body my-3">
                                                <a href="#"
                                                    class="card-title fw-bolder text-dark fs-5 mb-3 d-block">Completed tests
                                                </a>
                                                <div class="">
                                                    <span class="text-dark" style="font-size: 30px;">50,000</span>
                                                </div>
                                                <div class="progress h-7px bg-secondary bg-opacity-50 mt-7">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <!--end:: Body-->
                                        </div>
                                        <!--end: Statistics Widget 6-->
                                    </div>
                                </div>
                                <hr>
                                <div class="row text-center offset-md-1">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-5 d-flex justify-content-center align-items-center">
                                        <i class="bi bi-gender-female gender-icon female-icon p-1"></i>
                                        <div>
                                            <span>Female</span>
                                            <br>
                                            <span class="percentage text-dark" style="font-size: 15px;">73.6%</span>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-1 d-flex justify-content-center align-items-center">
                                        <div class="divider"></div>
                                    </div> --}}

                                    <div class="col-lg-5 col-md-5 col-sm-5 col-5 d-flex justify-content-center align-items-center">
                                        <i class="bi bi-gender-male gender-icon male-icon p-1"></i>
                                        <div>
                                            <span>Male</span>
                                            <br>
                                            <span class="percentage text-dark" style="font-size: 15px;">73.6%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-2">
                        <div class="card card-custom">
                            <div class="row">
                                <div class="col-md-8 text-start">
                                    <h5>KSA, Madinah</h5>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="total-users">Total users</span><br>
                                    <span class="user-count">100,356</span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="text-center">
                                    <div class="circle circle-red"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-yellow"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-green"></div><br>
                                    <span>1,546</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-2">
                        <div class="card card-custom">
                            <div class="row">
                                <div class="col-md-8 text-start">
                                    <h5>KSA, Madinah</h5>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="total-users">Total users</span><br>
                                    <span class="user-count">100,356</span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="text-center">
                                    <div class="circle circle-red"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-yellow"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-green"></div><br>
                                    <span>1,546</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-2">
                        <div class="card card-custom">
                            <div class="row">
                                <div class="col-md-8 text-start">
                                    <h5>KSA, Madinah</h5>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="total-users">Total users</span><br>
                                    <span class="user-count">100,356</span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="text-center">
                                    <div class="circle circle-red"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-yellow"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-green"></div><br>
                                    <span>1,546</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-2">
                        <div class="card card-custom">
                            <div class="row">
                                <div class="col-md-8 text-start">
                                    <h5>KSA, Madinah</h5>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="total-users">Total users</span><br>
                                    <span class="user-count">100,356</span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="text-center">
                                    <div class="circle circle-red"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-yellow"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-green"></div><br>
                                    <span>1,546</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-2">
                        <div class="card card-custom">
                            <div class="row">
                                <div class="col-md-8 text-start">
                                    <h5>KSA, Madinah</h5>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="total-users">Total users</span><br>
                                    <span class="user-count">100,356</span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="text-center">
                                    <div class="circle circle-red"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-yellow"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-green"></div><br>
                                    <span>1,546</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 p-2">
                        <div class="card card-custom">
                            <div class="row">
                                <div class="col-md-8 text-start">
                                    <h5>KSA, Madinah</h5>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="total-users">Total users</span><br>
                                    <span class="user-count">100,356</span>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-around mt-3">
                                <div class="text-center">
                                    <div class="circle circle-red"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-yellow"></div><br>
                                    <span>1,546</span>
                                </div>
                                <div class="text-center">
                                    <div class="circle circle-green"></div><br>
                                    <span>1,546</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    @push('panel_js')
        <script src="{{ asset('assets/panel/js/custom/apps/chat/chat.js') }}"></script>
        <script>
            t = document.getElementById("kt_charts_widget_1_chart"),
                a = parseInt(KTUtil.css(t, "height")),
                o = KTUtil.getCssVariableValue("--bs-gray-500"),
                s = KTUtil.getCssVariableValue("--bs-gray-200"),
                r = KTUtil.getCssVariableValue("--bs-purple"),
                i = KTUtil.getCssVariableValue("--bs-gray-300"),
                t && new ApexCharts(t, {
                    series: [{
                        name: "Revenue",
                        data: [30, 20, 50, 100, 10, 80, 76, 10, 5, 3, 0, 0]
                    }],
                    chart: {
                        fontFamily: "inherit",
                        type: "bar",
                        height: a,
                        toolbar: {
                            show: !1
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: !1,
                            columnWidth: ["35%"],
                            endingShape: "rounded"
                        }
                    },
                    legend: {
                        show: !1
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    stroke: {
                        show: !0,
                        width: 2,
                        colors: ["transparent"]
                    },
                    xaxis: {
                        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                        axisBorder: {
                            show: !1
                        },
                        axisTicks: {
                            show: !1
                        },
                        labels: {
                            style: {
                                colors: o,
                                fontSize: "12px"
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: o,
                                fontSize: "12px"
                            }
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    states: {
                        normal: {
                            filter: {
                                type: "none",
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: "none",
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: !1,
                            filter: {
                                type: "none",
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: "12px"
                        },
                        y: {
                            formatter: function(e) {
                                return "$" + e + " thousands"
                            }
                        }
                    },
                    colors: [r, i],
                    grid: {
                        borderColor: s,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: !0
                            }
                        }
                    }
                }).render();
        </script>
    @endpush
@endsection
