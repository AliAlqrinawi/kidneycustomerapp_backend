@extends('panel.layouts.index', [
   'sub_title' => __('dashboard.constants'),
   'is_active' => 'constants'
])
@section('contion')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
   @php 
            $title_toolbar = __('dashboard.constants') . ' (' . __('dashboard.' . request('parent')) . ')';
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
        'title' => __('dashboard.constants'),
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
               <input type="hidden" id="image" name="image" value="{{@$item->image}}" />
               <!--begin::Card body-->
               <div class="card-body">
                  @if(in_array(request('parent'), ['']))
                 <div class="fv-row mb-7">
                   <!--begin::Label-->
                   <label class="d-block fw-bold fs-6 mb-5">
                     {{__('dashboard.main_image')}}
                   </label>
                   <!--end::Label-->
                   <!--begin::Image input-->
                   <div class="image-input image-input-outline" data-kt-image-input="true"
                     style="background-image: url(/assets/panel/media/avatars/blank.png)">
                     <!--begin::Preview existing avatar-->
                     <div class="image-input-wrapper w-125px h-125px"
                        style="background-image: url({{imageUrl(@$item->image)}})"></div>
                     <!--end::Preview existing avatar-->
                     <!--begin::Label-->
                     <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow "
                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                        title="{{__('dashboard.change')}}">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <!--begin::Inputs-->
                        <input type="hidden" id="width_image" value="100" />
                        <input type="hidden" id="height_image" value="100" />
                        <input type="hidden" id="custome_path" value="constants" />
                        <input class="file-upload" type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />
                        <!--end::Inputs-->
                     </label>
                     <!--end::Label-->
                     <!--begin::Cancel-->
                     <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="bi bi-x fs-2"></i>
                     </span>
                     <!--end::Cancel-->
                     <!--begin::Remove-->
                     <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-white shadow"
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
              @endif          @foreach(locales() as $locale => $value)

              <div class="fv-row mb-7 fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required fs-6 fw-bold mb-2">
                  {{__('dashboard.title')}}
                  ({{ __($value) }} )
                </label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" name="name_{{$locale}}" class="form-control form-control-solid"
                  value="{{isset($item) ? @$item->translate($locale)->name : ''}}" required
                  id="exampleInputPassword1" placeholder="" />
                <!--end::Input-->
                <div class="fv-plugins-message-container invalid-feedback"></div>
              </div>

           @endforeach 

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
   <script src="{{asset('assets/panel/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
   <script src="{{asset('assets/panel/plugins/custom/tinymce/tinymce.js')}}"></script>

@endpush
@stop