<?php
	require get_template_directory() . '/rolltheme/config.php';
	require get_template_directory() . '/rolltheme/base/assets.php';
	require get_template_directory() . '/rolltheme/base/support.php';
	require get_template_directory() . '/rolltheme/customizer/customizer.php';
	require get_template_directory() . '/rolltheme/post_types/post_types.php';

	do_action('roll_init');