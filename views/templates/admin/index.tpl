{**
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
*}

<div id="container_shopylinkerp">
    {include file="$include_tpl"}
</div>
<div id="modal_container"></div>
<script>
    $(document).ready(function () {
        ShopyManager.init('{$token|escape:'htmlall':'UTF-8'}');
    });


    //text
    var TEXT_LOADING = '{l s='Please wait...' mod='shopylinkerp'}';

</script>
<style>
    .error {
        color: red;
        font-weight: 400 !important;
    }
</style>