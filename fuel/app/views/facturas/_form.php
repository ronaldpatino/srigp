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