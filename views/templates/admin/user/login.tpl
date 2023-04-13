<div class="row">
    <div class="col-md-4"></div>
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">{l s='Sign in to Shopylinker' mod='shopylinkerp'}</div>
            <form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px">{l s='User name' mod='shopylinkerp'}: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px">{l s='Password' mod='shopylinkerp'}: </label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" required="required">
                            </div>
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
</div>
