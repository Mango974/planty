<?php
/**
 *
 * @package   Advanced Themer for Bricks
 * @author    Maxime Beguin
 * @copyright 2022 Maxime Beguin
 * @license   GPL-2.0-or-later
 *
 * Plugin Name: Advanced Themer for Bricks
 * Description: Advanced Themer levels up your efficiency in building websites with Bricks thanks to dozens of productivity hacks designed to facilitate your development process.
 * Plugin URI:  https://advancedthemer.com/
 * Author:      Maxime Beguin
 * Author URI:  https://advancedthemer.com/
 * Created:     01.12.2021
 * Version:     1.0.4
 * Text Domain: bricks-advanced-themer
 * Domain Path: /lang
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * Copyright (C) 2022 Maxime Beguin
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <http://www.gnu.org/licenses/>.
 */

defined('ABSPATH') || die();

$theme = wp_get_theme(); // gets the current theme

if ( defined('BRICKS_ADVANCED_THEMER_PLUGIN_FILE') || ('Bricks' != $theme->name && 'Bricks' != $theme->parent_theme ) ) {
    
    return;

}

const BRICKS_ADVANCED_THEMER_PLUGIN_FILE = __FILE__;

if (!class_exists('Advanced_Themer_Bricks\AT__Plugin_Updater')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/EDD_SL_Plugin_Updater.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__license')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/license.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__Helpers')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/helpers.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__ACF')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/acf.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__Admin')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/admin.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__Global_Colors')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/global_colors.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__Global_Variables')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/global_variables.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__Grid_Builder')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/global_grid_builder.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__Class_Importer')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/class_importer.php';
}

if (!class_exists('Advanced_Themer_Bricks\AT__Frontend')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/frontend.php';
}
if (!class_exists('Advanced_Themer_Bricks\AT__Builder')) {
    require_once plugin_dir_path( __FILE__ ) . 'classes/builder.php';
}

require_once __DIR__ . '/start.php';
