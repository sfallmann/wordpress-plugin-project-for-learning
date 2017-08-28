<?php

/**
 * The utility\helper functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/includes
 */

/**
 * The utility\helper functionality of the plugin.
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/includesn
 * @author     Your Name <email@example.com>
 */

require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');
require_once(ABSPATH . 'wp-content/plugins/spf_movie/movie_post_type.php');

function get_movies() {
    
  $search = '&language=en-US&with_genres=14,878&with_original_languge=en&primary_release_year=2017';

	$apikey = '***********************';
	$api = 'https://api.themoviedb.org/3/discover/movie?';
	$url = $api.$apikey.$search;
	
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);
	$json = json_decode($result, true);
	
  return $json['results'];
}

function new_attachment( $att_id ){
    // the post this was sideloaded into is the attachments parent!

    // fetch the attachment post
    $att = get_post( $att_id );

    // grab it's parent
    $post_id = $att->post_parent;

    // set the featured post
    set_post_thumbnail( $post_id, $att_id );
}
