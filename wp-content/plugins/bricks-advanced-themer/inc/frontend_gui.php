<?php

if (!defined('ABSPATH')) { die();
}

if (isset( $field ) ){
    $json = (array) json_decode($field);
} else {
    $json = false;
}

$args = array(
    'post_type'      => 'brxc_color_palette',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
);

$query = new WP_Query($args);

?>
<div class="brxc-modal__overlay">
    <div class="brxc-modal__export-modal">
        <?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/components/export.php';?>
        <div class="brxc-export__close-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="m12.45 37.65-2.1-2.1L21.9 24 10.35 12.45l2.1-2.1L24 21.9l11.55-11.55 2.1 2.1L26.1 24l11.55 11.55-2.1 2.1L24 26.1Z"/></svg></div>
    </div>
</div>
<div class="brxc-modal__button">
    <span class="brxc-modal__icon icon-setting">
        <i></i>
	</span>
</div>

<div class="brxc-modal no-transition-on-load">
    <div class="brxc-modal__menu">
        <?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/components/vert_menu.php';?>
    </div>
    <?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/components/header_buttons.php';?>
    <div class="brxc-modal__main">
        <div class="brxc-modal__inner">
            <div class="brxc-modal__lab">
                <div class="brxc-modal__inner--header">Color Lab</div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/color_lab.php';?></div>
            </div>
            <div class="brxc-modal__convertor">
                <div class="brxc-modal__inner--header">Color Convertor</div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/color_convertor.php';?></div>
            </div>
            <div class="brxc-modal__scale">
                <div class="brxc-modal__inner--header">Color Scale Generator</div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/color_scale.php';?></div>
            </div>
            <div class="brxc-modal__generator">
                <div class="brxc-modal__inner--header">Color Palette Generator</div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/cp_generator.php';?></div>
            </div>
            <div class="brxc-modal__popular">
                <div class="brxc-modal__inner--header">Popular Palettes</div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/popular_palettes.php';?></div>
            </div>
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__light">
                <div class="brxc-modal__inner--header">Light Colors</div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/light_panel.php';?></div>
            </div>
            <div class="brxc-modal__dark">
                <div class="brxc-modal__inner--header">Dark Colors</div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/dark_panel.php';?></div>
            </div>
            <?php endif?>
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('typography', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__typography">
                <div class="brxc-modal__inner--header">Typography</div>
                <div class="brxc-modal__inner--search-box">
                    <input type="search" class="iso-search" name="typography-search" placeholder="Type here to filter">
                </div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/typography.php';?></div>
            </div>
            <?php endif?>
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('spacing', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__spacing">
                <div class="brxc-modal__inner--header">Spacing</div>
                <div class="brxc-modal__inner--search-box">
                    <input type="search" class="iso-search" name="spacing-search" placeholder="Type here to filter">
                </div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/spacing.php';?></div>
            </div>
            <?php endif?>
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('border-radius', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__spacing">
                <div class="brxc-modal__inner--header">Border-Radius</div>
                <div class="brxc-modal__inner--search-box">
                    <input type="search" class="iso-search" name="border-search" placeholder="Type here to filter">
                </div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/border.php';?></div>
            </div>
            <?php endif?>
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('custom-variables', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__misc">
                <div class="brxc-modal__inner--header">Misc</div>
                <div class="brxc-modal__inner--search-box">
                    <input type="search" class="iso-search" name="misc-search" placeholder="Type here to filter">
                </div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/misc.php';?></div>
            </div>
            <?php endif?>
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('grids', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__grids">
                <div class="brxc-modal__inner--header">Grids</div>
                <div class="brxc-modal__inner--search-box">
                    <input type="search" class="iso-search" name="grids-search" placeholder="Type here to filter">
                </div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/grids.php';?></div>
            </div>
            <?php endif?>
            <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('class-importer', $brxc_acf_fields['theme_settings_tabs'])) :?>
            <div class="brxc-modal__classes">
                <div class="brxc-modal__inner--header">Imported Classes</div>
                <div class="brxc-modal__inner--search-box">
                    <input type="search" class="iso-search" name="classes-search" placeholder="Type here to filter">
                </div>
                <div class="brxc-modal__inner--content"><?php include_once BRICKS_ADVANCED_THEMER_PATH . '/inc/panels/imported_classes.php';?></div>
            </div>
            <?php endif?>
        </div>
    </div>
</div><?php 

wp_reset_postdata();