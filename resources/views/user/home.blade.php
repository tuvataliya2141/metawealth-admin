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
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="d-flex flex-column flex-xl-row">
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body pt-15">
                            <div class="d-flex flex-center flex-column mb-5">
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"></path>
                                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"></rect>
                                    </svg>
                                </div>
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1"> {{ auth()->user()->name }} </a>
                                <div class="fs-5 fw-semibold text-muted mb-6"> {{ auth()->user()->email }} </div>
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
                                    <a href="{{ route('adminUpdateClient', auth()->user()->id) }}" class="btn btn-sm btn-light-primary"> Add </a>
                                </span>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    <div class="text-gray-400 fw-bold mt-5">Net Worth</div>
                                    <h1 class="mt-2 display-5"> $0 </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">My Details</span>
                            </h3>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-9">
                                <li class="nav-item col-4 mx-0 p-0">
                                    <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_10_tab_1">
                                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                                            Personal
                                        </span>
                                        <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                    </a>
                                </li>
                                <li class="nav-item col-4 mx-0 px-0">
                                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_10_tab_2">
                                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                                            Events
                                        </span>
                                        <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                    </a>
                                </li>
                                <li class="nav-item col-4 mx-0 px-0">
                                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill" href="#kt_list_widget_10_tab_3">
                                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">
                                            Incomes
                                        </span>
                                        <span class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                                    </a>
                                </li>
                                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="kt_list_widget_10_tab_1">
                                    <div class="d-flex justify-content-end">
                                        <span class="text-end" data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit client details">
                                            <a href="{{ route('adminUpdateClient', $clientDetail['user']->id) }}" class="btn btn-sm btn-light-primary"> Edit </a>
                                        </span>
                                    </div>
                                    <div class="m-0">
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
                                    @if(isset($clientDetail['personalDetails'][1]))
                                        <div class="separator separator-dashed my-6"></div>
                                        <div class="m-0">
                                            <h5 class="fw-bold m-0">Spouse / Partner Details</h5>
                                            @php
                                                $firstName = ($clientDetail['personalDetails'][1]->first_name != NULL) ? decrypt($clientDetail['personalDetails'][1]->first_name) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">First Name</div>
                                            <div class="text-gray-600">{{ $firstName }}</div>
                                            @php
                                                $lastName = ($clientDetail['personalDetails'][1]->last_name != NULL) ? decrypt($clientDetail['personalDetails'][1]->last_name) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Last Name</div>
                                            <div class="text-gray-600">{{ $lastName }}</div>
                                            @php
                                                $dob = ($clientDetail['personalDetails'][1]->dob != NULL) ? decrypt($clientDetail['personalDetails'][1]->dob) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Date of birth</div>
                                            <div class="text-gray-600">{{ $dob }}</div>
                                            @php
                                                $gender = ($clientDetail['personalDetails'][1]->gender != NULL) ? decrypt($clientDetail['personalDetails'][1]->gender) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Gender</div>
                                            <div class="text-gray-600">{{ $gender }}</div>
                                            @php
                                                $retired = ($clientDetail['personalDetails'][1]->retired != NULL) ? decrypt($clientDetail['personalDetails'][1]->retired) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Retired</div>
                                            <div class="text-gray-600">{{ $retired }}</div>
                                            @php
                                                $maritalStatus = ($clientDetail['personalDetails'][1]->marital_status != NULL) ? decrypt($clientDetail['personalDetails'][1]->marital_status) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Marital Status</div>
                                            <div class="text-gray-600">{{ $maritalStatus }}</div>
                                            @php
                                                $phone = ($clientDetail['personalDetails'][1]->phone != NULL) ? decrypt($clientDetail['personalDetails'][1]->phone) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Phone</div>
                                            <div class="text-gray-600">{{ $phone }}</div>
                                            @php
                                                $email = ($clientDetail['personalDetails'][1]->email != NULL) ? decrypt($clientDetail['personalDetails'][1]->email) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Email</div>
                                            <div class="text-gray-600">{{ $email }}</div>
                                            @php
                                                $address = ($clientDetail['personalDetails'][1]->address != NULL) ? decrypt($clientDetail['personalDetails'][1]->address) : NULL;
                                            @endphp
                                            <div class="fw-bold mt-5">Address</div>
                                            <div class="text-gray-600">{{ $address }}</div>
                                        </div>
                                    @endif
                                    @if($clientDetail['advisor'] != NULL)
                                    <div class="separator separator-dashed my-6"></div>
                                    <div class="m-0">
                                        <h5 class="fw-bold m-0">Advisor Details</h5>
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
                                    @endif
                                </div>
                                <div class="tab-pane fade " id="kt_list_widget_10_tab_2">
                                    <div class="d-flex justify-content-end mb-5">
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
                                    <div id="kt_table_clients_events">
                                        @foreach($wealthEvents as $wealthEvent)
                                            <div class="m-0">
                                                @if($wealthEvent->eventName != null)
                                                    <div class="d-flex flex-stack mb-5">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <h4 class="fw-bold m-0 mb-2 text-primary">{{ $wealthEvent->eventName }}</h4>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">CAD ${{ $wealthEvent->event_budget }}</div>
                                                            </div>
                                                        </div>
                                                    </div>                                                
                                                @endif
                                                @if($wealthEvent->event_start_year != null && $wealthEvent->event_end_year)
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <div class="text-gray-800 fw-bold fs-6">Start Year to End Year</div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">{{ $wealthEvent->event_start_year }} - {{ $wealthEvent->event_end_year }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($wealthEvent->interest != null)
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <div class="text-gray-800 fw-bold fs-6">Interest</div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">{{ $wealthEvent->interest }}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($wealthEvent->rate_return != null)
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <div class="text-gray-800 fw-bold fs-6">Return Rate</div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">{{ $wealthEvent->rate_return }}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($wealthEvent->down_payment != null)
                                                    <div class="d-flex flex-stack">
                                                        <div class="d-flex flex-stack flex-row-fluid d-grid gap-2">
                                                            <div class="me-5">
                                                                <div class="text-gray-800 fw-bold fs-6">Down Payment</div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="text-gray-600">{{ $wealthEvent->down_payment }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>                                        
                                            <div class="separator separator-dashed my-6"></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="kt_list_widget_10_tab_3">
                                    <div class="d-flex justify-content-end mb-5">
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
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body d-flex flex-column flex-center">
                            <div class="mb-2">
                                <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                                    What's your <span class="fw-bolder"> Net Worth ?</span>
                                </h1>
                                <p class="text-center">Link your account to find out. Track it here to help it grow.</p>
                                <div class="py-10 text-center">
                                    <img src="{{ asset('assets/media/svg/illustrations/easy/1.svg') }}" class="theme-light-show w-200px" alt="" />
                                    <img src="{{ asset('assets/media/svg/illustrations/easy/1-dark.svg') }}" class="theme-dark-show w-200px" alt="" />
                                </div>
                            </div>
                            <div class="text-center mb-1">
                                <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_new_card" data-bs-toggle="modal"> Show Me </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-lg-row-fluid ms-lg-15">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header pt-5">
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
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon fs-1 position-absolute ms-4">...</span>
                                    <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Report" />
                                </div>
                                <div id="goal_planner_1_export" class="d-none"></div>
                            </div>
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-exit-down fs-2"><span class="path1"></span><span class="path2"></span></i>
                                    Export Report
                                </button>
                                <div id="goal_planner_export_menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-export="copy"> Copy to clipboard </a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-export="excel"> Export as Excel </a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-export="csv"> Export as CSV </a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-export="pdf"> Export as PDF </a>
                                    </div>
                                </div>
                                <div id="goal_planner_buttons" class="d-none"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table align-middle border rounded table-row-dashed fs-6 g-5" id="goal_planner">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase">
                                        <th class="min-w-100px">Customer Name</th>
                                        <th class="min-w-100px">Email</th>
                                        <th class="min-w-100px">Status</th>
                                        <th class="min-w-100px">Date Joined</th>
                                        <th class="text-end min-w-75px">No. Orders</th>
                                        <th class="text-end min-w-75px">No. Products</th>
                                        <th class="text-end min-w-100px pe-5">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <tr class="odd">
                                        <td>
                                            <a href="#" class="text-dark text-hover-primary">Emma Smith</a>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark text-hover-primary">e.smith@kpmg.com.au</a>
                                        </td>
                                        <td>
                                            <div class="badge badge-light-success">Active</div>
                                        </td>
                                        <td data-order="2022-03-10T14:40:00+05:00">10 Mar 2022, 2:40 pm</td>
                                        <td class="text-end pe-0">94</td>
                                        <td class="text-end pe-0">103</td>
                                        <td class="text-end">$500.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-event.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/add-income.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/user-management/users/view/goal-planner.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/event-chart.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/expense-chart.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/customers/view/income-chart.js') }}"></script> 
@endsection