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
				<?php echo Form::input('fecha', Input::post('fecha', isset($factura) ? $factura->fecha : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="clearfix">
			<?php echo Form::label('Valor', 'valor'); ?>

			<div class="input">
				<?php echo Form::input('valor', Input::post('valor', isset($factura) ? $factura->valor : ''), array('class' => 'span4')); ?>

			</div>
		</div>
		<div class="actions">
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>

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
    });
</script>