<h2>Viewing #<?php echo $ruc->id; ?></h2>

<p>
	<strong>Ruc:</strong>
	<?php echo $ruc->ruc; ?></p>
<p>
	<strong>Nombre:</strong>
	<?php echo $ruc->nombre; ?></p>

<?php echo Html::anchor('rucs/edit/'.$ruc->id, 'Edit'); ?> |
<?php echo Html::anchor('rucs', 'Back'); ?>