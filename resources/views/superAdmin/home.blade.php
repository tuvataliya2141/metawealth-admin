@extends('superAdmin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Dashboard
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('subAdminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Dashboards </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-fluid ">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-xl-2">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA;background-image:url('../assets/media/svg/shapes/wave-bg-purple.svg')">
                        <div class="card-header pt-5 mb-3">
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                <svg width="45" height="45" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="#ffffff"/>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="#ffffff"/>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end mb-3">
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ count($advisors) }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Advisors</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <div class="symbol-group symbol-hover flex-nowrap">
                                    @if(count($advisors) > 0)
                                        @php $total = count($advisors) - 6; @endphp
                                        @foreach($advisors as $key => $advisor)
                                            @if($key < 6)
                                                @if($key % 2 == 0)
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $advisor->name }}">
                                                        <span class="symbol-label bg-success text-inverse-success fw-bold">{{ substr($advisor->name,0,1) }}</span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $advisor->name }}">
                                                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ substr($advisor->name,0,1) }}</span>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if(count($advisors) > 6)
                                            <a href="{{ route('subAdminAllClients') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C;background-image:url('../assets/media/svg/shapes/wave-bg-red.svg')">
                        <div class="card-header pt-5 mb-3">
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                                <svg width="45" height="45" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="#ffffff"/>
                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="#ffffff"/>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end mb-3">
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ count($users) }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Clients</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <div class="symbol-group symbol-hover flex-nowrap">
                                    @if(count($users) > 0)
                                        @php $total = count($users) - 6; @endphp
                                        @foreach($users as $key => $user)
                                            @if($key < 6)
                                                @if($key % 2 == 0)
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $user->name }}">
                                                        <span class="symbol-label bg-success text-inverse-success fw-bold">{{ substr($user->name,0,1) }}</span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $user->name }}">
                                                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ substr($user->name,0,1) }}</span>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                        @if(count($users) > 6)
                                            <a href="{{ route('subAdminAllClients') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gx-5 gx-xl-10">
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Advisors - This Month</span>
                            </h3>
                        </div>
                        <div class="card-body pt-6">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_stats_widget_16_tab_1">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                                    <th class="p-0 pb-3 min-w-50px text-start"> ID </th>
                                                    <th class="p-0 pb-3 min-w-100px text-start"> NAME </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-13"> PHONE </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-7"> EMAIL </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end"> JOINING DATE </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($advisors as $key => $advisor)
                                                    @php
                                                        $monthyear = date("Y-m"); 
                                                        $start = date("Y-m",strtotime($advisor->created_at));
                                                        $finish = date("Y-m",strtotime($advisor->created_at));
                                                        $personalDetails = App\Models\PersonalDetails::where('user_id', $advisor->id)->first();
                                                    @endphp
                                                <tr>
                                                    <td class="text-start pe-13">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ $key + 1 }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-35px me-3">
                                                                <span class="symbol-label bg-success text-inverse-success fw-bold">{{ substr($advisor->name,0,1) }}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="{{ route('adminViewAdvisor', $advisor->id) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $advisor->name }}</a>
                                                                <span class="text-gray-400 fw-semibold d-block fs-7"></span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-13">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ decrypt($personalDetails->phone) }}</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ decrypt($personalDetails->email) }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ Carbon\Carbon::parse($personalDetails->created_at)->format('M d, Y'); }}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Users - This Month</span>
                            </h3>
                        </div>
                        <div class="card-body pt-6">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_stats_widget_16_tab_1">
                                    <div class="table-responsive">
                                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                                    <th class="p-0 pb-3 min-w-50px text-start"> ID </th>
                                                    <th class="p-0 pb-3 min-w-100px text-start"> NAME </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-13"> PHONE </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-7"> EMAIL </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end"> JOINING DATE </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $key => $user)
                                                    @php
                                                        $monthyear = date("Y-m"); 
                                                        $start = date("Y-m",strtotime($user->created_at));
                                                        $finish = date("Y-m",strtotime($user->created_at));
                                                        $personalDetails = App\Models\PersonalDetails::where('user_id', $user->id)->first();
                                                    @endphp
                                                <tr>
                                                    <td class="text-start pe-13">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ $key + 1 }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-35px me-3">
                                                                <span class="symbol-label bg-success text-inverse-success fw-bold">{{ substr($user->name,0,1) }}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="{{ route('subAdminViewClient', $user->id) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $user->name }}</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end pe-13">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ decrypt($personalDetails->phone) }}</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ decrypt($personalDetails->email) }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <span class="text-gray-600 fw-bold fs-6">{{ Carbon\Carbon::parse($personalDetails->created_at)->format('M d, Y'); }}</span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection