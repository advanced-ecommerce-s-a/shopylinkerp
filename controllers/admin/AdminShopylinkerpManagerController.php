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
        $this->meta_title[] = $this->l('Shopylinker');

        $this->toolbar_title[] = $this->meta_title;
    }

    public function renderForm()
    {
        $config = Configuration::get('SHOPYLINKER_UDATA');

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/login.tpl');

        if($config['user']['id'] != 0){
            $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/dashboard.tpl');
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
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/login.tpl');

        $token = Tools::getAdminTokenLite('AdminSmtImportSupplier');

        $tpl->assign('token', $token);

        //return $tpl->fetch();
    }
    public function postProcessLogin()
    {
        if (Tools::isSubmit('username') && Tools::isSubmit('password')) {
            $username = Tools::getValue('username');
            $password = Tools::getValue('password');


            $user_created = true;


            if ($user_created) {
                $this->confirmations[] = '';
            } else {
                $this->errors[] = '';
            }
        }
    }
    #endregion



}

