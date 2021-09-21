<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ThemeMXPageTemplate extends ThemeMXBasicTemplate
{

	public $page_template = 'default';

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		// Set Page template
		$this->set_page_template( $args['page_template'] ?? NULL );

		// extends js vars
		$this->mx_expand_javascript_vars_page_template();

	}

	/*
	* Set Page template
	*/
	public function set_page_template( $page_template = NULL )
	{

		if( $page_template !== NULL ) {

			$this->page_template = $page_template;

		}

	}

	/*
	* Expand Global JS variable
	*/
	public function mx_expand_javascript_vars_page_template()
	{

		$script = '<script>';

		$script .= 'window.theme_mx_data.page_template = "' . $this->page_template . '";';

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}

/*
* Set AJAX actions
*/
if ( ! function_exists( 'get_page_content_func' ) ) :

	add_action( 'wp_ajax_mx_get_page_content', 'get_page_content_func' );

	add_action( 'wp_ajax_nopriv_mx_get_page_content', 'get_page_content_func' );

	function get_page_content_func() {

		// Check out if POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Check out if nonce's matched
		if( wp_verify_nonce( $_POST['nonce'], 'theme_mx_get_content_nonce' ) ) {

			global $wpdb;

			$table = $wpdb->prefix . 'posts';

			$post_id = intval( $_POST['post_id'] );

			$post = $wpdb->get_row(

				"SELECT * FROM $table
					WHERE ID = '" . $post_id . "'
					AND post_status = 'publish'"

			);

			if ( $post !== NULL ) :

				echo $post->post_content;

			endif;

		}

		wp_die();

	}

endif;