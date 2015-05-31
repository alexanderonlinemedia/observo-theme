<?php
/**
 * observo functions and definitions
 *
 * @package observo
 */


/**
 * Theme Setup
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Update Notifier
 */
require get_template_directory() . '/inc/update-check.php';

/**
 * Enqueue Scripts
 */
require get_template_directory() . '/inc/enqueue-scripts.php';

/**
 * Custom Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Register Widget Areas
 */
require get_template_directory() . '/inc/widget-areas.php';

/**
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Wordskins Control Panel Page and Setup
 */
require get_template_directory() . '/inc/control-panel.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
