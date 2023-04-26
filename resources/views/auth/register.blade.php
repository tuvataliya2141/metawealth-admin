<!DOCTYPE html>
<html lang="en">
<head>
<title>Metawealth - Your wealth, your plans, your way</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="app-blank">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column stepper-multistep" id="kt_create_account_stepper">
            <div class="d-flex flex-column flex-lg-row-auto w-lg-350px w-xl-500px">
                <div class="d-flex flex-column position-lg-fixed top-0 bottom-0 w-lg-350px w-xl-500px scroll-y bgi-size-cover bgi-position-center"
                    style="background-image: url({{ asset('assets/media/misc/auth-bg.png') }})">
                    <div class="d-flex flex-center py-10 py-lg-20 mt-lg-20">
                        <a href="{{ route('login') }}">
                            <img alt="Logo" src="{{ asset('assets/media/logos/white-logo.png') }}" class="h-70px" />
                        </a>
                    </div>
                    <div class="d-flex flex-row-fluid justify-content-center p-10">
                        <div class="stepper-nav">
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon rounded-3">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">1</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2"> Register </h3>
                                        <div class="stepper-desc fw-normal"> Select your account </div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px">
                                </div>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">2</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2">
                                            Personalize
                                        </h3>
                                        <div class="stepper-desc fw-normal">
                                            Setup your personal details
                                        </div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px">
                                </div>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="stepper-check fas fa-check"></i>
                                        <span class="stepper-number">3</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title ">
                                            Completed
                                        </h3>
                                        <div class="stepper-desc fw-normal">
                                            Your account is created
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-650px w-xl-700px p-10 p-lg-15 mx-auto">
                    @if(session('success'))
                        <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
                            <div class="alert-icon"><i class="flaticon2-checkmark"></i></div>
                            <div class="alert-text">{{ session('success') }}</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                </button>
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
                                <h4 class="mb-1 text-danger">Incorrect Email Address</h4>
                                <span>{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif
                        <form class="my-auto pb-5" novalidate="novalidate" id="kt_create_account_form" action="{{ route('registration') }}" method="POST">
                            <!--begin::Step 1-->
                            <div class="current" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-15">
                                        <div class="text-center mb-11">
                                            <h1 class="text-dark fw-bolder mb-3"> Sign Up </h1>
                                            <div class="text-gray-500 fw-semibold fs-6"> Your Social Campaigns </div>
                                        </div>
                                        <div class="row g-3 mb-9">
                                            <div class="col-md-6">
                                                <a href="{{ route('signupRedirectToGoogle') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                                    <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3" /> Sign in with Google
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                                    <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/facebook-4.svg') }}" class="theme-light-show h-15px me-3" />
                                                    <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/facebook-4.svg') }}" class="theme-dark-show h-15px me-3" /> Sign in with Facebook
                                                </a>
                                            </div>
                                        </div>
                                        <div class="separator separator-content my-14">
                                            <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                                            @csrf
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="email" placeholder="{{ __('Email Address') }}" name="email" id="email" autocomplete="off" class="form-control bg-transparent" value="{{ old('email') }}" required/>
                                        </div>
                                        <div class="fv-row mb-8">
                                            <input type="password" placeholder="{{ __('Password') }}" name="password" id="password" autocomplete="off" class="form-control bg-transparent" required/>
                                        </div>
                                        <div class="fv-row mb-3">
                                            <input type="password" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" id="password_confirmation" autocomplete="off" class="form-control bg-transparent" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Step 1-->

                            <!--begin::Step 2-->
                            <div class="" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-10 pb-lg-12">
                                        <h2 class="fw-bold text-dark">Personal Details</h2>
                                        <div class="text-muted fw-semibold fs-6"> Add the details for signup    . </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-xl-6">
                                            <label class="form-label required">First Name</label>
                                            <input name="first_name" class="form-control form-control-lg form-control-solid" value="{{ old('first_name') }}" id="first_name" placeholder="{{ __('Enter your first name') }}" />
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label required">Last Name</label>
                                            <input name="last_name" class="form-control form-control-lg form-control-solid" value="{{ old('last_name') }}" id="last_name" placeholder="{{ __('Enter your last name') }}" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-xl-6">
                                            <label class="form-label required">Phone</label>
                                            <input name="phone" class="form-control form-control-lg form-control-solid" value="{{ old('phone') }}" id="phone" placeholder="{{ __('Enter your phone no') }}" />
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label required">Date Of Birth</label>
                                            <input type="date" name="dob" class="form-control form-control-lg form-control-solid" value="{{ old('dob') }}" id="dob" />
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-xl-6">
                                            <label class="form-label required">Gender</label>
                                            <select id="gender" name="gender" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label required">Marital Status</label>
                                            <select id="marital_status" name="marital_status" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="married">Married</option>
                                                <option value="unmarried">Unmarried</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row fv-row mb-7">
                                        <div class="col-xl-6">
                                            <label class="form-label required">Retired</label>
                                            <select id="retired" name="retired" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-6">
                                            <label class="form-label required">Joint Profile</label>
                                            <select id="joint_profile" name="joint_profile" class="form-select form-select-lg form-select-solid" data-control="select2" data-placeholder="Select..." data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Step 2-->

                            <!--begin::Step 3-->
                            <div class="" data-kt-stepper-element="content">
                                <div class="w-100">
                                    <div class="pb-8 pb-lg-10">
                                        <h2 class="fw-bold text-dark">Your Are Done!</h2>
                                    </div>
                                    <div class="mb-0">
                                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <div class="d-flex flex-stack flex-grow-1 ">
                                                <div class=" fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">We need your attention!</h4>
                                                    <div class="fs-6 text-gray-700 ">After submitting all the details you need to verify your account, please check your mail and click on the received link for verify the account after click on submit button.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Step 3-->

                            <!--begin::Actions-->
                            <div class="d-flex flex-stack pt-15">
                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="currentColor" />
                                                <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        Previous
                                    </button>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-lg btn-primary" data-kt-stepper-action="submit">
                                        <span class="indicator-label">
                                            Submit
                                            <span class="svg-icon svg-icon-4 ms-2">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="indicator-progress"> Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>

                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                        Continue
                                        <span class="svg-icon svg-icon-4 ms-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="currentColor" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div class="text-muted fw-semibold fs-6 text-end pt-15">
                                Already have an Account? <a href="{{ route('login') }}" class="text-primary fw-bold">Sign In</a>.
                            </div>
                            <!--end::Actions-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-account.js') }}"></script>
</body>
</html>