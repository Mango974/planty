<?php
if (!defined('ABSPATH')) { die();
}
?>
<div id="brxcResourcesOverlay" class="brxc-overlay__wrapper" style="opacity:0" onclick="ADMINBRXC.closeModal(event, this,'#brxcResourcesOverlay');">
    <div class="brxc-overlay__inner">
        <div class="brxc-overlay__close-btn" onClick="ADMINBRXC.closeModal(event, event.target,'#brxcResourcesOverlay')">
            <i class="bricks-svg ti-close"></i>
        </div>
        <div class="brxc-overlay__inner-wrapper">
            <div class="brxc-overlay__header">
                <h3 class="brxc-overlay__header-title">Resources</h3>
                <a href="/wp-admin/admin.php?page=bricks-advanced-themer" target="_blank">
                    <i class="fa-solid fa-up-right-from-square"></i>
                </a>
            </div>
            <div class="brxc-overlay__container">
                <div id="brxcCSSContainer" class="isotope-wrapper" data-gutter="20" data-filter-layout="masonry">
                    <div id="brxcCSSColLeft" class="brxc-overlay__col-left">
                        <div class="filterbtn-wrapper"> 
                            <div class="brxcCSSLabel filterbtn active" data-filter="*">All</div>
                            <?php
                            if ( have_rows( 'field_63d8cb65c801f', 'bricks-advanced-themer' ) ) :
                                while ( have_rows( 'field_63d8cb65c801f', 'bricks-advanced-themer' ) ) :
                                    the_row();
                                    $category = get_sub_field('field_63d8cbb7c8020', 'bricks-advanced-themer');
                                    ?>
                                    <div class="brxcCSSLabel filterbtn" data-filter="<?php echo strtolower( preg_replace( '/\s+/', '-', esc_attr($category) ) );?>"><?php echo esc_attr($category)?></div>
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
                                            <div class="isotope-selector brxc-isotope__col" data-filter="<?php echo strtolower( preg_replace( '/\s+/', '-', esc_attr($category) ) );?>" title="<?php echo esc_attr( $image['title'] ); ?>" onClick="ADMINBRXC.openInnerWindow(this.parentNode.closest('.brxc-overlay__wrapper'));ADMINBRXC.setInnerContent(this);">
                                                <?php //var_dump($image['sizes']); ?>
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
            </div>
        </div>
    </div>
    <div class="brxc-overlay__inner2">
        <div class="brxc-overlay__inner-wrapper">
            <div class="brxc-overlay__header">
                <div class="brxcCSSLabel brxc-overlay__back-btn" onClick="ADMINBRXC.openInnerWindow(this.parentNode.closest('.brxc-overlay__wrapper'));">BACK</div>
                <h3 class="brxc-overlay__header-title"></h3>
            </div>
            <div class="brxc-overlay__container">
                <div class="brxc-overlay__col-left">
                    <div class="brxc-overlay__img"></div>
                </div>
                <div class="brxc-overlay__col-right">
                    <div class="brxcCSSLabel brxc-overlay-btn__copy active" onClick="ADMINBRXC.copytoClipboard(this,this.parentNode.closest('.brxc-overlay__container').querySelector('img.inner__img').src,'URL Copied!','Copy URL to Clipboard');">Copy URL to Clipboard</div>
                    <div class="brxcCSSLabel brxc-overlay-btn__open" onClick="window.open(this.parentNode.closest('.brxc-overlay__container').querySelector('img.inner__img').src, '_blank').focus();">Open in a new tab</div>
                </div>
            </div>
        </div>
    </div>
</div>