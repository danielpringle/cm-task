<?php
/**
 * Load the plugin assets.
 *
 * @package     dpuk\cleverMarketing
 * @since       1.0.0
 * @author      Dan Pringle
 * @link        https://www.danielpringle.co.uk
 * @license     GNU General Public License 2.0+
 */
namespace dpuk\cleverMarketing;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\clever_theme_name_scripts' );
/**
 * Enqueue the plugin scripts and styles
 */
function clever_theme_name_scripts() {

	if ( is_page( 'Clever Marketing' ) ) {
	$plugin_main_styles = temp_URL . 'assets/css/clever-marketing.min.css';
	wp_enqueue_style( temp_TEXT, esc_url( $plugin_main_styles ), array(), temp_VERSION, 'all' );
	}
}

add_filter( 'page_template',  __NAMESPACE__ . '\clever_page_template' );
function clever_page_template( $page_template )
{
    if ( is_page( 'Clever Marketing' ) ) {
        $page_template = temp_PATH . 'includes/theme-templates/template.php';
    }
    return $page_template;
}
