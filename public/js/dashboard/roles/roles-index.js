/*
* Ing.Charles Rodriguez
*/

function rolesIndex(commonFunctions) {
    var selft = this, select_table_roles;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.common_dashboard();
    },
        this.component_init = function () {

            /* DataTable Roles */
            let table_roles = $('#table_roles').DataTable({
                "processing": false,
                "serverSide": true,
                "responsive": {
                    "details": {
                        "display": $.fn.dataTable.Responsive.display.modal({
                            "header": function (row) {
                                let data = row.data();
                                return data.name;
                            }
                        }),
                        "renderer": $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                "sPaginationType": "full_numbers",
                'autoWidth': false,
                'select': true,
                'language': datatables_language,
                'bLengthChange': false,
                'lengthChange': false,
                'pageLength': 1,
                'sDom': '<"toolbar col-xs-12 col-md-6 row margin-top-14">frtip',
                'ajax': {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    'url': base_url + '/getUsersWithRoles',
                    'type': 'POST'
                },
                columnDefs: [{ targets: [], visible: false }, {
                    'bSortable': false,
                    'aTargets': '_all'
                }, { responsivePriority: 1, targets: [0, 3] }],
                'columns': [
                    { 'data': 'id', 'className': 'font-weight-bold align-middle', 'width': '15px', 'defaultContent': '' },
                    { 'data': 'name', 'className': 'align-middle', 'defaultContent': '' },
                    { 'data': 'created_at', 'className': 'align-middle', 'width': '100px', 'defaultContent': '' },
                    { 'data': 'action', 'className': 'text-right align-middle', 'width': '15px', 'defaultContent': '' },
                ]
            });
            table_roles
                .on('select', function (e, dt, type, indexes) {
                    var rowData = table_roles.rows(indexes).data().toArray();
                    select_table_roles = rowData[0];
                });
            /* Fin de DataTable Roles */

        }
    /* Funciones Locales */
}

$(function () {
    var roles_index = new rolesIndex(new commonFunctions());
    roles_index.constructor();
});
