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

<div class="row login">
    {include file="module:shopylinkerp/views/templates/admin/header.tpl"}

    <div class="col-md-4"></div>
    <div class="col-lg-4">
        <div class="panel">
            <div class="title"><h2>{l s='Sign in to Shopylinker' mod='shopylinkerp'}</h2>
                <span class="subtitle"> {l s='You must enter the details of your Shopylinker account' mod='shopylinkerp'}</span>
            </div>
            <form id="form_login" method="post">
                <div class="row">
                    <div class="col-12">
                        <div id="div_message" class="alert alert-danger" style="display: none"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px"> <i class="icon_Usuario_1"
                                                                   title="{l s='Email' mod='shopylinkerp'}"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input title="{l s='Email' mod='shopylinkerp'}" placeholder="{l s='Email' mod='shopylinkerp'}" type="text" class="form-control smttooltip"
                                       name="smt_username" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px"><i class="icon_confir_Contrasena"
                                                                  title="{l s='Password' mod='shopylinkerp'}"></i>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <input title="{l s='Password' mod='shopylinkerp'}" type="password" placeholder="{l s='Password' mod='shopylinkerp'}"
                                       class="form-control smttooltip" name="smt_password" id="password"
                                       required="required">
                                <span class="form-control-icon_pass">
                                        <i data-input="password" class="icon_Mostrar"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary"
                                    data-action="processLogin">{l s="Sign in" mod='shopylinkerp'}</button>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <div class="form-group">
                            <a href="javascript:void(0)"
                               data-action="displayRegister">{l s="Don't have an account yet? Sign up here" mod='shopylinkerp'}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
