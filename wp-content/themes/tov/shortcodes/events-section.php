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
	<section class="py-24 sm:py-32" style="background-color: #E8F6FF;">
		<div class="mx-auto max-w-6xl px-6 lg:px-8">
			<div class="flex flex-wrap items-center gap-6 justify-between w-full">
				<div class="flex-1 min-w-[220px]">
					<h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">
						<?php echo esc_html__('Upcoming events', 'tov'); ?>
					</h2>
					<p class="mt-2 text-base text-gray-600">
						<?php echo esc_html__('Join us at our upcoming events and be part of our community.', 'tov'); ?>
					</p>
				</div>
				<a href="<?php echo esc_url(home_url('/eventtest/')); ?>" class="inline-flex items-center justify-center rounded-full border border-gray-300 px-5 py-2 text-sm font-medium text-gray-900 hover:bg-white transition ml-auto">
					<?php echo esc_html__('See all events', 'tov'); ?>
					<svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="none" stroke="currentColor">
						<path d="M7 5l5 5-5 5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</a>
			</div>

			<?php if ($events_query->have_posts()) : ?>
				<div class="mt-12 grid gap-8 md:grid-cols-2">
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
						<article class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 mx-auto" style="max-width: 600px; width: 100%;">
							<div class="relative w-full" style="height: 300px;">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('large', array('class' => 'h-full w-full object-cover')); ?>
								<?php else : ?>
									<div class="flex h-full w-full items-center justify-center bg-gray-100 text-gray-400">
										<?php echo esc_html__('No image available', 'tov'); ?>
									</div>
								<?php endif; ?>
							</div>
							<div class="flex flex-1 flex-col pb-6 pt-5">
								<h3 class="text-xl font-semibold text-gray-900 mb-4">
									<?php the_title(); ?>
								</h3>
								
								<?php if ($date_display || $time_display || $event_location) : ?>
									<p class="text-sm text-gray-600">
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
			<div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
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
					<article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80 dark:bg-gray-800">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('large', array('class' => 'absolute inset-0 -z-10 size-full object-cover')); ?>
						<?php endif; ?>
						<div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40 dark:from-black/80 dark:via-black/40"></div>
						<div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10 dark:ring-white/10"></div>

						<div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm/6 text-gray-300">
							<?php if ($date_display) : ?>
								<div class="mr-8">
									<?php echo esc_html($date_display); ?>
								</div>
							<?php endif; ?>
							<?php if ($event_location) : ?>
								<div class="mr-8">
									<?php echo esc_html($event_location); ?>
								</div>
							<?php endif; ?>
						</div>
						<h3 class="mt-3 text-lg/6 font-semibold text-white">
							<a href="<?php the_permalink(); ?>">
								<span class="absolute inset-0"></span>
								<?php the_title(); ?>
							</a>
						</h3>
						<?php
							// Get event categories
							$event_categories = get_the_terms(get_the_ID(), 'event_category');
						?>
						<?php if ($event_categories && !is_wp_error($event_categories)) : ?>
							<div class="absolute top-4 right-4">
								<?php foreach ($event_categories as $category) : ?>
									<span class="inline-flex items-center rounded-full bg-blue-600/80 backdrop-blur-sm text-white px-2 py-1 text-xs font-semibold">
										<?php echo esc_html(strtoupper($category->name)); ?>
									</span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
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
			<div class="mx-auto mt-16 grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 sm:mt-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
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
					<article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pb-8 pt-80 sm:pt-48 lg:pt-80 dark:bg-gray-800">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('large', array('class' => 'absolute inset-0 -z-10 size-full object-cover')); ?>
						<?php endif; ?>
						<div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40 dark:from-black/80 dark:via-black/40"></div>
						<div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-inset ring-gray-900/10 dark:ring-white/10"></div>

						<div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm/6 text-gray-300">
							<?php if ($date_display) : ?>
								<div class="mr-8">
									<?php echo esc_html($date_display); ?>
								</div>
							<?php endif; ?>
							<?php if ($event_location) : ?>
								<div class="mr-8">
									<?php echo esc_html($event_location); ?>
								</div>
							<?php endif; ?>
						</div>
						<h3 class="mt-3 text-lg/6 font-semibold text-white">
							<a href="<?php the_permalink(); ?>">
								<span class="absolute inset-0"></span>
								<?php the_title(); ?>
							</a>
						</h3>
						<?php
							// Get event categories
							$event_categories = get_the_terms(get_the_ID(), 'event_category');
						?>
						<?php if ($event_categories && !is_wp_error($event_categories)) : ?>
							<div class="absolute top-4 right-4">
								<?php foreach ($event_categories as $category) : ?>
									<span class="inline-flex items-center rounded-full bg-gray-600/80 backdrop-blur-sm text-white px-2 py-1 text-xs font-semibold">
										<?php echo esc_html(strtoupper($category->name)); ?>
									</span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
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
