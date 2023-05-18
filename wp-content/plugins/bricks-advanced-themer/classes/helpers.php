<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Helpers{

    // Check the current user role and return TRUE/FALSE based on the user permission set in the option page
    public static function return_user_role_check(){
        if( !is_user_logged_in() ) {

            return false;

        }
        global $brxc_acf_fields;

        $disabled_roles = AT__ACF::acf_get_role();

        $current_user = wp_get_current_user(); 


        if( !$current_user ) {

            return false;

        }

        $user_roles = ( array ) $current_user->roles;

        if( !$user_roles || !is_array( $user_roles ) ) {

            return false;

        }

        if( !$disabled_roles && in_array('administrator', $user_roles)) {

            return true;

        } 

        if( !$disabled_roles ) {

            return false;

        }


        $intersection = array_intersect( $disabled_roles, $user_roles );

        foreach( $user_roles as $role ){

            if ( $role == 'administrator' || in_array( $role, $intersection ) ) {

                return true; // return true when the current user role MATCHES the disable roles list

            }

        }
        
        return false;// return true when the current user role DOESN'T MATCHES the disable roles list


    }

    // Check the post type of the current page and return TRUE/FALSE base on the CPT permissions set on the option page
    public static function return_post_type_check(){

        global $post;

        if( !is_user_logged_in() ) {

            return false;

        }

        global $brxc_acf_fields;

        $enabled_post_types = $brxc_acf_fields['post_types_permissions'];

        if( !$enabled_post_types || !is_array( $enabled_post_types ) ) {

            return false;

        }

        $current_post_id = get_the_ID();

        $current_post_type = get_post_type( $current_post_id );
    
        if ( in_array( $current_post_type, $enabled_post_types ) ) {

            return true; // return true when the current user role MATCHES the roles list

        }
    
        return false;// return true when the current user role DOESN'T MATCHES the roles list

    }

    // Check the URL of the current page and return TRUE/FALSE if it contains the query string brxcthemer=on
    public static function check_url_query_for_themer(){

        $actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $parsed_url = wp_parse_url( $actual_link );

        $url_query_string = isset( $parsed_url['query'] ) ? $parsed_url['query'] : '';

        if ( $url_query_string && strpos( $url_query_string, 'brxcthemer=on' ) !== false ) {

            return true;

        } else { 

            return false;

        }

    }

    public static function check_url_query_for_bricks_builder(){
        if (!isset($_SERVER['HTTP_HOST']) ){

            return false;

        }

        $actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $parsed_url = wp_parse_url( $actual_link );

        $url_query_string = isset( $parsed_url['query'] ) ? $parsed_url['query'] : '';

        if ( $url_query_string && strpos( $url_query_string, 'bricks=run' ) !== false ) {

            return true;

        } else { 

            return false;

        }

    }

    // function that transform the brightness of an hex value based on the percentage provided as parameter 
    public static function adjustBrightness( $hexCode, $adjustPercent ) {
        
        $hexCode = ltrim( sanitize_hex_color( $hexCode ), '#' );
    
        if ( strlen( $hexCode ) == 3 ) {

            $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];

        }
    
        $hexCode = array_map( 'hexdec', str_split( $hexCode, 2 ) );
    
        foreach ( $hexCode as & $color ) {

            $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;

            $adjustAmount = ceil( $adjustableLimit * $adjustPercent );
    
            $color = str_pad( dechex ( $color + $adjustAmount ), 2, '0', STR_PAD_LEFT );

        }
    
        return '#' . implode( $hexCode );

    }

    // Get the imported json text saved on the color palette cpt and convert all the values to a valid hex format
    public static function get_hex_value_from_json($label, $sufix, $query){

        $acf_json = get_field( 'brxc_import_from_json' );

        $json_decode = ( isset( $acf_json ) && $acf_json != null ) ? ( array ) json_decode( $acf_json ) : '';

        $arr = ( is_array( $json_decode )) ?  $json_decode[$query] : '';

        
        $hex = '';

        ( $sufix && $sufix != null ) ? $label .= '-' . $sufix : '';

        if ( $arr && is_array( $arr ) ) {

            foreach( $arr as $key => $val ){

                if( $arr[$key][0] == $label ){

                    $hex = sanitize_hex_color( $arr[$key][1] );

                }

            }

        }

        return $hex;

    }

    public static function register_bricks_elements() {

        if (!class_exists('Bricks\Elements')) {
            return;
        }

        global $brxc_acf_fields;
        
        if( !is_array( $brxc_acf_fields['enable_elements'] ) ) {
    
            return;
    
        }
    
        $element_files = [];
    
        ( in_array( 'darkmode-toggle', $brxc_acf_fields['enable_elements'] ) ) ? $element_files[] = plugin_dir_path( BRICKS_ADVANCED_THEMER_PLUGIN_FILE ) . 'elements/darkmode-toggle.php' : '';
        ( in_array( 'darkmode-button', $brxc_acf_fields['enable_elements'] ) ) ? $element_files[] = plugin_dir_path( BRICKS_ADVANCED_THEMER_PLUGIN_FILE ) . 'elements/darkmode-button.php' : '';
        
        if ( isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs']) ) {

            ( in_array( 'color-swatch', $brxc_acf_fields['enable_elements'] ) ) ? $element_files[] = plugin_dir_path( BRICKS_ADVANCED_THEMER_PLUGIN_FILE ) . 'elements/color-swatch.php' : '';
            ( in_array( 'preset-swatch', $brxc_acf_fields['enable_elements'] ) ) ? $element_files[] = plugin_dir_path( BRICKS_ADVANCED_THEMER_PLUGIN_FILE ) . 'elements/preset-swatch.php' : '';
            ( in_array( 'theme-editor', $brxc_acf_fields['enable_elements'] ) ) ? $element_files[] = plugin_dir_path( BRICKS_ADVANCED_THEMER_PLUGIN_FILE ) . 'elements/theme-editor.php' : '';
            ( in_array( 'style-guide', $brxc_acf_fields['enable_elements'] ) ) ? $element_files[] = plugin_dir_path( BRICKS_ADVANCED_THEMER_PLUGIN_FILE ) . 'elements/color-palette-style-guide.php' : '';
            
        }
    
        
        foreach ( $element_files as $file ) {
        
            \Bricks\Elements::register_element( $file );
        
        }

    }

    public static function generate_unique_string( $length ) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand( 0, $charactersLength - 1 )];

        }

        return $randomString;

    }

    public static function translate_string_to_unicode($u) {
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));
        return $k2 * 256 + $k1;
    }

    public static function get_bricks_elements(){

        if (!class_exists('Bricks\Elements')) return;

        $elements = \Bricks\Elements::$elements;

        return $elements;
    }

}