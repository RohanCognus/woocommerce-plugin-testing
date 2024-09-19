<?php
// Path to the WordPress codebase you want to test.
$table_prefix  = 'wptests_';
define( 'ABSPATH', dirname( dirname( __FILE__ ) ) . '/c/xampp/tmp/wordpress/' );

// Test database credentials.
define( 'DB_NAME', 'wordpress_test' ); // Name of the test database.
define( 'DB_USER', 'root' );           // Your MySQL username.
define( 'DB_PASSWORD', '' );           // Your MySQL password (leave empty if none).
define( 'DB_HOST', 'localhost' );      // Database host (typically 'localhost').

// Test table prefix.
define( 'WP_TESTS_TABLE_PREFIX', 'wptests_' );

// Use the default theme for WordPress.
define( 'WP_DEFAULT_THEME', 'twentytwentyone' );

// Debug mode.
define( 'WP_DEBUG', true );

// Skip the installation process if the database is already installed.
define( 'WP_TESTS_SKIP_INSTALL', false );

define( 'WP_TESTS_DOMAIN', 'localhost' );
define( 'WP_TESTS_EMAIL', 'admin@localhost.dev' );
define( 'WP_TESTS_TITLE', 'Test WordPress Site' );
define( 'WP_PHP_BINARY', 'php' );
// Tell WordPress to look for the test environment.
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';
