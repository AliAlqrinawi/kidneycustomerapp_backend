@extends('panel.layouts.index', ['sub_title' => __('dashboard.account_settings'), 'is_active' => 'profile'])
@section('contion')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
   @php 
      $title_toolbar = __('dashboard.account_settings');
   $toolbar_links = [
      [
        'title' => __('dashboard.home'),
        'link' => route('panel.home')
      ],
      [
        'title' => __('dashboard.account'),
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

         <!--begin::Basic info-->
         <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
               data-bs-target="#kt_account_profile_details" aria-expanded="true"
               aria-controls="kt_account_profile_details">
               <!--begin::Card title-->
               <div class="card-title m-0">
                  <h3 class="fw-bolder m-0">
                     {{__('dashboard.profile_details')}}
                  </h3>
               </div>
               <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
               <!--begin::Form-->
               <form id="form" method="{{isset($item) ? 'POST' : 'POST'}}" action="{{url()->current()}}"
                  to="{{url()->current()}}" class="form">
                  @csrf
                  <input type="hidden" id="image" name="image" value="{{@$item->image}}" />
                  <!--begin::Card body-->
                  <div class="card-body border-top p-9">
                     <!--begin::Input group-->
                     <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-bold fs-6">
                           {{__('dashboard.avatar')}}
                        </label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                           <!--begin::Image input-->
                           <div class="image-input image-input-outline" data-kt-image-input="true"
                              style="background-image: url(/assets/panel/media/avatars/blank.png)">
                              <!--begin::Preview existing avatar-->
                              <div class="image-input-wrapper w-125px h-125px"
                                 style="background-image: url({{imageUrl(@$item->image)}})"></div>
                              <!--end::Preview existing avatar-->
                              <!--begin::Label-->
                              <label
                                 class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow "
                                 data-kt-image-input-action="change" 
                                 data-bs-toggle="tooltip" title="{{__('dashboard.change')}}">
                                 <i class="bi bi-pencil-fill fs-7"></i>
                                 <!--begin::Inputs-->
                                 <input type="hidden" id="width_image" value="100" />
                                 <input type="hidden" id="height_image" value="100" />
                                 <input type="hidden" id="custome_path" value="admins" />

                                 <input class="file-upload" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
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
                                 data-kt-image-input-action="remove" 
                                 data-bs-toggle="tooltip"
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
                        <!--end::Col-->
                     </div>
                     <!--end::Input group-->
                     <!--begin::Input group-->
                     <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label required fw-bold fs-6">
                           {{__('dashboard.full_name')}}
                        </label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                           <!--begin::Row-->
                           <div class="row">
                              <!--begin::Col-->
                              <div class="col-lg-12 fv-row">
                                 <input type="text" name="name"
                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                    placeholder="{{__('dashboard.full_name')}}" value="{{@$item->name}}" required />
                              </div>
                              <!--end::Col-->

                           </div>
                           <!--end::Row-->
                        </div>
                        <!--end::Col-->
                     </div>
                     <!--end::Input group-->

                  </div>
                  <!--end::Card body-->
                  <!--begin::Actions-->
                  <div class="card-footer d-flex justify-content-end py-6 px-9">
                     <button type="reset" class="btn btn-white btn-active-light-primary me-2">
                        {{__('dashboard.discard')}}
                     </button>

                     @include('panel.components.btn_submit', ['btn_submit_text' => __('dashboard.save')])

                  </div>
                  <!--end::Actions-->
               </form>
               <!--end::Form-->
            </div>
            <!--end::Content-->
         </div>
         <!--end::Basic info-->
         <!--begin::Sign-in Method-->
         <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
               data-bs-target="#kt_account_signin_method">
               <div class="card-title m-0">
                  <h3 class="fw-bolder m-0">
                     {{__('dashboard.sign_in_method')}}
                  </h3>
               </div>
            </div>
            <!--end::Card header-->
            <!--begin::Content-->
            <div id="kt_account_signin_method" class="collapse show">
               <!--begin::Card body-->
               <div class="card-body border-top p-9">


                  <!--begin::Password-->
                  <div class="d-flex flex-wrap align-items-center mb-10">
                     <!--begin::Label-->
                     <div id="kt_signin_password">
                        <div class="fs-6 fw-bolder mb-1">
                           {{__('dashboard.password')}}
                        </div>
                        <div class="fw-bold text-gray-600">************</div>
                     </div>
                     <!--end::Label-->
                     <!--begin::Edit-->
                     <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                        <!--begin::Form-->

                        <form id="form_2" method="{{isset($item) ? 'POST' : 'POST'}}"
                           action="{{route('panel.profile.resetPassword')}}" to="{{url()->current()}}" class="form">
                           @csrf
                           <div class="row mb-1">
                              <div class="col-lg-4">
                                 <div class="fv-row mb-0">
                                    <label for="currentpassword" class="form-label fs-6 fw-bolder mb-3">
                                       {{__('dashboard.current_password')}}
                                    </label>
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                       name="current_password" id="currentpassword" required />
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="fv-row mb-0">
                                    <label for="password" class="form-label fs-6 fw-bolder mb-3">
                                       {{__('dashboard.new_password')}}

                                    </label>
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                       name="new_password" id="password" required />
                                 </div>
                              </div>
                              <div class="col-lg-4">
                                 <div class="fv-row mb-0">
                                    <label for="confirmpassword" class="form-label fs-6 fw-bolder mb-3">
                                       {{__('dashboard.confirm_new_password')}}
                                    </label>
                                    <input type="password" class="form-control form-control-lg form-control-solid"
                                       name="password_confirmation" id="confirmpassword" required />
                                 </div>
                              </div>
                           </div>
                           <!-- <div class="form-text mb-5">Password must be at least 8 character and contain symbols</div> -->
                           <div class="d-flex mt-5">
                              @include('panel.components.btn_submit', ['btn_submit_text' => __('dashboard.save')])

                              <button id="kt_password_cancel" type="button"
                                 class="btn btn-color-gray-400 btn-active-light-primary px-6">
                                 {{__('dashboard.cancel')}}
                              </button>
                           </div>
                        </form>
                        <!--end::Form-->
                     </div>
                     <!--end::Edit-->
                     <!--begin::Action-->
                     <div id="kt_signin_password_button" class="ms-auto">
                        <button class="btn btn-light btn-active-light-primary">
                           {{__('dashboard.reset_password')}}
                        </button>
                     </div>
                     <!--end::Action-->
                  </div>
                  <!--end::Password-->

               </div>
               <!--end::Card body-->
            </div>
            <!--end::Content-->
         </div>
         <!--end::Sign-in Method-->


         <!--end::Modals-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Post-->
</div>
<!--end::Content-->


@push('panel_js')
   <script src="{{asset('assets/panel/js/custom/control-panel/jqueryValidate.min.js')}}"></script>
   <script src="{{asset('assets/panel/js/custom/documentation/forms/image-input.js')}}"></script>
   <script src="{{asset('assets/panel/js/custom/control-panel/post.js')}}"></script>
   <script src="{{asset('assets/panel/js/custom/control-panel/pages/account_settings.js')}}"></script>

@endpush
@stop