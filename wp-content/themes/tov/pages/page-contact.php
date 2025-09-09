<?php
/**
 * Template Name: Contact Page Template
 * 
 * Custom template for Contact pages with contact information and forms.
 */

get_header(); ?>

<main class="contact-page-content">
    <?php while (have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('contact-page'); ?>>
            
            <!-- Hero Section -->
            <section class="page-hero bg-navy-800 py-16">
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
            
            <!-- Contact Content -->
            <section class="contact-content py-16">
                <div class="container-custom">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        
                        <!-- Contact Information -->
                        <div class="contact-info">
                            <h2 class="text-2xl font-bold mb-6">Get in Touch</h2>
                            
                            <?php the_content(); ?>
                            
                            <!-- You can add custom contact fields here -->
                            <div class="contact-details space-y-4 mt-8">
                                <?php 
                                $phone = get_post_meta(get_the_ID(), 'contact_phone', true);
                                $email = get_post_meta(get_the_ID(), 'contact_email', true);
                                $address = get_post_meta(get_the_ID(), 'contact_address', true);
                                ?>
                                
                                <?php if ($phone) : ?>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                        </svg>
                                        <span><?php echo esc_html($phone); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($email) : ?>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 mr-3 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg>
                                        <a href="mailto:<?php echo esc_attr($email); ?>" class="text-primary-600 hover:text-primary-700">
                                            <?php echo esc_html($email); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($address) : ?>
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 mr-3 mt-1 text-primary-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span><?php echo esc_html($address); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Contact Form Area -->
                        <div class="contact-form-area">
                            <h2 class="text-2xl font-bold mb-6">Send us a Message</h2>
                            
                            <!-- You can replace this with your preferred contact form plugin -->
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <p class="text-gray-600 mb-4">Contact form integration area.</p>
                                <p class="text-sm text-gray-500">
                                    Add your contact form shortcode here, or integrate with plugins like:
                                    <br>• Contact Form 7
                                    <br>• WPForms
                                    <br>• Gravity Forms
                                </p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </section>
            
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
