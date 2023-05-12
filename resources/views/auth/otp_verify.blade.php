<!DOCTYPE html>
<html lang="en" >    
    <head>
        <title>Metawealth - Verify Account</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>      
        <meta property="og:locale" content="en_US" />
        <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.png') }}"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    </head>
    <body  id="kt_body"  class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat" >
        <div class="d-flex flex-column flex-root" id="kt_app_root">    
            <style>
                body {
                    background-image: url("{{ asset('assets/media/auth/bg5.jpg') }}");
                }
            </style>
            <div class="d-flex flex-column flex-center flex-column-fluid">            
                <div class="d-flex flex-column flex-center text-center p-10">                
                    <div class="card card-flush w-lg-650px py-5">
                        <div class="card-body py-15 py-lg-20">
                            <div class="mb-14">
                                <a href="{{ route('login') }}" class="">
                                    <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-40px" />
                                </a>
                            </div>
                            <h1 class="fw-bolder text-gray-900 mb-5">
                                Verify your Login
                            </h1>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger"><span>{{ session('error') }}</span></h4>
                            </div>
                            <div class="d-flex flex-center flex-column-fluid">
                                <form class="form" method="POST" action="{{ route('otpCheck') }}" style="width: 70%">
                                    @csrf
                                    <div class="fv-row mb-8">
                                        <input type="text" maxlength="4" placeholder="{{ __('Enter OTP') }}" name="otp" autocomplete="off" class="form-control bg-transparent" required/>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                                    <div class="d-grid mb-10">
                                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                                            <span class="indicator-label">{{ __('CONFIRM') }}</span>
                                            <span class="indicator-progress">
                                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="fs-6 mb-8">
                                <span class="fw-semibold text-gray-500">Didn't received an email?</span>
                                <a class="link-primary fw-bold" href="{{ route('otpResendEmail') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('resend-email-form').submit();">
                                        {{ __('OTP Resend') }}
                                </a>

                                <form id="resend-email-form" action="{{ route('otpResendEmail') }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $user['id'] }}">
                                    <input type="hidden" name="email" value="{{ $user['email'] }}">
                                </form>
                            </div>
                            <div class="mb-0">
                                <img src="{{ asset('assets/media/auth/please-verify-your-email.png') }}" class="mw-100 mh-300px theme-light-show" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function clickEvent(first,last){
                if(first.value.length){
                    document.getElementById(last).focus();
                }
            }
        </script>
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    </body>
</html>