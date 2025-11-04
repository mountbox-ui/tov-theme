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
    <section class="container-full py-[80px] sm:py-[80px] bg-no-repeat bg-cover bg-center" style="background-image: url('<?php echo esc_url($bg_image); ?>');">
        <div class="container-custom max-w-[1280px] mx-auto">
            <!-- outer wrapper -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-[48px] items-start">
                <!-- left column -->
                <div class="text-white">
                    <!-- left: upper block (pretitle + title) -->
                    <div class="mb-8">
                        <h6 class="text-white/70 text-xs tracking-[0.2em]  pb-[26px]"><?php echo esc_html($a['pretitle']); ?></h6>
                        <h2 class="text-[40px] sm:text-3xl md:text-4xl font-semibold pb-[37px]">
                            <?php echo esc_html($a['title']); ?>
                            <span class="block md:inline"><?php echo esc_html($a['italic']); ?></span>
                        </h2>
                    </div>
                    <!-- left: icons grid (2 rows x 2 cols) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-[106px] gap-y-[67px]">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <div class="flex flex-col items-start gap-6 w-[269px]">
                                <?php if (!empty($a['icon'.$i])): ?>
                                    <img src="<?php echo esc_url($a['icon'.$i]); ?>" alt="" class="w-[78px] h-[78px] object-contain" />
                                <?php else: ?>
                                    <span class="w-[78px] h-[78px] rounded-full bg-white/15 flex items-center justify-center">★</span>
                                <?php endif; ?>
                                <div>
                                    <div class="font-semibold mb-1 w-[269px]"> <h5><?php echo esc_html($a['h'.$i]); ?></h5></div>
                                    <div class="text-white/80 text-[18px] leading-relaxed"><?php echo esc_html($a['p'.$i]); ?></div>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- right column: single svg image -->
                <div class="flex justify-center items-start px-0px">
                    <img src="<?php echo esc_url($right_image); ?>" alt="Why TOV" class="w-full max-w-[530px] h-[580px] object-contain mt-[44px]">
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('why_tov', 'tov_why_tov_shortcode');


