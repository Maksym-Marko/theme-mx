<?php

/* Template Name: News Template */

get_header();

// render default page template
( new ThemeMXNewsTemplate(
	[
		'page_template' => 'news',
		'pagination' 	=> [
			'enable'		 => true,
			'posts_per_page' => 3
		]
	]
) )->render();

get_footer();
