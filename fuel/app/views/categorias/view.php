<h2>Viewing #<?php echo $categoria->id; ?></h2>

<p>
	<strong>Nombre:</strong>
	<?php echo $categoria->nombre; ?></p>

<?php echo Html::anchor('categorias/edit/'.$categoria->id, 'Edit'); ?> |
<?php echo Html::anchor('categorias', 'Back'); ?>