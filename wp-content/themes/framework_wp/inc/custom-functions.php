<?php
/*
 *  Responsive embeds
 */

add_theme_support( 'responsive-embeds' );


/**
 * Year filter
 */
add_filter( 'facetwp_index_row', function( $params, $class ) {
	if ( 'date_as_year' == $params['facet_name'] ) { // change date_as_year to name of your facet
		$raw_value = $params['facet_value'];
		$params['facet_value'] = date( 'Y', strtotime( $raw_value ) );
		$params['facet_display_value'] = $params['facet_value'];
	}
	return $params;
}, 10, 2 );


/**
 * reindex after adding or updating this filter
 */
add_filter( 'facetwp_index_row', function( $params, $class ) {
	if ( 'video' == $params['facet_name'] && '' != $params['facet_value'] ) { // change my_facet to name of your facet
		$params['facet_value'] = 'video';
		$params['facet_display_value'] = 'Show with video';
	}
	return $params;
}, 10, 2 );

/**
 * reindex after adding or updating this filter
 */
add_filter( 'facetwp_index_row', function( $picparams, $class ) {
	if ( 'picture' == $picparams['facet_name'] && '' != $picparams['facet_value'] ) { // change my_facet to name of your facet
		$picparams['facet_value'] = 'picture';
		$picparams['facet_display_value'] = 'Show with picture(s)';
	}
	return $picparams;
}, 10, 2 );


/**
 * 
 * Return current user ID
 * 
 */

 function currentUserId() {
	 //get user id
	 $current_user = wp_get_current_user();
	 $current_user_id = $current_user->ID;

	 return $current_user_id;
}


/**
 * 
 * Return the number of gigs for a user ID
 * 
 */

function getNumberOfGigs() {
	global $wpdb;

	$gig_count = $wpdb->get_var(
		$wpdb->prepare(
			"SELECT COUNT(*) FROM " . $wpdb->prefix . "gigs_attending
			WHERE user_id = %d",
			currentUserId()
		)
	);

	return $gig_count;
}

/**
 * 
 * Return all the post id of the gigs a user has attended
 * 
 */

function getPostIdsOfUser() {
	global $wpdb;
                        
	$currentUserId = currentUserId();
	$gigIds = [];
	
	$results = $wpdb->get_results($wpdb->prepare('SELECT post_id FROM ' . $wpdb->prefix . 'gigs_attending WHERE user_id = %s', $currentUserId));
	
	foreach ($results as $r) {
		$gig_id = $r->post_id;
		
		array_push($gigIds, $gig_id); 
	}

	return $gigIds;
}

/**
 * 
 * Return the number of songs of the post ids
 * 
 */
function getSongsOfPosts() {
	//get array of post id
	$postIds = getPostIdsOfUser();
	$songIds = [];
	$allSongs = [];

	//loop over post ids

	//get the songs field get_field('songs')
	foreach ($postIds as $postId){ 
		array_push($songIds, get_field('songs', $postId));	
	} 

	foreach ($songIds as $songId) {
		foreach ($songId as $key => $value) {
			array_push($allSongs, $value->ID);
		}
	}

	$uniqueSongs = array_unique($allSongs, SORT_REGULAR);

	return $uniqueSongs;
}


/**
 * 
 * Return the number of songs of the post ids
 * 
 */
function getNumberOfSongsOfPosts() {
	//get array of post id
	$postIds = getPostIdsOfUser();
	$songIds = [];
	$allSongs = [];

	//get the songs field get_field('songs')
	foreach ($postIds as $postId){ 
		array_push($songIds, get_field('songs', $postId));	
	} 

	foreach ($songIds as $songId) {
		foreach ($songId as $key => $value) {
			array_push($allSongs, $value->ID);
		}
	}

	$allSongs = array_count_values($allSongs);

	return $allSongs;
}


function getNumberCountries() {
	$countries = [];

	$args = array(
		'post_type' => 'gig',
	); 

	$loop = new WP_Query($args);

	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                            
		array_push($countries, get_field('country'));

	endwhile;

	else:
	endif;

	$countries = array_count_values($countries);

	arsort($countries);

	return $countries;
}

function getNumberCities() {
	$cities = [];

	$args = array(
		'post_type' => 'gig',
	); 

	$loop = new WP_Query($args);

	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
                            
		array_push($cities, get_field('city'));

	endwhile;

	else:
	endif;

	$cities = array_count_values($cities);

	arsort($cities);

	return $cities;
}

/**
 * 
 * Get the total number of songs played
 * 
 */
function getNumberSongsPlayed() {
	$args = array(
		'post_type' => 'gig'
	);

	$loop = new WP_Query($args);
	$counter = 0;

	if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();
		$posts = get_field('songs');

		if( $posts ): 
			foreach( $posts as $post):
				setup_postdata($post); 

				$counter ++;

			endforeach;
			wp_reset_postdata();

		endif;


	endwhile;
	endif;


	return $counter;
}

/*
 * FIX: enable all comments
 * 
 * 
 */
function enable_comments_for_all(){
    global $wpdb;
    $wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET comment_status = 'open' WHERE post_type = 'gig'")); // Enable comments
    $wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET ping_status = 'open' WHERE post_type = 'gig'")); // Enable trackbacks
} enable_comments_for_all();