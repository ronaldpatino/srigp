<h2>Listing Facturas</h2>
<br>
<?php if ($facturas): ?>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>Valor</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($facturas as $factura): ?>		<tr>


        <td><?php echo $factura->fecha; ?></td>
        <td><?php echo $tipos_deducibles[$factura->tipo]; ?></td>
        <td><?php echo $factura->valor; ?></td>
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
    <?php echo Html::anchor('facturas/create', 'Add new Factura', array('class' => 'btn btn-success')); ?>

</p>


