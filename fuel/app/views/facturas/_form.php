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
            source: function(query, process) {
                $.post('/search/typeahead', { q: query, limit: 8 }, function(data) {
                    process(JSON.parse(data));
                });
            },
            updater: function (item) {
                document.location = "/search?q=" + encodeURIComponent(item);
                return item;
            },
            sorter: function (items) {
                items.unshift(this.query);
                return items;
            }
        });
    });
</script>