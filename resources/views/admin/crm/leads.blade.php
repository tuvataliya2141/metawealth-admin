@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Leads </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
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
                            <input type="text" data-kt-crm-client-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Client" />
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_crm_clients_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-150px">Name</th>
                                <th class="text-end min-w-150px">Phone</th>
                                <th class="text-end min-w-150px">Email</th>
                                <th class="text-end min-w-150px">Address</th>
                                <th class="text-end min-w-150px">Nationality</th>
                                <th class="text-end min-w-150px">Annual Income</th>
                                <th class="text-end min-w-150px">Date of Contact</th>
                                <th class="text-end min-w-150px">Follow up Date</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-100px">Clients</th>
                                <th class="text-end min-w-150px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach($allClients as $client)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-5">
                                            <a href="{{ route('adminUpdateCRMClient', $client->id) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-crm-client-filter="product_name"> {{ $client->first_name . ' ' . $client->last_name }} </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">{{ $client->phone_number }}</span>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">{{ $client->email }}</span>
                                </td>
                                <td class="text-end pe-0"> {{ $client->address }} </td>
                                <td class="text-end pe-0"> {{ $client->nationality }} </td>
                                <td class="text-end pe-0"> {{ $client->annual_income }} </td>
                                <td class="text-end pe-0"> {{ Carbon\Carbon::parse($client->date_of_contact)->format('M d, Y') }} </td>
                                <td class="text-end pe-0"> {{ Carbon\Carbon::parse($client->followup_date)->format('M d, Y') }} </td>
                                <td class="text-end pe-0" data-order="Published">
                                    <div class="badge badge-light-success">Active</div>
                                </td>
                                <td class="text-end pe-0">
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" value="yes" id="client" name="client" data-id="{{ $client->id }}" onChange="convertIntoLeads(this)" {{ ($client->clients == 'yes') ? 'checked' : '' }}/>
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
                                            <a href="#" class="menu-link px-3 assignUser" data-client-id="1" data-client-name="Brijesh Vataliya" data-bs-toggle="modal" data-bs-target="#kt_modal_assign_advisor"> Assign </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="{{ route('adminUpdateCRMClient', $client->id) }}" class="menu-link px-3"> Edit </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-client-id="{{ $client->id }}" data-kt-crm-client-filter="delete_row">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
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

@endsection
@section('script')
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/crmClients.js') }}"></script>
<script>
    function convertIntoLeads(val) {
        const parent = $(val).parent().closest('tr');
        const productName = parent.find('[data-kt-crm-client-filter="product_name"]').text();
        const clientId = $(val).attr('data-id');
        if($(val).prop('checked') == false) {
            Swal.fire({
                html: "Are you sure you want to remove <strong>" + productName + "</strong> from client list?",
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
                        url : "remove-crm-client/"+clientId,
                        type : 'get',
                        dataType : 'json',
                        success : function(result){
                            Swal.fire({
                                html: "You have removed <strong>" + productName + "</strong>!.",
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
                        html: "<strong>" +productName + "</strong> was not removed.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        }
    }
</script>
@endsection