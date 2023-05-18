<?php

if (!defined('ABSPATH')) { die();
}
$i = 5;
?>
<div class="brxc-modal__menu-wrapper">
<?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('color-palettes', $brxc_acf_fields['theme_settings_tabs'])) :?>
    <div class="brxc-modal__menu-item color active" data-balloon="Colors" data-balloon-pos="right" onClick="document.querySelector('.brxc-modal__inner').style.transform = '';">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M4.5 48v-7h39v7ZM11 34 22 6h4l11 28h-3.75l-2.85-7.5H17.6L14.75 34Zm7.8-10.7h10.4L24.1 9.75h-.2Z"/></svg>
    </div>
    <?php $i++; $i++; endif;?>
    <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('typography', $brxc_acf_fields['theme_settings_tabs'])) :?>
    <div class="brxc-modal__menu-item transformable typography" data-transform="-<?php echo $i; $i++;?>" data-balloon="Typography" data-balloon-pos="right">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M28.5 40V13H18V8h26v5H33.5v27Zm-18 0V23H4v-5h18v5h-6.5v17Z"/></svg>
    </div>
    <?php endif;?>
    <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('spacing', $brxc_acf_fields['theme_settings_tabs'])) :?>
    <div class="brxc-modal__menu-item transformable spacing" data-transform="-<?php echo $i; $i++;?>" data-balloon="Spacing" data-balloon-pos="right">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M6 40v-1.5h36V40Zm0-4.5v-3h36v3Zm0-6V25h36v4.5ZM6 22V8h36v14Z"/></svg>
    </div>
    <?php endif;?>
    <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('border-radius', $brxc_acf_fields['theme_settings_tabs'])) :?>
    <div class="brxc-modal__menu-item transformable spacing" data-transform="-<?php echo $i; $i++;?>" data-balloon="Border-Radius" data-balloon-pos="right">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M6 42V6h36v36Zm3-3h30V9H9Zm5.25-13.5v-3h3v3Zm8.25 8.25v-3h3v3Zm0-8.25v-3h3v3Zm0-8.25v-3h3v3Zm8.25 8.25v-3h3v3Z"/></svg>
    </div>
    <?php endif;?>
    <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('custom-variables', $brxc_acf_fields['theme_settings_tabs'])) :?>
    <div class="brxc-modal__menu-item transformable misc" data-transform="-<?php echo $i; $i++;?>" data-balloon="Misc" data-balloon-pos="right">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="m16.15 37.75 7.85-4.7 7.85 4.75-2.1-8.9 6.9-6-9.1-.8L24 13.7l-3.55 8.35-9.1.8 6.9 6ZM11.65 44l3.25-14.05L4 20.5l14.4-1.25L24 6l5.6 13.25L44 20.5l-10.9 9.45L36.35 44 24 36.55ZM24 26.25Z"/></svg>
    </div>
    <?php endif;?>
    <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('grids', $brxc_acf_fields['theme_settings_tabs'])) :?>
    <div class="brxc-modal__menu-item transformable misc" data-transform="-<?php echo $i; $i++;?>" data-balloon="Grids" data-balloon-pos="right">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M6 22.5V6h16.5v16.5ZM6 42V25.5h16.5V42Zm19.5-19.5V6H42v16.5Zm0 19.5V25.5H42V42ZM9 19.5h10.5V9H9Zm19.5 0H39V9H28.5Zm0 19.5H39V28.5H28.5ZM9 39h10.5V28.5H9Zm19.5-19.5Zm0 9Zm-9 0Zm0-9Z"/></svg>
    </div>
    <?php endif;?>
    <?php if(isset($brxc_acf_fields['theme_settings_tabs']) && !empty($brxc_acf_fields['theme_settings_tabs']) && is_array($brxc_acf_fields['theme_settings_tabs']) && in_array('class-importer', $brxc_acf_fields['theme_settings_tabs'])) :?>
    <div class="brxc-modal__menu-item transformable misc" data-transform="-<?php echo $i; $i++;?>" data-balloon="Classes" data-balloon-pos="right">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="brxc__svg-path"><path d="M28.5 40v-3h6q1.05 0 1.775-.725Q37 35.55 37 34.5v-5q0-1.85 1.125-3.3 1.125-1.45 2.875-2v-.4q-1.75-.5-2.875-1.975T37 18.5v-5q0-1.05-.725-1.775Q35.55 11 34.5 11h-6V8h6q2.3 0 3.9 1.6t1.6 3.9v5q0 1.05.725 1.775Q41.45 21 42.5 21H44v6h-1.5q-1.05 0-1.775.725Q40 28.45 40 29.5v5q0 2.3-1.6 3.9T34.5 40Zm-15 0q-2.3 0-3.9-1.6T8 34.5v-5q0-1.05-.725-1.775Q6.55 27 5.5 27H4v-6h1.5q1.05 0 1.775-.725Q8 19.55 8 18.5v-5q0-2.3 1.6-3.9T13.5 8h6v3h-6q-1.05 0-1.775.725Q11 12.45 11 13.5v5q0 1.85-1.125 3.325T7 23.8v.4q1.75.55 2.875 2T11 29.5v5q0 1.05.725 1.775Q12.45 37 13.5 37h6v3Z"/></svg>
    </div>
    <?php endif;?>
</div>
