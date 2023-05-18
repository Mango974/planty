<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style( 'theme-style', get_stylesheet_uri() . 'css/theme.css',  array(),
  filemtime(get_stylesheet_directory() . '/css/theme.css'));
}
function add_admin_link_to_menu( $items, $args ) {
    if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
        $items .= '<li><a href="' . admin_url() . '">' . __("Admin") . '</a></li>';
    }
    $items .= '<li><a href="' . get_page_link(11 ) . '">' . __("Commander") . '</a></li>';

    return $items;
}
add_filter( 'wp_nav_menu_items', 'add_admin_link_to_menu', 10, 2 );
