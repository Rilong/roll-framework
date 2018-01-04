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
				<?php $this->export->BuildSysTab() ?>
			</div>
			<div class="options-content">
				<form id="roll-form" action="options.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="color" class="roll-colorpicker">
					<div class="top">
						<?php
						settings_fields( $this->optionsName );
						echo $this->getBuildContent();
						?>
					</div>
					<div class="bottom"><?php submit_button() ?></div>
				</form>
			</div>
			<?php $this->export->BuildSysContent() ?>
		</div>
	</div>

</div>