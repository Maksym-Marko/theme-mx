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