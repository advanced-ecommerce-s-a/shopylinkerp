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

$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}

use PrestaShop\Module\shopylinkerp\Classes\ShopyManager;

class Shopylinkerp extends Module
{
    public function __construct()
    {
        $this->name = 'shopylinkerp';
        $this->version = '1.0.0';
        $this->author = 'Optyum, S.A.';
        $this->bootstrap = true;
        parent::__construct();

        //recordar poner el numero del modulo

        $this->displayName = $this->trans('Shopylinker – Prestashop');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => '1.7.99.99');

        $this->description = $this->trans('Shopylinker – Prestashop');
    }

    public function install()
    {
        $this->multistoreCompatibility = self::MULTISTORE_COMPATIBILITY_YES;

        // Call install parent method
        if (!parent::install()) {
            return false;
        }

        $this->installTab();

        $this->createConfig();

        // All went well!
        return true;
    }

    public function uninstall()
    {
        // Call uninstall parent method
        if (!parent::uninstall()) {
            return false;
        }

        $this->uninstallTab();

        //TODO ver si cuando se desintala se elimina la configuracion
        $this->removeConfig();

        return true;
    }

    public function installTab()
    {
        //tab main
        $tab = new Tab();
        $tab->id_parent = 0;
        $tab->active = 1;
        $tab->name = array();
        $tab->icon = 'track_changes';
        $tab->class_name = 'AdminShopylinkerp';
        $tab->module = $this->name;
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Shopylinker';
        }
        $tab->add();

        //TODO cambiar getIdFromClassName esta deprecate (mira en la ayuda de prestashop ahi explican como se hace esto)
        //tab manager
        $tab = new Tab();
        $tab->id_parent = (int)Tab::getIdFromClassName('AdminShopylinkerp');
        $tab->active = 1;
        $tab->name = array();
        $tab->icon = 'track_changes';
        $tab->class_name = 'AdminShopylinkerpManager';
        $tab->module = $this->name;
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Manager';
        }
        $tab->add();

    }

    public function uninstallTab()
    {
        //TODO cambiar getIdFromClassName esta deprecate
        // Retrieve Tab ID
        $id_tab = (int)Tab::getIdFromClassName('AdminShopylinkerp');

        // Load tab
        $tab = new Tab((int)$id_tab);

        // Delete it
        return $tab->delete();
    }

    //todo esto pasarlo a la clase general tuya
    public function createConfig()
    {
        ShopyManager::init();
    }

    public function removeConfig()
    {

    }

}
