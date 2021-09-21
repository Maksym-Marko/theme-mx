<?php

/* Template Name: News Template */

get_header();

// render news page template
( new ThemeMXNewsTemplate(
	[
		'post_type' 	=> 'post',
		'page_template' => 'news',
		'pagination' 	=> [
			'enable'		 => true,
			'posts_per_page' => 3
		]
	]
) )->render();

get_footer();
