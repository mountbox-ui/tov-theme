<?php
// === Parent Shortcode ===
function hero_section_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'bg' => '',         // background image URL (optional)
        'youtube' => '',    // YouTube URL for background video (optional)
    ), $atts, 'hero_section');

    $bg = esc_url($atts['bg']);
    $youtube = trim($atts['youtube']);
    // Extract YouTube id early so it can be used in markup attributes
    $video_id = '';
    if (!empty($youtube) && preg_match('~(?:youtu.be/|v=|embed/)([A-Za-z0-9_-]{6,})~', $youtube, $m)) {
        $video_id = $m[1];
    }

    $content = $content ?? '';

    // Remove auto-inserted paragraph and line break tags that WordPress may add
    $clean_content = shortcode_unautop($content);
    $clean_content = preg_replace('#(?:<br\s*/?>\s*)+#', "\n", $clean_content ?? '');

    ob_start();
    ?>
    <section id="support-center" class="container-full relative isolate overflow-hidden dark:bg-gray-900 h-[600px] sm:h-[680px] md:h-[720px] lg:h-[600px]"<?php echo !empty($video_id) ? ' data-video-id="' . esc_attr($video_id) . '"' : ''; ?>>
        <?php
        // Prefer YouTube background if provided
        if ($video_id): ?>
            <div class="absolute inset-0 -z-20 overflow-hidden h-[600px] sm:h-[680px] md:h-[720px] lg:h-[600px]">
                <iframe class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none"
                        style="width: max(100vw, calc(100vh * 16 / 9)); height: max(100vh, calc(100vw * 9 / 16));"
                        src="https://www.youtube.com/embed/<?php echo esc_attr($video_id); ?>?autoplay=1&mute=1&controls=0&playsinline=1&loop=1&playlist=<?php echo esc_attr($video_id); ?>&modestbranding=1&rel=0"
                        title="Background video" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            </div>
        <?php elseif($bg): ?>
            <img src="<?php echo $bg; ?>" alt="" class="absolute inset-0 -z-20 w-full h-full object-cover dark:hidden" />
        <?php endif; ?>
        <!-- overlays -->
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/50 to-black/0"></div>
        <div class="absolute inset-0 -z-10 bg-[linear-gradient(282deg,rgba(0,58,68,0.40)_5.65%,rgba(82,60,37,0.40)_97.18%)]"></div>

        <div class="max-w-[1280px] mx-auto py-12 sm:py-16 md:py-24 lg:py-32 px-4 sm:px-6 relative">
            <div class="max-w-3xl mt-[56px] lg:mx-0">
                <?php echo do_shortcode($clean_content); ?>
            </div>
            
            <!-- Play Video Button - Absolutely positioned on right -->
            <?php if (!empty($video_id)) : ?>
            <div class="absolute right-8 md:right-12 lg:right-16 top-1/2 -translate-y-1/2 hidden md:flex">
                <a href="#" id="hero-video-trigger" class="inline-flex flex-col items-center justify-center gap-2 text-white/90 hover:text-white text-xs sm:text-sm group">
                    <div class="relative inline-flex items-center justify-center">
                        <!-- Pulsing glow rings - positioned outside the circle -->
                        <span class="absolute inline-flex rounded-full border-2 border-white opacity-25 animate-ping" style="width: 110px; height: 110px;"></span>
                        <span class="absolute inline-flex rounded-full border-2 border-white opacity-15 animate-pulse" style="width: 100px; height: 100px;"></span>
                        <!-- Glassy effect overlay on hover -->
                        <span class="absolute inset-0 rounded-full bg-white/10 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out" style="width: 82px; height: 82px; margin: auto;"></span>
                        <!-- Shine effect on hover -->
                        <span class="absolute inset-0 rounded-full bg-gradient-to-br from-white/20 via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out" style="width: 82px; height: 82px; margin: auto; clip-path: polygon(0 0, 100% 0, 100% 50%, 0 50%);"></span>
                        <!-- Play icon -->
                        <span class="relative z-10">
                            <svg xmlns="http://www.w3.org/2000/svg" width="82" height="82" viewBox="0 0 55 55" fill="none" class="w-[82px] h-[82px] transition-all duration-300 group-hover:drop-shadow-[0_0_15px_rgba(255,255,255,0.4)]">
                                <path d="M23.5742 35.8728C23.8561 35.8728 24.1094 35.7889 24.335 35.6198L24.3613 35.654L24.335 35.6189L24.3389 35.6169L35.0957 29.2321L35.0986 29.2312C35.3217 29.1196 35.4896 28.9382 35.6025 28.6843C35.7169 28.427 35.7744 28.1704 35.7744 27.9148C35.7744 27.6592 35.717 27.4182 35.6035 27.1911C35.4912 26.9665 35.3233 26.7986 35.0986 26.6862L35.0957 26.6843L24.3389 20.2126C24.1131 20.1003 23.8585 20.0437 23.5742 20.0437C23.2905 20.0437 23.0363 20.1145 22.8105 20.2556C22.5842 20.3971 22.3993 20.5958 22.2568 20.8523C22.1146 21.1083 22.0439 21.378 22.0439 21.6618V34.2546C22.0439 34.5383 22.1147 34.8082 22.2568 35.0642C22.3993 35.3207 22.5842 35.5194 22.8105 35.6609C23.0364 35.802 23.2904 35.8728 23.5742 35.8728Z" fill="white" fill-opacity="0.68" stroke="white" stroke-width="0.0874545" class="transition-all duration-300 group-hover:fill-opacity-90"/>
                                <circle cx="27.3165" cy="27.3165" r="25.644" stroke="white" stroke-width="3.34487" class="transition-all duration-300"/>
                            </svg>
                        </span>
                    </div>
                    <!-- <span class="text-white/90 group-hover:text-white transition-colors">Play video</span> -->
                </a>
            </div>
            <?php endif; ?>
        </div>
        
        <style>
        @keyframes ping {
            75%, 100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }
        .animate-ping {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
        </style>
    </section>
    <?php if (!empty($video_id)) : ?>
    <div id="hero-video-overlay" class="fixed inset-0 z-50 hidden bg-black/90">
        <button id="hero-video-close" class="absolute right-4 top-4 text-white text-2xl" aria-label="Close">&times;</button>
        <div class="h-full w-full flex items-center justify-center">
            <iframe id="hero-video-iframe" class="" style="width: min(100vw, calc(100vh * 16 / 9)); height: min(100vh, calc(100vw * 9 / 16));" src="" title="Hero video" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
        </div>
        </div>
    </div>
    <?php endif; ?>
    <?php
    return ob_get_clean();
}
add_shortcode('hero_section', 'hero_section_shortcode');


// === Pretitle Shortcode ===
function hero_section_pretitle_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text' => 'A WARM WELCOME AWAITS YOU',
    ), $atts, 'hero_pretitle');

    return '<h6 class="text-white opacity-90 pb-4" >'
            . esc_html($atts['text']) . '</h6>';
}
add_shortcode('hero_pretitle', 'hero_section_pretitle_shortcode');


// === Heading Shortcode ===
function hero_section_heading_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text' => 'Default Heading',
    ), $atts, 'hero_heading');

    return '<h1 class="text-white pb-1">'
            . esc_html($atts['text']) . '</h1>';
}
add_shortcode('hero_heading', 'hero_section_heading_shortcode');


// === Paragraph Shortcode ===
function hero_section_paragraph_shortcode($atts) {
    $atts = shortcode_atts(array(
        'text' => 'Default paragraph goes here...',
    ), $atts, 'hero_paragraph');

    return '<p class="hero-section-text sm:text-sm md:text-xl lg:text-xl opacity-80 pb-5 leading-[1.15] sm:leading-[1.15] md:leading-[1.2] lg:leading-[1.25]" >'
            . esc_html($atts['text']) . '</p>';
}
add_shortcode('hero_paragraph', 'hero_section_paragraph_shortcode');


// === Buttons Row Shortcode ===
function hero_section_buttons_shortcode($atts) {
    $atts = shortcode_atts(array(
        'primary_text' => 'Get In Touch',
        'primary_url'  => '#contact',
        'phone_text'   => '01395 542808',
        'phone_url'    => 'tel:01395542808',
        'see_text'     => 'See how we work',
        'see_url'      => '#',
    ), $atts, 'hero_buttons');
 $arrow_icon = '<span class="ml-2 inline-block transform transition-transform duration-300 ease-in-out group-hover:translate-x-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
        <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="white"/>
    </svg>
</span>';

    $primary = '<a href="' . esc_url($atts['primary_url']) . '" class="btn btn-primary bt-1">'
             . esc_html($atts['primary_text']) . $arrow_icon . '</a>';
   

    $phone_icon = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-3.5 w-3.5 sm:h-4 sm:w-4">'
                . '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372a1.125 1.125 0 0 0-.852-1.09l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293a1.125 1.125 0 0 1-1.21.386 12.035 12.035 0 0 1-7.143-7.143 1.125 1.125 0 0 1 .386-1.21l1.293-.97a1.125 1.125 0 0 0 .417-1.173L6.962 3.102A1.125 1.125 0 0 0 5.872 2.25H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25z"/></svg>';

    $phone = '<a href="' . esc_url($atts['phone_url']) . '" class="inline-flex w-[152px] items-center justify-center gap-1.5 sm:gap-2 rounded-md border border-white/30 text-white  sm:px-6 sm:py-4 bg-[rgba(28, 35, 33, 0.20)] opacity-[0.7983] text-base sm:text-lg hover:bg-white/10 transition-colors whitespace-nowrap sm:w-auto">'
           . $phone_icon . '<span>' . esc_html($atts['phone_text']) . '</span></a>';

    $play_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none" class="w-10 h-10 sm:w-12 sm:h-12 md:w-[55px] md:h-[55px] transition-all duration-300 group-hover:drop-shadow-[0_0_12px_rgba(255,255,255,0.4)]">
<path d="M23.5742 35.8728C23.8561 35.8728 24.1094 35.7889 24.335 35.6198L24.3613 35.654L24.335 35.6189L24.3389 35.6169L35.0957 29.2321L35.0986 29.2312C35.3217 29.1196 35.4896 28.9382 35.6025 28.6843C35.7169 28.427 35.7744 28.1704 35.7744 27.9148C35.7744 27.6592 35.717 27.4182 35.6035 27.1911C35.4912 26.9665 35.3233 26.7986 35.0986 26.6862L35.0957 26.6843L24.3389 20.2126C24.1131 20.1003 23.8585 20.0437 23.5742 20.0437C23.2905 20.0437 23.0363 20.1145 22.8105 20.2556C22.5842 20.3971 22.3993 20.5958 22.2568 20.8523C22.1146 21.1083 22.0439 21.378 22.0439 21.6618V34.2546C22.0439 34.5383 22.1147 34.8082 22.2568 35.0642C22.3993 35.3207 22.5842 35.5194 22.8105 35.6609C23.0364 35.802 23.2904 35.8728 23.5742 35.8728Z" fill="white" fill-opacity="0.68" stroke="white" stroke-width="0.0874545" class="transition-all duration-300 group-hover:fill-opacity-90"/>
<circle cx="27.3165" cy="27.3165" r="25.644" stroke="white" stroke-width="3.34487" class="transition-all duration-300"/>
</svg>';

    // Play icon with label underneath and pulsing glow effect
    $see = '<a href="#" id="hero-video-trigger" class="inline-flex flex-col items-center justify-center gap-1 text-white/90 hover:text-white text-xs sm:text-sm md:text-base group">
        <div class="relative inline-flex items-center justify-center">
            <!-- Pulsing glow rings -->
            <span class="absolute inline-flex h-full w-full rounded-full bg-white opacity-30 animate-ping"></span>
            <span class="absolute inline-flex h-full w-full rounded-full bg-white opacity-20 animate-pulse"></span>
            <!-- Glassy effect overlay on hover -->
            <span class="absolute inset-0 rounded-full bg-white/10 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out h-full w-full"></span>
            <!-- Shine effect on hover -->
            <span class="absolute inset-0 rounded-full bg-gradient-to-br from-white/20 via-white/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out h-full w-full" style="clip-path: polygon(0 0, 100% 0, 100% 50%, 0 50%);"></span>
            <!-- Play icon -->
            <span class="relative z-10">' . $play_icon . '</span>
        </div>
        <span class="mt-1 text-white/90 group-hover:text-white transition-colors">Play video</span>
    </a>
    
    <style>
    @keyframes ping {
        75%, 100% {
            transform: scale(1.3);
            opacity: 0;
        }
    }
    .animate-ping {
        animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    </style>';

    // Left buttons (primary + phone) - play button is now absolutely positioned in hero section
    $left  = '<div class="flex flex-col min-[600px]:flex-row min-[600px]:items-center gap-3 sm:gap-4 w-full sm:w-auto">' . $primary . $phone . '</div>';

    return '<div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-5 w-full max-w-[1200px]">' . $left . '</div>';
}
add_shortcode('hero_buttons', 'hero_section_buttons_shortcode');

