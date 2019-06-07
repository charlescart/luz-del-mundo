/*
* Ing.Charles Rodriguez
*/

function rolesIndex(commonFunctions) {
    var selft = this, select_table_roles, table_permissions;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.common_dashboard();
    },
        this.component_init = function () {

            /* DataTable Roles */
            let table_roles = $('#table_roles').DataTable({
                "processing": true,
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
                'sDom': '<"toolbar col-xs-12 col-md-6 row margin-top-14">frtip',
                'ajax': {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend: function () {
                        if ($('#table_roles_filter [type="search"]').val() == '')
                            commonFunctions.lock();
                    },
                    url: base_url + '/getUsersWithRoles',
                    type: 'POST',
                    complete: function () {
                        commonFunctions.unlock();
                    }
                },
                columnDefs: [{targets: [], visible: false}, {
                    'bSortable': false,
                    'aTargets': '_all'
                }, {responsivePriority: 1, targets: [0, 1, 4]},
                    {responsivePriority: 2, targets: [2]}],
                'columns': [
                    {'data': 'id', 'className': 'font-weight-bold align-middle', 'width': '15px', 'defaultContent': ''},
                    {'data': 'name', 'className': 'align-middle', 'defaultContent': ''},
                    {'data': 'created_at', 'className': 'align-middle', 'width': '100px', 'defaultContent': ''},
                    {'data': 'guard_name', 'className': 'align-middle', 'width': '10px', 'defaultContent': ''},
                    {'data': 'action', 'className': 'text-right align-middle', 'width': '15px', 'defaultContent': ''},
                ]
            });
            table_roles
                .on('select', function (e, dt, type, indexes) {
                    var rowData = table_roles.rows(indexes).data().toArray();
                    select_table_roles = rowData[0];
                    console.table(select_table_roles);
                });
            /* Fin de DataTable Roles */

            /* Config. de input material*/
            commonFunctions.config_input_material();
            /* Fin de config. de input material*/

            /* Evento show de modal roles create */
            $('#modal-roles-create').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let form = button.data('form');
                let title = button.data('title');
                let modal = $(this);
                modal.find('form').attr('id', form);
                modal.find('.modal-title').text(title);
                modal.find('.btn-roles-save').attr('form', form);
            });
            /* Fin de evento show de modal roles create */

            /* Evento submit de form roles create */
            $(document).on('submit', '#form-roles-create', function (event) {
                event.preventDefault();
                let form = $(this), form_id = this.id, modal = $(this).parents('.modal:first');
                console.log(modal, modal.attr('id'));
                $.ajax({
                    beforeSend: function () {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('start');
                        commonFunctions.lock();
                    },
                    url: base_url + '/roles',
                    type: 'POST',
                    data: form.serialize()
                })
                    .done(function (data) {
                        if (data.success) {
                            table_roles.ajax.reload();
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
            /*Fin de submit de form roles create*/

            /* Evento show de modal roles show */
            $('#modal-roles-show').on('show.bs.modal', function (event) {
                let modal = $(this);
                modal.find('.modal-title').text(select_table_roles.id + ' ' + select_table_roles.name);
                modal.find('.roles-guard-name').text(select_table_roles.guard_name);
                modal.find('.roles-date').text(select_table_roles.created_at);
                selft.table_permissions();
            });
            /* Fin de evento show de modal roles show */

            /* Evento hidden de modal roles show */
            $('#modal-roles-show').on('hidden.bs.modal', function (e) {
                table_permissions.destroy();
            });
            /* Fin de evento hidden de modal roles show */

            /* Evento doble click de dataTables */
            $('#table_roles').on('dblclick', 'tr', function (event) {
                $('#modal-roles-show').modal('show');
            });
            /* Fin de evento doble click de dataTables */

            /*Evento click de btn show de fila de tabla roles*/
            $(document).on('click', 'tr .btn-show', function (event) {
                $('#modal-roles-show').modal('show');
            });
            /*Fin de evento click de btn show de fila de tabla roles*/

            /*Evento click de btn edit de fila de tabla roles*/
            $(document).on('click', 'tr .btn-edit', function (event) {
                window.location.href = base_url + '/roles/' + select_table_roles.id + '/edit';
            });
            /*Fin de evento click de btn edit de fila de tabla roles*/

            $('#table_roles').on('click', '.btn-destroy', function (event) {
                let btn = this;
                let id = select_table_roles.id;
                iziToast.question({
                    timeout: false,
                    close: false,
                    overlay: true,
                    toastOnce: true,
                    backgroundColor: question_color,
                    id: 'question',
                    message: mensaje_delete,
                    position: 'topRight',
                    // theme: 'dark',
                    buttons: [
                        ['<button><b>' + btn_delete + '</b></button>', function (instance, toast) {
                            $.ajax({
                                beforeSend: function () {
                                    instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                                    commonFunctions.lock();
                                    $(btn).buttonLoader('start');
                                },
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url: base_url + '/roles/' + id,
                                type: 'DELETE',
                                data: {'id': id}
                            })
                                .done(function (data) {
                                })
                                .fail(function (data) {
                                    commonFunctions.show_error_messages(data);
                                })
                                .always(function (data) {
                                    $(btn).buttonLoader('stop');
                                    commonFunctions.unlock();
                                    if (data.success)
                                        table_roles.ajax.reload();
                                    msg(data.msg);
                                });
                        }, true],
                        ['<button>' + btn_cancel + '</button>', function (instance, toast) {

                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        }],
                    ],
                    onClosing: function (instance, toast, closedBy) {
                        console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function (instance, toast, closedBy) {
                        console.info('Closed | closedBy: ' + closedBy);
                    }
                });
            });

        },
        /* Funciones Locales */

        /* Funcion que inicializa DataTables de permisos de un determinado rol */
        this.table_permissions = function () {
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
                'pageLength': 5,
                'sDom': '<"toolbar col-xs-12 col-md-6 row margin-top-14">frtip',
                'ajax': {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend: function () {
                        if ($('#table_permissions_filter [type="search"]').val() == '')
                            commonFunctions.lock();
                    },
                    url: base_url + '/getPermissionsOfARol',
                    data: function (d) {
                        d.id = select_table_roles.id;
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
        }
    /* Fin de funcion que inicializa DataTables de permisos de un determinado rol */
}

$(function () {
    var roles_index = new rolesIndex(new commonFunctions());
    roles_index.constructor();
});
