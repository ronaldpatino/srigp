
<h3>Bienvenido</h3>
<?php echo Form::open('users/login'); ?>

<div class="input text required">
    <?php echo Form::label('Usuario', 'username'); ?>
    <?php echo Form::input('username', isset($username) ? $username : false, array('size' => 30)); ?>
</div>

<div class="input password required">
    <?php echo Form::label('Contrase&ntilde;a', 'password'); ?>
    <?php echo Form::password('password', NULL, array('size' => 30)); ?>
</div>

<div class="input submit">
    <?php echo Form::submit('login', 'Entrar',array('class'=>'btn btn-primary')); ?>
</div>
