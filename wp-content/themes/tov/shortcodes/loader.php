<?php
/**
 * Shortcodes Loader
 * 
 * This file loads all shortcode files from the shortcodes directory.
 * Add new shortcode files here to automatically include them.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Get the shortcodes directory path
$shortcodes_dir = get_template_directory() . '/shortcodes/';

// Array of shortcode files to load
$shortcode_files = array(
    'welcome-slider.php',
    'image-section.php',
    'text-section.php',
);

// Load each shortcode file
foreach ($shortcode_files as $file) {
    $file_path = $shortcodes_dir . $file;
    
    if (file_exists($file_path)) {
        require_once $file_path;
    } else {
        // Log error if file doesn't exist (for debugging)
        error_log("Shortcode file not found: " . $file_path);
    }
}

/**
 * Optional: Add shortcode-related hooks or filters here
 */

// Example: Disable wpautop for shortcodes (prevents extra <p> tags)
// add_filter('the_content', 'shortcode_unautop');

// Example: Enable shortcodes in widgets
// add_filter('widget_text', 'do_shortcode');
