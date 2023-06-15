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

namespace PrestaShop\Module\shopylinkerp\Classes;

if (!defined('_PS_VERSION_')) {
    exit;
}

class ApiCall
{
    const MODULE_INSTALL = 'newModuleInstall';
    const MODULE_UNISTALL = 'moduleUninstall';
    const LOGIN = 'login';
    const REGISTER = 'register';
    const USER_VALIDATION = 'uservalidation';
    const RESEND_USER_VALIDATION = 'resendvalidacion';
    const FINISH_STORE_ASOCIATION = 'finishstoreasociation';
    const CHECK_BD = 'checkaccessdb';
    const CHECK_FTP = 'checkaccessftp';
    const EDIT_STORE = 'editstore';
    const CHECK_ACCESS = 'checkaccessstore';
    const ADD_STORE = 'addstore';

}