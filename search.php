<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package theme-mx
 */


get_header();

// render search page template
( new ThemeMXSearchPageTemplate(
	[
		'page_template' => 'search',
        'pagination'    => [
            'enable'         => true,
            'posts_per_page' => 4
        ]
	]
) )->render();

get_footer();