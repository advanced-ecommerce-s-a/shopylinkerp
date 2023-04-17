<?php
/**
 * 2018-2023 Optyum S.A. All Rights Reserved.
 * NOTICE:  All information contained herein is, and remains
 * the property of Optyum S.A. and its suppliers,
 * if any.  The intellectual and technical concepts contained
 * herein are proprietary to Optyum S.A.
 * and its suppliers and are protected by trade secret or copyright law.
 * Dissemination of this information or reproduction of this material
 * is strictly forbidden unless prior written permission is obtained
 * from Optyum S.A.
 * @author    Optyum S.A.
 * @copyright 2018-2023 Optyum S.A.
 * @license  Optyum S.A. All Rights Reserved
 *  International Registered Trademark & Property of Optyum S.A.
 */

namespace PrestaShop\Module\shopylinkerp\Classes;

use Configuration;

class ShopyManager
{
    //const SHOPYLINKER_URL = 'https://localhost/sassympresta/web/app_dev.php/';
    const SHOPYLINKER_URL = 'https://devp.shopylinker.com/web/app_dev.php/';

    static public function getApiUrl($lang = 'es')
    {
        return static::SHOPYLINKER_URL.$lang.'/api/';
    }

    static public function getExtLoginUrl($lang = 'es')
    {
        return static::SHOPYLINKER_URL.$lang.'/externalLogin';
    }

    static public function init()
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        if (!isset($config['user']) && !isset($config['instance'])) {
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
                'ftp_port' => '21',
                'ftp_ssl' => '',
                'ftp_root' => '/',
                'connection_key' => '',
                'date_add' => '',

            ];
            Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));
        }
        return $config;
    }

    static public function destroyConfig()
    {
        Configuration::deleteByName('SHOPYLINKER_UDATA');
    }

    static public function getShopyUser()
    {
        $userData = ShopyManager::init();

        return $userData['user'];
    }

    static public function setShopyUser($userData)
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $config['user'] = $userData;

        Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));
    }

    static public function getShopyInstance()
    {
        $instanceData = ShopyManager::init();

        return $instanceData['instance'];
    }

    static public function setShopyInstance($instanceData)
    {
        $config = json_decode(Configuration::get('SHOPYLINKER_UDATA'), true);

        $config['instance'] = $instanceData;

        Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));
    }

    static public function callShopyApi($action, $parameters)
    {
        //TODO ver si la url de la api se pone directo
        $url = static::getApiUrl() . $action . "?rand=" . rand(0, 100000);

        $strparams = '';

        $strparams = http_build_query($parameters, '', '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strparams);
        //solo para localhost
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //--------------
        $apiResult = curl_exec($ch);
        $info = curl_getinfo($ch);
        if ($apiResult === false) {
            echo 'Curl error: ' . curl_error($ch);
            print_r($info);
        }
        if ($info['http_code'] != 200) {
            $info = curl_getinfo($ch);
            echo $strparams;
            print_r($info);
        }
        /*echo $apiResult;
        echo $strparams;
        print_r($info);*/

        curl_close($ch);
        $result = null;
        if ($apiResult) {
            $result = json_decode($apiResult, true);
        }
        return $result;
    }
}