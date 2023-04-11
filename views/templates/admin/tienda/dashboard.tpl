<div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <label>{l s='Id' mod='shopylinkerp'}: {$userData['id']}</label>
            </div>
            <div class="col-12">
                <label>{l s='Name' mod='shopylinkerp'}: {$userData['name']}</label>
            </div>
            <div class="col-12">
                <label>{l s='Last name' mod='shopylinkerp'}: {$userData['lastname']}</label>
            </div>
            <div class="col-12">
                <label>{l s='Email' mod='shopylinkerp'}: {$userData['username']}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {if $userData['status'] == 0}
                    <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
                        <div class="form-group">
                            <label>{l s='Code' mod='shopylinkerp'}: {$userData['username']}</label>
                            <input class="form-control" name="code" required>
                            <input type="hidden" name="action" value="processValidateUser">
                            <button type="submit">{l s='Validate' mod='shopylinkerp'}</button>
                        </div>
                    </form>
                {else}
                    <label style="color: green">{l s='verified user' mod='shopylinkerp'}</label>
                {/if}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <a href="{$link->getAdminLink('AdminShopylinkerpManager', true, [], ['action' => 'processLogout'])}">{l s="Log off" mod='shopylinkerp'}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6">

    </div>
</div>