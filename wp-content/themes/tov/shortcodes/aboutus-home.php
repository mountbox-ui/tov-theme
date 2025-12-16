<?php
/**
 * About Us Home Shortcode
 * Usage: [aboutus_home image_url="..." button_url="..."]
 */

function tov_aboutus_home_shortcode($atts) {
    $atts = shortcode_atts(array(
        'image_url' => get_template_directory_uri() . "/assets/images/About Us H1.png",
        'image_url_bg' => get_template_directory_uri() . "/assets/images/About Us H1 bg gr.png",
        'button_url' => home_url('/about-us'),
    ), $atts);

    ob_start();
    ?>
    <section class="py-24 bg-[#FDFBF7]">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6">
            <div class="flex flex-col md:flex-row items-start gap-20">
                <!-- Content Column -->
                <div class="w-full md:w-1/2">
                    <div class="max-w-xl">
                        <!-- Label with line -->
                        <div class="flex items-center gap-4 mb-6">
                            <span class="text-[#1C2321] font-lato text-base font-normal leading-[16px] uppercase tracking-wider">About Us</span>
                            <div class="h-px w-24 sm:w-48 md:w-[28rem] bg-gray-300"></div>
                        </div>

                        <!-- Heading -->
                        <h2 class="text-[rgba(28,35,33,0.90)] font-jakarta text-[30px] font-semibold leading-[36px] tracking-[-0.5px] mb-8">
                            Outstanding residential care in a <span class="text-[rgba(28,35,33,0.90)] inline md:block font-lora text-[30px] italic font-medium leading-[36px] tracking-[-0.5px]">beautiful country setting.</span>
                        </h2>

                        <!-- Content Paragraphs -->
                        <div class="relative mb-6">
                            <div class="text-[#757575] font-lato text-[18px] font-normal leading-[26px] space-y-6">
                                <p class="paragraph">
                                    At The Old Vicarage, we believe later life should be lived with purpose, comfort, and dignity. Established and managed by Neways Healthcare in the picturesque village of Otterton - near Budleigh Salterton, Exmouth, and Sidmouth - our family-run care home is part of a proud legacy of providing exceptional care across East Devon.
                                </p>
                                <p class="paragraph">
                                    With roots grounded in compassion and respect, we specialise in Residential, Respite, and Dementia Care, including support for those living with Parkinson's and requiring End of Life Care. Since our beginnings, our mission has remained unchanged:
                                </p>
                            
                                <!-- Expandable Content -->
                                <div id="aboutUsExpandable" class="overflow-hidden transition-all duration-500 ease-in-out" style="max-height: 0;">
                                    <div class="space-y-6">
                                        <p class="paragraph">
                                            Our beautifully appointed rooms, award-winning gardens, and vibrant wellbeing calendar are designed to foster joy, independence, and connection. Every detail - from freshly prepared meals with home-grown ingredients, personalised care, and a warm, luxurious environment where individuality is celebrated.
                                        </p>
                                        <p class="paragraph">
                                            From the moment you walk through our doors, you'll be treated like a friend - because that's exactly who you are. And with tools like the Nourish App to keep families close, and free experience days for prospective residents, everything we do is centred around building trust, comfort, and lasting relationships.
                                        </p>
                                        <p class="paragraph">
                                            The Old Vicarage isn't just a place to live—it's a place to belong, to laugh again and to thrive.
                                        </p>
                                    </div>
                                </div>
                            </div>
                 
                            <!-- Gradient Overlay (visible when collapsed) -->
                            <div id="aboutUsGradient" class="pointer-events-none transition-opacity duration-500" 
                                 style="position: absolute; right: 16px; bottom: 23px; width: 562px; height: 150px; background: linear-gradient(180deg, rgba(250, 248, 244, 0.00) 5.04%, #FAF8F4 100%);">
                            </div>
                        </div>
                        
                        <!-- Read More Button -->
                        <button 
                            id="aboutUsToggle" 
                            onclick="toggleAboutUs()"
                            class="inline-flex font-lato items-center text-gray-800 font-medium hover:text-[#016A7C] transition-colors duration-300 group cursor-pointer border-none bg-transparent p-0">
                            <span id="aboutUsToggleText">Read More</span>
                            <svg id="aboutUsArrow" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <script>
                        function toggleAboutUs() {
                            const expandable = document.getElementById('aboutUsExpandable');
                            const button = document.getElementById('aboutUsToggle');
                            const arrow = document.getElementById('aboutUsArrow');
                            const gradient = document.getElementById('aboutUsGradient');
                            
                            if (expandable.style.maxHeight === '0px' || expandable.style.maxHeight === '') {
                                // Expand only (no collapse)
                                expandable.style.maxHeight = expandable.scrollHeight + 'px';
                                arrow.style.transform = 'rotate(180deg)';
                                gradient.style.opacity = '0';
                                // Hide button after expansion
                                setTimeout(() => {
                                    button.style.display = 'none';
                                }, 300);
                            }
                        }
                        </script>
                    </div>
                </div>

                <!-- Image Column -->
                <div class="w-full md:w-1/2">
                    <div class="relative flex justify-center">
                        <div>
                            <img src="<?php echo get_template_directory_uri() . "/assets/images/About Us H1 bg gr.png"; ?>" alt="" class="absolute bottom-[-30px] left-[0px] blur-[15px] w-[600px] h-[395px]">
                        </div>
                        
                        <div class="relative rounded-2xl overflow-hidden shadow-sm">
                            <img src="<?php echo esc_url($atts['image_url']); ?>" alt="The Old Vicarage Exterior" class="w-full h-auto object-cover rounded-2xl w-[412px] h-[460px] ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('aboutus_home', 'tov_aboutus_home_shortcode');
