/*
* Ing.Charles Rodriguez
*/

function churchesIndex(commonFunctions) {
    var selft = this;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.common_dashboard();
        commonFunctions.common_events();
        commonFunctions.show_flash_message();
    },
        this.component_init = function () {

            /* Config. de input material*/
            commonFunctions.config_input_material();
            /* Fin de config. de input material*/

            /* tooltips de card de iglesia */
            $('[data-toggle="tooltip"]').tooltip();
            /* tooltips de card de iglesia */

            $(document).on('click', '.btn-destroy', function (event) {
                alert('hola');
                /* let btn = this;
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
                                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                                    commonFunctions.lock();
                                    $(btn).buttonLoader('start');
                                },
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                url: base_url + '/finances/' + id,
                                type: 'DELETE',
                                data: { 'id': id }
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

                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }],
                    ],
                    onClosing: function (instance, toast, closedBy) {
                        console.info('Closing | closedBy: ' + closedBy);
                    },
                    onClosed: function (instance, toast, closedBy) {
                        console.info('Closed | closedBy: ' + closedBy);
                    }
                }); */
            });

        },
        /* Funciones Locales */
        this.example_function = function () {
            // code...
        }
}

$(function () {
    var churches_index = new churchesIndex(new commonFunctions());
    churches_index.constructor();
});
