<?php
/**
 * Icons Right Section Shortcode
 * 
 * Usage:
 * [icons_right heading="..." description="..." button_text="..." button_url="..." icons_heading="..."]
 *     [icon_item image="..." alt="..." width="105" height="48" heading="Item Title"]
 *     [icon_item image="..." alt="..." width="104" height="48" heading="Item Title"]
 * [/icons_right]
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main icons right section shortcode
 */
function tov_icons_right_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'heading' => 'Trusted by the most innovative teams',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Et, egestas tempus tellus etiam sed. Quam a scelerisque amet ullamcorper eu enim et fermentum, augue.',
        'button_text' => 'Create account',
        'button_url' => '#',
        'icons_heading' => '',
    ), $atts);
    
    $content = $content ?? '';
    $clean_content = !empty($content) ? do_shortcode(shortcode_unautop($content)) : '';
    
    ob_start();
    ?>
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-x-8 gap-y-16 lg:grid-cols-2">
                
                <!-- Left Column - Text Content -->
                <div class="mx-auto w-full max-w-xl lg:mx-0">
                    <h2>
                        <?php echo wp_kses_post($atts['heading']); ?>
                    </h2>
                    
                    <p class="mt-6 paragraph text-gray-600">
                        <?php echo esc_html($atts['description']); ?>
                    </p>
                    
                    <div class="mt-8 flex items-center gap-x-6">
                        <?php if (!empty($atts['button_text']) && !empty($atts['button_url'])) : ?>
                            <a href="<?php echo esc_url($atts['button_url']); ?>" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <?php echo esc_html($atts['button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Right Column - Icons/Logos Grid -->
                <div class="mx-auto grid w-full max-w-xl grid-cols-2 items-center gap-y-12 sm:gap-y-14 lg:mx-0 lg:max-w-none lg:pl-8">
                    <?php if (!empty($atts['icons_heading'])) : ?>
                        <div class="col-span-2 mb-4">
                            <h3 class="text-2xl font-semibold text-gray-900">
                                <?php echo wp_kses_post($atts['icons_heading']); ?>
                            </h3>
                        </div>
                    <?php endif; ?>
                    
                    <?php echo $clean_content; ?>
                </div>
                
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('icons_right', 'tov_icons_right_shortcode');

/**
 * Individual icon item shortcode (Right column content)
 */
function tov_icon_item_shortcode($atts) {
    $atts = shortcode_atts(array(
        'image' => '',
        'alt' => '',
        'width' => '105',
        'height' => '48',
        'heading' => '',
    ), $atts);
    
    ob_start();
    ?>
    <div class="flex flex-col gap-4">
        <?php if (!empty($atts['heading'])) : ?>
            <h4 class="text-lg font-semibold text-gray-900">
                <?php echo esc_html($atts['heading']); ?>
            </h4>
        <?php endif; ?>
        
        <img width="<?php echo esc_attr($atts['width']); ?>" 
             height="<?php echo esc_attr($atts['height']); ?>" 
             src="<?php echo esc_url($atts['image']); ?>" 
             alt="<?php echo esc_attr($atts['alt']); ?>" 
             class="max-h-12 w-full object-contain object-left" />
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('icon_item', 'tov_icon_item_shortcode');
