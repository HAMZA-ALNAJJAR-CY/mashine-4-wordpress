<?php
/**
 * Pharmacy Theme
 * A custom WordPress theme for the Secret Pharmacy CTF challenge
 */

// Theme setup
add_action('after_setup_theme', 'pharmacy_theme_setup');
function pharmacy_theme_setup() {
    // Add title tag support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    
    // Register menus
    register_nav_menu('primary', 'Primary Menu');
}

// Enqueue styles
add_action('wp_enqueue_scripts', 'pharmacy_enqueue_styles');
function pharmacy_enqueue_styles() {
    wp_enqueue_style('pharmacy-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('pharmacy-custom', get_template_directory_uri() . '/custom.css');
    wp_enqueue_script('pharmacy-script', get_template_directory_uri() . '/js/pharmacy.js', array(), '1.0', true);
}

// Add custom logo support
add_theme_support('custom-logo');

// Register sidebar
add_action('widgets_init', 'pharmacy_widgets_init');
function pharmacy_widgets_init() {
    register_sidebar(array(
        'name' => 'Right Sidebar',
        'id' => 'right-sidebar',
        'description' => 'Right sidebar widget area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

// Custom header color
add_action('wp_head', 'pharmacy_custom_header');
function pharmacy_custom_header() {
    ?>
    <style>
    :root {
        --pharmacy-green: #1a7f5a;
        --pharmacy-light-green: #2a9f6f;
        --pharmacy-dark: #0d4a3a;
        --pharmacy-accent: #e74c3c;
        --pharmacy-light: #ecf0f1;
        --pharmacy-text: #2c3e50;
    }
    </style>
    <?php
}
?>
