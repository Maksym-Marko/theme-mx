<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ThemeMXSearchPageTemplate extends ThemeMXIndexTemplate
{

	public $search_str = '';

	public $search_post_type = NULL;

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		// Set title
		$this->set_search_str();

		// Set a particular post type. If NULL, you'll get a global search result
		$this->set_search_post_type( $args['search_post_type'] ?? NULL );

		// extends js vars
		$this->mx_expand_javascript_vars_search_template();

	}

	/*
	* Set Post Type
	*/
	public function set_search_post_type( $search_post_type = NULL )
	{

		if( $search_post_type !== NULL ) {

			$this->search_post_type = $search_post_type;

		}

	}



	public function set_search_str()
	{

		if( isset( $_GET['s'] ) ) {

			$this->search_str = $_GET['s'];

		}

	}

	public function mx_expand_javascript_vars_search_template()
	{

		$script = '<script>';

		$script .= 'window.theme_mx_data.search_str = "' . $this->search_str . '";';

		$script .= 'window.theme_mx_data.search_post_type = "' . $this->search_post_type . '";';		

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}