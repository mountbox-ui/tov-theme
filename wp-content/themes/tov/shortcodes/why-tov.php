<?php
if (!defined('ABSPATH')) { exit; }

// [why_tov title="Dedicated to comfort, dignity," italic="and true compassion" main_image="url" side_image="url" rating_image="url"]
function tov_why_tov_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'pretitle' => 'WHY TOV?',
        'title'    => 'Dedicated to comfort, diginity,',
        'italic'   => 'and true compassion',
        // four icons with labels/desc
        'icon1' => '', 'h1' => 'Relationship–Centred', 'p1' => 'You or your loved ones at the heart of everything we do',
        'icon2' => '', 'h2' => 'Homes for Living',      'p2' => 'Everything you need to spend your days, your way',
        'icon3' => '', 'h3' => 'Loved by Residents',    'p3' => 'With a 9.8/10 review score on carehome.co.uk',
        'icon4' => '', 'h4' => 'Award Winning',         'p4' => 'Setting the standard for exceptional resident experiences',
    ), $atts, 'why_tov');

    $right_image = get_template_directory_uri() . '/assets/images/why-tov.svg';
    $bg_image = get_template_directory_uri() . '/assets/images/why-tov-bg-gradient.svg';

    ob_start();
    ?>
    <section class="container-full py-16 sm:py-20 md:py-24 bg-no-repeat bg-cover bg-center" style="background-image: url('<?php echo esc_url($bg_image); ?>');">
        <div class="max-w-[1200px] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- outer wrapper -->
            <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)] gap-12 lg:gap-16 items-start">
                <!-- left column -->
                <div class="text-white">
                    <!-- left: upper block (pretitle + title) -->
                    <div class="mb-8">
                        <h6 class="text-white/70 tracking-[0.2em]"><?php echo esc_html($a['pretitle']); ?></h6>
                        <h2 class="leading-tight">
                            <?php echo esc_html($a['title']); ?>
                            <span class="block md:inline"><?php echo esc_html($a['italic']); ?></span>
                        </h2>
                    </div>
                    <!-- left: icons grid (2 rows x 2 cols) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 lg:gap-x-16 gap-y-10 lg:gap-y-16">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <div class="flex flex-col items-start gap-4 sm:gap-6 max-w-[320px]">
                                <?php if (!empty($a['icon'.$i])): ?>
                                    <img src="<?php echo esc_url($a['icon'.$i]); ?>" alt="" class="w-16 h-16 sm:w-20 sm:h-20 object-contain" />
                                <?php else: ?>
                                    <span class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-white/15 flex items-center justify-center text-xl sm:text-2xl">★</span>
                                <?php endif; ?>
                                <div>
                                    <div class="font-semibold mb-1">
                                        <h5 class="leading-snug"><?php echo esc_html($a['h'.$i]); ?></h5>
                                    </div>
                                    <div class="text-white/80 text-base sm:text-lg leading-relaxed"><?php echo esc_html($a['p'.$i]); ?></div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- right column: single svg image -->
                <div class="flex justify-center items-center md:items-start">
                    <img src="<?php echo esc_url($right_image); ?>" alt="Why TOV" class="w-full max-w-[360px] sm:max-w-[400px] md:max-w-[440px] xl:max-w-[520px] h-auto object-contain mt-6 md:mt-10">
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('why_tov', 'tov_why_tov_shortcode');


