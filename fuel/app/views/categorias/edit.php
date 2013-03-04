<h2>Editing Categoria</h2>
<br>

<?php echo render('categorias/_form'); ?>
<p>
	<?php echo Html::anchor('categorias/view/'.$categoria->id, 'View'); ?> |
	<?php echo Html::anchor('categorias', 'Back'); ?></p>
