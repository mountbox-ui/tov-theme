<?php
/**
 * Template Name: Location Page
 * 
 * Template for location pages with a simple layout
 */

get_header(); ?>

<div class="container-custom py-16">
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-800 mb-4"><?php the_title(); ?></h1>
            <?php if (has_excerpt()) : ?>
                <p class="text-lg text-slate-600"><?php the_excerpt(); ?></p>
            <?php endif; ?>
        </div>

        <!-- Page Content -->
        <div class="prose prose-lg max-w-none">
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
        </div>

        <!-- Location Pages Menu -->
        <?php if (has_nav_menu('location_pages')) : ?>
            <div class="mt-16 pt-8 border-t border-slate-200">
                <h3 class="text-xl font-semibold text-slate-800 mb-6">Other Locations</h3>
                <nav class="location-pages-nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'location_pages',
                        'menu_class'     => 'flex flex-wrap gap-4',
                        'container'      => false,
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ));
                    ?>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
