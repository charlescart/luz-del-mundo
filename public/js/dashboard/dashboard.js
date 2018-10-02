/*
* Ing.Charles Rodriguez
*/

function Dashboard(commonFunctions) {
    var selft = this;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.common_dashboard();
    },
        this.component_init = function () {

            /* Card Close */
            $('.card-close a.remove').on('click', function (e) {
                e.preventDefault();
                $(this).parents('.card').fadeOut();
            });
            /* Fin de card Close */

        }
    /* Funciones Locales */
}

$(function () {
    var dashboard = new Dashboard(new commonFunctions());
    dashboard.constructor();
});
