<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css(array('bootstrap.css','datepicker.css')); ?>
    <?php echo Asset::js(array('jquery.js', 'bootstrap.js','bootstrap-datepicker.js','raphael-min.js','g.raphael-min.js','g.pie-min.js','util.js'));?>

</head>
<body>

<div class="navbar navbar-inverse nav-pills navbar-fixed-top">
    <div class="navbar-inner">

        <?php echo Html::anchor('/', 'GP', array('class'=>'brand','style'=>'margin-left:0px;'));?>
        <ul class="nav">
            <li <?php echo isset($home)?'class="active"':'';?>><?php echo Html::anchor('/', '<i class="icon-home"></i> Inicio');?></li>
            <li <?php echo isset($gastos)?'class="active"':'';?>><?php echo Html::anchor('/facturas/', '<i class="icon-briefcase"></i> Gastos');?></li>
            <li <?php echo isset($reportes)?'class="active"':'';?>><?php echo Html::anchor('/reportes/', '<i class="icon-book"></i> Reportes');?></li>
            <li <?php echo isset($ayuda)?'class="active"':'';?>><?php echo Html::anchor('/ayuda/', '<i class="icon-question-sign"></i> Ayuda');?></li>
        </ul>

        <ul class="nav pull-right">
            <li>
                <?php echo Form::open(array('action' => 'facturas/create/', 'method' => 'get', 'class'=>'nav pull-right form-inline', 'style'=>'margin:0px;width:200px;'));?>
                <button class="btn btn-primary" type="submit">Registrar Nueva Factura</button>
                <?php echo Form::close();?>

            </li>
            <li class="divider-vertical"></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Mi Cuenta <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><?php echo Html::anchor('/configuracion/', '<i class="icon-wrench"></i> Configuraci&oacute;n');?></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><?php echo Html::anchor('/users/logout', '<i class="icon-remove-sign"></i> Salir');?></li>
                </ul>
            </li>
        </ul>
        </div>

</div>
<hr/>
<div class="container">

		<div class="row">

<?php if (Session::get_flash('success')): ?>
            <div class="span12">
				<div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Muy Bien! :-)</h4>
					<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>

				</div>
            </div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
            <div class="span12">
				<div class="alert alert-error">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4>Lo siento, Algo sali&oacute; mal :-(</h4>
					<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>

				</div>
            </div>
<?php endif; ?>

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
