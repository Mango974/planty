<?php

if (!defined('ABSPATH')) { die();
}
//Category

        
if ( have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :

    while ( have_rows( 'field_64066a105f7ec', 'bricks-advanced-themer' ) ) :

        the_row();

        $cat_label = get_sub_field('brxc_misc_category_label', 'bricks-advanced-themer' );

        if( have_rows('field_63dd12891d1d9', 'bricks-advanced-themer') ):

            $prefix = $brxc_acf_fields['global_prefix'];
            $base_font = $brxc_acf_fields['base_font'];
            $min_vw = $brxc_acf_fields['min_vw'];
            $max_vw = $brxc_acf_fields['max_vw '];

            while ( have_rows('field_63dd12891d1d9', 'bricks-advanced-themer') ) : the_row();

                // Case: Fluid Variable.
                if( get_row_layout() == 'brxc_misc_fluid_variable' ):
                    $label = get_sub_field('brxc_misc_fluid_label', 'bricks-advanced-themer' );
                    $min_value = get_sub_field('brxc_misc_fluid_min_value', 'bricks-advanced-themer' );
                    $max_value = get_sub_field('brxc_misc_fluid_max_value', 'bricks-advanced-themer' );

                    ?>
                    <div class="isotope-wrapper">
                        <span><?php echo esc_attr($label);?></span>
                        <div class="brxc-modal__field two-icons">
                            <div class="brxc-modal__labels-typo">
                                <input type="number" value="<?php echo esc_attr($min_value);?>" data-initial-value="<?php echo esc_attr($min_value);?>" data-prefix ="<?php echo esc_attr($prefix);?>" data-label="<?php echo esc_attr($label);?>" data-base-font=<?php echo esc_attr($base_font)?> data-min-vw=<?php echo esc_attr($min_vw)?> data-max-vw=<?php echo esc_attr($max_vw)?> onInput="BRXC.setClampValue(event.target)">
                                <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/icons_typo.php';?>
                            </div>
                            <div class="brxc-modal__labels-typo">
                                <input type="number" value="<?php echo esc_attr($max_value);?>" data-initial-value="<?php echo esc_attr($max_value);?>" onInput="BRXC.setClampValue(event.target)">
                                <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/icons_typo.php';?>
                            </div>
                        </div>
                    </div><?php

                // Case: Static Variable.
                elseif( get_row_layout() == 'brxc_misc_static_variable' ): 
                    $label = get_sub_field('brxc_misc_static_label', 'bricks-advanced-themer' );
                    $value = get_sub_field('brxc_misc_static_value', 'bricks-advanced-themer' );

                    ?>
                    <div class="isotope-wrapper">
                        <span><?php echo esc_attr($label);?></span>
                        <div class="brxc-modal__field two-icons">
                            <div class="brxc-modal__labels-typo">
                                <input type="text" value="<?php echo esc_attr($value);?>" data-initial-value="<?php echo esc_attr($value);?>" data-prefix ="<?php echo esc_attr($prefix);?>" data-label="<?php echo esc_attr($label);?>" onInput="BRXC.updateMiscValue(event.target)">
                                <?php include BRICKS_ADVANCED_THEMER_PATH . '/inc/components/icons_misc.php';?>
                            </div>
                        </div>
                    </div><?php

                endif;

            // End loop.
            endwhile;
        endif;
    
    // End Repeater.
    endwhile;    
else:

    echo '<div class="brxc-modal__no-colors"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M13.05 31.9q.6 0 1.05-.45.45-.45.45-1.05 0-.6-.45-1.05-.45-.45-1.05-.45-.6 0-1.05.45-.45.45-.45 1.05 0 .6.45 1.05.45.45 1.05.45Zm-1.5-6.5h3v-9.55h-3Zm8.95 4h15.95v-3H20.5Zm0-8.55h15.95v-3H20.5ZM6.6 40q-1.2 0-2.1-.9-.9-.9-.9-2.1V11q0-1.2.9-2.1.9-.9 2.1-.9h34.8q1.2 0 2.1.9.9.9.9 2.1v26q0 1.2-.9 2.1-.9.9-2.1.9Zm0-3h34.8V11H6.6v26Zm0 0V11v26Z"/></svg>No Misc Variables found.</div>';
    
endif;

