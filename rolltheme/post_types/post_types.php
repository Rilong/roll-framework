<?php

	function roll_create_post_type() {
		global $config;

		$post_types = $config['post_types'];
		$theme_domain = wp_get_theme()->get( 'textDomain' );
		$defaults = array(
			'public' => true,
			'menu_position' => 1,
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'has_archive' => true
		);

		if (!empty( $post_types )) {
			foreach ( $post_types as $type_key => $type ) {
				$name = $type['labels']['name'];
				$singular = $type['labels']['singular'];

				$labels = array(
					'name' => esc_html__( $name, $theme_domain ),
					'singular_name' => esc_html__( $singular, $theme_domain ),
					'add_new' => esc_html__( 'Add new ' . mb_strtolower( $name ), $theme_domain ),
					'add_new_item' => esc_html__( 'Add new ' . mb_strtolower( $singular ), $theme_domain ),
					'edit' => esc_html__( 'Edit ' . mb_strtolower( $name ), $theme_domain ),
					'edit_item' => esc_html__( 'Edit ' . mb_strtolower( $singular ), $theme_domain ),
					'new_item' => esc_html__( 'New ' . mb_strtolower( $singular ), $theme_domain ),
					'view' => esc_html__( 'Show ' . mb_strtolower( $name ), $theme_domain ),
					'view_item' => esc_html__( 'Show ' . mb_strtolower( $singular ), $theme_domain ),
					'search_items' => esc_html__( 'Search ' . mb_strtolower( $name ), $theme_domain ),
					'not_found' => esc_html__( 'Not found  ' . mb_strtolower( $name ), $theme_domain ),
					'not_found_in_trash' => esc_html__( 'Not found in trash', mb_strtolower( $theme_domain ) ),
					'parent' => ''
				);

				if ( isset( $type['labels']['edit'] ) && ! empty( $type['labels']['edit'] ) )
					$labels = array_merge( $labels, $type['labels']['edit'] );

				$options = $defaults;

				if ( isset( $type['options'] ) && ! empty( $type['options'] ) )
					$options = array_merge($options, $type['options']);

				$post_type_data = array('labels' => $labels);
				$post_type_data = array_merge($post_type_data, $options);

				register_post_type($type_key, $post_type_data);

			}
		}

	}

	add_action('roll_init', 'roll_create_post_type');