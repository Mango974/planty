<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Admin{

    public static function add_admin_bar_menu( $admin_bar ) {

        global $brxc_acf_fields;

        if (!AT__Helpers::return_user_role_check() === true  ||  !isset($brxc_acf_fields['theme_settings_tabs']) || empty($brxc_acf_fields['theme_settings_tabs']) || !is_array($brxc_acf_fields['theme_settings_tabs']) || !in_array('admin-bar', $brxc_acf_fields['theme_settings_tabs']) ) {

            return;
        };

        $args = array (
                'id'        => 'brxc-advanced-themer-admin-bar',
                'title'     => 'Advanced Themer',
        );
    
        $admin_bar->add_node( $args );

        $args = array (
            'id'        => 'brxc-color-palettes-admin-bar',
            'title'     => 'Color Palettes',
            'href'      => \site_url() . '/wp-admin/edit.php?post_type=brxc_color_palette',
            'parent'    => 'brxc-advanced-themer-admin-bar'
        );

        $admin_bar->add_node( $args );

        $args = array (
            'id'        => 'brxc-theme-settings-admin-bar',
            'title'     => 'Theme Settings',
            'href'      => \site_url() . '/wp-admin/admin.php?page=bricks-advanced-themer',
            'parent'    => 'brxc-advanced-themer-admin-bar'
        );

        $admin_bar->add_node( $args );

        $args = array (
            'id'        => 'brxc-license-admin-bar',
            'title'     => 'Manage your License',
            'href'      => \site_url() . '/wp-admin/admin.php?page=at-license',
            'parent'    => 'brxc-advanced-themer-admin-bar'
        );

        $admin_bar->add_node( $args );
        
    }

    public static function add_link_to_admin_bar( $admin_bar ) {

        global $brxc_acf_fields;

        if( !AT__Helpers::return_user_role_check() === true || !isset($brxc_acf_fields['theme_settings_tabs']) || empty($brxc_acf_fields['theme_settings_tabs']) || !is_array($brxc_acf_fields['theme_settings_tabs']) || !in_array('admin-bar', $brxc_acf_fields['theme_settings_tabs'])){

            return;
        }

        global $brxc_acf_fields;

        $actual_link = ( isset($_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $url_parts = wp_parse_url($actual_link);

        $query = isset( $url_parts['query'] );
      
        if ( $brxc_acf_fields['enable_frontend_gui'] && !$query && AT__Helpers::return_post_type_check() === true ){

            $new_link = $actual_link . '?brxcthemer=on';

            $args = array(
                'id'    => 'enable-bricks-advanced-themer-link',
                'title' => 'Enable the Frontend Playground', 
                'href'  => $new_link,
                'parent'    => 'brxc-advanced-themer-admin-bar'
            );
        
            $admin_bar->add_node($args);
      
        } elseif ( $brxc_acf_fields['enable_frontend_gui'] && $query && AT__Helpers::check_url_query_for_themer() === true ){

            $constructed_url = $url_parts['scheme'] . '://' . $url_parts['host'] . (isset($url_parts['path'])?$url_parts['path']:'');
        
            $args = array(
                'id'    => 'exit-bricks-advanced-themer-link',
                'title' => 'Exit the Frontend Playground', 
                'href'  => $constructed_url,
                'parent'    => 'brxc-advanced-themer-admin-bar'
            );
        
            $admin_bar->add_node( $args );
      
        } else {

            return;

        }

    }

    public static function color_palette_cpt_init() {

        global $brxc_acf_fields;

        if ( !isset($brxc_acf_fields['theme_settings_tabs']) || empty($brxc_acf_fields['theme_settings_tabs']) || !is_array($brxc_acf_fields['theme_settings_tabs']) || !in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs']) ) {

            return;

        }

        $args = [
            'label'  => esc_html__( 'Color Palettes', 'text-domain' ),
            'labels' => [
                'menu_name'          => esc_html__( 'Color Palettes', 'bricks-advanced-themer' ),
                'name_admin_bar'     => esc_html__( 'Color Palette', 'bricks-advanced-themer' ),
                'add_new'            => esc_html__( 'Add Color Palette', 'bricks-advanced-themer' ),
                'add_new_item'       => esc_html__( 'Add new Color Palette', 'bricks-advanced-themer' ),
                'new_item'           => esc_html__( 'New Color Palette', 'bricks-advanced-themer' ),
                'edit_item'          => esc_html__( 'Edit Color Palette', 'bricks-advanced-themer' ),
                'view_item'          => esc_html__( 'View Color Palette', 'bricks-advanced-themer' ),
                'update_item'        => esc_html__( 'View Color Palette', 'bricks-advanced-themer' ),
                'all_items'          => esc_html__( 'AT - Color Palettes', 'bricks-advanced-themer' ),
                'search_items'       => esc_html__( 'Search Color Palettes', 'bricks-advanced-themer' ),
                'parent_item_colon'  => esc_html__( 'Parent Color Palette', 'bricks-advanced-themer' ),
                'not_found'          => esc_html__( 'No Color Palettes found', 'bricks-advanced-themer' ),
                'not_found_in_trash' => esc_html__( 'No Color Palettes found in Trash', 'bricks-advanced-themer' ),
                'name'               => esc_html__( 'Color Palettes', 'bricks-advanced-themer' ),
                'singular_name'      => esc_html__( 'Color Palette', 'bricks-advanced-themer' ),
            ],
            'public'              => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => false,
            'show_ui'             => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => false,
            'show_in_rest'        => false,
            'capability_type'     => 'post',
            'hierarchical'        => false,
            'has_archive'         => false,
            'query_var'           => false,
            'can_export'          => true,
            'rewrite_no_front'    => false,
            'menu_icon'           => 'dashicons-art',
            'show_in_menu'        => 'bricks',
            'menu_position'       => 9,
            'supports'            => array( 'title', 'revisions'),
            'rewrite' => true
        ];

        if (!AT__Helpers::return_user_role_check() === true){

            unset($args['show_in_menu']);
            $args['show_in_nav_menus'] = false;
            $args['show_ui'] = false;

        }
    
        register_post_type( 'brxc_color_palette', $args );

    }


    public static function reorder_bricks_menu( $menu_order ) {

        global $brxc_acf_fields;
        
        if ( !isset($brxc_acf_fields['theme_settings_tabs']) || empty($brxc_acf_fields['theme_settings_tabs']) || !is_array($brxc_acf_fields['theme_settings_tabs']) || !in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs']) ) {

            return;

        }
        
        global $submenu;

        if (!isset($submenu) || empty($submenu) || !is_array($submenu) ) {

            return;
        }

        $bricks_menu = $submenu['bricks'];


        if( !$bricks_menu || !is_array( $bricks_menu ) ) {

            return;

        }
        
        if (!AT__Helpers::return_user_role_check() === true){

            array_pop($bricks_menu);

        }

        $palette = $bricks_menu[0];

        if( !$palette ) {

            return;

        }

        $length = count( $bricks_menu );

        $extra = array_slice( $bricks_menu, 1, $length, true );

        $extra[] = $palette;

        $submenu['bricks'] = $extra;

    }

    public static function remove_templates_from_menu() {

        if (!class_exists('Bricks\Capabilities')) {
            return;
        }

        global $brxc_acf_fields;

        if(!\Bricks\Capabilities::current_user_has_full_access() === true && isset($brxc_acf_fields['remove_template_links']) && !empty($brxc_acf_fields['remove_template_links']) && $brxc_acf_fields['remove_template_links']){

            remove_menu_page( 'bricks' );

        }
    }

    public static function remove_templates_from_toolbar() {

        if (!class_exists('Bricks\Capabilities')) {
            return;
        }

        global $brxc_acf_fields;
        global $wp_admin_bar;

        if(!\Bricks\Capabilities::current_user_has_full_access() === true && isset($brxc_acf_fields['remove_template_links']) && !empty($brxc_acf_fields['remove_template_links']) && $brxc_acf_fields['remove_template_links']){

            $wp_admin_bar->remove_menu('edit_with_bricks_header');
            $wp_admin_bar->remove_menu('edit_with_bricks_footer');
            $wp_admin_bar->remove_menu('bricks_settings');
            $wp_admin_bar->remove_menu('bricks_templates');
            $wp_admin_bar->remove_menu('editor_mode');

        }

    }

    /* ADD THE CUSTOM COLUMN INSIDE THE Before/After image CPT */
    public static function manage_brxc_color_palette_posts_columns_callback($columns) {
        $new = array(
        "cb" => "<input type=\"checkbox\" />",
        );

        foreach( $columns as $key => $title ) {

            if ( $key=='title' ) {

                $new[$key] = $title;

            }

            if ( $key=='date' ) {

                $new['colors'] = 'Colors';

                $new['shades'] = 'Shades';

                $new['darkmode'] = 'Darkmode';

                $new['json'] = 'JSON';

                $new['prefix'] = 'Prefix';

                $new[$key] = $title;

            }

        }

        return $new;

    }

    
    /* POPULATE THE ACF VALUE INSIDE EACH COLUMN */
    public static function colors_custom_column( $column, $post_id ) {

        switch ( $column ) {

            case 'colors':

                echo '<style>.brxc-colors-wrapper{display:flex;flex-wrap:wrap;gap:.3rem;}.brxc-color-div{width:30px;height:30px;border-radius:50%;}</style>';

                echo '<div class="brxc-colors-wrapper">';

                if( have_rows( 'brxc_colors_repeater' ) ) :

                    while( have_rows( 'brxc_colors_repeater' ) ):

                        the_row();

                        $color = get_sub_field( 'brxc_color_hex' );

                        echo (isset($color) && $color) ? '<div class="brxc-color-div" style="background-color: ' . sanitize_hex_color( $color ) . ' "></div>' : '';

                    endwhile;

                endif;

                echo '</div>';

            break;

            case 'shades':

                $shades = get_field('brxc_enable_shapes');

                echo (isset($shades) && $shades) ? 'Enabled' : 'Disabled';

            break;

            case 'darkmode':

                $darkmode = get_field('brxc_enable_dark_mode');

                echo (isset($darkmode) && $darkmode) ? 'Enabled' : 'Disabled';

            break;

            case 'json':

                $json = get_field('brxc_import_from_json');

                echo (isset($json) && $json) ? 'Yes' : 'No';

            break;

            case 'prefix':

                $prefix = get_field('brxc_variable_prefix');

                echo ( isset($prefix) && $prefix ) ? '"' . $prefix . '"' : 'Disabled';

            break;

        }

    }

    // Register Scripts
    public static function register_scripts(){

        wp_register_style( 'bricks-advanced-themer', BRICKS_ADVANCED_THEMER_URL . 'assets/css/bricks-advanced-themer.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/bricks-advanced-themer.css' ) );
        wp_register_style( 'bricks-advanced-themer-builder', BRICKS_ADVANCED_THEMER_URL . 'assets/css/bricks-advanced-themer-builder.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/bricks-advanced-themer-builder.css' ) );
        wp_register_style( 'bricks-advanced-themer-backend', BRICKS_ADVANCED_THEMER_URL . 'assets/css/bricks-advanced-themer-backend.css', [], BRICKS_ADVANCED_THEMER_VERSION );
        wp_enqueue_style( 'bricks-advanced-themer' );
        wp_register_style( 'frontend-gui', BRICKS_ADVANCED_THEMER_URL . 'assets/css/frontend-gui.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/frontend-gui.css' ) );
        wp_register_style( 'frontend-gui-admin', BRICKS_ADVANCED_THEMER_URL . 'assets/css/frontend-gui-admin.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/frontend-gui-admin.css' ) );
        //wp_enqueue_style( 'frontend-gui-admin' );
        wp_register_style( 'brxc-theme-editor', BRICKS_ADVANCED_THEMER_URL . 'assets/css/theme-editor.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/theme-editor.css' ) );
        wp_register_style( 'brxc-color-swatch', BRICKS_ADVANCED_THEMER_URL . 'assets/css/color-swatch.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/color-swatch.css' ) );
        wp_register_style( 'brxc-preset-swatch', BRICKS_ADVANCED_THEMER_URL . 'assets/css/preset-swatch.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/preset-swatch.css' ) );
        wp_register_style( 'brxc-color-palette-style-guide', BRICKS_ADVANCED_THEMER_URL . 'assets/css/color-palette-style-guide.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/color-palette-style-guide.css' ) );
        wp_register_style( 'brxc-darkmode-toggle', BRICKS_ADVANCED_THEMER_URL . 'assets/css/darkmode-toggle.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/darkmode-toggle.css' ) );
        wp_register_style( 'brxc-darkmode-btn', BRICKS_ADVANCED_THEMER_URL . 'assets/css/darkmode-btn.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/darkmode-btn.css' ) );
        wp_register_style( 'monokai', BRICKS_ADVANCED_THEMER_URL . 'assets/css/monokai.min.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/monokai.min.css' ) );
        wp_register_style( 'brxc-builder-new-codemirror', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/lib/codemirror.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/lib/codemirror.css' ) );
        wp_register_style( 'bricks-strict-editor-view', BRICKS_ADVANCED_THEMER_URL . 'assets/css/bricks-strict-editor-view.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/css/bricks-strict-editor-view.css' ) );
        wp_register_script( 'acf-color-cpt', BRICKS_ADVANCED_THEMER_URL . 'assets/js/acf-color-cpt.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/acf-color-cpt.js' ) );
        wp_register_script( 'brxc-builder', BRICKS_ADVANCED_THEMER_URL . 'assets/js/builder.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/builder.js' ) );
        wp_register_script( 'brxc-builder-new-codemirror', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/lib/codemirror.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/lib/codemirror.js' ) );
        wp_register_script( 'brxc-theme-editor', BRICKS_ADVANCED_THEMER_URL . 'assets/js/theme-editor.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/theme-editor.js' ) );
        wp_register_script( 'brxc-color-swatch', BRICKS_ADVANCED_THEMER_URL . 'assets/js/color-swatch.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/color-swatch.js' ) );
        wp_register_script( 'brxc-preset-swatch', BRICKS_ADVANCED_THEMER_URL . 'assets/js/preset-swatch.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/preset-swatch.js' ) );
        wp_register_script( 'brxc-darkmode', BRICKS_ADVANCED_THEMER_URL . 'assets/js/darkmode.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/darkmode.js' ) );
        wp_register_script( 'sortable', BRICKS_ADVANCED_THEMER_URL . 'assets/js/Sortable.min.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/Sortable.min.js' ) );
        wp_register_script( 'contrast', BRICKS_ADVANCED_THEMER_URL . 'assets/js/contrast.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/contrast.js' ) );
        wp_register_script( 'color-scheme', BRICKS_ADVANCED_THEMER_URL . 'assets/js/color-scheme.min.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/color-scheme.min.js' ) );
        wp_register_script( 'chroma', BRICKS_ADVANCED_THEMER_URL . 'assets/js/chroma.min.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/chroma.min.js' ) );
        wp_register_script( 'highlight', BRICKS_ADVANCED_THEMER_URL . 'assets/js/highlight.min.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/highlight.min.js' ) );
        wp_register_script( 'frontend-gui', BRICKS_ADVANCED_THEMER_URL . 'assets/js/frontend-gui.js', ['color-scheme', 'chroma', 'contrast', 'sortable'], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/frontend-gui.js' ) );
        wp_register_script( 'frontend-gui-min', BRICKS_ADVANCED_THEMER_URL . 'assets/js/frontend-gui.min.js', ['color-scheme', 'chroma', 'contrast', 'sortable','highlight'], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/frontend-gui.min.js' ) );
        wp_register_script( 'bricks-strict-editor-view', BRICKS_ADVANCED_THEMER_URL . 'assets/js/bricks-strict-editor-view.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . '/assets/js/bricks-strict-editor-view.js' ) );
    
    }

    public static function admin_enqueue_scripts($hook_suffix){
        wp_enqueue_style( 'bricks-advanced-themer-backend' );

        $cpt = 'brxc_color_palette';

        if( in_array($hook_suffix, array('post.php', 'post-new.php') ) ){
            $screen = get_current_screen();

            if( is_object( $screen ) && $cpt == $screen->post_type ){

                wp_enqueue_script( 'acf-color-cpt' );

            }
        }
        
    }
    public static function enqueue_builder_scripts() {

        if (!class_exists('Bricks\Capabilities')) {
            
            return;
        }

        global $brxc_acf_fields;

        if( !bricks_is_builder() ) return;

        if( class_exists('Bricks\Capabilities') && !\Bricks\Capabilities::current_user_has_full_access() === true && $brxc_acf_fields['strict_editor_view']) {
            wp_enqueue_style( 'bricks-strict-editor-view' );
            $index = 0;
            $custom_css = '';
            foreach ( $brxc_acf_fields['strict_editor_view_elements'] as $element ){
                if($index === 0){
                    $custom_css .= '.brx-draggable.bricks-draggable-handle .brxe-' . $element['value'];
                    $index++;
                } else {
                    $custom_css .= ',.brx-draggable.bricks-draggable-handle .brxe-' . $element['value'];
                    $index++;
                }
            }
            $custom_css .= '{pointer-events: auto;}[class*=brxe-].builder-active-element:not(';
            $index = 0;
            foreach ( $brxc_acf_fields['strict_editor_view_elements'] as $element ){
                if($index === 0){
                    $custom_css .= '.brxe-' . $element['value'];
                    $index++;
                } else {
                    $custom_css .= ',.brxe-' . $element['value'];
                    $index++;
                }

            }
            $custom_css .= '){outline: 0 !important;outline-offset: 0 !important;}';

            if(isset($brxc_acf_fields['change_accent_color']) && !empty($brxc_acf_fields['change_accent_color']) && ($brxc_acf_fields['change_accent_color'])){
                $custom_css .= 'html body{--builder-color-accent:';
                $custom_css .= $brxc_acf_fields['change_accent_color'];
                $custom_css .= '}#bricks-toolbar .logo{background-color:';
                $custom_css .= $brxc_acf_fields['change_accent_color'];
                $custom_css .= '}';
            }
            if(isset($brxc_acf_fields['disable_toolbar_icons']) && !empty($brxc_acf_fields['disable_toolbar_icons']) && ($brxc_acf_fields['disable_toolbar_icons']) && is_array($brxc_acf_fields['disable_toolbar_icons'])){
                $toolbar_items = [
                    ['logo','#bricks-toolbar li.logo'],
                    ['help','#bricks-toolbar li.docs'],
                    ['pages','#bricks-toolbar li.pages'],
                    ['revisions','#bricks-toolbar li.history'],
                    ['settings','#bricks-toolbar li.settings'],
                    ['breakpoints','#bricks-toolbar li.breakpoint '],
                    ['dimensions','#bricks-toolbar li.preview-dimension'],
                    ['undo-redo','#bricks-toolbar li.undo, #bricks-toolbar li.redo'],
                    ['edit','#bricks-toolbar li[data-balloon="Edit in WordPress"]'],
                    ['preview','#bricks-toolbar li.preview']
                ];
                $temp_css = [];
                foreach ($toolbar_items as $item){

                    if(in_array($item[0], $brxc_acf_fields['disable_toolbar_icons'])){
                        $temp_css[] = $item[1];
                    }
                }

                $custom_css .= implode(",", $temp_css) . '{display: none !important;}';

            }
            if(isset($brxc_acf_fields['reduce_left_panel_visibility']) && !empty($brxc_acf_fields['reduce_left_panel_visibility']) && ($brxc_acf_fields['reduce_left_panel_visibility'])){
                $visible_items = [
                    '#bricks-panel:has(.control.control-image)',
                ];
                $temp_css = [];

                foreach($visible_items as $item){
                    $temp_css[] = $item;
                }
                $custom_css .= '#bricks-panel{width:0!important;}';
                $custom_css .= implode(",", $temp_css) . '{width: 400px !important;}';
            }
            
            if(isset($brxc_acf_fields['disable_header_footer_hover_btn']) && !empty($brxc_acf_fields['disable_header_footer_hover_btn']) && ($brxc_acf_fields['disable_header_footer_hover_btn'])){
                $custom_css .= 'body #brx-header.builder-active-element,body #brx-footer.builder-active-element{outline:0!important}body #brx-header .bricks-area-label,body #brx-footer .bricks-area-label{display:none!important;}';
            }
            
            wp_add_inline_style('bricks-strict-editor-view', $custom_css, 'after');
            wp_enqueue_script( 'bricks-strict-editor-view' );
            if($toolbar_img = get_field('field_64066003f4140', 'bricks-advanced-themer' )){
                wp_add_inline_script('bricks-builder', 'window.addEventListener("DOMContentLoaded", () => {
                    const toolbarLogo = document.querySelector("#bricks-toolbar .logo img");
                    if(!toolbarLogo) return
                    toolbarLogo.src = "' . $toolbar_img['url'] . '";
                })', 'after');
            }


            return;
        }
        

        wp_enqueue_script( 'contrast' );
        wp_enqueue_style( 'bricks-advanced-themer-builder' );
        $custom_css = '';
        if(isset($brxc_acf_fields['disable_pin_icon']) && !empty($brxc_acf_fields['disable_pin_icon']) && ($brxc_acf_fields['disable_pin_icon'])){
            $custom_css .= 'body .bricks-panel #bricks-panel-elements .bricks-panel-actions-icon{display: none !important;}';
        }
        wp_add_inline_style('bricks-advanced-themer-builder', $custom_css, 'after');

        if( bricks_is_builder_iframe() ) return;
        wp_enqueue_script('brxc-builder');
        wp_enqueue_script( 'brxc-builder-new-codemirror');
        wp_enqueue_script( 'brxc-builder-new-codemirror-mode-css', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/mode/css/css.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/mode/css/css.js' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-dialog', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/dialog/dialog.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/dialog/dialog.js' ) );
        wp_enqueue_style( 'brxc-builder-new-codemirror-addon-dialog', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/dialog/dialog.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/dialog/dialog.css' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-placeholder', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/display/placeholder.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/display/placeholder.js' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-closeBrackets', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/edit/closebrackets.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/edit/closebrackets.js' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-matchBrackets', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/edit/matchbrackets.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/edit/matchbrackets.js' ) );
        wp_enqueue_style( 'brxc-builder-new-codemirror-addon-hint', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/hint/show-hint.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/hint/show-hint.css' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-hint', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/hint/show-hint.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/hint/show-hint.js' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-css-hint', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/hint/css-hint.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/hint/css-hint.js' ) );
        wp_enqueue_script( 'brxc-builder-csslint', 'https://unpkg.com/csslint@1.0.5/dist/csslint.js', [], '1.0.5');
        wp_enqueue_style( 'brxc-builder-new-codemirror-addon-lint', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/lint/lint.css', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/lint/lint.css' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-lint', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/lint/lint.js', ['brxc-builder-csslint'], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/lint/lint.js' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-css-lint', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/lint/css-lint.js', ['brxc-builder-new-codemirror-addon-lint'], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/lint/css-lint.js' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-search', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/search/search.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/search/search.js' ) );
        wp_enqueue_script( 'brxc-builder-new-codemirror-addon-searchcursor', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/search/searchcursor.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/search/searchcursor.js' ) );
        //wp_enqueue_script( 'brxc-builder-new-codemirror-addon-matchHighlighter', BRICKS_ADVANCED_THEMER_URL . 'assets/js/codemirror/addon/search/match-highlighter.js', [], filemtime( BRICKS_ADVANCED_THEMER_PATH . 'assets/js/codemirror/addon/search/match-highlighter.js' ) );

        wp_localize_script( 'brxc-builder', 'openai_ajax_req', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'openai_ajax_nonce' ) ) );
    }

    // Enqueue Scripts in footer
    public static function enqueue_scripts_in_footer() {

        global $brxc_acf_fields;

        if ( !$brxc_acf_fields['enable_frontend_gui'] || AT__Helpers::check_url_query_for_themer() !== true || AT__Helpers::return_user_role_check() !== true ){

            return;

        }

        wp_enqueue_style( 'frontend-gui' );
        wp_enqueue_style( 'monokai' );
        wp_enqueue_script( 'contrast' );
        wp_enqueue_script( 'color-scheme' );
        wp_enqueue_script( 'chroma' );
        wp_enqueue_script( 'highlight' );
        wp_enqueue_script( 'frontend-gui' );
        //wp_enqueue_script( 'frontend-gui-min' );
        wp_enqueue_script( 'bricks-isotope' );


    }

    // Enqueue Scripts in footer
    public static function enqueue_scripts_in_color_cpt_admin() {

    }

    public static function uninstall_method() {

        global $brxc_acf_fields;

        $remove_data = $brxc_acf_fields['remove_data'];

        if ( isset($remove_data) && $remove_data ){

            global $wpdb;

            $all_post_ids = get_posts(array(
                'fields'          => 'ids',
                'posts_per_page'  => -1,
                'post_type' => 'brxc_color_palette'
            ));

            foreach($all_post_ids as $id){

                $wpdb->query("DELETE FROM $wpdb->postmeta WHERE post_id = $id");

            }

            $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '%bricks-advanced-themer_brxc%'");

        }

    }

}