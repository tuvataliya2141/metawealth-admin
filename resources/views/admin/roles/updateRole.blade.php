@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> Roles </h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminDashboard') }}" class="text-muted text-hover-primary"> Home </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('adminAllRoles') }}" class="text-muted text-hover-primary"> All Roles </a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted"> Update Role </li>
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
        </div>
    </div>
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <div class="card card-flush h-lg-100" id="kt_contacts_main">
                <div class="card-header pt-7" id="kt_chat_contacts_header">
                    <div class="card-title">
                        <h2>Update Role</h2>
                    </div>
                </div>
                <div class="card-body pt-5">
                    <form class="form" action="{{ route('adminEditRole') }}" method="post">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mt-3">
                                        <span class="required">Role Name</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enter the role name."></i>
                                    </label>
                                    <input type="hidden" name="id" value="{{ $roles->id }}"/>
                                    <input type="text" class="form-control form-control-solid" name="name" value="{{ $roles->name }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="separator mb-6"></div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('adminAllRoles') }}" class="btn btn-light me-3"> Cancel </a>
                            <button type="submit" data-kt-contacts-type="submit" class="btn btn-primary"> Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection