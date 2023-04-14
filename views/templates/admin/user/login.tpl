<div class="row">
    <div class="col-md-4"></div>
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-heading">{l s='Sign in to Shopylinker' mod='shopylinkerp'}</div>
            <form id="form_login" method="post">
                <div class="row">
                    <div class="col-12">
                        <div id="div_message" class="alert alert-danger" style="display: none"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px">{l s='Username' mod='shopylinkerp'}: </label>
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
                            <button type="button" class="btn btn-primary" data-action="processLogin">{l s="Sign in" mod='shopylinkerp'}</button>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <div class="form-group">
                            <a href="javascript:void(0)" data-action="displayRegister">{l s="Don't have an account? Sign up" mod='shopylinkerp'}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
