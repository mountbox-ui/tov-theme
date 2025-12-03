<?php
/**
 * FAQ Section Shortcodes
 * 
 * Provides nested shortcodes for creating FAQ sections with collapsible answers
 * 
 * Usage:
 * [faq_section title="Frequently Asked Questions" subtitle="Find answers to common questions"]
 *     [faq_item question="What is your service?" answer="Our service provides..."]
 *     [faq_item question="How much does it cost?" answer="The pricing varies..."]
 * [/faq_section]
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main FAQ Section Shortcode
 * 
 * @param array $atts Shortcode attributes
 * @param string $content Shortcode content (contains faq_item shortcodes)
 * @return string HTML output
 */
function tov_faq_section_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        // Visual + behavior
        'style' => 'modern', // modern, minimal, card
        'layout' => 'accordion', // accordion, grid
        'show_icons' => 'true',
        'animation' => 'true',
        'dark_mode' => 'false', // Enable dark mode
        'class' => '',
        'id' => ''
    ), $atts);
    
    // Generate unique ID for the FAQ section
    $faq_id = !empty($atts['id']) ? $atts['id'] : 'faq-section-' . uniqid();
    
    // Process the content to extract FAQ items
    $faq_items = array();
    if (!empty($content)) {
        // Extract FAQ items directly from the raw content
        $faq_items = tov_extract_faq_items_from_raw($content);
        
        // Debug mode available for troubleshooting if needed
        // Add ?debug_faq=1 to URL to enable debugging
    }
    
    // Start output buffering
    ob_start();
    ?>
    <div class="<?php echo ($atts['dark_mode'] === 'true') ? 'dark' : ''; ?> <?php echo esc_attr($atts['class']); ?>" id="<?php echo esc_attr($faq_id); ?>" 
         data-style="<?php echo esc_attr($atts['style']); ?>" 
         data-layout="<?php echo esc_attr($atts['layout']); ?>">
        <div class="bg-[#FAF8F4] text-gray-900 dark:bg-gray-900 dark:text-gray-50">
            <div class="max-w-4xl mx-auto px-6 py-24 sm:px-6 sm:py-32 lg:px-8 lg:py-[80px]">
                
                <!-- Header -->
                <div class="text-start mb-[40px]">
                    <h2 class="font-jakarta text-[40px] leading-[48px] font-semibold mb-8 sm:text-[40px] md:text-5xl">FAQ</h2>
                </div>

                <!-- FAQ List -->
                <div class="mb-12">
                    <dl class="flex flex-col divide-y divide-gray-900/10 dark:divide-white/10" data-animation="<?php echo esc_attr($atts['animation']); ?>">
                        <?php if (!empty($faq_items)): ?>
                            <?php foreach ($faq_items as $index => $item): ?>
                                <?php tov_render_faq_item($item, $index, $atts); ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center text-gray-500 dark:text-gray-400 italic py-10 px-5">No FAQ items found.</p>
                        <?php endif; ?>
                    </dl>
                </div>

                <!-- Button -->
                <div class="">
                    <a href="<?php echo home_url('/contact-us/'); ?>" class="inline-flex items-center gap-2 bg-[#016A7C] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#015a69] transition-colors">
                        Contact Us Now 
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 11L11 1M11 1H1M11 1V11" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Removed embedded styles; now using Tailwind utility classes -->
    
    
    <!-- FAQ JavaScript -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqSection = document.getElementById('<?php echo esc_js($faq_id); ?>');
        if (!faqSection) return;
        
        const faqQuestions = faqSection.querySelectorAll('.faq-question');
        
        faqQuestions.forEach((question) => {
            question.addEventListener('click', function() {
                const answerId = this.getAttribute('aria-controls');
                const answer = answerId ? faqSection.querySelector('#' + answerId) : null;
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                
                if (!answer) return;
                
                // Toggle aria-expanded attribute
                const newExpanded = !isExpanded;
                this.setAttribute('aria-expanded', newExpanded);
                
                // Smooth animation for expanding/collapsing
                if (newExpanded) {
                    // Opening
                    answer.classList.remove('hidden');
                    answer.style.maxHeight = '0px';
                    answer.style.opacity = '0';
                    answer.style.overflow = 'hidden';
                    answer.style.transition = 'max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    
                    // Force reflow
                    answer.offsetHeight;
                    
                    // Animate to full height
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    answer.style.opacity = '1';
                    
                    // Remove max-height after animation completes
                    setTimeout(() => {
                        answer.style.maxHeight = 'none';
                        answer.style.overflow = 'visible';
                    }, 420);
                } else {
                    // Closing
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    answer.style.overflow = 'hidden';
                    answer.style.transition = 'max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                    
                    // Force reflow
                    answer.offsetHeight;
                    
                    // Animate to zero height and opacity simultaneously
                    requestAnimationFrame(() => {
                        answer.style.maxHeight = '0px';
                        answer.style.opacity = '0';
                    });
                    
                    // Hide after animation completes - wait a bit longer to ensure smooth finish
                    setTimeout(() => {
                        answer.classList.add('hidden');
                        answer.style.maxHeight = '';
                        answer.style.opacity = '';
                        answer.style.overflow = '';
                        answer.style.transition = '';
                    }, 420);
                }
                
                // Smooth scroll to FAQ item if it's opening
                if (newExpanded && faqSection.dataset.animation === 'true') {
                    setTimeout(() => {
                        answer.scrollIntoView({ 
                            behavior: 'smooth', 
                            block: 'center' 
                        });
                    }, 100);
                }
            });
        });
        
        // Keyboard navigation
        faqQuestions.forEach(question => {
            question.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
        });
    });
    </script>
    
    <?php
    return ob_get_clean();
}

/**
 * Individual FAQ Item Shortcode
 * 
 * @param array $atts Shortcode attributes
 * @param string $content Shortcode content (the answer)
 * @return string HTML output
 */
function tov_faq_item_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'question' => '',
        'answer' => '',
        'class' => '',
        'id' => ''
    ), $atts);
    
    // Use content as answer if answer attribute is not provided
    $answer = !empty($content) ? trim($content) : $atts['answer'];
    
    if (empty($atts['question']) || empty($answer)) {
        return '<p class="text-red-600 dark:text-red-400 p-4">FAQ item missing question or answer.</p>';
    }
    
    // Generate unique ID for the FAQ item
    $item_id = !empty($atts['id']) ? $atts['id'] : 'faq-item-' . uniqid();
    
    ob_start();
    ?>
    <div class="py-6 first:pt-0 last:pb-0 last:border-b-0 border-b border-gray-900/10 dark:border-white/10 <?php echo esc_attr($atts['class']); ?>" id="<?php echo esc_attr($item_id); ?>">
        <dt>
            <button class="faq-question group flex w-full items-start justify-between text-left text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 transition-colors" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($item_id); ?>-answer">
                <span class="font-jakarta text-[20px] leading-[26px] font-semibold flex-1"><?php echo esc_html($atts['question']); ?></span>
                <span class="ml-6 flex h-8 w-8 items-center justify-center shrink-0 rounded-full bg-[#E2A76F] transition-colors group-hover:bg-[#0f172a]">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#111111" stroke-width="1.5" class="size-4 icon-plus transition-all" aria-hidden="true">
                        <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" class="size-4 icon-minus hidden transition-all" aria-hidden="true">
                        <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </button>
        </dt>
        <dd class="mt-2 pr-12 sm:pr-0 hidden" id="<?php echo esc_attr($item_id); ?>-answer">
            <div class="font-lato text-[18px] leading-[26px] font-normal text-[#757575]">
                <?php echo wpautop(do_shortcode($answer)); ?>
            </div>
        </dd>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Extract FAQ items from raw content (before shortcode processing)
 * 
 * @param string $content Raw shortcode content
 * @return array Array of FAQ items
 */
function tov_extract_faq_items_from_raw($content) {
    $faq_items = array();
    
    // Extract all faq_item shortcodes
    $pattern = '/\[faq_item\s+([^\]]+)\]([^\[]*(?:\[[^\]]*\][^\[]*)*)\[\/faq_item\]/s';
    preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
    
    if (empty($matches)) {
        // Try self-closing tags
        $pattern = '/\[faq_item\s+([^\]]+)\]/';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
    }
    
    foreach ($matches as $match) {
        $attributes_string = isset($match[1]) ? $match[1] : '';
        $content_part = isset($match[2]) ? $match[2] : '';
        
        // Parse attributes
        $attributes = shortcode_parse_atts($attributes_string);
        
        $question = isset($attributes['question']) ? $attributes['question'] : '';
        $answer = '';
        
        // Check if answer is in attributes or content
        if (isset($attributes['answer'])) {
            $answer = $attributes['answer'];
        } elseif (!empty($content_part)) {
            $answer = trim($content_part);
        }
        
        if (!empty($question)) {
            $faq_items[] = array(
                'question' => $question,
                'answer' => $answer,
                'icon' => isset($attributes['icon']) ? $attributes['icon'] : 'plus',
                'class' => isset($attributes['class']) ? $attributes['class'] : '',
                'id' => isset($attributes['id']) ? $attributes['id'] : ''
            );
        }
    }
    
    return $faq_items;
}

/**
 * Extract FAQ items from content (legacy function)
 * 
 * @param string $content Shortcode content
 * @return array Array of FAQ items
 */
function tov_extract_faq_items($content) {
    // Legacy function removed: no longer used
    return array();
}

/**
 * Render individual FAQ item
 * 
 * @param array $item FAQ item data
 * @param int $index Item index
 * @param array $section_atts Section attributes
 * @return void
 */
function tov_render_faq_item($item, $index, $section_atts) {
    $item_id = !empty($item['id']) ? $item['id'] : 'faq-item-' . uniqid();
    $layout = isset($section_atts['layout']) ? $section_atts['layout'] : 'accordion';
    
    // Different styling for grid vs accordion layout
    if ($layout === 'grid') {
        ?>
        <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white p-6 <?php echo esc_attr($item['class']); ?>" id="<?php echo esc_attr($item_id); ?>">
            <dt>
                <button class="faq-question group flex w-full items-start justify-between text-left text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500 transition-colors" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($item_id); ?>-answer">
                    <span class="font-jakarta text-[20px] leading-[26px] font-semibold flex-1"><?php echo esc_html($item['question']); ?></span>
                    <span class="ml-4 flex h-8 w-8 items-center justify-center shrink-0 rounded-full bg-[#222222]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" class="size-4 icon-plus transition-all" aria-hidden="true">
                            <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" class="size-4 icon-minus hidden transition-all" aria-hidden="true">
                            <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </dt>
            <dd class="mt-2 hidden" id="<?php echo esc_attr($item_id); ?>-answer">
                <div class="font-lato text-[18px] leading-[26px] font-normal text-[#757575]">
                    <?php echo wpautop(do_shortcode($item['answer'])); ?>
                </div>
            </dd>
        </div>
        <?php
    } else {
        // Accordion layout
        ?>
        <div class="py-6 first:pt-0 last:pb-0 last:border-b-0 border-b border-gray-900/10 dark:border-white/10 <?php echo esc_attr($item['class']); ?>" id="<?php echo esc_attr($item_id); ?>">
            <dt>
                <button class="faq-question group flex w-full items-start justify-between text-left text-gray-900 dark:text-white hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none transition-colors" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr($item_id); ?>-answer">
                    <span class="font-jakarta text-[20px] leading-[26px] font-semibold flex-1 pt-1"><?php echo esc_html($item['question']); ?></span>
                    <span class="ml-6 flex h-8 w-8 items-center justify-center shrink-0 rounded-full bg-[#E2A76F] transition-colors group-aria-expanded:bg-[#273A29]">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3.5" class="size-4 icon-plus transition-all duration-300 group-aria-expanded:rotate-90 group-aria-expanded:opacity-0 absolute" aria-hidden="true">
                            <path d="M12 6v12m6-6H6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3.5" class="size-4 icon-minus transition-all duration-300 opacity-0 group-aria-expanded:opacity-100 absolute" aria-hidden="true">
                            <path d="M18 12H6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </dt>
            <dd class="mt-4 pr-12 sm:pr-0 hidden" id="<?php echo esc_attr($item_id); ?>-answer">
                <div class="font-lato text-[18px] leading-[26px] font-normal text-[#757575]">
                    <?php echo wpautop(do_shortcode($item['answer'])); ?>
                </div>
            </dd>
        </div>
        <?php
    }
}

/**
 * Get FAQ icon HTML
 * 
 * @param string $icon_type Icon type
 * @return string Icon HTML
 */
// Removed unused icon helper

// Register shortcodes
add_shortcode('faq_section', 'tov_faq_section_shortcode');
add_shortcode('faq_item', 'tov_faq_item_shortcode');

// Add shortcode to functions.php include
if (!function_exists('tov_load_faq_shortcodes')) {
    function tov_load_faq_shortcodes() {
        // This function can be used to conditionally load the shortcodes
        return true;
    }
}

// Removed demo [faq_block] shortcode and related code
?>
