<?php
/**
 * How to Start Section Shortcode
 * Usage: [how_to_start_home]
 */

function tov_how_to_start_home_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'How to start',
    ), $atts);

    ob_start();
    ?>
    
    <section class="py-20 bg-[#FDFBF7] relative overflow-hidden">
        

        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            
            <!-- Section Header -->
            <div>
                <div class="mb-8">
                    <h2 class="text-[#000] font-jakarta text-[40px] font-semibold leading-[1.2]">
                        <?php echo esc_html($atts['title']); ?>
                    </h2>
                </div>
            </div>

            <!-- Steps Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Step 1: Get in touch -->
                <div class="bg-[#EAE5D3] rounded-xl p-8 flex flex-col items-start h-full transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-20 h-20 flex items-center justify-center mb-6 relative">
                        <!-- Gradient Background SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="108" height="83" viewBox="0 0 108 83" fill="none" class="absolute inset-0 w-[108px] h-[83px]">
                            <circle opacity="0.5" cx="69" cy="39" r="39" fill="url(#paint0_linear_58_540)"/>
                            <circle opacity="0.5" cx="41.5" cy="41.5" r="41.5" fill="url(#paint1_linear_58_540)"/>
                            <defs>
                                <linearGradient id="paint0_linear_58_540" x1="43.4063" y1="18.7419" x2="108" y2="64.445" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0"/>
                                    <stop offset="1" stop-color="white"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_58_540" x1="14.2656" y1="19.9433" x2="83" y2="68.5761" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.240385" stop-color="white"/>
                                    <stop offset="1" stop-color="white" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <!-- Chat Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="50" viewBox="0 0 60 50" fill="none" class="relative z-10 w-[3rem] h-[3rem] ml-[20px]">
                            <path d="M51.544 36.316V42.698C51.544 45.448 49.946 46.114 47.994 44.177L43.461 39.681C42.334 39.878 41.182 40 39.999 40C28.953 40 20.002 31.048 20.001 20C20.002 8.953 28.953 0 40 0C51.047 0 60 8.953 60.001 20C60 26.744 56.655 32.693 51.544 36.316ZM15.001 20.002C15.001 18.818 15.09 17.655 15.25 16.515C15.166 16.513 15.084 16.502 15 16.502C6.716 16.502 0 23.218 0 31.502C0 36.56 2.511 41.023 6.347 43.741V47.271C6.347 50.021 7.945 50.687 9.897 48.75L12.406 46.263C13.25 46.41 14.113 46.502 15 46.502C19.65 46.502 23.806 44.385 26.557 41.063C19.616 36.616 15.002 28.84 15.001 20.002Z" fill="#016A7C"/>
                        </svg>
                    </div>
                    <h3 class="text-[#1E1E1E] text-center font-jakarta text-[24px] font-bold leading-normal tracking-[-0.24px] mb-3">Get in touch</h3>
                    <p class="text-[#000] font-lato text-[18px] font-normal leading-[26px] opacity-70">
                        Start a care enquiry
                    </p>
                </div>

                <!-- Step 2: Receive email -->
                <div class="bg-[#EAE5D3] rounded-xl p-8 flex flex-col items-start h-full transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-20 h-20 flex items-center justify-center mb-6 relative">
                        <!-- Gradient Background SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="108" height="83" viewBox="0 0 108 83" fill="none" class="absolute inset-0 w-[108px] h-[83px]">
                            <circle opacity="0.5" cx="69" cy="39" r="39" fill="url(#paint0_linear_58_541)"/>
                            <circle opacity="0.5" cx="41.5" cy="41.5" r="41.5" fill="url(#paint1_linear_58_541)"/>
                            <defs>
                                <linearGradient id="paint0_linear_58_541" x1="43.4063" y1="18.7419" x2="108" y2="64.445" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0"/>
                                    <stop offset="1" stop-color="white"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_58_541" x1="14.2656" y1="19.9433" x2="83" y2="68.5761" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.240385" stop-color="white"/>
                                    <stop offset="1" stop-color="white" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <!-- Email Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="35" viewBox="0 0 50 35" fill="none" class="relative z-10 w-[3rem] h-[3rem] ml-[20px]">
                            <path d="M22.337 20.636L0 5C0 2.25 2.25 0 5 0H45C47.75 0 50 2.25 50 5L27.663 20.636C26.269 21.611 23.731 21.611 22.337 20.636ZM25 26.36C23.01 26.36 21.021 25.818 19.47 24.733L0 11.103V30C0 32.75 2.25 35 5 35H45C47.75 35 50 32.75 50 30V11.103L30.53 24.732C28.979 25.817 26.99 26.36 25 26.36Z" fill="#016A7C"/>
                        </svg>
                    </div>
                    <h3 class="text-[#1E1E1E] text-center font-jakarta text-[24px] font-bold leading-normal tracking-[-0.24px] mb-3">Receive email</h3>
                    <p class="text-[#000] font-lato text-[18px] font-normal leading-[26px] opacity-70">
                        Check your inbox for an email from us.
                    </p>
                </div>

                <!-- Step 3: We'll call -->
                <div class="bg-[#EAE5D3] rounded-xl p-8 flex flex-col items-start h-full transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-20 h-20 flex items-center justify-center mb-6 relative">
                        <!-- Gradient Background SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="108" height="83" viewBox="0 0 108 83" fill="none" class="absolute inset-0 w-[108px] h-[83px]">
                            <circle opacity="0.5" cx="69" cy="39" r="39" fill="url(#paint0_linear_58_542)"/>
                            <circle opacity="0.5" cx="41.5" cy="41.5" r="41.5" fill="url(#paint1_linear_58_542)"/>
                            <defs>
                                <linearGradient id="paint0_linear_58_542" x1="43.4063" y1="18.7419" x2="108" y2="64.445" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0"/>
                                    <stop offset="1" stop-color="white"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_58_542" x1="14.2656" y1="19.9433" x2="83" y2="68.5761" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.240385" stop-color="white"/>
                                    <stop offset="1" stop-color="white" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <!-- Call Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="40" viewBox="0 0 48 40" fill="none" class="relative z-10 w-[3rem] h-[3rem] ml-[20px]">
                            <path d="M47.0419 33.949C47.3599 35.426 46.9929 36.967 46.0429 38.142C45.0949 39.317 43.6649 40 42.1539 40H5.00186C3.49086 40 2.06186 39.317 1.11186 38.142C0.162862 36.967 -0.204139 35.426 0.112861 33.949C2.47386 22.969 12.3429 15 23.5779 15C33.1769 15 41.8339 20.707 45.6339 29.539C46.2439 30.955 46.7179 32.439 47.0419 33.949ZM5.00586 15.536C5.94486 15.536 6.89486 15.272 7.73986 14.719C12.4539 11.632 17.9309 10 23.5779 10C29.2249 10 34.7019 11.631 39.4149 14.718C41.7269 16.232 44.8249 15.584 46.3369 13.274C47.8499 10.964 47.2029 7.865 44.8929 6.352C38.5469 2.196 31.1759 0 23.5779 0C15.9799 0 8.60886 2.196 2.26186 6.352C-0.0491385 7.864 -0.695139 10.963 0.817861 13.274C1.77686 14.74 3.37486 15.536 5.00586 15.536Z" fill="#016A7C"/>
                        </svg>
                    </div>
                    <h3 class="text-[#1E1E1E] text-center font-jakarta text-[24px] font-bold leading-normal tracking-[-0.24px] mb-3">We'll call</h3>
                    <p class="text-[#000] font-lato text-[18px] font-normal leading-[26px] opacity-70">
                        Time spent chatting through your situation and needs.
                    </p>
                </div>

                <!-- Step 4: Your choice -->
                <div class="bg-[#EAE5D3] rounded-xl p-8 flex flex-col items-start h-full transition-transform hover:-translate-y-1 duration-300">
                    <div class="w-20 h-20 flex items-center justify-center mb-6 relative">
                        <!-- Gradient Background SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="108" height="83" viewBox="0 0 108 83" fill="none" class="absolute inset-0 w-[108px] h-[83px]">
                            <circle opacity="0.5" cx="69" cy="39" r="39" fill="url(#paint0_linear_58_543)"/>
                            <circle opacity="0.5" cx="41.5" cy="41.5" r="41.5" fill="url(#paint1_linear_58_543)"/>
                            <defs>
                                <linearGradient id="paint0_linear_58_543" x1="43.4063" y1="18.7419" x2="108" y2="64.445" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" stop-opacity="0"/>
                                    <stop offset="1" stop-color="white"/>
                                </linearGradient>
                                <linearGradient id="paint1_linear_58_543" x1="14.2656" y1="19.9433" x2="83" y2="68.5761" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.240385" stop-color="white"/>
                                    <stop offset="1" stop-color="white" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                        </svg>
                        <!-- House Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none" class="relative z-10 w-[3rem] h-[3rem] ml-[20px]">
                            <path d="M42.4994 31.0339V45.0089C42.4994 47.7539 40.2494 49.9999 37.4994 49.9999H12.4994C9.74941 49.9999 7.49941 47.7539 7.49941 45.0089V31.0339L11.4764 27.6599L24.9994 16.1869L42.4994 31.0339ZM48.8094 23.2869C50.5974 21.1869 50.3414 18.0369 48.2384 16.2519L32.0484 2.51588C28.0954 -0.839125 21.9024 -0.838125 17.9514 2.51588L1.76141 16.2519C-0.342595 18.0369 -0.597594 21.1869 1.19041 23.2869C2.97941 25.3879 6.1344 25.6409 8.2384 23.8569L24.4294 10.1199C24.6584 9.92487 25.3414 9.92587 25.5714 10.1199L41.7614 23.8569C42.7014 24.6549 43.8524 25.0449 44.9974 25.0449C46.4134 25.0459 47.8194 24.4479 48.8094 23.2869Z" fill="#016A7C"/>
                        </svg>
                    </div>
                    <h3 class="text-[#1E1E1E] text-center font-jakarta text-[24px] font-bold leading-normal tracking-[-0.24px] mb-3">Your choice</h3>
                    <p class="text-[#000] font-lato text-[18px] font-normal leading-[26px] opacity-70">
                        Pop in, meet the team and take a tour.
                    </p>
                </div>

            </div>
            <!-- Background Glow Effect -->
            <img src="<?php echo get_template_directory_uri() . "/assets/images/About Us H1 bg gr.png"; ?>" alt="" class="absolute z-[-1] bottom-[170px] left-[225px] blur-[15px] w-[220px] h-[196px]">
        </div>
    </section>

    <?php
    return ob_get_clean();
}
add_shortcode('how_to_start_home', 'tov_how_to_start_home_shortcode');
