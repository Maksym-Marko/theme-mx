<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ThemeMX404PageTemplate extends ThemeMXPageTemplate
{

	public $page_template = '404';

	public $page404_title = 'Oops! That page can’t be found.';

	public $page404_description = 'It looks like nothing was found at this location. Maybe try one of the links below or a search?';

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		// Set title
		$this->set_page404_title( $args['page404_title'] ?? NULL );

		// Set description
		$this->set_page404_description( $args['page404_description'] ?? NULL );

		// extends js vars
		$this->mx_expand_javascript_vars_page404_template();

	}

	public function set_page404_title( $page404_title = NULL )
	{

		if( $page404_title !== NULL ) {

			$this->page404_title = $page404_title;

		}

	}

	public function set_page404_description( $page404_description = NULL )
	{

		if( $page404_description !== NULL ) {

			$this->page404_description = $page404_description;

		}

	}

	public function mx_expand_javascript_vars_page404_template()
	{

		$script = '<script>';

		$script .= 'window.theme_mx_data.page404_title = "' . $this->page404_title . '";';

		$script .= 'window.theme_mx_data.page404_description = "' . $this->page404_description . '";';

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}