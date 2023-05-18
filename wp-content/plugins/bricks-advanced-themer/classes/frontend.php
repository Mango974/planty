<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Frontend{

    public static function add_theme_class_to_body( $classes ){

        global $brxc_acf_fields;
      
        if( !$brxc_acf_fields['frontend_gui_theme'] ||AT__Helpers::check_url_query_for_themer() !== true || AT__Helpers::return_user_role_check() !== true ){

            return $classes;
      
        }

        $classes = array_merge( $classes, array( 'brxc-' . $brxc_acf_fields['frontend_gui_theme'] . '-theme' ) );
      
        return $classes;
      
    }

    public static function activate_frontend_gui_on_frontend(){

        global $brxc_acf_fields;

        if ( !$brxc_acf_fields['enable_frontend_gui'] || AT__Helpers::check_url_query_for_themer() !== true || AT__Helpers::return_user_role_check() !== true ){

            return;

        }

        global $brxc_colors;

        $colors = $brxc_colors;

        if( !$colors ) {

            return;
        }

        include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/frontend_gui.php';

    }

    public static function load_variables_on_frontend() {

        global $brxc_acf_fields;

        $global_colors = AT__Global_Colors::load_colors_variables_on_frontend();

        if(!isset($brxc_acf_fields['theme_settings_tabs']) || empty($brxc_acf_fields['theme_settings_tabs']) || !is_array($brxc_acf_fields['theme_settings_tabs'])) {

            return;

        }

        $custom_css = ':root{';

        if (in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs'])){

            $custom_css .= $global_colors[0];

        }

        if (in_array('spacing', $brxc_acf_fields['theme_settings_tabs'])){

            $custom_css .= AT__Global_Variables::load_spacing_variables_on_frontend();

        }

        if (in_array('border-radius', $brxc_acf_fields['theme_settings_tabs'])){

            $custom_css .= AT__Global_Variables::load_border_variables_on_frontend();

        }

        if (in_array('typography', $brxc_acf_fields['theme_settings_tabs'])){

            $custom_css .= AT__Global_Variables::load_typography_variables_on_frontend();

        }

        if (in_array('custom-variables', $brxc_acf_fields['theme_settings_tabs'])){

            $custom_css .= AT__Global_Variables::load_misc_variables_on_frontend();

        }

        $custom_css .= '}';

        if (in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs'])){

            $custom_css .= 'body.brxc-dark{';

            $custom_css .= $global_colors[1];

            $custom_css .= '}';

        }

        if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('grids', $brxc_acf_fields['theme_settings_tabs'])) {
            
            $custom_css .= AT__Grid_Builder::grid_builder_classes();
        
        }

        wp_add_inline_style( 'bricks-advanced-themer', $custom_css );

    }

    public static function bricks_colors_gutenberg_frontend() {

        global $brxc_acf_fields;

        if ( !isset($brxc_acf_fields['theme_settings_tabs']) || empty($brxc_acf_fields['theme_settings_tabs']) || !is_array($brxc_acf_fields['theme_settings_tabs']) || !in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs']) || !isset( $brxc_acf_fields['replace_gutenberg_palettes'] ) || !$brxc_acf_fields['replace_gutenberg_palettes'] ){

            return;

        }
    	
        $gutenberg_colors_frontend_css = "";
        
    	$bricks_palettes = get_option(BRICKS_DB_COLOR_PALETTE, []);

        if ( isset( $bricks_palettes ) && is_array( $bricks_palettes ) ){

            foreach( $bricks_palettes as $bricks_palette ) {

                foreach( $bricks_palette['colors'] as $bricks_color ) {
                    $gutenberg_colors_frontend_css .= ".has-" . _wp_to_kebab_case($bricks_color['name']) ."-color { color: " . ( $bricks_color['raw'] ?? $bricks_color['hex'] ) . "} ";
                    
                    $gutenberg_colors_frontend_css .= ".has-" . _wp_to_kebab_case($bricks_color['name']) ."-background-color { background-color: " . ( $bricks_color['raw'] ?? $bricks_color['hex'] ) . "}";
                    
                    $gutenberg_colors_frontend_css .= ".has-" . _wp_to_kebab_case($bricks_color['name']) ."-border-color { border-color: " . ( $bricks_color['raw'] ?? $bricks_color['hex'] ) . "}";
                }
            }
            
            wp_add_inline_style( 'bricks-advanced-themer', $gutenberg_colors_frontend_css );

        }
    
    }

    public static function remove_default_gutenberg_presets() {

        global $brxc_acf_fields;
        
        if ( !isset( $brxc_acf_fields['remove_default_gutenberg_presets'] ) || !$brxc_acf_fields['remove_default_gutenberg_presets'] ){

           return;

        }

        remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
        remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
        remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

    }

}