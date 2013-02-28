<?php echo Form::open(); ?>

	<fieldset>
		<div class="clearfix">
			<?php echo Form::label('Ruc', 'ruc'); ?>

			<div class="input">
				<?php echo Form::input('ruc', Input::post('ruc', isset($factura) ? $factura->ruc : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Nombre', 'nombre'); ?>

			<div class="input">
				<?php echo Form::input('nombre', Input::post('nombre', isset($factura) ? $factura->nombre : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Fecha', 'fecha'); ?>

			<div class="input">
				<?php echo Form::input('fecha', Input::post('fecha', isset($factura) ? $factura->fecha : date('Y-m-d')), array('class' => 'span4','data-date'=>date('Y-m-d'), 'data-date-format'=>'yyyy-mm-dd')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Valor', 'valor'); ?>

			<div class="input">
				<?php echo Form::input('valor', Input::post('valor', isset($factura) ? $factura->valor : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Grabar Factura', array('class' => 'btn btn-primary')); ?>
            <?php echo Html::anchor('facturas', 'Ir al listado de facturas', array('class' => 'btn')); ?>
		</div>
	</fieldset>
<?php echo Form::close(); ?>


<script type="text/javascript">
    $(document).ready(function() {
        $('#form_ruc').typeahead({
            minLength: 3,
            source: function(ruc, process) {
                $.post('/fp/api/rucs.json', { ruc: ruc, limit: 10 }, function(data) {
                    listado = [];
                    mapa = {};

                    $.each(data, function (i, item) {
                        mapa[item.ruc] = item;
                        listado.push(item.ruc);
                    });

                    process(listado);
                });
            },
            updater: function (item) {
                $("#form_nombre").val(mapa[item].nombre);
                return item;
            }
        });

        $('#form_fecha').datepicker({endDate: '<?php echo date('Y-m-d');?>',autoclose:true,todayHighlight:true});
    });
</script>