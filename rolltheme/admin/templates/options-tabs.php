<?php
foreach ( $this->optionsTree as $sectionName => $section ) {
	$class = isset( $section['subs'] ) && ! empty( $section['subs'] ) ? ' has-sub' : '';
	$icon  = isset( $section['icon'] ) ? '<i class="fa ' . $section['icon'] . '"></i> ' : '';

	?>

<li class="tab-link<?= $class ?>" data-tab-id="<?= $sectionName ?>">
	<a href="javascript:void(0)"> <?= $icon . $section['title'] ?></a>
	<?php if ( isset( $section['subs'] ) && ! empty( $section['subs'] ) ) {?>
	<ul class="sub-tabs">
		<?php foreach ( $section['subs'] as $subName => $sub ) {?>
		<li class="tab-link" data-tab-id="<?= $subName ?>"><a href="javascript:void(0)"><?= $sub['title'] ?></a></li>
		<?php } ?>
	</ul>
	<?php } ?>

</li>

<?php } ?>
