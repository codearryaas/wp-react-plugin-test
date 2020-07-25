<?php
/**
 * Plugin Name: WP React Plugin Test
 * Plugin URI: https://racase.com.np/
 * Description: A test pluing to teach React on WordPress
 * Version: 1.0.0
 * Author: Rakesh Lawaju
 * Author URI: https://racase.com.np/
 * Text Domain: wp-react-plugin-test
 * Domain Path: /i18n/languages/
 * Requires at least: 5.2
 * Requires PHP: 7.0
 *
 * @package WP React Plugin Test
 */

defined( 'ABSPATH' ) || exit;

define( 'WP_REACT_PLUGIN_TEST_PLUGIN_FILE', __FILE__ );
define( 'WP_REACT_PLUGIN_TEST_ABSPATH', dirname( __FILE__ ) . '/' );
define( 'WP_REACT_PLUGIN_TEST_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'WP_REACT_PLUGIN_TEST_PLUGIN_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WP_REACT_PLUGIN_TEST_VERSION', '1.0.0' );

/**
 * Register a custom menu page.
 */
function wp_react_plugin_test_register_custom_menu_page() {
    add_menu_page(
        __( 'Book Management System' ),
        __( 'Books' ),
        'manage_options',
        'wp-react-plugin-test',
        'wp_react_plugin_test_register_custom_menu_page_cb',
        'dashicons-book-alt',
        6
    );
}
add_action( 'admin_menu', 'wp_react_plugin_test_register_custom_menu_page' );

function wp_react_plugin_test_register_custom_menu_page_cb() {
    echo "<div id='wp-react-plugin-test-app'></div>";
}


add_action( 'admin_enqueue_scripts', 'wp_react_plugin_test_assets' );

function wp_react_plugin_test_assets() {
    $screen         = get_current_screen();
    if( ! empty( $screen->base ) && 'toplevel_page_wp-react-plugin-test' === $screen->base ) {
        $deps = include_once 'app/build/admin.asset.php';
        wp_enqueue_script( 'wp-react-admin-script', plugin_dir_url( WP_REACT_PLUGIN_TEST_PLUGIN_FILE ) . '/app/build/admin.js', $deps['dependencies'], $deps['version'], true );
    
        wp_enqueue_style( 'wp-react-admin-style', plugin_dir_url( WP_REACT_PLUGIN_TEST_PLUGIN_FILE ) . '/app/build/admin.css', array( 'wp-components' ), $deps['version'] );
    }
}