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
                    <h6 class="text-[#016A7C]">Our Homely Facilities</h6>
                    <h2 class="w-auto md:w-[500px]">
                        Facilities that feel like home <span>only better</span>
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
                <div class="relative rgba(1, 106, 124, 1) z-10 w-[315px]">
                    <a href="<?php echo home_url('/facilities'); ?>" class="btn btn-primary bt-1">
                        View more for Rooms & Facilities
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                            <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="white"/>
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

