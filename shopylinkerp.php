<?php

use PrestaShopBundle\Entity\Repository\TabRepository;

class shopylinkerp extends Module
{
    public function __construct()
    {
        $this->name = 'shopylinkerp';
        $this->nameExt = 'shopylinkerp';
        $this->version = '1.0.1';
        $this->author = 'Optyum, S.A.';
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Shopylinker – Prestashop');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => '1.7.99.99');

        $this->description = $this->l('Shopylinker – Prestashop');
    }

    public function install()
    {
        $this->multishop_context = Shop::CONTEXT_ALL;

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
        // Retrieve Tab ID
        $id_tab = (int)Tab::getIdFromClassName('AdminShopylinkerp');

        // Load tab
        $tab = new Tab((int)$id_tab);

        // Delete it
        return $tab->delete();
    }

    public function createConfig()
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

        Configuration::updateValue('SHOPYLINKER_UDATA', json_encode($config));
    }

    public function removeConfig(){

    }

}
