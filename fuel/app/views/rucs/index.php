<h2>Listing Rucs</h2>
<br>
<?php if ($rucs): ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Ruc</th>
			<th>Nombre</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rucs as $ruc): ?>		<tr>

			<td><?php echo $ruc->ruc; ?></td>
			<td><?php echo $ruc->nombre; ?></td>
			<td>
				<?php echo Html::anchor('rucs/view/'.$ruc->id, 'View'); ?> |
				<?php echo Html::anchor('rucs/edit/'.$ruc->id, 'Edit'); ?> |
				<?php echo Html::anchor('rucs/delete/'.$ruc->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Rucs.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('rucs/create', 'Add new Ruc', array('class' => 'btn btn-success')); ?>

</p>
