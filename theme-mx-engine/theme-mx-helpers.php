<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Get next post
*/
if ( ! function_exists( 'mx_get_next_post' ) ) :

	function mx_get_next_post( $post_id = NULL, $post_type = 'post' ) {

		if( $post_id == NULL ) {
			return;
		}

		$date = get_the_date( 'Y-m-d h:i:s', $post_id );

		global $wpdb;

		$posts_table = $wpdb->prefix . 'posts';

		$sql_str = "SELECT ID, post_title, post_date, post_title, post_content, post_excerpt, post_type
			FROM $posts_table
			WHERE post_type = '$post_type'
				AND post_date < '$date'
				AND post_status = 'publish'
			ORDER BY post_date DESC";

		$result = $wpdb->get_row( $sql_str, ARRAY_A );

		if( $result !== NULL ) {

			$the_permalink = get_the_permalink( $result['ID'] );

			$result['permalink'] = $the_permalink;

		}

		return $result;

	}

endif;

/*
* Get next post
*/
if ( ! function_exists( 'mx_get_prev_post' ) ) :

	function mx_get_prev_post( $post_id = NULL, $post_type = 'post' ) {

		if( $post_id == NULL ) {
			return;
		}

		$date = get_the_date( 'Y-m-d h:i:s', $post_id );

		global $wpdb;

		$posts_table = $wpdb->prefix . 'posts';

		$sql_str = "SELECT ID, post_title, post_date, post_title, post_content, post_excerpt, post_type
			FROM $posts_table
			WHERE post_type = '$post_type'
				AND post_date > '$date'
				AND post_status = 'publish'
			ORDER BY post_date ASC";

		$result = $wpdb->get_row( $sql_str, ARRAY_A );

		if( $result !== NULL ) {

			$the_permalink = get_the_permalink( $result['ID'] );

			$result['permalink'] = $the_permalink;

		}

		return $result;

	}

endif;