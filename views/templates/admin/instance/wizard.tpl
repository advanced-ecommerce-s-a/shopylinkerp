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

<div id="modal_instance" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{l s='Store Asociation' mod='shopylinkerp'}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified mb-4" id="wizardTabs" role="tablist">
                            <li class="nav-item">
                                <a id="tab_step1" class="nav-link active" href="#tab_admin_acces"
                                   role="tab">{l s='Prestashop Backoffice Access' mod='shopylinkerp'}</a>
                            </li>
                            <li class="nav-item">
                                <a id="tab_step2" class="nav-link disabled" href="#tab_connection_data"
                                   role="tab">{l s='ShopyLinker connection data' mod='shopylinkerp'}</a>
                            </li>
                        </ul>
                        <div class="tab-content" style="padding: 25px">
                            <div id="tab_admin_acces" class="tab-pane fade active" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="div_message" class="alert alert-danger" style="display: none"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <form id="form_user_data" method="post">
                                            <input type="hidden" id="validastoreccess" name="validastoreccess"
                                                   value="0">
                                            <div class="form-group row">
                                                <div class="col-md-3 text-right">
                                                    <label style="margin-top: 5px">{l s='Username' mod='shopylinkerp'}
                                                        : </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input title="{l s='Must be a user with administrator privileges' mod='shopylinkerp'}"
                                                           type="text" class="form-control chaneg_associate_user stoolt"
                                                           name="useradmin" required="required" value="{$useradmin}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3 text-right">
                                                    <label style="margin-top: 5px">{l s='Password' mod='shopylinkerp'}
                                                        : </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="password" class="form-control chaneg_associate_user"
                                                           name="passadmin" required="required" value="{$passadmin}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="step" value="1">
                                                    <button type="button" class="btn btn-success"
                                                            data-action="processAssociateStore"
                                                            data-idform="form_user_data">{l s='Validate' mod='shopylinkerp'}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-right stoolt fr" title="{l s='To continue you must validate the administrator user' mod='shopylinkerp'}">
                                        <button id="btn_next_step_1" type="button" class="btn btn-primary"

                                                disabled="disabled">{l s='Next' mod='shopylinkerp'}</button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_connection_data" class="tab-pane fade" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="div_message_step2" class="alert alert-danger"
                                             style="display: none"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label> <input type="radio" name="checked_connection_mode" value="2"
                                                                    {if $conectionmode == 2} checked="checked" {/if}
                                                                       data-action="selectConnectionMode"> {l s='Proxy Mode Integration Configuration.' mod='shopylinkerp'}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label><input type="radio" {if $conectionmode == 1} checked="checked" {/if}
                                                                      name="checked_connection_mode" value="1"
                                                                      data-action="selectConnectionMode"> {l s='Direct Mode Integration Configuration.' mod='shopylinkerp'}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="container_proxy"
                                             class="row" {if $conectionmode == 1} style="display: none" {/if}>
                                            <form id="form_instance_proxy" method="post">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="alert alert-warning">{l s='Shopylinker will connect to the store through a proxy hosted in the module. You must set a password for communication between Shopylinker and your store.' mod='shopylinkerp'}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="margin-top: 5px">{l s='Connection key' mod='shopylinkerp'}</label>
                                                        <input class="form-control chaneg_associate_store stoolt"
                                                               name="connection_key" value="{{$conectionKey}}"
                                                               title="{l s='Minimum 10 Characters - Must include upper and lower case letters,at least one number and some special character' mod='shopylinkerp'}"
                                                               minlength="10" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center" style="margin-top: 25px">
                                                    <input type="hidden" name="step" value="2">
                                                    <input type="hidden" name="connection_mode" value="2">
                                                    <button type="button" class="btn btn-success"
                                                            data-action="processAssociateStore"
                                                            data-idform="form_instance_proxy">{l s='Validate' mod='shopylinkerp'}</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="container_direct"
                                             class="row" {if $conectionmode == 2} style="display: none" {/if}>
                                            <input type="hidden" id="checkdb" value="0">
                                            <input type="hidden" id="checkftp" value="0">
                                            <form id="form_instance_direct_db" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="alert alert-warning">{l s='Shopylinker will connect directly to your database and file system. For that it is necessary to provide the accesses. Note that in some cases we propose the accesses that are already configured in the store, but you can change them for the ones you want' mod='shopylinkerp'}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>{l s='Database connection data' mod='shopylinkerp'}</legend>
                                                            <div class="row">
                                                                <div id="divdbmsg" class="alert alert-danger"
                                                                     style="display: none"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Server' mod='shopylinkerp'}
                                                                        </label>
                                                                        <input class="form-control chaneg_associate_store"
                                                                               name="server" required value="{$server}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Database Name' mod='shopylinkerp'}
                                                                        </label>
                                                                        <input class="form-control chaneg_associate_store"
                                                                               name="name_bd" required
                                                                               value="{$name_bd}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='DB Username' mod='shopylinkerp'}
                                                                            *</label>
                                                                        <input class="form-control chaneg_associate_store"
                                                                               name="user_bd" required
                                                                               value="{$user_bd}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='DB Password' mod='shopylinkerp'}</label>
                                                                        <input class="form-control chaneg_associate_store"
                                                                               name="pass_bd"
                                                                               value="{$pass_bd}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 text-center">
                                                                    <button type="button" class="btn btn-success"
                                                                            data-action="processCheckDb">{l s='Validate' mod='shopylinkerp'}</button>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </form>
                                            <form id="form_instance_direct_ftp" method="post">
                                                <div class="row">
                                                    <div class="col-md-12" style="margin-top: 25px">
                                                        <fieldset>
                                                            <legend>{l s='Ftp connection data' mod='shopylinkerp'}</legend>
                                                            <div class="row">
                                                                <div id="divftpmsg" class="alert alert-danger"
                                                                     style="display: none"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='FTP Username' mod='shopylinkerp'} </label>
                                                                        <input class="form-control chaneg_associate_store stoolt"
                                                                               title="{l s='Enter the FTP username' mod='shopylinkerp'}"
                                                                               name="ftp_user" value="{{$userftp}}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='FTP Password' mod='shopylinkerp'}</label>
                                                                        <input class="form-control chaneg_associate_store stoolt"
                                                                               title="{l s='Enter the password of the indicated FTP user' mod='shopylinkerp'}"
                                                                               name="ftp_pass" value="{{$passftp}}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='FTP Server' mod='shopylinkerp'}</label>
                                                                        <input class="form-control chaneg_associate_store stoolt"
                                                                               title="{l s='Enter the address of the FTP server. Generally it is the same domain of the store' mod='shopylinkerp'}"
                                                                               name="ftp_server" value="{{$ftpserver}}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='FTP Port' mod='shopylinkerp'}</label>
                                                                        <input class="form-control chaneg_associate_store stoolt"
                                                                               title="{l s='The default FTP connection port is 21. In case of using a different port, specify it in this field.' mod='shopylinkerp'}"
                                                                               name="ftp_port"
                                                                               placeholder="21" value="{{$ftpport}}"
                                                                               required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Root folder' mod='shopylinkerp'}</label>
                                                                        <input class="form-control chaneg_associate_store stoolt"
                                                                               title="{l s='Represents the store folder on the server.
                                                                               Check with your server administrator if you do not know what it is. Default is /' mod='shopylinkerp'}"
                                                                               name="ftp_root" value="{{$ftproot}}"
                                                                               placeholder="/" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Use SSL' mod='shopylinkerp'}</label><br>
                                                                        <label class="switch stoolt"
                                                                               title="{l s="Activate if the FTP connection is under secure protocol (SFTP)"}"><input
                                                                                    type="checkbox"
                                                                                    class="chaneg_associate_store"
                                                                                    {if $ftpssl == 1}checked{/if}
                                                                                    name="ftp_ssl">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-center" style="margin-top: 25px">
                                                        <input type="hidden" name="step" value="2">
                                                        <input type="hidden" name="connection_mode" value="1">
                                                        <button type="button" class="btn btn-success"
                                                                data-action="proccessCheckFTP"
                                                        >{l s='Validate' mod='shopylinkerp'}</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <button id="btn_back_step_1" type="button"
                                                class="btn btn-primary">{l s='Back' mod='shopylinkerp'}</button>
                                    </div>
                                    <div class="text-right stoolt fr" title="{l s='You must validate all the forms in your integration setup to finalize the association' mod='shopylinkerp'}">
                                        <button id="btn_step_finish" type="button" class="btn btn-primary"
                                                disabled="disabled"
                                                data-action="finishAssociateStore">{l s='Finish' mod='shopylinkerp'}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () { // <-- add this
        ShopyManager._initWizard();
        $('.stoolt').tooltip();
    });
</script>