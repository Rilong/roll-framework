<?php

$config = array(
	'assets' => array(
		'head' => array(
			'css' => array(
				'main-style' => 'css/main.css'
			),

			'js' => array()
		),

		'footer' => array(
			'css' => array(),

			'js' => array(
				'common-js' => 'js/common.js'
			)
		)
	),

	'support' => array(
		'menu'       => true,
		'customizer' => true,
		'thumbnails' => true
	),

	'customizer' => array(
		'section_id' => array(
			'title'    => 'section title',
			'priority' => 1,
			'items'    => array(
				'setting_key' => array(
					'default'   => '',
					'transport' => 'refresh',
					'field'     => array(
						'label' => 'name',
						'type'  => 'text'
					)
				)
			)
		),
	),

	'post_types' => array(
		'post_type_name' => array(
			'options' => array(),
			'labels'  => array(
				'name'     => 'My post types',
				'singular' => 'My post type',
				'edit'     => array()
			)
		)
	),

	'theme_options' => array(
		'section1' => array(
			'title'   => 'Header',
			'icon'    => 'fa-address-book',
			'options' => array(
				'header_test' => array(
					'type'  => 'text',
					'std'   => 'Default text',
					'label' => 'text type'
				)
			)
		),
		'section2' => array(
			'title'   => 'Header #2',
			'sub'     => true,
			'options' => array(
				'header_test' => array(
					'type'  => 'text',
					'std'   => 'Default text',
					'label' => 'text type'
				)
			),
		),
		'section3' => array(
			'title'   => 'Header #3',
			'sub'     => true,
			'options' => array(
				'header_test' => array(
					'type'  => 'text',
					'std'   => 'Default text',
					'label' => 'text type'
				)
			),
		),
		'section4' => array(
			'title'   => 'Header #4',
			'sub'     => false,
			'icon'    => 'fa-address-card',
			'options' => array(
				'header_test' => array(
					'type'  => 'text',
					'std'   => 'Default text',
					'label' => 'text type'
				)
			),
		),
		'section5' => array(
			'title'   => 'Header #5',
			'sub'     => true,
			'options' => array(
				'header_test' => array(
					'type'  => 'text',
					'std'   => 'Default text',
					'label' => 'text type'
				)
			),
		),
	),

	'metaboxes' => array(),

	'taxonomy' => array()
);