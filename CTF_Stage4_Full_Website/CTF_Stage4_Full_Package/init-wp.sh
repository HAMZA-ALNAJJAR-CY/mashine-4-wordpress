#!/bin/bash

# Initialize WordPress database and setup
echo "🔧 Initializing Pharmacy WordPress Setup..."

# Wait for MySQL to be ready
sleep 10

# Create wp-config.php with some hints embedded
cat > /var/www/html/wp-config.php <<'EOF'
<?php
/**
 * The base configuration for WordPress
 */

// ** MySQL settings - CTF Challenge Stage 4 ** //
define('DB_NAME', 'wordpress');
define('DB_USER', 'wp_user');
define('DB_PASSWORD', 'wp_password_123');
define('DB_HOST', 'mysql:3306');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

// ** Authentication Unique Keys and Salts. ** //
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

// ** WordPress Database Table prefix. ** //
$table_prefix = 'wp_';

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', '/var/www/html/wp-content/debug.log');
define('WP_DEBUG_DISPLAY', false);

// CTF Hint: Sensitive data often lives here
// Stage 4 Flag hints stored in plugin config

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
EOF

chmod 644 /var/www/html/wp-config.php

echo "✅ WordPress initialized!"
