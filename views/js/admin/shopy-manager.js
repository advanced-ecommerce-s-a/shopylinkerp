var ShopyManager = {
    token: null,
    init: function (token) {
        this.token = token;
        this._initEvents();
    },

    _ajaxCall(form, action, callback) {

        form.append('controller', 'AdminShopylinkerpManager');
        form.append('token', ShopyManager.token);
        form.append('action', action);

        $.ajax({
            url: 'ajax-tab.php',
            data: form,
            method: 'POST',
            processData: false,
            cache: false,
            contentType: false,
            beforeSend: function () {
                //TODO block
            },
            success: function (response) {
                callback(response);
            },
            complete: function () {
                //TODO unblock
            }
        });
    },
    _initEvents: function () {
        //region User
        $('[data-action="displayLogin"]').off('click').on('click', function () {
            ShopyManager.displayLogin();
        });

        $('[data-action="processLogin"]').off('click').on('click', function () {
            ShopyManager.processLogin();
        });

        $('[data-action="processLogout"]').off('click').on('click', function () {
            ShopyManager.processLogout();
        });
        //endregion

        //region Register
        $('[data-action="displayRegister"]').off('click').on('click', function () {
            ShopyManager.displayRegister();
        });

        $('[data-action="processRegister"]').off('click').on('click', function () {
            ShopyManager.processRegister();
        });

        $('[data-action="processValidateUser"]').off('click').on('click', function () {
            ShopyManager.processValidateUser();
        });
        //endregion

        //region Instance
        $('[data-action="selectConnectionMode"]').off('change').on('change', function () {
            var opciones = $(this).val();
            if (opciones == 1) {
                $('#container_proxy').show();
                $('#container_direct').hide();
            } else {
                $('#container_proxy').hide();
                $('#container_direct').show();
            }
        });

        $('[data-action="displayAssociateStore"]').off('click').on('click', function () {
            ShopyManager.displayAssociateStore();
        });

        $('[data-action="processAssociateStore"]').off('click').on('click', function () {
            var idform = $(this).data('idform')
            ShopyManager.processAssociateStore(idform);
        });
        //endregion
    },

    //region User
    displayLogin: function () {
        var form = new FormData();

        this._ajaxCall(form,'displayLogin',function (response)
        {
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

            this._ajaxCall(form,'login',function (response) {
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

        this._ajaxCall(form,'logout',function (response)
        {
            $('#container_shopylinkerp').html(response);
            ShopyManager._initEvents();
        });
    },
    //endregion

    //region Register
    displayRegister: function () {
        var form = new FormData();

        this._ajaxCall(form,'displayRegister',function (response)
        {
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

            this._ajaxCall(form,'register',function (response)
            {
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

            this._ajaxCall(form,'validateUser',function (response)
            {
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
        this._ajaxCall(form,'displayAssociateStore',function (response)
        {
            $('#modal_container').html(response);
            $('#modal_instance').modal('show');
            ShopyManager.initWizard();
            ShopyManager._initEvents();
        });
    },

    processAssociateStore: function (idform) {
        $('#div_message_step2').hide();
        var form = document.getElementById(idform);
        form = new FormData(form);
        this._ajaxCall(form,'registerAssociateStore',function (response)
        {
            var response = JSON.parse(response);
            switch (response.step) {
                case '1': {
                    if (response.status == 0) {
                        $('#btn_step_1').prop('disabled', false);
                    } else {
                        $('#div_message_step2').html(response.error);
                        $('#div_message_step2').show();
                    }
                    break;
                }
                case '2': {
                    if (response.status == 0) {
                        $('#modal_instance').modal('hide');
                        //ShopyManager.displayDasboard()
                    } else {
                        $('#div_message_step2').html(response.error);
                        $('#div_message_step2').show();
                    }
                    break;
                }
            }
        });
    },

    initWizard: function (){
        $("#tab_step1").tab("show");
        $('#btn_next_step_1').on('click', function (){
            $("#tab_step2").tab("show");
        });
        $('#btn_back_step_1').on('click', function (){
            $("#tab_step1").tab("show");
        });
    },
    //endregion

};
