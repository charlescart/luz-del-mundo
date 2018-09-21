/*
* Ing.Charles Rodriguez
*/

function Register(commonFunctions) {
    var selft = this;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.show_flash_message();
    },
        this.component_init = function () {
            /* Particles de fondo */
            commonFunctions.particles();
            /* Fin de particles de fondo */

            /* Config. de input material*/
            commonFunctions.config_input_material();
            /* Fin de config. de input material*/

        }
    /* Funciones Locales */
}

$(function () {
    var register = new Register(new commonFunctions());
    register.constructor();
});
