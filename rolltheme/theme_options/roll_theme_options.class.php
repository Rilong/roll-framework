<?php


class Roll_theme_options {

	private $optionsName = 'roll_theme_options';
	private $pageTitle = 'Theme options';
	private $pageSlug = 'theme-options';
	private $screen = 'appearance_page_';
	private $options;
	private $optionsTree = array();
    private $export;

	public function __construct() {
		global $config;
		$this->options = $config['theme_options'];
		$this->optionsTree = $this->reformatOptions();
		$this->screen .= $this->pageSlug;

		$this->init();
	}

    /*
     * Initialize option panel
     */

	public function init() {
		Roll_theme_options_controls::setOptionsName( $this->optionsName );
		Roll_theme_options_controls::setOptions( get_option($this->optionsName) );
		$this->load_assets();
		$this->setHooks();
		$this->export = new Roll_theme_options_export($this->optionsName);
	}

	/*
	 * Save options with Ajax
	 */

	public function saveAjax() {
		parse_str( $_POST['formData'], $formData );

		$res = update_option( $this->optionsName, $formData[ $this->optionsName ] );

		if ( $res ) {
			echo 1;
		} else {
			echo 0;
		}
		die;
	}

	/*
	 * Add hooks
	 */

	private function setHooks() {
		add_action( 'admin_menu', array( $this, 'createPage' ) );
		add_action( 'admin_init', array( $this, 'registerOptions' ) );
		add_action( 'wp_ajax_roll_ajax', array( $this, 'saveAjax' ) );
		add_action( 'switch_theme', array( $this, 'deactivateTheme' ) );
		add_action( 'after_switch_theme', array( $this, 'activateTheme' ) );
		if (!is_admin())
    		add_action( 'admin_bar_menu', array($this, 'add_in_admin_bar'), 50 );
	}

	/*
	 * Create options page
	 */

	public function createPage() {
		$this->options_uri = add_theme_page( $this->pageTitle, $this->pageTitle, 'manage_options', $this->pageSlug, array(
			$this,
			'createPageCallback'
		) );
	}

	/*
	 * Make options tree
	 * @return Array
	 */

	private function reformatOptions() {
		$options    = $this->options;
		$formarted  = array();
		$section_id = null;
		foreach ( $options as $id => $option ) {
			if ( ! array_key_exists( 'sub', $option ) || $option['sub'] === false ) {
				$section_id = $id;
				$formarted[ $section_id ] = $option;
			} else {
				if ( $option['sub'] === true ) {
					$formarted[ $section_id ]['subs'][ $id ] = $option;
				}
			}
		}

		return $formarted;
	}

	/*
	 * View tabs menu
	 */

	private function getBuildTabs() {
		$html  = null;

		return $this->loadTemplate('options-tabs');
	}

	/*
	 * View content options
	 */

	private function getBuildContent() {
	    $html = null;

		return $this->loadTemplate('options-content');
	}

	/*
	 * View options panel
	 */

	public function createPageCallback() {
		$this->loadTemplate( 'options-panel', true );
	}

	/*
	 * Register options
	 */

	public function registerOptions() {
		register_setting( $this->optionsName, $this->optionsName );
	}

	/*
	 * Load templates
	 */

	private function loadTemplate($filename, $echo = false) {
		$html = null;
		$file = ROLLTHEME_DIR . 'admin/templates/'. $filename .'.php';


		if ($echo) {
			require $file;
		} else {
			ob_start();
			require $file;
			$html = ob_get_clean();
			return $html;
		}
		return true;
	}

	/*
	 * Load assets JS & CSS
	 */

	public function load_assets() {
		Roll_assets_admin::setShowOn( [ $this->screen ] );
		Roll_assets_admin::add_style( 'fontawesome', 'font-awesome.min.css' );
		Roll_assets_admin::add_style( 'rcswitcher-style', 'rcswitcher.min.css' );
		Roll_assets_admin::add_style( 'colorpicker-style', 'colorpicker.css' );
		Roll_assets_admin::add_style( 'roll-theme-options-style', 'theme-options.css' );

		Roll_assets_admin::add_script( 'rcswitcher-script', 'rcswitcher-4.0.min.js', true );
		Roll_assets_admin::add_script( 'colorpicker-script', 'colorpicker.js', true );
		Roll_assets_admin::add_script( 'roll-theme-options-script', 'theme-options.js', true );
		Roll_assets_admin::add_script( 'roll-theme-options-ajax', 'ajax.js', true );
	}

	/*
	 * Add links in admin bar
	 */

	public function add_in_admin_bar() {
	    global $wp_admin_bar;
	    $args = array(
	        'id' => $this->optionsName,
	        'title' => 'Theme options',
            'href' => admin_url() . 'themes.php?page=theme-options'
        );
	    $wp_admin_bar->add_node($args);
    }

	/*
	 * Add options
	 */

	public function activateTheme() {
		if ($options = $this->export->import()) {
			add_option($this->optionsName, $options);
		}
	}

	/*
	 * Delete options
	 */

	public function deactivateTheme() {
		$this->export->export();
		delete_option( $this->optionsName );
	}

}