<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Grid_Builder{

    public static function grid_builder_classes() {

        $custom_css = '';

        if ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

            $items = [];

            $classes = [];

            while ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

                the_row();

                $class = '.' . get_sub_field('field_63b48c6f1b20b', 'bricks-advanced-themer' );

                $max_col = get_sub_field('field_63b48c6f1b20c', 'bricks-advanced-themer' );

                $min_width = get_sub_field('field_63b48c6f1b20d', 'bricks-advanced-themer' );

                $gap = explode(" ", get_sub_field('field_63b48d7e1b20e', 'bricks-advanced-themer' ));

                if( count($gap) === 1 ){
                    $gap_col = $gap[0];
                    $gap_row = $gap[0];
                } else {
                    $gap_col = $gap[0];
                    $gap_row = $gap[1];
                }

                $item = [$class, $max_col, $min_width, $gap_col, $gap_row];

                $classes[] = $class;

                $items[] = $item;

            endwhile;

            $imploded_classes = implode(',', $classes);

            $custom_css .= $imploded_classes;
            $custom_css .= '{display:grid!important;gap:var(--grid-layout-gap);grid-template-columns: repeat(auto-fit, minmax(min(100%, var(--grid-item--min-width)), 1fr));}@media screen and (min-width: 781px){';
            $custom_css .= $imploded_classes;
            $custom_css .= '{--gap-count: calc(var(--grid-column-count) - 1);--total-gap-width: calc(var(--gap-count) * var(--grid-layout-gap));--grid-item--max-width: calc((100% - var(--total-gap-width)) / var(--grid-column-count));grid-template-columns: repeat(auto-fill, minmax(max(var(--grid-item--min-width), var(--grid-item--max-width)), 1fr));}}';
            foreach ( $items as $item ){
                $custom_css .= $item[0] . '{--grid-column-count:' . $item[1] . ';--grid-item--min-width:' . $item[2] . 'px;--grid-layout-gap:' . $item[3] . ';}';
            }

        endif;

        return $custom_css;

    }
    /*
    public static function generate_class_key() {

        $screen = get_current_screen();

        if (!$screen || (strpos($screen->id, "bricks-advanced-themer") == false) )  return;
        
        $repeater = 'brxc_grid_builder_repeater'; // the field name of the repeater field

        $subfield1 = 'brxc_grid_id'; // the field I want to get
        
        // get the number of rows in the repeater
        $count = intval(get_option('bricks-advanced-themer_' . $repeater) );
        // loop through the rows

        for ($i=0; $i<$count; $i++) {

            $get_field = 'bricks-advanced-themer_' . $repeater.'_'.$i.'_'.$subfield1;

            $id = get_option($get_field);

            if( isset( $id ) && $id != 0 && $id ){

                continue;

            }

            update_option($get_field, 'brxc_grid_' . AT__Helpers::generate_unique_string( 6 ));

        }
    }

    public static function update_class_options() {

        $screen = get_current_screen();

        if (!$screen || (strpos($screen->id, "bricks-advanced-themer") == false) )  return; 
        
        $options = get_option('bricks_global_classes');


        if( !isset($options) ) {

            $global_classes = [];

        } else{

            $global_classes = $options;

        }

        $index = 0;

        $delete = [];
        
        if( $global_classes && is_array( $global_classes) && !empty($global_classes) ){
            foreach ( $global_classes as $global_class ) {

                if ( isset($global_class['id']) && strpos($global_class['id'], 'brxc_grid_') === 0 ) {
    
                    $delete[] = $index;
    
                }
    
                $index++;
            }

            if ( is_array($delete) ) {

                foreach( $delete as $i ){

                    unset($global_classes[$i]);
    
                }

            }

        } 

        if ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

            while ( have_rows( 'field_63b48c6f1b20a', 'bricks-advanced-themer' ) ) :

                the_row();

                $id = get_sub_field('field_63b49e528fc9c', 'bricks-advanced-themer' );

                $class = get_sub_field('field_63b48c6f1b20b', 'bricks-advanced-themer' );
                
                $item['id'] = $id;

                $item['name'] = $class;

                if (isset( $item['id'] ) && $item['id'] && isset( $item['name'] ) && $item['name'] ){

                    if(isset($options) && is_array($options)){

                        $global_classes = array_merge( $global_classes, array($item) );

                    } else {

                        $global_classes[] = $item;

                    }

                }

            endwhile;

        endif;

        $locked_classes = [];

        foreach($global_classes as $class){

            if($class['id']){

                $locked_classes[] = $class['id'];

            }
        }
        
        update_option('bricks_global_classes', $global_classes);
        update_option('bricks_global_classes_locked', $locked_classes);


    }
    */
}