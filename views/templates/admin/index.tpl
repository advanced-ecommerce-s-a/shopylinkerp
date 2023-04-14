<div id="container_shopylinkerp">
    {include file="$include_tpl"}
</div>
<div id="modal_container"></div>
<script>
    $(document).ready(function(){
        ShopyManager.init('{$token|escape:'htmlall':'UTF-8'}');
    });
</script>
<style>
    .error{
        color: red;
        font-weight: 400 !important;
    }
</style>