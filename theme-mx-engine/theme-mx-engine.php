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
 * Include News Template actions.
 */
require get_template_directory() . '/theme-mx-engine/theme-mx-news-template.php';