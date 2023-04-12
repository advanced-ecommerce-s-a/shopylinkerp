{*Step 1 - Administrator information*}
<div class="row">
    <div class="col-12">
        <label>{l s='Administrator information' mod='shopylinkerp'}</label>
        <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
            <div class="form-group">
                <label>{l s='User name' mod='shopylinkerp'}</label>
                <input class="form-control" name="useradmin" required>
            </div>
            <div class="form-group">
                <label>{l s='Password' mod='shopylinkerp'}</label>
                <input class="form-control" name="passadmin" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="action" value="processAssociateStore">
                <input type="hidden" name="step" value="1">
                <button type="submit">{l s='Validate' mod='shopylinkerp'}</button>
            </div>
        </form>
    </div>
</div>
{*Step 2 - ShopyLinker connection data.*}
<div class="row">
    <div class="col-12">
        <label>{l s='ShopyLinker connection data' mod='shopylinkerp'}</label>
        <div class="row">
            {* Proxy *}
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label>{l s='Proxy' mod='shopylinkerp'}</label>
                        <input type="radio" name="connection_mode" value="1">
                        <label>{l s='Descriptions....' mod='shopylinkerp'}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
                            <label>{l s='Proxy Mode Integration Configuration.' mod='shopylinkerp'}</label>
                            <div class="form-group">
                                <label>{l s='Connection key' mod='shopylinkerp'}</label>
                                <input class="form-control" name="connection_key" required>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="action" value="processAssociateStore">
                                <input type="hidden" name="step" value="2">
                                <button type="submit">{l s='Validate' mod='shopylinkerp'}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {* Direct *}
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <label>{l s='Direct' mod='shopylinkerp'}</label>
                        <input type="radio" name="connection_mode" value="2">
                        <label>{l s='Descriptions....' mod='shopylinkerp'}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
                            <label>{l s='Direct Mode Integration Configuration.' mod='shopylinkerp'}</label>
                            <div class="row">
                                {* Database connection data. *}
                                <div class="col-12">
                                    <label>{l s='Database connection data.' mod='shopylinkerp'}</label>
                                    <div class="form-group">
                                        <label>{l s='Server' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="server" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Name' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="name_bd" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='User' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="user_bd" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label>{l s='Password' mod='shopylinkerp'}</label>
                                        <input class="form-control" name="pass_bd" required value="">
                                    </div>
                                </div>
                                {* Ftp connection data. *}
                                <div class="col-12">
                                    <label>{l s='Ftp connection data' mod='shopylinkerp'}</label>
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
                                    <div class="form-group">
                                        <label>{l s='Ssl' mod='shopylinkerp'}</label>
                                        <input type="checkbox" class="form-control" name="ftp_ssl" required>
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
                                <button type="submit">{l s='Validate' mod='shopylinkerp'}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>