<?php
/**
 * Template Name: Team Page
 * 
 * This template displays team members in a responsive layout
 */

get_header(); ?>

<div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-pretty font-jakarta text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl dark:text-white">Our team</h2>
            <p class="mt-6 text-lg/8 font-lato text-gray-600 dark:text-gray-400">We're a dynamic group of individuals who are passionate about what we do and dedicated to delivering the best results for our clients.</p>
        </div>
        
        <div class="flex flex-col gap-10 py-12 first:pt-0 last:pb-0 sm:flex-row">
            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt="" class="aspect-[4/5] w-[350px] flex-none rounded-2xl object-cover outline outline-1 -outline-offset-1 outline-black/5" />
            
            <div class="max-w-xl flex-auto">
                <p class="paragraph">Sinto is our Director & CQC Nominated Individual who is responsible for the quality of service and business operations. He has 20+ years of experience in various capacities such as Consultant and Business owner in various areas such as Local Councils, Adult Social Care, Banking and Charity. Sinto has been actively involved in the home care and care home area for the last 8 years. Sinto has worked with various local community groups such as Director, Weymouth Carnival and several other charity groups. He has developed various community engagement programmes such as Community Bingos, Coffee morning, etc.</p>
                <p class="my-6 text-base/7 font-lato italic text-gray-600">"At our care home, we provide compassionate, safe, personalized support so every resident feels valued, respected, and genuinely cared for."</p>

                <h3>Sinto Antony</h3>
                <p class="text-base/7 text-gray-600 font-lato">Director</p>
                
                <ul role="list" class="mt-6 flex gap-x-6">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">X</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-5">
                                <path d="M11.4678 8.77491L17.2961 2H15.915L10.8543 7.88256L6.81232 2H2.15039L8.26263 10.8955L2.15039 18H3.53159L8.87581 11.7878L13.1444 18H17.8063L11.4675 8.77491H11.4678ZM9.57608 10.9738L8.95678 10.0881L4.02925 3.03974H6.15068L10.1273 8.72795L10.7466 9.61374L15.9156 17.0075H13.7942L9.57608 10.9742V10.9738Z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">LinkedIn</span>
                            <svg viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" class="size-5">
                                <path d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="highlighted-news-separator"></div>
        
        <?php
        // Query team members
        $team_query = new WP_Query(array(
            'post_type' => 'team',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'menu_order',
            'order' => 'ASC',
        ));
        
        if ($team_query->have_posts()) :
                ?>
                <ul role="list" class="mx-auto mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-14 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3 xl:grid-cols-4">
                    <?php
                    while ($team_query->have_posts()) : $team_query->the_post();
                        // Get ACF fields
                        $name = '';
                        $designation = '';
                        $image = '';
                        $show_on_homepage = false;
                        
                        if (function_exists('get_field')) {
                            $name = get_field('name', get_the_ID());
                            $designation = get_field('designation', get_the_ID());
                            $image = get_field('image', get_the_ID());
                            $show_on_homepage = get_field('show_on_homepage', get_the_ID());
                        }
                        
                        // Use post title as fallback for name
                        if (empty($name)) {
                            $name = get_the_title();
                        }
                        ?>
                        <li>
                            <?php 
                            // Use ACF image if available, otherwise fallback to featured image
                            if (!empty($image) && is_array($image)) {
                                $image_url = $image['sizes']['large'] ?? $image['url'];
                                $image_alt = $image['alt'] ?? $name;
                                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="aspect-[14/13] w-full rounded-2xl object-cover outline outline-1 -outline-offset-1 outline-black/5 dark:outline-white/10" />';
                            } elseif (has_post_thumbnail()) {
                                echo get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'aspect-[14/13] w-full rounded-2xl object-cover outline outline-1 -outline-offset-1 outline-black/5 dark:outline-white/10'));
                            } else {
                                ?>
                                <div class="aspect-[14/13] w-full rounded-2xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center outline outline-1 -outline-offset-1 outline-black/5 dark:outline-white/10">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <?php
                            }
                            ?>
                            <h3 class="mt-6 font-jakarta text-lg/8 font-semibold tracking-tight text-gray-900 dark:text-white">
                                <?php echo esc_html($name); ?>
                            </h3>
                            <p class="text-base/7 font-lato text-gray-600 dark:text-gray-300">
                                <?php echo esc_html($designation); ?>
                            </p>
                        </li>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
                <?php
        else :
            ?>
            <div class="mt-20 text-center">
                <p class="text-gray-500">No team members found.</p>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
