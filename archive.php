<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme-mx
 */

get_header();

	( new ThemeMXArchiveTemplate(
		[
			'page_template' => 'archive',
			'pagination' 	=> [
				'enable'		 => true,
				// 'posts_per_page' => 2
			]
		]
	) )->render();

// get_sidebar();
get_footer();
