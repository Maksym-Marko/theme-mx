<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ThemeMXSearchPageTemplate extends ThemeMXIndexTemplate
{

	public $search_str = '';

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		// Set title
		$this->set_search_str();

		// extends js vars
		$this->mx_expand_javascript_vars_search_template();

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

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}