var ShopyManager = {
    token: null,
    init: function(token){
        this.token = token;
        this._initEvents();
    },

    _initEvents: function(){
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
    },

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
                var resp = JSON.parse(response);
                console.log(resp);
                switch (resp.step){
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
};
