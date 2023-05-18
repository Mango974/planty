<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Global_Variables{

    private static function clamp_builder($pixelsPerRem, $minWidthPx, $maxWidthPx, $minFontSize, $maxFontSize ) {
      
        $minWidth = $minWidthPx / $pixelsPerRem;
        $maxWidth = $maxWidthPx / $pixelsPerRem;
      
        $slope = ( $maxFontSize - $minFontSize ) / ( $maxWidth - $minWidth );
        $yAxisIntersection = -$minWidth * $slope + $minFontSize;
      
        return 'clamp(' . $minFontSize / $pixelsPerRem . 'rem, ' . round($yAxisIntersection / $pixelsPerRem, 4) . 'rem + ' . round($slope / $pixelsPerRem * 100, 4) . 'cqi, ' . $maxFontSize / $pixelsPerRem. 'rem)';
    }

    public static function load_spacing_variables_on_frontend() {

        global $brxc_acf_fields;
        
        $custom_css = '';

        if ( have_rows( 'field_63a6a51731bbb', 'bricks-advanced-themer' ) ) :

            $prefix = $brxc_acf_fields['global_prefix'];
            $base_font = $brxc_acf_fields['base_font'];
            $min_vw = $brxc_acf_fields['min_vw'];
            $max_vw = $brxc_acf_fields['max_vw '];

            while ( have_rows( 'field_63a6a51731bbb', 'bricks-advanced-themer' ) ) :
                the_row();

                $label = get_sub_field('brxc_spacing_label', 'bricks-advanced-themer' );
                $min_value = get_sub_field('brxc_spacing_min_value', 'bricks-advanced-themer' );
                $max_value = get_sub_field('brxc_spacing_max_value', 'bricks-advanced-themer' );

                if ( isset($prefix) && $prefix ) {
                    
                    $custom_css .= '--' . $prefix . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';
                
                } else {

                $custom_css .= '--' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';

                }
                
            endwhile;
            
        endif;

        return $custom_css;

    }

    public static function load_border_variables_on_frontend() {

        global $brxc_acf_fields;
        
        $custom_css = '';

        if ( have_rows( 'field_63c8f17f5e2ed', 'bricks-advanced-themer' ) ) :

            $prefix = $brxc_acf_fields['global_prefix'];
            $base_font = $brxc_acf_fields['base_font'];
            $min_vw = $brxc_acf_fields['min_vw'];
            $max_vw = $brxc_acf_fields['max_vw '];

            while ( have_rows( 'field_63c8f17f5e2ed', 'bricks-advanced-themer' ) ) :
                the_row();

                $label = get_sub_field('brxc_border_label', 'bricks-advanced-themer' );
                $min_value = get_sub_field('brxc_border_min_value', 'bricks-advanced-themer' );
                $max_value = get_sub_field('brxc_border_max_value', 'bricks-advanced-themer' );

                if ( isset($prefix) && $prefix ) {
                    
                    $custom_css .= '--' . $prefix . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';
                
                } else {

                $custom_css .= '--' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';

                }
                
            endwhile;
            
        endif;

        return $custom_css;

    }

    public static function load_typography_variables_on_frontend() {

        global $brxc_acf_fields;

        $custom_css = '';

        if ( have_rows( 'field_63a6a58831bbe', 'bricks-advanced-themer' ) ) :

            $prefix = $brxc_acf_fields['global_prefix'];
            $base_font = $brxc_acf_fields['base_font'];
            $min_vw = $brxc_acf_fields['min_vw'];
            $max_vw = $brxc_acf_fields['max_vw '];

            while ( have_rows( 'field_63a6a58831bbe', 'bricks-advanced-themer' ) ) :
                the_row();

                $label = get_sub_field('brxc_typography_label', 'bricks-advanced-themer' );
                $min_value = get_sub_field('brxc_typography_min_value', 'bricks-advanced-themer' );
                $max_value = get_sub_field('brxc_typography_max_value', 'bricks-advanced-themer' );

                if ( isset($prefix) && $prefix ) {
                    
                    $custom_css .= '--' . $prefix . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';
                
                } else {

                $custom_css .= '--' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';

                }
                
            endwhile;

        endif;

        return $custom_css;

    }

    public static function load_misc_variables_on_frontend() {

        global $brxc_acf_fields;

        $custom_css = '';

        //Category

        
        if ( have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :

            while ( have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :

                the_row();

                // Flexible Content

                if( have_rows('field_63dd12891d1d9', 'bricks-advanced-themer') ):

                    $prefix = $brxc_acf_fields['global_prefix'];
                    $base_font = $brxc_acf_fields['base_font'];
                    $min_vw = $brxc_acf_fields['min_vw'];
                    $max_vw = $brxc_acf_fields['max_vw '];

                    // Loop through rows.
                    while ( have_rows('field_63dd12891d1d9', 'bricks-advanced-themer') ) : the_row();
                
                        // Case: Paragraph layout.
                        if( get_row_layout() == 'brxc_misc_fluid_variable' ):
                            $label = get_sub_field('brxc_misc_fluid_label', 'bricks-advanced-themer' );
                            $min_value = get_sub_field('brxc_misc_fluid_min_value', 'bricks-advanced-themer' );
                            $max_value = get_sub_field('brxc_misc_fluid_max_value', 'bricks-advanced-themer' );

                            if ( isset($prefix) && $prefix ) {
                                
                                $custom_css .= '--' . $prefix . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';
                            
                            } else {

                            $custom_css .= '--' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . self::clamp_builder($base_font, $min_vw, $max_vw, (float) $min_value, (float) $max_value) . ';';

                            }
                
                        // Case: Download layout.
                        elseif( get_row_layout() == 'brxc_misc_static_variable' ): 
                            $label = get_sub_field('brxc_misc_static_label', 'bricks-advanced-themer' );
                            $value = get_sub_field('brxc_misc_static_value', 'bricks-advanced-themer' );

                            if ( isset($prefix) && $prefix ) {
                                
                                $custom_css .= '--' . $prefix . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . $value . ';';
                            
                            } else {

                                $custom_css .= '--' . strtolower( preg_replace( '/\s+/', '-', $label ) ) . ': ' . $value . ';';

                            }
                
                        endif;
                
                    // End Flexible Content
                    endwhile;

                endif;

            // End Repeater
            endwhile;

        endif;
        
        return $custom_css;
    }

}