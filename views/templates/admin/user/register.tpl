<div class="row">
    <div class="col-md-3"></div>
    <div class="col-lg-6">
        <div class="panel">
            <div class="panel-heading">{l s='Sign up in Shopylinker' mod='shopylinkerp'}</div>
            <form id="form_register" method="post">
                <div class="row">
                    <div class="col-12">
                        <div id="div_message" class="alert alert-danger" style="display: none"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="username" style="margin-top: 5px">{l s='Email' mod='shopylinkerp'}:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label for="password" style="margin-top: 5px">{l s='Password' mod='shopylinkerp'}:</label>
                            </div>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px">{l s='Confirm Password' mod='shopylinkerp'}:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="rpassword" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px">{l s='Name' mod='shopylinkerp'}:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-3 text-right">
                                <label style="margin-top: 5px">{l s='Last name' mod='shopylinkerp'}:</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="lastname" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary" data-action="processRegister">{l s="Register" mod='shopylinkerp'}</button>
                        </div>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                        <div class="form-group">
                            <a href="javascript:void(0)" data-action="displayLogin">{l s="Go to login" mod='shopylinkerp'}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>