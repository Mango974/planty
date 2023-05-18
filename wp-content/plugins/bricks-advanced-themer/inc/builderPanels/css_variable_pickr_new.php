<?php
if (!defined('ABSPATH')) { die();
}

/*--------------------------------------
Variables
--------------------------------------*/

// ID & Classes
$overlay_id = 'brxcVariableOverlay';
$prefix_id = 'brxcVariable';
$prefix_class = 'brxc-css-variables';
// Heading
$modal_heading_title = 'CSS Variables';
$modal_heading_link = \site_url() . '/wp-admin/admin.php?page=bricks-advanced-themer#field_63a84218b5268';

?>
<!-- Main -->
<div id="<?php echo esc_attr($overlay_id);?>" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#<?php echo esc_attr($overlay_id);?>');" >
    <!-- Main Inner -->
    <div class="brxc-overlay__inner brxc-medium" style="max-height: 840px;">
        <!-- Close Modal Button -->
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target, '#<?php echo esc_attr($overlay_id);?>')">
            <i class="bricks-svg ti-close"></i>
        </div>
        <!-- Modal Wrapper -->
        <div class="brxc-overlay__inner-wrapper">
            <!-- Modal Header -->
            <div class="brxc-overlay__header">
                <!-- Modal Header Title-->
                <h3 class="brxc-overlay__header-title"><?php echo esc_attr($modal_heading_title);?></h3>
                <!-- Modal Header External Link Icon-->
                <a href="<?php echo esc_attr($modal_heading_link);?>" target="_blank" class="brxc-overlay__header-link">
                    <i class="fa-solid fa-up-right-from-square"></i>
                </a>
            </div>
            <!-- Modal Error Container for OpenAI -->
            <div class="brxc-overlay__error-message-wrapper"></div>
            <!-- Modal Container -->
            <div class="brxc-overlay__container">
                <!-- Modal Panels Wrapper -->
                <div class="brxc-overlay__pannels-wrapper">
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-1 isotope-wrapper" data-gutter="10" data-filter-layout="fitRows">
                        <!-- Panel Content -->
                        <div class="brxc-overlay__search-box">
                            <input type="search" class="iso-search" name="typography-search" placeholder="Type here to filter the CSS variables" data-type="textContent">
                            <div class="iso-reset">
                                <i class="bricks-svg ti-close"></i>
                            </div>
                        </div>
                        <?php
                        if ( is_array( $typography ) && !empty( $typography ) ){
                            ?>
                            <label class="brxc-input__label">Typography</label>
                            <div class="brxc-overlay__action-btn-wrapper isotope-container">
                            
                                <?php foreach ( $typography as $value ) {
                                    ?>
                                    <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div> 

                                <?php }
                            ?>
                            </div>
                        <?php
                        }

                        if ( is_array( $spacing ) && !empty( $spacing ) ){
                            ?>
                            <label class="brxc-input__label">Spacing</label>
                            <div class="brxc-overlay__action-btn-wrapper isotope-container">
                            
                                <?php foreach ( $spacing as $value ) {
                                    ?>
                                    <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div>

                                <?php }
                                ?>
                            </div>
                        <?php 
                        }

                        if ( is_array( $border ) && !empty( $border ) ){
                            ?>
                            <label class="brxc-input__label">Border-Radius</label>
                            <div class="brxc-overlay__action-btn-wrapper isotope-container">
                            
                                <?php foreach ( $border as $value ) {
                                    ?>
                                    <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div>

                                <?php }
                                ?>
                            </div>
                        <?php
                        }
                        
                        if ( is_array( $misc ) && !empty( $misc ) ){

                            $index = 0;

                            foreach ( $misc as $cat ) {
                            ?>
                            <label class="brxc-input__label"><?php echo esc_attr($cat[$index]['label']); ?></label>
                            <div class="brxc-overlay__action-btn-wrapper isotope-container">

                                <?php
                                if ( is_array( $cat[$index]['items'] ) && !empty( $cat[$index]['items'] ) ){ 
                                    foreach ( $cat[$index]['items'] as $value ) {
                                        ?>
                                        <div class="brxc-overlay__action-btn isotope-selector" data-variable="<?php echo esc_attr($value[1]) ?>"><?php echo esc_attr($value[0]) ?></div> 
                                    <?php }
                                }
                            ?>
                            </div>
                            <?php 
                            $index++;
                            }
                        }?>
                        <!-- End of Panel Content -->
                    </div>
                    <!-- End of Modal Panel -->
                </div>
                <!-- End of Modal Panels Wrapper -->
            </div>
            <!-- End of Modal Container -->
        </div>
        <!-- End of Modal Wrapper -->
    </div>
    <!-- End of Main Inner -->
</div>
<!-- End of Main -->