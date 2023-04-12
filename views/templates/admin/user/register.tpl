<form id="registration-form" method="post" action="{$link->getAdminLink('AdminShopylinkerpManager')}">
    <div class="form-group">
        <label for="username">{l s='Email' mod='shopylinkerp'}:</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">{l s='Password' mod='shopylinkerp'}:</label>
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="password">{l s='Confirm Password' mod='shopylinkerp'}:</label>
        <input type="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label>{l s='Name' mod='shopylinkerp'}:</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
        <label>{l s='Last name' mod='shopylinkerp'}:</label>
        <input type="text" class="form-control" name="lastname" required>
    </div>
    <input type="hidden" name="action" value="processRegister">
    <button type="submit" class="btn btn-primary">{l s="Register" mod='shopylinkerp'}</button>
</form>