<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Google Fonts -->
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Lora:ital,wght@0,400..700;1,400..700&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
    <header id="masthead" class="site-header <?php echo (is_front_page() || is_home()) ? 'bg-transparent' : 'bg-[#014854]'; ?> fixed top-0 pt-4 w-full z-50">
        <div class="container-custom max-w-[1280px] mx-auto pl-[0px] pr-[0px]">
            <div class="flex lg:grid lg:grid-cols-[1fr_auto_1fr] items-center justify-between lg:justify-center p-4">
                <!-- Site Logo -->
                <div class="site-branding flex justify-start">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tov-log-white.svg" 
                             alt="<?php bloginfo('name'); ?>" 
                             class="h-12 w-auto md:pt-4 md:h-16 md:w-auto lg:pt-0 lg:h-[91px] lg:w-[297px]">
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-white hover:text-navy-200 hover:bg-navy-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-navy-400 ml-4" aria-expanded="false">
                    <span class="sr-only"><?php esc_html_e('Open main menu', 'tov-theme'); ?></span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Desktop Navigation -->
                <nav id="site-navigation" class="main-navigation hidden lg:flex lg:items-center lg:gap-[20px] justify-center">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'flex gap-[20px]',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 2, // Allow submenus
                    ));
                    ?>
                </nav>

                <!-- Contact Us Button (desktop) -->
                <div class="hidden lg:flex justify-end">
                    <a href="#contact" class="btn-primary hover:bg-teal-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200 uppercase tracking-wide">
                        Contact Us
                    </a>
                </div>

                <?php // Search icon removed from navbar ?>
            </div>

            <!-- Mobile Navigation -->
            <nav id="mobile-navigation" class="mobile-navigation lg:hidden hidden bg-[#014854]">
                <div class="px-2 pt-2 pb-3 space-y-1 border-t border-white/20">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'mobile-menu',
                        'menu_class'     => 'space-y-1',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 2, // Allow submenus
                    ));
                    ?>
                    
                    <!-- Mobile Contact Us Button -->
                    <div class="pt-4">
                        <a href="#contact" class="block btn-primary hover:bg-teal-700 text-white font-semibold px-6 py-3 rounded-lg transition-colors duration-200 uppercase tracking-wide text-center">
                            Contact Us
                        </a>
                    </div>
                </div>
            </nav>

            <?php // Collapsible search form removed ?>
        </div>
    </header>

    <div id="content" class="site-content flex-grow"><?php // Opening tag closed in footer.php ?>
