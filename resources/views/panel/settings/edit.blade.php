@extends('panel.layouts.index', ['sub_title' => __('dashboard.general_settings'), 'is_active' => 'profile'])
@section('contion')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
   @php 
            $title_toolbar = __('dashboard.general_settings');
   $toolbar_links = [
      [
        'title' => __('dashboard.home'),
        'link' => route('panel.home')
      ],
      [
        'title' => __('dashboard.system_settings'),
        'link' => '#'
      ],
      [
        'title' => __('dashboard.settings'),
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
         <!--begin::Messenger-->
         <div class="card" id="kt_chat_messenger">
            <!--begin::Card header-->
            <div class="card-header" id="kt_chat_messenger_header">
               <!--begin::Title-->
               <div class="card-title">
                  <!--begin::User-->
                  <div class="d-flex justify-content-center flex-column me-3">
                     <h2 class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">
                        {{@$title_toolbar}}
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
            <form id="form" method="{{isset($item) ? 'POST' : 'POST'}}" to="{{url()->current()}}"
               url="{{url()->current()}}" class="w-100">
               @csrf
               @method('put')
               <input type="hidden" value="{{@$settings->valueOf('logo')}}" name="logo" id="image" />
               <input type="hidden" value="{{@$settings->valueOf('white_logo')}}" name="white_logo" id="image_2" />

               <!--begin::Card body-->
               <div class="card-body">
                  <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                     @php
                  $tabs = [
                     [
                       'id' => 'tab_site_settings',
                       'title' => __('dashboard.general_settings'),
                       'icon' => 'bi bi-archive',
                       'is_active' => true,
                     ],
                     [
                       'id' => 'tab_social_media',
                       'title' => __('dashboard.social_media_sites'),
                       'icon' => 'bi bi-archive',
                       'is_active' => false,
                     ],
                     [
                       'id' => 'tab_contact',
                       'title' => __('dashboard.contact_information'),
                       'icon' => 'bi bi-archive',
                       'is_active' => false,
                     ],

                  ];
                  @endphp
                     @foreach($tabs as $tab)
                   <li class="nav-item">
                     <a class="nav-link {{@$tab['is_active'] ? 'active show' : ''}} " data-bs-toggle="tab"
                        href="#{{@$tab['id']}}" role="tab" aria-selected="false">
                        <i class="{{$tab['icon']}} mr-2"></i>
                        {{$tab['title']}}
                     </a>
                   </li>
                @endforeach
                  </ul>
                  <div class="tab-content" id="myTabContent" style="margin-top: 24px;">
                     <div class="tab-pane  active show" id="tab_site_settings" role="tabpanel">

                        <div class="row">
                           <div class="col-md-3">
                              <div class="fv-row mb-7 fv-plugins-icon-container">
                                 <!--begin::Label-->
                                 <label class="required fs-6 fw-bold mb-2">
                                    {{__('dashboard.logo')}}
                                 </label>
                                 <!--end::Label-->
                                 <br>
                                 <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url(/assets/panel/media/avatars/blank.png)">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px"
                                       style="background-image: url({{imageUrl(@$settings->valueOf('logo'))}})"></div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                       class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow "
                                       data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                       title="{{__('dashboard.change')}}">
                                       <i class="bi bi-pencil-fill fs-7"></i>
                                       <!--begin::Inputs-->
                                       <input type="hidden" id="width_image" value="100" />
                                       <input type="hidden" id="height_image" value="100" />
                                       <input type="hidden" id="custome_path" value="settings" />

                                       <input class="file-upload" type="file" name="avatar"
                                          accept=".png, .jpg, .jpeg" />
                                       <input type="hidden" name="avatar_remove" />
                                       <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                       class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                       data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                       title="Cancel avatar">
                                       <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span
                                       class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                       data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                       title="{{__('dashboard.remove')}}">
                                       <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                 </div>
                                 <!--end::Image input-->
                                 <!--begin::Hint-->
                                 <div class="form-text">
                                    {{__('dashboard.allowed_image_type', ['types' => 'png, jpg, jpeg'])}}
                                 </div>
                                 <!--end::Hint-->


                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="fv-row mb-7 fv-plugins-icon-container">
                                 <!--begin::Label-->
                                 <label class="required fs-6 fw-bold mb-2">
                                    {{__('dashboard.white_logo')}}
                                 </label>
                                 <!--end::Label-->
                                 <br>
                                 <div class="image-input image-input-outline" data-kt-image-input="true"
                                    style="background-image: url(/assets/panel/media/avatars/blank.png)">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px"
                                       style="background-image: url({{imageUrl(@$settings->valueOf('white_logo'))}})">
                                    </div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label
                                       class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow "
                                       data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                       title="{{__('dashboard.change')}}">
                                       <i class="bi bi-pencil-fill fs-7"></i>
                                       <!--begin::Inputs-->
                                       <input type="hidden" id="width_image" value="100" />
                                       <input type="hidden" id="height_image" value="100" />
                                       <input type="hidden" id="custome_path" value="settings" />

                                       <input class="file-upload-2" type="file" name="avatar"
                                          accept=".png, .jpg, .jpeg" />
                                       <input type="hidden" name="avatar_remove" />
                                       <!--end::Inputs-->
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Cancel-->
                                    <span
                                       class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                       data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                       title="Cancel avatar">
                                       <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Cancel-->
                                    <!--begin::Remove-->
                                    <span
                                       class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                                       data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                       title="{{__('dashboard.remove')}}">
                                       <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <!--end::Remove-->
                                 </div>
                                 <!--end::Image input-->
                                 <!--begin::Hint-->
                                 <div class="form-text">
                                    {{__('dashboard.allowed_image_type', ['types' => 'png, jpg, jpeg'])}}
                                 </div>
                                 <!--end::Hint-->


                              </div>
                           </div>

                        </div>


                        @foreach(locales() as $locale => $value)
                     <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold mb-2">
                          {{__('dashboard.title')}}

                          ({{ __($value) }} )
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="title_{{$locale}}" class="form-control form-control-solid"
                          value="{{@$settings->valueOf('title_' . $locale)}}" required id="exampleInputPassword1"
                          placeholder="" />
                        <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                     </div>
                     <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold mb-2">

                          {{__('dashboard.describe')}}

                          ({{ __($value) }} )
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea type="text" name="describe_{{$locale}}" class="form-control form-control-solid"
                          rows="4" required>{{@$settings->valueOf('describe_' . $locale)}}</textarea>
                        <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                     </div>
                     <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold mb-2">
                          {{__('dashboard.copyright')}}
                          ({{ __($value) }} )
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="copyright_{{$locale}}" class="form-control form-control-solid"
                          value="{{@$settings->valueOf('copyright_' . $locale)}}" required
                          id="exampleInputPassword1" placeholder="" />
                        <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                     </div>
                     <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold mb-2">
                          {{__('dashboard.tags')}}
                          ({{ __($value) }} )
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input id="kt_tagify_1_{{$locale}}" class="form-control form-control-solid"
                          name='tags_{{$locale}}' placeholder='' value="{{@$settings->valueOf('tags_' . $locale)}}"
                          required />
                        <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                     </div>

                     <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold mb-2">
                          {{__('dashboard.address')}}
                          ({{ __($value) }} )
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input id="kt_tagify_1_{{$locale}}" class="form-control form-control-solid"
                          name='address_{{$locale}}' placeholder=''
                          value="{{@$settings->valueOf('address_' . $locale)}}" required />
                        <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                     </div>

                     <hr>
                  @endforeach

                   


                     </div>
                     <div class="tab-pane  " id="tab_social_media" role="tabpanel">
                        @foreach($socials as $social)
                     <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-bold mb-2">
                          {{$social->name}}
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" type="text" name="{{$social->key}}"
                          value="{{$social->getLink()}}" placeholder="{{$social->name}} ">
                        <!--end::Input-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                     </div>
                  @endforeach
                     </div>
                     <div class="tab-pane  " id="tab_contact" role="tabpanel">
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                           <!--begin::Label-->
                           <label class="required fs-6 fw-bold mb-2">
                              {{__('dashboard.email')}}
                           </label>
                           <!--end::Label-->
                           <!--begin::Input-->
                           <input type="text" name="email" class="form-control form-control-solid"
                              value="{{@$settings->valueOf('email')}}" required id="email" placeholder="" />
                           <!--end::Input-->
                           <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <div class="fv-row mb-7 fv-plugins-icon-container">
                           <!--begin::Label-->
                           <label class="required fs-6 fw-bold mb-2">
                              {{__('dashboard.mobile')}}
                           </label>
                           <!--end::Label-->
                           <!--begin::Input-->
                           <input type="text" name="mobile" class="form-control form-control-solid"
                              value="{{@$settings->valueOf('mobile')}}" required id="mobile" placeholder="" />
                           <!--end::Input-->
                           <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                     </div>


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
         <!--end::Messenger-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Post-->
</div>
<!--end::Content-->
@push('panel_js')
   <script src="{{asset('assets/panel/js/custom/control-panel/jqueryValidate.min.js')}}"></script>
   <script src="{{asset('assets/panel/js/custom/control-panel/post.js')}}"></script>
   <script src="{{asset('assets/panel/js/custom/documentation/forms/image-input.js')}}"></script>
   @foreach(locales() as $locale => $value)
      <script>
        // Initialize Tagify components on the above inputs
        new Tagify(document.querySelector("#kt_tagify_1_{{$locale}}"));
      </script>
   @endforeach

@endpush
@stop