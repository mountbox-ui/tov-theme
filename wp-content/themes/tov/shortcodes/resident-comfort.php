<?php
/**
 * Resident Comfort Section Shortcode
 * 
 * Usage:
 * [resident_comfort heading="Resident Comfort" subheading="Experience luxury and care"]
 *     [comfort_item image="url" title="Title" date="Date" author="Author" author_image="url" link="url"]
 *     [comfort_item image="url" title="Title" date="Date" author="Author" author_image="url" link="url"]
 * [/resident_comfort]
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main resident comfort section shortcode
 */
function tov_resident_comfort_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'heading' => 'Resident comfort & support',
        'subheading' => 'Discover the exceptional care and amenities we provide for our residents.',
    ), $atts);
    
    $content = $content ?? '';
    $clean_content = !empty($content) ? do_shortcode(shortcode_unautop($content)) : '';
    
    ob_start();
    ?>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="max-w-2xl">
                <h2>
                    <?php echo wp_kses_post($atts['heading']); ?>
                </h2>
                <?php if (!empty($atts['subheading'])) : ?>
                    <p class="paragraph">
                        <?php echo esc_html($atts['subheading']); ?>
                    </p>
                <?php endif; ?>
            </div>
            
                <div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                <?php echo $clean_content; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('resident_comfort', 'tov_resident_comfort_shortcode');

/**
 * Individual comfort item shortcode
 */
function tov_comfort_item_shortcode($atts) {
    $atts = shortcode_atts(array(
        'image' => '',
        'title' => 'Comfort Item',
        'description' => '',
        'link' => '#',
    ), $atts);
    
    ob_start();
    ?>
    <style>
        .comfort-card-hover img {
            transition: transform 0.5s ease;
        }
        .comfort-card-hover:hover img {
            transform: scale(1.1);
        }
    </style>
    <article class="comfort-card-hover relative overflow-hidden rounded-2xl cursor-pointer" style="height: 320px; min-height: 320px;">
        <?php if (!empty($atts['image'])) : ?>
            <div class="absolute inset-0 w-full h-full" style="position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
                <img src="<?php echo esc_url($atts['image']); ?>" 
                     alt="<?php echo esc_attr($atts['title']); ?>" 
                     class="w-full h-full object-cover" 
                     style="display: block; width: 100%; height: 100%; object-fit: cover;" />
            </div>
        <?php endif; ?>
        
        <!-- Dark gradient overlay -->
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 50%, rgba(0,0,0,0) 100%); pointer-events: none;"></div>
        
        <!-- Content on top -->
        <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 24px; z-index: 10; pointer-events: none;">
            <h3 class="font-semibold" style="color: #ffffff; font-size: 18px; line-height: 1.4; margin: 0;">
                <a href="<?php echo esc_url($atts['link']); ?>" style="color: #ffffff; text-decoration: none; pointer-events: all;">
                    <?php echo esc_html($atts['title']); ?>
                </a>
            </h3>
            
            <?php if (!empty($atts['description'])) : ?>
                <p style="color: #e5e7eb; font-size: 14px; line-height: 1.5; margin-top: 8px; margin-bottom: 0;">
                    <?php echo esc_html($atts['description']); ?>
                </p>
            <?php endif; ?>
        </div>
    </article>
    <?php
    return ob_get_clean();
}
add_shortcode('comfort_item', 'tov_comfort_item_shortcode');

