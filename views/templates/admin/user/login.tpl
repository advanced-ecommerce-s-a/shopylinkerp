<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{l s='User name' mod='shopylinkerp'}</label>
                        <input type="text" class="form-control" name="username" required="required">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{l s='Password' mod='shopylinkerp'}</label>
                        <input type="text" class="form-control" name="password" required="required">
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <div class="form-group">
                        <input type="hidden" name="action" value="processLogin">
                        <button type="submit" class="btn btn-primary">{l s="Sign in" mod='shopylinkerp'}</button>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-2">
                    <div class="form-group">
                        <a href="{$link->getAdminLink('AdminShopylinkerpManager', true, [], ['action' => 'displayRegister'])}">{l s="Don't have an account? Sign up" mod='shopylinkerp'}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
