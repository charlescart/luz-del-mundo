<script type="text/javascript">
    window.base_url = '{!! url('/') !!}';
    window.url_behind = '{!! URL::previous() !!}';
    window.mensaje_delete = '{!! trans('mensaje.delete') !!}';
    window.btn_delete = '{!! trans('btn.delete') !!}';
    window.btn_cancel = '{!! trans('btn.cancel') !!}';
    window.assigned_roles = '{!! __('Assigned roles') !!}';
    window.preloader = '<svg viewBox="0 0 120 120" width="100px" height="100px"> <circle class="inner" cx="60" cy="60" r="32"/> <circle class="middle" cx="60" cy="60" r="38"/> <circle class="outer" cx="60" cy="60" r="44"/></svg><span class="text-nowrap text-white-50" style="display: block; color: #aacbb0; margin-left: 0;">{!! trans('mensaje.preloader') !!}</span>';
    window.msg_flash = '{!! (session('msg')) ? session('msg') : 'false' !!}';
    window.msg_unauthenticated = '{!! trans('auth.unauthenticated') !!}';
    window.select_lang = '{!! __('Select') !!}';

    /* toast */
    window.question_color = '#d39e00';
    window.error_color = '#333834';
    window.success_color = '#333834';
    window.warning_color = '#ffc107';
    window.time_toast = 8000;
    /* fin de toast */

    window.datatables_language = {
        "sProcessing": '{!! __('datatables.sProcessing') !!}',
        "sLengthMenu": "{!! __('datatables.sLengthMenu') !!}",
        "sZeroRecords": "{!! __('datatables.sZeroRecords') !!}",
        "sEmptyTable": "{!! __('datatables.sEmptyTable') !!}",
        "sInfo": "{!! __('datatables.sInfo') !!}",
        "sInfoEmpty": "{!! __('datatables.sInfoEmpty') !!}",
        "sInfoFiltered": "{!! __('datatables.sInfoFiltered') !!}",
        "sInfoPostFix": "{!! __('datatables.sInfoPostFix') !!}",
        "sSearch": "{!! __('datatables.sSearch') !!}",
        "sUrl": "{!! __('datatables.sUrl') !!}",
        "sInfoThousands": "{!! __('datatables.sInfoThousands') !!}",
        "sLoadingRecords": "{!! __('datatables.sLoadingRecords') !!}",
        "oPaginate": {
            "sFirst": "{!! __('datatables.oPaginate.sFirst') !!}",
            "sLast": "{!! __('datatables.oPaginate.sLast') !!}",
            "sNext": "{!! __('datatables.oPaginate.sNext') !!}",
            "sPrevious": "{!! __('datatables.oPaginate.sPrevious') !!}"
        },
        "oAria": {
            "sSortAscending": "{!! __('datatables.oPaginate.sPrevious') !!}",
            "sSortDescending": "{!! __('datatables.oPaginate.sPrevious') !!}"
        },
        "select": {
            "rows": {
                _: "{!! __('datatables.select._') !!}",
                0: "{!! __('datatables.select.0') !!}",
                1: "{!! __('datatables.select.1') !!}"
            }
        },
        "decimal": "{!! __('datatables.decimal') !!}",
        "emptyTable": "{!! __('datatables.emptyTable') !!}",
        "info": "{!! __('datatables.info') !!}",
        "infoEmpty": "{!! __('datatables.infoEmpty') !!}",
        "infoFiltered": "{!! __('datatables.infoFiltered') !!}",
        "infoPostFix": "{!! __('datatables.infoPostFix') !!}",
        "thousands": "{!! __('datatables.thousands') !!}",
        "lengthMenu": "{!! __('datatables.lengthMenu') !!}",
        "loadingRecords": "{!! __('datatables.loadingRecords') !!}",
        "processing": '{!! __('datatables.processing') !!}',
        "search": "{!! __('datatables.search') !!}",
        "zeroRecords": "{!! __('datatables.zeroRecords') !!}",
        "paginate": {
            "first": "{!! __('datatables.paginate.first') !!}",
            "last": "{!! __('datatables.paginate.last') !!}",
            "next": "{!! __('datatables.paginate.next') !!}",
            "previous": "{!! __('datatables.paginate.previous') !!}"
        },
        "aria": {
            "sortAscending": "{!! __('datatables.aria.sortAscending') !!}",
            "sortDescending": "{!! __('datatables.aria.sortDescending') !!}"
        }
    };


    function msg(num, time = 6000, btn_number = 0) {
        let msg = [], btn = [];

        /* ERROR */
        msg[-1] = '{!! trans('mensaje.-1') !!}'; // No pudo realizarse la operación!
        msg[-2] = '{!! trans('mensaje.-2') !!}'; // Acceso denegado, no estás autenticado!
        msg[-3] = '{!! trans('mensaje.-3') !!}'; // Acceso denegado, no está autorizado!
        msg[-4] = '{!! trans('mensaje.-4') !!}';
        msg[-5] = '{!! trans('mensaje.-5') !!}';
        msg[-6] = '{!! trans('mensaje.-6') !!}';
        msg[-7] = '{!! trans('mensaje.-7') !!}';
        msg[-8] = '{!! trans('mensaje.-8') !!}';
        msg[-9] = '{!! trans('mensaje.-9') !!}';
        msg[-10] = '{!! trans('mensaje.-10') !!}'; // La opcion elegida es invalida!
        msg[-11] = '{!! trans('mensaje.-11') !!}'; // Cero (0) no es un numero valido para una iglesia!

        /* SUCCESS */
        msg[1] = '{!! trans('mensaje.1') !!}';
        msg[2] = '{!! trans('mensaje.2') !!}';

        /* OBSERVACIONES */
        msg[100] = '{!! trans('mensaje.100') !!}';
        msg[101] = '{!! trans('mensaje.101') !!}';
        msg[102] = '{!! trans('mensaje.102') !!}';

        /* BOTONES */
        let btn_css = 'style="font-size: .9em; margin-top: -3px; padding: 0 5px;"';
        btn[0] = ' ';
        btn[1] = '<a href="{!! url('login') !!}" class="btn btn-outline-dark" '+btn_css+'>{!! trans('btn.auth') !!}</a>';
        btn[2] = '<a href="{!! URL::previous() !!}" class="btn btn-outline-light ml-2 btn-behind" '+btn_css+'>{!! trans('btn.behind') !!}</a>';

        if (num < 0)
            iziToast.error({message: (msg[num]+' '+btn[btn_number]), position: 'topRight', timeout: time, backgroundColor: error_color, theme: 'dark'});
        else if (num > 0 && num < 100) /* del nro 1 en adelante */
            iziToast.success({message: (msg[num]+' '+btn[btn_number]), position: 'topRight', timeout: time, backgroundColor: success_color, theme: 'dark'});
        else if (num >= 100)
            iziToast.info({message: (msg[num]+' '+btn[btn_number]), position: 'topRight', timeout: time, backgroundColor: success_color, theme: 'dark'});
    }
</script>
