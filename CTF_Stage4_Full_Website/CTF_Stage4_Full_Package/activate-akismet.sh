#!/bin/bash
# Auto-activate Akismet plugin on container start

cd /var/www/html

# Wait for WordPress to be ready
sleep 3

# Activate Akismet plugin via WP-CLI or PHP
php -r "
define('WP_USE_THEMES', false);
require('/var/www/html/wp-blog-header.php');

// Ensure Akismet is the active plugin
\$plugins = array('akismet/akismet.php');
update_option('active_plugins', \$plugins);

echo 'Akismet activated for CTF challenge\n';
"
