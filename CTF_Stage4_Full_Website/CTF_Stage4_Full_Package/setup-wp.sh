#!/bin/bash
# Setup WordPress programmatically

set -e

cd /var/www/html

# Wait for database
echo "⏳ Waiting for database to be ready..."
sleep 5

# Try creating wp-config if it doesn't exist properly
if ! grep -q "DB_NAME" wp-config.php 2>/dev/null; then
    echo "Creating wp-config.php..."
    cat > wp-config.php <<'WPCONFIG'
<?php
define('DB_NAME', 'wordpress');
define('DB_USER', 'wp_user');
define('DB_PASSWORD', 'wp_password_123');
define('DB_HOST', 'mysql:3306');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');

define('AUTH_KEY',         'pharmacy_auth_key_2025');
define('SECURE_AUTH_KEY',  'pharmacy_secure_key_2025');
define('LOGGED_IN_KEY',    'pharmacy_logged_in_key');
define('NONCE_KEY',        'pharmacy_nonce_key_2025');
define('AUTH_SALT',        'pharmacy_auth_salt_2025');
define('SECURE_AUTH_SALT', 'pharmacy_secure_salt_2025');
define('LOGGED_IN_SALT',   'pharmacy_logged_in_salt');
define('NONCE_SALT',       'pharmacy_nonce_salt_2025');

$table_prefix = 'wp_';

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', '/var/www/html/wp-content/debug.log');
define('WP_DEBUG_DISPLAY', false);

if (!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');
WPCONFIG
fi

# Create uploads directory with proper permissions
mkdir -p /var/www/html/wp-content/uploads/exports
chmod 777 /var/www/html/wp-content/uploads
chmod 777 /var/www/html/wp-content/uploads/exports

# Create plugin directory
mkdir -p /var/www/html/wp-content/plugins/ctf-vulnerable-plugin
chmod 755 /var/www/html/wp-content/plugins/ctf-vulnerable-plugin

# Set permissions
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

echo "✅ Setup complete!"
