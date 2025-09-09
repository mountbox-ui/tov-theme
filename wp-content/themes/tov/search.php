<?php
/**
 * The template for displaying search results pages
 */

get_header(); ?>

<main class="container-custom py-8">
    <div class="max-w-4xl mx-auto">
            <header class="page-header mb-8">
                <h1 class="page-title text-3xl font-bold text-gray-900">
                    <?php
                    printf(
                        esc_html__('Search Results for: %s', 'tov-theme'),
                        '<span class="text-primary-600">' . get_search_query() . '</span>'
                    );
                    ?>
                </h1>
            </header>
            
            <?php if (have_posts()) : ?>
                <div class="space-y-8">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
                            <div class="p-6">
                                <header class="mb-4">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <time datetime="<?php echo get_the_date('c'); ?>">
                                            <?php echo get_the_date(); ?>
                                        </time>
                                        <span class="mx-2">•</span>
                                        <span><?php the_author(); ?></span>
                                        <?php if (get_post_type() !== 'post') : ?>
                                            <span class="mx-2">•</span>
                                            <span class="capitalize"><?php echo get_post_type(); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <h2 class="text-xl font-bold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="text-gray-900 hover:text-primary-600 transition-colors duration-200">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                </header>
                                
                                <div class="prose max-w-none mb-4">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <footer>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary text-sm">
                                        <?php esc_html_e('Read More', 'tov-theme'); ?>
                                    </a>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <?php get_template_part('template-parts/pagination'); ?>
                
            <?php else : ?>
                <div class="card p-6 text-center">
                    <h2 class="text-xl font-semibold mb-4"><?php esc_html_e('Nothing Found', 'tov-theme'); ?></h2>
                    <p class="text-gray-600 mb-6">
                        <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tov-theme'); ?>
                    </p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
