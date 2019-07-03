/*
* Ing.Charles Rodriguez
* Funciones de uso común y recurrente.
*/

/* Funciones de uso commun o recurrente */
function commonFunctions() {
    selft = this;
    this.constructor = function () {
        // this.common_events();
        console.info('Funciones comunes cargadas!');
    },
        this.show_flash_message = function () {
            if (typeof (msg_flash) != 'undefined')
                if (msg_flash != 'false')
                    msg(msg_flash);
        },
        this.apply_error_menssages = function (data, form_id, msgOnly = false) {
            switch (data.status) {
                case 422: /* Errores de validacion */
                    $.each(data.responseJSON.errors, function (name, msg) {
                        if(msgOnly)
                            iziToast.error({message: msg[0], position: 'topRight', timeout: time_toast, backgroundColor: error_color, theme: 'dark'});
                        else {
                            $('#' + form_id + ' [name="' + name + '"]').addClass('is-invalid');
                            $('#' + form_id + ' [name="' + name + '"]').siblings('div.invalid-feedback:first').text(msg[0]);
                        }
                    });
                    break;
                case 403: /* Acceso no autorizado por Request o Roles*/
                    msg(-3, time_toast);
                    break;
                case 401:
                    msg(-2, time_toast, 1);
                    break;
                default:
                    msg(-1, time_toast);
            }
        },
        this.show_error_messages = function (data) {
            /* Funcion que despliega uno o varios toast con errors */
            switch (data.status) {
                case 422: /* Solo si vienen errores de vuelta */
                    $.each(data.responseJSON.errors, function (name, msg) {
                        iziToast.warning({
                            message: msg,
                            position: 'topRight',
                            timeout: time_toast,
                            backgroundColor: warning_color
                        });
                    });
                    break;
                case 401:
                    msg(-2, time_toast, 1);
                    break;
                default:
                    msg(-1, time_toast);
            }
        },
        this.clean_error_messages = function (fields, selft) {
            /* var "fields" son inputs serializados del form "$(this).serializeArray()",
            * var "selft" el elemento en si, es un "this" */
            $.each(fields, function (i, field) {
                $('#' + selft.id + ' [name="' + field.name + '"]').removeClass('is-invalid');
            });
        },
        this.lock = function () {
            $.blockUI({
                message: preloader,
                css: { 'z-index': 100020, backgroundColor: 'transparent', color: '#fff', opacity: '1', border: 'none' }
            });
        },
        this.unlock = function () {
            $.unblockUI();
        },
        /* limpia el input del form cuando esta escribiendo para corregir */
        this.clean_invalidation_form = function (input) {
            let padre = $(input).parent('div');
            $(input).removeClass('is-invalid');
            padre.children('invalid-feedback').text('');
        },
        /* Convierte el texto en slug */
        this.string_to_slug = function (s, opt) {
            s = String(s);
            opt = Object(opt);

            var defaults = {
                'delimiter': '-',
                'limit': undefined,
                'lowercase': true,
                'replacements': {},
                'transliterate': (typeof (XRegExp) === 'undefined') ? true : false
            };

            // Merge options
            for (var k in defaults) {
                if (!opt.hasOwnProperty(k)) {
                    opt[k] = defaults[k];
                }
            }

            var char_map = {
                // Latin
                'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
                'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
                'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
                'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
                'ß': 'ss',
                'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c',
                'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i',
                'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o',
                'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th',
                'ÿ': 'y',

                // Latin symbols
                '©': '(c)',

                // Greek
                'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
                'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
                'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
                'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
                'Ϋ': 'Y',
                'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
                'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
                'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
                'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
                'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

                // Turkish
                'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
                'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g',

                // Russian
                'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
                'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
                'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
                'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
                'Я': 'Ya',
                'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
                'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
                'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
                'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
                'я': 'ya',

                // Ukrainian
                'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
                'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

                // Czech
                'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U',
                'Ž': 'Z',
                'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
                'ž': 'z',

                // Polish
                'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z',
                'Ż': 'Z',
                'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
                'ż': 'z',

                // Latvian
                'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N',
                'Š': 'S', 'Ū': 'u', 'Ž': 'Z',
                'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
                'š': 's', 'ū': 'u', 'ž': 'z'
            };

            // Make custom replacements
            for (var k in opt.replacements) {
                s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
            }

            // Transliterate characters to ASCII
            if (opt.transliterate) {
                for (var k in char_map) {
                    s = s.replace(RegExp(k, 'g'), char_map[k]);
                }
            }

            // Replace non-alphanumeric characters with our delimiter
            var alnum = (typeof (XRegExp) === 'undefined') ? RegExp('[^a-z0-9]+', 'ig') : XRegExp('[^\\p{L}\\p{N}]+', 'ig');
            s = s.replace(alnum, opt.delimiter);

            // Remove duplicate delimiters
            s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);

            // Truncate slug to max. characters
            s = s.substring(0, opt.limit);

            // Remove delimiter from ends
            s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');

            return opt.lowercase ? s.toLowerCase() : s;
        },
        /*
        * Limpia y destruye el tag editor
        */
        this.clearAndDestroyTagEditor = function(dial) {
            /* dial: variable de tipo string que contiene el selector, sea id o clase */
            let tags = $(dial).tagEditor('getTags')[0].tags;
            for (i = 0; i < tags.length; i++) { $(dial).tagEditor('removeTag', tags[i]); }
            $(dial).tagEditor('destroy');
        }
        /*
        * Aplica fondos tipo particles
        * */
        this.particles = function () {
            particlesJS("particles-js", {
                "particles": {
                    "number": {
                        "value": 80,
                        "density": { "enable": true, "value_area": 800 }
                    },
                    "color": { "value": "#132fb3" },
                    "shape": {
                        "type": "edge",
                        "stroke": { "width": 0, "color": "#000000" },
                        "polygon": { "nb_sides": 5 },
                        "image": { "src": "img/github.svg", "width": 100, "height": 100 }
                    },
                    "opacity": {
                        "value": 1,
                        "random": true,
                        "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false }
                    },
                    "size": {
                        "value": 3,
                        "random": true,
                        "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false }
                    },
                    "line_linked": { "enable": true, "distance": 150, "color": "#c89393", "opacity": 0.4, "width": 1 },
                    "move": {
                        "enable": true,
                        "speed": 6,
                        "direction": "none",
                        "random": false,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": { "enable": false, "mode": "repulse" },
                        "onclick": { "enable": true, "mode": "push" },
                        "resize": true
                    },
                    "modes": {
                        "grab": { "distance": 400, "line_linked": { "opacity": 1 } },
                        "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 },
                        "repulse": { "distance": 200, "duration": 0.4 },
                        "push": { "particles_nb": 4 },
                        "remove": { "particles_nb": 2 }
                    }
                },
                "retina_detect": false
            });
        },
        this.config_input_material = function () {
            /* Material Inputs */
            var materialInputs = $('input.input-material');
            /* Fin de material Inputs */

            /* Activate labels for prefilled values */
            materialInputs.filter(function () { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');
            /* Fin de activate labels for prefilled values */

            /* move label on focus */
            materialInputs.on('focus', function () {
                $(this).siblings('.label-material').addClass('active');
            });
            /* Fin de move label on focus */

            /*remove/keep label on blur*/
            materialInputs.on('blur', function () {
                $(this).siblings('.label-material').removeClass('active');

                if ($(this).val() !== '') {
                    $(this).siblings('.label-material').addClass('active');
                } else {
                    $(this).siblings('.label-material').removeClass('active');
                }
            });
            /*Fin de remove/keep label on blur*/
            console.info('Config. input material');
        },
        /* *
         * Fincionalidades comunes del dashboard.
         * */
        this.common_dashboard = function () {
            /* Search Box */
            $('#search').on('click', function (e) {
                e.preventDefault();
                $('.search-box').fadeIn();
            });
            $('.dismiss').on('click', function () {
                $('.search-box').fadeOut();
            });
            /* Fin de search Box */

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

            /* Tooltips init */
            $('[data-toggle="tooltip"]').tooltip();
            /* Fin de tooltips init */

            /* External links to new window */
            $('.external').on('click', function (e) {

                e.preventDefault();
                window.open($(this).attr("href"));
            });
            /* Fin de external links to new window */

            console.info('Funciones comunes de dashboard cargadas!');
        },
        this.common_events = function () {
            /* limpia de invalidaciones (is-invalid) el form antes de hacer submit */
            $('form').on('submit', function (event) {
                selft.clean_error_messages($(this).serializeArray(), this);
            });
            /* Fin de limpia de invalidaciones (is-invalid) el form antes de hacer submit */

            /* limpia de (is-invalid) el input al hacer keyup */
            $(document).on('keyup', 'input.is-invalid, textarea.is-invalid', function (event) {
                selft.clean_invalidation_form(this);
            });
            /* Fin de limpia de (is-invalid) el input al hacer keyup */
            
            /* Limpia de (is-invalid) el check y select */
            $(document).on('change', 'input.is-invalid, select.is-invalid', function (event) {
                selft.clean_invalidation_form(this);
            });
            /* Fin de limpia de (is-invalid) el check y select */

            /* BOTON ATRAS DE TOAST */
            $(document).on('click', '.btn-behind', function (event) {
                /* code... */
            });
            /* FIN DE BOTON ATRAS DE TOAST */

            console.info('eventos comunes cargado');

        }
}
