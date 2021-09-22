<?php
/**
 * The template for displaying all single CPT posts
 * This file is an example. You can remove it. All CPT posts will be displayed on single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package theme-mx
 */

get_header();

// render default post template
( new ThemeMXCPTmxtpfmt_booksTemplate( [

    'navigation' => 'enable',
    'cpt_data' => 'Some CPT Data'

] ) )->render();

// get_sidebar();
get_footer();
