<?php
/**
 * Events Section Shortcode
 * [events_section limit="6" category="" show_past="false"]
 */

if (!defined('ABSPATH')) exit;

function tov_events_section_shortcode($atts) {
	$atts = shortcode_atts(array(
		'limit' => 2,
		'category' => '',
		'show_past' => 'false'
	), $atts);
	
	// Convert show_past to boolean
	$show_past = filter_var($atts['show_past'], FILTER_VALIDATE_BOOLEAN);
	
	// Force limit to 2 items (latest added events)
	$limit = 2;

	// Fetch latest published events (by post date, not event date)
	// This shows the 2 most recently added events
	$args = array(
		'post_type' => 'event',
		'posts_per_page' => $limit,
		'orderby' => 'date', // Order by post publish date (when event was added)
		'order' => 'DESC', // Most recent first
		'post_status' => 'publish', // Only published events
	);

	// Add category filter if specified
	if (!empty($atts['category'])) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'event_category',
				'field' => 'slug',
				'terms' => $atts['category']
			)
		);
	}

	// For showing latest added events, we don't filter by event date
	// This ensures we always show the 2 most recently added events
	// regardless of whether they're past or upcoming

	$events_query = new WP_Query($args);
	
	// Ensure we get exactly 2 events - if query returns less, it means there aren't enough published events
	
	ob_start();
	?>
	<section class="py-24 sm:py-[80px]" style="background-color: #E2F5F8;">
		<div class="max-w-[1280px] mx-auto px-4 sm:px-6 relative z-10">
			<div class="flex flex-wrap items-center gap-6 justify-between w-full">
				<div class="flex-1 min-w-[220px]">
					<h2 class="text-[#000] leading-[1.2] letter-spacing-[-0.5px]">
						<?php echo esc_html__('Upcoming events', 'tov'); ?>
					</h2>
					
				</div>
				<a href="<?php echo esc_url(home_url('/event/')); ?>" class="bt-r">
					<?php echo esc_html__('See all events', 'tov'); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" class="ml-2.5 p-[2px]" fill="none">
						<path d="M11.5375 16.8374L17.1437 11.3937C17.4146 11.177 17.55 10.8791 17.55 10.4999C17.55 10.1207 17.4146 9.82282 17.1437 9.60615L11.5375 4.1624C11.3208 3.89157 11.0365 3.75615 10.6844 3.75615C10.3323 3.75615 10.0344 3.87803 9.79062 4.12178C9.54688 4.36553 9.425 4.67699 9.425 5.05615C9.425 5.43532 9.56042 5.73324 9.83125 5.9499L13.1625 9.1999H4.46875C4.14375 9.1999 3.85938 9.32178 3.61562 9.56553C3.37187 9.80928 3.25 10.1207 3.25 10.4999C3.25 10.8791 3.37187 11.1905 3.61562 11.4343C3.85938 11.678 4.14375 11.7999 4.46875 11.7999H13.1625L9.83125 15.0499C9.56042 15.2666 9.425 15.5645 9.425 15.9437C9.425 16.3228 9.54688 16.6343 9.79062 16.878C10.0344 17.1218 10.3323 17.2437 10.6844 17.2437C11.0365 17.2437 11.3208 17.1082 11.5375 16.8374Z" fill="#016A7C"/>
					</svg>
				</a>
			</div>

			<?php if ($events_query->have_posts()) : ?>
				<div class="mt-12 grid gap-[90px] md:grid-cols-2">
					<?php while ($events_query->have_posts()) : $events_query->the_post(); 
						// Get event details from ACF fields
						$event_date = '';
						$event_end_date = '';
						$event_time = '';
						$event_location = '';
						
						if (function_exists('get_field')) {
							$event_date = get_field('event_start_date', get_the_ID());
							$event_end_date = get_field('event_end_date', get_the_ID());
							$event_time = get_field('event_time', get_the_ID());
							$event_location = get_field('event_location', get_the_ID());
						}
						
						// Fallback to WordPress meta fields if ACF fields are empty
						if (empty($event_date)) {
							$event_date = get_post_meta(get_the_ID(), '_event_date', true);
						}
						if (empty($event_end_date)) {
							$event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
						}
						if (empty($event_time)) {
							$event_time = get_post_meta(get_the_ID(), '_event_time', true);
						}
						if (empty($event_location)) {
							$event_location = get_post_meta(get_the_ID(), '_event_location', true);
						}
						
						// Format date/time string
						$start_ts = $event_date ? strtotime($event_date) : null;
						$time_display = '';
						$date_display = '';

						if ($start_ts) {
							$date_display = date_i18n('l jS F Y', $start_ts);
						}

						if ($event_time) {
							$time_display = date_i18n('g:i a', strtotime($event_time));
						}
						?>
						<article class="flex flex-col overflow-hidden rounded-2xl bg-white cursor-pointer" style="height: 498px;" onclick="window.location.href='<?php the_permalink(); ?>'">
							<div class="relative w-full" >
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('large', array('class' => 'h-[338px] object-cover rounded-[8px] w-[555px]')); ?>
								<?php else : ?>
									<div class="flex h-[338px] w-full items-center justify-center bg-gray-100 text-gray-400">
										<?php echo esc_html__('No image available', 'tov'); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="flex flex-1 flex-col pb-6 pt-5 ">
								<h3 class="mb-3 line-clamp-2">
									<?php the_title(); ?>
								</h3>
								
								<?php if ($date_display || $time_display || $event_location) : ?>
									<p class="text-[rgba(28,35,33,0.9)] font-lato text-base font-normal leading-[24px] tracking-[0.459px] mb-6">
										<?php if ($date_display) : ?>
											<?php echo esc_html($date_display); ?>
										<?php endif; ?>
										<?php if ($time_display) : ?>
											<?php if ($date_display) : ?><span class="mx-1 text-gray-400">|</span><?php endif; ?>
											<?php echo esc_html($time_display); ?>
										<?php endif; ?>
										<?php if ($event_location) : ?>
											<?php if ($date_display || $time_display) : ?><span class="mx-1 text-gray-400">|</span><?php endif; ?>
											<?php echo esc_html($event_location); ?>
										<?php endif; ?>
									</p>
								<?php endif; ?>

								<div class="mt-auto">
									<!-- <a href="<?php the_permalink(); ?>"
									   class="inline-flex items-center text-sm font-semibold text-[#227D8C] hover:text-[#014854]">
										<?php esc_html_e('Read more', 'tov'); ?>
										<span aria-hidden="true" class="ml-1">→</span>
									</a> -->
									<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-[#227D8C] font-bold text-sm hover:text-[#016A7C] transition-colors relative z-10" onclick="event.stopPropagation();">
                        			Learn more
                        			<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" class="pt-1" viewBox="0 0 21 21" fill="none">
										<path d="M11.5246 10.4999L7.19336 6.16861L8.43148 4.93136L14 10.4999L8.43149 16.0684L7.19424 14.8311L11.5246 10.4999Z" fill="#016A7C"/>
									</svg>
									</a>
								</div>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

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


/**
 * Upcoming Events Shortcode
 * [upcoming_events limit="6" category=""]
 */
function tov_upcoming_events_shortcode($atts) {
	$atts = shortcode_atts(array(
		'limit' => 6,
		'category' => ''
	), $atts);
	
	// Query args for upcoming events only
	$args = array(
		'post_type' => 'event',
		'posts_per_page' => $atts['limit'],
		'meta_key' => 'event_start_date',
		'orderby' => 'meta_value',
		'order' => 'ASC',
		'meta_query' => array(
			'relation' => 'OR',
			array(
				'key' => 'event_start_date',
				'value' => date('Y-m-d'),
				'compare' => '>=',
				'type' => 'DATE'
			),
			array(
				'key' => 'event_end_date',
				'value' => date('Y-m-d'),
				'compare' => '>=',
				'type' => 'DATE'
			)
		)
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

	$events_query = new WP_Query($args);
	
	ob_start();
	?>
	<section class="upcoming-events-section bg-white py-24 sm:py-32 dark:bg-gray-900">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			<div class="mx-auto max-w-2xl text-center">
				<h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">
					<?php echo esc_html__('Upcoming Events', 'tov'); ?>
				</h2>
				<p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-400">
					<?php echo esc_html__('Join us at our upcoming events and be part of our community.', 'tov'); ?>
				</p>
			</div>
			<div class="mx-auto mt-16 grid max-w-7xl grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
		<?php if ($events_query->have_posts()) : ?>
				<?php while ($events_query->have_posts()) : $events_query->the_post(); 
					// Get event details from ACF fields
					$event_date = '';
					$event_end_date = '';
					$event_time = '';
					$event_location = '';
					
					if (function_exists('get_field')) {
						$event_date = get_field('event_start_date', get_the_ID());
						$event_end_date = get_field('event_end_date', get_the_ID());
						$event_time = get_field('event_time', get_the_ID());
						$event_location = get_field('event_location', get_the_ID());
					}
					
					// Fallback to WordPress meta fields if ACF fields are empty
					if (empty($event_date)) {
						$event_date = get_post_meta(get_the_ID(), '_event_date', true);
					}
					if (empty($event_end_date)) {
						$event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
					}
					if (empty($event_time)) {
						$event_time = get_post_meta(get_the_ID(), '_event_time', true);
					}
					if (empty($event_location)) {
						$event_location = get_post_meta(get_the_ID(), '_event_location', true);
					}
					
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
					
					// Get event categories for label
					$event_categories = get_the_terms(get_the_ID(), 'event_category');
					$category_label = 'EVENT';
					if ($event_categories && !is_wp_error($event_categories) && !empty($event_categories)) {
						$category_label = strtoupper($event_categories[0]->name);
					}
					?>
					<article class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 dark:bg-gray-800">
						<?php if (has_post_thumbnail()) : ?>
							<div class="relative w-full h-48 overflow-hidden">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover rounded-[8px]')); ?>
								</a>
								<div class="absolute top-3 left-3">
									<span class="inline-flex items-center rounded bg-[#E2A76F] text-white px-2 py-1 text-xs font-semibold">
										<?php echo esc_html($category_label); ?>
									</span>
								</div>
							</div>
						<?php endif; ?>
						<div class="p-6">
							<h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
								<a href="<?php the_permalink(); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
									<?php the_title(); ?>
								</a>
							</h3>
							<?php if ($date_display) : ?>
								<p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
									<?php echo esc_html($date_display); ?>
								</p>
							<?php endif; ?>
							<?php if ($event_location) : ?>
								<p class="text-sm text-gray-600 dark:text-gray-400">
									<?php echo esc_html($event_location); ?>
								</p>
							<?php endif; ?>
						</div>
					</article>
				<?php endwhile; ?>
		<?php else : ?>
			<div class="text-center text-gray-600 dark:text-gray-400 py-8">
				<p><?php esc_html_e('No upcoming events scheduled.', 'tov'); ?></p>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode('upcoming_events', 'tov_upcoming_events_shortcode');

/**
 * Past Events Shortcode
 * [past_events limit="6" category=""]
 */
function tov_past_events_shortcode($atts) {
	$atts = shortcode_atts(array(
		'limit' => 6,
		'category' => ''
	), $atts);
	
	// Query args for past events only
	$args = array(
		'post_type' => 'event',
		'posts_per_page' => $atts['limit'],
		'meta_key' => 'event_start_date',
		'orderby' => 'meta_value',
		'order' => 'DESC',
		'meta_query' => array(
			array(
				'key' => 'event_start_date',
				'value' => date('Y-m-d'),
				'compare' => '<',
				'type' => 'DATE'
			)
		)
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

	$events_query = new WP_Query($args);
	
	ob_start();
	?>
	<section class="past-events-section bg-white py-24 sm:py-32 dark:bg-gray-900">
		<div class="mx-auto max-w-7xl px-6 lg:px-8">
			<div class="mx-auto max-w-2xl text-center">
				<h2 class="text-balance text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl dark:text-white">
					<?php echo esc_html__('Past Events', 'tov'); ?>
				</h2>
				<p class="mt-2 text-lg/8 text-gray-600 dark:text-gray-400">
					<?php echo esc_html__('Take a look at our previous events and what we accomplished together.', 'tov'); ?>
				</p>
			</div>
			<div class="mx-auto mt-16 space-y-6 max-w-4xl">
		<?php if ($events_query->have_posts()) : ?>
				<?php while ($events_query->have_posts()) : $events_query->the_post(); 
					// Get event details from ACF fields
					$event_date = '';
					$event_end_date = '';
					$event_time = '';
					$event_location = '';
					
					if (function_exists('get_field')) {
						$event_date = get_field('event_start_date', get_the_ID());
						$event_end_date = get_field('event_end_date', get_the_ID());
						$event_time = get_field('event_time', get_the_ID());
						$event_location = get_field('event_location', get_the_ID());
					}
					
					// Fallback to WordPress meta fields if ACF fields are empty
					if (empty($event_date)) {
						$event_date = get_post_meta(get_the_ID(), '_event_date', true);
					}
					if (empty($event_end_date)) {
						$event_end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
					}
					if (empty($event_time)) {
						$event_time = get_post_meta(get_the_ID(), '_event_time', true);
					}
					if (empty($event_location)) {
						$event_location = get_post_meta(get_the_ID(), '_event_location', true);
					}
					
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
					?>
					<article class="flex flex-col sm:flex-row gap-6 bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 dark:bg-gray-800">
						<?php if (has_post_thumbnail()) : ?>
							<div class="flex-shrink-0 w-full sm:w-64 h-48 sm:h-auto">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover rounded-[8px]')); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="flex-1 p-6 flex flex-col justify-center">
							<div class="text-sm text-gray-600 dark:text-gray-400 mb-2">
								<?php if ($date_display) : ?>
									<span><?php echo esc_html(strtoupper($date_display)); ?></span>
								<?php endif; ?>
							</div>
							<h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
								<a href="<?php the_permalink(); ?>" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
									<?php the_title(); ?>
								</a>
							</h3>
							<?php if ($event_location) : ?>
								<p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
									<?php echo esc_html($event_location); ?>
								</p>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-sm font-semibold text-[#000] hover:text-[#000] dark:text-[#000] dark:hover:text-[#000] transition-colors">
								<?php esc_html_e('Read more', 'tov'); ?>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
								</svg>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
		<?php else : ?>
			<div class="text-center text-gray-600 dark:text-gray-400 py-8">
				<p><?php esc_html_e('No past events found.', 'tov'); ?></p>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode('past_events', 'tov_past_events_shortcode');
