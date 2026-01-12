<?php
/**
 * Template Name: Service ResidentialPage
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
            <div class="prose prose-lg max-w-none dark:prose-invert">
                <div class="min-h-screen bg-[#FAF8F4]">
                    <!-- Intro / Overview Section -->
                    <section class="py-20 bg-white">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                <div class="rounded-2xl overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1764173039610-aecaafe54ef4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzZW5pb3JzJTIwY29tbXVuaXR5JTIwaW50ZXJhY3Rpb258ZW58MXx8fHwxNzY4MTEzMzU0fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Residents interacting" class="w-full h-[400px] object-cover m-0" />
                                </div>
                                <div>
                                    <h2 class="text-4xl mb-6 text-[#014854] mt-0 ">
                                        Starting a New Chapter
                                    </h2>
                                    <p class="text-lg text-gray-700 mb-4 leading-relaxed font-sans">
                                        Starting a new chapter in a residential care home can bring mixed emotions and we
                                        want to assure you that at The Old Vicarage, we are dedicated to making your
                                        transition as smooth and comfortable as possible.
                                    </p>
                                    <p class="text-lg text-gray-700 mb-8 leading-relaxed font-sans">
                                        Our home, set in the beautiful village of Otterton, is truly a residence belonging
                                        to its community – our residents. We are simply the team here to ensure you live
                                        life to the fullest, supported by holistic care in a warm, family atmosphere.
                                    </p>
                                    <button
                                        class="px-8 py-4 btn-primary rounded-lg uppercase tracking-wider font-sans font-medium">
                                        Book a Visit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- What is Residential Care Section -->
                    <section class="py-20 bg-[#FAF8F4]">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <h2 class="text-4xl mb-4 text-[#014854] mt-0 ">
                                    What is Residential Care at The Old Vicarage?
                                </h2>
                                <div class="w-24 h-1 bg-[#014854] mb-8"></div>

                                <div class="space-y-6 font-sans">
                                    <p class="text-lg text-gray-700 leading-relaxed">

                                        Residential care here means enjoying a vibrant community living experience with
                                        dedicated, heartfelt support available 24 hours a day, 7 days a week. It is a place
                                        where you are at the steering wheel of your life. Our core belief is that our
                                        residents are our extended family. We watch over the home and provide care in a way
                                        we would wish for one of our own. Our proactive team strives to get to know your
                                        passions, helping you continue cherished hobbies or discover new ones, ensuring
                                        every moment matters and every day is yours to enjoy.
                                    </p>

                                    <p class="text-lg text-gray-700 leading-relaxed">
                                        Residential care at The Old Vicarage provides a supportive living environment
                                        for individuals who need assistance with daily activities but do not require
                                        nursing care. Our approach focuses on maintaining independence while offering
                                        the right level of support to ensure comfort, safety, and wellbeing.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- High-quality Care Process -->
                    <section class="py-20 bg-white">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <h2 class="text-4xl mb-16 text-[#014854] text-center mt-0 ">
                                High-quality care tailored to your needs
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
                                <!-- Step 1 -->
                                <div class="text-center">
                                    <div
                                        class="w-20 h-20 bg-[#EAE5D3] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-clipboard-check text-4xl text-[#014854]"></i>
                                    </div>
                                    <h3 class="text-2xl mb-4 text-[#014854] font-bold ">
                                        Pre-assessment
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans">
                                        We begin with a thorough assessment to understand your individual needs,
                                        preferences, and lifestyle, ensuring we can provide the most appropriate care.
                                    </p>
                                </div>

                                <!-- Step 2 -->
                                <div class="text-center">
                                    <div
                                        class="w-20 h-20 bg-[#EAE5D3] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-user-check text-4xl text-[#014854]"></i>
                                    </div>
                                    <h3 class="text-2xl mb-4 text-[#014854] font-bold ">
                                        Personalised Plan
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans">
                                        Based on the assessment, we create a tailored care plan that evolves with you,
                                        ensuring continuity and consistency in your care journey.
                                    </p>
                                </div>

                                <!-- Step 3 -->
                                <div class="text-center">
                                    <div
                                        class="w-20 h-20 bg-[#EAE5D3] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-heart text-4xl text-[#014854]"></i>
                                    </div>
                                    <h3 class="text-2xl mb-4 text-[#014854] font-bold ">
                                        Arrival & Comfort
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans">
                                        We support you during the transition, helping you settle in and feel at home
                                        from day one, with ongoing care that prioritizes your comfort and wellbeing.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Personalised Care Details -->
                    <section class="py-20 bg-[#F5F1E8]" style="background-color: #F5F1E8;">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <h2 class="text-4xl mb-12 text-[#014854] mt-0 ">
                                Personalised and Tailored Care Includes
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                                <div class="flex items-start gap-6 bg-white p-6 rounded-xl">
                                    <i class="fas fa-activity text-3xl text-[#014854] flex-shrink-0 mt-1"></i>
                                    <div>
                                        <h3 class="text-xl mb-2 text-[#014854] font-bold mt-0">
                                            Continuous Review
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans m-0">
                                            Care plans are regularly reviewed and updated as needed.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-6 bg-white p-6 rounded-xl">
                                    <i class="fas fa-stethoscope text-3xl text-[#014854] flex-shrink-0 mt-1"></i>
                                    <div>
                                        <h3 class="text-xl mb-2 text-[#014854] font-bold mt-0">
                                            Professional Access
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans m-0">
                                            We facilitate contact with external professionals like GPs, District Nurses and
                                            Therapists.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-6 bg-white p-6 rounded-xl">
                                    <i class="fas fa-hands-helping text-3xl text-[#014854] flex-shrink-0 mt-1"></i>
                                    <div>
                                        <h3 class="text-xl mb-2 text-[#014854] font-bold mt-0">
                                            Enabling Support
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans m-0">
                                            We offer “enabling time” during the week for one-to-one quality support –
                                            whether it is organizing your room, strolling in the garden, or playing a board
                                            game.
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-6 bg-white p-6 rounded-xl">
                                    <i class="fas fa-users text-3xl text-[#014854] flex-shrink-0 mt-1"></i>
                                    <div>
                                        <h3 class="text-xl mb-2 text-[#014854] font-bold mt-0">
                                            Medical Registration & Transport
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans m-0">
                                            We register you with a GP from Budleigh Medical Centre if needed and organise
                                            transport to all medical appointments (hospital, dentist, etc.).
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-6 bg-white p-6 rounded-xl">
                                    <i class="fas fa-moon text-3xl text-[#014854] flex-shrink-0 mt-1"></i>
                                    <div>
                                        <h3 class="text-xl mb-2 text-[#014854] font-bold mt-0">
                                            Night Checks
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans m-0">
                                            You can choose hourly night checks or enjoy your nights completely undisturbed –
                                            the choice is always yours.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Expertise Section -->
                    <section class="py-20 bg-white">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <h2 class="text-4xl mb-4 text-[#014854] text-center mt-0 ">
                                What We Specialise In
                            </h2>
                            <p class="text-center text-gray-600 mb-12 font-sans">
                                Our team has specialist expertise in supporting residents with specific needs
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto mb-8">
                                <div class="bg-[#FAF8F4] p-8 rounded-2xl text-center border-2 border-[#E8E2C3]">
                                    <div
                                        class="w-16 h-16 bg-[#014854] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-brain text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-3 text-[#014854]  ">
                                        Mild to Moderate Dementia Care
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans">
                                        Specialized support in a safe, familiar environment with activities designed to
                                        maintain cognitive function.
                                    </p>
                                </div>

                                <div class="bg-[#FAF8F4] p-8 rounded-2xl text-center border-2 border-[#E8E2C3]">
                                    <div
                                        class="w-16 h-16 bg-[#014854] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-heartbeat text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-3 text-[#014854]  ">
                                        Parkinson's Support
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans">
                                        Expert care for residents with Parkinson's, focusing on maintaining mobility and
                                        quality of life.
                                    </p>
                                </div>

                                <div class="bg-[#FAF8F4] p-8 rounded-2xl text-center border-2 border-[#E8E2C3]">
                                    <div
                                        class="w-16 h-16 bg-[#014854] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-heart text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-3 text-[#014854]  ">
                                        End of Life Care
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans">
                                        Compassionate, dignified end-of-life care, ensuring comfort and support for
                                        residents and families.
                                    </p>
                                </div>
                            </div>

                            <p class="text-center text-sm text-gray-600 italic font-sans">
                                Please note: We do not support advanced dementia care
                            </p>
                        </div>
                    </section>

                    <!-- Comfort & Cuisine Section -->
                    <section class="py-20 bg-[#FAF8F4]">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                                <div>
                                    <h2 class="text-4xl mb-6 text-[#014854] mt-0 ">
                                        Comfortable Living & Home-cooked Cuisine
                                    </h2>
                                    <h3 class="text-2xl mb-4 text-[#014854]  ">
                                        Your Home, Your Way
                                    </h3>
                                    <p class="text-lg text-gray-700 mb-4 leading-relaxed font-sans">
                                        Enjoy warm, homely accommodation with private ensuite rooms, modern amenities and
                                        inviting shared spaces including lounges, dining areas, activity rooms and beautiful
                                        gardens. Housekeeping and laundry are fully taken care of, so you can relax and feel
                                        at home.
                                    </p>
                                    <p class="text-lg text-gray-700 mb-6 leading-relaxed font-sans">
                                        Our team prepares delicious, traditional meals using homegrown and locally sourced
                                        ingredients. With flexible mealtimes, plenty of choice and the option to dine in
                                        your room, the dining room or outdoors in summer, every meal is made to suit you.
                                    </p>
                                </div>

                                <div class="rounded-2xl overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1758977405163-f2595de08dfe?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGVnYW50JTIwZGluaW5nJTIwcm9vbXxlbnwxfHx8fDE3NjgwNTEzMjB8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Dining experience" class="w-full h-[500px] object-cover m-0" />
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Lifestyle & Wellbeing -->
                    <section class="py-20 bg-[#E8E2C3]" style="background-color: #E8E2C3;">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <h2 class="text-4xl mb-4 text-[#014854] text-center mt-0 ">
                                Lifestyle & Wellbeing
                            </h2>
                            <p class="text-center text-gray-700 text-lg mb-12 max-w-3xl mx-auto font-sans">
                                We believe in nurturing mind, body, and spirit through a rich program of activities
                                designed to bring joy, purpose, and connection to every day.
                            </p>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                <div class="bg-white rounded overflow-hidden shadow-md">
                                    <img src="https://images.unsplash.com/photo-1584661156681-540e80a161d3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzZW5pb3JzJTIwYXJ0JTIwcGFpbnRpbmd8ZW58MXx8fHwxNzY4MTEzMzU1fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Art activities" class="w-full h-48 object-cover m-0" />
                                    <div class="p-6">
                                        <div class="w-12 h-12 bg-[#E8E2C3] rounded-full flex items-center justify-center mb-4"
                                            style="background-color: #E8E2C3;">
                                            <i class="fas fa-palette text-2xl text-[#014854]"></i>
                                        </div>
                                        <h3 class="text-xl mb-2 text-[#014854] mt-0 font-bold  ">
                                            Art & Creativity
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans">
                                            Express yourself through painting, crafts, and creative workshops.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-white rounded overflow-hidden shadow-md">
                                    <img src="https://images.unsplash.com/photo-1739111165604-368400feb1d1?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwZ2FyZGVuaW5nJTIwaGFwcHl8ZW58MXx8fHwxNzY4MTEzMzU1fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Gardening activities" class="w-full h-48 object-cover m-0" />
                                    <div class="p-6">
                                        <div class="w-12 h-12 bg-[#E8E2C3] rounded-full flex items-center justify-center mb-4"
                                            style="background-color: #E8E2C3;">
                                            <i class="fas fa-seedling text-2xl text-[#014854]"></i>
                                        </div>
                                        <h3 class="text-xl mb-2 text-[#014854] mt-0 font-bold  ">
                                            Gardening
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans">
                                            Enjoy our beautiful gardens and participate in horticultural activities.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-white rounded overflow-hidden shadow-md">
                                    <img src="https://images.unsplash.com/photo-1696522732406-065ef560da8c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzZW5pb3JzJTIwbXVzaWMlMjB0aGVyYXB5fGVufDF8fHx8MTc2ODExMzM1Nnww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Music activities" class="w-full h-48 object-cover m-0" />
                                    <div class="p-6">
                                        <div class="w-12 h-12 bg-[#E8E2C3] rounded-full flex items-center justify-center mb-4"
                                            style="background-color: #E8E2C3;">
                                            <i class="fas fa-music text-2xl text-[#014854]"></i>
                                        </div>
                                        <h3 class="text-xl mb-2 text-[#014854] mt-0 font-bold  ">
                                            Music & Entertainment
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans">
                                            Live performances, music therapy, and sing-alongs bring joy and connection.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-white rounded overflow-hidden shadow-md">
                                    <img src="https://images.unsplash.com/photo-1766808983916-ee1d9461ef2b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwd2Fsa2luZyUyMG91dGRvb3JzfGVufDF8fHx8MTc2ODExMzM1Nnww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Outings" class="w-full h-48 object-cover m-0" />
                                    <div class="p-6">
                                        <div class="w-12 h-12 bg-[#E8E2C3] rounded-full flex items-center justify-center mb-4"
                                            style="background-color: #E8E2C3;">
                                            <i class="fas fa-map-marker-alt text-2xl text-[#014854]"></i>
                                        </div>
                                        <h3 class="text-xl mb-2 text-[#014854] mt-0 font-bold  ">
                                            Outings & Trips
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-sans">
                                            Regular excursions to local attractions, gardens, and community events.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Additional Services Section -->
                    <section class="py-20 bg-white">
                        <div class="container max-w-[1280px] mx-auto px-6">
                            <h2 class="text-4xl mb-12 text-[#014854] text-center  ">
                                Additional Services Available
                            </h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                                <div class="bg-[#FAF8F4] p-8 rounded-2xl border border-[#E8E2C3]">
                                    <div class="w-16 h-16 bg-[#014854] rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-shopping-bag text-2xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-3 text-[#014854] font-bold mt-0 ">
                                        The Old Vicarage Shop
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans mb-0">
                                        In-house shopping every Wednesday for toiletries, sweets and small items.
                                    </p>
                                </div>

                                <div class="bg-[#FAF8F4] p-8 rounded-2xl border border-[#E8E2C3]">
                                    <div class="w-16 h-16 bg-[#014854] rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-briefcase text-2xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-3 text-[#014854] font-bold mt-0 ">
                                        Professional Services
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans mb-0">
                                        Visiting Chiropodist (£35 per visit), Hairdresser (weekly), and
                                        Manicurist/Pedicurist (fortnightly).
                                    </p>
                                </div>

                                <div class="bg-[#FAF8F4] p-8 rounded-2xl border border-[#E8E2C3]">
                                    <div class="w-16 h-16 bg-[#014854] rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-newspaper text-2xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-3 text-[#014854] font-bold mt-0 ">
                                        Newspaper & Magazine Delivery
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans mb-0">
                                        Ordered through the Otterton Community Shop and charged to your account monthly.
                                        (Link to community page)

                                    </p>
                                </div>

                                <div class="bg-[#FAF8F4] p-8 rounded-2xl border border-[#E8E2C3]">
                                    <div class="w-16 h-16 bg-[#014854] rounded-full flex items-center justify-center mb-6">
                                        <i class="fas fa-hands-helping text-2xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-3 text-[#014854] font-bold mt-0 ">
                                        Private Enabling
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-sans mb-0">
                                        Hire one of our Enablers to accompany you shopping or on local trips (£15 per hour).

                                    </p>
                                </div>
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

<?php get_footer(); ?>