"use strict";

// Class definition
var KTModalCustomersAdd = function () {
    var submitButton;
    var cancelButton;
	var closeButton;
    var validator;
    var form;
    var modal;
    const siteUrl = $('meta[name="site-url"]').attr('content');

    // Init form inputs
    var handleForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		validator = FormValidation.formValidation(
			form,
			{
				fields: {
					'advisor': {
						validators: {
							notEmpty: {
								message: 'Advisor is required'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap5({
						rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
					})
				}
			}
		);

		// Revalidate country field. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="advisor"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validator.revalidateField('advisor');
        });

		// Action buttons
		submitButton.addEventListener('click', function (e) {
			e.preventDefault();

			// Validate form before submit
			if (validator) {
				validator.validate().then(function (status) {
					console.log('validated!');

					if (status == 'Valid') {
						submitButton.setAttribute('data-kt-indicator', 'on');
                        const advisorName = $('#advisor_name').val();
                        const userName = $('#client_id').attr('data-name');

                        var advisorId = $('#selectAdvisor').val();
                        var clientId = $('#client_id').val();
                        console.log($('meta[name="csrf-token"]').attr('content'));
						// Disable submit button whilst loading
						submitButton.disabled = true;

                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : siteUrl+"advisors/assign-advisor",
                            data : {client_id: clientId, advisor_id: advisorId},
                            type : 'post',
                            dataType : 'json',
                            success : function(result){
                                if(result['success'] == true) {
                                    Swal.fire({
                                        html: "You have assigned <b>" + advisorName + "</b> to <b>" + userName + "</b>.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function () {
                                        modal.hide();
                                        submitButton.disabled = false;
                                        location.reload();
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
                                        modal.hide();
                                        submitButton.disabled = false;
                                    });
                                }
                            }
                        });
					} else {
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
			}
		});

        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide(); // Hide modal
                    $('#client_id').val('');
                    $('#client_id').attr('data-name', '');
                    $('#advisor_name').val('');
                    $('#selectAdvisor').val('').trigger("change");

                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

		closeButton.addEventListener('click', function(e){
			e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
		})
    }

    return {
        // Public functions
        init: function () {
            // Elements
            modal = new bootstrap.Modal(document.querySelector('#kt_modal_assign_advisor'));

            form = document.querySelector('#kt_modal_assign_advisor_form');
            submitButton = form.querySelector('#kt_modal_assign_advisor_submit');
            cancelButton = form.querySelector('#kt_modal_assign_advisor_cancel');
			closeButton = form.querySelector('#kt_modal_assign_advisor_close');

            handleForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
	KTModalCustomersAdd.init();
});


$('#selectAdvisor').change(function(){
    $('#advisor_name').val($("#selectAdvisor option:selected").attr('data-name'));
});