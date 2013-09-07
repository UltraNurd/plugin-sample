<?php
/*
Plugin Name: Remove YouTube Play Indicator
Plugin URI: http://github.com/UltraNurd/youtube-play-indicator
Description: Removes the triangle from the title of the shortened URL
Version: 1.0
Author: Nicolas Ward
Author URI: http://www.ultranurd.net/
*/

// No direct call
if( !defined( 'YOURLS_ABSPATH' ) ) die();

yourls_add_filter( 'add_new_title', 'nurd_rytpi_remove_play_indicator' );

function nurd_rytpi_remove_play_indicator( $original_title, $url, $keyword = '' ) {
	// Get the domain and check if it's from YouTube
	$domain = parse_url( $url, PHP_URL_HOST );
	if ( preg_match( '/(youtube|youtu\.be)/', $domain ) ) {
		// From YouTube, so kill that triangle
		$title = @mb_convert_encoding( preg_replace( '/^\x{25B6}\s*/u', "", $original_title ), 'UTF-8' );
		return $title;
	} else {
		// Leave as-is, not from YouTube
		return $original_title;
	}
}

?>
