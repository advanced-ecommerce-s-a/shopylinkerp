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
<div class="row home">
    {include file="module:shopylinkerp/views/templates/admin/header.tpl"}

    <div class="row justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <div class="col-md-4">
                <div class="shopypanel">
                    <div class="title">
                        <h2>{l s='Discover everything that Shopylinker can do for you:' mod='shopylinkerp'}</h2>
                        <ul>
                            <li><a href="javascript:void(0)" data-action="displayinfo" data-where="frequentquestion"><i
                                            class="icon_Preg_frecuentes"></i> {l s='Frequent questions' mod='shopylinkerp'}
                                </a></li>
                            <li><a href="javascript:void(0)" data-action="displayinfo" data-where="catalogm"><i
                                            class="icon_Gest_catalogo"></i> {l s='Catalog Management' mod='shopylinkerp'}</a></li>
                            <li><a href="javascript:void(0)" data-action="displayinfo" data-where="catalogo"><i
                                            class="icon_Optim_catalogo"></i> {l s='Catalog Optimization' mod='shopylinkerp'}</a>
                            </li>
                            <li><a
                                        href="javascript:void(0)" data-action="displayinfo" data-where="marketingm"><i
                                            class="icon_Modulos_marketing"></i> {l s='Marketing modules' mod='shopylinkerp'}</a></li>
                            <li><a
                                        href="javascript:void(0)" data-action="displayinfo" data-where="increase"><i
                                            class="icon_Aumento_segur"></i> {l s='Increased security' mod='shopylinkerp'}</a></li>
                            <li><a
                                        href="javascript:void(0)" data-action="displayinfo" data-where="logistic"> <i
                                            class="icon_Logist_tiendas"></i> {l s='Logistics, physical stores, warehouses' mod='shopylinkerp'}
                                </a>
                            </li>
                        </ul>
                        <div class="imacontainer">
                            <img src="../modules/shopylinkerp/views/img/footermejora.png">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="shopypanel">
                        <div class="row">
                            <div class="col-md-5 text-center">
                                <img src="../modules/shopylinkerp/views/img/bombillo.png">
                            </div>
                            <div class="col-md-7 text-center">
                                <h2>{l s='Advanced eCommerce Management' mod='shopylinkerp'}</h2>
                                <p style="margin-bottom: 30px">{l s='Optimize, facilitate and enhance your Prestashop' mod='shopylinkerp'}</p>
                                <a href="javascript:void(0)" data-action="displayLogin"
                                   class="shbutton">{l s='Start now' mod='shopylinkerp'}</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="shopypanel">
                            <div class="row text-center">
                                <img src="../modules/shopylinkerp/views/img/visitar.png"><br>
                                <a target="_blank" class="linkextern"
                                   href="http://www.shopylinker.com">{l s='Visit Shopylinker.com' mod='shopylinkerp'}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="shopypanel">
                            <div class="row text-center">
                                <img src="../modules/shopylinkerp/views/img/manual.png"><br>
                                <a class="linkextern" target="_blank"
                                   href="{$urllinkmanual}">{l s='Download manual' mod='shopylinkerp'}</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>