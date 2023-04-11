<?php
class shopylinkerp extends Module
{
    public function __construct()
    {
        $this->name = 'shopylinkerp';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Your Name';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => '1.7.99.99');
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('My Custom Registration');
        $this->description = $this->l('Adds a custom registration controller and link in the configuration menu.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
    }

    public function install()
    {
        return parent::install() &&
            $this->installTab();
    }

    public function uninstall()
    {
        return parent::uninstall() &&
            $this->uninstallTab();
    }

    public function installTab()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->class_name = 'AdminShopylinkerpRegistration';
        $tab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'My Custom Registration';
        }
        $tab->id_parent = (int) Tab::getIdFromClassName('AdminParentModulesSf');
        $tab->module = $this->name;

        return $tab->add();
    }

    public function uninstallTab()
    {
        $tabId = (int) Tab::getIdFromClassName('AdminShopylinkerpRegistration');
        $tab = new Tab($tabId);

        return $tab->delete();
    }

    private function createConfig(){
        $arrayconfig["CONFIG_LIST"]["MAESTRO"]=array(
            "nombre" => "MAESTRO",
            "id" => "MAESTRO",
            "descripcion" => "Master structure",
            "participeAleatorio" => 0
        );

        $configmaestro = json_encode($configmaestro);
        Configuration::updateValue('CROSSALES_CONFIG_MAESTRO', $configmaestro);
    }
}
