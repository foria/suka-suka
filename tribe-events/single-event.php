<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 * @cmsms_package 	Music Band
 * @cmsms_version 	1.1.8
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

if (have_posts()) : the_post();

?>

<div id="tribe-events-content" class="tribe-events-single vevent hentry">
	<!-- <div class="cmsms_single_event_header clearfix">
		<div class="cmsms_single_event_header_right clearfix">
			<?php
			//echo '<div class="tribe-events-schedule updated published clearfix">' .
				//tribe_events_event_schedule_details($event_id, '<div class="tribe-events-date">', '</div>');
			//echo '</div>';
			?>
		</div>
	</div> -->

	<div id="post-<?php the_ID(); ?>" <?php post_class('cmsms_single_event'); ?>>

		<div class="mbc-single__content-col">
			<?php
			echo '<div class="cmsms_single_event_inner">';

				the_title('<h1 class="tribe-events-single-event-title summary entry-title"><span>', '</span></h1>');


				echo '<div class="tribe-events-single-event-description cmsms_single_event_content tribe-events-content entry-content description">';

					the_content();

				echo '</div>' .
			'</div>';

			do_action('tribe_events_single_event_before_the_content');

			do_action('tribe_events_single_event_after_the_content');
			?>
		</div>

		<div class="mbc-single__content-col">
			<?php
			if (has_post_thumbnail()) {
				echo '<div class="cmsms_single_event_img' . (!tribe_embed_google_map() ? ' cmsms_single_event_full_width' : '') . '">' .
					tribe_event_featured_image($event_id, (!tribe_embed_google_map() ? 'full-thumb' : 'blog-masonry-thumb'), false) .
				'</div>';
			}

			do_action('tribe_events_single_event_before_the_meta');


			if (!apply_filters('tribe_events_single_event_meta_legacy_mode', false)) {
				tribe_get_template_part( 'modules/meta' );
			} else {
				echo tribe_events_single_event_meta();
			}
			?>
		</div>

		<?php

		echo '</div>';

		do_action('tribe_events_single_event_after_the_meta');


	$cmsms_post_type = get_post_type();

	$published_events = wp_count_posts($cmsms_post_type)->publish;

	if ($published_events > 1) {
		echo '<aside id="tribe-events-sub-nav" class="post_nav">' .
			'<span class="tribe-events-nav-previous cmsms_prev_post cmsms_theme_icon_slide_' . (!is_rtl() ? 'prev' : 'next') . '"><icon class="icono-arrow1-right"></icon>';

				tribe_the_prev_event_link('%title%');

			echo '</span>' .
			'<span class="tribe-events-nav-next cmsms_next_post cmsms_theme_icon_slide_' . (!is_rtl() ? 'next' : 'prev') . '">';

				tribe_the_next_event_link('%title%');

			echo '<icon class="icono-arrow1-left"></icon></span>' .
		'</aside>';
	}


	if (get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option('showComments', false)) {
		comments_template();
	}

echo '</div>';


endif;

