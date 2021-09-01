<?php

/* Template Name: News Template */

get_header();

// render default page template
( new ThemeMXPageTemplate( [ 'page_template' => 'news' ] ) )->render();

get_footer();
