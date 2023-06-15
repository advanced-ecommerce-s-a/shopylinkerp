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

<div class="row register">
    {include file="module:shopylinkerp/views/templates/admin/header.tpl"}
    <div class="col-md-3"></div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="title"><h2>{l s='Sign up in Shopylinker' mod='shopylinkerp'}</h2>
                <span class="subtitle"> {l s='You must create a user in Shopylinker to start working' mod='shopylinkerp'}</span>
            </div>

            <form id="form_register" method="post">
                <div class="row">
                    <div class="col-12">
                        <div id="div_message" class="alert alert-danger" style="display: none"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="username" style="margin-top: 5px"><i class="icon_email_2"
                                                                                 title="{l s='Email' mod='shopylinkerp'}"></i></label>
                            </div>
                            <div class="col-md-6">
                                <input type="email" title="{l s='Email' mod='shopylinkerp'}"
                                       placeholder="{l s='Email' mod='shopylinkerp'}" class="form-control smttooltip"
                                       name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="password" style="margin-top: 5px"><i class="icon_confir_Contrasena"
                                                                                 title="{l s='Password' mod='shopylinkerp'}"></i></label>
                            </div>
                            <div class="col-md-6">
                                <input id="password" placeholder="{l s='Password' mod='shopylinkerp'}"
                                       title="{l s='Password' mod='shopylinkerp'}" type="password"
                                       class="form-control smttooltip" id="password" name="password"
                                       required="required">
                                <span class="form-control-icon_pass">
                                        <i data-input="password" data-inputextra="rpassword" class="icon_Mostrar"></i>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px"><i class="icon_Contrasena"
                                                                  title="{l s='Password' mod='shopylinkerp'}"></i></label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" placeholder="{l s='Confirm Password' mod='shopylinkerp'}"
                                       title="{l s='Confirm Password' mod='shopylinkerp'}"
                                       class="form-control smttooltip" id="rpassword" name="rpassword"
                                       required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px"><i class="icon_Inscripcion_2"
                                                                  title="{l s='Name' mod='shopylinkerp'}"></i></label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="{l s='Name' mod='shopylinkerp'}"
                                       title="{l s='Name' mod='shopylinkerp'}" class="form-control smttooltip"
                                       name="name" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px"><i class="icon_Apellidos"
                                                                  title="{l s='Last name' mod='shopylinkerp'}"></i></label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="{l s='Last name' mod='shopylinkerp'}"
                                       title="{l s='Last name' mod='shopylinkerp'}" class="form-control smttooltip"
                                       name="lastname" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary"
                                    data-action="processRegister">{l s="Sign up in Shopylinker" mod='shopylinkerp'}</button>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <div class="form-group">
                            <a href="javascript:void(0)"
                               data-action="displayLogin">{l s="Already have an account? Access from here" mod='shopylinkerp'}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
