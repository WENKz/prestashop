<?php
/**
 * Starter Module
 *
 *  @author    PremiumPresta <office@premiumpresta.com>
 *  @copyright PremiumPresta
 *  @license   http://creativecommons.org/licenses/by/4.0/ CC BY 4.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Yownes extends Module
{

    /** @var array Use to store the configuration from database */
    public $config_values;

    /** @var array submit values of the configuration page */
    protected static $config_post_submit_values = array('saveConfig');

    public function __construct()
    {
        $this->name = 'yownes'; // internal identifier, unique and lowercase
        $this->tab = 'front_office_features'; // backend module coresponding category
        $this->version = '2.0.0'; // version number for the module
        $this->author = 'Yownes'; // module author
        $this->need_instance = 0; // load the module when displaying the "Modules" page in backend
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Yownes'); // public name
        $this->description = $this->l('CMS Connect App for PrestaShop'); // public description

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?'); // confirmation message at uninstall

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        // $this->module_key = '1d77752fd71e98268cd50f200cb5f5ce';
    }

    /**
     * Install this module
     * @return boolean
     */
    public function install()
    {
        return parent::install() &&
        $this->registerAdminTab() && $this->registerAdminAjaxTab();
    }

    /**
     * Uninstall this module
     * @return boolean
     */
    public function uninstall()
    {
        return Configuration::deleteByName($this->name) &&
        parent::uninstall() &&
        $this->deleteAdminTab();
    }

    /**
     * Configuration page
     */
    public function getContent()
    {
        $this->config_values = $this->getConfigValues();

        $this->context->smarty->assign(array(
            'module' => array(
                'class' => get_class($this),
                'name' => $this->name,
                'displayName' => $this->displayName,
                'dir' => $this->_path
            )
        ));

        $app = json_decode(file_get_contents(__DIR__ . '/views/js/yownes/asset-manifest.json'), true);
        $entrypoints = $app['entrypoints'];
        $files = $app['files'];
        $base_path = $this->_path . 'views/js/yownes/';
        // $base_script = $base_path . "/static/js/base.js";
        $scripts = [];

        foreach ($entrypoints as $key) {
            $type = explode("/", $key)[1];
            if ($type == 'js') {
                array_push($scripts, $base_path . $key);
            }
            else if ($type == 'css') {
                $this->context->controller->addCSS($base_path . $key, [
                    'media' => 'all',
                    'priority' => 1000
                ]);
            }
        }

        // $this->context->controller->addCSS($base_path . $files['main.css'], [
        //     'media' => 'all',
        //     'priority' => 1000
        // ]);

        // array_push($scripts, $base_path . $files['main.js']);

        $this->context->smarty->assign(array(
            'catalog' => Tools::getHttpHost(true).
            __PS_BASE_URI__.'index.php?controller=graphql&module=yownes&fc=module',
            'blog' => Module::isInstalled('prestablog'),
            'baseUrl' => '',
            'scripts' => $scripts,
            'shopName' => Configuration::get('PS_SHOP_NAME'),
            'siteUrl' => Tools::getHttpHost(true).
            __PS_BASE_URI__,
            'tokenYownes' => Tools::getAdminTokenLite('AdminYownesAjax')
        ));

        return $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }

    /**
     * Get configuration array from database
     * @return array
     */
    public function getConfigValues()
    {
        return json_decode(Configuration::get($this->name), true);
    }

    public function registerAdminAjaxTab()
    {

        $tab = new Tab();
        $tab->class_name = 'AdminYownesAjax';
        $tab->module = 'yownes';

        foreach (Language::getLanguages(false) as $lang) {
          $tab->name[$lang['id_lang']] = 'Yownes';
        }

        $tab->id_parent = -1;
        
        return $tab->save();
    }
    public function registerAdminTab()
    {
        $tab = new Tab();
        $tab->class_name = 'AdminYownes';
        foreach (Language::getLanguages(false) as $lang) {
            $tab->name[$lang['id_lang']] = 'Yownes';
        }

        $tab->id_parent = (int)Tab::getIdFromClassName('AdminTools');
        $tab->module = 'yownes';
        $tab->icon = 'library_books';

        return $tab->save();
    }

    public function deleteAdminTab()
    {
        foreach (array('AdminYownes') as $tab_name) {
            $id_tab = (int)Tab::getIdFromClassName($tab_name);
            if ($id_tab) {
                $tab = new Tab($id_tab);
                $tab->delete();
            }
        }

        return true;
    }
}
