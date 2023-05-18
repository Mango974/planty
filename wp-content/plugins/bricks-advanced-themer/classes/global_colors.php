<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Global_Colors{

    private static function add_shapes_to_custom_css( $colors_arr, $slug, $custom_css, $acf, $bool_sufix, $query_par ){

        if( !isset($colors_arr) || !$colors_arr ) {

            return;
        }

        if( !is_array( $colors_arr ) ) {

            $tempvalue = '';

            $tempvalue = AT__Helpers::get_hex_value_from_json( $slug, '', $query_par );

            if ( !$tempvalue ) {

                $hex = sanitize_hex_color($acf);

            } else {

                $hex = $tempvalue;
            }

            $custom_css .= $slug . ': ' . sanitize_hex_color( $hex ) . ';';

        } else {

            foreach ( $colors_arr as $rows ) { 

                if( !$rows || !is_array( $rows ) ) {
    
                    return;
    
                }
    
                foreach ( $rows as $key => $value ) {
    
                    if ( !$slug ) {
    
                        return;
    
                    }
    
                    $tempvalue = '';
    
                    $this_slug = $slug;
    
                    ( $bool_sufix && $key ) ? $this_slug .= '-' . $key : '';
    
                    $tempvalue = AT__Helpers::get_hex_value_from_json( $slug, $key, $query_par );
    
                    if ( !$tempvalue ) {
    
                        $hex = AT__Helpers::adjustBrightness( $acf, $value );
    
                    } else {
    
                        $hex = $tempvalue;
                    }
    
                    $custom_css .= $this_slug . ': ' . sanitize_hex_color( $hex ) . ';';
                }
    
            }

        }

        return  $custom_css;

    }

    private static function add_shapes_to_custom_css_simple( $colors_arr, $slug, $custom_css, $acf, $bool_sufix ){

        if( !$colors_arr || !is_array( $colors_arr ) ) {

            return;

        }

        foreach ( $colors_arr as $rows ){ 

            if( !$rows || !is_array( $rows ) ) {

                return;

            }

            foreach ( $rows as $key => $value ) {

                if ( !$slug ) {

                    return;

                }

                $this_slug = $slug;

                ( $bool_sufix && $key ) ? $this_slug .= '-' . $key : '';

                $hex = AT__Helpers::adjustBrightness( $acf, $value );
    
                $custom_css .= $this_slug . ': ' . sanitize_hex_color( $hex ) . ';';
            }
        }
        
        return  $custom_css;

    }

    private static function gutenberg_shapes( $colors_arr, $prefix, $label, $color){

        if( !$colors_arr || !is_array( $colors_arr ) ) {

            return;

        }

        $arr = [];

        foreach ( $colors_arr as $rows ){ 

            if( !$rows || !is_array( $rows ) ) {

                return;

            }

            $sub_arr = [];

            foreach ( $rows as $key => $value ) {

                $sub_arr['name'] = ( isset( $key ) && $key ) ? $label . '-' . $key : $label;

                $sub_arr['slug'] = ( isset( $key ) && $key ) ? $prefix . '-' . $label . '-' . $key : $label . '-' . $key;

                ( isset($key) && $key ) ? $selector = '--' . $prefix . '-' . $label : $selector = '--' . $label;

                $tempvalue = AT__Helpers::get_hex_value_from_json( $selector, $key, 'light');

                if ( !$tempvalue ) {

                    $hex = AT__Helpers::adjustBrightness( $color, $value );

                } else {

                    $hex = $tempvalue;
                }

                $sub_arr['color'] = $hex;
    
            }

            $arr[] = $sub_arr;
        }
        
        return $arr;

    }

    private static function gutenberg_main_color( $prefix, $label, $color ){

        $arr = [];

        $sub_arr = [];

        $sub_arr['name'] = $label;

        $sub_arr['slug'] = $prefix . '-' . $label;

        ( isset($prefix) && $prefix ) ? $selector = '--' . $prefix . '-' . $label : $selector = '--' . $label;

        $tempvalue = AT__Helpers::get_hex_value_from_json( $selector, '', 'light' );

        if (!$tempvalue) {

            $hex = sanitize_hex_color($color);

        } else {

            $hex = $tempvalue;

        }

        $sub_arr['color'] = $hex;

        $arr[] = $sub_arr;
        
        return $arr;

    }

    public static function generate_color_palette_key( $post_id ) {

        if ( get_post_type( $post_id ) !== 'brxc_color_palette' ) return;

        $repeater = 'brxc_colors_repeater'; // the field name of the repeater field

        $subfield1 = 'brxc_color_id'; // the field I want to get
        
        // get the number of rows in the repeater
        $count = intval(get_post_meta($post_id, $repeater, true) );
        // loop through the rows

        for ($i=0; $i<$count; $i++) {

            $get_field = $repeater.'_'.$i.'_'.$subfield1;

            $id = get_post_meta($post_id, $get_field, true);

            if( isset( $id ) && $id != 0 && $id ){

                continue;

            }

            update_post_meta($post_id, $get_field, 'brxc_color_' . AT__Helpers::generate_unique_string( 6 ));

        }

        // Palette key
        
        $key = get_post_meta( $post_id, 'brxc_color_palette_key', true );

        if( $key ) {

           return;

        }

        update_field( 'field_6395702f26ebe', 'brxc_color_' . AT__Helpers::generate_unique_string( 6 ), $post_id );

    }

    public static function update_color_palette_options( $post_id ) {

       global $brxc_acf_fields;

        if ( get_post_type( $post_id ) !== 'brxc_color_palette' || !isset($brxc_acf_fields['theme_settings_tabs']) || empty($brxc_acf_fields['theme_settings_tabs']) || !is_array($brxc_acf_fields['theme_settings_tabs']) || !in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs']) ) {

             return;

        }

        global $brxc_colors;

        $global_colors = $brxc_colors;


        $args = array(
            'post_type'      => 'brxc_color_palette',
            'posts_per_page' => -1,
            'post_status'    => array('publish'),
        );
    
        $query = new \WP_Query($args);

        $final_colors = [];

        $color_palettes_arr = [];
        
        if ( $query->have_posts() ) :

            while ( $query->have_posts() ) :

                $query->the_post();

                $status = get_post_status();

                if ($status !== 'publish'){

                    $color_palettes_arr[] = get_field('brxc_color_palette_key'); 

                    continue;

                }

                $data = [];

                $colors = [];

                $color_palettes_arr[] = get_field('brxc_color_palette_key');

                $data['id'] = get_field('brxc_color_palette_key');

                $data['name'] = get_the_title();

                $status = get_post_status();

                $shades = get_field('brxc_enable_shapes');

                $prefix = strtolower( preg_replace( '/\s+/', '-', get_field( 'brxc_variable_prefix' ) ) );

                if ( have_rows( 'brxc_colors_repeater' ) ) :

                    while ( have_rows( 'brxc_colors_repeater' ) ) :

                        the_row();

                        $color = [];

                        $color_label = strtolower( preg_replace( '/\s+/', '-', get_sub_field( 'brxc_color_label' ) ) );

                        (isset($prefix) && $prefix ) ? $selector = '--' . $prefix . '-' . $color_label : $selector = '--' . $color_label;

                        $color_id = get_sub_field( 'brxc_color_id' );

                        $color['raw'] = 'var(' . $selector . ')';

                        $color['id'] = $color_id;

                        ( isset($prefix) && $prefix ) ? $color['name'] = $prefix . '-' . $color_label : $color['name'] = $color_label;

                        $colors[] = $color;

                        if ( !$shades ) {

                            continue;

                        }

                        foreach ( $global_colors['backend_light'] as $value){

                            $color = [];

                            $color['raw'] = 'var(' . $selector . $value . ')';

                            $color['id'] = $color_id . $value;

                            ( isset($prefix) && $prefix ) ? $color['name'] = $prefix . '-' . $color_label . $value : $color['name'] = $color_label . $value;

                            $colors[] = $color;

                        }
                        
                    endwhile;

                endif;

                $data['colors'] = $colors;

                $final_colors[] = $data;


            endwhile;

        endif;

        wp_reset_postdata();

        // Get Option Color Palette

        $palette_arr = get_option( 'bricks_color_palette' );

        if( !isset($palette_arr) || !$palette_arr || !is_array($palette_arr) ) {

            $palette_arr = [];

            $index = 0;

            foreach ($final_colors as $color) {
    
                $palette_arr[$index] = $color;
    
                $index++;
    
            }

            add_option( 'bricks_color_palette', $palette_arr , '', 'no' );

        } else {

            foreach( $palette_arr as $key => $palette) {

                $pos = strpos($palette['id'], 'brxc_color_');
                
                if ($pos !== false) {
                
                    unset($palette_arr[$key]);
                }
    
            }

            $index = count($palette_arr); 
    
            foreach ($final_colors as $color) {
    
                $palette_arr[$index] = $color;
    
                $index++;
    
            }

        }

        update_option( 'bricks_color_palette', $palette_arr );

    }

    public static function load_colors_variables_on_frontend(){

        global $brxc_acf_fields;

        global $brxc_colors;

        $colors = $brxc_colors;

        $light_css = '';

        $dark_css = '';

        $gut_colors = [];

        $args = array(
            'post_type'      => 'brxc_color_palette',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );
    
        $query = new \WP_Query($args);
        
        if ( $query->have_posts() ) :

            while ( $query->have_posts() ) :

                $query->the_post();

                $darkmode = get_field('brxc_enable_dark_mode');

                $shades = get_field( 'brxc_enable_shapes' );

                $prefix = strtolower( preg_replace( '/\s+/', '-', get_field( 'brxc_variable_prefix' ) ) );


                if ( have_rows( 'brxc_colors_repeater' ) ) :
    
                    while ( have_rows( 'brxc_colors_repeater' ) ) :  
    
                        the_row();
    
                        $acf = get_sub_field( 'brxc_color_hex' );
    
                        $label = strtolower( preg_replace( '/\s+/', '-', get_sub_field( 'brxc_color_label' ) ) );

                        ( isset($prefix) && $prefix ) ? $selector = '--' . $prefix . '-' . $label : $selector = '--' . $label;
                        
                        if( !$acf || !$label ){
    
                            continue;
    
                        }
                        /*
                        ( isset($prefix) && $prefix ) ? $light_css .= '--' . $prefix . '-' . $label . ': ' . sanitize_hex_color( $acf ) . ';' : $light_css .= '--' . $label . ': ' . sanitize_hex_color( $acf ) . ';';

                        // Check if gutenberg sync is activated in option settings
                        if ( isset( $brxc_acf_fields['replace_gutenberg_palettes'] ) && $brxc_acf_fields['replace_gutenberg_palettes'] ){

                            ( isset($prefix) && $prefix ) ? $gut_colors[] = self::gutenberg_main_color( $prefix, $label, $acf) : $gut_colors[] = self::gutenberg_main_color( false, $label, $acf);
                        }
                        */

                        // Main color                    
                        // Check if color is overwritten by json
                        $tempvalue = AT__Helpers::get_hex_value_from_json( $selector, '', 'light' );

                        if (!$tempvalue) {

                            $light_css .= $selector . ':' . sanitize_hex_color($acf) . ';';

                        } else {

                            $light_css .= $selector . ':' . AT__Helpers::get_hex_value_from_json( $selector, '', 'light' ) . ';';

                        }

                        // Check if gutenberg sync is activated in option settings
                        if ( isset( $brxc_acf_fields['replace_gutenberg_palettes'] ) && $brxc_acf_fields['replace_gutenberg_palettes'] ){

                            ( isset($prefix) && $prefix ) ? $gut_colors[] = self::gutenberg_main_color( $prefix, $label, $acf) : $gut_colors[] = self::gutenberg_main_color( false, $label, $acf);
                        }
                        
                        // Shades
                        if ( isset( $shades ) && $shades == true ){

                            $light_css = self::add_shapes_to_custom_css( $colors['light'], $selector, $light_css, $acf, true, 'light' );
                            
                            // Check if gutenberg sync is activated in option settings
                            if ( isset( $brxc_acf_fields['replace_gutenberg_palettes'] ) && $brxc_acf_fields['replace_gutenberg_palettes'] ){

                                ( isset($prefix) && $prefix ) ? $gut_colors[] = self::gutenberg_shapes( $colors['gutenberg'], $prefix, $label, $acf) : $gut_colors[] = self::gutenberg_shapes( $brxc_colors['gutenberg'], false, $label, $acf);
                            
                            }

                        }

                        // Darkmode
                        if ( !$darkmode ) {

                            continue;

                        }

                        // Check if color is overwritten by json
                        $tempvalue = AT__Helpers::get_hex_value_from_json( $selector, '', 'dark' );

                        if (!$tempvalue) {

                            $dark_css .= $selector . ':' . sanitize_hex_color($acf) . ';';

                        } else {

                            $dark_css .= $selector . ':' . AT__Helpers::get_hex_value_from_json( $selector, '', 'dark' ) . ';';

                        }

                        // Shades
                        if ( isset( $shades ) && $shades == true){

                            $dark_css = self::add_shapes_to_custom_css( $colors['dark'], $selector, $dark_css, $acf, true, 'dark' );

                        }
    
                    endwhile;
    
                endif;

            endwhile;

        endif;

        wp_reset_postdata();

        $final_gut_colors = call_user_func_array('array_merge', $gut_colors);
        

        return [$light_css, $dark_css, $final_gut_colors];  

    }

    public static function load_gutenberg_colors() {


        global $brxc_acf_fields;

        if ( !isset( $brxc_acf_fields['replace_gutenberg_palettes'] ) || !$brxc_acf_fields['replace_gutenberg_palettes'] ){

            return;
            
        }

        $arr = self::load_colors_variables_on_frontend();

        add_theme_support('editor-color-palette', $arr[2] );

    }

    public static function load_global_color_variable() {

        //Color palette
        global $brxc_colors;

        $brxc_colors = [];

        $brxc_colors['light'] = [
          //[null => 0],
          ['l-1' => 0.1],
          ['l-2' => 0.2],
          ['l-3' => 0.4],
          ['l-4' => 0.6],
          ['l-5' => 0.8],
          ['l-6' => 0.9],
          ['d-1' => -0.1],
          ['d-2' => -0.2],
          ['d-3' => -0.4],
          ['d-4' => -0.6],
          ['d-5' => -0.8],
          ['d-6' => -0.9],
        ];
      
        $brxc_colors['dark'] = [
          //[null => 0],
          ['l-1' => -0.1],
          ['l-2' => -0.2],
          ['l-3' => -0.4],
          ['l-4' => -0.6],
          ['l-5' => -0.8],
          ['l-6' => -0.9],
          ['d-1' => 0.1],
          ['d-2' => 0.2],
          ['d-3' => 0.4],
          ['d-4' => 0.6],
          ['d-5' => 0.8],
          ['d-6' => 0.9],
        ];

        $brxc_colors['gutenberg'] = [
            //[null => 0],
            ['l-1' => 0.1],
            ['l-2' => 0.2],
            ['l-3' => 0.4],
            ['l-4' => 0.6],
            ['l-5' => 0.8],
            ['l-6' => 0.9],
            [null => 0],
            ['d-1' => -0.1],
            ['d-2' => -0.2],
            ['d-3' => -0.4],
            ['d-4' => -0.6],
            ['d-5' => -0.8],
            ['d-6' => -0.9],
          ];
      
      
        $brxc_colors['backend_light'] = [
          '-l-1',
          '-l-2',
          '-l-3',
          '-l-4',
          '-l-5',
          '-l-6',
          null, // repeat the main color
          '-d-1',
          '-d-2',
          '-d-3',
          '-d-4',
          '-d-5',
          '-d-6',
        ];
      
    }
}