<?php
/**
 * Facilities Home Shortcode
 * Usage: [facilities_home]
 */

function tov_facilities_home_shortcode($atts) {
    ob_start();
    
    $facilities = [
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />',
            'title' => 'BBQ Area',
            'desc' => 'Outdoor grilling spaces'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />',
            'title' => 'Hair Salon',
            'desc' => 'Professional styling services'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />',
            'title' => 'Café',
            'desc' => 'Premium coffee & snacks'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />',
            'title' => 'Landscaped Gardens',
            'desc' => 'Beautiful outdoor spaces'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />',
            'title' => 'Cinema Room',
            'desc' => 'Private movie screenings'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />',
            'title' => 'Library',
            'desc' => 'Quiet reading sanctuary'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />',
            'title' => 'Couples Rooms',
            'desc' => 'Private intimate spaces'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />',
            'title' => 'Lounges',
            'desc' => 'Comfortable relaxation areas'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />',
            'title' => 'Craft Room',
            'desc' => 'Creative workshop space'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />',
            'title' => 'Pets Welcome',
            'desc' => 'Pet-friendly facilities'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />',
            'title' => 'Dining Rooms',
            'desc' => 'Elegant dining experiences'
        ],
        [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />',
            'title' => 'Therapy Room',
            'desc' => 'Wellness & relaxation'
        ],
    ];
    ?>
    <section class="py-24 bg-[#FDFBF7] relative overflow-hidden">
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
                        <div class="flex-shrink-0 w-12 h-12 bg-[#E6F0F2] rounded-lg flex items-center justify-center text-[#016A7C] group-hover:bg-[#016A7C] group-hover:text-white transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <?php echo $facility['icon']; ?>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-lato font-[600] text-[18px] leading-[26px] text-[#09090B] mb-1"><?php echo esc_html($facility['title']); ?></h3>
                            <p class="font-inter font-normal text-[14px] leading-[20px] tracking-[-0.15px] text-[#6A7282]"><?php echo esc_html($facility['desc']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Button -->
                <div class="relative rgba(1, 106, 124, 1) z-10">
                    <a href="<?php echo home_url('/facilities'); ?>" class="inline-flex font-lato font-[400] items-center bg-[#016A7C] hover:bg-[#014854] text-white font-jakarta font-semibold px-8 py-4 rounded-md transition-colors duration-300">
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

