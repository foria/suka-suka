<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/tribe-events-bar.class.php
 *
 * @package TribeEventsCalendar
 *
 * @cmsms_package 	Music Band
 * @cmsms_version 	1.1.0
 *
 */

global $cities;
?>

<div id="tribe-bar-form" class="custom-tribe-bar">
	<span class="tribe-bar-title"><?php _e('Fast Search', 'mbc'); ?></span>
    <div class="tribe-bar-date-filter">
        <label for="tribe-bar-date">Date</label>
        <input type="text" name="tribe-bar-date" id="tribe-bar-date" aria-label="Search for Events by Date" value="" placeholder="Pick a Day" autocomplete="off">
    </div>
    <div class="tribe-bar-date-filter">
        <label for="tribe-bar-location">Location</label>
        <?php
        echo '<select name="tribe-bar-location" id="tribe-bar-location" aria-label="Search for Events by Location">';
	    echo '<option disabled selected>ex. Seminyak</option>';

	    foreach($cities as $city){
	        echo '<option>'.$city.'</option>';
	    }

	    echo '</select>';
	    ?>
    </div>
    <div class="tribe-bar-date-filter">
        <label for="tribe-bar-category">Category</label>
        <?php
        $categories = get_terms( array(
		    'taxonomy' => Tribe__Events__Main::TAXONOMY,
		    'hide_empty' => false,
		) );

        echo '<select name="tribe-bar-category" id="tribe-bar-category" aria-label="Search for Events by Category" value="">';
	    echo '<option disabled selected>ex. Exhibition</option>';

	    foreach($categories as $category){
	        echo '<option>'.$category->name.'</option>';
	    }

	    echo '</select>';
		?>
    </div>
    <div class="tribe-bar-submit">
		<input class="tribe-events-button tribe-no-param" type="submit" name="submit-bar" value="Find Events">
	</div>
</div>

