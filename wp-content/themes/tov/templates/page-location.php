<?php
/**
 * Template Name: Location Page
 * Template for displaying individual location pages
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<div class="bg-white px-6 py-24 sm:py-32 lg:px-8 dark:bg-gray-900">
  <div class="mx-auto max-w-4xl">
    <!-- Page Title -->
    <header class="mb-12 text-center">
      <h1 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl dark:text-white">
        <?php the_title(); ?>
      </h1>
    </header>
    
    <!-- Page Content -->
    <div class="prose prose-lg max-w-none dark:prose-invert">
      <?php 
      // Display the page content
      the_content();
      
      // Display pagination for multi-page content
      wp_link_pages(array(
          'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'tov') . '</span>',
          'after' => '</div>',
          'link_before' => '<span>',
          'link_after' => '</span>',
      ));
      ?>
    </div>
  </div>
</div>
<?php endwhile; ?>

<?php get_footer(); ?>