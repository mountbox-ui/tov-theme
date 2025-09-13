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

// Add custom meta boxes for event details
function tov_add_event_meta_boxes() {
    add_meta_box(
        'event_details',
        __('Event Details', 'tov'),
        'tov_event_details_meta_box',
        'event',
        'normal',
        'high'
    );
}
add_action('admin_head-post-new.php', 'tov_event_admin_style');
add_action('admin_head-post.php', 'tov_event_admin_style');

function tov_event_admin_style() {
    global $post_type;
    if ($post_type == 'event') {
        ?>
        <style>
            #event_details {
                margin-top: 20px;
            }
            #event_details .inside {
                padding: 0;
                margin: 0;
            }
            .event-meta-fields {
                background: #f8fafc;
                border: 1px solid #e2e4e7;
                border-radius: 4px;
                padding: 15px;
            }
        </style>
        <?php
    }
}
add_action('add_meta_boxes', 'tov_add_event_meta_boxes');

function tov_event_details_meta_box($post) {
    wp_nonce_field('tov_event_details', 'tov_event_details_nonce');

    $event_date = get_post_meta($post->ID, '_event_date', true);
    $event_end_date = get_post_meta($post->ID, '_event_end_date', true);
    $event_time = get_post_meta($post->ID, '_event_time', true);
    $event_location = get_post_meta($post->ID, '_event_location', true);
    ?>
    <style>
        .event-meta-fields {
            padding: 10px;
            background: #fff;
            border: 1px solid #e2e4e7;
            border-radius: 4px;
        }
        .event-meta-fields p {
            margin: 1em 0;
        }
        .event-meta-fields label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .event-meta-fields input[type="date"],
        .event-meta-fields input[type="time"] {
            width: 200px;
        }
        .event-meta-fields input[type="text"] {
            width: 100%;
        }
    </style>
    <div class="event-meta-fields">
        <p>
            <label for="event_date"><?php _e('Event Start Date:', 'tov'); ?></label>
            <input type="date" 
                   id="event_date" 
                   name="event_date" 
                   value="<?php echo esc_attr($event_date); ?>"
                   required>
        </p>
        <p>
            <label for="event_end_date"><?php _e('Event End Date (optional):', 'tov'); ?></label>
            <input type="date" 
                   id="event_end_date" 
                   name="event_end_date" 
                   value="<?php echo esc_attr($event_end_date); ?>">
        </p>
        <p>
            <label for="event_time"><?php _e('Event Time:', 'tov'); ?></label>
            <input type="time" 
                   id="event_time" 
                   name="event_time" 
                   value="<?php echo esc_attr($event_time); ?>">
        </p>
        <p>
            <label for="event_location"><?php _e('Location / Venue:', 'tov'); ?></label>
            <input type="text" 
                   id="event_location" 
                   name="event_location" 
                   value="<?php echo esc_attr($event_location); ?>" 
                   class="widefat"
                   placeholder="Enter event location">
        </p>
    </div>
    <?php
}

function tov_save_event_meta($post_id) {
    if (!isset($_POST['tov_event_details_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['tov_event_details_nonce'], 'tov_event_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save event date
    if (isset($_POST['event_date'])) {
        update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
    }

    // Save event end date
    if (isset($_POST['event_end_date'])) {
        update_post_meta($post_id, '_event_end_date', sanitize_text_field($_POST['event_end_date']));
    }
    
    // Save event time
    if (isset($_POST['event_time'])) {
        update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
    }
    
    // Save event location
    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }
}
add_action('save_post', 'tov_save_event_meta');
