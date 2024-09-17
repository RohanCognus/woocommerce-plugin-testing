<?php
// Path to the WordPress root directory
$_tests_dir = 'C:/xampp/htdocs/wordpress/wp-content/plugins/woocommerce/wordpress-tests-lib';

// Include the WordPress test environment
require_once $_tests_dir . '/includes/functions.php';

// Manually load the WooCommerce plugin
function _manually_load_plugin() {
    require dirname( dirname( __FILE__ ) ) . '/woocommerce.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment
require $_tests_dir . '/includes/bootstrap.php';
