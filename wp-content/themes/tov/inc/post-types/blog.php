<?php
/**
 * Register Blog Custom Post Type
 */

if (!defined('ABSPATH')) exit;

function tov_register_blog_post_type() {
    $labels = array(
        'name'               => _x('Blog Posts', 'post type general name', 'tov'),
        'singular_name'      => _x('Blog Post', 'post type singular name', 'tov'),
        'menu_name'          => _x('Blog', 'admin menu', 'tov'),
        'name_admin_bar'     => _x('Blog Post', 'add new on admin bar', 'tov'),
        'add_new'           => _x('Add New', 'blog post', 'tov'),
        'add_new_item'      => __('Add New Blog Post', 'tov'),
        'new_item'          => __('New Blog Post', 'tov'),
        'edit_item'         => __('Edit Blog Post', 'tov'),
        'view_item'         => __('View Blog Post', 'tov'),
        'all_items'         => __('All Blog Posts', 'tov'),
        'search_items'      => __('Search Blog Posts', 'tov'),
        'not_found'         => __('No blog posts found.', 'tov'),
        'not_found_in_trash'=> __('No blog posts found in Trash.', 'tov')
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
        'menu_position'     => 7,
        'menu_icon'         => 'dashicons-edit',
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'      => true,
    );

    register_post_type('blog', $args);

    // Register Blog Category Taxonomy
    $cat_labels = array(
        'name'              => _x('Blog Categories', 'taxonomy general name', 'tov'),
        'singular_name'     => _x('Blog Category', 'taxonomy singular name', 'tov'),
        'search_items'      => __('Search Blog Categories', 'tov'),
        'all_items'         => __('All Blog Categories', 'tov'),
        'parent_item'       => __('Parent Blog Category', 'tov'),
        'parent_item_colon' => __('Parent Blog Category:', 'tov'),
        'edit_item'         => __('Edit Blog Category', 'tov'),
        'update_item'       => __('Update Blog Category', 'tov'),
        'add_new_item'      => __('Add New Blog Category', 'tov'),
        'new_item_name'     => __('New Blog Category Name', 'tov'),
        'menu_name'         => __('Categories', 'tov'),
    );

    register_taxonomy('blog_category', array('blog'), array(
        'hierarchical'      => true,
        'labels'           => $cat_labels,
        'show_ui'          => true,
        'show_admin_column'=> true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'blog-category'),
        'show_in_rest'     => true,
        'public'           => true,
        'publicly_queryable' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'    => true,
    ));
}
add_action('init', 'tov_register_blog_post_type');

/**
 * Flush rewrite rules on theme activation
 */
function tov_flush_blog_rewrite_rules() {
    tov_register_blog_post_type();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'tov_flush_blog_rewrite_rules');

/**
 * Flush rewrite rules when blog post type is updated
 */
function tov_flush_blog_rules_on_save() {
    if (get_post_type() == 'blog') {
        flush_rewrite_rules();
    }
}
add_action('save_post', 'tov_flush_blog_rules_on_save');

// Add custom meta boxes for blog details
function tov_add_blog_meta_boxes() {
    add_meta_box(
        'blog_details',
        __('Blog Details', 'tov'),
        'tov_blog_details_meta_box',
        'blog',
        'normal',
        'high'
    );
}
add_action('admin_head-post-new.php', 'tov_blog_admin_style');
add_action('admin_head-post.php', 'tov_blog_admin_style');

function tov_blog_admin_style() {
    global $post_type;
    if ($post_type == 'blog') {
        ?>
        <style>
            #blog_details {
                margin-top: 20px;
            }
            #blog_details .inside {
                padding: 0;
                margin: 0;
            }
            .blog-meta-fields {
                background: #f8fafc;
                border: 1px solid #e2e4e7;
                border-radius: 4px;
                padding: 15px;
            }
        </style>
        <?php
    }
}
add_action('add_meta_boxes', 'tov_add_blog_meta_boxes');

function tov_blog_details_meta_box($post) {
    wp_nonce_field('tov_blog_details', 'tov_blog_details_nonce');

    $blog_author_bio = get_post_meta($post->ID, '_blog_author_bio', true);
    $blog_read_time = get_post_meta($post->ID, '_blog_read_time', true);
    $blog_featured = get_post_meta($post->ID, '_blog_featured', true);
    ?>
    <style>
        .blog-meta-fields {
            padding: 10px;
            background: #fff;
            border: 1px solid #e2e4e7;
            border-radius: 4px;
        }
        .blog-meta-fields p {
            margin: 1em 0;
        }
        .blog-meta-fields label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .blog-meta-fields input[type="text"],
        .blog-meta-fields textarea {
            width: 100%;
        }
        .blog-meta-fields input[type="checkbox"] {
            margin-right: 8px;
        }
    </style>
    <div class="blog-meta-fields">
        <p>
            <label for="blog_author_bio"><?php _e('Author Bio (optional):', 'tov'); ?></label>
            <textarea id="blog_author_bio" 
                      name="blog_author_bio" 
                      rows="3"
                      placeholder="Brief author bio for this post"><?php echo esc_textarea($blog_author_bio); ?></textarea>
        </p>
        <p>
            <label for="blog_read_time"><?php _e('Estimated Read Time (optional):', 'tov'); ?></label>
            <input type="text" 
                   id="blog_read_time" 
                   name="blog_read_time" 
                   value="<?php echo esc_attr($blog_read_time); ?>"
                   placeholder="e.g., 5 min read">
        </p>
        <p>
            <label for="blog_featured">
                <input type="checkbox" 
                       id="blog_featured" 
                       name="blog_featured" 
                       value="1" 
                       <?php checked($blog_featured, '1'); ?>>
                <?php _e('Featured Blog Post', 'tov'); ?>
            </label>
        </p>
    </div>
    <?php
}

function tov_save_blog_meta($post_id) {
    if (!isset($_POST['tov_blog_details_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['tov_blog_details_nonce'], 'tov_blog_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save author bio
    if (isset($_POST['blog_author_bio'])) {
        update_post_meta($post_id, '_blog_author_bio', sanitize_textarea_field($_POST['blog_author_bio']));
    }
    
    // Save read time
    if (isset($_POST['blog_read_time'])) {
        update_post_meta($post_id, '_blog_read_time', sanitize_text_field($_POST['blog_read_time']));
    }
    
    // Save featured status
    $featured = isset($_POST['blog_featured']) ? '1' : '0';
    update_post_meta($post_id, '_blog_featured', $featured);
}
add_action('save_post', 'tov_save_blog_meta');

/**
 * Custom function to render blog card (similar to events)
 */
function tov_render_blog_card($post_id, $blog_date = null) {
    $categories = get_the_terms($post_id, 'blog_category');
    $read_time = get_post_meta($post_id, '_blog_read_time', true);
    $author_id = get_post_field('post_author', $post_id);
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_avatar = get_avatar($author_id, 40, '', '', ['class'=>'size-10 rounded-full bg-gray-100 dark:bg-gray-800']);
    ?>
    <article class="flex flex-col items-start justify-between">
        <div class="relative w-full">
            <?php if (has_post_thumbnail($post_id)) : ?>
                <a href="<?php echo get_permalink($post_id); ?>">
                    <?php echo get_the_post_thumbnail($post_id, 'large', array('class' => 'aspect-video w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] dark:bg-gray-800')); ?>
                </a>
            <?php else : ?>
                <div class="aspect-video w-full rounded-2xl bg-gray-100 sm:aspect-[2/1] lg:aspect-[3/2] dark:bg-gray-800 flex items-center justify-center">
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
                <?php if ($categories && !is_wp_error($categories)) : ?>
                    <a href="<?php echo esc_url(get_term_link($categories[0])); ?>"
                       class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100 dark:bg-gray-800/60 dark:text-gray-300 dark:hover:bg-gray-800">
                        <?php echo esc_html($categories[0]->name); ?>
                    </a>
                <?php endif; ?>
            </div>
            
            <div class="group relative grow">
                <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600 dark:text-white dark:group-hover:text-gray-300">
                    <a href="<?php echo get_permalink($post_id); ?>">
                        <span class="absolute inset-0"></span>
                        <?php echo get_the_title($post_id); ?>
                    </a>
                </h3>
                <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600 dark:text-gray-400">
                    <?php echo wp_trim_words(get_the_excerpt($post_id), 25, '...'); ?>
                </p>
            </div>
            
            <div class="relative mt-8 flex items-center gap-x-4 justify-self-end">
                <?php echo $author_avatar; ?>
                <div class="text-sm/6">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        <a href="<?php echo get_author_posts_url($author_id); ?>">
                            <span class="absolute inset-0"></span>
                            <?php echo esc_html($author_name); ?>
                        </a>
                    </p>
                    <?php if ($read_time) : ?>
                        <p class="text-gray-600 dark:text-gray-400"><?php echo esc_html($read_time); ?></p>
                    <?php else : ?>
                        <p class="text-gray-600 dark:text-gray-400">Author</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>
    <?php
}

/**
 * Custom single blog handler - redirect to blog page with modal or custom display
 */
function tov_handle_single_blog() {
    // Check if we're on a single blog post page
    if (is_singular('blog') || (is_single() && get_post_type() === 'blog')) {
        // Get the blog post
        global $post;
        
        // Additional check to make sure we have a valid blog post
        if (!$post || $post->post_type !== 'blog') {
            return;
        }
        
        // Debug mode (only show if requested)
        if (isset($_GET['debug_blog_redirect']) && current_user_can('manage_options')) {
            echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999; max-width: 500px;">';
            echo '<h3>Blog Redirect Debug</h3>';
            echo '<p><strong>Post ID:</strong> ' . $post->ID . '</p>';
            echo '<p><strong>Post Title:</strong> ' . $post->post_title . '</p>';
            echo '<p><strong>Post Type:</strong> ' . $post->post_type . '</p>';
            echo '<p><strong>Current URL:</strong> ' . $_SERVER['REQUEST_URI'] . '</p>';
            
            // Check for blog page
            $blog_page = get_page_by_path('blog');
            if ($blog_page) {
                echo '<p><strong>Blog Page Found:</strong> ' . $blog_page->post_title . ' (ID: ' . $blog_page->ID . ')</p>';
                echo '<p><strong>Blog Page URL:</strong> ' . get_permalink($blog_page->ID) . '</p>';
            } else {
                echo '<p><strong>Blog Page:</strong> Not found</p>';
            }
            echo '</div>';
            return;
        }
        
        // Get the blog page URL - we know it exists from error check
        $blog_page = get_page_by_path('blog');
        $blog_page_url = null;
        
        if ($blog_page && $blog_page->post_status === 'publish') {
            $blog_page_url = get_permalink($blog_page->ID);
        } else {
            // Fallback: try to find any page with blog template
            $pages = get_posts(array(
                'post_type' => 'page',
                'meta_key' => '_wp_page_template',
                'meta_value' => 'templates/page-blog.php',
                'posts_per_page' => 1,
                'post_status' => 'publish'
            ));
            if (!empty($pages)) {
                $blog_page_url = get_permalink($pages[0]->ID);
            }
        }
        
        // If still no URL, use home as fallback
        if (!$blog_page_url) {
            $blog_page_url = home_url();
        }
        
        // Debug: Show redirect URL if requested
        if (isset($_GET['debug_redirect_url']) && current_user_can('manage_options')) {
            $redirect_url = add_query_arg('blog_id', $post->ID, $blog_page_url);
            echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999;">';
            echo '<h3>Blog Redirect Debug</h3>';
            echo '<p><strong>Blog Page ID:</strong> ' . ($blog_page ? $blog_page->ID : 'Not found') . '</p>';
            echo '<p><strong>Blog Page URL:</strong> ' . $blog_page_url . '</p>';
            echo '<p><strong>Redirect URL:</strong> ' . $redirect_url . '</p>';
            echo '<p><strong>Blog Post ID:</strong> ' . $post->ID . '</p>';
            echo '<p><a href="' . $redirect_url . '" target="_blank">Test Redirect URL</a></p>';
            echo '</div>';
            return;
        }
        
        // Redirect with blog_id parameter
        wp_redirect(add_query_arg('blog_id', $post->ID, $blog_page_url));
        exit;
    }
}
add_action('template_redirect', 'tov_handle_single_blog');

/**
 * Additional hook to catch blog post URLs that might bypass the main redirect
 */
function tov_catch_blog_urls() {
    // Check if we have a blog parameter in the URL
    if (isset($_GET['blog']) && !empty($_GET['blog'])) {
        $post_name = sanitize_text_field($_GET['blog']);
        
        // Find the blog post by name
        $blog_post = get_page_by_path($post_name, OBJECT, 'blog');
        
        if ($blog_post && $blog_post->post_type === 'blog') {
            // Redirect to blog page with blog_id parameter
            $blog_page = get_page_by_path('blog');
            if ($blog_page) {
                $blog_page_url = get_permalink($blog_page->ID);
                wp_redirect(add_query_arg('blog_id', $blog_post->ID, $blog_page_url));
                exit;
            }
        }
    }
    
    // Also check for /blog/post-name/ pattern (fallback)
    $request_uri = $_SERVER['REQUEST_URI'];
    if (preg_match('#^/blog/[^/]+/?$#', $request_uri)) {
        // Extract post name from URL
        $post_name = basename(trim($request_uri, '/'));
        
        // Find the blog post by name
        $blog_post = get_page_by_path($post_name, OBJECT, 'blog');
        
        if ($blog_post && $blog_post->post_type === 'blog') {
            // Redirect to blog page with blog_id parameter
            $blog_page = get_page_by_path('blog');
            if ($blog_page) {
                $blog_page_url = get_permalink($blog_page->ID);
                wp_redirect(add_query_arg('blog_id', $blog_post->ID, $blog_page_url));
                exit;
            }
        }
    }
}
add_action('init', 'tov_catch_blog_urls', 1);

/**
 * Debug function to check blog post URLs
 */
function tov_debug_blog_urls() {
    if (isset($_GET['debug_blog_urls']) && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999; max-width: 600px;">';
        echo '<h3>Blog URLs Debug</h3>';
        
        // Get blog posts
        $blog_posts = get_posts(array(
            'post_type' => 'blog',
            'numberposts' => 3,
            'post_status' => 'publish'
        ));
        
        if (!empty($blog_posts)) {
            echo '<p><strong>Blog Post URLs:</strong></p>';
            foreach ($blog_posts as $post) {
                $permalink = get_permalink($post->ID);
                echo '<p><strong>' . $post->post_title . ':</strong></p>';
                echo '<p>- Permalink: <a href="' . $permalink . '" target="_blank">' . $permalink . '</a></p>';
                echo '<p>- Post Name: ' . $post->post_name . '</p>';
                echo '<p>- Expected Redirect: <a href="' . home_url('/blog/?blog_id=' . $post->ID) . '" target="_blank">' . home_url('/blog/?blog_id=' . $post->ID) . '</a></p>';
                echo '<hr>';
            }
        } else {
            echo '<p><strong>No blog posts found</strong></p>';
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_debug_blog_urls');

/**
 * Test redirect function - add ?test_blog_redirect=post-name to test
 */
function tov_test_blog_redirect() {
    if (isset($_GET['test_blog_redirect']) && current_user_can('manage_options')) {
        $post_name = sanitize_text_field($_GET['test_blog_redirect']);
        
        // Find the blog post by name
        $blog_post = get_page_by_path($post_name, OBJECT, 'blog');
        
        if ($blog_post && $blog_post->post_type === 'blog') {
            // Get blog page
            $blog_page = get_page_by_path('blog');
            if ($blog_page) {
                $blog_page_url = get_permalink($blog_page->ID);
                $redirect_url = add_query_arg('blog_id', $blog_post->ID, $blog_page_url);
                
                echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999;">';
                echo '<h3>Blog Redirect Test</h3>';
                echo '<p><strong>Post Name:</strong> ' . $post_name . '</p>';
                echo '<p><strong>Blog Post ID:</strong> ' . $blog_post->ID . '</p>';
                echo '<p><strong>Blog Post Title:</strong> ' . $blog_post->post_title . '</p>';
                echo '<p><strong>Redirect URL:</strong> <a href="' . $redirect_url . '" target="_blank">' . $redirect_url . '</a></p>';
                echo '<p><a href="' . $redirect_url . '" target="_blank">Test Redirect</a></p>';
                echo '</div>';
            }
        } else {
            echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999;">';
            echo '<h3>Blog Redirect Test - Error</h3>';
            echo '<p><strong>Post Name:</strong> ' . $post_name . '</p>';
            echo '<p><strong>Status:</strong> Blog post not found</p>';
            echo '</div>';
        }
    }
}
add_action('wp_head', 'tov_test_blog_redirect');

/**
 * Auto-create blog page if it doesn't exist
 */
function tov_auto_create_blog_page() {
    // Check if blog page exists
    $blog_page = get_page_by_path('blog');
    
    if (!$blog_page) {
        // Create the blog page
        $page_data = array(
            'post_title'   => 'Blog',
            'post_name'    => 'blog',
            'post_content' => 'This page displays all blog posts.',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_author'  => 1,
        );
        
        $page_id = wp_insert_post($page_data);
        
        if ($page_id && !is_wp_error($page_id)) {
            // Set the page template
            update_post_meta($page_id, '_wp_page_template', 'templates/page-blog.php');
            
            // Flush rewrite rules
            flush_rewrite_rules();
        }
    }
}
add_action('init', 'tov_auto_create_blog_page');

/**
 * Force flush rewrite rules for blog post type changes
 */
function tov_flush_blog_rewrite_rules_now() {
    if (isset($_GET['flush_blog_rules']) && current_user_can('manage_options')) {
        flush_rewrite_rules();
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999;">';
        echo '<h3>Blog Rewrite Rules Flushed</h3>';
        echo '<p>Blog post type rewrite rules have been flushed. Blog posts should now redirect properly.</p>';
        echo '</div>';
    }
}
add_action('wp_head', 'tov_flush_blog_rewrite_rules_now');

/**
 * Debug blog page access
 */
function tov_debug_blog_page_access() {
    if (isset($_GET['debug_blog_page']) && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999; max-width: 600px;">';
        echo '<h3>Blog Page Access Debug</h3>';
        
        // Check blog page by slug
        $blog_page = get_page_by_path('blog');
        if ($blog_page) {
            echo '<p><strong>✅ Blog Page Found by Slug:</strong></p>';
            echo '<p>- Title: ' . $blog_page->post_title . '</p>';
            echo '<p>- ID: ' . $blog_page->ID . '</p>';
            echo '<p>- Status: ' . $blog_page->post_status . '</p>';
            echo '<p>- URL: <a href="' . get_permalink($blog_page->ID) . '" target="_blank">' . get_permalink($blog_page->ID) . '</a></p>';
        } else {
            echo '<p><strong>❌ Blog Page Not Found by Slug</strong></p>';
        }
        
        // Check blog page by template
        $pages = get_posts(array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => 'templates/page-blog.php',
            'posts_per_page' => 1,
            'post_status' => 'publish'
        ));
        
        if (!empty($pages)) {
            echo '<p><strong>✅ Blog Page Found by Template:</strong></p>';
            foreach ($pages as $page) {
                echo '<p>- Title: ' . $page->post_title . '</p>';
                echo '<p>- ID: ' . $page->ID . '</p>';
                echo '<p>- URL: <a href="' . get_permalink($page->ID) . '" target="_blank">' . get_permalink($page->ID) . '</a></p>';
            }
        } else {
            echo '<p><strong>❌ No Blog Page Found by Template</strong></p>';
        }
        
        // Check archive link
        $archive_url = get_post_type_archive_link('blog');
        if ($archive_url) {
            echo '<p><strong>✅ Blog Archive URL:</strong> <a href="' . $archive_url . '" target="_blank">' . $archive_url . '</a></p>';
        } else {
            echo '<p><strong>❌ Blog Archive URL Not Available</strong></p>';
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_debug_blog_page_access');

/**
 * Check for common blog errors and fix them
 */
function tov_check_and_fix_blog_errors() {
    if (isset($_GET['fix_blog_errors']) && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc; position: fixed; top: 0; left: 0; z-index: 9999; max-width: 700px;">';
        echo '<h3>Blog Error Check & Fix</h3>';
        
        $errors_found = false;
        $fixes_applied = array();
        
        // Check 1: Blog post type registration
        $post_type_obj = get_post_type_object('blog');
        if (!$post_type_obj) {
            echo '<p><strong>❌ ERROR:</strong> Blog post type not registered</p>';
            $errors_found = true;
        } else {
            echo '<p><strong>✅ Blog post type is registered</strong></p>';
        }
        
        // Check 2: Blog page exists
        $blog_page = get_page_by_path('blog');
        if (!$blog_page) {
            echo '<p><strong>❌ ERROR:</strong> Blog page does not exist</p>';
            $errors_found = true;
            
            // Fix: Create blog page
            $page_data = array(
                'post_title'   => 'Blog',
                'post_name'    => 'blog',
                'post_content' => 'This page displays all blog posts.',
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_author'  => 1,
            );
            
            $page_id = wp_insert_post($page_data);
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', 'templates/page-blog.php');
                $fixes_applied[] = 'Created blog page (ID: ' . $page_id . ')';
                echo '<p><strong>🔧 FIXED:</strong> Created blog page</p>';
            } else {
                echo '<p><strong>❌ FAILED:</strong> Could not create blog page</p>';
            }
        } else {
            echo '<p><strong>✅ Blog page exists</strong> (ID: ' . $blog_page->ID . ')</p>';
            
            // Check if it has the right template
            $template = get_post_meta($blog_page->ID, '_wp_page_template', true);
            if ($template !== 'templates/page-blog.php') {
                echo '<p><strong>❌ ERROR:</strong> Blog page has wrong template (' . $template . ')</p>';
                $errors_found = true;
                
                // Fix: Set correct template
                update_post_meta($blog_page->ID, '_wp_page_template', 'templates/page-blog.php');
                $fixes_applied[] = 'Set correct template for blog page';
                echo '<p><strong>🔧 FIXED:</strong> Set correct template</p>';
            } else {
                echo '<p><strong>✅ Blog page has correct template</strong></p>';
            }
        }
        
        // Check 3: Blog posts exist
        $blog_posts = get_posts(array(
            'post_type' => 'blog',
            'numberposts' => 1,
            'post_status' => 'publish'
        ));
        
        if (empty($blog_posts)) {
            echo '<p><strong>❌ ERROR:</strong> No blog posts found</p>';
            $errors_found = true;
            echo '<p><strong>💡 SOLUTION:</strong> Create some blog posts in WordPress Admin</p>';
        } else {
            echo '<p><strong>✅ Blog posts exist</strong> (' . count($blog_posts) . ' found)</p>';
        }
        
        // Check 4: Blog shortcode exists
        if (!shortcode_exists('blog_section')) {
            echo '<p><strong>❌ ERROR:</strong> Blog section shortcode not registered</p>';
            $errors_found = true;
        } else {
            echo '<p><strong>✅ Blog section shortcode exists</strong></p>';
        }
        
        // Check 5: Template file exists
        $template_file = get_template_directory() . '/templates/page-blog.php';
        if (!file_exists($template_file)) {
            echo '<p><strong>❌ ERROR:</strong> Blog template file missing</p>';
            $errors_found = true;
        } else {
            echo '<p><strong>✅ Blog template file exists</strong></p>';
        }
        
        // Apply fixes
        if (!empty($fixes_applied)) {
            flush_rewrite_rules();
            echo '<p><strong>🔧 APPLIED FIXES:</strong></p>';
            foreach ($fixes_applied as $fix) {
                echo '<p>- ' . $fix . '</p>';
            }
            echo '<p><strong>✅ Rewrite rules flushed</strong></p>';
        }
        
        if (!$errors_found) {
            echo '<p><strong>🎉 NO ERRORS FOUND!</strong> Blog system should be working correctly.</p>';
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_check_and_fix_blog_errors');

/**
 * Debug function to check blog post type registration
 * Add ?debug_blog=1 to any URL to see debug info
 */
function tov_debug_blog_registration() {
    if (isset($_GET['debug_blog']) && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
        echo '<h3>Blog Post Type Debug Info</h3>';
        
        // Check if post type is registered
        $post_type_obj = get_post_type_object('blog');
        if ($post_type_obj) {
            echo '<p><strong>✅ Blog post type is registered</strong></p>';
            echo '<pre>' . print_r($post_type_obj, true) . '</pre>';
        } else {
            echo '<p><strong>❌ Blog post type is NOT registered</strong></p>';
        }
        
        // Check if taxonomy is registered
        $taxonomy_obj = get_taxonomy('blog_category');
        if ($taxonomy_obj) {
            echo '<p><strong>✅ Blog category taxonomy is registered</strong></p>';
            echo '<pre>' . print_r($taxonomy_obj, true) . '</pre>';
        } else {
            echo '<p><strong>❌ Blog category taxonomy is NOT registered</strong></p>';
        }
        
        // Check existing blog posts
        $blog_posts = get_posts(array(
            'post_type' => 'blog',
            'numberposts' => 5,
            'post_status' => 'publish'
        ));
        
        if (!empty($blog_posts)) {
            echo '<p><strong>Existing Blog Posts:</strong></p>';
            foreach ($blog_posts as $post) {
                echo '<p>- ' . $post->post_title . ' (ID: ' . $post->ID . ') - <a href="' . get_permalink($post->ID) . '">View</a></p>';
            }
        } else {
            echo '<p><strong>No blog posts found</strong></p>';
        }
        
        // Check blog page
        $blog_page = get_page_by_path('blog');
        if ($blog_page) {
            echo '<p><strong>Blog Page:</strong> ' . $blog_page->post_title . ' (ID: ' . $blog_page->ID . ') - <a href="' . get_permalink($blog_page->ID) . '">View</a></p>';
        } else {
            echo '<p><strong>Blog Page:</strong> Not found</p>';
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_debug_blog_registration');
add_action('admin_head', 'tov_debug_blog_registration');
