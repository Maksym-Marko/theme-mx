<?php

/* Template Name: Template with sidebar */

get_header();

// render news page template
( new ThemeMXNewsTemplate(
	[
		'page_template' => 'with_sidebar'
	]
) )->render();

get_footer();
