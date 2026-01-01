<?php
/**
 * Rooms and Facilities Hero Section Shortcode
 * Usage: 
 * [rooms_facilities_hero subheading="..." heading="..." description="..." button_text="..." button_url="..." image_url="..." image_alt="..."]
 *     [nested_shortcode]...[/nested_shortcode]
 * [/rooms_facilities_hero]
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function tov_rooms_facilities_hero_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'subheading' => '',
        'heading' => 'Discover the comforts of The Old Vicarage',
        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'button_text' => '',
        'button_url' => '',
        'image_url' => '',
        'image_alt' => 'Room at The Old Vicarage',
    ), $atts);
    
    $content = $content ?? '';
    $clean_content = !empty($content) ? do_shortcode(shortcode_unautop($content)) : '';
    
    ob_start();
    ?>
    <div class="overflow-hidden bg-[#FDFBF7]">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <!-- Left Column - Text Content -->
                <div class="bg-[#FDFBF7] px-6 py-12 sm:px-8 sm:py-16 md:px-12 md:py-24 lg:px-16 flex items-center">
                    <div class="max-w-xl mx-auto md:mx-0 md:max-w-lg w-full">
                        <?php if (!empty($atts['subheading'])) : ?>
                            <h6 class="text-[#016A7C]">
                                <?php echo esc_html($atts['subheading']); ?>
                            </h6>
                        <?php endif; ?>
                        
                        <?php if (!empty($atts['heading'])) : ?>
                            <h2 class="text-[#014854] mb-6">
                                <?php echo wp_kses_post($atts['heading']); ?>
                            </h2>
                        <?php endif; ?>
                        
                        <?php if (!empty($atts['description'])) : ?>
                            <p class="paragraph mt-6">
                                <?php echo esc_html($atts['description']); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if (!empty($atts['button_text']) && !empty($atts['button_url'])) : ?>
                            <div class="mt-8 w-full md:w-[200px]">
                                <a href="<?php echo esc_url($atts['button_url']); ?>" class="btn btn-primary bt-1 w-full md:w-[200px] justify-center">
                                    <?php echo esc_html($atts['button_text']); ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                        <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="white"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (!empty($clean_content)) : ?>
                            <div class="mt-8">
                                <?php echo $clean_content; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Right Column - Image -->
                <?php if (!empty($atts['image_url'])) : ?>
                    <div class="relative order-first md:order-last">
                        <div class="flex justify-center md:justify-start md:items-center md:h-full px-6 py-20 md:px-0 md:py-0">
                            <img src="<?php echo esc_url($atts['image_url']); ?>" 
                                 alt="<?php echo esc_attr($atts['image_alt']); ?>" 
                                 class="max-w-[400px] w-[400px] h-[500px] object-cover mt-0 md:mt-12 rounded-[32px]" />
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('rooms_facilities_hero', 'tov_rooms_facilities_hero_shortcode');
