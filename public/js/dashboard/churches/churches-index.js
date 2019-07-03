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
