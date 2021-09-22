<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ThemeMXPostTemplate extends ThemeMXBasicTemplate
{

	public $navigation = false;

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		$this->set_navigation( $args['navigation'] ?? false );

		// extends js vars
		$this->mx_expand_javascript_vars_post_template();

	}

	public function set_navigation( $navigation = false )
	{
		
		// enable navigation
		if( isset( $navigation ) AND $navigation == 'enable' ) {

			$this->navigation = 'enable';

		}

	}

	public function mx_expand_javascript_vars_post_template()
	{

		$script = '<script>';

			$script .= 'window.theme_mx_data.posts_navigation = "' . $this->navigation . '";';

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}

/*
* Set AJAX actions
*/
// get news
if ( ! function_exists( 'mx_get_post_navigation_func' ) ) :

	add_action( 'wp_ajax_mx_get_post_navigation', 'mx_get_post_navigation_func' );

	add_action( 'wp_ajax_nopriv_mx_get_post_navigation', 'mx_get_post_navigation_func' );

	function mx_get_post_navigation_func() {

		// Check out if POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Check out if nonce's matched
		if( wp_verify_nonce( $_POST['nonce'], 'theme_mx_get_content_nonce' ) ) {

			if( isset( $_POST['post_id'] ) AND isset( $_POST['post_type'] ) ) {

				$post_id = sanitize_text_field( $_POST['post_id'] );

				$post_type = sanitize_text_field( $_POST['post_type'] );

				$next_post = mx_get_next_post( $post_id, $post_type );

				$prev_post = mx_get_prev_post( $post_id, $post_type );

				$navigation = [];

				if( $next_post !== NULL ) {

					$navigation['next_post'] = $next_post;

				}

				if( $prev_post !== NULL ) {

					$navigation['prev_post'] = $prev_post;

				}

				echo json_encode( $navigation );

			}			

		}

		wp_die();

	}

endif;

