<h2>Listing Facturas</h2>
<br>
<?php if ($facturas): ?>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Tipo</th>
        <th>N&uacute;mero de Factura</th>
        <th>Valor</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($facturas as $factura): ?>
    <tr>


        <td>
            <?php if (!empty($factura->comentario)):?>
            <a class="btn btn-primary btn-mini comentario" href="#" data-toggle='tooltip' title='<?php echo htmlspecialchars($factura->comentario, ENT_QUOTES);?>'><i class="icon-tag icon-white"></i></a>
            <?php else:?>
            <a class="btn btn-primary btn-mini disabled" href="#" data-toggle='tooltip' title='<?php echo htmlspecialchars($factura->comentario, ENT_QUOTES);?>'><i class="icon-tag icon-white"></i></a>
            <?php endif;?>

            <?php echo date('Y-m-d', strtotime( $factura->fecha ));?>
        </td>

        <td><?php echo  $tipos_deducibles[$factura->tipo]; ?></td>
        <td><?php echo $factura->numero_factura;?></td>
        <td>$ <?php echo $factura->valor; ?></td>

    </tr>
        <?php endforeach; ?>	</tbody>
</table>

<?php echo $pagination->render(); ?>
<?php else: ?>
<p>No Facturas.</p>

<?php endif; ?>
<div class="btn-group">
    <?php echo Html::anchor('facturas', '&lt;Ir al listado de facturas', array('class' => 'btn')); ?>
    <?php echo Html::anchor('facturas/create', 'Registrar Nueva Factura', array('class' => 'btn btn-success')); ?>
</div>





<script type="text/javascript">
    $(document).ready(function() {
        $('.comentario').tooltip({placement:'right',trigger:'hover'});
    });
</script>