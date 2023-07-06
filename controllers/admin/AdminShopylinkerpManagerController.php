<?php
/**
 * 2018-2023 Optyum S.A. All Rights Reserved.
 *
 * NOTICE:  All information contained herein is, and remains
 * the property of Optyum S.A. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Optyum S.A.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Optyum S.A.
 *
 * @author    Optyum S.A.
 * @copyright 2018-2023 Optyum S.A.
 * @license  Optyum S.A. All Rights Reserved
 *  International Registered Trademark & Property of Optyum S.A.
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\Module\shopylinkerp\Classes\ShopyUser;
use PrestaShop\Module\shopylinkerp\Classes\ShopyInstance;
use PrestaShop\Module\shopylinkerp\Classes\ShopyManager;
use PrestaShop\Module\shopylinkerp\Classes\InstanceStatus;
use PrestaShop\Module\shopylinkerp\Classes\ApiCall;
use PrestaShop\Module\shopylinkerp\Classes\HTTPErrorHelper;

class AdminShopylinkerpManagerController extends ModuleAdminController
{
    const SHOPYLINKER_NAME = 'Shopylinker';
    const SHOPYLINKER_LASTANME = 'Admin';
    const SHOPYLINKER_EMAIL = 'noreply@shopylinker.com';
    const SHOPYLINKER_PROFILE = _PS_ADMIN_PROFILE_;


    public function __construct()
    {
        // Call of the parent constructor method
        parent::__construct();

        $this->bootstrap = true;

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

        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/plugin/jquery/jquery.blockUI.js');
        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/plugin/jquery/jquery.form.min.js');
        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/plugin/jquery/jquery.validate.js');

        $this->addJS(_MODULE_DIR_ . $this->module->name . '/views/js/admin/shopy-manager.js?version='.rand(0,100));

        $this->addCSS(_MODULE_DIR_ . $this->module->name . '/views/css/general.css?version='.rand(0,100));
        $this->addCSS(_MODULE_DIR_ . $this->module->name . '/views/css/fonts.css?version='.rand(0,100));
    }


    public function renderList()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/index.tpl');

        $user = ShopyManager::getShopyUser();
        $include_tpl = 'module:shopylinkerp/views/templates/admin/user/register.tpl';
        if (isset($user['id']) && $user['id'] != 0) {
            $userData = ShopyManager::getShopyUser();
            $tpl->assign('userData', $userData);

            $instanceData = ShopyManager::getShopyInstance();
            $tpl->assign('instanceData', $instanceData);

            $lang = $this->context->language->iso_code;

            $tpl->assign('extlogin', ShopyManager::getExtLoginUrl($lang));

            $include_tpl = 'module:shopylinkerp/views/templates/admin/dashboard.tpl';
        }

        $tpl->assign('include_tpl', $include_tpl);

        $token = Tools::getAdminTokenLite('AdminShopylinkerpManager');

        $tpl->assign('token', $token);

        return $tpl->fetch();
    }

    #region Dashboard
    public function ajaxProcessDisplayDashboard()
    {
        $tpl = $this->displayDashboard();
        die($tpl->fetch());
    }


    private function displayDashboard()
    {
        $userData = ShopyManager::getShopyUser();

        $instanceData = ShopyManager::getShopyInstance();

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/dashboard.tpl');

        $lang = $this->context->language->iso_code;

        $tpl->assign('extlogin', ShopyManager::getExtLoginUrl($lang));

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
        $username = Tools::getValue('smt_username');
        $password = Tools::getValue('smt_password');

        $apiResult = ShopyManager::callShopyApi(ApiCall::LOGIN, [
            'user' => $username,
            'pass' => $password,
        ]);

        $response = [
            'status' => 0,
            'error' => '',
        ];

        if (isset($apiResult['success']) && $apiResult['success']) {
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
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans('The user does not exist or the password is incorrect.');
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans('The user is not active.');
                        break;
                    }
                    case 4:
                    {
                        $error = $this->trans('The user is locked.');
                        break;
                    }
                    case 5:
                    {
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

        $context = Context::getContext();
        $language = $context->language;

        // Obtener el código de idioma
        $languageCode = $language->iso_code;

        $apiResult = ShopyManager::callShopyApi(ApiCall::REGISTER, [
            'email' => $email,
            'pass' => $password,
            'name' => $name,
            'apel' => $lastname,
            'lang' => $languageCode
        ]);

        if (isset($apiResult['success']) && $apiResult['success']) {
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
        } else {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans("The user's email already exists.");
                        break;
                    }
                    case 3:
                    {
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

    public function ajaxProcessValidateUser()
    {
        $code = Tools::getValue('code');

        $user = new ShopyUser();
        $idUser = $user->getId();

        $apiResult = ShopyManager::callShopyApi(ApiCall::USER_VALIDATION, [
            'iduser' => $idUser,
            'code' => $code,
        ]);

        if (isset($apiResult['success']) && $apiResult['success']) {
            $user = new ShopyUser();
            $user->setStatus(1);
            $user->update();

            $response['html'] = $this->displayDashboard()->fetch();
            $response['status'] = 0;

        } else {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans("The code does not match.");
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans("The user is already active.");
                        break;
                    }
                    case 4:
                    {
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

        $apiResult = ShopyManager::callShopyApi(ApiCall::RESEND_USER_VALIDATION, [
            'iduser' => $user->getId(),
            'pass' => $user->getPass(),
        ]);

        if (isset($apiResult['success']) && $apiResult['success']) {
            $this->confirmations[] = 'An email has been sent with the verification code';

        } else {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans("The user does not exist.");
                        break;
                    }
                    case 3:
                    {
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

    public function ajaxProcessFinishteStore()
    {
        $instancia = new ShopyInstance();
        $instancia->setStatus(InstanceStatus::VALID);
        $instancia->update();

        $user = new ShopyUser();

        //call to the api
        $apiResult = ShopyManager::callShopyApi(ApiCall::FINISH_STORE_ASOCIATION, [
            'iduser' => $user->getId(),
            'pass' => $user->getPass(),
            'idinstancia' => $instancia->getIdInstance(),
        ]);

        $response = [];
        $response['status'] = 1;

        die(json_encode($response));
    }

    public function ajaxProcessDisplayAssociateStore()
    {
        $instancia = new ShopyInstance();
        $useradmin = $instancia->getUserAdmin();
        $passadmin = $instancia->getPassAdmin();

        $server = $instancia->getServer() ?: _DB_SERVER_;
        if ($server == 'localhost' || $server == '127.0.0.1') {
            //el server tiene que ser igual al dominio en que estamos
            $server = $_SERVER['SERVER_NAME'];
        }

        $name_bd = $instancia->getNameBd() ?: _DB_NAME_;
        $user_bd = $instancia->getUserBd() ?: _DB_USER_;
        $pass_bd = $instancia->getPassBd() ?: _DB_PASSWD_;

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/instance/wizard.tpl');

        $tpl->assign('useradmin', $useradmin);
        $tpl->assign('passadmin', $passadmin);

        $tpl->assign('server', $server);
        $tpl->assign('name_bd', $name_bd);
        $tpl->assign('user_bd', $user_bd);
        $tpl->assign('pass_bd', $pass_bd);
        $tpl->assign('conectionmode', $instancia->getConnectionMode());
        $tpl->assign('conectionKey', $instancia->getConnectionKey());
        $tpl->assign('userftp', $instancia->getFtpUser());
        $tpl->assign('passftp', $instancia->getFtpPass());
        $tpl->assign('ftpserver', $instancia->getFtpServer());
        $tpl->assign('ftpport', $instancia->getFtpPort());
        $tpl->assign('ftproot', $instancia->getFtpRoot());
        $tpl->assign('ftpssl', $instancia->getFtpSsl());

        $link = new Link();

        $tpl->assign('link', $link);

        $response = $tpl->fetch();

        die($response);
    }

    public function ajaxProcessResendEmailCode()
    {
        $user = new ShopyUser();

        $error = '';
        $response = [
            'status' => 1,
            'error' => '',
        ];

        $apiResult = ShopyManager::callShopyApi(ApiCall::RESEND_USER_VALIDATION, [
            'iduser' => $user->getId(),
            'pass' => $user->getPass(),
        ]);

        if (isset($apiResult['success']) && !$apiResult['success']) {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans('The user its not found.');
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans('The user is already active.');
                        break;
                    }
                }
            }
        }
        if ($error) {
            $response['status'] = 0;
            $response['error'] = $error;
        } else {
            $response['text'] = $this->trans('The mail have been send!');;
        }

        die(json_encode($response));
    }

    public function ajaxProcessCheckAndRegisterdb()
    {
        $intance = new ShopyInstance();
        $user = new ShopyUser();

        $response = [
            'status' => 1,
            'error' => '',
        ];

        //TODO ver si la contraseña se encripta
        $server = Tools::getValue('server');
        $name_bd = Tools::getValue('name_bd');
        $user_bd = Tools::getValue('user_bd');
        $pass_bd = Tools::getValue('pass_bd');
        $prefix_bd = _DB_PREFIX_;

        $error = null;

        $apiResult = ShopyManager::callShopyApi(ApiCall::CHECK_BD, [
            'servidor' => $server,
            'user' => $user_bd,
            'pass' => $pass_bd,
            'nombrebd' => $name_bd,
            'prefix' => $prefix_bd,
            'tipotienda' => 'pre',
        ]);

        if (isset($apiResult['success']) && $apiResult['success']) {
            //mando a editar los datos
            $data = ['modoConection' => 1,
                'servidor' => $server,
                'nombre_bd' => $name_bd,
                'user_bd' => $user_bd,
                'pass_bd' => $pass_bd,
                'prefix' => $prefix_bd
            ];

            $response = $this->editStoreData($intance->getIdInstance(), $user->getId(), $user->getPass(), $data);

        } else {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 1045:
                    {
                        $error = $this->trans('Cannot access with those credentials.');
                        break;
                    }
                    case 2002:
                    {
                        $error = $this->trans('The server cannot be found.');
                        break;
                    }
                    case 1049:
                    {
                        $error = $this->trans('The database cannot be found.');
                        break;
                    }
                    case 2:
                    {
                        $error = $this->trans('The prefix of the tables is incorrect.');
                        break;
                    }
                }
            }
        }

        if ($error) {
            $response['status'] = 0;
            $response['error'] = $error;
        } else {
            $response['text'] = $this->trans('The database information is correct!');;
        }

        die(json_encode($response));
    }

    public function ajaxProcessCheckAndRegisterFtp()
    {
        $intance = new ShopyInstance();
        $user = new ShopyUser();

        $response = [
            'status' => 1,
            'error' => '',
        ];

        //TODO ver si la contraseña se encripta
        $server = Tools::getValue('ftp_server');
        $port = Tools::getValue('ftp_port');
        $username = Tools::getValue('ftp_user');
        $pass = Tools::getValue('ftp_pass');
        $ssl = Tools::getValue('ftp_ssl');
        $root = Tools::getValue('ftp_root');

        $prefix_bd = _DB_PREFIX_;

        $error = null;

        $apiResult = ShopyManager::callShopyApi(ApiCall::CHECK_FTP, [
            'servidor' => $server,
            'user' => $username,
            'pass' => $pass,
            'puerto' => $port,
            'ssl' => $ssl,
            'raiz' => $root,
            'tipotienda' => 'pre',
        ]);

        if (isset($apiResult['success']) && $apiResult['success']) {
            //mando a editar los datos
            $data = ['modoConection' => 1,
                'ftp_user' => $username,
                'ftp_pass' => $pass,
                'ftp_server' => $server,
                'ftp_port' => $port,
                'ftpssl' => $ssl,
                'ftpraiz' => $root,
            ];

            $response = $this->editStoreData($intance->getIdInstance(), $user->getId(), $user->getPass(), $data);

        } else {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 1:
                    {
                        $error = $this->trans('Cannot access with those credentials.');
                        break;
                    }
                    case 2:
                    {
                        $error = $this->trans('There are no write permissions for the user.');
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans('The specified root folder is not the root of the store');
                        break;
                    }
                    case 4:
                    {
                        $error = $apiResult['msg'];
                        break;
                    }
                    case 5:
                    {
                        $error = $this->trans('Cannot establish connection to the server. Check server address');
                        break;
                    }
                }
            }
        }

        if ($error) {
            $response['status'] = 0;
            $response['error'] = $error;
        } else {
            $response['text'] = $this->trans('The FTP information is correct!');;
        }

        die(json_encode($response));
    }

    public function ajaxProcessRegisterAssociateStore()
    {
        $step = Tools::getValue('step');
        $context = Context::getContext();

        $response = [
            'status' => 1,
            'step' => $step,
            'error' => '',
        ];

        $intance = new ShopyInstance();
        $user = new ShopyUser();

        //TODO ver si esto lo paso al shopymanager
        switch ($step) {
            case 1: //Step 1 - Administrator information
            {
                //creo el usuario administrador si no existe ya, y lo mando
                $employee = new Employee();
                $existingEmployee = $employee->getByEmail(self::SHOPYLINKER_EMAIL);

                $password = $user->generarPassword();

                dump($existingEmployee);
                if (!$existingEmployee) {

                    dump("entre");
                    $employee = new Employee();
                    $employee->firstname = self::SHOPYLINKER_NAME;
                    $employee->lastname = self::SHOPYLINKER_LASTANME;
                    $employee->email = self::SHOPYLINKER_EMAIL;
                    $employee->passwd = Tools::hash($password);
                    $employee->id_profile = self::SHOPYLINKER_PROFILE;
                    $employee->id_lang = $context->language->id;

                    dump($employee);
                    if (!$employee->add()) {
                        $response['status'] = 0;
                        $response['error'] = 25;
                    }
                } else {
                    dump("estoy en el otro");
                    $existingEmployee->passwd = Tools::hash($password);
                    $existingEmployee->update();
                }
                $useradmin = self::SHOPYLINKER_EMAIL;
                $passadmin = $password;

                /*$useradmin = Tools::getValue('useradmin');
                $passadmin = Tools::getValue('passadmin');*/

                $error = $this->checkAndRegisteStore($useradmin, $passadmin, $intance, $user);

                if ($error) {
                    $response['status'] = 0;
                    $response['error'] = $error;
                } else {
                    $response['text'] = $this->trans('The user has been successfully created and Shopylinker can connect to your store. You must click next to continue with the process');;
                }
                break;
            }
            case 2: //Step 2 - ShopyLinker connection data.
            {
                $connection_mode = Tools::getValue('connection_mode');

                $error = null;
                switch ($connection_mode) {
                    case 2://Proxy
                    {
                        $connection_key = Tools::getValue('connection_key');

                        $apiResult = ShopyManager::callShopyApi(ApiCall::EDIT_STORE, [
                            'idinstancia' => $intance->getIdInstance(),
                            'iduser' => $user->getId(),
                            'pass' => $user->getPass(),
                            'modoConection' => $connection_mode,
                            'claveConection' => $connection_key,
                        ]);

                        if (isset($apiResult['success']) && $apiResult['success']) {
                            $intance = new ShopyInstance();
                            $intance->setConnectionMode($connection_mode);
                            $intance->setConnectionKey($connection_key);
                            $intance->setStatus(InstanceStatus::REGISTER);
                            $intance->update();
                        } else {
                            $error = 'There is no connection with the API.';
                            if (isset($apiResult['error'])) {
                                switch ($apiResult['error']) {
                                    case 2:
                                    {
                                        $error = $this->trans('The instance to edit cannot be found.');
                                        break;
                                    }
                                    case 3:
                                    {
                                        $error = $this->trans('The user does not exist or the password is incorrect.');
                                        break;
                                    }
                                    case 4:
                                    {
                                        $error = $this->trans('Data error.');
                                        break;
                                    }
                                }
                            }
                        }
                        break;
                    }
                    case 1://Direct
                    {

                        break;
                    }
                }

                if ($error) {
                    $response['status'] = 0;
                    $response['error'] = $error;
                } else {
                    $response['text'] = $this->trans('The code have been saved correctly, you can finish the asociation!');;
                }

                break;
            }
        }

        die(json_encode($response));
    }

    private function checkAndRegisteStore($useradmin, $passadmin, ShopyInstance $intance, $user)
    {
        $error = null;

        //check access store
        $dataaccess = [
            'urlfront' => $this->getShopUrl(),
            'urladmin' => $this->getAdminUrl(),
            'user' => $useradmin,
            'pass' => $passadmin,
            'tipotienda' => 'pre',
        ];

        $apiResult = ShopyManager::callShopyApi(ApiCall::CHECK_ACCESS, $dataaccess);

        if (isset($apiResult['success']) && $apiResult['success']) {

            $version = Configuration::get('PS_INSTALL_VERSION');
            //register store
            $data = [
                'iduser' => $user->getId(),
                'pass' => $user->getPass(),
                'nombre' => $this->getShopName(),
                'prefijo' => _DB_PREFIX_,
                'urlfront' => $this->getShopUrl(),
                'urladmin' => $this->getAdminUrl(),
                'useradmin' => $useradmin,
                'passadmin' => $passadmin,
                'version' => $version,
            ];
            $apiResult = ShopyManager::callShopyApi(ApiCall::ADD_STORE, $data);


            //si devuelven un idINstance es que esta ok que la registro o ya existia
            if ((isset($apiResult['success']) && $apiResult['success']) || $apiResult['idinstance']) {
                $intance->setIdInstance($apiResult['idinstance']);
                $intance->setDateAdd($apiResult['dateadd']);
                $intance->setPrefix(_DB_PREFIX_);
                $intance->setStatus(InstanceStatus::REGISTER);
                $intance->setUrlFront($this->getShopUrl());
                $intance->setUrlAdmin($this->getAdminUrl());
                $intance->setUserAdmin($useradmin);
                $intance->setPassAdmin($passadmin);
                $intance->update();
            } else {
                $error = 'There is no connection with the API.';
                if (isset($apiResult['error'])) {
                    switch ($apiResult['error']) {
                        case 2:
                        {
                            $error = $this->trans('There is already an instance with that front URL in another user.');
                            break;
                        }
                        case 3:
                        {
                            $error = $this->trans('The instance is already registered by this user');
                            break;
                        }
                        case 4:
                        {
                            $error = $this->trans('A parameter is missing.');
                            break;
                        }
                        case 5:
                        {
                            $error = $this->trans('The user does not exist');
                            break;
                        }
                        case 6:
                        {
                            $datasrs = [];
                            foreach ($data as $key => $val) {
                                $datasrs[] = $key . '=' . $val;
                            }
                            $error = $this->trans('Unknown error. Contact with soporte@shopylinker.com');
                            $error .= "<br>" . $apiResult['errormsg'];
                            $error .= "<br>" . implode("&", $datasrs);

                            break;
                        }
                    }
                }
            }
        } else {


            $error = 'There is no connection with the API';
            if (isset($apiResult['error'])) {

                //debo hacer tratamiento del mensaje segun el codigo de respuesta
                $httpcode = $apiResult['httpcode'];
                $textCode = $this->trans(HTTPErrorHelper::getErrorMessage($httpcode));

                switch ($apiResult['error']) {
                    case 1:
                    {
                        $error = $this->trans('No access to the store front ') . ': ' . $this->getShopUrl() . '<br>' . $textCode;
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans('No access to the store admin ') . ': ' . $this->getAdminUrl() . '<br>' . $textCode;
                        break;
                    }
                }
            }
        }

        return $error;
    }

    private function checkBdDataStore($server, $name_bd, $user_bd, $pass_bd, $prefix_bd)
    {
        $error = null;

        $apiResult = ShopyManager::callShopyApi(ApiCall::CHECK_BD, [
            'server' => $server,
            'name_bd' => $name_bd,
            'user_bd' => $user_bd,
            'pass_bd' => $pass_bd,
            'prefix_bd' => $prefix_bd,
            'tipotienda' => '',
        ]);

        if (!isset($apiResult['success']) || !$apiResult['success']) {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans('Cannot access with those credentials.');
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans('The server cannot be found.');
                        break;
                    }
                    case 4:
                    {
                        $error = $this->trans('No se encuentra la base de datos');
                        break;
                    }
                }
            }
        }

        return $error;
    }

    private function checkFtpDataStore($ftp_user, $ftp_pass, $ftp_server, $ftp_port, $ftp_ssl, $ftp_root)
    {
        $error = null;

        $apiResult = ShopyManager::callShopyApi(ApiCall::CHECK_FTP, [
            'ftp_user' => $ftp_user,
            'ftp_pass' => $ftp_pass,
            'ftp_server' => $ftp_server,
            'ftp_port' => $ftp_port,
            'ftp_ssl' => $ftp_ssl,
            'ftp_root' => $ftp_root,
            'tipotienda' => '',
        ]);

        if (!isset($apiResult['success']) || !$apiResult['success']) {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans('No write permissions.');
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans('The store folder is not valid.');
                        break;
                    }
                    case 4:
                    {
                        $error = $this->trans('Unknown error.');
                        break;
                    }
                }
            }
        }

        return $error;
    }

    private function editStoreData($idinstancia, $iduser, $passUser, $data = [])
    {
        $response = [
            'status' => 1,
            'error' => '',
        ];

        $arrayMapfunction = ['modoConection' => 'setConnectionMode',
            'servidor' => 'setServer',
            'nombre_bd' => 'setNameBd',
            'user_bd' => 'setUserBd',
            'pass_bd' => 'setPassBd',
            'prefix' => 'setPrefix',
            'ftp_user' => 'setFtpUser',
            'ftp_pass' => 'setFtpPass',
            'ftp_server' => 'setFtpServer',
            'ftp_port' => 'setFtpPort',
            'ftpssl' => 'setFtpSsl',
            'ftpraiz' => 'setFtpRoot',];

        $dataSend = $data;
        $dataSend['idinstancia'] = $idinstancia;
        $dataSend['iduser'] = $iduser;
        $dataSend['pass'] = $passUser;

        $apiResult = ShopyManager::callShopyApi(ApiCall::EDIT_STORE, $dataSend);

        if (isset($apiResult['success']) && $apiResult['success']) {

            $intance = new ShopyInstance();
            foreach ($arrayMapfunction as $key => $funtion) {
                if (isset($data[$key])) {
                    $intance->$funtion($data[$key]);
                }
            }

            $intance->update();
        } else {
            $error = 'There is no connection with the API.';
            if (isset($apiResult['error'])) {
                switch ($apiResult['error']) {
                    case 2:
                    {
                        $error = $this->trans('The instance to edit cannot be found.');
                        break;
                    }
                    case 3:
                    {
                        $error = $this->trans('The user does not exist or the password is incorrect.');
                        break;
                    }
                    case 4:
                    {
                        $error = $this->trans('Data error.');
                        break;
                    }
                }
            }
            $response['error'] = $error;
            $response['status'] = 0;
        }

        return $response;
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

        $url = $shop->getBaseURL(true);
        if (!$url)
            $url = $shop->getBaseURL();

        return $url;
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

