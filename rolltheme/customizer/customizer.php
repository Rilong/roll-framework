<?php

/*
 * Customizer Wordpress
 */

function roll_customizer( $wp_customize ) {
	global $config;
	$customizer = $config['customizer'];

	foreach ($customizer as $section_name => $section_params) {
		$section_params_array = array();
		if ( ! isset( $section_params['title'] ) || strlen( $section_params['title'] ) == 0  )
			$section_params_array['title'] = 'noname';
		else
			$section_params_array['title'] = $section_params['title'];
		if ( isset( $section_params['priority'] ) )
			$section_params_array['priority'] = $section_params['priority'];

		$wp_customize->add_section($section_name, $section_params_array);

		if (! empty( $section_params['items'] )) {
			foreach ( $section_params['items'] as $item => $setting) {

				$setting_params_array = array();

				if ( ! isset( $setting['default'] ) )
					$setting_params_array['default'] = '';
				else
					$setting_params_array['default'] = $setting['default'];

				if ( ! isset( $setting['transport'] ) )
					$setting_params_array['transport'] = 'refresh';
				else
					$setting_params_array['transport'] = $setting['transport'];

				$wp_customize->add_setting($item, $setting_params_array);

				$control = $setting['field'];

				$control['section'] = $section_name;
				$control['settings'] = $item;
				$control['choices'] = array( 'left'  => 'left', 'right' => 'right' );

				$wp_customize->add_control($item . '_input', $control );
			}
		}
	}
}