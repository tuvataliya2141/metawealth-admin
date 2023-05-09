@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Advisors </h1>
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
                    <li class="breadcrumb-item text-muted"> Add Advisor </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card card-flush h-lg-100" id="kt_contacts_main">
                <div class="card-header pt-7" id="kt_chat_contacts_header">
                    <div class="card-title">
                        <h2>Add New Advisor</h2>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <form class="form" action="{{ route('adminStoreAdvisor') }}" method="post">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">First Name</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the first name."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="first_name" value="" required/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Last Name</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the last name."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="last_name" value="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Phone</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the phone number."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="phone" value="" required/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Email</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the email id."></i>
                                    </label>
                                    <input type="email" class="form-control form-control-solid" name="email" value="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Date of Birth</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the date of birth."></i>
                                    </label>
                                    <input type="date" class="form-control form-control-solid" name="dob" value="" required/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Gender</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the gender."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_advisor_gender" class="form-select form-select-solid" name="gender" data-placeholder="Select a Gender" required>
                                            <option></option>
                                            <option value="male"> Male </option>                                            
                                            <option value="female"> Female </option>                                            
                                            <option value="other"> Other </option>                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Password</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the password."></i>
                                    </label>
                                    <input type="password" class="form-control form-control-solid" name="password" value="" required/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Confirm Password</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Confirm Password."></i>
                                    </label>
                                    <input type="password" class="form-control form-control-solid" name="password_confirmation" value="" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">                            
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <div class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" name="status" type="checkbox" value="1" id="flexSwitchChecked" checked/>
                                        <label class="form-check-label" for="flexSwitchChecked">
                                            Status
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('adminAllAdvisors') }}" class="btn btn-light me-3"> Cancel </a>
                            <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary"> Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('#select2_advisor_gender').select2({
        placeholder: "Select a gender",
        minimumResultsForSearch: Infinity
    });
</script>
@endsection