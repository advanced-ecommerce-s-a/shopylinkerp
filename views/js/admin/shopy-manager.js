/**
 * 2018-2023 Optyum S.A. All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Optyum S.A. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Optyum S.A.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Optyum S.A.
 *
 * @author    Optyum S.A.
 * @copyright 2018-2023 Optyum S.A.
 * @license  Optyum S.A. All Rights Reserved
 *  International Registered Trademark & Property of Optyum S.A.
 */

var ShopyManager = {
        token: null,

        //region General
        init: function (token) {
            this.token = token;
            this._initEvents();
        },

        _ajaxCall(form, action, callback) {

            form.append('controller', 'AdminShopylinkerpManager');
            form.append('token', ShopyManager.token);
            form.append('action', action);
            form.append('ajaxMode', 1);
            form.append('ajax', 1);

            $.ajax({
                url: 'index.php',
                data: form,
                method: 'POST',
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    $.blockUI({
                        message: TEXT_LOADING,
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                },
                success: function (response) {
                    callback(response);
                },
                complete: function () {
                    $.unblockUI();
                }
            });
        },

        _initWizard: function () {
            $.validator.addMethod("strong_password", function (value, element) {
                let password = value;

                if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%])(.{10,20}$)/.test(password))) {
                    return false;
                }
                return true;
            }, function (value, element) {
                let password = $(element).val();
                if (!(/^(.{10,20}$)/.test(password))) {
                    return PASS_VALID_MINIMUN;
                } else if (!(/^(?=.*[A-Z])/.test(password))) {
                    return PASS_VALID_UPPERCASE;
                } else if (!(/^(?=.*[a-z])/.test(password))) {
                    return PASS_VALID_LOWERCASE;
                } else if (!(/^(?=.*[0-9])/.test(password))) {
                    return PASS_VALID_NUMBER;
                } else if (!(/^(?=.*[@#$%&])/.test(password))) {
                    return PASS_VALID_SPECIAL;
                }
                return false;
            });

            $('[data-action="processAssociateStore"]').off('click').on('click', function () {
                var idform = $(this).data('idform');
                ShopyManager.processAssociateStore(idform);
            });
            $('[data-action="selectConnectionMode"]').off('change').on('change', function () {
                var opciones = $(this).val();
                if (opciones == 2) {
                    $('#container_proxy').show();
                    $('#container_direct').hide();
                } else {
                    $('#container_proxy').hide();
                    $('#container_direct').show();
                }

                //desaparesco los mensajes
                $('#div_message_step2').hide();
                $('#btn_step_finish').prop('disabled', true);
            });

            $('.chaneg_associate_store').off('change').on('change', function () {
                $('#btn_step_finish').prop('disabled', true);
            });
            $('.chaneg_associate_user').off('change').on('change', function () {
                $('#btn_next_step_1').prop('disabled', true);
                $('#btn_step_finish').prop('disabled', true);
            });

            //pestañas
            $("#tab_step1").tab("show");
            $('#btn_next_step_1').on('click', function () {
                $("#tab_step2").tab("show");
            });
            $('#btn_back_step_1').on('click', function () {
                $("#tab_step1").tab("show");
            });

            $('[data-action="finishAssociateStore"]').off('click').on('click', function () {
                ShopyManager.finishAssociateStore();
            });

            $('[data-action="processCheckDb"]').off('click').on('click', function () {
                ShopyManager.proccessCheckDb();
            });

            $('[data-action="proccessCheckFTP"]').off('click').on('click', function () {
                ShopyManager.proccessCheckFTP();
            });

            $('#conectionkeyGenerate').on('click', function () {
                $pass = ShopyManager.generatePasswordCode();
                $('#connection_key').val($pass);
            });

        },
        _initEvents: function () {

            $('.smttooltip').tooltip();

            $('[data-action="displayLogin"]').off('click').on('click', function () {
                ShopyManager.displayLogin();
            });

            $('[data-action="processLogin"]').off('click').on('click', function () {
                ShopyManager.processLogin();
            });

            $('[data-action="displayinfo"]').off('click').on('click', function () {
                var where = $(this).data('where');
                ShopyManager.displayInfo(where);
            });

            $('.collapse').on('show.bs.collapse', function () {
                console.log($('.collapse.in'));
                $('.collapse.in').not(this).collapse('hide');
            })

            $(document).on("click", ".imagelink", function(e) {
                e.preventDefault(); // Prevenir comportamiento predeterminado del enlace

                urlsite = 'https://shopylinker.com/imgmodule/';

                // Obtener la URL de la imagen desde el atributo "data-image-url" del enlace
                var imageUrl = $(this).data("image-url");

                // Establecer la URL de la imagen en el atributo "src" de la imagen dentro del modal
                $("#modalImage").attr("src", urlsite+imageUrl);

                // Mostrar el modal
                $("#imagenModal").modal("show");
            });

            // Limpiar la imagen del modal cuando este se oculte
            $("#imagenModal").on("hidden.bs.modal", function() {
                $("#modalImage").attr("src", "");
            });


            $('[data-action="processLogout"]').off('click').on('click', function () {
                ShopyManager.processLogout();
            });


            $('[data-action="displayRegister"]').off('click').on('click', function () {
                ShopyManager.displayRegister();
            });

            $('[data-action="processRegister"]').off('click').on('click', function () {
                ShopyManager.processRegister();
            });

            $('[data-action="processValidateUser"]').off('click').on('click', function () {
                ShopyManager.processValidateUser();
            });


            $('[data-action="displayAssociateStore"]').off('click').on('click', function () {
                ShopyManager.displayAssociateStore();
            });

            $('[data-action="linkresend"]').off('click').on('click', function () {
                ShopyManager.resendValidCodeEmail();
            });

            $('.form-control-icon_pass i').off('click').on('click', function (obj) {
                inputid = $(this).data('input');
                var inpu = $('#' + inputid);

                if (inpu.attr('type') == 'password') {
                    inpu.attr('type', 'text');
                    if ($(this).data('inputextra')) {
                        inpuextra = $('#' + $(this).data('inputextra'));
                        inpuextra.attr('type', 'text');
                    }
                    $(this).removeClass('icon_Mostrar').addClass('icon_Ocultar');

                } else {
                    $(this).removeClass('icon_Ocultar').addClass('icon_Mostrar');

                    inpu.attr('type', 'password');
                    if ($(this).data('inputextra')) {
                        inpuextra = $('#' + $(this).data('inputextra'));
                        inpuextra.attr('type', 'password');
                    }
                }
            });
        },

        //endregion


        //region Info
        displayInfo: function (info)
        {
            var form = new FormData();
            form.append('page', info);

            this._ajaxCall(form, 'displayInfo', function (response) {
                $('#container_shopylinkerp').html(response);
                ShopyManager._initEvents();
            });
        },

        //endregion

        //region User
        displayLogin: function () {
            var form = new FormData();

            this._ajaxCall(form, 'displayLogin', function (response) {
                $('#container_shopylinkerp').html(response);
                ShopyManager._initEvents();
            });
        },

        processLogin: function () {
            $('#div_message').hide();
            var form = $('#form_login');
            if (form.valid()) {
                form = document.getElementById('form_login');
                form = new FormData(form);

                this._ajaxCall(form, 'login', function (response) {

                    var response = JSON.parse(response);
                    console.log(response);
                    switch (response.status) {
                        case 0: {
                            $('#container_shopylinkerp').html(response.html);
                            break;
                        }
                        case 1: {
                            $('#div_message').html(response.error);
                            $('#div_message').show();
                        }
                    }
                    ShopyManager._initEvents();
                });
            }
        },

        processLogout: function () {
            form = new FormData();

            this._ajaxCall(form, 'logout', function (response) {
                $('#container_shopylinkerp').html(response);
                ShopyManager._initEvents();
            });
        },
        //endregion

        //region Register
        displayRegister: function () {
            var form = new FormData();

            this._ajaxCall(form, 'displayRegister', function (response) {
                $('#container_shopylinkerp').html(response);
                ShopyManager._initEvents();
            });
        },

        processRegister: function () {
            $('#div_message').hide();
            var form = $('#form_register');
            form.validate({
                rules: {
                    password: {
                        minlength: 8,
                    },
                    rpassword: {
                        required: true,
                        equalTo: '#password'
                    },
                }
            });
            if (form.valid()) {
                form = document.getElementById('form_register');
                form = new FormData(form);

                this._ajaxCall(form, 'register', function (response) {
                    var response = JSON.parse(response);
                    switch (response.status) {
                        case 0: {
                            $('#container_shopylinkerp').html(response.html);
                            break;
                        }
                        case 1: {
                            $('#div_message').html(response.error);
                            $('#div_message').show();
                        }
                    }
                    ShopyManager._initEvents();
                });
            }
        },

        processValidateUser: function () {
            var form = $('#form_validate_user');
            if (form.valid()) {
                form = document.getElementById('form_validate_user');
                form = new FormData(form);

                this._ajaxCall(form, 'validateUser', function (response) {
                    var response = JSON.parse(response);
                    switch (response.status) {
                        case 0: {
                            $('#container_shopylinkerp').html(response.html);
                            break;
                        }
                        case 1: {
                            $('#div_message').html(response.error);
                            $('#div_message').show();
                        }
                    }
                    ShopyManager._initEvents();
                });
            }
        },

        //endregion

        //region Instance
        displayAssociateStore: function () {
            var form = new FormData();
            this._ajaxCall(form, 'displayAssociateStore', function (response) {
                $('#modal_container').html(response);
                $('#modal_instance').modal('show');
            });
        },

        processAssociateStore: function (idform) {
            $('#div_message_step2').hide();
            $('#div_message').hide();

            var formtoValidate = $('#' + idform);

            if (idform === 'form_instance_proxy') {
                $("#" + idform).validate({
                    rules: {
                        connection_key: {
                            strong_password: true,
                            required: true
                        },
                    },
                });
            }
            var form = document.getElementById(idform);

            if (formtoValidate.valid()) {
                form = new FormData(form);
                this._ajaxCall(form, 'registerAssociateStore', function (response) {
                    console.log(response);
                    var response = JSON.parse(response);
                    switch (response.step) {
                        case '1': {
                            if (response.status) {
                                $('#btn_next_step_1').prop('disabled', false);
                                $('#div_message').removeClass('alert-danger').addClass('alert-success');
                                $('#div_message').html(response.text);
                                $('#infonewUser').hide();
                                $('#div_message').show();
                            } else {
                                $('#div_message').html(response.error);
                                $('#div_message').removeClass('alert-success').addClass('alert-danger');
                                $('#div_message').show();
                            }
                            break;
                        }
                        case '2': {
                            if (response.status) {
                                $('#div_message_step2').removeClass('alert-danger').addClass('alert-success');
                                $('#div_message_step2').html(response.text);
                                $('#div_message_step2').show();
                                $('#btn_step_finish').prop('disabled', false);
                            } else {
                                $('#div_message_step2').html(response.error);
                                $('#div_message_step2').removeClass('alert-success').addClass('alert-danger');
                                $('#div_message_step2').show();
                            }
                            break;
                        }
                    }
                });
            }
        },
        _checkDirectConection: function () {
            var chdb = parseInt($('#checkdb').val());
            var chftp = parseInt($('#checkftp').val());

            if (chftp != 0 && chdb != 0) {
                $('#btn_step_finish').prop('disabled', false);
            } else {
                $('#btn_step_finish').prop('disabled', true);
            }
        }
        ,
        proccessCheckDb: function () {
            var form = $('#form_instance_direct_db');
            var formdata = document.getElementById('form_instance_direct_db');
            formdata = new FormData(formdata);
            if (form.valid()) {
                this._ajaxCall(formdata, 'checkAndRegisterdb', function (response) {
                    console.log(response);
                    var response = JSON.parse(response);
                    if (response.status) {
                        //ok con la bd, tengo el mensaje y debo poner el hidden en true
                        $('#divdbmsg').html(response.text);
                        $('#divdbmsg').removeClass('alert-danger').addClass('alert-success');
                        $('#divdbmsg').show();
                        $('#checkdb').val(1);
                    } else {
                        $('#divdbmsg').html(response.error);
                        $('#divdbmsg').removeClass('alert-success').addClass('alert-danger');
                        $('#divdbmsg').show();
                        $('#checkdb').val(0);
                    }
                    ShopyManager._checkDirectConection();
                });
            }
        },

        proccessCheckFTP: function () {
            var form = $('#form_instance_direct_ftp');
            var formdata = document.getElementById('form_instance_direct_ftp');
            formdata = new FormData(formdata);
            if (form.valid()) {
                this._ajaxCall(formdata, 'checkAndRegisterFtp', function (response) {
                    console.log(response);
                    var response = JSON.parse(response);
                    if (response.status) {
                        //ok con la bd, tengo el mensaje y debo poner el hidden en true
                        $('#divftpmsg').html(response.text);
                        $('#divftpmsg').removeClass('alert-danger').addClass('alert-success');
                        $('#divftpmsg').show();
                        $('#checkftp').val(1);

                    } else {
                        $('#divftpmsg').html(response.error);
                        $('#divftpmsg').removeClass('alert-success').addClass('alert-danger');
                        $('#divftpmsg').show();
                        $('#checkftp').val(0);
                    }
                    ShopyManager._checkDirectConection();
                });
            }

        },

        displayDasboard: function () {
            var form = new FormData();

            this._ajaxCall(form, 'DisplayDashboard', function (response) {
                $('#container_shopylinkerp').html(response);
                ShopyManager._initEvents();
            });
        },
        generatePasswordCode: function () {
            var longitud = 10; // Longitud mínima de la contraseña

            var caracteresEspeciales = '@#$%';
            var numeros = '0123456789';
            var letrasMayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var letrasMinusculas = 'abcdefghijklmnopqrstuvwxyz';

            var password = '';

            // Generar al menos una letra mayúscula
            password += letrasMayusculas.charAt(Math.floor(Math.random() * letrasMayusculas.length));

            // Generar al menos un número
            password += numeros.charAt(Math.floor(Math.random() * numeros.length));

            // Generar al menos un carácter especial
            password += caracteresEspeciales.charAt(Math.floor(Math.random() * caracteresEspeciales.length));

            // Generar al menos una letra minúscula
            password += letrasMinusculas.charAt(Math.floor(Math.random() * letrasMinusculas.length));

            // Generar los caracteres restantes
            var caracteres = caracteresEspeciales + numeros + letrasMayusculas + letrasMinusculas;
            for (var i = password.length; i < longitud; i++) {
                password += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
            }

            return password;
        },

        finishAssociateStore: function () {
            var form = new FormData();
            this._ajaxCall(form, 'FinishteStore', function (response) {
                var response = JSON.parse(response);
                if (response.status) {
                    $('#modal_instance').modal('hide');
                    ShopyManager.displayDasboard();
                } else {
                    $('#div_message_step2').html('error');
                    $('#div_message_step2').removeClass('alert-success').addClass('alert-danger');
                    $('#div_message_step2').show();
                }
            });
        }
        ,

        resendValidCodeEmail: function () {
            var form = new FormData();
            $('.codemessage').hide();

            this._ajaxCall(form, 'ResendEmailCode', function (response) {
                var response = JSON.parse(response);
                if (response.status) {
                    //desactivo el link
                    $('.codemessage').removeClass('alert-danger').addClass('alert-success');
                    $('.codemessage').html(response.text);
                    $('.codemessage').show();
                } else {
                    $('.codemessage').removeClass('alert-success').addClass('alert-danger');
                    $('.codemessage').html(response.error);
                    $('.codemessage').show();

                }
            });
        }
//endregion

        ,

    }
;

