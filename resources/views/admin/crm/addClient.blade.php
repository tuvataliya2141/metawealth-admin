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
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminCRMAllClients') }}" class="text-muted text-hover-primary"> All Clients </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Add Client </li>
                </ul>
            </div>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card card-flush h-lg-100" id="kt_contacts_main">
                <div class="card-header pt-7" id="kt_chat_contacts_header">
                    <div class="card-title">
                        <h2>Add New Client</h2>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <form class="form" action="{{ route('adminStoreCRMClient') }}" method="post">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">First Name</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the first name."></i>
                                    </label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required/>
                                </div>
                                @error('first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Last Name</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the last name."></i>
                                    </label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required/>
                                </div>
                                @error('last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Phone</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the phone number."></i>
                                    </label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required/>
                                </div>
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Cell Phone</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Cell Phone."></i>
                                    </label>
                                    <input type="text" class="form-control" name="cell_phone" value="{{ old('cell_phone') }}"/>
                                </div>
                                @error('cell_phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Fax</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Fax."></i>
                                    </label>
                                    <input type="text" class="form-control" name="fax" value="{{ old('fax') }}" required/>
                                </div>
                                @error('fax')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Email</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the email id."></i>
                                    </label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required/>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Date of Birth</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the date of birth."></i>
                                    </label>
                                    <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" required/>
                                </div>
                                @error('dob')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Gender</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the gender."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_client_gender" class="form-select" name="gender" data-placeholder="Select a Gender" required>
                                            <option></option>
                                            <option value="male" {{ (old('gender') == 'male') ? 'selected' : '' }}> Male </option>
                                            <option value="female" {{ (old('gender') == 'female') ? 'selected' : '' }}> Female </option>
                                            <option value="other" {{ (old('gender') == 'other') ? 'selected' : '' }}> Other </option>
                                        </select>
                                    </div>
                                </div>
                                @error('gender')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Occupation</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the occupation."></i>
                                    </label>
                                    <input type="text" class="form-control" name="occupation" value="{{ old('occupation') }}" required/>
                                </div>
                                @error('occupation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Industry</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Industry."></i>
                                    </label>
                                    <input type="text" class="form-control" name="industry" value="{{ old('industry') }}" required/>
                                </div>
                                @error('industry')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Nationality</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Nationality."></i>
                                    </label>
                                    <input type="text" class="form-control" name="nationality" value="{{ old('nationality') }}" required/>
                                </div>
                                @error('nationality')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Employer</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Employer."></i>
                                    </label>
                                    <input type="text" class="form-control" name="employer" value="{{ old('employer') }}" required/>
                                </div>
                                @error('employer')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Id Type</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Id Type."></i>
                                    </label>
                                    <input type="text" class="form-control" name="id_type" value="{{ old('id_type') }}" required/>
                                </div>
                                @error('id_type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Id Number</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Id Number."></i>
                                    </label>
                                    <input type="text" class="form-control" name="id_number" value="{{ old('id_number') }}" required/>
                                </div>
                                @error('id_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Id Place</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Id Place."></i>
                                    </label>
                                    <input type="text" class="form-control" name="id_place" value="{{ old('id_place') }}" required/>
                                </div>
                                @error('id_place')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Receiving Funds</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Receiving Funds."></i>
                                    </label>
                                    <input type="text" class="form-control" name="receiving_funds" value="{{ old('receiving_funds') }}" required/>
                                </div>
                                @error('receiving_funds')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Sending Funds</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Sending Funds."></i>
                                    </label>
                                    <input type="text" class="form-control" name="sending_funds" value="{{ old('sending_funds') }}" required/>
                                </div>
                                @error('sending_funds')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Source Funds</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Source Funds."></i>
                                    </label>
                                    <input type="text" class="form-control" name="source_funds" value="{{ old('source_funds') }}" required/>
                                </div>
                                @error('source_funds')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Expected Transaction</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Expected Transaction."></i>
                                    </label>
                                    <input type="text" class="form-control" name="expected_transaction" value="{{ old('expected_transaction') }}" required/>
                                </div>
                                @error('expected_transaction')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Annual Income</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Annual Income."></i>
                                    </label>
                                    <input type="text" class="form-control" name="annual_income" value="{{ old('annual_income') }}" required/>
                                </div>
                                @error('annual_income')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Purpose of Trading</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Trading Purpose."></i>
                                    </label>
                                    <input type="text" class="form-control" name="trading_purpose" value="{{ old('trading_purpose') }}" required/>
                                </div>
                                @error('trading_purpose')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Date of Contact</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the date of contact."></i>
                                    </label>
                                    <input type="date" class="form-control" name="date_contact" value="{{ old('date_contact') }}"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Mode of Contact</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Mode of Contact."></i>
                                    </label>
                                    <input type="text" class="form-control" name="mode_contact" value="{{ old('mode_contact') }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Notes from Contact</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Notes from Contact."></i>
                                    </label>
                                    <textarea class="form-control" data-kt-autosize="true" name="notes_from_contact">{{ old('notes_from_contact') }}</textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Address</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the Address."></i>
                                    </label>
                                    <textarea class="form-control" data-kt-autosize="true" name="address">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Follow up Date</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the Follow up date."></i>
                                    </label>
                                    <input type="date" class="form-control" name="followup_date" value="{{ old('followup_date') }}"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span>Status</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Select the Status."></i>
                                    </label>
                                    <div class="w-100">
                                        <select id="select2_client_status" class="form-select" name="status" data-placeholder="Select a Status">
                                            <option></option>
                                            <option value="Cold" {{ (old('status') == 'Cold') ? 'selected' : '' }}> Cold </option>
                                            <option value="Warm" {{ (old('status') == 'Warm') ? 'selected' : '' }}> Warm </option>
                                            <option value="Hot" {{ (old('status') == 'Hot') ? 'selected' : '' }}> Hot </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="form-check">
                                    <div class="fv-row mb-7">
                                        <input class="form-check-input" type="checkbox" value="1" id="followup_notification" name="followup_notification" />
                                        <label class="form-check-label" for="followup_notification">
                                            Follow up Notification
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <div class="fv-row mb-7">
                                        <input class="form-check-input" type="checkbox" value="1" id="followup_notification_email" name="followup_notification_email" />
                                        <label class="form-check-label" for="followup_notification_email">
                                            Email notification to agents for Follow up
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="yes" id="client" name="client"/>
                                    <label class="form-check-label" for="client">
                                        Client
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('adminCRMAllClients') }}" class="btn btn-light me-3"> Cancel </a>
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
    $('#select2_client_status').select2({
        placeholder: "Select a status",
        minimumResultsForSearch: Infinity
    });
</script>
@endsection