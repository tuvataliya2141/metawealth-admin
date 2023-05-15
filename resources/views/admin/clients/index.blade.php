@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Clients </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> All Clients </li>
                </ul>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Client" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="{{ route('adminAddClient') }}" class="btn btn-primary">
                            Add Client
                        </a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_clients_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Name</th>
                                <th class="text-end min-w-100px">Phone</th>
                                <th class="text-end min-w-100px">Email</th>
                                <th class="text-end min-w-100px">Address</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach($clients as $client)
                                @if($client->status != null && decrypt($client->status) == 'self')
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-5">
                                                <a href="{{ route('adminViewClient', $client->user_id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">{{ decrypt($client->first_name) . ' ' . decrypt($client->last_name) }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{ ($client->phone) ? decrypt($client->phone) : '-' }}</span>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{ decrypt($client->email) }}</span>
                                    </td>
                                    <td class="text-end pe-0"> {{ ($client->address) ? decrypt($client->address) : '-' }} </td>
                                    <td class="text-end pe-0" data-order="Published">
                                        @if($client->user_status == 1)
                                        <div class="badge badge-light-success">Active</div>
                                        @else
                                        <div class="badge badge-light-danger">Inactive</div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <span class="svg-icon svg-icon-5 m-0">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 assignUser" data-client-id="{{ $client->user_id }}" data-client-name="{{ decrypt($client->first_name) . ' ' . decrypt($client->last_name) }}" data-bs-toggle="modal" data-bs-target="#kt_modal_assign_advisor"> Assign </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('adminViewClient', $client->user_id) }}" class="menu-link px-3"> View </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('adminUpdateClient', $client->user_id) }}" class="menu-link px-3"> Edit </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-client-id="{{ $client->user_id }}" data-kt-ecommerce-product-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="kt_modal_assign_advisor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form" action="#" id="kt_modal_assign_advisor_form">
                <div class="modal-header" id="kt_modal_assign_advisor_header">
                    <h2 class="fw-bold">Assign Advisor to User</h2>
                    <div id="kt_modal_assign_advisor_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                            <input type="hidden" value="" id="client_id" data-name="">
                            <input type="hidden" value="" id="advisor_name">
                            <select id="selectAdvisor" name="advisor" aria-label="Select an Advisor" data-control="select2" data-placeholder="Select an Advisor..." data-dropdown-parent="#kt_modal_assign_advisor" class="form-select form-select-solid fw-bold">
                                <option value="">Select an Advisor...</option>
                                @foreach($advisors as $advisor)
                                    <option value="{{ $advisor->id }}" data-name="{{ $advisor->name }}">{{ $advisor->name . ' (' . $advisor->email . ')'  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" id="kt_modal_assign_advisor_cancel" class="btn btn-light me-3"> Discard </button>
                    <button type="submit" id="kt_modal_assign_advisor_submit" class="btn btn-primary">
                        <span class="indicator-label"> Submit </span>
                        <span class="indicator-progress"> Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/clients.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/assignAdvisor.js') }}"></script>
<script>
    $('.assignUser').click(function(){
        var clientId = $(this).attr('data-client-id');
        var clientName = $(this).attr('data-client-name');

        $('#client_id').val(clientId);
        $('#client_id').attr('data-name', clientName);
    });

</script>
@endsection