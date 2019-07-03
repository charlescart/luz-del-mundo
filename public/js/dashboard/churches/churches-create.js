/*
* Ing.Charles Rodriguez
*/

function churchesCreate(commonFunctions) {
    var selft = this, view_custom_name = true;
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

            /* Evento change, select Pais */
            $('#country').on('change', function (event) {
                if ($(this).val() != 0) {
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        beforeSend: function () {
                            commonFunctions.lock();
                        },
                        url: base_url + '/getProvinces',
                        type: 'POST',
                        data: { 'country': $(this).val() }
                    })
                        .done(function (data) {
                            if (data.success) {
                                $('#state').html('');
                                $("#state").append('<option value="0" selected>' + select_lang + '</option>');
                                $.each(data.data, function (key, province) {
                                    $("#state").append('<option value=' + province.id + '>' + province.name + '</option>');
                                });
                                /* select city se limpia */
                                $('#city').html('');
                                $("#city").append('<option value="0" selected>' + select_lang + '</option>');
                                /* select city se limpia */
                            } else
                                msg(data.msg);
                        })
                        .fail(function (data) {
                            commonFunctions.apply_error_menssages(data, 'form-create-church', true);
                        })
                        .always(function (data) {
                            commonFunctions.unlock();
                        });

                } else {
                    /* select estado y ciudad se limpia */
                    $('#state').html('');
                    $("#state").append('<option value="0" selected>' + select_lang + '</option>');

                    $('#city').html('');
                    $("#city").append('<option value="0" selected>' + select_lang + '</option>');
                    /* select estado y ciudad se limpia */
                    $('#name').val('');
                    msg(-10); // de ser la opcion 0 (cero) Pais
                }
            });
            /* Fin de evento change, select Pais */

            /* Evento change, select Estado */
            $('#state').on('change', function (event) {
                if ($(this).val() != 0) {
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        beforeSend: function () {
                            commonFunctions.lock();
                        },
                        url: base_url + '/getCities',
                        type: 'POST',
                        data: { 'state': $(this).val() }
                    })
                        .done(function (data) {
                            if (data.success) {
                                $('#city').html('');
                                $("#city").append('<option value="0" selected>' + select_lang + '</option>');
                                $.each(data.data, function (key, city) {
                                    $("#city").append('<option value=' + city.id + '>' + city.name + '</option>');
                                });
                            } else
                                msg(data.msg);
                        })
                        .fail(function (data) {
                            commonFunctions.apply_error_menssages(data, 'form-create-church', true);
                        })
                        .always(function (data) {
                            commonFunctions.unlock();
                        });

                } else {
                    // limpiando select ciudad
                    $('#city').html('');
                    $("#city").append('<option value="0" selected>' + select_lang + '</option>');
                    msg(-10); // de ser la opcion 0 (cero) Estado
                    $('#name').val(''); /* limpiando name church */
                }
            });
            /* Fin de evento change, select Estado */

            /* Evento change, select Ciudad */
            $('#city').on('change', function (event) {
                if ($(this).val() > 0) {
                    selft.create_name_of_church();
                } else
                    msg(-10); // de ser la opcion 0 (cero) Ciudad
            });
            /* Fin de evento change, select Ciudad */

            /* Evento keyup input number church */
            $('#number_of_church').on('keyup', function (event) {
                if ($(this).val() == 0) {
                    $(this).val('');
                    msg(-11);
                }

                if ($(this).val() < 0)
                    $(this).val('');

                selft.create_name_of_church();
            });
            /* Fin de evento keyup input number church */

            /* Evento change input number church */
            $('#number_of_church').on('change', function (event) {
                if ($(this).val() == 0) {
                    $(this).val(''); // no puse el msg -10 por doble evento accionado
                }
                selft.create_name_of_church();
            });
            /* Fin de evento change input number church */

            /* Checked personalizar nombre iglesia */
            $('#custom_name').on('change', function (event) {
                if ($(this).is(':checked')) {
                    $('#name').prop('readOnly', false);
                    if (view_custom_name) {
                        $('#custom-name-modal').modal('show');
                        view_custom_name = false;
                    }
                } else {
                    $('#name').prop('readOnly', true);
                    selft.create_name_of_church();
                }
            });
            /* Fin de checked personalizar nombre iglesia */

            /* Evento submit de form create church */
            $('#form-create-church').on('submit', function (event) {
                event.preventDefault();
                let form = $(this), form_id = this.id;
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    beforeSend: function () {
                        $('#' + form_id + ' [type="submit"]').buttonLoader('start');
                        commonFunctions.lock();
                    },
                    url: base_url + '/churches',
                    type: 'POST',
                    data: form.serialize()
                })
                    .done(function (data) {
                        if (data.success) {
                            location.href = base_url + '/churches';
                        } else
                            msg(data.msg);
                    })
                    .fail(function (data) {
                        commonFunctions.apply_error_menssages(data, form_id, false);
                    })
                    .always(function (data) {
                        $('#' + form_id + ' [type="submit"]').buttonLoader('stop');
                        commonFunctions.unlock();
                    });
            });
            /* Fin de submit de form create church */

        },
        /* Funciones Locales */
        this.create_name_of_church = function () {
            /* si check personalizar nombre está activo no creo el nombre */
            if ($('#custom_name').is(':checked'))
                return 0;
            /* si ciudad no es una seleccion valida tampoco */
            if ($('#city').val() == 0 || $('#city option:selected').text() == '')
                return 0;

            let name = 'Luz del Mundo ' + $('#city option:selected').text();
            if ($('#number_of_church').val() != '')
                name = name + ' Misión ' + $('#number_of_church').val();

            $('#name').val(name);
        }
}

$(function () {
    var churches_create = new churchesCreate(new commonFunctions());
    churches_create.constructor();
});
