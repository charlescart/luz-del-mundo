/*
* Ing.Charles Rodriguez
*/

function rolesEdit(commonFunctions) {
    var selft = this;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
    },
        this.component_init = function () {

            /* Config. de input material*/
            commonFunctions.config_input_material();
            /* Fin de config. de input material*/

            /* Funcion que inicializa DataTables de permisos de un determinado rol */
                table_permissions = $('#table_permissions').DataTable({
                    "processing": false,
                    "serverSide": true,
                    "responsive": true,
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
                            if ($('#table_permissions_filter [type="search"]').val() == '')
                                commonFunctions.lock();
                        },
                        url: base_url + '/getPermissionsOfARol',
                        data: function (d) {
                            d.id = $('#form-roles-edit').data('id');
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
                        {'data': 'name', 'className': 'align-middle', 'defaultContent': ''},
                        {'data': 'guard_name', 'className': 'align-middle', 'width': '10px', 'defaultContent': ''},
                        {'data': 'created_at', 'className': 'align-middle', 'width': '100px', 'defaultContent': ''},
                    ]
                });
                table_permissions
                    .on('select', function (e, dt, type, indexes) {
                        var rowData = table_permissions.rows(indexes).data().toArray();
                        select_table_permissions = rowData[0];
                    });
            /* Fin de funcion que inicializa DataTables de permisos de un determinado rol */

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
    var roles_edit = new rolesEdit(new commonFunctions());
    roles_edit.constructor();
});
