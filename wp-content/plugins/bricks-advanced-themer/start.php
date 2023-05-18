<?php

/**
 * Load all application modules.
 *
 * @package Bricks_Advanced_Themer
 */

defined('ABSPATH') || die();

add_action( 'plugins_loaded', 'brxc_init_plugin' );

/**
 * Initialize the free plugin after all plugins were loaded.
 * We want to check, if the premium plugin is active, before loading the
 * free plugin.
 */
function brxc_init_plugin()
{
    if ( defined( 'BRICKS_AREAS_INST' ) ) {

        return;

    }

    include_once __DIR__ . '/const.php';

    if (!class_exists('Advanced_Themer_Bricks\AT__Init')) {

        require_once plugin_dir_path( __FILE__ ) . 'classes/init.php';

        Advanced_Themer_Bricks\AT__Init::init_hooks();
    }
    
}