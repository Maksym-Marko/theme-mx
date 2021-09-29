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
* Posts Navigation
*/
if ( ! function_exists( 'theme_mx_posts_navigation' ) ) :

	function theme_mx_posts_navigation( $request ) {

		$post_type = $request['post_type'];

		$post_id = $request['post_id'];

		$next_post = mx_get_next_post( $post_id, $post_type );

		$prev_post = mx_get_prev_post( $post_id, $post_type );

		$navigation = [];

		if( $next_post !== NULL ) {

			$navigation['next_post'] = $next_post;

		}

		if( $prev_post !== NULL ) {

			$navigation['prev_post'] = $prev_post;

		}

		return $navigation;

	}

	add_action( 'rest_api_init', function () {

	    register_rest_route( 'theme_mx/v1', '/navigation/post_type=(?P<post_type>[a-zA-Z0-9_-]+)/post_id=(?P<post_id>\d+)', array(
	        'methods' => 'GET',
	        'callback' => 'theme_mx_posts_navigation',
	        'permission_callback' => '__return_true'
	    ) );

	} );

endif;