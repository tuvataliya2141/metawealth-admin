<!DOCTYPE html>
<html lang="en">
<head>
    <title>Metawealth - Your wealth, your plans, your way</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="site-url" content="{{ env('APP_URL') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="og:locale" content="en_US" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />
</head>
<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url("{{ asset('assets/media/auth/bg4.jpg') }}");
            }
        </style>
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <a href="{{ route('login') }}" class="mb-7">
                        <img alt="Logo" src="{{ asset('assets/media/logos/white-logo.png') }}" />
                    </a>
                    <h2 class="text-white fw-normal m-0"> Your wealth, your plans, your way </h2>
                </div>
            </div>
            <div class="d-flex flex-center w-lg-50 p-10">
                <div class="card rounded-3 w-md-550px">
                    <div class="card-body d-flex flex-column p-10 p-lg-20 pb-lg-10">                        
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-success">Your account is verified now!</h4>
                                    <span>{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif
                        @error('email')
                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">Incorrect Email Address</h4>
                                    <span>{{ $message }}</span>
                                </div>
                            </div>
                        @enderror
                        <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                            <form class="form w-100" method="POST" id="kt_password_reset_form">
                                @csrf
                                <div class="text-center mb-10">
                                    <h1 class="text-dark fw-bolder mb-3"> Forgot Password ? </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Enter your email to reset your password.
                                    </div>
                                </div>
                                <div class="fv-row mb-8">
                                    <input id="email" type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                </div>
                                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                    <button type="button" id="kt_password_reset_submit" class="btn btn-primary me-4">
                                        <span class="indicator-label"> Submit</span>
                                        <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <a href="#" class="btn btn-light">Cancel</a>
                                </div>
                            </form>
                            <form class="form w-100 d-none" method="POST" id="kt_submit_otp_form">
                                @csrf
                                <div class="text-center mb-10">
                                    <h1 class="text-dark fw-bolder mb-3"> Verify code </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Enter verfication code sent to you at <strong><span id="givenMailID"></span></strong>.
                                    </div>
                                </div>
                                <div class="fv-row mb-8">
                                    <input id="verifiedMailId" type="hidden"/>
                                    <input id="otp" type="text" placeholder="OTP" name="otp" autocomplete="off" class="form-control bg-transparent" value="{{ old('otp') }}" required autofocus/>
                                    <div class="text-gray-500 fw-semibold fs-6 text-end mt-2">
                                        Didn't receive the code ?
                                        <a href="sign-in.html" class="link-primary fw-bold" id="kt_resend_otp_submit">
                                            resend
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                    <button type="button" id="kt_submit_otp_submit" class="btn btn-primary me-4">
                                        <span class="indicator-label"> Submit</span>
                                        <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <a href="#" class="btn btn-light">Cancel</a>
                                </div>
                            </form>
                            <form class="form w-100 d-none" novalidate="novalidate" id="kt_new_password_form">
                                <input type="hidden" id="finalEmailID"/>
                                <div class="text-center mb-10">
                                    <h1 class="text-dark fw-bolder mb-3">
                                        Setup New Password
                                    </h1>
                                    <div class="text-gray-500 fw-semibold fs-6">
                                        Have you already reset the password ?
                                        <a href="sign-in.html" class="link-primary fw-bold">
                                            Sign in
                                        </a>
                                    </div>
                                </div>
                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                    <div class="mb-1">
                                        <div class="position-relative mb-3">
                                            <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" id="password" autocomplete="off" />
                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                <i class="bi bi-eye-slash fs-2"></i>
                                                <i class="bi bi-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"> </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"> </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"> </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                    </div>
                                    <div class="text-muted">
                                        Use 8 or more characters with a mix of letters, numbers & symbols.
                                    </div>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="password" placeholder="Repeat Password" name="confirm-password" autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="button" id="kt_new_password_submit" class="btn btn-primary">
                                        <span class="indicator-label"> Submit</span>
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
        </div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/reset-password/reset-password.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/reset-password/submit-otp.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/reset-password/new-password.js') }}"></script>
</body>
<!--end::Body-->

</html>