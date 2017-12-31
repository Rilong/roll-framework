<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 31.12.2017
 * Time: 14:28
 */

class Roll_theme_options_export {

	private $optionsName;

	public function __construct($optionsName) {
		$this->optionsName = $optionsName;
		$this->setHooks();
	}

	public function ajaxExport() {
		$json = json_encode(get_option($this->optionsName));
		file_put_contents(get_template_directory() .'/export/data.json', $json);
		$res = $json;
		echo $res;
		die;
	}

	private function setHooks() {
		add_action( 'wp_ajax_roll_ajax_export', array( $this, 'ajaxExport' ) );
		add_action( 'admin_footer', array( $this, 'add_script' ) );
	}

	public function BuildSysTab() {
		?>
		<ul class="system-tabs">
			<li class="tab-link export-tab"><a href="javascript:void(0)">Export</a></li>
		</ul>
		<?php
	}

	public function BuildSysContent() {
		?>
		<div class="system-content" style="display: none">
			<?php if (!file_exists(get_template_directory(). '/export/data.json')) :?>
				<div class="export-view" style="display: none"></div>
			<?php else:
				?>
				<div class="export-view"><?php echo file_get_contents(get_template_directory_uri() . '/export/data.json')?></div>
				<?php
			endif; ?>
			<button id="export-btn" class="button button-primary">Export</button>
			<?php if (file_exists(get_template_directory(). '/export/data.json')) :?>
				<a href="<?= get_template_directory_uri() . '/export/data.json' ?>" download>Download JSON file</a>
			<?php endif; ?>
		</div>
		<?php
	}

	public function add_script() {
		echo '<script type="text/javascript">var roll_export_dir = "'. get_template_directory_uri(). '/export/data.json' .'"</script>';
	}
}