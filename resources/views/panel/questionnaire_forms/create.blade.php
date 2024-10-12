@extends('panel.layouts.index', [
   'sub_title' => __('dashboard.questionnaire_forms'),
   'is_active' => 'questionnaire_forms'
])
@section('contion')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
   @php 
            $title_toolbar = __('dashboard.questionnaire_forms');
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
        'title' => __('dashboard.questionnaire_forms'),
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



                  <div class="row">
                     @foreach(locales() as $locale => $value)

                   <div class="col-md-6 fv-row mb-7 fv-plugins-icon-container">
                     <!--begin::Label-->
                     <label class="required fs-6 fw-bold mb-2">
                        {{__('dashboard.title')}}
                        ({{ __($value) }} )
                     </label>
                     <!--end::Label-->
                     <!--begin::Input-->
                     <input type="text" name="title_{{$locale}}" class="form-control form-control-solid"
                        value="{{isset($item) ? @$item->translate($locale)->title : ''}}" required
                        id="exampleInputPassword1" placeholder="" />
                     <!--end::Input-->
                     <div class="fv-plugins-message-container invalid-feedback"></div>
                   </div>


                @endforeach 
                  </div>

                  <fieldset class="scheduler-border">
                        <legend class="scheduler-borderL">
                           <label>
                                                         حقول النموذج  

                           </label>
                        </legend>
                        @php 
                        $formFields=[];
                        if(isset($item)){
                         $formFields=$item->fields;
                        }
                        @endphp 
                        <div class="fileds">
                           @foreach ($formFields as $formField )
                           @include('panel.questionnaire_forms.partials.filds')
                           @endforeach
                        </div>
                        {{--  types fileds  --}}
                        <hr>
                        <div class="form-group m-form__group row mb-25 d-flex justify-content-cente fileds_type">
                           <div class="col-md-3">
                              <button type="button"  class="btn btn-success w-100 add_filed" data-type="input">حقل ادخال
                              </button>     
                           </div>
                           <div class="col-md-3">
                              <button type="button"  class="btn btn-warning w-100 add_filed" data-type="textarea" >حقل نصي  
                              </button>     
                           </div>
                           <div class="col-md-3">
                              <button type="button"  class="btn btn-primary w-100 add_filed" data-type="checkboxs">الاجابات المتعددة 
                              </button>     
                           </div>
                           <div class="col-md-3">
                              <button type="button"  class="btn btn-danger w-100 add_filed" data-type="radio">اختر من متعدد
                              </button>     
                           </div>
                           <div class="col-md-3">
                              <button type="button"  class="btn btn-dark w-100 add_filed" data-type="file">مرفقات
                              </button>     
                           </div>
                           <div class="col-md-3">
                              <button type="button"  class="btn btn-info w-100 add_filed" data-type="hint">ملاحظة نصية
                              </button>     
                           </div>
                           <div class="col-md-3">
                              <button type="button"  class="btn btn-primary w-100 add_filed" data-type="select">قائمة منسدلة  
                              </button>     
                           </div>
                        </div>
                     </fieldset>



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
   <script src="{{asset('assets/panel/js/custom/control-panel/post.js')}}"></script>

   <script>
      $(document).on('click', '.btn-remove', function (e) {
        $(this).closest(".fild").remove();
      });

      $(document).on('click', '.remove-option', function (e) {
        $(this).closest(".option").remove();
      });


      $(document).on('click', '.chnage_required', function () {
        var that = this;
        var required = $(that).parent().find('.requireds').val();
        if (required == 1) {
          console.log($(that).parent().find('.requireds').val())
          $(that).parent().find('.requireds').val(0);
        } else {
          $(that).parent().find('.requireds').val(1);
        }
      })


      $(document).on('click', '.add_filed', function () {
        var type = $(this).data('type');
        $.ajax({
          url: "{{route('panel.questionnaireForms.render.filds')}}",
          method: "get",
          data: { type: type, form_id:{{request('id')}}},
          success: function (e) {
            if (e.status) {
               var html = e.item;
               $('.fileds').append(html);

             


            }
          }
        });

      });

   </script>
@endpush
@stop