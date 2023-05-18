<?php

if (!defined('ABSPATH')) { die();
}
?>
<div class="accordion v1">
    <?php 
    $has_darmode = 0;
    if ( $query->have_posts() ) :
    
        while ( $query->have_posts() ) :
    
            $query->the_post();

            global $post;

            $darkmode = get_field( 'brxc_enable_dark_mode' );

            if( !isset($darkmode) || !$darkmode ){

                continue;

            } 

            $has_darmode++;

            $post_slug = $post->post_name;

            $json = get_field( 'brxc_import_from_json' );

            $shades = get_field( 'brxc_enable_shapes' );

            $prefix = get_field( 'brxc_variable_prefix' );

            echo '<div class="brxc-modal__palette-wrapper" data-palette="' . $post_slug . '"><span class="brxc-modal__palette-title">' . get_the_title() . '</span>';
    
            if ( have_rows( 'brxc_colors_repeater' ) ) :
    
                while ( have_rows( 'brxc_colors_repeater' ) ) :
    
                    the_row();

                    $label = get_sub_field( 'brxc_color_label' );

                    $acf = get_sub_field( 'brxc_color_hex' );

                    if ($acf):

                    // Base color

                    ( isset($prefix) && $prefix ) ? $tempvalue = Advanced_Themer_Bricks\AT__Helpers::get_hex_value_from_json( '--' . strtolower( preg_replace( '/\s+/', '-', $prefix ) ) . '-' . strtolower( preg_replace('/\s+/', '-', $label ) ), '', 'dark' ) : $tempvalue = Advanced_Themer_Bricks\AT__Helpers::get_hex_value_from_json( '--' . strtolower( preg_replace('/\s+/', '-', $label ) ), '', 'dark' );
      
                    $delete_value = sanitize_hex_color( $acf );
                    
                    if ( !$tempvalue ) {

                        $value = $delete_value;

                        $textvalue = '';

                    } else {

                        $value = $tempvalue;

                        $textvalue = $tempvalue;

                    }
                    ?>
                    <div class="a-container">
                        <div class="a-btn brxc-modal__header">
                            <div class="brxc-modal__header-preview" style="background-color: var(--<?php echo ( isset($prefix) && $prefix ) ? strtolower( preg_replace( '/\s+/', '-', $prefix ) ) . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) : strtolower(preg_replace('/\s+/', '-', $label));?>)"></div>
                            <h6><?php echo $label;?></h6><span></span>
                        </div>
                        <div class="a-panel">
                            <div class="brxc-modal__field three-icons">
                                <div class="brxc-modal__left-col">
                                    <input type="color" value="<?php echo $value;?>" data-delete-value="<?php echo $delete_value?>" data-initial-value="<?php echo $value;?>" data-color="<?php echo ( isset($prefix) && $prefix ) ? strtolower( preg_replace( '/\s+/', '-', $prefix ) ) . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) : strtolower(preg_replace('/\s+/', '-', $label));?>" data-sufix="" onInput="BRXC.updateSingleLabel(event.target)">
                                </div>
                                <div class="brxc-modal__right-col">
                                    <span><?php echo $label;?></span>
                                    <div class="brxc-modal__labels">
                                        <input type="text" value="<?php echo (isset($textvalue) ) ? $textvalue : '';?>" onInput="BRXC.updateSingleInput(event.target)">
                                        <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/icons_dark.php';?>
                                    </div>
                                </div>
                            </div>
                            <?php

                            // Shades

                            if ( isset( $shades ) && $shades == true){

                                foreach ( $colors['dark'] as $rows ){

                                    foreach ( $rows as $sufix => $percent ){

                                        ( isset($prefix) && $prefix ) ? $tempvalue = Advanced_Themer_Bricks\AT__Helpers::get_hex_value_from_json( '--' . strtolower( preg_replace( '/\s+/', '-', $prefix ) ) . '-' . strtolower( preg_replace('/\s+/', '-', $label ) ), $sufix, 'dark' ) : $tempvalue = Advanced_Themer_Bricks\AT__Helpers::get_hex_value_from_json( '--' . strtolower( preg_replace('/\s+/', '-', $label ) ), $sufix, 'dark' );

                                        $delete_value = Advanced_Themer_Bricks\AT__Helpers::adjustBrightness( sanitize_hex_color( $acf ), $percent );
                                        
                                        if ( !$tempvalue ) {

                                            $value = $delete_value;

                                            $textvalue = '';

                                        } else {

                                            $value = $tempvalue;

                                            $textvalue = $tempvalue;

                                        }

                                        ?>
                                        <div class="brxc-modal__field three-icons">
                                            <div class="brxc-modal__left-col">
                                                <input type="color" value="<?php echo $value;?>" data-delete-value="<?php echo $delete_value?>" data-initial-value="<?php echo $value;?>" data-color="<?php echo ( isset($prefix) && $prefix ) ? strtolower( preg_replace( '/\s+/', '-', $prefix ) ) . '-' . strtolower( preg_replace( '/\s+/', '-', $label ) ) : strtolower(preg_replace('/\s+/', '-', $label));?>" data-sufix="<?php echo $sufix ?>" onInput="BRXC.updateSingleLabel(event.target)">
                                            </div>
                                            <div class="brxc-modal__right-col">
                                                <span><?php echo ($sufix) ? $sufix : $label .' Color';?></span>
                                                <div class="brxc-modal__labels">
                                                    <input type="text" value="<?php echo (isset($textvalue) ) ? $textvalue : '';?>" onInput="BRXC.updateSingleInput(event.target)">
                                                    <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/icons_dark.php';?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                }
                            }
                            ?>
                        </div>
                    </div><?php 

                    endif;

                endwhile;

            endif;

            echo '</div>';

        endwhile;

    endif;

    if($has_darmode === 0) {

        echo '<div class="brxc-modal__no-darkmode"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M13.05 31.9q.6 0 1.05-.45.45-.45.45-1.05 0-.6-.45-1.05-.45-.45-1.05-.45-.6 0-1.05.45-.45.45-.45 1.05 0 .6.45 1.05.45.45 1.05.45Zm-1.5-6.5h3v-9.55h-3Zm8.95 4h15.95v-3H20.5Zm0-8.55h15.95v-3H20.5ZM6.6 40q-1.2 0-2.1-.9-.9-.9-.9-2.1V11q0-1.2.9-2.1.9-.9 2.1-.9h34.8q1.2 0 2.1.9.9.9.9 2.1v26q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h34.8V11H6.6v26Zm0 0V11v26Z"/></svg>No Darkmode palettes found.</div>';
    }

    $query->rewind_posts();

    ?>
</div>