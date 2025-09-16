<?php
/**
 * Blog Section Shortcode
 * [blog_section limit="6" category="" show_past="false"]
 */

if (!defined('ABSPATH')) exit;

function tov_blog_section_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
        'category' => '',
        'show_past' => 'false',
        'debug' => 'false'
    ), $atts, 'blog_section');

    // Convert show_past to boolean
    $show_past = filter_var($atts['show_past'], FILTER_VALIDATE_BOOLEAN);

    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Add category if specified
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'blog_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            )
        );
    }

    // Filter past blog posts if show_past is false (show only recent blog posts)
    if (!$show_past) {
        $args['date_query'] = array(
            array(
                'after' => date('Y-m-d', strtotime('-30 days')), // Show blog posts from last 30 days
                'inclusive' => true,
            )
        );
    }

    $blog_query = new WP_Query($args);
    
    // Debug mode
    $debug_mode = filter_var($atts['debug'], FILTER_VALIDATE_BOOLEAN);
    if ($debug_mode && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
        echo '<h3>Blog Shortcode Debug Info</h3>';
        echo '<p><strong>Shortcode Attributes:</strong></p>';
        echo '<pre>' . print_r($atts, true) . '</pre>';
        echo '<p><strong>Query Args:</strong></p>';
        echo '<pre>' . print_r($args, true) . '</pre>';
        echo '<p><strong>Query Found Posts:</strong> ' . $blog_query->found_posts . '</p>';
        echo '<p><strong>Query Post Count:</strong> ' . $blog_query->post_count . '</p>';
        if ($blog_query->have_posts()) {
            echo '<p><strong>Posts Found:</strong></p>';
            while ($blog_query->have_posts()) {
                $blog_query->the_post();
                echo '<p>- ' . get_the_title() . ' (ID: ' . get_the_ID() . ')</p>';
            }
            wp_reset_postdata();
        }
        echo '</div>';
    }
    
    ob_start();
    ?>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">From the blog</h2>
          <p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-300">Learn how to grow your business with our expert advice.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
          <?php if ($blog_query->have_posts()) : ?>
            <?php while ($blog_query->have_posts()) : $blog_query->the_post();
                $blog_date = get_the_date('Y-m-d', get_the_ID());
                tov_render_blog_card(get_the_ID(), $blog_date);
            endwhile; ?>
          <?php else : ?>
            <div class="col-span-full text-center text-gray-600 dark:text-gray-400 py-12">
              <?php echo esc_html__('No blog posts available at the moment.', 'tov'); ?>
            </div>
          <?php endif; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('blog_section', 'tov_blog_section_shortcode');

/**
 * Latest Blog Shortcode
 * [latest_blog limit="6" category=""]
 */
function tov_latest_blog_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
        'category' => ''
    ), $atts);
    
    // Query args for latest blog posts only
    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
            array(
                'after' => date('Y-m-d', strtotime('-30 days')), // Last 30 days
                'inclusive' => true,
            )
        )
    );

    // Add category if specified
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'blog_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            )
        );
    }

    $blog_query = new WP_Query($args);
    
    ob_start();
    ?>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Latest Blog Posts</h2>
          <p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-300">Stay updated with our latest blog posts and articles.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
          <?php if ($blog_query->have_posts()) : ?>
            <?php while ($blog_query->have_posts()) : $blog_query->the_post();
                $blog_date = get_the_date('Y-m-d', get_the_ID());
                tov_render_blog_card(get_the_ID(), $blog_date);
            endwhile; ?>
          <?php else : ?>
            <div class="col-span-full text-center text-gray-600 dark:text-gray-400 py-12">
              <?php echo esc_html__('No latest blog posts available.', 'tov'); ?>
            </div>
          <?php endif; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('latest_blog', 'tov_latest_blog_shortcode');

/**
 * Past Blog Shortcode
 * [past_blog limit="6" category=""]
 */
function tov_past_blog_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
        'category' => ''
    ), $atts);
    
    // Query args for past blog posts only
    $args = array(
        'post_type' => 'blog',
        'posts_per_page' => intval($atts['limit']),
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
            array(
                'before' => date('Y-m-d'),
                'inclusive' => true,
            )
        )
    );

    // Add category if specified
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'blog_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            )
        );
    }

    $blog_query = new WP_Query($args);
    
    ob_start();
    ?>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Past Blog Posts</h2>
          <p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-300">Browse through our previous blog posts and articles.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
          <?php if ($blog_query->have_posts()) : ?>
            <?php while ($blog_query->have_posts()) : $blog_query->the_post();
                $blog_date = get_the_date('Y-m-d', get_the_ID());
                tov_render_blog_card(get_the_ID(), $blog_date);
            endwhile; ?>
          <?php else : ?>
            <div class="col-span-full text-center text-gray-600 dark:text-gray-400 py-12">
              <?php echo esc_html__('No past blog posts found.', 'tov'); ?>
            </div>
          <?php endif; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('past_blog', 'tov_past_blog_shortcode');

/**
 * Test shortcode to verify shortcode system is working
 * [test_blog_shortcode]
 */
function tov_test_blog_shortcode($atts) {
    return '<div style="background: #e7f3ff; padding: 20px; margin: 20px; border: 1px solid #2196F3; border-radius: 4px;">
        <h3 style="color: #1976D2; margin-top: 0;">✅ Blog Shortcode System is Working!</h3>
        <p>This confirms that the blog shortcode system is functioning properly.</p>
        <p><strong>Available Blog Shortcodes:</strong></p>
        <ul>
            <li><code>[blog_section]</code> - Main blog section</li>
            <li><code>[blog_section debug="true"]</code> - With debug info</li>
            <li><code>[latest_blog]</code> - Latest blog posts (last 30 days)</li>
            <li><code>[past_blog]</code> - Past blog posts</li>
        </ul>
    </div>';
}
add_shortcode('test_blog_shortcode', 'tov_test_blog_shortcode');
