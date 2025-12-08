<?php
/**
 * Image Section Shortcode
 * [image_section position="left"]
 *    [image_section_image src="image.jpg" alt="Alt text"]
 *    [image_section_content title="Title" button_text="Click" button_url="#"]Content[/image_section_content]
 * [/image_section]
 */

if (!defined('ABSPATH')) exit;

function tov_image_section_shortcode($atts, $content = null) {
    $atts = shortcode_atts(['position' => 'left'], $atts);
    
    // Parse nested shortcodes
    $pattern = get_shortcode_regex(['image_section_content', 'image_section_image']);
    preg_match_all('/'.$pattern.'/s', $content, $matches);
    
    $image_content = '';
    $text_content = '';
    
    if (!empty($matches[0])) {
        foreach ($matches[0] as $shortcode) {
            if (strpos($shortcode, 'image_section_content') !== false) {
                $text_content = do_shortcode($shortcode);
            } elseif (strpos($shortcode, 'image_section_image') !== false) {
                $image_content = do_shortcode($shortcode);
            }
        }
    }
    
    ob_start();
    ?>
    <section class="max-w-[1280px] mx-auto relative z-10 py-[60px]">
        <div>
            <div class="flex flex-col gap-8 sm:gap-12 lg:gap-16 <?php echo $atts['position'] === 'right' ? 'lg:flex-row-reverse' : 'lg:flex-row'; ?> items-center">
                <!-- Text Content -->
                <div class="w-full lg:w-[35%] text-left">
                    <?php echo $text_content; ?>
                </div>
                <!-- Image Content -->
                <div class="w-full lg:w-[60%]">
                    <?php echo $image_content; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function tov_image_section_image_shortcode($atts, $content = null) {
    $atts = shortcode_atts(['src' => '', 'alt' => ''], $atts);
    $src = empty($atts['src']) ? trim($content) : $atts['src'];
    if (empty($src)) return '';
    
    return sprintf(
        '<img src="%s" alt="%s" class="w-full h-auto rounded-[30px]">',
        esc_url($src),
        esc_attr($atts['alt'])
    );
}

function tov_image_section_content_shortcode($atts, $content = null) {
    $atts = shortcode_atts([
        'title' => '',
        'button_text' => '',
        'button_url' => ''
    ], $atts);
    
    ob_start();
    ?>
    <div class="content-container">
        <?php if (!empty($atts['title'])) : ?>
            <h2>
                <?php echo wp_kses_post($atts['title']); ?>
            </h2>
        <?php endif; ?>
        
        <div class="paragraph text-base lg:text-lg leading-relaxed mb-4">
            <?php echo wp_kses_post($content); ?>
        </div>
        
        <!-- <?php if (!empty($atts['button_text']) && !empty($atts['button_url'])) : ?>
            <a href="<?php echo esc_url($atts['button_url']); ?>" 
               class="inline-block text-[#8B6F47] font-medium hover:underline">
                <?php echo esc_html($atts['button_text']); ?>
            </a>
        <?php endif; ?> -->
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('image_section', 'tov_image_section_shortcode');
add_shortcode('image_section_image', 'tov_image_section_image_shortcode');
add_shortcode('image_section_content', 'tov_image_section_content_shortcode');
