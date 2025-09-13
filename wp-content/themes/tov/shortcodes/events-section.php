<?php
/**
 * Events Section Shortcode
 * [events_section limit="6" category="" show_past="false"]
 */

if (!defined('ABSPATH')) exit;

function tov_events_section_shortcode($atts) {
	$atts = shortcode_atts(array(
		'limit' => 6,
		'category' => '',
		'show_past' => 'false'
	), $atts);
	
	// Convert show_past to boolean
	$show_past = filter_var($atts['show_past'], FILTER_VALIDATE_BOOLEAN);

	// Query args
	$args = array(
		'post_type' => 'event',
		'posts_per_page' => $atts['limit'],
		'meta_key' => '_event_date',
		'orderby' => 'meta_value',
		'order' => 'ASC',
	);

	// Add category if specified
	if (!empty($atts['category'])) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'event_category',
				'field' => 'slug',
				'terms' => $atts['category']
			)
		);
	}

	// Filter past events if show_past is false
	if (!$show_past) {
		$args['meta_query'] = array(
			array(
				'key' => '_event_date',
				'value' => date('Y-m-d'),
				'compare' => '>=',
				'type' => 'DATE'
			)
		);
	}

	$events_query = new WP_Query($args);
	
	ob_start();
	?>
	<section class="bg-white py-24 sm:py-32 dark:bg-gray-900">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			<div class="mx-auto max-w-2xl text-center">
				<h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">
					<?php echo esc_html__('Upcoming Events', 'tov'); ?>
				</h2>
				<p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-400">
					<?php echo esc_html__('Join us at our upcoming events and be part of our community.', 'tov'); ?>
				</p>
			</div>

			<?php if ($events_query->have_posts()) : ?>
				<div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
					<?php while ($events_query->have_posts()) : $events_query->the_post(); 
						// Get event details
						$event_date = get_post_meta(get_the_ID(), '_event_date', true);
						$event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
						$event_time = get_post_meta(get_the_ID(), '_event_time', true);
						$event_location = get_post_meta(get_the_ID(), '_event_location', true);
						
						// Format date and time
						$start_ts = $event_date ? strtotime($event_date) : null;
						$end_ts = $event_end_date ? strtotime($event_end_date) : null;
						$time_formatted = $event_time ? date_i18n('g:i A', strtotime($event_time)) : '';
						
						$date_display = '';
						if ($start_ts && $end_ts) {
							if (date('Y-m', $start_ts) === date('Y-m', $end_ts)) {
								// Same month & year: Sep 12 - 13, 2025
								$date_display = date_i18n('M j', $start_ts) . ' - ' . date_i18n('j, Y', $end_ts);
							} elseif (date('Y', $start_ts) === date('Y', $end_ts)) {
								// Same year: Sep 30 - Oct 2, 2025
								$date_display = date_i18n('M j', $start_ts) . ' - ' . date_i18n('M j, Y', $end_ts);
							} else {
								// Different years
								$date_display = date_i18n('M j, Y', $start_ts) . ' - ' . date_i18n('M j, Y', $end_ts);
							}
						} elseif ($start_ts) {
							$date_display = date_i18n('M j, Y', $start_ts);
						}
						
						// Check if event is past
						$is_past_event = false;
						if ($event_date) {
							$event_timestamp = strtotime($event_date);
							$current_timestamp = current_time('timestamp');
							$is_past_event = $event_timestamp < $current_timestamp;
						}
						?>
						<article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80 dark:bg-gray-800">
							<?php
								// Get event categories
								$event_categories = get_the_terms(get_the_ID(), 'event_category');
							?>
							<?php if ($event_categories && !is_wp_error($event_categories)) : ?>
								<div class="absolute top-4 right-4 z-20 flex flex-wrap gap-2 justify-end">
									<?php foreach ($event_categories as $category) : ?>
										<span class="inline-flex items-center rounded-full bg-white/10 backdrop-blur-sm px-2 py-1 text-xs font-medium text-white ring-1 ring-inset ring-white/20">
											<?php echo esc_html($category->name); ?>
										</span>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

							<?php if (has_post_thumbnail()) : ?>
								<?php 
									$image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
								?>
								<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="absolute inset-0 -z-10 size-full object-cover" />
							<?php endif; ?>

							<div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40 dark:from-black/80 dark:via-black/40"></div>
							<div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10 dark:ring-white/10"></div>

							<div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm/6 text-gray-300">
								<time datetime="<?php echo esc_attr($event_date); ?>" class="mr-8">
									<?php echo esc_html($date_display); ?>
									<?php if ($time_formatted) : ?>
										<span class="ml-2"><?php echo esc_html($time_formatted); ?></span>
									<?php endif; ?>
								</time>
								<?php if ($event_location) : ?>
								<div class="-ml-4 flex items-center gap-x-4">
									<svg viewBox="0 0 2 2" class="-ml-0.5 size-0.5 flex-none fill-white/50 dark:fill-gray-300/50">
										<circle r="1" cx="1" cy="1" />
									</svg>
									<div class="flex gap-x-2.5">
										<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
											      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
											      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
										</svg>
										<?php echo esc_html($event_location); ?>
									</div>
								</div>
								<?php endif; ?>
							</div>

							<h3 class="mt-3 text-lg/6 font-semibold text-white">
								<a href="<?php the_permalink(); ?>">
									<span class="absolute inset-0"></span>
									<?php the_title(); ?>
								</a>
							</h3>
						</article>
					<?php endwhile; ?>
				</div>

				<?php if ($events_query->max_num_pages > 1) : ?>
					<div class="mt-10 flex items-center justify-center gap-x-6">
						<a href="<?php echo get_post_type_archive_link('event'); ?>" class="rounded-md bg-gray-900 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-100">
							<?php echo esc_html__('View All Events', 'tov'); ?>
						</a>
					</div>
				<?php endif; ?>

			<?php else : ?>
				<div class="text-center text-gray-600 dark:text-gray-400 py-12">
					<?php echo esc_html__('No upcoming events scheduled.', 'tov'); ?>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode('events_section', 'tov_events_section_shortcode');
