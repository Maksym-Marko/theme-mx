<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package theme-mx
 */

get_header();

( new ThemeMX404PageTemplate( [

	'page404_title' => __( 'Oops! That page can’t be found.', 'theme-mx' ),
	'page404_description' => __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'theme-mx' )

] ) )->render();

get_footer();
