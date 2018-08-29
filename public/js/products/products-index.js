/*
* Ing.Charles Rodriguez
*/

function ProductsIndex(commonFunctions) {
    var selft = this, select_table_products;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.show_flash_message();
    },
        this.component_init = function () {

            let table_products = $('#table_products').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": {
                    "details": {
                        "display": $.fn.dataTable.Responsive.display.modal( {
                            "header": function ( row ) {
                                let data = row.data();
                                return 'Details for '+data.id+' '+data.name;
                            }
                        } ),
                        "renderer": $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
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
                'ajax': {headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, 'url': base_url + '/getProducts', 'type': 'POST'},
                columnDefs: [{targets: [], visible: false}, {'bSortable': false, 'aTargets': '_all'}, {responsivePriority: 1, targets: [0, 3]}],
                'columns': [
                    {'data': 'id', 'className': 'font-weight-bold', 'defaultContent': ''},
                    {'data': 'name', 'defaultContent': ''},
                    {'data': 'description', 'defaultContent': ''},
                    {'data': 'action', 'className': 'text-right', 'defaultContent': ''},
                ]
            });
            table_products
                .on('select', function (e, dt, type, indexes) {
                    var rowData = table_products.rows(indexes).data().toArray();
                    select_table_products = rowData[0];
                });

            /*EVENTO BTN DELETE POST*/
            $(document).on('click', '.btn-delete-product', function (event) {
                let id = $(this).data('id');
                iziToast.question({
                    timeout: false,
                    close: false,
                    overlay: true,
                    toastOnce: true,
                    backgroundColor: question_color,
                    id: 'question',
                    message: mensaje_delete,
                    position: 'topRight',
                    buttons: [
                        ['<button><b>' + btn_delete + '</b></button>', function (instance, toast) {
                            $.ajax({
                                beforeSend: function () {
                                    instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                                    commonFunctions.lock();
                                    // $(btn).buttonLoader('start');
                                },
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                url: base_url + '/products/' + id,
                                type: 'DELETE',
                                data: {'id': id}
                            })
                                .done(function (data) {
                                })
                                .fail(function (data) {
                                    commonFunctions.show_error_messages(data);
                                })
                                .always(function (data) {
                                    // $(btn).buttonLoader('stop');
                                    commonFunctions.unlock();
                                    if (data.success) {
                                        table_products.ajax.reload();
                                    } else
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
            /*FIN DE EVENTO BTN DELETE POST*/

        } /* Funciones Locales */
}

$(function () {
    var product_index = new ProductsIndex(new commonFunctions());
    product_index.constructor();
});