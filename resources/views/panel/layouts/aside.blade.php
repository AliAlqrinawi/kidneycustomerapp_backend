<!--begin::Aside-->
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="{{route('panel.home')}}">
            <img alt="Logo" src="{{imageUrl(getSeting('white_logo'))}}" class="h-55px logo" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="aside-minimize">
            <!--begin::Svg Icon | path: icons/duotone/Navigation/Angle-double-left.svg-->
            <span class="svg-icon svg-icon-1 rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.5"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Aside toggler-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-2 py-5 py-lg-8" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
            data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link active" href="{{route('panel.home')}}">
                        <span class="menu-icon">
                            <i class="bi bi-house fs-3"></i>
                        </span>
                        <span class="menu-title">
                            {{__('dashboard.dashboard')}}
                        </span>
                    </a>
                </div>
                @php
                                                                                                                                                                                                                                                                                                                                                                                            $user_admin = getAdmin();
                    $menus = [
                        'system_content_management' => [
                            [
                                'title' => __('dashboard.inbox'),
                                'link' => route('panel.inbox.all.index'),
                                'is_active' => false,
                                'icon' => 'bi-chat-right-text',
                                'permission_check' => $user_admin->can('show_inbox'),
                                'sub_menu' => []
                            ],
                            [
                                'title' => __('dashboard.products'),
                                'link' => '#',
                                'is_active' => false,
                                'icon' => 'bi-diagram-2',
                                'permission_check' => '',
                                'sub_menu' => [
                                    [
                                        'title' => __('dashboard.products'),
                                        'link' => route('panel.products.all.index'),
                                        'is_active' => false,
                                        'permission_check' => $user_admin->can('show_products'),
                                    ],
                                    [
                                        'title' => __('dashboard.categories'),
                                        'link' => route('panel.constants.all.index', ['parent' => 'products_categories']),
                                        'is_active' => false,
                                        'permission_check' => $user_admin->can('show_products_categories'),
                                    ],


                                ]
                            ],
                            [
                                'title' => __('dashboard.posts'),
                                'link' => '#',
                                'is_active' => false,
                                'icon' => 'bi-stickies',
                                'permission_check' => '',
                                'sub_menu' => [
                                    [
                                        'title' => __('dashboard.posts'),
                                        'link' => route('panel.posts.all.index'),
                                        'is_active' => false,
                                        'permission_check' => $user_admin->can('show_posts'),
                                    ],
                                    [
                                        'title' => __('dashboard.categories'),
                                        'link' => route('panel.constants.all.index', ['parent' => 'posts_categories']),
                                        'is_active' => false,
                                        'permission_check' => $user_admin->can('show_posts_categories'),
                                    ],


                                ]
                            ],
                        ],

                        'institutions_management' => [
                            [
                                'title' => __('dashboard.institutions'),
                                'link' => route('panel.institutions.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-house',
                                'permission_check' => $user_admin->can('show_institutions'),
                                'sub_menu' => []
                            ],
                            [
                                'title' => __('dashboard.areas'),
                                'link' => route('panel.areas.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-shop-window',
                                'permission_check' => $user_admin->can('show_areas'),
                                'sub_menu' => []
                            ],
                            [
                                'title' => __('dashboard.providers'),
                                'link' => route('panel.providers.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-people',
                                'permission_check' => $user_admin->can('show_providers'),
                                'sub_menu' => []
                            ],
                        ],

                        'general_settings' => [
                            [
                                'title' => __('dashboard.pages'),
                                'link' => route('panel.pages.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-archive',
                                'permission_check' => $user_admin->can('show_pages'),
                                'sub_menu' => []
                            ],
                            [
                                'title' => __('dashboard.settings'),
                                'link' => route('panel.settings.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-gear-fill',
                                'permission_check' => $user_admin->can('show_settings'),
                                'sub_menu' => []
                            ],
                            [
                                'title' => __('dashboard.questionnaire_forms'),
                                'link' => route('panel.questionnaireForms.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-patch-question-fill',
                                'permission_check' => $user_admin->can('show_settings'),
                                'sub_menu' => []
                            ],
                            [
                                'title' => __('dashboard.constants'),
                                'link' => '#',
                                'is_active' => false,
                                'icon' => 'bi-hdd-stack-fill',
                                'permission_check' => '',
                                'sub_menu' => [
                                    [
                                        'title' => __('dashboard.blood_types'),
                                        'link' => route('panel.constants.all.index', ['parent' => 'blood_types']),
                                        'is_active' => false,
                                        'permission_check' => $user_admin->can('show_blood_types'),
                                    ],
                                    [
                                        'title' => __('dashboard.types_health_insurance'),
                                        'link' => route('panel.constants.all.index', ['parent' => 'types_health_insurance']),
                                        'is_active' => false,
                                        'permission_check' => $user_admin->can('show_types_health_insurance'),
                                    ],

                                ]
                            ],
                        ],
                        'system_users' => [
                            [
                                'title' => __('dashboard.users'),
                                'link' => route('panel.users.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-people',
                                'permission_check' => $user_admin->can('show_users'),
                                'sub_menu' => []
                            ],
                        ],

                        'management_of_admins' => [
                            [
                                'title' => __('dashboard.managing_system_administrators'),
                                'link' => route('panel.admins.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-people',
                                'permission_check' => $user_admin->can('show_admins'),
                                'sub_menu' => []
                            ],
                            [
                                'title' => __('dashboard.roles'),
                                'link' => route('panel.roles.all.index'),
                                'is_active' => false,
                                'icon' => 'bi bi-gear-fill',
                                'permission_check' => $user_admin->can('show_roles'),
                                'sub_menu' => []
                            ],
                        ],
                    ];
                @endphp
                @foreach($menus as $key => $value)
                    @if(count(MenusCheck($value)) > 0)

                        <div class="menu-item">
                            <div class="menu-content pt-8 pb-2">
                                <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                                    {{__('dashboard.' . $key)}}
                                </span>
                            </div>
                        </div>

                        @foreach($value as $menu)

                            @if(count($menu['sub_menu']) > 0 && count(MenusCheck($menu['sub_menu'])) > 0)
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <i class="{{@$menu['icon']}} fs-3"></i>
                                        </span>
                                        <span class="menu-title">
                                            {{@$menu['title']}}
                                        </span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        @foreach ($menu['sub_menu'] as $sub_menu)
                                            @if($sub_menu['permission_check'])
                                                <div class="menu-item">
                                                    <a class="menu-link" href="{{@$sub_menu['link']}}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">
                                                            {{@$sub_menu['title']}}
                                                        </span>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                @if($menu['permission_check'])
                                    <div class="menu-item">
                                        <a class="menu-link {{@$menu['is_active'] ? 'active' : ''}}" href="{{@$menu['link']}}">
                                            <span class="menu-icon">
                                                <i class="{{@$menu['icon']}} fs-3"></i>
                                            </span>
                                            <span class="menu-title">
                                                {{@$menu['title']}}
                                            </span>
                                        </a>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
            <!--end::Menu-->
        </div>
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
        <a href="{{route('panel.logout')}}" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip"
            data-bs-trigger="hover" data-bs-dismiss-="click" title="{{__('dashboard.sign_out')}}">
            <span class="btn-label">
                {{__('dashboard.sign_out')}}
            </span>
        </a>
    </div>
    <!--end::Footer-->
</div>
<!--end::Aside-->
