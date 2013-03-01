<h2>Listing Facturas</h2>
<br>
<?php if ($facturas): ?>
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
<p>No Facturas.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('facturas/create', 'Registrar Nueva Factura', array('class' => 'btn btn-success')); ?>

</p>
