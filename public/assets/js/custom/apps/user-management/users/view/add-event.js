"use strict";

// Class definition
var KTUsersAddEvents = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_event');
    const form = element.querySelector('#kt_modal_add_event_form');
    const modal = new bootstrap.Modal(element);    
    const siteUrl = $('meta[name="site-url"]').attr('content');
    var table;

    // Init add Events modal
    var initAddEvents = () => {       

        // Init flatpickr -- for more info: https://flatpickr.js.org/       
        new tempusDominus.TempusDominus(document.getElementById("kt_modal_start_datepicker"), {
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
        new tempusDominus.TempusDominus(document.getElementById("kt_modal_end_datepicker"), {
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
                    'event_name': {
						validators: {
							notEmpty: {
								message: 'Event name is required'
							}
						}
					},
                    'event_amount': {
						validators: {
							notEmpty: {
								message: 'Event amount is required'
							}
						}
					},
					'event_start_year': {
						validators: {
							notEmpty: {
								message: 'Event start year is required'
							}
						}
					},
					'event_end_year': {
						validators: {
							notEmpty: {
								message: 'Event end year is required'
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
        const closeButton = element.querySelector('[data-kt-events-modal-action="close"]');
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
        const cancelButton = element.querySelector('[data-kt-events-modal-action="cancel"]');
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
        const submitButton = element.querySelector('[data-kt-events-modal-action="submit"]');
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
                        var wealthManagementId = $(".event_wealth_management_id").val();
                        var eventName = $('.select_event_name').val();
                        var otherEventName = $('.other_event_name').val();
                        var interest = $('.interest').val();
                        var downPayment = $('.down_payment').val();
                        var eventAmount = $('.event_amount').val();
                        var eventStartYear = $('.event_start_year').val();
                        var eventEndYear = $('.event_end_year').val();
                        var totalWealth = $('.total_wealth').val();
                        var age = $('.age').val();
                        var rateReturn = $('.rate_return').val();

                        const data = {
                            user_id: userId,
                            wealth_management_id: wealthManagementId,
                            event_name: eventName,
                            other_event_name: otherEventName,
                            interest: interest,
                            down_payment: downPayment,
                            event_amount: eventAmount,
                            event_start_year: eventStartYear,
                            event_end_year: eventEndYear,
                            total_wealth: totalWealth,
                            age: age,
                            rate_return: rateReturn
                        };

                        setTimeout(function() {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url : siteUrl+"clients/addClientsEvent",
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
        const editButtons = table.querySelectorAll('[data-kt-wealthEvent-filter="edit_row"]');

        editButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const clientWealthId = d.getAttribute('data-id');

                const parent = e.target.closest('tr');
                const productName = parent.querySelector('[data-kt-wealthEvent-filter="product_name"]').innerText;
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
                            url : siteUrl+"clients/editClientsEvent/"+clientWealthId,
                            type : 'get',
                            dataType : 'json',
                            success : function(result){
                                console.log(result.data);
                                $(".event_wealth_management_id").val(clientWealthId);
                                $('.select_event_name').val(result.data.event_name).trigger('change');
                                $('.event_amount').val(result.data.event_budget);
                                $('.event_start_year').val(result.data.event_start_year);
                                $('.event_end_year').val(result.data.event_end_year);
                                $('.total_wealth').val(result.data.total_wealth);
                                $('.age').val(result.data.age);
                                $('.rate_return').val(result.data.rate_return);

                                if(result.data.is_other_event == 1) {
                                    $(".select_event_name").val('other').trigger('change');
                                    $("#addEvent").css('display', 'block');
                                    $(".other_event_name").val(result.data.eventName);
                                } else if(result.data.event_name == 1 || result.data.event_name == 2){
                                    $("#interest").css("display", 'block');
                                    $("#downPayment").css("display", 'block');
                                    $(".interest").val(result.data.interest);
                                    $(".down_payment").val(result.data.down_payment);
                                } else if(result.data.event_name == 3 || result.data.event_name == 4) {
                                    $("#interest").css("display", 'none');
                                    $("#downPayment").css("display", 'none');
                                    $(".interest").val('');
                                    $(".downPayment").val('');
                                }

                                modal.show();
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            html: "<b>" + productName + "</b> was not edited.",
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
        const deleteButtons = table.querySelectorAll('[data-kt-wealthEvent-filter="delete_row"]');

        deleteButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = e.target.closest('tr');
                const productName = parent.querySelector('[data-kt-wealthEvent-filter="product_name"]').innerText;
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
                            url : siteUrl+"clients/delete-clientsEvent/"+clientId,
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
                            html: "<b>" + productName + "</b> was not edited.",
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
            table = document.querySelector('#kt_table_clients_events');
            if (!table) {
                return;
            }
            initAddEvents();
            handleEditRows();
            handleDeleteRows();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddEvents.init();
});

$("#addEvent").css("display", "none");
$("#interest").css("display", 'none');
$("#downPayment").css("display", 'none');

$(".select_event_name").change(function(){
    var eventNameVal = $(this).val();
    if (eventNameVal == 1 || eventNameVal == 2) {
        $("#addEvent").css("display", 'none');
        $("#interest").css("display", 'block');
        $("#downPayment").css("display", 'block');
        $(".other_event_name").val('');
    } else if(eventNameVal == 3 || eventNameVal == 4) {
        $("#addEvent").css("display", 'none');
        $("#interest").css("display", 'none');
        $("#downPayment").css("display", 'none');
        $(".other_event_name").val('');
        $(".interest").val('');
        $(".down_payment").val('');
    } else if (eventNameVal == 'other') {
        $("#addEvent").css("display", 'block');
        $("#interest").css("display", 'block');
        $("#downPayment").css("display", 'block');
        $(".interest").val('');
        $(".down_payment").val('');
    }
});