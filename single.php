<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package theme-mx
 */

get_header();

// render default post template
( new ThemeMXPostTemplate( [

    'navigation' => 'enable'

] ) )->render();

// get_sidebar();
get_footer();
