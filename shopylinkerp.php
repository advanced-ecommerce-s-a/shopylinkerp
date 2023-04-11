<?php

class shopylinkerp extends Module
{
    public function __construct()
    {
        $this->name = 'shopylinkerp';
        $this->nameExt = 'shopylinkerp';
        $this->version = '1.0.0';
        $this->author = 'Optyum, S.A.';
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Shopylinker – Prestashop');
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => '1.7.99.99');

        $this->description = $this->l('Shopylinker – Prestashop');
    }

    public function install()
    {

        // Call install parent method
        if (!parent::install()) {
            return false;
        }

        if (!$this->installTab()) {
            return false;
        }

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

        if (!$this->uninstall()) {
            return false;
        }

        //TODO ver si cuando se desintala se elimina la configuracion
        $this->removeConfig();

        return true;
    }

    private function installTab()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminShopylinkerpManager';
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Shopylinker';
        }
        //todofredy usar el metodo que no esta deprecado, si entras a la funcion te lo dice
        $tab->id_parent = (int) Tab::getIdFromClassName('CONFIGURE');
        $tab->module = $this->name;

        return $tab->add();
    }

    private function uninstallTab()
    {
        //todofredy usar el metodo que no esta deprecado, si entras a la funcion te lo dice
        $tabId = (int) Tab::getIdFromClassName('AdminShopylinkerpManager');
        $tab = new Tab($tabId);

        return $tab->delete();
    }

    private function createConfig(){

        $config['user'] = [
            'id' => 0,
            'username' => '',
            'pass' => '',
            'nombre' => '',
            'apellidos' => '',
            'status' => 0,
        ];

        Configuration::updateValue('SHOPYLINKER_UDATA', $config);
    }

    private function removeConfig(){

    }

}
