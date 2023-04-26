@extends('superAdmin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Clients </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('subAdminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('subAdminAllClients') }}" class="text-muted text-hover-primary"> All Clients </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Add Clients </li>
                </ul>
            </div>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card card-flush h-lg-100" id="kt_contacts_main">
                <div class="card-header pt-7" id="kt_chat_contacts_header">
                    <div class="card-title">
                        <span class="svg-icon svg-icon-1 me-2">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                                <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                            </svg>
                        </span>
                        <h2>Add New Client</h2>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <form class="form" action="{{ route('subAdminStoreClient') }}" method="post">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">First Name</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the first name."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="first_name" value="{{ old('first_name') }}" required/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Last Name</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the last name."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="last_name" value="{{ old('last_name') }}" required/>
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
                                    <input type="text" class="form-control form-control-solid" name="phone" value="{{ old('phone') }}" required/>
                                    @error('phone')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Email</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the email id."></i>
                                    </label>
                                    <input type="email" class="form-control form-control-solid" name="email" value="{{ old('email') }}" required/>
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
                                    <input type="date" class="form-control form-control-solid" name="dob" value="{{ old('dob') }}" required/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Gender</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the gender."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_client_gender" class="form-select form-select-solid" name="gender" data-placeholder="Select a Gender" required>
                                            <option></option>
                                            <option value="male" {{ (old('gender') == 'male') ? 'selected' : '' }}> Male </option>
                                            <option value="female" {{ (old('gender') == 'female') ? 'selected' : '' }}> Female </option>
                                            <option value="other" {{ (old('gender') == 'other') ? 'selected' : '' }}> Other </option>
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
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Joint Profile</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the Joint Profile."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_client_joint_profile" class="form-select form-select-solid" name="joint_profile" data-placeholder="Select a Joint Profile">
                                            <option></option>
                                            <option value="yes" {{ (old('joint_profile') == 'yes') ? 'selected' : '' }}> Yes </option>                                            
                                            <option value="no" {{ (old('joint_profile') == 'no') ? 'selected' : '' }}> No </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Marital Status</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the Marital Status."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_client_marital_status" class="form-select form-select-solid" name="marital_status" data-placeholder="Select a Marital Status">
                                            <option></option>
                                            <option value="married" {{ (old('marital_status') == 'married') ? 'selected' : '' }}> Married </option>                                            
                                            <option value="unmarried" {{ (old('marital_status') == 'unmarried') ? 'selected' : '' }}> Unmarried </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Retired</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the Retired."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_client_retired" class="form-select form-select-solid" name="retired" data-placeholder="Select a Retired">
                                            <option></option>
                                            <option value="yes" {{ (old('retired') == 'yes') ? 'selected' : '' }}> Yes </option>                                            
                                            <option value="no" {{ (old('retired') == 'no') ? 'selected' : '' }}> No </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Street Address</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Street Address."></i>
                                    </label>
                                    <textarea class="form-control" data-kt-autosize="true" name="address">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>City</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the City."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="city" value="{{ old('city') }}"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Province</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Province."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="province" value="{{ old('province') }}"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Postal Code</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Postal Code."></i>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="postal_code" value="{{ old('postal_code') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-6 family_details" style="display: none;"></div>
                        <div class="family_details" style="display: none;">
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">                            
                                <div class="col d-flex align-items-center" id="have_child">
                                    <div class="fv-row mb-7">
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" name="have_child" type="checkbox" value="1" id="flexSwitchChecked" {{ (old('have_child')) ? 'selected' : '' }}/>
                                            <label class="form-check-label" for="flexSwitchChecked">
                                                Do you have a child?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col d-none" id="child_count">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>How Many Children?</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the no. of children."></i>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="child" value="{{ old('child') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-title">
                                <h2>SPOUSE / PARTNER</h2>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>First Name</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the first name."></i>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="p_first_name" value="{{ old('p_first_name') }}"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Last Name</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the last name."></i>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="p_last_name" value="{{ old('p_last_name') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Date of Birth</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the date of birth."></i>
                                        </label>
                                        <input type="date" class="form-control form-control-solid" name="p_dob" value="{{ old('p_dob') }}"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Gender</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the gender."></i>
                                        </label>
                                        <div class="w-100">
                                            <select id="select2_client_p_gender" class="form-select form-select-solid" name="p_gender" data-placeholder="Select a Gender">
                                                <option></option>
                                                <option value="male" {{ (old('p_gender') == 'male') ? 'selected' : '' }}> Male </option>
                                                <option value="female" {{ (old('p_gender') == 'female') ? 'selected' : '' }}> Female </option>
                                                <option value="other" {{ (old('p_gender') == 'other') ? 'selected' : '' }}> Other </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Retired</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the Retired."></i>
                                        </label>
                                        <div class="w-100">
                                            <select id="select2_client_p_retired" class="form-select form-select-solid" name="p_retired" data-placeholder="Select a Retired">
                                                <option></option>
                                                <option value="yes" {{ (old('p_retired') == 'yes') ? 'selected' : '' }}> Yes </option>                                            
                                                <option value="no" {{ (old('p_retired') == 'no') ? 'selected' : '' }}> No </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Marital Status</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the Marital Status."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_client_p_marital_status" class="form-select form-select-solid" name="p_marital_status" data-placeholder="Select a Marital Status">
                                            <option></option>
                                            <option value="married" {{ (old('p_marital_status') == 'married') ? 'selected' : '' }}> Married </option>                                            
                                            <option value="unmarried" {{ (old('p_marital_status') == 'unmarried') ? 'selected' : '' }}> Unmarried </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Phone</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the phone number."></i>
                                        </label>
                                        <input type="text" class="form-control form-control-solid" name="p_phone" value="{{ old('p_phone') }}"/>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Email</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the email id."></i>
                                        </label>
                                        <input type="email" class="form-control form-control-solid" name="p_email" value="{{ old('p_email') }}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <div class="col">
                                    <div class="fv-row mb-7">
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Street Address</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Street Address."></i>
                                        </label>
                                        <textarea class="form-control" data-kt-autosize="true" name="p_address">{{ old('p_address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('subAdminAllClients') }}" class="btn btn-light me-3"> Cancel </a>
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
    $('#select2_client_gender').select2({
        placeholder: "Select a gender",
        minimumResultsForSearch: Infinity
    });
    $('#select2_client_p_gender').select2({
        placeholder: "Select a gender",
        minimumResultsForSearch: Infinity
    });
    $('#select2_client_joint_profile').select2({
        placeholder: "Select a joint profile",
        minimumResultsForSearch: Infinity
    });
    $('#select2_client_marital_status').select2({
        placeholder: "Select a marital status",
        minimumResultsForSearch: Infinity
    });
    $('#select2_client_retired').select2({
        placeholder: "Select a retired",
        minimumResultsForSearch: Infinity
    });
    $('#select2_client_p_marital_status').select2({
        placeholder: "Select a marital status",
        minimumResultsForSearch: Infinity
    });
    $('#select2_client_p_retired').select2({
        placeholder: "Select a retired",
        minimumResultsForSearch: Infinity
    });
    $('#select2_client_marital_status').change(function(){
        var maritalStatus = $(this).val();

        if(maritalStatus == 'married') {
            $(".family_details").slideDown();

            $("#have_child").click(function(){
                if($("#flexSwitchChecked").prop('checked')==true) {
                    $("#child_count").removeClass('d-none');
                } else {
                    $("#child_count").addClass('d-none');
                }
            });

        } else if(maritalStatus == 'unmarried') {
            $(".family_details").slideUp();
        }
    });
</script>
@endsection