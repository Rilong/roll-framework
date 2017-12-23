<?php


class Roll_theme_options {

	private $optionsName = 'roll_theme_options';
	private $pageTitle = 'Theme options';
	private $pageSlug = 'theme-options.php';

	public function __construct() {
		Roll_theme_options_controls::setOptionsName($this->optionsName);
		$this->load_assets();
		$this->setHooks();
	}

    private function setHooks() {
	    add_action('admin_menu', array($this, 'createPage'));
	    add_action( 'admin_init', array($this, 'registerOptions') );
    }

	public function createPage() {
		add_theme_page($this->pageTitle, $this->pageTitle, 'manage_options', $this->pageSlug, array($this, 'createPageCallback'));
	}

	public function createPageCallback() {

		?>
		<div class="wrap">
            <div class="head">
                <h2>Theme options</h2>
                <span>By Rilong</span>
            </div>
            <form action="options.php" method="post" enctype="multipart/form-data">
                <div class="white-container">
                    <?php
                        settings_fields($this->optionsName);
                        do_settings_sections($this->pageSlug);
                    ?>
                    <?php submit_button() ?>
                </div>
            </form>
		</div>
		<?php
	}

	public function registerOptions() {
		// Register the settings with Validation callback
		register_setting( $this->pageTitle, $this->optionsName );

	}

	 public function load_assets() {
	    Roll_assets_admin::add_style('roll-theme-options-style', 'theme-options.css');
     }


}