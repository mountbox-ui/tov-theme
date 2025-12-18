<?php
/**
 * Template Name: Service Page
 * Template for displaying individual service pages
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <!-- Page Title -->
    <header class="mb-12 text-center">
      <h2 class="text-left">
        <?php the_title(); ?>
      </h2>
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
