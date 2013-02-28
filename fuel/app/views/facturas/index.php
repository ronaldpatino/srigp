<h2>Listing Facturas</h2>
<br>
<?php if ($facturas): ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Ruc</th>
			<th>Nombre</th>
			<th>Fecha</th>
			<th>Valor</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($facturas as $factura): ?>		<tr>

			<td><?php echo $factura->ruc; ?></td>
			<td><?php echo $factura->nombre; ?></td>
			<td><?php echo $factura->fecha; ?></td>
			<td><?php echo $factura->valor; ?></td>
			<td>
				<?php echo Html::anchor('facturas/edit/'.$factura->id, 'Editar'); ?> |
				<?php echo Html::anchor('facturas/delete/'.$factura->id, 'Borrar', array('onclick' => "return confirm('Seguro desea borrar?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Facturas.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('facturas/create', 'Add new Factura', array('class' => 'btn btn-success')); ?>

</p>
