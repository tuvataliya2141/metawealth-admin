"use strict";

// Class definition
var KTUsersAddSchedule = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_income');
    const form = element.querySelector('#kt_modal_add_income_form');
    const modal = new bootstrap.Modal(element);
    const siteUrl = $('meta[name="site-url"]').attr('content');
    var table;
    
    // Init add schedule modal
    var initAddSchedule = () => {       
        
        // Init flatpickr -- for more info: https://flatpickr.js.org/       
        new tempusDominus.TempusDominus(document.getElementById("kt_modal_add_income_datepicker"), {
            display: {
                viewMode: "years",
                components: {
                    decades: false,
                    year: true,
                    month: false,
                    date: false,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            }
        });

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		var validator = FormValidation.formValidation(
			form,
			{
				fields: {
                    'income_name': {
						validators: {
							notEmpty: {
								message: 'Income name is required'
							}
						}
					},
                    'income_amount': {
						validators: {
							notEmpty: {
								message: 'Income amount is required'
							}
						}
					},
					'income_year': {
						validators: {
							notEmpty: {
								message: 'Income year is required'
							}
						}
					},
                    'total_wealth': {
						validators: {
							notEmpty: {
								message: 'Total Wealth is required'
							}
						}
					},					
                    'age': {
						validators: {
							notEmpty: {
								message: 'Age is required'
							}
						}
					},
                    'rate_return': {
						validators: {
							notEmpty: {
								message: 'Rate Return is required'
							}
						}
					},					
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
        $(form.querySelector('[name="event_invitees"]')).on('change', function () {
            // Revalidate the field when an option is chosen
            validator.revalidateField('event_invitees');
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
        closeButton.addEventListener('click', e => {
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
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
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
        });

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
		submitButton.addEventListener('click', function (e) {
			// Prevent default button action
			e.preventDefault();

			// Validate form before submit
			if (validator) {
				validator.validate().then(function (status) {
					if (status == 'Valid') {
						// Show loading indication
						submitButton.setAttribute('data-kt-indicator', 'on');

						// Disable button to avoid multiple click 
						submitButton.disabled = true;

                        var userId = $('.user_id').val();
                        var wealthManagementId = $(".wealth_management_id").val();
                        var incomeName = $('.income_name').val();
                        var incomeAmount = $('.income_amount').val();
                        var incomeYear = $('.income_year').val();
                        var totalWealth = $('.total_wealth').val();
                        var age = $('.age').val();
                        var rateReturn = $('.rate_return').val();

                        const data = {user_id: userId, wealth_management_id: wealthManagementId, income_name: incomeName, income_amount: incomeAmount, income_year: incomeYear, total_wealth: totalWealth, age: age, rate_return: rateReturn};

                        setTimeout(function() {
                            $.ajax({
                                headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url : siteUrl+"clients/addClientsIncome",
                                type : 'post',
                                data : data,
                                dataType : 'json',
                                success : function(result){
                                    if(result == 1) {
                                        // Remove loading indication
                                        submitButton.removeAttribute('data-kt-indicator');
            
                                        // Enable button
                                        submitButton.disabled = false;
                                        
                                        // Show popup confirmation 
                                        Swal.fire({
                                            text: "Form has been successfully submitted!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                modal.hide();
                                                location.reload();
                                            }
                                        });
                                    }     
                                }
                            });
                        }, 2000);
					} else {
						// Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
    }

    var handleEditRows = () => {
        const editButtons = table.querySelectorAll('[data-kt-wealthIncome-filter="edit_row"]');

        editButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const clientWealthId = d.getAttribute('data-id');

                const parent = e.target.closest('tr');
                const productName = parent.querySelector('[data-kt-wealthIncome-filter="product_name"]').innerText;
                Swal.fire({
                    html: "Are you sure you want to edit <b>" + productName + "</b>?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, edit!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : siteUrl+"clients/editClientsIncome/"+clientWealthId,
                            type : 'get',
                            dataType : 'json',
                            success : function(result){
                                $(".wealth_management_id").val(clientWealthId);
                                $('.income_name').val(result.data.income_name).trigger('change');
                                $('.income_amount').val(result.data.income_budget);
                                $('.income_year').val(result.data.income_year);
                                $('.total_wealth').val(result.data.total_wealth);
                                $('.age').val(result.data.age);
                                $('.rate_return').val(result.data.rate_return);
                                modal.show();
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: productName + " was not edited.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    var handleDeleteRows = () => {
        const deleteButtons = table.querySelectorAll('[data-kt-wealthIncome-filter="delete_row"]');

        deleteButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = e.target.closest('tr');
                const productName = parent.querySelector('[data-kt-wealthIncome-filter="product_name"]').innerText;
                const clientId = d.getAttribute('data-id');
                Swal.fire({
                    html: "Are you sure you want to delete <b>" + productName + "</b>?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url : siteUrl+"clients/delete-clientIncome/"+clientId,
                            type : 'get',
                            dataType : 'json',
                            success : function(result){
                                Swal.fire({
                                    text: "You have deleted " + productName + "!.",
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
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: productName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    return {
        // Public functions
        init: function () {
            table = document.querySelector('#kt_table_clients_incomes');
            if (!table) {
                return;
            }
            initAddSchedule();
            handleEditRows();
            handleDeleteRows();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddSchedule.init();
});