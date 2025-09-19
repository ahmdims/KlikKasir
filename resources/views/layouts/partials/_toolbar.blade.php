<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
        <!--begin::Toolbar wrapper-->
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">
                    @title
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                    @foreach (Breadcrumbs::generate() as $breadcrumb)
                        <!--begin::Item-->
                        <li class="breadcrumb-item {{ $loop->last ? 'text-dark' : 'text-muted' }}">
                            @if (!is_null($breadcrumb->url) && !$loop->last)
                                <a href="{{ $breadcrumb->url }}"
                                    class="text-muted text-hover-primary">{{ $breadcrumb->title }}</a>
                            @else
                                {{ $breadcrumb->title }}
                            @endif
                        </li>
                        <!--end::Item-->
                        @if (!$loop->last)
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                        @endif
                    @endforeach
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar wrapper-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->