<?php
if (!defined('ABSPATH')) { die();
}

/*--------------------------------------
Variables
--------------------------------------*/

// ID & Classes
$overlay_id = 'brxcResourcesOverlay';
$prefix_id = 'brxcResources';
$prefix_class = 'brxc-resources';
// Heading
$modal_heading_title = 'Resources';
$modal_heading_link = '/wp-admin/admin.php?page=bricks-advanced-themer#field_63d8cb54c801e';

?>
<!-- Main -->
<div id="<?php echo esc_attr($overlay_id);?>" class="brxc-overlay__wrapper" style="opacity:0" data-input-target="" onclick="ADMINBRXC.closeModal(event, this, '#<?php echo esc_attr($overlay_id);?>');" >
    <!-- Main Inner -->
    <div class="brxc-overlay__inner brxc-large">
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
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-1">
                        <!-- Panel Content -->
                        <div id="brxcCSSContainer" class="isotope-wrapper" data-gutter="20" data-filter-layout="masonry">
                            <div id="brxcCSSColLeft" class="brxc-overlay__col-left">
                                <div class="brxc-overlay__action-btn-wrapper m-bottom-10"> 
                                    <div class="filterbtn brxc-overlay__action-btn outline active" data-filter="*">All</div>
                                    <?php
                                    if ( have_rows( 'field_63d8cb65c801f', 'bricks-advanced-themer' ) ) :
                                        while ( have_rows( 'field_63d8cb65c801f', 'bricks-advanced-themer' ) ) :
                                            the_row();
                                            $category = get_sub_field('field_63d8cbb7c8020', 'bricks-advanced-themer');
                                            ?>
                                            <div class="filterbtn brxc-overlay__action-btn outline" data-filter="<?php echo strtolower( preg_replace( '/\s+/', '-', esc_attr($category) ) );?>"><?php echo esc_attr($category)?></div>
                                        <?php endwhile;
                                    endif;
                                    ?>
                                </div>
                                <div class="brxc-overlay__search-box">
                                    <input type="search" class="iso-search" name="typography-search" placeholder="Type the title here to filter the grid" data-type="title">
                                    <div class="iso-reset">
                                        <i class="bricks-svg ti-close"></i>
                                    </div>
                                </div>
                            </div>
                            <div id="brxcCSSColRight">
                                <div id="brxcPageCSSWrapper" class="brxc-overlay-resources__wrappe">
                                    <div class="brxc-gallery__container isotope-container">
                                    <?php
                                    if ( have_rows( 'field_63d8cb65c801f', 'bricks-advanced-themer' ) ) :
                                        $index = 0; 
                                        while ( have_rows( 'field_63d8cb65c801f', 'bricks-advanced-themer' ) ) :
                                            the_row();
                                            $category = get_sub_field('field_63d8cbb7c8020', 'bricks-advanced-themer');
                                            $gallery = get_sub_field('field_63d8cbd8c8021', 'bricks-advanced-themer');
                                            if ( $gallery && is_array($gallery) && !empty($gallery)) : ?>
                                                <?php foreach( $gallery as $image ) : ?>
                                                    <div class="isotope-selector brxc-isotope__col" data-filter="<?php echo strtolower( preg_replace( '/\s+/', '-', esc_attr($category) ) );?>" title="<?php echo esc_attr( $image['title'] ); ?>" data-transform="calc(-100% - 80px)" onClick="ADMINBRXC.setInnerContent(this);ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">
                                                        <img src="<?php echo esc_url( $image['sizes']['2048x2048'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"/>
                                                        <div class="brxc-gallery__title">
                                                            <span><?php echo esc_attr( $image['title'] ); ?></span>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endwhile;
                                    endif;
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Panel Content -->
                    </div>
                    <!-- End of Modal Panel -->
                    <!-- Modal Panel -->
                    <div class="brxc-overlay__pannel brxc-overlay__pannel-2 p-top-0">
                        <!-- Panel Content -->
                        <div class="brxc-overlay__pannel-top--sticky flex align-center space-between m-bottom-10">
                            <div class="brxc-overlay__action-btn" data-transform="0" onClick="ADMINBRXC.movePanel(document.querySelector('#<?php echo esc_attr($overlay_id);?> .brxc-overlay__pannels-wrapper'),this.dataset.transform);">BACK</div>
                            <h3 class="brxc-overlay__header-title"></h3>
                            <div class="brxc-overlay__action-btn-wrapper">
                                <div class="brxc-overlay-btn__open brxc-overlay__action-btn" onClick="window.open(this.parentNode.closest('.brxc-overlay__container').querySelector('img.inner__img').src, '_blank').focus();">Open in a new tab</div>
                                <div class="brxc-overlay-btn__copy brxc-overlay__action-btn primary" onClick="ADMINBRXC.copytoClipboard(this,this.parentNode.closest('.brxc-overlay__container').querySelector('img.inner__img').src,'URL Copied!','Copy URL to Clipboard');">Copy URL to Clipboard</div>
                            </div>
                        </div>
                        <div class="brxc-overlay__img"></div>
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