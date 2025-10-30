<?php
/**
 * Debug Events Functionality
 * 
 * This file helps debug events issues
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Debug function to check events
 */
function debug_events_functionality() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    echo '<div style="background: #f0f0f0; padding: 20px; margin: 20px 0; border: 1px solid #ccc;">';
    echo '<h3>Events Debug Information</h3>';
    
    // Check if events post type exists
    $post_types = get_post_types(array('public' => true), 'names');
    echo '<p><strong>Event post type exists:</strong> ' . (in_array('event', $post_types) ? 'Yes' : 'No') . '</p>';
    
    // Check if ACF is active
    echo '<p><strong>ACF Plugin active:</strong> ' . (function_exists('get_field') ? 'Yes' : 'No') . '</p>';
    
    // Check events count
    $events_count = wp_count_posts('event');
    echo '<p><strong>Published events:</strong> ' . $events_count->publish . '</p>';
    echo '<p><strong>Draft events:</strong> ' . $events_count->draft . '</p>';
    
    // Check if we have any events with ACF fields
    $events_with_dates = get_posts(array(
        'post_type' => 'event',
        'posts_per_page' => 5,
        'meta_query' => array(
            array(
                'key' => 'event_start_date',
                'compare' => 'EXISTS'
            )
        )
    ));
    
    echo '<p><strong>Events with start dates:</strong> ' . count($events_with_dates) . '</p>';
    
    if (!empty($events_with_dates)) {
        echo '<h4>Sample Event Data:</h4>';
        foreach ($events_with_dates as $event) {
            $start_date = get_field('event_start_date', $event->ID);
            $end_date = get_field('event_end_date', $event->ID);
            $location = get_field('event_location', $event->ID);
            
            echo '<div style="background: white; padding: 10px; margin: 10px 0; border: 1px solid #ddd;">';
            echo '<strong>' . $event->post_title . '</strong><br>';
            echo 'Start Date: ' . ($start_date ? $start_date : 'Not set') . '<br>';
            echo 'End Date: ' . ($end_date ? $end_date : 'Not set') . '<br>';
            echo 'Location: ' . ($location ? $location : 'Not set') . '<br>';
            echo '</div>';
        }
    }
    
    // Test query
    $test_query = new WP_Query(array(
        'post_type' => 'event',
        'posts_per_page' => 3,
        'meta_key' => 'event_start_date',
        'orderby' => 'meta_value',
        'order' => 'ASC'
    ));
    
    echo '<p><strong>Test query results:</strong> ' . $test_query->found_posts . ' events found</p>';
    
    echo '</div>';
}

// Add debug info to admin
add_action('admin_notices', 'debug_events_functionality');

/**
 * Add debug shortcode
 */
function debug_events_shortcode($atts) {
    if (!current_user_can('manage_options')) {
        return 'Debug information only available to administrators.';
    }
    
    ob_start();
    debug_events_functionality();
    return ob_get_clean();
}
add_shortcode('debug_events', 'debug_events_shortcode');
?>
