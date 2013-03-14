

<h3><?php echo $menu?></h3>

<?php if ($ayudas): ?>
<table class="zebra-striped">
	<tbody>
<?php foreach ($ayudas as $ayuda): ?>		<tr>
			<td>
				<?php echo Html::anchor('ayuda/view/'.$ayuda->id, $ayuda->titulo ); ?>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<div class="span10">
    <div class="alert alert-block">
        <h4 class="alert-heading">Lo siento :-(</h4>
        <p>A&uacute;n no existe ayuda disponinble. </p>
    </div>
</div>


<?php endif; ?>
