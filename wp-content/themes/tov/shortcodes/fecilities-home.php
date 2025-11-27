<?php
/**
 * Facilities Home Shortcode
 * 
 * Usage: [facilities_home]
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

function tov_facilities_home_shortcode($atts) {
    $atts = shortcode_atts(array(
        'button_url' => '#'
    ), $atts);
    
    // Facilities Data
    $facilities = array(
        array(
            'title' => 'BBQ Area',
            'desc' => 'Outdoor grilling spaces',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />'
        ),
        array(
            'title' => 'Hair Salon',
            'desc' => 'Professional styling services',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />'
        ),
        array(
            'title' => 'Café',
            'desc' => 'Premium coffee & snacks',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 1v3M10 1v3M14 1v3" />'
        ),
        array(
            'title' => 'Landscaped Gardens',
            'desc' => 'Beautiful outdoor spaces',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />' // Abstract tree/nature
        ),
        array(
            'title' => 'Cinema Room',
            'desc' => 'Private movie screenings',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />'
        ),
        array(
            'title' => 'Library',
            'desc' => 'Quiet reading sanctuary',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />'
        ),
        array(
            'title' => 'Couples Rooms',
            'desc' => 'Private intimate spaces',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />'
        ),
        array(
            'title' => 'Lounges',
            'desc' => 'Comfortable relaxation areas',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />' // Sofa-ish
        ),
        array(
            'title' => 'Craft Room',
            'desc' => 'Creative workshop space',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />' // Pen/Tool
        ),
        array(
            'title' => 'Pets Welcome',
            'desc' => 'Pet-friendly facilities',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />' // Warning/Paw placeholder - using generic for now, can refine
        ),
        array(
            'title' => 'Dining Rooms',
            'desc' => 'Elegant dining experiences',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />' // Cutlery
        ),
        array(
            'title' => 'Therapy Room',
            'desc' => 'Wellness & relaxation',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />' // Sparkles
        ),
    );
    
    ob_start();
    ?>
    <section class="py-24 bg-[#FDFBF7] relative overflow-hidden">
        <!-- Blurred gradient background -->
        <div class="absolute left-[186px] top-[877px] opacity-30 hidden lg:block" 
             style="width: 1357px; height: 719px; background: linear-gradient(135deg, #E8F1F2 0%, #FDFBF7 50%, #FFF5E1 100%); filter: blur(15px);">
        </div>
        
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            <div class="bg-white rounded-[32px] p-8 md:p-12 lg:p-16 shadow-sm">
                
                <!-- Header -->
                <div class="mb-16">
                    <span class="block text-[#016A7C] font-lato text-[14px] font-medium leading-[12px] tracking-[3.6px] uppercase mb-4">
                        Our Homely Facilities
                    </span>
                    <h2 class="text-[rgba(28,35,33,0.90)] font-jakarta text-[30px] font-semibold leading-[36px] tracking-[-0.5px] mb-8">
                        Facilities that feel like<br>
                        home <span class="text-[rgba(28,35,33,0.90)] font-lora text-[30px] italic font-medium leading-[36px] tracking-[-0.5px]">only better</span>
                    </h2>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12 mb-16">
                    <?php foreach ($facilities as $facility) : ?>
                        <div class="flex items-start gap-4 group">
                            <!-- Icon Box -->
                            <div class="flex-shrink-0 w-12 h-12 bg-[#E8F1F2] rounded-lg flex items-center justify-center text-[#2D7A7F] group-hover:bg-[#2D7A7F] group-hover:text-white transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <?php echo $facility['icon']; ?>
                                </svg>
                            </div>
                            
                            <!-- Content -->
                            <div>
                                <h3 class="text-[#09090B] font-lato text-[18px] font-semibold leading-[26px] mb-1">
                                    <?php echo esc_html($facility['title']); ?>
                                </h3>
                                <p class="text-[#6A7282] font-sans text-[14px] font-normal leading-[20px] tracking-[-0.15px]">
                                    <?php echo esc_html($facility['desc']); ?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Button -->
                <div>
                    <a href="<?php echo esc_url($atts['button_url']); ?>" class="inline-flex items-center px-8 py-4 bg-[#2D7A7F] text-white font-lato text-[16px] font-medium rounded-lg hover:bg-[#236064] transition-colors duration-300">
                        View more for Rooms & Facilities
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

add_shortcode('facilities_home', 'tov_facilities_home_shortcode');
