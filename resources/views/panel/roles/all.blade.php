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
                  <a href="{{route('panel.roles.create.index')}}" class="btn btn-sm btn-primary">
                     {{__('dashboard.create_new')}}
                  </a>
               </div>
               <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body">
               <!--begin: Datatable-->
               <table id="kt_datatable_example_2" class="table table-striped table-row-bordered gy-5 gs-7 w-100">
                  <thead>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
               <!--end: Datatable-->
            </div>
            <!--end::Card body-->
         </div>
         <!--end::Messenger-->
      </div>
      <!--end::Container-->
   </div>
   <!--end::Post-->
</div>
<!--end::Content-->
@push('panel_js')
   <script src="{{asset('assets/panel/plugins/custom/datatables/datatables.bundle.js')}}"></script>
   <script src="{{asset('assets/panel/js/custom/control-panel/datatable.js')}}"></script>
   <script>
      window.data_url = '{{route('panel.roles.all.data')}}';
      window.columns = [
        {
          data: 'DT_RowIndex', name: 'DT_RowIndex'
        },
        {
          data: 'name',
          title: '{{__('dashboard.name')}}',
        },
        {
          data: 'action',
          title: '{{__('dashboard.action')}}',
          orderable: false
        }
      ];

   </script>
@endpush
@stop