<?php
	define('ROLLTHEME_DIR', get_template_directory() . '/rolltheme/');

	require ROLLTHEME_DIR . 'config.php';
	require ROLLTHEME_DIR . 'base/assets.php';
	require ROLLTHEME_DIR . 'base/support.php';
	require ROLLTHEME_DIR . 'customizer/customizer.php';
	require ROLLTHEME_DIR . 'post_types/post_types.php';


    require ROLLTHEME_DIR . 'admin/base/roll_assets_admin.class.php';
    require ROLLTHEME_DIR . 'theme_options/roll_theme_options_controls.class.php';
    require ROLLTHEME_DIR . 'theme_options/roll_theme_options.class.php';
    require ROLLTHEME_DIR . 'theme_options/roll_theme_options_export.class.php';

    Roll_assets_admin::instance();
    new Roll_theme_options();


	do_action('roll_init');