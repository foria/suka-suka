<?php
/**
 * List View Nav Template
 * This file loads the list view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/nav.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */
if ( ! $wp_query = tribe_get_global_query_object() ) {
	return;
}

$events_label_plural = tribe_get_event_label_plural();

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<nav class="tribe-events-nav-pagination" aria-label="<?php echo esc_html( sprintf( esc_html__( '%s List Navigation', 'the-events-calendar' ), $events_label_plural ) ); ?>">
	<ul>
		<!-- Left Navigation -->

		<?php if ( tribe_has_previous_event() ) : ?>
			<li class="<?php echo esc_attr( tribe_left_navigation_classes() ); ?>">
				<a href="<?php echo esc_url( tribe_get_listview_prev_link() ); ?>" rel="prev"><icon class="icono-arrow1-right"></icon><?php _e('Previous', 'mbc'); ?></a>
			</li><!-- .tribe-events-nav-left -->
		<?php endif; ?>

		<!-- Right Navigation -->
		<?php if ( tribe_has_next_event() ) : ?>
			<li class="<?php echo esc_attr( tribe_right_navigation_classes() ); ?>">
				<a href="<?php echo esc_url( tribe_get_listview_next_link() ); ?>" rel="next"><?php _e('More Events', 'mbc'); ?><icon  class="icono-arrow1-left"></icon></a>
			</li><!-- .tribe-events-nav-right -->
		<?php endif; ?>
	</ul>
</nav>