<?php
/*
Plugin Name: Bricksforge
Plugin URI: https://www.bricksforge.io
Description: A powerful set of tools to extend the Bricks Builder functionality.
Version: 0.9.8.4
Author: Bricksforge
Author URI: https://www.bricksforge.io
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: bricksforge
Domain Path: /languages
*/

/**
 * Copyright (c) 2022 Daniele De Rosa – Bricksforge. All rights reserved.
 */

// don't call the file directly
if (!defined('ABSPATH'))
    exit;

$theme = wp_get_theme();
if ('Bricks' != $theme->name && 'Bricks' != $theme->parent_theme) {
    return;
}

/**
 * Bricksforge class
 *
 * @class Bricksforge The class that holds the entire Bricksforge plugin
 */
if (!class_exists('Bricksforge')) {

    final class Bricksforge
    {

        /**
         * Plugin version
         *
         * @var string
         */
        public $version = '0.9.8.4';

        /**
         * Holds various class instances
         *
         * @var array
         */
        private $container = array();

        /**
         * Constructor for the Bricksforge class
         *
         * Sets up all the appropriate hooks and actions
         * within our plugin.
         */
        public function __construct()
        {
            $this->define_constants();

            register_activation_hook(__FILE__, array($this, 'activate'));
            register_deactivation_hook(__FILE__, array($this, 'deactivate'));

            add_action('plugins_loaded', array($this, 'init_plugin'));
        }

        /**
         * Initializes the Bricksforge() class
         *
         * Checks for an existing Bricksforge() instance
         * and if it doesn't find one, creates it.
         */
        public static function init()
        {
            static $instance = false;

            if (!$instance) {
                $instance = new Bricksforge();
            }

            return $instance;
        }

        /**
         * Magic getter to bypass referencing plugin.
         *
         * @param $prop
         *
         * @return mixed
         */
        public function __get($prop)
        {
            if (array_key_exists($prop, $this->container)) {
                return $this->container[$prop];
            }

            return $this->{$prop};
        }

        /**
         * Magic isset to bypass referencing plugin.
         *
         * @param $prop
         *
         * @return mixed
         */
        public function __isset($prop)
        {
            return isset($this->{$prop}) || isset($this->container[$prop]);
        }

        /**
         * Define the constants
         *
         * @return void
         */
        public function define_constants()
        {
            define('BRICKSFORGE_VERSION', $this->version);
            define('BRICKSFORGE_FILE', __FILE__);
            define('BRICKSFORGE_PATH', dirname(BRICKSFORGE_FILE));
            define('BRICKSFORGE_INCLUDES', BRICKSFORGE_PATH . '/includes');
            define('BRICKSFORGE_URL', plugins_url('', BRICKSFORGE_FILE));
            define('BRICKSFORGE_ASSETS', BRICKSFORGE_URL . '/assets');
            define('BRICKSFORGE_CUSTOM_STYLES_FILE', BRICKSFORGE_PATH . '/assets/classes/custom.css');
            define('BRICKSFORGE_ELEMENTS_ROOT_PATH', BRICKSFORGE_URL . '/includes/elements');
            define('BRICKSFORGE_BRICKS_ELEMENT_PREFIX', 'brxe-');
            define('BRICKSFORGE_SUBMISSIONS_DB_TABLE', 'bricksforge_submissions');
            define('BRICKSFORGE_TEMP_DIR', wp_upload_dir()['basedir'] . '/bricksforge/');
        }

        /**
         * Load the plugin after all plugis are loaded
         *
         * @return void
         */
        public function init_plugin()
        {
            $this->includes();
            $this->init_hooks();
        }

        /**
         * Placeholder for activation function
         *
         * Nothing being called here yet.
         */
        public function activate()
        {

            $installed = get_option('bricksforge_installed');

            if (!$installed) {
                update_option('bricksforge_installed', time());
            }

            update_option('bricksforge_version', BRICKSFORGE_VERSION);
        }

        /**
         * Placeholder for deactivation function
         *
         * Nothing being called here yet.
         */
        public function deactivate()
        {
        }

        /**
         * Include the required files
         *
         * @return void
         */
        public function includes()
        {

            require_once BRICKSFORGE_INCLUDES . '/update-checker/plugin-update-checker.php';
            require_once BRICKSFORGE_INCLUDES . '/Assets.php';
            require_once BRICKSFORGE_INCLUDES . '/animations/Animations.php';
            require_once BRICKSFORGE_INCLUDES . '/permissions/Permissions.php';
            require_once BRICKSFORGE_INCLUDES . '/global-classes/GlobalClasses.php';
            require_once BRICKSFORGE_INCLUDES . '/conditional-logic/ConditionalLogic.php';
            require_once BRICKSFORGE_INCLUDES . '/elements/Elements.php';
            require_once BRICKSFORGE_INCLUDES . '/popups/Popups.php';
            require_once BRICKSFORGE_INCLUDES . '/mega-menu/MegaMenu.php';
            require_once BRICKSFORGE_INCLUDES . '/backend-designer/BackendDesigner.php';
            require_once BRICKSFORGE_INCLUDES . '/form-submissions/FormSubmissions.php';
            require_once BRICKSFORGE_INCLUDES . '/dynamic-data/DynamicData.php';
            require_once BRICKSFORGE_INCLUDES . '/email-designer/EmailDesigner.php';

            if ($this->is_request('admin')) {
                require_once BRICKSFORGE_INCLUDES . '/Admin.php';
                require_once BRICKSFORGE_INCLUDES . '/whitelabel/WhiteLabel.php';
            }

            if ($this->is_request('frontend')) {
                require_once BRICKSFORGE_INCLUDES . '/Frontend.php';
                require_once BRICKSFORGE_INCLUDES . '/maintenance/Maintenance.php';
            }

            if ($this->is_request('ajax')) {
                // require_once BRICKSFORGE_INCLUDES . '/class-ajax.php';
            }

            require_once BRICKSFORGE_INCLUDES . '/Api.php';

            $BricksforgeUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
                'https://update-server.codepa.de/?action=get_metadata&slug=bricksforge',
                __FILE__,
                'bricksforge'
            );
        }

        /**
         * Initialize the hooks
         *
         * @return void
         */
        public function init_hooks()
        {

            $this->init_classes_before_wp_init();
            add_action('init', array($this, 'init_classes_after_wp_init'), 20);

            // Localize our plugin
            add_action('init', array($this, 'localization_setup'));
        }

        /**
         * Instantiate the required classes before WP Init
         *
         * @return void
         */
        public function init_classes_before_wp_init()
        {

            if ($this->is_request('admin')) {
                $this->container['admin'] = new Bricksforge\Permissions();
            }

            if ($this->is_request('frontend')) {
                $this->container['frontend'] = new Bricksforge\DynamicData();
                $this->container['frontend'] = new Bricksforge\Permissions();
            }

            if ($this->is_request('builder')) {
                $this->container['builder'] = new Bricksforge\Permissions();
                $this->container['builder'] = new Bricksforge\DynamicData();
            }
        }

        /**
         * Instantiate the required classes
         *
         * @return void
         */
        public function init_classes_after_wp_init()
        {

            /**
             * Return if Bricks is not loaded
             * @since 0.9.2
             */
            if (!function_exists('bricks_is_builder')) {
                return;
            }

            if ($this->is_request('admin')) {
                $this->container['admin'] = new Bricksforge\Admin();
                $this->container['admin'] = new Bricksforge\Permissions();
                $this->container['admin'] = new Bricksforge\GlobalClasses();
                $this->container['admin'] = new Bricksforge\Animations();
                $this->container['admin'] = new Bricksforge\Popups();
                $this->container['admin'] = new Bricksforge\WhiteLabel();
                $this->container['admin'] = new Bricksforge\MegaMenu();
                $this->container['admin'] = new Bricksforge\BackendDesigner();
                $this->container['admin'] = new Bricksforge\FormSubmissions();
            }

            if ($this->is_request('builder')) {
                $this->container['builder'] = new Bricksforge\Permissions();
                $this->container['builder'] = new Bricksforge\GlobalClasses();
                $this->container['builder'] = new Bricksforge\Animations();
                $this->container['builder'] = new Bricksforge\Elements();
            }

            if ($this->is_request('frontend')) {
                $this->container['frontend'] = new Bricksforge\Frontend();
                $this->container['frontend'] = new Bricksforge\GlobalClasses();
                $this->container['frontend'] = new Bricksforge\Animations();
                $this->container['frontend'] = new Bricksforge\ConditionalLogic();
                $this->container['frontend'] = new Bricksforge\Elements();
                $this->container['frontend'] = new Bricksforge\Popups();
                $this->container['frontend'] = new Bricksforge\Maintenance();
                $this->container['frontend'] = new Bricksforge\MegaMenu();
                $this->container['frontend'] = new Bricksforge\BackendDesigner();
            }

            if ($this->is_request('ajax')) {
                // $this->container['ajax'] =  new Bricksforge\Ajax();
            }

            if (!isset($this->container['emaildesigner'])) {
                $this->container['emaildesigner'] = Bricksforge\EmailDesigner::get_instance();
            }

            $this->container['api'] = new Bricksforge\Api();
            $this->container['assets'] = new Bricksforge\Assets();
        }

        /**
         * Initialize plugin for localization
         *
         * @uses load_plugin_textdomain()
         */
        public function localization_setup()
        {
            load_plugin_textdomain('bricksforge', false, dirname(plugin_basename(__FILE__)) . '/languages/');
        }

        /**
         * What type of request is this?
         *
         * @param  string $type admin, ajax, cron or frontend.
         *
         * @return bool
         */
        private function is_request($type)
        {
            switch ($type) {
                case 'admin':
                    return is_admin();

                case 'builder':
                    // @since 0.9.1
                    if (!function_exists('bricks_is_builder')) {
                        return is_admin();
                    }

                    return bricks_is_builder();

                case 'ajax':
                    return defined('DOING_AJAX');

                case 'rest':
                    return defined('REST_REQUEST');

                case 'cron':
                    return defined('DOING_CRON');

                case 'frontend':
                    return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
            }
        }
    }

    $bricksforge = Bricksforge::init();
}
