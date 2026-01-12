<?php
/**
 * Template Name: A Day at The Old Vicarage
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
                    <p class="mt-6 text-lg/8 font-lato text-gray-600 dark:text-gray-400">At The Old Vicarage, we provide
                        compassionate residential care in a warm, welcoming environment where every resident is valued and
                        supported to live life to the fullest.</p>
                </div>
            </header>

            <!-- Page Content -->
            <div class="max-w-none dark:prose-invert">
                <div class="min-h-screen bg-[#FAF8F4]">

                    <!-- Breadcrumb Section -->
                    <section class="py-8 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="flex items-center gap-2 font-sans">
                                <i class="fas fa-home w-4 h-4 text-[#014854]"></i>
                                <i class="fas fa-chevron-right w-4 h-4 text-gray-400 text-xs"></i>
                                <span class="text-sm text-gray-600">Life Here</span>
                                <i class="fas fa-chevron-right w-4 h-4 text-gray-400 text-xs"></i>
                                <span class="text-sm text-[#014854]">A Day at The Old Vicarage</span>
                            </div>
                        </div>
                    </section>

                    <!-- Hero Intro Section -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="max-w-5xl mx-auto text-center mb-12">
                                <h1 class="text-5xl mb-6 text-[#014854]    leading-tight">
                                    A Day at The Old Vicarage: Comfort, Care & Community
                                </h1>
                                <p class="text-xl text-gray-700 leading-relaxed font-sans max-w-4xl mx-auto">
                                    Nestled in the heart of Otterton village, East Devon, The Old Vicarage offers more than
                                    just a place to stay – it is a place to live fully, with dignity, joy and connection.
                                    From the moment you arrive, your private ensuite room becomes your sanctuary, filled
                                    with your own cherished belongings, ready to reflect your personality and story.
                                </p>
                            </div>

                            <div class="rounded-2xl overflow-hidden shadow-2xl max-w-5xl mx-auto">
                                <img src="https://images.unsplash.com/photo-1764795932247-d2ce2014fc0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxiZWF1dGlmdWwlMjBidWlsZGluZyUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTl8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                    alt="The Old Vicarage" class="w-full h-[400px] object-cover" />
                            </div>
                        </div>
                    </section>

                    <!-- Morning: Waking Up -->
                    <section class="py-20 bg-[#FAF8F4]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <div class="flex gap-8 items-start">
                                    <div class="flex-shrink-0">
                                        <div class="timeline-dot">
                                            <i class="fas fa-sun text-3xl"
                                                style="color: rgb(1 106 124 / var(--tw-bg-opacity, 1));"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex flex-col mb-4 gap-1">
                                            <h6 class="text-[#016A7C] pb-1">Morning</h6>
                                            <h2 class="text-2xl text-[#014854]  font-bold ">
                                                Waking Up in Comfort
                                            </h2>
                                            <span class="text-lg text-gray-500 font-sans">6:00am - 10:00am</span>
                                        </div>
                                        <div class="bg-white p-8 rounded-2xl">
                                            <p class="text-lg text-gray-700 leading-relaxed font-sans mb-4">
                                                Your day begins gently, just the way you like it. Whether you prefer an
                                                early morning drink at 6am or a leisurely breakfast served until 10am, our
                                                team is here to accommodate your rhythm.
                                            </p>
                                            <p class="text-lg text-gray-700 leading-relaxed font-sans">
                                                Enjoy a nutritious breakfast of your choice in your room, the dining room or
                                                even on the terrace during warmer months. With Wifi, TV and a direct
                                                telephone line, your room is both a retreat and a hub for staying connected.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Mid-Morning: Freshen Up -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <div class="flex gap-8 items-start">
                                    <div class="flex-shrink-0">
                                        <div class="timeline-dot">
                                            <i class="fas fa-shower text-3xl"
                                                style="color: rgb(1 106 124 / var(--tw-bg-opacity, 1));"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-4xl mb-4 text-[#014854]   ">
                                            Mid-Morning: Freshen Up & Feel Good
                                        </h2>
                                        <div class="bg-[#FAF8F4] p-8 rounded-2xl shadow-lg">
                                            <p class="text-lg text-gray-700 leading-relaxed font-sans">
                                                Our assisted hi-lo baths and spacious wet room shower ensure that everyone
                                                can enjoy a refreshing start to the day, regardless of mobility. Whether you
                                                prefer a quiet bath or an invigorating shower, our care team is always
                                                nearby to support you.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Late Morning: Activities -->
                    <section class="py-20 bg-[#FAF8F4]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <div class="flex gap-8 items-start">
                                    <div class="flex-shrink-0">
                                        <div class="timeline-dot">
                                            <i class="fas fa-users text-3xl text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-4">
                                            <h2 class="text-4xl text-[#014854]   ">
                                                Late Morning: Activities & Companionship
                                            </h2>
                                            <span class="text-lg text-gray-500 font-sans">10:30am</span>
                                        </div>
                                        <div class="bg-white p-8 rounded-2xl shadow-lg">
                                            <p class="text-lg text-gray-700 leading-relaxed font-sans mb-6">
                                                By 10:30am, it's time for a warm drink and biscuits, often shared in the
                                                charming main lounge. Residents gather for the wellbeing & lifestyle
                                                activities from morning chair yoga or move it or lose it to art classes,
                                                inclusive bingo, gardening club or simply to chat over magazines and music.
                                            </p>
                                            <p class="text-lg text-gray-700 leading-relaxed font-sans">
                                                The activities room upstairs hosts everything from fitness sessions with
                                                Jordan to animal visits and book club discussions.
                                            </p>

                                            <!-- Activity Icons -->
                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
                                                <div class="text-center">
                                                    <div
                                                        class="w-16 h-16 bg-[#E8E2C3] rounded-full flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-palette text-2xl text-[#014854]"></i>
                                                    </div>
                                                    <span class="text-sm text-gray-600 font-sans">Art Classes</span>
                                                </div>
                                                <div class="text-center">
                                                    <div
                                                        class="w-16 h-16 bg-[#E8E2C3] rounded-full flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-dumbbell text-2xl text-[#014854]"></i>
                                                    </div>
                                                    <span class="text-sm text-gray-600 font-sans">Chair Yoga</span>
                                                </div>
                                                <div class="text-center">
                                                    <div
                                                        class="w-16 h-16 bg-[#E8E2C3] rounded-full flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-seedling text-2xl text-[#014854]"></i>
                                                    </div>
                                                    <span class="text-sm text-gray-600 font-sans">Gardening</span>
                                                </div>
                                                <div class="text-center">
                                                    <div
                                                        class="w-16 h-16 bg-[#E8E2C3] rounded-full flex items-center justify-center mx-auto mb-2">
                                                        <i class="fas fa-book text-2xl text-[#014854]"></i>
                                                    </div>
                                                    <span class="text-sm text-gray-600 font-sans">Book Club</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Afternoon: Dining -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <div class="flex gap-8 items-start">
                                    <div class="flex-shrink-0">
                                        <div class="timeline-dot">
                                            <i class="fas fa-utensils text-3xl text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-4">
                                            <h2 class="text-4xl text-[#014854]   ">
                                                Afternoon: Dining & Delight
                                            </h2>
                                            <span class="text-lg text-gray-500 font-sans">12:00pm - 3:30pm</span>
                                        </div>
                                        <div class="bg-[#FAF8F4] p-8 rounded-2xl shadow-lg">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                                <div>
                                                    <img src="https://images.unsplash.com/photo-1758977405163-f2595de08dfe?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGVnYW50JTIwZGluaW5nJTIwcm9vbXxlbnwxfHx8fDE3NjgwNTEzMjB8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                        alt="Dining experience"
                                                        class="w-full h-64 object-cover rounded-xl" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <p class="text-lg text-gray-700 leading-relaxed font-sans mb-4">
                                                        Lunch is served between 12 and 12:30pm in the dining room using
                                                        home-grown produce, where themed meals and special occasions are
                                                        celebrated with wine and laughter.
                                                    </p>
                                                    <p class="text-lg text-gray-700 leading-relaxed font-sans">
                                                        Prefer privacy? Dine in your room or book the private dining room
                                                        for a family gathering.
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="bg-white p-6 rounded-xl">
                                                <p class="text-lg text-gray-700 leading-relaxed font-sans mb-4">
                                                    Homemade cakes arrive with afternoon tea at 3:30pm – always a highlight!
                                                    You can take part in the afternoon group activities depends on your
                                                    interest or just go for a gentle walk in the beautiful garden.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Early Evening: Tranquility -->
                    <section class="py-20 bg-[#F5F1E8]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <div class="flex gap-8 items-start">
                                    <div class="flex-shrink-0">
                                        <div class="timeline-dot">
                                            <i class="fas fa-cloud-sun text-3xl text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-4">
                                            <h2 class="text-4xl text-[#014854]   ">
                                                Early Evening: Tranquillity & Togetherness
                                            </h2>
                                            <span class="text-lg text-gray-500 font-sans">5:30pm onwards</span>
                                        </div>
                                        <div class="bg-white p-8 rounded-2xl shadow-lg">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <div>
                                                    <p class="text-lg text-gray-700 leading-relaxed font-sans mb-4">
                                                        After supper at 5:30pm, enjoy a stroll through our beautiful
                                                        gardens, soaking in views of the village and the scent of herbs from
                                                        our kitchen garden.
                                                    </p>
                                                    <p class="text-lg text-gray-700 leading-relaxed font-sans">
                                                        Others settle in for a film in the upstairs sitting room.
                                                    </p>
                                                </div>
                                                <div>
                                                    <img src="https://images.unsplash.com/photo-1757829316659-5f2ffb007eac?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwb3V0ZG9vciUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTR8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                        alt="Beautiful gardens"
                                                        class="w-full h-64 object-cover rounded-xl" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Night: Peaceful Rest -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <div class="flex gap-8 items-start">
                                    <div class="flex-shrink-0">
                                        <div class="timeline-dot">
                                            <i class="fas fa-moon text-3xl text-white"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h2 class="text-4xl mb-4 text-[#014854]   ">
                                            Night: Peaceful Rest & Gentle Care
                                        </h2>
                                        <div class="bg-[#FAF8F4] p-8 rounded-2xl shadow-lg">
                                            <p class="text-lg text-gray-700 leading-relaxed font-sans mb-4">
                                                As the day winds down, our care team remains available 24/7. Whether you
                                                prefer hourly night checks or uninterrupted sleep, your comfort is our
                                                priority.
                                            </p>
                                            <p class="text-lg text-gray-700 leading-relaxed font-sans">
                                                With a pendant and call bell system, help is always within reach. Depends on
                                                your interest – you can ask for hot chocolate and night nibbles.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Living Life Your Way -->
                    <section class="py-20 bg-[#E8E2C3]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-5xl mx-auto">
                                <h2 class="text-4xl mb-8 text-[#014854]    text-center">
                                    Living Life Your Way
                                </h2>

                                <div class="bg-white p-10 rounded-2xl shadow-lg mb-8">
                                    <p class="text-xl text-gray-700 leading-relaxed font-sans text-center mb-8">
                                        From enabling support for hobbies and strolls, to GP registration and free transport
                                        to medical appointments, we tailor every detail to meet your needs. Our housekeeping
                                        and laundry services keep things sparkling, while our catering team crafts meals
                                        with love and local produce.
                                    </p>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                                        <div class="text-center">
                                            <div
                                                class="w-20 h-20 bg-[#014854] rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-hands-helping text-3xl text-white"></i>
                                            </div>
                                            <h3 class="text-lg text-[#014854]    mb-2">Enabling Support</h3>
                                            <p class="text-gray-600 font-sans text-sm">Personalized assistance for hobbies
                                                and activities</p>
                                        </div>

                                        <div class="text-center">
                                            <div
                                                class="w-20 h-20 bg-[#014854] rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-ambulance text-3xl text-white"></i>
                                            </div>
                                            <h3 class="text-lg text-[#014854]    mb-2">Medical Support</h3>
                                            <p class="text-gray-600 font-sans text-sm">Free transport to appointments</p>
                                        </div>

                                        <div class="text-center">
                                            <div
                                                class="w-20 h-20 bg-[#014854] rounded-full flex items-center justify-center mx-auto mb-4">
                                                <i class="fas fa-broom text-3xl text-white"></i>
                                            </div>
                                            <h3 class="text-lg text-[#014854]    mb-2">Housekeeping</h3>
                                            <p class="text-gray-600 font-sans text-sm">Full laundry and cleaning services
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-[#014854] p-10 rounded-2xl shadow-lg text-center">
                                    <p class="text-2xl text-white leading-relaxed    mb-6">
                                        At The Old Vicarage, every day is designed to inspire joy, nurture wellbeing, and
                                        celebrate individuality.
                                    </p>
                                    <p class="text-xl text-[#E8E2C3] leading-relaxed font-sans">
                                        Whether you're enjoying a quiet moment in your room or laughing with friends in the
                                        lounge, you're part of a vibrant, caring community.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Call to Action Section -->
                    <section class="py-24 bg-[#014854]">
                        <div class="container mx-auto px-6 text-center">
                            <h2 class="text-5xl mb-6 text-white max-w-3xl mx-auto   ">
                                Experience a Day at The Old Vicarage
                            </h2>
                            <p class="text-xl text-[#E8E2C3] mb-10 max-w-2xl mx-auto font-sans">
                                Come and see for yourself what makes each day special. We'd love to welcome you for a visit
                                and show you around our beautiful home.
                            </p>
                            <button
                                class="px-10 py-5 btn-primary rounded-lg uppercase tracking-wider text-lg font-sans font-medium">
                                Book a Visit
                            </button>
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

    .timeline-dot {
        width: 80px;
        height: 80px;
        background: #E6F0F2;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .timeline-line {
        position: absolute;
        left: 30px;
        top: 60px;
        bottom: -60px;
        width: 2px;
        background: var(--color-cream-secondary);
    }
</style>
<?php get_footer(); ?>