"use strict";

// Class definition
var KTCustomerViewPaymentTable = function () {

    // Define shared variables
    var datatable;
    var table;
    // var table = document.querySelector('#kt_table_advisors_users');

    var initDatatable = function () {
        datatable = $(table).DataTable({
            // "info": false,
            // 'order': [],
            // 'pageLength': 10,
            // 'columnDefs': [
            //     { orderable: false, targets: 10 },
            // ]
        });
    }

    // Delete customer
    var deleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-users-filter="delete_row"]');
        
        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get customer name
                const invoiceNumber = parent.querySelectorAll('td')[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    html: "Are you sure you want to delete <b>" + invoiceNumber + "</b>?",
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
                            url : "clients/delete-client/"+clientId,
                            type : 'get',
                            dataType : 'json',
                            success : function(result){
                                Swal.fire({
                                    html: "You have deleted <b>" + invoiceNumber + "</b>!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    datatable.row($(parent)).remove().draw();
                                    location.reload();
                                });
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " was not deleted.",
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

    // Public methods
    return {
        init: function () {
            table = document.querySelector('#kt_table_advisors_users');
            if (!table) {
                return;
            }
            deleteRows();
            initDatatable();
        }
        // init: function () {
        //     if (!table) {
        //         return;
        //     }

        //     deleteRows();
        //     initDatatable();
        // }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTCustomerViewPaymentTable.init();
});