<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">
                {{@$title_toolbar}}
            </h1>
            <!--end::Title-->
            @if(count($toolbar_links) > 0)
                <!--begin::Separator-->
                <span class="h-20px border-gray-200 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    @foreach ($toolbar_links as $toolbar_link)
                        <!--begin::Item-->
                        <li class="breadcrumb-item {{$loop->last ? 'text-dark' : 'text-muted'}}">
                            @if($toolbar_link['link'] != '#')
                                <a href="{{$toolbar_link['link']}}" class="text-muted text-hover-primary">
                                    {{$toolbar_link['title']}}
                                </a>
                            @else
                                {{$toolbar_link['title']}}
                            @endif
                        </li>
                        <!--end::Item-->
                        @if(!$loop->last)
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-200 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                        @endif

                    @endforeach    

                </ul>
            @endif
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->