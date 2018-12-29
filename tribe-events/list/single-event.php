<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 * @cmsms_package 	Music Band
 * @cmsms_version 	1.1.0
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

?>

<figure>
	<!-- Event Image -->
	<?php echo tribe_event_featured_image( null, 'event-thumb' ) ?>
	<figcaption>
		<div class="cmsms_event_date">
			<div class="cmsms_event_day_name"><?php echo tribe_get_start_date(null, false, 'l'); ?></div>
			<div class="cmsms_event_day"><?php echo tribe_get_start_date(null, false, 'd'); ?></div>
			<div class="cmsms_event_month"><?php echo tribe_get_start_date(null, false, 'F'); ?></div>
		</div>
		<!-- Event Cost -->
		<?php if ( tribe_get_cost() ) : ?>
			<div class="tribe-events-event-cost">
				<span><?php echo tribe_get_cost( null, true ); ?></span>
			</div>
		<?php endif; ?>
	</figcaption>
</figure>

<p class="events_categories">
	<?php
		$cats = get_the_terms($id, 'tribe_events_cat');
		$is_ajax = defined('DOING_AJAX') && DOING_AJAX;
		$is_truly_admin = is_admin() && !$is_ajax;
		if (tribe_is_event($id) && $cats && !is_single() && !$is_truly_admin) {
        	$cat_titles = array();
		    foreach($cats as $i) {
		        $cat_titles[] = $i->name;
	        }
	        echo implode(', ', $cat_titles);
		}
	?>
</p>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h3 class="tribe-events-list-event-title entry-title summary">
	<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h3>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta vcard">
	<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

		<!-- Schedule & Recurrence Details -->
		<!-- <div class="updated published time-details">
			<?php //echo tribe_events_event_schedule_details() ?>
		</div> -->

		<?php if ( $venue_details ) : ?>
			<!-- Venue Display Info -->
			<div class="tribe-events-venue-details">
				<?php echo implode( ', ', $venue_details ); ?>
			</div> <!-- .tribe-events-venue-details -->
		<?php endif; ?>

	</div>
</div><!-- .tribe-events-event-meta -->
<?php do_action( 'tribe_events_after_the_meta' ) ?>

<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'the-events-calendar' ) ?></a>
