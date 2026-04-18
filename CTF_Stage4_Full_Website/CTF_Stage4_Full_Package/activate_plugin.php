<?php
define('WP_USE_THEMES', false);
require './wp-load.php';

echo "Activating plugin...\n";
$result = activate_plugin('ctf-vulnerable-plugin/pharmacy-plugin.php');

if (is_wp_error($result)) {
    echo "Error: " . $result->get_error_message() . "\n";
} else {
    echo "Plugin activated successfully!\n";
}

// Verify
global $wp_filter;
$count = 0;
foreach ($wp_filter as $hook => $data) {
    if (strpos($hook, 'pharmacy') !== false) {
        echo "  Hook found: $hook\n";
        $count++;
    }
}

echo "Total pharmacy hooks: $count\n";

$active = get_option('active_plugins');
echo "Active plugins: ";
print_r($active);
?>
