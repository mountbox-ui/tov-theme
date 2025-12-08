<?php
/**
 * Template Name: Why TOV Page
 * Template for displaying individual service pages
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
<div class="max-w-[1280px] mx-auto px-4 pt-[110px] pb-[110px] sm:px-6 relative z-10">
  <div>
    <!-- Page Title -->
    <div class="text-left mb-16 mx-auto max-w-2xl lg:mx-0">
        <!-- <h2 class="font-bold">Why The Old Vicarage Care Home? <span>A sanctuary of care in East Devon</span></h2>
        <p class="paragraph mt-6">
            The Old Vicarage, an award-winning residential and dementia care facility, offers more than just care; it offers a vibrant, supportive community set in one of East Devon's most picturesque locations. Here's a breakdown of why it stands out as an outstanding choice.
        </p> -->
        <h2>
            Why The Old Vicarage Care Home? <span>A sanctuary of care in East Devon</span>
        </h2>
        <p class="paragraph mt-6">
            The Old Vicarage Care Home is a sanctuary of care in East Devon, offering more than just care; it offers a vibrant, supportive community set in one of East Devon's most picturesque locations. Here's a breakdown of why it stands out as an outstanding choice.
        </p>
    </div>
    
    <!-- Page Content -->
    <div class="prose prose-lg max-w-none dark:prose-invert">
      <?php 
      // Display the page content
      the_content();
      ?>

      <?php echo do_shortcode('[image_section position="left"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/tov-17.jpg" alt="The Old Vicarage"]
        [image_section_content title="A slice of paradise" button_text="Click" button_url="#"]The home enjoys a prime and accessible position in Otterton, a picturesque village known for its historic mill and countryside walks.<br>
        <span class="font-semibold">Setting:</span> Nestled in the heart of the East Devon Area of Outstanding Natural Beauty.<br>  
        <span class="font-semibold">Local Attractions:</span> Close proximity to the Jurassic Coast, a UNESCO World Heritage Site, perfect for day trips.<br>  
        <span class="font-semibold">Accessibility:</span> Excellent transport links, lying just 3 km from Budleigh Salterton, 8 km from Exmouth, and 6 km from Sidmouth.<br>  
        <span class="font-semibold">Travel Hub:</span> Only 15 km from Exeter International Airport, reachable within 20–25 minutes by car.<br> [/image_section_content]
        [/image_section]'); ?>
      
      <?php echo do_shortcode('[image_section position="right"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 18.jpg" alt="The Old Vicarage"]
        [image_section_content title="The gold standard care" button_text="Click" button_url="#"]The Old Vicarage is a family-run, award-winning facility rated Outstanding by the Care Quality Commission (CQC). <br>
        <span class="font-semibold">Range of Care:</span> Provides comprehensive, person-centred care including: Long-term Residential Care, Respite Care, Dementia Care.<br>  
        <span class="font-semibold">Approach:</span> Care is tailored to individual needs with a strong emphasis on dignity, independence, and wellbeing.<br>  
        <span class="font-semibold">Support:</span> Transport is provided for GP registration and medical appointments.<br>  
        <span class="font-semibold">Assessment:</span> Care coordinators conduct pre-assessments (at home or in hospital) to ensure the perfect fit for each resident.<br> [/image_section_content]
        [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="left"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 59.jpg" alt="The Old Vicarage"]
        [image_section_content title="Award-Winning Cuisine" button_text="Click" button_url="#"]Mealtimes are a celebrated highlight, nourishing both body and soul with fresh, high-quality ingredients. <br>
        <span class="font-semibold">Quality:</span> Chefs prepare nutritious, home-grown meals daily.<br>  
        <span class="font-semibold">Source:</span> Ingredients are sourced fresh, including produce from the homes own kitchen garden.<br>  
        <span class="font-semibold">Experience:</span> Lunch is served in the dining room, often featuring themed meals and special occasions with wine. Residents can also dine in their room or book a private dining room for family gatherings.<br>  
        <span class="font-semibold">Daily Treats:</span> Homemade cakes and cookies arrive for afternoon tea.<br> [/image_section_content]
        [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="right"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 63.jpg" alt="The Old Vicarage"]
        [image_section_content title="Day Filled with Activities - Famileo App" button_text="Click" button_url="#"]Daily life is enriched with a diverse and engaging program that fosters connection, creativity and purpose. <br>
        <span class="font-semibold">Activities Program:</span> A vibrant calendar tailored to interests, including: Morning chair yoga / Move it or Lose it,Art classes and board games, Gardening club, Fitness sessions, Animal visits and Book club discussions.<br>  
        <span class="font-semibold">Social Spaces:</span> Activities are held in the main lounge, activities room and gardens.<br>  
        <span class="font-semibold">Technology & Connection (Famileo App):</span> The Famileo App is used to keep families closely involved, providing regular updates and messages, ensuring confidence in the quality of care.<br>[/image_section_content]
        [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="left"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 64.jpg" alt="The Old Vicarage"]
        [image_section_content title="Fantastic Facilities" button_text="Click" button_url="#"]The Old Vicarage seamlessly blends heritage charm with modern standards in a beautiful setting. <br>
        <span class="font-semibold">Setting:</span> A Georgian country house surrounded by one acre of beautifully landscaped gardens.<br>  
        <span class="font-semibold">Private Rooms:</span>  Private en-suite rooms designed for comfort and sensory needs. Amenities include: Modern call bell system, Wi-Fi, TV, and direct telephone lines, Walk-in showers (in selected rooms).<br>  
        <span class="font-semibold">Mobility Support:</span>  Assisted hi-lo baths and spacious wet room showers ensure a refreshing start to the day for everyone.<br>  
        <span class="font-semibold">Views:</span> Residents enjoy beautiful country views from their rooms and shared spaces.<br> [/image_section_content]
        [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="right"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 64.jpg" alt="The Old Vicarage"]
        [image_section_content title="Experienced Team and a Part of Neways Healthcare" button_text="Click" button_url="#"]The heart of The Old Vicarage is its dedicated staff, who provide care with compassion and expertise. <br>
        <span class="font-semibold">Staff Quality:</span>A team of dedicated, compassionate and experienced staff who work closely with residents and families.<br>  
        <span class="font-semibold">Focus:</span>  Strong emphasis on person-centred care to help each resident get the best out of their life.<br>  
        <span class="font-semibold">Culture:</span>  Described as a "happy, fun-loving team" that goes "above and beyond" daily.<br>  
        <span class="font-semibold">Corporate Backing:</span> The Old Vicarage is part of the trusted Neways healthcare family.<br>. [/image_section_content]
        [/image_section]'); ?>

      <?php echo do_shortcode('[image_section position="left"]
        [image_section_image src="' . get_template_directory_uri() . '/assets/images/TOV 64.jpg" alt="The Old Vicarage"]
        [image_section_content title="Community Engagement at The Old Vicarage" button_text="Click" button_url="#"]The Old Vicarage is a vibrant hub that regularly hosts fantastic events designed to foster a strong sense of community and enhance resident engagement. <br>
        <span class="font-semibold">Pivotal Activities:</span>Meticulously planned activities, ranging from intergenerational family days to therapeutic resident workshops.<br>  
        <span class="font-semibold">Purpose:</span>  hese activities are pivotal in bringing residents, their loved ones and the wider community together.<br>  
        <span class="font-semibold">Outcomes:</span> y providing enriching opportunities for shared experiences, connection and purposeful interaction, The Old Vicarage ensures: A better quality of life for its residents, Strengthened familial bonds, Solidification of its role as an integral and positive force within the local area.<br>  
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
