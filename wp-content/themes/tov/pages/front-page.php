<?php
/**
 * The front page template file
 * This is the template that displays on WordPress' front page, whether it displays the blog posts index or a static page.
 */

get_header(); ?>

<main class="homepage-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('homepage-article'); ?>>
            <div class="homepage-content-wrapper">
                <h1 class="text-center">Welcome to our website</h1>
                <?php
                // Display the page content which will contain shortcodes
                the_content();
                ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
