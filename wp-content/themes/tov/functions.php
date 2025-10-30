<?php
/**
 * Tov Theme functions and definitions - Minimal Version
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Theme version
define('TOV_THEME_VERSION', '1.0.0');

/**
 * Theme setup
 */
function tov_theme_setup() {
    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');

    // Register navigation menus
    register_nav_menus(array(
        'primary'         => esc_html__('Primary Menu', 'tov-theme'),
        'footer'          => esc_html__('Footer Menu', 'tov-theme'),
        'location_pages'  => esc_html__('Location Pages', 'tov-theme'),
        // New footer columns
        'footer_about'    => esc_html__('Footer About', 'tov-theme'),
        'footer_services' => esc_html__('Footer Services', 'tov-theme'),
        'footer_resources'=> esc_html__('Footer Resources', 'tov-theme'),
        'footer_legal'    => esc_html__('Footer Legal', 'tov-theme'),
    ));

    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'style',
        'script',
    ));
}
add_action('after_setup_theme', 'tov_theme_setup');
/**
 * Enqueue scripts and styles
 */
function tov_theme_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'tov-theme-style',
        get_template_directory_uri() . '/assets/css/tov.css',
        array(),
        TOV_THEME_VERSION
    );

    // Custom overrides stylesheet (loads after tov.css)
    wp_enqueue_style(
        'tov-theme-custom',
        get_template_directory_uri() . '/assets/css/custom.css',
        array('tov-theme-style'),
        TOV_THEME_VERSION
    );

    // Main JavaScript file
    wp_enqueue_script(
        'tov-theme-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        TOV_THEME_VERSION,
        true
    );
}
add_action('wp_enqueue_scripts', 'tov_theme_scripts');

/**
 * Add custom classes to navigation menu
 */
function tov_theme_nav_menu_css_class($classes, $item, $args) {
    if ($args->theme_location == 'primary') {
        $classes[] = 'text-white hover:text-navy-200 px-3 py-2 text-sm font-medium transition-colors duration-200';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'tov_theme_nav_menu_css_class', 10, 3);


/**
 * Load Shortcodes
 */
require_once get_template_directory() . '/shortcodes/loader.php';

// Force clear caches for blog updates
function tov_force_clear_blog_cache() {
    if (current_user_can('manage_options') && isset($_GET['clear_blog_cache'])) {
        // Clear WordPress object cache
        wp_cache_flush();
        
        // Clear any plugin caches
        if (function_exists('wp_cache_clear_cache')) {
            wp_cache_clear_cache();
        }
        
        // Clear rewrite rules
        flush_rewrite_rules();
        
        wp_redirect(remove_query_arg('clear_blog_cache'));
        exit;
    }
}
add_action('init', 'tov_force_clear_blog_cache');

/**
 * Load Custom Post Types
 */
require_once get_template_directory() . '/inc/post-types/events.php';
require_once get_template_directory() . '/inc/post-types/news.php';
require_once get_template_directory() . '/inc/post-types/news-highlight-admin.php';
require_once get_template_directory() . '/inc/post-types/blog.php';
require_once get_template_directory() . '/inc/post-types/team.php';

/**
 * Load Gallery Management System
 */
require_once get_template_directory() . '/inc/gallery/gallery-management.php';
require_once get_template_directory() . '/shortcodes/gallery-section.php';

/**
 * Load FAQ Shortcode System
 */
require_once get_template_directory() . '/shortcodes/faq-section.php';

/**
 * Load ACF Fields for Awards Template
 */
require_once get_template_directory() . '/inc/acf/awards-fields.php';

/**
 * Load ACF Fields for Events
 */
require_once get_template_directory() . '/inc/acf/events-fields.php';



/**
 * Load Simple Awards Height Control
 */
require_once get_template_directory() . '/inc/acf/simple-awards-height.php';

/**
 * Load Direct Height Field
 */
require_once get_template_directory() . '/inc/acf/direct-height-field.php';

/**
 * Load Manual Height Control
 */
require_once get_template_directory() . '/inc/acf/manual-height.php';

/**
 * Load Services Admin Menu
 */
require_once get_template_directory() . '/inc/post-types/services.php';
require_once get_template_directory() . '/inc/post-types/locations.php';


/**
 * Debug function to check if blog post type is working
 * Add ?debug_blog_system=1 to any URL
 */
function tov_debug_blog_system() {
    if (isset($_GET['debug_blog_system']) && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999; max-width: 600px;">';
        echo '<h3>Blog System Debug</h3>';
        
        // Check if blog post type exists
        $post_type_obj = get_post_type_object('blog');
        if ($post_type_obj) {
            echo '<p><strong>✅ Blog post type is registered</strong></p>';
        } else {
            echo '<p><strong>❌ Blog post type is NOT registered</strong></p>';
        }
        
        // Check blog posts
        $blog_posts = get_posts(array(
            'post_type' => 'blog',
            'numberposts' => 3,
            'post_status' => 'publish'
        ));
        
        if (!empty($blog_posts)) {
            echo '<p><strong>Blog Posts Found:</strong></p>';
            foreach ($blog_posts as $post) {
                echo '<p>- ' . $post->post_title . ' (ID: ' . $post->ID . ')</p>';
                echo '<p>  URL: <a href="' . get_permalink($post->ID) . '" target="_blank">' . get_permalink($post->ID) . '</a></p>';
            }
        } else {
            echo '<p><strong>❌ No blog posts found</strong></p>';
        }
        
        // Check blog page
        $blog_page = get_page_by_path('blog');
        if ($blog_page) {
            echo '<p><strong>✅ Blog Page Found:</strong> ' . $blog_page->post_title . ' (ID: ' . $blog_page->ID . ')</p>';
            echo '<p>URL: <a href="' . get_permalink($blog_page->ID) . '" target="_blank">' . get_permalink($blog_page->ID) . '</a></p>';
        } else {
            echo '<p><strong>❌ Blog Page Not Found</strong></p>';
        }
        
        // Check if blog-section shortcode exists
        if (shortcode_exists('blog_section')) {
            echo '<p><strong>✅ Blog section shortcode exists</strong></p>';
        } else {
            echo '<p><strong>❌ Blog section shortcode does NOT exist</strong></p>';
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_debug_blog_system');
/**
 * Add templates folder to WordPress template hierarchy
 */
function tov_add_template_directory($template) {
    // Check if it's a page template request
    if (is_page_template()) {
        $templates_dir = get_template_directory() . '/templates/';
        
        // Look for page templates in the templates folder
        if (is_page()) {
            $page_template = get_page_template_slug();
            
            // Handle templates from templates/ folder
            if ($page_template && strpos($page_template, 'templates/') === 0) {
                $template_file = $page_template;
                if (file_exists(get_template_directory() . '/' . $template_file)) {
                    return get_template_directory() . '/' . $template_file;
                }
            }
            
            // Also check direct filename in templates folder
            if ($page_template && file_exists($templates_dir . $page_template)) {
                return $templates_dir . $page_template;
            }
        }
    }
    
    return $template;
}
add_filter('page_template', 'tov_add_template_directory');

/**
 * Register page templates from templates folder
 */
function tov_get_page_templates() {
    $templates = array();
    $templates_dir = get_template_directory() . '/templates/';
    
    if (is_dir($templates_dir)) {
        $files = glob($templates_dir . '*.php');
        foreach ($files as $file) {
            $filename = basename($file);
            if ($filename !== 'page.php') {
                $template_data = get_file_data($file, array('Template Name' => 'Template Name'));
                if (!empty($template_data['Template Name'])) {
                    $templates['templates/' . $filename] = $template_data['Template Name'];
                }
            }
        }
    }
    
    return $templates;
}

/**
 * Add page templates to the template dropdown
 */
function tov_add_page_templates($templates) {
    $custom_templates = tov_get_page_templates();
    return array_merge($templates, $custom_templates);
}
add_filter('theme_page_templates', 'tov_add_page_templates');

/**
 * Debug function to check if templates are being registered
 */
function tov_debug_templates() {
    if (current_user_can('manage_options') && isset($_GET['debug_templates'])) {
        $templates = tov_get_page_templates();
        echo '<pre>';
        echo "Registered Templates:\n";
        print_r($templates);
        echo '</pre>';
    }
}
add_action('admin_init', 'tov_debug_templates');

/**
 * AJAX handler for loading more events
 */
function tov_load_more_events() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'tov_ajax_nonce')) {
        wp_die('Security check failed');
    }
    
    $page = intval($_POST['page']);
    $today = date('Y-m-d');
    
    // Get all events and filter past ones (same logic as main page)
    $all_events = new WP_Query(array(
        'post_type' => 'event',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC'
    ));
    
    // Filter past events using the same logic as the main page
    $past_events_data = array();
    if ($all_events->have_posts()) {
        while ($all_events->have_posts()) {
            $all_events->the_post();
            $event_start_date = get_field('event_start_date', get_the_ID());
            $event_end_date = get_field('event_end_date', get_the_ID());
            
            // Convert ACF dates to Y-m-d format for proper comparison
            if ($event_start_date) {
                $event_start_date = date('Y-m-d', strtotime($event_start_date));
            }
            if ($event_end_date) {
                $event_end_date = date('Y-m-d', strtotime($event_end_date));
            }
            
            // Check if event is past (same logic as main page)
            $is_past = false;
            if ($event_start_date) {
                if ($event_start_date < $today) {
                    // If there's an end date, check if it's also in the past
                    if ($event_end_date) {
                        if ($event_end_date < $today) {
                            $is_past = true;
                        }
                    } else {
                        // No end date, so if start date is past, event is past
                        $is_past = true;
                    }
                }
            } elseif ($event_end_date) {
                // Only end date available
                if ($event_end_date < $today) {
                    $is_past = true;
                }
            }
            
            if ($is_past) {
                $past_events_data[] = get_the_ID();
            }
        }
        wp_reset_postdata();
    }
    
    // Create paginated query for past events
    if (!empty($past_events_data)) {
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => 6,
            'paged' => $page,
            'post__in' => $past_events_data,
            'orderby' => 'post__in'
        );
    } else {
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => 0,
            'paged' => $page,
            'post_status' => 'publish'
        );
    }
    
    $events_query = new WP_Query($args);
    
    if ($events_query->have_posts()) {
        ob_start();
        while ($events_query->have_posts()) {
            $events_query->the_post();
            
            // Get event details from ACF fields
            $event_date = '';
            $event_end_date = '';
            $event_location = '';
            
            if (function_exists('get_field')) {
                $event_date = get_field('event_start_date', get_the_ID());
                $event_end_date = get_field('event_end_date', get_the_ID());
                $event_location = get_field('event_location', get_the_ID());
            }
            
            // Fallback to WordPress meta fields if ACF fields are empty
            if (empty($event_date)) {
                $event_date = get_post_meta(get_the_ID(), '_event_date', true);
            }
            if (empty($event_end_date)) {
                $event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
            }
            if (empty($event_location)) {
                $event_location = get_post_meta(get_the_ID(), '_event_location', true);
            }
            
            tov_render_event_card(get_the_ID(), $event_date, $event_end_date, $event_location);
        }
        wp_reset_postdata();
        
        $html = ob_get_clean();
        wp_send_json_success(array('html' => $html));
    } else {
        wp_send_json_error('No more events found');
    }
}
add_action('wp_ajax_load_more_events', 'tov_load_more_events');
add_action('wp_ajax_nopriv_load_more_events', 'tov_load_more_events');

/**
 * AJAX handler for loading more news
 */
function tov_load_more_news() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'tov_ajax_nonce')) {
        wp_die('Security check failed');
    }
    
    $page = intval($_POST['page']);
    $today = date('Y-m-d');
    
    // Query older news for the specific page
    $args = array(
        'post_type' => 'news',
        'posts_per_page' => 6,
        'paged' => $page,
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
            array(
                'before' => $today,
                'inclusive' => true,
            ),
        ),
    );
    
    $news_query = new WP_Query($args);
    
    if ($news_query->have_posts()) {
        ob_start();
        while ($news_query->have_posts()) {
            $news_query->the_post();
            $news_date = get_the_date('Y-m-d', get_the_ID());
            tov_render_news_card(get_the_ID(), $news_date);
        }
        wp_reset_postdata();
        
        $html = ob_get_clean();
        wp_send_json_success(array('html' => $html));
    } else {
        wp_send_json_error('No more news found');
    }
}
add_action('wp_ajax_load_more_news', 'tov_load_more_news');
add_action('wp_ajax_nopriv_load_more_news', 'tov_load_more_news');

/**
 * AJAX handler for loading more blog posts
 */
function tov_load_more_blog() {
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'], 'tov_ajax_nonce')) {
        wp_die('Security check failed');
    }
    
    $page = intval($_POST['page']);
    $today = date('Y-m-d');
    
    // Query older blog posts for the specific page
    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => 6,
        'paged' => $page,
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
            array(
                'before' => $today,
                'inclusive' => true,
            ),
        ),
    );
    
    $blog_query = new WP_Query($args);
    
    if ($blog_query->have_posts()) {
        ob_start();
        while ($blog_query->have_posts()) {
            $blog_query->the_post();
            $blog_date = get_the_date('Y-m-d', get_the_ID());
            tov_render_blog_card(get_the_ID(), $blog_date);
        }
        wp_reset_postdata();
        
        $html = ob_get_clean();
        wp_send_json_success(array('html' => $html));
    } else {
        wp_send_json_error('No more blog posts found');
    }
}
add_action('wp_ajax_load_more_blog', 'tov_load_more_blog');
add_action('wp_ajax_nopriv_load_more_blog', 'tov_load_more_blog');

/**
 * Enqueue AJAX script with nonce
 */
function tov_enqueue_ajax_script() {
    wp_localize_script('tov-theme-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('tov_ajax_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'tov_enqueue_ajax_script');

