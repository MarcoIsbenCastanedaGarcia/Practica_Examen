(function () {

    'use strict';


    /* =====================================================
       MENÚ PÚBLICO
    ====================================================== */

    const publicMenuButton =
        document.querySelector(
            '[data-public-menu]'
        );


    const publicNav =
        document.querySelector(
            '[data-public-nav]'
        );


    if (
        publicMenuButton &&
        publicNav
    ) {

        publicMenuButton.addEventListener(
            'click',
            function () {

                const open =
                    publicNav
                        .classList
                        .toggle('open');


                publicMenuButton
                    .setAttribute(
                        'aria-expanded',
                        open
                            ? 'true'
                            : 'false'
                    );

            }
        );


        publicNav
            .querySelectorAll('a')
            .forEach(
                function (link) {

                    link.addEventListener(
                        'click',
                        function () {

                            publicNav
                                .classList
                                .remove('open');


                            publicMenuButton
                                .setAttribute(
                                    'aria-expanded',
                                    'false'
                                );

                        }
                    );

                }
            );

    }



    /* =====================================================
       MENÚ DEL ADMIN EN MÓVIL
    ====================================================== */

    const adminMenuButton =
        document.querySelector(
            '[data-admin-menu]'
        );


    if (adminMenuButton) {

        adminMenuButton.addEventListener(
            'click',
            function () {

                const open =
                    document
                        .body
                        .classList
                        .toggle(
                            'admin-sidebar-open'
                        );


                adminMenuButton
                    .setAttribute(
                        'aria-expanded',
                        open
                            ? 'true'
                            : 'false'
                    );

            }
        );


        document.addEventListener(
            'click',
            function (event) {

                if (
                    !document
                        .body
                        .classList
                        .contains(
                            'admin-sidebar-open'
                        )
                ) {

                    return;

                }


                const clickedSidebar =
                    event.target.closest(
                        '[data-admin-sidebar]'
                    );


                const clickedButton =
                    event.target.closest(
                        '[data-admin-menu]'
                    );


                if (
                    !clickedSidebar &&
                    !clickedButton
                ) {

                    document
                        .body
                        .classList
                        .remove(
                            'admin-sidebar-open'
                        );


                    adminMenuButton
                        .setAttribute(
                            'aria-expanded',
                            'false'
                        );

                }

            }
        );

    }



    /* =====================================================
       ESC PARA CERRAR MENÚ
    ====================================================== */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key !== 'Escape'
            ) {

                return;

            }


            document
                .body
                .classList
                .remove(
                    'admin-sidebar-open'
                );


            if (publicNav) {

                publicNav
                    .classList
                    .remove('open');

            }

        }
    );



    /* =====================================================
       MOSTRAR / OCULTAR CONTRASEÑA
    ====================================================== */

    document
        .querySelectorAll(
            '[data-password-toggle]'
        )
        .forEach(
            function (button) {

                button.addEventListener(
                    'click',
                    function () {

                        const targetId =
                            button.getAttribute(
                                'data-password-toggle'
                            );


                        const input =
                            document.getElementById(
                                targetId
                            );


                        if (!input) {

                            return;

                        }


                        const hidden =
                            input.type ===
                            'password';


                        input.type =
                            hidden
                                ? 'text'
                                : 'password';


                        button.textContent =
                            hidden
                                ? '🙈'
                                : '👁';


                        button.setAttribute(
                            'aria-label',
                            hidden
                                ? 'Ocultar contraseña'
                                : 'Mostrar contraseña'
                        );

                    }
                );

            }
        );



    /* =====================================================
       BÚSQUEDA LOCAL EN TABLAS
    ====================================================== */

    document
        .querySelectorAll(
            '[data-filter-table]'
        )
        .forEach(
            function (input) {

                const tableId =
                    input.getAttribute(
                        'data-filter-table'
                    );


                const table =
                    document.getElementById(
                        tableId
                    );


                if (!table) {

                    return;

                }


                input.addEventListener(
                    'input',
                    function () {

                        const search =
                            input
                                .value
                                .trim()
                                .toLowerCase();


                        table
                            .querySelectorAll(
                                'tbody tr'
                            )
                            .forEach(
                                function (row) {

                                    const text =
                                        row
                                            .textContent
                                            .toLowerCase();


                                    row.style.display =
                                        text.includes(
                                            search
                                        )
                                            ? ''
                                            : 'none';

                                }
                            );

                    }
                );

            }
        );



    /* =====================================================
       EVITAR DOBLE ENVÍO
    ====================================================== */

    document.addEventListener(
        'submit',
        function (event) {

            const form =
                event.target;


            if (
                !form.matches(
                    '[data-once-form]'
                )
            ) {

                return;

            }


            const button =
                form.querySelector(
                    '[data-once]'
                );


            if (!button) {

                return;

            }


            window.setTimeout(
                function () {

                    button.disabled =
                        true;


                    button.textContent =
                        'Procesando...';

                },
                0
            );

        }
    );



    /* =====================================================
       ARCHIVO TXT
    ====================================================== */

    document
        .querySelectorAll(
            '[data-txt-file]'
        )
        .forEach(
            function (input) {

                input.addEventListener(
                    'change',
                    function () {

                        const file =
                            input.files &&
                            input.files[0];


                        const errorElement =
                            document.querySelector(
                                '[data-file-error]'
                            );


                        let message =
                            '';


                        if (file) {

                            const extensionValid =
                                /\.txt$/i.test(
                                    file.name
                                );


                            const maxBytes =
                                2 *
                                1024 *
                                1024;


                            if (
                                !extensionValid
                            ) {

                                message =
                                    'El archivo debe ser formato TXT.';

                            } else if (
                                file.size >
                                maxBytes
                            ) {

                                message =
                                    'El archivo no puede superar los 2 MB.';

                            }

                        }


                        if (errorElement) {

                            errorElement.textContent =
                                message;

                        }


                        if (message) {

                            input.value =
                                '';

                        }

                    }
                );

            }
        );



    /* =====================================================
       OCULTAR MENSAJES DE ÉXITO
    ====================================================== */

    document
        .querySelectorAll(
            '[data-autohide]'
        )
        .forEach(
            function (alert) {

                window.setTimeout(
                    function () {

                        alert.style.transition =
                            'opacity .4s ease';


                        alert.style.opacity =
                            '0';


                        window.setTimeout(
                            function () {

                                alert.remove();

                            },
                            450
                        );

                    },
                    5000
                );

            }
        );


})();