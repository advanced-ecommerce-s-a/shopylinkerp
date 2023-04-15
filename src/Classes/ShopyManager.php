<?php

namespace PrestaShop\Module\shopylinkerp\Classes;

use Configuration;

class ShopyManager
{
    //const API_URL = 'https://devp.shopylinker.com/web/app_dev.php/es/api/';
    const API_URL = 'https://localhost/sassympresta/web/app_dev.php/es/api/';

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
                'status' => InstanceStatus::UNREGISTER,
                'id_instance' => 0,
                'prefix' => '',
                'url_front' => '',
                'url_admin' => '',
                'user_admin' => '',
                'pass_admin' => '',
                'connection_mode' => 2,
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
        $url = static::API_URL.$action."?rand=".rand(0,100000);

        $strparams = '';

        $strparams = http_build_query($parameters,'','&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strparams);
        //solo para localhost
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //--------------
        $apiResult = curl_exec($ch);
        $info = curl_getinfo($ch);
        if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
            print_r($info);
        }
        if($info['http_code']!=200)
        {
            $info = curl_getinfo($ch);
            echo $strparams;
            print_r($info);
        }
        /*echo $apiResult;
        echo $strparams;
        print_r($info);*/

        curl_close($ch);
        $result = null;
        if($apiResult){
            $result = json_decode($apiResult, true);
        }

        return $result;
    }

}
