<?php
/**
 * Services Home Shortcode
 * Usage: [services_home]
 */

function tov_services_home_shortcode($atts) {
    ob_start();
    ?>
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Glow Effect -->
         <img src="<?php echo get_template_directory_uri() . "/assets/images/About Us H1 bg gr.png"; ?>" alt="" class="absolute bottom-[735px] left-[545px] blur-[15px] w-[138px] h-[155px]">

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            <!-- Header -->
            <div class="max-w-3xl mb-16">
                <span class="text-[#016A7C] font-jakarta text-sm font-bold tracking-widest uppercase block mb-4">Our Care Services</span>
                <h2 class="text-[rgba(28,35,33,0.90)] font-jakarta text-[30px] font-semibold leading-[36px] tracking-[-0.5px] mb-8]">
                    Compassionate care <br>
                    tailored to <span class="text-[rgba(28,35,33,0.90)] font-lora text-[30px] italic font-medium leading-[36px] tracking-[-0.5px]">every need</span>
                </h2>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
                <!-- Service 1: Residential Care -->
                <div class="group">
                    <div class="rounded-2xl overflow-hidden mb-6 h-[240px]">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/residential-care.png" alt="Residential Care" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[#1C2321] font-jakarta text-2xl font-bold mb-3">Residential care</h3>
                    <p class="text-[#6A7282] font-inter text-sm leading-6 mb-4">
                        As a residential care home we offer assistance with personal care, such as washing, dressing, bathing or showering. We can assist with getting up in the morning and going to bed at night, at a time which suits you. We can help with continence care, medical issues, medication administration and meal times.
                    </p>
                    <a href="<?php echo home_url('/services/residential-care'); ?>" class="inline-flex items-center text-[#1C2321] font-bold text-sm hover:text-[#016A7C] transition-colors">
                        Learn more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Service 2: Respite Care -->
                <div class="group">
                    <div class="rounded-2xl overflow-hidden mb-6 h-[240px]">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/respite-care.png" alt="Respite Care" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[#1C2321] font-jakarta text-2xl font-bold mb-3">Respite care</h3>
                    <p class="text-[#6A7282] font-inter text-sm leading-6 mb-4">
                        Respite Care involves coming to stay with us for a short holiday, allowing your carer or loved ones to have a break and recharge their batteries, with peace of mind that you will be well looked after by us.
                    </p>
                    <a href="<?php echo home_url('/services/respite-care'); ?>" class="inline-flex items-center text-[#1C2321] font-bold text-sm hover:text-[#016A7C] transition-colors">
                        Learn more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Service 3: Dementia Care -->
                <div class="group">
                    <div class="rounded-2xl overflow-hidden mb-6 h-[240px]">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/dementia-care.png" alt="Dementia Care" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <h3 class="text-[#1C2321] font-jakarta text-2xl font-bold mb-3">Dementia care</h3>
                    <p class="text-[#6A7282] font-inter text-sm leading-6 mb-4">
                        Our approach to dementia care is of compassion, kindness and sensitivity, where residents are supported to live meaningful lives full of happiness, acceptance and contentment, irrespective of the type of dementia they live with and their symptoms at any given time.
                    </p>
                    <a href="<?php echo home_url('/services/dementia-care'); ?>" class="inline-flex items-center text-[#1C2321] font-bold text-sm hover:text-[#016A7C] transition-colors">
                        Learn more
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="flex justify-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-[#016A7C] rounded-full flex items-center justify-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[#6A7282] font-inter text-xs uppercase tracking-wider font-medium">Call us today</span>
                        <a href="tel:01395568208" class="text-[#1C2321] font-jakarta text-xl font-bold hover:text-[#016A7C] transition-colors">01395 568208</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('services_home', 'tov_services_home_shortcode');
