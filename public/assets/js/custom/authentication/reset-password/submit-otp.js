"use strict";

// Class Definition
var KTAuthSubmitOtp = function() {
    // Elements
    var form;
    var submitButton;
    var resendCode;
	var validator;
    const siteUrl = $('meta[name="site-url"]').attr('content');

    var handleForm = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
			form,
			{
				fields: {					
					'otp': {
                        validators: {
							notEmpty: {
								message: 'OTP is required'
							}
						}
					} 
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
						eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
				}
			}
		);		

        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading indication
                    submitButton.setAttribute('data-kt-indicator', 'on');

                    // Disable button to avoid multiple click 
                    submitButton.disabled = true;

                    // Simulate ajax request
                    setTimeout(function() {
                        var emailId = $('#verifiedMailId').val();
                        var otp = $('#otp').val();

                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : siteUrl+"password/reset/verify-otp",
                            data : {email: emailId, otp: otp},
                            type : 'post',
                            dataType : 'json',
                            success : function(result){
                                if(result['success'] == true) {
                                    Swal.fire({
                                        html: "OTP verified successfully, Please crete new password.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        submitButton.removeAttribute('data-kt-indicator');                
                                        submitButton.disabled = false;
                                        $("#finalEmailID").val(emailId);
                                        $("#kt_password_reset_form").addClass('d-none');
                                        $("#kt_submit_otp_form").addClass('d-none');
                                        $("#kt_new_password_form").removeClass('d-none');
                                    });
                                } else if(result['success'] == false) {
                                    Swal.fire({
                                        text: result['message'],
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function(){
                                        submitButton.removeAttribute('data-kt-indicator');                
                                        submitButton.disabled = false;
                                        $('#otp').val('');
                                    });
                                }
                            }
                        });
                    }, 1500);   						
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });  
		});

        resendCode.addEventListener('click', function (e) {
            e.preventDefault();

            // Show loading indication
            resendCode.setAttribute('data-kt-indicator', 'on');

            // Disable button to avoid multiple click 
            resendCode.disabled = true;

            // Simulate ajax request
            setTimeout(function() {
                var emailId = $('#verifiedMailId').val();
                var otp = $('#otp').val();

                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url : siteUrl+"password/reset/reset-password",
                    data : {email: emailId, otp: otp},
                    type : 'post',
                    dataType : 'json',
                    success : function(result){
                        if(result['success'] == true) {
                            Swal.fire({
                                html: "We have send a password reset link to your email.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function () {
                                resendCode.removeAttribute('data-kt-indicator');                
                                resendCode.disabled = false;
                            });
                        } else if(result['success'] == false) {
                            Swal.fire({
                                text: result['message'],
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function(){
                                resendCode.removeAttribute('data-kt-indicator');                
                                resendCode.disabled = false;
                            });
                        }
                    }
                });
            }, 1500);
		});
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            form = document.querySelector('#kt_submit_otp_form');
            submitButton = document.querySelector('#kt_submit_otp_submit');
            resendCode = document.querySelector('#kt_resend_otp_submit');

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTAuthSubmitOtp.init();
});
