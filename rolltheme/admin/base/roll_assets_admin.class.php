<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 22.12.2017
 * Time: 14:12
 */

class Roll_assets_admin {
	const ASSETS_DIR = '/rolltheme/admin/assets/';

	private static $css = array();
	private static $js = array();
	private static $showOn = array();

	public function __construct() {
		$this->start();
	}

	public static function instance	() {
		new Roll_assets_admin();
	}

	public function parse() {
		if ( in_array( get_current_screen()->id, self::$showOn ) ) {
			if ( ! empty( self::$css ) ) {
				foreach ( self::$css as $key => $dir ) {
					wp_enqueue_style( $key, get_template_directory_uri() . self::ASSETS_DIR . 'css/' . $dir );
				}
			}

			if ( ! empty( self::$js ) ) {
				foreach ( self::$js as $id => $params ) {
					if ( $params['file'] != '' ) {
						wp_enqueue_script( $id, get_template_directory_uri() . self::ASSETS_DIR . 'js/' . $params['file'],
							array(), null, $params['in_footer'] );
					} else {
						wp_enqueue_script( $id );
					}
				}
			}
		}
	}

	public function start() {
		add_action('admin_enqueue_scripts', array($this, 'parse'));
	}


	public static function add_style($id, $file) {
		self::$css[$id] = $file;
	}

	public static function add_script($id, $file = '', $in_footer = false) {
		self::$js[$id] = array('file' => $file, 'in_footer' => $in_footer);
	}

	public static function setShowOn($params) {
		self::$showOn = array_merge(self::$showOn,$params);
	}

	public static function getShowOn() {
		return self::$showOn;
	}
}