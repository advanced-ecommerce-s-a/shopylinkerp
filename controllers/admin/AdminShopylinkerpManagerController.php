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

        $userData = $config['user'];

        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/dashboard.tpl');

        $tpl->assign('userData', $userData);

        return $tpl;
    }
    #endregion

    #region Login
    private function showLogin()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/login.tpl');

        return $tpl;
    }

    public function processLogin()
    {
        $username = Tools::getValue('username');
        $password = Tools::getValue('password');

        $user = $this->callShopylinkerApi('externalLogin', [
            'username' => $username,
            'password' => $password,
        ]);

        //$user = null;
        $user['id'] = 5;

        if (isset($user['id']))
        {
            //TODO ver si para actualizar la configuracion tengo que cargarla
            $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);
            $config['user']['id'] = $user['id'];

            //update SHOPYLINKER_UDATA config
            Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));

            //redirect to dashboard
            $result = $this->showDashboard();
        } else
        {
            //TODO procesar los codigo de respuesta de error
            $this->errors[] = 'user not exist';
            $result = $this->showLogin();
        }

        return $result;
    }

    public function processLogout()
    {
        //TODO ver si para actualizar la configuracion tengo que cargarla
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $config['user'] = [
            'id' => 0,
            'username' => '',
            'pass' => '',
            'name' => '',
            'lastname' => '',
            'status' => 0,
        ];

        Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));

        $result = $this->showLogin();

        return $result;
    }
    #endregion

    #region Register
    private function showRegister()
    {
        $tpl = $this->context->smarty->createTemplate('module:shopylinkerp/views/templates/admin/register.tpl');

        return $tpl;
    }

    private function processRegister()
    {
        $name = Tools::getValue('name');
        $lastname = Tools::getValue('lastname');
        $email = Tools::getValue('email');
        $password = Tools::getValue('password');

        $user = $this->callShopylinkerApi('externalRegister', [
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
        ]);

        //$user = null;
        $user['id'] = 5;

        if (isset($user['id']))
        {
            $config['user'] = [
                'id' => $user['id'],
                'username' => $email,
                'pass' => $password,
                'name' => $name,
                'lastname' => $lastname,
                'status' => 0,
            ];

            //update SHOPYLINKER_UDATA config
            Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));

            //redirect to dashboard
            $result = $this->showDashboard();
        } else
        {
            //TODO procesar los codigo de respuesta de error
            $this->errors[] = 'no register';
            $result = $this->showRegister();
        }

        return $result;
    }

    private function processValidateUser()
    {
        $code = Tools::getValue('code');

        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);
        $idUser = $config['user']['id'];

        $user = $this->callShopylinkerApi('uservalidation', [
            'idUser' => $idUser,
            'code' => $code,
        ]);

        $user['valid'] = 0;

        if (isset($user['valid']))
        {
            //TODO ver si para actualizar la configuracion tengo que cargarla
            $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);
            $config['user']['status'] = 1;

            //update SHOPYLINKER_UDATA config
            Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));

            //TODO procesar los codigo de respuesta
            $this->confirmations[] = 'User validated successfully';

        } else
        {
            //TODO procesar los codigo de respuesta de error
            $this->errors[] = 'The verification code is wrong';
        }

        //redirect to dashboard
        $result = $this->showDashboard();

        return $result;
    }

    private function processResendValidateUser()
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);
        $idUser = $config['user']['id'];

        $resend = $this->callShopylinkerApi('resendvalidacion', [
            'idUser' => $idUser,
        ]);

        $resend = false;

        if ($resend)
        {

            //TODO procesar los codigo de respuesta
            $this->confirmations[] = 'An email has been sent with the verification code';

        } else
        {
            //TODO procesar los codigo de respuesta de error
            $this->errors[] = 'An error occurred while sending the verification code';
        }

        //redirect to dashboard
        $result = $this->showDashboard();

        return $result;
    }
    #endregion

    #region generic
    //TODO ver si esto lo pongo en una clase aparte
    private function callShopylinkerApi($action, $parameters)
    {
        $result = null;

//        $url = 'https://shopylinker.com/api?'.$action;
//        $apiKey = '';
//
//        // Initialize cURL session
//        $ch = curl_init();
//
//        // Set cURL options
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            "Authorization: Bearer " . $apiKey,
//            "Content-Type: application/json"
//        ));
//
//        // Execute cURL session and get the response
//        $response = curl_exec($ch);
//
//        // Check for errors
//        if (curl_errno($ch)) {
//            echo "Error: " . curl_error($ch);
//        } else {
//            // Decode the JSON response
//            $result = json_decode($response, true);
//        }
//
//        // Close cURL session
//        curl_close($ch);


        return $result;
    }
    #endregion
}

