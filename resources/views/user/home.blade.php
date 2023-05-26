@extends('user.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Overview
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Overview </li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="me-0">
                    <button class="btn btn-sm fw-bold btn-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"> Add </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="javascript:void(0)" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_event"> Add Event </a>
                        </div>
                        <div class="menu-item px-3">
                        <a href="javascript:void(0)" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_income"> Add Income </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="d-flex flex-column flex-xl-row">
                <!-- Sidebar -->
                @include('user.sidebar')
                <div class="flex-lg-row-fluid ms-lg-15">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Events Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Goal Planner</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_personal_details">My Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_incomes">Incomes</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Events Performance</span>
                                    </h3>
                                    <input type="hidden" class="events_chart_data" value="{{ json_encode($eventsChart['data']['chartData'], true) }}">
                                </div>
                                <div class="card-body d-flex align-items-center p-0">
                                    <div id="kt_chart_events" class="mx-auto mb-4"></div>
                                    <div class="mx-auto">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet bullet-dot w-8px h-7px bg-primary me-2"></div>
                                            <div class="fs-8 fw-semibold text-muted"><b>Long Term - ${{ $eventsChart['data']['pv_of_year_long_term'] }}</b></div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet bullet-dot w-8px h-7px bg-success me-2"></div>
                                            <div class="fs-8 fw-semibold text-muted"><b>Mid Term - ${{ $eventsChart['data']['pv_of_year_mid_term'] }}</b></div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet bullet-dot w-8px h-7px bg-info me-2"></div>
                                            <div class="fs-8 fw-semibold text-muted"><b>Short Term - ${{ $eventsChart['data']['pv_of_year_short_term'] }}</b></div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="bullet bullet-dot w-8px h-7px bg-danger me-2"></div>
                                            <div class="fs-8 fw-semibold text-muted"> <b>Legacy - ${{ $eventsChart['data']['lagacy'] }}</b></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Please Select Your Risk Tolerance Level</span>
                                    </h3>
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <div class="row w-100">
                                        @php $risk_rate = $user->risk_rate; @endphp
                                        <div class="col-md-3 col-lg-3 col-xxl-3">
                                            @php $highLightDiv = ''; $checked = ''; @endphp
                                            @if($risk_rate == 'low')
                                                @php $highLightDiv = 'active'; $checked = 'checked'; @endphp
                                            @endif
                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 {{ $highLightDiv }}" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                    <input class="form-check-input risk_rate" type="radio" name="risk_rate" value="low" {{ $checked }}/>
                                                </span>
                                                <span class="ms-5">
                                                    <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Low</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xxl-3">
                                            @php $highLightDiv = ''; $checked = ''; @endphp
                                            @if($risk_rate == 'medium')
                                                @php $highLightDiv = 'active'; $checked = 'checked'; @endphp
                                            @endif
                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 {{ $highLightDiv }}" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                    <input class="form-check-input risk_rate" type="radio" name="risk_rate" value="medium" {{ $checked }}/>
                                                </span>
                                                <span class="ms-5">
                                                    <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Medium</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xxl-3">
                                            @php $highLightDiv = ''; $checked = ''; @endphp
                                            @if($risk_rate == 'high')
                                                @php $highLightDiv = 'active'; $checked = 'checked'; @endphp
                                            @endif
                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 {{ $highLightDiv }}" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                    <input class="form-check-input risk_rate" type="radio" name="risk_rate" value="high" {{ $checked }}/>
                                                </span>
                                                <span class="ms-5">
                                                    <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">High</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xxl-3">
                                            @php $highLightDiv = ''; $checked = ''; @endphp
                                            @if($risk_rate == 'extreme')
                                                @php $highLightDiv = 'active'; $checked = 'checked'; @endphp
                                            @endif
                                            <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex text-start p-6 {{ $highLightDiv }}" data-kt-button="true">
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                    <input class="form-check-input risk_rate" type="radio" name="risk_rate" value="extreme" {{ $checked }}/>
                                                </span>
                                                <span class="ms-5">
                                                    <span class="fs-4 fw-bold text-gray-800 mb-2 d-block">Extreme</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6 mb-10">
                                <i class="ki-duotone ki-percentage fs-2tx text-primary me-4"><i class="path1"></i><i class="path2"></i></i>
                                <!-- <i class="ki-duotone ki-devices-2 fs-2tx text-primary me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> -->
                                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                    <div class="mb-3 mb-md-0 fw-semibold">
                                        <h4 class="text-gray-900 fw-bold"> {!! $statement !!} </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Expense Indicator</span>
                                    </h3>
                                    <input type="hidden" class="expense_chart_data" value="{{ json_encode($eventsLineChart, true) }}">
                                </div>
                                <div class="card-body d-flex align-items-end p-0">
                                    <div id="kt_charts_events" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Life Style Indicator</span>
                                    </h3>
                                    <input type="hidden" class="line_chart_data" value="{{ json_encode($incomeChart, true) }}">
                                </div>
                                <div class="card-body d-flex align-items-end p-0">
                                    <div id="kt_charts_incomes" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                    <div class="card-title">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bold text-dark">Goal Planner</span>
                                        </h3>
                                    </div>
                                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                                            Export Report
                                        </button>
                                        <div id="kt_datatable_example_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-export="excel"> Export as Excel </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-export="csv"> Export as CSV </a>
                                            </div>
                                        </div>
                                        <div id="kt_datatable_example_buttons" class="d-none"></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="kt_datatable_example"> -->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable_example">
                                        <thead>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-80px">Age</th>
                                                @for($i = $myAge; $i <= 99; $i++)
                                                    <th class="min-w-80px">{{ $i }}</th>
                                                @endfor
                                                <th></th>
                                            </tr>
                                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-80px">Year</th>
                                                @for($i = $myAge; $i <= 99; $i++)
                                                    <th class="min-w-80px">{{ $startYear }}</th>
                                                    @php $startYear++ @endphp
                                                @endfor
                                                <th class="min-w-80px">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            @php $columnWiseSum = array(); @endphp
                                            @foreach($wealthData as $data)
                                                @if($data->event_name)
                                                    @php 
                                                        $wdata = (array)json_decode($data->devide_year);
                                                        $startYear2 = Carbon\Carbon::now()->year;
                                                    @endphp
                                                    <tr data-id="{{$data->id}}" id="ev-{{$data->id}}">                                                    
                                                        <td>
                                                            {{$data->eventName}}
                                                            @if($data->down_payment)
                                                                @if($data->down_payment < 900)
                                                                    <div class="badge badge-light fw-bold">({{number_format($data->down_payment, 1)}} Down)</div>
                                                                    @elseif($data->down_payment < 900000)
                                                                    <div class="badge badge-light fw-bold">({{number_format($data->down_payment/1000, 1)}}K Down)</div>
                                                                    @elseif($data->down_payment < 900000000)
                                                                    <div class="badge badge-light fw-bold">({{number_format($data->down_payment/1000000, 1)}}M Down)</div>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        @php $sum = 0; @endphp
                                                        @for($i = $myAge; $i <= 99; $i++)
                                                            @if($wdata)
                                                                @if (array_key_exists($startYear2,$wdata))
                                                                    <td data-year="{{$startYear2}}" data-price="{{number_format((float)$wdata[$startYear2], 2, '.', '')}}">{{number_format((float)$wdata[$startYear2], 2, '.', '')}}</td>
                                                                    @php
                                                                        $sum += number_format((float)$wdata[$startYear2], 2, '.', '');
                                                                        if (array_key_exists($i, $columnWiseSum)) {
                                                                            $columnWiseSum[$i] = $columnWiseSum[$i] + number_format((float)$wdata[$startYear2], 2, '.', ''); 
                                                                        } else {
                                                                            $columnWiseSum[$i] = number_format((float)$wdata[$startYear2], 2, '.', ''); 
                                                                        }
                                                                    @endphp
                                                                @else
                                                                    <td data-year="{{$startYear2}}"></td>
                                                                @endif
                                                            @else
                                                                <td data-year="{{$startYear2}}"></td>
                                                            @endif
                                                            @php $startYear2++; @endphp
                                                        @endfor
                                                        @if($data->down_payment || $data->interest)
                                                            <td><b>{{$sum}}</b></td>
                                                        @else
                                                            <td><b>{{$data->event_budget}}</b></td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                            <tr>                                            
                                                <td> Total </td>
                                                @for($i = $myAge; $i <= 99; $i++)
                                                    @if (array_key_exists($i, $columnWiseSum))
                                                        <td><b> {{ $columnWiseSum[$i] }} </b></td>
                                                    @else
                                                        <td><b>-</b></td>
                                                    @endif
                                                @endfor
                                                <td></td>
                                            </tr>
                                            @php $wdata = []; @endphp
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                        <div class="tab-pane fade" id="kt_user_view_personal_details" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Personal Details</h3>
                                    </div>
                                    <a class="btn btn-sm btn-primary align-self-center" href="{{ route('personalDetails', $user->id) }}">                                        
                                        Edit Details
                                    </a>
                                </div>
                                <div class="card-body p-9">
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $clientDetail['user']->name }}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Email Id</label>
                                        <div class="col-lg-8 fv-row">                                            
                                            <a href="mailto:{{ $clientDetail['user']->email }}" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $clientDetail['user']->email }}</a>
                                        </div>
                                    </div>
                                    @php
                                        $phone = ($clientDetail['personalDetails'][0]->phone != NULL) ? decrypt($clientDetail['personalDetails'][0]->phone) : 'N/A';
                                    @endphp
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted"> Mobile No. </label>
                                        <div class="col-lg-8 d-flex align-items-center">
                                            <a href="tel:{{ $phone }}" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $phone }}</a>
                                        </div>
                                    </div>
                                    @php
                                        $gender = ($clientDetail['personalDetails'][0]->gender != NULL) ? decrypt($clientDetail['personalDetails'][0]->gender) : 'N/A';
                                    @endphp
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Gender</label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $gender }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $dob = ($clientDetail['personalDetails'][0]->dob != NULL) ? decrypt($clientDetail['personalDetails'][0]->dob) : 'N/A';
                                    @endphp
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted"> Date of Birth </label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $dob }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $maritalStatus = ($clientDetail['personalDetails'][0]->marital_status != NULL) ? decrypt($clientDetail['personalDetails'][0]->marital_status) : 'N/A';
                                    @endphp
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Marital Status</label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $maritalStatus }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $address = ($clientDetail['personalDetails'][0]->address != NULL) ? decrypt($clientDetail['personalDetails'][0]->address) : NULL;
                                        $city = ($clientDetail['personalDetails'][0]->city != NULL) ? decrypt($clientDetail['personalDetails'][0]->city) : NULL;
                                        $province = ($clientDetail['personalDetails'][0]->province != NULL) ? decrypt($clientDetail['personalDetails'][0]->province) : NULL;
                                        $postalCode = ($clientDetail['personalDetails'][0]->postal_code != NULL) ? decrypt($clientDetail['personalDetails'][0]->postal_code) : NULL;
                                        $add = ($address == NULL && $city == NULL && $province == NULL && $postalCode == NULL) ? 'N/A' : $address . '<br />' . $city . '<br />' . $province . '<br />' . $postalCode;
                                    @endphp
                                    <div class="row mb-10">
                                        <label class="col-lg-4 fw-semibold text-muted">Address</label>
                                        <div class="col-lg-8">
                                            <span class="fw-semibold fs-6 text-gray-800">{{ $add }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $retired = ($clientDetail['personalDetails'][0]->retired != NULL) ? decrypt($clientDetail['personalDetails'][0]->retired) : 'N/A';
                                    @endphp
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Retired</label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $retired }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $joint_plan = ($clientDetail['personalDetails'][0]->joint_plan != NULL) ? decrypt($clientDetail['personalDetails'][0]->joint_plan) : 'N/A';
                                    @endphp
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">Joint Plan</label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $joint_plan }}</span>
                                        </div>
                                    </div>
                                    @php
                                        $child_tot = ($clientDetail['personalDetails'][0]->child_tot != NULL) ? decrypt($clientDetail['personalDetails'][0]->child_tot) : 'N/A';
                                    @endphp
                                    <div class="row mb-7">
                                        <label class="col-lg-4 fw-semibold text-muted">No. of Child</label>
                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-6 text-gray-800">{{ $child_tot }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Spouse / Partner Details</h3>
                                    </div>
                                    <a class="btn btn-sm btn-primary align-self-center" href="{{ route('personalDetails', $user->id) }}">                                        
                                        Edit Details
                                    </a>
                                </div>
                                <div class="card-body p-9">                                    
                                    @if(isset($clientDetail['personalDetails'][1]))
                                        @php
                                            $firstName = ($clientDetail['personalDetails'][1]->first_name != NULL) ? decrypt($clientDetail['personalDetails'][1]->first_name) : 'N/A';
                                            $lastName = ($clientDetail['personalDetails'][1]->last_name != NULL) ? decrypt($clientDetail['personalDetails'][1]->last_name) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">{{ $firstName }} {{ $lastName }}</span>
                                            </div>
                                        </div>
                                        @php
                                            $phone = ($clientDetail['personalDetails'][1]->phone != NULL) ? decrypt($clientDetail['personalDetails'][1]->phone) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Mobile No</label>
                                            <div class="col-lg-8">
                                                <a href="tel:{{ $phone }}" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $phone }}</a>
                                            </div>
                                        </div>
                                        @php
                                            $email = ($clientDetail['personalDetails'][1]->email != NULL) ? decrypt($clientDetail['personalDetails'][1]->email) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Email Id</label>
                                            <div class="col-lg-8">
                                                <a href="mailto:{{ $email }}" class="fw-semibold fs-6 text-gray-800 text-hover-primary">{{ $email }}</a>
                                            </div>
                                        </div>
                                        @php
                                            $dob = ($clientDetail['personalDetails'][1]->dob != NULL) ? decrypt($clientDetail['personalDetails'][1]->dob) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Date of Birth</label>
                                            <div class="col-lg-8 fv-row">
                                                <span class="fw-semibold text-gray-800 fs-6">{{ $dob }}</span>
                                            </div>
                                        </div>
                                        @php
                                            $gender = ($clientDetail['personalDetails'][1]->gender != NULL) ? decrypt($clientDetail['personalDetails'][1]->gender) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">                                            
                                            <label class="col-lg-4 fw-semibold text-muted"> Gender </label>
                                            <div class="col-lg-8 d-flex align-items-center">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">{{ $gender }}</span>
                                            </div>
                                        </div>
                                        @php
                                            $retired = ($clientDetail['personalDetails'][1]->retired != NULL) ? decrypt($clientDetail['personalDetails'][1]->retired) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Retired</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800 me-2">{{ $retired }}</span>
                                            </div>
                                        </div>
                                        @php
                                            $maritalStatus = ($clientDetail['personalDetails'][1]->marital_status != NULL) ? decrypt($clientDetail['personalDetails'][1]->marital_status) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted"> Marital Status </label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800"> {{ $maritalStatus }} </span>
                                            </div>
                                        </div>
                                        @php
                                            $address = ($clientDetail['personalDetails'][1]->address != NULL) ? decrypt($clientDetail['personalDetails'][1]->address) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Address</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">{{ $address }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <div class="d-flex flex-stack flex-grow-1 ">
                                                <div class=" fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">No data available!</h4>
                                                    <div class="fs-6 text-gray-700 ">Spouse / Partner details are not available, please <a class="fw-bold" href="billing.html">Add Spouse / Partner</a>.</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Advisor Details</h3>
                                    </div>
                                </div>
                                <div class="card-body p-9">
                                    @if($clientDetail['advisor'] != NULL)
                                        @php
                                            $firstName = ($clientDetail['advisor'] != NULL && $clientDetail['advisor']->first_name != NULL) ? $clientDetail['advisor']->first_name : 'N/A';
                                            $lastName = ($clientDetail['advisor'] != NULL && $clientDetail['advisor']->last_name != NULL) ? $clientDetail['advisor']->last_name : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Full Name</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">{{ $firstName . ' ' . $lastName }}</span>
                                            </div>
                                        </div>
                                        @php
                                            $email = ($clientDetail['advisor'] != NULL && $clientDetail['advisor']->email != NULL) ? $clientDetail['advisor']->email : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Email Id</label>
                                            <div class="col-lg-8 fv-row">
                                                <a href="mailto:{{ $email }}"><span class="fw-semibold text-gray-800 fs-6">{{ $email }}</span></a>
                                            </div>
                                        </div>
                                        @php
                                            $phone = ($clientDetail['advisor']->phone != NULL) ? decrypt($clientDetail['advisor']->phone) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted"> Mobile No. </label>
                                            <div class="col-lg-8 d-flex align-items-center">
                                                <a href="tel:{{ $phone }}"><span class="fw-semibold text-gray-800 fs-6">{{ $phone }}</span></a>
                                            </div>
                                        </div>
                                        @php
                                            $gender = ($clientDetail['advisor']->gender != NULL) ? decrypt($clientDetail['advisor']->gender) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted">Gender</label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">{{ $gender }}</span>
                                            </div>
                                        </div>
                                        @php
                                            $dob = ($clientDetail['advisor']->dob != NULL) ? decrypt($clientDetail['advisor']->dob) : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted"> Date of Birth </label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">{{ $dob }}</span>
                                            </div>
                                        </div>
                                        @php
                                            $dob = ($clientDetail['advisor']->dob != NULL) ? decrypt($clientDetail['advisor']->dob) : 'N/A';
                                            $age = ($dob != NULL) ? Carbon\Carbon::parse($dob)->diff(\Carbon\Carbon::now())->format('%y Years Old') : 'N/A';
                                        @endphp
                                        <div class="row mb-7">
                                            <label class="col-lg-4 fw-semibold text-muted"> Age </label>
                                            <div class="col-lg-8">
                                                <span class="fw-bold fs-6 text-gray-800">{{ $age }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <div class="d-flex flex-stack flex-grow-1">
                                                <div class=" fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">No data available!</h4>
                                                    <div class="fs-6 text-gray-700 ">Advisor details are not available.</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_user_view_incomes" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header cursor-pointer">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Income Details</h3>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-primary align-self-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_income">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                                <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                                <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Add income
                                    </button>
                                </div>
                                <div class="card-body p-9">
                                    <div id="kt_table_clients_incomes">
                                        @foreach($wealthIncomes as $wealthIncome)
                                            <div class="m-0">
                                                @if($wealthIncome->name != null)
                                                    <div class="d-flex flex-stack mb-5">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <h4 class="fw-bold m-0 mb-2 text-primary">{{ $wealthIncome->name }}</h4>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">CAD ${{ $wealthIncome->income_budget }}</div>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                @endif
                                                @if($wealthIncome->income_year != null)
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <div class="text-gray-800 fw-bold fs-6">Year</div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">{{ $wealthIncome->income_year }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($wealthIncome->interest != null)
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <div class="text-gray-800 fw-bold fs-6">Interest</div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">{{ $wealthIncome->interest }}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($wealthIncome->rate_return != null)
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <div class="text-gray-800 fw-bold fs-6">Return Rate</div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">{{ $wealthIncome->rate_return }}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>                                        
                                            <div class="separator separator-dashed my-6"></div>
                                        @endforeach
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

<!--begin::Modal - Add event-->
<input type="hidden" value="addClientsEvent" id="addEventUrl" name="addEventUrl">
<div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Add an Event</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-events-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_add_event_form" class="form" action="#">
                    <input type="hidden" class="user_id" name="user_id" value="{{ auth()->user()->id }}"/>
                    <input type="hidden" class="event_wealth_management_id" name="wealth_management_id"/>
                    <div class="fv-row mb-7" id="selectEvent">
                        <label class="required fs-6 fw-semibold form-label mb-2">Event Name</label>
                        <select name="event_name" aria-label="Select a Event Name" data-control="select2" data-placeholder="Select a event name..." class="select_event_name form-select form-select-solid form-select-lg fw-semibold" required>
                            <option>Select a Event Name</option>
                                @foreach($events as $event)
                                <option value="{{ $event->id }}">{{ $event->name }}</option>
                                @endforeach
                                <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7" id="addEvent">
                        <label class="required fs-6 fw-semibold form-label mb-2">Event Name</label>
                        <input type="text" class="form-control form-control-solid other_event_name" name="other_event_name" value="" placeholder="Enter the event name" required/>
                    </div>
                    <div class="fv-row mb-7" id="interest">
                        <label class="required fs-6 fw-semibold form-label mb-2">Interest</label>
                        <div class="input-group input-group-solid">
                            <input type="text" class="form-control form-control-solid interest" name="interest" value="" placeholder="Enter the interest" required/>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="fv-row mb-7" id="downPayment">
                        <label class="required fs-6 fw-semibold form-label mb-2">Down Payment</label>
                        <input type="text" class="form-control form-control-solid down_payment" name="down_payment" value="" placeholder="Enter the down payment" required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Event Amount (CAD $)</label>
                        <input type="text" class="form-control form-control-solid event_amount" name="event_amount" value="" placeholder="Enter the event amount in CAD $" required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Event Start Year</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Select Start Year."></i>
                        </label>
                        <input class="form-control form-control-solid event_start_year" placeholder="Pick Start Year" name="event_start_year" id="kt_modal_start_datepicker" required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Event End Year</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Select End Year."></i>
                        </label>
                        <input class="form-control form-control-solid event_end_year" placeholder="Pick End Year" name="event_end_year" id="kt_modal_end_datepicker" required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Total Wealth (CAD $)</label>
                        <input type="text" class="form-control form-control-solid total_wealth" name="total_wealth" value="{{ ($totalWealth != 0) ? $totalWealth : '' }}" placeholder="Enter the total wealth" {{ ($totalWealth == 0) ? '' : 'readonly' }} required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Age</label>
                        <input type="text" class="form-control form-control-solid age" name="age" value="{{ $userAge }}" placeholder="Enter the age" readonly required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Rate Return</label>
                        <div class="input-group input-group-solid">
                            <input type="text" class="form-control form-control-solid rate_return" name="rate_return" value="{{ ($rateReturn != 0) ? $rateReturn : '' }}" placeholder="Enter the rate return"{{ ($rateReturn == 0) ? '' : 'readonly' }} required/>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-events-modal-action="cancel"> Discard </button>
                        <button type="submit" class="btn btn-primary" data-kt-events-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add event-->

<!--begin::Modal - Add income-->
<input type="hidden" value="addClientsIncome" id="addIncomeUrl" name="addIncomeUrl">
<div class="modal fade" id="kt_modal_add_income" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Add an Income</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_add_income_form" class="form" action="#">
                    <input type="hidden" class="user_id" name="user_id" value="{{ $clientDetail['user']->id }}"/>
                    <input type="hidden" class="wealth_management_id" name="wealth_management_id"/>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Income Name</label>
                        <select name="income_name" aria-label="Select a Income Name" data-control="select2" data-placeholder="Select a income name..." class="income_name form-select form-select-solid form-select-lg fw-semibold" required>
                            <option>Select a Income Name</option>
                            @foreach($incomes as $income)
                                <option value="{{ $income->id }}">{{ $income->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Income Amount (CAD $)</label>
                        <input type="text" class="form-control form-control-solid income_amount" name="income_amount" value="" placeholder="Enter the income amount in CAD $" required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Income Year</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Select Year."></i>
                        </label>
                        <input class="form-control form-control-solid income_year" placeholder="Pick Year" name="income_year" id="kt_modal_add_income_datepicker" required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Total Wealth (CAD $)</label>
                        <input type="text" class="form-control form-control-solid total_wealth" name="total_wealth" value="{{ ($totalWealth != 0) ? $totalWealth : '' }}" placeholder="Enter the total wealth" {{ ($totalWealth == 0) ? '' : 'readonly' }} required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Age</label>
                        <input type="text" class="form-control form-control-solid age" name="age" value="{{ $userAge }}" placeholder="Enter the age" readonly required/>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Rate Return</label>
                        <div class="input-group input-group-solid">
                            <input type="text" class="form-control form-control-solid rate_return" name="rate_return" value="{{ ($rateReturn != 0) ? $rateReturn : '' }}" placeholder="Enter the rate return"{{ ($rateReturn == 0) ? '' : 'readonly' }} required/>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel"> Discard </button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add income-->

<!--begin::Modal - Add age-->
<div class="modal fade" id="kt_modal_add_age" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Add an age</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-age="close">
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_add_age_form" class="form" action="#">
                    <input type="hidden" class="client_user_id" name="client_user_id" value="{{ $clientDetail['user']->id }}"/>
                    <div class="fv-row mb-7">
                        <label class="required fs-6 fw-semibold form-label mb-2">Age</label>
                        <input type="number" class="form-control form-control-solid client_age" name="client_age" value="" placeholder="Enter the age" required/>
                    </div>
                    <div class="text-center pt-15">
                        <button type="button" class="btn btn-primary" data-kt-users-modal-age="submit" id="submitAge">
                            <span class="indicator-label"> Submit </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add age-->

<!--begin::Toast-->
<div id="kt_docs_toast_stack_container" class="toast-container position-fixed top-0 end-0 p-3 z-index-9">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-kt-docs-toast="stack">
        <div class="toast-header">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 5px;">
                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="#F1416C"></path>
                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="#F1416C"></path>
            </svg>
            <strong class="me-auto">Metawealth</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Please add your age first!
        </div>
    </div>
</div>
<!--end::Toast-->

@endsection
@section('script')
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-event.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-income.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-age.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/goal-planner.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/event-chart.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/expense-chart.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/income-chart.js') }}"></script>
    <script>
        $(".risk_rate").click(function(){
            Swal.fire({
                text: "Are you sure you want to change the risk rate?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, change!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    var radioValue = $("input[name='risk_rate']:checked").val();
                    if(radioValue){
                        $.ajax({
                            type:'POST',
                                url:'{{ url("/change-risk-rate") }}',
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    "risk_rate" : radioValue,
                                },
                            success:function(data) {
                                Swal.fire({
                                    text: "You have changed risk rate!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    location.reload();
                                });           
                            }
                        }) ;
                    }                    
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Risk rate was not changed.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
          
        var modal = new bootstrap.Modal(document.querySelector('#kt_modal_add_age'));
        var closeButton = document.querySelector('[data-kt-users-modal-age="close"]');
        var myAge = '{{$userAge}}';
        const targetElement = document.querySelector('[data-kt-docs-toast="stack"]');
        const container = document.getElementById('kt_docs_toast_stack_container');
        
        $(window).on('load', function() {
            if (myAge == 0) {
                modal.show();
            } else {
                modal.hide();
            }
        });

        closeButton.addEventListener('click', function (e) {
            if (myAge == 1) {
                modal.hide();
            } else {
                const newToast = targetElement.cloneNode(true);
                container.append(newToast);
                const toast = bootstrap.Toast.getOrCreateInstance(newToast);
                toast.show();
            }
        });

        $("#submitAge").attr('disabled', true);
        $('.client_age').keyup(function() {
            if($('.client_age').val() == 0 || $('.client_age').val() == '') {
                $("#submitAge").attr('disabled', true);

            } else {
                $("#submitAge").attr('disabled', false);                
            }
        });

        $("#submitAge").click(function() {
            var userId = $('.client_user_id').val();
            var clientAge = $('.client_age').val();
            const data = {user_id: userId, age: clientAge};
            console.log(data);
            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '{{ route("updateAge") }}',
                type : 'post',
                data : data,
                dataType : 'json',
                success : function(result){
                    if(result == 1) {
                        Swal.fire({
                            text: "Age has been updated successfully!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                modal.hide();
                                location.reload();
                            }
                        });
                    }     
                }
            });
        });
    </script>
@endsection