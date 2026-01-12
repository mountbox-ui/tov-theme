<?php
/**
 * Template Name: Rooms & Facilities
 * Template for displaying individual service pages
 */

get_header(); ?>

<?php while (have_posts()):
    the_post(); ?>
    <div class="bg-white pt-24 sm:pt-32 dark:bg-gray-900">
        <div class="">
            <!-- Page Title -->
            <header class="container max-w-[1280px] mx-auto px-6">
                <div class="max-w-[800px]">
                    <h6 class="text-[#016A7C]">Rooms & Facilities</h6>
                    <h2 class="text-left">
                        Discover the Comforts of <span>The Old Vicarage</span>
                    </h2>
                    <p class="mt-6 text-lg/8 font-lato text-[#757575] dark:text-gray-400">At The Old Vicarage, we believe
                        that assisted living should be a time for new
                        experiences, relaxation and connection; and that is why we have carefully designed our
                        home to be more than just a place to live – it is a vibrant destination where every day
                        offers something engaging and enjoyable.</p>
                </div>
            </header>

            <!-- Page Content -->
            <div class=" max-w-none dark:prose-invert">
                <div class="min-h-screen bg-[#FAF8F4]">

                    <!-- Intro Section -->
                    <section class=" bg-white">
                        <div class="container max-w-[1280px] mx-auto px-6">


                            <div class="grid grid-cols-1 gap-6 max-w-5xl mx-auto py-12">
                                <div class="rounded-2xl overflow-hidden shadow-lg h-96">
                                    <img src="https://images.unsplash.com/photo-1764795932247-d2ce2014fc0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxiZWF1dGlmdWwlMjBidWlsZGluZyUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTl8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="The Old Vicarage exterior" class="w-full h-full m-0 object-cover" />
                                </div>

                            </div>
                        </div>
                    </section>

                    <!-- Resident Comfort & Support -->
                    <section class="py-20 bg-[#FAF8F4]">
                        <div class="container mx-auto px-6">
                            <div class="max-w-4xl mx-auto">
                                <h2 class="text-4xl mb-4 text-center">
                                    Resident Comfort & Support
                                </h2>
                                

                                <p class="text-lg text-[#757575] leading-relaxed font-lato mb-12 text-center">
                                    We are dedicated to providing a comfortable and supportive environment for all
                                    residents, with a focus on privacy and convenience. Ensuring a refreshing and dignified
                                    start to the day is a priority, with specialized equipment and accessible facilities.
                                </p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="flex items-start gap-4 bg-white p-6 rounded-xl">
                                        <i class="fas fa-door-open text-3xl text-[#016A7C] bg-[#E6EEEF] p-2 rounded-[8px] flex-shrink-0 mt-1"></i>
                                        <div>
                                            <h3 class="text-xl mb-2 text-[#09090B]  ">
                                                Private Rooms
                                            </h3>
                                            <p class="text-[#757575] leading-relaxed font-lato">
                                                Our private en-suite rooms are thoughtfully designed with resident comfort
                                                and sensory needs in mind.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4 bg-white p-6 rounded-xl">
                                        <i class="fas fa-wifi text-3xl text-[#016A7C] bg-[#E6EEEF] p-2 rounded-[8px] flex-shrink-0 mt-1"></i>
                                        <div>
                                            <h3 class="text-xl mb-2 text-[#09090B]  ">
                                                Modern Amenities
                                            </h3>
                                            <p class="text-[#757575] leading-relaxed font-lato">
                                                Each room is equipped with a modern call bell system, Wi-Fi, TV, and a
                                                direct telephone line for convenience and connectivity.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4 bg-white p-6 rounded-xl">
                                        <i class="fas fa-bath text-3xl text-[#016A7C] bg-[#E6EEEF] p-2 rounded-[8px] flex-shrink-0 mt-1"></i>
                                        <div>
                                            <h3 class="text-xl mb-2 text-[#09090B]  ">
                                                En-suite Bathrooms
                                            </h3>
                                            <p class="text-[#757575] leading-relaxed font-lato">
                                                Selected rooms feature easily accessible walk-in showers.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4 bg-white p-6 rounded-xl">
                                        <i class="fas fa-hot-tub text-3xl text-[#016A7C] bg-[#E6EEEF] p-2 rounded-[8px] flex-shrink-0 mt-1"></i>
                                        <div>
                                            <h3 class="text-xl mb-2 text-[#09090B]  ">
                                                Specialised Bathing
                                            </h3>
                                            <p class="text-[#757575] leading-relaxed font-lato">
                                                Residents have access to assisted hi-lo baths and spacious wet room showers
                                                designed for maximum safety and ease of use.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-start gap-4 bg-white p-6 rounded-xl md:col-span-2">
                                        <i class="fas fa-mountain text-3xl text-[#016A7C] bg-[#E6EEEF] p-2 rounded-[8px] flex-shrink-0 mt-1"></i>
                                        <div>
                                            <h3 class="text-xl mb-2 text-[#09090B]  ">
                                                Scenic Location
                                            </h3>
                                            <p class="text-[#757575] leading-relaxed font-lato">
                                                Residents can enjoy beautiful country views directly from their rooms and
                                                all shared communal spaces, promoting calm and well-being.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Culinary Delights and Social Spaces -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="text-center mb-16">
                                <h2 class="text-4xl mb-4 text-center">
                                    Culinary Delights and Social Spaces
                                </h2>
                               
                                <p class="text-lg text-[#757575] leading-relaxed font-lato max-w-3xl mx-auto">
                                    We understand that food and good company are central to a happy life. Our amenities are
                                    designed to bring people together, whether for a quick catch-up or an elegant meal.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                                <div class="bg-[#FAF8F4] rounded-2xl overflow-hidden ">
                                    <div class="h-48 flex items-center justify-center">
                                        <img src="https://images.unsplash.com/photo-1764795932247-d2ce2014fc0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxiZWF1dGlmdWwlMjBidWlsZGluZyUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTl8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                            alt="The Old Vicarage exterior" class="w-full h-full m-0 object-cover" />
                                    </div>
                                    <div class="p-8">
                                        <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                            Dining Rooms
                                        </h3>
                                        <p class="text-[#757575] leading-relaxed font-lato">
                                            Experience elegant dining experiences daily. Our chefs prepare fresh, seasonal
                                            menus served in a beautiful setting, making every meal a special occasion.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-[#FAF8F4] rounded-2xl overflow-hidden ">
                                    <div class="h-48 flex items-center justify-center">
                                        <img src="https://images.unsplash.com/photo-1764795932247-d2ce2014fc0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxiZWF1dGlmdWwlMjBidWlsZGluZyUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTl8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                            alt="The Old Vicarage exterior" class="w-full h-full m-0 object-cover" />
                                    </div>
                                    <div class="p-8">
                                        <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                            Café on the Wheels
                                        </h3>
                                        <p class="text-[#757575] leading-relaxed font-lato">
                                            Our mobile Café serves premium coffee and delicious snacks, offering the perfect
                                            place to catch up or unwind with a good book. Throughout the mid-morning and
                                            afternoon, you can enjoy a selection of beverages – coffee, tea, yogurt drinks
                                            and more – paired with a variety of tasty snacks.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-[#FAF8F4] rounded-2xl overflow-hidden ">
                                    <div class="h-48 flex items-center justify-center">
                                        <img src="https://images.unsplash.com/photo-1764795932247-d2ce2014fc0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxiZWF1dGlmdWwlMjBidWlsZGluZyUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTl8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                            alt="The Old Vicarage exterior" class="w-full h-full m-0 object-cover" />
                                    </div>
                                    <div class="p-8">
                                        <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                            Lounges
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-lato">
                                            Step into our comfortable relaxation areas. These tastefully decorated lounges
                                            are the perfect spots for afternoon tea, card games or simply relaxing by the
                                            fireplace.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Wellness, Beauty and Relaxation -->
                    <section class="py-20 bg-[#F5F1E8]">
                        <div class="container mx-auto px-6">
                            <div class="text-center mb-16">
                                <h2 class="text-4xl mb-4 text-[#1C2321]  ">
                                    Wellness, Beauty and Relaxation
                                </h2>
                                <p class="text-lg text-[#757575] leading-relaxed font-lato max-w-3xl mx-auto">
                                    Taking care of mind, body and spirit is a priority. We offer private, dedicated spaces
                                    for personal wellness and pampering.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                                <div class="bg-white p-8 rounded-2xl border-2 border-[#E8E2C3] text-center">
                                    <div
                                        class="w-20 h-20 bg-[#016A7C] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-cut text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                        Hair Salon
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-lato">
                                        Our on-site professional styling services mean residents can look and feel their
                                        best without ever leaving the building.
                                    </p>
                                </div>

                                <div class="bg-white p-8 rounded-2xl border-2 border-[#E8E2C3] text-center">
                                    <div
                                        class="w-20 h-20 bg-[#016A7C] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-dumbbell text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                        Activity Room
                                    </h3>
                                    <p class="text-gray-700 leading-relaxed font-lato">
                                        A sanctuary for well-being. A welcoming space designed to support wellbeing and
                                        connection. This room hosts a range of wellness sessions and activities, including
                                        Move It or Lose It and Exercises in Care. It is a place where residents can stay
                                        active, build confidence and enjoy meaningful moments together.
                                    </p>
                                </div>

                                <div class="bg-white p-8 rounded-2xl border-2 border-[#E8E2C3] text-center">
                                    <div
                                        class="w-20 h-20 bg-[#016A7C] rounded-full flex items-center justify-center mx-auto mb-6">
                                        <i class="fas fa-spa text-3xl text-white"></i>
                                    </div>
                                    <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                        Dementia Lounge
                                    </h3>
                                    <p class="text-[#757575] leading-relaxed font-lato">
                                        A calming, dedicated space designed for people living with dementia, created to
                                        gently stimulate the senses and support comfort. The environment encourages
                                        relaxation, engagement, and moments of meaningful connection throughout the day.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Entertainment and Enrichment -->
                    <section class="py-20 bg-white">
                        <div class="container mx-auto px-6">
                            <div class="text-center mb-16">
                                <h2 class="text-4xl mb-4 text-[#1C2321]  ">
                                    Entertainment and Enrichment
                                </h2>
                                <p class="text-lg text-gray-700 leading-relaxed font-lato max-w-3xl mx-auto">
                                    Life here is never dull! We offer stimulating environments for learning, creativity and
                                    entertainment.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                                <div class="bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-md">
                                    <div class="h-48">
                                        <img src="https://images.unsplash.com/photo-1758977405163-f2595de08dfe?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGVnYW50JTIwZGluaW5nJTIwcm9vbXxlbnwxfHx8fDE3NjgwNTEzMjB8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                            alt="Cinema room" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-2xl mb-3 text-[#1C2321]  ">
                                            Cinema Room
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-lato">
                                            Grab the popcorn! Our private movie screenings let residents enjoy classic films
                                            and new releases in comfort and style.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-md">
                                    <div class="h-48">
                                        <img src="https://images.unsplash.com/photo-1764173039610-aecaafe54ef4?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzZW5pb3JzJTIwY29tbXVuaXR5JTIwaW50ZXJhY3Rpb258ZW58MXx8fHwxNzY4MTEzMzU0fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                            alt="Library" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-2xl mb-3 text-[#1C2321]  ">
                                            Library
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-lato">
                                            Find your next great read in our quiet reading sanctuary. It is a peaceful spot
                                            for reflection, study or browsing our collection.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-[#FAF8F4] rounded-2xl overflow-hidden shadow-md">
                                    <div class="h-48">
                                        <img src="https://images.unsplash.com/photo-1584661156681-540e80a161d3?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzZW5pb3JzJTIwYXJ0JTIwcGFpbnRpbmd8ZW58MXx8fHwxNzY4MTEzMzU1fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                            alt="Craft area" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-2xl mb-3 text-[#1C2321]  ">
                                            Craft Area
                                        </h3>
                                        <p class="text-gray-700 leading-relaxed font-lato">
                                            Let your imagination run wild! This creative workshop space is perfect for
                                            painting, knitting, model-making and all sorts of creative hobbies.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Outdoors -->
                    <section class="py-20">
                        <div class="container mx-auto px-6">
                            <div class="text-center mb-16">
                                <h2 class="text-4xl mb-4 text-[#1C2321]  ">
                                    Outdoors
                                </h2>
                                <p class="text-lg text-[#757575] leading-relaxed font-lato max-w-3xl mx-auto">
                                    We believe in the therapeutic power of nature and the unconditional love of pets.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                                <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1757829316659-5f2ffb007eac?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwb3V0ZG9vciUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTR8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Landscaped gardens" class="w-full h-64 object-cover" />
                                    <div class="p-8">
                                        <div class="w-16 h-16 bg-[#E8E2C3] rounded-full flex items-center justify-center mb-6"
                                            style="background: #E6EEEF;">
                                            <i class="fas fa-tree text-3xl text-[#016A7C]"></i>
                                        </div>
                                        <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                            Landscaped Gardens
                                        </h3>
                                        <p class="text-[#757575] leading-relaxed font-lato">
                                            Take a stroll through our beautiful outdoor spaces. Our landscaped Gardens
                                            provide serene walking paths, seating areas and vibrant seasonal displays to
                                            enjoy throughout the year.
                                        </p>
                                    </div>
                                </div>

                                <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                                    <img src="https://images.unsplash.com/photo-1739111165604-368400feb1d1?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxlbGRlcmx5JTIwZ2FyZGVuaW5nJTIwaGFwcHl8ZW58MXx8fHwxNzY4MTEzMzU1fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                                        alt="Gardening activities" class="w-full h-64 object-cover" />
                                    <div class="p-8">
                                        <div
                                            class="w-16 h-16 bg-[#E6EEEF] rounded-full flex items-center justify-center mb-6">
                                            <i class="fas fa-seedling text-3xl text-[#016A7C]"></i>
                                        </div>
                                        <h3 class="text-2xl mb-4 text-[#1C2321]  ">
                                            Gardening Activities & Potting Benches
                                        </h3>
                                        <p class="text-[#757575] leading-relaxed font-lato">
                                            A lovely opportunity for residents to enjoy hands-on gardening, from potting
                                            plants to growing vegetables and herbs. These sessions encourage creativity,
                                            connection with nature and a real sense of accomplishment.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Call to Action Section -->
                    <section class="py-24 bg-[#014854] relative overflow-hidden">
                        <!-- Background Image -->
                        <img src="https://images.unsplash.com/photo-1764795932247-d2ce2014fc0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxiZWF1dGlmdWwlMjBidWlsZGluZyUyMGdhcmRlbnxlbnwxfHx8fDE3NjgxMTMzNTl8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
                            alt="" class="absolute inset-0 w-full h-full object-cover opacity-30" />
                        <!-- Overlay for additional opacity control -->
                        <div class="absolute inset-0 bg-[#014854]/70"></div>
                        <!-- Content -->
                        <div class="container mx-auto px-6 text-center relative z-10">
                            <h2 class="text-5xl mb-6 text-white max-w-3xl mx-auto  ">
                                Ready to Experience the Difference?
                            </h2>
                            <p class="text-xl text-[#E8E2C3] mb-10 max-w-2xl mx-auto font-lato">
                                At The Old Vicarage, we have gone above and beyond to create a community where convenience,
                                comfort and joy intersect.
                            </p>
                            <div class="relative rgba(1, 106, 124, 1) z-10 w-[300px] sm:w-[230px] mx-auto">
                    <a href="<?php echo home_url('/rooms-facilities/'); ?>" class="btn btn-primary bt-1 bg-white text-[#2C5F6F] hover:bg-white hover:text-[#2C5F6F] hover:svg:hover">
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

<?php get_footer(); ?>