<?php
/**
 * Template Name: Events Page
 */

if (!defined('ABSPATH')) exit;

get_header(); ?>

<main class="bg-white dark:bg-gray-900 py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8  pb-1 overflow-visible ">
         
        <header class="mb-12 mx-auto max-w-2xl lg:mx-0">
            <h2><?php esc_html_e('Events', 'tov'); ?></h2>
            <p class="paragraph">We're a dynamic group of individuals who are passionate about what we do and dedicated to delivering the best results for our clients.</p>
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
                        <?php echo get_the_post_thumbnail($post_id, 'large', array('class' => 'w-full h-full object-cover rounded-lg')); ?>
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
    </div>

        <?php if ($upcoming_events->have_posts()) : ?>
        <!-- Upcoming Events Section -->
        <section class="relative w-full mb-12  pb-16 overflow-hidden">
            <!-- Full Width Background Image
            <div class="absolute inset-0 top-0 left-0 w-full h-full z-0">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/About Us H1 bg gr.png" alt="" class="w-full h-full object-cover object-bottom opacity-30 scale-x-[1]">
            </div> -->
            <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="text-2xl font-jakarta font-bold text-gray-900 dark:text-white mb-6"><?php esc_html_e('Upcoming', 'tov'); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($upcoming_events->have_posts()) : $upcoming_events->the_post();
                    // Get event details from ACF fields first
                    $event_date = '';
                    $event_end_date = '';
                    $event_time = '';
                    $event_location = '';
                    
                    if (function_exists('get_field')) {
                        $event_date = get_field('event_start_date', get_the_ID());
                        $event_end_date = get_field('event_end_date', get_the_ID());
                        $event_time = get_field('event_time', get_the_ID());
                        $event_location = get_field('event_location', get_the_ID());
                    }
                    
                    // Fallback to WordPress meta fields if ACF fields are empty
                    if (empty($event_date)) {
                        $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                    }
                    if (empty($event_end_date)) {
                        $event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
                    }
                    if (empty($event_time)) {
                        $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                    }
                    if (empty($event_location)) {
                        $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                    }
                    
                    // Format date using the same function as past events
                    $date_display = tov_format_event_range($event_date, $event_end_date);
                    $time_display = '';
                    
                    if ($event_time) {
                        $time_display = date_i18n('g:i a', strtotime($event_time));
                    }
                    
                    // Get event categories for label
                    $event_categories = get_the_terms(get_the_ID(), 'event_category');
                    $category_label = 'EVENT';
                    if ($event_categories && !is_wp_error($event_categories) && !empty($event_categories)) {
                        $category_label = strtoupper($event_categories[0]->name);
                    }
                    ?>
                    <article class="group bg-white rounded-lg overflow-hidden hover:shadow-sm transition-shadow duration-300 dark:bg-gray-800">
                        <?php if (has_post_thumbnail(get_the_ID())) : ?>
                            <div class="relative w-full h-48 overflow-hidden">
                                <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'w-full h-full object-cover rounded-lg')); ?>
                                </a>
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center rounded bg-[#006778a1] text-white px-2 py-1 text-xs font-semibold">
                                        <?php echo esc_html($category_label); ?>
                                    </span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="py-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-[#016A7C] dark:group-hover:text-[#016A7C] transition-colors duration-300">
                                <a href="<?php echo get_permalink(get_the_ID()); ?>" class="transition-colors duration-300">
                                    <?php echo get_the_title(get_the_ID()); ?>
                                </a>
                            </h3>
                            <?php if ($date_display || $time_display || $event_location) : ?>
                                <p class="text-[rgba(28,35,33,0.9)] font-lato text-base font-normal leading-[24px] tracking-[0.459px] mb-6">
                                    <?php if ($date_display) : ?>
                                        <span class="uppercase"><?php echo esc_html($date_display); ?></span>
                                    <?php endif; ?>
                                    <?php if ($time_display) : ?>
                                        <?php if ($date_display) : ?><span class="mx-1 text-gray-400">|</span><?php endif; ?>
                                        <?php echo esc_html($time_display); ?>
                                    <?php endif; ?>
                                    <?php if ($event_location) : ?>
                                        <?php if ($date_display || $time_display) : ?><span class="mx-1 text-gray-400">|</span><?php endif; ?>
                                        <?php echo esc_html($event_location); ?>
                                    <?php endif; ?>
                                </p>
                            <?php endif; ?>
                            <div class="mt-4">
                                <a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn-readmore group">
                                    <?php esc_html_e('Read more', 'tov'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" class="pt-1" viewBox="0 0 21 21" fill="none">
                                        <path d="M11.5246 10.4999L7.19336 6.16861L8.43148 4.93136L14 10.4999L8.43149 16.0684L7.19424 14.8311L11.5246 10.4999Z" fill="rgba(0, 0, 0, 0.8)"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            </div>
        </section>
        <?php endif; wp_reset_postdata(); ?>

    <div class="mx-auto max-w-7xl px-6 lg:px-8">

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
    </div>

        <?php if ($past_events->have_posts()) : ?>
        <!-- Past Events Section -->
        <section class="relative w-full mt-12 pt-12 pb-16 overflow-hidden">
            <!-- Gradient Background -->
            <div class="absolute inset-0 bg-[#FAF8F4] dark:bg-[#FAF8F4]"></div>
            
            <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-8">
                <h2 class="text-2xl font-jakarta font-bold text-gray-900 dark:text-white mb-6"><?php esc_html_e('Past', 'tov'); ?></h2>
                <div class="space-y-6 max-w-[800px]">
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
                    
                    // Format date
                    $date_display = tov_format_event_range($event_date, $event_end_date);
                    ?>
                    <a href="<?php echo get_permalink(get_the_ID()); ?>" class="block group">
                        <article class="group flex flex-col sm:flex-row gap-6 rounded-lg overflow-hidden p-3 hover:shadow-sm transition-shadow duration-300 hover:bg-white cursor-pointer">
                            <div class="flex-shrink-0 w-full sm:w-64 h-48 sm:h-auto flex items-center justify-center">
                                <?php if (has_post_thumbnail(get_the_ID())) : ?>
                                    <?php echo get_the_post_thumbnail(get_the_ID(), 'medium', array('class' => 'w-full h-[130px] object-cover rounded-lg')); ?>
                                <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 p-6 flex flex-col justify-center">
                                <?php if ($date_display || $event_location) : ?>
                                    <div class="text-sm text-gray-600 dark:text-gray-400 mb-2 transition-colors duration-200">
                                        <?php if ($date_display) : ?>
                                            <span><?php echo esc_html(strtoupper($date_display)); ?></span>
                                        <?php endif; ?>
                                        <?php if ($event_location) : ?>
                                            <?php if ($date_display) : ?><span class="mx-1 text-gray-400">|</span><?php endif; ?>
                                            <span><?php echo esc_html($event_location); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 group-hover:text-[#016A7C] dark:group-hover:text-[#016A7C] transition-colors duration-300">
                                    <?php echo get_the_title(get_the_ID()); ?>
                                </h3>
                                <span class="btn-readmore group">
                                    <?php esc_html_e('Read more', 'tov'); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" class="pt-1" viewBox="0 0 21 21" fill="none">
                                        <path d="M11.5246 10.4999L7.19336 6.16861L8.43148 4.93136L14 10.4999L8.43149 16.0684L7.19424 14.8311L11.5246 10.4999Z" fill="rgba(0, 0, 0, 0.8)"/>
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </a>
                <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php endif; wp_reset_postdata(); ?>

    <div class="mx-auto max-w-7xl px-6 lg:px-8">
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
