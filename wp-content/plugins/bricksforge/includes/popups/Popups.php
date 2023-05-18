<?php
namespace Bricksforge;

/**
 * Popups Handler
 */
 class Popups {

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'load_styles']);
    }

    /* public function activated() {
        return get_option('brf_global_classes_activated') == true;
    } */

    public function load_styles() {
       // if ($this->activated() === false) { return false; }

        //wp_register_style( 'brf_custom_css', BRICKSFORGE_URL . '/assets/classes/custom.css', false, time() );
	    //wp_enqueue_style ( 'brf_custom_css' );
    }
 }