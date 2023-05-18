<?php
namespace Advanced_Themer_Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Init {
    public static function init_hooks() {

        /*--------------------------------------
        Add ACF PRO
        --------------------------------------*/

        // Include the ACF plugin.

        function brxc_deactivate_acf(){
            if(is_plugin_active('advanced-custom-fields/acf.php')){ 
                deactivate_plugins('advanced-custom-fields/acf.php');
            }
        }
        add_action( 'admin_init', 'Advanced_Themer_Bricks\brxc_deactivate_acf' );
        
        
        if(!class_exists('ACF')){
            global $brxc_acf_already_exists;
            $brxc_acf_already_exists = false;
            include_once( BRICKS_ADVANCED_THEMER_PATH . '/plugins/acf-pro/acf.php' );
            add_action('init', 'Advanced_Themer_Bricks\AT__ACF::remove_acf_menu');
            add_filter('acf/settings/show_updates', '__return_false', 100);
            add_filter( 'acf/settings/path', 'Advanced_Themer_Bricks\AT__ACF::acf_settings_path' );
            add_filter( 'acf/settings/dir', 'Advanced_Themer_Bricks\AT__ACF::acf_settings_dir' );
            add_filter( 'site_transient_update_plugins', 'Advanced_Themer_Bricks\AT__ACF::stop_acf_update_notifications', 11 );
        }

        add_action( 'admin_init', 'Advanced_Themer_Bricks\AT__ACF::acf_get_role');
        add_filter( 'acf/settings/path', 'Advanced_Themer_Bricks\AT__ACF::acf_settings_path' );
        add_filter( 'acf/settings/dir', 'Advanced_Themer_Bricks\AT__ACF::acf_settings_dir' );
        add_filter( 'site_transient_update_plugins', 'Advanced_Themer_Bricks\AT__ACF::stop_acf_update_notifications', 11 );
        add_action( 'acf/init', 'Advanced_Themer_Bricks\AT__ACF::acf_color_palettes_fields');
        add_action( 'acf/init', 'Advanced_Themer_Bricks\AT__ACF::acf_settings_fields');

        
        /*--------------------------------------
        EDD Updated
        --------------------------------------*/
        
        add_action( 'init', 'Advanced_Themer_Bricks\AT__License::brxc_plugin_updater' );
        add_action( 'admin_init', 'Advanced_Themer_Bricks\AT__License::brxc_register_option' );
        add_action( 'admin_init', 'Advanced_Themer_Bricks\AT__License::brxc_activate_license' );
        add_action( 'admin_init', 'Advanced_Themer_Bricks\AT__License::brxc_deactivate_license' );
        add_action( 'admin_notices', 'Advanced_Themer_Bricks\AT__License::brxc_admin_notices' );
        
        /*--------------------------------------
        Option Page
        --------------------------------------*/
        
        add_action( 'acf/init', 'Advanced_Themer_Bricks\AT__ACF::create_advanced_themer_option_page');
        add_action( 'admin_menu', 'Advanced_Themer_Bricks\AT__License::brxc_license_menu',9999);
        add_action( 'init', 'Advanced_Themer_Bricks\AT__ACF::remove_acf_menu');
        
        /*--------------------------------------
        Variables
        --------------------------------------*/
        
        add_action( 'init', 'Advanced_Themer_Bricks\AT__ACF::load_global_acf_variable', 2 );
        add_action( 'init', 'Advanced_Themer_Bricks\AT__Global_Colors::load_global_color_variable' );
        add_action( 'save_post', 'Advanced_Themer_Bricks\AT__Global_Colors::generate_color_palette_key', 20);
        //add_action( 'acf/save_post', 'Advanced_Themer_Bricks\AT__Grid_Builder::generate_class_key', 25);
        //add_action( 'acf/save_post', 'Advanced_Themer_Bricks\AT__Class_Importer::generate_class_importer_key', 30);
        add_action( 'save_post', 'Advanced_Themer_Bricks\AT__Global_Colors::update_color_palette_options', 35);
        add_action( 'trashed_post', 'Advanced_Themer_Bricks\AT__Global_Colors::update_color_palette_options', 35 );
        add_action( 'transition_post_status', 'Advanced_Themer_Bricks\AT__Global_Colors::update_color_palette_options', 10, 999 );
        //add_action( 'acf/save_post', 'Advanced_Themer_Bricks\AT__Grid_Builder::update_class_options', 40);
        //add_action( 'init', 'Advanced_Themer_Bricks\AT__Class_Importer::update_global_classes_from_importer',999);
        

        /*--------------------------------------
        Create Color Palette CPT 
        --------------------------------------*/

        add_action( 'init', 'Advanced_Themer_Bricks\AT__Admin::color_palette_cpt_init', 2 , 10 );
        add_filter( 'admin_menu', 'Advanced_Themer_Bricks\AT__Admin::reorder_bricks_menu', 999);
        add_filter( 'manage_brxc_color_palette_posts_columns', 'Advanced_Themer_Bricks\AT__Admin::manage_brxc_color_palette_posts_columns_callback');
        add_action( 'manage_brxc_color_palette_posts_custom_column', 'Advanced_Themer_Bricks\AT__Admin::colors_custom_column', 10, 2);
        
        /*--------------------------------------
        Load Custom data in ACF fields
        --------------------------------------*/
        add_filter( 'acf/load_field/key=field_6388e73289b6a', 'Advanced_Themer_Bricks\AT__ACF::load_user_roles_inside_select_field');
        add_filter( 'acf/load_field/key=field_63899284664e9', 'Advanced_Themer_Bricks\AT__ACF::load_post_types_inside_select_field' );
        add_filter( 'acf/load_value/key=field_63a6a51731bbb', 'Advanced_Themer_Bricks\AT__ACF::load_spacing_default_repeater_values', 10, 3);
        add_filter( 'acf/load_value/key=field_63c8f17f5e2ed', 'Advanced_Themer_Bricks\AT__ACF::load_border_default_repeater_values', 10, 3);
        add_filter( 'acf/load_value/key=field_63a6a58831bbe', 'Advanced_Themer_Bricks\AT__ACF::load_typography_default_repeater_values', 10, 3);
        add_filter( 'acf/load_value/key=field_63b48c6f1b20a', 'Advanced_Themer_Bricks\AT__ACF::load_grid_default_repeater_values', 10, 3);
        add_filter( 'acf/load_value/key=field_64018efb660fb', 'Advanced_Themer_Bricks\AT__ACF::load_openai_password', 10, 3);
        add_action( 'acf/save_post', 'Advanced_Themer_Bricks\AT__ACF::save_openai_password', 5, 1 );
        add_action( 'acf/fields/flexible_content/no_value_message', 'Advanced_Themer_Bricks\AT__ACF::change_flexible_layout_no_value_msg', 10, 3);

        
        /*--------------------------------------
        Register / Enqueue Styles
        --------------------------------------*/
        
        add_action( 'init', 'Advanced_Themer_Bricks\AT__Admin::register_scripts' );
        add_action( 'admin_enqueue_scripts', 'Advanced_Themer_Bricks\AT__Admin::admin_enqueue_scripts' );
        add_action( 'get_footer', 'Advanced_Themer_Bricks\AT__Admin::enqueue_scripts_in_footer' );
        add_action( 'get_footer', 'Advanced_Themer_Bricks\AT__Admin::enqueue_builder_scripts' );
        add_action( 'acf/input/admin_enqueue_scripts', 'Advanced_Themer_Bricks\AT__ACF::acf_admin_enqueue_scripts' );
        
        /*--------------------------------------
        Global Colors & Variables
        --------------------------------------*/
        
        add_action( 'wp_enqueue_scripts', 'Advanced_Themer_Bricks\AT__Frontend::load_variables_on_frontend', 2, 5 );
        add_action( 'init', 'Advanced_Themer_Bricks\AT__Global_Colors::load_gutenberg_colors', 30 );
        add_action( 'enqueue_block_assets', 'Advanced_Themer_Bricks\AT__Frontend::bricks_colors_gutenberg_frontend' );
        add_action( 'after_setup_theme', 'Advanced_Themer_Bricks\AT__Frontend::remove_default_gutenberg_presets' );
        
        
        /*--------------------------------------
        Frontend Playground color controler
        --------------------------------------*/
        
        add_filter( 'body_class', 'Advanced_Themer_Bricks\AT__Frontend::add_theme_class_to_body');
        add_action( 'bricks_after_site_wrapper', 'Advanced_Themer_Bricks\AT__Frontend::activate_frontend_gui_on_frontend' );
        
        /*--------------------------------------
        Add Admin Bar Menu Item
        --------------------------------------*/
        
        add_action( 'admin_bar_menu', 'Advanced_Themer_Bricks\AT__Admin::add_link_to_admin_bar', 100);
        add_action( 'admin_bar_menu', 'Advanced_Themer_Bricks\AT__Admin::add_admin_bar_menu', 100);

        //

        add_action( 'wp_footer', 'Advanced_Themer_Bricks\AT__Builder::add_modal_after_body_wrapper' );
        
        /*--------------------------------------
        Uninstall Hook
        --------------------------------------*/

        register_uninstall_hook( BRICKS_ADVANCED_THEMER_PLUGIN_FILE, 'Advanced_Themer_Bricks\AT__Admin::uninstall_method' );

        /*--------------------------------------
        Register New Bricks Elements
        --------------------------------------*/
        
        add_action( 'init',  'Advanced_Themer_Bricks\AT__Helpers::register_bricks_elements', 11 );
  

        /*--------------------------------------
        Class Importer
        --------------------------------------*/

        add_action( 'init', 'Advanced_Themer_Bricks\AT__Class_Importer::enqueue_uploaded_css' );

        /*--------------------------------------
        AJAX Request
        --------------------------------------*/

        add_action( 'wp_ajax_openai_ajax_function', 'Advanced_Themer_Bricks\AT__Builder::openai_ajax_function' );
        add_action( 'wp_ajax_nopriv_openai_ajax_function', 'Advanced_Themer_Bricks\AT__Builder::openai_ajax_function' );
        add_action( 'wp_ajax_openai_save_image_to_media_library', 'Advanced_Themer_Bricks\AT__Builder::openai_save_image_to_media_library' );
        add_action( 'wp_ajax_nopriv_openai_save_image_to_media_library', 'Advanced_Themer_Bricks\AT__Builder::openai_save_image_to_media_library' );
        add_action( 'wp_ajax_export_advanced_options', 'Advanced_Themer_Bricks\AT__Builder::export_advanced_options_callback');
        add_action( 'wp_ajax_norpiv_export_advanced_options', 'Advanced_Themer_Bricks\AT__Builder::export_advanced_options_callback');
        add_action( 'wp_ajax_import_json_data', 'Advanced_Themer_Bricks\AT__Builder::import_json_data');
        add_action( 'wp_ajax_norpiv_import_json_data', 'Advanced_Themer_Bricks\AT__Builder::import_json_data');

        /*--------------------------------------
        Strict Editor View
        --------------------------------------*/
        add_filter( 'admin_menu', 'Advanced_Themer_Bricks\AT__Admin::remove_templates_from_menu', 999 );
        add_action( 'wp_before_admin_bar_render', 'Advanced_Themer_Bricks\AT__Admin::remove_templates_from_toolbar', 999); 
        add_filter( 'bricks/acf/filter_field_groups' , function($groups){
            foreach($groups as $key => $value){
                if($value['key'] === 'group_638315a281bf1' || $value['key'] === 'group_6389e81fa2085'){
                    unset($groups[$key]);
                }
            }
            return $groups;
        });


    }
    
}