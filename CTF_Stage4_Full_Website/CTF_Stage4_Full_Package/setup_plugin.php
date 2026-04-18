<?php
define('WP_USE_THEMES', false);
require './wp-load.php';

// Fix the active_plugins option - create proper array
$plugins = array('ctf-vulnerable-plugin/pharmacy-plugin.php');
update_option('active_plugins', $plugins);

echo "Active plugins set to: ";
print_r(get_option('active_plugins'));

// Now manually load the plugin since it's "activated"
require_once WP_PLUGIN_DIR . '/ctf-vulnerable-plugin/pharmacy-plugin.php';

echo "Plugin file loaded!\n";

// Verify hooks
global $wp_filter;
$count = 0;
foreach ($wp_filter as $hook => $data) {
    if (strpos($hook, 'pharmacy') !== false) {
        echo "✓ Hook registered: $hook\n";
        $count++;
    }
}

echo "Total pharmacy hooks: $count\n";
?>
