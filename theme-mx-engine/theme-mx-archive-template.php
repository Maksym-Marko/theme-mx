<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// extends page template class
class ThemeMXArchiveTemplate extends ThemeMXIndexTemplate
{

}

/*
* Set AJAX actions
*/
// get news
if ( ! function_exists( 'mx_get_archive_data_func' ) ) :

	add_action( 'wp_ajax_mx_get_archive_data', 'mx_get_archive_data_func' );

	add_action( 'wp_ajax_nopriv_mx_get_archive_data', 'mx_get_archive_data_func' );

	function mx_get_archive_data_func() {

		// Check out if POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Check out if nonce's matched
		if( wp_verify_nonce( $_POST['nonce'], 'theme_mx_get_content_nonce' ) ) {

			$post_type = 'post';

			if( isset( $_POST['post_type'] ) ) {

				$post_type = sanitize_text_field( $_POST['post_type'] );

			}

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

			echo json_encode( $archive_data );

		}

		wp_die();

	}

endif;
