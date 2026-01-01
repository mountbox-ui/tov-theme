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
 * Strip wpautop <p>/<br> wrappers around hero shortcodes.
 */
add_filter('the_content', function ($content) {
    if (has_shortcode($content, 'hero_section')) {
        // Remove paragraph wrappers around hero_* shortcodes.
        $content = preg_replace('#<p>\s*(\[(?:/?hero_[^\]]+)\])\s*</p>#', '$1', $content);
        // Remove line breaks injected before/after hero_* shortcodes.
        $content = preg_replace('#<br\s*/?>\s*(\[(?:/?hero_[^\]]+)\])#', '$1', $content);
        $content = preg_replace('#(\[(?:/?hero_[^\]]+)\])\s*<br\s*/?>#', '$1', $content);
    }
    return $content;
}, 11);

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


/**
 * Load Custom Post Types
 */
require_once get_template_directory() . '/inc/post-types/events.php';
require_once get_template_directory() . '/inc/post-types/news.php';
require_once get_template_directory() . '/inc/post-types/news-highlight-admin.php';
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
            // AJAX "load more news" is used on the template page, so keep meta
            tov_render_news_card(get_the_ID(), $news_date, true);
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
 * Enqueue AJAX script with nonce
 */
function tov_enqueue_ajax_script() {
    wp_localize_script('tov-theme-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('tov_ajax_nonce'),
        'contact_form_nonce' => wp_create_nonce('tov_contact_form_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'tov_enqueue_ajax_script');

/**
 * Handle contact form submission with email
 */
function tov_handle_contact_form() {
    // Verify nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'tov_contact_form_nonce')) {
        wp_send_json_error('Security check failed');
    }
    
    // Sanitize form data
    $form_type = sanitize_text_field($_POST['form_type']);
    $full_name = sanitize_text_field($_POST['full_name']);
    $phone_number = sanitize_text_field($_POST['phone_number']);
    $email_address = sanitize_email($_POST['email_address']);
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $request_callback = isset($_POST['request_callback']) ? 'Yes' : 'No';
    
    // Visit specific fields
    $care_home = sanitize_text_field($_POST['care_home'] ?? '');
    $preferred_date = sanitize_text_field($_POST['preferred_date'] ?? '');
    $preferred_time = sanitize_text_field($_POST['preferred_time'] ?? '');
    
    // Admin email
    $admin_email = get_option('admin_email');
    
    // Email subject based on form type
    $subject_map = array(
        'contact' => 'New Contact Form Submission',
        'visit' => 'New Tour Booking Request',
        'brochure' => 'New Brochure Download Request'
    );
    $subject = $subject_map[$form_type] ?? 'New Form Submission';
    
    // Build email message
    $email_message = "You have received a new {$form_type} form submission.\n\n";
    $email_message .= "Name: {$full_name}\n";
    $email_message .= "Phone: {$phone_number}\n";
    $email_message .= "Email: {$email_address}\n";
    
    if ($form_type === 'visit') {
        $email_message .= "Care Home: {$care_home}\n";
        $email_message .= "Preferred Date: {$preferred_date}\n";
        $email_message .= "Preferred Time: {$preferred_time}\n";
    }
    
    if (!empty($message)) {
        $email_message .= "\nMessage:\n{$message}\n";
    }
    
    if ($form_type === 'contact') {
        $email_message .= "\nRequest Callback: {$request_callback}\n";
    }
    
    // Headers
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // Send email to admin
    $admin_sent = wp_mail($admin_email, $subject, nl2br($email_message), $headers);
    
    // Send confirmation email to user
    $user_subject = "Thank you for contacting The Old Vicarage";
    $user_message = "Dear {$full_name},\n\n";
    $user_message .= "Thank you for your submission. We have received your request and will get back to you shortly.\n\n";
    $user_message .= "Best regards,\n";
    $user_message .= "The Old Vicarage Team";
    
    $user_sent = wp_mail($email_address, $user_subject, nl2br($user_message), $headers);
    
    if ($admin_sent) {
        wp_send_json_success('Form submitted successfully');
    } else {
        wp_send_json_error('Failed to send email');
    }
}
add_action('wp_ajax_tov_contact_form', 'tov_handle_contact_form');
add_action('wp_ajax_nopriv_tov_contact_form', 'tov_handle_contact_form');

// template for jobs
require_once get_template_directory() . '/jobs/theme-functions.php';