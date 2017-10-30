<?php

function roll_support_options() {
	global $config;
	$support = $config['support'];

	foreach ( $support as $key => $value ) {
		switch ($key) {
			case 'admin_bar' : {
				if ( $support['admin_bar'] === false ) {
					show_admin_bar( false );
				} else {
					show_admin_bar( true );
				}
				continue;
			}
			case 'menu' : {
				if ( $support['menu'] === true )
					add_theme_support( 'menus' );
				continue;
			}
		}
	}
}

add_action( 'after_setup_theme', 'roll_support_options' );
