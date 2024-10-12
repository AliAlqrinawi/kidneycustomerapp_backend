<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">{{date('Y')}}©</span>
            <a href="/" target="_blank" class="text-gray-800 text-hover-primary">
                {{getSeting('title_' . app()->getLocale())}}
            </a>
        </div>
        <!--end::Copyright-->
        <!--begin::Menu-->
        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
            @php 

             $footer_menus = [
                    [
                        'title' => __('dashboard.dashboard'),
                        'link' => route('panel.home'),
                    ],
                ];

            @endphp

            @foreach ($footer_menus as $footer_menu)
                <li class="menu-item">
                    <a href="{{@$footer_menu['link']}}" class="menu-link px-2">
                        {{$footer_menu['title']}}
                    </a>
                </li>
            @endforeach
        </ul>
        <!--end::Menu-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->