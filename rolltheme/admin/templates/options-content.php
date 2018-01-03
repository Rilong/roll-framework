<?php foreach ( $this->options as $sectionName => $section ) {
    if ( $i == 1 ) {
        $display = ' style="display: block;"';
    } else {
        $display = '';
    }
?>

<div class="tab-content" data-content-id="<?= $sectionName ?>"<?= $display ?> >
    <h3><?= $section['title'] ?></h3>

	<?php if ( isset( $section['options'] ) && ! empty( $section['options'] ) ) { ?>
        <table class="table-options">
			<?php foreach ( $section['options'] as $optionId => $option ) {
				$option['id'] = $optionId;
				echo Roll_theme_options_controls::getControl( $option['type'], $option );
				$i++;
			} ?>
        </table>
        </div>
	<?php }
	$i++;
} ?>