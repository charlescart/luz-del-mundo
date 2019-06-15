/*
* Ing.Charles Rodriguez
*/

function financesIndex(commonFunctions) {
    var selft = this, select_table_finance;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.common_dashboard();
        commonFunctions.common_events();
    },
        this.component_init = function () {
            /*Inicializando los tooltips*/
            $('[data-toggle="tooltip"]').tooltip();

            /* DataTable Finances */
            let table_finance = $('#table_finance').DataTable({
                "formatNumber": function ( toFormat ) {
                    return toFormat.toString().replace(
                        /\B(?=(\d{3})+(?!\d))/g, "'"
                    );
                },
                "processing": true,
                "serverSide": true,
                "responsive": {
                    "details": {
                        "display": $.fn.dataTable.Responsive.display.modal({
                            "header": function (row) {
                                let data = row.data();
                                return data.amount;
                            }
                        }),
                        "renderer": $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
                "sPaginationType": "full_numbers",
                'autoWidth': true,
                'select': true,
                'language': datatables_language,
                'bLengthChange': false,
                'lengthChange': false,
                'pageLength': 10,
                'sDom': '<"toolbar col-xs-12 col-md-6 row margin-top-14">frtip',
                'ajax': {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    beforeSend: function () {
                        if ($('#table_finance_filter [type="search"]').val() == '')
                            commonFunctions.lock();
                    },
                    url: base_url + '/getFinancesForUser',
                    type: 'POST',
                    complete: function (data) {
                        commonFunctions.unlock();
                        console.log(data);
                    }
                },
                columnDefs: [{targets: [], visible: false}, {
                    'bSortable': false,
                    'aTargets': '_all'
                }, {responsivePriority: 1, targets: [0, 1, 4]},
                    {responsivePriority: 2, targets: [1]},
                    {responsivePriority: 3, targets: [6]}],
                'columns': [
                    {'data': 'id', 'className': 'font-weight-bold align-middle', 'width': '15px', 'defaultContent': ''},
                    {'data': 'amount', 'className': 'align-middle text-nowrap', 'width': '20px', 'defaultContent': ''},
                    {'data': 'tithe', 'className': 'align-middle', 'width': '10px', 'defaultContent': ''},
                    {'data': 'debt', 'className': 'align-middle text-nowrap', 'width': '20px', 'defaultContent': ''},
                    {'data': 'type', 'className': 'align-middle','width': '20px', 'defaultContent': ''},
                    {'data': 'created_at', 'className': 'align-middle text-center text-nowrap', 'width': '75px', 'defaultContent': ''},
                    {'data': 'description', 'className': 'align-middle text-justify', 'defaultContent': ''},
                    {'data': 'action', 'className': 'text-right align-middle', 'width': '15px', 'defaultContent': ''},
                ]
            });
            table_finance
                .on('select', function (e, dt, type, indexes) {
                    var rowData = table_finance.rows(indexes).data().toArray();
                    select_table_finance = rowData[0];
                    // console.table(select_table_finance);
                });
            /* Fin de DataTable Roles */

            /* Config. de input material*/
            commonFunctions.config_input_material();
            /* Fin de config. de input material*/

            /* Evento show de modal roles create */
            $('#modal-finances-create').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let form = button.data('form');
                let title = button.data('title');
                let modal = $(this);
                modal.find('form').attr('id', form);
                modal.find('.modal-title').text(title);
                modal.find('.btn-finances-save').attr('form', form);
            });
            /* Fin de evento show de modal roles create */

            /*Validaciones de clasificacion de finanzas*/
            $("#finance_classification_id").on('change', function (event) {
                let select = $(event.relatedTarget);

                if($(this).val() == 3 || $(this).val() == 4) {
                    if($(this).val() == 3) {
                        $(".content-debit-to").addClass('d-block');
                        $('input[name="debt"]').prop('disabled', true);
                    } else {
                        $(".content-debit-to").removeClass('d-block');
                        $('input[name="debt"]').prop('disabled', true);
                    }

                    $('#tithe_not').prop("checked", true);
                    $('#fifth_part_not').prop("checked", true);
                } else {
                    $(".content-debit-to").removeClass('d-block');
                    $('#tithe_yes').prop("checked", true);
                    $('#fifth_part_not').prop("checked", true);
                    $('input[name="debt"]').prop('disabled', false);
                }

                if($(this).val() != 3)
                    $('#debit_to').val(0);
            });
            /*Fin de validaciones de clasificacion de finanzas*/

            /*Validacion de input radio tithe*/
            $('input:radio[name="tithe"]').on('change', function(event) {
                /*Si no diezma del ingreso, pues logicamente no pagará quinta parte*/
                if($(this).val() == 0) {
                    if($('input:radio[name=fifth_part]:checked').val() == 1) {
                        $('#fifth_part_not').prop("checked", true);
                        msg(100, time_toast);
                    }
                }
            });
            /*Fin de validacion de input radio tithe*/

            /*Validacion de input radio fifth_part*/
            $('input:radio[name="fifth_part"]').on('change', function(event){
                /*Si pagará quinta parte pues debe decir que diezmará*/
                if($(this).val() == 1) {
                    if($('input:radio[name="tithe"]:checked').val() == 0) {
                        $('#tithe_yes').prop("checked", true);
                        msg(101, time_toast);
                    }
                }
            });
            /*Fin de validacion de input radio fifth_part*/

            /* Evento submit de form roles create */
            $(document).on('submit', '#form-finances-create', function (event) {
                event.preventDefault();
                let form = $(this), form_id = this.id, modal = $(this).parents('.modal:first');
                commonFunctions.clean_error_messages($(this).serializeArray(), this);
                $.ajax({
                    beforeSend: function () {
                        $('#' + modal.attr('id') + ' [type="submit"]').buttonLoader('start');
                        commonFunctions.lock();
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: base_url + '/finances',
                    type: 'POST',
                    data: form.serialize()
                })
                    .done(function (data) {
                        if (data.success) {
                            table_finance.ajax.reload();
                            modal.modal('hide');
                            form[0].reset();
                            $(".content-debit-to").removeClass('d-block');
                            $('input[name="debt"]').prop('disabled', false);
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

            $(document).on('click', '.btn-destroy', function (event) {
                /* Cerrando el modal de Datatables */
                $(this).parents('div.modal:first').modal('hide');
                let btn = this;
                let id = select_table_finance.id;
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
                                url: base_url + '/finances/' + id,
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
                                        table_finance.ajax.reload();
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
    var finances_index = new financesIndex(new commonFunctions());
    finances_index.constructor();
});
