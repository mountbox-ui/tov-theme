<?php
/**
 * Culinary Spaces Section Shortcode
 * 
 * Usage:
 * [culinary_spaces heading="..." subheading="..."]
 *     [space_item title="..." description="..." image="..."]
 *     [space_item title="..." description="..." image="..."]
 * [/culinary_spaces]
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Main culinary spaces section shortcode
 */
function tov_culinary_spaces_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'heading' => 'Culinary delights and social spaces',
        'subheading' => 'We understand that food and good company are central to a happy life.',
    ), $atts);
    
    $content = $content ?? '';
    $clean_content = !empty($content) ? do_shortcode(shortcode_unautop($content)) : '';
    
    ob_start();
    ?>
    <div class="bg-[#F5F3EE] py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Section Heading -->
            <div class="mb-12">
                <h2 class="text-[#014854] mb-4">
                    <?php echo wp_kses_post($atts['heading']); ?>
                </h2>
                <?php if (!empty($atts['subheading'])) : ?>
                    <p class="paragraph text-lg text-gray-600 max-w-3xl">
                        <?php echo esc_html($atts['subheading']); ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <!-- Left Column - Text Content -->
                <div class="lg:col-span-4 space-y-6">
                    <?php echo $clean_content; ?>
                </div>
                
                <!-- Right Column - Image Grid -->
                <div class="lg:col-span-8">
                    <div id="culinary-image-grid" class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Images will be added here by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Collect all images from space items
        const spaceItems = document.querySelectorAll('.culinary-space-item');
        const imageGrid = document.getElementById('culinary-image-grid');
        
        if (imageGrid && spaceItems.length > 0) {
            imageGrid.innerHTML = ''; // Clear existing content
            
            spaceItems.forEach(function(item, index) {
                const img = item.getAttribute('data-image');
                const title = item.getAttribute('data-title');
                
                if (img) {
                    const col = document.createElement('div');
                    
                    // First image - larger, spans full width, reduced height
                    if (index === 0) {
                        col.className = 'relative group overflow-hidden rounded-2xl sm:col-span-3';
                        col.style.height = '280px';
                    } else if (index === 1) {
                        // Second image (Cafe) - wider, spans 2 columns
                        col.className = 'relative group overflow-hidden rounded-2xl sm:col-span-2';
                        col.style.height = '220px';
                    } else {
                        // Third image (Lounges) - narrower, spans 1 column
                        col.className = 'relative group overflow-hidden rounded-2xl sm:col-span-1';
                        col.style.height = '220px';
                    }
                    
                    col.innerHTML = `
                        <img src="${img}" alt="${title}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" style="object-fit: cover; object-position: top;" />
                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                            <p class="text-white font-medium text-sm">${title}</p>
                        </div>
                    `;
                    imageGrid.appendChild(col);
                }
            });
        }
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('culinary_spaces', 'tov_culinary_spaces_shortcode');

/**
 * Individual space item shortcode (Left column content)
 */
function tov_space_item_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'Space Title',
        'description' => '',
        'image' => '',
        'icon' => '', // Optional icon
    ), $atts);
    
    ob_start();
    ?>
    <div class="culinary-space-item flex gap-4 items-start" 
         data-image="<?php echo esc_attr($atts['image']); ?>" 
         data-title="<?php echo esc_attr($atts['title']); ?>">
        
        <?php if (!empty($atts['icon'])) : ?>
            <div class="flex-shrink-0 w-8 h-8 mt-1">
                <img src="<?php echo esc_url($atts['icon']); ?>" alt="" class="w-full h-full object-contain opacity-60" />
            </div>
        <?php else : ?>
            <div class="flex-shrink-0 w-2 h-2 mt-3 bg-[#016A7C] rounded-full"></div>
        <?php endif; ?>
        
        <div>
            <h3 class="text-xl font-semibold text-[#014854] mb-2">
                <?php echo esc_html($atts['title']); ?>
            </h3>
            
            <?php if (!empty($atts['description'])) : ?>
                <p class="text-base text-gray-600 leading-relaxed">
                    <?php echo esc_html($atts['description']); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('space_item', 'tov_space_item_shortcode');

