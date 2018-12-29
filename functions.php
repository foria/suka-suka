<?php
/**
 * @package 	WordPress
 * @subpackage 	Music Band Child
 * @version		1.0.0
 *
 * Child Theme Functions File
 * Created by CMSMasters
 *
 */


function music_band_child_enqueue_styles() {
    wp_enqueue_style('tribe-events-full-calendar-style');
    wp_enqueue_style('tribe-events-calendar-style');
    wp_enqueue_style('music-band-child-style', get_stylesheet_uri(), array('theme-style'), time(), 'screen, print');
    //wp_enqueue_style('music-band-child-style-resp', get_stylesheet_directory_uri() . '/responsive.css', array(), time(), 'screen');

    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );

    remove_action('init', 'cmsmasters_add_editor_styles');

    wp_dequeue_style('contact-form-7-css');
    wp_dequeue_style('music-css');
    //wp_dequeue_style('theme-fonts-schemes');
    wp_dequeue_style('cmsms-google-fonts');
    wp_dequeue_style('theme-icons');
    wp_dequeue_style('animate');
    wp_dequeue_style('isotope');
    wp_dequeue_style('ilightbox');
    wp_dequeue_style('ilightbox-skin-dark');

    wp_deregister_style('isotope');
    wp_deregister_style('icons');
    wp_deregister_style('music');

    if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            [ 'jquery-migrate' ]
        );
    }
    wp_dequeue_script( 'comment-reply' );
    wp_deregister_script( 'wp-embed' );

    wp_dequeue_script( 'less' );
    wp_dequeue_script( 'libs' );
    wp_dequeue_script( 'jLibs' );
    wp_dequeue_script( 'iLightBox' );
    wp_dequeue_script( 'cmsms-scrollspy' );
    wp_dequeue_script( 'playlist' );
    wp_dequeue_script( 'jplayer' );
    wp_dequeue_script('twitter');

    wp_enqueue_script( 'tribe-events-bootstrap-datepicker' );
    wp_enqueue_script('music-band-child-script', get_stylesheet_directory_uri(). '/js/main.js', array('jquery'), time());

    remove_image_size('full-masonry-thumb');
    remove_image_size('project-full-thumb');
    remove_image_size('masonry-thumb');
    remove_image_size('project-masonry-thumb');
    remove_image_size('blog-masonry-thumb');
    remove_image_size('square-thumb');
    remove_image_size('small-thumb');
}

add_action('wp_enqueue_scripts', 'music_band_child_enqueue_styles', 11);

if( !function_exists( 'mbc_unregister_post_type' ) ) {
    function mbc_unregister_post_type(){
        unregister_post_type( 'project' );
        unregister_post_type( 'profile' );
    }
}
add_action('init','mbc_unregister_post_type');

/**
 * Adds a metabox to the right side of the screen under the “Publish” box
 */
function wpt_add_event_metaboxes() {
    add_meta_box(
        'wpt_events_location',
        'Event Location',
        'wpt_events_location',
        Tribe__Events__Main::POSTTYPE,
        'side',
        'default'
    );
}
add_action( 'admin_init', 'wpt_add_event_metaboxes' );

/**
 * Output the HTML for the metabox.
 */
$cities = array('Badung', 'Canggu', 'Denpasar', 'Kerobokan', 'Kuta', 'Nusa Dua', 'Sanur', 'Seminyak', 'Ubud', 'Uluwatu', 'Umalas' );

function wpt_events_location() {
    global $post;
    global $cities;

    // Nonce field to validate form request came from current site
    wp_nonce_field( basename( __FILE__ ), 'event_fields' );

    // Get the location data if it's already been entered
    $location = get_post_meta( $post->ID, 'location', true );

    // Output the field
    //echo '<input type="text" name="location" value="' . esc_textarea( $location )  . '" class="widefat">';
    echo '<select name="location" class="widefat">';
    echo '<option>Select Location</option>';

    foreach($cities as $city){
        echo '<option value='.$city.selected($location, $city).'>'.$city.'</option>';
    }

    echo '</select>';

}

/**
 * Save the metabox data
 */
function wpt_save_events_meta( $post_id, $post ) {

    // Return if the user doesn't have edit permissions.
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
    }

    // Verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times.
    if ( ! isset( $_POST['location'] ) || ! wp_verify_nonce( $_POST['event_fields'], basename(__FILE__) ) ) {
        return $post_id;
    }

    // Now that we're authenticated, time to save the data.
    // This sanitizes the data from the field and saves it into an array $events_meta.
    $events_meta['location'] = esc_textarea( $_POST['location'] );

    // Cycle through the $events_meta array.
    // Note, in this example we just have one item, but this is helpful if you have multiple.
    foreach ( $events_meta as $key => $value ) :

        // Don't store custom data twice
        if ( 'revision' === $post->post_type ) {
            return;
        }

        if ( get_post_meta( $post_id, $key, false ) ) {
            // If the custom field already has a value, update it.
            update_post_meta( $post_id, $key, $value );
        } else {
            // If the custom field doesn't have a value, add it.
            add_post_meta( $post_id, $key, $value);
        }

        if ( ! $value ) {
            // Delete the meta key if there's no value
            delete_post_meta( $post_id, $key );
        }

    endforeach;

}
add_action( 'save_post', 'wpt_save_events_meta', 1, 2 );

function events_link_blank() {
    return '_blank';
}
add_filter( 'tribe_get_event_website_link_target', 'events_link_blank' );


// Add to existing function.php file
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');
// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');
// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');
// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');
// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'df_disable_comments_admin_bar');


// Disable RSS Feed
function itsme_disable_feed() {
 wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);

remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );


function get_posts_count($author, $time) {
    global $wpdb;

    $numposts = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT COUNT(ID) ".
            "FROM {$wpdb->posts} ".
            "WHERE ".
                "post_status='publish' ".
                "AND post_type= %s ".
                "AND post_author= %s ".
                "AND post_date> %s",
            Tribe__Events__Main::POSTTYPE, $author, date('Y-m-d H:i:s', strtotime($time))
        )
    );
    return $numposts;
}

/*
 * Adding the column
 */
// function rd_user_id_column( $columns ) {
//     $columns['user_id'] = 'ID';
//     return $columns;
// }
// add_filter('manage_users_columns', 'rd_user_id_column');

// /*
//  * Column content
//  */
// function rd_user_id_column_content($value, $column_name, $user_id) {
//     if ( 'user_id' == $column_name )
//         return $user_id;
//     return $value;
// }
// add_action('manage_users_custom_column',  'rd_user_id_column_content', 10, 3);

// /*
//  * Column style (you can skip this if you want)
//  */
// function rd_user_id_column_style(){
//     echo '<style>.column-user_id{width: 5%}</style>';
// }
// add_action('admin_head-users.php',  'rd_user_id_column_style');


add_action( 'before_delete_post', 'wps_remove_attachment_with_post', 10 );
function wps_remove_attachment_with_post($post_id)
{

    if(has_post_thumbnail( $post_id ))
        {
      $attachment_id = get_post_thumbnail_id( $post_id );
      wp_delete_attachment($attachment_id, true);
    }

}
