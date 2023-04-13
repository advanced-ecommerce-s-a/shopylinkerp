var ShopyManager = {
    init: function(){
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
    },
};
