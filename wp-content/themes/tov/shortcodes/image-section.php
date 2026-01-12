<?php
/**
 * Image Section Shortcode
 * 
 * Usage:
 * [image_section]
 *     [image_section_content label="Deploy faster" title="A better workflow" description="Lorem ipsum..."]
 *         [image_section_feature icon="clock" title="Push to deploy."]Lorem ipsum description[/image_section_feature]
 *         [image_section_feature icon="lock" title="SSL certificates."]Anim aute id magna...[/image_section_feature]
 *         [image_section_feature icon="database" title="Database backups."]Ac tincidunt sapien...[/image_section_feature]
 *     [/image_section_content]
 *     [image_section_image src="image.jpg" alt="Product screenshot"]
 * [/image_section]
 */

if (!defined('ABSPATH')) exit;

function tov_image_section_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        'position' => 'left' // left = content left/image right, right = image left/content right
    ], $atts);
    
    // Parse nested shortcodes - improved method
    $image_content = '';
    $text_content = '';
    
    if (!empty($content)) {
        // Extract image_section_content shortcode using WP native regex
        $content_pattern = get_shortcode_regex(['image_section_content']);
        if (preg_match("/$content_pattern/s", $content, $content_match)) {
            $text_content = do_shortcode($content_match[0]);
        }
        
        // Extract image_section_image shortcode using WP native regex
        $image_pattern = get_shortcode_regex(['image_section_image']);
        if (preg_match("/$image_pattern/s", $content, $image_match)) {
            $image_content = do_shortcode($image_match[0]);
        }
    }
    
    // Determine layout order (case-insensitive)
    // position="left" (default) = content left (40%), image right (60%)
    // position="right" = image left (60%), content right (40%)
    $position = strtolower(trim($atts['position']));
    $swap_order = ($position === 'right');
    
    ob_start();
    ?>
    <div class="overflow-hidden bg-white mb-0 lg:mb-24">
        <div class="max-w-[1280px] mx-auto mt-14 relative z-10">
            <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:gap-y-20 lg:grid-cols-10">
                <?php if ($swap_order) : ?>
                    <!-- Image on LEFT when position="right" (60% width) -->
                    <div class="lg:col-span-6 order-1 lg:order-1 overflow-hidden">
                        <?php echo $image_content; ?>
                    </div>
                    <!-- Content on RIGHT when position="right" (40% width) -->
                    <div class="lg:col-span-4 lg:pl-8 lg:pt-4 order-2 lg:order-2">
                        <?php echo $text_content; ?>
                    </div>
                <?php else : ?>
                    <!-- Content on LEFT when position="left" or default (40% width) -->
                    <!-- On mobile: order-2 (shows second), on desktop: order-1 (shows first) -->
                    <div class="lg:col-span-4 lg:pr-8 lg:pt-4 order-2 lg:order-1">
                        <?php echo $text_content; ?>
                    </div>
                    <!-- Image on RIGHT when position="left" or default (60% width) -->
                    <!-- On mobile: order-1 (shows first), on desktop: order-2 (shows second) -->
                    <div class="lg:col-span-6 order-1 lg:order-2 overflow-hidden">
                        <?php echo $image_content; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function tov_image_section_content_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        'label' => '',
        'title' => '',
        'description' => ''
    ], $atts);
    
    // Extract feature items from content
    $features = array();
    if (!empty($content)) {
        // Improved regex to match feature shortcodes with nested content
        if (preg_match_all('/\[image_section_feature([^\]]*)\](.*?)\[\/image_section_feature\]/s', $content, $feature_matches, PREG_SET_ORDER)) {
            foreach ($feature_matches as $match) {
                $features[] = do_shortcode($match[0]);
            }
        }
    }
    
    ob_start();
    ?>
    <div class="lg:max-w-lg">
        <?php if (!empty($atts['label'])) : ?>
            <h6 class="text-[#016A7C]"><?php echo esc_html($atts['label']); ?></h6>
        <?php endif; ?>
        
        <?php if (!empty($atts['title'])) : ?>
            <h3 class="text-[#1C2321] font-jakarta text-2xl font-bold mb-3"><?php echo esc_html($atts['title']); ?></h3>
        <?php endif; ?>
        
        <?php if (!empty($atts['description'])) : ?>
            <p class="paragraph"><?php echo esc_html($atts['description']); ?></p>
        <?php endif; ?>
        
        <?php if (!empty($features)) : ?>
            <dl class="mt-6 paragraph">
                <?php foreach ($features as $feature) : ?>
                    <?php echo $feature; ?>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}

function tov_image_section_feature_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        'icon' => 'clock', // clock, lock, database, or custom SVG path
        'title' => ''
    ], $atts);
    
    // Get icon SVG based on icon name
    $icon_svg = tov_get_feature_icon($atts['icon']);
    
    ob_start();
    ?>
    <div class="relative pl-9">
        <?php if ($icon_svg) : ?>
            <span class="absolute left-0 top-[6px]">
                <?php echo $icon_svg; ?>
            </span>
        <?php endif; ?>
        <div>
            <?php if (!empty($atts['title'])) : ?>
                <dt class="font-semibold text-[#016A7C]  paragraph">
                    <?php echo esc_html($atts['title']); ?>
                </dt>
            <?php endif; ?>
            <?php if (!empty($content)) : ?>
                <dd class="paragraph mb-2"><?php echo wp_kses_post(trim($content)); ?></dd>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function tov_get_feature_icon($icon_name) {
    // Always return tick mark icon inside a circle with #016A7C fill color
    // Circle background with tick mark centered inside
    return '<svg viewBox="0 0 20 20" data-slot="icon" aria-hidden="true" class="w-5 h-5"><circle cx="10" cy="10" r="9" fill="#E0F2F1"/><path d="M16.707 5.293a1 1 0 0 1 0 1.414l-7 7a1 1 0 0 1-1.414 0l-3.5-3.5a1 1 0 1 1 1.414-1.414L9 11.586l6.293-6.293a1 1 0 0 1 1.414 0Z" fill="#016A7C"/></svg>';
}

function tov_image_section_image_shortcode($atts, $content = null) {
    // Define default classes separately
    $default_classes = 'w-full h-auto rounded-xl shadow-xl ring-1 ring-gray-400/10';

    $atts = shortcode_atts([
        'src' => '',
        'alt' => 'Product screenshot',
        'width' => '2432',
        'height' => '1442',
        'class' => $default_classes, // Default to strict existing classes
        'style' => ''
    ], $atts);
    
    // Get src from attribute or content
    $src = !empty($atts['src']) ? $atts['src'] : trim($content);
    
    // If still empty, return placeholder
    if (empty($src)) {
        return '<div class="w-full h-[32rem] bg-gray-100 rounded-xl shadow-xl ring-1 ring-gray-400/10 flex items-center justify-center text-gray-400">
            <span>Image not specified</span>
        </div>';
    }
    
    // Handle relative URLs - convert to absolute if needed
    if (strpos($src, 'http') !== 0 && strpos($src, '//') !== 0) {
        // If it's a relative path, try to make it absolute
        if (strpos($src, '/') === 0) {
            // Already absolute path from root
        } else {
            // Relative path, prepend theme directory
            $src = get_template_directory_uri() . '/' . ltrim($src, '/');
        }
    }
    
    $style_attr = !empty($atts['style']) ? ' style="' . esc_attr($atts['style']) . '"' : '';

    return sprintf(
        '<img width="%s" height="%s" src="%s" alt="%s" class="%s"%s />',
        esc_attr($atts['width']),
        esc_attr($atts['height']),
        esc_url($src),
        esc_attr($atts['alt']),
        esc_attr($atts['class']),
        $style_attr
    );
}

add_shortcode('image_section', 'tov_image_section_shortcode');
add_shortcode('image_section_content', 'tov_image_section_content_shortcode');
add_shortcode('image_section_feature', 'tov_image_section_feature_shortcode');
add_shortcode('image_section_image', 'tov_image_section_image_shortcode');
