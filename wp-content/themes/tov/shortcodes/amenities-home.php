<?php
/**
 * Amenities Home Shortcode
 * Usage: [amenities_home]
 */

function tov_amenities_home_shortcode($atts) {
    ob_start();
    
    $amenities = [
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Landscaped Gardens.svg" alt="Landscaped Gardens" class="w-12 h-12">',
            'title' => 'Landscaped Gardens',
            'desc' => 'Tranquil outdoor spaces for relaxation.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Cusine.svg" alt="Award Winning Cuisine" class="w-12 h-12">',
            'title' => 'Award Winning Cuisine',
            'desc' => 'Nutritious, chef-prepared meals daily.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Country Views.svg" alt="Beautiful Country Views" class="w-12 h-12">',
            'title' => 'Beautiful Country Views',
            'desc' => 'Scenic countryside vistas to enjoy daily.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Wellbeing.svg" alt="Country Style Wellbeing" class="w-12 h-12">',
            'title' => 'Country Style Wellbeing',
            'desc' => 'Holistic care in a peaceful environment.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/En-Suite Rooms.svg" alt="Private En-Suite Rooms" class="w-12 h-12">',
            'title' => 'Private En-Suite Rooms',
            'desc' => 'Comfortable, private rooms with modern amenities.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Programme.svg" alt="Varied Activities Programme" class="w-12 h-12">',
            'title' => 'Varied Activities Programme',
            'desc' => 'Engaging activities tailored to interests.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/En-Suite Rooms.svg" alt="Private En-Suite Rooms" class="w-12 h-12">',
            'title' => 'Private En-Suite Rooms',
            'desc' => 'Comfortable, private rooms with modern amenities.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Programme.svg" alt="Varied Activities Programme" class="w-12 h-12">',
            'title' => 'Varied Activities Programme',
            'desc' => 'Engaging activities tailored to interests.'
        ],
    ];
    ?>
    <section class="py-20 bg-[#014854] relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 opacity-30">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/amenities-bg-2.png'; ?>" alt="" class="w-full h-full object-cover">
        </div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
                <!-- Left Column: Content -->
                <div class="text-white">
                    <span class="text-[rgba(255, 255, 255, 0.57)] font-jakarta text-sm font-normal tracking-widest uppercase block mb-4">OUR AMENITIES</span>
                    
                    <h2 class="text-white font-jakarta text-[30px] font-normal leading-[36px] tracking-[-0.5px] mb-8]">
                        Comforts of <span class="text-white block font-lora text-[30px] italic font-normal leading-[36px] tracking-[-0.5px]">home</span>
                    </h2>
                    
                    <p class="my-8 max-w-md" style="color: rgba(255, 255, 255, 0.65); font-family: 'Lato', sans-serif; font-size: 16px; font-style: normal; font-weight: 400; line-height: 24px;">
                        Discover a warm, welcoming environment designed with your loved ones in mind. Our care home offers thoughtfully crafted amenities that prioritize comfort, safety, and a sense of belonging.
                    </p>
                    
                    <a href="<?php echo home_url('/amenities'); ?>" class="inline-flex items-center bg-white hover:bg-gray-100 text-[#2C5F6F] font-lato font-normal px-6 py-3 rounded-md transition-colors duration-300">
                        Get In Touch
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <!-- Right Column: Amenities Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-12">
                    <?php foreach ($amenities as $amenity) : ?>
                    <div class="group" style="width: 244px; height: 148.59px;">
                        <div class="text-white/90 mb-4">
                            <?php echo $amenity['icon']; ?>
                        </div>
                        <h3 class="text-white font-jakarta text-xl font-normal leading-tight mb-2">
                            <?php echo esc_html($amenity['title']); ?>
                        </h3>
                        <p style="color: rgba(255, 255, 255, 0.69); font-family: 'Lato', sans-serif; font-size: 16px; font-style: normal; font-weight: 400; line-height: 20.8px;">
                            <?php echo esc_html($amenity['desc']); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('amenities_home', 'tov_amenities_home_shortcode');
