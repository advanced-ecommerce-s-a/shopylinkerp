var ShopyManager = {
    token: null,
    init: function(token){
        this.token = token;
        this._initEvents();
    },

    _initEvents: function()
    {
        //region User
        $('[data-action="displayLogin"]').off('click').on('click', function () {
            ShopyManager.displayLogin();
        });

        $('[data-action="processLogin"]').off('click').on('click', function () {
            ShopyManager.processLogin();
        });
        //endregion

        //region Register
        $('[data-action="displayRegister"]').off('click').on('click', function () {
            ShopyManager.displayRegister();
        });

        $('[data-action="processRegister"]').off('click').on('click', function () {
            ShopyManager.processRegister();
        });
        //endregion

        //region Instance
        $('[data-action="selectConnectionMode"]').off('change').on('change', function () {
            var opciones = $(this).val();
            if(opciones == 1){
                $('#container_proxy').show();
                $('#container_direct').hide();
            }else{
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
        form.append('controller', 'AdminShopylinkerpManager');
        form.append('token', ShopyManager.token);
        form.append('action', 'displayLogin');


        $.ajax({
            //url: 'ajax-tab.php',
            url: 'ajax-tab.php',
            data: form,
            method: 'POST',
            processData:false,
            cache: false,
            contentType: false,
            beforeSend: function () {
                //TODO block
            },
            success: function (response) {
                $('#container_shopylinkerp').html(response);
                ShopyManager._initEvents();
            },
            complete: function () {
                //TODO unblock
            }
        });
    },

    processLogin: function () {
        var form = $('#form_login');
        if(form.valid()) {
            form = document.getElementById('form_login');
            form = new FormData(form);
            form.append('controller', 'AdminShopylinkerpManager');
            form.append('token', ShopyManager.token);
            form.append('action', 'login');

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
                    alert(response);
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
                },
                complete: function () {
                    //TODO unblock
                }
            });
        }
    },
    //endregion

    //region Register
    displayRegister: function () {
        var form = new FormData();
        form.append('controller', 'AdminShopylinkerpManager');
        form.append('token', ShopyManager.token);
        form.append('action', 'displayRegister');

        $.ajax({
            url: 'ajax-tab.php',
            data: form,
            method: 'POST',
            processData:false,
            cache: false,
            contentType: false,
            beforeSend: function () {
                //TODO block
            },
            success: function (response) {
                $('#container_shopylinkerp').html(response);
                ShopyManager._initEvents();
            },
            complete: function () {
                //TODO unblock
            }
        });
    },

    processRegister: function () {
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
        if(form.valid()) {
            form = document.getElementById('form_register');
            form = new FormData(form);
            form.append('controller', 'AdminShopylinkerpManager');
            form.append('token', ShopyManager.token);
            form.append('action', 'register');

            $.ajax({
                url: 'ajax-tab.php',
                data: form,
                method: 'POST',
                processData:false,
                cache: false,
                contentType: false,
                beforeSend: function () {
                    //TODO block
                },
                success: function (response) {
                    var response = JSON.parse(response);
                    switch (response.status){
                        case 0:{
                            $('#container_shopylinkerp').html(response.html);
                            break;
                        }
                        case 1:{
                            $('#div_message').html(response.error);
                            $('#div_message').show();
                        }
                    }
                    ShopyManager._initEvents();
                },
                complete: function () {
                    //TODO unblock
                }
            });
        }

    },
    //endregion

    //region Instance
    displayAssociateStore: function () {
        var form = new FormData();
        form.append('controller', 'AdminShopylinkerpManager');
        form.append('token', ShopyManager.token);
        form.append('action', 'displayAssociateStore');

        $.ajax({
            url: 'ajax-tab.php',
            data: form,
            method: 'POST',
            processData:false,
            cache: false,
            contentType: false,
            beforeSend: function () {
                //TODO block
            },
            success: function (response) {
                $('#modal_container').html(response);
                $('#modal_instance').modal('show');
                ShopyManager._initEvents();
            },
            complete: function () {
                //TODO unblock
            }
        });
    },

    processAssociateStore: function (idform) {
        var form = document.getElementById(idform);
        form = new FormData(form);
        form.append('controller', 'AdminShopylinkerpManager');
        form.append('token', ShopyManager.token);
        form.append('action', 'registerAssociateStore');

        $.ajax({
            url: 'ajax-tab.php',
            data: form,
            method: 'POST',
            processData:false,
            cache: false,
            contentType: false,
            beforeSend: function () {
                //TODO block
            },
            success: function (response) {
                var response = JSON.parse(response);
                switch (response.step){
                    case '1':{
                        if(response.status == 0){
                            //TODO next step
                            alert('OK');
                        }else{
                            //TODO show error
                            alert(resp.error);
                        }
                        break;
                    }
                    case '2':{
                        if(response.status == 0){
                            //TODO close de wizard
                            alert('OK');
                        }else{
                            //TODO show error
                            alert(resp.error);
                        }
                        break;
                    }
                }
            },
            complete: function () {
                //TODO unblock
            }
        });
    },
    //endregion
};
