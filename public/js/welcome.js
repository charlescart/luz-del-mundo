/*
* Ing.Charles Rodriguez
*/

function Welcome(commonFunctions) {
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



        }
    /* Funciones Locales */
}

$(function () {
    var welcome = new Welcome(new commonFunctions());
    welcome.constructor();
});
