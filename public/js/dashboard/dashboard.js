/*
* Ing.Charles Rodriguez
*/

function Dashboard(commonFunctions) {
    var selft = this;
    commonFunctions.constructor();
    this.constructor = function () {
        this.component_init();
        commonFunctions.show_flash_message();
    },
        this.component_init = function () {
            /* Search Box */
            $('#search').on('click', function (e) {
                e.preventDefault();
                $('.search-box').fadeIn();
            });
            $('.dismiss').on('click', function () {
                $('.search-box').fadeOut();
            });
            /* Fin de search Box */

            /* Card Close */
            $('.card-close a.remove').on('click', function (e) {
                e.preventDefault();
                $(this).parents('.card').fadeOut();
            });
            /* Fin de card Close */

            /* Tooltips init */
            $('[data-toggle="tooltip"]').tooltip()
            /* Fin de tooltips init */

            /* Adding fade effect to dropdowns */
            $('.dropdown').on('show.bs.dropdown', function () {
                $(this).find('.dropdown-menu').first().stop(true, true).fadeIn();
            });
            $('.dropdown').on('hide.bs.dropdown', function () {
                $(this).find('.dropdown-menu').first().stop(true, true).fadeOut();
            });
            /* Fin de adding fade effect to dropdowns */

            /* Sidebar Functionality */
            $('#toggle-btn').on('click', function (e) {
                e.preventDefault();
                $(this).toggleClass('active');

                $('.side-navbar').toggleClass('shrinked');
                $('.content-inner').toggleClass('active');
                $(document).trigger('sidebarChanged');

                if ($(window).outerWidth() > 1183) {
                    if ($('#toggle-btn').hasClass('active')) {
                        $('.navbar-header .brand-small').hide();
                        $('.navbar-header .brand-big').show();
                    } else {
                        $('.navbar-header .brand-small').show();
                        $('.navbar-header .brand-big').hide();
                    }
                }

                if ($(window).outerWidth() < 1183) {
                    $('.navbar-header .brand-small').show();
                }
            });
            /* Fin de sidebar Functionality */


            /* Footer */
            var contentInner = $('.content-inner');

            $(document).on('sidebarChanged', function () {
                adjustFooter();
            });

            $(window).on('resize', function () {
                adjustFooter();
            })

            function adjustFooter() {
                var footerBlockHeight = $('.main-footer').outerHeight();
                contentInner.css('padding-bottom', footerBlockHeight + 'px');
            }
            /* Fin de Footer */

            /* External links to new window */
            $('.external').on('click', function (e) {

                e.preventDefault();
                window.open($(this).attr("href"));
            });
            /* Fin de external links to new window */

            /* For demo purposes, can be deleted */
            var stylesheet = $('link#theme-stylesheet');
            $("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
            var alternateColour = $('link#new-stylesheet');

            if ($.cookie("theme_csspath")) {
                alternateColour.attr("href", $.cookie("theme_csspath"));
            }

            $("#colour").change(function () {

                if ($(this).val() !== '') {

                    var theme_csspath = 'css/style.' + $(this).val() + '.css';

                    alternateColour.attr("href", theme_csspath);

                    $.cookie("theme_csspath", theme_csspath, {
                        expires: 365,
                        path: document.URL.substr(0, document.URL.lastIndexOf('/'))
                    });

                }

                return false;
            });
            /* For demo purposes, can be deleted */

        }
    /* Funciones Locales */
}

$(function () {
    var dashboard = new Dashboard(new commonFunctions());
    dashboard.constructor();
});
