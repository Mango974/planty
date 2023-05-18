<?php
namespace Advanced_Themer_Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__ACF{

    public static function acf_get_role(){

        return get_field('field_6388e73289b6a','bricks-advanced-themer' );
    }

    public static function acf_settings_path( $path ) {

        $acf_path = BRICKS_ADVANCED_THEMER_PATH . 'plugins/acf-pro/';

        return $acf_path;

    }

    public static function acf_settings_dir( $path ) {

        $acf_path = BRICKS_ADVANCED_THEMER_URL . '/plugins/acf-pro/';

        return $acf_path;

    }

    public static function acf_json_save_point( $path ) {

        $acf_json_path = BRICKS_ADVANCED_THEMER_PATH . 'acf-json/';

        return $acf_json_path;

    }

    public static function acf_json_load_point( $paths ) {
          
        $paths[] = BRICKS_ADVANCED_THEMER_PATH . 'acf-json/';
        
        return $paths;
        
    }

    public static function stop_acf_update_notifications( $value ) {

        unset( $value->response[ BRICKS_ADVANCED_THEMER_URL . '/plugins/acf-pro/acf.php' ] );

        return $value;

    }

    public static function create_advanced_themer_option_page() {

        // Check function exists.
        if( function_exists( 'acf_add_options_sub_page' ) ) {

            // Register options page.
            $option_page = acf_add_options_sub_page(
                array(
                'page_title'    => __( 'Theme Settings' ),
                'menu_title'    => __( 'AT - Theme Settings' ),
                'menu_slug'     => 'bricks-advanced-themer',
                'parent'        => 'bricks',
                'capability'    => 'edit_posts',
                'redirect'      => false,
                'position'      => '98',
                'update_button' => __('Save Settings', 'acf'),
                'post_id' => 'bricks-advanced-themer',
                )

            );

        }

    }

    // Get a list of editable user roles
    private static function get_editable_roles() {

        $all_roles = wp_roles()->roles;


	    $editable_roles = apply_filters( 'editable_roles', $all_roles );
    
        return $editable_roles;

    }

    // Return a list of all the public post types on the site
    private static function return_array_all_post_types() {

        $args = array(
            'public'   => true,
        );
        
        $output = 'names';

        $operator = 'and';

        $post_types = get_post_types( $args, $output, $operator );

        return $post_types;

    }

    public static function load_user_roles_inside_select_field( $field ){

        $roles = self::get_editable_roles();

        if ( !$roles || !is_array( $roles ) ){

            return;

        }

        $field['choices'] = [];

        $default = [];
      
        foreach ( $roles as $role ) {

            $field['choices'][strtolower( $role['name'] )] = $role['name'];

        }

        return $field;

    }

    public static function load_post_types_inside_select_field( $field ){

        $post_types_arr = self::return_array_all_post_types();

        if ( !$post_types_arr || !is_array( $post_types_arr ) ) {

            return;

        }

        $field['choices'] = [];

        $default = [];
      
        foreach ( $post_types_arr as $post_type ){

            $field['choices'][strtolower( $post_type )] = $post_type;

            $default[] = strtolower( $post_type );

        }
        
        $field['default_value'] = $default;

        return $field;

    }

    public static function load_spacing_default_repeater_values($value, $post_id, $field) {

        if ($value === false) {

            $value = array();
            
            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-xs-1',
                'field_63a6a55c31bbd' => '4',
                'field_63a82e7791041' => '4',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-xs-2',
                'field_63a6a55c31bbd' => '8',
                'field_63a82e7791041' => '8',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-s-1',
                'field_63a6a55c31bbd' => '12',
                'field_63a82e7791041' => '16',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-s-2',
                'field_63a6a55c31bbd' => '16',
                'field_63a82e7791041' => '24',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-s-3',
                'field_63a6a55c31bbd' => '20',
                'field_63a82e7791041' => '32',
            );
            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-m-1',
                'field_63a6a55c31bbd' => '24',
                'field_63a82e7791041' => '40',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-m-2',
                'field_63a6a55c31bbd' => '28',
                'field_63a82e7791041' => '48',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-m-3',
                'field_63a6a55c31bbd' => '32',
                'field_63a82e7791041' => '56',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-l-1',
                'field_63a6a55c31bbd' => '40',
                'field_63a82e7791041' => '64',
            );
            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-l-2',
                'field_63a6a55c31bbd' => '44',
                'field_63a82e7791041' => '72',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-l-3',
                'field_63a6a55c31bbd' => '48',
                'field_63a82e7791041' => '80',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-xl-1',
                'field_63a6a55c31bbd' => '64',
                'field_63a82e7791041' => '120',
            );
            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-xl-2',
                'field_63a6a55c31bbd' => '80',
                'field_63a82e7791041' => '160',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'gap-xl-3',
                'field_63a6a55c31bbd' => '104',
                'field_63a82e7791041' => '240',
            );
            $value[] = array(
                'field_63a6a53f31bbc' => 'btn-vert-pad',
                'field_63a6a55c31bbd' => '4',
                'field_63a82e7791041' => '8',
            );
            $value[] = array(
                'field_63a6a53f31bbc' => 'btn-horiz-pad',
                'field_63a6a55c31bbd' => '24',
                'field_63a82e7791041' => '40',
            );

            $value[] = array(
                'field_63a6a53f31bbc' => 'card-vert-pad',
                'field_63a6a55c31bbd' => '24',
                'field_63a82e7791041' => '40',
            );
            $value[] = array(
                'field_63a6a53f31bbc' => 'card-horiz-pad',
                'field_63a6a55c31bbd' => '24',
                'field_63a82e7791041' => '40',
            );
  
          }
        
          return $value;

    }

    public static function load_border_default_repeater_values($value, $post_id, $field) {

        if ($value === false) {

            $value = array();

            $value[] = array(
                'field_63c8f17f5e2ee' => 'radius-img',
                'field_63c8f17f5e2ef' => '16',
                'field_63c8f17f5e2f0' => '24',
            );
            
            $value[] = array(
                'field_63c8f17f5e2ee' => 'radius-card',
                'field_63c8f17f5e2ef' => '6',
                'field_63c8f17f5e2f0' => '12',
            );

            $value[] = array(
                'field_63c8f17f5e2ee' => 'radius-btn',
                'field_63c8f17f5e2ef' => '4',
                'field_63c8f17f5e2f0' => '8',
            );
  
          }
        
          return $value;

    }

    public static function load_typography_default_repeater_values($value, $post_id, $field) {

        if ($value === false) {

            $value = array();
            

            //clamp(5.6rem, 4.2154rem + 3.8462vw, 9.6rem)
            $value[] = array(
                'field_63a6a58831bbf' => 'font-h1',
                'field_63a6a58831bc0' => '56',
                'field_63a844885697c' => '96',
            );

            //clamp(3.8rem, 3.0385rem + 2.1154vw, 6rem)
            $value[] = array(
                'field_63a6a58831bbf' => 'font-h2',
                'field_63a6a58831bc0' => '38',
                'field_63a844885697c' => '60',
            );

            //clamp(3.2rem, 2.6462rem + 1.5385vw, 4.8rem)
            $value[] = array(
                'field_63a6a58831bbf' => 'font-h3',
                'field_63a6a58831bc0' => '32',
                'field_63a844885697c' => '48',
            );

            //clamp(2.5rem, 2.2577rem + 0.6731vw, 3.2rem)
            $value[] = array(
                'field_63a6a58831bbf' => 'font-h4',
                'field_63a6a58831bc0' => '25',
                'field_63a844885697c' => '32',
            );

            //clamp(2rem, 1.8615rem + 0.3846vw, 2.4rem)
            $value[] = array(
                'field_63a6a58831bbf' => 'font-h5',
                'field_63a6a58831bc0' => '20',
                'field_63a844885697c' => '24',
            );

            //clamp(1.8rem, 1.7308rem + 0.1923vw, 2rem)
            $value[] = array(
                'field_63a6a58831bbf' => 'font-h6',
                'field_63a6a58831bc0' => '18',
                'field_63a844885697c' => '20',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-subtitle',
                'field_63a6a58831bc0' => '14',
                'field_63a844885697c' => '16',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-subtitle-xs',
                'field_63a6a58831bc0' => '12',
                'field_63a844885697c' => '14',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-body',
                'field_63a6a58831bc0' => '14',
                'field_63a844885697c' => '16',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-body-xs',
                'field_63a6a58831bc0' => '12',
                'field_63a844885697c' => '14',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-button',
                'field_63a6a58831bc0' => '12',
                'field_63a844885697c' => '14',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-button-l',
                'field_63a6a58831bc0' => '14',
                'field_63a844885697c' => '16',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-caption',
                'field_63a6a58831bc0' => '10',
                'field_63a844885697c' => '12',
            );

            $value[] = array(
                'field_63a6a58831bbf' => 'font-overline',
                'field_63a6a58831bc0' => '8',
                'field_63a844885697c' => '10',
            );
          }
        
          return $value;

    }

    public static function load_grid_default_repeater_values($value, $post_id, $field) {


        if ($value === false) {

            $value = array();
            
            $value[] = array(
                'field_63b48c6f1b20b' => 'grid-3',
                'field_63b48c6f1b20c' => '3',
                'field_63b48c6f1b20d' => '280',
                'field_63b48d7e1b20e' => '2rem',
            );

          }
        
          return $value;

    }

    public static function load_bricks_elements_inside_checkbox_field( $field ) {
        /*$elements = self::get_bricks_elements();
         $excluded = [
            "container",
            "section",
            "block",
            "div",
            "divider",
            "form",
            "map",
            "alert",
            "html",
            "code",
            "template",
            "wordpress",
            "posts",
            "pagination",
            "sidebar",
            "search",
            "shortcode",
            "post-title",
            "post-excerpt",
            "post-meta",
            "post-content",
            "post-sharing",
            "related-posts",
            "post-author",
            "post-comments",
            "post-taxonomy",
            "post-navigation",
            "brxc-darkmode-toggle",
            "brxc-darkmode-btn",
            "brxc-color-swatch",
            "brxc-preset-swatch",
            "brxc-theme-editor",
            "brxc-color-palette-style-guide"
        ];
        if( !isset( $elements ) || empty( $elements ) || !is_array( $elements ) ) return $field;
        $field['choices'] = [];
        $field['default_value'] = [];
        $default_elements = ['heading', 'text', 'text-basic', 'button', 'icon', 'image', 'video','icon-box', 'list'];
        foreach( $elements as $element ){

            $label = $element['name'];

            if (in_array($label, $excluded ) ) continue;

            $value = ucfirst(str_replace('-',' ',str_replace('brxc-','',$label)));
            
            $field['choices'][$label] = $value;

            if( in_array( $label, $default_elements ) ) {

                $field['default_value'][] = $label;
            }
        }

        return $field;*/
    }

    public static function change_flexible_layout_no_value_msg( $no_value_message, $field) {
        if(!$field['key'] === 'field_63dd12891d1d9') return;

        $no_value_message = __('Click the "%s" button below to start creating your own CSS variables','acf');

        return $no_value_message;
    }
    
    //openaAI Password
    public static function load_openai_password($value, $post_id, $field) {


        if (isset($value) && !empty($value) && $value) {
            $ciphering = "AES-128-CTR";
            $options = 0;
            $decryption_iv = 'UrsV9aENFT*IRfhr';
            $decryption_key = "OpenAIPasswordForAdvancedThemer";
            $value = openssl_decrypt ($value, $ciphering, $decryption_key, $options, $decryption_iv);

        }
        
        return $value;

    }

    public static function save_openai_password(){

        $screen = get_current_screen();

        if (!$screen || (strpos($screen->id, "bricks-advanced-themer") == false) )  return;

        // Check if a specific value was updated.
        if( isset($_POST['acf']['field_64018efb660fb']) && !empty($_POST['acf']['field_64018efb660fb'])) {

            $ciphering = "AES-128-CTR";
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;
            $encryption_iv = 'UrsV9aENFT*IRfhr';
            $encryption_key = "OpenAIPasswordForAdvancedThemer";
            $_POST['acf']['field_64018efb660fb'] = openssl_encrypt($_POST['acf']['field_64018efb660fb'], $ciphering, $encryption_key, $options, $encryption_iv);

        }
    
    }


    // ACF fields from Option Page
    public static function load_global_acf_variable() {

        global $brxc_acf_fields;
        
        $brxc_acf_fields = [];

        // Theme Settings
        $brxc_acf_fields['theme_settings_tabs'] = get_field('field_645s9g7tddfj2', 'bricks-advanced-themer' );

        // Values from the option page/Spacing
 
        $brxc_acf_fields['spacing_repeater'] = get_field('field_63a6a51731bbb', 'bricks-advanced-themer' );

        // Values from the option page/typography
 
        $brxc_acf_fields['typography_repeater'] = get_field('field_63a6a58831bbe', 'bricks-advanced-themer' );

        // Values from the option page/Settings
        $brxc_acf_fields['global_prefix'] = get_field('field_63ab121136eb9', 'bricks-advanced-themer' );
        $brxc_acf_fields['base_font'] = get_field('field_63a843db56979', 'bricks-advanced-themer' );
        $brxc_acf_fields['min_vw'] = get_field('field_63a843f85697a', 'bricks-advanced-themer' );
        $brxc_acf_fields['max_vw ']= get_field('field_63a8440d5697b', 'bricks-advanced-themer' );
        $brxc_acf_fields['enable_frontend_gui'] = get_field('field_638380c42dac1', 'bricks-advanced-themer' );
        $brxc_acf_fields['frontend_gui_theme'] = get_field('field_6399a2840185c', 'bricks-advanced-themer' );
        $brxc_acf_fields['user_role_permissions'] = get_field('field_6388e73289b6a','bricks-advanced-themer' );
        $brxc_acf_fields['post_types_permissions'] = get_field('field_63899284664e9','bricks-advanced-themer' );
        $brxc_acf_fields['enable_elements'] = get_field('field_63aabb0ccebeb', 'bricks-advanced-themer' );
        $brxc_acf_fields['remove_data'] = get_field('field_63ab55f50e545', 'bricks-advanced-themer' );
        $brxc_acf_fields['replace_gutenberg_palettes'] = get_field('field_63b3dc8b9484d', 'bricks-advanced-themer' );
        $brxc_acf_fields['remove_default_gutenberg_presets'] = get_field('field_63b3ddc49484f', 'bricks-advanced-themer' );
        $brxc_acf_fields['remove_acf_menu'] = get_field('field_63a8765e6ceed', 'bricks-advanced-themer' );

        // Global Features
        $brxc_acf_fields['enable_global_features'] = get_field('field_641af47fbf980', 'bricks-advanced-themer' );
        $brxc_acf_fields['enable_grid_guide_col'] = get_field('field_63ebb3684a5fe', 'bricks-advanced-themer' );
        $brxc_acf_fields['openai_api_key'] = get_field('field_64018efb660fb', 'bricks-advanced-themer' );

        // Classes & Styles
        $brxc_acf_fields['class_features'] = get_field('field_64074j8de4756', 'bricks-advanced-themer' );

        // Elements
        $brxc_acf_fields['element_features'] = get_field('field_64074ge58dfj2', 'bricks-advanced-themer' );
        $brxc_acf_fields['enable_tabs_icons'] = get_field('field_6426786feb84a', 'bricks-advanced-themer' );
        $brxc_acf_fields['lorem_type'] = get_field('field_63d651ddc5a6f', 'bricks-advanced-themer' );
        $brxc_acf_fields['default_elements_list_cols'] = get_field('field_63dd6b8k2la6f', 'bricks-advanced-themer' );
        $brxc_acf_fields['enable_shortcuts_icons'] = get_field('field_6420a42b78413', 'bricks-advanced-themer' );

        // Keyboard Shortcuts
        $brxc_acf_fields['keyboard_sc_open_css_variable_modal'] = get_field('field_63db8199d73d4', 'bricks-advanced-themer' );
        $brxc_acf_fields['keyboard_sc_enable_grid_guides'] = get_field('field_63dba4f8f5056', 'bricks-advanced-themer' );
        $brxc_acf_fields['keyboard_sc_enable_xmode'] = get_field('field_63dba4b8f5055', 'bricks-advanced-themer' );
        $brxc_acf_fields['keyboard_sc_enable_constrast_checker'] = get_field('field_63dba510f5057', 'bricks-advanced-themer' );
        $brxc_acf_fields['keyboard_sc_enable_darkmode'] = get_field('field_63dba543f5058', 'bricks-advanced-themer' );
        $brxc_acf_fields['keyboard_sc_enable_css_stylesheets'] = get_field('field_63dba55ff5059', 'bricks-advanced-themer' );
        $brxc_acf_fields['keyboard_sc_enable_resources'] = get_field('field_63dba59df505a', 'bricks-advanced-themer' );
        $brxc_acf_fields['keyboard_sc_enable_openai'] = get_field('field_6418f83d91c38', 'bricks-advanced-themer' );

        // Editor Strict View
        $brxc_acf_fields['strict_editor_view'] = get_field('field_63df639314dd1', 'bricks-advanced-themer' );
        $brxc_acf_fields['strict_editor_view_elements'] = get_field('field_63e0ccbf3f5d0', 'bricks-advanced-themer' );

        //$brxc_acf_fields['change_logo_img'] = get_field('field_64066003f4140', 'bricks-advanced-themer' );
        $brxc_acf_fields['change_accent_color'] = get_field('field_640660aee91e4', 'bricks-advanced-themer' );
        $brxc_acf_fields['disable_toolbar_icons'] = get_field('field_64065d4de47ca', 'bricks-advanced-themer' );
        $brxc_acf_fields['reduce_left_panel_visibility'] = get_field('field_6406649640d2d', 'bricks-advanced-themer' );
        $brxc_acf_fields['disable_header_footer_hover_btn'] = get_field('field_64073d2b6d6bc', 'bricks-advanced-themer' );
        $brxc_acf_fields['remove_template_links'] = get_field('field_640756cf80359', 'bricks-advanced-themer' );
        $brxc_acf_fields['tone_of_voice'] = [
            'Authoritative',
            'Conversational',
            'Casual',
            'Enthusiastic',
            'Formal',
            'Frank',
            'Friendly',
            'Funny',
            'Humorous',
            'Informative',
            'Irreverent',
            'Matter-of-fact',
            'Passionate',
            'Playful',
            'Professional',
            'Provocative',
            'Respectful',
            'Sarcastic',
            'Smart',
            'Sympathetic',
            'Trustworthy',
            'Witty',
        ];
        $brxc_acf_fields['ai_models']['completion'] = ['gpt-4','gpt-4-32k','gpt-3.5-turbo'];
        //$brxc_acf_fields['ai_models']['edit'] = ['text-davinci-edit-001', 'text-davinci-edit-002'];
        $brxc_acf_fields['ai_models']['edit'] = ['gpt-4','gpt-4-32k','gpt-3.5-turbo'];
        $brxc_acf_fields['ai_models']['code'] = ['gpt-4','gpt-4-32k','gpt-3.5-turbo'];
    }

    public static function remove_acf_menu() {

        global $brxc_acf_already_exists;

        if(!$brxc_acf_already_exists && $brxc_acf_already_exists !== false) return;

        global $brxc_acf_fields;

        if (  get_field('field_63a8765e6ceed', 'bricks-advanced-themer' )) {
            add_filter('acf/settings/show_admin', '__return_false');

        }
    }

    //Enqueue admin ACF Scripts
    public static function acf_admin_enqueue_scripts() {

        if( !is_user_logged_in() ) {

            return;

        }

        wp_enqueue_style( 'brxc_acf_admin', BRICKS_ADVANCED_THEMER_URL . '/assets/css/acf-admin.css', false, filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/acf-admin.css') );
        wp_enqueue_script( 'brxc_acf_admin', BRICKS_ADVANCED_THEMER_URL . '/assets/js/acf-admin.js', false, filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/acf-admin.js') );
        $nonce = wp_create_nonce('export_advanced_options_nonce');
        wp_localize_script('brxc_acf_admin', 'exportOptions', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => $nonce,
        ));

    }

    public static function acf_color_palettes_fields(){

        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_6389e81fa2085',
                'title' => 'Color Palette Post Type',
                'fields' => array(
                    array(
                        'key' => 'field_63956fca26ebb',
                        'label' => 'Colors',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_6383d6f67641b',
                        'label' => 'Colors',
                        'name' => 'brxc_colors_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'Add the colors to your palette here. Choose a unique name for each label in order to avoid CSS conflicts, or make sure to set a prefix value in the settings tab.',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'color-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 1,
                        'max' => 0,
                        'collapsed' => '',
                        'button_label' => 'Add a New Color',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_638728339e15f',
                                'label' => 'Label',
                                'name' => 'brxc_color_label',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '40',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_6383d6f67641b',
                            ),
                            array(
                                'key' => 'field_638344c95efcf',
                                'label' => 'Color',
                                'name' => 'brxc_color_hex',
                                'aria-label' => '',
                                'type' => 'color_picker',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '60',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'enable_opacity' => 0,
                                'return_format' => 'string',
                                'parent_repeater' => 'field_6383d6f67641b',
                            ),
                            array(
                                'key' => 'field_63958c871e42e',
                                'label' => 'ID',
                                'name' => 'brxc_color_id',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => 'hidden',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_6383d6f67641b',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63956fe226ebc',
                        'label' => 'Settings',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_639570d626ec1',
                        'label' => 'Add a prefix to your CSS variables',
                        'name' => 'brxc_variable_prefix',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => 'The prefix will be automatically added to all your colors (including shades). Example of variable generated with "p1" as prefix: --brxc-p1-primary-color.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'prefix-css',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_6395700626ebd',
                        'label' => 'Enable Shades',
                        'name' => 'brxc_enable_shapes',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'If this field is checked, the plugin will automatically generate 12 different shades for each color: 6 light and 6 dark variations. They will appear inside the Bricks builder.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_6395707d26ec0',
                        'label' => 'Enable Dark Mode',
                        'name' => 'brxc_enable_dark_mode',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'Check this field if you plan to implement a dark mode on your website.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_63882c3f1215b',
                        'label' => 'Import custom shapes/colors (JSON)',
                        'name' => 'brxc_import_from_json',
                        'aria-label' => '',
                        'type' => 'textarea',
                        'instructions' => 'Paste here the JSON object generated by the export function of the playground GUI.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_6395707d26ec0',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'rows' => '',
                        'placeholder' => '',
                        'new_lines' => '',
                    ),
                    array(
                        'key' => 'field_6395702f26ebe',
                        'label' => 'Color Palette Key',
                        'name' => 'brxc_color_palette_key',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'hidden',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'brxc_color_palette',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));
            
            endif;				

    }

    public static function acf_settings_fields() {

        if( function_exists('acf_add_local_field_group') ):

            global $brxc_acf_fields;

            acf_add_local_field_group(array(
                'key' => 'group_638315a281bf1',
                'title' => 'Option Page',
                'fields' => array(
                    array(
                        'key' => 'field_63a6a4d97c8b6',
                        'label' => 'Typography',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'typography',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63a6a58831bbe',
                        'label' => 'Typography Variables',
                        'name' => 'brxc_typography_variables_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'In the following repeater, you can add/edit/remove your typography variables. Each row requires a label, a min value, and a max value. The label is used to create your CSS variable like var(--label). The min value is set in Pixels and represents the default value applied when reaching the minimum viewport width set in the Setting tab. The max value is also set in Pixels and represents the default max value when reaching the maximum viewport width. Keep in mind that all the pixels values will be converted in REM on frontend.<br><strong>The default values are set according to the <a href="https://mui.com/material-ui/customization/typography/#responsive-font-sizes">material UI font-size scale</a>.</strong>',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'typography-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => 'field_63a6a58831bbf',
                        'button_label' => 'Add a new typography variable',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_63a6a58831bbf',
                                'label' => 'Label',
                                'name' => 'brxc_typography_label',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '50',
                                    'class' => 'label',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63a6a58831bbe',
                            ),
                            array(
                                'key' => 'field_63a6a58831bc0',
                                'label' => 'Min Value',
                                'name' => 'brxc_typography_min_value',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => 'min-value',
                                    'id' => '',
                                ),
                                'default_value' => 32,
                                'min' => 1,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 0.01,
                                'prepend' => '',
                                'append' => 'px',
                                'parent_repeater' => 'field_63a6a58831bbe',
                            ),
                            array(
                                'key' => 'field_63a844885697c',
                                'label' => 'Max Value',
                                'name' => 'brxc_typography_max_value',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => 'max-value',
                                    'id' => '',
                                ),
                                'default_value' => 48,
                                'min' => 1,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 0.01,
                                'prepend' => '',
                                'append' => 'px',
                                'parent_repeater' => 'field_63a6a58831bbe',
                            ),
                            array(
                                'key' => 'field_63c79e51022d8',
                                'label' => 'Preview',
                                'name' => '',
                                'aria-label' => '',
                                'type' => 'message',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '100',
                                    'class' => 'preview',
                                    'id' => '',
                                ),
                                'message' => '<div class="typography-preview">Bricks is awesome.</div>',
                                'new_lines' => 'wpautop',
                                'esc_html' => 0,
                                'parent_repeater' => 'field_63a6a58831bbe',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63a6a4d17c8b5',
                        'label' => 'Spacing',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'spacing',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63a6a51731bbb',
                        'label' => 'Spacing Variables',
                        'name' => 'brxc_spacing_variables_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'In the following repeater, you can add/edit/remove your spacing variables. Each row requires a label, a min value, and a max value. The label is used to create your CSS variable like var(--label). The min value is set in Pixels and represents the default value applied when reaching the minimum viewport width set in the Setting tab. The max value is also set in Pixels and represents the default max value when reaching the maximum viewport width. Keep in mind that all the pixels values will be converted in REM on frontend.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'spacing-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => 'field_63a6a53f31bbc',
                        'button_label' => 'Add a new spacing variable',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_63a6a53f31bbc',
                                'label' => 'Label',
                                'name' => 'brxc_spacing_label',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '50',
                                    'class' => 'label',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63a6a51731bbb',
                            ),
                            array(
                                'key' => 'field_63a6a55c31bbd',
                                'label' => 'Min Value',
                                'name' => 'brxc_spacing_min_value',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => 'min-value',
                                    'id' => '',
                                ),
                                'default_value' => 10,
                                'min' => 1,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 0.01,
                                'prepend' => '',
                                'append' => 'px',
                                'parent_repeater' => 'field_63a6a51731bbb',
                            ),
                            array(
                                'key' => 'field_63a82e7791041',
                                'label' => 'Max Value',
                                'name' => 'brxc_spacing_max_value',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => 'max-value',
                                    'id' => '',
                                ),
                                'default_value' => 20,
                                'min' => 1,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 0.01,
                                'prepend' => '',
                                'append' => 'px',
                                'parent_repeater' => 'field_63a6a51731bbb',
                            ),
                            array(
                                'key' => 'field_63c7dc4a42516',
                                'label' => 'Preview',
                                'name' => '',
                                'aria-label' => '',
                                'type' => 'message',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '100',
                                    'class' => 'preview',
                                    'id' => '',
                                ),
                                'message' => '<div class="spacing-preview">
            <div class="spacing-preview-1"></div>
            <div class="spacing-preview-2"></div>
            </div>',
                                'new_lines' => 'wpautop',
                                'esc_html' => 0,
                                'parent_repeater' => 'field_63a6a51731bbb',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63c8f16e5e2ec',
                        'label' => 'Border-radius',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'border-radius',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63c8f17f5e2ed',
                        'label' => 'Border-radius Variables',
                        'name' => 'brxc_border_variables_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'In the following repeater, you can add/edit/remove your border-radius variables. Each row requires a label, a min value, and a max value. The label is used to create your CSS variable like var(--label). The min value is set in Pixels and represents the default value applied when reaching the minimum viewport width set in the Setting tab. The max value is also set in Pixels and represents the default max value when reaching the maximum viewport width. Keep in mind that all the pixels values will be converted in REM on frontend.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'border-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => 'field_63a6a53f31bbc',
                        'button_label' => 'Add a new spacing variable',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_63c8f17f5e2ee',
                                'label' => 'Label',
                                'name' => 'brxc_border_label',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '50',
                                    'class' => 'label',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63c8f17f5e2ed',
                            ),
                            array(
                                'key' => 'field_63c8f17f5e2ef',
                                'label' => 'Min Value',
                                'name' => 'brxc_border_min_value',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => 'min-value',
                                    'id' => '',
                                ),
                                'default_value' => 10,
                                'min' => 1,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 0.01,
                                'prepend' => '',
                                'append' => 'px',
                                'parent_repeater' => 'field_63c8f17f5e2ed',
                            ),
                            array(
                                'key' => 'field_63c8f17f5e2f0',
                                'label' => 'Max Value',
                                'name' => 'brxc_border_max_value',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => 'max-value',
                                    'id' => '',
                                ),
                                'default_value' => 20,
                                'min' => 1,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 0.01,
                                'prepend' => '',
                                'append' => 'px',
                                'parent_repeater' => 'field_63c8f17f5e2ed',
                            ),
                            array(
                                'key' => 'field_63c8f17f5e2f1',
                                'label' => 'Preview',
                                'name' => '',
                                'aria-label' => '',
                                'type' => 'message',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '100',
                                    'class' => 'preview',
                                    'id' => '',
                                ),
                                'message' => '<div class="border-preview">
            </div>',
                                'new_lines' => 'wpautop',
                                'esc_html' => 0,
                                'parent_repeater' => 'field_63c8f17f5e2ed',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63a84218b5268',
                        'label' => 'Custom Variables',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'custom-variables',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_64066a105f7ec',
                        'label' => 'Custom Variables',
                        'name' => 'brxc_misc_category_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'In the following repeater, you can add/edit/remove your own variables. First, create a category where the variable will be stored. The category label will be shown inside the Variable Picker. Each row requires a label and a value. The label is used to create your CSS variable like var(--label). Choose between a static or a fluid (clamp) variable.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'spacing-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => 'field_64066a535f7ed',
                        'button_label' => 'Add a Category',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_64066a535f7ed',
                                'label' => 'Category Label',
                                'name' => 'brxc_misc_category_label',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_64066a105f7ec',
                            ),
                            array(
                                'key' => 'field_63dd12891d1d9',
                                'label' => 'CSS Variables',
                                'name' => 'brxc_misc_variables_repeater',
                                'aria-label' => '',
                                'type' => 'flexible_content',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => 'misc-repeater',
                                    'id' => '',
                                ),
                                'layouts' => array(
                                    'layout_63dd12920c84c' => array(
                                        'key' => 'layout_63dd12920c84c',
                                        'name' => 'brxc_misc_fluid_variable',
                                        'label' => 'Fluid Variable',
                                        'display' => 'block',
                                        'sub_fields' => array(
                                            array(
                                                'key' => 'field_63dd12dd1d1dc',
                                                'label' => 'Label',
                                                'name' => 'brxc_misc_fluid_label',
                                                'aria-label' => '',
                                                'type' => 'text',
                                                'instructions' => '',
                                                'required' => 1,
                                                'conditional_logic' => 0,
                                                'wrapper' => array(
                                                    'width' => '',
                                                    'class' => 'label',
                                                    'id' => '',
                                                ),
                                                'default_value' => '',
                                                'maxlength' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                            ),
                                            array(
                                                'key' => 'field_63dd12e61d1dd',
                                                'label' => 'Min Value',
                                                'name' => 'brxc_misc_fluid_min_value',
                                                'aria-label' => '',
                                                'type' => 'number',
                                                'instructions' => '',
                                                'required' => 1,
                                                'conditional_logic' => 0,
                                                'wrapper' => array(
                                                    'width' => '31',
                                                    'class' => 'min-value',
                                                    'id' => '',
                                                ),
                                                'default_value' => 10,
                                                'min' => 1,
                                                'max' => '',
                                                'placeholder' => '',
                                                'step' => 0.01,
                                                'prepend' => '',
                                                'append' => 'px',
                                            ),
                                            array(
                                                'key' => 'field_63dd12f21d1de',
                                                'label' => 'Max Value',
                                                'name' => 'brxc_misc_fluid_max_value',
                                                'aria-label' => '',
                                                'type' => 'number',
                                                'instructions' => '',
                                                'required' => 1,
                                                'conditional_logic' => 0,
                                                'wrapper' => array(
                                                    'width' => '31',
                                                    'class' => 'max-value',
                                                    'id' => '',
                                                ),
                                                'default_value' => 20,
                                                'min' => 1,
                                                'max' => '',
                                                'placeholder' => '',
                                                'step' => 0.01,
                                                'prepend' => '',
                                                'append' => 'px',
                                            ),
                                        ),
                                        'min' => '',
                                        'max' => '',
                                    ),
                                    'layout_63dd13191d1e0' => array(
                                        'key' => 'layout_63dd13191d1e0',
                                        'name' => 'brxc_misc_static_variable',
                                        'label' => 'Static Variable',
                                        'display' => 'block',
                                        'sub_fields' => array(
                                            array(
                                                'key' => 'field_63dd13341d1e1',
                                                'label' => 'Label',
                                                'name' => 'brxc_misc_static_label',
                                                'aria-label' => '',
                                                'type' => 'text',
                                                'instructions' => '',
                                                'required' => 1,
                                                'conditional_logic' => 0,
                                                'wrapper' => array(
                                                    'width' => '',
                                                    'class' => '',
                                                    'id' => '',
                                                ),
                                                'default_value' => '',
                                                'maxlength' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                            ),
                                            array(
                                                'key' => 'field_63dd135e1d1e2',
                                                'label' => 'Value',
                                                'name' => 'brxc_misc_static_value',
                                                'aria-label' => '',
                                                'type' => 'text',
                                                'instructions' => '',
                                                'required' => 1,
                                                'conditional_logic' => 0,
                                                'wrapper' => array(
                                                    'width' => '75',
                                                    'class' => '',
                                                    'id' => '',
                                                ),
                                                'default_value' => '',
                                                'maxlength' => '',
                                                'placeholder' => '',
                                                'prepend' => '',
                                                'append' => '',
                                            ),
                                        ),
                                        'min' => '',
                                        'max' => '',
                                    ),
                                ),
                                'min' => '',
                                'max' => '',
                                'button_label' => 'Add a Variable',
                                'parent_repeater' => 'field_64066a105f7ec',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63b48c521b209',
                        'label' => 'Grids',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'grids',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63b48c6f1b20a',
                        'label' => 'Grid Classes',
                        'name' => 'brxc_grid_builder_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'In the following repeater, you can add/edit/remove your grid classes. Each row requires a class name (without dots), a gap value, a maximum number of columns, and a minimum column width (expressed in pixels). Once saved, the classes will be available inside the Builder. Note that grids are already fully responsive.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'grid-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => 'field_63b48c6f1b20b',
                        'button_label' => 'Add a new grid class',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_63b49e528fc9c',
                                'label' => 'ID',
                                'name' => 'brxc_grid_id',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => 'hidden',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63b48c6f1b20a',
                            ),
                            array(
                                'key' => 'field_63b48c6f1b20b',
                                'label' => 'Class',
                                'name' => 'brxc_grid_class',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '.',
                                'append' => '',
                                'parent_repeater' => 'field_63b48c6f1b20a',
                            ),
                            array(
                                'key' => 'field_63b48d7e1b20e',
                                'label' => 'Gap',
                                'name' => 'brxc_grid_gap',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '2rem',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63b48c6f1b20a',
                            ),
                            array(
                                'key' => 'field_63b48c6f1b20c',
                                'label' => 'Max N° of Cols',
                                'name' => 'brxc_grid_max_col',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'min' => 1,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 1,
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63b48c6f1b20a',
                            ),
                            array(
                                'key' => 'field_63b48c6f1b20d',
                                'label' => 'Min Col Width',
                                'name' => 'brxc_grid_min_width',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '25',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'min' => 0,
                                'max' => '',
                                'placeholder' => '',
                                'step' => 1,
                                'prepend' => '',
                                'append' => 'px',
                                'parent_repeater' => 'field_63b48c6f1b20a',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63b4bd4816ac0',
                        'label' => 'Class Importer',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'class-importer',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63b4bd5c16ac1',
                        'label' => 'Import your Stylesheets',
                        'name' => 'brxc_class_importer_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'In the following repeater, you can add/edit/remove your imported Stylesheets. Each row requires a label and a CSS file attached. The version field is optional. Once saved, the CSS file will be automatically enqueued to your website and all the classes in it will be parsed and added inside the Builder. <strong><br>IMPORTANT: if you delete a row, all the classes will be removed. Any class assigned to any element in Bricks won\'t work anymore. If you need to upgrade a CSS file, just replace the file without deleting the entire row.</strong>',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'class-importer-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => 'field_63b48c6f1b20b',
                        'button_label' => 'Add a new CSS file',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_63b4bd5c16ac2',
                                'label' => 'ID',
                                'name' => 'brxc_class_importer_id',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => 'hidden',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63b4bd5c16ac1',
                            ),
                            array(
                                'key' => 'field_63b4bd5c16ac3',
                                'label' => 'Label',
                                'name' => 'brxc_class_importer_label',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '40',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63b4bd5c16ac1',
                            ),
                            array(
                                'key' => 'field_63b4bd5c16ac4',
                                'label' => 'Version',
                                'name' => 'brxc_class_importer_version',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 0,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '20',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '1.0.0',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63b4bd5c16ac1',
                            ),
                            array(
                                'key' => 'field_6f5o9q1d14dd1',
                                'label' => 'Enqueue in',
                                'name' => 'brxc_class_importer_position',
                                'aria-label' => '',
                                'type' => 'select',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '20',
                                    'class' => 'frontend-theme-select',
                                    'id' => '',
                                ),
                                'choices' => array(
                                    'head' => 'Head',
                                    'footer' => 'Footer',
                                ),
                                'default_value' => 'head',
                                'return_format' => 'value',
                                'multiple' => 0,
                                'allow_null' => 0,
                                'ui' => 0,
                                'ajax' => 0,
                                'placeholder' => '',
                            ),
                            array(
                                'key' => 'field_6f8v4s1x4a5ff',
                                'label' => 'Priority',
                                'name' => 'brxc_class_importer_priority',
                                'aria-label' => '',
                                'type' => 'number',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '20',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => 10,
                                'min' => '',
                                'max' => '',
                                'placeholder' => '',
                                'step' => 1,
                                'prepend' => '',
                                'append' => '',
                            ),
                            array(
                                'key' => 'field_63b4bdf216ac7',
                                'label' => 'CSS file',
                                'name' => 'brxc_class_importer_file',
                                'aria-label' => '',
                                'type' => 'file',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '100',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'url',
                                'library' => 'all',
                                'min_size' => '',
                                'max_size' => '',
                                'mime_types' => 'css',
                                'parent_repeater' => 'field_63b4bd5c16ac1',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63d8cb54c801e',
                        'label' => 'Resources',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'resources',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63d8cb65c801f',
                        'label' => 'Resources',
                        'name' => 'brxc_resources_repeater',
                        'aria-label' => '',
                        'type' => 'repeater',
                        'instructions' => 'In the following repeater, you can add/edit/remove the images added inside the Resources Panel. Each row requires a category label and an image gallery. Once saved, the gallery will be accessible inside the Resource Panel, on the right side of the Builder toolbar.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'class-importer-repeater',
                            'id' => '',
                        ),
                        'layout' => 'block',
                        'pagination' => 0,
                        'min' => 0,
                        'max' => 0,
                        'collapsed' => '',
                        'button_label' => 'Add Row',
                        'rows_per_page' => 20,
                        'sub_fields' => array(
                            array(
                                'key' => 'field_63d8cbb7c8020',
                                'label' => 'Category',
                                'name' => 'brxc_resources_category',
                                'aria-label' => '',
                                'type' => 'text',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'default_value' => '',
                                'maxlength' => '',
                                'placeholder' => '',
                                'prepend' => '',
                                'append' => '',
                                'parent_repeater' => 'field_63d8cb65c801f',
                            ),
                            array(
                                'key' => 'field_63d8cbd8c8021',
                                'label' => 'Gallery',
                                'name' => 'brxc_resources_gallery',
                                'aria-label' => '',
                                'type' => 'gallery',
                                'instructions' => '',
                                'required' => 1,
                                'conditional_logic' => 0,
                                'wrapper' => array(
                                    'width' => '',
                                    'class' => '',
                                    'id' => '',
                                ),
                                'return_format' => 'array',
                                'library' => 'all',
                                'min' => 1,
                                'max' => '',
                                'min_width' => '',
                                'min_height' => '',
                                'min_size' => '',
                                'max_width' => '',
                                'max_height' => '',
                                'max_size' => '',
                                'mime_types' => '',
                                'insert' => 'append',
                                'preview_size' => 'medium',
                                'parent_repeater' => 'field_63d8cb65c801f',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_63eb7ad55853d',
                        'label' => 'Builder Tweaks',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_645s9g7tddfj2',
                                    'operator' => '==',
                                    'value' => 'builder-tweaks',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63eb7f90b87a2',
                        'label' => 'Global Features',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_641af47fbf980',
                        'label' => 'Enable Global Features',
                        'name' => 'brxc_enable_global_features',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Enable the following features inside the Bricks Builder. Once activated, a dedicated icon will be shown inside the Bricks Builder Toolbar.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-3-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'Grid Guide' => 'Grid Guide',
                            'X-Mode' => 'X-Mode',
                            'Contrast Checker' => 'Contrast Checker',
                            'Darkmode' => 'Darkmode',
                            'Advanced CSS' => 'Advanced CSS',
                            'Resources' => 'Resources',
                            'Global AI Panel' => 'Global AI Panel',
                        ),
                        'default_value' => array(
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_63ebb3684a5fe',
                        'label' => 'Grid Columns',
                        'name' => 'brxc_enable_grid_guide_col',
                        'aria-label' => '',
                        'type' => 'number',
                        'instructions' => 'Specify the number of columns for the Grid Guide feature. Default: 12.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_641af47fbf980',
                                    'operator' => '==',
                                    'value' => 'Grid Guide',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 12,
                        'min' => '',
                        'max' => '',
                        'placeholder' => '',
                        'step' => 1,
                        'prepend' => '',
                        'append' => 'col',
                    ),
                    array(
                        'key' => 'field_63ebb3b64a5ff',
                        'label' => 'Grid Gap',
                        'name' => 'brxc_enable_grid_guide_gap',
                        'aria-label' => '',
                        'type' => 'number',
                        'instructions' => 'Specify the gap between the columns for the Grid Guide feature. Default: 20px.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_641af47fbf980',
                                    'operator' => '==',
                                    'value' => 'Grid Guide',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 20,
                        'min' => '',
                        'max' => '',
                        'placeholder' => '',
                        'step' => 1,
                        'prepend' => '',
                        'append' => 'px',
                    ),
                    array(
                        'key' => 'field_64018efb660fb',
                        'label' => 'OpenAI API KEY',
                        'name' => 'brxc_ai_api_key',
                        'aria-label' => '',
                        'type' => 'password',
                        'instructions' => 'Insert here your OpenAI API key that you can find in your <a href="https://platform.openai.com/account/api-keys" target="_blank">OpenAI account</a>. The key will be stored in your database using a 128-bit AES encryption method.',
                        'required' => 1,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_641af47fbf980',
                                    'operator' => '==',
                                    'value' => 'Global AI Panel',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63eb81afb87a5',
                        'label' => 'Classes & Styles',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_64074j8de4756',
                        'label' => 'Builder Tweaks for Classes and Styles',
                        'name' => 'brxc_builder_tweaks_for_classes',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Enable/Disable any of the following builder tweaks related to classes and styles. <a href="https://advancedthemer.com/category/styles-classes/" target="_blank">Learn more about the builder tweaks for classes & styles</a>',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-2-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'extend-classes' => '<span>Extend Global Classes and Styles. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="This feature will consent you to extend the classes & styles from an element to his parents/children"></a></span>',
                            'find-and-replace' => '<span>Enable Find & Replace Styles. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="This feature will consent you to replace any style value assigned to any element inside the builder."></a></span>',
                            'reorder-classes' => '<span>Reorder the global classes alphabetically. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="Check this option if you want your global classes reordered alphabetically inside the Builder."></a></span>',
                            'disable-id-styles' => '<span>Disable Styles on element ID level. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="Check this option if you want to disable the ability to style your elements on an ID level. In order to style your elements, you\'ll be forced to create a class and apply the styles on it."></a></span>',
                            'variable-picker' => '<span>CSS Variables Picker. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, you\'ll see a new icon popping up on the relevant style fields inside the Bricks builder. When clicked on it, the script will open a modal where you can pick the CSS variable of your choice."></a></span>',
                            'autocomplete-variable' => '<span>Autocomplete for CSS Variables. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, a bottom popup will show up at the bottom of each field when typing with the list of all the matching CSS variables."></a></span>',
                            'plain-classes' => '<span>Plain Classes. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, a new icon will show up next to the element\'s class field. When you click on it, a popup window will appear where you can type the classes you want to add/remove in bulk."></a></span>',
                            'export-styles-to-class' => '<span>Copy ID Styles to Classes. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, a new export icon will show up next to the element\'s class field. When you\'ll click on it, you\'ll be able to insert a class name and export all your ID styles to it."></a></span>',
                            'highlight-classes' => '<span>Highlight Classes when Selected. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, a blue outline will appear on all the elements that share the same class when you select it inside the builder. It\'s a great way to localize where your classes are applied."></a></span>',
                            'count-classes' => '<span>Count Classes and navigation when Selected. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, a new counter will show up next to the class name that indicates the number of times the class is used on the page. Clicking on the counter will scroll the page to each element that is using the active class."></a></span>',
                            'color-preview' => '<span>Color Preview on hover. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked and the color grid of any element is open, hovering on each color will temporarily apply the color to the element. This is a great way to preview your colors inside the builder."></a></span>',
                            'class-preview' => '<span>Class Preview on hover. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked and the class dropdown of any element is open, hovering on each class will temporarily apply the class to the element. This is a great way to preview the impact of a class to your elements inside the builder."></a></span>',

                        ),
                        'default_value' => array(
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),         
                    // array(
                    //     'key' => 'field_6420ab1ef98de',
                    //     'label' => 'Enable Extend Global Classes and Styles',
                    //     'name' => 'brxc_enable_extend',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'Check this option if you want to add the "Extend Global Classes & Styles" function inside the builder. This feature will consent you to extend the classes & styles from an element to his parents/children.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_6420ab96f98df',
                    //     'label' => 'Enable Find & Replace Styles',
                    //     'name' => 'brxc_enable_find_and_replace',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'Check this option if you want to add the "Find & Replace" function inside the builder. This feature will consent you to replace any style value assigned to any element inside the builder.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_63ccf551e8daf',
                    //     'label' => 'Reorder the global classes alphabetically',
                    //     'name' => 'brxc_reorder_global_classes',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'Check this option if you want your global classes reordered alphabetically inside the Builder.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_63dcae7fa2a09',
                    //     'label' => 'Disable Styles on element ID level',
                    //     'name' => 'brxc_disable_id_styles',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'Check this option if you want to disable the ability to style your elements on an ID level. In order to style your elements, you\'ll be forced to create a class and apply the styles on it.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_63d7deef7c81b',
                    //     'label' => 'Enable CSS Variables Picker',
                    //     'name' => 'brxc_enable_css_variables_picker',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, you\'ll see a new icon popping up on the relevant style fields inside the Bricks builder. When clicked on it, the script will open a modal where you can pick the CSS variable of your choice.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_640828e6750d4',
                    //     'label' => 'Enable autocomplete for CSS Variables',
                    //     'name' => 'brxc_enable_css_variables_autocomplete',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, a bottom popup will show up at the bottom of each field when typing with the list of all the matching CSS variables.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_63eb7fe0b87a3',
                    //     'label' => 'Enable Plain Classes',
                    //     'name' => 'brxc_enable_plain_classes',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, a new icon will show up next to the element\'s class field. When you click on it, a popup window will appear where you can type the classes you want to add/remove in bulk.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_6421a7cc80961',
                    //     'label' => 'Enable Copy ID Styles to Classes',
                    //     'name' => 'brxc_enable_copy_id_styles_to_classes',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, a new export icon will show up next to the element\'s class field. When you\'ll click on it, you\'ll be able to insert a class name and export all your ID styles to it.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_64227b4087f50',
                    //     'label' => 'Enable Highlight Classes when Selected',
                    //     'name' => 'brxc_enable_highlight_classes',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, a blue outline will appear on all the elements that share the same class when you select it inside the builder. It\'s a great way to localize where your classes are applied.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_64227c1e87f51',
                    //     'label' => 'Enable Count Classes and navigation when Selected',
                    //     'name' => 'brxc_enable_count_classes',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, a new counter will show up next to the class name that indicates the number of times the class is used on the page. Clicking on the counter will scroll the page to each element that is using the active class.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_63eb829eb87ad',
                    //     'label' => 'Enable Color Preview on hover',
                    //     'name' => 'brxc_enable_color_preview_on_hover',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked and the color grid of any element is open, hovering on each color will temporarily apply the color to the element. This is a great way to preview your colors inside the builder.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_63eb8433a22d0',
                    //     'label' => 'Enable Class Preview on hover',
                    //     'name' => 'brxc_enable_class_preview_on_hover',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked and the class dropdown of any element is open, hovering on each class will temporarily apply the class to the element. This is a great way to preview the impact of a class to your elements inside the builder.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    array(
                        'key' => 'field_63eb7f7db87a1',
                        'label' => 'Elements',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_64074ge58dfj2',
                        'label' => 'Builder Tweaks for the Elements',
                        'name' => 'brxc_builder_tweaks_for_elements',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Enable/Disable any of the following builder tweaks related to the elements. <a href="https://advancedthemer.com/category/builder-tweaks/" target="_blank">Learn more about the general builder tweaks</a>',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-2-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'tabs-shortcuts' => '<span>Enable Tabs Shortcuts. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="Check this option to enable the left-panel shorcuts to quickly access to your style groups."></a></span>',
                            'pseudo-shortcut' => '<span>Activate the Pseudo-Element Shortcuts. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, new icon shortcuts will display next to the Condtions and Interactions icons."></a></span>',
                            'parent-shortcut' => '<span>Enable Go to Parent Shortcut. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, you\'ll see a new icon popping up on the left panel of each element. Clicking on this icon will activate the parent element."></a></span>',
                            'lorem-ipsum' => '<span>Enable Lorem Ipsum Generator. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, you\'ll see a new icon popping up on the relevant text/textarea fields inside the Bricks builder. When clicked on it, the script will automatically generate dummy content for that specific field."></a></span>',
                            'diable-pin-on-elements' => '<span>Disable the PIN Icon on the elements list. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, you\'ll see a new icon popping up on the left panel of each element. Clicking on this icon will activate the parent element."></a></span>',
                            'close-accordion-tabs' => '<span>Close all open tabs when clicking the Style Panel. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, all the tabs of the Style panel will be closed by default. This allows you to avoid closing the layout tab continuously when styling an element."></a></span>',
                            'disable-borders-boxshadows' => '<span>Disable element\'s outline when styling Borders and Box-shadow. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, the green outline that surrounds the active element will be removed to consent you to easily style both borders and box-shadows."></a></span>',
                            'resize-elements-icons' => '<span>Resize Icons inside the global elements list panel. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="When this option is checked, you\'ll see 3 new icons on the top-right of the global elements panel that will consent you to control the grid\'s column number."></a></span>',
                        ),
                        'default_value' => array(
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),  
                    array(
                        'key' => 'field_6426786feb84a',
                        'label' => 'Tabs Shortcuts',
                        'name' => 'brxc_enable_shortcuts_tabs',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Select the shortcut icons you want to display inside each element panel. This will create an icon for each Content/Style Tab in order to quickly access the accordion tab when styling an element inside the Builder',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_64074ge58dfj2',
                                    'operator' => '==',
                                    'value' => 'tabs-shortcuts',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-3-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'content' => 'content',
                            'layout' => 'layout',
                            'typography' => 'typography',
                            'background' => 'background',
                            'borders' => 'borders',
                            'gradient' => 'gradient',
                            'transform' => 'transform',
                            'css' => 'css',
                            'attributes' => 'attributes',
                        ),
                        'default_value' => array(
                        ),
                        'return_format' => '',
                        'allow_custom' => 0,
                        'layout' => '',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_6420a42b78413',
                        'label' => 'Pseudo Elements Shortcuts',
                        'name' => 'brxc_enable_shortcuts_icons',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Select the shortcut icons you want to display inside each element panel. This will create an icon for each status in order to quickly activate/deactivate your pseudo-classes when styling an element inside the Builder',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_64074ge58dfj2',
                                    'operator' => '==',
                                    'value' => 'pseudo-shortcut',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-3-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'hover' => 'hover',
                            'before' => 'before',
                            'after' => 'after',
                            'active' => 'active',
                            'focus' => 'focus',
                        ),
                        'default_value' => array(
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),       
                    // array(
                    //     'key' => 'field_642ae48042981',
                    //     'label' => 'Enable Go to Parent Shortcut',
                    //     'name' => 'brxc_enable_go_to_parent',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, you\'ll see a new icon popping up on the left panel of each element. Clicking on this icon will activate the parent element.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_63d7d82587108',
                    //     'label' => 'Enable Lorem Ipsum Generator',
                    //     'name' => 'brxc_enable_lorem_ipsum_generator',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, you\'ll see a new icon popping up on the relevant text/textarea fields inside the Bricks builder. When clicked on it, the script will automatically generate dummy content for that specific field.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    array(
                        'key' => 'field_63d651ddc5a6f',
                        'label' => 'Type of dummy content',
                        'name' => 'brxc_lorem_type',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => 'Choose between the classic Latin Lorem Ipsus text or the human-readable Website Ipsum created by <a href="https://websiteipsum.com/" target="_blank">Kyle Van Deusen</a>',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_64074ge58dfj2',
                                    'operator' => '==',
                                    'value' => 'lorem-ipsum',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'lorem' => 'Lorem Ipsum',
                            'human' => 'Human Readable Content',
                        ),
                        'default_value' => 'lorem',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_63dd6b8k2la6f',
                        'label' => 'Default Elements List Columns ',
                        'name' => 'brxc_elements_default_cols',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => 'Set the default number of columns of the elements list panel when the page is loaded.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_64074ge58dfj2',
                                    'operator' => '==',
                                    'value' => 'resize-elements-icons',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            '2' => '2 columns',
                            '3' => '3 columns',
                            '4' => '4 columns',
                        ),
                        'default_value' => '2-col',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    // array(
                    //     'key' => 'field_64071a94d140d',
                    //     'label' => 'Disable the PIN Icon on the elements list',
                    //     'name' => 'brxc_disable_pin_icon',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, the pin icon is hidden when you hover on any element tab inside the elements list.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_64089716ae2bb',
                    //     'label' => 'Close all open tabs when clicking the Style Panel',
                    //     'name' => 'brxc_close_open_tabs_style_panel',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, all the tabs of the Style panel will be closed by default. This allows you to avoid closing the layout tab continuously when styling an element.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_6408ae2f0b3da',
                    //     'label' => 'Disable the outline border of the active element when styling Borders and Box-shadow',
                    //     'name' => 'brxc_disable_outline_for_borders_and_boxshadow',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, the green outline that surrounds the active element will be removed to consent you to easily style both borders and box-shadows.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    // array(
                    //     'key' => 'field_641b063717211',
                    //     'label' => 'Enable the Resize Icons inside the global elements list panel',
                    //     'name' => 'brxc_resize_elements_list',
                    //     'aria-label' => '',
                    //     'type' => 'true_false',
                    //     'instructions' => 'When this option is checked, you\'ll see 3 new icons on the top-right of the global elements panel that will consent you to control the grid\'s column number.',
                    //     'required' => 0,
                    //     'conditional_logic' => 0,
                    //     'wrapper' => array(
                    //         'width' => '',
                    //         'class' => '',
                    //         'id' => '',
                    //     ),
                    //     'message' => '',
                    //     'default_value' => 0,
                    //     'ui_on_text' => '',
                    //     'ui_off_text' => '',
                    //     'ui' => 1,
                    // ),
                    array(
                        'key' => 'field_63eb7f0fb879e',
                        'label' => 'Keyboard Shortcuts',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63dba4f8f5056',
                        'label' => 'Keyboard Shortcut: Enable Grid Guides',
                        'name' => 'brxc_shortcut_grid_guides',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'brxc-shortcode__input',
                            'id' => '',
                        ),
                        'default_value' => 'i',
                        'maxlength' => 1,
                        'placeholder' => '',
                        'prepend' => 'CTRL + CMD +',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63dba4b8f5055',
                        'label' => 'Keyboard Shortcut: Enable X-Mode',
                        'name' => 'brxc_shortcut_xmode',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'brxc-shortcode__input',
                            'id' => '',
                        ),
                        'default_value' => 'j',
                        'maxlength' => 1,
                        'placeholder' => '',
                        'prepend' => 'CTRL + CMD +',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63dba510f5057',
                        'label' => 'Keyboard Shortcut: Enable Contrast Checker',
                        'name' => 'brxc_shortcut_contrast_checker',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'brxc-shortcode__input',
                            'id' => '',
                        ),
                        'default_value' => 'k',
                        'maxlength' => 1,
                        'placeholder' => '',
                        'prepend' => 'CTRL + CMD +',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63dba543f5058',
                        'label' => 'Keyboard Shortcut: Enable Darkmode',
                        'name' => 'brxc_shortcut_darkmode',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'brxc-shortcode__input',
                            'id' => '',
                        ),
                        'default_value' => 'z',
                        'maxlength' => 1,
                        'placeholder' => '',
                        'prepend' => 'CTRL + CMD +',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63dba55ff5059',
                        'label' => 'Keyboard Shortcut: Open the Advanced CSS Modal',
                        'name' => 'brxc_shortcut_stylesheet',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'brxc-shortcode__input',
                            'id' => '',
                        ),
                        'default_value' => 'l',
                        'maxlength' => 1,
                        'placeholder' => '',
                        'prepend' => 'CTRL + CMD +',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63dba59df505a',
                        'label' => 'Keyboard Shortcut: Open the Resources Modal',
                        'name' => 'brxc_shortcut_resources',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'brxc-shortcode__input',
                            'id' => '',
                        ),
                        'default_value' => 'x',
                        'maxlength' => 1,
                        'placeholder' => '',
                        'prepend' => 'CTRL + CMD +',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_6418f83d91c38',
                        'label' => 'Keyboard Shortcut: Open the OpenAI Assistant Modal',
                        'name' => 'brxc_shortcut_openai',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'brxc-shortcode__input',
                            'id' => '',
                        ),
                        'default_value' => 'o',
                        'maxlength' => 1,
                        'placeholder' => '',
                        'prepend' => 'CTRL + CMD',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63eb7f3eb879f',
                        'label' => 'Editor Strict View',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    
                    array(
                        'key' => 'field_63df639314dd1',
                        'label' => 'Enable Strict Editor View',
                        'name' => 'brxc_enable_strict_editor_view',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'When enabled for a specific user role, these users won\'t be able to modify any styles on the pages - including drag & drop spacing and advanced settings in the left panel',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_64066003f4140',
                        'label' => 'Change Logo Image in the Builder',
                        'name' => 'brxc_change_logo_img',
                        'aria-label' => '',
                        'type' => 'image',
                        'instructions' => 'Switch the default Bricks logo to yours inside the Editor View.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63df639314dd1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                        'preview_size' => 'medium',
                    ),
                    array(
                        'key' => 'field_640660aee91e4',
                        'label' => 'Change the Accent Color in Editor Mode',
                        'name' => 'brxc_change_accent_color',
                        'aria-label' => '',
                        'type' => 'color_picker',
                        'instructions' => 'Personalize the accent color of the Editor Mode to match your brand\'s color guidelines.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63df639314dd1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '#ffd64f',
                        'enable_opacity' => 0,
                        'return_format' => 'string',
                    ),
                    array(
                        'key' => 'field_64065d4de47ca',
                        'label' => 'Disable Toolbar Icons',
                        'name' => 'brxc_disable_toolbar_icons',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Click on any of the following icons to hide them from the Strict Editor View\'s Toolbar.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63df639314dd1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-3-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'logo' => 'Logo',
                            'help' => 'Help',
                            'pages' => 'Pages',
                            'revisions' => 'Revisions',
                            'settings' => 'Settings',
                            'breakpoints' => 'Breakpoints',
                            'dimensions' => 'Dimensions',
                            'undo-redo' => 'Undo / Redo',
                            'edit' => 'Edit with WordPress',
                            'preview' => 'Preview',
                        ),
                        'default_value' => array(
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),            
                    array(
                        'key' => 'field_63e0ccbf3f5d0',
                        'label' => 'Enable the following elements on Strict Editor View',
                        'name' => 'brxc_enable_strict_editor_view_elements',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'All the following checked elements will be selectable by your clients inside the editor and, thus, partially editable. All the others will be in read-only mode.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63df639314dd1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-3-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'heading' => 'Heading',
                            'text-basic' => 'Text basic',
                            'text' => 'Text',
                            'button' => 'Button',
                            'icon' => 'Icon',
                            'image' => 'Image',
                            'video' => 'Video',
                            'icon-box' => 'Icon box',
                            'social-icons' => 'Social icons',
                            'list' => 'List',
                            'accordion' => 'Accordion',
                            'accordion-nested' => 'Accordion nested',
                            'tabs' => 'Tabs',
                            'tabs-nested' => 'Tabs nested',
                            'animated-typing' => 'Animated typing',
                            'countdown' => 'Countdown',
                            'counter' => 'Counter',
                            'pricing-tables' => 'Pricing tables',
                            'progress-bar' => 'Progress bar',
                            'pie-chart' => 'Pie chart',
                            'team-members' => 'Team members',
                            'testimonials' => 'Testimonials',
                            'logo' => 'Logo',
                            'facebook-page' => 'Facebook page',
                            'image-gallery' => 'Image gallery',
                            'audio' => 'Audio',
                            'carousel' => 'Carousel',
                            'slider' => 'Slider',
                            'slider-nested' => 'Slider nested',
                            'svg' => 'Svg',
                            'nav-menu' => 'Nav menu',
                        ),
                        'default_value' => array(
                        ),
                        'return_format' => 'array',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_6406649640d2d',
                        'label' => 'Reduce Left Panel Visibility',
                        'name' => 'brxc_reduce_left_panel_visibility',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'When this option is checked, the left panel will be hidden most of the time. It will show up when strictly necessary (changing an image or a setting that can\'t be edited from the iframe).',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63df639314dd1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-3-col',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_64073d2b6d6bc',
                        'label' => 'Disable the Header & Footer edit button on hover',
                        'name' => 'brxc_disable_header_footer_hover_btn',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'When this option is enabled, editors won\'t have access to the Header & Footer edit link when hovering over the sections.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63df639314dd1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_640756cf80359',
                        'label' => 'Remove Template & Settings Links',
                        'name' => 'brxc_remove_template_links',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'When this option is enabled, all the links referring to Bricks templates and Settings will be removed for the editors. That include the Bricks Admin menu item and the Toolbar',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_63df639314dd1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-3-col',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_63eb7f62b87a0',
                        'label' => 'End',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 1,
                    ),
                    array(
                        'key' => 'field_63a6a4b47c8b4',
                        'label' => 'Settings',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63eb7f7db87a1',
                        'label' => 'Elements',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63r5h8y1d81cb',
                        'label' => 'Advanced Themer',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_645s9g7tddfj2',
                        'label' => 'Customize the functions included in Advanced Themer',
                        'name' => 'brxc_theme_settings_tabs',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Enable/Disable any of the following settings. Once disabled, the relative function will be completely disabled on both backend and frontend',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'checkbox-2-col',
                            'id' => '',
                        ),
                        'choices' => array(
                            'typography' => 'Typography',
                            'spacing' => 'Spacing',
                            'border-radius' => 'Border-Radius',
                            'custom-variables' => 'Custom Variables',
                            'grids' => '<span>Grids <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="If you unselect this tab, all the grid classes will be removed inside the builder. If you reactivate this option, you will need to reassign your grid classes to each element."></a></span>',
                            'class-importer' => '<span>Class Importer. <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="If you unselect this tab, all the imported classes will be removed inside the builder. If you reactivate this option, you will need to reassign your imported classes to each element."></a></span>',
                            'resources' => 'Resources',
                            'builder-tweaks' => 'Builder Tweaks',
                            'color-palettes' => '<span>Color Palette CPT <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="By disabling this option, all the connected features will be disabled as well - such as gutenberg sync and some custom elements that rely on the CPT."></a></span>',
                            'admin-bar' => '<span>Admin Bar <a href="#" class="dashicons dashicons-info acf-js-tooltip" title="Save the theme settings in order to take effect. Remember that if this option is enabled, you won\'t have access to the Frontend Playground anymore."></a></span>',
                        ),
                        'default_value' => array(
                            'typography',
                            'spacing',
                            'border-radius',
                            'custom-variables',
                            'grids',
                            'class-importer',
                            'resources',
                            'builder-tweaks',
                            'color-palettes',
                            'admin-bar',
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),  
                    array(
                        'key' => 'field_63b3d88ee81cb',
                        'label' => 'Fluid Settings',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63ab121136eb9',
                        'label' => 'Add a prefix to your global CSS variables',
                        'name' => 'brxc_global_prefix',
                        'aria-label' => '',
                        'type' => 'text',
                        'instructions' => 'The prefix will be automatically added to all your CSS variables. Example of variable generated with "p1" as prefix: --p1-gap-1.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'prefix-css',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'maxlength' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                    ),
                    array(
                        'key' => 'field_63a843db56979',
                        'label' => 'Base Font Size',
                        'name' => 'brxc_base_font_size',
                        'aria-label' => '',
                        'type' => 'number',
                        'instructions' => 'Insert the base font-size you are using on the website. This field is required in order to calculate the correct REM values. Change this value if you know what you\'re doing!<br><strong>The default base font-size in Bricks is 10px.</strong>',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'base-font',
                            'id' => '',
                        ),
                        'default_value' => 10,
                        'min' => '',
                        'max' => '',
                        'placeholder' => '',
                        'step' => 1,
                        'prepend' => '',
                        'append' => 'px',
                    ),
                    array(
                        'key' => 'field_63a843f85697a',
                        'label' => 'Minimum Viewport Width',
                        'name' => 'brxc_min_vw',
                        'aria-label' => '',
                        'type' => 'number',
                        'instructions' => 'Set the minimum viewport width where the default min value of the clamp function will apply. Above this value, the fluid formula will run until reaching the maximum viewport width.<br><strong>The default value is set to 360px.</strong>',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'min-viewport',
                            'id' => '',
                        ),
                        'default_value' => 360,
                        'min' => '',
                        'max' => '',
                        'placeholder' => '',
                        'step' => 1,
                        'prepend' => '',
                        'append' => 'px',
                    ),
                    array(
                        'key' => 'field_63a8440d5697b',
                        'label' => 'Maximum Viewport Width',
                        'name' => 'brxc_max_vw',
                        'aria-label' => '',
                        'type' => 'number',
                        'instructions' => 'Set the maximum viewport width where the default max value of the clamp function will apply. Below this value, the fluid formula will run until reaching the minimum viewport width.<br><strong>The default value is set to 1600px.</strong>',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'max-viewport',
                            'id' => '',
                        ),
                        'default_value' => 1600,
                        'min' => '',
                        'max' => '',
                        'placeholder' => '',
                        'step' => 1,
                        'prepend' => '',
                        'append' => 'px',
                    ),
                    array(
                        'key' => 'field_63b3daadf4107',
                        'label' => 'Builder Elements',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63aabb0ccebeb',
                        'label' => 'Enable / Disable Elements',
                        'name' => 'brxc_enable_elements',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Uncheck an element to disable it completely from the whole website.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'darkmode-toggle' => 'Darkmode Toggle',
                            'darkmode-button' => 'Darkmode Button',
                            'color-swatch' => 'Color Swatch',
                            'preset-swatch' => 'Preset Swatch',
                            'theme-editor' => 'Theme Editor',
                            'style-guide' => 'Style Guide',
                        ),
                        'default_value' => array(
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 1,
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_63c922908dff1',
                        'label' => 'Permissions',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_6388e73289b6a',
                        'label' => 'User Roles Permissions',
                        'name' => 'brxc_user_role_permissions',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Select which roles should have access to your theme settings and color palettes.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => '',
                        'allow_custom' => 0,
                        'layout' => '',
                        'toggle' => 0,
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_63b3dad502a80',
                        'label' => 'Frontend Playground',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_638380c42dac1',
                        'label' => 'Enable Frontend Playground',
                        'name' => 'brxc_enable_gui_on_frontend',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'Disable this option to deactivate the frontend Playground on the whole site for all users',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_6399a2840185c',
                        'label' => 'Frontend Playground Theme',
                        'name' => 'brxc_frontend_gui_theme',
                        'aria-label' => '',
                        'type' => 'select',
                        'instructions' => 'Choose the Theme of the Frontend Playground',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_638380c42dac1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => 'frontend-theme-select',
                            'id' => '',
                        ),
                        'choices' => array(
                            'dark' => 'Dark Theme',
                            'light' => 'Light Theme',
                        ),
                        'default_value' => 'dark',
                        'return_format' => 'value',
                        'multiple' => 0,
                        'allow_null' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_63899284664e9',
                        'label' => 'Custom Post Types Permissions',
                        'name' => 'brxc_post_types_permissions',
                        'aria-label' => '',
                        'type' => 'checkbox',
                        'instructions' => 'Enable the Frontend Playground on specific custom post types.',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_638380c42dac1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'value',
                        'allow_custom' => 0,
                        'layout' => 'vertical',
                        'toggle' => 0,
                        'save_custom' => 0,
                    ),
                    array(
                        'key' => 'field_63b3dc809484c',
                        'label' => 'Gutenberg Settings',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63b3dc8b9484d',
                        'label' => 'Replace Gutenberg Color Palettes',
                        'name' => 'brxc_enable_gutenberg_sync',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'When this option is checked, your bricks color palettes and the Gutenberg color palettes will be synched together. Uncheck this option if you don\'t plan to use your custom color palettes with Gutenberg.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_63b3ddc49484f',
                        'label' => 'Remove Default Gutenberg Presets',
                        'name' => 'brxc_remove_default_gutenberg_presets',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'When this option is checked, the default Gutenberg presets CSS variables (like --wp--preset--color--black) won\'t be loaded on the frontend anymore.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_63b3daf302a81',
                        'label' => 'Misc',
                        'name' => '',
                        'aria-label' => '',
                        'type' => 'accordion',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'open' => 1,
                        'multi_expand' => 1,
                        'endpoint' => 0,
                    ),
                    array(
                        'key' => 'field_63a8765e6ceed',
                        'label' => 'Disable the "ACF" menu item in your Dashboard',
                        'name' => 'brxc_disable_acf_menu_item',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'If for some reason you prefer to hide the ACF menu item from your Dashboard, check this toggle. Note that if you have ACF PRO installed, this option will be ignored and the ACF menu will be visible.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 1,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                    array(
                        'key' => 'field_63ab55f50e545',
                        'label' => 'Remove all data when uninstalling the plugin',
                        'name' => 'brxc_remove_data_uninstall',
                        'aria-label' => '',
                        'type' => 'true_false',
                        'instructions' => 'Check this toggle if you want to erase all the data from your database when uninstalling the plugin. This includes all your theme options, your color palettes, and your license.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                        'ui' => 1,
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'bricks-advanced-themer',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => true,
                'description' => '',
                'show_in_rest' => 0,
            ));
            
            endif;			
    }

}