@include('user.layouts.header')
<body id="kt_app_body" data-kt-app-layout="dark-header" data-kt-app-header-fixed="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
        @include('user.layouts.nav')
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    @yield('content')
                    <div id="kt_app_footer" class="app-footer ">
                        <div class="app-container  container-xxl d-flex flex-column flex-md-row flex-center flex-md-stack py-3 ">
                            <div class="text-dark order-2 order-md-1">
                                <span class="text-muted fw-semibold me-1">2022&copy;</span>
                                <a href="https://metawealthinc.com/" target="_blank" class="text-gray-800 text-hover-primary">Metawealth.</a>
                                <span class="text-muted fw-semibold me-1">All Right Reserved.</span>
                            </div>
                            <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                                <li class="menu-item"><a href="#" target="_blank" class="menu-link px-2">Privacy Policy</a></li>
                                <li class="menu-item"><a href="#" target="_blank" class="menu-link px-2">Terms and Condition</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('user.layouts.footer')