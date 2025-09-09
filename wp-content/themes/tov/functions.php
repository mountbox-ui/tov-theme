<?php
/**
 * Tov Theme functions and definitions
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
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'tov-theme'),
        'footer'  => esc_html__('Footer Menu', 'tov-theme'),
    ));

    // Add support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
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
        get_template_directory_uri() . '/assets/css/style.css',
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

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'tov_theme_scripts');

/**
 * Register widget areas
 */
function tov_theme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Footer Widgets', 'tov-theme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add footer widgets here.', 'tov-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-lg font-semibold mb-4 text-white">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'tov_theme_widgets_init');

/**
 * Custom excerpt length
 */
function tov_theme_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'tov_theme_excerpt_length', 999);

/**
 * Custom excerpt more
 */
function tov_theme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'tov_theme_excerpt_more');

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
 * Customize comment form
 */
function tov_theme_comment_form_defaults($defaults) {
    $defaults['class_form'] = 'space-y-4';
    $defaults['class_submit'] = 'btn btn-primary';
    return $defaults;
}
add_filter('comment_form_defaults', 'tov_theme_comment_form_defaults');

/**
 * Custom comment callback
 */
function tov_theme_comment_callback($comment, $args, $depth) {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('comment bg-white rounded-lg p-4 shadow-sm'); ?>>
        <div class="comment-body">
            <div class="comment-meta flex items-start space-x-3 mb-3">
                <div class="comment-author-avatar flex-shrink-0">
                    <?php echo get_avatar($comment, 48, '', '', array('class' => 'rounded-full')); ?>
                </div>
                <div class="comment-metadata flex-grow">
                    <div class="comment-author text-sm font-medium text-gray-900">
                        <?php comment_author_link(); ?>
                    </div>
                    <div class="comment-date text-xs text-gray-500">
                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>" class="hover:text-primary-600">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php comment_date(); ?> at <?php comment_time(); ?>
                            </time>
                        </a>
                        <?php edit_comment_link(esc_html__('Edit', 'tov-theme'), '<span class="edit-link ml-2">', '</span>'); ?>
                    </div>
                </div>
            </div>
            
            <div class="comment-content prose prose-sm max-w-none ml-12">
                <?php if ('0' == $comment->comment_approved) : ?>
                    <p class="comment-awaiting-moderation text-sm text-amber-600 bg-amber-50 px-3 py-2 rounded mb-3">
                        <?php esc_html_e('Your comment is awaiting moderation.', 'tov-theme'); ?>
                    </p>
                <?php endif; ?>
                
                <?php comment_text(); ?>
            </div>
            
            <div class="comment-reply ml-12 mt-3">
                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<span class="reply-link">',
                    'after'     => '</span>',
                    'class'     => 'text-sm text-primary-600 hover:text-primary-700 font-medium',
                )));
                ?>
            </div>
        </div>
    <?php
}

/**
 * Load Shortcodes
 */
require_once get_template_directory() . '/shortcodes/loader.php';
