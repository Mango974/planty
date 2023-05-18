<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Builder{

    public static function populate_grid_classes(){

        $grid_classes = [];

        if ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

            while ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

                the_row();

                $name = get_sub_field('field_63b48c6f1b20b', 'bricks-advanced-themer' );

                $grid_classes[] = $name;

            endwhile;

        endif;

        return $grid_classes;

    }

    public static function populate_class_importer(){

        $total_classes = [];

        if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

            while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

                the_row();

                $id_stylesheet = get_sub_field('field_63b4bd5c16ac2', 'bricks-advanced-themer' );

                $file = get_sub_field('field_63b4bdf216ac7', 'bricks-advanced-themer' );

                $classes = AT__Class_Importer::extract_selectors_from_css($file);

                if (isset($classes) && !empty($classes) && is_array($classes) ) {

                    foreach ( $classes as $class) {
    
                        $total_classes[] = str_replace(['.', '#'],'', $class);
    
                    }

                }

            endwhile;

        endif;

        return $total_classes;
    }

    public static function add_modal_after_body_wrapper() {

        if (!class_exists('Bricks\Capabilities')) {
            return;
        }

        global $brxc_acf_fields;

        if( bricks_is_builder_iframe() && \Bricks\Capabilities::current_user_has_full_access() === true) {
            if (isset($brxc_acf_fields['enable_global_features']) && !empty($brxc_acf_fields['enable_global_features']) && is_array($brxc_acf_fields['enable_global_features']) && in_array('Grid Guide', $brxc_acf_fields['enable_global_features']) ) {
                wp_add_inline_style('bricks-advanced-themer-builder', preg_replace( '/\s+/', '', '
                        .brxc-grid-guide__wrapper > .brxe-container {
                            grid-template-columns: repeat(' . get_field('field_63ebb3684a5fe', 'bricks-advanced-themer' ) . ', 1fr);
                            gap: ' . get_field('field_63ebb3b64a5ff', 'bricks-advanced-themer' ) . 'px;
                        }
                    '), 'after');
                
                wp_add_inline_style('bricks-advanced-themer-builder', preg_replace( '/\s+/', '', '
                    .brxc-grid-guide__wrapper > .brxe-container {
                        grid-template-columns: repeat(' . get_field('field_63ebb3684a5fe', 'bricks-advanced-themer' ) . ', 1fr);
                        gap: ' . get_field('field_63ebb3b64a5ff', 'bricks-advanced-themer' ) . 'px;
                    }
                '), 'after');
            }

        }

        if( ! bricks_is_builder() || bricks_is_builder_iframe() || !\Bricks\Capabilities::current_user_has_full_access() === true) return;

        if (isset($brxc_acf_fields['default_elements_list_cols']) && !empty($brxc_acf_fields['default_elements_list_cols']) ) {
            wp_add_inline_style('bricks-advanced-themer-builder', '#bricks-panel-elements #bricks-panel-elements-categories .sortable-wrapper {grid-template-columns: repeat( ' . $brxc_acf_fields['default_elements_list_cols'] . ',1fr);}', 'after');

        }
        
        wp_add_inline_script('bricks-builder', preg_replace( '/\s+/', '', "window.addEventListener('DOMContentLoaded', () => {
            ADMINBRXC.globalSettings.shortcutsTabs = JSON.parse('" . json_encode($brxc_acf_fields['enable_tabs_icons']) . "');
            ADMINBRXC.globalSettings.shortcutsIcons = JSON.parse('" . json_encode($brxc_acf_fields['enable_shortcuts_icons']) . "');
            ADMINBRXC.globalSettings.globalFeatures = JSON.parse('" . json_encode($brxc_acf_fields['enable_global_features']) . "');
            ADMINBRXC.globalSettings.classFeatures = JSON.parse('" . json_encode($brxc_acf_fields['class_features']) . "');
            ADMINBRXC.globalSettings.elementFeatures = JSON.parse('" . json_encode($brxc_acf_fields['element_features']) . "');
            ADMINBRXC.globalSettings.themeSettingsTabs = JSON.parse('" . json_encode($brxc_acf_fields['theme_settings_tabs']) . "');
            ADMINBRXC.globalSettings.enableGridGuideCol = '" .$brxc_acf_fields['enable_grid_guide_col'] . "';
            ADMINBRXC.globalSettings.loremIpsumtype = '" . $brxc_acf_fields['lorem_type'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.cssVariableModal = '" . $brxc_acf_fields['keyboard_sc_open_css_variable_modal'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.gridGuides = '" . $brxc_acf_fields['keyboard_sc_enable_grid_guides'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.xMode = '" . $brxc_acf_fields['keyboard_sc_enable_xmode'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.contrastChecker = '" . $brxc_acf_fields['keyboard_sc_enable_constrast_checker'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.darkmode = '" . $brxc_acf_fields['keyboard_sc_enable_darkmode'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.cssStylesheets = '" . $brxc_acf_fields['keyboard_sc_enable_css_stylesheets'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.resources = '" . $brxc_acf_fields['keyboard_sc_enable_resources'] . "';
            ADMINBRXC.globalSettings.keyboardShortcuts.openai = '" . $brxc_acf_fields['keyboard_sc_enable_openai'] . "';
            ADMINBRXC.globalSettings.strictEditorView = '" .$brxc_acf_fields['strict_editor_view'] . "';
            ADMINBRXC.globalSettings.gridClasses = JSON.parse('" . json_encode(self::populate_grid_classes()) . "');
            ADMINBRXC.globalSettings.importedClasses = JSON.parse('" . json_encode(self::populate_class_importer()) . "');

        })"), 'after');

        

        require_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builder_modal.php';
    }
    
    // Create the AJAX function
    public static function openai_ajax_function() {
        // Verify the nonce
        if ( ! wp_verify_nonce( $_POST['nonce'], 'openai_ajax_nonce' ) ) {
            die( 'Invalid nonce' );
        }
    
        // Get the data from the wp_option table
        $my_option = get_option( 'bricks-advanced-themer_brxc_ai_api_key' );
        $ciphering = "AES-128-CTR";
        $options = 0;
        $decryption_iv = 'UrsV9aENFT*IRfhr';
        $decryption_key = "OpenAIPasswordForAdvancedThemer";
        $value = openssl_decrypt ($my_option, $ciphering, $decryption_key, $options, $decryption_iv);
    
        // Return the data as JSON
        wp_send_json( $value );
    }
    
    public static function openai_save_image_to_media_library() {
        // Verify the nonce
        if ( ! wp_verify_nonce( $_POST['nonce'], 'openai_ajax_nonce' ) ) {
            die( 'Invalid nonce' );
        }
    
        if (!current_user_can('edit_posts')) { 

            wp_send_json_error('You do not have permission to save images.'); 

        } 
        $base64_img= $_POST['image_url'];

        if(!$base64_img){
            wp_send_json_error('Could not retrieve image data.');
        }

        $title = 'ai-image-' . AT__Helpers::generate_unique_string( 6 );
        $upload_dir  = wp_upload_dir();
        $upload_path = str_replace( '/', DIRECTORY_SEPARATOR, $upload_dir['path'] ) . DIRECTORY_SEPARATOR;

        $img             = str_replace( 'data:image/png;base64,', '', $base64_img );
        $img             = str_replace( ' ', '+', $img );
        $decoded         = base64_decode( $img );
        $filename        = $title . '.png';
        $file_type       = 'image/png';
        $hashed_filename = md5( $filename . microtime() ) . '_' . $filename;

        // Save the image in the uploads directory.
        $upload_file = file_put_contents( $upload_path . $hashed_filename, $decoded );
        $target_file = trailingslashit($upload_dir['path']) . $hashed_filename;

        $attachment = array(
            'post_mime_type' => $file_type,
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $hashed_filename ) ),
            'post_content'   => '',
            'post_status'    => 'inherit',
            'guid'           => $upload_dir['url'] . '/' . basename( $hashed_filename )
        );

        $attach_id = wp_insert_attachment( $attachment, $upload_dir['path'] . '/' . $hashed_filename );
        $attachment_data = wp_generate_attachment_metadata($attach_id, $target_file);
        wp_update_attachment_metadata($attach_id, $attachment_data);
        wp_send_json_success('Image saved successfully.'); 

    }

    public static function export_advanced_options_callback() {
        if (!current_user_can('manage_options')) {
            wp_send_json_error('You don\'t have permission to perform this action.');
        }
        // Verify nonce
        $nonce = isset($_POST['nonce']) ? sanitize_text_field($_POST['nonce']) : '';
    
        if (!wp_verify_nonce($nonce, 'export_advanced_options_nonce')) {
            wp_die("Invalid nonce, please refresh the page and try again.");
        }
    
        global $wpdb;
        $option_data = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE '%bricks-advanced-themer%'");
        
        $json_data = array();
        
        foreach ($option_data as $row) {
            $json_data[$row->option_name] = maybe_unserialize($row->option_value);
        }
    
        echo json_encode($json_data);
        
        wp_die(); // Required for AJAX callback 

    } 
    
    public static function import_json_data() {

        if (!current_user_can('manage_options')) {
            wp_send_json_error('You don\'t have permission to perform this action.');
        }

        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            wp_send_json_error('Error uploading file.');
        }
            
        $json_file = file_get_contents($_FILES['file']['tmp_name']);
        $data = json_decode($json_file, true);
        
        if ($data === null) {
            wp_send_json_error('Invalid JSON file.');
        }
        
        global $wpdb;
        
        $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'bricks-advanced-themer'"); 
        foreach ($data as $row) { 
            // Make sure to sanitize and validate the data before inserting. 
            $option_name = sanitize_text_field($row['option_name']); 
            $option_value = maybe_serialize($row['option_value']); 
            $wpdb->insert($wpdb->options, array('option_name' => $option_name, 'option_value' => $option_value)); 
        } 
        
        wp_send_json_success(); 
    }
} 
