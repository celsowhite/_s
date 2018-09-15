<?php

/*==========================================
THEME
==========================================*/

// Pre Init - Functions that need to run before init to setup admin customizations

require get_template_directory() . '/includes/theme/pre_init.php';

// Enqueue - Load styles and scripts

require get_template_directory() . '/includes/theme/enqueue.php';

/*==========================================
DASHBOARD
==========================================*/

// Custom Post Types

require get_template_directory() . '/includes/dashboard/custom_post_types.php';

// Widgets & Sidebars

require get_template_directory() . '/includes/dashboard/register_widgets_sidebars.php';

// Clean Admin

require get_template_directory() . '/includes/dashboard/clean_admin.php';

/*==========================================
HELPERS
==========================================*/

// WP Queries

require get_template_directory() . '/includes/helpers/wp_queries.php';

// Helper Functions

require get_template_directory() . '/includes/helpers/helper_functions.php';

// Custom template tags for this theme.

require get_template_directory() . '/includes/helpers/template-tags.php';

/*==========================================
PLUGIN CUSTOMIZATION
==========================================*/

// Yoast

require get_template_directory() . '/includes/plugin_customization/yoast.php';

// ACF

require get_template_directory() . '/includes/plugin_customization/acf.php';

/*==========================================
SHORTCODES
==========================================*/

// Custom Shortcodes

require get_template_directory() . '/includes/shortcodes/custom_shortcodes.php';

/*==========================================
FEATURES
==========================================*/

// oEmbed

require get_template_directory() . '/includes/features/oEmbed.php';
