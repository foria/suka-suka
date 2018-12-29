<?php
/**
 * List View Content Template
 * The content template for the list view. This template is also used for
 * the response that is returned on list view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/content.php
 *
 * @package TribeEventsCalendar
 *
 * @cmsms_package 	Music Band
 * @cmsms_version 	1.1.0
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-list">

	<!-- List Header -->
    <?php do_action( 'tribe_events_before_header' ); ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

		<!-- List Title -->
		<?php do_action( 'tribe_events_before_the_title' ); ?>
		<h2 class="tribe-events-page-title"><?php _e('Upcoming Events', 'mbc') ?></h2>
		<?php do_action( 'tribe_events_after_the_title' ); ?>

		<!-- Header Navigation -->
		<?php do_action( 'tribe_events_before_header_nav' ); ?>
		<?php do_action( 'tribe_events_after_header_nav' ); ?>

	</div>
	<?php do_action( 'tribe_events_after_header' ); ?>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<!-- Events Loop -->
	<?php if ( have_posts() ) : ?>
		<?php do_action( 'tribe_events_before_loop' ); ?>
		<?php tribe_get_template_part( 'list/loop' ) ?>
		<?php tribe_get_template_part('list/nav', 'footer'); ?>
		<?php do_action( 'tribe_events_after_loop' ); ?>
	<?php endif; ?>

</div><!-- #tribe-events-content -->
