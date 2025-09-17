<?php
/**
 * Register News Custom Post Type
 */

if (!defined('ABSPATH')) exit;

function tov_register_news_post_type() {
    $labels = array(
        'name'               => _x('News', 'post type general name', 'tov'),
        'singular_name'      => _x('News Item', 'post type singular name', 'tov'),
        'menu_name'          => _x('News', 'admin menu', 'tov'),
        'name_admin_bar'     => _x('News', 'add new on admin bar', 'tov'),
        'add_new'           => _x('Add News', 'news', 'tov'),
        'add_new_item'      => __('Add New News', 'tov'),
        'new_item'          => __('New News', 'tov'),
        'edit_item'         => __('Edit News', 'tov'),
        'view_item'         => __('View News', 'tov'),
        'all_items'         => __('All News', 'tov'),
        'search_items'      => __('Search News', 'tov'),
        'not_found'         => __('No news found.', 'tov'),
        'not_found_in_trash'=> __('No news found in Trash.', 'tov')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false, // Disable direct access to single posts
        'show_ui'           => true,
        'show_in_menu'      => true,
        'query_var'         => true,
        'rewrite'           => false, // Disable rewrite rules for single posts
        'capability_type'   => 'post',
        'has_archive'       => true,
        'hierarchical'      => false,
        'menu_position'     => 6,
        'menu_icon'         => 'dashicons-media-document',
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'      => true,
    );

    register_post_type('news', $args);

    // Register News Category Taxonomy
    $cat_labels = array(
        'name'              => _x('News Categories', 'taxonomy general name', 'tov'),
        'singular_name'     => _x('News Category', 'taxonomy singular name', 'tov'),
        'search_items'      => __('Search News Categories', 'tov'),
        'all_items'         => __('All News Categories', 'tov'),
        'parent_item'       => __('Parent News Category', 'tov'),
        'parent_item_colon' => __('Parent News Category:', 'tov'),
        'edit_item'         => __('Edit News Category', 'tov'),
        'update_item'       => __('Update News Category', 'tov'),
        'add_new_item'      => __('Add New News Category', 'tov'),
        'new_item_name'     => __('New News Category Name', 'tov'),
        'menu_name'         => __('Categories', 'tov'),
    );

    register_taxonomy('news_category', array('news'), array(
        'hierarchical'      => true,
        'labels'           => $cat_labels,
        'show_ui'          => true,
        'show_admin_column'=> true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'news-category'),
        'show_in_rest'     => true,
        'public'           => true,
        'publicly_queryable' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'    => true,
    ));
}
add_action('init', 'tov_register_news_post_type');

/**
 * Flush rewrite rules on theme activation
 */
function tov_flush_news_rewrite_rules() {
    tov_register_news_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'tov_flush_news_rewrite_rules');

/**
 * Flush rewrite rules when news post type is updated
 */
function tov_flush_news_rules_on_save() {
    if (get_post_type() == 'news') {
        flush_rewrite_rules();
    }
}
add_action('save_post', 'tov_flush_news_rules_on_save');

// ✅ News meta box (you can add fields like Source, Reporter, Published Date)
function tov_add_news_meta_boxes() {
    add_meta_box(
        'news_details',
        __('News Details', 'tov'),
        'tov_news_details_meta_box',
        'news',
        'normal',
        'high'
    );
    
    add_meta_box(
        'news_homepage_settings',
        __('Homepage Display Settings', 'tov'),
        'tov_news_homepage_meta_box',
        'news',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'tov_add_news_meta_boxes');

/**
 * Add admin styles for news post type
 */
function tov_news_admin_styles() {
    global $post_type;
    if ($post_type == 'news') {
        ?>
        <style>
            .news-meta-fields {
                padding: 15px;
                background: #f8fafc;
                border: 1px solid #e2e4e7;
                border-radius: 4px;
            }
            .news-meta-fields p {
                margin: 1em 0;
            }
            .news-meta-fields label {
                display: block;
                font-weight: 600;
                margin-bottom: 5px;
            }
            .news-meta-fields input[type="text"] {
                width: 100%;
            }
        </style>
        <?php
    }
}
add_action('admin_head-post-new.php', 'tov_news_admin_styles');
add_action('admin_head-post.php', 'tov_news_admin_styles');

function tov_news_details_meta_box($post) {
    wp_nonce_field('tov_news_details', 'tov_news_details_nonce');

    $news_source = get_post_meta($post->ID, '_news_source', true);
    $news_reporter = get_post_meta($post->ID, '_news_reporter', true);
    ?>
    <div class="news-meta-fields">
        <p>
            <label for="news_source"><?php _e('News Source:', 'tov'); ?></label>
            <input type="text" id="news_source" name="news_source"
                   value="<?php echo esc_attr($news_source); ?>" class="widefat">
        </p>
        <p>
            <label for="news_reporter"><?php _e('Reporter/Author:', 'tov'); ?></label>
            <input type="text" id="news_reporter" name="news_reporter"
                   value="<?php echo esc_attr($news_reporter); ?>" class="widefat">
        </p>
    </div>
    <?php
}

function tov_save_news_meta($post_id) {
    if (!isset($_POST['tov_news_details_nonce'])) return;
    if (!wp_verify_nonce($_POST['tov_news_details_nonce'], 'tov_news_details')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['news_source'])) {
        update_post_meta($post_id, '_news_source', sanitize_text_field($_POST['news_source']));
    }
    if (isset($_POST['news_reporter'])) {
        update_post_meta($post_id, '_news_reporter', sanitize_text_field($_POST['news_reporter']));
    }
    
    // Save homepage settings
    if (isset($_POST['news_homepage_meta_box_nonce']) && wp_verify_nonce($_POST['news_homepage_meta_box_nonce'], 'news_homepage_meta_box')) {
        if (isset($_POST['_show_on_homepage'])) {
            update_post_meta($post_id, '_show_on_homepage', '1');
        } else {
            delete_post_meta($post_id, '_show_on_homepage');
        }
        
        if (isset($_POST['_homepage_priority'])) {
            $priority = intval($_POST['_homepage_priority']);
            if ($priority >= 1 && $priority <= 10) {
                update_post_meta($post_id, '_homepage_priority', $priority);
            }
        }
    }
}
add_action('save_post', 'tov_save_news_meta');

/**
 * Homepage meta box for news selection
 */
function tov_news_homepage_meta_box($post) {
    wp_nonce_field('news_homepage_meta_box', 'news_homepage_meta_box_nonce');
    
    $show_on_homepage = get_post_meta($post->ID, '_show_on_homepage', true);
    $homepage_priority = get_post_meta($post->ID, '_homepage_priority', true);
    if (empty($homepage_priority)) $homepage_priority = 5; // Default priority
    
    echo '<div class="news-homepage-fields">';
    echo '<p>';
    echo '<label for="show_on_homepage">';
    echo '<input type="checkbox" id="show_on_homepage" name="_show_on_homepage" value="1" ' . checked($show_on_homepage, '1', false) . ' />';
    echo ' ' . __('Show on Homepage', 'tov');
    echo '</label>';
    echo '</p>';
    
    echo '<p>';
    echo '<label for="homepage_priority">' . __('Homepage Priority (1-10, higher = more important):', 'tov') . '</label><br>';
    echo '<input type="number" id="homepage_priority" name="_homepage_priority" value="' . esc_attr($homepage_priority) . '" min="1" max="10" style="width: 100%;" />';
    echo '<small>' . __('Higher priority news will be shown first if more than 3 are selected.', 'tov') . '</small>';
    echo '</p>';
    echo '</div>';
}

/**
 * Debug function to check news post type registration
 * Add ?debug_news=1 to any URL to see debug info
 */
function tov_debug_news_registration() {
    if (isset($_GET['debug_news']) && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
        echo '<h3>News Post Type Debug Info</h3>';
        
        // Check if post type is registered
        $post_type_obj = get_post_type_object('news');
        if ($post_type_obj) {
            echo '<p><strong>✅ News post type is registered</strong></p>';
            echo '<pre>' . print_r($post_type_obj, true) . '</pre>';
        } else {
            echo '<p><strong>❌ News post type is NOT registered</strong></p>';
        }
        
        // Check if taxonomy is registered
        $taxonomy_obj = get_taxonomy('news_category');
        if ($taxonomy_obj) {
            echo '<p><strong>✅ News category taxonomy is registered</strong></p>';
            echo '<pre>' . print_r($taxonomy_obj, true) . '</pre>';
        } else {
            echo '<p><strong>❌ News category taxonomy is NOT registered</strong></p>';
        }
        
        // Check existing news categories
        $categories = get_terms(array(
            'taxonomy' => 'news_category',
            'hide_empty' => false
        ));
        
        if (!is_wp_error($categories)) {
            echo '<p><strong>Existing News Categories:</strong></p>';
            echo '<pre>' . print_r($categories, true) . '</pre>';
        } else {
            echo '<p><strong>Error getting categories:</strong> ' . $categories->get_error_message() . '</p>';
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_debug_news_registration');
add_action('admin_head', 'tov_debug_news_registration');

/**
 * Force template for news posts
 */
function tov_news_template_redirect($template) {
    if (is_singular('news')) {
        $custom_template = get_template_directory() . '/single-news.php';
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    return $template;
}
add_filter('template_include', 'tov_news_template_redirect');

/**
 * Debug function to check if news post exists
 */
function tov_debug_news_post() {
    if (isset($_GET['debug_news_post']) && current_user_can('manage_options') && is_singular('news')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
        echo '<h3>News Post Debug Info</h3>';
        
        global $post;
        if ($post) {
            echo '<p><strong>Post ID:</strong> ' . $post->ID . '</p>';
            echo '<p><strong>Post Type:</strong> ' . $post->post_type . '</p>';
            echo '<p><strong>Post Status:</strong> ' . $post->post_status . '</p>';
            echo '<p><strong>Post Title:</strong> ' . $post->post_title . '</p>';
            echo '<p><strong>Post Content:</strong> ' . (empty($post->post_content) ? 'Empty' : 'Has content') . '</p>';
        } else {
            echo '<p><strong>No post object found</strong></p>';
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_debug_news_post');

/**
 * Custom function to render news card (similar to events)
 */
function tov_render_news_card($post_id, $news_date = null) {
    $categories = get_the_terms($post_id, 'news_category');
    $author_id = get_post_field('post_author', $post_id);
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_avatar = get_avatar($author_id, 40, '', '', ['class'=>'size-10 rounded-full bg-gray-100 dark:bg-gray-800']);
    
    // Check if this post has the "highlighted" category
    $is_highlighted = false;
    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            if ($category->slug === 'highlighted') {
                $is_highlighted = true;
                break;
            }
        }
    }
    
    $card_classes = "flex flex-col items-start justify-between";
    if ($is_highlighted) {
        $card_classes .= " bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 border border-orange-200 dark:border-orange-700/50 rounded-2xl p-6 shadow-lg";
    }
    ?>
    <article class="<?php echo esc_attr($card_classes); ?>">
        <div class="relative w-full">
            <?php if (has_post_thumbnail($post_id)) : ?>
                <a href="<?php echo get_permalink($post_id); ?>">
                    <?php echo get_the_post_thumbnail($post_id, 'large', array('class' => 'w-full h-48 rounded-2xl bg-gray-100 object-cover object-center dark:bg-gray-800')); ?>
                </a>
            <?php else : ?>
                <div class="w-full h-48 rounded-2xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                    <span class="text-gray-400 dark:text-gray-500">No Image</span>
                </div>
            <?php endif; ?>
            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10 dark:ring-white/10"></div>
        </div>
        
        <div class="flex max-w-xl grow flex-col justify-between">
            <div class="mt-8 flex items-center gap-x-4 text-xs">
                <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>" class="text-gray-500 dark:text-gray-400">
                    <?php echo esc_html(get_the_date('M j, Y', $post_id)); ?>
                </time>
            </div>
            
            <div class="group relative grow">
                <h3 class="mt-3 text-lg font-semibold text-gray-900 group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                    <a href="<?php echo get_permalink($post_id); ?>">
                        <span class="absolute inset-0"></span>
                        <?php echo get_the_title($post_id); ?>
                    </a>
                </h3>
                <p class="mt-5 text-sm leading-6 text-gray-600 dark:text-gray-400">
                    <?php echo wp_trim_words(get_the_excerpt($post_id), 25, '...'); ?>
                </p>
            </div>
            
            <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                <?php echo $author_avatar; ?>
                <div class="text-sm leading-6">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        <a href="<?php echo get_author_posts_url($author_id); ?>">
                            <span class="absolute inset-0"></span>
                            <?php 
                            $custom_reporter = get_post_meta($post_id, '_news_reporter', true);
                            echo esc_html($custom_reporter ? $custom_reporter : $author_name); 
                            ?>
                        </a>
                    </p>
                    <?php 
                    $news_source = get_post_meta($post_id, '_news_source', true);
                    if ($news_source) : ?>
                        <p class="text-gray-600 dark:text-gray-400"><?php echo esc_html($news_source); ?></p>
                    <?php else : ?>
                        <p class="text-gray-600 dark:text-gray-400">Reporter</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>
    <?php
}

/**
 * Custom single news handler - redirect to news page with modal or custom display
 */
function tov_handle_single_news() {
    if (is_singular('news')) {
        // Get the news post
        global $post;
        
        // Redirect to news page with the specific post
        $news_page_url = get_permalink(get_page_by_path('news'));
        if ($news_page_url) {
            wp_redirect(add_query_arg('news_id', $post->ID, $news_page_url));
            exit;
        } else {
            // Fallback: redirect to home with news_id parameter
            wp_redirect(add_query_arg('news_id', $post->ID, home_url()));
            exit;
        }
    }
}
add_action('template_redirect', 'tov_handle_single_news');

/**
 * Additional hook to catch news post URLs that might bypass the main redirect
 */
function tov_catch_news_urls() {
    // Check if we have a news parameter in the URL
    if (isset($_GET['news']) && !empty($_GET['news'])) {
        $post_name = sanitize_text_field($_GET['news']);
        
        // Find the news post by name
        $news_post = get_page_by_path($post_name, OBJECT, 'news');
        
        if ($news_post && $news_post->post_type === 'news') {
            // Redirect to news page with news_id parameter
            $news_page = get_page_by_path('news');
            if ($news_page) {
                $news_page_url = get_permalink($news_page->ID);
                wp_redirect(add_query_arg('news_id', $news_post->ID, $news_page_url));
                exit;
            }
        }
    }
    
    // Also check for /news/post-name/ pattern (fallback)
    $request_uri = $_SERVER['REQUEST_URI'];
    if (preg_match('#^/news/[^/]+/?$#', $request_uri)) {
        // Extract post name from URL
        $post_name = basename(trim($request_uri, '/'));
        
        // Find the news post by name
        $news_post = get_page_by_path($post_name, OBJECT, 'news');
        
        if ($news_post && $news_post->post_type === 'news') {
            // Redirect to news page with news_id parameter
            $news_page = get_page_by_path('news');
            if ($news_page) {
                $news_page_url = get_permalink($news_page->ID);
                wp_redirect(add_query_arg('news_id', $news_post->ID, $news_page_url));
                exit;
            }
        }
    }
}
add_action('init', 'tov_catch_news_urls', 1);

/**
 * Force flush rewrite rules for news post type changes
 */
function tov_flush_news_rewrite_rules_now() {
    if (isset($_GET['flush_news_rules']) && current_user_can('manage_options')) {
        flush_rewrite_rules();
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999;">';
        echo '<h3>News Rewrite Rules Flushed</h3>';
        echo '<p>News post type rewrite rules have been flushed. News posts should now redirect properly.</p>';
        echo '</div>';
    }
}
add_action('wp_head', 'tov_flush_news_rewrite_rules_now');

/**
 * Render horizontal news card (blog-style layout)
 */
function tov_render_horizontal_news_card($post_id) {
    $categories = get_the_terms($post_id, 'news_category');
    $author_id = get_post_field('post_author', $post_id);
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_avatar = get_avatar($author_id, 40, '', '', ['class'=>'size-10 rounded-full bg-gray-50 dark:bg-gray-800']);
    
    
    // Check if this post has the "highlighted" category
    $is_highlighted = false;
    if ($categories && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            if ($category->slug === 'highlighted') {
                $is_highlighted = true;
                break;
            }
        }
    }
    
    $card_classes = "relative isolate flex flex-col gap-8 lg:flex-row";
    if ($is_highlighted) {
        $card_classes .= " bg-gray-50 dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 rounded-2xl p-6 shadow-lg";
    }
    ?>
    <article class="<?php echo esc_attr($card_classes); ?>">
        <div class="relative w-full h-16 lg:w-16 lg:h-16 lg:shrink-0">
            <?php if (has_post_thumbnail($post_id)) : ?>
                <a href="<?php echo get_permalink($post_id); ?>">
                    <?php echo get_the_post_thumbnail($post_id, 'large', array('class' => 'absolute inset-0 size-full rounded-2xl bg-gray-50 object-cover dark:bg-gray-800')); ?>
                </a>
            <?php else : ?>
                <div class="absolute inset-0 size-full rounded-2xl bg-gray-50 dark:bg-gray-800 flex items-center justify-center">
                    <span class="text-gray-400 dark:text-gray-500">No Image</span>
                </div>
            <?php endif; ?>
            <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-gray-900/10 dark:ring-white/10"></div>
        </div>
        <div>
            <div class="flex items-center gap-x-4 text-xs">
                <time datetime="<?php echo esc_attr(get_the_date('c', $post_id)); ?>" class="text-gray-500 dark:text-gray-400">
                    <?php echo esc_html(get_the_date('M j, Y', $post_id)); ?>
                </time>
            </div>
            <div class="group relative max-w-xl">
                <h3 class="mt-3 text-lg font-semibold text-gray-900 group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                    <a href="<?php echo get_permalink($post_id); ?>">
                        <span class="absolute inset-0"></span>
                        <?php echo get_the_title($post_id); ?>
                    </a>
                </h3>
                <p class="mt-5 text-sm leading-6 text-gray-600 dark:text-gray-400">
                    <?php echo wp_trim_words(get_the_excerpt($post_id), 25, '...'); ?>
                </p>
            </div>
            <div class="mt-6 flex border-t border-gray-900/5 pt-6 dark:border-white/10">
                <div class="relative flex items-center gap-x-4">
                    <?php echo $author_avatar; ?>
                    <div class="text-sm leading-6">
                        <p class="font-semibold text-gray-900 dark:text-white">
                            <a href="<?php echo get_author_posts_url($author_id); ?>">
                                <span class="absolute inset-0"></span>
                                <?php 
                                $custom_reporter = get_post_meta($post_id, '_news_reporter', true);
                                echo esc_html($custom_reporter ? $custom_reporter : $author_name); 
                                ?>
                            </a>
                        </p>
                        <?php 
                        $news_source = get_post_meta($post_id, '_news_source', true);
                        if ($news_source) : ?>
                            <p class="text-gray-600 dark:text-gray-400"><?php echo esc_html($news_source); ?></p>
                        <?php else : ?>
                            <p class="text-gray-600 dark:text-gray-400">Reporter</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </article>
    <?php
}
