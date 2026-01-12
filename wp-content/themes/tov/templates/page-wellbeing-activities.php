<?php
/**
 * Template Name: Wellbeing & Activities
 * Template for displaying individual service pages
 */

get_header(); ?>

<?php while (have_posts()):
    the_post(); ?>
    <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
        <div class="">
            <!-- Page Title -->
            <header class="container max-w-[1280px] mx-auto px-6">
                <div class="max-w-[800px]">
                    <h2 class="text-left">
                        <?php the_title(); ?>
                    </h2>
                    <p class="mt-6 text-lg/8 font-lato text-gray-600 dark:text-gray-400 mb-6">At The Old Vicarage, we provide
                        compassionate residential care in a warm, welcoming environment where every resident is valued and
                        supported to live life to the fullest.</p>
                </div>
            </header>

            <!-- Page Content -->
            <div >
                <div class="min-h-screen bg-[#FAF8F4]">

                    <!-- Hero Section -->
                    <section class="py-16 md:py-20 bg-[#014854] relative">
                        <!-- Background Image -->
                        <div class="absolute inset-0">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/amenities-bg-2.png'; ?>"
                                alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="container mx-auto px-6 text-center flex flex-col items-center">
                            <h1 class="text-3xl md:text-4xl mb-6 text-white leading-tight">
                                Inspired Living: Discovering Joy and Engagement
                            </h1>
                            <p class="paragraph text-white/70 mb-6 w-[700px]">
                                At The Old Vicarage, our award-winning care home we believe that a fulfilling life is built
                                on engagement, connection and pursuing personal passions.
                            </p>
                            <div class="relative rgba(1, 106, 124, 1) z-10 w-[150px] sm:w-[165px]">
                                <a href="<?php echo home_url('/contact-us/?form=visit'); ?>" class="btn btn-primary bt-1 bg-white text-[#2C5F6F] hover:bg-white hover:text-[#2C5F6F] hover:svg:hover">
                                Book a Visit
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                    <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="#2C5F6F"/>
                                </svg>
                                </a>
                        </div>
                        </div>
                    </section>

                    <!-- Introduction Section -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="max-w-5xl mx-auto">
                                <p class="text-xl text-gray-700 leading-relaxed font-sans mb-6">
                                    Our comprehensive Wellbeing and Activities programme is designed to ensure every
                                    resident feels entertained, inspired and actively involved in our vibrant community.
                                    That is why our dedicated activities team works tirelessly to design a programme that
                                    entertains, inspires and keeps our residents actively engaged every single day.
                                </p>
                                <p class="text-xl text-gray-700 leading-relaxed font-sans mb-6">
                                    From group sessions to one-to-one moments, we tailor activities to suit individual
                                    interests and hobbies. When you join us, our team will introduce themselves, learn more
                                    about what you enjoy, and invite you to share ideas for new activities.
                                </p>
                                <p class="text-2xl text-[#014854] leading-relaxed text-center mt-10">
                                    After all, this is your home, and your voice matters.
                                </p>
                            </div>
                        </div>
                    </section>

                    <!-- One-to-One Sessions -->
                    <section class="py-20 bg-[#F5F1E8]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-6xl mx-auto">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                    <div>
                                        <h2 class="text-4xl mb-6 text-[#014854]">
                                            Mornings: One-to-One Sessions
                                        </h2>
                                        <p class="paragraph mb-6">
                                            We know that sometimes the most meaningful moments happen in smaller settings.
                                            That is why our mornings often include dedicated one-to-one sessions. A member
                                            of our team spends quality time with each resident, offering companionship and
                                            support in ways that differ from person to person.
                                        </p>
                                        <p class="paragraph mb-6">
                                            These sessions are designed to nurture wellbeing, build trust, and ensure every
                                            resident feels valued. They are incredibly flexible and entirely focused on the
                                            resident's needs and preferences, which can vary widely from person to person.
                                        </p>
                                    </div>
                                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                                        <h3 class="text-2xl mb-6 text-black">What this looks like:</h3>
                                        <ul class="space-y-4">
                                            <li class="flex items-start gap-3">
                                                <div class="flex-shrink-0 w-12 h-12 bg-[#E6F0F2] rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-coffee text-[#016A7C] text-xl mt-1"></i>
                                                </div>
                                                <span class="paragraph">Enjoying a quiet chat over a cup of
                                                    tea.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                 <div class="flex-shrink-0 w-12 h-12 bg-[#E6F0F2] rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-chess text-[#016A7C] text-xl mt-1"></i>
                                                </div>
                                                <span class="paragraph">Playing a favourite card game or
                                                    solving a crossword puzzle.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                 <div class="flex-shrink-0 w-12 h-12 bg-[#E6F0F2] rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-images text-[#016A7C] text-xl mt-1"></i>
                                                </div>
                                                <span class="paragraph">Assisting with personal projects, such
                                                    as organising photos or tidying a wardrobe to create a comforting,
                                                    familiar space.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <div class="flex-shrink-0 w-12 h-12 bg-[#E6F0F2] rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-walking text-[#016A7C] text-xl mt-1"></i>
                                                </div>
                                                <span class="paragraph">Going for a short, private
                                                    walk.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <div class="flex-shrink-0 w-12 h-12 bg-[#E6F0F2] rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-heart text-[#016A7C] text-xl mt-1"></i>
                                                </div>
                                                <span class="paragraph">Simply providing companionship and a
                                                    listening ear.</span>
                                            </li>
                                        </ul>
                                        <p class="paragraph mt-6 italic">
                                            These sessions ensure that even residents with different needs or who prefer
                                            quieter activities are always actively engaged and receiving meaningful
                                            attention.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Lifestyle Activities Header -->
                    <section class="pt-16 bg-white">
                        <div class="container mx-auto px-6 flex flex-col items-start">
                            <h2 class="text-4xl mb-6 text-black">
                                Lifestyle Activities: A World of Choice
                            </h2>
                            <p class="paragraph w-[700px]">
                                Our scheduled activities run throughout the day, catering to a diverse range of physical,
                                cognitive and creative interests. Here is a closer look at some of the highlights currently
                                on our programme:
                            </p>
                        </div>
                    </section>

                    <!-- Creativity and Expression -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="max-w-6xl mx-auto">
                                <?php echo do_shortcode('[image_section position="right"]
                                    [image_section_image src="https://images.unsplash.com/photo-1762955911431-4c44c7c3f408?q=80&w=1121&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-[400px] object-cover"]
                                    [image_section_content title="Creativity and Expression " description=""]
                                    [image_section_feature icon="clock" title="Arts:"]Unleash your inner artist in our regular art classes with Maria Bowers. Whether you are a beginner or an experienced painter, these sessions provide a wonderful, therapeutic outlet for self-expression, allowing residents to create beautiful pieces in a relaxed, social environment. [/image_section_feature]
                                    [image_section_feature icon="lock" title="Crafts:"]From knitting and sewing to seasonal decoration making, our Craft Activities are perfect for those who enjoy working with their hands. These sessions not only produce lovely items but also promote fine motor skills and cognitive engagement.[/image_section_feature]
                                    [image_section_feature icon="database" title="Flower arranging:"] Working with natural materials, residents learn the beautiful skill of flower arranging, creating colourful displays that brighten up their own rooms and the common areas.[/image_section_feature]
                                    [/image_section_content]
                                    [/image_section]'); ?>

                                <?php echo do_shortcode('[image_section position="left"]
                                    [image_section_image src="https://images.unsplash.com/photo-1543333995-a78aea2eee50?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-[400px] object-cover"]
                                    [image_section_content title="Nature and the Outdoors" description=""]
                                    [image_section_feature icon="clock" title="Gardening club:"]Get your hands dirty and connect with nature! Our dedicated Gardener works alongside the residents in our Gardening Club, whether it is tending to flower beds, planting vegetables or simply enjoying the fresh air. This activity is incredibly rewarding and promotes physical movement. [/image_section_feature]
                                    [image_section_feature icon="lock" title="Outdoor trips (Groups & One-to-One)"] We organise regular trips, ensuring everyone has the opportunity to enjoy a change of scenery, whether it is a group outing to a local park or a private one-to-one visit to a favourite spot. [/image_section_feature]
                                    [image_section_feature icon="database" title="Animal visits:"] Nothing brings a smile quite like an animal! We regularly host therapeutic and entertaining visits from a variety of animals, including Llamas and Dogs, providing unique and heartwarming sensory experiences.[/image_section_feature]
                                    [/image_section_content]
                                    [/image_section]'); ?>

                                <?php echo do_shortcode('[image_section position="right"]
                                    [image_section_image src="https://images.unsplash.com/photo-1513159446162-54eb8bdaa79b?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"]
                                    [image_section_content title="Physical & Mental Wellness " description=""]
                                    [image_section_feature icon="clock" title="Keep fit:"] We offer a range of fitness sessions, from the gentle, accessible ‘Move it or Lose it’ class to sessions with Jordan, a professional fitness trainer. These activities focus on improving mobility, strength and balance in a fun, supportive setting. [/image_section_feature]
                                    [image_section_feature icon="lock" title="Bingo & board games"] Our bingo game is a fun twist on the traditional game, ensuring everyone can participate and enjoy the excitement. We also have regular sessions for quizzes, crosswords, cards & board games, perfect for keeping minds sharp and fostering friendly competition. [/image_section_feature]
                                    [image_section_feature icon="database" title="Book club:"] Dive into great stories and lively discussions with our book club, encouraging cognitive stimulation and social connection over shared literary interests.[/image_section_feature]
                                    [/image_section_content]
                                    [/image_section]'); ?>

                                <?php echo do_shortcode('[image_section position="left"]
                                    [image_section_image src="https://images.unsplash.com/photo-1762955911769-d652ceaa94bb?q=80&w=1121&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"]
                                    [image_section_content title="Social and entertainment" description=""]
                                    [image_section_feature icon="clock" title="Musical entertainment:"]We bring the fun to you with regular sessions featuring professional entertainers, offering music and performances that residents can sing along to, dance to or simply enjoy. [/image_section_feature]
                                    [image_section_feature icon="lock" title="Afternoon teas and themed parties:"] Life is a celebration! We host delightful afternoon teas and organise exciting themed parties throughout the year to mark holidays and special occasions, creating wonderful opportunities for socialising and making memories.[/image_section_feature]
                                    [image_section_feature icon="database" title="Theatre:"] We value cultural enrichment. While we may not have a full, resident-run theatre, we often enjoy live performances from visiting groups or incorporate theatre-based activities into our social calendar, providing an engaging and sophisticated entertainment experience. [/image_section_feature]
                                    [image_section_feature icon="database" title="Boules and outdoor games:"] During the warmer months, residents love getting out for boules and other outdoor games, promoting gentle exercise and camaraderie in the sunshine. [/image_section_feature]
                                    [/image_section_content]
                                    [/image_section]'); ?>
                            </div>
                        </div>
                    </section>
                    <!-- Closing Statement -->
                     <section class="py-16 md:py-20 bg-[#014854] relative">
                        <!-- Background Image -->
                        <div class="absolute inset-0">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/amenities-bg-2.png'; ?>"
                                alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="container mx-auto px-6 text-center flex flex-col items-center">
                            <h1 class="text-3xl md:text-4xl mb-6 text-white leading-tight">
                                Experience the Vibrant, Engaging Lifestyle
                            </h1>
                            <p class="paragraph text-white/70 mb-6 w-[700px]">
                                We invite you to experience the vibrant, engaging lifestyle at The Old Vicarage for
                                    yourself. Our commitment is simple: to provide activities that genuinely entertain,
                                    inspire, and keep our residents actively engaged every single day.
                            </p>
                            <div class="relative rgba(1, 106, 124, 1) z-10 w-[150px] sm:w-[165px]">
                                <a href="<?php echo home_url('/contact-us/?form=visit'); ?>" class="btn btn-primary bt-1 bg-white text-[#2C5F6F] hover:bg-white hover:text-[#2C5F6F] hover:svg:hover">
                                Book a Visit
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                    <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="#2C5F6F"/>
                                </svg>
                                </a>
                        </div>
                        </div>
                    </section>
                </div>
















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
<style>
    :root {
        --color-teal-primary: #014854;
        --color-cream-secondary: #E8E2C3;
        --color-body-background: #FAF8F4;
        --color-teal-light: #016370;
        --color-beige-soft: #F5F1E8;
    }

    .activity-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .activity-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(1, 72, 84, 0.15);
    }
</style>
<?php get_footer(); ?>