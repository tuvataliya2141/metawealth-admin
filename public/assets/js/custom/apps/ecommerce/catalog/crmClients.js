"use strict";

var KTAppCrmClients = function () {
    var table;
    var datatable;

    var initDatatable = function () {
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
                { orderable: false, targets: 10 },
            ]
        });

        datatable.on('draw', function () {
            handleDeleteRows();
        });
    }

    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-crm-client-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    var handleStatusFilter = () => {
        const filterStatus = document.querySelector('[data-kt-crm-client-filter="status"]');
        $(filterStatus).on('change', e => {
            let value = e.target.value;
            if(value === 'all'){
                value = '';
            }
            datatable.columns().search(value).draw();
        });
    }

    var handleDeleteRows = () => {
        const deleteButtons = table.querySelectorAll('[data-kt-crm-client-filter="delete_row"]');

        deleteButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();
                const parent = e.target.closest('tr');
                const productName = parent.querySelector('[data-kt-crm-client-filter="product_name"]').innerText;
                const clientId = d.getAttribute('data-client-id');
                Swal.fire({
                    html: "Are you sure you want to delete <strong>" + productName + "</strong>?",
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
                            url : "delete-crm-client/"+clientId,
                            type : 'get',
                            dataType : 'json',
                            success : function(result){
                                Swal.fire({
                                    html: "You have deleted <strong>" + productName + "</strong>!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    datatable.row($(parent)).remove().draw();
                                });
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            html: "<strong>" + productName + "</strong> was not deleted.",
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
        init: function () {
            table = document.querySelector('#kt_crm_clients_table');
            if (!table) {
                return;
            }
            initDatatable();
            handleSearchDatatable();
            handleStatusFilter();
            handleDeleteRows();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAppCrmClients.init();
});
