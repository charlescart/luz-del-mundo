/*
* Ing.Charles Rodriguez
*/

function rolesCreate(commonFunctions) {
    var selft = this;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
    },
        this.component_init = function () {

            /* Evento show de modal roles create */
            $('#modal-roles-create').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget);
                let form = button.data('form');
                let modal = $(this);
                modal.find('form').attr('id', form);
            });
            /* Fin de evento show de modal roles create */


        }
    /* Funciones Locales */
}

$(function () {
    var roles_create = new rolesCreate(new commonFunctions());
    roles_create.constructor();
});
