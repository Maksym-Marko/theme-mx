<?php
/*
* CPT mxtpfmt_books
*
* This file is an example of an extension of the ThemeMXBasicTemplate class. 
* You can use the ThemeMXBasicTemplate class dirrectly in your single-${cpt-name}.php file.
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class ThemeMXCPTmxtpfmt_booksTemplate extends ThemeMXPostTemplate
{

	public $cpt_data = '';

	public function __construct( $args = [] )
	{		

		parent::__construct( $args );

		// Set cpt_data
		$this->set_cpt_data( $args['cpt_data'] ?? NULL );

		// extends js vars
		$this->mx_expand_javascript_vars_cpt_template();

	}

	public function set_cpt_data( $cpt_data = NULL )
	{

		if( $cpt_data !== NULL ) {

			$this->cpt_data = $cpt_data;

		}

	}

	public function mx_expand_javascript_vars_cpt_template()
	{

		$script = '<script>';

		$script .= 'window.theme_mx_data.cpt_data = "' . $this->cpt_data . '";';

		$script .= '</script>';

		array_push( $this->expand_javascript_vars, $script );

	}

}