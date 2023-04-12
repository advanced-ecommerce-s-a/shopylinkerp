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
        $this->meta_title[] = $this->trans('Shopylinker');

        $this->toolbar_title[] = $this->meta_title;

    }

    public function renderList()
    {
        $tpl = $this->showLogin();

        $action = Tools::getValue('action');

        switch ($action){
            case 'processLogin':{
                $tpl = $this->processLogin();
                break;
            }
            case 'processLogout':{
                $tpl = $this->processLogout();
                break;
            }
            case 'showRegister':{
                $tpl = $this->showRegister();
                break;
            }
            case 'processRegister':{
                $tpl = $this->processRegister();
                break;
            }
            case 'processValidateUser':{
                $tpl = $this->processValidateUser();
                break;
            }
            case 'processResendValidateUser':{
                $tpl = $this->processResendValidateUser();
                break;
            }
            case 'showAssociateStore':{
                $tpl = $this->showAssociateStore();
                break;
            }
            case 'processAssociateStore':{
                $tpl = $this->processAssociateStore();
                break;
            }
            default:{
                $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

                if(isset($config['user']['id']) && $config['user']['id'] != 0){
                    $tpl = $this->showDashboard();
                }
            }
        }

        $link = new Link();

        $tpl->assign('link', $link);

        return $tpl->fetch();
    }

    #region Dashboard
    private function showDashboard()
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $userData = new User();

        $instanceData = new Instance();

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/dashboard.tpl');

        $tpl->assign('userData', $userData);

        $tpl->assign('instanceData', $instanceData);

        return $tpl;
    }
    #endregion

    #region Login
    private function showLogin()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/user/login.tpl');

        return $tpl;
    }

    public function processLogin()
    {
        $username = Tools::getValue('username');
        $password = Tools::getValue('password');

        $apiResult = $this->callShopylinkerApi('login', [
            'user' => $username,
            'pass' => $password,
        ]);

        if (isset($apiResult['success']) && $apiResult['success'])
        {
            $user = new User();
            $user->setId($apiResult['id']);
            $user->setUsername($username);
            $user->setPass($password);
            $user->update();

            $result = $this->showDashboard();
        } else {
            $error = 'There is no connection with the API.';
            if(isset($apiResult['error'])){
                switch ($apiResult['error']){
                    case 2:{
                        $error = $this->trans('The user does not exist or the password is incorrect.');
                        break;
                    }
                    case 3:{
                        $error = 'The user is not active.';
                        break;
                    }
                    case 4:{
                        $error = 'The user is locked.';
                        break;
                    }
                    case 5:{
                        $error = 'Empty parameters.';
                        break;
                    }
                }
            }
            $this->errors[] = $error;
            $result = $this->showLogin();
        }

        return $result;
    }

    public function processLogout()
    {
        $user = new User();
        $user->setId(0);
        $user->setUsername('');
        $user->setPass('');
        $user->setName('');
        $user->setLastname('');
        $user->setStatus(0);
        $user->update();

        $result = $this->showLogin();

        return $result;
    }
    #endregion

    #region Register
    private function showRegister()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/user/register.tpl');

        return $tpl;
    }

    private function processRegister()
    {
        $name = Tools::getValue('name');
        $lastname = Tools::getValue('lastname');
        $email = Tools::getValue('email');
        $password = Tools::getValue('password');

        $apiResult = $this->callShopylinkerApi('register', [
            'email' => $email,
            'pass' => $password,
            'name' => $name,
            'apel' => $lastname
        ]);

        if (isset($apiResult['success ']) && $apiResult['success '])
        {
            $user = new User();
            $user->setId($apiResult['id']);
            $user->setUsername($email);
            $user->setPass($password);
            $user->setName($name);
            $user->setLastname($lastname);
            $user->setStatus(0);
            $user->update();

            $result = $this->showDashboard();
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
                }
            }
            $this->errors[] = $error;
            $result = $this->showRegister();
        }

        return $result;
    }

    private function processValidateUser()
    {
        $code = Tools::getValue('code');

        $user = new User();
        $idUser = $user->getId();

        $apiResult = $this->callShopylinkerApi('uservalidation', [
            'iduser' => $idUser,
            'code' => $code,
        ]);

        if (isset($apiResult['success']) && $apiResult['success'])
        {
            $user = new User();
            $user->setStatus(1);
            $user->update();

            $this->confirmations[] = $this->trans('User validated successfully');

        } else
        {
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
            $this->errors[] = $error;
        }

        //redirect to dashboard
        $result = $this->showDashboard();

        return $result;
    }

    private function processResendValidateUser()
    {
        $user = new User();

        $apiResult = $this->callShopylinkerApi('resendvalidacion', [
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
        $result = $this->showDashboard();

        return $result;
    }
    #endregion

    #region Instance
    private function showAssociateStore()
    {

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/instance/wizard.tpl');

        return $tpl;
    }

    private function processAssociateStore()
    {
        $step = Tools::getValue('step');

        switch ($step)
        {
            case 1: //Step 1 - Administrator information
            {
                $user = new User();

                //TODO ver si la contraseña se encripta
                $useradmin = Tools::getValue('useradmin');
                $passadmin = Tools::getValue('passadmin');

                $result = $this->callShopylinkerApi('', [
                    'iduser' => $user->getId(),
                    'nombre' => $this->getShopName(),
                    'prefijo' => _DB_PREFIX_,
                    'urlfront' => $this->getShopUrl(),
                    'urladmin' => $this->getAdminUrl(),
                    'useradmin' => $useradmin,
                    'passadmin' => $passadmin,
                ]);

                if($result)
                {
                    $intance = new Instance();
                    $intance->setIdInstance($result['id_instance']);
                    $intance->setPrefix(_DB_PREFIX_);
                    $intance->setUrlFront($this->getShopUrl());
                    $intance->setUrlAdmin($this->getAdminUrl());
                    $intance->setUserAdmin($useradmin);
                    $intance->setPassAdmin($passadmin);
                    $intance->update();
                }else{
                    $this->errors[] = 'The verification is wrong';
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

                        $result = $this->callShopylinkerApi('editstore', [
                            'connection_mode' => $connection_mode,
                            'connection_key' => $connection_key,
                        ]);

                        if($result)
                        {
                            $intance = new Instance();
                            $intance->setConnectionMode($connection_mode);
                            $intance->setConnectionKey($connection_key);
                            $intance->setStatus(3);
                            $intance->update();
                        }else{
                            $this->errors[] = 'The verification is wrong';
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

                        $result = $this->callShopylinkerApi('editstore', [
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

                        if($result)
                        {
                            $intance = new Instance();
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
                        }else{
                            $this->errors[] = 'The verification is wrong';
                        }
                        break;
                    }
                }

                break;
            }
        }
    }

    #endregion

    #region generic
    //TODO ver si esto lo pongo en una clase aparte
    private function callShopylinkerApi($action, $parameters)
    {
        //TODO ver si la url de la api se pone directo
        $url = 'https://devp.shopylinker.com/web/app_dev.php/es/api/'.$action;

        $strparams = '';
        if(is_array($parameters))
        {
            $separator = '&';
            foreach ($parameters as $key => $value) {
                $strparams .= $separator. $key . '=' . $value;
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strparams);
        $apiResult = curl_exec($ch);
        curl_close($ch);

        $result = null;
        if($apiResult){
            $result = json_decode($apiResult, true);
        }

        return $result;
    }

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

