    </div><!-- #content -->

    <footer id="colophon" class="site-footer bg-[#014854] text-white">
        <div class="container-custom max-w-[1280px] mx-auto py-10 lg:py-12 px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 border-b border-white/20 pb-8">
                <!-- Brand + Address -->
                <div>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center ">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tov-log-white.svg" alt="<?php bloginfo('name'); ?>" class="w-[260px] h-[72px]">
                    </a>
                    <div class="mt-4 text-sm text-white leading-6">
                        <p>Ropers Lane, Otterton, Budleigh<br> Salterton East Devon, EX9 7JF</p>
                        <p class="mt-3">01395 568208</p>
                        <p>enquiries@theoldvicarageotterton.com</p>
                    </div>
                </div>

                <!-- About Us -->
                <!-- <div>
                    <h4 class="text-sm font-semibold mb-4">About Us</h4>
                    <?php if (has_nav_menu('footer_about')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_about',
                            'menu_class' => 'space-y-2 text-sm text-white/80',
                            'container' => false,
                            'depth' => 1,
                        ));
                    } ?>
                </div> -->

                <!-- Services -->
                <div>
                    <h4 class="text-sm font-semibold mb-4">Services</h4>
                    <?php if (has_nav_menu('footer_services')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_services',
                            'menu_class' => 'space-y-2 text-sm text-white/80',
                            'container' => false,
                            'depth' => 1,
                        ));
                    } ?>
                </div>

                <!-- Resources -->
                <div>
                    <h4 class="text-sm font-semibold mb-4">Resources</h4>
                    <?php if (has_nav_menu('footer_resources')) {
                        wp_nav_menu(array(
                            'theme_location' => 'footer_resources',
                            'menu_class' => 'space-y-2 text-sm text-white/80',
                            'container' => false,
                            'depth' => 1,
                        ));
                    } ?>
                </div>
            </div>

            <!-- Bottom bar -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-6">
                <p class="text-xs text-white/70">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
                <?php if (has_nav_menu('footer_legal')) {
                    wp_nav_menu(array(
                        'theme_location' => 'footer_legal',
                        'menu_class' => 'flex items-center gap-6 text-xs text-white/80',
                        'container' => false,
                        'depth' => 1,
                    ));
                } else { ?>
                    <ul class="flex items-center gap-6 text-xs text-white/80">
                        <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy policy</a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>">Terms &amp; conditions</a></li>
                        <li><a href="<?php echo esc_url(home_url('/modern-slavery-act/')); ?>">Modern Slavery Act</a></li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
