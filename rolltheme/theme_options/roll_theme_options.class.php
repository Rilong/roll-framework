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
			echo 'ok';
		} else {
			echo 'ERROR!';
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
	}

	/*
	 * Create options page
	 */

	public function createPage() {
		add_theme_page( $this->pageTitle, $this->pageTitle, 'manage_options', $this->pageSlug, array(
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
		$class = '';
		$icon  = '';

		ob_start();
		require ROLLTHEME_DIR . 'admin/templates/options-tabs.php';
        $html = ob_get_clean();
		return $html;
	}

	/*
	 * View content options
	 */

	private function getBuildContent() {
	    $html = null;
		$display = '';
		$i = 1;

		ob_start();
		require ROLLTHEME_DIR . 'admin/templates/options-content.php';
		$html = ob_get_clean();

		return $html;
	}

	/*
	 * View options panel
	 */
	public function createPageCallback() {
		require ROLLTHEME_DIR . 'admin/templates/options-panel.php';
	}

	/*
	 * Register options
	 */

	public function registerOptions() {
		register_setting( $this->optionsName, $this->optionsName );
	}

	/*
	 * Load assets JS & CSS
	 */

	public function load_assets() {
		Roll_assets_admin::setShowOn( [ $this->screen ] );
		Roll_assets_admin::add_style( 'fontawesome', 'font-awesome.min.css' );
		Roll_assets_admin::add_style( 'roll-theme-options-style', 'theme-options.css' );
		Roll_assets_admin::add_script( 'roll-theme-options-script', 'theme-options.js', true );
		Roll_assets_admin::add_script( 'roll-theme-options-ajax', 'ajax.js', true );
	}

	/*
	 * Delete options
	 */

	public function deactivateTheme() {
		delete_option( $this->optionsName );
	}

}