<?php
class AdminShopylinkerpManagerController extends ModuleAdminController
{
    public function __construct()
    {
        // Call of the parent constructor method
        parent::__construct();

        // Set fields form for form view
        $this->context = Context::getContext();
        $this->context->controller = $this;

        // Define meta and toolbar title
        //todofredy usar el metodo que no esta deprecado, si entras a la funcion te lo dice
        $this->meta_title[] = $this->l('Shopylinker');

        $this->toolbar_title[] = $this->meta_title;

        $action = Tools::getValue('action');

        switch ($action){
            case 'processLogin':{
                $this->processLogin();
                break;
            }
            default:{
                $this->renderLogin();
            }
        }
    }

    public function renderForm()
    {
        $config = Configuration::get('SHOPYLINKER_UDATA');

        $tpl = $this->renderLogin();

        if($config['user']['id'] != 0){
            $tpl = $this->renderDashboard();
        }

        return $tpl->fetch();
    }

    public function renderView()
    {
        //return parent::renderView();
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/view.tpl');

        //$tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/list.tpl');

        return $tpl->fetch();
    }

    public function renderList()
    {
        //return parent::renderList();

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/list.tpl');

        //$tpl = $this->context->smarty->createTemplate(dirname(__FILE__). '/../../views/templates/admin/list.tpl');

        return $tpl->fetch();
    }

    #region Login
    private function renderLogin()
    {
//        $token = Tools::getAdminTokenLite('AdminSmtImportSupplier');
//        $tpl->assign('token', $token);
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/login.tpl');

        $form_action =  $this->context->link->getAdminLink('AdminShopylinkerpManager');

        $tpl->assign('form_action', $form_action);

        return $tpl;
    }
    public function processLogin()
    {
        if (Tools::isSubmit('username') && Tools::isSubmit('password'))
        {
            $username = Tools::getValue('username');
            $password = Tools::getValue('password');
            $user_created = true;

            if ($user_created) {
                $this->confirmations[] = 'OK';
            } else {
                $this->errors[] = 'KO';
            }
        }
    }
    #endregion

    #region Dashboard
    private function renderDashboard()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/login.tpl');

        $url =  $this->context->link->getAdminLink('AdminShopylinkerpManager');

        $token = Tools::getAdminTokenLite('AdminSmtImportSupplier');

        $tpl->assign('token', $token);
        $tpl->assign('url', $url);

        return $tpl;
    }
    #endregion
}

