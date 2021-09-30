<?php

/* Template Name: Template with sidebar */

get_header();

// render page template
( new ThemeMXPageTemplate(
	[
		'page_template' => 'with_sidebar'
	]
) )->render();

get_footer();
