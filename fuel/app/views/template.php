<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css(array('bootstrap.css','datepicker.css')); ?>
    <?php echo Asset::js(array('jquery.js', 'bootstrap.js','bootstrap-datepicker.js'));?>
	<style>
		body { margin: 40px; }
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span12">

<?php if (Session::get_flash('success')): ?>
				<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Muy Bien!</strong>
					<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>

				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Algo sali&oacute; mal</strong>
					<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>

				</div>
<?php endif; ?>
			</div>
			<div class="span12">
<?php echo $content; ?>
			</div>
		</div>
		<footer>
            <!--
			<p class="pull-right">Page rendered in {exec_time}s using {mem_usage}mb of memory.</p>
			<p>
				<a href="http://fuelphp.com">FuelPHP</a> is released under the MIT license.<br>
				<small>Version: <?php echo e(Fuel::VERSION); ?></small>
			</p>
			-->
		</footer>
	</div>
</body>
</html>
