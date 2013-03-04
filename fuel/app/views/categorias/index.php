<h2>Listing Categorias</h2>
<br>
<?php if ($categorias): ?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Nombre</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($categorias as $categoria): ?>		<tr>

			<td><?php echo $categoria->nombre; ?></td>
			<td>
				<?php echo Html::anchor('categorias/view/'.$categoria->id, 'View'); ?> |
				<?php echo Html::anchor('categorias/edit/'.$categoria->id, 'Edit'); ?> |
				<?php echo Html::anchor('categorias/delete/'.$categoria->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Categorias.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('categorias/create', 'Add new Categoria', array('class' => 'btn btn-success')); ?>

</p>
