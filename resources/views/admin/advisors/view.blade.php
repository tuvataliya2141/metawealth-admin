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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Advisors Details </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminAllAdvisors') }}" class="text-muted text-hover-primary"> All Advisors </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> View Advisor </li>
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
                                    <span class="symbol-label bg-danger text-inverse-danger fw-bold profile-char">{{ substr($advisorDetails['user']->name,0,1) }}</span>
                                </div>
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1"> {{ $advisorDetails['user']->name }} </a>
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
                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit advisor details">
                                    <a href="{{ route('adminUpdateAdvisor', $advisorDetails['user']->id) }}" class="btn btn-sm btn-light-primary"> Edit </a>
                                </span>
                            </div>
                            <div class="separator separator-dashed my-3"></div>
                            <div id="kt_customer_view_details" class="collapse show">
                                <div class="py-5 fs-6">
                                    @if($advisorDetails['user']->status == 1)
                                    <div class="badge badge-light-success d-inline">Active</div>
                                    @else
                                    <div class="badge badge-light-danger d-inline">Inactive</div>
                                    @endif
                                    <div class="fw-bold mt-5">Email Id</div>
                                    <div class="text-gray-600">
                                        <a href="mailto:{{ $advisorDetails['user']->email }}" class="text-gray-600 text-hover-primary">{{ $advisorDetails['user']->email }}</a>
                                    </div>
                                    @php
                                        $phone = ($advisorDetails['personalDetails'][0]->phone != NULL) ? decrypt($advisorDetails['personalDetails'][0]->phone) : NULL;
                                    @endphp
                                    <div class="fw-bold mt-5">Mobile No</div>
                                    <div class="text-gray-600">
                                        <a href="tel:{{ $phone }}" class="text-gray-600 text-hover-primary">{{ $phone }}</a>
                                    </div>
                                    @if($advisorDetails['personalDetails'][0]->gender != NULL)
                                        @php
                                            $gender = ($advisorDetails['personalDetails'][0]->gender != NULL) ? decrypt($advisorDetails['personalDetails'][0]->gender) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Gender</div>
                                        <div class="text-gray-600">{{ ($gender!= NULL) ? $gender : '' }}</div>
                                    @endif
                                    @if($advisorDetails['personalDetails'][0]->marital_status != NULL)
                                        @php
                                            $maritlStatus = ($advisorDetails['personalDetails'][0]->marital_status != NULL) ? decrypt($advisorDetails['personalDetails'][0]->marital_status) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Marital Status</div>
                                        <div class="text-gray-600">{{ ($maritlStatus!= NULL) ? $maritlStatus : '' }}</div>
                                    @endif
                                    @if($advisorDetails['personalDetails'][0]->address != NULL || $advisorDetails['personalDetails'][0]->city != NULL || $advisorDetails['personalDetails'][0]->province != NULL || $advisorDetails['personalDetails'][0]->postal_code != NULL)
                                        @php
                                            $address = ($advisorDetails['personalDetails'][0]->address != NULL) ? decrypt($advisorDetails['personalDetails'][0]->address) : NULL;
                                            $city = ($advisorDetails['personalDetails'][0]->city != NULL) ? decrypt($advisorDetails['personalDetails'][0]->city) : NULL;
                                            $province = ($advisorDetails['personalDetails'][0]->province != NULL) ? decrypt($advisorDetails['personalDetails'][0]->province) : NULL;
                                            $postalCode = ($advisorDetails['personalDetails'][0]->postal_code != NULL) ? decrypt($advisorDetails['personalDetails'][0]->postal_code) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Address</div>
                                        <div class="text-gray-600">{{ ($address != NULL) ? $address : '' }}<br />{{ ($city != NULL) ? $city : '' }}<br />{{ ($province != NULL) ? $province : '' }}<br />{{ ($postalCode != NULL) ? $postalCode : '' }}</div>
                                    @endif
                                    @if($advisorDetails['personalDetails'][0]->dob != NULL)
                                        @php
                                            $dob = ($advisorDetails['personalDetails'][0]->dob != NULL) ? decrypt($advisorDetails['personalDetails'][0]->dob) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Date of Birth</div>
                                        <div class="text-gray-600">{{ ($dob!= NULL) ? $dob : '' }}</div>
                                    @endif
                                    @if($advisorDetails['personalDetails'][0]->retired != NULL)
                                        @php
                                            $retired = ($advisorDetails['personalDetails'][0]->retired != NULL) ? decrypt($advisorDetails['personalDetails'][0]->retired) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Retired</div>
                                        <div class="text-gray-600">{{ ($retired!= NULL) ? $retired : '' }}</div>
                                    @endif
                                    @if($advisorDetails['personalDetails'][0]->joint_plan != NULL)
                                        @php
                                            $joint_plan = ($advisorDetails['personalDetails'][0]->joint_plan != NULL) ? decrypt($advisorDetails['personalDetails'][0]->joint_plan) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Joint Plan</div>
                                        <div class="text-gray-600">{{ ($joint_plan!= NULL) ? $joint_plan : '' }}</div>
                                    @endif
                                    @if($advisorDetails['personalDetails'][0]->child_tot != NULL)
                                        @php
                                            $child_tot = ($advisorDetails['personalDetails'][0]->child_tot != NULL) ? decrypt($advisorDetails['personalDetails'][0]->child_tot) : NULL;
                                        @endphp
                                        <div class="fw-bold mt-5">Joint Plan</div>
                                        <div class="text-gray-600">{{ ($child_tot!= NULL) ? $child_tot : '' }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-lg-row-fluid ms-lg-15">
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_client_view_advisors_tab">Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_leads_view_advisors_tab">Leads</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_client_view_advisors_tab" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Clients</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <table class="table align-middle table-row-dashed gy-5"  id="kt_table_advisors_users">
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                            <tr class="text-start text-muted text-uppercase gs-0">
                                                <th class="min-w-120px">Id</th>
                                                <th class="min-w-120px">Name</th>
                                                <th class="min-w-120px">Phone</th>
                                                <th class="min-w-120px">Email</th>
                                                <th class="min-w-120px">Notes From Contact</th>
                                                <th class="min-w-120px">Followup Date</th>
                                                <th class="min-w-120px">Status</th>
                                                <th class="min-w-120px">Clients</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            @foreach($advisorDetails['clients'] as $key => $user)
                                                @php
                                                    $personalDetails = App\Models\PersonalDetails::where('user_id', $user->id)->first();
                                                @endphp
                                            <tr>
                                                <td><a href="#" class="text-gray-600 text-hover-primary mb-1"> {{ $key + 1 }} </a></td>
                                                <td data-kt-users-filter="product_name"> {{ $user->first_name .' '. $user->last_name }} </td>
                                                <td> {{ $user->phone_number }} </td>
                                                <td> {{ $user->email }} </td>
                                                <td> {{ $user->notes_from_contact }} </td>
                                                <td> {{ Carbon\Carbon::parse($user->followup_date)->format('M d, Y') }} </td>
                                                <td> {{ $user->status }} </td>
                                                <td> 
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" value="yes" id="client" name="client" data-id="{{ $user->id }}" onChange="convertIntoLeads(this)"/>
                                                    </div>    
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="kt_leads_view_advisors_tab" role="tabpanel">
                            <div class="card pt-4 mb-6 mb-xl-9">
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h2>Leads</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 pb-5">
                                    <table class="table align-middle table-row-dashed gy-5">
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                            <tr class="text-start text-muted text-uppercase gs-0">
                                                <th class="min-w-100px">Id</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th class="min-w-100px">Email</th>
                                                <th class="text-end min-w-100px pe-4">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            @foreach($advisorDetails['leads'] as $key => $user)
                                                @php
                                                    $personalDetails = App\Models\PersonalDetails::where('user_id', $user->id)->first();
                                                @endphp
                                            <tr>
                                                <td><a href="#" class="text-gray-600 text-hover-primary mb-1"> {{ $key + 1 }} </a></td>
                                                <td data-kt-users-filter="product_name"> {{ $user->name }} </td>
                                                <td> {{ decrypt($personalDetails->phone) }} </td>
                                                <td> {{ $user->email }} </td>
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
                                                            <a href="{{ route('adminViewClient', $user->id) }}" class="menu-link px-3"> View </a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="{{ route('adminUpdateClient', $user->id) }}" class="menu-link px-3"> Edit </a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0);" data-id="{{ $user->id }}" class="menu-link px-3" data-kt-users-filter="delete_row"> Delete </a>
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
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script src="{{ asset('assets/js/custom/apps/customers/view/advisors-users-table.js') }}"></script>
    <script>
        const siteUrl = $('meta[name="site-url"]').attr('content');
        function convertIntoLeads(val) {
            const parent = $(val).parent().closest('tr');
            const productName = parent.find('[data-kt-crm-client-filter="product_name"]').text();
            const clientId = $(val).attr('data-id');
            if($(val).prop('checked') == true) {
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
                            url : siteUrl+"advisors/status-update-client/"+clientId,
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
            }
        }
    </script>
@endsection