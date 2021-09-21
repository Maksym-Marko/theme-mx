<?php

/* Template Name: Books Template */

get_header();

// render books page template
( new ThemeMXNewsTemplate(
	[
		'post_type' 	=> 'mxtpfmt_books',
		'page_template' => 'news',
		'pagination' 	=> [
			'enable'		 => true,
			'posts_per_page' => 3
		]
	]
) )->render();

get_footer();
