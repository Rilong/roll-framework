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
				'option1' => array(
					'type'  => 'text',
					'label' => 'My text',
					'desc'  => 'test',
					'std'   => 'Default text',
				),
				'option2' => array(
					'type'  => 'text',
					'label' => 'My text 2',
					'desc'  => 'test 2',
					'std'   => 'Default text',
				)
			),
		),
		'section2' => array(
			'title'   => 'Header #2',
			'icon'    => 'fa-address-book',
			'sub'     => true,
			'options' => array(
				'option3' => array(
					'type'  => 'text',
					'label' => 'My text',
					'desc'  => 'test #3',
					'std'   => 'Default text',
				),
			)
		),

		'section3' => array(
			'title'   => 'Footer',
			'icon'    => 'fa-address-book',
			'options' => array(
				'option4' => array(
					'type'  => 'text',
					'label' => 'My text 2',
					'desc'  => 'test 2',
					'std'   => 'Default text',
				),
				'option5' => array(
					'type'  => 'text',
					'label' => 'My text 2',
					'desc'  => 'test 2',
					'std'   => 'Default text',
				)
			),
		),
		'section4' => array(
			'title'   => 'Footer #2',
			'icon'    => 'fa-address-book',
			'sub'     => true,
			'options' => array(
				'option6' => array(
					'type'  => 'text',
					'label' => 'My text 3',
					'desc'  => 'test #3',
					'std'   => 'Default text',
				),
			)
		),
	),

	'metaboxes' => array(),

	'taxonomy' => array()
);