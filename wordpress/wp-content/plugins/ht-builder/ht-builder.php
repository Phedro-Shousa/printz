<?php 
/**
 * Plugin Name: HT Builder
 * Description: HT Builder is a elementor addons package for Elementor page builder plugin for WordPress.
 * Plugin URI:  https://hasthemes.com/plugins/
 * Author:      HasThemes
 * Author URI:  http://hasthemes.com/
 * Version:     1.0.6
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ht-builder
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'HTBUILDER_VERSION', '1.0.6' );
define( 'HTBUILDER_PL_URL', plugins_url( '/', __FILE__ ) );
define( 'HTBUILDER_PL_PATH', plugin_dir_path( __FILE__ ) );
define( 'HTBUILDER_PL_ROOT', __FILE__ );
define( 'HTBUILDER_PLUGIN_BASE', plugin_basename( HTBUILDER_PL_ROOT ) );

// Required File
require( HTBUILDER_PL_PATH.'includes/base.php' );