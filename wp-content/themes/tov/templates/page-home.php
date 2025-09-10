<?php
/**
 * Template Name: Homepage Template
 * 
 * This template can be selected for any page that should use the homepage layout.
 * Perfect for homepage content with shortcodes.
 */

get_header(); ?>

<main class="homepage-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('homepage-article'); ?>>
            <div class="homepage-content-wrapper">
                <h1>Welcome to our website</h1>
                <h2>Welcome to our website</h2>
                <h3>Welcome to our website</h3>
                <h4>Welcome to our website</h4>
                <h5>Welcome to our website</h5>
                <h6>Welcome to our website</h6>
                <p>Welcome to our website</p>
                <a href="#">Welcome to our website</a>
                <button class="btn btn-primary">know more</button>
                <?php
                
                // Display the page content which will contain shortcodes
                the_content();
                ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
