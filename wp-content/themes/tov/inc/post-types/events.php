<?php
/**
 * Register Events Custom Post Type
 */

if (!defined('ABSPATH')) exit;

function tov_register_events_post_type() {
    $labels = array(
        'name'               => _x('Events', 'post type general name', 'tov'),
        'singular_name'      => _x('Event', 'post type singular name', 'tov'),
        'menu_name'          => _x('Events', 'admin menu', 'tov'),
        'name_admin_bar'     => _x('Event', 'add new on admin bar', 'tov'),
        'add_new'           => _x('Add New', 'event', 'tov'),
        'add_new_item'      => __('Add New Event', 'tov'),
        'new_item'          => __('New Event', 'tov'),
        'edit_item'         => __('Edit Event', 'tov'),
        'view_item'         => __('View Event', 'tov'),
        'all_items'         => __('All Events', 'tov'),
        'search_items'      => __('Search Events', 'tov'),
        'not_found'         => __('No events found.', 'tov'),
        'not_found_in_trash'=> __('No events found in Trash.', 'tov')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'events'),
        'capability_type'   => 'post',
        'has_archive'       => true,
        'hierarchical'      => false,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-calendar-alt',
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'      => true,
    );

    register_post_type('event', $args);

    // Register Event Category Taxonomy
    $cat_labels = array(
        'name'              => _x('Event Categories', 'taxonomy general name', 'tov'),
        'singular_name'     => _x('Event Category', 'taxonomy singular name', 'tov'),
        'search_items'      => __('Search Event Categories', 'tov'),
        'all_items'         => __('All Event Categories', 'tov'),
        'parent_item'       => __('Parent Event Category', 'tov'),
        'parent_item_colon' => __('Parent Event Category:', 'tov'),
        'edit_item'         => __('Edit Event Category', 'tov'),
        'update_item'       => __('Update Event Category', 'tov'),
        'add_new_item'      => __('Add New Event Category', 'tov'),
        'new_item_name'     => __('New Event Category Name', 'tov'),
        'menu_name'         => __('Categories', 'tov'),
    );

    register_taxonomy('event_category', array('event'), array(
        'hierarchical'      => true,
        'labels'           => $cat_labels,
        'show_ui'          => true,
        'show_admin_column'=> true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'event-category'),
        'show_in_rest'     => true,
    ));
}
add_action('init', 'tov_register_events_post_type');

// WordPress meta boxes removed - using ACF plugin instead


