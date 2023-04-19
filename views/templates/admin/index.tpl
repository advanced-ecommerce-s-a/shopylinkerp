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
    var PASS_VALID_MINIMUN = '{l s='Key must be between 10 to 20 characters long.' mod='shopylinkerp'}';
    var PASS_VALID_UPPERCASE = '{l s='Key must contain at least one uppercase.' mod='shopylinkerp'}';
    var PASS_VALID_LOWERCASE = '{l s='Key must contain at least one lowercase.' mod='shopylinkerp'}';
    var PASS_VALID_NUMBER = '{l s='Key must contain at least one digit.' mod='shopylinkerp'}';
    var PASS_VALID_SPECIAL = '{l s='Key must contain special characters from @#$%.' mod='shopylinkerp'}';

</script>
<style>
    .error {
        color: red;
        font-weight: 400 !important;
    }
</style>