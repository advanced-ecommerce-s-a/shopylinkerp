<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                {l s='User Information' mod='shopylinkerp'}
                <span class="panel-heading-action" style="width: 10%">
                    <a href="javascript:void(0)" class="list-toolbar-btn" data-action="processLogout" style="width: 100%; text-align: center">
                        <span><i class="fa fa-power-off"></i>{l s='Sign Out' mod='shopylinkerp'}</span>
                    </a>
                </span>
            </div>
            <div class="row" style="margin-bottom: 25px">
                <div class="col-md-4">
                    <div class="text-center">
                        <label>{l s='Id' mod='shopylinkerp'}</label>
                    </div>
                    <div class="text-center">
                        <span>{$userData['id']}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <label>{l s='Name' mod='shopylinkerp'}</label>
                    </div>
                    <div class="text-center">
                        <span>{$userData['name']} {$userData['lastname']}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <label>{l s='Email' mod='shopylinkerp'}</label>
                    </div>
                    <div class="text-center">
                        <span>{$userData['username']}</span>
                    </div>
                </div>
            </div>
            {if $userData['status'] == 0}
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 row">
                        <div class="col-md-12">
                            <div id="div_message" class="alert alert-danger">{l s='You must check your email to obtain the validation code and enter it here' mod='shopylinkerp'}</div>
                        </div>
                        <div class="col-md-12">
                            <form id="form_validate_user">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-right">
                                        <label>{l s='Code' mod='shopylinkerp'}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" name="code" required="required">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary" data-action="processValidateUser">{l s='Validate' mod='shopylinkerp'}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {else}
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 text-center">
                        <div class="alert alert-success">{l s='Verified user' mod='shopylinkerp'}</div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">{l s='Instance' mod='shopylinkerp'}</div>
            {if $instanceData == 3}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{l s='Linking date' mod='shopylinkerp'}: {$instanceData['date_add']}</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{l s='Connection mode' mod='shopylinkerp'}: {$instanceData['connection_mode']}</label>
                        </div>
                    </div>
                </div>
            {else}
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {if $instanceData == 1}
                                        <label>{l s='You must link the store to start working with Shopylinker.' mod='shopylinkerp'}</label>
                                    {else}
                                        <label>{l s='You must complete the store linking process.' mod='shopylinkerp'}</label>
                                    {/if}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="action" value="displayAssociateStore">
                                    <button type="button" class="btn btn-primary" data-action="displayAssociateStore">{l s='Associate store' mod='shopylinkerp'}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>