@extends('panel.layouts.index', [
'sub_title' => __('dashboard.roles'),
'is_active' => 'roles'
])
@section('contion')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
   @php 
   $title_toolbar = __('dashboard.roles');
   $toolbar_links = [
   [
   'title' => __('dashboard.home'),
   'link' => route('panel.home')
   ],
   [
   'title' => __('dashboard.management_of_admins'),
   'link' => '#'
   ],
   [
   'title' => __('dashboard.roles'),
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
         <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
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
               <!--begin::Card body-->
               <div class="card-body">
                  <div class="fv-row mb-7 fv-plugins-icon-container">
                     <!--begin::Label-->
                     <label class="required fs-6 fw-bold mb-2">
                     {{__('dashboard.title')}}
                     </label>
                     <!--end::Label-->
                     <!--begin::Input-->
                     <input type="text" name="name" class="form-control form-control-solid" value="{{@$item->name}}"
                        required id="exampleInputPassword1" placeholder="" />
                     <!--end::Input-->
                     <div class="fv-plugins-message-container invalid-feedback"></div>
                  </div>
                  <div class="fv-row">
                     <!--begin::Label-->
                     <label class="fs-5 fw-bolder form-label mb-2">
                     {{__('dashboard.role_permissions')}}
                     </label>
                     <!--end::Label-->
                     <!--begin::Table wrapper-->
                     <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                           <!--begin::Table body-->
                           <tbody class="text-gray-600 fw-bold">
                              <!--begin::Table row-->
                              <tr>
                                 <td class="text-gray-800">
                                    {{__('dashboard.administrator_access')}}
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title=""
                                       data-bs-original-title="{{__('dashboard.allows_a_full_access_to_the_system')}}"
                                       aria-label="{{__('dashboard.allows_a_full_access_to_the_system')}}"></i>
                                 </td>
                                 <td>
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                    <input class="form-check-input" type="checkbox" value=""
                                       id="kt_roles_select_all">
                                    <span class="form-check-label" for="kt_roles_select_all">
                                    {{__('dashboard.select_all')}}
                                    </span>
                                    </label>
                                    <!--end::Checkbox-->
                                 </td>
                              </tr>
                              <!--end::Table row-->
                              @foreach ($permission as $key => $value)
                              <!--begin::Table row-->
                              <tr>
                                 <!--begin::Label-->
                                 <td class="text-gray-800">
                                    {{__('dashboard.' . $key)}}
                                 </td>
                                 <!--end::Label-->
                                 <!--begin::Input group-->
                                 <td>
                                    <!--begin::Wrapper-->
                                    <div class="d-flex">
                                       @foreach ($value as $permission_item)
                                       @php
                                       $checked='';
                                       try{
                                       if(isset($item)){
                                       if($item->hasPermissionTo($permission_item)){
                                       $checked='checked';
                                       }
                                       }
                                       } catch (Exception $e) {
                                       }
                                       @endphp
                                       <!--begin::Checkbox-->
                                       <label
                                          class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                       <input class="form-check-input" type="checkbox" 
                                       value="{{@$permission_item->name}}"
                                       name="permissions[]"
                                       {{@$checked}}
                                       >
                                       <span class="form-check-label">
                                       {{__('dashboard.' . @$permission_item->name)}}
                                       </span>
                                       </label>
                                       <!--end::Checkbox-->
                                       @endforeach
                                    </div>
                                    <!--end::Wrapper-->
                                 </td>
                                 <!--end::Input group-->
                              </tr>
                              <!--end::Table row-->
                              @endforeach
                           </tbody>
                           <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                     </div>
                     <!--end::Table wrapper-->
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
<script src="{{asset('assets/panel/js/custom/control-panel/pages/roles.js')}}"></script>
@endpush
@stop