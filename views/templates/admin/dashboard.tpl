<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">
                {l s='User Information' mod='shopylinkerp'}
                <span class="panel-heading-action" style="width: 10%">
                    <a href="javascript:void(0)" class="list-toolbar-btn" data-action="processLogout"
                       style="width: 100%; text-align: center">
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
                        <div class="col-md-12 text-center">
                            <div id="div_message"
                                 class="alert alert-danger">{l s='You must check your email to obtain the validation code and enter it here' mod='shopylinkerp'}</div>
                        </div>
                        <div class="col-md-12">
                            <form id="form_validate_user">
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-2 text-right">
                                        <label style="margin-top: 5px">{l s='Code' mod='shopylinkerp'}</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control" name="code" required="required">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary"
                                                data-action="processValidateUser">{l s='Validate' mod='shopylinkerp'}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {else}
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="bigicon">
                            <i class="icon-check-circle"></i><br>
                            <span>{l s='Verified user' mod='shopylinkerp'}</span>
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">{l s='Store asociation' mod='shopylinkerp'}</div>
            {if $instanceData['status'] == 3}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{l s='Linking date' mod='shopylinkerp'}: </label>{$instanceData['date_add']}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{l s='Connection mode' mod='shopylinkerp'}
                                : </label>{if $instanceData['connection_mode'] ==2 }
                                {l s='Proxy' mod='shopylinkerp'}
                            {else}
                                {l s='Direct' mod='shopylinkerp'}
                            {/if}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="bigicon">
                            <i class="icon-check-circle"></i><br>
                            <span>{l s='Store associated' mod='shopylinkerp'}</span>
                        </div>
                    </div>
                </div>
            {else}
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {if $instanceData['status'] == 1}
                                        <div class="alert alert-danger">{l s='You must link the store to start working with Shopylinker.' mod='shopylinkerp'}</div>
                                    {else}
                                        <div class="alert alert-warning">{l s='You must complete the store linking process.' mod='shopylinkerp'}</div>
                                    {/if}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-primary"
                                            data-action="displayAssociateStore">{l s='Associate store' mod='shopylinkerp'}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {/if}
        </div>
    </div>
</div>