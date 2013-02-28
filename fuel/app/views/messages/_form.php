<?php echo Form::open(); ?>

	<fieldset>

			<?php echo Form::label('Name', 'name'); ?>

		    <?php echo Form::input('name', Input::post('name', isset($message) ? $message->name : ''), array('class' => 'span4')); ?>

			<?php echo Form::label('Message', 'message'); ?>

			<?php echo Form::textarea('message', Input::post('message', isset($message) ? $message->message : ''), array('class' => 'span8', 'rows' => 8)); ?>

            <div class="control-group">
                <div class="controls">
                    <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>
                </div>
            </div>



	</fieldset>
<?php echo Form::close(); ?>