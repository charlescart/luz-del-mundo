/*
* Ing.Charles Rodriguez
*/

function assingRoles(commonFunctions) {
    var selft = this, table_users, select_table_users, buttonAction, table_roles;
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
                    details: {
                        display: $.fn.dataTable.Responsive.display.childRow,
                    }
                },
                "sPaginationType": "full_numbers",
                'autoWidth': false,
                'select': true,
                'language': datatables_language,
                'bLengthChange': false,
                'lengthChange': false,
                'pageLength': 10,
                'sDom': 'frtip',
                'ajax': {
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    beforeSend: function () {
                        if ($('#table_users_filter [type="search"]').val() == '')
                            commonFunctions.lock();
                    },
                    url: base_url + '/getGuestUsers',
                    type: 'POST',
                    complete: function () {
                        commonFunctions.unlock();
                    }
                },
                columnDefs: [{ targets: [], visible: false }, {
                    'bSortable': false,
                    'aTargets': '_all'
                }, { responsivePriority: 1, targets: [0, 1, 3] },
                { responsivePriority: 2, targets: [2, 4] }],
                'columns': [
                    { 'data': 'id', 'className': 'font-weight-bold align-middle', 'width': '15px', 'defaultContent': '' },
                    { 'data': 'email', 'className': 'align-middle', 'defaultContent': '' },
                    { 'data': 'name', 'className': 'align-middle', 'defaultContent': '' },
                    { 'data': 'roles_list', 'className': 'align-middle', 'defaultContent': '' },
                    { 'data': 'action', 'className': 'align-middle  align-right', 'width': '15px', 'defaultContent': '' },
                ]
            });
            table_users
                .on('select', function (e, dt, type, indexes) {
                    var rowData = table_users.rows(indexes).data().toArray();
                    select_table_users = rowData[0];
                });
            /* Fin de funcion que inicializa DataTables de usuarios */

            /* Evento show de modal modal-create-guest-user show */
            $('#modal-guest-user').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let modal = $(this);

                /* en este orden estricto  */
                modal.find('.modal-title').text(button.data('title'));
                modal.find('textarea.tag-edit').attr('form', button.data('form'));

                selft.tableRoles();
                modal.find('form').attr('id', button.data('form'));
                modal.find('input[name="send_email"]').attr('form', button.data('form'));
                modal.find('button[type="submit"]').attr('form', button.data('form'));

                if (button.data('form') == 'form-edit-guest-user') {
                    modal.find('input[name="email"]').val(select_table_users.email);
                    modal.find('input[name="name"]').val(select_table_users.name);
                    $('.tag-edit').tagEditor({ forceLowercase: false, placeholder: assigned_roles,
                        initialTags: select_table_users.roles});
                    modal.find('input[name="send_email"]').prop('checked', false);
                } else
                    $('.tag-edit').tagEditor({ forceLowercase: false, placeholder: assigned_roles });
            });
            /* Fin de evento show de modal modal-create-guest-user show */

            /* Evento hidden de modal modal-create-guest-user */
            $('#modal-guest-user').on('hidden.bs.modal', function (e) {
                let modal = $(this);
                let form = modal.find('form');
                form[0].reset();
                table_roles.destroy();
                commonFunctions.clearAndDestroyTagEditor('.tag-edit');
            });
            /* Fin de evento hidden de modal modal-create-guest-user */

            /* Evento submit de form create guest user */
            $(document).on('submit', '#form-create-guest-user', function (event) {
                event.preventDefault();
                let form = $(this), form_id = this.id, modal = $(this).parents('.modal:first');
                $.ajax({
                    beforeSend: function () {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('start');
                        commonFunctions.lock();
                    },
                    url: base_url + '/guest-user',
                    type: 'POST',
                    data: form.serialize()
                })
                    .done(function (data) {
                        if (data.success) {
                            table_users.ajax.reload();
                            modal.modal('hide');
                            form[0].reset();
                        }
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
            /* Fin de submit de form create guest user */

            /* Evento submit de form edit guest user */
            $(document).on('submit', '#form-edit-guest-user', function (event) {
                event.preventDefault();
                let form = $(this), form_id = this.id, modal = $(this).parents('.modal:first');
                $.ajax({
                    beforeSend: function () {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('start');
                        commonFunctions.lock();
                    },
                    url: base_url + '/guest-user/'+select_table_users.id,
                    type: 'PUT',
                    data: form.serialize()
                })
                    .done(function (data) {
                        if (data.success) {
                            table_users.ajax.reload();
                            modal.modal('hide');
                            form[0].reset();
                        }
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
            /* Fin de submit de form edit guest user */


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
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    beforeSend: function () {
                        if ($('table_roles_filter [type="search"]').val() == '')
                            commonFunctions.lock();
                    },
                    url: base_url + '/getRolesForGuestUser',
                    type: 'POST',
                    complete: function (data) {
                        // data = data.responseJSON;
                        /*if(data.hasOwnProperty('assigned_roles'))
                            for (i = 0; i < data.assigned_roles.length; i++) {
                                $('#tag-editor-roles').tagEditor('addTag', data.assigned_roles[i]);
                            }
                        else {
                            msg(-8, time_toast);
                            $('#modal-manage-roles').modal('hide');
                        }*/
                        commonFunctions.unlock();
                    }
                },
                columnDefs: [{ targets: [], visible: false }, { 'bSortable': false, 'aTargets': '_all' },
                { responsivePriority: 1, targets: [0] }],
                'columns': [{ 'data': 'name', 'className': 'text-nowrap align-middle', 'defaultContent': '' }]
            });
            table_roles
                .on('select', function (e, dt, type, indexes) {
                    var rowData = table_roles.rows(indexes).data().toArray();
                    select_table_roles = rowData[0];
                    $('.tag-edit').tagEditor('addTag', rowData[0].name, true);
                });
            /* Fin de funcion que inicializa DataTables de roles */

            /* Ajuste de estilos a paginacion */
            $('#table_roles_paginate').addClass('paginate-center-force');
            $('#tabler_roles_info').addClass('text-info-center-force');
            /* Ajuste de estilos a paginacion */
        },
        this.clearAndDestroyTagEditor = function (dial) {
            /* dial: variable de tipo string que contiene el selector, sea id o clase */
            let tags = $(dial).tagEditor('getTags')[0].tags;
            for (i = 0; i < tags.length; i++) { $(dial).tagEditor('removeTag', tags[i]); }
            $(dial).tagEditor('destroy');
        },
        this.loadFormEdit = function (form) {
            if (select_table_users.hasOwnProperty('roles')) {
                for (i = 0; i < select_table_users.roles.length; i++) {
                    $('.tag-edit').tagEditor('addTag', select_table_users.roles[i], true);
                }
            } else {
                msg(-8, time_toast);
                $('#modal-guest-user').modal('hide');
            }
        }
}

$(function () {
    var assing_roles = new assingRoles(new commonFunctions());
    assing_roles.constructor();
});
