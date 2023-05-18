<?php
if (!defined('ABSPATH')) { die();
}
?>
<div id="brxcVariableOverlay" class="brxc-overlay__wrapper isotope-wrapper" style="opacity:0" data-gutter="10" data-filter-layout="fitRows" onclick="ADMINBRXC.closeModal(event, this, '#brxcVariableOverlay');" >
    <div class="brxc-overlay__inner">
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target, '#brxcVariableOverlay')">
            <i class="bricks-svg ti-close"></i>
        </div>
        <div class="brxc-overlay__inner-wrapper">
            <div class="brxc-overlay__header">
                <h3 class="brxc-overlay__header-title">CSS Variables</h3>
                <a href="/wp-admin/admin.php?page=bricks-advanced-themer" target="_blank">
                    <i class="fa-solid fa-up-right-from-square"></i>
                </a>
            </div>
            <div class="brxc-overlay__container">
                <div class="brxc-overlay__search-box">
                    <input type="search" class="iso-search" name="typography-search" placeholder="Type here to filter the CSS variables" data-type="textContent">
                    <div class="iso-reset">
                        <i class="bricks-svg ti-close"></i>
                    </div>
                </div>
                <?php

                if ( is_array( $typography ) && !empty( $typography ) ){
                    ?>
                    <div class="brxc-overlay-variables__title">Typography</div>
                    <div class="brxc-overlay-variables__btn-wrapper isotope-container">
                    
                        <?php foreach ( $typography as $value ) {
                            ?>
                            <div class="brxc-overlay-variables__btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div> 

                        <?php }
                    ?>
                    </div>
                <?php
                }

                if ( is_array( $spacing ) && !empty( $spacing ) ){
                    ?>
                    <div class="brxc-overlay-variables__title">Spacing</div>
                    <div class="brxc-overlay-variables__btn-wrapper isotope-container">
                    
                        <?php foreach ( $spacing as $value ) {
                            ?>
                            <div class="brxc-overlay-variables__btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div>

                        <?php }
                        ?>
                    </div>
                <?php 
                }

                if ( is_array( $border ) && !empty( $border ) ){
                    ?>
                    <div class="brxc-overlay-variables__title">Border-Radius</div>
                    <div class="brxc-overlay-variables__btn-wrapper isotope-container">
                    
                        <?php foreach ( $border as $value ) {
                            ?>
                            <div class="brxc-overlay-variables__btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div>

                        <?php }
                        ?>
                    </div>
                <?php
                }
                
                if ( is_array( $misc ) && !empty( $misc ) ){

                    $index = 0;

                    foreach ( $misc as $cat ) {
                    ?>
                    <div class="brxc-overlay-variables__title"><?php echo esc_attr($cat[$index]['label']); ?></div>
                    <div class="brxc-overlay-variables__btn-wrapper isotope-container">

                        <?php
                        if ( is_array( $cat[$index]['items'] ) && !empty( $cat[$index]['items'] ) ){ 
                            foreach ( $cat[$index]['items'] as $value ) {
                                ?>
                                <div class="brxc-overlay-variables__btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div> 
                            <?php }
                        }
                    ?>
                    </div>
                    <?php 
                    $index++;
                    }
                }?>
            </div>
        </div>
    </div>
</div>