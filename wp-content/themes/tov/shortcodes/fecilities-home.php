<?php
/**
 * Facilities Home Shortcode
 * Usage: [facilities_home]
 */

function tov_facilities_home_shortcode($atts) {
    ob_start();
    
    $facilities = [
        [
            'icon' => 'BBQ Areas.svg',
            'title' => 'BBQ Area',
            'desc' => 'Outdoor grilling spaces'
        ],
        [
            'icon' => 'Salon.svg',
            'title' => 'Hair Salon',
            'desc' => 'Professional styling services'
        ],
        [
            'icon' => 'Cafe.svg',
            'title' => 'Café',
            'desc' => 'Premium coffee & snacks'
        ],
        [
            'icon' => 'Landscaped Gardens.svg',
            'title' => 'Landscaped Gardens',
            'desc' => 'Beautiful outdoor spaces'
        ],
        [
            'icon' => 'Cinema Room.svg',
            'title' => 'Cinema Room',
            'desc' => 'Private movie screenings'
        ],
        [
            'icon' => 'Library.svg',
            'title' => 'Library',
            'desc' => 'Quiet reading sanctuary'
        ],
        [
            'icon' => 'Couple Rooms.svg',
            'title' => 'Couples Rooms',
            'desc' => 'Private intimate spaces'
        ],
        [
            'icon' => 'Lounges.svg',
            'title' => 'Lounges',
            'desc' => 'Comfortable relaxation areas'
        ],
        [
            'icon' => 'Craft Rooms.svg',
            'title' => 'Craft Room',
            'desc' => 'Creative workshop space'
        ],
        [
            'icon' => 'Pets Welcome.svg',
            'title' => 'Pets Welcome',
            'desc' => 'Pet-friendly facilities'
        ],
        [
            'icon' => 'Dining Rooms.svg',
            'title' => 'Dining Rooms',
            'desc' => 'Elegant dining experiences'
        ],
        [
            'icon' => 'Therapy.svg',
            'title' => 'Therapy Room',
            'desc' => 'Wellness & relaxation'
        ],
    ];
    ?>
    <section class="pb-24 bg-[#FDFBF7] relative overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            <!-- White Container -->
            <div class="bg-white rounded-[32px] p-8 sm:p-12 lg:p-16 shadow-sm relative overflow-hidden">
                <!-- Glow Effect -->
                <!-- <div class="absolute top-0 left-1/3 w-96 h-96 bg-[#CDAC79] opacity-20 blur-[100px] rounded-full pointer-events-none transform -translate-y-1/2"></div> -->
                 <img src="<?php echo get_template_directory_uri() . "/assets/images/About Us H1 bg gr.png"; ?>" alt="" class="absolute bottom-[510px] left-[270px] blur-[15px] w-[138px] h-[155px]">

                <!-- Header -->
                <div class="mb-16 relative z-10">
                    <span class="text-[#016A7C] font-jakarta text-sm font-bold tracking-widest uppercase block mb-4">Our Homely Facilities</span>
                    <h2 class="text-[rgba(28,35,33,0.90)] w-[297px] font-jakarta text-[30px] font-semibold leading-[36px] tracking-[-0.5px] mb-8">
                        Facilities that feel like home <span class="text-[rgba(28,35,33,0.90)] font-lora text-[30px] italic font-medium leading-[36px] tracking-[-0.5px]">only better</span>
                    </h2>
                </div>

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-10 mb-12 relative z-10">
                    <?php foreach ($facilities as $facility) : ?>
                    <div class="flex items-start gap-4 group">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#E6F0F2] rounded-lg flex items-center justify-center ">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Fecilities-Icons/<?php echo $facility['icon']; ?>" 
                                 alt="<?php echo esc_attr($facility['title']); ?>" 
                                 class="h-6 w-6 transition-all duration-300">
                        </div>
                        <div>
                            <h3 class="font-lato font-normal text-[18px] leading-[26px] text-[#09090B] mb-1"><?php echo esc_html($facility['title']); ?></h3>
                            <p class="font-inter font-normal text-[14px] leading-[20px] tracking-[-0.15px] text-[#6A7282]"><?php echo esc_html($facility['desc']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
       
                <!-- Button -->
                <div class="relative rgba(1, 106, 124, 1) z-10">
                    <a href="<?php echo home_url('/facilities'); ?>" class="inline-flex font-lato font-normal items-center bg-[#016A7C] hover:bg-[#014854] text-white font-jakarta px-8 py-4 rounded-md transition-colors duration-300">
                        View more for Rooms & Facilities
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
add_shortcode('fecilities_home', 'tov_facilities_home_shortcode');

