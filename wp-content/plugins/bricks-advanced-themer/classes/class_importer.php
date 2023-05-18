<?php
namespace Advanced_Themer_Bricks;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AT__Class_Importer{

    public static function extract_selectors_from_css( $file ) {

        $file = file_get_contents($file);

        $pattern_one = '/(?<=\{)(.*?)(?=\})/s';

        $pattern_two = '/[\.][\w|-]*/';

        $stripped = preg_replace($pattern_one, '', $file);

        $selectors = array();

        $matches = preg_match_all($pattern_two, $stripped, $selectors);

        return array_unique($selectors[0]);

    }
    /*
    public static function generate_class_importer_key() {

        $screen = get_current_screen();

        if (!$screen || (strpos($screen->id, "bricks-advanced-themer") == false) )  return;

        $repeater = 'brxc_class_importer_repeater'; // the field name of the repeater field

        $subfield1 = 'brxc_class_importer_id'; // the field I want to get
        
        // get the number of rows in the repeater
        $count = get_option('bricks-advanced-themer_' . $repeater, true);
        // loop through the rows

        for ($i=0; $i<$count; $i++) {

            $get_field = 'bricks-advanced-themer_' . $repeater.'_'.$i.'_'.$subfield1;

            $id = get_option($get_field, true);

            if( isset( $id ) && $id != 0 && $id ){

                continue;

            }

            update_option($get_field, AT__Helpers::generate_unique_string( 6 ));

        }
    }

    */

    public static function enqueue_uploaded_css(){

        if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

            while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

                the_row();

                global $class_importer_label, $class_importer_file, $class_importer_version;

                $class_importer_label = get_sub_field('field_63b4bd5c16ac3', 'bricks-advanced-themer' );

                $class_importer_version = get_sub_field('field_63b4bd5c16ac4', 'bricks-advanced-themer' );

                ( empty($class_importer_version) ) ?  $class_importer_version = microtime(true) : '';

                $priority = get_sub_field('field_6f8v4s1x4a5ff', 'bricks-advanced-themer' );

                $position_temp = get_sub_field('field_6f5o9q1d14dd1', 'bricks-advanced-themer' );

                ($position_temp === 'head') ? $position = 'wp_enqueue_scripts' : $position = 'get_footer';

                $class_importer_file = get_sub_field('field_63b4bdf216ac7', 'bricks-advanced-themer' );

                add_action($position, function(){
                    
                    global $class_importer_label, $class_importer_file, $class_importer_version;

                    wp_enqueue_style('brxc-' . $class_importer_label, $class_importer_file, array(), $class_importer_version, 'all');

                }, $priority);

            endwhile;
        
        endif;

    }

    /*
    public static function update_global_classes_from_importer() {

        if( ! AT__Helpers::check_url_query_for_bricks_builder() ) return;

        global $brxc_acf_fields;

        //$global_classes = get_option('bricks_global_classes');

        $options = get_option('bricks_global_classes');

        if( !isset($options) ) {

            $global_classes = [];

        } else{

            $global_classes = $options;

        }

        $index = 0;

        $delete = [];

        if( isset($global_classes) && $global_classes && is_array( $global_classes) && !empty($global_classes) ) {

            foreach ( $global_classes as $global_class ) {

                if ( isset($global_class['id']) && strpos($global_class['id'], 'brxc_class_') === 0 ) {
    
                    $delete[] = $index;
    
                }
    
                $index++;
            }

        }


        if ( is_array($delete) ) {

            foreach( $delete as $i ){

                unset($global_classes[$i]);

            }

        }

        if ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

            while ( have_rows( 'field_63b4bd5c16ac1', 'bricks-advanced-themer' ) ) :

                the_row();

                $id_stylesheet = get_sub_field('field_63b4bd5c16ac2', 'bricks-advanced-themer' );

                $file = get_sub_field('field_63b4bdf216ac7', 'bricks-advanced-themer' );

                $classes = self::extract_selectors_from_css($file);

                $id_exist = false;

                foreach ( $classes as $class) {

                    $item = [];
    
                    $id_class = 'brxc_class_' . $id_stylesheet  . '_' . $class;

                    $item['id'] = $id_class;

                    $item['name'] = str_replace(['.', '#'],'',$class);

                    if(isset($options) && is_array($options)){

                        $global_classes = array_merge( $global_classes, array($item) );

                    } else {

                        $global_classes[] = $item;

                    }

                }

            endwhile;

        endif;


        $locked_classes = [];

        if(isset($global_classes) && !empty($global_classes) && is_array($global_classes)){

            foreach($global_classes as $class){

                if( isset($class['id']) ){
    
                    $locked_classes[] = $class['id'];
    
                }
            }
        }
        
        update_option('bricks_global_classes', $global_classes);
        update_option('bricks_global_classes_locked', $locked_classes);


    }
    */
}