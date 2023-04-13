<?php

namespace PrestaShop\Module\shopylinkerp\Classes;

use Configuration;
class ShopyManager
{
    static function init()
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        if(!isset($config['user']) && !isset($config['instance']))
        {
            //TODO ver si hay que pregunta si ya existe la configuracion
            $config['user'] = [
                'id' => 0,
                'username' => '',
                'pass' => '',
                'name' => '',
                'lastname' => '',
                'status' => 0,
            ];

            $config['instance'] = [
                'status' => 1,
                'id_instance' => 0,
                'prefix' => '',
                'url_front' => '',
                'url_admin' => '',
                'user_admin' => '',
                'pass_admin' => '',
                'connection_mode' => '',
                'server' => '',
                'name_bd' => '',
                'user_bd' => '',
                'pass_bd' => '',
                'ftp_user' => '',
                'ftp_pass' => '',
                'ftp_server' => '',
                'ftp_port' => '',
                'ftp_ssl' => '',
                'ftp_root' => '',
                'connection_key' => '',
                'date_add' => '',

            ];

            Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));
        }

        return $config;
    }

    static function getShopyUser()
    {
        $userData = ShopyManager::init();

        return $userData['user'];
    }

    static function setShopyUser($userData)
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $config['user'] = $userData;

        Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));
    }

    static function getShopyInstance()
    {
        $instanceData = ShopyManager::init();

        return $instanceData['instance'];
    }

    static function setShopyInstance($instanceData)
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $config['instance'] = $instanceData;

        Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));
    }

    static function callShopyApi($action, $parameters)
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

}
