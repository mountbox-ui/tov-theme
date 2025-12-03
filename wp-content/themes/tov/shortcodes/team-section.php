<?php
/**
 * Team Section Shortcode
 * Usage: [team_section]
 */

if (!defined('ABSPATH')) exit;

/**
 * Get the highlighted team member
 */
function tov_get_highlighted_team_member() {
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_is_highlighted',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        wp_reset_postdata();
        return $post_id;
    }
    
    return false;
}

function tov_team_section_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'title' => 'Our Team',
        'subtitle' => 'Meet the amazing people behind our success',
        'posts_per_page' => 12,
        'department' => '',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'layout' => 'grid', // grid, list, carousel, admin-style
        'style' => 'modern', // modern, admin-style, minimal
        'highlighted_only' => 'false' // true, false - show only highlighted team member
    ), $atts);

    // Check if ACF is available
    $use_acf = function_exists('get_field');
    
    // Build query args
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => intval($atts['posts_per_page']),
        'post_status' => 'publish',
        'orderby' => $atts['orderby'],
        'order' => $atts['order'],
    );

    // Add taxonomy filters if specified
    if (!empty($atts['department'])) {
        $args['tax_query'][] = array(
            'taxonomy' => 'team_department',
            'field'    => 'slug',
            'terms'    => $atts['department'],
        );
    }

    
    // Add highlighted filter if specified
    if ($atts['highlighted_only'] === 'true') {
        $args['meta_query'] = array(
            array(
                'key' => '_is_highlighted',
                'value' => '1',
                'compare' => '='
            )
        );
    }


    $team_query = new WP_Query($args);

    if (!$team_query->have_posts()) {
        return '<div class="text-center py-12"><p class="text-gray-500">No team members found.</p></div>';
    }

    ob_start();
    ?>
    <div class="team-section bg-white dark:bg-gray-900 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                    <?php echo esc_html($atts['title']); ?>
                </h2>
                <p class="mt-4 text-lg leading-8 text-gray-600 dark:text-gray-400">
                    <?php echo esc_html($atts['subtitle']); ?>
                </p>
            </div>
            
            <?php
            // Determine layout classes based on layout attribute
            $layout_classes = '';
            if ($atts['layout'] === 'list') {
                $layout_classes = 'space-y-8 max-w-4xl mx-auto';
            } elseif ($atts['layout'] === 'carousel') {
                $layout_classes = 'grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3';
            } elseif ($atts['layout'] === 'admin-style') {
                $layout_classes = 'grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4';
            } else {
                $layout_classes = 'grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4';
            }
            ?>
            
            <div class="<?php echo esc_attr($layout_classes); ?>">
                <?php while ($team_query->have_posts()) : $team_query->the_post(); ?>
                    <?php 
                    if ($atts['highlighted_only'] === 'true') {
                        // Use special highlighted card for featured member
                        tov_render_highlighted_team_card(get_the_ID(), $use_acf);
                    } elseif ($atts['layout'] === 'list') {
                        tov_render_team_list_item(get_the_ID(), $use_acf);
                    } elseif ($atts['layout'] === 'admin-style') {
                        tov_render_team_admin_style(get_the_ID(), $use_acf);
                    } else {
                        tov_render_team_card(get_the_ID(), $use_acf);
                    }
                    ?>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php
    wp_reset_postdata();
    
    return ob_get_clean();
}
add_shortcode('team_section', 'tov_team_section_shortcode');

/**
 * Render team member as list item (for list layout)
 */
function tov_render_team_list_item($post_id, $use_acf = false) {
    // Get team member details from ACF fields
    $name = '';
    $designation = '';
    $image = '';
    $message = '';
    $message_visibility = true;
    
    // Get ACF fields using your specific field names
    if ($use_acf && function_exists('get_field')) {
        $name = get_field('name', $post_id);
        $designation = get_field('designation', $post_id);
        $image = get_field('image', $post_id);
        $message = get_field('message', $post_id);
        $message_visibility = get_field('message_visibility', $post_id);
    }
    
    // Use post title as fallback for name
    if (empty($name)) {
        $name = get_the_title($post_id);
    }
    ?>
    <div class="team-member-list-item flex items-center space-x-6 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="flex-shrink-0">
            <div class="relative w-20 h-20">
                <?php 
                // Use ACF image if available, otherwise fallback to featured image
                if (!empty($image) && is_array($image)) {
                    $image_url = $image['sizes']['thumbnail'] ?? $image['url'];
                    $image_alt = $image['alt'] ?? $name;
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="w-full h-full rounded-full object-cover" />';
                } elseif (has_post_thumbnail($post_id)) {
                    echo get_the_post_thumbnail($post_id, 'thumbnail', array('class' => 'w-full h-full rounded-full object-cover'));
                } else {
                    ?>
                    <div class="w-full h-full rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        
        <div class="flex-1 min-w-0">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                <?php echo esc_html($name); ?>
            </h3>
            
            <?php if (!empty($designation)) : ?>
                <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                    <?php echo esc_html($designation); ?>
                </p>
            <?php endif; ?>
            
            <?php if (!empty($message) && $message_visibility) : ?>
                <p class="paragraph">
                    "<?php echo esc_html($message); ?>"
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Render highlighted team member with special styling
 */
function tov_render_highlighted_team_card($post_id, $use_acf = false) {
    // Get team member details from ACF fields
    $name = '';
    $designation = '';
    $image = '';
    $message = '';
    $message_visibility = true;
    
    // Get ACF fields using your specific field names
    if ($use_acf && function_exists('get_field')) {
        $name = get_field('name', $post_id);
        $designation = get_field('designation', $post_id);
        $image = get_field('image', $post_id);
        $message = get_field('message', $post_id);
        $message_visibility = get_field('message_visibility', $post_id);
    }
    
    // Use post title as fallback for name
    if (empty($name)) {
        $name = get_the_title($post_id);
    }
    
    // Image URL logic
    $image_url = '';
    $image_alt = $name;
    if (!empty($image) && is_array($image)) {
        $image_url = $image['sizes']['large'] ?? $image['url'];
        $image_alt = $image['alt'] ?? $name;
    } elseif (has_post_thumbnail($post_id)) {
        $image_url = get_the_post_thumbnail_url($post_id, 'large');
    }
    ?>
    <div class="highlighted-team-card py-12 px-4 sm:px-6 lg:px-8 rounded-3xl">
        <div class="flex flex-col lg:flex-row items-center gap-[118px] max-w-7xl mx-auto">
            <!-- Content Section -->
            <div class="lg:pr-8 text-left">
                <h6 class="text-[#016A7C]">Meet the Team</h6>
                <h2 class="w-[450px]">
                    Increase your <span>relationship potential.</span>
                </h2>
                
                <?php if (!empty($message) && $message_visibility) : ?>
                    <div class="font-lato text-[18px] text-[#757575] text-normal pt-[24px] pb-[40px] w-[600px]">
                        <?php echo wp_kses_post($message); ?>
                    </div>
                <?php endif; ?>
                <div class="mt-8">
                    <h3 class="text-[16px] font-normal font-lato tracking-widest text-[#1C2321] uppercase"><?php echo esc_html($name); ?></h3>
                    <?php if (!empty($designation)) : ?>
                        <p class="font-lato text-[20px] font-normal text-[#6E7370] mt-1"><?php echo esc_html($designation); ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Image Section --> 
            <div class="flex-shrink-0 relative flex flex-col items-center justify-center">
                <!-- Blob Background (SVG) -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[140%] h-[140%] -z-10">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full text-[#F0ECE4] fill-current opacity-60">
                        <path d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,81.6,-46.6C91.4,-34.1,98.1,-19.2,95.8,-5.3C93.5,8.6,82.2,21.5,70.6,32.3C59,43.1,47.1,51.8,34.8,58.6C22.5,65.4,9.8,70.3,-1.9,73.6C-13.6,76.9,-24.3,78.6,-34.4,73.6C-44.5,68.6,-54,56.9,-61.8,44.2C-69.6,31.5,-75.7,17.8,-76.8,3.5C-77.9,-10.8,-74,-25.7,-65.3,-37.8C-56.6,-49.9,-43.1,-59.2,-29.6,-66.8C-16.1,-74.4,-2.6,-80.3,10.3,-78.8C23.2,-77.3,30.5,-91.1,44.7,-76.4Z" transform="translate(100 100)" />
                    </svg>
                </div>
                
                <!-- Image -->
                <div class="relative w-[270px] h-[360px] md:w-[270px] rounded-full md:h-[360px] overflow-hidden shadow-xl">
                    <?php if (!empty($image_url)) : ?>
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="w-full h-full object-cover" />
                    <?php else : ?>
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mt-[80px]">
                     <a href="<?php echo esc_url(get_post_type_archive_link('/teams/')) ?>" class="inline-flex items-center px-6 py-3 bg-[#2A7F85] text-white font-medium rounded hover:bg-[#236C70] transition-colors">
                        Meet our team 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                     </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Team Member Single Shortcode
 * Usage: [team_member id="123"]
 */
function tov_team_member_shortcode($atts) {
    $atts = shortcode_atts(array(
        'id' => '',
        'name' => '',
        'use_acf' => 'true'
    ), $atts);

    if (empty($atts['id']) && empty($atts['name'])) {
        return '<p class="text-red-500">Error: Team member ID or name is required.</p>';
    }

    // Check if ACF is available
    $use_acf = $atts['use_acf'] === 'true' && function_exists('get_field');

    $args = array(
        'post_type' => 'team',
        'post_status' => 'publish',
        'posts_per_page' => 1,
    );

    if (!empty($atts['id'])) {
        $args['p'] = intval($atts['id']);
    } else {
        $args['name'] = sanitize_text_field($atts['name']);
    }

    $team_query = new WP_Query($args);

    if (!$team_query->have_posts()) {
        return '<p class="text-red-500">Team member not found.</p>';
    }

    ob_start();
    while ($team_query->have_posts()) {
        $team_query->the_post();
        tov_render_team_card(get_the_ID(), $use_acf);
    }
    wp_reset_postdata();
    
    return ob_get_clean();
}
add_shortcode('team_member', 'tov_team_member_shortcode');

/**
 * Team Department Filter Shortcode
 * Usage: [team_departments]
 */
function tov_team_departments_shortcode($atts) {
    $atts = shortcode_atts(array(
        'show_count' => 'true',
        'style' => 'list' // list, buttons, dropdown
    ), $atts);

    $departments = get_terms(array(
        'taxonomy' => 'team_department',
        'hide_empty' => true,
    ));

    if (empty($departments) || is_wp_error($departments)) {
        return '<p class="text-gray-500">No departments found.</p>';
    }

    ob_start();
    
    if ($atts['style'] === 'buttons') {
        echo '<div class="flex flex-wrap gap-2">';
        foreach ($departments as $department) {
            $count = $atts['show_count'] === 'true' ? ' (' . $department->count . ')' : '';
            echo '<a href="' . esc_url(get_term_link($department)) . '" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-200">';
            echo esc_html($department->name) . $count;
            echo '</a>';
        }
        echo '</div>';
    } elseif ($atts['style'] === 'dropdown') {
        echo '<select class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">';
        echo '<option value="">All Departments</option>';
        foreach ($departments as $department) {
            $count = $atts['show_count'] === 'true' ? ' (' . $department->count . ')' : '';
            echo '<option value="' . esc_url(get_term_link($department)) . '">' . esc_html($department->name) . $count . '</option>';
        }
        echo '</select>';
    } else {
        echo '<ul class="space-y-2">';
        foreach ($departments as $department) {
            $count = $atts['show_count'] === 'true' ? ' (' . $department->count . ')' : '';
            echo '<li><a href="' . esc_url(get_term_link($department)) . '" class="text-blue-600 hover:text-blue-800 transition-colors duration-200">';
            echo esc_html($department->name) . $count;
            echo '</a></li>';
        }
        echo '</ul>';
    }
    
    return ob_get_clean();
}
add_shortcode('team_departments', 'tov_team_departments_shortcode');

/**
 * Highlighted Team Member Shortcode
 * Usage: [highlighted_team_member]
 */
function tov_highlighted_team_member_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Team Member Spotlight',
        'subtitle' => 'Meet our team member',
        'layout' => 'card', // card, list, admin-style
        'style' => 'modern', // modern, admin-style, minimal
        'show_title' => 'true',
        'show_subtitle' => 'true'
    ), $atts);
    
    // Get the highlighted team member
    $highlighted_id = tov_get_highlighted_team_member();
    
    if (!$highlighted_id) {
        return '<div class="text-center py-8"><p class="text-gray-500">No featured team member selected.</p></div>';
    }
    
    // Check if ACF is available
    $use_acf = function_exists('get_field');
    
    ob_start();
    ?>
    <div class="highlighted-team-member bg-[#F9F7F2] py-24 sm:py-24">
        <div class="mx-auto max-w-[1280px] px-4 sm:px-6 lg:px-8">
            <!-- <?php if ($atts['show_title'] === 'true') : ?>
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                        <?php echo esc_html($atts['title']); ?>
                    </h2>
                    <?php if ($atts['show_subtitle'] === 'true') : ?>
                        <p class="text-blue-600">
                            <?php echo esc_html($atts['subtitle']); ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?> -->
            
            
            <?php
            // Render based on layout
            if ($atts['layout'] === 'list') {
                tov_render_team_list_item($highlighted_id, $use_acf);
            } elseif ($atts['layout'] === 'admin-style') {
                tov_render_team_admin_style($highlighted_id, $use_acf);
            } else {
                // Enhanced card layout for highlighted member
                tov_render_highlighted_team_card($highlighted_id, $use_acf);
            }
            ?>
        </div>
    </div>
    <?php
    
    return ob_get_clean();
}
add_shortcode('highlighted_team_member', 'tov_highlighted_team_member_shortcode');

/**
 * Render team member in admin-style layout
 */
function tov_render_team_admin_style($post_id, $use_acf = false) {
    // Get team member details from ACF fields
    $name = '';
    $designation = '';
    $image = '';
    $message = '';
    $message_visibility = true;
    
    // Get ACF fields using your specific field names
    if ($use_acf && function_exists('get_field')) {
        $name = get_field('name', $post_id);
        $designation = get_field('designation', $post_id);
        $image = get_field('image', $post_id);
        $message = get_field('message', $post_id);
        $message_visibility = get_field('message_visibility', $post_id);
    }
    
    // Use post title as fallback for name
    if (empty($name)) {
        $name = get_the_title($post_id);
    }
    
    // Get departments
    $departments = get_the_terms($post_id, 'team_department');
    $department_names = array();
    if ($departments && !is_wp_error($departments)) {
        foreach ($departments as $dept) {
            $department_names[] = $dept->name;
        }
    }
    ?>
    <div class="team-member-admin-card bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
        <!-- Header with image and name -->
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                        <?php 
                        // Use ACF image if available, otherwise fallback to featured image
                        if (!empty($image) && is_array($image)) {
                            $image_url = $image['sizes']['thumbnail'] ?? $image['url'];
                            $image_alt = $image['alt'] ?? $name;
                            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="w-full h-full object-cover" />';
                        } elseif (has_post_thumbnail($post_id)) {
                            echo get_the_post_thumbnail($post_id, 'thumbnail', array('class' => 'w-full h-full object-cover'));
                        } else {
                            ?>
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                        <?php echo esc_html($name); ?>
                    </h3>
                    <?php if (!empty($designation)) : ?>
                        <p class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                            <?php echo esc_html($designation); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Content section -->
        <div class="p-6">
            <?php if (!empty($message) && $message_visibility) : ?>
                <div class="mb-4">
                    <blockquote class="text-sm text-gray-600 dark:text-gray-400 italic border-l-4 border-blue-500 pl-4">
                        "<?php echo esc_html($message); ?>"
                    </blockquote>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($department_names)) : ?>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ($department_names as $dept_name) : ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                            <?php echo esc_html($dept_name); ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Footer with action buttons -->
        <div class="px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    <?php echo get_the_date('M j, Y', $post_id); ?>
                </span>
                <div class="flex space-x-2">
                    <a href="<?php echo get_permalink($post_id); ?>" class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
}