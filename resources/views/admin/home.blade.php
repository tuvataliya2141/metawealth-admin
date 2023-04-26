@extends('admin.layouts.app')

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
                        <a href="{{ route('adminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
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
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100"
                        style="background-color: #F1416C;background-image:url('../assets/media/svg/shapes/wave-bg-red.svg')">
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
                                <span class="fs-4hx text-white fw-bold me-6">{{ count($subAdmins) }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Sub Admins</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer"
                            style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <div class="symbol-group symbol-hover flex-nowrap">
                                    @if(count($subAdmins) > 0)
                                        @php $total = count($subAdmins) - 6; @endphp
                                        @foreach($subAdmins as $key => $subAdmin)
                                            @if($key < 6)
                                                @if($key % 2 == 0)
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $subAdmin->name }}">
                                                        <span class="symbol-label bg-success text-inverse-success fw-bold">{{ ucfirst(substr($subAdmin->name,0,1)) }}</span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $subAdmin->name }}">
                                                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ ucfirst(substr($subAdmin->name,0,1)) }}</span>
                                                    </div>
                                                @endif
                                            @else
                                            <a href="{{ route('adminAllClients') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                    <a href="{{ route('adminViewAdvisor', $advisor->id) }}">
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $advisor->name }}">
                                                            <span class="symbol-label bg-success text-inverse-success fw-bold">{{ ucfirst(substr($advisor->name,0,1)) }}</span>
                                                        </div>
                                                    </a>
                                                @else
                                                    <a href="{{ route('adminViewAdvisor', $advisor->id) }}">
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $advisor->name }}">
                                                            <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ ucfirst(substr($advisor->name,0,1)) }}</span>
                                                        </div>
                                                    </a>
                                                @endif
                                            @else
                                            <a href="{{ route('adminAllClients') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                            @endif
                                        @endforeach
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
                                                    <a href="{{ route('adminViewClient', $user->id) }}">
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $user->name }}">
                                                            <span class="symbol-label bg-success text-inverse-success fw-bold">{{ ucfirst(substr($user->name,0,1)) }}</span>
                                                        </div>
                                                    </a>
                                                @else
                                                    <a href="{{ route('adminViewClient', $user->id) }}">
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $user->name }}">
                                                            <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ ucfirst(substr($user->name,0,1)) }}</span>
                                                        </div>
                                                    </a>
                                                @endif
                                            @else
                                            <a href="{{ route('adminAllClients') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA;background-image:url('../assets/media/svg/shapes/wave-bg-purple.svg')">
                        <div class="card-header pt-5 mb-3">
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                <svg width="45" height="45" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z" fill="#ffffff"></path>
                                    <path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end mb-3">
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ count($events) }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Events</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <div class="symbol-group symbol-hover flex-nowrap">
                                    @if(count($events) > 0)
                                        @php $total = count($events) - 6; @endphp
                                        @foreach($events as $key => $event)
                                            @if($key < 6)
                                                @if($key % 2 == 0)
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $event->name }}">
                                                        <span class="symbol-label bg-success text-inverse-success fw-bold">{{ ucfirst(substr($event->name,0,1)) }}</span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $event->name }}">
                                                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ ucfirst(substr($event->name,0,1)) }}</span>
                                                    </div>
                                                @endif
                                            @else
                                            <a href="{{ route('adminAllEvents') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA;background-image:url('../assets/media/svg/shapes/wave-bg-purple.svg')">
                        <div class="card-header pt-5 mb-3">
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                <svg width="45" height="45" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M20.859 12.596L17.736 13.596L10.388 20.944C10.2915 21.0406 10.1769 21.1172 10.0508 21.1695C9.9247 21.2218 9.78953 21.2486 9.65302 21.2486C9.5165 21.2486 9.3813 21.2218 9.25519 21.1695C9.12907 21.1172 9.01449 21.0406 8.918 20.944L2.29999 14.3229C2.10543 14.1278 1.99619 13.8635 1.99619 13.588C1.99619 13.3124 2.10543 13.0481 2.29999 12.853L11.853 3.29999C11.9495 3.20341 12.0641 3.12679 12.1902 3.07452C12.3163 3.02225 12.4515 2.9953 12.588 2.9953C12.7245 2.9953 12.8597 3.02225 12.9858 3.07452C13.1119 3.12679 13.2265 3.20341 13.323 3.29999L21.199 11.176C21.3036 11.2791 21.3797 11.4075 21.4201 11.5486C21.4605 11.6898 21.4637 11.8391 21.4295 11.9819C21.3953 12.1247 21.3249 12.2562 21.2249 12.3638C21.125 12.4714 20.9989 12.5514 20.859 12.596Z" fill="#ffffff"></path>
                                    <path d="M14.8 10.184C14.7447 10.1843 14.6895 10.1796 14.635 10.1699L5.816 8.69997C5.55436 8.65634 5.32077 8.51055 5.16661 8.29469C5.01246 8.07884 4.95035 7.8106 4.99397 7.54897C5.0376 7.28733 5.18339 7.05371 5.39925 6.89955C5.6151 6.7454 5.88334 6.68332 6.14498 6.72694L14.963 8.19692C15.2112 8.23733 15.435 8.36982 15.59 8.56789C15.7449 8.76596 15.8195 9.01502 15.7989 9.26564C15.7784 9.51626 15.6642 9.75001 15.479 9.92018C15.2939 10.0904 15.0514 10.1846 14.8 10.184ZM17 18.6229C17 19.0281 17.0985 19.4272 17.287 19.7859C17.4755 20.1446 17.7484 20.4521 18.0821 20.6819C18.4158 20.9117 18.8004 21.0571 19.2027 21.1052C19.605 21.1534 20.0131 21.103 20.3916 20.9585C20.7702 20.814 21.1079 20.5797 21.3758 20.2757C21.6437 19.9716 21.8336 19.607 21.9293 19.2133C22.025 18.8195 22.0235 18.4085 21.925 18.0154C21.8266 17.6223 21.634 17.259 21.364 16.9569L19.843 15.257C19.7999 15.2085 19.7471 15.1697 19.688 15.1432C19.6289 15.1167 19.5648 15.1029 19.5 15.1029C19.4352 15.1029 19.3711 15.1167 19.312 15.1432C19.2529 15.1697 19.2001 15.2085 19.157 15.257L17.636 16.9569C17.2254 17.4146 16.9988 18.0081 17 18.6229ZM10.388 20.9409L17.736 13.5929H1.99999C1.99921 13.7291 2.02532 13.8643 2.0768 13.9904C2.12828 14.1165 2.2041 14.2311 2.29997 14.3279L8.91399 20.9409C9.01055 21.0381 9.12539 21.1152 9.25188 21.1679C9.37836 21.2205 9.51399 21.2476 9.65099 21.2476C9.78798 21.2476 9.92361 21.2205 10.0501 21.1679C10.1766 21.1152 10.2914 21.0381 10.388 20.9409Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end mb-3">
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ count($incomes) }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Incomes</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <div class="symbol-group symbol-hover flex-nowrap">
                                    @if(count($incomes) > 0)
                                        @php $total = count($incomes) - 6; @endphp
                                        @foreach($incomes as $key => $income)
                                            @if($key < 6)
                                                @if($key % 2 == 0)
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $income->name }}">
                                                        <span class="symbol-label bg-success text-inverse-success fw-bold">{{ ucfirst(substr($income->name,0,1)) }}</span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $income->name }}">
                                                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ ucfirst(substr($income->name,0,1)) }}</span>
                                                    </div>
                                                @endif
                                            @else
                                            <a href="{{ route('adminAllIncomes') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2">
                    <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA;background-image:url('../assets/media/svg/shapes/wave-bg-purple.svg')">
                        <div class="card-header pt-5 mb-3">
                            <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                <svg width="45" height="45" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.3" d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z" fill="#ffffff"></path>
                                    <path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z" fill="#ffffff"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="card-body d-flex align-items-end mb-3">
                            <div class="d-flex align-items-center">
                                <span class="fs-4hx text-white fw-bold me-6">{{ count($otherEvents) }}</span>
                                <div class="fw-bold fs-6 text-white">
                                    <span class="d-block">Other Events</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                            <div class="fw-bold text-white py-2">
                                <div class="symbol-group symbol-hover flex-nowrap">
                                    @if(count($otherEvents) > 0)
                                        @php $total = count($otherEvents) - 6; @endphp
                                        @foreach($otherEvents as $key => $otherEvent)
                                            @if($key < 6)
                                                @if($key % 2 == 0)
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $otherEvent->name }}">
                                                        <span class="symbol-label bg-success text-inverse-success fw-bold">{{ ucfirst(substr($otherEvent->name,0,1)) }}</span>
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{ $otherEvent->name }}">
                                                        <span class="symbol-label bg-warning text-inverse-warning fw-bold">{{ ucfirst(substr($otherEvent->name,0,1)) }}</span>
                                                    </div>
                                                @endif
                                            @else
                                            <a href="{{ route('adminAllIncomes') }}" class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+{{ $total }}</span>
                                            </a>
                                            @endif
                                        @endforeach
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
                                                    <th class="p-0 pb-3 min-w-100px text-start"> NAME </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-13"> PHONE </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-7"> EMAIL </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end"> JOINING DATE </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($advisors as $advisor)
                                                    @php
                                                        $monthyear = date("Y-m"); 
                                                        $start = date("Y-m",strtotime($advisor->created_at));
                                                        $finish = date("Y-m",strtotime($advisor->created_at));
                                                        $personalDetails = App\Models\PersonalDetails::where('user_id', $advisor->id)->first();
                                                    @endphp
                                                <tr>
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
                                                    <th class="p-0 pb-3 min-w-100px text-start"> NAME </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-13"> PHONE </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end pe-7"> EMAIL </th>
                                                    <th class="p-0 pb-3 min-w-100px text-end"> JOINING DATE </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    @php
                                                        $monthyear = date("Y-m"); 
                                                        $start = date("Y-m",strtotime($user->created_at));
                                                        $finish = date("Y-m",strtotime($user->created_at));
                                                        $personalDetails = App\Models\PersonalDetails::where('user_id', $user->id)->first();
                                                    @endphp
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-35px me-3">
                                                                <span class="symbol-label bg-success text-inverse-success fw-bold">{{ substr($user->name,0,1) }}</span>
                                                            </div>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="{{ route('adminViewClient', $user->id) }}" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">{{ $user->name }}</a>
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