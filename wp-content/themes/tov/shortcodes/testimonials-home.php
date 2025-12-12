<?php
/**
 * Testimonials Home Shortcode
 */
function tov_testimonials_home_shortcode($atts) {
    ob_start();
    
    // Sample data for the slider
    $testimonials = [
        [
            'text' => 'The feeling I get at the Old Vicarage is that everyone, staff and residents alike, enjoy a sense of community, and staff feel motivated to contribute their very best to ensure a uniformly high level of support and comfort.',
            'author' => 'Daughter of Resident'
        ],
        [
            'text' => 'I enjoy having the freedom to come and go as I please. I love going outside for a walk and it’s easy to make friends here.',
            'author' => 'Quote from a resident'
        ],
        [
            'text' => 'It is heart-warming to read the report of the latest Residents’ forum.',
            'author' => 'Email from a relative'
        ],
        [
            'text' => 'You would have to go a long way to find a care home as good as The Old Vicarage.',
            'author' => 'Quote from a resident'
        ],
        [
            'text' => 'There is a wonderful, welcoming and cheerful atmosphere at The Old Vicarage.',
            'author' => 'Letter from a relative'
        ]
    ];
    
    $unique_id = 'testimonials-' . uniqid();
    $total_slides = count($testimonials);
    ?>
    
    <section class="relative bg-[#FDFBF7] px-6 py-24 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-7xl relative" id="<?php echo esc_attr($unique_id); ?>">
            
            <!-- Header Section -->
            <div class="text-center mb-16">
                <h6 class="text-[#016A7C]">TESTIMONIALS</h6>
                <h2>
                    What are our clients <span>thinking?</span>
                </h2>
            </div>

            <!-- Carousel Area -->
            <div class="relative max-w-6xl mx-auto px-4 sm:px-6 md:px-12">
                
                <!-- Prev Button (Absolute) -->
                <button class="prev-btn absolute left-0 top-1/2 -translate-y-1/2 p-2 text-black hover:scale-110 transition-transform focus:outline-none z-20 hidden md:block" aria-label="Previous testimonial">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                </button>

                <!-- Slider Container -->
                <div class="overflow-hidden w-full max-w-4xl mx-auto">
                    <div class="slides flex transition-transform duration-500 ease-out">
                        <?php foreach ($testimonials as $index => $item): ?>
                            <div class="w-full flex-shrink-0 px-4">
                                <figure class="flex flex-col items-center">
                                    <blockquote class="text-center text-lg md:text-xl lg:text-2xl leading-relaxed text-gray-600 font-serif max-w-3xl mx-auto">
                                        <p class="paragraph"><?php echo esc_html($item['text']); ?></p>
                                    </blockquote>
                                    <figcaption class="mt-8 text-center">
                                        <div class="text-xs font-bold tracking-widest text-[#5B9CA1] uppercase">
                                            <?php echo esc_html($item['author']); ?>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Next Button (Absolute) -->
                <button class="next-btn absolute right-0 top-1/2 -translate-y-1/2 p-2 text-black hover:scale-110 transition-transform focus:outline-none z-20 hidden md:block" aria-label="Next testimonial">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </div>
            
            <!-- Progress Bar -->
            <div class="mt-16 flex flex-col items-center">
                <div class="flex items-center gap-6 text-sm font-medium text-gray-900">
                    <span class="current-slide font-lato text-lg">01</span>
                    <!-- Bar container -->
                    <div class="w-64 h-[2px] bg-gray-200 relative rounded-full overflow-hidden">
                        <!-- Moving part -->
                        <div class="progress-fill absolute left-0 top-0 h-full bg-black transition-all duration-300 ease-out" style="width: <?php echo (1 / $total_slides) * 100; ?>%"></div>
                    </div>
                    <span class="total-slides font-lato text-lg"><?php echo str_pad($total_slides, 2, '0', STR_PAD_LEFT); ?></span>
                </div>
            </div>

        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('<?php echo $unique_id; ?>');
        if (!container) return;

        const slidesContainer = container.querySelector('.slides');
        const slides = container.querySelectorAll('.slides > div');
        const prevBtns = container.querySelectorAll('.prev-btn, .prev-btn-mobile');
        const nextBtns = container.querySelectorAll('.next-btn, .next-btn-mobile');
        const currentSlideEl = container.querySelector('.current-slide');
        const progressFill = container.querySelector('.progress-fill');
        
        let currentIndex = 0;
        const totalSlides = slides.length;

        function updateSlider() {
            // Update sliding position
            slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
            
            // Update numbers
            currentSlideEl.textContent = String(currentIndex + 1).padStart(2, '0');
            
            // Update progress bar
            // We want the bar to represent the segment for the current slide
            // If we have 5 slides, each is 20%. Slide 1 ends at 20%, Slide 2 at 40%, etc.
            const progress = ((currentIndex + 1) / totalSlides) * 100;
            progressFill.style.width = `${progress}%`;
        }

        prevBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSlider();
            });
        });

        nextBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            });
        });

        // Touch handling for swipe
        let touchStartX = 0;
        let touchEndX = 0;

        container.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, {passive: true});

        container.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, {passive: true});

        function handleSwipe() {
            const threshold = 50;
            if (touchEndX < touchStartX - threshold) {
                // Swipe Left -> Next
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            }
            if (touchEndX > touchStartX + threshold) {
                // Swipe Right -> Prev
                currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
                updateSlider();
            }
        }
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('testimonials_home', 'tov_testimonials_home_shortcode');
