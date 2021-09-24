<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Menus
*/
if ( ! function_exists( 'theme_mx_get_menus' ) ) :

	function theme_mx_get_menus( WP_REST_Request $request ) {

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

		mx_debug_to_file( $post );

        if ( $post->post_type !== 'post' || $post->post_type !== 'page' ) {

	        $route = '/wp/v2/' . $post->post_type . '/' . $post->ID;

	    }
	 
	    return $route;

	}
	add_filter( 'rest_route_for_post', 'theme_mx_get_cpt_posts', 10, 2 );

endif;