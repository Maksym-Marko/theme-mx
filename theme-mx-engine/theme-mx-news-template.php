<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Set AJAX actions
*/
add_action( 'wp_ajax_mx_get_news', 'mx_get_news_func' );

add_action( 'wp_ajax_nopriv_mx_get_news', 'mx_get_news_func' );

function mx_get_news_func() {	

	// Check out if POST nonce is not empty
	if( empty( $_POST['nonce'] ) ) wp_die( '0' );

	// Check out if nonce's matched
	if( wp_verify_nonce( $_POST['nonce'], 'theme_mx_get_content_nonce' ) ) {

		$post_type = 'post';

		global $wpdb;

		$posts_table = $wpdb->prefix . 'posts';

		$sql_str = "SELECT ID, post_title, post_date, post_title, post_content, post_excerpt
			FROM $posts_table
			WHERE post_type = '$post_type'
				AND post_status = 'publish'
			ORDER BY post_date DESC";

		$results = $wpdb->get_results( $sql_str, ARRAY_A );

		if( $results ) {

			foreach ( $results as $key => $value ) {

				$post_id = $value['ID'];

				// post thumbnails
				$results[$key]['thumbnails'] = [];

				$the_thumbnail_full = get_the_post_thumbnail_url( $post_id );

				if( $the_thumbnail_full ) {

					// full
					$results[$key]['thumbnails']['full'] = $the_thumbnail_full;
					
					// thumbnail
					$the_thumbnail_thumbnail = get_the_post_thumbnail_url( $post_id, 'thumbnail' );

					$results[$key]['thumbnails']['thumbnail'] = $the_thumbnail_thumbnail;

					// medium
					$the_thumbnail_medium = get_the_post_thumbnail_url( $post_id, 'medium' );

					$results[$key]['thumbnails']['medium'] = $the_thumbnail_medium;

					// large
					$the_thumbnail_large = get_the_post_thumbnail_url( $post_id, 'large' );

					$results[$key]['thumbnails']['large'] = $the_thumbnail_large;

				}

				// the permalink
				$url = get_the_permalink( $post_id );

				if( $url ) {

					$results[$key]['permalink'] = $url;

				}

				// categories
				$categories = get_the_category( $post_id );

				if( $categories ) {

					$results[$key]['categories'] = $categories;

				}

				// tags
				$tags = get_the_tags( $post_id );

				if( $tags ) {

					$results[$key]['tags'] = $tags;

				}

			}			

			echo json_encode( $results );

		} else {

			echo 'error';

		}

	}

	wp_die();

}