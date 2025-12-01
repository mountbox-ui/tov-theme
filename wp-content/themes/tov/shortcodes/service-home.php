<?php
/**
 * Services Home Shortcode
 * 
 * Usage: [services_home bg_line_url="..." bg_gradient_url="..."]
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function tov_services_home_shortcode($atts) {
    $atts = shortcode_atts(array(
        'bg_line_url' => '', // Background line image
        'bg_gradient_url' => '', // Background gradient image
        'phone_number' => '01395 568208'
    ), $atts);
    
    // Services Data
    $services = array(
        array(
            'title' => 'Residential care',
            'desc' => 'As a residential care home we offer assistance with personal care, such as washing, dressing, bathing or showering. We can assist with getting up in the morning and going to bed at night, at a time which suits you. We can help with continence care, medical issues, medication administration and meal times.',
            'image' => '/wp-content/uploads/2025/11/residential-care.jpg',
            'link' => '#'
        ),
        array(
            'title' => 'Respite care',
            'desc' => 'Respite Care involves coming to stay with us for a short holiday, allowing your carer or loved ones to have a break and recharge their batteries, with peace of mind that you will be well looked after by us.',
            'image' => '/wp-content/uploads/2025/11/respite-care.jpg',
            'link' => '#'
        ),
        array(
            'title' => 'Dementia care',
            'desc' => 'Our approach to dementia care is of compassion, kindness and sensitivity, where residents are supported to live meaningful lives full of happiness, acceptance and contentment, irrespective of the type of dementia they live with and their symptoms at any given time.',
            'image' => '/wp-content/uploads/2025/11/dementia-care.jpg',
            'link' => '#'
        ),
    );
    
    ob_start();
    ?>
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Background Line Image -->
        <?php if (!empty($atts['bg_line_url'])) : ?>
            <div class="absolute left-0 top-0 w-full h-full pointer-events-none opacity-20">
                <img src="<?php echo esc_url($atts['bg_line_url']); ?>" alt="" class="w-full h-full object-cover">
            </div>
        <?php endif; ?>
        
        <!-- Background Gradient Image -->
        <?php if (!empty($atts['bg_gradient_url'])) : ?>
            <div class="absolute right-0 top-[50px] w-[400px] h-[400px] pointer-events-none opacity-30 hidden lg:block">
                <img src="<?php echo esc_url($atts['bg_gradient_url']); ?>" alt="" class="w-full h-full object-contain">
            </div>
        <?php endif; ?>
        
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            <!-- Header -->
            <div class="mb-16">
                <span class="block text-[#016A7C] font-lato text-[14px] font-medium leading-[12px] tracking-[3.6px] uppercase mb-4">
                    Our Care Services
                </span>
                <h2 class="text-[rgba(28,35,33,0.90)] font-jakarta text-[30px] font-semibold leading-[36px] tracking-[-0.5px] mb-8">
                    Compassionate care<br>
                    tailored to <span class="text-[rgba(28,35,33,0.90)] font-lora text-[30px] italic font-medium leading-[36px] tracking-[-0.5px]">every need</span>
                </h2>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <?php foreach ($services as $service) : ?>
                    <div class="group">
                        <!-- Image -->
                        <div class="relative rounded-2xl overflow-hidden mb-6 h-[240px]">
                            <img src="<?php echo esc_url($service['image']); ?>" 
                                 alt="<?php echo esc_attr($service['title']); ?>" 
                                 class="w-full h-full object-cover">
                        </div>
                        
                        <!-- Content -->
                        <div>
                            <h3 class="text-[#09090B] font-lato text-[20px] font-semibold leading-[28px] mb-3">
                                <?php echo esc_html($service['title']); ?>
                            </h3>
                            <p class="text-[#6A7282] font-sans text-[14px] font-normal leading-[22px] tracking-[-0.15px] mb-4">
                                <?php echo esc_html($service['desc']); ?>
                            </p>
                            <a href="<?php echo esc_url($service['link']); ?>" 
                               class="inline-flex items-center text-[#016A7C] font-lato text-[14px] font-normal hover:underline">
                                Learn more
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Call to Action -->
            <div class="text-center">
                <div class="inline-flex items-center gap-3 bg-[#016A7C] text-white px-8 py-4 rounded-full">
                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#016A7C]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <div class="text-[12px] font-lato font-normal opacity-90">CALL US TODAY</div>
                        <div class="text-[18px] font-lato font-bold"><?php echo esc_html($atts['phone_number']); ?></div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <?php
    return ob_get_clean();
}

add_shortcode('services_home', 'tov_services_home_shortcode');
