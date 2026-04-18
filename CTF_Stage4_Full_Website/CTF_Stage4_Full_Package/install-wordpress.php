<?php
/**
 * WordPress Installation Script for CTF
 */

// Set up environment
define('WP_INSTALLING', true);
$_SERVER['HTTP_HOST'] = 'localhost';
$_SERVER['SCRIPT_NAME'] = '/index.php';

// Load WordPress
require '/var/www/html/wp-load.php';

// Create WordPress tables
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

// Install WordPress
wp_install(
    'Secret Pharmacy Inventory System',  // blog title
    'admin',                              // username
    'admin@pharmacy.local',               // email
    true                                  // is_public
);

// Set admin password
$user = new WP_User(1);
wp_set_password('admin', 1);

// Update options
update_option('blogdescription', 'CTF Challenge Stage 4');
update_option('siteurl', 'http://localhost');
update_option('home', 'http://localhost');

// Create CTF flag post
$post_id = wp_insert_post(array(
    'post_title' => 'CTF Stage 4 - Challenge Info',
    'post_content' => "Stage 4 Flag: CTF{wordpress_rce_exploitation}\n\nHints:\n1. Find the vulnerable plugin\n2. Exploit AJAX endpoint\n3. Achieve RCE\n4. Extract credentials for Stage 5",
    'post_status' => 'publish',
    'post_type' => 'post',
));

// Create plugin directory with plugin file
if (!is_dir(WP_CONTENT_DIR . '/plugins/ctf-vulnerable-plugin')) {
    mkdir(WP_CONTENT_DIR . '/plugins/ctf-vulnerable-plugin', 0755, true);
}

// Activate plugin
// (it will activate on its own when accessed)

echo "✅ WordPress installation complete!\n";
echo "✅ Admin user created: admin / admin\n";
echo "✅ Blog URL: http://localhost\n";
echo "✅ Post created with Stage 4 info\n";
?>
