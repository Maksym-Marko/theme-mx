<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Include Basic Template.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-basic-template.php';

/**
 * Include Default Page Template.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-page-template.php';

/**
 * Include Index Template.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-index-template.php';

/**
 * Include Archive Template.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-archive-template.php';

/**
 * Include News Template.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-news-template.php';

/**
 * Page 404.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-page404-template.php';

/**
 * Include Post Template.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-post-template.php';

/**
 * Search Page.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-search-template.php';

/**
 * Books CPT.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-cpt-mxtpfmt_books-template.php';