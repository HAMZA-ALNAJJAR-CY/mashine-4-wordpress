<?php
/**
 * Pharmacy Plugin Persistence Script
 * Ensures the vulnerable plugin remains active after container restarts
 * Place this in wp-content/mu-plugins/ or hook into WordPress boot
 */

// Add to WordPress hooks to ensure plugin loads
add_action('plugins_loaded', function() {
    // If plugin not active, ensure it loads its functions
    if (!is_plugin_active('ctf-vulnerable-plugin/pharmacy-plugin.php')) {
        // Load the plugin file directly
        $plugin_file = WP_PLUGIN_DIR . '/ctf-vulnerable-plugin/pharmacy-plugin.php';
        if (file_exists($plugin_file)) {
            require_once $plugin_file;
        }
    }
}, 1);

// Also ensure it's in the active_plugins list
add_action('init', function() {
    $active_plugins = get_option('active_plugins', array());
    $plugin = 'ctf-vulnerable-plugin/pharmacy-plugin.php';
    
    if (!in_array($plugin, $active_plugins)) {
        $active_plugins[] = $plugin;
        update_option('active_plugins', $active_plugins);
    }
}, 1);
?>
