<?php
/**
 * Template Name: Rooms and Facilities
 * 
 * Custom template for displaying rooms and facilities information.
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<main class="rooms-facilities-page">
    <?php 
    // Display the rooms and facilities hero section
    echo do_shortcode('[rooms_facilities_hero subheading="Rooms & Facilities" heading="Discover the comforts of <span>The Old Vicarage</span>" description="At The Old Vicarage, we believe that assisted living should be a time for new experiences, relaxation and connection; and that is why we have carefully designed our home to be more than just a place to live – it is a vibrant destination where every day offers something engaging and enjoyable." button_text="Book a Tour" button_url="/book-a-tour/?form=visit" image_url="/wp-content/themes/tov/assets/images/About Us H1.png"]');
    
    // Display the page content (which contains shortcodes)
    the_content();
    
    // Display resident comfort section
    echo do_shortcode('[resident_comfort heading="Resident <span>comfort & support</span>" subheading="We are dedicated to providing a comfortable and supportive environment for all residents, with a focus on privacy and convenience. Ensuring a refreshing and dignified start to the day is a priority, with specialized equipment and accessible facilities."]
        [comfort_item image="/wp-content/themes/tov/assets/images/TOV 63.jpg" title="Private rooms" description="Our private en-suite rooms are thoughtfully designed with resident comfort and sensory needs in mind." link="/link-to-page"]
        [comfort_item image="/wp-content/themes/tov/assets/images/TOV 63.jpg" title="Modern amenities" description="Each room is equipped with a modern call bell system, Wi-Fi, TV, and a direct telephone line for convenience and connectivity." link="/link-to-page"]
        [comfort_item image="/wp-content/themes/tov/assets/images/TOV 63.jpg" title="En-suite bathrooms" description="Selected rooms feature easily accessible walk-in showers." link="/link-to-page"]
        [comfort_item image="/wp-content/themes/tov/assets/images/TOV 63.jpg" title="Specialised bathing" description="Residents have access to assisted hi-lo baths and spacious wet room showers designed for maximum safety and ease of use." link="/link-to-page"]
        [comfort_item image="/wp-content/themes/tov/assets/images/TOV 63.jpg" title="Scenic location" description="Residents can enjoy beautiful country views directly from their rooms and all shared communal spaces, promoting calm and well-being." link="/link-to-page"]
    [/resident_comfort]');
    
    // Display culinary spaces section
    echo do_shortcode('[culinary_spaces heading="Culinary delights and social spaces" subheading="We understand that food and good company are central to a happy life. Our amenities are designed to bring people together, whether for a quick catch-up or an elegant meal."]
        [space_item title="Dining rooms" description="Experience elegant dining experiences daily. Our chefs prepare fresh, seasonal menus served in a beautiful setting, making every meal a special occasion." image="/wp-content/themes/tov/assets/images/TOV 63.jpg"]
        [space_item title="Café on the wheels" description="Our mobile Café serves premium coffee and delicious snacks, offering the perfect place to catch up or unwind with a good book. Throughout the mid‑morning and afternoon, you can enjoy a selection of beverages – coffee, tea, yogurt drinks and more – paired with a variety of tasty snacks." image="/wp-content/themes/tov/assets/images/TOV 63.jpg"]
        [space_item title="Lounges" description="Step into our comfortable relaxation areas. These tastefully decorated lounges are the perfect spots for afternoon tea, card games or simply relaxing by the fireplace." image="/wp-content/themes/tov/assets/images/TOV 63.jpg"]
    [/culinary_spaces]');
    
    // Display pagination for multi-page content
    wp_link_pages(array(
        'before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'tov') . '</span>',
        'after' => '</div>',
        'link_before' => '<span>',
        'link_after' => '</span>',
    ));
    ?>
</main>
<?php endwhile; ?>

<?php get_footer(); ?>
