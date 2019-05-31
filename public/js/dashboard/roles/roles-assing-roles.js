/*
* Ing.Charles Rodriguez
*/

function assingRoles(commonFunctions) {
    var selft = this, table_users, select_table_users;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.common_dashboard();
    },
        this.component_init = function () {

            /* Config. de input material*/
            commonFunctions.config_input_material();
            /* Fin de config. de input material*/

            /* Funcion que inicializa DataTables de usuarios */
                table_users = $('#table_users').DataTable({
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
                    'pageLength': 10,
                    'sDom': '<"toolbar col-12 col-sm-5 p-0 text-center text-sm-left">frtip',
                    'ajax': {
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        beforeSend: function () {
                            if ($('#table_users_filter [type="search"]').val() == '')
                                commonFunctions.lock();
                        },
                        url: base_url + '/getUsersForAssingRole',
                        data: function (d) {
                            d.id = 1;
                        },
                        type: 'POST',
                        complete: function () {
                            commonFunctions.unlock();
                        }
                    },
                    columnDefs: [{targets: [], visible: false}, {
                        'bSortable': false,
                        'aTargets': '_all'
                    }, {responsivePriority: 1, targets: [0, 1]},
                        {responsivePriority: 2, targets: [2, 3]}],
                    'columns': [
                        {'data': 'id', 'className': 'font-weight-bold align-middle', 'width': '15px', 'defaultContent': ''},
                        {'data': 'name', 'className': 'text-nowrap align-middle', 'defaultContent': ''},
                        {'data': 'email', 'className': 'align-middle', 'defaultContent': ''},
                        {'data': 'email_verified_at', 'className': 'align-middle', 'width': '100px', 'defaultContent': ''},
                        {'data': 'created_at', 'className': 'align-middle', 'width': '15px', 'defaultContent': ''},
                        {'data': 'action', 'className': 'align-right', 'width': '15px', 'defaultContent': ''},
                    ]
                });
                table_users
                    .on('select', function (e, dt, type, indexes) {
                        var rowData = table_users.rows(indexes).data().toArray();
                        select_table_users = rowData[0];
                    });
            /* Fin de funcion que inicializa DataTables de usuarios */

            /* Evento submit de form add permission */
            $(document).on('submit', '#form-add-permission', function (event) {
                event.preventDefault();
                let form = $(this), form_id = this.id, modal = $(this).parents('.modal:first');
                $.ajax({
                    beforeSend: function () {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('start');
                        commonFunctions.lock();
                    },
                    url: base_url + '/addPermissionToARole',
                    type: 'POST',
                    data: form.serialize()
                })
                    .done(function (data) {
                        if (data.success) {
                            table_permissions.ajax.reload();
                            form[0].reset();
                            modal.modal('hide');
                            msg(data.msg, time_toast);
                        } else
                            msg(data.msg);
                    })
                    .fail(function (data) {
                        commonFunctions.apply_error_menssages(data, form_id);
                    })
                    .always(function (data) {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('stop');
                        commonFunctions.unlock();
                    });
            });
            /*Fin de submit de form add permission */

            // $('.toolbar').prepend('<button type="button" class="btn btn-outline-primary btn-sm float-md-left mt-md-2 rounded-0">Add permissions</button>');
        }
    /* Funciones Locales */
}

$(function () {
    var assing_roles = new assingRoles(new commonFunctions());
    assing_roles.constructor();
});
