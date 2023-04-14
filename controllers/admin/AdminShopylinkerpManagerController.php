<?php
use PrestaShop\Module\shopylinkerp\Classes\ShopyUser;
use PrestaShop\Module\shopylinkerp\Classes\ShopyInstance;
use PrestaShop\Module\shopylinkerp\Classes\ShopyManager;
class AdminShopylinkerpManagerController extends ModuleAdminController
{
    public function __construct()
    {
        // Call of the parent constructor method
        parent::__construct();

        $this->bootstrap = true;
        //$this->display = 'view';

        // Set fields form for form view
        $this->context = Context::getContext();

        $this->context->controller = $this;

        // Define meta and toolbar title
        $this->meta_title[] = $this->trans('Shopylinker');

        $this->toolbar_title[] = $this->meta_title;

    }
    public function setMedia($isNewTheme = false)
    {
        parent::setMedia($isNewTheme);

        $this->addJS(_MODULE_DIR_.$this->module->name.'/views/js/plugin/jquery/jquery.blockUI.js');
        $this->addJS(_MODULE_DIR_.$this->module->name.'/views/js/plugin/jquery/jquery.form.min.js');
        $this->addJS(_MODULE_DIR_.$this->module->name.'/views/js/plugin/jquery/jquery.validate.js');

        $this->addJS(_MODULE_DIR_.$this->module->name.'/views/js/admin/shopy-manager.js');
    }

//    public function initContent()
//    {
//        parent::initContent();
//
//        $link = new Link();
//
//        $this->context->smarty->assign('link', $link);
//
//        $this->setTemplate('module:shopylinkerp/views/templates/admin/user/login.tpl');
//    }

    public function renderList()
    {
//        $module_action = Tools::getValue('action');
//
//        if (!isset($module_action) || $module_action == '')
//        {
//            $module_action = 'displayLogin';
//
//            $user = ShopyManager::getShopyUser();
//            if(isset($user['id']) && $user['id'] != 0){
//                $module_action = 'displayDashboard';
//            }
//        }
//
//        $tpl = $this->$module_action();
//
//        $link = new Link();
//
//        $tpl->assign('link', $link);


        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/index.tpl');

        $user = ShopyManager::getShopyUser();
        $include_tpl = 'module:shopylinkerp/views/templates/admin/user/login.tpl';
        if(isset($user['id']) && $user['id'] != 0)
        {
            $userData = ShopyManager::getShopyUser();
            $tpl->assign('userData', $userData);

            $instanceData = ShopyManager::getShopyInstance();
            $tpl->assign('instanceData', $instanceData);

            $include_tpl = 'module:shopylinkerp/views/templates/admin/dashboard.tpl';
        }

        $tpl->assign('include_tpl', $include_tpl);

        $token = Tools::getAdminTokenLite('AdminShopylinkerpManager');

        $tpl->assign('token', $token);

        return $tpl->fetch();
    }

    #region Dashboard
    private function displayDashboard()
    {
        $userData = ShopyManager::getShopyUser();

        $instanceData = ShopyManager::getShopyInstance();

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/dashboard.tpl');

        $tpl->assign('userData', $userData);

        $tpl->assign('instanceData', $instanceData);

        return $tpl;
    }
    #endregion

    #region Login
    public function ajaxProcessDisplayLogin()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/user/login.tpl');

        die($tpl->fetch());
    }

    public function ajaxProcessLogin()
    {
        $username = Tools::getValue('username');
        $password = Tools::getValue('password');

        $apiResult = ShopyManager::callShopyApi('login', [
            'user' => $username,
            'pass' => $password,
        ]);

        $response = [
            'status' => 0,
            'error' => '',
        ];

        if (isset($apiResult['success']) && $apiResult['success'])
        {
            $uData = $apiResult['uData'];
            $user = new ShopyUser();
            $user->setId($apiResult['id']);
            $user->setUsername($username);
            $user->setPass($password);
            $user->setName($uData['name']);
            $user->setLastname($uData['lastname']);
            $user->setStatus($uData['status']);
            $user->update();

            $response['html'] = $this->displayDashboard()->fetch();
        } else {
            $error = 'There is no connection with the API.';
            if(isset($apiResult['error'])){
                switch ($apiResult['error']){
                    case 2:{
                        $error = $this->trans('The user does not exist or the password is incorrect.');
                        break;
                    }
                    case 3:{
                        $error = $this->trans('The user is not active.');
                        break;
                    }
                    case 4:{
                        $error = $this->trans('The user is locked.');
                        break;
                    }
                    case 5:{
                        $error = $this->trans('Empty parameters.');
                        break;
                    }
                }
            }
            $response['error'] = $error;
            $response['status'] = 1;
        }

        die(json_encode($response));
    }

    public function ajaxProcessLogout()
    {
        $user = new ShopyUser();
        $user->setId(0);
        $user->update();

        $this->ajaxProcessDisplayLogin();
    }
    #endregion

    #region Register
    public function ajaxProcessDisplayRegister()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/user/register.tpl');

        die($tpl->fetch());
    }

    public function ajaxProcessRegister()
    {
        $name = Tools::getValue('name');
        $lastname = Tools::getValue('lastname');
        $email = Tools::getValue('email');
        $password = Tools::getValue('password');

        $apiResult = ShopyManager::callShopyApi('register', [
            'email' => $email,
            'pass' => $password,
            'name' => $name,
            'apel' => $lastname
        ]);

        if (isset($apiResult['success']) && $apiResult['success'])
        {
            $user = new ShopyUser();
            $user->setId($apiResult['id']);
            $user->setUsername($email);
            $user->setPass($password);
            $user->setName($name);
            $user->setLastname($lastname);
            $user->setStatus(0);
            $user->update();

            $response['html'] = $this->displayDashboard()->fetch();
            $response['status'] = 0;
        } else
        {
            $error = 'There is no connection with the API.';
            if(isset($apiResult['error']))
            {
                switch ($apiResult['error'])
                {
                    case 2:{
                        $error = $this->trans("The user's email already exists.");
                        break;
                    }
                    case 3:{
                        $error = $this->trans("The email already exists.");
                        break;
                    }
                }
            }
            $response['status'] = 1;
            $response['error'] = $error;
        }

        die(json_encode($response));
    }

    public function processValidateUser()
    {
        $code = Tools::getValue('code');

        $user = new ShopyUser();
        $idUser = $user->getId();

        $apiResult = ShopyManager::callShopyApi('uservalidation', [
            'iduser' => $idUser,
            'code' => $code,
        ]);

        if (isset($apiResult['success']) && $apiResult['success'])
        {
            $user = new ShopyUser();
            $user->setStatus(1);
            $user->update();

            $response['html'] = $this->displayDashboard()->fetch();
            $response['status'] = 0;

        } else {
            $error = 'There is no connection with the API.';
            if(isset($apiResult['error']))
            {
                switch ($apiResult['error'])
                {
                    case 2:{
                        $error = $this->trans("The code does not match.");
                        break;
                    }
                    case 3:{
                        $error = $this->trans("The user is already active.");
                        break;
                    }
                    case 4:{
                        $error = $this->trans("The user does not exist.");
                        break;
                    }
                }
            }
            $response['status'] = 1;
            $response['error'] = $error;
        }

        die(json_encode($response));
    }

    public function processResendValidateUser()
    {
        $user = new ShopyUser();

        $apiResult = ShopyManager::callShopyApi('resendvalidacion', [
            'iduser' => $user->getId(),
            'pass' => $user->getPass(),
        ]);

        if (isset($apiResult['success']) && $apiResult['success'])
        {
            $this->confirmations[] = 'An email has been sent with the verification code';

        } else
        {
            $error = 'There is no connection with the API.';
            if(isset($apiResult['error']))
            {
                switch ($apiResult['error'])
                {
                    case 2:{
                        $error = $this->trans("The user does not exist.");
                        break;
                    }
                    case 3:{
                        $error = $this->trans("The user is already active");
                        break;
                    }
                }
            }
            $this->errors[] = $error;
        }

        //redirect to dashboard
        $result = $this->displayDashboard();

        return $result;
    }
    #endregion

    #region Instance
    public function ajaxProcessDisplayAssociateStore()
    {
        $instancia = new ShopyInstance();
        $useradmin = $instancia->getUserAdmin();
        $passadmin = $instancia->getPassAdmin();

        $server = $instancia->getServer()?:_DB_SERVER_;
        $name_bd = $instancia->getNameBd()?:_DB_NAME_;
        $user_bd = $instancia->getUserBd()?:_DB_USER_;
        $pass_bd = $instancia->getPassBd()?:_DB_PASSWD_;

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/instance/wizard.tpl');

        $tpl->assign('useradmin', $useradmin);
        $tpl->assign('passadmin', $passadmin);

        $tpl->assign('server', $server);
        $tpl->assign('name_bd', $name_bd);
        $tpl->assign('user_bd', $user_bd);
        $tpl->assign('pass_bd', $pass_bd);

        $link = new Link();

        $tpl->assign('link', $link);

        $response = $tpl->fetch();

        die($response);
    }

    public function ajaxProcessRegisterAssociateStore()
    {
        $step = Tools::getValue('step');

        $response = [
            'status' => 0,
            'step' => $step,
            'error' => '',
        ];

        $intance = new ShopyInstance();

        $user = new ShopyUser();

        //TODO ver si esto lo paso al shopymanager
        switch ($step)
        {
            case 1: //Step 1 - Administrator information
            {
                //TODO ver si la contraseña se encripta
                $useradmin = Tools::getValue('useradmin');
                $passadmin = Tools::getValue('passadmin');

                $apiResult = ShopyManager::callShopyApi('addstore', [
                    'idinstancia' => $intance->getIdInstance(),
                    'iduser' => $user->getId(),
                    'pass' => $user->getPass(),
                    'nombre' => $this->getShopName(),
                    'prefijo' => _DB_PREFIX_,
                    'urlfront' => $this->getShopUrl(),
                    'urladmin' => $this->getAdminUrl(),
                    'useradmin' => $useradmin,
                    'passadmin' => $passadmin,
                ]);

                if (isset($apiResult['success']) && $apiResult['success'])
                {
                    $intance->setIdInstance($apiResult['idinstance']);
                    $intance->setPrefix(_DB_PREFIX_);
                    $intance->setUrlFront($this->getShopUrl());
                    $intance->setUrlAdmin($this->getAdminUrl());
                    $intance->setUserAdmin($useradmin);
                    $intance->setPassAdmin($passadmin);
                    $intance->update();
                } else {
                    $error = 'There is no connection with the API.';
                    if(isset($apiResult['error']))
                    {
                        switch ($apiResult['error'])
                        {
                            case 2:{
                                $error = $this->trans('There is already an instance with that front URL in another user.');
                                break;
                            }
                            case 3:{
                                $error = $this->trans('The instance is already registered by this user');
                                break;
                            }
                            case 4:{
                                $error = $this->trans('A parameter is missing.');
                                break;
                            }
                            case 5:{
                                $error = $this->trans('The user does not exist');
                                break;
                            }
                            case 6:{
                                $error = $this->trans('Unknown error.');
                                break;
                            }
                        }
                    }
                    $response['error'] = $error;
                    $response['status'] = 1;
                }
                break;
            }
            case 2: //Step 2 - ShopyLinker connection data.
            {
                $connection_mode = Tools::getValue('connection_mode');

                switch ($connection_mode){
                    case 1://Proxy
                    {
                        $connection_key = Tools::getValue('connection_key');

                        $apiResult = ShopyManager::callShopyApi('editstore', [
                            'idinstancia' => $intance->getIdInstance(),
                            'iduser' => $user->getId(),
                            'pass' => $user->getPass(),
                            'connection_mode' => $connection_mode,
                            'connection_key' => $connection_key,
                        ]);

                        if (isset($apiResult['success']) && $apiResult['success'])
                        {
                            $intance = new ShopyInstance();
                            $intance->setConnectionMode($connection_mode);
                            $intance->setConnectionKey($connection_key);
                            $intance->setStatus(3);
                            $intance->update();
                        } else {
                            $error = 'There is no connection with the API.';
                            if(isset($apiResult['error']))
                            {
                                switch ($apiResult['error'])
                                {
                                    case 2:{
                                        $error = $this->trans('The instance to edit cannot be found.');
                                        break;
                                    }
                                    case 3:{
                                        $error = $this->trans('The user does not exist or the password is incorrect.');
                                        break;
                                    }
                                    case 4:{
                                        $error = $this->trans('Data error.');
                                        break;
                                    }
                                }
                            }
                            $response['error'] = $error;
                            $response['status'] = 1;
                        }
                        break;
                    }
                    case 2://Direct
                    {
                        $server = _DB_SERVER_;
                        $name_bd = _DB_NAME_;
                        $user_bd = _DB_USER_;
                        $pass_bd = _DB_PASSWD_;

                        $ftp_user = Tools::getValue('ftp_user');
                        $ftp_pass = Tools::getValue('ftp_pass');
                        $ftp_server = Tools::getValue('ftp_server');
                        $ftp_port = Tools::getValue('ftp_port');
                        $ftp_ssl = Tools::getValue('ftp_ssl');
                        $ftp_root = Tools::getValue('ftp_root');

                        $apiResult = ShopyManager::callShopyApi('editstore', [
                            'idinstancia' => $intance->getIdInstance(),
                            'iduser' => $user->getId(),
                            'pass' => $user->getPass(),
                            'connection_mode' => $connection_mode,
                            'server' => $server,
                            'name_bd' => $name_bd,
                            'user_bd' => $user_bd,
                            'pass_bd' => $pass_bd,
                            'ftp_user' => $ftp_user,
                            'ftp_pass' => $ftp_pass,
                            'ftp_server' => $ftp_server,
                            'ftp_port' => $ftp_port,
                            'ftp_ssl' => $ftp_ssl,
                            'ftp_root' => $ftp_root,
                        ]);

                        if (isset($apiResult['success']) && $apiResult['success'])
                        {
                            $intance = new ShopyInstance();
                            $intance->setConnectionMode($connection_mode);
                            $intance->setServer($server);
                            $intance->setNameBd($name_bd);
                            $intance->setUserBd($user_bd);
                            $intance->setPassBd($pass_bd);
                            $intance->setFtpUser($ftp_user);
                            $intance->setFtpPass($ftp_pass);
                            $intance->setFtpServer($ftp_server);
                            $intance->setFtpPort($ftp_port);
                            $intance->setFtpSsl($ftp_ssl);
                            $intance->setFtpRoot($ftp_root);
                            $intance->setStatus(3);
                            $intance->update();

                        } else {
                            $error = 'There is no connection with the API.';
                            if(isset($apiResult['error']))
                            {
                                switch ($apiResult['error'])
                                {
                                    case 2:{
                                        $error = $this->trans('The instance to edit cannot be found.');
                                        break;
                                    }
                                    case 3:{
                                        $error = $this->trans('The user does not exist or the password is incorrect.');
                                        break;
                                    }
                                    case 4:{
                                        $error = $this->trans('Data error.');
                                        break;
                                    }
                                }
                            }
                            $response['error'] = $error;
                            $response['status'] = 1;
                        }
                        break;
                    }
                }
                break;
            }
        }

        die(json_encode($response));
    }

    #endregion

    #region generic

    public function getShopName()
    {
        $context = Context::getContext();

        $shop = new Shop($context->shop->id);

        $shop_name = $shop->name;

        return $shop_name;
    }

    public function getShopUrl()
    {
        $context = Context::getContext();

        $shop = new Shop($context->shop->id);

        $shop_url = $shop->getBaseURL();

        return $shop_url;
    }

    public function getAdminUrl()
    {
        $shop_url = $this->getShopUrl();

        $admin_folder = _PS_ADMIN_DIR_;
        $admin_folder = basename($admin_folder);
        $admin_url = $shop_url . $admin_folder . '/';

        return $admin_url;
    }


    #endregion
}

