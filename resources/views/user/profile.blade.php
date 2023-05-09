@extends('user.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Profile
                </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Profile </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="d-flex flex-column flex-xl-row">
                <!-- Sidebar -->
                @include('user.sidebar')
                <div class="flex-lg-row-fluid ms-lg-15">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <svg width="60" height="60" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="currentColor"/>
                                            <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="currentColor"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                        <div class="d-flex flex-column">
                                            <div class="d-flex align-items-center mb-2">
                                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->name }}</a>                                        
                                                @if($user->email_verified_at != null)
                                                <a href="#">
                                                    <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                            <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor" />
                                                            <path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                    <span class="svg-icon svg-icon-4 me-1">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                        </svg>
                                                    </span> {{ $user->email }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <div class="card-header cursor-pointer">
                            <div class="card-title m-0">
                                <h3 class="fw-bold m-0">Profile Details</h3>
                            </div>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-success">Password updated!</h4>
                                    <span>{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">Password not updated!</h4>
                                    <span>{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif
                        <form class="form" action="{{ route('adminEditProfile') }}" method="post">
                            @csrf
                            <div class="card-body p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="hidden" name="id" value="{{ $user->id }}" />
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="Name" value="{{ $user->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Email Address</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email Address" value="{{ $user->email }}" readonly />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Current Password</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="password" name="current_pass" class="form-control form-control-lg form-control-solid" placeholder="Current Password" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">New Password</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="New Password" />
                                    </div>
                                </div>
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Confirm Password</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="Confirm Password" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
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
    </script>
@endsection