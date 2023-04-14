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
                                <a id="tab_step1" class="nav-link active" data-toggle="pill" href="#tab_admin_acces" role="tab">{l s='Prestashop Backoffice Access' mod='shopylinkerp'}</a>
                            </li>
                            <li class="nav-item">
                                <a id="tab_step2" class="nav-link" data-toggle="pill" href="#tab_connection_data" role="tab">{l s='ShopyLinker connection data' mod='shopylinkerp'}</a>
                            </li>
                        </ul>
                        <div class="tab-content" style="padding: 25px">
                            <div id="tab_admin_acces" class="tab-pane fade active" role="tabpanel">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="div_message" class="alert alert-danger" style="display: none"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <form id="form_user_data" method="post">
                                            <div class="form-group row">
                                                <div class="col-md-3 text-right">
                                                    <label style="margin-top: 5px">{l s='Username' mod='shopylinkerp'}: </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="useradmin" required="required" value="{$useradmin}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-3 text-right">
                                                    <label style="margin-top: 5px">{l s='Password' mod='shopylinkerp'}: </label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="password" class="form-control" name="passadmin" required="required" value="{$passadmin}">
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <div class="form-group">
                                                    <input type="hidden" name="step" value="1">
                                                    <button type="button" class="btn btn-primary" data-action="processAssociateStore" data-idform="form_user_data">{l s='Validate' mod='shopylinkerp'}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button id="btn_next_step_1" type="button" class="btn btn-primary">{l s='Next' mod='shopylinkerp'}</button>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_connection_data" class="tab-pane fade" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="div_message_step2" class="alert alert-danger" style="display: none"></div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="radio" name="checked_connection_mode" value="1" checked="checked" data-action="selectConnectionMode">
                                                        <label>{l s='Proxy Mode Integration Configuration.' mod='shopylinkerp'}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <input type="radio" name="checked_connection_mode" value="2" data-action="selectConnectionMode">
                                                        <label>{l s='Direct Mode Integration Configuration.' mod='shopylinkerp'}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="container_proxy" class="row">
                                            <form id="form_instance_proxy" method="post">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="alert alert-warning">{l s='Description.....' mod='shopylinkerp'}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label style="margin-top: 5px">{l s='Connection key' mod='shopylinkerp'}</label>
                                                        <input class="form-control" name="connection_key" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 text-center" style="margin-top: 25px">
                                                    <input type="hidden" name="step" value="2">
                                                    <input type="hidden" name="connection_mode" value="1">
                                                    <button type="button" class="btn btn-primary" data-action="processAssociateStore" data-idform="form_instance_proxy">{l s='Validate' mod='shopylinkerp'}</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="container_direct" class="row" style="display: none">
                                            <form id="form_instance_direct" method="post">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="alert alert-warning">{l s='Description.....' mod='shopylinkerp'}</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <fieldset>
                                                            <legend>{l s='Database connection data.' mod='shopylinkerp'}</legend>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Server' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="server" required value="{$server}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Data base' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="name_bd" required value="{$name_bd}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='User' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="user_bd" required value="{$user_bd}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Password' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="pass_bd" required value="{$pass_bd}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12" style="margin-top: 25px">
                                                        <fieldset>
                                                            <legend>{l s='Ftp connection data' mod='shopylinkerp'}</legend>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='User' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="ftp_user" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>{l s='Password' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="ftp_pass" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>{l s='Server' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="ftp_server" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label>{l s='Root' mod='shopylinkerp'}</label>
                                                                        <input class="form-control" name="ftp_root" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group row">
                                                                        <label class="col-md-12">{l s='Ssl' mod='shopylinkerp'}</label>
                                                                        <input type="checkbox" class="col-md-12" name="ftp_ssl">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 text-center" style="margin-top: 25px">
                                                        <input type="hidden" name="step" value="2">
                                                        <input type="hidden" name="connection_mode" value="2">
                                                        <button type="button" class="btn btn-primary" data-action="processAssociateStore" data-idform="form_instance_direct">{l s='Validate' mod='shopylinkerp'}</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-left">
                                        <button id="btn_back_step_1" type="button" class="btn btn-primary">{l s='Back' mod='shopylinkerp'}</button>
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