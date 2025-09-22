<?php
/**
 * Register Team Custom Post Type
 */

if (!defined('ABSPATH')) exit;

function tov_register_team_post_type() {
    $labels = array(
        'name'               => _x('Team Members', 'post type general name', 'tov'),
        'singular_name'      => _x('Team Member', 'post type singular name', 'tov'),
        'menu_name'          => _x('Team', 'admin menu', 'tov'),
        'name_admin_bar'     => _x('Team Member', 'add new on admin bar', 'tov'),
        'add_new'           => _x('Add New', 'team member', 'tov'),
        'add_new_item'      => __('Add New Team Member', 'tov'),
        'new_item'          => __('New Team Member', 'tov'),
        'edit_item'         => __('Edit Team Member', 'tov'),
        'view_item'         => __('View Team Member', 'tov'),
        'all_items'         => __('All Team Members', 'tov'),
        'search_items'      => __('Search Team Members', 'tov'),
        'not_found'         => __('No team members found.', 'tov'),
        'not_found_in_trash'=> __('No team members found in Trash.', 'tov')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'team'),
        'capability_type'   => 'post',
        'has_archive'       => true,
        'hierarchical'      => false,
        'menu_position'     => 6,
        'menu_icon'         => 'dashicons-groups',
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'      => true,
    );

    register_post_type('team', $args);

    // Register Team Department Taxonomy
    $dept_labels = array(
        'name'              => _x('Departments', 'taxonomy general name', 'tov'),
        'singular_name'     => _x('Department', 'taxonomy singular name', 'tov'),
        'search_items'      => __('Search Departments', 'tov'),
        'all_items'         => __('All Departments', 'tov'),
        'parent_item'       => __('Parent Department', 'tov'),
        'parent_item_colon' => __('Parent Department:', 'tov'),
        'edit_item'         => __('Edit Department', 'tov'),
        'update_item'       => __('Update Department', 'tov'),
        'add_new_item'      => __('Add New Department', 'tov'),
        'new_item_name'     => __('New Department Name', 'tov'),
        'menu_name'         => __('Departments', 'tov'),
    );

    register_taxonomy('team_department', array('team'), array(
        'hierarchical'      => true,
        'labels'           => $dept_labels,
        'show_ui'          => true,
        'show_admin_column'=> true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'team-department'),
        'show_in_rest'     => true,
        'public'           => true,
        'publicly_queryable' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'    => true,
    ));
}
add_action('init', 'tov_register_team_post_type');

/**
 * Flush rewrite rules on theme activation
 */
function tov_flush_team_rewrite_rules() {
    tov_register_team_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'tov_flush_team_rewrite_rules');

/**
 * Add custom columns to team members admin list
 */
function tov_team_admin_columns($columns) {
    // Add new column after title
    $new_columns = array();
    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['show_on_homepage'] = __('Show on Homepage', 'tov');
        }
    }
    return $new_columns;
}
add_filter('manage_team_posts_columns', 'tov_team_admin_columns');

/**
 * Display custom column content
 */
function tov_team_admin_column_content($column, $post_id) {
    if ($column === 'show_on_homepage') {
        $show_on_homepage = false;
        if (function_exists('get_field')) {
            $show_on_homepage = get_field('show_on_homepage', $post_id);
        }
        
        if ($show_on_homepage) {
            echo '<span class="dashicons dashicons-admin-home" style="color: #46b450;" title="Shows on Homepage"></span>';
        } else {
            echo '<span class="dashicons dashicons-admin-home" style="color: #ddd;" title="Not on Homepage"></span>';
        }
    }
}
add_action('manage_team_posts_custom_column', 'tov_team_admin_column_content', 10, 2);

/**
 * Make custom column sortable
 */
function tov_team_admin_sortable_columns($columns) {
    $columns['show_on_homepage'] = 'show_on_homepage';
    return $columns;
}
add_filter('manage_edit-team_sortable_columns', 'tov_team_admin_sortable_columns');

/**
 * Handle sorting for custom column
 */
function tov_team_admin_column_orderby($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    $orderby = $query->get('orderby');
    if ('show_on_homepage' === $orderby) {
        $query->set('meta_key', 'show_on_homepage');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'tov_team_admin_column_orderby');

/**
 * Flush rewrite rules when team post type is updated
 */
function tov_flush_team_rules_on_save() {
    if (get_post_type() == 'team') {
        flush_rewrite_rules();
    }
}
add_action('save_post', 'tov_flush_team_rules_on_save');

/**
 * Custom function to render team member card
 */
function tov_render_team_card($post_id, $use_acf = false) {
    // Get team member details from ACF fields
    $name = '';
    $designation = '';
    $image = '';
    $message = '';
    $message_visibility = true;
    $show_on_homepage = false;
    
    // Get ACF fields using your specific field names
    if ($use_acf && function_exists('get_field')) {
        $name = get_field('name', $post_id);
        $designation = get_field('designation', $post_id);
        $image = get_field('image', $post_id);
        $message = get_field('message', $post_id);
        $message_visibility = get_field('message_visibility', $post_id);
        $show_on_homepage = get_field('show_on_homepage', $post_id);
    }
    
    // Use post title as fallback for name
    if (empty($name)) {
        $name = get_the_title($post_id);
    }
    ?>
    <div class="team-member-card flex flex-col items-center text-center">
        <div class="relative w-32 h-32 mb-4">
            <?php 
            // Use ACF image if available, otherwise fallback to featured image
            if (!empty($image) && is_array($image)) {
                $image_url = $image['sizes']['medium'] ?? $image['url'];
                $image_alt = $image['alt'] ?? $name;
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="w-full h-full rounded-full object-cover border-4 border-white shadow-lg" />';
            } elseif (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, 'medium', array('class' => 'w-full h-full rounded-full object-cover border-4 border-white shadow-lg'));
            } else {
                ?>
                <div class="w-full h-full rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <?php
            }
            ?>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">
            <?php echo esc_html($name); ?>
        </h3>
        
        <?php if (!empty($designation)) : ?>
            <p class="text-lg text-blue-600 dark:text-blue-400 font-medium mb-2">
                <?php echo esc_html($designation); ?>
            </p>
        <?php endif; ?>
        
        <?php if (!empty($message) && $message_visibility) : ?>
            <div class="text-sm text-gray-700 dark:text-gray-300 mb-4 max-w-sm italic">
                <blockquote class="border-l-4 border-blue-500 pl-4">
                    "<?php echo esc_html($message); ?>"
                </blockquote>
            </div>
        <?php endif; ?>
        
    </div>
    <?php
}

/**
 * Auto-create team page if it doesn't exist
 */
function tov_auto_create_team_page() {
    // Check if team page exists
    $team_page = get_page_by_path('team');
    
    if (!$team_page) {
        // Create the team page
        $page_data = array(
            'post_title'   => 'Our Team',
            'post_name'    => 'team',
            'post_content' => 'Meet our amazing team members.',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_author'  => 1,
        );
        
        $page_id = wp_insert_post($page_data);
        
        if ($page_id && !is_wp_error($page_id)) {
            // Set the page template
            update_post_meta($page_id, '_wp_page_template', 'templates/page-team.php');
            
            // Flush rewrite rules
            flush_rewrite_rules();
        }
    }
}
add_action('init', 'tov_auto_create_team_page');
