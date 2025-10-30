<?php
/**
 * Template Name: Events Page
 */

if (!defined('ABSPATH')) exit;

get_header(); ?>

<main class="bg-white dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-12 lg:py-16">
        <header class="mb-8">
            <h1 class="text-3xl font-semibold tracking-tight text-gray-900 sm:text-4xl dark:text-white"><?php esc_html_e('Events & webinars', 'tov'); ?></h1>
        </header>



        <?php
        $today = date('Y-m-d');
        
        // Debug: Uncomment the line below to see debug output
        // echo '<div style="background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;"><strong>Debug Info:</strong> Today is ' . $today . '</div>';
        
        
        // Function to format event date range
        function tov_format_event_range($start, $end) {
            $s = $start ? strtotime($start) : null;
            $e = $end ? strtotime($end) : null;
            if ($s && $e) {
                if (date('Y-m', $s) === date('Y-m', $e)) {
                    return date_i18n('M j', $s) . ' - ' . date_i18n('j, Y', $e);
                } elseif (date('Y', $s) === date('Y', $e)) {
                    return date_i18n('M j', $s) . ' - ' . date_i18n('M j, Y', $e);
                }
                return date_i18n('M j, Y', $s) . ' - ' . date_i18n('M j, Y', $e);
            }
            if ($s) return date_i18n('M j, Y', $s);
            return '';
        }
        
        // Function to render event card
        function tov_render_event_card($post_id, $event_date, $event_end_date, $event_location) {
            $range = tov_format_event_range($event_date, $event_end_date);
            $categories = get_the_terms($post_id, 'event_category');
            $badge_text = 'EVENT';
            $badge_color = 'bg-blue-600';
            
            if ($categories && !is_wp_error($categories)) {
                $badge_text = strtoupper($categories[0]->name);
                if (stripos($badge_text, 'WEBINAR') !== false) {
                    $badge_color = 'bg-pink-600';
                } elseif (stripos($badge_text, 'EXPO') !== false) {
                    $badge_color = 'bg-purple-600';
                }
            }
            
            // Hide the problematic ACF field by starting output buffering
            ob_start();
            ?>
            <article class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                <?php if (has_post_thumbnail($post_id)) : ?>
                    <div class="relative h-48 overflow-hidden">
                        <?php echo get_the_post_thumbnail($post_id, 'large', array('class' => 'w-full h-full object-cover')); ?>
                        <div class="absolute top-3 left-3">
                            <span class="<?php echo $badge_color; ?> text-white px-2 py-1 text-xs font-semibold rounded"><?php echo esc_html($badge_text); ?></span>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        <a href="<?php echo get_permalink($post_id); ?>" class="hover:text-blue-600 transition-colors duration-200"><?php echo get_the_title($post_id); ?></a>
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <?php echo esc_html($range); ?>
                        <?php if ($event_location) : ?>
                            <br><?php echo esc_html($event_location); ?>
                        <?php endif; ?>
                    </p>
                </div>
            </article>
            <?php
            $output = ob_get_clean();
            
            // Remove the problematic field from the output
            $output = preg_replace('/field_68ccff5169cd3/', '', $output);
            $output = preg_replace('/<[^>]*>field_68ccff5169cd3<\/[^>]*>/', '', $output);
            
            echo $output;
        }
        
        // Get all events and categorize them
        $all_events_args = array(
            'post_type' => 'event',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'ASC'
        );
        $all_events = new WP_Query($all_events_args);
        
        // Categorize events
        $upcoming_events_data = array();
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
                
                // Determine if event is upcoming or past
                $is_upcoming = false;
                $is_past = false;
                
                if ($event_start_date) {
                    if ($event_start_date >= $today) {
                        // Event starts today or in the future
                        $is_upcoming = true;
                    } elseif ($event_end_date && $event_end_date >= $today) {
                        // Event started in the past but hasn't ended yet
                        $is_upcoming = true;
                    } else {
                        // Event has ended
                        $is_past = true;
                    }
                } elseif ($event_end_date) {
                    // Only end date available
                    if ($event_end_date >= $today) {
                        $is_upcoming = true;
                    } else {
                        $is_past = true;
                    }
                }
                
                // Debug: Uncomment the lines below to see debug output for each event
                // echo '<div style="background: #e8f4f8; padding: 5px; margin: 2px 0; font-size: 12px;">';
                // echo 'Event: ' . get_the_title() . ' | Start: ' . ($event_start_date ?: 'None') . ' | End: ' . ($event_end_date ?: 'None') . ' | Upcoming: ' . ($is_upcoming ? 'YES' : 'NO') . ' | Past: ' . ($is_past ? 'YES' : 'NO');
                // echo '</div>';
                
                if ($is_upcoming) {
                    $upcoming_events_data[] = get_the_ID();
                } elseif ($is_past) {
                    $past_events_data[] = get_the_ID();
                }
            }
            wp_reset_postdata();
        }
        
        // Create queries for upcoming events
        if (!empty($upcoming_events_data)) {
            $upcoming_args = array(
                'post_type' => 'event',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'post__in' => $upcoming_events_data,
                'orderby' => 'post__in'
            );
        } else {
            $upcoming_args = array(
                'post_type' => 'event',
                'posts_per_page' => 0,
                'post_status' => 'publish'
            );
        }
        $upcoming_events = new WP_Query($upcoming_args);
        
        ?>

        <?php if ($upcoming_events->have_posts()) : ?>
        <!-- Upcoming Events Section -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6"><?php esc_html_e('Upcoming', 'tov'); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($upcoming_events->have_posts()) : $upcoming_events->the_post();
                    // Get event details from ACF fields first
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
                endwhile; ?>
            </div>
        </section>
        <?php endif; wp_reset_postdata(); ?>

        <?php
        // Create query for past events (show all, no pagination)
        if (!empty($past_events_data)) {
            $past_args = array(
                'post_type' => 'event',
                'posts_per_page' => -1,
                'post__in' => $past_events_data,
                'orderby' => 'post__in'
            );
        } else {
            $past_args = array(
                'post_type' => 'event',
                'posts_per_page' => 0,
                'post_status' => 'publish'
            );
        }
        $past_events = new WP_Query($past_args);
        
        // Debug: Uncomment the lines below to see summary debug output
        // echo '<div style="background: #fff3cd; padding: 10px; margin: 10px 0; border: 1px solid #ffeaa7;"><strong>Debug Summary:</strong><br>';
        // echo 'Today is: ' . $today . '<br>';
        // echo 'Total events found: ' . $all_events->found_posts . '<br>';
        // echo 'Events marked as upcoming: ' . count($upcoming_events_data) . '<br>';
        // echo 'Events marked as past: ' . count($past_events_data) . '<br>';
        // echo 'Events showing in upcoming section: ' . $upcoming_events->found_posts . '<br>';
        // echo 'Events showing in past section: ' . $past_events->found_posts;
        // echo '</div>';
        ?>

        <?php if ($past_events->have_posts()) : ?>
        <!-- Past Events Section -->
        <section>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6"><?php esc_html_e('Past', 'tov'); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($past_events->have_posts()) : $past_events->the_post();
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
                endwhile; ?>
            </div>
            
        </section>
        <?php endif; wp_reset_postdata(); ?>

        <?php if (!$upcoming_events->have_posts() && !$past_events->have_posts()) : ?>
        <div class="text-center py-12">
            <p class="text-gray-600 dark:text-gray-400"><?php esc_html_e('No events found.', 'tov'); ?></p>
            <p class="mt-4">
                <a href="<?php echo admin_url('post-new.php?post_type=event'); ?>" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    <?php esc_html_e('Create Event', 'tov'); ?>
                </a>
            </p>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
