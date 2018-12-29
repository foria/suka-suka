<?php
/**
 * @package 	WordPress
 * @subpackage 	Music Band
 * @version		1.1.7
 *
 * Template Name: Events Counter
 * Created by MM
 *
 */

// $posts= get_posts(array(
//     'numberposts' => -1,
//     'post_type' => Tribe__Events__Main::POSTTYPE,
//     'post_status' => 'publish',
//     'orderby' => 'date',
//     'order'   => 'DESC',
//     'author'  => 1,
//     'date_query'    => array(
//         'column'  => 'post_date',
//         'after'   => '-7 days'  // -7 Means last 7 days
//     )
// ));
?>
<style>
    body {
        font-family: 'Courier New', Courier, 'Nimbus Mono L', monospace;
        font-size: 18px;
        line-height: 24px;
        font-weight: 400;
        font-style: normal;
    }
</style>
<h3>last 7 days</h3>

<?php
echo "Tabie: " . get_posts_count(3, '-7 days') . "<br>";
echo "Bella: " . get_posts_count(4, '-7 days') . "<br>";
echo "Verena: " . get_posts_count(5, '-7 days') . "<br>";
echo "Witria: " . get_posts_count(6, '-7 days') . "<br>";
echo "ssstaff: " . get_posts_count(2, '-7 days') . "<br>";
echo "caligola: " . get_posts_count(1, '-7 days') . "<br>";
?>

<h3>last month</h3>

<?php
echo "Tabie: " . get_posts_count(3, '-1 month') . "<br>";
echo "Bella: " . get_posts_count(4, '-1 month') . "<br>";
echo "Verena: " . get_posts_count(5, '-1 month') . "<br>";
echo "Witria: " . get_posts_count(6, '-1 month') . "<br>";
echo "ssstaff: " . get_posts_count(2, '-1 month') . "<br>";
echo "caligola: " . get_posts_count(1, '-1 month') . "<br>";
//wp_reset_postdata();

// $posts= get_posts(array(
//     'numberposts' => -1,
//     'post_type' => Tribe__Events__Main::POSTTYPE,
//     'post_status' => 'publish',
//     'orderby' => 'date',
//     'order'   => 'DESC',
//     'author'  => 'bellasdinata',
//     'date_query'    => array(
//         'column'  => 'post_date',
//         'after'   => '-7 days'  // -7 Means last 7 days
//     )
// ));
// echo "Bella: " . count($posts) . "<br>";
// wp_reset_postdata();

// $posts= get_posts(array(
//     'numberposts' => -1,
//     'post_type' => Tribe__Events__Main::POSTTYPE,
//     'post_status' => 'publish',
//     'orderby' => 'date',
//     'order'   => 'DESC',
//     'author'  => 'verenaaninditabanu',
//     'date_query'    => array(
//         'column'  => 'post_date',
//         'after'   => '-7 days'  // -7 Means last 7 days
//     )
// ));
// echo "Verena: " . count($posts) . "<br>";
// wp_reset_postdata();

// $posts= get_posts(array(
//     'numberposts' => -1,
//     'post_type' => Tribe__Events__Main::POSTTYPE,
//     'post_status' => 'publish',
//     'orderby' => 'date',
//     'order'   => 'DESC',
//     'author'  => 'ssstaff',
//     'date_query'    => array(
//         'column'  => 'post_date',
//         'after'   => '-7 days'  // -7 Means last 7 days
//     )
// ));
// echo "ssstaff: " . count($posts) . "<br>";
// wp_reset_postdata();

// $posts= get_posts(array(
//     'numberposts' => -1,
//     'post_type' => Tribe__Events__Main::POSTTYPE,
//     'post_status' => 'publish',
//     'orderby' => 'date',
//     'order'   => 'DESC',
//     'author'  => 'caligola',
//     'date_query'    => array(
//         'column'  => 'post_date',
//         'after'   => '-7 days'  // -7 Means last 7 days
//     )
// ));
// echo "caligola: " . count($posts) . "<br>";
// wp_reset_postdata();
