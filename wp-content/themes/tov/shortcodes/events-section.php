<?php
/**
 * Events Section Shortcode
 * [events_section limit="6" category="" show_past="false"]
 */

if (!defined('ABSPATH')) exit;

function tov_events_section_shortcode($atts) {
	// Function to format event date range (if not already defined)
	if (!function_exists('tov_format_event_range')) {
		function tov_format_event_range($start, $end) {
			$s = $start ? strtotime($start) : null;
			$e = $end ? strtotime($end) : null;
			if ($s && $e) {
				if (date('Y-m', $s) === date('Y-m', $e)) {
					return date_i18n('M j', $s) . ' - ' . date_i18n('j, Y', $e);
				} elseif (date('Y', $s) === date('Y', $e)) {
					return date_i18n('M j', $s) . ' - ' . date_i18n('M j, Y', $e);
				}
				return date_i18n('M j, Y', $s) . ' - ' . date_i18n('M j, Y', $e);
			}
			if ($s) return date_i18n('M j, Y', $s);
			return '';
		}
	}
	
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
				<a href="<?php echo esc_url(home_url('/event/')); ?>" class="btn btn-primary btn-resources">
					<?php echo esc_html__('See All Events', 'tov'); ?>
					<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                        <path d="M12.6014 18.39L18.7246 12.4443C19.0204 12.2076 19.1683 11.8823 19.1683 11.4681C19.1683 11.054 19.0204 10.7286 18.7246 10.492L12.6014 4.54629C12.3648 4.25048 12.0542 4.10258 11.6697 4.10258C11.2851 4.10258 10.9597 4.23569 10.6935 4.50192C10.4273 4.76814 10.2942 5.10832 10.2942 5.52245C10.2942 5.93657 10.4421 6.26196 10.7379 6.4986L14.3763 10.0483H4.88093C4.52596 10.0483 4.21537 10.1814 3.94914 10.4476C3.68292 10.7138 3.5498 11.054 3.5498 11.4681C3.5498 11.8823 3.68292 12.2224 3.94914 12.4887C4.21537 12.7549 4.52596 12.888 4.88093 12.888H14.3763L10.7379 16.4377C10.4421 16.6743 10.2942 16.9997 10.2942 17.4138C10.2942 17.8279 10.4273 18.1681 10.6935 18.4343C10.9597 18.7006 11.2851 18.8337 11.6697 18.8337C12.0542 18.8337 12.3648 18.6858 12.6014 18.39Z" fill="white"/>
                    </svg>
				</a>
			</div>

			<?php if ($events_query->have_posts()) : ?>
				<div class="mt-12 grid gap-[40px] lg:gap-[90px] md:gap-[40px] md:grid-cols-2">
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
						
						// Format date using the same function as templates
						$date_display = tov_format_event_range($event_date, $event_end_date);
						$time_display = '';
						
						if ($event_time) {
							$time_display = date_i18n('g:i a', strtotime($event_time));
						}
						?>
						<article class="group flex flex-col overflow-hidden rounded-2xl bg-white cursor-pointer" style="height: 498px;" onclick="window.location.href='<?php the_permalink(); ?>'">
							<div class="relative w-full" >
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('large', array('class' => 'h-[280px] lg:h-[338px] sm:h-[280px] object-cover rounded-[8px] w-[555px]')); ?>
								<?php else : ?>
									<div class="flex h-[280px] lg:h-[338px] sm:h-[280px] w-full items-center justify-center bg-gray-100 text-gray-400">
										<?php echo esc_html__('No image available', 'tov'); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="flex flex-1 flex-col pb-6 pt-5 ">
								<h3 class="mb-3 line-clamp-2 group-hover:text-[#016A7C] transition-colors duration-300">
									<?php the_title(); ?>
								</h3>
								
								<?php if ($date_display || $time_display || $event_location) : ?>
									<p class="text-[rgba(28,35,33,0.9)] font-lato text-base font-normal leading-[24px] tracking-[0.459px] mb-6">
										<?php if ($date_display) : ?>
											<span class="uppercase"><?php echo esc_html($date_display); ?></span>
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
									<a href="<?php the_permalink(); ?>" class="btn-readmore group" onclick="event.stopPropagation();">
                        			Learn more
                        			<svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" class="pt-1" viewBox="0 0 21 21" fill="none">
										<path d="M11.5246 10.4999L7.19336 6.16861L8.43148 4.93136L14 10.4999L8.43149 16.0684L7.19424 14.8311L11.5246 10.4999Z" fill="rgba(0, 0, 0, 0.8)"/>
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
					<article class="group bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 dark:bg-gray-800">
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
							<h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-[#016A7C] dark:group-hover:text-[#016A7C] transition-colors duration-300">
								<a href="<?php the_permalink(); ?>" class="transition-colors duration-300">
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
					<article class="group flex flex-col sm:flex-row gap-6 bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 dark:bg-gray-800">
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
							<h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 group-hover:text-[#016A7C] dark:group-hover:text-[#016A7C] transition-colors duration-300">
								<a href="<?php the_permalink(); ?>" class="transition-colors duration-300">
									<?php the_title(); ?>
								</a>
							</h3>
							<?php if ($event_location) : ?>
								<p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
									<?php echo esc_html($event_location); ?>
								</p>
							<?php endif; ?>
							<a href="<?php the_permalink(); ?>" class="inline-flex font-lato items-center text-gray-800 font-medium hover:text-[#016A7C] transition-colors duration-300 group cursor-pointer border-none bg-transparent p-0">
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
