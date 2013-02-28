<h2>Editing Factura</h2>
<br>

<?php echo render('facturas/_form'); ?>
<p>
	<?php echo Html::anchor('facturas/view/'.$factura->id, 'View'); ?> |
	<?php echo Html::anchor('facturas', 'Back'); ?></p>
