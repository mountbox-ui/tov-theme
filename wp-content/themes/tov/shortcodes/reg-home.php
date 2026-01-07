<?php
/**
 * Regulatory & Awards Section Shortcode
 * Usage: [reg_home]
 */

function tov_reg_home_shortcode($atts) {
    ob_start();
    ?>
    
    <section class="py-16 md:py-20 bg-white">
        <div class="max-w-[1280px] mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center justify-items-center">
                
                <!-- CQC Rating -->
                <div class="w-full flex justify-center">
                   <div class="bg-white shadow-sm p-6 border border-gray-100 flex flex-col hover:shadow-md transition-shadow duration-300 min-h-[250px] w-full max-w-[350px]">
                       <!-- CQC Widget Code -->
                       <div class="cqc-container w-full">
                            <div class="cqc-widget-header">
                                <a href="https://www.cqc.org.uk?referer=widget3" target="_blank" alt="CQC Logo" title="CQC Logo" class="block mb-4">
                                    <img src="https://www.cqc.org.uk/_dp/build/widget/asset_cqclogo_update.png" alt="CQC logo" class="h-8">
                                </a>

                                <div class="cqc-service-name whitespace-nowrap text-lg font-bold text-[#1C2321] mb-4">
                                    The Old Vicarage
                                </div>
                                
                                <div class="bg-[#F9F9F7] p-4 rounded-lg w-full">
                                    <div class="inherited-facility"></div>
                                    <div class="cqc-widget-normal">
                                        <div class="cqc-widget-new-style-margin-2 text-sm font-bold text-gray-800 mb-2">
                                            CQC overall rating
                                        </div>
                                        <div class="flex items-center gap-2 mb-3">
                                            <span class="cqc-widget-overall good text-[#006400] font-bold text-xl">Good</span>
                                            <span class="w-3 h-3 rounded-full bg-[#006400]"></span>
                                        </div>
                                        <div class="cqc-widget-footer cqc-widget-date text-sm text-gray-500 mb-4">11 December 2018</div>
                                        <div class="widget-button-wrapper cqc-widget-footer-new-style">
                                            <a class="bg-white border border-[#6e2a5d] text-[#6e2a5d] hover:bg-gray-50 font-semibold text-sm px-4 py-2 rounded inline-flex items-center transition-colors" title="See full report (opens in new window)" alt="See full report (opens in new window)" target="_blank" href="https://www.cqc.org.uk/location/1-1599281127?referer=widget3">
                                                See the report &gt;
                                            </a>
                                        </div>
                                    </div>
                                    <br class="cqc-widget-clear">
                                </div>
                            </div>
                        </div>
                   </div>
                </div>

                <!-- Carehome.co.uk Rating -->
                <!-- <div class="w-full flex justify-center">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex flex-col items-center justify-center hover:shadow-md transition-shadow duration-300 min-h-[250px] w-full max-w-[350px]"> -->
                         <!-- Logo Placeholder -->
                         <!-- <div class="flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/></svg>
                            <span class="text-xl font-bold text-[#101038]">carehome.co.uk</span>
                         </div>
                         
                         <div class="text-center w-full border-t pt-4">
                             <div class="text-5xl font-bold text-[#101038] mb-1">9.8</div>
                             <div class="flex justify-center gap-1 mb-2"> -->
                                 <!-- Stars -->
                                 <!-- <svg class="w-5 h-5 text-orange-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                 <svg class="w-5 h-5 text-orange-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                 <svg class="w-5 h-5 text-orange-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                 <svg class="w-5 h-5 text-orange-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                 <svg class="w-5 h-5 text-orange-400 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                             </div>
                             <div class="text-xs text-gray-500 mb-4">Review Score for The Old Vicarage</div>
                             <a href="#" class="inline-block bg-[#101038] text-white text-sm font-semibold px-6 py-2 rounded shadow hover:bg-blue-900 transition-colors">Write a Review</a>
                         </div>
                    </div>
                </div> -->

                <!-- Food Hygiene Rating -->
                <!-- <div class="w-full flex justify-center">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex flex-col items-center justify-center hover:shadow-md transition-shadow duration-300 min-h-[250px] w-full max-w-[350px]">
                        <div class="flex items-center gap-2 mb-4">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#badd11]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                             <div class="text-left leading-tight">
                                <div class="font-bold text-gray-800">Food Standards code</div>
                                <div class="text-gray-500 text-xs">Agency</div>
                             </div>
                        </div>
                        
                        <div class="bg-black text-white px-4 py-4 rounded-xl text-center w-full relative overflow-hidden">
                            <div class="text-[#badd11] text-sm font-bold uppercase tracking-wider mb-2 border-b border-gray-700 pb-2">Food Hygiene Rating</div>
                            <div class="flex justify-between items-center gap-1 mb-2 px-2">
                                <span class="w-6 h-6 rounded-full border border-gray-600 flex items-center justify-center text-[10px] text-gray-400">0</span>
                                <span class="w-6 h-6 rounded-full border border-gray-600 flex items-center justify-center text-[10px] text-gray-400">1</span>
                                <span class="w-6 h-6 rounded-full border border-gray-600 flex items-center justify-center text-[10px] text-gray-400">2</span>
                                <span class="w-6 h-6 rounded-full border border-gray-600 flex items-center justify-center text-[10px] text-gray-400">3</span>
                                <span class="w-6 h-6 rounded-full border border-gray-600 flex items-center justify-center text-[10px] text-gray-400">4</span>
                                <span class="w-8 h-8 rounded-full border-2 border-white bg-white text-black flex items-center justify-center font-bold text-lg shadow-lg scale-110">5</span>
                            </div>
                            <div class="text-[#badd11] text-sm font-bold uppercase tracking-widest mt-1">Very Good</div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </section>

    <?php
    return ob_get_clean();
}
add_shortcode('reg_home', 'tov_reg_home_shortcode');
