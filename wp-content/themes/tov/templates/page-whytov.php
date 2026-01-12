<?php
/**
 * Template Name: Why TOV Page
 * Template for displaying individual service pages
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<div class="max-w-[1280px] mx-auto  pt-[110px] pb-[110px] px-4 sm:px-6  relative z-10">
  <div>
    <!-- Page Title -->
    <div class="text-left mb-4 mx-auto max-w-2xl lg:mx-0">
        <h2>
            Why The Old Vicarage Care Home? <span>A sanctuary of care in East Devon</span>
        </h2>
        <p class="paragraph mt-6">
            The Old Vicarage Care Home is a sanctuary of care in East Devon, offering more than just care; it offers a vibrant, supportive community set in one of East Devon's most picturesque locations. Here's a breakdown of why it stands out as an outstanding choice.
        </p>
    </div>
    
    <!-- Page Content -->
    <div class=" max-w-none dark:prose-invert">
      <?php 
      // Display the page content
      the_content();
      ?>

<?php echo do_shortcode('[image_section position="right"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 18.jpg" alt="The Old Vicarage"]
        [image_section_content title="The gold standard care" description="The Old Vicarage is a family-run, award-winning facility rated Outstanding by the Care Quality Commission (CQC)."]
          [image_section_feature icon="clock" title="Range of Care:"]Provides comprehensive, person-centred care including: Long-term Residential Care, Respite Care, Dementia Care.[/image_section_feature]
          [image_section_feature icon="lock" title="Approach:"]Care is tailored to individual needs with a strong emphasis on dignity, independence, and wellbeing.[/image_section_feature]
          [image_section_feature icon="database" title="Support:"]Transport is provided for GP registration and medical appointments.[/image_section_feature]
          [image_section_feature icon="clock" title="Assessment:"]Care coordinators conduct pre-assessments (at home or in hospital) to ensure the perfect fit for each resident.[/image_section_feature]
        [/image_section_content]
      [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="left"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/tov-17.jpg" alt="The Old Vicarage"]
        [image_section_content title="A slice of paradise" description="The home enjoys a prime and accessible position in Otterton, a picturesque village known for its historic mill and countryside walks."]
          [image_section_feature icon="clock" title="Setting:"]Nestled in the heart of the East Devon Area of Outstanding Natural Beauty.[/image_section_feature]
          [image_section_feature icon="lock" title="Local Attractions:"]Close proximity to the Jurassic Coast, a UNESCO World Heritage Site, perfect for day trips.[/image_section_feature]
          [image_section_feature icon="database" title="Accessibility:"]Excellent transport links, lying just 3 km from Budleigh Salterton, 8 km from Exmouth, and 6 km from Sidmouth.[/image_section_feature]
          [image_section_feature icon="clock" title="Travel Hub:"]Only 15 km from Exeter International Airport, reachable within 20–25 minutes by car.[/image_section_feature]
        [/image_section_content]
      [/image_section]'); ?>
      
      <?php echo do_shortcode('[image_section position="right"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 63.jpg" alt="The Old Vicarage"]
        [image_section_content title="Day Filled with Activities - Famileo App" description="Daily life is enriched with a diverse and engaging program that fosters connection, creativity and purpose."]
          [image_section_feature icon="clock" title="Activities Program:"]A vibrant calendar tailored to interests, including: Morning chair yoga / Move it or Lose it, Art classes and board games, Gardening club, Fitness sessions, Animal visits and Book club discussions.[/image_section_feature]
          [image_section_feature icon="lock" title="Social Spaces:"]Activities are held in the main lounge, activities room and gardens.[/image_section_feature]
          [image_section_feature icon="database" title="Technology & Connection (Famileo App):"]The Famileo App is used to keep families closely involved, providing regular updates and messages, ensuring confidence in the quality of care.[/image_section_feature]
        [/image_section_content]
      [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="left"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 64.jpg" alt="The Old Vicarage"]
        [image_section_content title="Fantastic Facilities" description="The Old Vicarage seamlessly blends heritage charm with modern standards in a beautiful setting."]
          [image_section_feature icon="clock" title="Setting:"]A Georgian country house surrounded by one acre of beautifully landscaped gardens.[/image_section_feature]
          [image_section_feature icon="lock" title="Private Rooms:"]Private en-suite rooms designed for comfort and sensory needs. Amenities include: Modern call bell system, Wi-Fi, TV, and direct telephone lines, Walk-in showers (in selected rooms).[/image_section_feature]
          [image_section_feature icon="database" title="Mobility Support:"]Assisted hi-lo baths and spacious wet room showers ensure a refreshing start to the day for everyone.[/image_section_feature]
          [image_section_feature icon="clock" title="Views:"]Residents enjoy beautiful country views from their rooms and shared spaces.[/image_section_feature]
        [/image_section_content]
      [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="right"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 64.jpg" alt="The Old Vicarage"]
        [image_section_content title="Experienced Team and a Part of Neways Healthcare" description="The heart of The Old Vicarage is its dedicated staff, who provide care with compassion and expertise."]
          [image_section_feature icon="clock" title="Staff Quality:"]A team of dedicated, compassionate and experienced staff who work closely with residents and families.[/image_section_feature]
          [image_section_feature icon="lock" title="Focus:"]Strong emphasis on person-centred care to help each resident get the best out of their life.[/image_section_feature]
          [image_section_feature icon="database" title="Culture:"]Described as a "happy, fun-loving team" that goes "above and beyond" daily.[/image_section_feature]
          [image_section_feature icon="clock" title="Corporate Backing:"]The Old Vicarage is part of the trusted Neways healthcare family.[/image_section_feature]
        [/image_section_content]
      [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="left"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 64.jpg" alt="The Old Vicarage"]
        [image_section_content title="Community Engagement at The Old Vicarage" description="The Old Vicarage is a vibrant hub that regularly hosts fantastic events designed to foster a strong sense of community and enhance resident engagement."]
          [image_section_feature icon="clock" title="Pivotal Activities:"]Meticulously planned activities, ranging from intergenerational family days to therapeutic resident workshops.[/image_section_feature]
          [image_section_feature icon="lock" title="Purpose:"]These activities are pivotal in bringing residents, their loved ones and the wider community together.[/image_section_feature]
          [image_section_feature icon="database" title="Outcomes:"]By providing enriching opportunities for shared experiences, connection and purposeful interaction, The Old Vicarage ensures: A better quality of life for its residents, Strengthened familial bonds, Solidification of its role as an integral and positive force within the local area.[/image_section_feature]
        [/image_section_content]
      [/image_section]'); ?>

      
<?php echo do_shortcode('[image_section position="right"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 59.jpg" alt="The Old Vicarage"]
        [image_section_content title="Award-Winning Cuisine" description="Mealtimes are a celebrated highlight, nourishing both body and soul with fresh, high-quality ingredients."]
          [image_section_feature icon="clock" title="Quality:"]Chefs prepare nutritious, home-grown meals daily.[/image_section_feature]
          [image_section_feature icon="lock" title="Source:"]Ingredients are sourced fresh, including produce from the homes own kitchen garden.[/image_section_feature]
          [image_section_feature icon="database" title="Experience:"]Lunch is served in the dining room, often featuring themed meals and special occasions with wine. Residents can also dine in their room or book a private dining room for family gatherings.[/image_section_feature]
          [image_section_feature icon="clock" title="Daily Treats:"]Homemade cakes and cookies arrive for afternoon tea.[/image_section_feature]
        [/image_section_content]
      [/image_section]'); ?>

    </div>
  </div>
</div>
<?php endwhile; ?>

<div>
      <?php echo do_shortcode('[events_section]'); ?>
    </div>

<?php get_footer(); ?>
