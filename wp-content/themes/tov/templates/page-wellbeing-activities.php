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
                    <p class="mt-6 text-lg/8 font-lato text-gray-600 dark:text-gray-400">At The Old Vicarage, we provide
                        compassionate residential care in a warm, welcoming environment where every resident is valued and
                        supported to live life to the fullest.</p>
                </div>
            </header>

            <!-- Page Content -->
            <div class="prose prose-lg max-w-none dark:prose-invert">
                <div class="min-h-screen bg-[#FAF8F4]">

                    <!-- Hero Section -->
                    <section class="py-20 bg-gradient-to-br from-[#014854] to-[#016370]">
                        <div class="container mx-auto px-6 text-center">
                            <h1 class="text-5xl md:text-6xl mb-6 text-white font-serif leading-tight">
                                Inspired Living: Discovering Joy and Engagement
                            </h1>
                            <p class="text-xl md:text-2xl text-[#E8E2C3] max-w-4xl mx-auto leading-relaxed font-sans">
                                At The Old Vicarage, our award-winning care home we believe that a fulfilling life is built
                                on engagement, connection and pursuing personal passions.
                            </p>
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
                                <p class="text-2xl text-[#014854] leading-relaxed font-serif text-center mt-10">
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
                                        <h2 class="text-4xl mb-6 text-[#014854] font-serif">
                                            Mornings: One-to-One Sessions
                                        </h2>
                                        <p class="text-lg text-gray-700 leading-relaxed font-sans mb-6">
                                            We know that sometimes the most meaningful moments happen in smaller settings.
                                            That is why our mornings often include dedicated one-to-one sessions. A member
                                            of our team spends quality time with each resident, offering companionship and
                                            support in ways that differ from person to person.
                                        </p>
                                        <p class="text-lg text-gray-700 leading-relaxed font-sans mb-6">
                                            These sessions are designed to nurture wellbeing, build trust, and ensure every
                                            resident feels valued. They are incredibly flexible and entirely focused on the
                                            resident's needs and preferences, which can vary widely from person to person.
                                        </p>
                                    </div>
                                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                                        <h3 class="text-2xl mb-6 text-[#014854] font-serif">What this looks like:</h3>
                                        <ul class="space-y-4">
                                            <li class="flex items-start gap-3">
                                                <i class="fas fa-coffee text-[#014854] text-xl mt-1"></i>
                                                <span class="text-gray-700 font-sans">Enjoying a quiet chat over a cup of
                                                    tea.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <i class="fas fa-chess text-[#014854] text-xl mt-1"></i>
                                                <span class="text-gray-700 font-sans">Playing a favourite card game or
                                                    solving a crossword puzzle.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <i class="fas fa-images text-[#014854] text-xl mt-1"></i>
                                                <span class="text-gray-700 font-sans">Assisting with personal projects, such
                                                    as organising photos or tidying a wardrobe to create a comforting,
                                                    familiar space.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <i class="fas fa-walking text-[#014854] text-xl mt-1"></i>
                                                <span class="text-gray-700 font-sans">Going for a short, private
                                                    walk.</span>
                                            </li>
                                            <li class="flex items-start gap-3">
                                                <i class="fas fa-heart text-[#014854] text-xl mt-1"></i>
                                                <span class="text-gray-700 font-sans">Simply providing companionship and a
                                                    listening ear.</span>
                                            </li>
                                        </ul>
                                        <p class="text-lg text-gray-700 leading-relaxed font-sans mt-6 italic">
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
                    <section class="py-16 bg-[#014854]">
                        <div class="container mx-auto px-6 text-center">
                            <h2 class="text-5xl mb-6 text-white font-serif">
                                Lifestyle Activities: A World of Choice
                            </h2>
                            <p class="text-xl text-[#E8E2C3] max-w-4xl mx-auto leading-relaxed font-sans">
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
                                <h2 class="text-4xl mb-12 text-[#014854] font-serif text-center">
                                    Creativity and Expression
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <!-- Arts -->
                                    <div class="activity-card bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1720175646441-cea633d88dc9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwcGVvcGxlJTIwYXJ0JTIwY2xhc3N8ZW58MXx8fHwxNzY4MTMxNjIzfDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                alt="Art classes" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-palette text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Arts</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                Unleash your inner artist in our regular art classes with Maria Bowers.
                                                Whether you are a beginner or an experienced painter, these sessions provide
                                                a wonderful, therapeutic outlet for self-expression, allowing residents to
                                                create beautiful pieces in a relaxed, social environment.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Crafts -->
                                    <div class="activity-card bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 bg-[#E8E2C3] flex items-center justify-center">
                                            <i class="fas fa-cut text-7xl text-[#014854]"></i>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-scissors text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Crafts</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                From knitting and sewing to seasonal decoration making, our Craft Activities
                                                are perfect for those who enjoy working with their hands. These sessions not
                                                only produce lovely items but also promote fine motor skills and cognitive
                                                engagement.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Flower Arranging -->
                                    <div class="activity-card bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 bg-[#E8E2C3] flex items-center justify-center">
                                            <i class="fas fa-spa text-7xl text-[#014854]"></i>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-leaf text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Flower Arranging</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                Working with natural materials, residents learn the beautiful skill of
                                                flower arranging, creating colourful displays that brighten up their own
                                                rooms and the common areas.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Nature and the Outdoors -->
                    <section class="py-20 bg-[#F5F1E8]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-6xl mx-auto">
                                <h2 class="text-4xl mb-12 text-[#014854] font-serif text-center">
                                    Nature and the Outdoors
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <!-- Gardening Club -->
                                    <div class="activity-card bg-white rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1734303023491-db8037a21f09?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzZW5pb3JzJTIwZ2FyZGVuaW5nJTIwYWN0aXZpdHl8ZW58MXx8fHwxNzY4MTMxNjIzfDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                alt="Gardening club" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-seedling text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Gardening Club</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                Get your hands dirty and connect with nature! Our dedicated Gardener works
                                                alongside the residents in our Gardening Club, whether it is tending to
                                                flower beds, planting vegetables or simply enjoying the fresh air. This
                                                activity is incredibly rewarding and promotes physical movement.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Outdoor Trips -->
                                    <div class="activity-card bg-white rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 bg-[#E8E2C3] flex items-center justify-center">
                                            <i class="fas fa-bus text-7xl text-[#014854]"></i>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-map-marked-alt text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Outdoor Trips</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                We organise regular trips, ensuring everyone has the opportunity to enjoy a
                                                change of scenery, whether it is a group outing to a local park or a private
                                                one-to-one visit to a favourite spot.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Animal Visits -->
                                    <div class="activity-card bg-white rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1765896387454-3c29c0473615?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx0aGVyYXB5JTIwZG9nJTIwdmlzaXR8ZW58MXx8fHwxNzY4MTMxNjI1fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                alt="Animal visits" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-paw text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Animal Visits</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                Nothing brings a smile quite like an animal! We regularly host therapeutic
                                                and entertaining visits from a variety of animals, including Llamas and
                                                Dogs, providing unique and heartwarming sensory experiences.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Physical & Mental Wellness -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="max-w-6xl mx-auto">
                                <h2 class="text-4xl mb-12 text-[#014854] font-serif text-center">
                                    Physical & Mental Wellness
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                    <!-- Keep Fit -->
                                    <div class="activity-card bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1758612897695-be644d6febec?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwZml0bmVzcyUyMGV4ZXJjaXNlfGVufDF8fHx8MTc2ODEzMTYyM3ww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                alt="Keep fit classes" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-dumbbell text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Keep Fit</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                We offer a range of fitness sessions, from the gentle, accessible 'Move it
                                                or Lose it' class to sessions with Jordan, a professional fitness trainer.
                                                These activities focus on improving mobility, strength and balance in a fun,
                                                supportive setting.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Bingo & Board Games -->
                                    <div class="activity-card bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1758691031158-8d19bc43fcf8?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzZW5pb3JzJTIwcGxheWluZyUyMGJpbmdvfGVufDF8fHx8MTc2ODEzMTYyNHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                alt="Bingo and games" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-dice text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Bingo & Board Games</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                Our bingo game is a fun twist on the traditional game, ensuring everyone can
                                                participate and enjoy the excitement. We also have regular sessions for
                                                quizzes, crosswords, cards & board games, perfect for keeping minds sharp
                                                and fostering friendly competition.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Book Club -->
                                    <div class="activity-card bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-48 bg-[#E8E2C3] flex items-center justify-center">
                                            <i class="fas fa-book-open text-7xl text-[#014854]"></i>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-book text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Book Club</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                Dive into great stories and lively discussions with our book club,
                                                encouraging cognitive stimulation and social connection over shared literary
                                                interests.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Social and Entertainment -->
                    <section class="py-20 bg-[#F5F1E8]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-6xl mx-auto">
                                <h2 class="text-4xl mb-12 text-[#014854] font-serif text-center">
                                    Social and Entertainment
                                </h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                                    <!-- Musical Entertainment -->
                                    <div class="activity-card bg-white rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-56 overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1761299146027-e7a37d99bbd3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwbXVzaWMlMjBlbnRlcnRhaW5tZW50fGVufDF8fHx8MTc2ODEzMTYyNHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                                alt="Musical entertainment" class="w-full h-full object-cover" />
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-music text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Musical Entertainment</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                We bring the fun to you with regular sessions featuring professional
                                                entertainers, offering music and performances that residents can sing along
                                                to, dance to or simply enjoy.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Afternoon Teas and Themed Parties -->
                                    <div class="activity-card bg-white rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-56 bg-[#E8E2C3] flex items-center justify-center">
                                            <i class="fas fa-birthday-cake text-8xl text-[#014854]"></i>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-glass-cheers text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Afternoon Teas & Themed
                                                    Parties</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                Life is a celebration! We host delightful afternoon teas and organise
                                                exciting themed parties throughout the year to mark holidays and special
                                                occasions, creating wonderful opportunities for socialising and making
                                                memories.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <!-- Theatre -->
                                    <div class="activity-card bg-white rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-56 bg-[#E8E2C3] flex items-center justify-center">
                                            <i class="fas fa-masks-theater text-8xl text-[#014854]"></i>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-theater-masks text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Theatre</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                We value cultural enrichment. While we may not have a full, resident-run
                                                theatre, we often enjoy live performances from visiting groups or
                                                incorporate theatre-based activities into our social calendar, providing an
                                                engaging and sophisticated entertainment experience.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Boules and Outdoor Games -->
                                    <div class="activity-card bg-white rounded-2xl overflow-hidden shadow-lg">
                                        <div class="h-56 bg-[#E8E2C3] flex items-center justify-center">
                                            <i class="fas fa-futbol text-8xl text-[#014854]"></i>
                                        </div>
                                        <div class="p-6">
                                            <div class="flex items-center gap-3 mb-4">
                                                <div
                                                    class="w-12 h-12 bg-[#014854] rounded-full flex items-center justify-center">
                                                    <i class="fas fa-sun text-white text-xl"></i>
                                                </div>
                                                <h3 class="text-2xl text-[#014854] font-serif">Boules & Outdoor Games</h3>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed font-sans">
                                                During the warmer months, residents love getting out for boules and other
                                                outdoor games, promoting gentle exercise and camaraderie in the sunshine.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Closing Statement -->
                    <section class="py-20 bg-gradient-to-br from-[#014854] to-[#016370]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto text-center">
                                <h2 class="text-4xl mb-8 text-white font-serif">
                                    Experience the Vibrant, Engaging Lifestyle
                                </h2>
                                <p class="text-2xl text-[#E8E2C3] leading-relaxed font-sans mb-10">
                                    We invite you to experience the vibrant, engaging lifestyle at The Old Vicarage for
                                    yourself. Our commitment is simple: to provide activities that genuinely entertain,
                                    inspire, and keep our residents actively engaged every single day.
                                </p>
                                <button
                                    class="px-10 py-5 btn-primary rounded-lg uppercase tracking-wider text-lg font-sans font-medium">
                                    Visit Us & Join the Fun
                                </button>
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