<div class="wrap">
	<div class="head">
		<h2>Theme options</h2>
		<span>By Rilong</span>
	</div>

	<div class="white-container">
		<div class="tabs-container">
			<div class="tabs">
				<ul class="theme-options-menu">
					<?php echo $this->getBuildTabs() ?>
				</ul>
                <ul class="system-tabs">
    				<?php $this->export->BuildSysTab() ?>
                    <?php do_action('roll_system_tabs', $this->optionsName, $this->options) ?>
                </ul>
			</div>
			<div class="options-content">
				<form id="roll-form" action="options.php" method="post" enctype="multipart/form-data">
					<div class="top">
						<?php
						settings_fields( $this->optionsName );
						echo $this->getBuildContent();
						do_action('roll_system_content', $this->optionsName, $this->options)
						?>
					</div>
					<div class="bottom"><?php submit_button() ?></div>
				</form>
			</div>
			<?php $this->export->BuildSysContent() ?>
		</div>
	</div>

</div>