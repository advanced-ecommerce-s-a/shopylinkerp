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

<div class="col-md-12">
    <div class="row">
        <div class="row">
            <div class="supsidebar">
                <div class="row text-center">
                    <img style="width: 240px" src="../modules/shopylinkerp/views/img/logoshopy.png">
                </div>
                <div class="col-md-12 smtsidebar">
                    <ul>
                        {if isset($userData['id']) && $userData['id'] != 0}
                        <li><a data-action="displaydashboard" class="{if $active =='dashboard'}active{/if}" href="javascript:void(0)"><i
                                        class="icon_Dashboard"></i> {l s='Dashboard' mod='shopylinkerp'}
                            </a></li>
                            {else}
                            <li><a class="{if $active =='login'}active{/if}" data-action="displayLogin" href="javascript:void(0)"><i
                                            class="icon_confir_Contrasena"></i> {l s='Login' mod='shopylinkerp'}
                                </a></li>
                        {/if}
                        <li><a class="{if $active =='frequentquestion'}active{/if}" data-action="displayinfo" data-where="frequentquestion" href="javascript:void(0)"><i
                                        class="icon_Preg_frecuentes"></i> {l s='Frequent questions' mod='shopylinkerp'}
                            </a></li>
                        <li><a class="{if $active =='catalogm'}active{/if}" data-action="displayinfo" data-where="catalogm" href="javascript:void(0)"><i
                                        class="icon_Gest_catalogo"></i> {l s='Catalog Management' mod='shopylinkerp'}
                            </a>
                        </li>
                        <li><a class="{if $active =='catalogo'}active{/if}" data-action="displayinfo" data-where="catalogo" href="javascript:void(0)"><i
                                        class="icon_Optim_catalogo"></i> {l s='Catalog Optimization' mod='shopylinkerp'}
                            </a>
                        </li>
                        <li><a class="{if $active =='marketingm'}active{/if}" data-action="displayinfo" data-where="marketingm"
                                    href="javascript:void(0)"><i
                                        class="icon_Modulos_marketing"></i> {l s='Marketing modules' mod='shopylinkerp'}
                            </a>
                        </li>
                        <li><a class="{if $active =='increase'}active{/if}" data-action="displayinfo" data-where="increase"
                                    href="javascript:void(0)"><i
                                        class="icon_Aumento_segur"></i> {l s='Increased security' mod='shopylinkerp'}
                            </a>
                        </li>
                        <li><a class="{if $active =='logistic'}active{/if}" data-action="displayinfo" data-where="logistic"
                                    href="javascript:void(0)"> <i
                                        class="icon_Logist_tiendas"></i> {l s='Logistics, physical stores, warehouses' mod='shopylinkerp'}
                            </a>
                        </li>
                        {if isset($userData['id'])}
                        <li><a data-action="processLogout"
                                    href="javascript:void(0)"> <i
                                        class="icon_Salir"></i> {l s='Sign Out' mod='shopylinkerp'}
                            </a>
                        </li>
                        {/if}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal que muestra la imagen -->
<div id="imagenModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-container" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img id="modalImage" src="" alt="Imagen" />
            </div>
        </div>
    </div>
</div>
