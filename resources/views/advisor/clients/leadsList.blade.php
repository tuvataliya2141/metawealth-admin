@extends('advisor.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Leads    </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('advisorDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> All Leads </li>
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
                            <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Leads" />
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <a href="javascript:void(0);" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_assign_user">
                            Assign User
                        </a>
                        {{-- <a href="{{ route('advisorAddClient') }}" class="btn btn-primary">
                            Add Leads
                        </a> --}}
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_clients_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_clients_table .form-check-input" value="1" />
                                    </div>
                                </th>
                                <th class="min-w-200px">Name</th>
                                <th class="text-end min-w-100px">Phone</th>
                                <th class="text-end min-w-100px">Email</th>
                                <th class="text-end min-w-100px">Address</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-100px">Clients</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach($clients as $client)
                                @if(decrypt($client->status) == 'self')
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-5">
                                                <a href="{{ route('advisorViewClient', $client->user_id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name">{{ decrypt($client->first_name) . ' ' . decrypt($client->last_name) }}</a>
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
                                        <div class="form-switch">
                                            <input class="form-check-input" type="checkbox" checked value="no" id="client" name="client" data-id="{{ $client->user_id }}" onChange="convertIntoLeads(this)"/>
                                        </div>    
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
                                                <a href="{{ route('advisorViewClient', $client->user_id) }}" class="menu-link px-3"> View </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('advisorUpdateLeads', $client->user_id) }}" class="menu-link px-3"> Edit </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('adminUnAssignAdvisor', $client->user_id) }}" class="menu-link px-3">
                                                    Unassign
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
<div class="modal fade" id="kt_modal_assign_user" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <form class="form" action="#" id="kt_modal_assign_user_form">
                <div class="modal-header" id="kt_modal_assign_user_header">
                    <h2 class="fw-bold">Assign User to Advisor</h2>
                    <div id="kt_modal_assign_user_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_assign_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_assign_user_header" data-kt-scroll-wrappers="#kt_modal_assign_user_scroll" data-kt-scroll-offset="300px">
                        <div class="d-flex flex-column mb-7 fv-row">
                            <label class="fs-6 fw-semibold mb-2">
                                <span class="required">User</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select an Advisor"></i>
                            </label>
                            <input type="hidden" value="{{ auth()->user()->id }}" id="advisor_id" data-name="{{ auth()->user()->name }}">
                            <input type="hidden" value="" id="user_name">
                            <select id="selectUser" name="user" aria-label="Select an User" data-control="select2" data-placeholder="Select a User..." data-dropdown-parent="#kt_modal_assign_user" class="form-select form-select-solid fw-bold">
                                <option value="">Select a User...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" data-name="{{ $user->name }}">{{ $user->name . ' (' . $user->email . ')'  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer flex-center">
                    <button type="reset" id="kt_modal_assign_user_cancel" class="btn btn-light me-3"> Discard </button>
                    <button type="submit" id="kt_modal_assign_user_submit" class="btn btn-primary">
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
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/assignUser.js') }}"></script>
<script>
    const siteUrl = $('meta[name="site-url"]').attr('content');
    function convertIntoLeads(val) {
        const parent = $(val).parent().closest('tr');
        const productName = parent.find('[data-kt-crm-client-filter="product_name"]').text();
        const clientId = $(val).attr('data-id');
        // if($(val).prop('checked') == true) {
            Swal.fire({
                html: "Are you sure you want to add <strong>" + productName + "</strong> as a client?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, add!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url : "statusUpdateLeads/"+clientId,
                        type : 'get',
                        dataType : 'json',
                        success : function(result){
                            Swal.fire({
                                html: "You have added <strong>" + productName + "</strong>!.",
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
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        html: "<strong>" +productName + "</strong> was not added.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        // }
    }
</script>
@endsection