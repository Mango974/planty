<?php

if (!defined('ABSPATH')) { die();
}

/*--------------------------------------
CONST
--------------------------------------*/
/**
 * Instanciate the plugin
 *
 * @var string
 */
const BRICKS_AREAS_INST = 'true';

 /**
 * A new version string will force a refresh of CSS and JS files for all users.
 *
 * @var string
 */
const BRICKS_ADVANCED_THEMER_VERSION = '1.0.4';

 /**
 * Set the plugin for production or development
 *
 * @var string
 */
const BRICKS_ADVANCED_THEMER_PROD = true;

/**
 * Plugin Path
 *
 * @var string
 */

define( 'BRICKS_ADVANCED_THEMER_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin URL
 *
 * @var string
 */

define( 'BRICKS_ADVANCED_THEMER_URL', plugin_dir_url( __FILE__  ) );

/**
 * Admin Slug
 *
 * @var string
 */

define(' BRICKS_ADMIN_SLUG', 'advanced-themer' );

// EDD Plugin const

define( 'BRXC_STORE_URL', 'https://advancedthemer.com/' );
define( 'BRXC_ITEM_ID', 14 );
define( 'BRXC_ITEM_NAME',  'Advanced Themer for Bricks' );
define( 'BRXC_EDD_AUTHOR', 'Maxime Beguin' );
define( 'BRXC_EDD_PLUGINVERSION',  BRICKS_ADVANCED_THEMER_VERSION );
define( 'BRXC_PLUGIN_LICENSE_PAGE', 'at-license');