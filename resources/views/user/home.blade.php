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
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1"> {{ auth()->user()->name }} </a>
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
                                    <a href="{{ route('adminUpdateClient', auth()->user()->id) }}" class="btn btn-sm btn-light-primary"> Edit </a>
                                </span>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    @if(auth()->user()->status == 1)
                                    <div class="badge badge-light-success d-inline">Active</div>
                                    @else
                                    <div class="badge badge-light-danger d-inline">Inactive</div>
                                    @endif
                                    <div class="fw-bold mt-5">Email Id</div>
                                    <div class="text-gray-600">
                                        <a href="mailto:{{ auth()->user()->email }}" class="text-gray-600 text-hover-primary">{{ auth()->user()->email }}</a>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-lg-row-fluid ms-lg-15">
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
                                    <tr>
                                        <td><a href="#" class="text-gray-600 text-hover-primary mb-1"> 1 </a></td>
                                        <td data-kt-wealthEvent-filter="product_name"> Brijesh Vataliya </td>
                                        <td> $100000 </td>
                                        <td> 2021 - 20300 </td>
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
                                                    <a href="javascript:void(0);" data-id="1" class="menu-link px-3" data-kt-wealthEvent-filter="edit_row"> Edit </a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="javascript:void(0);" data-id="1" class="menu-link px-3" data-kt-wealthEvent-filter="delete_row"> Delete </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Events Performance</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex align-items-center p-0">
                            <div id="kt_chart_events" class="mx-auto mb-4"></div>
                            <div class="mx-auto">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bullet bullet-dot w-8px h-7px bg-success me-2"></div>
                                    <div class="fs-8 fw-semibold text-muted"><b>Short Term - $1000000</b></div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bullet bullet-dot w-8px h-7px bg-primary me-2"></div>
                                    <div class="fs-8 fw-semibold text-muted"><b>Mid Term - $1000000</b></div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bullet bullet-dot w-8px h-7px bg-info me-2"></div>
                                    <div class="fs-8 fw-semibold text-muted"><b>Long Term - $1000000</b></div>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <div class="bullet bullet-dot w-8px h-7px bg-danger me-2"></div>
                                    <div class="fs-8 fw-semibold text-muted"> <b>Legacy - $1000000</b></div>
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
