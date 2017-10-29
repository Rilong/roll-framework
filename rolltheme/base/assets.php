<?php

/*
 * Load assets in frontend
 */

function roll_load_assets() {
	global $config;
	$assets = $config['assets'];
	$theme_data = wp_get_theme();

	$dir = get_template_directory_uri() . '/assets/';

	foreach ( $assets as $type => $asset ) {
		if ( empty( $asset ) ) {
			continue;
		}

		if ( $type == 'head' ) {
			foreach ( $asset as $item => $value ) {
				if ( $item == 'css' ) {
					if ( ! empty( $value ) ) {
						foreach ( $value as $id => $src ) {
							wp_enqueue_style( $id, $dir . $src, array(), $theme_data->get( 'Version' ) );
						}
					}
				}
				if ( $item == 'js' ) {
					if ( ! empty( $value ) ) {
						foreach ( $value as $id => $src ) {
							wp_enqueue_script( $id, $dir . $src, array(), $theme_data->get( 'Version' ) );
						}
					}
				}
			}
		}
		if ( $type == 'footer' ) {
			if ( ! empty( $asset['js'] ) ) {
				foreach ( $asset['js'] as $id => $src ) {
					wp_enqueue_script( $id, $dir . $src, array(), $theme_data->get( 'Version' ), true );
				}
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'roll_load_assets' );

/*
 * Load css in footer
 */

function roll_load_css_footer() {
	global $config;

	$assets = $config['assets'];
	$footerJs = $assets['footer']['css'];
	$theme_data = wp_get_theme();

	$dir = get_template_directory_uri() . '/assets/';

	if ( ! empty($footerJs) ) {
		foreach ($footerJs as $id => $src) {
			wp_enqueue_style( $id, $dir . $src, array(), $theme_data->get( 'Version' ) );
		}
	}
}

add_action( 'get_footer', 'roll_load_css_footer' );