@extends('superAdmin.layouts.app')

@section('content')
<style type="text/css">
    #map {
        border-radius: 20px;
        height: calc(100vh - 440px);
    }
    .gm-style-iw > button { 
        display: none !important; 
    }
</style>
<link href="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet" type="text/css" />
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Map </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('subAdminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Map </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">            
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-0">
                            <!-- <div id="map"></div> -->
                            <div id="kt_contact_map" class="w-100 rounded mb-2 mb-lg-0 mt-2" style="height: 800px"></div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/custom/leaflet/leaflet.bundle.js') }}"></script>
    <script>
        var LocationsForMap = JSON.parse('<?php echo json_encode($address_lat_long) ?>');
        var KTContactApply = function () {
            var selectedlocation;

            var initMap = function(elementId) {
                if (!L) {
                    return;
                }

                var leaflet = L.map(elementId, {
                    center: [28.704, 77.25],
                    zoom: 30
                });

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors' }).addTo(leaflet);

                var geocodeService;
                if (typeof L.esri.Geocoding === 'undefined') {
                    geocodeService = L.esri.geocodeService();
                } else {
                    geocodeService = L.esri.Geocoding.geocodeService();
                }

                var markerLayer = L.layerGroup().addTo(leaflet);

                var leafletIcon = L.divIcon({
                    html: `<span class="svg-icon svg-icon-primary shadow svg-icon-3x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="24" width="24" height="0"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/></g></svg></span>`,
                    bgPos: [10, 10],
                    iconAnchor: [20, 37],
                    popupAnchor: [0, -37],
                    className: 'leaflet-marker'
                });

                for (i = 0; i < LocationsForMap.length; i++) {
                    var url = LocationsForMap[i][0];
                    L.marker([LocationsForMap[i][1], LocationsForMap[i][2]], { icon: leafletIcon }).addTo(markerLayer).bindPopup(LocationsForMap[i][3], { closeButton: false }).openPopup().on('click', function(e) {
                        window.location.href = url;
                    });
                }
            }

            return {
                init: function () {
                    initMap('kt_contact_map');
                }
            };
        }();

        KTUtil.onDOMContentLoaded(function () {
            KTContactApply.init();
        });
    </script>
@endsection