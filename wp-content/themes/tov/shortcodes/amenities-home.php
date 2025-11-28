<?php
/**
 * Amenities Home Shortcode
 * Usage: [amenities_home]
 */

function tov_amenities_home_shortcode($atts) {
    ob_start();
    
    $amenities = [
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>',
            'title' => 'Landscaped Gardens',
            'desc' => 'Tranquil outdoor spaces for relaxation.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
            'title' => 'Award Winning Cuisine',
            'desc' => 'Nutritious, chef-prepared meals daily.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>',
            'title' => 'Beautiful Country Views',
            'desc' => 'Scenic countryside vistas to enjoy daily.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>',
            'title' => 'Country Style Wellbeing',
            'desc' => 'Holistic care in a peaceful environment.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>',
            'title' => 'Private En-Suite Rooms',
            'desc' => 'Comfortable, private rooms with modern amenities.'
        ],
        [
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
            'title' => 'Varied Activities Programme',
            'desc' => 'Engaging activities tailored to interests.'
        ],
    ];
    ?>
    <section class="py-20 bg-[#2C5F6F] relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 opacity-30">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/amenities-bg.jpg'; ?>" alt="" class="w-full h-full object-cover">
        </div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
                <!-- Left Column: Content -->
                <div class="text-white">
                    <span class="text-white/80 font-jakarta text-xs font-semibold tracking-[0.2em] uppercase block mb-6">OUR AMENITIES</span>
                    
                    <h2 class="text-white font-lora text-[48px] font-normal leading-[56px] mb-6">
                        Comforts of home
                    </h2>
                    
                    <p class="text-white/90 font-inter text-base leading-relaxed mb-8 max-w-md">
                        Discover a warm, welcoming environment designed with your loved ones in mind. Our care home offers thoughtfully crafted amenities that prioritize comfort, safety, and a sense of belonging.
                    </p>
                    
                    <a href="<?php echo home_url('/amenities'); ?>" class="inline-flex items-center bg-white hover:bg-gray-100 text-[#2C5F6F] font-jakarta font-semibold px-6 py-3 rounded-md transition-colors duration-300">
                        Get In Touch
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <!-- Right Column: Amenities Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <?php foreach ($amenities as $amenity) : ?>
                    <div class="group">
                        <div class="text-white/90 mb-4">
                            <?php echo $amenity['icon']; ?>
                        </div>
                        <h3 class="text-white font-jakarta text-xl font-semibold leading-tight mb-2">
                            <?php echo esc_html($amenity['title']); ?>
                        </h3>
                        <p class="text-white/80 font-inter text-sm leading-relaxed">
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
