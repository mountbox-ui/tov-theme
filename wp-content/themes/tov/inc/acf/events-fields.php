<?php
/**
 * ACF Fields for Events
 * 
 * This file contains the ACF field group configuration for Events.
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ACF fields for Events
 */
function register_events_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_events_fields',
        'title' => 'Event Details',
        'fields' => array(
            // Event Start Date
            array(
                'key' => 'field_event_start_date',
                'label' => 'Event Start Date',
                'name' => 'event_start_date',
                'type' => 'date_picker',
                'instructions' => 'Select the start date of the event',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'Y-m-d',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
            ),
            
            // Event End Date
            array(
                'key' => 'field_event_end_date',
                'label' => 'Event End Date',
                'name' => 'event_end_date',
                'type' => 'date_picker',
                'instructions' => 'Select the end date of the event (optional)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'Y-m-d',
                'return_format' => 'Y-m-d',
                'first_day' => 1,
            ),
            
            // Event Time
            array(
                'key' => 'field_event_time',
                'label' => 'Event Time',
                'name' => 'event_time',
                'type' => 'time_picker',
                'instructions' => 'Select the time of the event',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'g:i a',
                'return_format' => 'H:i:s',
            ),
            
            // Event Location
            array(
                'key' => 'field_event_location',
                'label' => 'Event Location',
                'name' => 'event_location',
                'type' => 'text',
                'instructions' => 'Enter the location of the event',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'e.g., Conference Center, London',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Fields for event details and information',
    ));
}

// Register the fields when ACF is available
add_action('acf/init', 'register_events_acf_fields');

?>
