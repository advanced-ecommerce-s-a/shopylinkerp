<div class="row">
    {*Step 1 - Administrator information*}
    <div class="col-md-4">
        <div class="form-group">
            <label>{l s='Administrator information' mod='shopylinkerp'}</label>
        </div>
        <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
            <div class="form-group">
                <label>{l s='User name' mod='shopylinkerp'}</label>
                <input type="text" class="form-control" name="useradmin" required="required" value="{$useradmin}">
            </div>
            <div class="form-group">
                <label>{l s='Password' mod='shopylinkerp'}</label>
                <input type="password" class="form-control" name="passadmin" required="required" value="{$passadmin}">
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="processAssociateStore">
                <input type="hidden" name="step" value="1">
                <button type="submit" class="btn btn-primary">{l s='Validate' mod='shopylinkerp'}</button>
            </div>
        </form>
    </div>
    <div class="col-md-12"></div>
    {*Step 2 - ShopyLinker connection data.*}
    <div class="col-md-4">
        <div class="form-group">
            <label>{l s='ShopyLinker connection data' mod='shopylinkerp'}</label>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="radio" name="connection_mode" value="1" checked="checked" data-action="selectConnectionMode">{l s='Proxy' mod='shopylinkerp'}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="radio" name="connection_mode" value="2" data-action="selectConnectionMode">{l s='Direct' mod='shopylinkerp'}
                            </div>
                        </div>
                    </div>
                </div>
                {* Proxy *}
                <div id="container_proxy" class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{l s='Proxy Mode Integration Configuration.' mod='shopylinkerp'}</label>
                        </div>
                        <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{l s='Connection key' mod='shopylinkerp'}</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input class="form-control" name="connection_key" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden" name="action" value="processAssociateStore">
                                        <input type="hidden" name="step" value="2">
                                        <button type="submit" class="btn btn-primary">{l s='Validate' mod='shopylinkerp'}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {* Direct *}
                <div id="container_direct" class="row" style="display: none">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{l s='Direct Mode Integration Configuration.' mod='shopylinkerp'}</label>
                        </div>
                        <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
                            <div class="row">
                                {* Database connection data. *}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{l s='Database connection data.' mod='shopylinkerp'}</label>
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Server' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="server" required value="{$server}">
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Data base' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="name_bd" required value="{$name_bd}">
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='User' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="user_bd" required value="{$user_bd}">
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Password' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="pass_bd" required value="{$pass_bd}">
                                    </div>
                                </div>
                                {* Ftp connection data. *}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{l s='Ftp connection data' mod='shopylinkerp'}</label>
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='User' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="ftp_user" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Password' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="ftp_pass" required>
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Server' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="ftp_server" required>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-12">{l s='Ssl' mod='shopylinkerp'}</label>
                                        <input type="checkbox" class="col-md-12" name="ftp_ssl">
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Root' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="ftp_root" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" value="processAssociateStore">
                                <input type="hidden" name="step" value="2">
                                <button type="submit" class="btn btn-primary">{l s='Validate' mod='shopylinkerp'}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        ShopyManager.init();
    });
</script>