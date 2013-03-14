<h3>Gastos</h3>
<?php if ($facturas->count() > 0): ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Ruc</th>
			<th>Nombre</th>
			<th>Total</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($facturas as $factura): ?>		<tr>

			<td><?php echo $factura->ruc; ?></td>
			<td><?php echo Str::upper($factura->nombre); ?></td>

			<td>$ <?php echo $factura->total; ?></td>
			<td>
				<?php echo Html::anchor('facturas/view/'.$factura->ruc, 'Detalle'); ?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>
<?php echo $pagination->render(); ?>
<?php else: ?>

<div class="span10">
    <div class="alert alert-block">
        <h4 class="alert-heading">Lo siento :-(</h4>
        <p>A&uacute;n no has ingresado Facturas. <br/>Sin facturas no puedo calcular los Gastos. </p>
    </div>
</div>


<?php endif; ?>