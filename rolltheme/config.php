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
		'customizer' => true
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

	'post_types' => array(),

	'metaboxes' => array(),

	'taxonomy' => array()
);