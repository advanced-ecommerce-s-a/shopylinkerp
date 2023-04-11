<?php
class AdminShopylinkerpRegistrationController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->context = Context::getContext();
        parent::__construct();

        $this->postProcess();
    }


    public function initContent()
    {
        parent::initContent();

        $this->context->smarty->assign(array(
            'form_action' => $this->context->link->getAdminLink('AdminShopylinkerpRegistration')
        ));

        $this->setTemplate('module:shopylinkerp/views/templates/registration_form.tpl');
    }

    public function postProcess()
    {
        if (Tools::isSubmit('username') && Tools::isSubmit('password')) {
            $username = Tools::getValue('username');
            $password = Tools::getValue('password');

            // Aquí puedes agregar el código para validar y guardar el nombre de usuario y la contraseña en la base de datos.
            $user_created = true;

            // Muestra un mensaje de confirmación o error según el resultado.
            if ($user_created) {
                $this->confirmations[] = 'Usuario registrado exitosamente.';
            } else {
                $this->errors[] = 'Ocurrió un error al registrar el usuario.';
            }
        }
    }


}

