<?php

// Path to the WordPress root directory
$_tests_dir = 'C:/xampp/htdocs/wordpress/wp-content/plugins/woocommerce/wordpress-tests-lib';  // Set your correct path here

if ( ! $_tests_dir ) {
    $_tests_dir = 'C:/xampp/htdocs/wordpress/wp-content/plugins/woocommerce/wordpress-tests-lib';  // Adjust this path as per your environment
}

// Include the WordPress test environment
// require_once $_tests_dir . '/includes/functions.php';
require_once dirname( __FILE__ ) . '/../wordpress-tests-lib/includes/functions.php';



 // Manually load the WooCommerce plugin for testing
function _manually_load_woocommerce_plugin() {
    require dirname( dirname( __FILE__ ) ) . '/woocommerce.php';  // Ensure the path to your main plugin file is correct
}
tests_add_filter( 'muplugins_loaded', '_manually_load_woocommerce_plugin' );

// Start up the WordPress testing environment
require $_tests_dir . '/includes/bootstrap.php';
