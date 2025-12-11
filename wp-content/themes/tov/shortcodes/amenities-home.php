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
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Relationship Centered.svg" alt="Relationship Centered" class="w-12 h-12">',
            'title' => 'Relationship Centered',
            'desc' => 'Comfortable, private rooms with modern amenities.'
        ],
        [
            'icon' => '<img src="' . get_template_directory_uri() . '/assets/images/Amenities-Icons/Loved-By-Residents.svg" alt="Loved By Residents" class="w-12 h-12">',
            'title' => 'Loved By Residents',
            'desc' => 'Engaging activities tailored to interests.'
        ],
    ];
    ?>
    <section class="py-20 bg-[#014854] relative">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/amenities-bg-2.png'; ?>" alt="" class="w-full h-full object-cover">
        </div>

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 items-start">
                <!-- Left Column: Content -->
                <div class="text-white lg:sticky top-12">
                    <h6 class="text-[rgba(255, 255, 255, 0.57)]">WHY TOV?</h6>
                    
                    <h2 class="text-white">
                        Comforts of <span class="text-white">home</span>
                    </h2>
                    
                    <p class="mb-8 mt-[12px] max-w-md paragraph text-[#fff]/60">
                        Discover a warm, welcoming environment designed with your loved ones in mind. Our care home offers thoughtfully crafted amenities that prioritize comfort, safety, and a sense of belonging.
                    </p>
                    
                    <div class="flex gap-4 w-full">
                    <a href="<?php echo home_url('/amenities'); ?>" class="btn btn-primary bt-1 bg-white text-[#2C5F6F] w-[182px] hover:bg-white hover:text-[#2C5F6F] hover:svg:hover">
                        Get In Touch
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none" class="hover:bg-[#fff]">
                            <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="#2C5F6F"/>
                        </svg>
                    </a>
                    <a href="<?php echo home_url('/book-a-tour/?form=brochure'); ?>" class="btn btn-primary bt-1 bg-white text-[#2C5F6F] hover:bg-white hover:text-[#2C5F6F] hover:svg:hover">
                        Download Brochure
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none" class="hover:bg-[#fff]">
                            <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="#2C5F6F"/>
                        </svg>
                    </a>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-12">
                    <?php foreach ($amenities as $amenity) : ?>
                    <div class="group flex flex-col" style="width: 244px; height: 148.59px;">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="text-white/90 flex-shrink-0">
                                <?php echo $amenity['icon']; ?>
                            </div>
                            <div>
                                <h3 class="text-white font-jakarta text-xl font-normal leading-tight">
                                    <?php echo esc_html($amenity['title']); ?>
                                </h3>
                                <p class="paragraph text-[#fff]/60 pt-2">
                                    <?php echo esc_html($amenity['desc']); ?>
                                </p>
                            </div>
                        </div>
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
