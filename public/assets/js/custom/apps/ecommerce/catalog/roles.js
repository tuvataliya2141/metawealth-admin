"use strict";

var KTAppClients = function () {
    var table;
    var datatable;

    var initDatatable = function () {
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
                { orderable: false, targets: 0 },
                { orderable: false, targets: 1 },
            ]
        });
    }

    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-ecommerce-product-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    var handleStatusFilter = () => {
        const filterStatus = document.querySelector('[data-kt-ecommerce-product-filter="status"]');
        $(filterStatus).on('change', e => {
            let value = e.target.value;
            if(value === 'all'){
                value = '';
            }
            datatable.columns().search(value).draw();
        });
    }

    return {
        init: function () {
            table = document.querySelector('#kt_roles_table');
            if (!table) {
                return;
            }
            initDatatable();
            handleSearchDatatable();
            handleStatusFilter();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAppClients.init();
});
