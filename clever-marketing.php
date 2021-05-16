<?php
/**
 *
 * @wordpress-plugin
 * Plugin Name:       Clever MArketing
 * Plugin URI:        https://github.com/danielpringle
 * Description:       Task for Clever Marketing
 * Version:           1.0.0
 * Author:            Dan Pringle
 * Author URI:        https://www.danielpringle.co.uk
 * Text Domain:       clever-marketing
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/danielpringle
 * Requires PHP:      5.6
 * Requires WP:       4.9
 *
 * WC requires at least: 3.3.0
 * WC tested up to: 3.6.4
 **/
namespace dpuk\cleverMarketing;

if ( ! defined( 'ABSPATH' ) ) {
		exit( 'Cheatin&#8217; uh?' );
}
/**
 * Define the plugin's global constants.
 *
 * @since 1.0.0
 *
 * @return void
 */
function init_constants() {
	$plugin_url = plugin_dir_url( __FILE__ );
	if ( is_ssl() ) {
		$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
	}
	$constant_name_prefix = 'temp_';
	$plugin_prefix        = 'temp';
	$plugin_data          = get_file_data(
		__FILE__,
		array(
			'name'    => 'Plugin Name',
			'version' => 'Version',
			'text'    => 'Text Domain',
		)
	);


	defined( $constant_name_prefix . 'DIR' ) || define( $constant_name_prefix . 'DIR', dirname( plugin_basename( __FILE__ ) ) );
	defined( $constant_name_prefix . 'BASE' ) || define( $constant_name_prefix . 'BASE', plugin_basename( __FILE__ ) );
	defined( $constant_name_prefix . 'URL' ) || define( $constant_name_prefix . 'URL', $plugin_url );
	defined( $constant_name_prefix . 'PATH' ) || define( $constant_name_prefix . 'PATH', plugin_dir_path( __FILE__ ) );
	defined( $constant_name_prefix . 'SLUG' ) || define( $constant_name_prefix . 'SLUG', dirname( plugin_basename( __FILE__ ) ) );
	defined( $constant_name_prefix . 'NAME' ) || define( $constant_name_prefix . 'NAME', $plugin_data['name'] );
	defined( $constant_name_prefix . 'VERSION' ) || define( $constant_name_prefix . 'VERSION', $plugin_data['version'] );
	defined( $constant_name_prefix . 'TEXT' ) || define( $constant_name_prefix . 'TEXT', $plugin_data['text'] );
	defined( $constant_name_prefix . 'PREFIX' ) || define( $constant_name_prefix . 'PREFIX', $constant_name_prefix );
	defined( $constant_name_prefix . 'SETTINGS' ) || define( $constant_name_prefix . 'SETTINGS', $plugin_data['text'] );
}
/**
 * Autoload the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function autoload_files() {
	$files = array(// add the list of files to load here.
		'asset-loader.php',
	);
	foreach ( $files as $file ) {
		require __DIR__ . '/includes/' . $file;
	}
}

/**
 * Launch the plugin.
 *
 * @since 1.0.0
 *
 * @return void
 */
function launch() {
	init_constants();
	autoload_files();
}

launch();
