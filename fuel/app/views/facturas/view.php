<h2>Viewing #<?php echo $factura->id; ?></h2>

<p>
	<strong>Ruc:</strong>
	<?php echo $factura->ruc; ?></p>
<p>
	<strong>Nombre:</strong>
	<?php echo $factura->nombre; ?></p>
<p>
	<strong>Fecha:</strong>
	<?php echo $factura->fecha; ?></p>
<p>
	<strong>Valor:</strong>
	<?php echo $factura->valor; ?></p>

<?php echo Html::anchor('facturas/edit/'.$factura->id, 'Edit'); ?> |
<?php echo Html::anchor('facturas', 'Back'); ?>