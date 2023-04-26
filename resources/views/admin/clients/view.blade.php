@extends('admin.layouts.app')

@section('content')
<style>
    .profile-char {
        font-size: 25px;
    }
</style>
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Clients Details </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminAllClients') }}" class="text-muted text-hover-primary"> All Clients </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> View Client </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="d-flex flex-column flex-xl-row">
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body pt-15">
                            <div class="d-flex flex-center flex-column mb-5">
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <span class="symbol-label bg-danger text-inverse-danger fw-bold profile-char">{{ substr($clientDetail['user']->name,0,1) }}</span>
                                </div>
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1"> {{ $clientDetail['user']->name }} </a>
                            </div>
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_customer_view_details" role="button" aria-expanded="false" aria-controls="kt_customer_view_details"> Details
                                    <span class="ms-2 rotate-180">
                                        <span class="svg-icon svg-icon-3">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </span>
                                </div>
                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit client details">
                                    <a href="{{ route('adminUpdateClient', $clientDetail['user']->id) }}" class="btn btn-sm btn-light-primary"> Edit </a>
                                </span>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    @if($clientDetail['user']->status == 1)
                                    <div class="badge badge-light-success d-inline">Active</div>
                                    @else
                                    <div class="badge badge-light-danger d-inline">Inactive</div>
                                    @endif
                                    <div class="fw-bold mt-5">Email Id</div>
                                    <div class="text-gray-600">
                                        <a href="mailto:{{ $clientDetail['user']->email }}" class="text-gray-600 text-hover-primary">{{ $clientDetail['user']->email }}</a>
                                    </div>
                                    @php
                                        $phone = ($clientDetail['personalDetails'][0]->phone != NULL) ? decrypt($clientDetail['personalDetails'][0]->phone) : NULL;
                                    @endphp
                                    <div class="fw-bold mt-5">Mobile No</div>
                                    <div class="text-gray-600">
                                        <a href="tel:{{ $phone }}" class="text-gray-600 text-hover-primary">{{ $phone }}</a>
                                    </div>
                                    @if($clientDetail['personalDetails'][0]->gender != NULL)
                                        @php
                                            $gender = ($clientDetail['personalDetails'][0]->gender != NULL) ? decrypt($clientDetail['personalDetails'][0]->gender) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Gender</div>
                                        <div class="text-gray-600">{{ ($gender!= NULL) ? $gender : '' }}</div>
                                    @endif
                                    @if($clientDetail['personalDetails'][0]->marital_status != NULL)
                                        @php
                                            $maritlStatus = ($clientDetail['personalDetails'][0]->marital_status != NULL) ? decrypt($clientDetail['personalDetails'][0]->marital_status) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Marital Status</div>
                                        <div class="text-gray-600">{{ ($maritlStatus!= NULL) ? $maritlStatus : '' }}</div>
                                    @endif
                                    @if($clientDetail['personalDetails'][0]->address != NULL || $clientDetail['personalDetails'][0]->city != NULL || $clientDetail['personalDetails'][0]->province != NULL || $clientDetail['personalDetails'][0]->postal_code != NULL)
                                        @php
                                            $address = ($clientDetail['personalDetails'][0]->address != NULL) ? decrypt($clientDetail['personalDetails'][0]->address) : NULL;
                                            $city = ($clientDetail['personalDetails'][0]->city != NULL) ? decrypt($clientDetail['personalDetails'][0]->city) : NULL;
                                            $province = ($clientDetail['personalDetails'][0]->province != NULL) ? decrypt($clientDetail['personalDetails'][0]->province) : NULL;
                                            $postalCode = ($clientDetail['personalDetails'][0]->postal_code != NULL) ? decrypt($clientDetail['personalDetails'][0]->postal_code) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Address</div>
                                        <div class="text-gray-600">{{ ($address != NULL) ? $address : '' }}<br />{{ ($city != NULL) ? $city : '' }}<br />{{ ($province != NULL) ? $province : '' }}<br />{{ ($postalCode != NULL) ? $postalCode : '' }}</div>
                                    @endif
                                    @if($clientDetail['personalDetails'][0]->dob != NULL)
                                        @php
                                            $dob = ($clientDetail['personalDetails'][0]->dob != NULL) ? decrypt($clientDetail['personalDetails'][0]->dob) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Date of Birth</div>
                                        <div class="text-gray-600">{{ ($dob!= NULL) ? $dob : '' }}</div>
                                    @endif
                                    @if($clientDetail['personalDetails'][0]->retired != NULL)
                                        @php
                                            $retired = ($clientDetail['personalDetails'][0]->retired != NULL) ? decrypt($clientDetail['personalDetails'][0]->retired) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Retired</div>
                                        <div class="text-gray-600">{{ ($retired!= NULL) ? $retired : '' }}</div>
                                    @endif
                                    @if($clientDetail['personalDetails'][0]->joint_plan != NULL)
                                        @php
                                            $joint_plan = ($clientDetail['personalDetails'][0]->joint_plan != NULL) ? decrypt($clientDetail['personalDetails'][0]->joint_plan) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Joint Plan</div>
                                        <div class="text-gray-600">{{ ($joint_plan!= NULL) ? $joint_plan : '' }}</div>
                                    @endif
                                    @if($clientDetail['personalDetails'][0]->child_tot != NULL)
                                        @php
                                            $child_tot = ($clientDetail['personalDetails'][0]->child_tot != NULL) ? decrypt($clientDetail['personalDetails'][0]->child_tot) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Joint Plan</div>
                                        <div class="text-gray-600">{{ ($child_tot!= NULL) ? $child_tot : '' }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($clientDetail['personalDetails'][1]))
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h3 class="fw-bold m-0">Spouse / Partner Details</h3>
                            </div>
                        </div>
                        <div class="card-body pt-2">                            
                            @if($clientDetail['personalDetails'][0]->joint_plan != NULL)
                                @php
                                    $joint_plan = ($clientDetail['personalDetails'][0]->joint_plan != NULL) ? decrypt($clientDetail['personalDetails'][0]->joint_plan) : NULL;
                                @endphp
                                <div class="fw-bold mt-5">Joint Plan</div>
                                <div class="text-gray-600">{{ ($joint_plan!= NULL) ? $joint_plan : '' }}</div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
                <div class="flex-lg-row-fluid ms-lg-15">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_client_view_events_tab">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_client_view_income_tab">Income</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_client_view_advisor">Advisor</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_client_view_events_tab" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Events</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_event">
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            Add event
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <table class="table align-middle table-row-dashed gy-5" id="kt_table_clients_events">
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                            <tr class="text-start text-muted text-uppercase gs-0">
                                                <th class="min-w-100px">Id</th>
                                                <th>Name</th>
                                                <th>Budget</th>
                                                <th class="min-w-100px">Year</th>
                                                <th class="text-end min-w-100px pe-4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            @foreach($wealthEvents as $key => $wealthEvent)
                                            <tr>
                                                <td><a href="#" class="text-gray-600 text-hover-primary mb-1"> {{ $key + 1 }} </a></td>
                                                <td data-kt-wealthEvent-filter="product_name"> {{ $wealthEvent->eventName }} </td>
                                                <td> ${{ $wealthEvent->event_budget }} </td>
                                                <td> {{ $wealthEvent->event_start_year }} - {{ $wealthEvent->event_end_year }} </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"> Actions
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0);" data-id="{{ $wealthEvent->id }}" class="menu-link px-3" data-kt-wealthEvent-filter="edit_row"> Edit </a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0);" data-id="{{ $wealthEvent->id }}" class="menu-link px-3" data-kt-wealthEvent-filter="delete_row"> Delete </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Events Performance</span>
                                        <!-- <span class="text-gray-400 mt-1 fw-semibold fs-6">1,046 Inbound Calls today</span> -->
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
                                <div class="card-header pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bold text-dark">Expense Indicator</span>
                                    </h3>
                                    <input type="hidden" class="expense_chart_data" value="{{ json_encode($eventsLineChart, true) }}">
                                </div>
                                <div class="card-body d-flex align-items-end p-0">
                                    <div id="kt_charts_events" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_client_view_income_tab" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Income</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_income">
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
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <table class="table align-middle table-row-dashed gy-5" id="kt_table_clients_incomes">
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                            <tr class="text-start text-muted text-uppercase gs-0">
                                                <th class="min-w-100px">Id</th>
                                                <th>Name</th>
                                                <th>Budget</th>
                                                <th class="min-w-100px">Year</th>
                                                <th class="text-end min-w-100px pe-4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            @foreach($wealthIncomes as $key => $wealthIncome)
                                            <tr>
                                                <td><a href="#" class="text-gray-600 text-hover-primary mb-1">{{ $key + 1 }}</a></td>
                                                <td data-kt-wealthIncome-filter="product_name">{{ $wealthIncome->name }}</td>
                                                <td> ${{ $wealthIncome->income_budget }} </td>
                                                <td> {{ $wealthIncome->income_year }} </td>
                                                <td class="pe-0 text-end">
                                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"> Actions
                                                        <span class="svg-icon svg-icon-5 m-0">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </a>
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0);" data-id="{{ $wealthIncome->id }}" class="menu-link px-3" data-kt-wealthIncome-filter="edit_row"> Edit </a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0);" data-id="{{ $wealthIncome->id }}" class="menu-link px-3" data-kt-wealthIncome-filter="delete_row"> Delete </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header pt-5">
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
                        <div class="tab-pane fade" id="kt_client_view_advisor" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Advisor Details</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_assign_advisor">
                                            <span class="svg-icon svg-icon-3">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="5" fill="currentColor" />
                                                    <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="currentColor" />
                                                    <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            {{ ($clientDetail['advisor'] == NULL) ? 'Assign Advisor' : 'Change Advisor' }}
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    @if($clientDetail['advisor'] != NULL && $clientDetail['advisor']->first_name != NULL)
                                    <div class="fw-bold mt-5">First Name</div>
                                    <div class="text-gray-600">
                                        <div class="text-gray-600">{{ decrypt($clientDetail['advisor']->first_name) }}</div>
                                    </div>
                                    @endif
                                    @if($clientDetail['advisor'] != NULL && $clientDetail['advisor']->last_name != NULL)
                                    <div class="fw-bold mt-5">Last Name</div>
                                    <div class="text-gray-600">
                                        <div class="text-gray-600">{{ decrypt($clientDetail['advisor']->last_name) }}</div>
                                    </div>
                                    @endif
                                    @if($clientDetail['advisor'] != NULL && $clientDetail['advisor']->email != NULL)
                                    <div class="fw-bold mt-5">Email Id</div>
                                    <div class="text-gray-600">
                                        <a href="mailto:{{ decrypt($clientDetail['advisor']->email) }}" class="text-gray-600 text-hover-primary">{{ decrypt($clientDetail['advisor']->email) }}</a>
                                    </div>
                                    @endif
                                    @if($clientDetail['advisor'] != NULL && $clientDetail['advisor']->phone != NULL)
                                    @php
                                        $phone = ($clientDetail['advisor']->phone != NULL) ? decrypt($clientDetail['advisor']->phone) : NULL;
                                    @endphp
                                    <div class="fw-bold mt-5">Mobile No</div>
                                    <div class="text-gray-600">
                                        <a href="tel:{{ $phone }}" class="text-gray-600 text-hover-primary">{{ $phone }}</a>
                                    </div>
                                    @endif
                                    @if($clientDetail['advisor'] != NULL && $clientDetail['advisor']->gender != NULL)
                                        @php
                                            $gender = ($clientDetail['advisor']->gender != NULL) ? decrypt($clientDetail['advisor']->gender) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Gender</div>
                                        <div class="text-gray-600">{{ ($gender!= NULL) ? $gender : '' }}</div>
                                    @endif
                                    @if($clientDetail['advisor'] != NULL && $clientDetail['advisor']->dob != NULL)
                                        @php
                                            $dob = ($clientDetail['advisor']->dob != NULL) ? decrypt($clientDetail['advisor']->dob) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Date of Birth</div>
                                        <div class="text-gray-600">{{ ($dob!= NULL) ? $dob : '' }}</div>
                                    @endif
                                    @if($clientDetail['advisor'] != NULL && $clientDetail['advisor']->dob != NULL)
                                        @php
                                            $dob = ($clientDetail['advisor']->dob != NULL) ? decrypt($clientDetail['advisor']->dob) : NULL;
                                            $age = ($dob != NULL) ? Carbon\Carbon::parse($dob)->diff(\Carbon\Carbon::now())->format('%y Years Old') : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Date of Birth</div>
                                        <div class="text-gray-600">{{ $age }}</div>
                                    @endif
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

<div class="modal fade" id="kt_modal_assign_advisor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form" action="#" id="kt_modal_assign_advisor_form">
                <div class="modal-header" id="kt_modal_assign_advisor_header">
                    <h2 class="fw-bold">Assign Advisor to User</h2>
                    <div id="kt_modal_assign_advisor_cancel" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_assign_advisor_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_assign_advisor_header" data-kt-scroll-wrappers="#kt_modal_assign_advisor_scroll" data-kt-scroll-offset="300px">
                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="fs-6 fw-semibold mb-2">
                                <span class="required">Advisor</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select an Advisor"></i>
                            </label>
                            <input type="hidden" value="{{ $clientDetail['user']->id }}" id="client_id" data-name="{{ $clientDetail['user']->name }}">
                            <input type="hidden" value="" id="advisor_name">
                            @php
                                $assignedAdvisor = ($clientDetail['advisor'] != null) ? $clientDetail['advisor']->id : 0
                            @endphp
                            <select id="selectAdvisor" name="advisor" aria-label="Select an Advisor" data-control="select2" data-placeholder="Select an Advisor..." data-dropdown-parent="#kt_modal_assign_advisor" class="form-select form-select-solid fw-bold">
                                <option value="">Select an Advisor...</option>
                                @foreach($allAdvisors as $advisor)
                                    <option value="{{ $advisor->user_id }}" data-name="{{ $advisor->name }}" {{ ($advisor->user_id == $assignedAdvisor) ? 'selected' : '' }}>{{ $advisor->name . ' (' . decrypt($advisor->email) . ')'  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" ID="kt_modal_assign_advisor_close" class="btn btn-light me-3"> Discard </button>
                    <button type="submit" id="kt_modal_assign_advisor_submit" class="btn btn-primary">
                        <span class="indicator-label"> Submit </span>
                        <span class="indicator-progress"> Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end::Modal - Add event-->

<!--begin::Modal - Add event-->
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
                    <input type="hidden" class="user_id" name="user_id" value="{{ $clientDetail['user']->id }}"/>
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

@endsection
@section('script')
    <script src="{{ asset('assets/js/custom/apps/customers/view/events-table.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-event.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/event-chart.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/expense-chart.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-income.js') }}"></script>    
    <script src="{{ asset('assets/js/custom/apps/customers/view/income-chart.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/assignAdvisor.js') }}"></script>
@endsection