<!--begin::Header-->
<div id="kt_header" style="" class="header align-items-stretch">
   <!--begin::Container-->
   <div class="container-fluid d-flex align-items-stretch justify-content-between">
      <!--begin::Aside mobile toggle-->
      <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
         <div class="btn btn-icon btn-active-color-white" id="kt_aside_mobile_toggle">
            <i class="bi bi-list fs-1"></i>
         </div>
      </div>
      <!--end::Aside mobile toggle-->
      <!--begin::Mobile logo-->
      <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
         <a href="{{route('panel.home')}}" class="d-lg-none">
            <img alt="Logo" src="{{imageUrl(getSeting('white_logo'))}}" class="h-55px" />
         </a>
      </div>
      <!--end::Mobile logo-->
      <!--begin::Wrapper-->
      <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
         <!--begin::Navbar-->
         <div class="d-flex align-items-stretch" id="kt_header_nav">
            <!--begin::Menu wrapper-->
            <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu"
               data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
               data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end"
               data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true"
               data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
               @php 

                              $header_menus = [
               [
                 'title' => __('dashboard.dashboard'),
                 'link' => route('panel.home'),
                 'sub_menu' => [],
               ],
               [
                 'title' => __('dashboard.dashboard'),
                 'link' => route('panel.home'),
                 'sub_menu' => [
                   [
                     'title' => __('dashboard.dashboard'),
                     'link' => route('panel.home'),
                     'icon' => 'bi bi-grid',
                     'text' => __('dashboard.dashboard'),
                   ],
                 ],
               ],

            ];

           @endphp 
               <!--begin::Menu-->
               <div
                  class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
                  id="#kt_header_menu" data-kt-menu="true">
                  @foreach ($header_menus as $header_menu)
                 @if(count($header_menu['sub_menu']) == 0)
                <div class="menu-item me-lg-1">
                  <a class="menu-link active py-3" href="{{@$header_menu['link']}}">
                   <span class="menu-title">
                     {{@$header_menu['title']}}
                   </span>
                  </a>
                </div>


             @else

             <div data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start"
               class="menu-item menu-lg-down-accordion me-lg-1 d-none">
               <span class="menu-link py-3">
                <span class="menu-title">{{@$header_menu['title']}}</span>
                <span class="menu-arrow d-lg-none"></span>
               </span>
               <div
                class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px">
                @foreach ($header_menu['sub_menu'] as $sub_menu)
               <div class="menu-item">
                 <a class="menu-link py-3" href="{{$sub_menu['link']}}" title="{{@$sub_menu['text']}}"
                  data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                  data-bs-placement="right">
                  <span class="menu-icon">
                   <i class="{{@$sub_menu['icon']}} fs-3"></i>
                  </span>
                  <span class="menu-title">
                   {{@$sub_menu['title']}}
                  </span>
                 </a>
               </div>

            @endforeach

               </div>
             </div>

          @endif
              @endforeach



               </div>
               <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->
         </div>
         <!--end::Navbar-->
         <!--begin::Topbar-->
         <div class="d-flex align-items-stretch flex-shrink-0">
            <!--begin::Toolbar wrapper-->
            <div class="topbar d-flex align-items-stretch flex-shrink-0">
               <!--begin::Quick links-->

               <!--end::Quick links-->
               <!--begin::Notifications-->

               <!--end::Notifications-->
               <!--begin::User-->
               @php 
               $user_admin = getAdmin();
           @endphp   
               <div class="d-flex align-items-stretch" id="kt_header_user_menu_toggle">
                  <!--begin::Menu wrapper-->
                  <div class="topbar-item cursor-pointer symbol px-3 px-lg-5 me-n3 me-lg-n5 symbol-30px symbol-md-35px"
                     data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end"
                     data-kt-menu-flip="bottom">
                     <img src="{{imageUrl(@$user_admin->image)}}" alt="metronic" />
                  </div>
                  <!--begin::Menu-->
                  <div
                     class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                     data-kt-menu="true">
                     <!--begin::Menu item-->
                     <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">

                           <!--begin::Avatar-->
                           <div class="symbol symbol-50px me-5">
                              <img alt="Logo" src="{{imageUrl($user_admin->image)}}" />
                           </div>
                           <!--end::Avatar-->
                           <!--begin::Username-->

                           <div class="d-flex flex-column">
                              <div class="fw-bolder d-flex align-items-center fs-5">
                                 {{@$user_admin->name}}
                              </div>
                              <a href="#" class="fw-bold text-muted text-hover-primary fs-7">
                                 {{@$user_admin->email}}
                              </a>
                           </div>
                           <!--end::Username-->
                        </div>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu separator-->
                     <div class="separator my-2"></div>
                     <!--end::Menu separator-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5">
                        <a href="{{route('panel.profile.index')}}" class="menu-link px-5">
                           {{__('dashboard.my_profile')}}
                        </a>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu separator-->
                     <div class="separator my-2"></div>
                     <!--end::Menu separator-->
                     <!-- can add file switch lang -->
                      @include('panel.layouts.switch_lang')
                     <!--begin::Menu item-->
                     <!--end::Menu item-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5">
                        <a href="{{route('panel.logout')}}" class="menu-link px-5">
                           {{__('dashboard.sign_out')}}
                        </a>
                     </div>
                     <!--end::Menu item-->
                  </div>
                  <!--end::Menu-->
                  <!--end::Menu wrapper-->
               </div>
               <!--end::User -->
               <!--begin::Heaeder menu toggle-->
               <div class="d-flex align-items-stretch d-lg-none px-3 me-n3" title="Show header menu">
                  <div class="topbar-item" id="kt_header_menu_mobile_toggle">
                     <i class="bi bi-text-left fs-1"></i>
                  </div>
               </div>
               <!--end::Heaeder menu toggle-->
            </div>
            <!--end::Toolbar wrapper-->
         </div>
         <!--end::Topbar-->
      </div>
      <!--end::Wrapper-->
   </div>
   <!--end::Container-->
</div>
<!--end::Header-->