<form id="registration-form" method="post" action="{$form_action|escape:'htmlall':'UTF-8'}">
    <div class="form-group">
        <label for="username">Nombre de usuario:</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Registrar</button>
</form>
