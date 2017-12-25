<?php


class Roll_theme_options {

	private $optionsName = 'roll_theme_options';
	private $pageTitle = 'Theme options';
	private $pageSlug = 'theme-options';
    private $screen = 'appearance_page_';

	public function __construct() {
	    $this->screen .= $this->pageSlug;
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
                    <div class="tabs-container">
                        <div class="tabs">
                            <ul class="theme-options-menu">
                                <li class="tab-link" data-tab-id="1">
                                    <a href="javascript:void(0)"><i class="fa fa-address-book" aria-hidden="true"></i> Header</a>
                                    <ul class="sub-tabs">
                                        <li class="tab-link"><a href="javascript:void(0)">Social links</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" data-content-id="1">
                            <div class="top">
                                Content...
		                        <?php
		                        settings_fields( $this->optionsName );
		                        do_settings_sections( $this->pageSlug );
		                        ?>
                            </div>
	                        <div class="bottom"><?php submit_button() ?></div>
                        </div>
                    </div>
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
	    Roll_assets_admin::setShowOn([$this->screen]);
	    Roll_assets_admin::add_style('fontawesome', 'font-awesome.min.css');
	    Roll_assets_admin::add_style('roll-theme-options-style', 'theme-options.css');
	    Roll_assets_admin::add_script( 'roll-theme-options-script', 'theme-options.js', true );
     }


}