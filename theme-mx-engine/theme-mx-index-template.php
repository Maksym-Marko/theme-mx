<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// extends page template class
class ThemeMXIndexTemplate extends ThemeMXPageTemplate
{

	public $pagination = false;

	public $posts_per_page = 10;

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		if( get_option( 'posts_per_page' ) ) {

			$this->posts_per_page = get_option( 'posts_per_page' );

		}

		$this->setPaginagion( $args['pagination'] ?? false );

		$this->mx_expand_javascript_vars_pagination();

	}

	public function setPaginagion( $pagination = false )
	{

		// enable pagination
		if( isset( $pagination['enable'] ) AND $pagination['enable'] ) {

			$this->pagination = true;

		}
		
		// set posts per page
		if( isset( $pagination['posts_per_page'] ) ) {

			$this->posts_per_page = intval( $pagination['posts_per_page'] );

		}

	}

	/*
	* Expand Global JS variable
	*/
	public function mx_expand_javascript_vars_pagination()
	{

		$script = '<script>';

			$script .= 'window.theme_mx_data.pagination = {';

				$script .= '"enable":"' . $this->pagination . '",';
				$script .= '"posts_per_page":"' . $this->posts_per_page . '"';

			$script .= '};';

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}