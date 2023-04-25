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
use PrestaShopBundle\Entity\Repository\TabRepository;

class Shopylinkerp extends Module
{
    public function __construct()
    {
        $this->name = 'shopylinkerp';
        $this->version = '1.0.1';
        $this->tab = 'administration';
        $this->author = 'Optyum, S.A.';
        $this->bootstrap = true;

        $this->module_key = '17be407b7858ce95e593847a34575c86';

        parent::__construct();

        //recordar poner el numero del modulo
        $this->displayName = $this->trans('Shopylinker – Prestashop');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => '8.0.2');

        $this->description = $this->trans('Innovative all-in-one system that will allow you to increase sales, 
        increasing visits and the conversion rate to sales. Increase revenue and reduce costs by integrating your store with Shopylinker.');
    }

    public function install()
    {
        //$this->multistoreCompatibility = self::MULTISTORE_COMPATIBILITY_YES;
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

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
        $this->uninstallTab();
        $this->removeConfig();
        // Call uninstall parent method
        if (!parent::uninstall()) {
            return false;
        }


        return true;
    }

    public function installTab()
    {
        //tab main
        $tabShopy = new Tab();
        $tabShopy->id_parent = 0;
        $tabShopy->active = 1;
        $tabShopy->name = array();
        //todo crear icono para shopy
        $tabShopy->icon = 'sync';
        $tabShopy->class_name = 'AdminShopylinkerp';
        $tabShopy->module = $this->name;

        foreach (Language::getLanguages(true) as $lang) {
            $tabShopy->name[$lang['id_lang']] = 'Shopylinker';
        }
        $tabShopy->add();

        //tab manager
        $tab = new Tab();
        $tab->id_parent = $tabShopy->id;
        $tab->active = 1;
        $tab->name = array();
        $tab->icon = 'sync';
        $tab->class_name = 'AdminShopylinkerpManager';
        $tab->module = $this->name;
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Manager';
        }
        $tab->add();

    }

    public function uninstallTab()
    {
        $tabRepository = $this->get('prestashop.core.admin.tab.repository');

        $id_tab = (int)$tabRepository->findOneIdByClassName('AdminShopylinkerp');
        $tab = new Tab((int)$id_tab);
        $tab->delete();

        $id_tab = (int)$tabRepository->findOneIdByClassName('AdminShopylinkerpManager');
        $tab = new Tab((int)$id_tab);
        $tab->delete();

        return true;
    }

    public function createConfig()
    {
        ShopyManager::init();
    }

    public function removeConfig()
    {
        ShopyManager::destroyConfig();
    }

    public function getContent()
    {
        $link = $this->context->link->getAdminLink('AdminShopylinkerpManager');
        Tools::redirectAdmin($link);
    }
}