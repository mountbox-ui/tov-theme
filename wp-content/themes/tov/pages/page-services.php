<?php
/**
 * Template Name: Services Page Template
 * 
 * Custom template for Services pages with service listings and features.
 */

get_header(); ?>

<main class="services-page-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('services-page'); ?>>
            
            <!-- Hero Section -->
            <section class="page-hero bg-navy-800 py-16 lg:py-24">
                <div class="container-custom text-center">
                    <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">
                        <?php the_title(); ?>
                    </h1>
                    
                    <?php if (has_excerpt()) : ?>
                        <p class="text-xl text-navy-200 max-w-3xl mx-auto">
                            <?php the_excerpt(); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </section>
            
            <!-- Services Content -->
            <section class="services-content py-16">
                <div class="container-custom">
                    
                    <!-- Main Content -->
                    <div class="max-w-4xl mx-auto mb-16">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Services Grid (can be populated with custom fields or shortcodes) -->
                    <div class="services-grid">
                        <h2 class="text-3xl font-bold text-center mb-12">Our Services</h2>
                        
                        <!-- Example service items - replace with your content -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            
                            <?php 
                            // You can add custom fields for services or use shortcodes
                            $services = get_post_meta(get_the_ID(), 'services_list', true);
                            if ($services) :
                                // If custom services are defined, display them
                                foreach ($services as $service) :
                            ?>
                                <div class="service-item bg-white p-6 rounded-lg shadow-lg">
                                    <?php if (!empty($service['icon'])) : ?>
                                        <div class="service-icon mb-4">
                                            <img src="<?php echo esc_url($service['icon']); ?>" alt="<?php echo esc_attr($service['title']); ?>" class="w-12 h-12">
                                        </div>
                                    <?php endif; ?>
                                    
                                    <h3 class="text-xl font-bold mb-3"><?php echo esc_html($service['title']); ?></h3>
                                    <p class="text-gray-600"><?php echo esc_html($service['description']); ?></p>
                                </div>
                            <?php 
                                endforeach;
                            else : 
                                // Default placeholder services
                            ?>
                                <div class="service-item bg-white p-6 rounded-lg shadow-lg">
                                    <div class="service-icon mb-4 text-primary-600">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 01-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-2.293 2.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l2.293-2.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 010-2h1.586l-2.293-2.293a1 1 0 111.414-1.414L15 13.586V12a1 1 0 011-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3">Service One</h3>
                                    <p class="text-gray-600">Description of your first service offering.</p>
                                </div>
                                
                                <div class="service-item bg-white p-6 rounded-lg shadow-lg">
                                    <div class="service-icon mb-4 text-primary-600">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3">Service Two</h3>
                                    <p class="text-gray-600">Description of your second service offering.</p>
                                </div>
                                
                                <div class="service-item bg-white p-6 rounded-lg shadow-lg">
                                    <div class="service-icon mb-4 text-primary-600">
                                        <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-bold mb-3">Service Three</h3>
                                    <p class="text-gray-600">Description of your third service offering.</p>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
                </div>
            </section>
            
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
