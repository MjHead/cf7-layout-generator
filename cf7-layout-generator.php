<?php
/**
 * Plugin Name: CF7 Layout Generator
 * Plugin URI:
 * Description:
 * Version:     1.0.0
 * Author:      Zemez
 * Author URI:
 * Text Domain:
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

define( 'CFLG_VERSION', time() );

define( 'CFLG__FILE__', __FILE__ );
define( 'CFLG_PATH', trailingslashit( plugin_dir_path( CFLG__FILE__ ) ) );
define( 'CFLG_URL', plugins_url( '/', CFLG__FILE__ ) );

require CFLG_PATH . 'includes/plugin.php';

add_action( 'after_setup_theme', array( 'CFLG_Plugin', 'get_instance' ) );
