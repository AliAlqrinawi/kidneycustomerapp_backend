@php
    $default_lang = app()->getLocale();
@endphp
<div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start" data-kt-menu-flip="bottom">
    <a href="#" class="menu-link px-5">
        <span class="menu-title position-relative">
            {{__('dashboard.language')}}
            <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 
      end-0">
                {{locales()[$default_lang]}}
                <img class="w-15px h-15px rounded-1 ms-2" src="/assets/panel/media/flags/{{@$default_lang}}.svg"
                    alt="{{@$default_lang}}" /></span></span>
    </a>
    <!--begin::Menu sub-->
    <div class="menu-sub menu-sub-dropdown w-175px py-4">
        @foreach (locales() as $key => $lang)
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{route('panel.home.changeLang',['lang'=>$key])}}" class="menu-link d-flex px-5 {{@$default_lang == $key ? 'active' : ''}} ">
                    <span class="symbol symbol-20px me-4">
                        <img class="rounded-1" src="/assets/panel/media/flags/{{@$key}}.svg" alt="{{@$key}}" />
                    </span>
                    {{@$lang}}
                </a>
            </div>
            <!--end::Menu item-->
        @endforeach
    </div>
    <!--end::Menu sub-->
</div>