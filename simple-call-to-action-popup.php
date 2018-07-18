<?php
/*
Plugin Name: Simple CallToAction PopUp
Plugin URI: https://dev-it.com.ua
Description: Simple plugin for call to action popup
Version: 0.2.1
Author: Nikita Dudarev
Author URI: https://dev-it.com.ua
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: simple-calltoaction-popup
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'SIMPLECALL_PATH' ) ) {
	define( 'SIMPLECALL_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'SIMPLECALL_URL' ) ) {
	define( 'SIMPLECALL_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'SIMPLECALL_PLUGIN_BASENAME' ) ) {
	define( 'SIMPLECALL_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

require SIMPLECALL_PATH . 'includes/classes/config.class.php';
require SIMPLECALL_PATH . 'includes/bootstrap.class.php';