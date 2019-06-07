/*
* Ing.Charles Rodriguez
*/

function assingRoles(commonFunctions) {
    var selft = this, table_users, select_table_users, table_roles, select_table_roles, select_user = false;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.common_dashboard();
        commonFunctions.common_events();
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
                        {'data': 'email_verified_at', 'className': 'align-middle', 'width': '15px', 'defaultContent': ''},
                        {'data': 'created_at', 'className': 'align-middle', 'width': '100px', 'defaultContent': ''},
                        {'data': 'action', 'className': 'align-right', 'width': '15px', 'defaultContent': ''},
                    ]
                });
                table_users
                    .on('select', function (e, dt, type, indexes) {
                        var rowData = table_users.rows(indexes).data().toArray();
                        select_table_users = rowData[0];
                    });
            /* Fin de funcion que inicializa DataTables de usuarios */

            /* Evento show de modal invite-role show */
            $('#modal-manage-roles').on('show.bs.modal', function (event) {
                selft.tableRoles();
                $('#tag-editor-roles').tagEditor({ forceLowercase: false, placeholder: assigned_roles });
                $('span.name-user').html('<i class="fa fa-user" aria-hidden="true"></i> '+
                    select_table_users.name+' ('+select_table_users.email+')');
            });
            /* Fin de evento show de modal invite-role show */

            /* Evento hidden de modal invite-role */
            $('#modal-manage-roles').on('hidden.bs.modal', function (e) {
                table_roles.destroy();
                selft.clearAndDestroyTagEditor('#tag-editor-roles');
            });
            /* Fin de evento hidden de modal invite-role */

            /* Evento submit de form add permission */
            $(document).on('submit', '#form-manage-roles', function (event) {
                event.preventDefault();
                let form = $(this), form_id = this.id, modal = $(this).parents('.modal:first');
                $(this).children('input[type="hidden"][name="user_id"]:first').val(select_table_users.id);
                $.ajax({
                    beforeSend: function () {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('start');
                        commonFunctions.lock();
                    },
                    url: base_url + '/assingRolesForUser',
                    type: 'POST',
                    data: form.serialize()
                })
                    .done(function (data) {
                        if (data.success) {
                            modal.modal('hide');
                            form[0].reset();
                            msg(data.msg, time_toast);
                        } else
                            msg(data.msg);
                    })
                    .fail(function (data) {
                        commonFunctions.apply_error_menssages(data, form_id, true);
                    })
                    .always(function (data) {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('stop');
                        commonFunctions.unlock();
                    });
            });
            /* Fin de submit de form add permission */

            // $('.toolbar').prepend('<button type="button" class="btn btn-outline-primary btn-sm float-md-left mt-md-2 rounded-0">Add permissions</button>');
        },
    /* Funciones Locales */
    this.tableRoles = function () {
        /* Funcion que inicializa DataTables de Roles */
        table_roles = $('#table_roles').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "sPaginationType": "full_numbers",
            'autoWidth': false,
            'select': true,
            'language': datatables_language,
            'bLengthChange': false,
            'lengthChange': false,
            'pageLength': 5,
            'sDom': 'frtp', /* Falta la "i", de informacion */
            'ajax': {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    if ($('#table_roles_filter [type="search"]').val() == '')
                        commonFunctions.lock();
                },
                url: base_url + '/getRolesForAssingRole',
                data: function (d) {
                    d.user_id = select_table_users.id;
                },
                type: 'POST',
                complete: function (data) {
                    data = data.responseJSON;
                    for (i = 0; i < data.assigned_roles.length; i++) {
                        $('#tag-editor-roles').tagEditor('addTag', data.assigned_roles[i]);
                    }
                    commonFunctions.unlock();
                }
            },
            columnDefs: [{targets: [], visible: false}, { 'bSortable': false, 'aTargets': '_all' },
                {responsivePriority: 1, targets: [0]}],
            'columns': [{'data': 'name', 'className': 'text-nowrap align-middle', 'defaultContent': ''}]
        });
        table_roles
            .on('select', function (e, dt, type, indexes) {
                var rowData = table_roles.rows(indexes).data().toArray();
                select_table_roles = rowData[0];
                $('#tag-editor-roles').tagEditor('addTag', rowData[0].name);
            });
        /* Fin de funcion que inicializa DataTables de roles */

        /* Ajuste de estilos a paginacion */
        $('#table_roles_paginate').addClass('paginate-center-force');
        $('#table_roles_info').addClass('text-info-center-force');
        /* Ajuste de estilos a paginacion */
    },
        this.clearAndDestroyTagEditor = function(dial) {
            /* dial: variable de tipo string que contiene el selector, sea id o clase */
            let tags = $(dial).tagEditor('getTags')[0].tags;
            for (i = 0; i < tags.length; i++) { $(dial).tagEditor('removeTag', tags[i]); }
            $(dial).tagEditor('destroy');
        }
}

$(function () {
    var assing_roles = new assingRoles(new commonFunctions());
    assing_roles.constructor();
});
