<?php


class Roll_theme_options {

	private $optionsName = 'roll_theme_options';
	private $pageTitle = 'Theme options';
	private $pageSlug = 'theme-options';
    private $screen = 'appearance_page_';
    private $options;
    private $optionsTree = array();

	public function __construct() {
	    global $config;
        $this->options = $config['theme_options'];
        $this->optionsTree = $this->reformatOptions();

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

	private function reformatOptions() {
	    $options = $this->options;
	    $formarted = array();
	    $section_id = null;
	    foreach ($options as $id => $option) {
            if (!array_key_exists('sub', $option) || $option['sub'] === false) {
                $section_id = $id;
                $formarted[$section_id] = $option;
            }else {
                if ($option['sub'] === true) {
                    $formarted[$section_id]['subs'][$id] = $option;
                }
            }
        }

       return $formarted;
    }

	private function getBulidTabs() {
	    $html = '';
	    $class = '';
        $icon = '';
	    foreach ($this->optionsTree as $sectionName => $section) {
	        $class = isset($section['subs']) && !empty($section['subs']) ? ' has-sub' : '';
	        $icon = isset($section['icon']) ? '<i class="fa '.$section['icon'].'"></i> ' : '';

	        $html .= '<li class="tab-link'.$class.'" data-tab-id="'.$sectionName.'">';
	        $html .= '<a href="javascript:void(0)">'.$icon.$section['title'].'</a>';

	        if (isset($section['subs']) && !empty($section['subs'])) {
		        $html .= '<ul class="sub-tabs">';
		        foreach ($section['subs'] as $subName => $sub) {
	                $html .= '<li class="tab-link" data-tab-id="'. $subName .'"><a href="javascript:void(0)">'.$sub['title'].'</a></li>';
                }
		        $html .= '</ul>';
	        }

            $html .= '</li>';

        }


        return $html;
    }

    private function getBuildContent() {
	    $html = '';
	    foreach ($this->options as $sectionName => $section) {
		    $html .= '<div class="tab-content" data-content-id="'.$sectionName.'">';
		    $html .= '<h3>'. $section['title'] .'</h3>';

		    if (isset($section['options']) && !empty($section['options'])) {
			    $html .=  '<table class="table-options">';
			    foreach ($section['options'] as $optionId => $option) {
				    $option['id'] = $optionId;
				    $html .= Roll_theme_options_controls::getControl($option['type'], $option);
			    }
			    $html .= '</table></div>';
		    }
	    }
	    return $html;
    }

	public function createPageCallback() {
		?>
		<div class="wrap">
            <div class="head">
                <h2>Theme options</h2>
                <span>By Rilong</span>
            </div>
            <form action="options.php" method="post" enctype="multipart/form-data">
                <?php
                settings_fields( $this->optionsName );
                do_settings_sections( $this->pageSlug ); ?>
                <div class="white-container">
                    <div class="tabs-container">
                        <div class="tabs">
                            <ul class="theme-options-menu">
                                <?php echo $this->getBulidTabs() ?>
                            </ul>
                        </div>
                        <div class="options-content">
	                        <div class="top"><?php echo $this->getBuildContent() ?></div>
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