<?php

if (!defined('ABSPATH')) { die();
}

$prefix = $brxc_acf_fields['global_prefix'];
$typography = [];
$spacing = [];
$border = [];
$misc = [];

// Typography

if ( isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('typography', $brxc_acf_fields['theme_settings_tabs']) && have_rows( 'field_63a6a58831bbe', 'bricks-advanced-themer' ) ) :

    while ( have_rows( 'field_63a6a58831bbe', 'bricks-advanced-themer' ) ) :
        the_row();

        $label = get_sub_field('brxc_typography_label', 'bricks-advanced-themer' );

        $item = [];

        $key = strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );

        if ( isset($prefix) && $prefix ) {

            $value = 'var(--' . esc_attr($prefix) . '-' . $key . ')'; 
        
        } else {

            $value = 'var(--' . $key . ')'; 

        }

        $item[] = $key;
        $item[] = $value;
        $typography[] = $item;
        
    endwhile;
    
endif;

// Spacing

if ( isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('spacing', $brxc_acf_fields['theme_settings_tabs']) && have_rows( 'field_63a6a51731bbb', 'bricks-advanced-themer' ) ) :

    while ( have_rows( 'field_63a6a51731bbb', 'bricks-advanced-themer' ) ) :

        the_row();

        $label = get_sub_field('brxc_spacing_label', 'bricks-advanced-themer' );

        $item = [];

        $key = strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );

        if ( isset($prefix) && $prefix ) {

            $value = 'var(--' . esc_attr($prefix) . '-' . $key . ')'; 
        
        } else {

            $value = 'var(--' . $key . ')'; 

        }

        $item[] = $key;
        $item[] = $value;
        $spacing[] = $item;
        
    endwhile;
    
endif;

// Border Radius
if ( isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('border-radius', $brxc_acf_fields['theme_settings_tabs']) && have_rows( 'field_63c8f17f5e2ed', 'bricks-advanced-themer' ) ) :

    while ( have_rows( 'field_63c8f17f5e2ed', 'bricks-advanced-themer' ) ) :
        the_row();

        $label = get_sub_field('brxc_border_label', 'bricks-advanced-themer' );

        $item = [];

        $key = strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );

        if ( isset($prefix) && $prefix ) {

            $value = 'var(--' . esc_attr($prefix) . '-' . $key . ')'; 
        
        } else {

            $value = 'var(--' . $key . ')'; 

        }

        $item[] = $key;
        $item[] = $value;
        $border[] = $item;
        
    endwhile;
    
endif;

// Misc

if ( isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('custom-variables', $brxc_acf_fields['theme_settings_tabs']) && have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :

    $cat = []; 
    $index = 0;
    
    while ( have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :
        
        the_row();
        
        $cat_label = get_sub_field('brxc_misc_category_label', 'bricks-advanced-themer' );

        $cat[$index]['label'] = $cat_label;

        if ( have_rows( 'field_63dd12891d1d9', 'bricks-advanced-themer' ) ) :

            while ( have_rows( 'field_63dd12891d1d9', 'bricks-advanced-themer' ) ) :
                the_row();

                if( get_row_layout() == 'brxc_misc_fluid_variable' ){

                    $label = get_sub_field('brxc_misc_fluid_label', 'bricks-advanced-themer' );

                } else {

                    $label = get_sub_field('brxc_misc_static_label', 'bricks-advanced-themer' );

                }

                $item = [];

                $key = strtolower( preg_replace( '/\s+/', '-', esc_attr($label) ) );

                if ( isset($prefix) && $prefix ) {

                    $value = 'var(--' . esc_attr($prefix) . '-' . $key . ')'; 
                
                } else {

                    $value = 'var(--' . $key . ')'; 

                }

                $item[] = $key;
                $item[] = $value;
                $cat[$index]['items'][] = $item;
                
            endwhile;
            
        endif;

        $misc[] = $cat;

        $index++;

    endwhile;
            
endif;

ob_start();
if (isset($brxc_acf_fields['class_features']) && !empty($brxc_acf_fields['class_features']) && is_array($brxc_acf_fields['class_features']) && in_array("variable-picker", $brxc_acf_fields['class_features'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/css_variable_pickr_new.php';
endif;
if (isset($brxc_acf_fields['class_features']) && !empty($brxc_acf_fields['class_features']) && is_array($brxc_acf_fields['class_features']) && in_array("plain-classes", $brxc_acf_fields['class_features'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/plain_classes_new.php';
endif;
if (isset($brxc_acf_fields['enable_global_features']) && !empty($brxc_acf_fields['enable_global_features']) && is_array($brxc_acf_fields['enable_global_features']) && in_array('Global AI Panel', $brxc_acf_fields['enable_global_features']) && isset($brxc_acf_fields['openai_api_key']) && !empty($brxc_acf_fields['openai_api_key'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/openai_text_new.php';
endif;

// Global Features
if (isset($brxc_acf_fields['enable_global_features']) && !empty($brxc_acf_fields['enable_global_features']) && is_array($brxc_acf_fields['enable_global_features']) && in_array('Global AI Panel', $brxc_acf_fields['enable_global_features']) && isset($brxc_acf_fields['openai_api_key']) && !empty($brxc_acf_fields['openai_api_key'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/global_openai_text_new.php';
endif;
if (isset($brxc_acf_fields['enable_global_features']) && !empty($brxc_acf_fields['enable_global_features']) && is_array($brxc_acf_fields['enable_global_features']) && in_array('Advanced CSS', $brxc_acf_fields['enable_global_features'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/advanced_css_new.php';
endif;
if (isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('resources', $brxc_acf_fields['theme_settings_tabs']) && isset($brxc_acf_fields['enable_global_features']) && !empty($brxc_acf_fields['enable_global_features']) && is_array($brxc_acf_fields['enable_global_features']) && in_array('Resources', $brxc_acf_fields['enable_global_features'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/resources_new.php';
endif;
if (isset($brxc_acf_fields['class_features']) && !empty($brxc_acf_fields['class_features']) && is_array($brxc_acf_fields['class_features']) && in_array("extend-classes", $brxc_acf_fields['class_features'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/extend.php';
endif;
if (isset($brxc_acf_fields['class_features']) && !empty($brxc_acf_fields['class_features']) && is_array($brxc_acf_fields['class_features']) && in_array("find-and-replace", $brxc_acf_fields['class_features'])):
    include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/builderPanels/find_replace.php';
endif;

$output = ob_get_clean();
echo $output;
