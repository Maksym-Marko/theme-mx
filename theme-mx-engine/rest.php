<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Menus
*/
if ( ! function_exists( 'theme_mx_get_menus' ) ) :

	function theme_mx_get_menus( $request ) {

		$menu_id = $request['menu'];

		if( ! wp_get_nav_menu_items( $menu_id ) ) {

			return new WP_Error( 'menu_not_found', 'Menu not found', [ 'status' => 404 ] );

		} else {

			return wp_get_nav_menu_items( $menu_id );

		}

	}

	add_action( 'rest_api_init', function () {

	    register_rest_route( 'theme_mx/v1', '/menus/(?P<menu>[a-zA-Z0-9_-]+)', array(
	        'methods' => 'GET',
	        'callback' => 'theme_mx_get_menus',
	        'permission_callback' => null
	    ) );

	} );

endif;

/*
*  Get Thumbnails
*/
add_action( 'rest_api_init', function(){

	register_rest_field( ['post', 'page', 'mxtpfmt_books'], 'thumbnails', array(

		'get_callback' => function( $post, $field_name, $request ) {

			$post_id = $post['id'];

			$thumbnails = [];

			$the_thumbnail_full = get_the_post_thumbnail_url( $post_id );

			if( $the_thumbnail_full ) {

				// full
				$thumbnails['full'] = $the_thumbnail_full;
				
				// thumbnail
				$the_thumbnail_thumbnail = get_the_post_thumbnail_url( $post_id, 'thumbnail' );

				$thumbnails['thumbnail'] = $the_thumbnail_thumbnail;

				// medium
				$the_thumbnail_medium = get_the_post_thumbnail_url( $post_id, 'medium' );

				$thumbnails['medium'] = $the_thumbnail_medium;

				// large
				$the_thumbnail_large = get_the_post_thumbnail_url( $post_id, 'large' );

				$thumbnails['large'] = $the_thumbnail_large;

			}

			return $thumbnails;
		},
		'update_callback' => null

	) );

} );

/*
* Get CPT posts
*/
if ( ! function_exists( 'theme_mx_get_cpt_posts' ) ) :

	function theme_mx_get_cpt_posts( $route, $post ) {

        if ( $post->post_type !== 'post' AND $post->post_type !== 'page' ) {

	        $route = '/wp/v2/' . $post->post_type . '/' . $post->ID;

	    }
	 
	    return $route;

	}
	add_filter( 'rest_route_for_post', 'theme_mx_get_cpt_posts', 10, 2 );

endif;

/*
* Get number of posts
*/
if ( ! function_exists( 'theme_mx_get_posts_count' ) ) :

	
	function theme_mx_get_posts_count( $request ) {

		$post_type = $request['post_type'];

		if( post_type_exists( $post_type ) ) {

			$post_type = sanitize_text_field( $post_type );

			global $wpdb;

			$posts_table = $wpdb->prefix . 'posts';

			$number_posts = $wpdb->get_var(
				"SELECT COUNT(ID)
					FROM $posts_table
					WHERE post_type = '$post_type'
					AND post_status = 'publish'
				"
			);

			return intval( $number_posts );

		} else {

			return new WP_Error( 'post_type_not_found', 'Post Type not found', [ 'status' => 404 ] );

		}

	}

	add_action( 'rest_api_init', function () {

	    register_rest_route( 'theme_mx/v1', '/count/post_type=(?P<post_type>[a-zA-Z0-9_-]+)', array(
	        'methods' => 'GET',
	        'callback' => 'theme_mx_get_posts_count',
	        'permission_callback' => null
	    ) );

	} );
	

endif;

/*
* Get Archive
*/
if ( ! function_exists( 'theme_mx_get_archive_data' ) ) :

	function theme_mx_get_archive_data( $request ) {

		$post_type = $request['post_type'];

		if( post_type_exists( $post_type ) ) {

			$get_archives = get_post_type_object( $post_type );

			$archive_data = [];

			if( $get_archives ) {

				$archive_title = $get_archives->label;

				$archive_description = $get_archives->description;

				$archive_data = [

					'archive_title' 		=> $archive_title,
					'archive_description' 	=> $archive_description

				];

			}

			return $archive_data;

		} else {

			return new WP_Error( 'archive_not_found', 'Archive not found', [ 'status' => 404 ] );

		}

	}

	add_action( 'rest_api_init', function () {

	    register_rest_route( 'theme_mx/v1', '/archive/post_type=(?P<post_type>[a-zA-Z0-9_-]+)', array(
	        'methods' => 'GET',
	        'callback' => 'theme_mx_get_archive_data',
	        'permission_callback' => null
	    ) );

	} );

endif;