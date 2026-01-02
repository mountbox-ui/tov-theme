<?php
if (!defined('ABSPATH')) exit;

function tov_news_section_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
        'category' => '',
        'show_past' => 'false',
        'debug' => 'false'
    ), $atts, 'news_section');

    // Convert show_past to boolean
    $show_past = filter_var($atts['show_past'], FILTER_VALIDATE_BOOLEAN);
    
    // Always limit to maximum 3 for homepage
    $display_limit = 3;
    $today = date('Y-m-d');
    
    // First, get manually selected homepage news (only past news)
    $selected_args = array(
        'post_type' => 'news',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
            array(
                'before' => $today,
                'inclusive' => true,
            )
        ),
        'meta_query' => array(
            array(
                'key' => '_show_on_homepage',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    
    // Add category filter if specified
    if (!empty($atts['category'])) {
        $selected_args['tax_query'] = array(
            array(
                'taxonomy' => 'news_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            )
        );
    }
    
    $selected_news = new WP_Query($selected_args);
    $selected_posts = array();
    
    // Get up to 3 selected homepage news
    if ($selected_news->have_posts()) {
        $count = 0;
        while ($selected_news->have_posts() && $count < $display_limit) {
            $selected_news->the_post();
            $selected_posts[] = get_the_ID();
            $count++;
        }
        wp_reset_postdata();
    }
    
    // If we need more posts to reach 3, get latest past news (excluding already selected)
    $remaining_needed = $display_limit - count($selected_posts);
    $all_posts = $selected_posts;
    
    if ($remaining_needed > 0) {
        $latest_args = array(
            'post_type' => 'news',
            'posts_per_page' => $remaining_needed,
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => $selected_posts, // Exclude already selected posts
            'date_query' => array(
                array(
                    'before' => $today,
                    'inclusive' => true,
                )
            ),
        );
        
        // Add category filter if specified
        if (!empty($atts['category'])) {
            $latest_args['tax_query'] = array(
                array(
                    'taxonomy' => 'news_category',
                    'field' => 'slug',
                    'terms' => sanitize_text_field($atts['category']),
                )
            );
        }
        
        $latest_news = new WP_Query($latest_args);
        if ($latest_news->have_posts()) {
            while ($latest_news->have_posts()) {
                $latest_news->the_post();
                $all_posts[] = get_the_ID();
            }
            wp_reset_postdata();
        }
    }
    
    // Create final query with the selected post IDs (only past news)
    $args = array(
        'post_type' => 'news',
        'post__in' => !empty($all_posts) ? $all_posts : array(0), // Use array(0) to return no results if empty
        'orderby' => 'post__in', // Maintain the order we created
        'posts_per_page' => count($all_posts),
        'date_query' => array(
            array(
                'before' => $today,
                'inclusive' => true,
            )
        ),
    );

    // Add category if specified
    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'news_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            )
        );
    }

    $news_query = new WP_Query($args);

    // Try to find a dedicated News page for the "Read all news" link
    $news_page_url = '';
    $news_page = get_page_by_path('news');
    if ($news_page) {
        $news_page_url = get_permalink($news_page->ID);
    } else {
        // Fallback to the news archive if enabled
        $archive_link = get_post_type_archive_link('news');
        if ($archive_link && !is_wp_error($archive_link)) {
            $news_page_url = $archive_link;
        }
    }

    // Debug mode
    $debug_mode = filter_var($atts['debug'], FILTER_VALIDATE_BOOLEAN);
    if ($debug_mode && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
        echo '<h3>News Shortcode Debug Info</h3>';
        echo '<p><strong>Shortcode Attributes:</strong></p>';
        echo '<pre>' . print_r($atts, true) . '</pre>';
        echo '<p><strong>Query Args:</strong></p>';
        echo '<pre>' . print_r($args, true) . '</pre>';
        echo '<p><strong>Query Found Posts:</strong> ' . $news_query->found_posts . '</p>';
        echo '<p><strong>Query Post Count:</strong> ' . $news_query->post_count . '</p>';
        if ($news_query->have_posts()) {
            echo '<p><strong>Posts Found:</strong></p>';
            while ($news_query->have_posts()) {
                $news_query->the_post();
                echo '<p>- ' . get_the_title() . ' (ID: ' . get_the_ID() . ')</p>';
            }
            wp_reset_postdata();
        }
        echo '</div>';
    }
    
    ob_start();
    ?>

    <div class="bg-white py-24 sm:py-[66px] dark:bg-gray-900">
      <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
        <div class="flex items-center justify-between mb-6 flex-wrap gap-6">
          <h2 class="text-[#000] leading-[1.2] letter-spacing-[-0.5px]">
            <?php esc_html_e('Latest news', 'tov-theme'); ?>
          </h2>
          <?php if (!empty($news_page_url)) : ?>
            
            <a href="<?php echo esc_url($news_page_url); ?>" class="btn btn-primary btn-resources">
					<?php echo esc_html__('Read All News', 'tov-theme'); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                        <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="white"/>
                    </svg>
				</a>
          <?php endif; ?>
        </div>

        <?php if ($news_query->have_posts()) : ?>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while ($news_query->have_posts()) : $news_query->the_post();
              $news_date = get_the_date('Y-m-d', get_the_ID());
              // For shortcode, hide author/reporter/avatar meta and apply custom date + heading styles
              tov_render_news_card(
                  get_the_ID(),
                  $news_date,
                  false,
                  'text-[rgba(28,35,33,0.9)] font-lato text-sm font-semibold leading-[20.124px] tracking-[0.385px] uppercase',
                  'mt-3 text-black font-plusjakarta text-[20px] font-bold leading-[25.993px]',
                  'mt-3 text-[#757575] font-lato text-[18px] font-normal leading-[26px]'
              );
            endwhile; ?>
          </div>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <div class="text-center text-gray-600 dark:text-gray-400 py-12">
            <?php echo esc_html__('No news available at the moment.', 'tov-theme'); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('news_section', 'tov_news_section_shortcode');

/**
 * Latest News Shortcode
 * [latest_news limit="6" category=""]
 */
function tov_latest_news_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
        'category' => ''
    ), $atts);
    
    // Query args for latest news only
    $args = array(
        'post_type' => 'news',
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
                'taxonomy' => 'news_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            )
        );
    }

    $news_query = new WP_Query($args);
    
    ob_start();
    ?>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-4xl">
          <h2 class="text-[#000] leading-[1.2] letter-spacing-[-0.5px]">Latest News</h2>
          <p class="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-400">Stay updated with our latest news and announcements.</p>
          <div class="mt-16 space-y-20 lg:mt-20">
            <?php if ($news_query->have_posts()) : ?>
              <?php while ($news_query->have_posts()) : $news_query->the_post();
                  tov_render_horizontal_news_card(get_the_ID());
              endwhile; ?>
            <?php else : ?>
              <div class="text-center text-gray-600 dark:text-gray-400 py-12">
                <?php echo esc_html__('No latest news available.', 'tov'); ?>
              </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('latest_news', 'tov_latest_news_shortcode');

/**
 * Past News Shortcode
 * [past_news limit="6" category=""]
 */
function tov_past_news_shortcode($atts) {
    $atts = shortcode_atts(array(
        'limit' => 6,
        'category' => ''
    ), $atts);
    
    // Query args for past news only
    $args = array(
        'post_type' => 'news',
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
                'taxonomy' => 'news_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($atts['category']),
            )
        );
    }

    $news_query = new WP_Query($args);
    
    ob_start();
    ?>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:max-w-4xl">
          <h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Past News</h2>
          <p class="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-400">Browse through our previous news and updates.</p>
          <div class="mt-16 space-y-20 lg:mt-20">
            <?php if ($news_query->have_posts()) : ?>
              <?php while ($news_query->have_posts()) : $news_query->the_post();
                  tov_render_horizontal_news_card(get_the_ID());
              endwhile; ?>
            <?php else : ?>
              <div class="text-center text-gray-600 dark:text-gray-400 py-12">
                <?php echo esc_html__('No past news found.', 'tov'); ?>
              </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode('past_news', 'tov_past_news_shortcode');

/**
 * Test shortcode to verify shortcode system is working
 * [test_news_shortcode]
 */
function tov_test_news_shortcode($atts) {
    return '<div style="background: #e7f3ff; padding: 20px; margin: 20px; border: 1px solid #2196F3; border-radius: 4px;">
        <h3 style="color: #1976D2; margin-top: 0;">✅ News Shortcode System is Working!</h3>
        <p>This confirms that the shortcode system is functioning properly.</p>
        <p><strong>Available News Shortcodes:</strong></p>
        <ul>
            <li><code>[news_section]</code> - Main news section</li>
            <li><code>[news_section debug="true"]</code> - With debug info</li>
            <li><code>[latest_news]</code> - Latest news (last 30 days)</li>
            <li><code>[past_news]</code> - Past news</li>
        </ul>
    </div>';
}
add_shortcode('test_news_shortcode', 'tov_test_news_shortcode');

/**
 * Verify shortcode registration
 */
function tov_verify_news_shortcodes() {
    if (isset($_GET['verify_shortcodes']) && current_user_can('manage_options')) {
        echo '<div style="background: #fff; padding: 20px; margin: 20px; border: 1px solid #ccc;">';
        echo '<h3>News Shortcode Verification</h3>';
        
        global $shortcode_tags;
        
        $news_shortcodes = array(
            'news_section',
            'latest_news', 
            'past_news',
            'test_news_shortcode'
        );
        
        foreach ($news_shortcodes as $shortcode) {
            if (isset($shortcode_tags[$shortcode])) {
                echo '<p>✅ <strong>' . $shortcode . '</strong> is registered</p>';
            } else {
                echo '<p>❌ <strong>' . $shortcode . '</strong> is NOT registered</p>';
            }
        }
        
        echo '</div>';
    }
}
add_action('wp_head', 'tov_verify_news_shortcodes');
add_action('admin_head', 'tov_verify_news_shortcodes');
