<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-heading">{l s='User' mod='shopylinkerp'}</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{l s='Id' mod='shopylinkerp'}: {$userData['id']}</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{l s='Name' mod='shopylinkerp'}: {$userData['name']}</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{l s='Last name' mod='shopylinkerp'}: {$userData['lastname']}</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{l s='Email' mod='shopylinkerp'}: {$userData['username']}</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {if $userData['status'] == 0}
                        <form method="post" action="">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-1">
                                        <label>{l s='Code' mod='shopylinkerp'}</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input class="form-control" name="code" required="required">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" name="action" value="processValidateUser">
                                        <button type="submit" class="btn btn-primary">{l s='Validate' mod='shopylinkerp'}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    {else}
                        <div class="form-group">
                            <label style="color: green">{l s='verified user' mod='shopylinkerp'}</label>
                        </div>
                    {/if}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
{*                        <a href="{$link->getAdminLink('AdminShopylinkerpManager', true, [], ['action' => 'processLogout'])}">{l s="Log off" mod='shopylinkerp'}</a>*}
                    </div>
                </div>
            </div>
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
<div id="modal_container"></div>
<script>
    $(document).ready(function(){
        ShopyManager.init('{$token|escape:'htmlall':'UTF-8'}');
    });
</script>