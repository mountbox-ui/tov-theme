<?php
/**
 * Inclusive Services Section Shortcode
 * Usage: [inclusive_home]
 */

function tov_inclusive_home_shortcode($atts) {
    $atts = shortcode_atts(array(
        'title' => 'More than just care',
        'subtitle' => 'The Old Vicarage all-Inclusive',
    ), $atts);

    ob_start();
    ?>
    
    <section class="py-16 md:py-20 bg-white relative overflow-hidden">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
            
            <!-- Section Header -->
        <div>
            <div class="mb-12">
                <h2 class="text-[#1C2321]">
                    <?php echo esc_html($atts['title']); ?><br><span class="text-[#1C2321]">
                    <?php echo esc_html($atts['subtitle']); ?>
                </span>
                </h2>
            </div>
            <!-- Background Glow Effect -->
            <img src="<?php echo get_template_directory_uri() . "/assets/images/About Us H1 bg gr.png"; ?>" alt="" class="absolute z-[-1] bottom-[390px] left-[330px] blur-[15px] w-[220px] h-[196px]">
        </div>

            <!-- Three Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-[48px]">
                
                <!-- Column 1: Premium Services Included -->
                <div class="lg:border-r lg:border-gray-200 lg:pr-8">
                    <h3 class="text-[#1E1E1E] font-jakarta text-[24px] font-bold leading-normal tracking-[-0.24px] mb-6">Premium Services Included</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.18817 0H4.49085L3.25564 4.60745H0.0429195L2.18817 0ZM6.87535 16H7.37229V5.85878H0L6.87535 16ZM8.62382 16H9.12077L15.9941 5.85459L8.62394 5.85255L8.62382 16ZM5.78124 0H10.1167L11.3519 4.60745H4.54393L5.78124 0ZM11.4091 0H13.8182L15.9593 4.60745H12.6464L11.4091 0Z" fill="#12A3BB"/>
                            </svg>
                            <span class="li-span">Biannual, 'In-Home', Dental Hygienist Appointments</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.18817 0H4.49085L3.25564 4.60745H0.0429195L2.18817 0ZM6.87535 16H7.37229V5.85878H0L6.87535 16ZM8.62382 16H9.12077L15.9941 5.85459L8.62394 5.85255L8.62382 16ZM5.78124 0H10.1167L11.3519 4.60745H4.54393L5.78124 0ZM11.4091 0H13.8182L15.9593 4.60745H12.6464L11.4091 0Z" fill="#12A3BB"/>
                            </svg>
                            <span class="li-span">Weekly cut & blow dry</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.18817 0H4.49085L3.25564 4.60745H0.0429195L2.18817 0ZM6.87535 16H7.37229V5.85878H0L6.87535 16ZM8.62382 16H9.12077L15.9941 5.85459L8.62394 5.85255L8.62382 16ZM5.78124 0H10.1167L11.3519 4.60745H4.54393L5.78124 0ZM11.4091 0H13.8182L15.9593 4.60745H12.6464L11.4091 0Z" fill="#12A3BB"/>
                            </svg>
                            <span class="li-span">Weekly standard manicure</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.18817 0H4.49085L3.25564 4.60745H0.0429195L2.18817 0ZM6.87535 16H7.37229V5.85878H0L6.87535 16ZM8.62382 16H9.12077L15.9941 5.85459L8.62394 5.85255L8.62382 16ZM5.78124 0H10.1167L11.3519 4.60745H4.54393L5.78124 0ZM11.4091 0H13.8182L15.9593 4.60745H12.6464L11.4091 0Z" fill="#12A3BB"/>
                            </svg>
                            <span class="li-span">Pedicure once-a-month</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.18817 0H4.49085L3.25564 4.60745H0.0429195L2.18817 0ZM6.87535 16H7.37229V5.85878H0L6.87535 16ZM8.62382 16H9.12077L15.9941 5.85459L8.62394 5.85255L8.62382 16ZM5.78124 0H10.1167L11.3519 4.60745H4.54393L5.78124 0ZM11.4091 0H13.8182L15.9593 4.60745H12.6464L11.4091 0Z" fill="#12A3BB"/>
                            </svg>
                            <span class="li-span">Complimentary use of the café area by residents & guests</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.18817 0H4.49085L3.25564 4.60745H0.0429195L2.18817 0ZM6.87535 16H7.37229V5.85878H0L6.87535 16ZM8.62382 16H9.12077L15.9941 5.85459L8.62394 5.85255L8.62382 16ZM5.78124 0H10.1167L11.3519 4.60745H4.54393L5.78124 0ZM11.4091 0H13.8182L15.9593 4.60745H12.6464L11.4091 0Z" fill="#12A3BB"/>
                            </svg>
                            <span class="li-span">Chiropody every 8 weeks</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.18817 0H4.49085L3.25564 4.60745H0.0429195L2.18817 0ZM6.87535 16H7.37229V5.85878H0L6.87535 16ZM8.62382 16H9.12077L15.9941 5.85459L8.62394 5.85255L8.62382 16ZM5.78124 0H10.1167L11.3519 4.60745H4.54393L5.78124 0ZM11.4091 0H13.8182L15.9593 4.60745H12.6464L11.4091 0Z" fill="#12A3BB"/>
                            </svg>
                            <span class="li-span">Communal newspapers</span>
                        </li>
                    </ul>
                </div>

                <!-- Column 2: Core Services Include -->
                <div class="lg:border-r lg:border-gray-200 lg:pr-8">
                    <h3 class="text-[#1E1E1E] font-jakarta text-[24px] font-bold leading-normal tracking-[-0.24px] mb-6">Core Services Include</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path d="M8.33333 16.6667C12.9358 16.6667 16.6667 12.9358 16.6667 8.33333C16.6667 3.73083 12.9358 0 8.33333 0C3.73083 0 0 3.73083 0 8.33333C0 12.9358 3.73083 16.6667 8.33333 16.6667ZM12.8808 6.21417L7.5 11.595L3.99417 8.08917L5.1725 6.91083L7.5 9.23833L11.7025 5.03583L12.8808 6.21417Z" fill="#CDAC79"/>
                            </svg>
                            <span class="li-span">All meals & snacks</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path d="M8.33333 16.6667C12.9358 16.6667 16.6667 12.9358 16.6667 8.33333C16.6667 3.73083 12.9358 0 8.33333 0C3.73083 0 0 3.73083 0 8.33333C0 12.9358 3.73083 16.6667 8.33333 16.6667ZM12.8808 6.21417L7.5 11.595L3.99417 8.08917L5.1725 6.91083L7.5 9.23833L11.7025 5.03583L12.8808 6.21417Z" fill="#CDAC79"/>
                            </svg>
                            <span class="li-span">Drinks inclusive of alcohol</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path d="M8.33333 16.6667C12.9358 16.6667 16.6667 12.9358 16.6667 8.33333C16.6667 3.73083 12.9358 0 8.33333 0C3.73083 0 0 3.73083 0 8.33333C0 12.9358 3.73083 16.6667 8.33333 16.6667ZM12.8808 6.21417L7.5 11.595L3.99417 8.08917L5.1725 6.91083L7.5 9.23833L11.7025 5.03583L12.8808 6.21417Z" fill="#CDAC79"/>
                            </svg>
                            <span class="li-span">Weekly programme of activities</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path d="M8.33333 16.6667C12.9358 16.6667 16.6667 12.9358 16.6667 8.33333C16.6667 3.73083 12.9358 0 8.33333 0C3.73083 0 0 3.73083 0 8.33333C0 12.9358 3.73083 16.6667 8.33333 16.6667ZM12.8808 6.21417L7.5 11.595L3.99417 8.08917L5.1725 6.91083L7.5 9.23833L11.7025 5.03583L12.8808 6.21417Z" fill="#CDAC79"/>
                            </svg>
                            <span class="li-span">Your care</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path d="M8.33333 16.6667C12.9358 16.6667 16.6667 12.9358 16.6667 8.33333C16.6667 3.73083 12.9358 0 8.33333 0C3.73083 0 0 3.73083 0 8.33333C0 12.9358 3.73083 16.6667 8.33333 16.6667ZM12.8808 6.21417L7.5 11.595L3.99417 8.08917L5.1725 6.91083L7.5 9.23833L11.7025 5.03583L12.8808 6.21417Z" fill="#CDAC79"/>
                            </svg>
                            <span class="li-span">Wi-Fi for residents & guests</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path d="M8.33333 16.6667C12.9358 16.6667 16.6667 12.9358 16.6667 8.33333C16.6667 3.73083 12.9358 0 8.33333 0C3.73083 0 0 3.73083 0 8.33333C0 12.9358 3.73083 16.6667 8.33333 16.6667ZM12.8808 6.21417L7.5 11.595L3.99417 8.08917L5.1725 6.91083L7.5 9.23833L11.7025 5.03583L12.8808 6.21417Z" fill="#CDAC79"/>
                            </svg>
                            <span class="li-span">Sky TV in the cinema room</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none" class="w-4 h-4 mt-1 flex-shrink-0">
                                <path d="M8.33333 16.6667C12.9358 16.6667 16.6667 12.9358 16.6667 8.33333C16.6667 3.73083 12.9358 0 8.33333 0C3.73083 0 0 3.73083 0 8.33333C0 12.9358 3.73083 16.6667 8.33333 16.6667ZM12.8808 6.21417L7.5 11.595L3.99417 8.08917L5.1725 6.91083L7.5 9.23833L11.7025 5.03583L12.8808 6.21417Z" fill="#CDAC79"/>
                            </svg>
                            <span class="li-span">All housekeeping, laundry & maintenance</span>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Weekly Fees & Short Respite Stay -->
                <div>
                    <h3 class="text-[#1E1E1E] font-jakarta text-[24px] font-bold leading-normal tracking-[-0.24px] mb-6">Weekly Fees</h3>
                    <div class="mb-8">
                        <p class="li-span">Residential care from £1,550</p>
                        <p class="li-span">Dementia care from £1,790</p>
                    </div>

                    <h4 class="text-[#09090B] font-lato text-[20px] font-bold leading-[26px] mb-4">Short Respite Stay</h4>
                    <p class="li-span mb-8">
                        Short term stays are subject to an increase of 10%. Please note that short term respite stays are usually for a minimum of 4 weeks.
                    </p>

                    <a href="<?php echo home_url('/contact-us/?form=brochure'); ?>" class="btn btn-primary bt-1">
                        Download Brochure
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none" class="hover:bg-[#fff]">
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
add_shortcode('inclusive_home', 'tov_inclusive_home_shortcode');
