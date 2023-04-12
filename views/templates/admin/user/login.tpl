<form method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
    <div class="form-group">
        <label for="username">{l s='User name' mod='shopylinkerp'}:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">{l s='Password' mod='shopylinkerp'}:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <input type="hidden" name="action" value="processLogin">
    <button type="submit" class="btn btn-primary">{l s="Sign in" mod='shopylinkerp'}</button>
</form>
<div class="form-group">
    <a href="{$link->getAdminLink('AdminShopylinkerpManager', true, [], ['action' => 'showRegister'])}">{l s="Don't have an account? Sign up" mod='shopylinkerp'}</a>
</div>