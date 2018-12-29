<?php
/**
 * @package     WordPress
 * @subpackage  Music Band
 * @version     1.1.7
 *
 * Template Name: Events Search
 * Created by MM
 *
 */


get_header();
$page_title = __('Upcoming Events', 'mbc');
?>

<?php
if (isset($_GET['start_date'])) {
    $start_date = $_GET['start_date'].' 00:01';
    $page_title .= ' from ' . explode(" ", $start_date)[0];
} else {
    $start_date = date('Y-m-d H:i:s');
    $page_title .= ' from today';
}

$events_args = array(
    'posts_per_page' => -1,
    'start_date' => $start_date
);

if (isset($_GET['location'])) {
    $location =  $_GET['location'];
    $events_args['meta_query'] =  array(
        array(
            'key' => 'location',
            'value' => $location,
        )
    );
    $page_title .= ' in ' . $location;
}

if (isset($_GET['category'])) {
    $category =  $_GET['category'];
    $events_args['tribe_events_cat'] = $category;
    $page_title .= ' for ' . $category;
}

// Retrieve events
$events = tribe_get_events( $events_args ); ?>

<div class="middle_content entry" role="main">

    <div id="tribe-events-content" class="tribe-events-list events-search">

        <!-- List Header -->
        <?php do_action( 'tribe_events_before_header' ); ?>
        <div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>

            <!-- List Title -->
            <?php do_action( 'tribe_events_before_the_title' ); ?>
            <h2 class="tribe-events-page-title"><?php echo $page_title ?></h2>
            <?php do_action( 'tribe_events_after_the_title' ); ?>

            <!-- Header Navigation -->
            <?php do_action( 'tribe_events_before_header_nav' ); ?>
            <?php do_action( 'tribe_events_after_header_nav' ); ?>

        </div>
        <?php do_action( 'tribe_events_after_header' ); ?>

        <!-- Notices -->
        <?php tribe_the_notices() ?>

        <!-- Events Loop -->
        <div class="tribe-events-loop">
            <?php
            do_action( 'tribe_events_before_loop' );
            tribe_get_template_part('list/nav', 'header');
            // Loop through the events, displaying the title
            // and content for each

            foreach ( $events as $post ) { ?>

                <?php do_action( 'tribe_events_inside_before_loop' ); ?>

                <!-- Month / Year Headers -->
                <?php //tribe_events_list_the_date_headers(); ?>

                <!-- Event  -->
                <?php
                $post_parent = '';
                if ( $post->post_parent ) {
                    $post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
                }
                ?>
                <div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>" <?php echo $post_parent; ?>>
                    <?php
                    $event_type = tribe( 'tec.featured_events' )->is_featured( $post->ID ) ? 'featured' : 'event';

                    /**
                     * Filters the event type used when selecting a template to render
                     *
                     * @param $event_type
                     */
                    $event_type = apply_filters( 'tribe_events_list_view_event_type', $event_type );

                    tribe_get_template_part( 'list/single', $event_type );
                    ?>
                </div>


                <?php do_action( 'tribe_events_inside_after_loop' ); ?>
            <?php } ?>
        </div><!-- .tribe-events-loop -->

    </div><!-- #tribe-events-content -->

</div>

<?php

get_footer();

